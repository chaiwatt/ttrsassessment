@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <div id="modal_edit_projectmember" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ทีมลงคะแนน</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row" id="selectothermember">
                        <div class="col-md-12" >
                            <label>เลือกผู้ใช้</label>
                            <div class="form-group header-elements-md-inline">
                                <select name="usermember" id="usermember" data-placeholder="เลือกผู้ใช้" class="form-control form-control-select2">
                                </select> 
                                &nbsp;<button id="btn_modal_edit_projectmember" class="btn bg-teal" > เพิ่ม</button>
                            </div>
                        </div>
                    </div>
             
                    <div class="row">
                        <div class="col-md-12" >
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ชื่อ</th> 
                                            <th>นามสกุล</th> 
                                            <th id="thother">เพิ่มเติม</th>                                                                                   
                                        </tr>
                                    </thead>
                                    <tbody id="usermember_wrapper_tr"> 
        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>           
                {{-- <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">ลงคะแนน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>โครงการ</a>
                    {{-- <a href="{{route('dashboard.admin.project.assessment')}}" class="breadcrumb-item">ลงคะแนน</a> --}}
                    <span class="breadcrumb-item active">ลงคะแนน</span>

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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">รายละเอียดโครงการ</h6>
                        <div class="header-elements">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="maintable">
                                <thead>
                                    <tr>
                                        {{-- <th>เลขที่โครงการ</th>  --}}
                                        <th>ชื่อโครงการ</th> 
                                        <th>บริษัท</th>
                                        <th style="width:1%;white-space: nowrap">ความเห็นผู้เชี่ยวชาญ</th> 
                                        <th style="width:1%;white-space: nowrap">ทีมลงคะแนน</th> 

                                        <th style="width:1%;white-space: nowrap">เพิ่มเติม</th>                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="text" id="fulltbpid" hidden>
                                   {{-- {{$fulltbps}} --}}
                                    @foreach ($fulltbps as $key => $fulltbp)
                                        @if (Empty($fulltbp->canceldate))
                                        {{-- {{$fulltbp->id}} --}}
                                            @if ($fulltbp->finished_onsite != 1 && $fulltbp->canceldate == null)
                                           {{-- sdfsfdvvv --}}
                                                @if ($fulltbp->minitbp->businessplan->business_plan_status_id >= 6 && $fulltbp->minitbp->businessplan->business_plan_status_id <= 8)
                                                    <tr>    
                                                        <td> {{$fulltbp->minitbp->project}} </td>  
                                                        <td> {{$fulltbp->minitbp->businessplan->company->name}} </td> 
                                                        <td style="white-space: nowrap">
                                                            @if ($fulltbp->haveexpertcomment($fulltbp->id) > 0)
                                                            <a href="{{route('dashboard.admin.project.assessment.expertcommentpdf',['id' => $fulltbp->id])}}" class="btn btn-sm bg-teal" target="_blank">รายละเอียด</a>
                                                            @endif
                                                        
                                                        </td>
                                                        <td style="white-space: nowrap"> 
                                                            <button type="button" id="projectmember{{$fulltbp->id}}" data-projectleaderid="{{$fulltbp->projectleader}}" data-isprojectleader="{{Auth::user()->isProjectLeader($fulltbp->id)}}" class="btn btn-sm bg-info projectmember" data-id="{{$fulltbp->id}}">{{$fulltbp->projectmember->count()}} คน</button>
                                                        </td>  
                                                        
                                                        <td style="white-space: nowrap"> 
                                                            @if (!Empty($fulltbp->finalassessmentdate))
                                                                    @if (!Empty($fulltbp->ev->scoringstatus->count() != 0))
                                                                            <a href="{{route('dashboard.admin.project.assessment.edit',['id' => $fulltbp->id, 'userid' => Auth::user()->id])}}" class="btn btn-sm bg-success">ส่งแล้ว</a>
                                                                        @else
                                                                            <a href="{{route('dashboard.admin.project.assessment.edit',['id' => $fulltbp->id, 'userid' => Auth::user()->id])}}" class="btn btn-sm bg-warning">ยังไม่ได้ลงคะแนน</a>
                                                                    @endif
                                                                @else
                                                                @if ($fulltbp->finished_onsite == 0)
                                                                    <span class="badge badge-flat border-warning text-warning-600">รอ Leader ยืนยันลงพื้นที่</span>
                                                                @else
                                                                    
                                                                    @if (Auth::user()->user_type_id == 4)
                                                                            @if ($fulltbp->minitbp->businessplan->business_plan_status_id < 7)
                                                                                @if (Auth::user()->isProjectLeader($fulltbp->id) == 0)
                                                                                    <span class="badge badge-flat border-warning text-warning-600">รอ Leader นัดหมายการสรุปคะแนน</span>
                                                                                    @else
                                                                                        <a href="{{route('dashboard.admin.calendar.createcalendar',['id' => $fulltbp->id])}}" class="btn btn-sm bg-warning">เพิ่มปฏิทินนัดหมายสรุปคะแนน</a>
                                                                                @endif
                                                                                
                                                                            @endif
                                                                        @else
                                                                            <span class="badge badge-flat border-warning text-warning-600">รอ Leader นัดหมายการสรุปคะแนน</span>
                                                                    @endif

                                                                @endif        
                                                            @endif
                                                        </td>     
                                                                                
                                                    </tr>
                                                @endif
                                            @endif

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
    <!-- /content area -->
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/approvefulltbphelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}",
        };

        var countitemtable =  "{{$fulltbps->count()}}";
        if (countitemtable >= 20) {
            $('#maintable').DataTable( {
                "paging":   true,
                "ordering": true,
                "info":     false,
                "pageLength" : 20,
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
        }
    </script>
@stop