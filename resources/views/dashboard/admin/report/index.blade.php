@extends('layouts.dashboard.main')
@section('pageCss')

<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/daygrid/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/timegrid/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/list/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/aos/aos.css')}}" rel="stylesheet">
{{-- <link href="{{asset('assets/dashboard/js/plugins/chart/chart.css')}}"> --}}
@stop
@section('content')
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
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>หัวข้อ</label>
                                            <input type="text"  id="title" value=""  placeholder="หัวข้อ" class="form-control form-control-lg" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>การเข้าร่วม<span class="text-danger">*</span></label>
                                        <select id="attendevent" class="form-control form-control-lg form-control-select2">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>ประเภท</label>
                                            <input type="text" id="eventtype" value=""  placeholder="ประเภท" class="form-control form-control-lg" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>วันที่</label>
                                            <input type="text" id="eventdate" value=""  placeholder="วันที่" class="form-control form-control-lg" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>เวลาเริ่ม</label>
                                            <input type="text" id="starttime" value=""  placeholder="เวลาเริ่ม" class="form-control form-control-lg" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>ถึงเวลา</label>
                                            <input type="text" id="endtime" value=""  placeholder="ถึงเวลา" class="form-control form-control-lg" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>รายละเอียด</label>
                                            <textarea type="text" id="detail" rows="3" cols="5"  placeholder="รายละเอียด" class="form-control form-control-lg" readonly></textarea>
                                        </div>
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
                                            <th>สถานะ</th>                                                                               
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
                    <a href="{{route('setting.profile.officer.edit',['userid' => Auth::user()->id])}}" class="btn btn-labeled bg-warning" ><span class="blink">โปรดตั้งค่าโพรไฟล์</span></a>
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
        @if (Auth::user()->user_type_id > 5)
        <div class="row">
            <div class="col-lg-3">
                <div class="card bg-teal-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h1 class="font-weight-semibold mb-0">{{$businessplans->count()}}</h1>
                        </div>
                        <div>
                            จำนวนสมัครสมาชิก
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div id="members-online"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card bg-blue-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h1 class="font-weight-semibold mb-0">{{$businessplans->where('business_plan_status_id','>=',4)->count()}}</h1>
                        </div>
                        <div>
                            จำนวนยื่น Mini Tbp
                        </div>
                    </div>
                    <div id="today-revenue"></div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card bg-pink-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h1 class="font-weight-semibold mb-0">{{$businessplans->where('business_plan_status_id','>=',6)->count()}}</h1>
                        </div>
                        <div>
                            จำนวนยื่น Full TBP
                        </div>
                    </div>
                    <div id="today-revenue"></div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card bg-orange-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h1 class="font-weight-semibold mb-0">{{$businessplans->where('business_plan_status_id','>=',8)->count()}}</h1>
                        </div>
                        <div>
                            จำนวนที่ได้รับการประเมิน
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
                        <h6 class="card-title">เกรดแยกตาม Pillar</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <canvas id="myChart" width=200  height=200 ></canvas>
                            </div>
                            <div class="col-md-9 l-40 none">
                              <div style="margin-top: 300px;"></div>
                              <ul class="chart-skills">
                                <li>
                                  <span id="chartpillar4"></span>
                                </li>
                              </ul>
                              <ul class="chart-skills2" style="margin-top:-230px"> 
                                <li>
                                    <span id="chartpillar3"></span>
                                </li>
                              </ul>
                              <ul class="chart-skills3" style="margin-top:-286px"> 
                                <li>
                                    <span id="chartpillar2"></span>
                                </li>
                              </ul>
                              <ul class="chart-skills4 l-30" style="margin-top:-344px"> 
                                <li>
                                    <span id="chartpillar1"></span>
                                </li>
                              </ul>
                              <div class="text-min"> 
                                min
                              </div>
                              <div class="text-max">
                                max
                              </div>
                            </div>
                            <div class="col-md-1">
                                  <table class="table-score table-bordered table-dark" data-aos="fade-laft" data-aos-delay="200">
                                <thead>
                                  <tr>
                                   
                                    <td class="bg-01 white" colspan="2">Level Classification</td>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr class="bg-02">
                                    <td style="width:70px"> 87-100</td>
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
                        <div class="row">
                            <div class="col-md-3" data-aos="fade-up">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-6"></div>
                                            <div class="col-sm-6"> 
                                                <h2><span style="font-weight: bold"> 01</span></h2>
                                                <img src="{{asset('assets/dashboard/images/chart/01.png')}}" width="100px" alt=""></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6 class="color-01" style="font-weight: bold">Management</h6>
                                        <h5><span id="pillar1"></span></h5>
                                        <h4 class="color-01"><span id="gradepillar1"></span></h4>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-6"></div>
                                            <div class="col-sm-6"> 
                                                <h2><span style="font-weight: bold"> 02</span></h2>
                                                <img src="{{asset('assets/dashboard/images/chart/02.png')}}" width="100px" alt=""></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6 class="color-02" style="font-weight: bold">Technology</h6>
                                        <h5><span id="pillar2"></span></h5>
                                        <h4 class="color-02"><span id="gradepillar2"></span></h4>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3" data-aos="fade-up" data-aos-delay="400"> 
                                <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6"></div>
                                        <div class="col-sm-6"> 
                                            <h2><span style="font-weight: bold"> 03</span></h2>
                                            <img src="{{asset('assets/dashboard/images/chart/03.png')}}" width="100px" alt=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="color-03" style="font-weight: bold">Marketability</h6>
                                    <h5><span id="pillar3"></span></h5>
                                    <h4 class="color-03"><span id="gradepillar3"></span></h4>
                                   
                                </div>
                            </div>
                        </div>
                            <div class="col-md-3" data-aos="fade-up" data-aos-delay="600">  <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6"></div>
                                        <div class="col-sm-6"> 
                                            <h2><span style="font-weight: bold"> 04</span></h2>
                                            <img src="{{asset('assets/dashboard/images/chart/04.png')}}" width="100px" alt=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="color-04" style="font-weight: bold">Business Prospet</h6>
                                    <h5><span id="pillar4"></span></h5>
                                    <h4 class="color-04"><span id="gradepillar4"></span></h4>
                                   
                                </div>
                            </div>
                        </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">เกรดแยกตาม Pillar</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebypillar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">เกรดแยกตามขนาดธุรกิจ</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebybusinesssize"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">เกรดแยกตามภูมิภาค</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebysector"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">เกรดแยกตามประเภทธุรกิจ</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebybusinesstype"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">เกรดแยกตามกลุ่มอุตสาหกรรม</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="width: 100%; min-height: 500px" id="gradebyindustry"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">เกรดแยกตาม Isic</h6>
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
                        <h6 class="card-title">รายการโครงการ</h6>
                        <div class="header-elements">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" >
                                <thead>
                                    <tr>
                                        <th>ชื่อโครงการ</th> 
                                        <th>สถานะ</th>
                                        <th>วันนัดประชุมก่อนลงพื้นที่</th>
                                        <th>วันที่ประเมิน</th>
                                        <th>วันที่สรุปผลประเมิน</th>
                                        <th>เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($fulltbps as $fulltbp)
                                        @if ($fulltbp->minitbp->businessplan->business_plan_status_id > 2 & ($fulltbp->canceldate == null))
                                            @php
                                                $check = Auth::user()->IsExpert($fulltbp->id);
                                            @endphp
                                            <tr> 
                                                <td>
                                                    @if (Empty($fulltbp->expertassignment))
                                                            <a href="#" data-toggle="modal" data-id="{{$fulltbp->minitbp->id}}" class="controlflowicon"><i class="icon-cog2 text-info mr-2"></i></a>
                                                            <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->company->id])}}" class="text-info" target="_blank" >{{$fulltbp->minitbp->project}} </a>  
                                                        @else
                                                            @if ($fulltbp->expertassignment->accepted == 1)
                                                                <a href="#" data-toggle="modal" data-id="{{$fulltbp->minitbp->id}}" class="controlflowicon"><i class="icon-cog2 text-info mr-2"></i></a>
                                                                <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->company->id])}}" class="text-info" target="_blank" >{{$fulltbp->minitbp->project}} </a>  
                                                            @else
                                                                {{$fulltbp->minitbp->project}}
                                                            @endif
                                                    @endif          
                                                </td>  
                                                <td> 
                                                    @if ($fulltbp->status == 3)
                                                            <span class="badge badge-flat border-success-600 text-success-600">{{$fulltbp->minitbp->businessplan->businessplanstatus->name}} </span> 
                                                        @else
                                                        <span class="badge badge-flat border-grey-600 text-grey-600">{{$fulltbp->minitbp->businessplan->businessplanstatus->name}} </span> 
                                                    @endif
                                                </td>  
                                                <td> {{$fulltbp->briefingdate}} </td>  
                                                <td> {{$fulltbp->assessmentdate}} </td>  
                                                <td> {{$fulltbp->finalassessmentdate}} </td>  
                                                <td> 
                                                    @if (!Empty($check))
                                                        @if ($fulltbp->expertassignment->accepted == 0)
                                                                <a href="{{route('dashboard.admin.report.expert.accept',['id' => $fulltbp->id])}}" class="btn btn-sm bg-info">ยอมรับเข้าร่วม</a>
                                                                <a href="#" data-id="{{$fulltbp->id}}" data-toggle="modal" class="btn btn-sm bg-danger reject">ปฎิเสธเข้าร่วม</a>
                                                            @elseif($fulltbp->expertassignment->accepted == 2)
                                                                <a href="" class="btn btn-sm bg-info showreject" data-id="{{$fulltbp->id}}" data-toggle="modal">เหตุผลการไม่เข้าร่วม</a> 
                                                        @endif
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
        {{-- @if (Auth::user()->user_type_id >= 5)
        <div class="row">
            @if ($numprojectcollections->count() > 0)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h6 class="card-title">จำนวนโครงการ ปี <span id="currentyear">{{intVal(date("Y"))+543}}</span></h6>
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
                                        <table class="table table-striped" id="testtopictable">
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
                        <h6 class="card-title">จำนวนโครงการตามเกรดการประเมิน ปี {{intVal(date("Y"))+543}}</h6>
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
                                    <table class="table table-striped" id="testtopictable">
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
                        <h6 class="card-title">โครงการตามกลุ่มอุตสาหกรรม ปี {{intVal(date("Y"))+543}}</h6>
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
                                    <table class="table table-striped" id="testtopictable">
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
                            <h6 class="card-title">วัตถุประสงค์ของการขอรับการประเมิน ปี {{intVal(date("Y"))+543}}</h6>
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
                                        <table class="table table-striped" id="testtopictable">
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
                            <h6 class="card-title">ปฏิทิน</h6>
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

<script src="{{asset('assets/dashboard/js/plugins/echart/echarts.min.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/reporthelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
{{-- <script src="{{asset('assets/dashboard/js/plugins/chart/chart.2.6.0.js')}}"></script> --}}
{{-- <script src="{{asset('assets/dashboard/js/plugins/chart/chart.js')}}"></script> --}}
<script src="{{asset('assets/dashboard/js/app/helper/controlflow.js')}}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}

<script>
      AOS.init();
    var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content'),
        branchid: "{{Auth::user()->branch_id}}"
    };

    $('#maintable').DataTable( {
        "paging":   true,
        "ordering": true,
        "info":     false,
        "pageLength" : 50,
        "language": {
            "search": "ค้นหา: ",  
            "sLengthMenu": "จำนวน _MENU_ รายการ",
            'paginate': {
                'previous': 'ก่อนหน้า',
                'next': 'ถัดไป'
            }
        }
    });

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
</script>

@stop
