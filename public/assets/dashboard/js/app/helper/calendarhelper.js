
import * as Calendar from './calendar.js';

$(function() {
    // Participate($('#fulltbp').val());
});

$(document).on('change', '#fulltbp', function(e) {
    if($(this).val() == 0){
        $("#project_wrapper").attr("hidden",true);
        return;
    }
    Participate($(this).val());
});

function Participate(id){
    var html ='';
    var html0 ='';
    var html1 ='';
    Calendar.getParticipate(id).then(data => {
        
        if(data.flownothree == 2){
            data.projectmembers.forEach(function (participate,index) {
                html += `<option value="${participate.user['id']}" selected >${participate.user['name']} ${participate.user['lastname']}</option>`
            });

            data.calendartypes.forEach(function (calendartype,index) {
                var select = "";
                if($('#oldcalendartype').val() != ""){
                    if(calendartype['id'] == $('#oldcalendartype').val()){
                        select = "selected";
                    }
                }
                html0 += `<option value="${calendartype['id']}" ${select}>${calendartype['name']}</option>`
            });

            data.calendarattachments.forEach(function (attachment,index) {
                html1 += `<tr >                                        
                    <td> ${attachment.name} </td>                                            
                    <td style="white-space: nowrap"> 
                        <a href="${route.url}/${attachment.path}" class="btn btn-sm bg-primary" target="_blank">ดาวน์โหลด</a>
                        <a  data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deleteattachment">ลบ</a>                                       
                    </td>
                </tr>`
            });
       
            var orgdate = data.projectstatus.startdate.split('-');
            var yearth = parseInt(orgdate[0])+543;
            var thaidate = orgdate[2] +'/'+ orgdate[1] +'/'+ yearth
            if(data.projectstatus.project_flow_id == 4){
                $("#toastmessage").html(`โครงการ${$("#fulltbp option:selected").text()} มีกำหนดเสร็จสิ้น <span class="badge bg-success" style="font-size:16px">การประเมิน ณ สถานประกอบการ</span> ในวันที่ ${thaidate} (จำนวน ${data.projectstatus.duration} วัน ตาม Control Flow) กรุณากำหนดปฏิทินให้อยู่ภายใน Control Flow`);
            }else if(data.projectstatus.project_flow_id == 5){
                $("#toastmessage").html(`โครงการ${$("#fulltbp option:selected").text()} มีกำหนดเสร็จสิ้น <span class="badge bg-success" style="font-size:16px">การลงคะแนนสรุปเกรด</span> ในวันที่ ${thaidate} (จำนวน ${data.projectstatus.duration} วัน ตาม Control Flow) กรุณากำหนดปฏิทินให้อยู่ภายใน Control Flow`);
            }

            $("#calendartype").html(html0);
            $("#user").html(html);
            // console.log(data.calendarattachments.length);
            if (data.calendarattachments.length == 0) {
                $("#attachmenttable_wrapper").attr("hidden",true);
            }else{
                $("#attachmenttable_wrapper_tr").html(html1);
                $("#attachmenttable_wrapper").attr("hidden",false);
            }
            
            $("#project_wrapper_not_finish").attr("hidden",true);
            $("#toast").attr("hidden",false);
            $("#project_wrapper").attr("hidden",false);
            
        }else if(data.flownothree == 1){
            $("#project_wrapper").attr("hidden",true);
            $("#project_wrapper_not_finish").attr("hidden",false);
            $("#project_wrapper_not_finish").html(`<span class="text-danger">โครงการนี้ยังไม่สามารถสร้างปฏิทินกิจกรรมได้ โปรดตรวจสอบ Full TBP , การมอบหมายผู้เชี่ยวชาญ และ EV ได้รับการอนุมัติทั้งหมดแล้ว</span>`);
        }
        
        $("#eventcalendarid").val(data.eventcalendarid);
        // console.log(data);
    }).catch(error => {})
}

$(document).on('change', '#calendarattachment', function(e) {
    
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
    if (this.files[0].size/1024/1024*1000 > 2048 ){
            Swal.fire({
            title: 'ผิดพลาด',
            text: 'ไฟล์ขนาดมากกว่า 2 MB',
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
    formData.append('eventcalendarid',$('#eventcalendarid').val());
        $.ajax({
            url: `${route.url}/api/calendar/addattachment`,  //Server script to process data
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                var html = ``;
                data.forEach(function (attachment,index) {
                    html += `<tr >                                        
                        <td> ${attachment.name} </td>                                            
                        <td style="white-space: nowrap"> 
                            <a href="${route.url}/${attachment.path}" class="btn btn-sm bg-primary" target="_blank">ดาวน์โหลด</a>
                            <a  data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deleteattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });

                    // console.log(data.length);
                    if(data.lenght == 0){
                        $("#attachmenttable_wrapper").attr("hidden",true);
                      }  else{
                        $("#attachmenttable_wrapper").attr("hidden",false);
                      }
                 $("#attachmenttable_wrapper_tr").html(html);
                //  $("#calendarattachment").val(null);
                // e.target.value = '';
        }
    });
});

$(document).on("click",".deleteattachment",function(e){
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
            DeleteAttachment($(this).data('id')).then(data => {
                var html = ``;
                data.forEach(function (attachment,index) {
                    html += `<tr >                                        
                        <td> ${attachment.name} </td>                                            
                        <td style="white-space: nowrap"> 
                            <a href="${route.url}/${attachment.path}" class="btn btn-sm bg-primary" target="_blank">ดาวน์โหลด</a>
                            <a  data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deleteattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                    if(data.length == 0){
                        $("#attachmenttable_wrapper").attr("hidden",true);
                      }  else{
                        $("#attachmenttable_wrapper").attr("hidden",false);
                      }
                 $("#attachmenttable_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
}); 

function DeleteAttachment(id){
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `${route.url}/api/calendar/deleteattachment`,
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