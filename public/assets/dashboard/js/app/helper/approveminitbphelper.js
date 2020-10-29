import * as MiniTbp from './minitbp.js'


$(document).on('click', '#editapprove', function(e) {
    $('#minitbpid').val($(this).data('id'));
    $('#modal_edit_minitbp').modal('show');
});

// $(document).on('change', '#my_radio_box', function(e) {
//     if($("input[name='result']:checked").val()=='1'){
//         console.log('1');
//         $('#note').attr('readonly', true);
//     }else{
//         console.log('2');
//         $('#note').attr('readonly', false);
//     }
// });

$(document).on('click', '#btn_modal_edit_minitbp', function(e) {
    $("#spinicon"+$('#minitbpid').val()).attr("hidden",false);
    MiniTbp.editApprove($('#minitbpid').val(),$("input[name='result']:checked").val(),$('#note').val()).then(data => {
        var html = ``;        
        window.location.replace(`${route.url}/dashboard/admin/project/minitbp`);
   }).catch(error => {})
});

