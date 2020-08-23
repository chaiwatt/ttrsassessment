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
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">รายงาน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> รายงาน</a>
                    <span class="breadcrumb-item active">รายงาน</span>
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
                            จำนวนการยื่นขอประเมิน
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
                            จำนวนยื่น mini Tbp
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
                            จำนวนยื่น full Tbp
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
                            จำนวนที่ได้รับการประเมิน
                        </div>
                    </div>
                    <div id="today-revenue"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">รายการโครงการ</h6>
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
                                        <th style="width:200px">เพิ่มเติม</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fulltbps as $fulltbp)
                                    <tr> 
                                        <td> {{$fulltbp->updatedatth}} </td> 
                                        <td> {{$fulltbp->minitbp->businessplan->code}} </td> 
                                        <td> {{$fulltbp->minitbp->project}} </td>  
                                        <td> {{$fulltbp->minitbp->businessplan->businessplanstatus->name}} </td>  
                                        <td> 
                                            <a href="{{route('dashboard.admin.report.search.view',['id' => $fulltbp->id])}}" class=" badge bg-primary">รายละเอียด</a>
                                            <a href="{{route('dashboard.admin.report.search.pdf',['id' => $fulltbp->id])}}" class=" badge bg-teal">PDF</a>
                                            <a href="{{route('dashboard.admin.report.search.excel',['id' => $fulltbp->id])}}" class=" badge bg-info">EXCEL</a>
                                        </td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>      
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">จำนวนโครงการต่อการยื่น ปี2563</h6>
                        <div class="header-elements">
                            <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="participate_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">จำนวนโครงการตามเกรดการประเมิน ปี2563</h6>
                        <div class="header-elements">
                            <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="grade_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">โครงการตามกลุ่มอุตสาหกรรม ปี2563</h6>
                        <div class="header-elements">
                            <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="industrygroup_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">จุดประสงค์การประเมิน ปี2563</h6>
                        <div class="header-elements">
                            <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                {{-- <i class="icon-calendar3 mr-2"></i> --}}
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="financial_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">ข้อมูลย้อนหลัง ปี2561-2563</h6>
                        <div class="header-elements">
                            <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                {{-- <i class="icon-calendar3 mr-2"></i> --}}
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="bar_chart"></div>
                        </div>
                    </div>
                </div>
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
<script>
    var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content'),
        branchid: "{{Auth::user()->branch_id}}"
    };
</script>

@stop
