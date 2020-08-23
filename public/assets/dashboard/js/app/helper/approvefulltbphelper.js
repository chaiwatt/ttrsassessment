import * as FullTbp from './fulltbp.js'

$(document).on('click', '#editapprove', function(e) {
    $('#fulltbpid').val($(this).data('id'));
    $('#modal_edit_fulltbp').modal('show');
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

$(document).on('click', '#btn_modal_edit_fulltbp', function(e) {
    FullTbp.editApprove($('#fulltbpid').val(),$("input[name='result']:checked").val(),$('#note').val()).then(data => {
        var html = ``;
        console.log('ok test');
        window.location.replace(`${route.url}/dashboard/admin/project/fulltbp`);
   }).catch(error => {})
});