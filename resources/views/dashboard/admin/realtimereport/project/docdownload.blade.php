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
                <h4> <span class="font-weight-semibold">ดาวน์โหลดเอกสาร</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> รายงาน</a>
                    <span class="breadcrumb-item active">โครงการ</span>
                    <span class="breadcrumb-item active">ดาวน์โหลดเอกสาร</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <input id="attendeventid" type="text" hidden>
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">เลือกช่วงเวลา</h6>
                        <div class="header-elements">
                            <a class="text-default daterange font-weight-semibold cursor-pointer dropdown-toggle">
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('dashboard.admin.realtimereport.project.getdocdownload')}}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ตั้งแต่วันที่</label>
                                        <input type="text"  name="fromdate" id="fromdate" value="{{Request::get('fromdate')}}" placeholder="ตั้งแต่วันที่" class="form-control form-control-lg" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ถึงวันที่</label>
                                        <input type="text" name="todate" id="todate" value="{{Request::get('todate')}}" placeholder="ถึงวันที่" class="form-control form-control-lg" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" name="btnsubmit" value="excel" class="btn btn-sm bg-teal float-right ml-1">Excel</button>  
                                    <button type="submit" name="btnsubmit" value="search" class="btn btn-sm bg-teal float-right">ค้นหา</button>  
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="searchtable">
                                        <thead>
                                            <tr class="bg-info">
                                                <th>เอกสาร</th> 
                                                <th>ผู้ดาวน์โหลด</th> 
                                                <th class="text-right">วันที่ดาวน์โหลด</th> 
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @foreach ($downloadstats as $downloadstat)
                                                <tr>
                                                    <td>{{$downloadstat->document}}</td>
                                                    <td>{{$downloadstat->user->name}} {{$downloadstat->user->lastname}}</td>
                                                    <td class="text-right">{{$downloadstat->created_at}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>      
                                </div>
                            </div>
                        </div>
                     
                    </div>
                </div>
            </div>
 
        </div>

        {{-- <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">จำนวนโครงการต่อการยื่น ปี2563</h6>
                        <div class="header-elements">
                            <a class="text-default font-weight-semibold cursor-pointer dropdown-toggle">
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="reportproject_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">ข้อมูลย้อนหลัง ปี2561-2563</h6>
                        <div class="header-elements">
                            <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
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
        </div> --}}
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/echart/echarts.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/moment/moment.min.js')}}"></script>
{{-- <script src="{{asset('assets/dashboard/js/plugins/pickers/daterangepicker.js')}}"></script> --}}
<script type="module" src="{{asset('assets/dashboard/js/app/helper/reportprojecthelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
<script>
    var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content'),
        branchid: "{{Auth::user()->branch_id}}"
    };


        // Initialize

        $('.daterange span').html(moment().subtract(29, 'days').format('D') + ' ' + thaiMonth(moment().subtract(29, 'days').format('MM')) + ' - ' + moment().format('D') + ' ' + thaiMonth(moment().format('MM')));

        function thaiMonth($check){
            var stmonth = 'มกราคม';
            if($check == 1){
                stmonth = 'มกราคม';
            }else if($check == 2){
                stmonth = 'กุมภาพันธ์';
            }else if($check == 3){
                stmonth = 'มีนาคม';
            }else if($check == 4){
                stmonth = 'เมษายน';
            }else if($check == 5){
                stmonth = 'พฤษภาคม';
            }else if($check == 6){
                stmonth = 'มิถุนายน ';
            }else if($check == 7){
                stmonth = 'กรกฎาคม';
            }else if($check == 8){
                stmonth = 'สิงหาคม';
            }else if($check == 9){
                stmonth = 'กันยายน';
            }else if($check == 10){
                stmonth = 'ตุลาคม';
            }else if($check == 11){
                stmonth = 'พฤศจิกายน';
            }else if($check == 12){
                stmonth = 'ธันวาคม';
            }
            return stmonth;
        }

        $('#fromdate').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            clearButton: true,
            cancelText: "ยกเลิก",
            okText: "ตกลง",
            clearText: "เคลียร์",
            time: false
        });
        $('#todate').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            clearButton: true,
            cancelText: "ยกเลิก",
            okText: "ตกลง",
            clearText: "เคลียร์",
            time: false
		});
        $('#searchtable').DataTable( {
            "paging":   true,
            "ordering": true,
            "info":     false,
            "pageLength" : 50,
            "language": {
                "search": "ค้นหา: ",  
                "sLengthMenu": "จำนวน _MENU_ รายการ",
                'paginate': {
                    'previous': 'ก่อนหน้า',
                    'next': 'ถัดไป'
                }
            }
        });
</script>

@stop
