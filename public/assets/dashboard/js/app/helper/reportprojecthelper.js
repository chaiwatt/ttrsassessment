        
    var globalid = null;
    $(function() {
        getProject('').then(data => {
            var html ='';
            data.fulltbps.forEach(function (fulltbp,index) {
                var status = 'success';
                if(fulltbp.status != 3){
                    status = 'grey';
                }
                html += `<tr > 
                <td> ${fulltbp.minitbp.businessplan['code']} </td> 
                <td>  
                    <a href="${route.url}/dashboard/admin/report/detail/view/${fulltbp.minitbp.businessplan.company['id']}" class="text-info" target="_blank">${fulltbp.minitbp['project']}</a> 
                </td>                                            
                <td>
                    <span class="badge badge-flat border-${status}-600 text-${status}-600">${fulltbp.minitbp.businessplan.businessplanstatus['name']}</span> 
                </td>                                             
                </tr>`
                });
            $("#report_project_wrapper").html(html);

            var  legend = [
                'Mimi TBP',
                'Full TBP',
                'เสร็จสิ้น'
            ]
            var  data = [
                {value: data.minitbps.length, name: 'Mimi TBP'},
                {value: data.fulltbps.length, name: 'Full TBP'},
                {value: data.completes.length, name: 'เสร็จสิ้น'},
            ]
            
            genDonutchart(data,legend,'โครงการต่อการยื่น','จำนวนโครงการต่อการยื่น','reportproject_chart','center');
           
        }).catch(error => {})
    });



    
    // var  data = [
    //     {value: 335, name: 'ยานยนต์สมัยใหม่'},
    //     {value: 310, name: 'อิเล็กทรอนิกส์อัจฉริยะ'},
    //     {value: 234, name: 'ท่องเที่ยว'},
    //     {value: 135, name: 'การเกษตรและเทคโนโลยีชีวภาพ'},
    //     {value: 1548, name: 'แปรรูปอาหาร'},
    //     {value: 500, name: 'หุ่นยนต์เพื่อการอุตสาหกรรม'}
    // ]
    // var  legend = [
    //     'ยานยนต์สมัยใหม่',
    //     'อิเล็กทรอนิกส์อัจฉริยะ',
    //     'ท่องเที่ยว',
    //     'การเกษตรและเทคโนโลยีชีวภาพ',
    //     'แปรรูปอาหาร',
    //     'หุ่นยนต์เพื่อการอุตสาหกรรม'
    // ]






    // var data = [];
    // for (var i=0; i<3; i++) {
    //     var aa = 'ยื่นขอ';
    //     if(i==1){
    //         aa = 'Mimi TBP';
    //     }else if(i==2){
    //         aa = 'Full TBP';
    //     }else if(i==3){
    //         aa = 'ประเมิน';
    //     }
    //     data[i] = {
    //         value: i+1,
    //         name: aa,
    //     };
    // }

    // genBarchart();
    function genDonutchart(data,legend,text,sub,eleid,legendalign){
        var dom = document.getElementById(eleid);
        var donutchart = echarts.init(dom);
        var app = {};
        var option = null;
        option = {
            tooltip: {
                textStyle: {
                    fontFamily: 'Kanit',
                },
                trigger: 'item',
                formatter: '{a} <br/>{b}: {c} ({d}%)'
            },
            legend: {
                textStyle: {
                    fontFamily: 'Kanit',
                    fontSize: 14
                },
                orient: 'vertical',
                left: 10,
                data: legend,
            },
            title: {
                text: text,
                subtext: sub,
                left: legendalign,
                textStyle: {
                    fontFamily: 'Kanit',
                    fontSize: 17,
                    fontWeight: 500
                },
                subtextStyle: {
                    fontFamily: 'Kanit',
                    fontSize: 14
                }
            },
            series: [
                {
                    name: 'รายละเอียด',
                    type: 'pie',
                    radius: ['50%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                        textStyle: {
                            fontFamily: 'Kanit',
                        },
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        label: {
                            textStyle: {
                                fontFamily: 'Kanit',
                            },
                            show: true,
                            fontSize: '30',
                            // formatter: '{b}: {c} \n({d}%)'
                            formatter: '{b} \n{c} โครงการ'
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

function getProject(range){
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `${route.url}/api/report/chart/getproject`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
                range : range
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