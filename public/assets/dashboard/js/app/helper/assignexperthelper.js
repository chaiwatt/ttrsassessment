$(document).on('change', '#expert', function(e) {
    if($(this).val() == ''){
        $('#assignedproject').html('');
        return;
    }
    getExpert($(this).val()).then(data => {
       var html = 'ยังไม่มีโครงการที่ได้รับมอบหมาย';
       
        if(data.length > 0){
          
            html = `
            <div class="table-responsive">
            <strong>Work Load</strong>
            <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>โครงการ</th>
                    <th>สถานะโครงการ</th>
                    <th>การตอบรับ</th>
                </tr>
            </thead>
            <tbody>`;

            data.forEach(function (expertassignment,index) {
                var status = expertassignment.fulltbp.minitbp.businessplan.businessplanstatus['name'];
                if(expertassignment.fulltbp.minitbp.businessplan.finished == '1'){
                    status = "ปิดโครงการ";
                }
                var acceptstatus = '';
                if(expertassignment.accepted == 0){
                  acceptstatus = `<span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้ตอบรับ</span>`;
                }else if(expertassignment.accepted == 1){
                  acceptstatus = `<span class="badge badge-flat border-success text-success-600">ตอบรับการเข้าร่วมแล้ว</span>`;
                }else if(expertassignment.accepted == 2){
                  acceptstatus = `<span class="badge badge-flat border-danger text-danger-600">ปฎิเสธการเข้าร่วม</span>`;
                }
                
                html += `<tr >                                        
                    <td> ${expertassignment.fulltbp.minitbp['project']} </td>                                            
                    <td><span class="badge badge-flat border-info text-info-600">${status}</span></td> 
                    <td> ${acceptstatus}</td>
                </tr>`
            });
            html +=`</tbody></table></div>`;
        }
        $('#assignedproject').html(html);
    }).catch(error => {})
});

function getExpert(id){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/dashboard/admin/project/fulltbp/getexpert`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            'id': id
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

  $(document).on('change', '.assignexpert', function(e) {
    var status = 1;
    if($(this).is(":checked")){
        status = 2;
    }

    $("#spiniconcheck"+$(this).data('id')).attr("hidden",false);
    assignExpert($(this).data('id'),status,route.fulltbpid).then(data => {
      $("#spiniconcheck"+$(this).data('id')).attr("hidden",true);  
      var html = ``;
        data.forEach(function (expert,index) {
            var onlymaster = ``;
            var checkstatus = ``;
            if(expert.expert_assignment_status_id == 2){
                checkstatus =  `checked`;
            }
            if(route.usertypeid == 6){
                onlymaster = `<td> <i class="icon-spinner spinner mr-2" id="spiniconcheck${expert.id}" hidden></i><input type="checkbox" data-id="${expert.id}" class="form-check assignexpert" ${checkstatus}></td> `;
            }
            var comment = '';
            if(expert.expertcomment != null){
              comment = `<button type="button" data-id="${expert.id}" class="btn btn-sm bg-info expertcomment">ความเห็น</button>`;
            }
            var acceptstatus = '';
            if(expert.accepted == 0){
              acceptstatus = `<span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้ตอบรับ</span>`;
            }else if(expert.accepted == 1){
              acceptstatus = `<span class="badge badge-flat border-success text-success-600">ตอบรับการเข้าร่วมแล้ว</span>`;
            }else if(expert.accepted == 2){
              acceptstatus = `<span class="badge badge-flat border-danger text-danger-600">ปฎิเสธการเข้าร่วม</span>`;
            }
            html += `<tr >                                        
                <td class='userid' data-id='${expert.user['id']}'> ${expert.user['name']} ${expert.user['lastname']}</td>   
                ${onlymaster}      
                <td> ${expert.expertassignmentstatus['name']}</td>  
                <td> ${acceptstatus}</td>    
                <td> ${comment}</td>                                 
                <td> 
                    <button type="button" data-id="${expert.id}" class="btn badge bg-danger deleteexpert">ลบ</button>                                       
                </td>
            </tr>`
            });
        $("#expert_wrapper").html(html);
        if(data.length == $('.assignexpert').filter(':checked').length){
            doneAssignement(route.fulltbpid).then(data => {
            }).catch(error => {})
        }
     }).catch(error => {})
});

function doneAssignement(fulltbpid){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/dashboard/admin/project/fulltbp/doneassignement`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'fulltbpid': fulltbpid
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


$(document).on('change', '.expert', function(e) {
  var message = "ต้องการลบการเลือกผู้เชี่ยวชาญ";
  var status = 1;
  if($(this).is(":checked")){
      status = 2;
      message = "ต้องการเพิ่มผู้เชี่ยวชาญ";
  }

  Swal.fire({
    title: 'การมอบหมาย',
    html: message,
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'ตกลง',
    cancelButtonText: 'ยกเลิก',
  }).then((result) => {
    if (result.value) {
      $("#spiniconcheck"+$(this).data('id')).attr("hidden",false);
      assignExpert($(this).data('id'),status,route.fulltbpid).then(data => {
        window.location.reload();
       }).catch(error => {})
    }else{
      
      location.reload()
    }
  });



});

function assignExpert(id,status,fulltbpid){
  return new Promise((resolve, reject) => {
      $.ajax({
        url: `${route.url}/api/expert/assignexpert`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
          'id': id,
          'status': status,
          'fulltbpid': fulltbpid
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

$(document).on('click', '.assingexpert', function(e) {
  Swal.fire({
    title: 'ยืนยัน',
    text: `ต้องการมอบหมายผู้เชี่ยวชาญ `,
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'ตกลง',
    cancelButtonText: 'ยกเลิก',
    closeOnConfirm: false,
    closeOnCancel: false
    }).then((result) => {
    if (result.value) {
        $("#btnassign"+$(this).data('id')).attr("hidden",false);
        JdassignExpert($(this).data('id'),route.fulltbpid).then(data => {
          window.location.reload();
         }).catch(error => {})
    }
});
});

function JdassignExpert(id,fulltbpid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/expert/jdassignexpert`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            'id': id,
            'fulltbpid': fulltbpid
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

  function assignExpertSave(id,fulltbpid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/dashboard/admin/project/fulltbp/assignexpertsave`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            'id': id,
            'fulltbpid': fulltbpid
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

$(document).on('click', '#btn_modal_add_expert', function(e) {
    $("#spiniconcheck"+$(this).data('id')).attr("hidden",false);
    assignExpertSave($('#expert').val(),route.fulltbpid).then(data => {
      $("#spiniconcheck"+$(this).data('id')).attr("hidden",true);
        var html = ``;
        data.forEach(function (expert,index) {
            var onlymaster = ``;
            var checkstatus = ``;
            if(expert.expert_assignment_status_id == 2){
                checkstatus =  `checked`;
            }
            var comment = '';
            if(expert.expertcomment != null){
              comment = `<button type="button" data-id="${expert.id}" class="btn btn-sm bg-info expertcomment">ความเห็น</button>`;
            }
            var acceptstatus = '';
            if(expert.accepted == 0){
              acceptstatus = `<span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้ตอบรับ</span>`;
            }else if(expert.accepted == 1){
              acceptstatus = `<span class="badge badge-flat border-success text-success-600">ตอบรับการเข้าร่วมแล้ว</span>`;
            }else if(expert.accepted == 2){
              acceptstatus = `<span class="badge badge-flat border-danger text-danger-600">ปฎิเสธการเข้าร่วม</span>`;
            }
            if(route.usertypeid == 6){
                onlymaster = `<td> <i class="icon-spinner spinner mr-2" id="spiniconcheck${expert.id}" hidden></i><input type="checkbox" data-id="${expert.id}" class="form-check assignexpert" ${checkstatus}></td> `;
            }
            html += `<tr >                                        
                <td class='userid' data-id='${expert.user['id']}'> ${expert.user['name']} ${expert.user['lastname']}</td> 
                ${onlymaster}     
                <td> ${expert.expertassignmentstatus['name']}</td>                                        
                <td> ${acceptstatus}</td>  
                <td> ${comment} </td>
                <td> 
                    <button type="button" data-id="${expert.id}" class="btn btn-sm bg-danger deleteexpert">ลบ</button>                                       
                </td>
            </tr>`
            });
        $("#expert_wrapper").html(html);
     }).catch(error => {})
});

$(document).on("click",".deleteexpert",function(e){
    Swal.fire({
        title: 'คำเตือน!',
        text: `ต้องการลบรายการ `,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            $("#spiniconcheck"+$(this).data('id')).attr("hidden",false);
            deleteExpert($(this).data('id'),route.fulltbpid).then(data => {
              $("#spiniconcheck"+$(this).data('id')).attr("hidden",true);
                var html = ``;
                data.forEach(function (expert,index) {
                    var onlymaster = ``;
                    var checkstatus = ``;
                    if(expert.expert_assignment_status_id == 2){
                        checkstatus =  `checked`;
                    }
                    var comment = '';
                    if(expert.expertcomment != null){
                      comment = `<button type="button" data-id="${expert.id}" class="btn btn-sm bg-info expertcomment">ความเห็น</button>`;
                    }
                    var acceptstatus = '';
                    if(expert.accepted == 0){
                      acceptstatus = `<span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้ตอบรับ</span>`;
                    }else if(expert.accepted == 1){
                      acceptstatus = `<span class="badge badge-flat border-success text-success-600">ตอบรับการเข้าร่วมแล้ว</span>`;
                    }else if(expert.accepted == 2){
                      acceptstatus = `<span class="badge badge-flat border-danger text-danger-600">ปฎิเสธการเข้าร่วม</span>`;
                    }

                    if(route.usertypeid == 6){
                        onlymaster = `<td> <i class="icon-spinner spinner mr-2" id="spiniconcheck${expert.id}" hidden></i><input type="checkbox" data-id="${expert.id}" class="form-check assignexpert" ${checkstatus}></td> `;
                    }
                    html += `<tr >                                        
                        <td class='userid' data-id='${expert.user['id']}'> ${expert.user['name']} ${expert.user['lastname']}</td>   
                        ${onlymaster}      
                        <td> ${expert.expertassignmentstatus['name']}</td>   
                        <td> ${acceptstatus} </td>
                        <td> ${comment} </td>
                        <td> 
                            <button type="button" data-id="${expert.id}" class="btn btn-sm bg-danger deleteexpert">ลบ</button>                                       
                        </td>
                    </tr>`
                    });
                $("#expert_wrapper").html(html);
             }).catch(error => {})
        }
    });
});

function deleteExpert(id,fulltbpid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/dashboard/admin/project/fulltbp/assignexpertdelete`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            'id': id,
            'fulltbpid': fulltbpid
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

$(document).on('click', '#sendtojd', function(e) {
    var arr = [];
    $('.userid').each(function() {
        arr.push($(this).data('id'));
    });
    $("#spinicon").attr("hidden",false);
    notifyJD(arr,route.fulltbpid).then(data => {
      $("#spinicon").attr("hidden",true);
        var html = ``;
          Swal.fire({
            title: 'สำเร็จ',
            text: 'ส่งผู้เชี่ยวชาญให้ Manager พิจารณาสำเร็จ',
        }).then((result) => {
            window.location.reload();
        });
     }).catch(error => {})
});

function notifyJD(users,fulltbpid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/dashboard/admin/project/fulltbp/notifyjd`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            'users': users,
            'fulltbpid': fulltbpid
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

  $(document).on('click', '.expertcomment', function(e) {
      expertComment($(this).data('id')).then(data => {
          var html = ``;
          $('#overview').val(data.overview);
          $('#management').val(data.management);
          $('#technology').val(data.technology);
          $('#marketing').val(data.marketing);
          $('#businessprospect').val(data.businessprospect);
          $('#modal_expert_comment').modal('show');
      }).catch(error => {})
  });

  function expertComment(id){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/dashboard/admin/project/fulltbp/expertcomment`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            'id': id
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

  
  $(document).on('click', '.expertworkload', function(e) {
    getExpert($(this).data('id')).then(data => {
       var html = 'ยังไม่มีโครงการที่ได้รับมอบหมาย';
       
        if(data.length > 0){
          
            html = `
            <div class="table-responsive">
            <strong>Work Load</strong>
            <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>โครงการ</th>
                    <th>สถานะโครงการ</th>
                    <th>การตอบรับ</th>
                </tr>
            </thead>
            <tbody>`;

            data.forEach(function (expertassignment,index) {
                var status = expertassignment.fulltbp.minitbp.businessplan.businessplanstatus['name'];
                if(expertassignment.fulltbp.minitbp.businessplan.finished == '1'){
                    status = "ปิดโครงการ";
                }
                var acceptstatus = '';
                if(expertassignment.accepted == 0){
                  acceptstatus = `<span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้ตอบรับ</span>`;
                }else if(expertassignment.accepted == 1){
                  acceptstatus = `<span class="badge badge-flat border-success text-success-600">ตอบรับการเข้าร่วมแล้ว</span>`;
                }else if(expertassignment.accepted == 2){
                  acceptstatus = `<span class="badge badge-flat border-danger text-danger-600">ปฎิเสธการเข้าร่วม</span>`;
                }
                
                html += `<tr >                                        
                    <td> ${expertassignment.fulltbp.minitbp['project']} </td>                                            
                    <td><span class="badge badge-flat border-info text-info-600">${status}</span></td> 
                    <td> ${acceptstatus}</td>
                </tr>`
            });
            html +=`</tbody></table></div>`;
        }
        $('#expert_workload_wrapper').html(html);
        $('#modal_expert_workload').modal('show');
    }).catch(error => {})
  });