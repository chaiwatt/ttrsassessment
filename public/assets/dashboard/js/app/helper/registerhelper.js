

$("#usergroup").on('change', function() {
    console.log($(this).val());
    $("#vatnomessage").attr("hidden",true);
    $("#vatnomessage").addClass("validation-invalid-label")
    if($(this).val() == 1) {
        $("#vatwrapper").attr("hidden",true);
    } else { 
        $("#vatwrapper").attr("hidden",false);
    }
});

$("#vatno").change(function(){
    var vatid = $(this).val();
    $("#vatnomessage").addClass("validation-invalid-label")
    if(vatid.length != 13){     
        $('#msg').html("หมายเลขผู้เสียภาษีไม่ถูกต้อง")
        $("#vatnomessage").attr("hidden",false);
        return ;
    }else{
        $("#vatnomessage").attr("hidden",true);
    }
    checkTinPin($(this).val()).then(data => {
        let  html = "";
        console.log(data[0]);
        if(data.length != 0 ){
            $("#vatnomessage").removeClass("validation-invalid-label")
            $("#vatnomessage").addClass("validation-valid-label")
            $('#msg').html(data[0].title + data[0].name)
            $("#vatnomessage").attr("hidden",false); 
        }else{
            $("#vatnomessage").removeClass("validation-valid-label")
            $("#vatnomessage").addClass("validation-invalid-label")
            $('#msg').html("ไม่พบนิติบุคคล");
            $("#vatnomessage").attr("hidden",false); 
        }
        // data.forEach((tambol,index) => 
        //     html += `<option value='${tambol.id}'>${tambol.name}</option>`
        // )
        // $("#tambol").html(html);

    })
    .catch(error => {
        console.log(error)
    })
});


function checkTinPin(vatid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/tinpin/companyinfo`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            vatid : vatid
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