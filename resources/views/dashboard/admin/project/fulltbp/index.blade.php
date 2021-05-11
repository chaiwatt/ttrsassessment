@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/plugins/summernote/summernote.min.css')}}" rel="stylesheet">
@stop
@section('content')
    {{-- modal_edit_fulltbp --}}
    <div id="modal_edit_fulltbp" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;การอนุมัติแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="my_radio_box">
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-input-styled" name="result" value="1" checked data-fouc>
                                        อนุมัติ
                                    </label>
                                </div>
            
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-input-styled" name="result" value="2" data-fouc>
                                        ให้แก้ไข
                                    </label>
                                </div>
                            </div>
                        </form>

                        <hr>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label id="messageshow">ข้อความเพิ่มเติม</label>
                                <textarea type="text" rows="5"  id="note" placeholder="ข้อความเพิ่มเติม แจ้งไปยังผู้ประกอบการ" class="form-control form-control-lg" ></textarea>
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_edit_fulltbp" class="btn bg-primary"><i class="icon-checkmark3 font-size-base mr-1"></i> บันทึก</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal_edit_projectmember --}}
    <div id="modal_edit_projectmember" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ทีมผู้เชี่ยวชาญการประเมิน</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    ทีมผู้เชี่ยวชาญการประเมิน
                    <div class="row">
                        <div class="col-md-12" >
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ชื่อ</th> 
                                            <th>นามสกุล</th> 
                                            {{-- <th>เพิ่มเติม</th>                                                                                    --}}
                                        </tr>
                                    </thead>
                                    <tbody id="usermember_wrapper_tr"> 
        
                                    </tbody>
                                </table>
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

    {{-- modal_mailto_user --}}
    <div id="modal_mailto_user" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ส่งอีเมลผู้ประกอบการ</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>หัวข้อ</label>
                                    <input type="text" id="topic" placeholder="หัวข้อ" class="form-control form-control-lg" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ข้อความ<span class="text-danger">*</span></label>
                                <textarea type="text" rows="5" id="messagebody" placeholder="ข้อความ" class="form-control form-control-lg"></textarea>
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_mailto_user" class="btn bg-primary"><i class="icon-spinner spinner mr-2" id="userspinicon" hidden></i> ส่งอีเมล</button>
                </div>
            </div>
        </div>
    </div>

        {{-- modal_mailto_member --}}
        <div id="modal_mailto_member" class="modal fade" style="overflow:hidden;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ส่งอีเมลทีมในโครงการ</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>หัวข้อ</label>
                                        <input type="text" id="topicmember" placeholder="หัวข้อ" class="form-control form-control-lg" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>ข้อความ<span class="text-danger">*</span></label>
                                    <textarea type="text" rows="5" id="messagebodymember" placeholder="ข้อความ" class="form-control form-control-lg"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>ผู้รับ</label><span class="text-danger">*</span>
                                    <select name="users[]" id="user" data-placeholder="ผู้รับ" class="form-control form-control-lg form-control-select2" multiple="multiple">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>           
                    <div class="modal-footer">
                        <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                        <button id="btn_modal_mailto_member" class="btn bg-primary"><i class="icon-spinner spinner mr-2" id="memberspinicon" hidden></i> ส่งอีเมล</button>
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

    <div id="modal_show_reviselog" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;รายการแก้ไข โครงการ<span id="showlogminitbp"></span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" >
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>รายละเอียด</th> 
                                            <th>ให้แก้ไขโดย</th>
                                            <th>วันที่</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="reviselog_wrapper_tr"> 
        
                                    </tbody>
                                </table>
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
                <h4> <span class="font-weight-semibold">แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>โครงการ</a>
                    <span class="breadcrumb-item active">แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)</span>
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
                <div class="card" >
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">รายการแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)</h6>
                        <div class="header-elements">
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="text" id="fulltbpid"  hidden>
                        <div class="table-responsive" style="min-height: 230px">
                            <table class="table table-striped" id="maintable">
                                <thead>
                                    <tr>
                                        <th>ชื่อโครงการ</th> 
                                        <th>การอนุมัติ</th> 
                                        <th>ผู้เชี่ยวชาญ</th> 
                                        <th>EV</th> 
                                        <th>BOL</th> 
                                        <th>สถานะ</th>                               
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fulltbps as $key => $fulltbp)
                                        @if ($fulltbp->minitbp->businessplan->business_plan_status_id > 4 )
                                            <tr>    
                                                <td> 
                                                    <a href="#" data-toggle="modal" data-id="{{$fulltbp->minitbp->id}}" class="controlflowicon"><i class="icon-cog2 text-info mr-2"></i></a>
                                                    <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->company->id])}}" class="text-info" target="_blank" >{{$fulltbp->minitbp->project}} </a>  
                                                </td>  
                                                <td>    
                                                    @if ($fulltbp->minitbp->businessplan->business_plan_status_id > 5 )
                                                            <a href="#" type="button" data-id="{{$fulltbp->id}}" class="badge badge-flat border-success text-success-600">ผ่านการอนุมัติ</a>
                                                        @else
                                                            @if ($fulltbp->refixstatus == 0)
                                                                    <a href="#" type="button" data-id="{{$fulltbp->id}}" id="editapprove" class="btn btn-sm bg-warning"><i class="icon-spinner spinner mr-2" id="spinicon{{$fulltbp->id}}" hidden></i>ยังไม่ได้อนุมัติ</a>
                                                                @elseif($fulltbp->refixstatus == 1)
                                                                    <span class="badge badge-flat border-pink text-pink-600">ส่งคืนแก้ไข</span>
                                                                    @if ($fulltbp->minitbp->reviselog(2)->count() > 0)
                                                                        <a href="#" data-id="{{$fulltbp->minitbp->id}}" data-project="{{$fulltbp->minitbp->project}}" data-doctype="2" class="btn btn-sm bg-pink showlog" ><i class="icon-spinner spinner mr-2" id="spinicon_showlog{{$fulltbp->minitbp->id}}" hidden></i>รายการแก้ไข</a>
                                                                    @endif
                                                                @elseif($fulltbp->refixstatus == 2)
                                                                    <a href="#" type="button" data-id="{{$fulltbp->id}}" id="editapprove" class="btn btn-sm bg-indigo"><i class="icon-spinner spinner mr-2" id="spinicon{{$fulltbp->id}}" hidden></i>มีการแก้ไขแล้ว</a>
                                                                    @if ($fulltbp->minitbp->reviselog(2)->count() > 0)
                                                                        <a href="#" data-id="{{$fulltbp->minitbp->id}}" data-project="{{$fulltbp->minitbp->project}}" data-doctype="2" class="btn btn-sm bg-pink showlog" ><i class="icon-spinner spinner mr-2" id="spinicon_showlog{{$fulltbp->minitbp->id}}" hidden></i>รายการแก้ไข</a>
                                                                    @endif
                                                            @endif       
                                                    @endif
                                                </td>
                                                <td> 
                                                    @if ($fulltbp->expertassignments->count() > 0)
                                                            @if ($fulltbp->expertassignments->where('expert_assignment_status_id',1)->count() > 0)
                                                                    <a  href="{{route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id])}}" class="btn btn-sm bg-info">มีรายการรอ JD พิจารณา</a>
                                                                @elseif($fulltbp->expertassignments->where('expert_assignment_status_id',2)->count() > 0)
                                                                    @if ($fulltbp->assignexpert !=2)
                                                                            <a  href="{{route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id])}}" class="btn btn-sm bg-pink">อยู่ระหว่างผู้เชียวชาญตอบรับ</a>
                                                                        @else
                                                                            <a  href="{{route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id])}}" class="badge badge-flat border-success text-success-600">มอบหมายแล้ว</a>
                                                                    @endif
                                                            @endif  
                                                        @else
                                                            <a  href="{{route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id])}}" class="btn btn-sm bg-warning">ยังไม่ได้มอบหมาย</a>
                                                    @endif
                                                </td>  
                                                <td> 
                                                    @if (!Empty($fulltbp->ev))
                                                        @php
                                                            $evstatus = 'ผ่านการอนุมัติ';
                                                            $style = 'badge badge-flat border-success text-success-600';
                                                            if($fulltbp->ev->status == 0){
                                                                $evstatus = 'อยู่ระหว่างการสร้าง EV';
                                                                $style = 'btn-sm bg-warning';
                                                            }elseif($fulltbp->ev->status == 1){
                                                                if($fulltbp->ev->refixstatus == 0){
                                                                    $evstatus = 'อยู่ระหว่าง JD ตรวจสอบ';
                                                                    $style = 'btn-sm bg-warning';
                                                                }else if($fulltbp->ev->refixstatus == 1){
                                                                    $evstatus = 'ส่งคืนแก้ไข';
                                                                    $style = 'btn-sm bg-pink';
                                                                }else if($fulltbp->ev->refixstatus == 2){
                                                                    $evstatus = 'มีการแก้ไขแล้ว';
                                                                    $style = 'btn-sm bg-indigo';
                                                                }
                                                            }elseif($fulltbp->ev->status == 2){
                                                                $evstatus = 'อยู่ระหว่าง Admin กำหนด Weight';
                                                                $style = 'btn-sm bg-pink';
                                                            }
                                                            elseif($fulltbp->ev->status == 3){
                                                                $evstatus = 'อยู่ระหว่าง JD พิจารณา';
                                                                $style = 'btn-sm bg-pink';
                                                            }
                                                        @endphp
            
                                                        @if (Auth::user()->user_type_id == 4)
                                                                <a type="button" href="{{route('dashboard.admin.project.fulltbp.editev',['id' => $fulltbp->ev->id])}}" class="{{$style}}">{{$evstatus}}</a>
                                                            @elseif(Auth::user()->user_type_id == 5)
                                                                @if ($fulltbp->ev->status < 2)
                                                                        <span class="badge badge-flat border-info text-info-600">{{$evstatus}}</span>
                                                                    @else
                                                                        <a type="button" href="{{route('dashboard.admin.project.evweight.edit',['id' => $fulltbp->ev->id])}}" class="{{$style}}">{{$evstatus}}</a>
                                                                @endif
                                                            @elseif(Auth::user()->user_type_id == 6)
                                                                @if ($fulltbp->ev->status == 0)
                                                                        <span class="badge badge-flat border-info text-info-600">{{$evstatus}}</span>
                                                                    @elseif($fulltbp->ev->status == 3)
                                                                        <a type="button" href="{{route('dashboard.admin.project.evweight.edit',['id' => $fulltbp->ev->id])}}" class="{{$style}}">{{$evstatus}}</a>
                                                                    @else   
                                                                        <a type="button" href="{{route('dashboard.admin.project.fulltbp.editev',['id' => $fulltbp->ev->id])}}" class="{{$style}}">{{$evstatus}}</a>
                                                                @endif
                                                        @endif
                                                    @else
                                                            <a href="{{route('dashboard.admin.project.fulltbp.viewev',['id' => $fulltbp->id])}}" class="btn btn-sm bg-warning">ยังไม่ได้เพิ่ม</a>
                                                    @endif
                                                </td> 
                                                <td> 
                                                    @if ( $fulltbp->bol->count() != 0)
                                                            <a href="{{route('dashboard.admin.project.fulltbp.bol',['id' => $fulltbp->id])}}" type="button" class="badge badge-flat border-success text-success-600">เอกสาร BOL</a> 
                                                        @else
                                                            <a href="{{route('dashboard.admin.project.fulltbp.bol',['id' => $fulltbp->id])}}" type="button" class="btn btn-sm bg-warning">เพิ่มเอกสาร BOL</a>  
                                                    @endif
                                                </td>  
                                                <td>
                                                    @if (!Empty($fulltbp->assessmentdate))
                                                            @if ($fulltbp->finished_onsite == 1)
                                                                    @if (Auth::user()->user_type_id == 4)
                                                                        <button type="button" href="#" data-id="{{$fulltbp->id}}" data-toggle="modal" class="btn btn-sm bg-warning finishonsite"><i class="icon-spinner spinner mr-2" id="spiniconfinishonsite{{$fulltbp->id}}" hidden></i>ยังไม่ได้ยืนยันการลงพื้นที่</button>
                                                                    @else
                                                                        <span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้ยืนยันการลงพื้นที่</span>
                                                                    @endif
                                                                @else
                                                                {{-- {{$fulltbp->minitbp->businessplan->business_plan_status_id}} --}}

                                                                @if (Auth::user()->user_type_id == 4)
                                                                        @if ($fulltbp->minitbp->businessplan->business_plan_status_id < 7)
                                                                                <a href="{{route('dashboard.admin.calendar.create')}}" class="btn btn-sm bg-warning">เพิ่มปฏิทินนัดหมายสรุปคะแนน</a>
                                                                            @elseif($fulltbp->minitbp->businessplan->business_plan_status_id == 7) 
                                                                                <span class="badge badge-flat border-info text-info-600">ลงคะแนนการประเมิน</span>
                                                                        @endif

                                                                    @else
                                                                        @if ($fulltbp->minitbp->businessplan->business_plan_status_id < 7)
                                                                                <span class="badge badge-flat border-warning text-warning-600">รอ Leader นัดหมายการสรุปคะแนน</span>
                                                                            @elseif($fulltbp->minitbp->businessplan->business_plan_status_id == 7) 
                                                                                <span class="badge badge-flat border-info text-info-600">ลงคะแนนการประเมิน</span>
                                                                        @endif
                                                                @endif 
                                                            @endif
                                                       @else
                                                            @if (Auth::user()->user_type_id == 4)
                                                                    @if ($fulltbp->minitbp->businessplan->business_plan_status_id > 7)
                                                                        @if ($fulltbp->minitbp->businessplan->business_plan_status_id > 9)
                                                                            <a href="#" type="button" data-id="{{$fulltbp->id}}" class="badge badge-flat border-success text-success-600">สิ้นสุดโครงการ</a>
                                                                        @else
                                                                            <a href="#" type="button" data-id="{{$fulltbp->id}}" class="badge badge-flat border-success text-success-600">ลงพื้นที่แล้ว</a>
                                                                        @endif
                                                                            
                                                                        @else
                                                                            <a href="{{route('dashboard.admin.calendar.create')}}" class="btn btn-sm bg-warning">เพิ่มปฏิทินลงพื้นที่</a>
                                                                    @endif
                                                                @else
                                                                        @if ($fulltbp->minitbp->businessplan->business_plan_status_id > 9)
                                                                            <a href="#" type="button" data-id="{{$fulltbp->id}}" class="badge badge-flat border-success text-success-600">สิ้นสุดโครงการ</a>
                                                                        @else
                                                                            <span class="badge badge-flat border-pink text-pink-600">รอ Leader สร้างปฏิทินลงพื้นที่</span>
                                                                        @endif
                                                                        
                                                            @endif
                                                    @endif
                                                   
                                                </td>
                                                {{-- <td> 
                                                    <button type="button" id="projectmember{{$fulltbp->id}}" class="btn btn-sm bg-info projectmember" data-id="{{$fulltbp->id}}">{{$fulltbp->projectmember->count()}} คน</button>
                                                </td> --}}
                                                {{-- <td class="text-right">
                                                    <div class="list-icons">
                                                        <div class="list-icons-item dropdown">
                                                            <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="{{asset($fulltbp->attachment)}}" class="dropdown-item"><i class="icon-file-download2"></i> PDF</a>
                                                                <a href="{{route('dashboard.admin.project.fulltbp.downloadzip',['id' => $fulltbp->id])}}" data-id="{{$fulltbp->id}}" class="dropdown-item"><i class="icon-file-download2"></i> ดาวน์โหลดเอกสารแนบ</a>
                                                                <a href="{{route('dashboard.admin.project.fulltbp.view',['id' => $fulltbp->id])}}" class="dropdown-item"><i class="icon-eye2"></i> รายละเอียด</a>
                                                                <a href="{{route('dashboard.admin.project.fulltbp.delete',['id' => $fulltbp->id])}}" class="dropdown-item"><i class="icon-trash"></i> ลบ</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="#" data-id="{{$fulltbp->id}}" class="dropdown-item mailtouser"><i class="icon-mail5"></i> อีเมลถึงผู้ประกอบการ</a>
                                                                <a href="#" data-id="{{$fulltbp->id}}" class="dropdown-item mailtomember"><i class="icon-mail5"></i> อีเเมลถึงทีมประเมิน</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>                               --}}
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
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/plugins/summernote/summernote.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/approvefulltbphelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/controlflow.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}",
        };
        $('#note').summernote({
			toolbar: false,
            height: 200,
		});


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