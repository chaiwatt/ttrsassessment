
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
    Calendar.getParticipate(id).then(data => {
        if(data.flownothree == 2){
            data.projectmembers.forEach(function (participate,index) {
                html += `<option value="${participate.user['id']}" selected >${participate.user['name']} ${participate.user['lastname']}</option>`
            });

            data.calendartypes.forEach(function (calendartype,index) {
                html0 += `<option value="${calendartype['id']}" >${calendartype['name']}</option>`
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
            
            $("#toast").attr("hidden",false);

            $("#project_wrapper").attr("hidden",false);
            
        }else if(data.flownothree == 1){
            $("#project_wrapper").attr("hidden",false);
            $("#project_wrapper").html(`<span class="text-danger">โครงการนี้ยังไม่สามารถสร้างปฏิทินกิจกรรมได้ โปรดตรวจสอบ Full TBP , การมอบหมายผู้เชี่ยวชาญ และ EV ได้รับการอนุมัติทั้งหมดแล้ว</span>`);
        }

    }).catch(error => {})
}