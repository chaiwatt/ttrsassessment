        
       import * as Attendee from './eventcalendarattendee.js';
        var globalid = null;
       $(function() {
            var events = [];
            getEvents().then(data => {
                data.forEach(function (event,index) {
                    events.push({
                        id: event["id"],
                        title: event["summary"],
                        start: event["start"],
                        color: event["color"]
                    });
                });
                var calendarBasicViewElement = document.querySelector('.fullcalendar-basic');
                if(calendarBasicViewElement) {
                    var calendarBasicViewInit = new FullCalendar.Calendar(calendarBasicViewElement, {
                        locale: 'th',
                        plugins: ["dayGrid", "timeGrid", "list", "interaction", "googleCalendar"],
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,dayGridWeek,dayGridDay'
                        },
                        buttonText: {
                            today:    'วันนี้',
                            month:    'เดือน',
                            week:     'สัปห์ดา',
                            day:      'วัน',
                            list:     'รายการ'
                        },
                        events: events,
                        editable: true,
                        eventLimit: true,
                        eventClick: function(e) {
                            getEvent(e.event.id).then(data => {
                                // console.log(data.attendeecalendar.id);
                                $('#title').val('นัดหมายการประชุม โครงการ' + data.eventcalendar.fulltbp.minitbp['project']);
                                $('#eventdate').val(data.eventcalendar.eventdateth);
                                $('#starttime').val(data.eventcalendar.starttime);
                                $('#endtime').val(data.eventcalendar.endtime);
                                $('#placeroom').val(data.eventcalendar.place + ' ห้อง' + data.eventcalendar.room);
                                $('#eventtype').val(data.eventcalendar.calendartype['name']);
                                $('#detail').val(data.eventcalendar.summary);
                                // if(data.eventcalendar.eventcalendarattendee['joinevent'] == 1){
                                //     $('#chkjoinmetting').bootstrapSwitch('state', true, false); 
                                // }else{
                                //     $('#chkjoinmetting').bootstrapSwitch('state', false,false); 
                                // }
                                $('#attendeventid').val(data.attendeecalendar.id);
                                var html =``;
                               
                                data.eventcalendarattendeestatuses.forEach(function (status,index) {
                                    var chk = ``;
                                    if(status['id'] == data.attendeecalendar.eventcalendarattendeestatus['id']){
                                        chk = `selected`;
                                    }
                                    html += `<option value="${status['id']}" ${chk} >${status['name']}</option>`
                                });
                                $("#attendevent").html(html);
                                $('#modal_get_calendar').modal('show');

                                var html =``;
                                data.eventcalendarattendees.forEach(function (attendee,index) {
                                    var attendeestatus = `<span class="badge badge-flat border-success text-success-600">${attendee.eventcalendarattendeestatus['name']}</span>`;
                                    if(attendee.joinevent == 2){
                                        attendeestatus = `<span class="badge badge-flat border-warning text-warning-600">${attendee.eventcalendarattendeestatus['name']}</span>`;
                                    }
                                    html += `<tr > 
                                    <td> ${attendee.user['name']} ${attendee.user['lastname']}</td>                                            
                                    <td> ${attendeestatus} </td> 
                                    </tr>`
                                    });
                                $("#attendee_modal_wrapper_tr").html(html);

                            }).catch(error => {})
                        },
                    }).render();
                }
            }).catch(error => {})
        });

    function getEvents() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: `${route.url}/dashboard/admin/report/getevents`,
                type: 'POST',
                headers: {"X-CSRF-TOKEN":route.token},
                success: function(data) {
                resolve(data)
                },
                error: function(error) {
                reject(error)
                },
            })
        })
    }

    function getEvent(id) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: `${route.url}/api/calendar/getevent`,
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

    var  data = [
        {value: 335, name: 'ยานยนต์สมัยใหม่'},
        {value: 310, name: 'อิเล็กทรอนิกส์อัจฉริยะ'},
        {value: 234, name: 'ท่องเที่ยว'},
        {value: 135, name: 'การเกษตรและเทคโนโลยีชีวภาพ'},
        {value: 1548, name: 'แปรรูปอาหาร'},
        {value: 500, name: 'หุ่นยนต์เพื่อการอุตสาหกรรม'}
    ]
    var  legend = [
        'ยานยนต์สมัยใหม่',
        'อิเล็กทรอนิกส์อัจฉริยะ',
        'ท่องเที่ยว',
        'การเกษตรและเทคโนโลยีชีวภาพ',
        'แปรรูปอาหาร',
        'หุ่นยนต์เพื่อการอุตสาหกรรม'
    ]

    var  gradedata = [
        {value: 335, name: 'เกรด A'},
        {value: 310, name: 'เกรด B'},
        {value: 234, name: 'เกรด C'},
        {value: 135, name: 'เกรด D'},
    ]
    var  dradelegend = [
        'เกรด A',
        'เกรด B',
        'เกรด C',
        'เกรด D'
    ]

    var  participatedata = [
        {value: 335, name: 'ยื่นขอ'},
        {value: 310, name: 'Mimi TBP'},
        {value: 234, name: 'Full TBP'},
        {value: 135, name: 'ประเมิน'},
    ]
    var  participatelegend = [
        'ยื่นขอ',
        'Mimi TBP',
        'Full TBP',
        'ประเมิน'
    ]

    var  financialdata = [
        {value: 50, name: 'ด้านการเงิน'},
        {value: 60, name: 'ไม่ใช่การเงิน'}
    ]
    var  financiallegend = [
        'ด้านการเงิน',
        'ไม่ใช่การเงิน'
    ]

    genDonutchart(data,legend,'กลุ่มอุตสาหกรรม','จำนวนโครงการตามกลุ่มอุตสาหกรรม','industrygroup_chart','right');
    genDonutchart(gradedata,dradelegend,'เกรดการประเมิน','จำนวนโครงการตามเกรดการประเมิน','grade_chart','center');
    genDonutchart(participatedata,participatelegend,'โครงการต่อการยื่น','จำนวนโครงการต่อการยื่น','participate_chart','center');
    genDonutchart(financialdata,financiallegend,'วัตถุประสงค์ของการขอรับการประเมิน','วัตถุประสงค์ของการขอรับการประเมิน','financial_chart','center');
    genBarchart();
    function genDonutchart(data,legend,text,sub,eleid,legendalign){
        var dom = document.getElementById(eleid);
        var donutchart = echarts.init(dom);
        var app = {};
        var option = null;
        option = {
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b}: {c} ({d}%)'
            },
            legend: {
                orient: 'vertical',
                left: 10,
                data: legend
            },
            title: {
                text: text,
                subtext: sub,
                left: legendalign,
                textStyle: {
                    fontSize: 17,
                    fontWeight: 500
                },
                subtextStyle: {
                    fontSize: 12
                }
            },
            series: [
                {
                    name: 'รายละเอียด',
                    type: 'pie',
                    radius: ['50%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: '30',
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: data
                }
            ]
        };

        if (option && typeof option === "object") {
            donutchart.setOption(option, true);
        }
    }

    function genBarchart(){
        var dom = document.getElementById("bar_chart");
        var myChart = echarts.init(dom);
        var app = {};
        var option = null;
        option = {
            tooltip: {
                trigger: 'axis',
                axisPointer: {           
                    type: 'shadow'        
                }
            },
            legend: {
                data: [ 'ขอประเมิน', 'Mini TBP', 'Full TBP', 'รับการประเมิน', 'ด้านการเงิน', 'ไม่ใช่ด้านการเงิน', 'เกรด A', 'เกรด B', 'เกรด C', 'เกรด D']
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: [
                {
                    type: 'category',
                    data: ['ปี2561', 'ปี2562', 'ปี2563']
                }
            ],
            yAxis: [
                {
                    type: 'value'
                }
            ],
            series: [
                {
                    name: 'ขอประเมิน',
                    type: 'bar',
                    stack: 'group1',
                    data: [120, 132, 101]
                },
                {
                    name: 'Mini TBP',
                    type: 'bar',
                    stack: 'group1',
                    data: [220, 182, 191]
                },
                {
                    name: 'Full TBP',
                    type: 'bar',
                    stack: 'group1',
                    data: [150, 232, 201]
                },
                {
                    name: 'รับการประเมิน',
                    type: 'bar',
                    stack: 'group1',
                    data: [120, 132, 101]
                },
                {
                    name: 'ด้านการเงิน',
                    type: 'bar',
                    stack: 'group2',
                    data: [60, 72, 71]
                },
                {
                    name: 'ไม่ใช่ด้านการเงิน',
                    type: 'bar',
                    stack: 'group2',
                    data: [55, 55, 91]
                },
                {
                    name: 'เกรด A',
                    type: 'bar',
                    stack: 'group3',
                    data: [120, 132, 101]
                },
                {
                    name: 'เกรด B',
                    type: 'bar',
                    stack: 'group3',
                    data: [220, 182, 191]
                },
                {
                    name: 'เกรด C',
                    type: 'bar',
                    stack: 'group3',
                    data: [220, 182, 191]
                },
                {
                    name: 'เกรด D',
                    type: 'bar',
                    stack: 'group3',
                    data: [200, 150, 200]
                }
            ]
        };
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }
    }

$('#chkjoinmetting').on('change.bootstrapSwitch', function(e) {
    var status = 0
    if(e.target.checked==true){
        status =1;
    }        
   console.log($(this).data('id'));
   globalid = $(this).data('id');
   $("#spinicon").attr("hidden",false);
   Attendee.updateJoinEvent($(this).data('id'),status).then(data => {
       $("#spinicon").attr("hidden",true);
       console.log(data);
      
   }).catch(error => {})
});


$(document).on('change', '#attendevent', function(e) {
    console.log($(this).val());
    var status = 1
    if($(this).val()==2){
        status =0;
    }        
   $("#spinicon").attr("hidden",false);
   Attendee.updateJoinEvent($('#attendeventid').val(),status).then(data => {
       $("#spinicon").attr("hidden",true);
       console.log(data);
      
   }).catch(error => {})
});

$(document).on('click', '#btn_modal_get_calendar', function(e) {
    console.log('dd');
    window.location.replace(`${route.url}/dashboard/admin/report`);
});
