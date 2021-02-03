import * as MiniTbp from './minitbp.js'


$(document).on('click', '#editapprove', function(e) {
    $('#minitbpid').val($(this).data('id'));
    $('#modal_edit_minitbp').modal('show');
});

$(document).on('change', '#my_radio_box', function(e) {
    if($("input[name='result']:checked").val()=='1'){
        $('#messageshow').html('ข้อความเพิ่มเติม');
    }else{
        $('#messageshow').html('ข้อความเพิ่มเติม<span class="text-danger">*</span>');
    }
});

$(document).on('click', '#btn_modal_edit_minitbp', function(e) {
    var check = $("input[name='result']:checked").val();
    if(check == 2 && $('#note').val() == ''){
        return ;
    }

    if(check == 1){
        Swal.fire({
          title: 'ยืนยัน!',
          text: `ต้องการอนุมัติ Mini TBP หรือไม่`,
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'ตกลง',
          cancelButtonText: 'ยกเลิก',
          closeOnConfirm: false,
          closeOnCancel: false
          }).then((result) => {
          if (result.value) {
            $('#modal_edit_minitbp').modal('hide');
            $("#spinicon"+$('#minitbpid').val()).attr("hidden",false);
            MiniTbp.editApprove($('#minitbpid').val(),$("input[name='result']:checked").val(),$('#note').val()).then(data => {     
                    window.location.replace(`${route.url}/dashboard/admin/project/minitbp`);
            }).catch(error => {})
          }
      });
      }else if(check == 2){
        $('#modal_edit_minitbp').modal('hide');
        $("#spinicon"+$('#minitbpid').val()).attr("hidden",false);
        MiniTbp.editApprove($('#minitbpid').val(),$("input[name='result']:checked").val(),$('#note').val()).then(data => {     
                window.location.replace(`${route.url}/dashboard/admin/project/minitbp`);
        }).catch(error => {})
      }






});

