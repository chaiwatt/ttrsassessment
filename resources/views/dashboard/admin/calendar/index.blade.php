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
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">รายการ Full TBP </span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> การประเมิน</a>
                    <span class="breadcrumb-item active">รายการ Full TBP</span>
                </div>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">
        @if (Session::has('success'))
            <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                {{ Session::get('success') }}
            </div>
            @elseif( Session::has('error') )
            <div class="alert alert-warning alert-styled-left alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                {{ Session::get('error') }}
            </div>
            @endif
            @if ($errors->count() > 0)
            <div class="alert alert-warning alert-styled-left alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                {{ $errors->first() }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">ปฎิทินกิจกรรม</h6>
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

<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>


    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
        var myevents = {!! json_encode($myevents) !!};;
        var events = [];
        for(var i = 0;i<myevents.length;i++){
            events.push({
                title: myevents[i]["summary"],
                url: myevents[i]["url"],
                start: myevents[i]["start"]
            });
        }
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
                // defaultDate: '2014-11-12',
                editable: true,
                eventLimit: true
            }).render();
        }
    </script>
@stop