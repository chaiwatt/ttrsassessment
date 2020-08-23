import * as MiniTbp from './minitbp.js'


$(document).on('click', '#editapprove', function(e) {
    $('#minitbpid').val($(this).data('id'));
    $('#modal_edit_minitbp').modal('show');
});

$('#my_radio_box').change(function(){
    if($("input[name='result']:checked").val()=='1'){
        console.log('1');
        $('#note').attr('readonly', true);
    }else{
        console.log('2');
        $('#note').attr('readonly', false);
    }
});

$(document).on('click', '#btn_modal_edit_minitbp', function(e) {
    console.log($("input[name='result']:checked").val());
    MiniTbp.editApprove($('#minitbpid').val(),$("input[name='result']:checked").val(),$('#note').val()).then(data => {
        var html = ``;
        console.log('ok test');
        window.location.replace(`${route.url}/dashboard/admin/project/minitbp`);
   }).catch(error => {})
});

