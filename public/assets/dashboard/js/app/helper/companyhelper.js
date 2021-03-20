import * as Assessment from './assessment.js'
import * as Company from './company.js'
import * as Project from './project.js';

 $('#chkassessment').on('change.bootstrapSwitch', function(e) {
     var status = 0
     if(e.target.checked==true){
         status =1;
     }        
    console.log($(this).data('id'));
    $("#spinicon").attr("hidden",false);
        Assessment.addAssessment($(this).data('id'),status).then(data => {
        $("#spinicon").attr("hidden",true);
    }).catch(error => {})
});

$(document).on('change', '#isic', function(e) {
    Company.getSubIsic($(this).val()).then(data => {
        var html = ``;
        var companysubisic= data.company.isic_sub_id;
        data.subisics.forEach(function (subisic,index) {
            var select ='';
            if(data.company.isic_sub_id == subisic['id']){
                select = 'selected'
            }
            html +=`<option value="${subisic['id']}" ${select}>${subisic['name']}</option>`
            });
         $("#subisic").html(html);
    })
    .catch(error => {})
});

$("#companydoc").on('change', function() {
    if($('#companydocname').val() == '')return ;
    var file = this.files[0];
    // console.log(file);
    if (this.files[0].size/1024/1024*1000 > 2000 ){
        alert('ไฟล์ขนาดมากกว่า 2 MB');
        return ;
    }
    var formData = new FormData();
    formData.append('file',file);
    formData.append('id',$(this).data('id'));
    formData.append('companydocname',$('#companydocname').val());
        $.ajax({
            url: `${route.url}/api/fulltbp/companydoc/add`,  //Server script to process data
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                console.log(data)
                var html = ``;
                data.forEach(function (attachment,index) {
                    html += `<tr >                                        
                        <td> ${attachment.name} </td>                                            
                        <td> 
                            <a href="${route.url}/${attachment.path}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpcompanydocattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_companydoc_wrapper_tr").html(html);
                 $('#modal_add_companydoc').modal('hide');
        }
    });
});

$(document).on("click",".deletefulltbpcompanydocattachment",function(e){
    Swal.fire({
        title: 'คำเตือน!',
        text: `ต้องการลบรายการ หรือไม่`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            Project.deleteCompanydoc($(this).data('id')).then(data => {
                var html = ``;
                data.forEach(function (attachment,index) {
                    html += `<tr >                                        
                        <td> ${attachment.name} </td>                                            
                        <td> 
                            <a href="${route.url}/${attachment.path}" class="btn btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpcompanydocattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_companydoc_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
});

$(document).on('click', '#btn_modal_add_authorized_director', function(e) {
    addAuthorizedDirector($(this).data('id'),$('#directorprefix').val(),$('#directorname').val(),$('#directorlastname').val()).then(data => {
        var html = ``;
        console.log(data);
        data.forEach(function (authorizeddirector,index) {
            html += `<tr >                                        
                <td> ${authorizeddirector.prefix['name']}${authorizeddirector.name}  ${authorizeddirector.lastname} </td>                                            
                <td><a type="button" data-id="${authorizeddirector.id}" class="btn btn-sm bg-danger deleteauthorizeddirector">ลบ</a>  </td> 
            </tr>`
            });
         $('#authorizeddirector').val(data.length);
         $("#authorized_director_wrapper_tr").html(html);
    })
    .catch(error => {})
});

function addAuthorizedDirector(id,prefix,name,lastname) {
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/company/addauthorizeddirector`,
          type: 'POST',
          dataType: "json",
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            id : id,
            prefix : prefix,
            name : name,
            lastname : lastname,
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
  $(document).on('click', '.deleteauthorizeddirector', function(e) {
    Swal.fire({
        title: 'คำเตือน!',
        text: `ต้องการลบรายการ หรือไม่`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            deleteAuthorizedDirector($(this).data('id')).then(data => {
                var html = ``;
                
                data.forEach(function (authorizeddirector,index) {
                    html += `<tr >                                        
                        <td> ${authorizeddirector.prefix['name']}${authorizeddirector.name}  ${authorizeddirector.lastname} </td>                                            
                        <td><a type="button" data-id="${authorizeddirector.id}" class="btn btn-sm bg-danger deleteauthorizeddirector">ลบ</a>  </td> 
                    </tr>`
                    });
                 $('#authorizeddirector').val(data.length);
                 $("#authorized_director_wrapper_tr").html(html);
            })
            .catch(error => {})        
        }
    });


});
  function deleteAuthorizedDirector(id) {
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/company/deleteauthorizeddirector`,
          type: 'POST',
          dataType: "json",
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
 
 