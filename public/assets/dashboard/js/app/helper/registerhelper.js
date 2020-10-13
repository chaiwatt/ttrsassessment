
 $(".modal-body").on( 'scroll', function(){
    if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight){
        $('#btnaccept').prop('disabled', false);
        $('#term').prop('disabled', false);
      }
 });

$(document).on("click","#btnaccept",function(e){
    // $(".chkterm").attr("checked",true);
    $(".chkterm").attr('checked',true);
 });



$("#usergroup").on('change', function() {
    $("#vatnomessage").attr("hidden",true);
    $("#vatnomessage").addClass("validation-invalid-label")
    if($(this).val() == 1) {
        $("#vatwrapper").attr("hidden",false);
    } else { 
        $("#vatwrapper").attr("hidden",true);
    }
});

$("#vatno").on( 'change', function(){
    var vatid = $(this).val();
    if(vatid.length != 13){     
        $("#vatnomessage").removeClass("validation-valid-label")
        $("#vatnomessage").addClass("validation-invalid-label")
        $('#msg').html("หมายเลขผู้เสียภาษีไม่ถูกต้อง")
        $("#vatnomessage").attr("hidden",false);
        $('#vatno').val('');
        return ;
    }else{
        $("#vatnomessage").attr("hidden",true);
    }
    checkTinPin($(this).val()).then(data => {
        if(data.length != 0 ){
            if(data[0].exist == 'n'){
                $("#vatnomessage").removeClass("validation-invalid-label")
                $("#vatnomessage").addClass("validation-valid-label")
                $('#msg').html(data[0].title + data[0].name)
                $('#companyname').val(data[0].title + data[0].name);
                $("#vatnomessage").attr("hidden",false); 
            }else if(data[0].exist == 'y') {
                $("#vatnomessage").removeClass("validation-valid-label")
                $("#vatnomessage").addClass("validation-invalid-label")
                $('#msg').html("นิติบุคคลนี้ลงทะเบียนแล้ว");
                $('#vatno').val('');
                $("#vatnomessage").attr("hidden",false); 
            }
        }else{
            $("#vatnomessage").removeClass("validation-valid-label")
            $("#vatnomessage").addClass("validation-invalid-label")
            $('#msg').html("ไม่พบนิติบุคคล");
            $('#vatno').val('');
            $("#vatnomessage").attr("hidden",false); 
        }
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