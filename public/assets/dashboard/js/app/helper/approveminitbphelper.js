import * as MiniTbp from './minitbp.js'


$(document).on('click', '#editapprove', function(e) {
    $('#minitbpid').val($(this).data('id'));
    $('#minitbptitle').html(' โครงการ : '+ $(this).data('project'));
    
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
          title: 'ยืนยัน',
          text: `ต้องการอนุมัติ Mini TBP `,
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
        Swal.fire({
            title: 'ยืนยัน',
            text: `ต้องการส่งคืน Mini TBP `,
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
      }
});

$(document).on('click', '.showlog', function(e) {
    var html ='';
    $("#spinicon_showlog"+$(this).data('id')).attr("hidden",false);
    getReviseLog($(this).data('id'),$(this).data('doctype')).then(data => {   
        data.forEach(function (log,index) {
            html += `<tr >                                        
                <td> ${log.message} </td>    
                <td style="white-space: nowrap;"> ${log.user} </td>                                         
                <td style="white-space: nowrap;text-align: center"> ${log.createdatth} </td>                                          
                
            </tr>`
            });
        $("#reviselog_wrapper_tr").html(html);
        $("#showlogminitbp").html(': ' +$(this).data('project'));
        $("#spinicon_showlog"+$(this).data('id')).attr("hidden",true);
        $('#modal_show_reviselog').modal('show');
    }).catch(error => {})
    
});

$(document).on('click', '.showapprovelog', function(e) {
    var html ='';
    getApproveLog($(this).data('id'),$(this).data('doctype')).then(data => {  
        $("#approvelog_detail").html(data[0].approvelog);
        $("#approvelog_info").html(data[0].approveby);
        $("#approvelog_date").html(data[0].createdatth);
        $("#showapprovelogminitbp").html(data[0].project);
        $('#modal_show_approvelog').modal('show');
    }).catch(error => {})
});

function getReviseLog(minitbpid,doctype){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/api/minitbp/getreviselog`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            minitbpid : minitbpid,
            doctype : doctype
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

  function getApproveLog(minitbpid,doctype){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/api/minitbp/getapprovelog`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            minitbpid : minitbpid,
            doctype : doctype
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



