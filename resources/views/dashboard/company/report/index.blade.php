@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/daygrid/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/timegrid/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/list/main.css')}}">

@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
            <h4> <span class="font-weight-semibold">
                @if (Empty(Auth::user()->company->name))
                        รายงาน : ยังไม่ได้ตั้งค่า
                    @else
                        {{Auth::user()->company->name}}
                @endif
            </span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            @if (Auth::user()->company->saveprofile == 0)
                <div class="header-elements d-none">
                    <a href="{{route('setting.profile.user.edit',['userid' => Auth::user()->id])}}" class="btn btn-labeled bg-warning" ><span class="blink">ตั้งค่าโพรไฟล์ ก่อนขอรับการประเมิน</span></a>
                </div>
            @endif
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> แดชบอร์ด</a>
                    <span class="breadcrumb-item active">หน้าแรก</span>
                </div>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">
        <div id="alertmessage_wrapper">
            @foreach ($alertmessages->reverse() as $alertmessage)
                <div class="alert alert-info alert-styled-left alert-dismissible">
                    <button type="button" data-id ="{{$alertmessage->id}}" class="close alertmessage" data-dismiss="alert"><span>&times;</span></button>{!!$alertmessage->detail!!}
                </div>
            @endforeach
        </div>
        @if (@$businessplans->first()->business_plan_status_id > 2)
            @if (@$businessplans->first()->business_plan_status_id >=  9)
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card bg-teal-400">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h1 class="font-weight-semibold mb-0">{{@$businessplans->first()->minitbp->fulltbp->projectgrade->percent}}</h1>
                                </div>
                                <div>
                                    ผลคะแนนการประเมิน
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div id="members-online"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card bg-blue-400">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h1 class="font-weight-semibold mb-0">{{@$businessplans->first()->minitbp->fulltbp->projectgrade->grade}}</h1>
                                </div>
                                <div>
                                    ระดับเกรดการประเมิน
                                </div>
                            </div>
                            <div id="today-revenue"></div>
                        </div>
                    </div>
                </div>
            @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">โครงการ</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                <span></span>
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                    

        
                        <div class="table-responsive">
                            <table class="table table-striped" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th>ชื่อโครงการ</th> 
                                        <th>เลขที่โครงการ</th> 
                                        <th >ความก้าวหน้าการประเมิน</th>    
                                        <th class="text-right">สถานะ</th>                                                                  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($businessplans as $key => $businessplan)
                                    <tr>    
                                        <td> 
                                            @if ($businessplan->business_plan_status_id < 4)
                                                    <a class="text-info" href="{{route('dashboard.company.project.minitbp.edit',['id' => $businessplan->minitbp->id])}}" class="breadcrumb-item">{{$businessplan->minitbp->project}} </a>
                                                @elseif($businessplan->business_plan_status_id >= 4)
                                                    @if ($businessplan->minitbp->fulltbp->canceldate != null)
                                                            {{$businessplan->minitbp->project}} <span class="badge badge-flat border-danger text-danger-400 rounded-0">โครงการถูกยกเลิก</span>
                                                        @else
                                                            <a class="text-info" href="{{route('dashboard.company.project.fulltbp.edit',['id' => $businessplan->minitbp->fulltbp->id])}}" class="breadcrumb-item">{{$businessplan->minitbp->project}} </a>
                                                    @endif       
                                                @else
                                                    {{$businessplan->minitbp->project}} 
                                            @endif
                                        </td> 
                                        <td> {{$businessplan->code}} </td> 
                                        <td>
                                            <div class="progress" style="height: 1.375rem;">
                                                <div class="progress-bar bg-success" style="width: {{$businessplan->businessplanstatus->progress}}%">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </div>
                                        </td> 
                                        <td class="text-right"> <span class="badge badge-flat border-success text-success-400 rounded-0">{{$businessplan->businessplanstatus->name}}</span></td>                                       
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>      
                        </div>
                    </div>
                </div>
            <!-- /striped rows -->
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">ความก้าวหน้าโครงการ</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="chart-container" >
                                    <div class="chart has-fixed-height" style="margin-top:-40px; " id="progress_chart"></div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">TimeLine</h6>
                        <div class="header-elements">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>วันที่</th> 
                                        <th>รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody id="timeline_wrapper_tr">
                                    @foreach ($timelinehistories as $timelinehistory)
                                        <tr>
                                            <td> {{$timelinehistory->createdatth}} </td>                            
                                            <td> {!!$timelinehistory->details!!} </td>  
                                        </tr>
                                    @endforeach
                                </tbody>  
                            </table>   
                        </div>
                        <div class="float-right mt-2">
                            {{$timelinehistories->links()}} 
                        </div>
                         
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

            <!-- /striped rows -->
            </div>
        </div>
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/daygrid/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/timegrid/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/list/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/interaction/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/google-calendar/main.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/locales/es.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/echart/echarts.min.js')}}"></script>

<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
<script>
    var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content'),
        branchid: "{{Auth::user()->branch_id}}"
    };
    
    var dom = document.getElementById("progress_chart");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    var check = "{{@$businessplans[0]->businessplanstatus->progress}}";
    var datavalue = '0';
    if(check.length!=0){
        datavalue = check
    }

    option = {
        textStyle: {
                    fontFamily: 'Kanit',
                },
                
         series: [
             {
                 type: "gauge",
                 center: ["50%", "50%"], 
                 radius: "100%", 
                 startAngle: 200, 
                 endAngle: -20, 
                 axisLine: {
                     show: false,
                     lineStyle: { 
                         color: [
                             [ 0.5,  new echarts.graphic.LinearGradient(0, 0, 1, 0, [{
                                 offset: 1,
                                 color: "#E75F25" // 50% 
                             }, {
                                 offset: 0.8,
                                 color: "#D9452C" // 40% 
                             }], false) ], // 100% 
                              [ 0.7,  new echarts.graphic.LinearGradient(0, 0, 1, 0, [{
                                 offset: 1,
                                 color: "#FFC539" // 70% 
                             }, {
                                 offset: 0.8,
                                 color: "#FE951E" // 66% 
                             }, {
                                 offset: 0,
                                 color: "#E75F25" // 50% 
                             }], false) ],
                              [ 0.9,  new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                 offset: 1,
                                 color: "#C7DD6B" // 90% 
                             }, {
                                 offset: 0.8,
                                 color: "#FEEC49" // 86% 
                             }, {
                                 offset: 0,
                                 color: "#FFC539" // 70% 
                             }], false) ],
                             [1,  new echarts.graphic.LinearGradient(0, 0, 0, 1, [ {
                                 offset: 0.2,
                                 color: "#1CAD52" // 92% 
                             }, {
                                 offset: 0,
                                 color: "#C7DD6B" // 90% 
                             }], false) ]
                         ],
                         width: 10
                     }
                 },

                 splitLine: {
                     show: false
                 },
                 axisTick: {
                     show: false
                 },
                 axisLabel: {
                     show: false
                 },
                 pointer : { 
                     length: '45%'
                 },
                 detail: {
                     show: false
                 }
             },
             {
                 type : "gauge",
                 center: ["50%", "60%"], 
                 radius : "100%",
                 startAngle: 200,
                 endAngle: -20,
                 axisLine : {
                     show : true,
                     lineStyle : { 
                         color : [ 
                             [ 0.3, "#DA462C" ],//0-50%
                             [ 0.7, "#FF9618" ],//51%-70%
                             [ 0.9, "#FFED44" ],//70%-90%
                             [ 1,"#20AE51" ]//90%-100%
                         ],
                         width : 30
                     }
                 },
                 splitLine : { 
                     length : 30,
                     lineStyle : { 
                         width : 2
                     }
                 },
                 axisTick : { 
                      length : 20
                 },
                 axisLabel : { 
                     color : "black",
                     distance : 5 
                 },
                 detail: {
                     formatter : "{score|{value}%}",
                     offsetCenter: [0, "40%"],
                    //  backgroundColor: '#FFEC45',
                     height:30,
                     rich : {
                         score : {
                            //  color : "white",
                             fontFamily : "Kanit",
                             fontSize : 32
                         }
                     }
                 },
                data: [
                    {
                        value: datavalue, 
                        name: "{{@$businessplans[0]->businessplanstatus->name}}"
                    }
                ]
             }
         ]
     };

    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }

    $( document ).ready(function() {
            var events = [];
            getEvent().then(data => {
                data.forEach(function (event,index) {
                    events.push({
                        title: event["summary"],
                        start: event["start"]
                    });
                });
               
                var calendarBasicViewElement = document.querySelector('.fullcalendar');
                if(calendarBasicViewElement) {
                    var calendarBasicViewInit = new FullCalendar.Calendar(calendarBasicViewElement, {
                        locale: 'th',
                        plugins: ["dayGrid", "timeGrid", "list", "interaction", "googleCalendar"],
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,dayGridDay'
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
                        eventLimit: true
                    }).render();
                }
            }).catch(error => {})
        });

    $(document).on('click', '#alertmessage', function(e) {
        editTimeLineStatus($(this).data('id')).then(data => {
            data.forEach(function (timeline,index) {
                var doctype = '';
                if(timeline.message_type == 1){
                    doctype ='เอกสาร Mini TBP';
                }else if(timeline.message_type == 2){
                    doctype ='เอกสาร Mini TBP';
                }
                html += `<tr >                                        
                    <td> ${timeline.createdatth} </td>                            
                    <td> ${timeline.details} </td> 
                </tr>`
                });
            $("#timeline_wrapper_tr").html(html);
            $("#infostatus").html(infostatus);

        }).catch(error => {})
    });

    function getEvent() {
        return new Promise((resolve, reject) => {
            $.ajax({
                    url: `${route.url}/dashboard/company/report/getevent`,
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

    
    function getTimeLine(userid){
        return new Promise((resolve, reject) => {
            $.ajax({
            url: `${route.url}/dashboard/company/report/gettimeline`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
                'userid': userid
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

    function editTimeLineStatus(id){
        return new Promise((resolve, reject) => {
            $.ajax({
                url: `${route.url}/dashboard/company/report/edittimelinestatus`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
                'id': id
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

</script>
@stop
