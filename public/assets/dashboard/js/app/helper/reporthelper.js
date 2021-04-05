        
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
                        editable: true,
                        eventLimit: true,
                        eventClick: function(e) {
                            getEvent(e.event.id).then(data => {
                                $('#title').val('นัดหมายการประชุม โครงการ' + data.eventcalendar.fulltbp.minitbp['project']);
                                $('#eventdate').val(data.eventcalendar.eventdateth);
                                $('#starttime').val(data.eventcalendar.starttime);
                                $('#endtime').val(data.eventcalendar.endtime);
                                $('#placeroom').val(data.eventcalendar.place + ' ห้อง' + data.eventcalendar.room);
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

            getChartData().then(data => {
                 participatedata = [
                    {value: data.numprojects['minitbp'], name: 'Mimi TBP'},
                    {value: data.numprojects['fulltbp'], name: 'Full TBP'},
                    {value: data.numprojects['finish'], name: 'ประเมินสำเร็จ'},
                ]
                if(data.numprojects['minitbp'] != 0 || data.numprojects['fulltbp'] != 0 || data.numprojects['finish'] != 0){
                    genDonutchart(participatedata,participatelegend,'จำนวนโครงการปี ' + $('#currentyear').html(),'จำนวนโครงการปี ' + $('#currentyear').html(),'participate_chart','center');
                }
    
                  gradedata = [
                    {value: data.projectgrades['AAA'], name: 'AAA'},
                    {value: data.projectgrades['AA'], name: 'AA'},
                    {value: data.projectgrades['A'], name: 'A'},
                    {value: data.projectgrades['BBB'], name: 'BBB'},
                    {value: data.projectgrades['BB'], name: 'BB'},
                    {value: data.projectgrades['B'], name: 'B'},
                    {value: data.projectgrades['CCC'], name: 'CCC'},
                    {value: data.projectgrades['CC'], name: 'CC'},
                    {value: data.projectgrades['C'], name: 'C'},
                    {value: data.projectgrades['D'], name: 'D'}
                ]

                if(data.projectgrades['AAA'] !=0 || data.projectgrades['AA'] !=0 ||data.projectgrades['A'] !=0 ||data.projectgrades['BBB'] !=0 ||data.projectgrades['BB'] !=0 ||
                data.projectgrades['B'] !=0 || data.projectgrades['CCC'] !=0 ||data.projectgrades['CC'] !=0 || data.projectgrades['C'] !=0 || data.projectgrades['D'] !=0){
                    genDonutchart(gradedata,dradelegend,'เกรดการประเมิน','จำนวนโครงการตามเกรดการประเมิน','grade_chart','center');
                }        

                industrygroupdata = [
                    {value: data.projectindustries['automotive'], name: 'Next-generation Automotive'},
                    {value: data.projectindustries['smartelectronic'], name: 'Smart Electronics'},
                    {value: data.projectindustries['affluent'], name: 'Affluent, Medical and Wellness Tourism'},
                    {value: data.projectindustries['agriculture'], name: 'Agriculture and Biotechnology'},
                    {value: data.projectindustries['food'], name: 'Food for the Future'},
                    {value: data.projectindustries['robotic'], name: 'Robotics'},
                    {value: data.projectindustries['aviation'], name: 'Aviation and Logistics'},
                    {value: data.projectindustries['biofuel'], name: 'Biofuels and Biochemicals'},
                    {value: data.projectindustries['digital'], name: 'Digital'},
                    {value: data.projectindustries['medical'], name: 'Medical Hub'},
                    {value: data.projectindustries['defense'], name: 'Defense'},
                    {value: data.projectindustries['education'], name: 'Education and Skill Development'},
                    {value: data.projectindustries['other'], name: 'อื่น'},
                ]

                if(data.projectindustries['automotive'] != 0 || data.projectindustries['smartelectronic'] != 0 || data.projectindustries['affluent'] != 0 ||
                data.projectindustries['agriculture'] != 0 || data.projectindustries['food'] != 0 || data.projectindustries['robotic'] != 0 ||
                data.projectindustries['aviation'] != 0 || data.projectindustries['biofuel'] != 0 || data.projectindustries['digital'] != 0 || 
                data.projectindustries['medical'] != 0 || data.projectindustries['defense'] != 0 || data.projectindustries['education'] != 0 || data.projectindustries['other'] != 0){
                    genDonutchart(industrygroupdata,industrygrouplegend,'กลุ่มอุตสาหกรรม','จำนวนโครงการตามกลุ่มอุตสาหกรรม','industrygroup_chart','center');
                }
            
                

                objectivedata = [
                    {value: data.objectives['finance'], name: 'ด้านการเงิน'},
                    {value: data.objectives['nonfinance'], name: 'ไม่ใช่ด้านการเงิน'},
                    {value: data.objectives['bothobjecttive'], name: 'ด้านการเงินและไม่ใช่ด้านการเงิน'}
                ]               

                if(data.objectives['finance'] != 0 || data.objectives['nonfinance'] != 0 || data.objectives['bothobjecttive'] != 0){
                    genDonutchart(objectivedata,objectivelegend,'วัตถุประสงค์ของการขอรับการประเมิน','วัตถุประสงค์ของการขอรับการประเมิน','financial_chart','center');
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

