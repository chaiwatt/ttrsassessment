@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/plugins/summernote/summernote.min.css')}}" rel="stylesheet">
<style>
    td{
        padding-left:5px !important;
        padding-right:5px !important;
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
                                        <input type="radio" class="form-input-styled" name="result" value="1" data-fouc>
                                        อนุมัติ
                                    </label>
                                </div>
            
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-input-styled" name="result" value="2" checked data-fouc>
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

    <div id="modal_show_approvelog" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;โครงการ: <span id="showapprovelogminitbp"></span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" >
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" >
                                    <thead>
                                        <tr>
                                            <th style="white-space: nowrap;text-align: center">รายละเอียด</th> 
                                            <th style="white-space: nowrap;text-align: center">อนุมัติโดย</th>
                                            <th style="white-space: nowrap;text-align: center">วันที่</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <td id="approvelog_detail"></td>
                                        <td id="approvelog_info"></td>
                                        <td style="text-align: center;width:1%;white-space: nowrap" id="approvelog_date"></td>
        
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
                                            <th style="white-space: nowrap;text-align: center">รายละเอียด</th> 
                                            <th style="white-space: nowrap;text-align: center">ให้แก้ไขโดย</th>
                                            <th style="width:1%;white-space: nowrap;text-align: center">วันที่</th>
                                            
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
                        @php
                            $tbdelaymsg = '';
                            foreach ($fulltbps as $key => $_item) {
                                if (@$_item->minitbp->isintime($_item->minitbp->id) < 0 && $_item->minitbp->businessplan->business_plan_status_id > 4) {
                                    $tbdelaymsg = '<span class="text-danger">(พบโครงการเกินกำหนด Control flow)</span>';
                                break ;
                                }
                            }
                        @endphp
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">รายการแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) {!!$tbdelaymsg!!}</h6>
                        <div class="header-elements">
                            <div class="list-icons ml-3">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="#" data-toggle="modal" id="select_maintable_excel" class="dropdown-item"><i class="icon-file-excel"></i>Excel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="text" id="fulltbpid"  hidden>
                        @if ($fulltbps->count() > 0)
                            <div >
                                <select id="gradeFilter" class="form-control">
                                <option value="">== เกรด ==</option>
                                @foreach ($gradecollection->sortDesc()->reverse() as $grade)
                                    <option value="{{$grade}}">{{$grade}}</option>
                                @endforeach
                                {{-- <option value="AAA">AAA</option>
                                <option value="AA">AA</option>
                                <option value="A">A</option>
                                <option value="BBB">BBB</option>
                                <option value="BB">BB</option>
                                <option value="B">B</option>
                                <option value="CCC">CCC</option>
                                <option value="CC">CC</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option> --}}
                                </select>
                            </div>
                            <div >
                                <select id="leaderFilter" class="form-control ">
                                <option value="">== Leader ==</option>
                                @foreach ($leaders as $leader)
                                    <option value="{{$leader->name}} {{$leader->lastname}}">{{$leader->name}} {{$leader->lastname}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div >
                                <select id="expertFilter" class="form-control">
                                <option value="">== ผู้เชี่ยวชาญ ==</option>
                                    @foreach ($experts as $expert)
                                        <option value="{{$expert->name}} {{$expert->lastname}}">{{$expert->name}} {{$expert->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="table-responsive" style="min-height: 230px">
                            <table class="table table-bordered table-striped mb-2" id="maintable">
                                <thead>
                                    <tr class="bg-info">
                                        <th hidden>date</th>
                                        <th style="width:1%;white-space: nowrap;text-align:center">เลขที่โครงการ</th>
                                        <th style="width:1%;white-space: nowrap;text-align:center">ชื่อโครงการ</th> 
                                        
                                        <th style="width:1%;white-space: nowrap;text-align:center">Full TBP</th> 
                                        <th style="width:1%;white-space: nowrap;text-align:center">ผู้เชี่ยวชาญ</th> 
                                        <th style="width:1%;white-space: nowrap;text-align:center">EV</th> 
                                        <th style="width:1%;white-space: nowrap;text-align:center">BOL</th> 
                                        <th style="width:1%;white-space: nowrap;text-align:center">สถานะ</th>   
                                        <th style="width:1%;white-space: nowrap;text-align:center" hidden>hidden_leader</th> 
                                        <th style="width:1%;white-space: nowrap;text-align:center" hidden>hidden_expert</th>                             
                                        <th style="width:1%;white-space: nowrap;text-align:center" hidden>hidden_grade</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fulltbps as $key => $fulltbp)
                                        @if ($fulltbp->minitbp->businessplan->business_plan_status_id > 4 )
                                            <tr>  
                                                <td hidden>{{$fulltbp->updated_at}}</td>  
                                                <td style="width:1%;white-space: nowrap;text-align:center">{{$fulltbp->fulltbp_code}}</td>
                                                <td style="white-space: nowrap"> 
                                                    @php
                                                        $cogcolor = 'text-info';
                                                        $latetext = '';
                                                        if (@$fulltbp->minitbp->isintime($fulltbp->minitbp->id) < 0) {
                                                            $cogcolor = 'text-danger';
                                                        
                                                            $latetext =  '<span class="badge badge-flat border-danger-600 text-danger-600">(เกินกำหนด '.$fulltbp->minitbp->isintime($fulltbp->minitbp->id)*(-1) .' วัน)</span>';
                                                        }
                                                    @endphp  
                                                    <a href="#" data-toggle="modal" data-id="{{$fulltbp->minitbp->id}}" class="controlflowicon"><i class="icon-cog2 {{$cogcolor}} mr-2"></i></a>
                                                    <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="{{$cogcolor}}" target="_blank" >{{$fulltbp->minitbp->project}} {!!$latetext!!}</a>  
                                                </td>  
                                                 
                                                <td style="width:1%;white-space: nowrap;text-align:center">    
                                                    {{-- {{$fulltbp->minitbp->businessplan->business_plan_status_id }} --}}
                                                    @if ($fulltbp->minitbp->businessplan->business_plan_status_id > 5 )

                                                            <a  href="{{route('dashboard.admin.project.fulltbp.view',['id' => $fulltbp->id])}}" ><span class="badge badge-flat border-success text-success-600">ผ่านการอนุมัติ</span></a>
                                                            {{-- <span class="badge badge-flat border-success text-success-600">ผ่านการอนุมัติ</span> --}}

                                                            @if (!Empty($fulltbp->approvelog))
                                                                <button data-id="{{$fulltbp->id}}" data-doctype="2" class="btn btn-sm bg-success showapprovelog">การอนุมัติ</button>
                                                            @endif

                                                            @if ($fulltbp->reviselog->count() > 0)
                                                                <button data-id="{{$fulltbp->minitbp->id}}" data-doctype="2" data-project="{{$fulltbp->minitbp->project}}" class="btn btn-sm bg-pink showlog">รายการแก้ไข</button>
                                                            @endif
                                                        @else
                                                            @if ($fulltbp->refixstatus == 0)
                                                                    <a href="#" data-id="{{$fulltbp->id}}" id="editapprove" class="btn btn-sm bg-warning"><i class="icon-spinner spinner mr-2" id="spinicon{{$fulltbp->id}}" hidden></i>ยังไม่ได้อนุมัติ</a>
                                                                @elseif($fulltbp->refixstatus == 1)
                                                                    <span class="badge badge-flat border-pink text-pink-600">ส่งคืนแก้ไข</span>
                                                                    @if ($fulltbp->minitbp->reviselog(2)->count() > 0)
                                                                        <a href="#" data-id="{{$fulltbp->minitbp->id}}" data-project="{{$fulltbp->minitbp->project}}" data-doctype="2" class="btn btn-sm bg-pink showlog" ><i class="icon-spinner spinner mr-2" id="spinicon_showlog{{$fulltbp->minitbp->id}}" hidden></i>รายการแก้ไข</a>
                                                                    @endif
                                                                @elseif($fulltbp->refixstatus == 2)
                                                                    <a href="#" data-id="{{$fulltbp->id}}" id="editapprove" class="btn btn-sm bg-indigo"><i class="icon-spinner spinner mr-2" id="spinicon{{$fulltbp->id}}" hidden></i>มีการแก้ไขแล้ว</a>
                                                                    @if ($fulltbp->minitbp->reviselog(2)->count() > 0)
                                                                        <a href="#" data-id="{{$fulltbp->minitbp->id}}" data-project="{{$fulltbp->minitbp->project}}" data-doctype="2" class="btn btn-sm bg-pink showlog" ><i class="icon-spinner spinner mr-2" id="spinicon_showlog{{$fulltbp->minitbp->id}}" hidden></i>รายการแก้ไข</a>
                                                                    @endif
                                                            @endif       
                                                    @endif
                                                </td>
                                                <td style="width:1%;white-space: nowrap;text-align:center">
                                                    {{-- {{$fulltbp->assignexpert}}  --}}
                                                    @if ($fulltbp->expertassignments->count() > 0)
                                                            @if ($fulltbp->expertassignments->where('expert_assignment_status_id',1)->count() > 0)
                                                                @if (Auth::user()->user_type_id >= 5)
                                                                        <a  href="{{route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id])}}" class="btn btn-sm bg-info">อยู่ระหว่าง Manager พิจารณา</a>
                                                                    @else
                                                                        <span class="badge badge-flat border-danger text-danger-600">อยู่ระหว่าง Manager พิจารณา</span>
                                                                @endif
                                                                    
                                                                @elseif($fulltbp->expertassignments->where('expert_assignment_status_id',2)->count() > 0)
                                                                    @if ($fulltbp->assignexpert !=2)
                                                                            <a  href="{{route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id])}}" class="btn btn-sm bg-pink">อยู่ระหว่างผู้เชียวชาญตอบรับ</a>
                                                                        @else
                                                                            <a  href="{{route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id])}}" >
                                                                                <span class="badge badge-flat border-success text-success-600">มอบหมายแล้ว</span>
                                                                            </a>
                                                                    @endif
                                                            @endif  
                                                        @else
                                                        @if (Auth::user()->isProjectLeader($fulltbp->id) == 0)
                                                                <span class="badge badge-flat border-danger text-danger-600">ยังไม่ได้มอบหมาย</span>
                                                            @else
                                                            @if ($fulltbp->minitbp->businessplan->business_plan_status_id <=5 )
                                                                    <span class="badge badge-flat border-danger text-danger-600">ยังไม่ได้มอบหมาย</span>
                                                                @else
                                                                    <a  href="{{route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id])}}" class="btn btn-sm bg-warning">ยังไม่ได้มอบหมาย</a>
                                                            @endif
                                                                
                                                        @endif
                                                           
                                                    @endif
                                                </td>  
                                                <td style="width:1%;white-space: nowrap;text-align:center"> 
                                                    {{-- {{$fulltbp->ev->status}} --}}
                                                    @if (!Empty($fulltbp->ev))
                                                        @php
                                                            $evstatus = 'ผ่านการอนุมัติ';
                                                            $style = 'badge badge-flat border-success text-success-600';
                                                            if($fulltbp->ev->status == 0){
                                                                $evstatus = 'ยังไม่ได้สร้าง EV';
                                                                if($fulltbp->ev->isevadd > 0){
                                                                    $evstatus = 'อยู่ระหว่างการสร้าง EV';
                                                                }

                                                                $style = 'btn-sm bg-warning';
                                                            }elseif($fulltbp->ev->status == 1){
                                                                if($fulltbp->ev->refixstatus == 0){
                                                                    $evstatus = 'อยู่ระหว่าง Manager ตรวจสอบ';
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
                                                                $evstatus = 'อยู่ระหว่าง Manager พิจารณา';
                                                                $style = 'btn-sm bg-pink';
                                                            }
                                                        @endphp
  
                                                        @if (Auth::user()->user_type_id == 4)
                                                        @if ($fulltbp->ev->status >= 4)
                                                                <a  href="{{route('dashboard.admin.project.fulltbp.editev',['id' => $fulltbp->ev->id])}}" ><span class="badge badge-flat border-success text-success-600">{{$evstatus}}</span></a>
                                                            @else
                                                                
                                                                @if ($fulltbp->assignexpert !=2 )
                                                                    <span class="badge badge-flat border-warning text-warning-600">{{$evstatus}}</span>
                                                                @else
                                                                    <a  href="{{route('dashboard.admin.project.fulltbp.editev',['id' => $fulltbp->ev->id])}}" class="{{$style}}">{{$evstatus}}</a>
                                                                @endif
                                                                
                                                        @endif
                                                                
                                                                
                                                            @elseif(Auth::user()->user_type_id == 5)
                                                                @if ($fulltbp->ev->status < 2)
                                                                        <span class="badge badge-flat border-warning text-warning-600">{{$evstatus}}</span>
                                                                    @else
                                                                        @if ($fulltbp->ev->status >= 4)
                                                                        <a  href="{{route('dashboard.admin.project.evweight.edit',['id' => $fulltbp->ev->id])}}" ><span class="badge badge-flat border-success text-success-600">{{$evstatus}}</span></a>
                                                                        @else
                                                                        <a  href="{{route('dashboard.admin.project.evweight.edit',['id' => $fulltbp->ev->id])}}" class="{{$style}}">{{$evstatus}}</a>
                                                                        @endif
                                                                       
                                                                @endif
                                                            @elseif(Auth::user()->user_type_id == 6)
                                                                @if ($fulltbp->ev->status == 0)
                                                                        <span class="badge badge-flat border-warning text-warning-600">{{$evstatus}}</span>
                                                                    @elseif($fulltbp->ev->status == 3)
                                                                        <a  href="{{route('dashboard.admin.project.evweight.edit',['id' => $fulltbp->ev->id])}}" class="{{$style}}">{{$evstatus}}</a>
                                                                    @else   
                                                                    @if ($fulltbp->ev->status >= 4)
                                                                    <a  href="{{route('dashboard.admin.project.fulltbp.editev',['id' => $fulltbp->ev->id])}}" ><span class="badge badge-flat border-success text-success-600">{{$evstatus}}</span></a>
                                                                    @else
                                                                    <a  href="{{route('dashboard.admin.project.fulltbp.editev',['id' => $fulltbp->ev->id])}}" class="{{$style}}">{{$evstatus}}</a>
                                                                    @endif
                                                                       
                                                                @endif
                                                        @endif
                                                    @else
                                                            <a href="{{route('dashboard.admin.project.fulltbp.viewev',['id' => $fulltbp->id])}}" class="btn btn-sm bg-warning">ยังไม่ได้เพิ่ม</a>
                                                    @endif
                                                </td> 
                                                <td style="width:1%;white-space: nowrap;text-align:center"> 
                                                    @if ( $fulltbp->bol->count() != 0)
                                                            <a href="{{route('dashboard.admin.project.fulltbp.bol',['id' => $fulltbp->id])}}" >
                                                                <span class="badge badge-flat border-success text-success-600">เอกสาร BOL</span>
                                                            </a> 
                                                        @else
                                                            @if (Auth::user()->user_type_id == 4)        
                                                                    @if ($fulltbp->ev->status >= 4)
                                                                            <a href="{{route('dashboard.admin.project.fulltbp.bol',['id' => $fulltbp->id])}}" class="btn btn-sm bg-warning">เพิ่มเอกสาร BOL</a> 
                                                                        @else
                                                                            <span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้เพิ่ม</span>
                                                                    @endif 
                                                                @else
                                                                    <span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้เพิ่ม</span>
                                                            @endif
                                                    @endif
                                                </td>  
                                                <td style="width:1%;white-space: nowrap;text-align:center">
                                                    @if (!Empty($fulltbp->canceldate))
                                                        <span class="badge badge-flat border-warning text-warning-400 rounded-0">โครงการถูกยกเลิก</span>
                                                    @else
                                                        @if (!Empty($fulltbp->assessmentdate))
                                                            @if ($fulltbp->finished_onsite == 1)
                                                                    @if (Auth::user()->user_type_id == 4)
                                                                        <button type="button" href="#" data-id="{{$fulltbp->id}}" data-toggle="modal" class="btn btn-sm bg-warning finishonsite"><i class="icon-spinner spinner mr-2" id="spiniconfinishonsite{{$fulltbp->id}}" hidden></i>ยังไม่ได้ยืนยันการลงพื้นที่</button>
                                                                    @else
                                                                        <span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้ยืนยันการลงพื้นที่</span>
                                                                    @endif
                                                                @else

                                                                @if (Auth::user()->user_type_id == 4)
                                                                        @if ($fulltbp->minitbp->businessplan->business_plan_status_id < 7)
                                                                                <a href="{{route('dashboard.admin.calendar.createcalendar',['id' => $fulltbp->id])}}" class="btn btn-sm bg-warning">เพิ่มปฏิทินนัดหมายสรุปคะแนน</a>
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
                                                                                    
                                                                                    <span class="badge badge-flat border-success text-success-600">สิ้นสุดโครงการ</span>
                                                                                @else
                                                                                    <a href="#" data-id="{{$fulltbp->id}}" class="badge badge-flat border-success text-success-600">ลงพื้นที่แล้ว</a>
                                                                                @endif  
                                                                            @else
                                                                            @if ($fulltbp->minitbp->flowstagefour == true)
                                                                                    <a href="{{route('dashboard.admin.calendar.createcalendar',['id' => $fulltbp->id])}}" class="btn btn-sm bg-warning">เพิ่มปฏิทินลงพื้นที่</a>
                                                                            @else
                                                                                    <span class="badge badge-flat border-pink text-pink-600">รออนุมัติ Full TBP/ผู้เชี่ยวชาญ/EV</span>
                                                                            @endif
                                                                                
                                                                        @endif
                                                                    @else
                                                                            @if ($fulltbp->minitbp->businessplan->business_plan_status_id > 9)
                                                                              
                                                                                <span class="badge badge-flat border-success text-success-600">สิ้นสุดโครงการ</span>
                                                                            @else
                                                                                @if ($fulltbp->minitbp->flowstagefour == true)
                                                                                        <span class="badge badge-flat border-pink text-pink-600">รอ Leader สร้างปฏิทินลงพื้นที่</span>
                                                                                    @else
                                                                                        <span class="badge badge-flat border-pink text-pink-600">รออนุมัติ Full TBP/ผู้เชี่ยวชาญ/EV</span>
                                                                                @endif
                                                                                
                                                                            @endif
                                                                            
                                                                @endif
                                                        @endif
                                                    @endif
                                                </td>
                                                <td hidden>{{$fulltbp->searchprojectleader}}</td>
                                                <td hidden>{{$fulltbp->searchprojectexpert}}</td>
                                                <td hidden>{{$fulltbp->searchprojectgrade}}</td>
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

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>


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
        callbacks: {
            onPaste: function (e) {
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                e.preventDefault();
                document.execCommand('insertText', false, bufferText);
            }
        }
    });

        var countitemtable =  "{{$fulltbps->count()}}";
        if (countitemtable >= 1) {
            $('#maintable').DataTable( {
                "paging":   true,
                "ordering": true,
                "order": [[ 0, 'desc' ]],
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
                },
                buttons: [
                    { 
                        extend: 'excelHtml5',
                        className: 'btn-primary',
                        text: 'Excel',
                        title: function () { 
                            return null; 
                        },
                        filename: function() {
                            return "รายการแผนธุรกิจเทคโนโลยี" ;      
                        }, 
                        exportOptions: {
                            columns: [  1,2,3,4, 5,6,7]
                        },
                        customize: function( xlsx ) {
                            var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                            source.setAttribute('name','รายการแผนธุรกิจเทคโนโลยี');
                        }, 
                    }        
                ],
                drawCallback: function() {
                    // $('.buttons-excel')[0].style.visibility = 'hidden';
                }
            });

            var table = $('#maintable').DataTable();
            $("#maintable_filter.dataTables_filter").append($("#leaderFilter"));
            $("#maintable_filter.dataTables_filter").append($("#expertFilter"));
            $("#maintable_filter.dataTables_filter").append($("#gradeFilter"));

            var leaderindex = 0;
            var expertrindex = 0;
            var gradeindex = 0;
            
            $("#maintable th").each(function (i) {
                if ($($(this)).html() == "hidden_leader") {
                    leaderindex = i; 
                }
                if ($($(this)).html() == "hidden_expert") {
                    expertrindex = i; 
                }
                if ($($(this)).html() == "hidden_grade") {
                    gradeindex = i; 
                }
            });

            $("#leaderFilter").change(function (e) {
                customSearhExact("#leaderFilter",leaderindex);
                $("#expertFilter").prop("selectedIndex", 0);
                $("#gradeFilter").prop("selectedIndex", 0);
            });
            $("#expertFilter").change(function (e) {
                customSearhContain("#expertFilter",expertrindex);
                $("#leaderFilter").prop("selectedIndex", 0);
                $("#gradeFilter").prop("selectedIndex", 0);
            });
            $("#gradeFilter").change(function (e) {
                customSearhExact("#gradeFilter",gradeindex);
                $("#leaderFilter").prop("selectedIndex", 0);
                $("#expertFilter").prop("selectedIndex", 0);
            });

            
            function customSearhContain(el,elindex){
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
                table.draw();
            }
            function customSearhExact(el,elindex){
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
                table.draw();
            }
        }

        $(document).on('click', '#select_maintable_excel', function(e) {
            $('#maintable').DataTable().buttons(0,0).trigger();
        });
    </script>
@stop
