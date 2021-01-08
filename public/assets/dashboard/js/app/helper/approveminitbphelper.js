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
    $('#modal_edit_minitbp').modal('hide');
    $("#spinicon"+$('#minitbpid').val()).attr("hidden",false);
        MiniTbp.editApprove($('#minitbpid').val(),$("input[name='result']:checked").val(),$('#note').val()).then(data => {     
            window.location.replace(`${route.url}/dashboard/admin/project/minitbp`);
       }).catch(error => {})
});

