        

import * as Attendee from './eventcalendarattendee.js';
       var  participatedata = null;
       var  gradedata = null;
       var  industrygroupdata = null;
       var  objectivedata = null;
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
                                $('#eventdate').val(data.eventcalendar.eventdateth);
                                $('#starttime').val(data.eventcalendar.starttime);
                                $('#endtime').val(data.eventcalendar.endtime);
                                $('#eventtype').val(data.eventcalendar.calendartype['name']);
                                $('#detail').val(data.eventcalendar.summary);
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

            getRadarChartData().then(data => {


                callGenRadarGradeByPillar(data);
                callGenRadarByBusinessSize(data);
                callGenRadarBySector(data);
                callGenRadarByBusinessType(data);
                callGenRadarByIndustryGroup(data);
                callGenRadarByIsic(data);
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
   Attendee.updateJoinEvent($(this).data('id'),status).then(data => {
       $("#spinicon").attr("hidden",true);
      
   }).catch(error => {})
});


$(document).on('change', '#attendevent', function(e) {
    var status = 1
    if($(this).val()==2){
        status =0;
    }        
   $("#spinicon").attr("hidden",false);
   Attendee.updateJoinEvent($('#attendeventid').val(),status).then(data => {
       $("#spinicon").attr("hidden",true);
      
   }).catch(error => {})
});

$(document).on('click', '#btn_modal_get_calendar', function(e) {
    window.location.replace(`${route.url}/dashboard/admin/report`);
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




// callGenRadarBySector();
// callGenRadarByIndustryGroup();
// callGenRadarByBusinessSize();
// callGenRadarByBusinessType();
// callGenRadarByIsic();


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
        { name: 'Business Prospet', max: maxval}        
    ];
    var color = [ '#c23531', '#2f4554', '#61a0a8', '#d48265', '#91c7ae', '#749f83', '#ca8622','#bda29a', '#6e7074', '#546570','#c4ccd3'];
    genRadar('radar',indicator,color,datagradebysector,gradedata,'gradebypillar');
}

function callGenRadarByBusinessSize(data){
console.log(data.projectgrades);
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
        { name: 'micro', max: maxval},
        { name: 'S', max: maxval},
        { name: 'M', max: maxval},
        { name: 'L', max: maxval}
    ];

    var color = [ '#c23531', '#2f4554', '#61a0a8', '#d48265', '#91c7ae', '#749f83', '#ca8622','#bda29a', '#6e7074', '#546570','#c4ccd3'];
    genRadar('radar',indicator,color,datagradebysector,gradedata,'gradebybusinesssize');
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
        { name: 'บริษัทมหาชน', max: maxval},
        { name: 'บริษัทจำกัด', max: maxval},
        { name: 'ห้างหุ้นส่วนจำกัด', max: maxval},
        { name: 'ห้างหุ้นส่วนสามัญ', max: maxval},
        { name: 'กิจการเจ้าของคนเดียว', max: maxval},
        { name: 'องค์กรธุรกิจจัดตั้ง หรือจดทะเบียนภายใต้กฎหมายเฉพาะ', max: maxval}
    ];

    var color = [ '#c23531', '#2f4554', '#61a0a8', '#d48265', '#91c7ae', '#749f83', '#ca8622','#bda29a', '#6e7074', '#546570','#c4ccd3'];
    genRadar('radar',indicator,color,datagradebysector,gradedata,'gradebybusinesstype');
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

//  genRadar('radar','scorebypillar');
//  genRadar('radar','gradebyindustry');
//  genRadar('radar','gradebybusinesssize');
//  genRadar('radar','gradebysector');
//  genRadar('radar','gradebybusinesstype');

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
           bottom: 0,
           type: 'scroll',
           orient: 'horizontal',
           legend
        },
        radar: {
            // shape: 'circle',
            name: {
                textStyle: {
                    color: '#fff',
                    backgroundColor: '#999',
                    borderRadius: 3,
                    // padding: [3, 5]
                },
                textStyle: {
                    fontSize: 16,
                    color: "#000000"
                },
            },
            indicator: indicator
        },
        series: [{
            // name: '预算 vs 开销（Budget vs spending）',
            type: charttype,
            areaStyle: {normal: {}},
            data: data
        }]
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

