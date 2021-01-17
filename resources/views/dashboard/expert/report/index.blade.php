@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/daygrid/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/timegrid/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/list/main.css')}}">
@stop
@section('content')

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
                <button id="btn_modal_expertreject_reason" class="btn bg-primary"><i class="icon-checkmark3 font-size-base mr-1"></i> บันทึก</button>
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
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">รายการประเมิน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{route('dashboard.expert.report')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> แดชบอร์ด</a>
                    <span class="breadcrumb-item active">รายงาน</span>
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
        <div id="alertmessage_wrapper">
            @foreach ($alertmessages->reverse() as $alertmessage)
                <div class="alert alert-info alert-styled-left alert-dismissible">
                    <button type="button" data-id ="{{$alertmessage->id}}" class="close alertmessage" data-dismiss="alert"><span>&times;</span></button>{{$alertmessage->detail}}
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">รายการประเมิน</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                
                                <span></span>
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th>เลขที่โครงการ</th> 
                                        {{-- <th>ชื่อโครงการ</th>  --}}
                                        <th>โครงการ</th>
                                        <th>สถานะ</th>
                                        <th>แสดงความเห็น</th>
                                        <th>วันนัดประชุมก่อนลงพื้นที่</th>
                                        <th>วันที่ประเมิน</th>
                                        <th>วันที่สรุปผลประเมิน</th>
                                        <th class="text-right">เพิ่มเติม</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fulltbps as $fulltbp)
                                    <tr>
                                        <td> {{$fulltbp->updatedatth}} </td> 
                                        {{-- <td> {{$fulltbp->minitbp->businessplan->code}} </td>  --}}
                                        <td>  
                                            <a class="text-info" href="{{route('dashboard.expert.project.fulltbp.view',['id' => $fulltbp->id])}}" >{{$fulltbp->minitbp->project}}</a>
                                        </td>  
                                        <td>  
                                            <span class="badge badge-flat border-info text-info-600">{{$fulltbp->minitbp->businessplan->businessplanstatus->name}}</span>
                                        </td>  
                                        <td> 
                                            @if($fulltbp->expertassignment->accepted == 1)
                                                    @if (Empty($fulltbp->expertcomment))
                                                            <a href="{{route('dashboard.expert.project.comment.edit',['id' => $fulltbp->id])}}" class="btn btn-sm bg-warning">แสดงความเห็น</a> 
                                                        @else
                                                            <a href="{{route('dashboard.expert.project.comment.edit',['id' => $fulltbp->id])}}" class="badge badge-flat border-success text-success-600">แสดงความเห็นแล้ว</a> 
                                                    @endif
                                                @else
                                                -
                                            @endif
                                        </td> 
                                        <td> {{$fulltbp->briefingdate}} </td>  
                                        <td> {{$fulltbp->assessmentdate}} </td>  
                                        <td> {{$fulltbp->finalassessmentdate}} </td> 
                                        <td class="text-right"> 
                                            @if ($fulltbp->expertassignment->accepted == 0)
                                                    <a href="{{route('dashboard.expert.report.accept',['id' => $fulltbp->id])}}" class="btn btn-sm bg-info">ยอมรับเข้าร่วม</a>
                                                    <a href="{{route('dashboard.expert.report.reject',['id' => $fulltbp->id])}}" data-id="{{$fulltbp->id}}" data-toggle="modal" class="btn btn-sm bg-danger reject">ปฎิเสธเข้าร่วม</a>
                                                {{-- @elseif($fulltbp->expertassignment->accepted == 1)
                                                     <a href="{{route('dashboard.expert.report.pdf',['id' => $fulltbp->id])}}" class="btn btn-sm bg-primary">PDF</a>--}}
                                                @elseif($fulltbp->expertassignment->accepted == 2)
                                                    <a href="" class="btn btn-sm bg-info showreject" data-id="{{$fulltbp->id}}" data-toggle="modal">เหตุผลการไม่เข้าร่วม</a> 
                                            @endif
                                            
                                        </td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>     
                        </div>
                    </div>
                </div>
            <!-- /striped rows -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">ปฏิทิน</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                
                                <span></span>
                            </a> --}}
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
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
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
        expertReject("{{Auth::user()->id}}",$(this).data('id'),$('#note').val()).then(data => {
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
            console.log(data);
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
