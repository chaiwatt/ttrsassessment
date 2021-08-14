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

  backgroundColor: 'rgb(255, 255, 255)',
  penColor: "rgb(81, 0, 234)"
});

signaturePad.clear();

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

savePNGButton.addEventListener("click", function (event) {
  if (signaturePad.isEmpty()) {
    alert("ยังไม่ได้เซนต์ลายมือชื่อ");
  } 
  else 
  {
    // console.log($('#authorizeddirectorid').val());
    var dataURL = signaturePad.toDataURL();
    $("#dataurl").val(dataURL);
    $("#imgdivedit").attr("src", dataURL);

    updateSignature(dataURL,$('#authorizeddirectorid').val()).then(data => {
        $(`#edit${$('#authorizeddirectorid').val()}`).html('<span class="badge badge-flat border-success text-success">มีลายมือชื่อแล้ว</span>');
       
        $(`#auth${$('#authorizeddirectorid').val()}`).data('id',2);
        $('#modal_signature').modal('hide');
       
      })
    .catch(error => {})
  }
});

function updateSignature(dataURL,directorid){
  var url = `${route.url}/api/profile/updatesignature`;
  return new Promise((resolve, reject) => {
      $.ajax({
        url: url,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          signaturebase64 : dataURL,
          directorid : directorid
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
  // var reader = new FileReader();
// console.log(reader.readAsDataURL(this.files[0]));
var file = this.files[0];
if(file){
    var reader = new FileReader();
    reader.onload = function(){
        $("#imgdivedit").attr("src", reader.result);
        //console.log(reader.result);
        $("#dataurl").val(reader.result);
        updateSignature(reader.result,$('#authorizeddirectorid').val()).then(data => {
          $('#modal_signature').modal('hide');
        })  .catch(error => {})
    }




    reader.readAsDataURL(file);
    // $('#modal_signature').modal('hide');
}

});


function readURL(input) {

  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $(input).next('img').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
  }
}