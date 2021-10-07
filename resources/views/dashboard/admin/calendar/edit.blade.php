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
                <h4> <span class="font-weight-semibold">ปฏิทินกิจกรรม โครงการ{{$eventcalendar->fulltbp->minitbp->project}}</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item">ปฏิทิน</a>
                    <span class="breadcrumb-item active">ปฏิทินกิจกรรม</span>
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
                    <input type="text" name="eventcalendarid" id="eventcalendarid" value="{{$eventcalendar->id}}" hidden>
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">ปฏิทินกิจกรรม</h6>
                        <div class="header-elements">
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('dashboard.admin.calendar.editsave',['id' => $eventcalendar->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>(วดป. เช่น {{date("d")}}/{{date("m")}}/{{intVal(date("Y"))+543}}) </label>
                                        <input type="text"  name="eventdate" id="eventdate" value="{{$eventcalendar->eventdateth}}"  placeholder="วันที่" class="form-control form-control-lg" >
                                    </div>
                                </div>
                                <div class="col-md-4" hidden>
                                    <div class="form-group">
                                        <label>ประเภทปฏิทิน</label>
                                        <input type="text"  name="calendartype" id="" value="{{$eventcalendar->calendartype->id}}"  placeholder="ประเภทปฏิทิน" class="form-control form-control-lg" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>อีเมลแจ้งเตือนซ้ำ</label><span class="text-danger">*</span>
                                        <select name="isnotify" data-placeholder="ส่งอีเมลแจ้งเตือนซ้ำ" class="form-control form-control-lg form-control-select2">
                                            @foreach ($isnotifies as $isnotify)
                                                <option value="{{$isnotify->id}}" @if ($isnotify->id == $eventcalendar->isnotify_id) selected @endif>{{$isnotify->name}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>เวลาเริ่ม</label>
                                        <input type="text"  name="eventtimestart" id="eventtimestart" value="{{$eventcalendar->starttime}}"  placeholder="เวลา" class="form-control form-control-lg timeformat" required >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>เวลาสิ้นสุด</label>
                                        <input type="text"  name="eventtimeend" id="eventtimeend" value="{{$eventcalendar->endtime}}"  placeholder="เวลา" class="form-control form-control-lg timeformat" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>สถานที่</label>
                                        <input type="text"  name="place"  value="{{$eventcalendar->place}}"  placeholder="สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)" class="form-control form-control-lg" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>หัวข้อ</label>
                                        <input type="text"  name="subject" value="{{$eventcalendar->subject}}"  placeholder="หัวข้อ" class="form-control form-control-lg" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>รายละเอียด</label>
                                        <textarea name="summary" rows="5" cols="5" placeholder="รายละเอียด" class="form-control form-control-lg" required>{{$eventcalendar->summary}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group">													
                                        <label for="">เอกสารแนบ<button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement"  id="btnuploadcalendarattachment" onclick="document.getElementById('calendarattachment').click();"><i class="icon-add mr-2"></i>อัปโหลดไฟล์</button></label>
                                    </div>
                                    <input type="file" style="display:none;" data-id="" id="calendarattachment" name="calendarattachment" accept="image/jpeg,image/gif,image/png,application/pdf"/>    
                                </div> 
                                @if ($calendarattachments->count() > 0)
                                <div class="col-md-12" id="attachmenttable_wrapper">
                                    <div class="form-group">
                                    <table style="width: 100%" class="table table-bordered table-striped" id="attachmenttable">
                                        <thead>
                                            <tr class="bg-info">
                                                <th style="text-align: center">เอกสารแนบ</th> 
                                                <th style="width:1%;text-align: center">เพิ่มเติม</th>                           
                                            </tr>
                                        </thead>
                                        <tbody id="attachmenttable_wrapper_tr">
                                            @foreach ($calendarattachments as $calendarattachment)
                                            <tr>    
                                                <td> {{$calendarattachment->name}} </td> 
                                                <td style="white-space: nowrap">
                                                    <a href="{{asset($calendarattachment->path)}}" class="btn btn-sm bg-primary" target="_blank">ดาวน์โหลด</a>
                                                    <a href="#" data-id="{{$calendarattachment->id}}" class="btn btn-sm bg-danger deleteattachment" data-toggle="modal" >ลบ</a>
                                                </td> 
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table> 
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>ผู้เข้าร่วม</label><span class="text-danger">*</span>
                                        <select name="users[]" data-placeholder="ผู้เข้าร่วม" class="form-control form-control-lg form-control-select2" multiple="multiple">
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}"
                                                    @if (!Empty($eventcalendarattendees->where('user_id',$user->id)->first()))
                                                        selected
                                                    @endif
                                                    >{{$user->name}} {{$user->lastname}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="text-right">
                                <div class="form-group">
                                <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
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

<script type="module" src="{{asset('assets/dashboard/js/app/helper/inputformat.js?v=2')}}"></script>



<script type="module" src="{{asset('assets/dashboard/js/app/helper/calendarhelper.js?v=1')}}"></script>

<script src="{{asset('assets/dashboard/js/app/helper/utility.js?v=1')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

        var eventdate = "{{$eventcalendar->eventdate}}";

        var startdate = moment();
        if($('#eventdate').val() != ''){
            
            startdate = moment(eventdate, 'YYYY-MM-DD');
        }
        var m = moment();
        $('#eventdate').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            clearButton: true,
            cancelText: "ยกเลิก",
            okText: "ตกลง",
            clearText: "เคลียร์",
			minDate : m,
            time: false
		});

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

    </script>
@stop