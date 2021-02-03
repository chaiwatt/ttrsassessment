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
                                        <input type="text"  id="title" value=""  placeholder="หัวข้อ" class="form-control form-control-lg" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>สถานที่/ห้อง</label>
                                    <input type="text" id="placeroom" value=""  placeholder="สถานที่/ห้อง" class="form-control form-control-lg" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>ประเภท</label>
                                        <input type="text" id="eventtype" value=""  placeholder="ประเภท" class="form-control form-control-lg" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>วันที่</label>
                                        <input type="text" id="eventdate" value=""  placeholder="วันที่" class="form-control form-control-lg" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>เวลาเริ่ม</label>
                                        <input type="text" id="starttime" value=""  placeholder="เวลาเริ่ม" class="form-control form-control-lg" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>ถึงเวลา</label>
                                        <input type="text" id="endtime" value=""  placeholder="ถึงเวลา" class="form-control form-control-lg" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>รายละเอียด</label>
                                        <textarea type="text" id="detail" rows="3" cols="5"  placeholder="รายละเอียด" class="form-control form-control-lg" readonly></textarea>
                                    </div>
                                </div>
                                    
                               
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>การเข้าร่วม<span class="text-danger">*</span></label>
                                    <select id="attendevent" class="form-control form-control-lg form-control-select2">
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
                <button id="btn_modal_get_calendar"  class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i>บันทึก</button>
            </div>
        </div>
    </div>
</div>

<div id="modal_expertreject_reason" class="modal fade" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;สาเหตุการไม่เข้าร่วมโครงการ
                </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label id="messageshow">สาเหตุการไม่เข้าร่วมโครงการ</label>
                            <textarea type="text" rows="5"  id="note" placeholder="ข้อความเพิ่มเติม สาเหตุการไม่เข้าร่วมโครงการ" class="form-control form-control-lg" ></textarea>
                        </div>
                    </div>
                </div>
            </div>           
            <div class="modal-footer">
                <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                <button id="btn_modal_expertreject_reason" class="btn bg-primary"><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i><i class="icon-checkmark3 font-size-base mr-1"></i> บันทึก</button>
            </div>
        </div>
    </div>
</div>

<div id="modal_show_reason" class="modal fade" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;สาเหตุการไม่เข้าร่วมโครงการ
                </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div id="rejectreason_wrapper" style="border-style:dashed;border-width:1px;border-radius:5px;padding:10px;height:150px;width:100%;overflow: auto;"></div>
                        </div>
                    </div>
                </div>
            </div>           
            <div class="modal-footer">
                <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
            </div>
        </div>
    </div>
</div>

    {{-- modal_show_controlflow --}}
    <div id="modal_show_controlflow" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;Control Flow</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="text" id="minitbpid" hidden>
                        <div class="col-md-12" id="flowlist_wrapper">

                        </div>
                    </div>
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
        <div id="alertmessage_wrapper">
            @foreach ($alertmessages->reverse() as $alertmessage)
                <div class="alert alert-info alert-styled-left alert-dismissible">
                    <button type="button" data-id ="{{$alertmessage->id}}" class="close alertmessage" data-dismiss="alert"><span>&times;</span></button>{!!$alertmessage->detail!!}
                </div>
            @endforeach
        </div>
        @if (Auth::user()->user_type_id > 5)
        <div class="row">
            <div class="col-lg-3">
                <div class="card bg-teal-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h1 class="font-weight-semibold mb-0">{{$businessplans->count()}}</h1>
                        </div>
                        <div>
                            จำนวนสมัครสมาชิก
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div id="members-online"></div>
                    </div>
                </div>
             

            </div>

            <div class="col-lg-3">

                <!-- Today's revenue -->
                <div class="card bg-blue-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h1 class="font-weight-semibold mb-0">{{$businessplans->where('business_plan_status_id','>=',4)->count()}}</h1>
                        </div>
                        
                        <div>
                            จำนวนยื่น Mini Tbp
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
                            <h1 class="font-weight-semibold mb-0">{{$businessplans->where('business_plan_status_id','>=',6)->count()}}</h1>
                        </div>
                        
                        <div>
                            จำนวนยื่น Full TBP
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
                            <h1 class="font-weight-semibold mb-0">{{$businessplans->where('business_plan_status_id','>=',8)->count()}}</h1>
                        </div>
                        
                        <div>
                            จำนวนที่ได้รับการประเมิน
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
                                        {{-- <th>เลขที่โครงการ</th>  --}}
                                        <th>ชื่อโครงการ</th> 
                                        <th>สถานะ</th>
                                        <th>วันนัดประชุมก่อนลงพื้นที่</th>
                                        <th>วันที่ประเมิน</th>
                                        <th>วันที่สรุปผลประเมิน</th>
                                        <th>เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fulltbps as $fulltbp)
                                    @php
                                        $check = Auth::user()->IsExpert($fulltbp->id);
                                    @endphp
                                    <tr> 
                                        {{-- <td> {{$fulltbp->minitbp->businessplan->code}} </td>  --}}
                                        <td> 
                                            <a href="#" data-toggle="modal" data-id="{{$fulltbp->minitbp->id}}" class="controlflowicon"><i class="icon-cog2 text-info mr-2"></i></a>
                                            <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->company->id])}}" class="text-info" target="_blank" >{{$fulltbp->minitbp->project}} </a>  
                                        </td>  
                                        <td> 
                                            @if ($fulltbp->status == 3)
                                                    <span class="badge badge-flat border-success-600 text-success-600">{{$fulltbp->minitbp->businessplan->businessplanstatus->name}} </span> 
                                                @else
                                                <span class="badge badge-flat border-grey-600 text-grey-600">{{$fulltbp->minitbp->businessplan->businessplanstatus->name}} </span> 
                                            @endif
                                        </td>  
                                        <td> {{$fulltbp->briefingdate}} </td>  
                                        <td> {{$fulltbp->assessmentdate}} </td>  
                                        <td> {{$fulltbp->finalassessmentdate}} </td>  
                                        <td> 
                                            @if (!Empty($check))
                                                @if ($fulltbp->expertassignment->accepted == 0)
                                                        <a href="{{route('dashboard.admin.report.expert.accept',['id' => $fulltbp->id])}}" class="btn btn-sm bg-info">ยอมรับเข้าร่วม</a>
                                                        <a href="#" data-id="{{$fulltbp->id}}" data-toggle="modal" class="btn btn-sm bg-danger reject">ปฎิเสธเข้าร่วม</a>
                                                    @elseif($fulltbp->expertassignment->accepted == 2)
                                                        <a href="" class="btn btn-sm bg-info showreject" data-id="{{$fulltbp->id}}" data-toggle="modal">เหตุผลการไม่เข้าร่วม</a> 
                                                @endif
                                            @endif
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">ปฏิทิน</h6>
                        <div class="header-elements">
                            <a class="text-default daterange font-weight-semibold cursor-pointer dropdown-toggle">
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
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">จำนวนโครงการต่อการยื่น ปี2563</h6>
                        <div class="header-elements">
                            <a class="text-default daterange font-weight-semibold cursor-pointer dropdown-toggle">
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
                            <a class="text-default daterange font-weight-semibold cursor-pointer dropdown-toggle">
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
                            <a class="text-default daterange font-weight-semibold cursor-pointer dropdown-toggle">
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
                        <h6 class="card-title">วัตถุประสงค์ของการขอรับการประเมิน ปี2563</h6>
                        <div class="header-elements">
                            <a class="text-default daterange font-weight-semibold cursor-pointer dropdown-toggle">
                                
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
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/daygrid/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/timegrid/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/list/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/interaction/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/google-calendar/main.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/locales/es.js')}}"></script>

{{-- <script src="{{asset('assets/dashboard/js/plugins/ui/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/pickers/daterangepicker.js')}}"></script> --}}
{{-- <script src="{{asset('assets/dashboard/js/demo_pages/dashboard.js')}}"></script> --}}

<script src="{{asset('assets/dashboard/js/plugins/echart/echarts.min.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/reporthelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/controlflow.js')}}"></script>
<script>
    var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content'),
        branchid: "{{Auth::user()->branch_id}}"
    };

    $(document).on('click', '.reject', function(e) {
        $('#btn_modal_expertreject_reason').data('id',$(this).data('id')); //setter
        $('#modal_expertreject_reason').modal('show');
    });

    $(document).on('click', '#btn_modal_expertreject_reason', function(e) {
        if($('#note').val() == '')return;
        $("#spinicon").attr("hidden",false);
        expertReject("{{Auth::user()->id}}",$(this).data('id'),$('#note').val()).then(data => {
            $("#spinicon").attr("hidden",true);
            window.location.reload();
        })
       .catch(error => {})
    });

    function expertReject(id,fulltbpid,note){
        return new Promise((resolve, reject) => {
            $.ajax({
            url: `${route.url}/api/expert/expertreject`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
                'id': id,
                'fulltbpid': fulltbpid,
                'note': note
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

    $(document).on('click', '.showreject', function(e) {
        // $('#btn_modal_expertreject_reason').data('id',$(this).data('id')); //setter
        showReject("{{Auth::user()->id}}",$(this).data('id')).then(data => {
            // console.log(data);
            $('#rejectreason_wrapper').html(data);
            $('#modal_show_reason').modal('show');
        })
        
    });
    // 

    function showReject(id,fulltbpid){
        return new Promise((resolve, reject) => {
            $.ajax({
            url: `${route.url}/api/expert/showreject`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
                'id': id,
                'fulltbpid': fulltbpid
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
