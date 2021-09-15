$(document).on('change', '#attachmentdoc', function(e) {
        var file = this.files[0];
        var fextension = file.name.substring(file.name.lastIndexOf('.')+1);
        var validExtensions = ["jpg","pdf","jpeg","gif","png","bmp"];
        if(!validExtensions.includes(fextension)){
            Swal.fire({
                title: 'ผิดพลาด...',
                text: 'รูปแบบไฟล์ไม่ถูกต้อง!',
                });
            this.value = "";
            return false;
        }
        if (this.files[0].size/1024/1024*1000 > 5120 ){
            Swal.fire({
                title: 'ผิดพลาด...',
                text: 'ไฟล์ขนาดมากกว่า 5 MB!',
                });
            return ;
        }
        if (this.files[0].name.length > 70 ){
            Swal.fire({
                title: 'ผิดพลาด...',
                text: 'ชื่อไฟล์ยาวมากกว่า 70 ตัวอักษร',
                });
            return ;
        }
        var formData = new FormData();
        formData.append('file',file);
        formData.append('id',$(this).data('id'));
            $.ajax({
                url: `${route.url}/dashboard/admin/evaluationresult/attachment/add`,  //Server script to process data
                type: 'POST',
                headers: {"X-CSRF-TOKEN":route.token},
                data: formData,
                contentType: false,
                processData: false,
                success: function(data){

                    // var html = ``;
                    // data.forEach(function (projectfinishattachment,index) {
                    //     html += `<tr >                                        
                    //         <td> ${projectfinishattachment.name} </td>                                            
                    //         <td style="white-space: nowrap"> 
                    //             <a href="${route.url}/${projectfinishattachment.path}" class="btn btn-sm bg-primary" target="_blank">ดาวน์โหลด</a>
                    //             <a data-id="${projectfinishattachment.id}" data-name="" class="btn btn-sm bg-danger deleteprojectfinishattachment">ลบ</a>                                       
                    //         </td>
                    //     </tr>`
                    //     });
                    //  $("#attachment_wrapper_tr").html(html);
                    //  $('#docname').val("");
                    //  Swal.fire({
                    //     title: 'สำเร็จ',
                    //     text: 'เพิ่มไฟล์แนบสำเร็จ',
                    //     });
                    // return ;
                    window.location.reload();
            }
        });
    });

    $(document).on("click",".deleteprojectfinishattachment",function(e){
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
                deleteAttachment($(this).data('id')).then(data => {
                  window.location.reload();
                    // var html = ``;
                    // data.forEach(function (projectfinishattachment,index) {
                    //     html += `<tr >                                        
                    //         <td> ${projectfinishattachment.name} </td>                                            
                    //         <td style="white-space: nowrap"> 
                    //             <a href="${route.url}/${projectfinishattachment.path}" class="btn btn-sm bg-primary" target="_blank">ดาวน์โหลด</a>
                    //             <a data-id="${projectfinishattachment.id}" data-name="" class="btn btn-sm bg-danger deleteprojectfinishattachment">ลบ</a>                                       
                    //         </td>
                    //     </tr>`
                    //     });
                    //  $("#attachment_wrapper_tr").html(html);
               })
               .catch(error => {})
            }
        });
    }); 


    function deleteAttachment(id){
        return new Promise((resolve, reject) => {
            $.ajax({
              url: `${route.url}/dashboard/admin/evaluationresult/attachment/delete`,
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


      $(document).on('click', '.showattachment', function(e) {
        showAttachment($(this).data('id')).then(data => {
            window.location.reload();
        })
        .catch(error => {})
    });

    $(document).on('click', '.hideattachment', function(e) {
        hideAttachment($(this).data('id')).then(data => {
            window.location.reload();
        })
        .catch(error => {})
    });

    function showAttachment(id){
        return new Promise((resolve, reject) => {
            $.ajax({
              url: `${route.url}/dashboard/admin/evaluationresult/attachment/show`,
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

      
    function hideAttachment(id){
        return new Promise((resolve, reject) => {
            $.ajax({
              url: `${route.url}/dashboard/admin/evaluationresult/attachment/hide`,
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