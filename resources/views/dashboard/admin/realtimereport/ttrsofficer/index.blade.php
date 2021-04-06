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
                <h4> <span class="font-weight-semibold">เจ้าหน้าที่ TTRS</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> รายงาน</a>
                    <span class="breadcrumb-item active">เจ้าหน้าที่ TTRS</span>
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
                        {{-- <h6 class="card-title">ช่วงเวลาโครงการ</h6> --}}
                        <div class="header-elements">
                            {{-- <a class="text-default daterange font-weight-semibold cursor-pointer dropdown-toggle">
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('dashboard.admin.realtimereport.getofficer')}}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                       
                                        <label>ค้นหา ชื่อ-นามสกุล</label>
                                        <input type="text"  name="search" id="search" placeholder="ค้นหา ชื่อ-นามสกุล" value="{{Request::get('search')}}" class="form-control form-control-lg" >
                                    </div>
                                </div>
                                <div class="col-md-4">
									<div class="form-group">
										<label>สาขาผู้เชี่ยวชาญ</label>
										<select name="expertbranch" data-placeholder="สาขาผู้เชี่ยวชาญ" value="{{old('expertbranch')}}" class="form-control form-control-lg form-control-select2">
											<option value="0" >===เลือก สาขาผู้เชี่ยวชาญ===</option> 
                                            @foreach ($expertbranches as $expertbranch)
												<option value="{{$expertbranch->id}}" @if ($expertbranch->id == Request::get('expertbranch')) selected @endif >{{$expertbranch->name}}</option> 
											@endforeach
										</select>
									</div>
								</div>
                                <div class="col-md-4">
									<div class="form-group">
										<label>วุฒิการศึกษา</label>
										<select name="educationlevel" data-placeholder="วุฒิการศึกษา" value="{{old('educationlevel')}}" class="form-control form-control-lg form-control-select2">
											<option value="0" >===เลือก วุฒิการศึกษา===</option> 
                                            @foreach ($educationlevels as $educationlevel)
												<option value="{{$educationlevel->id}}" @if ($educationlevel->id == Request::get('educationlevel')) selected @endif >{{$educationlevel->name}}</option> 
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
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="testtopictable">
                                        <thead>
                                            <tr class="bg-info">
                                                <th>ชื่อ-นามสกุล</th> 
                                                <th>ตำแหน่ง</th> 
                                                <th>หน่วยงานที่สังกัด</th> 
                                                <th>สาขาความเชี่ยวชาญ</th> 
                                                <th>ประสบการณ์ทำงาน</th> 
                                                <th class="text-right">รายบุคคล</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @foreach ($officers as $officer)
                                                <tr>
                                                    @php
                                                        $userprefix = $officer->user->prefix->name;
                                                            if($userprefix == 'อื่นๆ'){
                                                            $userprefix = $officer->user->alter_prefix;
                                                        }
                                                    @endphp
                                                    <td>{{$userprefix}}{{$officer->user->name}}  {{$officer->user->lastname}}</td>
                                                    <td>{{$officer->position}}</td>
                                                    <td>{{$officer->organization}}</td>
                                                    <td>{{$officer->expertbranch->name}}</td>
                                                    <td>{{$officer->expereinceyear}} ปี {{$officer->expereincemonth}} เดือน</td>
                                                    <td class="text-right"> 
                                                        <a href="{{route('dashboard.admin.realtimereport.singledownload',['id' => $officer->user_id])}}" class=" btn btn-sm bg-info">ดาวน์โหลด</a>
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
            </div>
        </div>
    </div>
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
</script>

@stop
