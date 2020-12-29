@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/daygrid/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/timegrid/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/list/main.css')}}">

@stop
@section('content')
{{-- modal_get_calendar --}}
<div id="modal_get_calendar" class="modal fade" style="overflow:hidden;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;รายละเอียดปฏิทิน</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="nav-item"><a href="#left-icon-tab1" class="nav-link active" data-toggle="tab"><i class="icon-menu7 mr-2"></i> รายละเอียด</a></li>
                    <li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i class="icon-mention mr-2"></i> ผู้เข้าร่วม</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="left-icon-tab1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>หัวข้อ</label>
                                        <input type="text"  id="title" value=""  placeholder="หัวข้อ" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>สถานที่/ห้อง</label>
                                    <input type="text" id="placeroom" value=""  placeholder="สถานที่/ห้อง" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>ประเภท</label>
                                        <input type="text" id="eventtype" value=""  placeholder="ประเภท" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>วันที่</label>
                                        <input type="text" id="eventdate" value=""  placeholder="วันที่" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>เวลาเริ่ม</label>
                                        <input type="text" id="starttime" value=""  placeholder="เวลาเริ่ม" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>ถึงเวลา</label>
                                        <input type="text" id="endtime" value=""  placeholder="ถึงเวลา" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>รายละเอียด</label>
                                        <textarea type="text" id="detail" rows="3" cols="5"  placeholder="รายละเอียด" class="form-control" readonly></textarea>
                                    </div>
                                </div>
                                    {{-- <i class="icon-spinner spinner mr-2" id="spinicon" hidden></i><input type="checkbox" id="chkjoinmetting" data-id="" data-on-color="success" data-off-color="danger" data-on-text="เข้าร่วมแล้ว" data-off-text="ไม่เข้าร่วม" class="form-check-input-switch"  > --}}
                               
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>การเข้าร่วม<span class="text-danger">*</span></label>
                                    <select id="attendevent" class="form-control form-control-select2">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="left-icon-tab2">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="attendee_modal">
                                <thead>
                                    <tr>
                                        <th>ชื่อ-สกุล</th>    
                                        <th>สถานะ</th>                                                                               
                                    </tr>
                                </thead>
                                <tbody id="attendee_modal_wrapper_tr"> 
        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>           
            <div class="modal-footer">
                <button class="btn btn-link "  data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                <button id="btn_modal_get_calendar"  class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> บันทึก</button>
            </div>
        </div>
    </div>
</div>
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">หน้าแรก</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <input id="attendeventid" type="text" hidden>
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">รายการโครงการ</h6>
                        <div class="header-elements">
                            <a class="text-default daterange font-weight-semibold cursor-pointer dropdown-toggle">
                                <i class="icon-calendar3 mr-2"></i>
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
                                        <th>สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody id="report_project_wrapper">

                                </tbody>
                            </table>      
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">จำนวนโครงการต่อการยื่น ปี2563</h6>
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
        </div>

        {{-- <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">ข้อมูลย้อนหลัง ปี2561-2563</h6>
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
<script src="{{asset('assets/dashboard/js/plugins/pickers/daterangepicker.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/reportprojecthelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
<script>
    var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content'),
        branchid: "{{Auth::user()->branch_id}}"
    };


        // Initialize
        $('.daterange').daterangepicker(
            {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2015',
                maxDate: '12/31/2050',
                dateLimit: { days: 60 },
                ranges: {
                    'วันนี้': [moment(), moment()],
                    'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'สัปดาห์ที่ผ่านมา': [moment().subtract(6, 'days'), moment()],
                    // 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
                    'เดือนที่ผ่านมา': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: $('html').attr('dir') == 'rtl' ? 'right' : 'left',
                applyClass: 'btn-sm bg-slate-600 btn-block',
                cancelClass: 'btn-sm btn-light btn-block',
                locale: {
                    format: 'MM/DD/YYYY',
                    startLabel: 'เริ่มวันที่',
                    endLabel: 'ถึงวันที่',
                    applyLabel: 'ตกลง',
                    cancelLabel: 'ยกเลิก',
                    customRangeLabel: 'กำหนดเอง',
                    direction: $('html').attr('dir') == 'rtl' ? 'rtl' : 'ltr'
                }
            },
            function(start, end) {               
                $('.daterange span').html(start.format('D') + ' ' + thaiMonth(start.format('MM')) + ' - ' + end.format('D') + ' ' + thaiMonth(end.format('MM')));
            }
        );
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
</script>

@stop
