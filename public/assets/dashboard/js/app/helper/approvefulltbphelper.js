import * as FullTbp from './fulltbp.js'
import * as Calendar from './calendar.js'

$(document).on('click', '#editapprove', function(e) {
    $('#fulltbpid').val($(this).data('id'));
    $('#modal_edit_fulltbp').modal('show');
});

$(document).on('change', '#my_radio_box', function(e) {
  if($("input[name='result']:checked").val()=='1'){
      $('#messageshow').html('ข้อความเพิ่มเติม');
  }else{
      $('#messageshow').html('ข้อความเพิ่มเติม<span class="text-danger">*</span>');
  }
});

$(document).on('click', '#btn_modal_edit_fulltbp', function(e) {
  var check = $("input[name='result']:checked").val();
  if(check == 2 && $('#note').val() == ''){
      return ;
  }
    if(check == 1){
      Swal.fire({
        title: 'ยืนยัน',
        text: `ต้องการอนุมัติ Full TBP`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
          $('#modal_edit_fulltbp').modal('hide');
          $("#spinicon"+$('#fulltbpid').val()).attr("hidden",false);
          FullTbp.editApprove($('#fulltbpid').val(),$("input[name='result']:checked").val(),$('#note').val()).then(data => {
                var html = ``;
                window.location.replace(`${route.url}/dashboard/admin/project/fulltbp`);
          }).catch(error => {})
        }
      });
    }else if(check == 2){
      Swal.fire({
        title: 'ยืนยัน',
        text: `ต้องการส่งคืน Full TBP ให้แก้ไข`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
          $('#modal_edit_fulltbp').modal('hide');
          $("#spinicon"+$('#fulltbpid').val()).attr("hidden",false);
          FullTbp.editApprove($('#fulltbpid').val(),$("input[name='result']:checked").val(),$('#note').val()).then(data => {
              var html = ``;
              window.location.replace(`${route.url}/dashboard/admin/project/fulltbp`);
        }).catch(error => {})
        }
      });

    }
});

$(document).on('click', '.projectmember', function(e) {

 var isleader =$(this).data('isprojectleader');
 var leaderid = $(this).data('projectleaderid');
 console.log(isleader);
    $('#fulltbpid').val($(this).data('id'));
      getUsers($(this).data('id')).then(data => {
          var html =``;
          var html1 =``;
          var hiddenbtn = `-`;
          if (isleader == 0) {
            $("#selectothermember").attr("hidden",true);

          }

          data.users.forEach(function (user,index) {
              html += `<option value="${user['id']}" >${user['name']}  ${user['lastname']}</option>`
          });
         
          data.projectmembers.forEach(function (projectmember,index) {
           
            var check = data.scoringstatuses.filter(x => x.user_id == projectmember.user_id)[0]; 
            var moreinfo = ``;
            if(typeof(check) != "undefined"){
              moreinfo = `<span class="badge badge-flat border-success text-success-600">ลงคะแนนแล้ว</span>`;
            }else{
              if (isleader == 0) {
                moreinfo = `<span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้ลงคะแนน</span>`;
              }else{
                if(projectmember.user_id != leaderid){
                  moreinfo = `<button type="button" data-id="${projectmember.id}" class="btn btn-sm bg-danger deleteprojectmember" >ลบ</button>`;
                }else{
                  moreinfo = `<span class="badge badge-flat border-grey text-grey-600">Leader</span>`;
                }
                
              }
            }
              html1 += `<tr >                                        
                          <td> ${projectmember.user['name']}</td>                            
                          <td> ${projectmember.user['lastname']} </td>     
                          <td style="text-align:center" ${hiddenbtn}>   
                              ${moreinfo}
                          </td>
                      </tr>`
              });
        
          $("#usermember_wrapper_tr").html(html1);
          $("#usermember").html(html);
          $('#modal_edit_projectmember').modal('show');
    }).catch(error => {})
});

function getUsers(id){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/dashboard/admin/project/fulltbp/getusers`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
              id : id
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

$(document).on('click', '#btn_modal_edit_projectmember', function(e) {

  Swal.fire({
    title: 'ยืนยัน',
    text: `ต้องการบันทึก คุณ${$("#usermember option:selected" ).text()} ลงในทีมลงคะแนน`,
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'ตกลง',
    cancelButtonText: 'ยกเลิก',
    closeOnConfirm: false,
    closeOnCancel: false
    }).then((result) => {
    if (result.value) {
      var isleader =$(this).data('isprojectleader');
      addProjectMember($('#fulltbpid').val(),$('#usermember').val()).then(data => {
          var html =``;
          var html1 =``;
          var hiddenbtn = `-`;
          if (isleader == 0) {
            $("#selectothermember").attr("hidden",true);
            // $("#thother").attr("hidden",true);
          }
          // if(typeof(data.iserror) != "undefined"){
          //   Swal.fire({
          //     title: 'ผิดพลาด...',
          //     text: 'ไฟล์ขนาดมากกว่า 5 MB!',
          //     });
          // }
          data.users.forEach(function (user,index) {
              html += `<option value="${user['id']}" >${user['name']}  ${user['lastname']}</option>`
          });
          // data.projectmembers.forEach(function (projectmember,index) {
          //     html1 += `<tr >                                        
          //                 <td> ${projectmember.user['name']}</td>                            
          //                 <td> ${projectmember.user['lastname']} </td>     
          //                 <td>   
          //                     <button type="button" data-id="${projectmember.id}" class="btn btn-sm bg-danger deleteprojectmember">ลบ</button>
          //                 </td>
          //             </tr>`
          //     });

          data.projectmembers.forEach(function (projectmember,index) {
           
            var check = data.scoringstatuses.filter(x => x.user_id == projectmember.user_id)[0]; 

            // console.log(check);
            var moreinfo = ``;
            if(typeof(check) != "undefined"){
              moreinfo = `<span class="badge badge-flat border-success text-success-600">ลงคะแนนแล้ว</span>`;
            }else{
              if (isleader == 0) {
                moreinfo = `<span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้ลงคะแนน</span>`;
              }else{
                moreinfo = `<button type="button" data-id="${projectmember.id}" class="btn btn-sm bg-danger deleteprojectmember" >ลบ</button>`;
              }
            }
              html1 += `<tr >                                        
                          <td> ${projectmember.user['name']}</td>                            
                          <td> ${projectmember.user['lastname']} </td>     
                          <td style="text-align:center" ${hiddenbtn}>   
                              ${moreinfo}
                          </td>
                      </tr>`
              });
              
          $("#projectmember"+$('#fulltbpid').val()).html(data.projectmembers.length + ' คน');
          $("#usermember_wrapper_tr").html(html1);
          $("#usermember").html(html);
          $('#modal_edit_projectmember').modal('show');
    }).catch(error => {})

    }
  });


});

function addProjectMember(fulltbpid,userid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/dashboard/admin/project/fulltbp/addprojectmember`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            fulltbpid : fulltbpid,
            userid : userid,
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

$(document).on('click', '.deleteprojectmember', function(e) {
  var isleader =$(this).data('isprojectleader');
    deleteProjectMember($(this).data('id'),$('#fulltbpid').val()).then(data => {
        var html =``;
        var html1 =``;
        var hiddenbtn = `-`;
        if (isleader == 0) {
          $("#selectothermember").attr("hidden",true);
          // $("#thother").attr("hidden",true);
        }
        data.users.forEach(function (user,index) {
            html += `<option value="${user['id']}" >${user['name']}  ${user['lastname']}</option>`
        });
        // data.projectmembers.forEach(function (projectmember,index) {
        //     html1 += `<tr >                                        
        //                 <td> ${projectmember.user['name']}</td>                            
        //                 <td> ${projectmember.user['lastname']} </td>     
        //                 <td>   
        //                     <button type="button" data-id="${projectmember.id}" class="btn btn-sm bg-danger deleteprojectmember">ลบ</button>
        //                 </td>
        //             </tr>`
        //     });
        data.projectmembers.forEach(function (projectmember,index) {
           
          var check = data.scoringstatuses.filter(x => x.user_id == projectmember.user_id)[0]; 
          var moreinfo = ``;
          if(typeof(check) != "undefined"){
            moreinfo = `<span class="badge badge-flat border-success text-success-600">ลงคะแนนแล้ว</span>`;
          }else{
            if (isleader == 0) {
              moreinfo = `<span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้ลงคะแนน</span>`;
            }else{
              moreinfo = `<button type="button" data-id="${projectmember.id}" class="btn btn-sm bg-danger deleteprojectmember" >ลบ</button>`;
            }
          }
            html1 += `<tr >                                        
                        <td> ${projectmember.user['name']}</td>                            
                        <td> ${projectmember.user['lastname']} </td>     
                        <td style="text-align:center" ${hiddenbtn}>   
                            ${moreinfo}
                        </td>
                    </tr>`
            });
        $("#projectmember"+$('#fulltbpid').val()).html(data.projectmembers.length + ' คน');
        $("#usermember_wrapper_tr").html(html1);
        $("#usermember").html(html);
        $('#modal_edit_projectmember').modal('show');
   }).catch(error => {})
});

function deleteProjectMember(id,fulltbpid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/dashboard/admin/project/fulltbp/deleteprojectmember`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            id : id,
            fulltbpid : fulltbpid
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


$(document).on('click', '.mailtouser', function(e) {
    $('#fulltbpid').val($(this).data('id'));
    $('#modal_mailto_user').modal('show');
});


$(document).on('click', '#btn_modal_mailto_user', function(e) {
  if($('#topic').val() == '' || $('#messagebody').val() == '')return;
    $("#userspinicon").attr("hidden",false);
    SendMailUser($('#fulltbpid').val(),$('#topic').val(),$('#messagebody').val()).then(data => {
        $("#userspinicon").attr("hidden",true);
        $('#modal_mailto_user').modal('hide');
    }).catch(error => {})
});

function SendMailUser(id,topic,body){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/mail/senduser`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id : id,
          topic : topic,
          body : body
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

$(document).on('click', '.mailtomember', function(e) {
  $('#fulltbpid').val($(this).data('id'));
  var html ='';
  Calendar.getParticipate($(this).data('id')).then(data => {
      data.forEach(function (participate,index) {
          html += `<option value="${participate.user['id']}" selected >${participate.user['name']} ${participate.user['lastname']}</option>`
      });
      $("#user").html(html);
      $('#modal_mailto_member').modal('show');
  }).catch(error => {})
});

$(document).on('click', '#btn_modal_mailto_member', function(e) {
  if($('#topicmember').val() == '' || $('#messagebodymember').val() == '')return;
  var selected = document.querySelectorAll('#user option:checked');
  var users = Array.from(selected).map(el => el.value);

  $("#memberspinicon").attr("hidden",false);
  SendMailMember($('#fulltbpid').val(),users,$('#topicmember').val(),$('#messagebodymember').val()).then(data => {
      $("#memberspinicon").attr("hidden",true);
      $('#modal_mailto_member').modal('hide');
  }).catch(error => {})
});

function SendMailMember(id,users,topic,body){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/mail/sendmember`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          id : id,
          users : users,
          topic : topic,
          body : body
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

$(document).on('click', '.finishonsite', function(e) {
  $("#spiniconfinishonsite"+$(this).data('id')).attr("hidden",false);
  FullTbp.finishOnsite($(this).data('id')).then(data => {
    window.location.reload();
}).catch(error => {})
});


$(document).on('click', '.showlog', function(e) {
  var html ='';
  $("#spinicon_showlog"+$(this).data('id')).attr("hidden",false);
  getReviseLog($(this).data('id'),$(this).data('doctype')).then(data => {   
      data.forEach(function (log,index) {
          html += `<tr >                                        
              <td> ${log.message} </td>    
              <td> ${log.user} </td>                                         
              <td style="width:1%;white-space: nowrap"> ${log.createdatth} </td>                                          
              
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
  getApproveLog($(this).data('id')).then(data => {  
    //  console.log(data);
      $("#approvelog_detail").html(data[0].approvelog);
      $("#approvelog_info").html(data[0].approveby);
      $("#approvelog_date").html(data[0].createdatth);
      $("#showapprovelogminitbp").html(data[0].minitbp.project);
      $('#modal_show_approvelog').modal('show');
  }).catch(error => {})

  $('#modal_show_approvelog').modal('show');
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


function getApproveLog(fulltbpid){
  return new Promise((resolve, reject) => {
      $.ajax({
      url: `${route.url}/api/fulltbp/getapprovelog`,
      type: 'POST',
      headers: {"X-CSRF-TOKEN":route.token},
      data: {
        fulltbpid : fulltbpid
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


$(document).on('click', '.reaction', function(e) {
  Swal.fire({
    title: 'ยืนยัน?',
    text: "ต้องการทำรายการลงคะแนน",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'ตกลง',
    cancelButtonText: 'ยกเลิก',
    closeOnConfirm: false,
    closeOnCancel: false
  }).then((result) => {

    if (result.value) {
      $('#btn_modal_select_reactiondate').data('id',$(this).data('id'));
      $('#modal_select_reactiondate').modal('show');
    }
  })
});



$(document).on('click', '#btn_modal_select_reactiondate', function(e) {
  // console.log($(this).data('id'),$('#newdate').val());
  if($('#reactiondate').val() == ''){
      return ;
  }
  $("#spinicon").attr("hidden",false);
  rescoring($(this).data('id'),$('#newdate').val()).then(data => {  
    window.location.reload();
  }).catch(error => {})

  
});


function rescoring(fulltbpid,eventdate){
  return new Promise((resolve, reject) => {
      $.ajax({
      url: `${route.url}/dashboard/admin/assessment/rescoring`,
      type: 'POST',
      headers: {"X-CSRF-TOKEN":route.token},
      data: {
        fulltbpid : fulltbpid,
        eventdate : eventdate
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


