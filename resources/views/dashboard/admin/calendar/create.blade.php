@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/daygrid/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/timegrid/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/list/main.css')}}">

<style>
    textarea{
        font-size: 16px !important;
    }
</style>
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">เพิ่มปฏิทินกิจกรรม</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ปฏิทิน</a>
                    <a href="{{route('dashboard.admin.calendar')}}" class="breadcrumb-item"> ปฏิทินกิจกรรม</a>
                    <span class="breadcrumb-item active">เพิ่มปฏิทินกิจกรรม</span>
                </div>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
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
                        {{-- <h6 class="card-title" style="font-size:16px;font-weight: bold">ปฏิทินกิจกรรม</h6> --}}
                        <div class="header-elements">
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('dashboard.admin.calendar.createsave')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- <div  class="col-md-12" id="toast" hidden>
                                    <div class="mb-4">
                                        <div class="toast bg-slate border-transparent" style="opacity: 1; max-width: none;">
                                            <div class="toast-header bg-slate-600 border-bottom-slate-400">
                                                <span class="font-weight-semibold mr-auto blink" style="font-size: 16px">ข้อแนะนำ</span>
                                                <button type="button" class="close" data-dismiss="toast" id="closetoast">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="toast-body" style="font-size: 16px">
                                               <span id="toastmessage"></span>  
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>โครงการ</label><span class="text-danger">*</span>
                                        <select name="fulltbp" id="fulltbp" data-placeholder="โครงการ" class="form-control form-control-lg form-control-select2">
                                           <option value="0">==เลือกโครงการ==</option>
                                            @foreach ($fulltbps as $fulltbp)
                                                <option value="{{$fulltbp->id}}">{{$fulltbp->minitbp->project}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12" id="project_wrapper" hidden>
                                    <input type="text" name="eventcalendarid" id="eventcalendarid" hidden>
                                    <div class="row" >
                                        <div class="col-md-6">
                                            <input type="text" id="oldcalendartype" value="{{old('calendartype')}}" hidden>
                                            <div class="form-group">
                                                <label>ประเภทปฏิทิน</label><span class="text-danger">*</span>
                                                <select name="calendartype" id="calendartype" data-placeholder="ประเภทปฏิทิน" class="form-control form-control-lg form-control-select2">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>อีเมลแจ้งเตือนซ้ำ</label><span class="text-danger">*</span>
                                                <select name="isnotify" data-placeholder="ส่งอีเมลแจ้งเตือนซ้ำ" class="form-control form-control-lg form-control-select2">
                                                    @foreach ($isnotifies as $key => $isnotify)
                                                        <option value="{{$isnotify->id}}" @if ($key == 1) selected @endif >{{$isnotify->name}}</option> 
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>วันที่ (วดป. เช่น {{date("d")}}/{{date("m")}}/{{intVal(date("Y"))+543}})</label><span class="text-danger">*</span>
                                                <input type="text"  name="eventdate" id="eventdate" value="{{old('eventdate')}}"  placeholder="วันที่" class="form-control form-control-lg dmyformat" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>เวลาเริ่ม</label><span class="text-danger">*</span>
                                                <input type="text"  name="eventtimestart" id="eventtimestart" value="{{old('eventtimestart')}}"  placeholder="เวลา" class="form-control form-control-lg timeformat" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>เวลาสิ้นสุด</label><span class="text-danger">*</span>
                                                <input type="text"  name="eventtimeend" id="eventtimeend" value="{{old('eventtimeend')}}"  placeholder="เวลา" class="form-control form-control-lg timeformat" >
                                            </div>
                                        </div>
                                        {{-- {{old('paidupcapital') ?? $user->company->paidupcapital}} --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>สถานที่นัดหมาย</label><span class="text-danger">*</span>
                                                <input type="text"  name="place" value="{{old('place')}}"  placeholder="สถานที่นัดหมาย" class="form-control form-control-lg" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>หัวข้อ</label><span class="text-danger">*</span>
                                                <input type="text"  name="subject" value="{{old('subject')}}"  placeholder="หัวข้อ" class="form-control form-control-lg" >
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ห้อง</label>
                                                <input type="text"  name="room" value="{{old('room')}}" placeholder="ห้อง" class="form-control form-control-lg" >
                                            </div>
                                        </div> --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>รายละเอียด</label><span class="text-danger">*</span>
                                                <textarea name="summary" rows="5" cols="5" placeholder="รายละเอียด" class="form-control form-control-lg">{{old('summary')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group">													
                                                <label for="">เอกสารแนบ<button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement"  id="btnuploadcalendarattachment" onclick="document.getElementById('calendarattachment').click();"><i class="icon-add mr-2"></i>อัปโหลดไฟล์</button></label>
                                            </div>
                                            <input type="file" style="display:none;" data-id="" id="calendarattachment" name="calendarattachment" accept="image/jpeg,image/gif,image/png,application/pdf"/>    
                                        </div> 
                                        <div class="col-md-12" id="attachmenttable_wrapper" hidden>
                                            <div class="form-group">
                                            <table class="table table-bordered" id="attachmenttable">
                                                <thead>
                                                    <tr>
                                                        <th>เอกสารแนบ</th> 
                                                        <th style="width:1%">เพิ่มเติม</th>                           
                                                    </tr>
                                                </thead>
                                                <tbody id="attachmenttable_wrapper_tr">
                                                </tbody>
                                            </table> 
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>ผู้เข้าร่วม</label><span class="text-danger">*</span>
                                                <select name="users[]" id="user" data-placeholder="ผู้เข้าร่วม" class="form-control form-control-lg form-control-select2" multiple="multiple">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($fulltbps->count() != 0)
                                        <div class="text-right">
                                            <button type="submit" class="btn bg-teal" onclick="confirmsubmit(event);">บันทึก<i class="icon-paperplane ml-2"></i></button>
                                            {{-- <button type="submit" class="btn bg-teal" onclick="confirmsubmit(event);">แจ้งการจ่ายเงิน<i class="icon-paperplane ml-2"></i></button> --}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/daygrid/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/timegrid/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/list/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/interaction/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/google-calendar/main.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/locales/es.js')}}"></script>

<script type="module" src="{{asset('assets/dashboard/js/app/helper/calendarhelper.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/inputformat.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>

    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

        // $('#eventdate').bootstrapMaterialDatePicker({
        //     format: 'DD/MM/YYYY HH:mm',
        //     clearButton: true,
        //     cancelText: "ยกเลิก",
        //     okText: "ตกลง",
        //     clearText: "เคลียร์",
        //     time: false
        // });

        // $('#eventtimestart').bootstrapMaterialDatePicker({
        //     format: 'HH:mm',
        //     clearButton: true,
        //     cancelText: "ยกเลิก",
        //     okText: "ตกลง",
        //     clearText: "เคลียร์",
        //     date: false,
        // });
        
        // $('#eventtimeend').bootstrapMaterialDatePicker({
        //     format: 'HH:mm',
        //     clearButton: true,
        //     cancelText: "ยกเลิก",
        //     okText: "ตกลง",
        //     clearText: "เคลียร์",
        //     date: false,
        // });

        $(document).on('click', '#closetoast', function(e) {
            $("#toast").attr("hidden",true);
        });

        function confirmsubmit(e) {
            e.preventDefault();
            var frm = e.target.form;
            Swal.fire({
                    title: 'ยืนยัน',
                    text: `ต้องการยืนยันสร้างปฎิทินหรือไม่? `,
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ตกลง',
                    cancelButtonText: 'ยกเลิก',
                    closeOnConfirm: false,
                    closeOnCancel: false
                }).then((result) => {
                if (result.value) {
                    frm.submit();
                }
            });
        }
    </script>
@stop