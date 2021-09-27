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
                <h4> <span class="font-weight-semibold">ปฏิทินกิจกรรม</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            {{-- <div class="header-elements d-none">
                <a href="{{route('dashboard.admin.calendar.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่มปฏิทินกิจกรรม <b><i class="icon-plus3"></i></b></a>
            </div> --}}
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ปฏิทิน</a>
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
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">ปฏิทินกิจกรรม</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                <span></span>
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-2" id="testtopictable">
                                <thead>
                                    <tr class="bg-info">
                                        <th hidden>date</th>
                                        <th style="width:1%;white-space: nowrap;text-align:center">เลขที่โครงการ</th> 
                                        <th style="text-align: center">ชื่อโครงการ</th> 
                                        
                                        <th style="text-align: center">บริษัท</th> 
                                        <th style="text-align: center">ประเภทกิจกรรม</th>  
                                        <th style="text-align: center">วันที่</th>
                                        <th style="text-align: center">เวลา</th>
                                        <th style="width:1%;white-space: nowrap;text-align:center">สถานภาพ</th> 
                                                                  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($eventcalendars->reverse() as $key => $eventcalendar)
                                    <tr>  
                                        <td hidden>{{$eventcalendar->updated_at}}</td>  
                                        <td style="width:1%;white-space: nowrap;text-align:center">{{$eventcalendar->fulltbp->fulltbp_code}}</td> 
                                        <td> {{$eventcalendar->fulltbp->minitbp->project}} </td> 
                                        
                                        <td> {{$eventcalendar->fulltbp->minitbp->businessplan->company->fullname}} </td> 
                                        <td> {{$eventcalendar->calendartype->name}}</td> 
                                        <td style="width:1%;white-space: nowrap;text-align:center">{{$eventcalendar->eventdateth}}</td> 
                                        <td style="width:1%;white-space: nowrap;text-align:center">{{$eventcalendar->starttime}}-{{$eventcalendar->endtime}} น.</td> 
                                        <td style="width:1%;white-space: nowrap;text-align:center">
                                            
                                            @if ($eventcalendar->fulltbp->minitbp->businessplan->business_plan_status_id < 8 || !Empty($fulltbp->canceldate))
                                            
                                                @if ($eventcalendar->calendar_type_id == $eventcalendar->currentcalendartype)
                                                  
                                                        @if ($eventcalendar->isscored == 0)
                                                        
                                                            {{-- @if ($eventcalendar->fulltbp->finished_onsite == 2)
                                                                    <a href="{{route('dashboard.admin.calendar.view',['id' => $eventcalendar->id])}}" class="btn btn-sm bg-primary">รายละเอียด</a>
                                                                @else --}}
                                                                    <a href="{{route('dashboard.admin.calendar.edit',['id' => $eventcalendar->id])}}" class="btn btn-sm bg-info">แก้ไข</a>
                                                            {{-- @endif --}}
                                                            
                                                        @else
                                                            <a href="{{route('dashboard.admin.calendar.view',['id' => $eventcalendar->id])}}" class="btn btn-sm bg-primary">รายละเอียด</a>
                                                        @endif
                                                    @else
                                                        <a href="{{route('dashboard.admin.calendar.view',['id' => $eventcalendar->id])}}" class="btn btn-sm bg-primary">รายละเอียด</a>
                                                @endif
                                            @else  
                                                    <a href="{{route('dashboard.admin.calendar.view',['id' => $eventcalendar->id])}}" class="btn btn-sm bg-primary">รายละเอียด</a>  
                                            @endif
                                            
                                            {{-- <a href="{{route('dashboard.admin.calendar.delete',['id' => $eventcalendar->id])}}" data-name="" onclick="confirmation(event)" class="btn btn-sm bg-danger">ลบ</a>                                        --}}
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
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/daygrid/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/timegrid/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/list/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/interaction/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/google-calendar/main.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/locales/es.js')}}"></script>

<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
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

        $('#eventtime').bootstrapMaterialDatePicker({
            format: 'HH:mm',
            clearButton: true,
            cancelText: "ยกเลิก",
            okText: "ตกลง",
            clearText: "เคลียร์",
            date: false,
        });
        
        $('#testtopictable').DataTable( {
            "paging":   true,
            "ordering": true,
            "order": [[ 0, 'desc' ]],
            "info":     false,
            "pageLength" : 10,
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