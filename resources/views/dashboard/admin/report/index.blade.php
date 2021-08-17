@extends('layouts.dashboard.main')
@section('pageCss')

<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/daygrid/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/timegrid/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/list/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/aos/aos.css')}}" rel="stylesheet">
{{-- <link href="{{asset('assets/dashboard/js/plugins/chart/chart.css')}}"> --}}

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
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;โครงการ<span id="showapprovelogminitbp"></span></h5>
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


{{-- modal_get_calendar --}}
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
                                    <input type="text" id="jointype" hidden>
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="attendee_modal">
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

                                <div class="col-md-12 mt-2" >
                                    <label><strong>การเข้าร่วม</strong> </label>
                                    <div class="col-md-12" class="confirm" id="attendevent">
    
                                    </div>
                                </div>


                                <div class="col-md-12 mt-2" id="rej_meeting_note_wrapper" hidden>
                                    <div class="form-group">
                                        <label><u>โปรดระบุเหตุผล</u></label>
                                        <textarea type="text" rows="5"  id="rej_meeting_note" placeholder="โปรดระบุเหตุผลการไม่เข้าร่วมประชุม" class="form-control form-control-lg" ></textarea>
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <div class="tab-pane fade" id="left-icon-tab2">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="attendee_modal">
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
                    <button id="btn_modal_get_calendar"  class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i>บันทึก</button>
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
                                            <th style="white-space: nowrap;text-align: center">วันที่</th>
                                            
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
                                <textarea type="text" rows="5"  id="rej_note" placeholder="ข้อความเพิ่มเติม สาเหตุการไม่เข้าร่วมโครงการ" class="form-control form-control-lg" ></textarea>
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
                <h4> <span class="font-weight-semibold">หน้าแรก</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            @if (Auth::user()->company->saveprofile == 0)
                <div class="header-elements d-none">
                    <a href="{{route('setting.profile.officer.edit',['userid' => Auth::user()->id])}}" class="btn btn-labeled bg-warning" ><span class="blink">โปรดตั้งค่า Profile</span></a>
                </div>
            @endif
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
    <div class="content">
        @if ($generalinfo->showalert_id == 1)
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

        @endif
        @if (Auth::user()->user_type_id >= 5)
        <div class="row">
            <div class="col">
                <div class="card bg-teal-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h1 class="font-weight-semibold mb-0">{{$businessplans->count()}}</h1>
                        </div>
                        <div>
                          <a href="{{route('dashboard.admin.search.project')}}" class="text-white">จำนวนผู้สมัคร</a>  
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div id="members-online"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-blue-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h1 class="font-weight-semibold mb-0">{{$businessplans->where('business_plan_status_id','>=',4)->count()}}</h1>
                        </div>
                        <div>
                            <a href="{{route('dashboard.admin.realtimereport.project.minitbpbyyear')}}" class="text-white">จำนวนยื่น Mini Tbp</a>  
                            
                        </div>
                    </div>
                    <div id="today-revenue"></div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-pink-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h1 class="font-weight-semibold mb-0">{{$businessplans->where('business_plan_status_id','>=',6)->count()}}</h1>
                        </div>
                        <div>  
                            <a href="{{route('dashboard.admin.realtimereport.project.fulltbpbyyear')}}" class="text-white">จำนวนยื่น Full TBP</a>  
                        </div>
                    </div>
                    <div id="today-revenue"></div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-orange-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h1 class="font-weight-semibold mb-0">{{$businessplans->where('business_plan_status_id','>=',5)->where('business_plan_status_id','<',9)->count()}}</h1>
                        </div>
                        <div> 
                            <a href="{{route('dashboard.admin.realtimereport.project.finishedbyyear')}}" class="text-white">อยู่ระหว่างการประเมิน</a>
                        </div>
                    </div>
                    <div id="today-revenue"></div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-green-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h1 class="font-weight-semibold mb-0">{{$businessplans->where('business_plan_status_id','>=',9)->count()}}</h1>
                        </div>
                        <div> 
                            <a href="{{route('dashboard.admin.realtimereport.project.finishedbyyear')}}" class="text-white">โครงการที่ประเมินเสร็จสิ้น</a>
                        </div>
                    </div>
                    <div id="today-revenue"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
 
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">แยกตาม Pillar</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 c-100">
                                <canvas id="myChart" width=180  height=180 ></canvas>
                            </div>
                            <div class="col-md-9 l-40">
                              <div style="margin-top: 300px;"></div>
                              <div id="mainchart" hidden>
                                <ul class="chart-skills">
                                    <li>
                                      <span id="chartpillar4"></span>
                                    </li>
                                  </ul>
                                  <ul class="chart-skills2"> 
                                    <li>
                                        <span id="chartpillar3"></span>
                                    </li>
                                  </ul>
                                  <ul class="chart-skills3"> 
                                    <li>
                                        <span id="chartpillar2"></span>
                                    </li>
                                  </ul>
                                  <ul class="chart-skills4"> 
                                    <li>
                                        <span id="chartpillar1"></span>
                                    </li>
                                  </ul>
                              </div>
                              <div>
                                
                            </div>
                            </div>
                            <div class="col-md-1 l-75 table-none">
                                  <table class="table table-bordered table-h table-dark" data-aos="fade-laft" data-aos-delay="200" >
                                <thead>
                                  <tr>
                                   
                                    <td class="bg-01 white" colspan="2" style="padding-left: 5px !important; padding-right:5px !important">Level Classification</td>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr class="bg-02">
                                    <td >87-100</td>
                                    <td>AAA</td>
                                  </tr>
                                  <tr class="bg-03">
                                    <td>80-86</td>
                                    <td>AA</td>
                                  </tr>
                                  <tr class="bg-02">
                                    <td>74-79</td>
                                    <td>A</td>
                                  </tr>
                                  <tr class="bg-03">
                                    <td>70-73</td>
                                    <td>BBB</td>
                                  </tr>
                                  <tr class="bg-02">
                                    <td>64-69</td>
                                    <td>BB</td>
                                  </tr>
                                  <tr class="bg-03">
                                    <td>56-63</td>
                                    <td>B</td>
                                  </tr>
                                  <tr class="bg-02">
                                    <td>54-55</td>
                                    <td>CCC</td>
                                  </tr>
                                  <tr class="bg-03">
                                    <td>51-52</td>
                                    <td>CC</td>
                                  </tr>
                                  <tr class="bg-02">
                                    <td>48-50</td>
                                    <td>C</td>
                                  </tr>
                                  <tr class="bg-03">
                                    <td>25-47</td>
                                    <td>D</td>
                                  </tr>
                                  <tr class="bg-02">
                                    <td>0-24</td>
                                    <td>E</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row l-50">
                            <div class="f-table table2-none table-w">
                                <table class="table table-bordered table-dark" data-aos="fade-laft" data-aos-delay="200">
                                    <thead>
                                      <tr>
                                       
                                        <td class="bg-02 white" colspan="2">Level Classification</td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr class="bg-01">
                                        <td>87-100</td>
                                        <td>AAA</td>
                                      </tr>
                                      <tr class="bg-04">
                                        <td>80-86</td>
                                        <td>AA</td>
                                      </tr>
                                      <tr class="bg-02">
                                        <td>74-79</td>
                                        <td>A</td>
                                      </tr>
                                      <tr class="bg-03">
                                        <td>70-73</td>
                                        <td>BBB</td>
                                      </tr>
                                      <tr class="bg-02">
                                        <td>64-69</td>
                                        <td>BB</td>
                                      </tr>
                                      <tr class="bg-03">
                                        <td>56-63</td>
                                        <td>B</td>
                                      </tr>
                                      <tr class="bg-02">
                                        <td>54-55</td>
                                        <td>CCC</td>
                                      </tr>
                                      <tr class="bg-03">
                                        <td>51-52</td>
                                        <td>CC</td>
                                      </tr>
                                      <tr class="bg-02">
                                        <td>48-50</td>
                                        <td>C</td>
                                      </tr>
                                      <tr class="bg-03">
                                        <td>25-47</td>
                                        <td>D</td>
                                      </tr>
                                      <tr class="bg-02">
                                        <td>0-24</td>
                                        <td>E</td>
                                      </tr>
                                    </tbody>
                                  </table>
                            </div>
                            <div class="col-md-3 top-550">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-6"></div>
                                            <div class="col-sm-6"> 
                                                {{-- <h2><span style="font-weight: bold"> 01</span></h2> --}}
                                                <img src="{{asset('assets/dashboard/images/chart/01.png')}}" width="100px" alt=""></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6 class="color-01" style="font-weight: bold">Management</h6>
                                        <h5><span id="pillar_management"></span></h5>
                                        <h4 class="color-01"><span id="gradepillar_management"></span></h4>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-6"></div>
                                            <div class="col-sm-6"> 
                                                {{-- <h2><span style="font-weight: bold"> 02</span></h2> --}}
                                                <img src="{{asset('assets/dashboard/images/chart/02.png')}}" width="100px" alt=""></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6 class="color-02" style="font-weight: bold">Technology</h6>
                                        <h5><span id="pillar_tech"></span></h5>
                                        <h4 class="color-02"><span id="gradepillar_tech"></span></h4>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"> 
                                <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6"></div>
                                        <div class="col-sm-6"> 
                                            {{-- <h2><span style="font-weight: bold"> 03</span></h2> --}}
                                            <img src="{{asset('assets/dashboard/images/chart/03.png')}}" width="100px" alt=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="color-03" style="font-weight: bold">Marketability</h6>
                                    <h5><span id="pillar_marketability"></span></h5>
                                    <h4 class="color-03"><span id="gradepillar_marketability"></span></h4>
                                   
                                </div>
                            </div>
                        </div>
                            <div class="col-md-3">  <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6"></div>
                                        <div class="col-sm-6"> 
                                            {{-- <h2><span style="font-weight: bold"> 04</span></h2> --}}
                                            <img src="{{asset('assets/dashboard/images/chart/04.png')}}" width="100px" alt=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="color-04" style="font-weight: bold">Business Prospect</h6>
                                    <h5><span id="pillar_bp"></span></h5>
                                    <h4 class="color-04"><span id="gradepillar_bp"></span></h4>
                                   
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6" @if ($generalinfo->showgradeperpillar != 1) hidden @endif>
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">เกรดแยกตาม Pillar</h6>
                        <div class="header-elements">
                            <div class="list-icons ml-3">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="#" data-toggle="modal" id="select_gradebypillar_pie" class="dropdown-item"><i class="icon-pie-chart3"></i>Radar</a>
                                        <a href="#" data-toggle="modal" id="select_gradebypillar_bar" class="dropdown-item"><i class="icon-stats-bars2"></i>Bar</a>
                                        <a href="#" data-toggle="modal" id="select_gradebypillar_polar" class="dropdown-item"><i class="icon-spinner4"></i>Polar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebypillar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" @if ($generalinfo->showgradeperbusinesssize != 1) hidden @endif>
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">เกรดแยกตามขนาดธุรกิจ</h6>
                        <div class="header-elements">
                            <div class="list-icons ml-3">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="#" data-toggle="modal" id="select_gradebybusinesssize_pie" class="dropdown-item"><i class="icon-pie-chart3"></i>Radar</a>
                                        <a href="#" data-toggle="modal" id="select_gradebybusinesssize_bar" class="dropdown-item"><i class="icon-stats-bars2"></i>Bar</a>
                                        <a href="#" data-toggle="modal" id="select_gradebybusinesssize_polar" class="dropdown-item"><i class="icon-spinner4"></i>Polar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebybusinesssize"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6" @if ($generalinfo->showgradepersection != 1) hidden @endif>
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">เกรดแยกตามภูมิภาค</h6>
                        <div class="header-elements">
                            <div class="list-icons ml-3">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="#" data-toggle="modal" id="select_gradebysector_pie" class="dropdown-item"><i class="icon-pie-chart3"></i>Radar</a>
                                        <a href="#" data-toggle="modal" id="select_gradebysector_bar" class="dropdown-item"><i class="icon-stats-bars2"></i>Bar</a>
                                        <a href="#" data-toggle="modal" id="select_gradebysector_polar" class="dropdown-item"><i class="icon-spinner4"></i>Polar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebysector"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" @if ($generalinfo->showgradeperbusinesstype != 1) hidden @endif>
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">เกรดแยกตามประเภทธุรกิจ</h6>
                        <div class="header-elements">
                            <div class="list-icons ml-3">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="#" data-toggle="modal" id="select_gradebybusinesstype_pie" class="dropdown-item"><i class="icon-pie-chart3"></i>Radar</a>
                                        <a href="#" data-toggle="modal" id="select_gradebybusinesstype_bar" class="dropdown-item"><i class="icon-stats-bars2"></i>Bar</a>
                                        <a href="#" data-toggle="modal" id="select_gradebybusinesstype_polar" class="dropdown-item"><i class="icon-spinner4"></i>Polar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebybusinesstype"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" @if ($generalinfo->showgradeperindustrygroup != 1) hidden @endif>
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">เกรดแยกตามกลุ่มอุตสาหกรรม</h6>
                        <div class="header-elements">
                            <div class="list-icons ml-3">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="#" data-toggle="modal" id="select_gradebyindustry_pie" class="dropdown-item"><i class="icon-pie-chart3"></i>Radar</a>
                                        <a href="#" data-toggle="modal" id="select_gradebyindustry_bar" class="dropdown-item"><i class="icon-stats-bars2"></i>Bar</a>
                                        <a href="#" data-toggle="modal" id="select_gradebyindustry_polar" class="dropdown-item"><i class="icon-spinner4"></i>Polar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebyindustry"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" @if ($generalinfo->showgradeperisic != 1) hidden @endif>
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">เกรดแยกตาม Isic</h6>
                        <div class="header-elements">
                            <div class="list-icons ml-3">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="#" data-toggle="modal" id="select_gradebyisic_pie" class="dropdown-item"><i class="icon-pie-chart3"></i>Radar</a>
                                        <a href="#" data-toggle="modal" id="select_gradebyisic_bar" class="dropdown-item"><i class="icon-stats-bars2"></i>Bar</a>
                                        <a href="#" data-toggle="modal" id="select_gradebyisic_polar" class="dropdown-item"><i class="icon-spinner4"></i>Polar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebyisic"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endif
       
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <input id="attendeventid" type="text" hidden>
                    <div class="card-header header-elements-sm-inline">
                        @php
                            $tbdelaymsg = '';
                             foreach ($fulltbps as $key => $_item) {
                                if (@$_item->minitbp->isintime($_item->minitbp->id) < 0) {
                                    $tbdelaymsg = '<span class="text-danger">(พบโครงการเกินกำหนด Control flow)</span>';
                                   break ;
                                }
                             }
                        @endphp
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">รายละเอียดโครงการ {!!$tbdelaymsg!!}</h6>
                        <div class="header-elements">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-2" id="maintable" >
                                <thead>
                                    <tr class="bg-info">
                                        <th hidden>date</th>
                                        <th style="width:1%;white-space: nowrap;text-align: center">ชื่อโครงการ</th> 
                                        <th style="width:1%;white-space: nowrap;text-align: center">ระยะเวลา</th>
                                        <th style="width:1%;white-space: nowrap;text-align: center">วันนัดก่อนลงพื้นที่</th>
                                        <th style="width:1%;white-space: nowrap;text-align: center">วันที่ประเมิน</th>
                                        <th style="width:1%;white-space: nowrap;text-align: center">วันที่สรุปผลประเมิน</th>
                                        <th style="width:1%;white-space: nowrap;text-align: center">เข้าร่วม(เฉพาะผู้เชี่ยวชาญ)</th>
                                        <th style="width:1%;white-space: nowrap;text-align: center">สถานภาพ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($fulltbps as $fulltbp)
                                        @if ($fulltbp->minitbp->businessplan->business_plan_status_id > 2 & ($fulltbp->canceldate == null))
                                            @php
                                                $check = Auth::user()->IsExpert($fulltbp->id);
                                            @endphp
                                            <tr> 
                                                <td hidden>{{$fulltbp->minitbp->updated_at}}</td>
                                                <td style="width:1%;white-space: nowrap">
                                                    @php
                                                        $cogcolor = 'text-info';
                                                        $latetext = '';
                                                        if (@$fulltbp->minitbp->isintime($fulltbp->minitbp->id) < 0) {
                                                            $cogcolor = 'text-danger';
                                                           
                                                            $latetext =  '<span class="badge badge-flat border-danger-600 text-danger-600">'.$fulltbp->minitbp->isintime($fulltbp->minitbp->id)*(-1) .' วัน</span>';
                                                        }
                                                    @endphp                                           
                                                    @if (Empty($fulltbp->expertassignment))
                                                            <a href="#" data-toggle="modal" data-id="{{$fulltbp->minitbp->id}}" class="controlflowicon"><i class="icon-cog2 {{$cogcolor}} mr-2"></i></a>
                                                            <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="{{$cogcolor}}" target="_blank" >{{$fulltbp->minitbp->project}} {!!$latetext!!}</a>  
                                                        @else
                                                            @if ($fulltbp->expertassignment->accepted == 1)
                                                                <a href="#" data-toggle="modal" data-id="{{$fulltbp->minitbp->id}}" class="controlflowicon"><i class="icon-cog2 {{$cogcolor}} mr-2"></i></a>
                                                                <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="{{$cogcolor}}" target="_blank" >{{$fulltbp->minitbp->project}} {!!$latetext!!}</a>  
                                                            @else
                                                            @if (Auth::user()->isColeader($fulltbp->id) > 0 )
                                                                    <a href="#" data-toggle="modal" data-id="{{$fulltbp->minitbp->id}}" class="controlflowicon"><i class="icon-cog2 {{$cogcolor}} mr-2"></i></a>
                                                                    <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="{{$cogcolor}}" target="_blank" >{{$fulltbp->minitbp->project}} {!!$latetext!!}</a>  
                                                                @else
                                                                    {{$fulltbp->minitbp->project}}
                                                            @endif
                                                                
                                                            @endif
                                                    @endif     
                                                </td>   
                                                <td style="white-space: nowrap;text-align:center"> {{$fulltbp->minitbp->projectdatediff}} </td>  
                                                <td style="white-space: nowrap;text-align:center"> {{$fulltbp->briefingdate}} </td>  
                                                <td style="white-space: nowrap;text-align:center"> {{$fulltbp->assessmentdate}} </td>  
                                                <td style="white-space: nowrap;text-align:center"> {{$fulltbp->finalassessmentdate}} </td>  
                                                
                                                <td style="white-space: nowrap;text-align: center"> 
                                                    @if (!Empty($check))
                                                        @if ($fulltbp->expertassignment->accepted == 0)
                                                                <a href="{{route('dashboard.admin.report.expert.accept',['id' => $fulltbp->id])}}" class="btn btn-sm bg-info">ยอมรับเข้าร่วม</a>
                                                                <a href="#" data-id="{{$fulltbp->id}}" data-toggle="modal" class="btn btn-sm bg-danger reject">ปฎิเสธเข้าร่วม</a>
                                                            @elseif($fulltbp->expertassignment->accepted == 2)
                                                                <a href="" class="btn btn-sm bg-info showreject" data-id="{{$fulltbp->id}}" data-toggle="modal">เหตุผลการไม่เข้าร่วม</a> 
                                                        @endif
                                                    @endif
                                                </td> 
                                                <td style="white-space: nowrap;text-align: center"> 
                                                    @if ($fulltbp->status == 3)
                                                            <span class="badge badge-flat border-success-600 text-success-600">{{$fulltbp->minitbp->businessplan->businessplanstatus->name}} </span> 
                                                        @else
                                                        <span class="badge badge-flat border-grey-600 text-grey-600">{{$fulltbp->minitbp->businessplan->businessplanstatus->name}} </span> 
                                                    @endif
                                                </td> 
                                            </tr>
                                        @endif
 
                                    @endforeach
                                </tbody>
                            </table>      
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- {{$fulltbp->id}} --}}
        {{-- @if (Auth::user()->isProjectLeader(@$fulltbp->id) == 1 || Auth::user()->user_type_id >= 5) --}}
       {{-- {{ Auth::user()->isProjectsLeader(@$fulltbps)}} --}}
       {{-- {{$fulltbp->minitbp->businessplan->business_plan_status_id}} --}}
        @if (Auth::user()->isProjectsLeader(@$fulltbps) != 0 || Auth::user()->user_type_id >= 5)
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
                            </div>
                        </div>
                        <div class="card-body">
                            <input type="text" id="fulltbpid"  hidden>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-2" id="fulltbptable" >
                                    <thead>
                                        <tr class="bg-info">
                                            <th hidden>date</th>
                                            <th style="width:1%;white-space: nowrap;text-align:center">ชื่อโครงการ</th> 
                                            <th style="width:1%;white-space: nowrap;text-align:center">Full TBP</th> 
                                            <th style="width:1%;white-space: nowrap;text-align:center">ผู้เชี่ยวชาญ</th> 
                                            <th style="width:1%;white-space: nowrap;text-align:center">EV</th> 
                                            <th style="width:1%;white-space: nowrap;text-align:center">BOL</th> 
                                            <th style="width:1%;white-space: nowrap;text-align:center">สถานภาพ</th>                               
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fulltbps as $key => $fulltbp)
                                            @if (($fulltbp->minitbp->businessplan->business_plan_status_id > 4 &&  Auth::user()->isProjectLeader(@$fulltbp->id) == 1) || ($fulltbp->minitbp->businessplan->business_plan_status_id > 4 && Auth::user()->user_type_id >=5))
                                                <tr>  
                                                    <td hidden >{{$fulltbp->updated_at}}</td>  
                                                    <td style="width:1%;white-space: nowrap;"> 
                                                        @php
                                                            $cogcolor = 'text-info';
                                                            $latetext = '';
                                                            if (@$fulltbp->minitbp->isintime($fulltbp->minitbp->id) < 0) {
                                                                $cogcolor = 'text-danger';
                                                            
                                                                $latetext =  '<span class="badge badge-flat border-danger-600 text-danger-600">'.$fulltbp->minitbp->isintime($fulltbp->minitbp->id)*(-1) .' วัน</span>';
                                                            }
                                                        @endphp  
                                                        <a href="#" data-toggle="modal" data-id="{{$fulltbp->minitbp->id}}" class="controlflowicon"><i class="icon-cog2 {{$cogcolor}} mr-2"></i></a>
                                                        <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="{{$cogcolor}}" target="_blank" >{{$fulltbp->minitbp->project}} {!!$latetext!!} </a>  
                                                    </td>  
                                                    <td style="white-space: nowrap;text-align: center">    
                                                        @if ($fulltbp->minitbp->businessplan->business_plan_status_id > 5 )
                                                                <span class="badge badge-flat border-success text-success-600">ผ่านการอนุมัติ</span>
                                                                @if (!Empty($fulltbp->approvelog))
                                                                    <button  data-toggle="modal" data-id="{{$fulltbp->id}}" data-doctype="2" class="btn btn-sm bg-success showapprovelog mr-1">รายการอนุมัติ</a>
                                                                @endif

                                                                @if ($fulltbp->reviselog->count() > 0)
                                                                    <button data-toggle="modal" data-id="{{$fulltbp->minitbp->id}}" data-doctype="2" data-project="{{$fulltbp->minitbp->project}}" class="btn btn-sm bg-pink showlog">รายการแก้ไข</button>
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
                                                    <td style="white-space: nowrap;text-align: center"> 
                                                        @if ($fulltbp->expertassignments->count() > 0)
                                                        {{-- {{$fulltbp->expertassignments->where('expert_assignment_status_id',1)->count()}} --}}
                                                                {{-- @if ($fulltbp->expertassignments->where('expert_assignment_status_id',1)->count() > 0)
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
                                                                @endif   --}}


                                                                @if ($fulltbp->expertassignments->where('expert_assignment_status_id',2)->count() > 0)
                                                                        @if ($fulltbp->assignexpert !=2)
                                                                            <a  href="{{route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id])}}" class="btn btn-sm bg-pink">อยู่ระหว่างผู้เชียวชาญตอบรับ</a>
                                                                        @else
                                                                            <a  href="{{route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id])}}" >
                                                                                <span class="badge badge-flat border-success text-success-600">มอบหมายแล้ว</span>
                                                                            </a>
                                                                        @endif
                                                                    @else
                                                                        @if (Auth::user()->user_type_id >= 5)
                                                                                <a  href="{{route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id])}}" class="btn btn-sm bg-info">อยู่ระหว่าง Manager พิจารณา</a>
                                                                            @else
                                                                                @if (Auth::user()->isProjectLeader($fulltbp->id) == 1)
                                                                                        <a  href="{{route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id])}}" class="btn btn-sm bg-info">อยู่ระหว่าง Manager พิจารณา</a>
                                                                                    @else
                                                                                        <span class="badge badge-flat border-danger text-danger-600">อยู่ระหว่าง Manager พิจารณา</span>
                                                                                @endif
                                                                                
                                                                        @endif
                                                                        {{-- @if (Auth::user()->user_type_id >= 5)
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
                                                                        @endif --}}
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
                                                    <td style="white-space: nowrap;text-align: center"> 
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
                                                                            <span class="badge badge-flat border-warning text-warning-600" style="text-align: center">{{$evstatus}}</span>
                                                                        @else
                                                                            @if ($fulltbp->ev->status >= 4)
                                                                            <a  href="{{route('dashboard.admin.project.evweight.edit',['id' => $fulltbp->ev->id])}}" ><span class="badge badge-flat border-success text-success-600">{{$evstatus}}</span></a>
                                                                            @else
                                                                            <a  href="{{route('dashboard.admin.project.evweight.edit',['id' => $fulltbp->ev->id])}}" class="{{$style}}">{{$evstatus}}</a>
                                                                            @endif
                                                                    @endif
                                                                @elseif(Auth::user()->user_type_id == 6)
                                                                    @if ($fulltbp->ev->status == 0)
                                                                            <span class="badge badge-flat border-warning text-warning-600" style="text-align: center">{{$evstatus}}</span>
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
                                                    <td style="white-space: nowrap;text-align: center"> 
                                                        @if ( $fulltbp->bol->count() != 0)
                                                                <a href="{{route('dashboard.admin.project.fulltbp.bol',['id' => $fulltbp->id])}}" >
                                                                    <span class="badge badge-flat border-success text-success-600" style="text-align: center">เอกสาร BOL</span>
                                                                </a> 
                                                            @else
                                                                @if (Auth::user()->user_type_id == 4)
                                                                        {{-- <a href="{{route('dashboard.admin.project.fulltbp.bol',['id' => $fulltbp->id])}}" class="btn btn-sm bg-warning">เพิ่มเอกสาร BOL</a>  --}}
                                                                        @if ($fulltbp->ev->status >= 4)
                                                                                <a href="{{route('dashboard.admin.project.fulltbp.bol',['id' => $fulltbp->id])}}" class="btn btn-sm bg-warning">เพิ่มเอกสาร BOL</a> 
                                                                            @else
                                                                                <span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้เพิ่ม</span>
                                                                        @endif 
                                                                    @else
                                                                        <span class="badge badge-flat border-warning text-warning-600" style="text-align: center">ยังไม่ได้เพิ่ม</span>
                                                                @endif
                                                        @endif
                                                    </td>  
                                                    <td style="white-space: nowrap;text-align: center">
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
                                                                                        {{-- <a href="#" data-id="{{$fulltbp->id}}" class="badge badge-flat border-success text-success-600">สิ้นสุดโครงการ</a> --}}
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
                                                                                    {{-- <a href="#" data-id="{{$fulltbp->id}}" class="badge badge-flat border-success text-success-600">สิ้นสุดโครงการ</a> --}}
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
                                                                    <a href="#" data-id="{{$fulltbp->id}}" class="dropdown-item mailtomember"><i class="icon-mail5"></i> อีเเมลถึงผู้เชี่ยวชาญ</a>
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
                </div>
            </div>

            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h6 class="card-title" style="font-size:16px;font-weight: bold">ผลการประเมินโครงการ</h6>
                            <div class="header-elements">
                                {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                    <span></span>
                                </a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap" id="reporttable">
                                    <thead>
                                        <tr class="bg-info">
                                            <th hidden>date</th>
                                            <th style="width:1%;white-space: nowrap;text-align: center">ชื่อโครงการ</th> 
                                            <th style="text-align: center">คะแนน</th>
                                            <th style="text-align: center">เกรด</th>     
                                            <th style="width:1%;white-space: nowrap;text-align: center">รายงานผล</th>    
                                            <th style="width:1%;white-space: nowrap;text-align: center">แจ้งผล</th> 
                                            <th style="width:1%;white-space: nowrap;text-align: center">แจ้งผลทางจดหมาย</th>  
                                            <th style="width:1%;white-space: nowrap;text-align: center">สิ้นสุดโครงการ</th>              
                                        </tr>
                                    </thead>
                                    <tbody style="min-height:300px">
                                        @foreach ($fulltbps as $key => $fulltbp)
                                            @if ($fulltbp->minitbp->businessplan->business_plan_status_id >= 8 && $fulltbp->canceldate == null)
                                                @if (Auth::user()->isProjectLeader($fulltbp->id) == 1 || Auth::user()->user_type_id >= 5)
                                                    <tr>   
                                                        <td hidden>{{$fulltbp->updated_at}}</td> 
                                                        <td style="width:1%;white-space: nowrap"> {{$fulltbp->minitbp->project}} </td> 
                                                        <td style="text-align: center"> {{number_format(@$fulltbp->projectgrade->percent, 2, '.', '')}} </td>  
                                                        <td style="text-align: center"> {{@$fulltbp->projectgrade->grade}} </td> 
                                                        <td style="white-space: nowrap;text-align: center"> 
                                                            @if(@$fulltbp->projectstatustransaction(8)->status != 2)
                                                                <a href="{{route('dashboard.admin.evaluationresult.edit',['id' => $fulltbp->evaluationresult->id])}}" class="btn btn-sm bg-info">เขียนบทวิเคราะห์</a>
                                                            @endif  
                                                            @if (!Empty(@$fulltbp->evaluationresult->management) && !Empty(@$fulltbp->evaluationresult->technoandinnovation) && !Empty(@$fulltbp->evaluationresult->marketability) && !Empty(@$fulltbp->evaluationresult->businessprospect))
                                                                {{-- <a href="{{route('dashboard.admin.evaluationresult.pdf',['id' => $fulltbp->evaluationresult->id])}}" class="btn btn-sm bg-primary" target="_blank">จดหมายแจ้งผล</a> --}}
                                                                <button type="button" class="btn btn-sm bg-info dropdown-toggle" data-toggle="dropdown">จดหมายแจ้งผล</button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a href="{{route('dashboard.admin.evaluationresult.pdf',['id' => $fulltbp->evaluationresult->id])}}" class="dropdown-item" target="_blank"><i class="icon-download"></i> ไฟล์ PDF</a>
                                                                    <a href="{{route('dashboard.admin.evaluationresult.word',['id' => $fulltbp->evaluationresult->id])}}" class="dropdown-item" target="_blank"><i class="icon-download"></i> ไฟล์ WORD</a>
                                                                    {{-- <a href="{{route('dashboard.admin.evaluationresult.certificate',['id' => $fulltbp->evaluationresult->id, 'type' => '2'])}}" class="dropdown-item" target="_blank"><i class="icon-download"></i> ดาวน์โหลด PDF</a> --}}
                                                                
                                                                </div>
                                                            @endif
                                                            
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-sm bg-info dropdown-toggle" data-toggle="dropdown">Certificate</button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a href="{{route('dashboard.admin.evaluationresult.certificate',['id' => $fulltbp->evaluationresult->id, 'type' => '1'])}}" class="dropdown-item" target="_blank"><i class="icon-file-eye"></i> ตัวอย่างการแสดงผล</a>
                                                                    <a href="{{route('dashboard.admin.evaluationresult.certificate',['id' => $fulltbp->evaluationresult->id, 'type' => '2'])}}" class="dropdown-item" target="_blank"><i class="icon-download"></i> ดาวน์โหลด PDF</a>
                                                                    <a href="{{route('dashboard.admin.evaluationresult.ppt',['id' => $fulltbp->evaluationresult->id, 'type' => '2'])}}" class="dropdown-item" target="_blank"><i class="icon-download"></i> ดาวน์โหลด PPT</a>
                                                                </div>
                                                            </div>
                                                        </td> 
                                                        <td style="white-space: nowrap;text-align: center"> 
                                                            @if ($fulltbp->minitbp->businessplan->business_plan_status_id >=9)
                                                                <span class="badge badge-flat border-success text-success-600">แจ้งผลแล้ว</span>
                                                            @else
                                                                @if ($fulltbp->minitbp->businessplan->business_plan_status_id == 8 && $generalinfo->use_invoice_status_id == 2)
                                                                    <button class="btn btn-sm bg-warning notifyresult" data-id="{{$fulltbp->minitbp->id}}"><i class="icon-spinner spinner mr-2" id="spinresultnity" hidden></i>แจ้งผล</button>
                                                                @endif
                                                            @endif

                                                        </td>
                                                        <td style="white-space: nowrap;text-align: center">
                                                            @if (!Empty($fulltbp->projectstatustransaction(7)))
                                                                    @if ($fulltbp->projectstatustransaction(7)->status == 2)  
                                                                            <span class="badge badge-flat border-success text-success-600">ส่งจดหมายแล้ว</span>
                                                                        @elseif($fulltbp->projectstatustransaction(7)->status == 1)
                                                                        
                                                                            @if (Auth::user()->user_type_id == 4)
                                                                                    <button class="btn btn-sm bg-warning confirmsendletter" data-id="{{$fulltbp->minitbp->id}}"><i class="icon-spinner spinner mr-2" id="spinlettersent" hidden></i>ยืนยันส่งจดหมาย</button>
                                                                            @else 
                                                                                    {{-- <button class="btn btn-sm bg-warning confirmsendletter" data-id="{{$fulltbp->minitbp->id}}">ยืนยันส่งจดหมาย</button> --}}
                                                                                    <span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้ส่งจดหมายแจ้งผล</span>
                                                                            @endif
                                                                    @endif  
                                                                @else
                                                                    {{-- @if ($generalinfo->invoiceoption == 1)
                                                                    
                                                                        @else

                                                                    @endif --}}
                                                                    <span class="badge badge-flat border-warning text-warning-600">รอการยืนยัน</span>
                                                            @endif
                                                        </td>
                                                        <td style="white-space: nowrap;text-align: center"> 
                                                            @if (!Empty($fulltbp->projectstatustransaction(8)))
                                                                    @if ($fulltbp->projectstatustransaction(8)->status == 2)
                                                                            <span class="badge badge-flat border-success text-success-600">สิ้นสุดโครงการ</span>
                                                                        @elseif($fulltbp->projectstatustransaction(8)->status == 1)
                                                                            <a href="{{route('dashboard.admin.project.fulltbp.finishproject',['id' => $fulltbp->id])}}" data-name="" onclick="confirmfinish(event)" class="btn btn-sm bg-warning">สิ้นสุดโครงการ</a>
                                                                    @endif  
                                                                @else
                                                                    <span class="badge badge-flat border-warning text-warning-600">รอการยืนยัน</span>
                                                            @endif
                                                        </td> 
                                                    </tr>
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
        @endif

        



        {{-- @endif --}}



        {{-- @if (Auth::user()->user_type_id >= 5)
        <div class="row">
            @if ($numprojectcollections->count() > 0)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h6 class="card-title" style="font-size:16px;font-weight: bold">จำนวนโครงการ ปี <span id="currentyear">{{intVal(date("Y"))+543}}</span></h6>
                            <div class="header-elements">
                                <div class="list-icons ml-3">
                                    <div class="list-icons-item dropdown">
                                        <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                        <div class="dropdown-menu">
                                            <a href="#" data-toggle="modal" id="numproject_bar" class="dropdown-item"><i class="icon-stats-bars2"></i>Bar</a>
                                            <a href="#" data-toggle="modal" id="numproject_donut" class="dropdown-item"><i class="icon-pie-chart3"></i>Donut</a>
                                            <a href="#" data-toggle="modal" id="numproject_pie" class="dropdown-item"><i class="icon-pie5"></i>Pie</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="{{route('api.adminreport.download.numproject')}}" class="dropdown-item"><i class="icon-floppy-disk"></i> ดาวน์โหลด</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="chart-container">
                                        <div class="chart has-fixed-height" id="participate_chart"></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="testtopictable">
                                            <thead>
                                                <tr class="bg-info">
                                                    <th style="width: 25%">ปีโครงการ</th> 
                                                    <th style="width: 25%">จำนวน Mini TBP</th>
                                                    <th style="width: 25%">จำนวน Full TBP</th>
                                                    <th style="width: 25%">ประเมินสำเร็จ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($numprojectcollections->reverse() as $key => $numprojectcollection)
                                                @if ($key <=5)
                                                    <tr> 
                                                        <td> {{$numprojectcollection['year']}} </td>  
                                                        <td> {{$numprojectcollection['minitpbs']}} </td>  
                                                        <td> {{$numprojectcollection['fulltbps']}} </td>  
                                                        <td> {{$numprojectcollection['finished']}} </td>  
                                                    </tr>
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
            @endif
            @if ($projectgradecollections->count() > 0)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">จำนวนโครงการตามเกรดการประเมิน ปี {{intVal(date("Y"))+543}}</h6>
                        <div class="header-elements">
                            <div class="list-icons ml-3">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="#" data-toggle="modal" id="project_grade_bar" class="dropdown-item"><i class="icon-stats-bars2"></i>Bar</a>
                                        <a href="#" data-toggle="modal" id="project_grade_donut" class="dropdown-item"><i class="icon-pie-chart3"></i>Donut</a>
                                        <a href="#" data-toggle="modal" id="project_grade_pie" class="dropdown-item"><i class="icon-pie5"></i>Pie</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="{{route('api.adminreport.download.projectgrade')}}" class="dropdown-item"><i class="icon-floppy-disk"></i> ดาวน์โหลด</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="chart-container">
                                    <div class="chart has-fixed-height" id="grade_chart"></div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="testtopictable">
                                        <thead>
                                            <tr class="bg-info">
                                                <th style="width: 10%">ปี</th> 
                                                <th style="width: 9%">AAA</th> 
                                                <th style="width: 9%">AA</th>
                                                <th style="width: 9%">A</th>
                                                <th style="width: 9%">BBB</th>
                                                <th style="width: 9%">BB</th>
                                                <th style="width: 9%">B</th>
                                                <th style="width: 9%">CCC</th>
                                                <th style="width: 9%">CC</th>
                                                <th style="width: 9%">C</th>
                                                <th style="width: 9%">D</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($projectgradecollections->reverse() as $key => $projectgradecollection)
                                               @if ($key <=5)
                                                <tr> 
                                                    <td> {{$projectgradecollection['year']}} </td>  
                                                    <td> {{$projectgradecollection['AAA']}} </td>  
                                                    <td> {{$projectgradecollection['AA']}} </td> 
                                                    <td> {{$projectgradecollection['A']}} </td> 
                                                    <td> {{$projectgradecollection['BBB']}} </td> 
                                                    <td> {{$projectgradecollection['BB']}} </td> 
                                                    <td> {{$projectgradecollection['B']}} </td> 
                                                    <td> {{$projectgradecollection['CCC']}} </td> 
                                                    <td> {{$projectgradecollection['CC']}} </td> 
                                                    <td> {{$projectgradecollection['C']}} </td> 
                                                    <td> {{$projectgradecollection['D']}} </td> 
                                                </tr>
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
            @endif
         
            @if ($projectindustrycollections->count() > 0)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">โครงการตามกลุ่มอุตสาหกรรม ปี {{intVal(date("Y"))+543}}</h6>
                        <div class="header-elements">
                            <div class="list-icons ml-3">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="#" data-toggle="modal" id="project_industry_bar" class="dropdown-item"><i class="icon-stats-bars2"></i>Bar</a>
                                        <a href="#" data-toggle="modal" id="project_industry_donut" class="dropdown-item"><i class="icon-pie-chart3"></i>Donut</a>
                                        <a href="#" data-toggle="modal" id="project_industry_pie" class="dropdown-item"><i class="icon-pie5"></i>Pie</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="{{route('api.adminreport.download.projectindustry')}}" class="dropdown-item"><i class="icon-floppy-disk"></i> ดาวน์โหลด</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="chart-container">
                                    <div class="chart has-fixed-height" id="industrygroup_chart"></div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="testtopictable">
                                        <thead>
                                            <tr class="bg-info">
                                                <th style="width: 10%">ปี</th> 
                                                <th style="width: 9%">Next-generation Automotive</th> 
                                                <th style="width: 9%">Smart Electronics</th>
                                                <th style="width: 9%">Affluent, Medical and Wellness Tourism</th>
                                                <th style="width: 9%">Agriculture and Biotechnology</th>
                                                <th style="width: 9%">Food for the Future</th>
                                                <th style="width: 9%">Robotics</th>
                                                <th style="width: 9%">Aviation and Logistics</th>
                                                <th style="width: 9%">Biofuels and Biochemicals</th>
                                                <th style="width: 9%">Digital</th>
                                                <th style="width: 9%">Medical Hub</th>
                                                <th style="width: 9%">Defense</th>
                                                <th style="width: 9%">Education and Skill Development</th>
                                                <th style="width: 9%">อื่นๆ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($projectindustrycollections->reverse() as $key => $projectindustrycollection)
                                               @if ($key <=5)
                                                <tr> 
                                                    <td> {{$projectindustrycollection['year']}} </td>  
                                                    <td> {{$projectindustrycollection['automotive']}} </td>  
                                                    <td> {{$projectindustrycollection['smartelectronic']}} </td> 
                                                    <td> {{$projectindustrycollection['affluent']}} </td> 
                                                    <td> {{$projectindustrycollection['agriculture']}} </td> 
                                                    <td> {{$projectindustrycollection['food']}} </td> 
                                                    <td> {{$projectindustrycollection['robotic']}} </td> 
                                                    <td> {{$projectindustrycollection['aviation']}} </td> 
                                                    <td> {{$projectindustrycollection['biofuel']}} </td> 
                                                    <td> {{$projectindustrycollection['digital']}} </td> 
                                                    <td> {{$projectindustrycollection['medical']}} </td> 
                                                    <td> {{$projectindustrycollection['defense']}} </td> 
                                                    <td> {{$projectindustrycollection['education']}} </td> 
                                                    <td> {{$projectindustrycollection['other']}} </td> 
                                                </tr>
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
            @endif
           
            @if ($objecttivecollections->count() > 0)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h6 class="card-title" style="font-size:16px;font-weight: bold">วัตถุประสงค์ของการขอรับการประเมิน ปี {{intVal(date("Y"))+543}}</h6>
                            <div class="header-elements">
                                <div class="list-icons ml-3">
                                    <div class="list-icons-item dropdown">
                                        <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                        <div class="dropdown-menu">
                                            <a href="#" data-toggle="modal" id="project_objective_bar" class="dropdown-item"><i class="icon-stats-bars2"></i>Bar</a>
                                            <a href="#" data-toggle="modal" id="project_objective_donut" class="dropdown-item"><i class="icon-pie-chart3"></i>Donut</a>
                                            <a href="#" data-toggle="modal" id="project_objective_pie" class="dropdown-item"><i class="icon-pie5"></i>Pie</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="{{route('api.adminreport.download.projectobjective')}}" class="dropdown-item"><i class="icon-floppy-disk"></i> ดาวน์โหลด</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="chart-container">
                                        <div class="chart has-fixed-height" id="financial_chart"></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="testtopictable">
                                            <thead>
                                                <tr class="bg-info">
                                                    <th style="width: 10%">ปี</th> 
                                                    <th style="width: 25%">ด้านการเงิน</th> 
                                                    <th style="width: 25%">ไม่ใช่ด้านการเงิน</th>
                                                    <th style="width: 40%">ด้านการเงินและไม่ใช่ด้านการเงิน</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($objecttivecollections->reverse() as $key => $objecttivecollection)
                                                @if ($key <=5)
                                                    <tr> 
                                                        <td> {{$objecttivecollection['year']}} </td>  
                                                        <td> {{$objecttivecollection['finance']}} </td>  
                                                        <td> {{$objecttivecollection['nonfinance']}} </td> 
                                                        <td> {{$objecttivecollection['bothobjecttive']}} </td> 
                                                    </tr>
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
            @endif
        </div>
        @endif --}}

        @if ($fulltbps->count() > 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h6 class="card-title" style="font-size:16px;font-weight: bold">ปฏิทิน</h6>
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
        @endif

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
<script src="{{asset('assets/dashboard/js/plugins/aos/aos.js')}}"></script>
{{-- <script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
<script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script> --}}

<script src="{{asset('assets/dashboard/js/plugins/echart/echarts.min.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/reporthelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
{{-- <script src="{{asset('assets/dashboard/js/plugins/chart/chart.2.6.0.js')}}"></script> --}}
{{-- <script src="{{asset('assets/dashboard/js/plugins/chart/chart.js')}}"></script> --}}
<script src="{{asset('assets/dashboard/js/app/helper/controlflow.js')}}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}

<script type="module" src="{{asset('assets/dashboard/js/app/helper/approvefulltbphelper.js')}}"></script>

<script>
      AOS.init();
    var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content'),
        branchid: "{{Auth::user()->branch_id}}"
    };

    var countitemtable =  "{{$fulltbps->count()}}";
        if (countitemtable >= 5) {
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
        }

        if (countitemtable >= 5) {
            $('#fulltbptable').DataTable( {
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
        }

        if (countitemtable >= 5) {
            $('#reporttable').DataTable( {
                "paging":   true,
                "ordering": true,
                "order": [[ 0, 'desc' ]],
                "info":     false,
                "pageLength" : 5,
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

    $(document).on('click', '.reject', function(e) {
        $('#btn_modal_expertreject_reason').data('id',$(this).data('id')); //setter
        $('#modal_expertreject_reason').modal('show');
    });

    $(document).on('click', '#btn_modal_expertreject_reason', function(e) {
        // console.log($('#rej_note').val() );
        if($('#rej_note').val() == '')return;
        
        $("#spinicon").attr("hidden",false);
        expertReject("{{Auth::user()->id}}",$(this).data('id'),$('#rej_note').val()).then(data => {
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
        // console.log($(this).data('id'));
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

    function confirmfinish(e) {
            e.preventDefault();
            var urlToRedirect = e.currentTarget.getAttribute('href');
            Swal.fire({
                    title: 'ยืนยัน',
                    text: `ต้องการสิ้นสุดโครงการหรือไม่? `,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ตกลง',
                    cancelButtonText: 'ยกเลิก',
                    closeOnConfirm: false,
                    closeOnCancel: false
                }).then((result) => {
                if (result.value) {
                    window.location.href = urlToRedirect;
                }
            });
        }
        $(document).on("click",".confirmsendletter",function(e){
            Swal.fire({
                title: 'ยืนยัน',
                text: `ยืนยันการส่งจดหมายแล้ว หรือไม่`,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                closeOnConfirm: false,
                closeOnCancel: false
                }).then((result) => {
                if (result.value) {
                    $("#spinlettersent").attr("hidden",false);
                    LetterSent($(this).data('id')).then(data => {
                        window.location.reload();
                    })
                .catch(error => {})
                }
            });
        }); 

        $(document).on("click",".notifyresult",function(e){
            Swal.fire({
                title: 'ยืนยัน',
                text: `การแจ้งผลจะแสดงเกรดและผลการประเมินให้ผู้ประกอบการทราบ ยืนยันแจ้งผลการประเมินหรือไม่?`,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                closeOnConfirm: false,
                closeOnCancel: false
                }).then((result) => {
                if (result.value) {
                    $("#spinresultnity").attr("hidden",false);
                    NotifyResult($(this).data('id')).then(data => {
                        window.location.reload();
                    })
                .catch(error => {})
                }
            });
        }); 

        function NotifyResult(id){
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: `${route.url}/api/assessment/notifyresult`,
                    type: 'POST',
                    headers: {"X-CSRF-TOKEN":route.token},
                    data: {
                    id : id
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

        function LetterSent(id){
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: `${route.url}/api/assessment/lettersent`,
                    type: 'POST',
                    headers: {"X-CSRF-TOKEN":route.token},
                    data: {
                    id : id
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

        // var countitemtable =  "{{$fulltbps->count()}}";
        // if (countitemtable >= 20) {
        //     $('#maintable').DataTable( {
        //         "paging":   true,
        //         "ordering": true,
        //         "info":     false,
        //         "pageLength" : 20,
        //         "language": {
        //             "zeroRecords": " ",
        //             "search": "ค้นหา: ",  
        //             "sLengthMenu": "จำนวน _MENU_ รายการ",
        //             'paginate': {
        //                 'previous': 'ก่อนหน้า',
        //                 'next': 'ถัดไป'
        //             }
        //         }
        //     });
        // }
</script>

@stop
