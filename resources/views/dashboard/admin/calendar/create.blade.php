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
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">เพิ่มปฎิทินกิจกรรม</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item">ปฎิทิน</a>
                    <span class="breadcrumb-item active">เพิ่มปฎิทินกิจกรรม</span>
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
                        <form method="POST" action="{{route('dashboard.admin.calendar.createsave')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>โครงการ</label><span class="text-danger">*</span>
                                        <select name="fulltbp" id="fulltbp" data-placeholder="โครงการ" class="form-control form-control-select2">
                                           <option val="0">==เลือกโครงการ==</option>
                                            @foreach ($fulltbps as $fulltbp)
                                                <option value="{{$fulltbp->id}}">{{$fulltbp->minitbp->project}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ประเภทปฎิทิน</label><span class="text-danger">*</span>
                                        <select name="calendartype" data-placeholder="ประเภทปฎิทิน" class="form-control form-control-select2">
                                            @foreach ($calendartypes as $calendartype)
                                                <option value="{{$calendartype->id}}">{{$calendartype->name}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>อีเมลแจ้งเตือนซ้ำ</label><span class="text-danger">*</span>
                                        <select name="isnotify" data-placeholder="ส่งอีเมลแจ้งเตือนซ้ำ" class="form-control form-control-select2">
                                            @foreach ($isnotifies as $isnotify)
                                                <option value="{{$isnotify->id}}">{{$isnotify->name}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>วันที่</label>
                                        <input type="text"  name="eventdate" id="eventdate" value="{{old('eventdate')}}"  placeholder="วันที่" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>เวลาเริ่ม</label>
                                        <input type="text"  name="eventtimestart" id="eventtimestart" value="{{old('eventtimestart')}}"  placeholder="เวลา" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>เวลาสิ้นสุด</label>
                                        <input type="text"  name="eventtimeend" id="eventtimeend" value="{{old('eventtimeend')}}"  placeholder="เวลา" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>สถานที่นัดหมาย</label>
                                        <input type="text"  name="place" value=""  placeholder="สถานที่นัดหมาย" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ห้อง</label>
                                        <input type="text"  name="room" value="{{old('room')}}" placeholder="ห้อง" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>รายละเอียด</label>
                                        <textarea name="summary" rows="5" cols="5" placeholder="รายละเอียด" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>ผู้เข้าร่วม</label><span class="text-danger">*</span>
                                        <select name="users[]" id="user" data-placeholder="ผู้เข้าร่วม" class="form-control form-control-select2" multiple="multiple">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
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
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

        $('#eventdate').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY HH:mm',
            clearButton: true,
            cancelText: "ยกเลิก",
            okText: "ตกลง",
            clearText: "เคลียร์",
            time: false
        });

        $('#eventtimestart').bootstrapMaterialDatePicker({
            format: 'HH:mm',
            clearButton: true,
            cancelText: "ยกเลิก",
            okText: "ตกลง",
            clearText: "เคลียร์",
            date: false,
        });
        
        $('#eventtimeend').bootstrapMaterialDatePicker({
            format: 'HH:mm',
            clearButton: true,
            cancelText: "ยกเลิก",
            okText: "ตกลง",
            clearText: "เคลียร์",
            date: false,
        });

    </script>
@stop