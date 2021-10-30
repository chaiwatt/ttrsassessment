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
  /* select.form-control{
        display: inline;
        width: 200px;
        margin-left: 35px;
        font-size: 16px
    } */




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
                            <div class="table-responsive" >
                                <table style="width: 100%" class="table table-bordered table-striped">
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
                            <div class="table-responsive" >
                                <table style="width: 100%" class="table table-bordered table-striped" >
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
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;รายละเอียดปฏิทิน <span id="passedeventtext" class="text-danger"></span> </h5>
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
                            <div class="table-responsive" >
                                <table style="width: 100%" class="table table-bordered table-striped">
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
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เหตุผลการไม่เข้าร่วมโครงการ
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label id="messageshow">โปรดระบุเหตุผล</label>
                                <textarea type="text" rows="5"  id="rej_note" placeholder="โปรดระบุเหตุผล" class="form-control form-control-lg" ></textarea>
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
                <h4> <span class="font-weight-semibold">สรุปสถานภาพโครงการ</span></h4>
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
                    <span class="breadcrumb-item active">สรุปสถานภาพโครงการ</span>
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
                <div class="card bg-teal-400 pillarcard">
                    <div class="card-body">
                        <div class="d-flex">
                            <a href="{{route('dashboard.admin.search.company')}}" class="text-white"><h1 class="font-weight-semibold mb-0" class="projectstatnum"><span class="projectstatnum">{{$totalcompany}}</span></h1></a>  
                            
                            
                        </div>
                        <div>
                          <a href="{{route('dashboard.admin.search.company')}}" class="text-white" ><span class="projectstat">จำนวนผู้ประกอบการ</span></a>  
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div id="members-online"></div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-blue-400 pillarcard">
                    <div class="card-body " >
                        <div class="d-flex">
                            <a href="{{route('dashboard.admin.realtimereport.project.minitbpbyyear')}}" class="text-white "><h1 class="font-weight-semibold mb-0" ><span class="projectstatnum">{{$totalminitbp}}</span> </h1></a> 
                            
                        </div>
                        <div>
                            <a href="{{route('dashboard.admin.realtimereport.project.minitbpbyyear')}}" class="text-white"><span class="projectstat">จำนวนยื่น Mini TBP</span></a>  
                            
                        </div>
                    </div>
                    <div id="today-revenue"></div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-pink-400 pillarcard">
                    <div class="card-body">
                        <div class="d-flex">
                            
                            <a href="{{route('dashboard.admin.realtimereport.project.fulltbpbyyear')}}" class="text-white"><h1 class="font-weight-semibold mb-0" ><span class="projectstatnum">{{$totalfulltbp}}</span></h1></a> 
                        </div>
                        <div>  
                            <a href="{{route('dashboard.admin.realtimereport.project.fulltbpbyyear')}}" class="text-white"><span class="projectstat">จำนวนยื่น Full TBP</span></a>  
                        </div>
                    </div>
                    <div id="today-revenue"></div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-orange-400 pillarcard">
                    <div class="card-body">
                        <div class="d-flex">
                            
                            <a href="{{route('dashboard.admin.realtimereport.project.projectall')}}" class="text-white"><h1 class="font-weight-semibold mb-0" class="projectstatnum"><span class="projectstatnum">{{$totalonprocess}}</span></h1></a>
                        </div>
                        <div> 
                            <a href="{{route('dashboard.admin.realtimereport.project.projectall')}}" class="text-white"><span class="projectstat">อยู่ระหว่างการประเมิน</span></a>
                        </div>
                    </div>
                    <div id="today-revenue"></div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-green-400 pillarcard">
                    <div class="card-body">
                        <div class="d-flex">
                            
                            <a href="{{route('dashboard.admin.realtimereport.project.finishedbyyear')}}" class="text-white"><h1 class="font-weight-semibold mb-0" class="projectstatnum"><span class="projectstatnum">{{$totalfinish}}</span></h1></a>
                        </div>
                        <div> 
                            <a href="{{route('dashboard.admin.realtimereport.project.finishedbyyear')}}" class="text-white"><span class="projectstat">ประเมินเสร็จสิ้น</span></a>
                        </div>
                    </div>
                    <div id="today-revenue"></div>
                </div>
            </div>
        </div>

        {{-- Responsive test --}}
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">คะแนนแยกตาม Pillar Just test</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2 d-none d-lg-block" style="background:red;height:200px;width:100%;color:#fff">
                            ชาร์ตวงกรม
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12" style="background:green;height:200px;width:100%;color:#fff">
                            ชาร์ตครึ่งวงกรม
                        </div>
                        <div class="col-lg-2 col-md-12 col-sm-12" style="background:blue;height:200px;width:100%;color:#fff">
                          ตาราง
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12" style="background:rgb(8, 221, 139);height:200px;width:100%;color:#fff">
                            Management
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12" style="background:rgb(75, 44, 187);height:200px;width:100%;color:#fff">
                            Technology
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12" style="background:rgb(202, 63, 81);height:200px;width:100%;color:#fff">
                            Marketability
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12" style="background:darkblue;height:200px;width:100%;color:#fff">
                            Business prospect
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-lg-12">
               
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">คะแนนแยกตาม Pillar</h6>
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
                                      <span class="chartscore" id="chartpillar4"></span>
                                    </li>
                                  </ul>
                                  <ul class="chart-skills2"> 
                                    <li>
                                        <span class="chartscore" id="chartpillar3"></span>
                                    </li>
                                  </ul>
                                  <ul class="chart-skills3"> 
                                    <li>
                                        <span class="chartscore" id="chartpillar2"></span>
                                    </li>
                                  </ul>
                                  <ul class="chart-skills4"> 
                                    <li>
                                        <span class="chartscore" id="chartpillar1"></span>
                                    </li>
                                  </ul>
                              </div>
                              <div>
                                
                            </div>
                            </div>
                            <div class="col-md-1 l-75 table-none">
                                  <table style="width: 100%" class="table table-bordered table-h table-dark">
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
                                <table style="width: 100%" class="table table-bordered table-dark" >
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
                            <div class="col-md-3 top-550 pillarbx">
                                <div class="row pillarinfo">
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="space-block col-sm-3"></div>
                                            <div class="col-sm-9"> 
                                                <h2><span class="pillarname" style="color:#0680C3"> Management</span></h2>
                                                <img class="imgpillar" src="{{asset('assets/dashboard/images/chart/ttrs-01.png')}}" width="100px" alt=""></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mt-3">
                                        <h5 style="font-weight: bold;font-size:28px" class="pillarscoreh5"><span id="pillar_management" class="pillarscore"></span></h5>
                                        <h4 style="font-weight: bold;color:#0680C3;font-size:28px"><span id="gradepillar_management" style="white-space: nowrap" class="pillarscore"></span></h4>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 pillarbx">
                                <div class="row pillarinfo">
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="space-block col-sm-3"></div>
                                            <div class="col-sm-9"> 
                                                <h2><span class="pillarname" style="color:#D1495B"> Technology</span></h2>
                                                <img class="imgpillar" src="{{asset('assets/dashboard/images/chart/ttrs-02.png')}}" width="100px" alt=""></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mt-3">
                                        <h5 style="font-weight: bold;font-size:28px" class="pillarscoreh5"><span id="pillar_tech" class="pillarscore"></span></h5>
                                        <h4 style="font-weight: bold;color:#D1495B;font-size:28px"><span id="gradepillar_tech" style="white-space: nowrap" class="pillarscore"></span></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 pillarbx"> 
                                <div class="row pillarinfo">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="space-block col-sm-3"></div>
                                        <div class="col-sm-9"> 
                                            <h2><span class="pillarname" style="color:#07A398"> Marketability</span></h2>
                                            <img class="imgpillar" src="{{asset('assets/dashboard/images/chart/ttrs-03.png')}}" width="100px" alt=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <h5 style="font-weight: bold;font-size:28px" class="pillarscoreh5"><span id="pillar_marketability" class="pillarscore"></span></h5>
                                    <h4 style="font-weight: bold;color:#07A398;font-size:28px"><span id="gradepillar_marketability" style="white-space: nowrap" class="pillarscore"></span></h4>
                                   
                                </div>
                            </div>
                        </div>
                            <div class="col-md-3 pillarbx">  
                                <div class="row pillarinfo">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="space-block col-sm-3"></div>
                                        <div class="col-sm-9"> 
                                            <h2><span class="pillarname" style="color:#F6AE2D"> Business Prospect</span></h2>
                                            <img class="imgpillar" src="{{asset('assets/dashboard/images/chart/ttrs-04.png')}}" width="100px" alt=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <h5 style="font-weight: bold;font-size:28px" class="pillarscoreh5"><span id="pillar_bp" class="pillarscore"></span></h5>
                                    <h4 style="font-weight: bold;color:#F6AE2D;font-size:28px"><span id="gradepillar_bp" style="white-space: nowrap" class="pillarscore"></span></h4>
                                   
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" @if ($generalinfo->showgradeperpillar != 1) hidden @endif>
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
                                        <a href="#" data-toggle="modal" id="select_gradebypillar_excel" class="dropdown-item"><i class="icon-file-excel"></i>Excel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebypillar"></div>
                        </div>
                        <table id="gradebypillar_table" hidden >
                            <thead>
                                <tr>
                                    <th>รายการ</th>
                                    <th>AAA</th>
                                    <th>AA</th>
                                    <th>A</th>
                                    <th>BBB</th>
                                    <th>BB</th>
                                    <th>B</th>
                                    <th>CCC</th>
                                    <th>CC</th>
                                    <th>C</th>
                                    <th>D</th>
                                    <th>E</th>
                                </tr>
                        </table>
                    </div>
                </div>
      
            </div>
            <div class="col-lg-12" @if ($generalinfo->showgradeperbusinesssize != 1) hidden @endif>
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
                                        <a href="#" data-toggle="modal" id="select_gradebybusinesssize_excel" class="dropdown-item"><i class="icon-file-excel"></i>Excel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebybusinesssize"></div>
                        </div>
                        <table id="gradebybusinesssize_table" hidden>
                            <thead>
                                <tr>
                                    <th>รายการ</th>
                                    <th>AAA</th>
                                    <th>AA</th>
                                    <th>A</th>
                                    <th>BBB</th>
                                    <th>BB</th>
                                    <th>B</th>
                                    <th>CCC</th>
                                    <th>CC</th>
                                    <th>C</th>
                                    <th>D</th>
                                    <th>E</th>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-lg-12" @if ($generalinfo->showgradepersection != 1) hidden @endif>
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
                                        <a href="#" data-toggle="modal" id="select_gradebysector_excel" class="dropdown-item"><i class="icon-file-excel"></i>Excel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebysector"></div>
                        </div>
                        <table id="gradebysector_table" hidden >
                            <thead>
                                <tr>
                                    <th>รายการ</th>
                                    <th>AAA</th>
                                    <th>AA</th>
                                    <th>A</th>
                                    <th>BBB</th>
                                    <th>BB</th>
                                    <th>B</th>
                                    <th>CCC</th>
                                    <th>CC</th>
                                    <th>C</th>
                                    <th>D</th>
                                    <th>E</th>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12" @if ($generalinfo->showgradeperbusinesstype != 1) hidden @endif>
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
                                        <a href="#" data-toggle="modal" id="select_gradebybusinesstype_excel" class="dropdown-item"><i class="icon-file-excel"></i>Excel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebybusinesstype"></div>
                        </div>
                        <table id="gradebybusinesstype_table" hidden >
                            <thead>
                                <tr>
                                    <th>รายการ</th>
                                    <th>AAA</th>
                                    <th>AA</th>
                                    <th>A</th>
                                    <th>BBB</th>
                                    <th>BB</th>
                                    <th>B</th>
                                    <th>CCC</th>
                                    <th>CC</th>
                                    <th>C</th>
                                    <th>D</th>
                                    <th>E</th>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12" @if ($generalinfo->showgradeperindustrygroup != 1) hidden @endif>
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
                                        <a href="#" data-toggle="modal" id="select_gradebyindustry_excel" class="dropdown-item"><i class="icon-file-excel"></i>Excel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebyindustry"></div>
                        </div>
                        <table id="gradebyindustry_table" hidden >
                            <thead>
                                <tr>
                                    <th>รายการ</th>
                                    <th>AAA</th>
                                    <th>AA</th>
                                    <th>A</th>
                                    <th>BBB</th>
                                    <th>BB</th>
                                    <th>B</th>
                                    <th>CCC</th>
                                    <th>CC</th>
                                    <th>C</th>
                                    <th>D</th>
                                    <th>E</th>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12" @if ($generalinfo->showgradeperisic != 1) hidden @endif>
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
                                        <a href="#" data-toggle="modal" id="select_gradebyisic_excel" class="dropdown-item"><i class="icon-file-excel"></i>Excel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebyisic"></div>
                        </div>
                        <table id="gradebyisic_table" hidden >
                            <thead>
                                <tr>
                                    <th>รายการ</th>
                                    <th>AAA</th>
                                    <th>AA</th>
                                    <th>A</th>
                                    <th>BBB</th>
                                    <th>BB</th>
                                    <th>B</th>
                                    <th>CCC</th>
                                    <th>CC</th>
                                    <th>C</th>
                                    <th>D</th>
                                    <th>E</th>
                                </tr>
                        </table>
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
                    </div>
                    @php
                        $count = Auth::user()->Isexpertbelong; 
                        
                    @endphp
                    {{-- {{$count}} --}}
                    <div class="card-body">
                        <div class="table-responsive" >
                            @if ($fulltbps->count() > 0)
                                <div >
                                    <select id="leaderFilter_tb1" class="form-control selectcustomsearch">
                                    <option value="">== Leader ==</option>
                                    @foreach ($leaders as $leader)
                                        <option value="{{$leader->name}} {{$leader->lastname}}">{{$leader->name}} {{$leader->lastname}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div >
                                    <select id="expertFilter_tb1" class="form-control selectcustomsearch">
                                    <option value="">== ผู้เชี่ยวชาญ ==</option>
                                        @foreach ($experts as $expert)
                                            <option value="{{$expert->name}} {{$expert->lastname}}">{{$expert->name}} {{$expert->lastname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            
                            <table style="width: 100%" class="table table-bordered table-striped mb-2" id="maintable" >
                                <thead>
                                    <tr class="bg-info">
                                        <th hidden>date</th>
                                        <th style="width:1%;white-space: nowrap;text-align:center">เลขที่โครงการ</th> 
                                        <th style="width:1%;white-space: nowrap;text-align: center">ชื่อโครงการ</th> 
                                       
                                        <th style="width:1%;white-space: nowrap;text-align: center">ระยะเวลา</th>
                                        <th style="width:1%;white-space: nowrap;text-align: center">วันนัดก่อนลงพื้นที่</th>
                                        <th style="width:1%;white-space: nowrap;text-align: center">วันที่ประเมิน</th>
                                        <th style="width:1%;white-space: nowrap;text-align: center">วันที่สรุปผลประเมิน</th>
                                        @if (Auth::user()->user_type_id < 5 && $count > 0)
                                            <th style="width:1%;white-space: nowrap;text-align: center">การเข้าร่วม</th>
                                        @endif
                                        
                                        <th style="width:1%;white-space: nowrap;text-align: center">สถานภาพ</th>
                                        <th style="width:1%;white-space: nowrap;text-align:center" hidden >hidden_leader</th> 
                                        <th style="width:1%;white-space: nowrap;text-align:center" hidden>hidden_expert</th>                             
                                        <th style="width:1%;white-space: nowrap;text-align:center" hidden>hidden_grade</th> 
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($fulltbps as $fulltbp)
                                        @if ($fulltbp->minitbp->businessplan->business_plan_status_id > 2 & ($fulltbp->canceldate == null))
                                            @php
                                                $check = Auth::user()->IsExpert($fulltbp->id);
                                            @endphp

                                            {{-- @if (Empty($fulltbp->finishdate)) --}}
                                                <tr> 
                                                    <td hidden>{{$fulltbp->minitbp->updated_at}}</td>
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
                                                        @if (Empty($fulltbp->expertassignment))
                                                                <a href="#" data-toggle="modal" data-id="{{$fulltbp->minitbp->id}}" class="controlflowicon"><i class="icon-cog2 {{$cogcolor}} mr-2"></i></a>
                                                                <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="{{$cogcolor}}" target="_blank" >{{$fulltbp->minitbp->project}} {!!$latetext!!}</a>  
                                                            @else
                                                                @if ($fulltbp->expertassignment->accepted == 1)
                                                                    <a href="#" data-toggle="modal" data-id="{{$fulltbp->minitbp->id}}" class="controlflowicon"><i class="icon-cog2 {{$cogcolor}} mr-2"></i></a>
                                                                    <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="{{$cogcolor}}" target="_blank" >{{$fulltbp->minitbp->project}} {!!$latetext!!}</a>  
                                                                @else
                                                                @if (Auth::user()->isProjectCoLeader($fulltbp->id) > 0 )
                                                                        <a href="#" data-toggle="modal" data-id="{{$fulltbp->minitbp->id}}" class="controlflowicon"><i class="icon-cog2 {{$cogcolor}} mr-2"></i></a>
                                                                        <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="{{$cogcolor}}" target="_blank" >{{$fulltbp->minitbp->project}} {!!$latetext!!}</a>  
                                                                    @else
                                                                        {{$fulltbp->minitbp->project}}
                                                                @endif
                                                                    
                                                                @endif
                                                        @endif     
                                                    </td>   
                                                    
                                                    <td style="width:1%;white-space: nowrap;text-align: center"> {{$fulltbp->minitbp->projectdatediff}} </td>  
                                                    <td style="width:1%;white-space: nowrap;text-align: center">
                                                        @if (!Empty($fulltbp->brieftdate))
                                                            {{$fulltbp->brieftdateth}}
                                                            @else
                                                            {{$fulltbp->briefingdate}} 
                                                        @endif 
                                                    </td>  
                                                    <td style="width:1%;white-space: nowrap;text-align: center">
                                                        @if (!Empty($fulltbp->fielddate))
                                                            {{$fulltbp->fielddateth}}
                                                            @else
                                                            {{$fulltbp->assessmentdate}}
                                                        @endif
                                                        </td>  
                                                    <td style="width:1%;white-space: nowrap;text-align: center"> 
                                                        @if (!Empty($fulltbp->scoringdate))
                                                                {{$fulltbp->scoringdateth}}
                                                            @else
                                                                {{$fulltbp->finalassessmentdate}}
                                                        @endif
                                                    </td>  
                                                    @if (Auth::user()->user_type_id < 5 && $count > 0)
                                                        <td style="width:1%;white-space: nowrap;text-align: center"> 
                                                            @if (!Empty($check))
                                                                @if ($fulltbp->expertassignment->accepted == 0)
                                                                        <a href="{{route('dashboard.admin.report.expert.accept',['id' => $fulltbp->id])}}" onclick="confirmjoinproject(event)" data-id="{{$fulltbp->id}}" data-toggle="modal"  class="btn btn-sm bg-info"><i class="icon-spinner spinner mr-2" id="spinjoinproject{{$fulltbp->id}}" hidden></i>ยอมรับเข้าร่วม</a>
                                                                        <a href="#" data-id="{{$fulltbp->id}}" data-toggle="modal" class="btn btn-sm bg-danger reject">ปฎิเสธเข้าร่วม</a>
                                                                    @elseif($fulltbp->expertassignment->accepted == 2)
                                                                        <a href="" class="btn btn-sm bg-info showreject" data-id="{{$fulltbp->id}}" data-toggle="modal">เหตุผลการไม่เข้าร่วม</a> 
                                                                @endif
                                                            @endif
                                                        </td> 
                                                    @endif
                                                
                                                    <td style="width:1%;white-space: nowrap;text-align: center"> 
                                                        @if ($fulltbp->status == 3)
                                                                <span class="badge badge-flat border-success-600 text-success-600">{{$fulltbp->minitbp->businessplan->businessplanstatus->name}} </span> 
                                                            @else
                                                            <span class="badge badge-flat border-grey-600 text-grey-600">{{$fulltbp->minitbp->businessplan->businessplanstatus->name}} </span> 
                                                        @endif
                                                    </td> 
                                                    <td hidden>{{@$fulltbp->searchprojectleader}}</td>
                                                        <td hidden>{{@$fulltbp->searchprojectexpert}}</td>
                                                        <td hidden>{{@$fulltbp->searchprojectgrade}}</td>
                                                </tr>
                                            {{-- @endif --}}

                                          
                                        @endif
 
                                    @endforeach
                                </tbody>
                            </table>      
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                <div class="list-icons ml-3">
                                    <div class="list-icons-item dropdown">
                                        <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                        <div class="dropdown-menu">
                                            <a href="#" data-toggle="modal" id="select_fulltbptable_excel" class="dropdown-item"><i class="icon-file-excel"></i>Excel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <input type="text" id="fulltbpid"  hidden>
                            <div class="table-responsive" >
                                @if ($fulltbps->count() > 0)
                                    <div >
                                        <select id="gradeFilter" class="form-control selectcustomsearch">
                                        <option value="">== เกรด ==</option>
                                        @foreach ($gradecollection->sortDesc()->reverse() as $grade)
                                            <option value="{{$grade}}">{{$grade}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div >
                                        <select id="leaderFilter" class="form-control selectcustomsearch">
                                        <option value="">== Leader ==</option>
                                        @foreach ($leaders as $leader)
                                            <option value="{{$leader->name}} {{$leader->lastname}}">{{$leader->name}} {{$leader->lastname}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div >
                                        <select id="expertFilter" class="form-control selectcustomsearch">
                                        <option value="">== ผู้เชี่ยวชาญ ==</option>
                                            @foreach ($experts as $expert)
                                                <option value="{{$expert->name}} {{$expert->lastname}}">{{$expert->name}} {{$expert->lastname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
        

                                <table style="width: 100%" class="table table-bordered table-striped mb-2" id="fulltbptable" style="width: 100%" >
                                    <thead>
                                        <tr class="bg-info">
                                            <th hidden>date</th>
                                            <th style="width:1%;white-space: nowrap;text-align:center">เลขที่โครงการ</th> 
                                            <th style="width:1%;white-space: nowrap;text-align:center">ชื่อโครงการ</th> 
                                            
                                            <th style="width:1%;white-space: nowrap;text-align:center">Full TBP</th> 
                                            <th style="width:1%;white-space: nowrap;text-align:center">ผู้เชี่ยวชาญ</th> 
                                            <th style="width:1%;white-space: nowrap;text-align:center">EV</th> 
                                            <th style="width:1%;white-space: nowrap;text-align:center">BOL</th> 
                                            <th style="width:1%;white-space: nowrap;text-align:center">สถานภาพ</th> 
                                            <th style="width:1%;white-space: nowrap;text-align:center" hidden>hidden_leader</th> 
                                            <th style="width:1%;white-space: nowrap;text-align:center" hidden>hidden_expert</th>                             
                                            <th style="width:1%;white-space: nowrap;text-align:center" hidden>hidden_grade</th>                               
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fulltbps as $key => $fulltbp)
                                            @if (($fulltbp->minitbp->businessplan->business_plan_status_id > 4 &&  Auth::user()->isProjectLeader(@$fulltbp->id) == 1) || ($fulltbp->minitbp->businessplan->business_plan_status_id > 4 && Auth::user()->user_type_id >=5))
                                               @if (Empty($fulltbp->finishdate))
                                                <tr>  
                                                    <td hidden >{{$fulltbp->updated_at}}</td>  
                                                    <td style="width:1%;white-space: nowrap;text-align:center">{{$fulltbp->fulltbp_code}}</td> 
                                                    <td style="white-space: nowrap;"> 
                                                        @php
                                                            $cogcolor = 'text-info';
                                                            $latetext = '';
                                                            if (@$fulltbp->minitbp->isintime($fulltbp->minitbp->id) < 0) {
                                                                $cogcolor = 'text-danger';
                                                            
                                                                $latetext =  '<span class="badge badge-flat border-danger-600 text-danger-600">(เกินกำหนด '.$fulltbp->minitbp->isintime($fulltbp->minitbp->id)*(-1) .' วัน)</span>';
                                                            }
                                                        @endphp  
                                                        <a href="#" data-toggle="modal" data-id="{{$fulltbp->minitbp->id}}" class="controlflowicon"><i class="icon-cog2 {{$cogcolor}} mr-2"></i></a>
                                                        <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="{{$cogcolor}}" target="_blank" >{{$fulltbp->minitbp->project}} {!!$latetext!!} </a>  
                                                    </td>  
                                                    
                                                    <td style="width:1%;white-space: nowrap;text-align:center">    
                                                        @if ($fulltbp->minitbp->businessplan->business_plan_status_id > 5 )
                                                                {{-- <span class="badge badge-flat border-success text-success-600">ผ่านการอนุมัติ</span> --}}
                                                                <a  href="{{route('dashboard.admin.project.fulltbp.view',['id' => $fulltbp->id])}}"><span class="badge badge-flat border-success text-success-600">ผ่านการอนุมัติ</span></a>
                                                                @if (!Empty($fulltbp->approvelog))
                                                                    <button  data-toggle="modal" data-id="{{$fulltbp->id}}" data-doctype="2" class="btn btn-sm bg-success showapprovelog mr-1">การอนุมัติ</a>
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
                                                    <td style="width:1%;white-space: nowrap;text-align:center"> 
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
                                                    <td style="width:1%;white-space: nowrap;text-align:center"> 
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
                                                    <td style="width:1%;white-space: nowrap;text-align:center"> 
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
                                                    <td hidden>{{$fulltbp->searchprojectleader}}</td>
                                                    <td hidden>{{$fulltbp->searchprojectexpert}}</td>
                                                    <td hidden>{{$fulltbp->searchprojectgrade}}</td>
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

            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h6 class="card-title" style="font-size:16px;font-weight: bold">ผลการประเมินโครงการ</h6>
                            <div class="header-elements">
                                <div class="list-icons ml-3">
                                    <div class="list-icons-item dropdown">
                                        <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                        <div class="dropdown-menu">
                                            <a href="#" data-toggle="modal" id="select_reporttable_excel" class="dropdown-item"><i class="icon-file-excel"></i>Excel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive" >
                                @if ($fulltbps->count() > 0)
                                    <div >
                                        <select id="gradeFilter_tb2" class="form-control selectcustomsearch">
                                        <option value="">== เกรด ==</option>
                                        @foreach ($gradecollection->sortDesc()->reverse() as $grade)
                                            <option value="{{$grade}}">{{$grade}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div >
                                        <select id="leaderFilter_tb2" class="form-control selectcustomsearch">
                                        <option value="">== Leader ==</option>
                                        @foreach ($leaders as $leader)
                                            <option value="{{$leader->name}} {{$leader->lastname}}">{{$leader->name}} {{$leader->lastname}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div >
                                        <select id="expertFilter_tb2" class="form-control selectcustomsearch">
                                        <option value="">== ผู้เชี่ยวชาญ ==</option>
                                            @foreach ($experts as $expert)
                                                <option value="{{$expert->name}} {{$expert->lastname}}">{{$expert->name}} {{$expert->lastname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <table style="width: 100%" class="table table-bordered text-nowrap mb-2" id="reporttable">
                                    <thead>
                                        <tr class="bg-info">
                                            <th hidden>date</th>
                                            <th style="width:1%;white-space: nowrap;text-align:center">เลขที่โครงการ</th> 
                                            <th style="width:1%;white-space: nowrap;text-align: center">ชื่อโครงการ</th> 
                                            <th style="width:1%;white-space: nowrap;text-align: center">คะแนน</th>
                                            <th style="width:1%;white-space: nowrap;text-align: center">เกรด</th>     
                                            <th style="width:1%;white-space: nowrap;text-align: center">รายงานผล</th>    
                                            <th style="width:1%;white-space: nowrap;text-align: center">แจ้งผล</th> 
                                            <th style="width:1%;white-space: nowrap;text-align: center">แจ้งผลทางจดหมาย</th>  
                                            <th style="width:1%;white-space: nowrap;text-align: center">สิ้นสุดโครงการ</th>    
                                            <th style="width:1%;white-space: nowrap;text-align:center" hidden>hidden_leader</th> 
                                            <th style="width:1%;white-space: nowrap;text-align:center" hidden>hidden_expert</th>                             
                                            <th style="width:1%;white-space: nowrap;text-align:center" hidden>hidden_grade</th>            
                                        </tr>
                                    </thead>
                                    <tbody style="min-height:300px">
                                        @foreach ($fulltbps as $key => $fulltbp)
                                            @if ($fulltbp->minitbp->businessplan->business_plan_status_id >= 8 && $fulltbp->canceldate == null)
                                                @if (Auth::user()->isProjectLeader($fulltbp->id) == 1 || Auth::user()->user_type_id >= 5)
                                                    <tr>   
                                                        <td hidden>{{$fulltbp->updated_at}}</td> 
                                                        <td style="width:1%;white-space: nowrap;text-align: center">{{$fulltbp->fulltbp_code}}</td> 
                                                        {{-- <td style="white-space: nowrap"> {{$fulltbp->minitbp->project}} </td>  --}}
                                                        <td style="white-space: nowrap"> <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="text-info" target="_blank" >{{$fulltbp->minitbp->project}}</a> </td> 
                                                        {{-- <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="{{$cogcolor}}" target="_blank" >{{$fulltbp->minitbp->project}}</a>   --}}
                                                        <td style="width:1%;white-space: nowrap;text-align: center"> {{number_format(@$fulltbp->projectgrade->percent, 2, '.', '')}} </td>  
                                                        <td style="width:1%;white-space: nowrap;text-align: center"> {{@$fulltbp->projectgrade->grade}} </td> 
                                                        <td style="width:1%;white-space: nowrap;text-align: center"> 
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
                                                        <td style="width:1%;white-space: nowrap;text-align: center"> 
                                                            @if ($fulltbp->minitbp->businessplan->business_plan_status_id >=9)
                                                                <span class="badge badge-flat border-success text-success-600">แจ้งผลแล้ว</span>
                                                            @else
                                                                @if ($fulltbp->minitbp->businessplan->business_plan_status_id == 8 && $generalinfo->use_invoice_status_id == 2)
                                                                    <button class="btn btn-sm bg-warning notifyresult" data-id="{{$fulltbp->minitbp->id}}"><i class="icon-spinner spinner mr-2" id="spinresultnity" hidden></i>แจ้งผล</button>
                                                                @endif
                                                            @endif

                                                        </td>
                                                        <td style="width:1%;white-space: nowrap;text-align: center">
                                                            @if (!Empty($fulltbp->projectstatustransaction(7)))
                                                                    @if ($fulltbp->projectstatustransaction(7)->status == 2)  
                                                                        @if ($fulltbp->projectfinishattachment > 0)
                                                                            <a href="{{route('dashboard.admin.evaluationresult.attachment',['id' => $fulltbp->id])}}" data-name="" class="btn btn-sm bg-info">เอกสารแนบ</a>
                                                                        @endif
                                                                            <span class="badge badge-flat border-success text-success-600">ส่งจดหมายแล้ว</span>
                                                                        @elseif($fulltbp->projectstatustransaction(7)->status == 1)
                                                                        
                                                                            @if (Auth::user()->user_type_id == 4)
                                                                            <a href="{{route('dashboard.admin.evaluationresult.attachment',['id' => $fulltbp->id])}}" data-name="" class="btn btn-sm bg-info">เอกสารแนบ</a>
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
                                                        <td style="width:1%;white-space: nowrap;text-align: center"> 
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
                                                        <td hidden>{{$fulltbp->searchprojectleader}}</td>
                                                        <td hidden>{{$fulltbp->searchprojectexpert}}</td>
                                                        <td hidden>{{$fulltbp->searchprojectgrade}}</td>
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

        
        @if ($fulltbps->count() > 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h6 class="card-title" style="font-size:16px;font-weight: bold">ปฏิทิน</h6>
                            <div class="header-elements">
                                {{-- <a class="text-default daterange font-weight-semibold cursor-pointer dropdown-toggle">
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
        @endif

    </div>
    <!-- /content area -->
@endsection
@section('pageScript')


<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>


<script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/daygrid/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/timegrid/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/list/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/interaction/main.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/google-calendar/main.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/locales/es.js')}}"></script>

<script src="{{asset('assets/dashboard/js/plugins/echart/echarts.min.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/reporthelper.js?v=4')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/utility.js?v=1')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/controlflow.js?v=1')}}"></script>

<script type="module" src="{{asset('assets/dashboard/js/app/helper/approvefulltbphelper.js?v=1')}}"></script>

<script>
    // AOS.init();
    var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content'),
        branchid: "{{Auth::user()->branch_id}}",
        popupmessages : JSON.parse(JSON.stringify({!! json_encode($popupmessages) !!}))
    };

    var _popupmessages = route.popupmessages;
        // define container
    var redips = {};
    
    // append scroll parameter to URL or return scroll value
    redips.scroll = function (url) {
        let scroll, q;
        // DOM compliant
        if (document.body && document.body.scrollTop) {
            scroll = document.body.scrollTop;
        }
        // old - Netscape compliant
        else if (typeof (window.pageYOffset) === 'number') {
            scroll = window.pageYOffset;
        }
        // very very old - IE6 standards compliant mode
        else if (document.documentElement && document.documentElement.scrollTop) {
            scroll = document.documentElement.scrollTop;
        }
        // when vertical scroll bar is on the top
        else {
            scroll = 0;
        }
        // if input parameter does not exist then return scroll value
        if (url === undefined) {
            return scroll;
        }
        // else append scroll parameter to URL
        else {
            // set "?" or "&" before scroll parameter
            q = url.indexOf('?') === -1 ? '?' : '&';
            // load page with scroll position parameter
            window.location.href = url + q + 'scroll=' + scroll;
        }
    };
    
    // set scroll position if URL contains scroll=nnn parameter
    redips.setScrollOnLoad = function () {
        // get query string parameter with "?"
        let search = window.location.search,
            matches;
        // if query string exists
        if (search) {
            // find scroll parameter in query string
            matches = /scroll=(\d+)/.exec(search);
            // jump to scroll position if scroll parameter exists
            if (matches) {
                window.scrollTo(0, matches[1]);
            }
        }
    };
    
    // add onload event listener
    if (window.addEventListener) {
        window.addEventListener('load', redips.setScrollOnLoad, false);
    }
    else if (window.attachEvent) {
        window.attachEvent('onload', redips.setScrollOnLoad);
    }

    var countitemtable =  "{{$fulltbps->count()}}";
        if (countitemtable >= 1) {
            $('#maintable').DataTable( {
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
                            return "รายละเอียดโครงการ" ;      
                        }, 
                        exportOptions: {
                            columns: [  1,2,3,4, 5,6]
                        },
                        customize: function( xlsx ) {
                            var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                            source.setAttribute('name','รายละเอียดโครงการ');
                        }, 
                    }        
                ],
                drawCallback: function() {
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
                customSearhExact_tb1("#leaderFilter_tb1",leaderindex_tb1);
                $("#expertFilter_tb1").prop("selectedIndex", 0);
            });
            $("#expertFilter_tb1").change(function (e) {
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

        if (countitemtable >= 1) {
            $('#fulltbptable').DataTable( {
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
                            columns: [  1,2,3,4,5,6,7]
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
            var table = $('#fulltbptable').DataTable();
            $("#fulltbptable_filter.dataTables_filter").append($("#leaderFilter"));
            $("#fulltbptable_filter.dataTables_filter").append($("#expertFilter"));
            $("#fulltbptable_filter.dataTables_filter").append($("#gradeFilter"));

            var leaderindex = 0;
            var expertrindex = 0;
            var gradeindex = 0;
            
            $("#fulltbptable th").each(function (i) {
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

        if (countitemtable >= 1) {
            $('#reporttable').DataTable( {
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
                            return "ผลการประเมินโครงการ" ;      
                        }, 
                        exportOptions: {
                            columns: [  1,2,3,4, 7,8,9]
                        },
                        customize: function( xlsx ) {
                            var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                            source.setAttribute('name','ผลการประเมินโครงการ');
                        }, 
                    }        
                ],
                drawCallback: function() {
                    // $('.buttons-excel')[0].style.visibility = 'hidden';
                }
    
            });

            var table_tb2 = $('#reporttable').DataTable();
            $("#reporttable_filter.dataTables_filter").append($("#leaderFilter_tb2"));
            $("#reporttable_filter.dataTables_filter").append($("#expertFilter_tb2"));
            $("#reporttable_filter.dataTables_filter").append($("#gradeFilter_tb2"));

            var leaderindex_tb2 = 0;
            var expertrindex_tb2 = 0;
            var gradeindex_tb2 = 0;
            
            $("#reporttable th").each(function (i) {
                if ($($(this)).html() == "hidden_leader") {
                    leaderindex_tb2 = i; 
                }
                if ($($(this)).html() == "hidden_expert") {
                    expertrindex_tb2 = i; 
                }
                if ($($(this)).html() == "hidden_grade") {
                    gradeindex_tb2 = i; 
                }
            });
            $("#leaderFilter_tb2").change(function (e) {
                customSearhExact_tb2("#leaderFilter_tb2",leaderindex_tb2);
                $("#expertFilter_tb2").prop("selectedIndex", 0);
                $("#gradeFilter_tb2").prop("selectedIndex", 0);
            });
            $("#expertFilter_tb2").change(function (e) {
                customSearhContain_tb2("#expertFilter_tb2",expertrindex_tb2);
                $("#leaderFilter_tb2").prop("selectedIndex", 0);
                $("#gradeFilter_tb2").prop("selectedIndex", 0);
            });
            $("#gradeFilter_tb2").change(function (e) {
                customSearhExact_tb2("#gradeFilter_tb2",gradeindex_tb2);
                $("#leaderFilter_tb2").prop("selectedIndex", 0);
                $("#expertFilter_tb2").prop("selectedIndex", 0);
            });

            function customSearhContain_tb2(el,elindex){
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
                table_tb2.draw();
            }
            function customSearhExact_tb2(el,elindex){
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
                table_tb2.draw();
            }



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
            popupmessage = route.popupmessages.find(x => x.id ==74);
                Swal.fire({
                    title: popupmessage['title'],
                    text: popupmessage['message'],
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
            popupmessage = route.popupmessages.find(x => x.id ==73);
            Swal.fire({
                title: popupmessage['title'],
                text: popupmessage['message'],
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
            popupmessage = route.popupmessages.find(x => x.id ==72);
            Swal.fire({
                title: popupmessage['title'],
                text: popupmessage['message'],
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                denyButtonText: `Preview`,
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

        function confirmjoinproject(e) {
                e.preventDefault();
                var dataid = e.currentTarget.dataset.id;
                var urlToRedirect = e.currentTarget.getAttribute('href');
                    // popupmessage = route.popupmessages.find(x => x.id ==74);
                    Swal.fire({
                        title: 'โปรดยืนยัน',
                        text: 'เข้าร่วมโครงการ',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'ตกลง',
                        cancelButtonText: 'ยกเลิก',
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }).then((result) => {
                        $("#spinjoinproject"+dataid).attr("hidden",false);  
                        if (result.value) {
                            window.location.href = urlToRedirect;
                        }else{
                            $("#spinjoinproject"+dataid).attr("hidden",true); 
                        }
                });
            }
</script>

@stop
