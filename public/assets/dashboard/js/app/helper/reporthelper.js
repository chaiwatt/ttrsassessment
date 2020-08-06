        
        $( document ).ready(function() {
            var events = [];
            getEvent().then(data => {
                console.log(data);
                data.forEach(function (event,index) {
                    events.push({
                        title: event["summary"],
                        start: event["start"]
                    });
                });
                // console.log(events);
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
                        eventLimit: true
                    }).render();
                }
            }).catch(error => {})
        });

    function getEvent() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: `${route.url}/dashboard/admin/report/getevent`,
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
        {value: 10, name: 'เกรดA'},
        {value: 15, name: 'เกรดB'},
        {value: 12, name: 'เกรดC'},
        {value: 5, name: 'เกรดD'},
    ]
    var  dradelegend = [
        'เกรดA',
        'เกรดB',
        'เกรดC',
        'เกรดD'
    ]

    var  participatedata = [
        {value: 335, name: 'ยื่นขอ'},
        {value: 310, name: 'mimi tbp'},
        {value: 234, name: 'full tbp'},
        {value: 135, name: 'ประเมิน'},
    ]
    var  participatelegend = [
        'ยื่นขอ',
        'mimi tbp',
        'full tbp',
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
    genDonutchart(financialdata,financiallegend,'จุดประสงค์ด้านการประเมิน','จุดประสงค์ด้านการประเมิน','financial_chart','center');
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
                axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                    type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            legend: {
                data: [ 'ขอประเมิน', 'mini tbp', 'full tbp', 'รับการประเมิน', 'ด้านการเงิน', 'ไม่ใช่ด้านการเงิน', 'เกรด A', 'เกรด B', 'เกรด C', 'เกรด D']
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
                    name: 'mini tbp',
                    type: 'bar',
                    stack: 'group1',
                    data: [220, 182, 191]
                },
                {
                    name: 'full tbp',
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