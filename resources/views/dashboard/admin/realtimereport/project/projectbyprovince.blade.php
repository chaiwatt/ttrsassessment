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
                <h4> <span class="font-weight-semibold">จำนวนโครงการแยกตามจังหวัด</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> รายงาน</a>
                    <span class="breadcrumb-item">โครงการ</span>
                    <span class="breadcrumb-item active">จำนวนโครงการแยกตามจังหวัด</span>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">จำนวนโครงการแยกตามจังหวัด</h6>
                        <div class="header-elements">
                            <a class="text-default daterange font-weight-semibold cursor-pointer dropdown-toggle">
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('dashboard.admin.realtimereport.project.getprojectbyprovince')}}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
									<div class="form-group">
										<label>เลือกจังหวัด</label>
										<select name="province" data-placeholder="เลือกจังหวัด" value="{{old('province')}}"  class="form-control form-control-lg form-control-select2">
											@foreach ($provinces as $province)
                                                <option value="{{$province->id}}" @if ($province->id == Request::get('province')) selected @endif >{{$province->name}}</option> 
											@endforeach
										</select>
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
                                    <table class="table table-bordered table-striped" id="searchtable">
                                        <thead>
                                            <tr class="bg-info">
                                                <th>เลขที่โครงการ</th> 
                                                <th>โครงการ</th> 
                                                <th>บริษัท</th> 
                                                <th class="text-right">สถานะ</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @foreach ($fulltbps as $fulltbp)
                                                @if ($fulltbp->minitbp->businessplan->business_plan_status_id >2)
                                                    <tr>
                                                        <td>{{$fulltbp->minitbp->businessplan->code}}</td>
                                                        <td>{{$fulltbp->minitbp->project}}</td>
                                                        <td>{{$fulltbp->minitbp->businessplan->company->name}}</td>
                                                        <td class="text-right">
                                                            @if ($fulltbp->status == 2)
                                                                    <span class="badge badge-flat border-info text-info-600 rounded-0">กำลังดำเนินการ</span>
                                                                @elseif($fulltbp->status == 3)
                                                                    <span class="badge badge-flat border-success text-success-600 rounded-0">เสร็จสิ้น</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
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
{{-- <script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/echart/echarts.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/pickers/daterangepicker.js')}}"></script> --}}
{{-- <script type="module" src="{{asset('assets/dashboard/js/app/helper/reportprojecthelper.js')}}"></script> --}}
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
<script>
    var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content'),
        branchid: "{{Auth::user()->branch_id}}"
    };


        // Initialize
        // $('.daterange').daterangepicker(
        //     {
        //         startDate: moment().subtract(29, 'days'),
        //         endDate: moment(),
        //         minDate: '01/01/2015',
        //         maxDate: '12/31/2050',
        //         dateLimit: { days: 60 },
        //         ranges: {
        //             'วันนี้': [moment(), moment()],
        //             'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        //             'สัปดาห์ที่ผ่านมา': [moment().subtract(6, 'days'), moment()],
        //             // 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        //             'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
        //             'เดือนที่ผ่านมา': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        //         },
        //         opens: $('html').attr('dir') == 'rtl' ? 'right' : 'left',
        //         applyClass: 'btn-sm bg-slate-600 btn-block',
        //         cancelClass: 'btn-sm btn-light btn-block',
        //         locale: {
        //             format: 'MM/DD/YYYY',
        //             startLabel: 'เริ่มวันที่',
        //             endLabel: 'ถึงวันที่',
        //             applyLabel: 'ตกลง',
        //             cancelLabel: 'ยกเลิก',
        //             customRangeLabel: 'กำหนดเอง',
        //             direction: $('html').attr('dir') == 'rtl' ? 'rtl' : 'ltr'
        //         }
        //     },
        //     function(start, end) {               
        //         $('.daterange span').html(start.format('D') + ' ' + thaiMonth(start.format('MM')) + ' - ' + end.format('D') + ' ' + thaiMonth(end.format('MM')));
        //     }
        // );
        // $('.daterange span').html(moment().subtract(29, 'days').format('D') + ' ' + thaiMonth(moment().subtract(29, 'days').format('MM')) + ' - ' + moment().format('D') + ' ' + thaiMonth(moment().format('MM')));

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

        $('#searchtable').DataTable( {
            "paging":   true,
            "ordering": true,
            "info":     false,
            "pageLength" : 50,
            "language": {
                "zeroRecords": " ",
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
