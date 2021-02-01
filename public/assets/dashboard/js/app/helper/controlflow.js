$(document).on('click', '.controlflowicon', function(e) { 
    showControlFlow($(this).data('id')).then(data => {
        var markeddate ;
        var html = '';
        var actionby;
        data.projectstatuses.forEach(function (projectstatus,index) {
            markeddate = '';
            actionby = ''
            var transaction = data.projectstatustransactions.filter(x => x.project_flow_id == (index+1))[0]; 
            var enddate = new Date(projectstatus.enddate);
            var overdue = '';

            var updatedat = new Date();
            var icon = ``;

            var startdate = new Date(projectstatus.startdate),
            month_start = '' + (startdate.getMonth() + 1),
            day_start = '' + startdate.getDate(),
            year_start = startdate.getFullYear();
           
            var _enddate = new Date(projectstatus.enddate),
            month_end= '' + (_enddate.getMonth() + 1),
            day_end = '' + _enddate.getDate(),
            year_end = _enddate.getFullYear();

            $details = projectstatus.projectflow;
            if(typeof(transaction) != "undefined"){
                var d = new Date(transaction.updated_at),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();
                var tmp = year+'-'+month+'-'+day;
                var updatedat = new Date(tmp);
                var diffintime = enddate.getTime() - updatedat.getTime(); 
                var diffinday = Math.floor((diffintime / (1000 * 3600 * 24))); 
                if(transaction.status == 1){
                    if(projectstatus.project_flow_id == 3){
                        // การอนุมัติ Full TBP, การมอบหมายผู้เชี่ยวชาญ, การพัฒนา EV
                        console.log(projectstatus.controlflowstage3approve[2]);
                        var fulltbpicon = `<i class="icon-watch2 text-pink-300"></i>`;
                        var experticon = `<i class="icon-watch2 text-pink-300"></i>`;
                        var evicon = `<i class="icon-watch2 text-pink-300"></i>`;
                        if(projectstatus.controlflowstage3approve[0] >= 6){
                            fulltbpicon = `<i class="icon-checkmark2 text-success"></i>`;
                        }
                        if(projectstatus.controlflowstage3approve[1] == 2){
                            experticon = `<i class="icon-checkmark2 text-success"></i>`;
                        }
                        if(projectstatus.controlflowstage3approve[2] >= 2){
                            evicon = `<i class="icon-checkmark2 text-success"></i>`;
                        }
                        $details = `${fulltbpicon}การอนุมัติ Full TBP, ` + `${experticon}การมอบหมายผู้เชี่ยวชาญ, ` + `${evicon}การพัฒนา EV`;
                    }
                    markeddate = 'กำหนด ' + day_start +'/' + month_start + '/' + (year_start+543) + ' - ' + day_end +'/' + month_end + '/' + (year_end+543)
                    icon = `class="btn bg-transparent border-pink-300 text-pink-300 rounded-round border-2 btn-icon"><i class="icon-watch2"></i>`;
                }else if(transaction.status == 2){   
                    markeddate = 'เสร็จสิ้น ' + day + '/' + month + '/' + (year+543)                 
                    if(diffinday >= 0){
                        icon = `class="btn bg-transparent border-success text-success rounded-round border-2 btn-icon"><i class="icon-checkmark3"></i>`;
                    }else{
                        overdue = `<span class="text-danger">เกินกำหนด ${diffinday*-1} วัน</span>`;
                        icon = `class="btn bg-transparent border-success text-danger rounded-round border-2 btn-icon"><i class="icon-cross2"></i>`;
                    }        
                }
            }else{
                markeddate = 'กำหนด ' + day_start +'/' + month_start + '/' + (year_start+543) + ' - ' + day_end +'/' + month_end + '/' + (year_end+543)
                icon = `class="btn bg-transparent border-grey-300 text-grey-300 rounded-round border-2 btn-icon"><i class="icon-watch2"></i>`;
            }

            html += `<li class="media">
                        <div class="mr-3">
                            <a href="#" ${icon}</a>
                        </div>
                        <div class="media-body">
                            ${$details} ${overdue}
                            <div class="text-muted">${markeddate} ${actionby}</div>
                        </div>
                    </li>`
        });

        $('#flowlist_wrapper').html(html);
        $('#modal_show_controlflow').modal('show');
    }).catch(error => {})
});

function showControlFlow(minitbpid){
return new Promise((resolve, reject) => {
    $.ajax({
    url: `${route.url}/api/controlflow/get`,
    type: 'POST',
    headers: {"X-CSRF-TOKEN":route.token},
    data: {
        minitbpid : minitbpid
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