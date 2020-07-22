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
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">รายการประเมิน Admin</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <span class="breadcrumb-item active">รายการประเมิน</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-lg-3">

                <!-- Members online -->
                <div class="card bg-teal-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">152</h3>
                            {{-- <span class="badge bg-teal-800 badge-pill align-self-center ml-auto">+53,6%</span> --}}
                        </div>
                        
                        <div>
                            ผ่านการประเมิน
                            {{-- <div class="font-size-sm opacity-75">489 avg</div> --}}
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div id="members-online"></div>
                    </div>
                </div>
                <!-- /members online -->

            </div>

            <div class="col-lg-3">

                <!-- Today's revenue -->
                <div class="card bg-blue-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">50</h3>
                            {{-- <div class="list-icons ml-auto">
                                <a class="list-icons-item" data-action="reload"></a>
                            </div> --}}
                        </div>
                        
                        <div>
                            กำลังประเมิน
                            {{-- <div class="font-size-sm opacity-75">$37,578 avg</div> --}}
                        </div>
                    </div>

                    <div id="today-revenue"></div>
                </div>
                <!-- /today's revenue -->

            </div>
            <div class="col-lg-3">

                <!-- Today's revenue -->
                <div class="card bg-pink-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">20</h3>
                            {{-- <div class="list-icons ml-auto">
                                <a class="list-icons-item" data-action="reload"></a>
                            </div> --}}
                        </div>
                        
                        <div>
                            รอรับการยืนยัน
                            {{-- <div class="font-size-sm opacity-75">$37,578 avg</div> --}}
                        </div>
                    </div>

                    <div id="today-revenue"></div>
                </div>
                <!-- /today's revenue -->

            </div>
            <div class="col-lg-3">

                <!-- Today's revenue -->
                <div class="card bg-orange-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">50</h3>
                            {{-- <div class="list-icons ml-auto">
                                <a class="list-icons-item" data-action="reload"></a>
                            </div> --}}
                        </div>
                        
                        <div>
                            ไม่ผ่านการประเมิน
                            {{-- <div class="font-size-sm opacity-75">$37,578 avg</div> --}}
                        </div>
                    </div>

                    <div id="today-revenue"></div>
                </div>
                <!-- /today's revenue -->

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">รอรับการยืนยัน</h6>
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
                                        <th>วันที่</th>
                                        <th>ชื่อบริษัท</th>
                                        <th>สถานะ</th>                                   
                                        <th style="width:150px">เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>    
                                        <td> 26/2/2563 </td>
                                        <td> บริษัท ทดสอบ จำกัด </td> 
                                        <td> <span class="badge badge-flat border-info text-info-600">รอรับยืนยัน</span>  </td>                                                            
                                        <td> 
                                            <a href="" class=" badge bg-primary">แก้ไข</a>
                                            <a href="" data-name="" onclick="confirmation(event)" class=" badge bg-danger">ลบ</a>                                       
                                        </td>
                                    </tr>
                                </tbody>
                            </table>      
                        </div>
                    </div>
                </div>
            <!-- /striped rows -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">รอรับการยืนยัน</h6>
                        <div class="header-elements">
                            <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                {{-- <i class="icon-calendar3 mr-2"></i> --}}
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="fullcalendar-basic"></div>
                    </div>
                </div>
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
<script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

        var events = [];
        getEvent().then(data => {
            data.forEach(function (event,index) {
                events.push({
                    title: event["summary"],
                    url: event["url"],
                    start: event["start"]
                });
            });
            console.log(events);
            var calendarBasicViewElement = document.querySelector('.fullcalendar-basic');
            // Initialize
            if(calendarBasicViewElement) {
                var calendarBasicViewInit = new FullCalendar.Calendar(calendarBasicViewElement, {
                    locale: 'th',
                    plugins: ["dayGrid", "timeGrid", "list", "interaction", "googleCalendar"],
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,dayGridWeek,dayGridDay'
                    },
                    events: events,
                    editable: true,
                    eventLimit: true
                }).render();
            }
        }).catch(error => {})
        
    function getEvent() {
        return new Promise((resolve, reject) => {
        $.ajax({
            url: `${route.url}/api/googlecalendar/getevents`,
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
