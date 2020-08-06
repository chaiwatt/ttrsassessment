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
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">รายการความก้าวหน้า</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> รายงาน</a>
                    <span class="breadcrumb-item active">รายการความก้าวหน้า</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">ความก้าวหน้าการประเมิน</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="progress_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">ปฎิทินนัดหมาย</h6>
                        <div class="header-elements">
                            <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="fullcalendar"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">สถานะโครงการ</h6>
                        <div class="header-elements">
                            <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                {{-- <i class="icon-calendar3 mr-2"></i> --}}
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th>วันที่ขอประเมิน</th> 
                                        <th>เลขที่โครงการ</th> 
                                        <th>ชื่อโครงการ</th> 
                                        <th >ความก้าวหน้าการประเมิน</th>    
                                        <th class="text-right">สถานะ</th> 
                                                                  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($businessplans as $key => $businessplan)
                                    <tr>    
                                        <td> {{$businessplan->createddateth}} </td> 
                                        <td> {{$businessplan->code}} </td> 
                                        <td> {{$businessplan->minitbp->project}} </td> 
                                        <td>
                                            <div class="progress" style="height: 1.375rem;">
                                                <div class="progress-bar bg-success" style="width: {{$businessplan->businessplanstatus->progress}}%">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </div>
                                        </td> 
                                        <td class="text-right"> <span class="badge badge-flat border-warning text-warning-400 rounded-0">{{$businessplan->businessplanstatus->name}}</span></td>                                       
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
    option = {
        tooltip: {
            formatter: '{a} <br/>{b} : {c}%'
        },
        series: [
            {
                name: 'gauge',
                type: 'gauge',
                detail: {formatter: '{value}%'},
                data: [{value: "{{@$businessplans[0]->businessplanstatus->progress}}", name: "{{@$businessplans[0]->businessplanstatus->name}}"}]
            }
        ]
    };


    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }

    $( document ).ready(function() {
        console.log('events');
            var events = [];
            getEvent().then(data => {
                console.log(data);
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
        console.log('what');
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

</script>
@stop
