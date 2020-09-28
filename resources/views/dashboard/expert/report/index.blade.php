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
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">รายการประเมิน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> รายงาน</a>
                    <span class="breadcrumb-item active">รายการประเมิน</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">
        <div id="alertmessage_wrapper">
            @foreach ($alertmessages as $alertmessage)
                <div class="alert alert-info alert-styled-left alert-dismissible">
                    <button type="button" data-id ="{{$alertmessage->id}}" class="close alertmessage" data-dismiss="alert"><span>&times;</span></button>{{$alertmessage->detail}}
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">รายการประเมิน</h6>
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
                                        <th>เลขที่โครงการ</th> 
                                        <th>ชื่อโครงการ</th> 
                                        <th>บริษัท</th>
                                        <th>สถานะ</th>
                                        <th>เพิ่มเติม</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fulltbps as $fulltbp)
                                        <td> {{$fulltbp->updatedatth}} </td> 
                                        <td> {{$fulltbp->minitbp->businessplan->code}} </td> 
                                        <td> {{$fulltbp->minitbp->project}} </td>  
                                        <td> {{$fulltbp->minitbp->businessplan->businessplanstatus->name}} </td>  
                                        <td> 
                                            @if ($fulltbp->expertassignment->accepted == 0)
                                                    <a href="{{route('dashboard.expert.report.accept',['id' => $fulltbp->id])}}" class="btn btn-sm bg-info">ยอมรับเข้าร่วม</a>
                                                    <a href="{{route('dashboard.expert.report.reject',['id' => $fulltbp->id])}}" class="btn btn-sm bg-danger">ปฎิเสธเข้าร่วม</a>
                                                @elseif($fulltbp->expertassignment->accepted == 1) 
                                                    <a href="{{route('dashboard.expert.report.view',['id' => $fulltbp->id])}}" class="btn btn-sm bg-primary">รายละเอียด</a>
                                                    <a href="{{route('dashboard.expert.report.pdf',['id' => $fulltbp->id])}}" class="btn btn-sm bg-teal">PDF</a>
                                                    <a href="{{route('dashboard.expert.report.excel',['id' => $fulltbp->id])}}" class="btn btn-sm bg-info">EXCEL</a>
                                                @elseif($fulltbp->expertassignment->accepted == 2)
                                                    <a href="{{route('dashboard.expert.report.accept',['id' => $fulltbp->id])}}" class="btn btn-sm bg-warning">ปฎิเสธการเข้าร่วมหรือคลิกเพื่อเข้าร่วม</a>
                                            @endif
                                            
                                        </td> 
                                    @endforeach
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
                        <h6 class="card-title">ปฎิทินกลาง</h6>
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
<script src="{{asset('assets/dashboard/js/plugins/echart/echarts.min.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/reporthelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
<script>
     var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content'),
        branchid: "{{Auth::user()->branch_id}}"
    };
</script>
@stop
