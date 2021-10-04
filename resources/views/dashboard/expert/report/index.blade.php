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

    .popper,
  .tooltip {
    position: absolute;
    z-index: 9999;
    background: #FFC107;
    color: black;
    width: 150px;
    border-radius: 3px;
    box-shadow: 0 0 2px rgba(0,0,0,0.5);
    padding: 10px;
    text-align: center;
  }
  .style5 .tooltip {
    background: #1E252B;
    color: #FFFFFF;
    max-width: 200px;
    width: auto;
    font-size: .8rem;
    padding: .5em 1em;
  }
  .popper .popper__arrow,
  .tooltip .tooltip-arrow {
    width: 0;
    height: 0;
    border-style: solid;
    position: absolute;
    margin: 5px;
  }
  
  .tooltip .tooltip-arrow,
  .popper .popper__arrow {
    border-color: #FFC107;
  }
  .style5 .tooltip .tooltip-arrow {
    border-color: #1E252B;
  }
  .popper[x-placement^="top"],
  .tooltip[x-placement^="top"] {
    margin-bottom: 5px;
  }
  .popper[x-placement^="top"] .popper__arrow,
  .tooltip[x-placement^="top"] .tooltip-arrow {
    border-width: 5px 5px 0 5px;
    border-left-color: transparent;
    border-right-color: transparent;
    border-bottom-color: transparent;
    bottom: -5px;
    left: calc(50% - 5px);
    margin-top: 0;
    margin-bottom: 0;
  }
  .popper[x-placement^="bottom"],
  .tooltip[x-placement^="bottom"] {
    margin-top: 5px;
  }
  .tooltip[x-placement^="bottom"] .tooltip-arrow,
  .popper[x-placement^="bottom"] .popper__arrow {
    border-width: 0 5px 5px 5px;
    border-left-color: transparent;
    border-right-color: transparent;
    border-top-color: transparent;
    top: -5px;
    left: calc(50% - 5px);
    margin-top: 0;
    margin-bottom: 0;
  }
  .tooltip[x-placement^="right"],
  .popper[x-placement^="right"] {
    margin-left: 5px;
  }
  .popper[x-placement^="right"] .popper__arrow,
  .tooltip[x-placement^="right"] .tooltip-arrow {
    border-width: 5px 5px 5px 0;
    border-left-color: transparent;
    border-top-color: transparent;
    border-bottom-color: transparent;
    left: -5px;
    top: calc(50% - 5px);
    margin-left: 0;
    margin-right: 0;
  }
  .popper[x-placement^="left"],
  .tooltip[x-placement^="left"] {
    margin-right: 5px;
  }
  .popper[x-placement^="left"] .popper__arrow,
  .tooltip[x-placement^="left"] .tooltip-arrow {
    border-width: 5px 0 5px 5px;
    border-top-color: transparent;
    border-right-color: transparent;
    border-bottom-color: transparent;
    right: -5px;
    top: calc(50% - 5px);
    margin-left: 0;
    margin-right: 0;
  }
  select.form-control{
        display: inline;
        width: 200px;
        margin-left: 25px;
        font-size: 16px
    }

</style>
@stop
@section('content')
<div id="modal_get_calendar" class="modal fade" style="overflow:hidden;">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;รายละเอียดปฏิทิน</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="nav-item"><a href="#left-icon-tab1" class="nav-link active" data-toggle="tab">รายละเอียด</a></li>
                    <li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab">ผู้เข้าร่วม</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="left-icon-tab1">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="form-group">
                                    <input type="text" id="jointype" hidden>
                                    <div class="table-responsive" >
                                        <table style="width: 100%" class="table table-bordered table-striped" id="attendee_modal">
                                                <tr>
                                                    <td><strong>ประเภท</strong> </td>  
                                                    <td id="eventtype"></td>
                                                </tr> 
                                                <tr> 
                                                    <td><strong>หัวข้อ</strong></td>
                                                    <td id="subject"></td>
                                                </tr>  
                                                <tr> 
                                                    <td><strong>วันที่ เวลา</strong></td> 
                                                    <td id="eventdate"></td>
                                                </tr>  
                                                <tr> 
                                                    <td><strong>สถานที่</strong></td> 
                                                    <td id="place"></td>
                                                </tr> 
                                                <tr style="width:200px">
                                                    <td  style="width:120px"><strong>รายละเอียด</strong></td>   
                                                    <td id="detail"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>เอกสารแนบ</strong></td>    
                                                    <td style="vertical-align: middle;" id="attachment_wrapper"></td>                                                                       
                                                </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>การเข้าร่วม<span class="text-danger">*</span></label>
                                    {{-- <select id="attendevent" class="form-control form-control-lg form-control-select2">
                                    </select> --}}
                                    <div class="col-md-12" class="confirm" id="attendevent">
    
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" id="rej_meeting_note_wrapper" hidden>
                                <div class="form-group">
                                    <label>เหตุผลการไม่เข้าร่วม</label>
                                    <textarea type="text" rows="5"  id="rej_meeting_note" placeholder="กรุณาระบุเหตุผลการไม่เข้าร่วมการประชุม" class="form-control form-control-lg" ></textarea>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <div class="tab-pane fade" id="left-icon-tab2">
                        <div class="table-responsive" >
                            <table style="width: 100%" class="table table-bordered table-striped" id="attendee_modal">
                                <thead>
                                    <tr>
                                        <th>ชื่อ-นามสกุล</th>    
                                        <th>สถานภาพ</th>                                                                               
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
                <button id="btn_modal_get_calendar"  class="btn bg-primary" ><i class="icon-spinner spinner mr-2" id="spiniconcalendar" hidden></i><i class="icon-checkmark3 font-size-base mr-1"></i>บันทึก</button>
            </div>
        </div>
    </div>
</div>

<div id="modal_expertreject_reason" class="modal fade" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เหตุผลการไม่เข้าร่วมโครงการ
                </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label id="messageshow">โปรดระบุเหตุผล</label>
                            <textarea type="text" rows="5"  id="note" placeholder="โปรดระบุเหตุผล" class="form-control form-control-lg" ></textarea>
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
                <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เหตุผลการไม่เข้าร่วมโครงการ
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
                <h4> <span class="font-weight-semibold">รายการประเมิน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            @if (Auth::user()->company->saveprofile == 0)
                <div class="header-elements d-none">
                    <a href="{{route('setting.profile.expert.edit',['userid' => Auth::user()->id])}}" class="btn btn-labeled bg-warning" ><span class="blink">โปรดตั้งค่า Profile</span></a>
                </div>
            @endif
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{route('dashboard.expert.report')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> แดชบอร์ด</a>
                    {{-- <span class="breadcrumb-item active">รายงาน</span> --}}
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
                    <button type="button" data-id ="{{$alertmessage->id}}" class="close alertmessage" data-dismiss="alert"><span>&times;</span></button>{!!$alertmessage->detail!!}
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">รายละเอียดโครงการ</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                
                                <span></span>
                            </a> --}}
                        </div>
                    </div>
                    @php
                        $count = Auth::user()->Isexpertbelong; 
                    @endphp
                    {{-- {{$count}} --}}
                    <div class="card-body">
                        <input id="attendeventid" type="text" hidden >
                        <div class="table-responsive" >
                            @if ($fulltbps->count() > 0)
                                <div >
                                    <select id="leaderFilter_tb1" class="form-control ">
                                    <option value="">== Leader ==</option>
                                    @foreach ($leaders as $leader)
                                        <option value="{{$leader->name}} {{$leader->lastname}}">{{$leader->name}} {{$leader->lastname}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div >
                                    <select id="expertFilter_tb1" class="form-control">
                                    <option value="">== ผู้เชี่ยวชาญ ==</option>
                                        @foreach ($experts as $expert)
                                            <option value="{{$expert->name}} {{$expert->lastname}}">{{$expert->name}} {{$expert->lastname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <table style="width: 100%" class="table table-bordered table-striped mb-2" id="maintable">
                                <thead>
                                    <tr class="bg-info">
                                        <th hidden>date</th>
                                        <th style="width:1%;white-space: nowrap;text-align:center">เลขที่โครงการ</th> 
                                        <th style="width:20%;text-align:center">โครงการ</th>
                                        <th style="width:1%;white-space: nowrap;text-align:center">วันนัดก่อนลงพื้นที่</th>
                                        <th style="width:1%;white-space: nowrap;text-align: center">วันที่ประเมิน</th>
                                        <th style="width:1%;white-space: nowrap;text-align:center">วันที่สรุปผลประเมิน</th>
                                        <th style="width:1%;white-space: nowrap;text-align:center">แสดงความเห็น</th>
                                        @if ($count > 0)
                                            <th style="width:1%;white-space: nowrap;text-align: center">การเข้าร่วม</th>
                                        @endif
                                        <th style="width:1%;white-space: nowrap;text-align:center">สถานภาพ</th>
                                        <th style="width:1%;white-space: nowrap;text-align:center" hidden>hidden_leader</th> 
                                        <th style="width:1%;white-space: nowrap;text-align:center" hidden>hidden_expert</th>                             
                                        {{-- <th style="width:1%;white-space: nowrap;text-align:center" >hidden_grade</th>     --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fulltbps as $fulltbp)
                                        @if ($fulltbp->canceldate == null)    
                                            <tr>
                                                <td hidden >{{$fulltbp->updated_at}}</td>  
                                                <td style="width:1%;white-space: nowrap;text-align:center">{{@$fulltbp->fulltbp_code}}</td> 
                                                <td style="width:20%;">  
                                                    
                                                    @if ($fulltbp->expertassignment->accepted == 1)
                                                        <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="text-info" target="_blank" >{{$fulltbp->minitbp->project}} </a>  
                                                    @else
                                                        {{$fulltbp->minitbp->project}}     
                                                    @endif
                                                    
                                                </td>  

                                                <td style="width:1%;white-space: nowrap;text-align:center">
                                                    @if (!Empty($fulltbp->brieftdate))
                                                         {{$fulltbp->brieftdateth}}
                                                        @else
                                                         {{$fulltbp->briefingdate}} 
                                                    @endif 
                                                </td>  
                                                <td style="width:1%;white-space: nowrap;text-align:center">
                                                    @if (!Empty($fulltbp->fielddate))
                                                        {{$fulltbp->fielddateth}}
                                                        @else
                                                        {{$fulltbp->assessmentdate}}
                                                    @endif
                                                      </td>  
                                                <td style="width:1%;white-space: nowrap;text-align:center"> 
                                                    @if (!Empty($fulltbp->scoringdate))
                                                    {{$fulltbp->scoringdateth}}
                                                        @else
                                                        {{$fulltbp->finalassessmentdate}}
                                                    @endif
                                                </td> 
                                                <td style="width:1%;white-space: nowrap;text-align:center"> 
                                                    @if($fulltbp->expertassignment->accepted == 1)
                                                            @if (Empty($fulltbp->expertcomment))
                                                                    @if ($fulltbp->minitbp->businessplan->business_plan_status_id < 9)
                                                                            {{-- <a href="{{route('dashboard.expert.project.comment.edit',['id' => $fulltbp->id])}}" class="btn btn-sm bg-info">ความเห็น</a> 
                                                                        @else --}}
                                                                            <a href="{{route('dashboard.expert.project.comment.edit',['id' => $fulltbp->id])}}" class="btn btn-sm bg-primary">แสดงความเห็น</a> 
                                                                    @endif
                                                                    
                                                            @else
                                                                    <a href="{{route('dashboard.expert.project.comment.edit',['id' => $fulltbp->id])}}" ><span class="badge badge-flat border-success text-success-600">แสดงความเห็นแล้ว</span></a> 
                                                            @endif
                                                    @endif
                                                </td> 
                                                @if ($count > 0)
                                                    <td style="width:1%;white-space: nowrap;text-align:center"> 
                                                        @if ($fulltbp->expertassignment->accepted == 0)
                                                                <a href="{{route('dashboard.expert.report.accept',['id' => $fulltbp->id])}}" class="btn btn-sm bg-info">ยอมรับเข้าร่วม</a>
                                                                <a href="#" data-id="{{$fulltbp->id}}" data-toggle="modal" class="btn btn-sm bg-danger reject">ปฎิเสธเข้าร่วม</a>
                                                            @elseif($fulltbp->expertassignment->accepted == 2)
                                                                <a href="" class="btn btn-sm bg-info showreject" data-id="{{$fulltbp->id}}" data-toggle="modal">เหตุผลการไม่เข้าร่วม</a> 
                                                        @endif
                                                        
                                                    </td> 
                                                @endif

                                                <td style="width:1%;white-space: nowrap;text-align:center">  

                                                    @if ($fulltbp->status == 3)
                                                            <span class="badge badge-flat border-success-600 text-success-600">{{$fulltbp->minitbp->businessplan->businessplanstatus->name}} </span> 
                                                        @else
                                                            <span class="badge badge-flat border-grey-600 text-grey-600">{{$fulltbp->minitbp->businessplan->businessplanstatus->name}} </span> 
                                                    @endif
                                                    
                                                    {{-- <span class="badge badge-flat border-grey-600 text-grey-600">{{$fulltbp->minitbp->businessplan->businessplanstatus->name}}</span> --}}
                                                </td>  
                                                <td hidden>{{$fulltbp->searchprojectleader}}</td>
                                                <td hidden>{{$fulltbp->searchprojectexpert}}</td>
                                                {{-- <td >{{$fulltbp->searchprojectgrade}}</td> --}}
                                            </tr>
                                            
                                        @endif

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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">ปฏิทิน</h6>
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
<script type="module" src="{{asset('assets/dashboard/js/app/helper/reporthelper.js?v=1')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/utility.js?v=1')}}"></script>
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
        showReject("{{Auth::user()->id}}",$(this).data('id')).then(data => {
            $('#rejectreason_wrapper').html(data);
            $('#modal_show_reason').modal('show');
        })
        
    });

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

    var countitemtable =  "{{$fulltbps->count()}}";

        if (countitemtable >= 1) {
            $('#maintable').DataTable( {
                "paging":   true,
                "ordering": true,
                "order": [[ 0, 'desc' ]],
                "info":     false,
                "pageLength" : 7,
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
            var table_tb1 = $('#maintable').DataTable();
            $("#maintable_filter.dataTables_filter").append($("#leaderFilter_tb1"));
            $("#maintable_filter.dataTables_filter").append($("#expertFilter_tb1"));

            var leaderindex_tb1 = 0;
            var expertrindex_tb1 = 0;
            
            $("#maintable th").each(function (i) {
                if ($($(this)).html() == "hidden_leader") {
                    leaderindex_tb1 = i; 
                }
                if ($($(this)).html() == "hidden_expert") {
                    expertrindex_tb1 = i; 
                }
            });
            $("#leaderFilter_tb1").change(function (e) {
                console.log(leaderindex_tb1);
                customSearhExact_tb1("#leaderFilter_tb1",leaderindex_tb1);
                $("#expertFilter_tb1").prop("selectedIndex", 0);
            });
            $("#expertFilter_tb1").change(function (e) {
                console.log(expertrindex_tb1);
                customSearhContain_tb1("#expertFilter_tb1",expertrindex_tb1);
                $("#leaderFilter_tb1").prop("selectedIndex", 0);
            });

            function customSearhContain_tb1(el,elindex){
                $.fn.dataTable.ext.search = [];
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        var elval = $(el).val();

                        var arr = data[elindex];
                            if (elval === '' || arr.includes(elval)) {  
                                return true;
                            }
                        return false;
                    }
                );
                table_tb1.draw();
            }
            function customSearhExact_tb1(el,elindex){
                $.fn.dataTable.ext.search = [];
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        var elval = $(el).val();
                        var arr = data[elindex];
                            if (elval === '' || (arr == elval)) {  
                                return true;
                            }
                        return false;
                    }
                );
                table_tb1.draw();
            }
        }
 
</script>
@stop
