        

import * as Attendee from './eventcalendarattendee.js';
       var  participatedata = null;
       var  gradedata = null;
       var  industrygroupdata = null;
       var  objectivedata = null;
       var globaldata = null;
       
       var  participatelegend = [
            'Mimi TBP',
            'Full TBP',
            'ประเมินสำเร็จ'
        ]
        var  dradelegend = [
            'AAA',
            'AA',
            'A',
            'BBB',
            'BB',
            'B',
            'CCC',
            'CC',
            'C',
            'D'
        ]

        var  industrygrouplegend = [
            'Next-generation Automotive',
            'Smart Electronics',
            'Affluent, Medical and Wellness Tourism',
            'Agriculture and Biotechnology',
            'Food for the Future',
            'Robotics',
            'Aviation and Logistics',
            'Biofuels and Biochemicals',
            'Digital',
            'Medical Hub',
            'Defense',
            'Education and Skill Development',
            'อื่นๆ'
        ]

        var  objectivelegend = [
            'ด้านการเงิน',
            'ไม่ใช่ด้านการเงิน',
            'ด้านการเงินและไม่ใช่ด้านการเงิน'
        ]
        var datagradebysector = ['เกรด AAA', 'เกรด AA','เกรด A', 'เกรด BBB','เกรด BB', 'เกรด B','เกรด CCC', 'เกรด CC','เกรด C', 'เกรด D']
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
                            week:     'สัปดาห์',
                            day:      'วัน',
                            list:     'รายการ'
                        },
                        events: events,
                        editable: false,
                        eventLimit: true,
                        droppable: false,
                        disableDragging: false,
                        eventRender: function(info) {

                            if(!info.event.startEditable) {
                                $(info.el).css('cursor','pointer');
                                return;
                            }
                       
                        },
                        eventClick: function(e) {
                            getEvent(e.event.id).then(data => {
                                $('#title').val('นัดหมายการประชุม โครงการ' + data.eventcalendar.fulltbp.minitbp['project']);
                                $('#eventdate').html(data.eventcalendar.eventdateth + ' เวลา ' + data.eventcalendar.starttime + ' น. - ' + data.eventcalendar.endtime + ' น.');
                                $('#place').html(data.eventcalendar.place);
                                $('#eventtype').html(data.eventcalendar.calendartype['name'] + 'โครงการ' + data.eventcalendar.fulltbp.minitbp['project'] + ' ' +  data.fullcompanyname);
                                $('#subject').html(data.eventcalendar.subject);
                                $('#detail').html(data.eventcalendar.summary);
                                $('#attendeventid').val(data.attendeecalendar.id);

                                var html =``;
                               
                                data.eventcalendarattendeestatuses.forEach(function (status,index) {
                                    var chk = ``;
                                    $('#jointype').val(data.attendeecalendar.eventcalendarattendeestatus['id']);
                                    if(status['id'] == data.attendeecalendar.eventcalendarattendeestatus['id']){
                                        chk = `checked`;
                                    }
                                    html += `
                                    <input style="vertical-align:middle !important;" type="radio" name="flexRadioDefault" class="confirm" value="${status['id']}" id="chk" ${chk}><label for="chk" style="margin-left:5px;margin-right:10px">${status['name']}</label>
                                  `
                                  
                                });

                                $("#attendevent").html(html);
                                $('#modal_get_calendar').modal('show');

                                var html =``;
                                data.eventcalendarattendees.forEach(function (attendee,index) {
                                    var rejreason = "";
                                    if(attendee['rejectreason'] != null){
                                        rejreason = ' ('+attendee['rejectreason']+')';
                                    }

                                    var attendeestatus = `<span class="badge badge-flat border-info text-info-600">${attendee.eventcalendarattendeestatus['name']}</span>`;
                                    if(attendee.joinevent == 2){
                                        attendeestatus = `<span class="badge badge-flat border-success text-success-600">${attendee.eventcalendarattendeestatus['name']}</span>`;
                                    }else if(attendee.joinevent == 3){
                                        attendeestatus = `<span class="badge badge-flat border-danger text-danger-600">${attendee.eventcalendarattendeestatus['name']}</span> ${rejreason}`;
                                    }
                                    html += `<tr > 
                                    <td > ${attendee.user['name']} ${attendee.user['lastname']}</td>                                            
                                    <td style="width:1%;white-space: nowrap"> ${attendeestatus} </td> 
                                    </tr>`
                                });

                                $("#attendee_modal_wrapper_tr").html(html);
                                var html =`<ul>`;
                                data.calendarattachments.forEach(function (attachment,index) {
                                    html += `<li><a href="${route.url}/${attachment.path}" target="_blank">${attachment.name}</a></li>`
                                });
                                html +=`</ul>`;
                                
                                $("#attachment_wrapper").html(html);
                            }).catch(error => {})
                        },
                    }).render();
                }
            }).catch(error => {})

            getRadarChartData().then(data => {
                globaldata = data;
                callUpdateChart(globaldata);
                callGenRadarGradeByPillar(globaldata);
                callGenRadarByBusinessSize(globaldata);
                callGenRadarBySector(globaldata);
                callGenRadarByBusinessType(globaldata);
                callGenRadarByIndustryGroup(globaldata);
                callGenRadarByIsic(globaldata);
               
            }).catch(error => {})

            // getChartData().then(data => {
            //      participatedata = [
            //         {value: data.numprojects['minitbp'], name: 'Mimi TBP'},
            //         {value: data.numprojects['fulltbp'], name: 'Full TBP'},
            //         {value: data.numprojects['finish'], name: 'ประเมินสำเร็จ'},
            //     ]
            //     if(data.numprojects['minitbp'] != 0 || data.numprojects['fulltbp'] != 0 || data.numprojects['finish'] != 0){
            //         genDonutchart(participatedata,participatelegend,'จำนวนโครงการปี ' + $('#currentyear').html(),'จำนวนโครงการปี ' + $('#currentyear').html(),'participate_chart','center');
            //     }
    
            //       gradedata = [
            //         {value: data.projectgrades['AAA'], name: 'AAA'},
            //         {value: data.projectgrades['AA'], name: 'AA'},
            //         {value: data.projectgrades['A'], name: 'A'},
            //         {value: data.projectgrades['BBB'], name: 'BBB'},
            //         {value: data.projectgrades['BB'], name: 'BB'},
            //         {value: data.projectgrades['B'], name: 'B'},
            //         {value: data.projectgrades['CCC'], name: 'CCC'},
            //         {value: data.projectgrades['CC'], name: 'CC'},
            //         {value: data.projectgrades['C'], name: 'C'},
            //         {value: data.projectgrades['D'], name: 'D'}
            //     ]

            //     if(data.projectgrades['AAA'] !=0 || data.projectgrades['AA'] !=0 ||data.projectgrades['A'] !=0 ||data.projectgrades['BBB'] !=0 ||data.projectgrades['BB'] !=0 ||
            //     data.projectgrades['B'] !=0 || data.projectgrades['CCC'] !=0 ||data.projectgrades['CC'] !=0 || data.projectgrades['C'] !=0 || data.projectgrades['D'] !=0){
            //         genDonutchart(gradedata,dradelegend,'เกรดการประเมิน','จำนวนโครงการตามเกรดการประเมิน','grade_chart','center');
            //     }        

            //     industrygroupdata = [
            //         {value: data.projectindustries['automotive'], name: 'Next-generation Automotive'},
            //         {value: data.projectindustries['smartelectronic'], name: 'Smart Electronics'},
            //         {value: data.projectindustries['affluent'], name: 'Affluent, Medical and Wellness Tourism'},
            //         {value: data.projectindustries['agriculture'], name: 'Agriculture and Biotechnology'},
            //         {value: data.projectindustries['food'], name: 'Food for the Future'},
            //         {value: data.projectindustries['robotic'], name: 'Robotics'},
            //         {value: data.projectindustries['aviation'], name: 'Aviation and Logistics'},
            //         {value: data.projectindustries['biofuel'], name: 'Biofuels and Biochemicals'},
            //         {value: data.projectindustries['digital'], name: 'Digital'},
            //         {value: data.projectindustries['medical'], name: 'Medical Hub'},
            //         {value: data.projectindustries['defense'], name: 'Defense'},
            //         {value: data.projectindustries['education'], name: 'Education and Skill Development'},
            //         {value: data.projectindustries['other'], name: 'อื่น'},
            //     ]

            //     if(data.projectindustries['automotive'] != 0 || data.projectindustries['smartelectronic'] != 0 || data.projectindustries['affluent'] != 0 ||
            //     data.projectindustries['agriculture'] != 0 || data.projectindustries['food'] != 0 || data.projectindustries['robotic'] != 0 ||
            //     data.projectindustries['aviation'] != 0 || data.projectindustries['biofuel'] != 0 || data.projectindustries['digital'] != 0 || 
            //     data.projectindustries['medical'] != 0 || data.projectindustries['defense'] != 0 || data.projectindustries['education'] != 0 || data.projectindustries['other'] != 0){
            //         genDonutchart(industrygroupdata,industrygrouplegend,'กลุ่มอุตสาหกรรม','จำนวนโครงการตามกลุ่มอุตสาหกรรม','industrygroup_chart','center');
            //     }
            
                

            //     objectivedata = [
            //         {value: data.objectives['finance'], name: 'ด้านการเงิน'},
            //         {value: data.objectives['nonfinance'], name: 'ไม่ใช่ด้านการเงิน'},
            //         {value: data.objectives['bothobjecttive'], name: 'ด้านการเงินและไม่ใช่ด้านการเงิน'}
            //     ]               

            //     if(data.objectives['finance'] != 0 || data.objectives['nonfinance'] != 0 || data.objectives['bothobjecttive'] != 0){
            //         genDonutchart(objectivedata,objectivelegend,'วัตถุประสงค์ของการขอรับการประเมิน','วัตถุประสงค์ของการขอรับการประเมิน','financial_chart','center');
            //     }

            // }).catch(error => {})
            
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

    function callUpdateChart(data) {
        var pillar_management = data.finalgrades.filter(x => x.pillar_id == 1).reduce((a, b) => +a + +b.percent, 0)/(data.finalgrades.length/4); 
        var pillar_tech = data.finalgrades.filter(x => x.pillar_id == 2).reduce((a, b) => +a + +b.percent, 0)/(data.finalgrades.length/4); 
        var pillar_marketability = data.finalgrades.filter(x => x.pillar_id == 3).reduce((a, b) => +a + +b.percent, 0)/(data.finalgrades.length/4); 
        var pillar_bp = data.finalgrades.filter(x => x.pillar_id == 4).reduce((a, b) => +a + +b.percent, 0)/(data.finalgrades.length/4); 

        var avgpillar = (pillar_management + pillar_tech + pillar_marketability + pillar_bp)/4;

        var avrgrade = checkPillarGrade(avgpillar)
        topLeftChart(avgpillar,avrgrade);
  
        if(isNaN(pillar_management)) {
            pillar_management = 0;
        }
        if(isNaN(pillar_tech)) {
            pillar_tech = 0;
        }
        if(isNaN(pillar_marketability)) {
            pillar_marketability = 0;
        }
        if(isNaN(pillar_bp)) {
            pillar_bp = 0;
        }
    

        pillar_bp = Math.round(pillar_bp * 100) / 100
        pillar_marketability = Math.round(pillar_marketability * 100) / 100
        pillar_tech = Math.round(pillar_tech * 100) / 100
        pillar_management = Math.round(pillar_management * 100) / 100

        $('#gradepillar_bp').html(checkPillarGrade(pillar_bp));
        if(pillar_bp == 0){
            $('.chart-skills').find('span:nth-child(1)').text(``);
            $('#pillar_bp').html('');

        }else{
            $('#pillar_bp').html(pillar_bp + ' %');
            $('.chart-skills').find('span:nth-child(1)').text(`${pillar_bp}%`);
        }

        $('.chart-skills').find('li:nth-child(1)').css('transform', `rotate(${pillar_bp*1.8}deg)`);
        $('.chart-skills').find('span:nth-child(1)').css('transform', `rotate(${(-1.8)*pillar_bp}deg)`);
        if(pillar_bp == 100){
            $('.chart-skills').find('span:nth-child(1)').css('top', `20px`);
        }

        $('#gradepillar_marketability').html(checkPillarGrade(pillar_marketability));
        if(pillar_marketability == 0){
            $('.chart-skills2').find('span:nth-child(1)').text(``);
            $('#pillar_marketability').html('');
        }else{
            $('#pillar_marketability').html(pillar_marketability + ' %');
            $('.chart-skills2').find('span:nth-child(1)').text(`${pillar_marketability}%`);
        }
        $('.chart-skills2').find('li:nth-child(1)').css('transform', `rotate(${pillar_marketability*1.8}deg)`);
        $('.chart-skills2').find('span:nth-child(1)').css('transform', `rotate(${(-1.8)*pillar_marketability}deg)`);    
        if(pillar_marketability == 100){
            $('.chart-skills2').find('span:nth-child(1)').css('top', `20px`);
        }    

        $('#gradepillar_tech').html(checkPillarGrade(pillar_tech));
        if(pillar_tech == 0){
            $('.chart-skills3').find('span:nth-child(1)').text(``);
            $('#pillar_tech').html('');
        }else{
            $('.chart-skills3').find('span:nth-child(1)').text(`${pillar_tech}%`);
            $('#pillar_tech').html(pillar_tech + ' %');
        }
        $('.chart-skills3').find('li:nth-child(1)').css('transform', `rotate(${pillar_tech*1.8}deg)`);
        $('.chart-skills3').find('span:nth-child(1)').css('transform', `rotate(${(-1.8)*pillar_tech}deg)`);
        if(pillar_tech == 100){
            $('.chart-skills3').find('span:nth-child(1)').css('top', `20px`);
        }


        $('#gradepillar_management').html(checkPillarGrade(pillar_management));
        if(pillar_management == 0){
            $('.chart-skills4').find('span:nth-child(1)').text(``);
            $('#pillar_management').html('');
        }else{
            $('.chart-skills4').find('span:nth-child(1)').text(`${pillar_management}%`);
            $('#pillar_management').html(pillar_management + ' %');
        }
        $('.chart-skills4').find('li:nth-child(1)').css('transform', `rotate(${pillar_management*1.8}deg)`);
        $('.chart-skills4').find('span:nth-child(1)').css('transform', `rotate(${(-1.8)*pillar_management}deg)`);
        if(pillar_management == 100){
            $('.chart-skills4').find('span:nth-child(1)').css('top', `20px`);
        }
        $("#mainchart").attr("hidden",false);

    }

 
    function checkPillarGrade(_percent){
        var percent = parseInt(_percent);
        if(percent >= 87){
            return 'AAA';
        }else if(percent >= 80 && percent < 87){
            return 'AA';
        }else if(percent >= 74 && percent < 80){
            return 'A';
        }else if(percent >= 70 && percent < 74){
            return 'BBB';
        }else if(percent >= 64 && percent < 70){
            return 'BB';
        }else if(percent >= 56 && percent < 64){
            return 'B';
        }else if(percent >= 54 && percent < 56){
            return 'CCC';
        }else if(percent >= 51 && percent < 54){
            return 'CC';
        }else if(percent >= 48 && percent < 51){
            return 'C';
        }else if(percent >= 25 && percent < 48){
            return 'D';
        }else if(percent > 0 && percent < 25){
            return 'E';
        }else{
            return '';
        }
    }

    function getRadarChartData() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: `${route.url}/api/report/chart/getchartdata`,
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

    function getChartData() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: `${route.url}/api/report/chart/chartdata`,
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
    
    function genDonutchart(data,legend,text,sub,eleid,legendalign){
        var dom = document.getElementById(eleid);
        var donutchart = echarts.init(dom);
        var app = {};
        var option = null;
        option = {
            textStyle: {
                fontFamily: 'Kanit',
            },
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b}: {c} ({d}%)'
            },
            legend: {
                bottom: 10,
                type: 'scroll',
                orient: 'horizontal',
                // left: 10,
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

$('#chkjoinmetting').on('change.bootstrapSwitch', function(e) {
    var status = 0
    if(e.target.checked==true){
        status =1;
    }        
   globalid = $(this).data('id');
   $("#spinicon").attr("hidden",false);
   Attendee.updateJoinEvent($(this).data('id'),status,"").then(data => {
       $("#spinicon").attr("hidden",true);
      
   }).catch(error => {})
});


var event_val =  $('#jointype').val();
$(document).on('change', '.confirm', function(e) { 
    console.log($(this).val());
    event_val = $(this).val();
    if(typeof($(this).val()) === "undefined" || $(this).val() === null || $(this).val() === ''){
        event_val = 1;
    }
    if(event_val == 3){
        console.log('yes');
        $("#rej_meeting_note_wrapper").attr("hidden",false);   
    }else{
        $("#rej_meeting_note_wrapper").attr("hidden",true); 
    }
    $('#jointype').val(event_val);
});


$(document).on('click', '#btn_modal_get_calendar', function(e) {
   $("#spinicon").attr("hidden",false);
   Attendee.updateJoinEvent($('#attendeventid').val(),$('#jointype').val(),$('#rej_meeting_note').val()).then(data => {
       $("#spinicon").attr("hidden",true);
       document.location.reload();
   }).catch(error => {})
});

$(document).on('click', '#numproject_donut', function(e) {
    genNumProject('donut',participatedata,participatelegend,'จำนวนโครงการปี ' + $('#currentyear').html(),'จำนวนโครงการปี ' + $('#currentyear').html(),'participate_chart','center');
});  

$(document).on('click', '#numproject_bar', function(e) {
    var data = [
        {
            value: participatedata[0]['value'],
            itemStyle: {color: '#61a0a8'},
        },
        {
            value: participatedata[1]['value'],
            itemStyle: {color: '#c23531'},
        },
        {
            value: participatedata[2]['value'],
            itemStyle: {color: '#2f4554'},
        }
    ]
    genNumProject('bar',data,participatelegend,'จำนวนโครงการปี ' + $('#currentyear').html(),'จำนวนโครงการปี ' + $('#currentyear').html(),'participate_chart','center');
});  

$(document).on('click', '#project_grade_bar', function(e) {
    var data = [
        {
            value: gradedata[0]['value'],
            itemStyle: {color: '#c23531'},
        },
        {
            value: gradedata[1]['value'],
            itemStyle: {color: '#2f4554'},
        },
        {
            value: gradedata[2]['value'],
            itemStyle: {color: '#61a0a8'},
        },{
            value: gradedata[3]['value'],
            itemStyle: {color: '#d48265'},
        },
        {
            value: gradedata[4]['value'],
            itemStyle: {color: '#91c7ae'},
        },
        {
            value: gradedata[5]['value'],
            itemStyle: {color: '#749f83'},
        },{
            value: gradedata[6]['value'],
            itemStyle: {color: '#ca8622'},
        },
        {
            value: gradedata[7]['value'],
            itemStyle: {color: '#bda29a'},
        },
        {
            value: gradedata[8]['value'],
            itemStyle: {color: '#6e7074'},
        },
        {
            value: gradedata[8]['value'],
            itemStyle: {color: '#546570'},
        }
    ]
    genNumProject('bar',data,dradelegend,'เกรดการประเมิน ' + $('#currentyear').html(),'จำนวนโครงการตามเกรดการประเมิน ' + $('#currentyear').html(),'grade_chart','center');
}); 

$(document).on('click', '#numproject_pie', function(e) {
    genNumProject('pie',participatedata,participatelegend,'จำนวนโครงการปี ' + $('#currentyear').html(),'จำนวนโครงการปี ' + $('#currentyear').html(),'participate_chart','center');
});

$(document).on('click', '#project_grade_donut', function(e) {
    genNumProject('donut',gradedata,dradelegend,'เกรดการประเมิน ' + $('#currentyear').html(),'จำนวนโครงการตามเกรดการประเมิน ' + $('#currentyear').html(),'grade_chart','center');
}); 

$(document).on('click', '#project_grade_pie', function(e) {
    genNumProject('pie',gradedata,dradelegend,'เกรดการประเมิน ' + $('#currentyear').html(),'จำนวนโครงการตามเกรดการประเมิน ' + $('#currentyear').html(),'grade_chart','center');
});


function callGenRadarGradeByPillar(data){
    var numgrade = [];
    var gradedata = []
    var rgbcolor = [ 'rgba(194, 53, 49, 0.2)', 'rgba(47, 69, 84, 0.2)', 'rgba(97, 160, 168, 0.2)', 'rgba(212, 130, 101, 0.2)', 'rgba(145, 199, 174, 0.2)', 'rgba(116, 159, 131, 0.2)', 'rgba(202, 134, 34, 0.2)','rgba(189, 162, 154, 0.2)', 'rgba(110, 112, 116, 0.2)', 'rgba(84, 101, 112, 0.2)','rgba(196, 204, 211, 0.2)'];
    data.grades.forEach(function (grade,index) {
        var pillararr = [];
        var pillar1 = data.finalgrades.filter(x => x.pillar_id == 1 && x.grade == grade.name); 
        var pillar2 = data.finalgrades.filter(x => x.pillar_id == 2 && x.grade == grade.name); 
        var pillar3 = data.finalgrades.filter(x => x.pillar_id == 3 && x.grade == grade.name); 
        var pillar4 = data.finalgrades.filter(x => x.pillar_id == 4 && x.grade == grade.name); 
        pillararr = [pillar1.length,pillar2.length,pillar3.length,pillar4.length];
        var max = Math.max.apply(null, pillararr);
        numgrade.push(max);
        var tmp = {value: pillararr, name: grade.name, areaStyle: {color:rgbcolor[index]}};
        gradedata.push(tmp);
  
    });
    var maxval = Math.max.apply(null, numgrade);
    var indicator =  [
        { name: 'Management', max: maxval},
        { name: 'Technology', max: maxval},
        { name: 'Marketability', max: maxval},
        { name: 'Business Prospect', max: maxval}        
    ];
    var color = [ '#c23531', '#2f4554', '#61a0a8', '#d48265', '#91c7ae', '#749f83', '#ca8622','#bda29a', '#6e7074', '#546570','#c4ccd3'];
    genRadar('radar',indicator,color,datagradebysector,gradedata,'gradebypillar');
}

function callBarGradeByPillar(data){

    var gradedata = []
    data.grades.forEach(function (grade,index) {
        var pillararr = [];
        var pillar1 = data.finalgrades.filter(x => x.pillar_id == 1 && x.grade == grade.name); 
        var pillar2 = data.finalgrades.filter(x => x.pillar_id == 2 && x.grade == grade.name); 
        var pillar3 = data.finalgrades.filter(x => x.pillar_id == 3 && x.grade == grade.name); 
        var pillar4 = data.finalgrades.filter(x => x.pillar_id == 4 && x.grade == grade.name); 
        pillararr = [pillar1.length,pillar2.length,pillar3.length,pillar4.length];
        var tmp = {name: grade.name, type: 'bar', stack: 'single', data: pillararr};
        gradedata.push(tmp);
     });

    var xaxis = ['Management', 'Technology', 'Marketability', 'Business Prospect']

    genBar(xaxis ,gradedata , 'gradebypillar');
}

function callPolarStackGradeByPillar(data){

    var gradedata = []
    data.grades.forEach(function (grade,index) {
        var pillararr = [];
        var pillar1 = data.finalgrades.filter(x => x.pillar_id == 1 && x.grade == grade.name); 
        var pillar2 = data.finalgrades.filter(x => x.pillar_id == 2 && x.grade == grade.name); 
        var pillar3 = data.finalgrades.filter(x => x.pillar_id == 3 && x.grade == grade.name); 
        var pillar4 = data.finalgrades.filter(x => x.pillar_id == 4 && x.grade == grade.name); 
        pillararr = [pillar1.length,pillar2.length,pillar3.length,pillar4.length];
        var tmp = {name: grade.name, type: 'bar', stack: 'a', data: pillararr,coordinateSystem: 'polar',emphasis: { focus: 'series'}};
        gradedata.push(tmp);
     });
     
    var xaxis = ['Management', 'Technology', 'Marketability', 'Business Prospect']

    genPolarStack(xaxis ,gradedata , 'gradebypillar');
}


function callGenRadarByBusinessSize(data){
    var numgrade = [];
    var gradedata = []
    var rgbcolor = [ 'rgba(194, 53, 49, 0.2)', 'rgba(47, 69, 84, 0.2)', 'rgba(97, 160, 168, 0.2)', 'rgba(212, 130, 101, 0.2)', 'rgba(145, 199, 174, 0.2)', 'rgba(116, 159, 131, 0.2)', 'rgba(202, 134, 34, 0.2)','rgba(189, 162, 154, 0.2)', 'rgba(110, 112, 116, 0.2)', 'rgba(84, 101, 112, 0.2)','rgba(196, 204, 211, 0.2)'];
    data.grades.forEach(function (grade,index) {
        var businesssizearr = [];
        var micro = data.projectgrades.filter(x => x.businesssize == 1 && x.grade == grade.name); 
        var S = data.projectgrades.filter(x => x.businesssize == 2 && x.grade == grade.name); 
        var M = data.projectgrades.filter(x => x.businesssize == 3 && x.grade == grade.name); 
        var L = data.projectgrades.filter(x => x.businesssize == 4 && x.grade == grade.name); 
        businesssizearr = [micro.length,S.length,M.length,L.length];
        var max = Math.max.apply(null, businesssizearr);
        numgrade.push(max);
        var tmp = {value: businesssizearr, name: grade.name, areaStyle: {color:rgbcolor[index]}};
        gradedata.push(tmp);
  
    });
    var maxval = Math.max.apply(null, numgrade);
    var indicator =  [
        { name: 'Micro', max: maxval},
        { name: 'S', max: maxval},
        { name: 'M', max: maxval},
        { name: 'L', max: maxval}
    ];

    var color = [ '#c23531', '#2f4554', '#61a0a8', '#d48265', '#91c7ae', '#749f83', '#ca8622','#bda29a', '#6e7074', '#546570','#c4ccd3'];
    genRadar('radar',indicator,color,datagradebysector,gradedata,'gradebybusinesssize');
}

function callGenBarByBusinessSize(data){
    var gradedata = []
    data.grades.forEach(function (grade,index) {
        var businesssizearr = [];
        var micro = data.projectgrades.filter(x => x.businesssize == 1 && x.grade == grade.name); 
        var S = data.projectgrades.filter(x => x.businesssize == 2 && x.grade == grade.name); 
        var M = data.projectgrades.filter(x => x.businesssize == 3 && x.grade == grade.name); 
        var L = data.projectgrades.filter(x => x.businesssize == 4 && x.grade == grade.name); 
        businesssizearr = [micro.length,S.length,M.length,L.length];

        var tmp = {name: grade.name, type: 'bar', stack: 'single', data: businesssizearr};
        gradedata.push(tmp);
    });

    var xaxis = ['Micro', 'S', 'M', 'L']

    genBar(xaxis ,gradedata , 'gradebybusinesssize');
}

function callGenPolarStackByBusinessSize(data){
    var gradedata = []
    data.grades.forEach(function (grade,index) {
        var businesssizearr = [];
        var micro = data.projectgrades.filter(x => x.businesssize == 1 && x.grade == grade.name); 
        var S = data.projectgrades.filter(x => x.businesssize == 2 && x.grade == grade.name); 
        var M = data.projectgrades.filter(x => x.businesssize == 3 && x.grade == grade.name); 
        var L = data.projectgrades.filter(x => x.businesssize == 4 && x.grade == grade.name); 
        businesssizearr = [micro.length,S.length,M.length,L.length];

        // var tmp = {name: grade.name, type: 'bar', stack: 'single', data: businesssizearr};
        var tmp = {name: grade.name, type: 'bar', stack: 'a', data: businesssizearr,coordinateSystem: 'polar',emphasis: { focus: 'series'}};
        gradedata.push(tmp);
    });

    var xaxis = ['Micro', 'S', 'M', 'L']
    genPolarStack(xaxis ,gradedata , 'gradebybusinesssize');
}

function callGenRadarBySector(data){
    var numgrade = [];
    var gradedata = []
    var rgbcolor = [ 'rgba(194, 53, 49, 0.2)', 'rgba(47, 69, 84, 0.2)', 'rgba(97, 160, 168, 0.2)', 'rgba(212, 130, 101, 0.2)', 'rgba(145, 199, 174, 0.2)', 'rgba(116, 159, 131, 0.2)', 'rgba(202, 134, 34, 0.2)','rgba(189, 162, 154, 0.2)', 'rgba(110, 112, 116, 0.2)', 'rgba(84, 101, 112, 0.2)','rgba(196, 204, 211, 0.2)'];
    data.grades.forEach(function (grade,index) {
        var sectorarr = [];
        var sector1 = data.projectgrades.filter(x => x.sector == 1 && x.grade == grade.name); 
        var sector2 = data.projectgrades.filter(x => x.sector == 2 && x.grade == grade.name); 
        var sector3 = data.projectgrades.filter(x => x.sector == 3 && x.grade == grade.name); 
        var sector4 = data.projectgrades.filter(x => x.sector == 4 && x.grade == grade.name); 
        var sector5 = data.projectgrades.filter(x => x.sector == 5 && x.grade == grade.name); 
        var sector6 = data.projectgrades.filter(x => x.sector == 6 && x.grade == grade.name); 
        sectorarr = [sector1.length,sector2.length,sector3.length,sector4.length,sector5.length,sector6.length];
        var max = Math.max.apply(null, sectorarr);
        numgrade.push(max);
        var tmp = {value: sectorarr, name: grade.name, areaStyle: {color:rgbcolor[index]}};
        gradedata.push(tmp);
  
    });
    var maxval = Math.max.apply(null, numgrade);
    var indicator =  [
        { name: 'เหนือ', max: maxval},
        { name: 'กลาง', max: maxval},
        { name: 'ตะวันออก', max: maxval},
        { name: 'ตะวันตก', max: maxval},
        { name: 'ตะวันออกเฉียงเหนือ', max: maxval},
        { name: 'ใต้', max: maxval}
    ];

    var color = [ '#c23531', '#2f4554', '#61a0a8', '#d48265', '#91c7ae', '#749f83', '#ca8622','#bda29a', '#6e7074', '#546570','#c4ccd3'];
    genRadar('radar',indicator,color,datagradebysector,gradedata,'gradebysector');
}

function callGenBarBySector(data){
    var gradedata = []
    data.grades.forEach(function (grade,index) {
        var sectorarr = [];
        var sector1 = data.projectgrades.filter(x => x.sector == 1 && x.grade == grade.name); 
        var sector2 = data.projectgrades.filter(x => x.sector == 2 && x.grade == grade.name); 
        var sector3 = data.projectgrades.filter(x => x.sector == 3 && x.grade == grade.name); 
        var sector4 = data.projectgrades.filter(x => x.sector == 4 && x.grade == grade.name); 
        var sector5 = data.projectgrades.filter(x => x.sector == 5 && x.grade == grade.name); 
        var sector6 = data.projectgrades.filter(x => x.sector == 6 && x.grade == grade.name); 
        sectorarr = [sector1.length,sector2.length,sector3.length,sector4.length,sector5.length,sector6.length];

        var tmp = {name: grade.name, type: 'bar', stack: 'single', data: sectorarr};
        gradedata.push(tmp);
  
    });

    var xaxis = ['เหนือ', 'กลาง', 'ตะวันออก', 'ตะวันตก', 'ตะวันออกเฉียงเหนือ', 'ใต้']

    genBar(xaxis ,gradedata , 'gradebysector');
}

function callGenPolarStackBySector(data){
    var gradedata = []
    data.grades.forEach(function (grade,index) {
        var sectorarr = [];
        var sector1 = data.projectgrades.filter(x => x.sector == 1 && x.grade == grade.name); 
        var sector2 = data.projectgrades.filter(x => x.sector == 2 && x.grade == grade.name); 
        var sector3 = data.projectgrades.filter(x => x.sector == 3 && x.grade == grade.name); 
        var sector4 = data.projectgrades.filter(x => x.sector == 4 && x.grade == grade.name); 
        var sector5 = data.projectgrades.filter(x => x.sector == 5 && x.grade == grade.name); 
        var sector6 = data.projectgrades.filter(x => x.sector == 6 && x.grade == grade.name); 
        sectorarr = [sector1.length,sector2.length,sector3.length,sector4.length,sector5.length,sector6.length];

        var tmp = {name: grade.name, type: 'bar', stack: 'a', data: sectorarr,coordinateSystem: 'polar',emphasis: { focus: 'series'}};
        gradedata.push(tmp);
  
    });

    var xaxis = ['เหนือ', 'กลาง', 'ตะวันออก', 'ตะวันตก', 'ตะวันออกเฉียงเหนือ', 'ใต้']

    // genBar(xaxis ,gradedata , 'gradebysector');
    genPolarStack(xaxis ,gradedata , 'gradebysector');
}

function callGenRadarByBusinessType(data){
    var numgrade = [];
    var gradedata = []
    var rgbcolor = [ 'rgba(194, 53, 49, 0.2)', 'rgba(47, 69, 84, 0.2)', 'rgba(97, 160, 168, 0.2)', 'rgba(212, 130, 101, 0.2)', 'rgba(145, 199, 174, 0.2)', 'rgba(116, 159, 131, 0.2)', 'rgba(202, 134, 34, 0.2)','rgba(189, 162, 154, 0.2)', 'rgba(110, 112, 116, 0.2)', 'rgba(84, 101, 112, 0.2)','rgba(196, 204, 211, 0.2)'];
    data.grades.forEach(function (grade,index) {
        var businesstypearr = [];
        var businesstype1 = data.projectgrades.filter(x => x.businesstype == 1 && x.grade == grade.name); 
        var businesstype2 = data.projectgrades.filter(x => x.businesstype == 2 && x.grade == grade.name); 
        var businesstype3 = data.projectgrades.filter(x => x.businesstype == 3 && x.grade == grade.name); 
        var businesstype4 = data.projectgrades.filter(x => x.businesstype == 4 && x.grade == grade.name); 
        var businesstype5 = data.projectgrades.filter(x => x.businesstype == 5 && x.grade == grade.name); 
        var businesstype6 = data.projectgrades.filter(x => x.businesstype == 6 && x.grade == grade.name); 
        businesstypearr = [businesstype1.length,businesstype2.length,businesstype3.length,businesstype4.length,businesstype5.length,businesstype6.length];
        var max = Math.max.apply(null, businesstypearr);
        numgrade.push(max);
        var tmp = {value: businesstypearr, name: grade.name, areaStyle: {color:rgbcolor[index]}};
        gradedata.push(tmp);
  
    });
    var maxval = Math.max.apply(null, numgrade);
    var indicator =  [
        { name: ' บริษัทมหาชน', max: maxval},
        { name: ' บริษัทจำกัด', max: maxval},
        { name: 'ห้างหุ้นส่วนจำกัด', max: maxval},
        { name: 'ห้างหุ้นส่วนสามัญ', max: maxval},
        { name: 'กิจการเจ้าของคนเดียว', max: maxval},
        { name: 'องค์กรธุรกิจจัดตั้ง หรือจดทะเบียนภายใต้กฎหมายเฉพาะ', max: maxval}
    ];

    var color = [ '#c23531', '#2f4554', '#61a0a8', '#d48265', '#91c7ae', '#749f83', '#ca8622','#bda29a', '#6e7074', '#546570','#c4ccd3'];
    genRadar('radar',indicator,color,datagradebysector,gradedata,'gradebybusinesstype');
}

function callGenBarByBusinessType(data){
    var gradedata = []
    data.grades.forEach(function (grade,index) {
        var businesstypearr = [];
        var businesstype1 = data.projectgrades.filter(x => x.businesstype == 1 && x.grade == grade.name); 
        var businesstype2 = data.projectgrades.filter(x => x.businesstype == 2 && x.grade == grade.name); 
        var businesstype3 = data.projectgrades.filter(x => x.businesstype == 3 && x.grade == grade.name); 
        var businesstype4 = data.projectgrades.filter(x => x.businesstype == 4 && x.grade == grade.name); 
        var businesstype5 = data.projectgrades.filter(x => x.businesstype == 5 && x.grade == grade.name); 
        var businesstype6 = data.projectgrades.filter(x => x.businesstype == 6 && x.grade == grade.name); 
        businesstypearr = [businesstype1.length,businesstype2.length,businesstype3.length,businesstype4.length,businesstype5.length,businesstype6.length];
        var tmp = {name: grade.name, type: 'bar', stack: 'single', data: businesstypearr};
        gradedata.push(tmp);
  
    });

    var xaxis = [' บริษัทมหาชน', ' บริษัทจำกัด', 'ห้างหุ้นส่วนจำกัด', 'ห้างหุ้นส่วนสามัญ', 'กิจการเจ้าของคนเดียว', 'องค์กรธุรกิจจัดตั้ง หรือจดทะเบียนภายใต้กฎหมายเฉพาะ']

    genBar(xaxis ,gradedata , 'gradebybusinesstype');
}

function callGenPolarStackByBusinessType(data){
    var gradedata = []
    data.grades.forEach(function (grade,index) {
        var businesstypearr = [];
        var businesstype1 = data.projectgrades.filter(x => x.businesstype == 1 && x.grade == grade.name); 
        var businesstype2 = data.projectgrades.filter(x => x.businesstype == 2 && x.grade == grade.name); 
        var businesstype3 = data.projectgrades.filter(x => x.businesstype == 3 && x.grade == grade.name); 
        var businesstype4 = data.projectgrades.filter(x => x.businesstype == 4 && x.grade == grade.name); 
        var businesstype5 = data.projectgrades.filter(x => x.businesstype == 5 && x.grade == grade.name); 
        var businesstype6 = data.projectgrades.filter(x => x.businesstype == 6 && x.grade == grade.name); 
        businesstypearr = [businesstype1.length,businesstype2.length,businesstype3.length,businesstype4.length,businesstype5.length,businesstype6.length];
        var tmp = {name: grade.name, type: 'bar', stack: 'a', data: businesstypearr,coordinateSystem: 'polar',emphasis: { focus: 'series'}};
        gradedata.push(tmp);
  
    });

    var xaxis = [' บริษัทมหาชน', ' บริษัทจำกัด', 'ห้างหุ้นส่วนจำกัด', 'ห้างหุ้นส่วนสามัญ', 'กิจการเจ้าของคนเดียว', 'องค์กรธุรกิจจัดตั้ง หรือจดทะเบียนภายใต้กฎหมายเฉพาะ']

    // genBar(xaxis ,gradedata , 'gradebybusinesstype');
    genPolarStack(xaxis ,gradedata , 'gradebybusinesstype');
}

function callGenRadarByIndustryGroup(data){
    var numgrade = [];
    var gradedata = []
    var rgbcolor = [ 'rgba(194, 53, 49, 0.2)', 'rgba(47, 69, 84, 0.2)', 'rgba(97, 160, 168, 0.2)', 'rgba(212, 130, 101, 0.2)', 'rgba(145, 199, 174, 0.2)', 'rgba(116, 159, 131, 0.2)', 'rgba(202, 134, 34, 0.2)','rgba(189, 162, 154, 0.2)', 'rgba(110, 112, 116, 0.2)', 'rgba(84, 101, 112, 0.2)','rgba(196, 204, 211, 0.2)'];
    data.grades.forEach(function (grade,index) {
        var industrygrouparr = [];
        var industrygroup1 = data.projectgrades.filter(x => x.industrygroup == 1 && x.grade == grade.name); 
        var industrygroup2 = data.projectgrades.filter(x => x.industrygroup == 2 && x.grade == grade.name); 
        var industrygroup3 = data.projectgrades.filter(x => x.industrygroup == 3 && x.grade == grade.name); 
        var industrygroup4 = data.projectgrades.filter(x => x.industrygroup == 4 && x.grade == grade.name); 
        var industrygroup5 = data.projectgrades.filter(x => x.industrygroup == 5 && x.grade == grade.name); 
        var industrygroup6 = data.projectgrades.filter(x => x.industrygroup == 6 && x.grade == grade.name); 
        var industrygroup7 = data.projectgrades.filter(x => x.industrygroup == 7 && x.grade == grade.name); 
        var industrygroup8 = data.projectgrades.filter(x => x.industrygroup == 8 && x.grade == grade.name); 
        var industrygroup9 = data.projectgrades.filter(x => x.industrygroup == 9 && x.grade == grade.name); 
        var industrygroup10 = data.projectgrades.filter(x => x.industrygroup == 10 && x.grade == grade.name); 
        var industrygroup11 = data.projectgrades.filter(x => x.industrygroup == 11 && x.grade == grade.name); 
        var industrygroup12 = data.projectgrades.filter(x => x.industrygroup == 12 && x.grade == grade.name); 
        var industrygroup13 = data.projectgrades.filter(x => x.industrygroup == 13 && x.grade == grade.name); 
        industrygrouparr = [industrygroup1.length,industrygroup2.length,industrygroup3.length,industrygroup4.length,industrygroup5.length,industrygroup6.length
        ,industrygroup7.length,industrygroup8.length,industrygroup9.length,industrygroup10.length,industrygroup11.length,industrygroup12.length,industrygroup13.length];
        var max = Math.max.apply(null, industrygrouparr);
        numgrade.push(max);
        var tmp = {value: industrygrouparr, name: grade.name, areaStyle: {color:rgbcolor[index]}};
        gradedata.push(tmp);
  
    });
    var maxval = Math.max.apply(null, numgrade);

    var indicator =  [
        { name: 'Next-generation Automotive', max: maxval},
        { name: 'Smart Electronics', max: maxval},
        { name: 'Affluent, Medical and Wellness Tourism', max: maxval},
        { name: 'Agriculture and Biotechnology', max: maxval},
        { name: 'Food for the Future', max: maxval},
        { name: 'Robotics', max: maxval},
        { name: 'Aviation and Logistics', max: maxval},
        { name: 'Biofuels and Biochemicals', max: maxval},
        { name: 'Digital', max: maxval},
        { name: 'Medical Hub', max: maxval},
        { name: 'Defense', max: maxval},
        { name: 'Education and Skill Development', max: maxval},
        { name: 'Other', max: maxval}
    ];

    var color = [ '#c23531', '#2f4554', '#61a0a8', '#d48265', '#91c7ae', '#749f83', '#ca8622','#bda29a', '#6e7074', '#546570','#c4ccd3'];

    genRadar('radar',indicator,color,datagradebysector,gradedata,'gradebyindustry');
}

function callGenBarByIndustryGroup(data){
    var gradedata = []
    data.grades.forEach(function (grade,index) {
        var industrygrouparr = [];
        var industrygroup1 = data.projectgrades.filter(x => x.industrygroup == 1 && x.grade == grade.name); 
        var industrygroup2 = data.projectgrades.filter(x => x.industrygroup == 2 && x.grade == grade.name); 
        var industrygroup3 = data.projectgrades.filter(x => x.industrygroup == 3 && x.grade == grade.name); 
        var industrygroup4 = data.projectgrades.filter(x => x.industrygroup == 4 && x.grade == grade.name); 
        var industrygroup5 = data.projectgrades.filter(x => x.industrygroup == 5 && x.grade == grade.name); 
        var industrygroup6 = data.projectgrades.filter(x => x.industrygroup == 6 && x.grade == grade.name); 
        var industrygroup7 = data.projectgrades.filter(x => x.industrygroup == 7 && x.grade == grade.name); 
        var industrygroup8 = data.projectgrades.filter(x => x.industrygroup == 8 && x.grade == grade.name); 
        var industrygroup9 = data.projectgrades.filter(x => x.industrygroup == 9 && x.grade == grade.name); 
        var industrygroup10 = data.projectgrades.filter(x => x.industrygroup == 10 && x.grade == grade.name); 
        var industrygroup11 = data.projectgrades.filter(x => x.industrygroup == 11 && x.grade == grade.name); 
        var industrygroup12 = data.projectgrades.filter(x => x.industrygroup == 12 && x.grade == grade.name); 
        var industrygroup13 = data.projectgrades.filter(x => x.industrygroup == 13 && x.grade == grade.name); 
        industrygrouparr = [industrygroup1.length,industrygroup2.length,industrygroup3.length,industrygroup4.length,industrygroup5.length,industrygroup6.length
        ,industrygroup7.length,industrygroup8.length,industrygroup9.length,industrygroup10.length,industrygroup11.length,industrygroup12.length,industrygroup13.length];

        var tmp = {name: grade.name, type: 'bar', stack: 'single', data: industrygrouparr};
        gradedata.push(tmp);
  
    });

    var xaxis = ['Next-generation Automotive', 'Smart Electronics', 'Affluent, Medical and Wellness Tourism', 'Agriculture and Biotechnology', 'Food for the Future', 'Robotics',
'Aviation and Logistics','Biofuels and Biochemicals','Digital','Medical Hub','Defense','Education and Skill Development','Other']

    genBar(xaxis ,gradedata , 'gradebyindustry');
}

function callGenPolarStackByIndustryGroup(data){
    var gradedata = []
    data.grades.forEach(function (grade,index) {
        var industrygrouparr = [];
        var industrygroup1 = data.projectgrades.filter(x => x.industrygroup == 1 && x.grade == grade.name); 
        var industrygroup2 = data.projectgrades.filter(x => x.industrygroup == 2 && x.grade == grade.name); 
        var industrygroup3 = data.projectgrades.filter(x => x.industrygroup == 3 && x.grade == grade.name); 
        var industrygroup4 = data.projectgrades.filter(x => x.industrygroup == 4 && x.grade == grade.name); 
        var industrygroup5 = data.projectgrades.filter(x => x.industrygroup == 5 && x.grade == grade.name); 
        var industrygroup6 = data.projectgrades.filter(x => x.industrygroup == 6 && x.grade == grade.name); 
        var industrygroup7 = data.projectgrades.filter(x => x.industrygroup == 7 && x.grade == grade.name); 
        var industrygroup8 = data.projectgrades.filter(x => x.industrygroup == 8 && x.grade == grade.name); 
        var industrygroup9 = data.projectgrades.filter(x => x.industrygroup == 9 && x.grade == grade.name); 
        var industrygroup10 = data.projectgrades.filter(x => x.industrygroup == 10 && x.grade == grade.name); 
        var industrygroup11 = data.projectgrades.filter(x => x.industrygroup == 11 && x.grade == grade.name); 
        var industrygroup12 = data.projectgrades.filter(x => x.industrygroup == 12 && x.grade == grade.name); 
        var industrygroup13 = data.projectgrades.filter(x => x.industrygroup == 13 && x.grade == grade.name); 
        industrygrouparr = [industrygroup1.length,industrygroup2.length,industrygroup3.length,industrygroup4.length,industrygroup5.length,industrygroup6.length
        ,industrygroup7.length,industrygroup8.length,industrygroup9.length,industrygroup10.length,industrygroup11.length,industrygroup12.length,industrygroup13.length];

        var tmp = {name: grade.name, type: 'bar', stack: 'a', data: industrygrouparr,coordinateSystem: 'polar',emphasis: { focus: 'series'}};
        gradedata.push(tmp);
  
    });

    var xaxis = ['Next-generation Automotive', 'Smart Electronics', 'Affluent, Medical and Wellness Tourism', 'Agriculture and Biotechnology', 'Food for the Future', 'Robotics',
'Aviation and Logistics','Biofuels and Biochemicals','Digital','Medical Hub','Defense','Education and Skill Development','Other']

    // genBar(xaxis ,gradedata , 'gradebyindustry');
    genPolarStack(xaxis ,gradedata , 'gradebyindustry');
}

function callGenRadarByIsic(data){
    var numgrade = [];
    var gradedata = []
    var rgbcolor = [ 'rgba(194, 53, 49, 0.2)', 'rgba(47, 69, 84, 0.2)', 'rgba(97, 160, 168, 0.2)', 'rgba(212, 130, 101, 0.2)', 'rgba(145, 199, 174, 0.2)', 'rgba(116, 159, 131, 0.2)', 'rgba(202, 134, 34, 0.2)','rgba(189, 162, 154, 0.2)', 'rgba(110, 112, 116, 0.2)', 'rgba(84, 101, 112, 0.2)','rgba(196, 204, 211, 0.2)'];
    data.grades.forEach(function (grade,index) {
        var isicarray = [];
        var isic1 = data.projectgrades.filter(x => x.isiccode == 1 && x.grade == grade.name); 
        var isic2 = data.projectgrades.filter(x => x.isiccode == 2 && x.grade == grade.name); 
        var isic3 = data.projectgrades.filter(x => x.isiccode == 3 && x.grade == grade.name); 
        var isic4 = data.projectgrades.filter(x => x.isiccode == 4 && x.grade == grade.name); 
        var isic5 = data.projectgrades.filter(x => x.isiccode == 5 && x.grade == grade.name); 
        var isic6 = data.projectgrades.filter(x => x.isiccode == 6 && x.grade == grade.name); 
        var isic7 = data.projectgrades.filter(x => x.isiccode == 7 && x.grade == grade.name); 
        var isic8 = data.projectgrades.filter(x => x.isiccode == 8 && x.grade == grade.name); 
        var isic9 = data.projectgrades.filter(x => x.isiccode == 9 && x.grade == grade.name); 
        var isic10 = data.projectgrades.filter(x => x.isiccode == 10 && x.grade == grade.name); 
        var isic11 = data.projectgrades.filter(x => x.isiccode == 11 && x.grade == grade.name); 
        var isic12 = data.projectgrades.filter(x => x.isiccode == 12 && x.grade == grade.name); 
        var isic13 = data.projectgrades.filter(x => x.isiccode == 13 && x.grade == grade.name); 
        var isic14 = data.projectgrades.filter(x => x.isiccode == 14 && x.grade == grade.name);
        var isic15 = data.projectgrades.filter(x => x.isiccode == 15 && x.grade == grade.name);
        var isic16 = data.projectgrades.filter(x => x.isiccode == 16 && x.grade == grade.name);
        var isic17 = data.projectgrades.filter(x => x.isiccode == 17 && x.grade == grade.name);
        var isic18 = data.projectgrades.filter(x => x.isiccode == 18 && x.grade == grade.name);
        var isic19 = data.projectgrades.filter(x => x.isiccode == 19 && x.grade == grade.name);
        var isic20 = data.projectgrades.filter(x => x.isiccode == 20 && x.grade == grade.name);

        isicarray = [isic1.length,isic2.length,isic3.length,isic4.length,isic5.length,isic6.length
        ,isic7.length,isic8.length,isic9.length,isic10.length,isic11.length,isic12.length,isic13.length
        ,isic14.length,isic15.length,isic16.length,isic17.length,isic18.length,isic19.length,isic20.length];
        var max = Math.max.apply(null, isicarray);
        numgrade.push(max);
        var tmp = {value: isicarray, name: grade.name, areaStyle: {color:rgbcolor[index]}};
        gradedata.push(tmp);
  
    });
    var maxval = Math.max.apply(null, numgrade);
    var indicator =  [
        { name: 'เกษตรกรรม การป่าไม้ และการประมง', max: maxval},
        { name: 'การทำเหมืองแร่และเหมืองหิน', max: maxval},
        { name: 'การผลิต', max: maxval},
        { name: 'ไฟฟ้า ก๊าซ ไอน้ำ และระบบปรับอากาศ', max: maxval},
        { name: 'การจัดหาน้ำ การจัดการ และการบำบัดน้ำเสีย ของเสีย และสิ่งปฏิกูล', max: maxval},
        { name: 'การขายส่งและการขายปลีก การซ่อมยานยนต์และจักรยานยนต์', max: maxval},
        { name: 'การขนส่งและสถานที่เก็บสินค้า', max: maxval},
        { name: 'ที่พักแรมและบริการด้านอาหาร', max: maxval},
        { name: 'ข้อมูลข่าวสารและการสื่อสาร', max: maxval},
        { name: 'กิจกรรมทางการเงินและการประกันภัย', max: maxval},
        { name: 'กิจกรรมอสังหาริมทรัพย์', max: maxval},
        { name: 'กิจกรรมทางวิชาชีพ วิทยาศาสตร์ และเทคนิค', max: maxval},
        { name: 'กิจกรรมการบริหารและการบริการสนับสนุน', max: 10},
        { name: 'การบริหารราชการ การป้องกันประเทศ และการประกันสังคมภาคบังคับ', max: maxval},
        { name: 'การศึกษา', max: maxval},
        { name: 'กิจกรรมด้านสุขภาพและงานสังคมสงเคราะห์', max: maxval},
        { name: 'ศิลปะ ความบันเทิง และนันทนาการ', max: maxval},
        { name: 'กิจกรรมบริการด้านอื่นๆ', max: maxval},
        { name: 'กิจกรรมการจ้างงานในครัวเรือนส่วนบุคคล กิจกรรมการผลิตสินค้าและบริการที่ทำขึ้นเองเพื่อใช้ในครัวเรือน ซึ่งไม่สามารถจำแนกกิจกรรมได้อย่างชัดเจน', max: maxval},
        { name: 'กิจกรรมขององค์การระหว่างประเทศและภาคีสมาชิก', max: maxval}
        

    ];

    var color = [ '#c23531', '#2f4554', '#61a0a8', '#d48265', '#91c7ae', '#749f83', '#ca8622','#bda29a', '#6e7074', '#546570','#c4ccd3'];
    genRadar('radar',indicator,color,datagradebysector,gradedata,'gradebyisic');
}

function callGenBarByIsic(data){
    var gradedata = []
    data.grades.forEach(function (grade,index) {
        var isicarray = [];
        var isic1 = data.projectgrades.filter(x => x.isiccode == 1 && x.grade == grade.name); 
        var isic2 = data.projectgrades.filter(x => x.isiccode == 2 && x.grade == grade.name); 
        var isic3 = data.projectgrades.filter(x => x.isiccode == 3 && x.grade == grade.name); 
        var isic4 = data.projectgrades.filter(x => x.isiccode == 4 && x.grade == grade.name); 
        var isic5 = data.projectgrades.filter(x => x.isiccode == 5 && x.grade == grade.name); 
        var isic6 = data.projectgrades.filter(x => x.isiccode == 6 && x.grade == grade.name); 
        var isic7 = data.projectgrades.filter(x => x.isiccode == 7 && x.grade == grade.name); 
        var isic8 = data.projectgrades.filter(x => x.isiccode == 8 && x.grade == grade.name); 
        var isic9 = data.projectgrades.filter(x => x.isiccode == 9 && x.grade == grade.name); 
        var isic10 = data.projectgrades.filter(x => x.isiccode == 10 && x.grade == grade.name); 
        var isic11 = data.projectgrades.filter(x => x.isiccode == 11 && x.grade == grade.name); 
        var isic12 = data.projectgrades.filter(x => x.isiccode == 12 && x.grade == grade.name); 
        var isic13 = data.projectgrades.filter(x => x.isiccode == 13 && x.grade == grade.name); 
        var isic14 = data.projectgrades.filter(x => x.isiccode == 14 && x.grade == grade.name);
        var isic15 = data.projectgrades.filter(x => x.isiccode == 15 && x.grade == grade.name);
        var isic16 = data.projectgrades.filter(x => x.isiccode == 16 && x.grade == grade.name);
        var isic17 = data.projectgrades.filter(x => x.isiccode == 17 && x.grade == grade.name);
        var isic18 = data.projectgrades.filter(x => x.isiccode == 18 && x.grade == grade.name);
        var isic19 = data.projectgrades.filter(x => x.isiccode == 19 && x.grade == grade.name);
        var isic20 = data.projectgrades.filter(x => x.isiccode == 20 && x.grade == grade.name);

        isicarray = [isic1.length,isic2.length,isic3.length,isic4.length,isic5.length,isic6.length
        ,isic7.length,isic8.length,isic9.length,isic10.length,isic11.length,isic12.length,isic13.length
        ,isic14.length,isic15.length,isic16.length,isic17.length,isic18.length,isic19.length,isic20.length];

        var tmp = {name: grade.name, type: 'bar', stack: 'single', data: isicarray};
        gradedata.push(tmp);
  
    });

    var xaxis = ['เกษตรกรรม การป่าไม้ และการประมง','การทำเหมืองแร่และเหมืองหิน','การผลิต','ไฟฟ้า ก๊าซ ไอน้ำ และระบบปรับอากาศ','การจัดหาน้ำ การจัดการ และการบำบัดน้ำเสีย ของเสีย และสิ่งปฏิกูล',
'การขายส่งและการขายปลีก การซ่อมยานยนต์และจักรยานยนต์','การขนส่งและสถานที่เก็บสินค้า','ที่พักแรมและบริการด้านอาหาร','ข้อมูลข่าวสารและการสื่อสาร','กิจกรรมทางการเงินและการประกันภัย','กิจกรรมอสังหาริมทรัพย์',
'กิจกรรมทางวิชาชีพ วิทยาศาสตร์ และเทคนิค','กิจกรรมการบริหารและการบริการสนับสนุน','การบริหารราชการ การป้องกันประเทศ และการประกันสังคมภาคบังคับ','การศึกษา','กิจกรรมด้านสุขภาพและงานสังคมสงเคราะห์',
'ศิลปะ ความบันเทิง และนันทนาการ','กิจกรรมบริการด้านอื่นๆ','กิจกรรมการจ้างงานในครัวเรือนส่วนบุคคล กิจกรรมการผลิตสินค้าและบริการที่ทำขึ้นเองเพื่อใช้ในครัวเรือน ซึ่งไม่สามารถจำแนกกิจกรรมได้อย่างชัดเจน','กิจกรรมขององค์การระหว่างประเทศและภาคีสมาชิก']

    genBar(xaxis ,gradedata , 'gradebyisic');
}

function callGenPolarStackByIsic(data){
    var gradedata = []
    data.grades.forEach(function (grade,index) {
        var isicarray = [];
        var isic1 = data.projectgrades.filter(x => x.isiccode == 1 && x.grade == grade.name); 
        var isic2 = data.projectgrades.filter(x => x.isiccode == 2 && x.grade == grade.name); 
        var isic3 = data.projectgrades.filter(x => x.isiccode == 3 && x.grade == grade.name); 
        var isic4 = data.projectgrades.filter(x => x.isiccode == 4 && x.grade == grade.name); 
        var isic5 = data.projectgrades.filter(x => x.isiccode == 5 && x.grade == grade.name); 
        var isic6 = data.projectgrades.filter(x => x.isiccode == 6 && x.grade == grade.name); 
        var isic7 = data.projectgrades.filter(x => x.isiccode == 7 && x.grade == grade.name); 
        var isic8 = data.projectgrades.filter(x => x.isiccode == 8 && x.grade == grade.name); 
        var isic9 = data.projectgrades.filter(x => x.isiccode == 9 && x.grade == grade.name); 
        var isic10 = data.projectgrades.filter(x => x.isiccode == 10 && x.grade == grade.name); 
        var isic11 = data.projectgrades.filter(x => x.isiccode == 11 && x.grade == grade.name); 
        var isic12 = data.projectgrades.filter(x => x.isiccode == 12 && x.grade == grade.name); 
        var isic13 = data.projectgrades.filter(x => x.isiccode == 13 && x.grade == grade.name); 
        var isic14 = data.projectgrades.filter(x => x.isiccode == 14 && x.grade == grade.name);
        var isic15 = data.projectgrades.filter(x => x.isiccode == 15 && x.grade == grade.name);
        var isic16 = data.projectgrades.filter(x => x.isiccode == 16 && x.grade == grade.name);
        var isic17 = data.projectgrades.filter(x => x.isiccode == 17 && x.grade == grade.name);
        var isic18 = data.projectgrades.filter(x => x.isiccode == 18 && x.grade == grade.name);
        var isic19 = data.projectgrades.filter(x => x.isiccode == 19 && x.grade == grade.name);
        var isic20 = data.projectgrades.filter(x => x.isiccode == 20 && x.grade == grade.name);

        isicarray = [isic1.length,isic2.length,isic3.length,isic4.length,isic5.length,isic6.length
        ,isic7.length,isic8.length,isic9.length,isic10.length,isic11.length,isic12.length,isic13.length
        ,isic14.length,isic15.length,isic16.length,isic17.length,isic18.length,isic19.length,isic20.length];

        var tmp = {name: grade.name, type: 'bar', stack: 'a', data: isicarray,coordinateSystem: 'polar',emphasis: { focus: 'series'}};
        gradedata.push(tmp);
  
    });

    var xaxis = ['เกษตรกรรม การป่าไม้ และการประมง','การทำเหมืองแร่และเหมืองหิน','การผลิต','ไฟฟ้า ก๊าซ ไอน้ำ และระบบปรับอากาศ','การจัดหาน้ำ การจัดการ และการบำบัดน้ำเสีย ของเสีย และสิ่งปฏิกูล',
'การขายส่งและการขายปลีก การซ่อมยานยนต์และจักรยานยนต์','การขนส่งและสถานที่เก็บสินค้า','ที่พักแรมและบริการด้านอาหาร','ข้อมูลข่าวสารและการสื่อสาร','กิจกรรมทางการเงินและการประกันภัย','กิจกรรมอสังหาริมทรัพย์',
'กิจกรรมทางวิชาชีพ วิทยาศาสตร์ และเทคนิค','กิจกรรมการบริหารและการบริการสนับสนุน','การบริหารราชการ การป้องกันประเทศ และการประกันสังคมภาคบังคับ','การศึกษา','กิจกรรมด้านสุขภาพและงานสังคมสงเคราะห์',
'ศิลปะ ความบันเทิง และนันทนาการ','กิจกรรมบริการด้านอื่นๆ','กิจกรรมการจ้างงานในครัวเรือนส่วนบุคคล กิจกรรมการผลิตสินค้าและบริการที่ทำขึ้นเองเพื่อใช้ในครัวเรือน ซึ่งไม่สามารถจำแนกกิจกรรมได้อย่างชัดเจน','กิจกรรมขององค์การระหว่างประเทศและภาคีสมาชิก']

    genPolarStack(xaxis ,gradedata , 'gradebyisic');
}

function topLeftChart(_percent,grade){
    if(isNaN(_percent)) {
        _percent = 0;
    }
    if( typeof grade === 'undefined' ) {
        grade = "";
    }
    var percent = parseInt(_percent);
    var percenlabel = percent + ' / ' + grade;
    if(percent == 0){
        percenlabel = "";
    }
    var dom = document.getElementById('myChart');
    var echart = echarts.init(dom);
    echart.clear();
    var option = null;
    option = {
        series: [
            {
                name: 'เกรด',
                type: 'pie',
                hoverAnimation: false,
                animation: true,
                radius: ['80%', '100%'],
                avoidLabelOverlap: false,
                label: {
                    show: true,
                    position: 'center',
                    fontSize : 26,
                    color: '#000000'
                },
                emphasis: {
                    label: {
                        show: true,
                        // fontSize: '16',
                        fontWeight: 'bold'
                    }
                },
                labelLine: {
                    show: false
                },
                data: [
                    {value: 100-percent, name: '',},
                    {value: percent, name:   percenlabel},
    
                ],
                 color: ['#bbbbbb', '#4688ce'],
                 silent: true,
            }
        ]
    };

    if (option && typeof option === "object") {
        echart.setOption(option, true);
    }
}

function genRadar(charttype,indicator,color,legend,data,eleid){
    var dom = document.getElementById(eleid);
    var echart = echarts.init(dom);
    echart.clear();
    var option = null;
    option = {
        color: color,
        textStyle: {
            fontFamily: 'Kanit',
        },
        tooltip: {},
        legend: {
           top: -5,
           type: 'scroll',
           orient: 'horizontal',
           fontSize: 8,
           legend
        },
        radar: {
            // shape: 'circle',
            name: {
                textStyle: {
                    color: '#fff',
                    backgroundColor: '#999',
                    borderRadius: 3,
                },
                textStyle: {
                    fontSize: 16,
                    color: "#000000"
                },
            },
            indicator: indicator
        },
        series: [{
            type: charttype,
            areaStyle: {normal: {}},
            data: data
        }]
    };

    if (option && typeof option === "object") {
        echart.setOption(option, true);
    }
}


 function genBar(xaxis,data,eleid){
    var dom = document.getElementById(eleid);
    var echart = echarts.init(dom);
    echart.clear();
    var option = null;
    option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {            // 
                type: 'shadow'        // 'line' | 'shadow'
            }
        },
        legend: {
            top: -5,
            type: 'scroll',
            data: ['AAA', 'AA', 'A', 'BBB', 'BB', 'B', 'CCC', 'CC', 'C', 'D', 'E'],
            selected:{'AAA':true, 'AA':true,'A':true, 'BBB':true,'BB':true,'B':true, 'CCC':true,'CC':true, 'C':true,'D':true, 'E':true},
            
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
                data: xaxis,
            }
        ],
        yAxis: [
            {
                type: 'value'
            }
        ],
        series: data
    };

    if (option && typeof option === "object") {
        echart.setOption(option, true);
    }
}

function genPolarStack(xaxis,data,eleid){
    var dom = document.getElementById(eleid);
    var echart = echarts.init(dom);
    echart.clear();
    var option = null;
    option = {
        angleAxis: 
        {
            type: 'category',
            data: xaxis,
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {            // 
                type: 'line'        // 'line' | 'shadow'
            }
        },
        radiusAxis: {
        },
        polar: {
        },
        legend: {
            top: -5,
            type: 'scroll',
            data: ['AAA', 'AA', 'A', 'BBB', 'BB', 'B', 'CCC', 'CC', 'C', 'D', 'E'],
            selected:{'AAA':true, 'AA':true,'A':true, 'BBB':true,'BB':true,'B':true, 'CCC':true,'CC':true, 'C':true,'D':true, 'E':true},
        },
        series: data
    };

    if (option && typeof option === "object") {
        echart.setOption(option, true);
    }
}

function genNumProject(charttype,data,legend,text,sub,eleid,legendalign){
    var dom = document.getElementById(eleid);
    var echart = echarts.init(dom);
    echart.clear();
    var option = null;

    if(charttype == 'donut'){
        option = {
            textStyle: {
                fontFamily: 'Kanit',
            },
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b}: {c} ({d}%)'
            },
            legend: {
                bottom: 10,
                type: 'scroll',
                orient: 'horizontal',
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
    }else if(charttype == 'bar'){
        option = {
            textStyle: {
                fontFamily: 'Kanit',
            },
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b}: {c}'
            },
            legend: {
                bottom: 10,
                orient: 'horizontal',
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
            xAxis: {
                type: 'category',
                data: legend
            },
            yAxis: {
                type: 'value'
            },
            series: [
                {
                    name: 'รายละเอียด',
                    type: 'bar',
                    data: data,
                }
            ]
        };

    }else if(charttype == 'pie'){
        option = {
            textStyle: {
                fontFamily: 'Kanit',
            },
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b}: {c} ({d}%)'
            },
            legend: {
                bottom: 10,
                type: 'scroll',
                orient: 'horizontal',
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
    }

    if (option && typeof option === "object") {
        echart.setOption(option, true);
    }  
}

$(document).on('click', '#download_numproject', function(e) {
    downloadNumProject().then(data => {
        location.href = data;
    }).catch(error => {})
});

function downloadNumProject() {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `${route.url}/api/adminreport/download/numproject`,
            type: 'GET',
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

$(document).on('click', '#select_gradebypillar_pie', function(e) {
    callGenRadarGradeByPillar(globaldata);
});

$(document).on('click', '#select_gradebypillar_bar', function(e) {
    callBarGradeByPillar(globaldata);
});

$(document).on('click', '#select_gradebypillar_polar', function(e) {
    callPolarStackGradeByPillar(globaldata);
});

$(document).on('click', '#select_gradebybusinesssize_pie', function(e) {
    callGenRadarByBusinessSize(globaldata);
});

$(document).on('click', '#select_gradebybusinesssize_bar', function(e) {
    callGenBarByBusinessSize(globaldata);
});

$(document).on('click', '#select_gradebybusinesssize_polar', function(e) {
    callGenPolarStackByBusinessSize(globaldata);
});

$(document).on('click', '#select_gradebysector_pie', function(e) {
    callGenRadarBySector(globaldata);
});

$(document).on('click', '#select_gradebysector_bar', function(e) {
    callGenBarBySector(globaldata);
});

$(document).on('click', '#select_gradebysector_polar', function(e) {
    callGenPolarStackBySector(globaldata);
});

$(document).on('click', '#select_gradebybusinesstype_pie', function(e) {
    callGenRadarByBusinessType(globaldata);
});

$(document).on('click', '#select_gradebybusinesstype_bar', function(e) {
    callGenBarByBusinessType(globaldata);
});

$(document).on('click', '#select_gradebybusinesstype_polar', function(e) {
    callGenPolarStackByBusinessType(globaldata);
});

$(document).on('click', '#select_gradebyindustry_pie', function(e) {
    callGenRadarByIndustryGroup(globaldata);
});

$(document).on('click', '#select_gradebyindustry_bar', function(e) {
    callGenBarByIndustryGroup(globaldata);
});

$(document).on('click', '#select_gradebyindustry_polar', function(e) {
    callGenPolarStackByIndustryGroup(globaldata);
});

$(document).on('click', '#select_gradebyisic_pie', function(e) {
    callGenRadarByIsic(globaldata);
});

$(document).on('click', '#select_gradebyisic_bar', function(e) {
    callGenBarByIsic(globaldata);
});

$(document).on('click', '#select_gradebyisic_polar', function(e) {
    callGenPolarStackByIsic(globaldata);
});

$(document).on('click', '#project_industry_pie', function(e) {
    genNumProject('pie',industrygroupdata,industrygrouplegend,'กลุ่มอุตสาหกรรม ' + $('#currentyear').html(),'จำนวนโครงการตามกลุ่มอุตสาหกรรม ' + $('#currentyear').html(),'industrygroup_chart','center');
});

$(document).on('click', '#project_industry_donut', function(e) {
    genNumProject('donut',industrygroupdata,industrygrouplegend,'กลุ่มอุตสาหกรรม ' + $('#currentyear').html(),'จำนวนโครงการตามกลุ่มอุตสาหกรรม ' + $('#currentyear').html(),'industrygroup_chart','center');
}); 


$(document).on('click', '#project_industry_bar', function(e) {
    var data = [
        {
            value: industrygroupdata[0]['value'],
            itemStyle: {color: '#c23531'},  //Next-generation Automative
        },
        {
            value: industrygroupdata[1]['value'],
            itemStyle: {color: '#2f4554'},  //Smart Electronics
        },
        {
            value: industrygroupdata[2]['value'],
            itemStyle: {color: '#61a0a8'},  //Affluent
        },{
            value: industrygroupdata[3]['value'],
            itemStyle: {color: '#d48265'},  //Agriculture
        },
        {
            value: industrygroupdata[4]['value'],
            itemStyle: {color: '#91c7ae'},  //Food
        },
        {
            value: industrygroupdata[5]['value'],
            itemStyle: {color: '#749f83'},  //Robotic
        },{
            value: industrygroupdata[6]['value'],
            itemStyle: {color: '#ca8622'},  //Aviation
        },
        {
            value: industrygroupdata[7]['value'],
            itemStyle: {color: '#bda29a'},  //Biofuel
        },
        {
            value: industrygroupdata[8]['value'],
            itemStyle: {color: '#6e7074'},  //Digital
        },
        {
            value: industrygroupdata[9]['value'],
            itemStyle: {color: '#546570'},  //Medical
        },
        {
            value: industrygroupdata[10]['value'],
            itemStyle: {color: '#c4ccd3'},  //Defense
        },
        {
            value: industrygroupdata[11]['value'],
            itemStyle: {color: '#c23531'},  //Education
        }
    ]
    genNumProject('bar',data,industrygrouplegend,'กลุ่มอุตสาหกรรม ' + $('#currentyear').html(),'จำนวนโครงการตามกลุ่มอุตสาหกรรม ' + $('#currentyear').html(),'industrygroup_chart','center');
}); 

$(document).on('click', '#project_objective_pie', function(e) {
    genNumProject('pie',objectivedata,objectivelegend,'วัตถุประสงค์ของการขอรับการประเมิน ' + $('#currentyear').html(),'วัตถุประสงค์ของการขอรับการประเมิน ' + $('#currentyear').html(),'financial_chart','center');
});

$(document).on('click', '#project_objective_donut', function(e) {
    genNumProject('donut',objectivedata,objectivelegend,'วัตถุประสงค์ของการขอรับการประเมิน ' + $('#currentyear').html(),'วัตถุประสงค์ของการขอรับการประเมิน ' + $('#currentyear').html(),'financial_chart','center');
});

$(document).on('click', '#project_objective_bar', function(e) {
    var data = [
        {
            value: objectivedata[0]['value'],
            itemStyle: {color: '#c23531'},  //ด้านการเงิน
        },
        {
            value: objectivedata[1]['value'],
            itemStyle: {color: '#2f4554'},  //ไม่ใช่ด้านการเงิน
        },
        {
            value: objectivedata[2]['value'],
            itemStyle: {color: '#61a0a8'},  //ด้านการเงินและไม่ใช่ด้านการเงิน
        }
    ]
    genNumProject('bar',data,objectivelegend,'วัตถุประสงค์ของการขอรับการประเมิน ' + $('#currentyear').html(),'วัตถุประสงค์ของการขอรับการประเมิน ' + $('#currentyear').html(),'financial_chart','center');
}); 



  
