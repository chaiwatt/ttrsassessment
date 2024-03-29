import * as Bol from './bol.js';
var popupmessage = null;
$(document).on('change', '#boldoc', function(e) {
        var file = this.files[0];
        var fextension = file.name.substring(file.name.lastIndexOf('.')+1);
        var validExtensions = ["jpg","pdf","jpeg","gif","png","bmp"];
        if(!validExtensions.includes(fextension)){
            Swal.fire({
                title: 'ผิดพลาด',
                text: 'รูปแบบไฟล์ไม่ถูกต้อง!',
                });
            this.value = "";
            return false;
        }
        if (this.files[0].size/1024/1024*1000 > 5120 ){
            Swal.fire({
                title: 'ผิดพลาด',
                text: 'ไฟล์ขนาดมากกว่า 5 MB!',
                });
            return ;
        }
        if (this.files[0].name.length > 70 ){
            Swal.fire({
                title: 'ผิดพลาด',
                text: 'ชื่อไฟล์ยาวมากกว่า 70 ตัวอักษร',
                });
            return ;
        }
        var formData = new FormData();
        formData.append('file',file);
        formData.append('id',$(this).data('id'));
            $.ajax({
                url: `${route.url}/api/fulltbp/bol/add`,  //Server script to process data
                type: 'POST',
                headers: {"X-CSRF-TOKEN":route.token},
                data: formData,
                contentType: false,
                processData: false,
                success: function(data){
                    var html = ``;
                    data.forEach(function (bol,index) {
                        html += `<tr >                                        
                            <td> ${bol.name} </td>                                            
                            <td style="white-space: nowrap"> 
                                <a href="${route.url}/${bol.path}" class="btn btn-sm bg-primary" target="_blank">ดาวน์โหลด</a>
                                <a data-id="${bol.id}" data-name="" class="btn btn-sm bg-danger deletebol">ลบ</a>                                       
                            </td>
                        </tr>`
                        });
                     $("#fulltbp_bol_wrapper_tr").html(html);
                     $('#docname').val("");
                     $('#modal_add_bol').modal('hide');
                     popupmessage = route.popupmessages.find(x => x.id ==65);
                     Swal.fire({
                         title: popupmessage['title'],
                         text: popupmessage['message'],
                        });
                    return ;
            }
        });
    });

    $(document).on("click",".deletebol",function(e){
        Swal.fire({
            title: 'คำเตือน',
            text: `ต้องการลบรายการ`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ยืนยันลบ',
            cancelButtonText: 'ยกเลิก',
            closeOnConfirm: false,
            closeOnCancel: false
            }).then((result) => {
            if (result.value) {
                Bol.deleteBol($(this).data('id')).then(data => {
                    var html = ``;
                    data.forEach(function (bol,index) {
                        html += `<tr >                                        
                            <td> ${bol.name} </td>                                            
                            <td style="white-space: nowrap"> 
                                <a href="${route.url}/${bol.path}" class="btn btn-sm bg-primary">ดาวน์โหลด</a>
                                <a data-id="${bol.id}" data-name="" class="btn btn-sm bg-danger deletebol">ลบ</a>                                       
                            </td>
                        </tr>`
                        });
                     $("#fulltbp_bol_wrapper_tr").html(html);
               })
               .catch(error => {})
            }
        });
    }); 