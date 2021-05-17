var wrapper = document.getElementById("signature-pad");
var wrapper_edit = document.getElementById("signature_type");
var clearButton = wrapper.querySelector("[data-action=clear]");
var changeColorButton = wrapper.querySelector("[data-action=change-color]");
var undoButton = wrapper.querySelector("[data-action=undo]");
var savePNGButton = wrapper.querySelector("[data-action=save-png]");
var saveJPGButton = wrapper.querySelector("[data-action=save-jpg]");
var saveSVGButton = wrapper.querySelector("[data-action=save-svg]");
var canvas = wrapper.querySelector("canvas");
var signaturePad = new SignaturePad(canvas, {
  // It's Necessary to use an opaque color when saving image as JPEG;
  // this option can be omitted if only saving as PNG or SVG
  backgroundColor: 'rgb(255, 255, 255)',
  penColor: "rgb(81, 0, 234)"
});

function download(dataURL, filename) {
  if (navigator.userAgent.indexOf("Safari") > -1 && navigator.userAgent.indexOf("Chrome") === -1) {
    window.open(dataURL);
  } else {
    var blob = dataURLToBlob(dataURL);
    var url = window.URL.createObjectURL(blob);

    var a = document.createElement("a");
    a.style = "display: none";
    a.href = url;
    a.download = filename;

    document.body.appendChild(a);
    a.click();

    window.URL.revokeObjectURL(url);
  }
}

// One could simply use Canvas#toBlob method instead, but it's just to show
// that it can be done using result of SignaturePad#toDataURL.
function dataURLToBlob(dataURL) {
  // Code taken from https://github.com/ebidel/filer.js
  var parts = dataURL.split(';base64,');
  var contentType = parts[0].split(":")[1];
  var raw = window.atob(parts[1]);
  var rawLength = raw.length;
  var uInt8Array = new Uint8Array(rawLength);

  for (var i = 0; i < rawLength; ++i) {
    uInt8Array[i] = raw.charCodeAt(i);
  }

  return new Blob([uInt8Array], { type: contentType });
}

clearButton.addEventListener("click", function (event) {
  signaturePad.clear();
});

undoButton.addEventListener("click", function (event) {
  var data = signaturePad.toData();

  if (data) {
    data.pop(); // remove the last dot or line
    signaturePad.fromData(data);
  }
});

// changeColorButton.addEventListener("click", function (event) {
//   var r = Math.round(Math.random() * 255);
//   var g = Math.round(Math.random() * 255);
//   var b = Math.round(Math.random() * 255);
//   var color = "rgb(" + r + "," + g + "," + b +")";

//   signaturePad.penColor = color;
// });

savePNGButton.addEventListener("click", function (event) {
  if (signaturePad.isEmpty()) {
    alert("ยังไม่ได้เซนต์ลายมือชื่อ");
  } else {
    var dataURL = signaturePad.toDataURL();
    uploadSignature(dataURL).then(data => {
    var html = `<img id="signatureimg" src="${route.url}/${data.path}" style="width: 150px;height:75px" alt="">`;
    $("#signatureid").val(data.id);
    $('#modal_signature').modal('hide');
    if(wrapper_edit.value == 1){
      $("#sigdiv").html(html);
    }else{
      $("#sigdiv_edit").html(html);
    }

  })
  .catch(error => {

  })

  }
});

function uploadSignature(dataURL){
  var url = `${route.url}/api/profile/uploadcanvassignature`;
  return new Promise((resolve, reject) => {
      $.ajax({
        url: url,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          signaturebase64 : dataURL
        },
        success: function(data) {
          resolve(data)
        },
        error: function(error) {
          reject(error)
        },
      })
    })
}

$("#signature").on('change', function() {
  var file = this.files[0];
  var fextension = file.name.substring(file.name.lastIndexOf('.')+1);
  var validExtensions = ["jpg","jpeg","gif","png","bmp"];
  if(!validExtensions.includes(fextension)){
      Swal.fire({
          title: 'ผิดพลาด...',
          text: 'รูปแบบไฟล์ไม่ถูกต้อง!',
          });
      this.value = "";
      return false;
  }
  if (this.files[0].size/1024/1024*1000 > 1000 ){
      Swal.fire({
        title: 'ผิดพลาด...',
        text: 'ไฟล์ขนาดมากกว่า 1 MB!',
        });
      return ;
  }

  var formData = new FormData();
  formData.append('signature',file);
  var url = `${route.url}/api/profile/uploadsignature`;
      $.ajax({
          url: url,  //Server script to process data
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: formData,
          contentType: false,
          processData: false,
          success: function(data){            
              $("#signatureid").val(data.id);
              var html = `<br><img id="signatureimg" src="${route.url}/${data.path}" style="width: 150px;height:75px" alt="">`;
              $('#modal_signature').modal('hide');
              if(wrapper_edit.value == 1){
                $("#sigdiv").html(html);
              }else{
                $("#sigdiv_edit").html(html);
              }
      }
  });
});