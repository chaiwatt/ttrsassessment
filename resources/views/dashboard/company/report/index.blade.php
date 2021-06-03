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
</style>
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
            <h4> <span class="font-weight-semibold">
                @if (Empty(Auth::user()->company->name))
                        รายงาน : ยังไม่ได้ตั้งค่า
                    @else
                    @php
                        $company = Auth::user()->company;
                        $company_name = (!Empty($company->name))?$company->name:'';
                        $bussinesstype = $company->business_type_id;
                        $fullcompanyname = $company_name;

                        if($bussinesstype == 1){
                            $fullcompanyname = 'บริษัท ' . $company_name . ' จำกัด (มหาชน)';
                        }else if($bussinesstype == 2){
                            $fullcompanyname = 'บริษัท ' . $company_name . ' จำกัด'; 
                        }else if($bussinesstype == 3){
                            $fullcompanyname = 'ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
                        }else if($bussinesstype == 4){
                            $fullcompanyname = 'ห้างหุ้นส่วนสามัญ ' . $company_name; 
                        }
                    @endphp
                        {{$fullcompanyname}}
                @endif
            </span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            @if (Auth::user()->company->saveprofile == 0)
                <div class="header-elements d-none">
                    <a href="{{route('setting.profile.user.edit',['userid' => Auth::user()->id])}}" class="btn btn-labeled bg-warning" ><span class="blink">ตั้งค่าโพรไฟล์ ก่อนขอรับการประเมิน</span></a>
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

    <!-- Content area -->
    <div class="content">
        <div id="alertmessage_wrapper">
            @foreach ($alertmessages->reverse() as $alertmessage)
                <div class="alert alert-info alert-styled-left alert-dismissible">
                    <button type="button" data-id ="{{$alertmessage->id}}" class="close alertmessage" data-dismiss="alert"><span>&times;</span></button>{!!$alertmessage->detail!!}
                </div>
            @endforeach
        </div>
        @if (@$businessplans->first()->business_plan_status_id > 2)
            @if (@$businessplans->first()->business_plan_status_id >= 9)
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card bg-teal-400">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h1 class="font-weight-semibold mb-0"><span id="showscore">{{ number_format(@$businessplans->first()->minitbp->fulltbp->projectgrade->percent, 2)}}</span> %</h1>
                                </div>
                                <div>
                                    ผลคะแนนการประเมิน
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div id="members-online"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card bg-blue-400">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h1 class="font-weight-semibold mb-0"><span id="showgrade">{{@$businessplans->first()->minitbp->fulltbp->projectgrade->grade}}</span></h1>
                                </div>
                                <div>
                                    ระดับเกรดการประเมิน
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
                                <h6 class="card-title" style="font-size:16px;font-weight: bold">เกรดแยกตาม Pillar</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2 c-20">
                                        <canvas id="myChart" width=200  height=200 ></canvas>
                                    </div>
                                    <div class="col-md-9 l-40 none">
                                      <div style="margin-top: 300px;"></div>
                                      <div id="mainchart" >
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
                                          <ul class="chart-skills4 l-30"> 
                                            <li>
                                                <span id="chartpillar1"></span>
                                            </li>
                                          </ul>
                                          {{-- <ul class="chart-skills4 l-30" style="margin-top:-344px" onload="play('rotate-four')"> 
                                            <li>
                                                <span id="chartpillar1"></span>
                                                <script>
                                                    var angle = 120;
                                                    var supportedFlag = $.keyframe.isSupported();
                                                    $('.chart-skills4').find('li:nth-child(1) span').css({'transform':`rotate(-${angle}deg)`});
                                                    $('.chart-skills4').find('span:nth-child(1)').text(`${(angle/1.8).toFixed(2)}%`);
                                                    $('.chart-skills4').find('li:nth-child(1)').css({'transform':`rotate(${angle}deg)`});
                                                    $(document).ready(function() {
                                                    $('.chart-skills4').find('li:nth-child(1)').css({'transform':`rotate(${angle}deg)`});
                                                    $.keyframe.define([{
                                                    name: 'rotate-four',
                                                    '100%': {
                                                        'transform': `rotate(${angle}deg)`,
                                                    }
                                                    }]);
                                                    });
                                                    $('.chart-skills4').find('li:nth-child(1)').playKeyframe({
                                                                name: 'rotate-four',
                                                                duration: "4s",
                                                                timingFunction: 'linear',
                                                                fillMode: 'forwards',
                                                            
                                                            });
                                                    
                                                </script>
                                            </li>
                                          </ul> --}}
                                      </div>
                                      <div>
                                        <img class="gauge1" src="{{asset('assets/dashboard/images/chart/gauge1.png')}}" alt="" srcset="">
                                    </div>
        
                                      {{-- <div class="text-min"> 
                                        min
                                      </div>
                                      <div class="text-max">
                                        max --}}
                                      {{-- </div> --}}
                                    </div>
                                    <div class="col-md-1 c-100">
                                          <table class="table-score table-7 table-bordered table-dark">
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
                                <div class="row l-50">
                                    <div class="col-md-3">
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
                                    <div class="col-md-3">
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
                                    <div class="col-md-3"> 
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
                                    <div class="col-md-3">  <div class="row">
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
                        {{-- <div class="card">
                            <div class="card-header header-elements-sm-inline">
                                <h6 class="card-title" style="font-size:16px;font-weight: bold">ร้อยละเกรดแยกตาม Pillar</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <canvas id="myChart" width=200  height=200 ></canvas>
                                    </div>
                                    <div class="col-md-9 l-40 none">
                                      <div style="margin-top: 300px;"></div>
                                      <div id="mainchart">
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

                                      </div>
        
                                    </div>
                                    <div class="col-md-1">
                                          <table class="table-score table-bordered table-dark">
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
                                    <div class="col-md-3">
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
                                    <div class="col-md-3">
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
                                    <div class="col-md-3"> 
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
                                    <div class="col-md-3">  <div class="row">
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
                        </div> --}}
                    </div>
                </div>
            @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">โครงการ</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                <span></span>
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
            
                        <div class="table-responsive">
                            <table class="table table-bordered" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th >ชื่อโครงการ</th> 
                                        <th >เลขที่โครงการ</th> 
                                        <th >ความก้าวหน้าการประเมิน</th>    
                                        <th style="width:1%;white-space: nowrap">สถานะ</th>                                                                  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($businessplans as $key => $businessplan)
                                    <tr>    
                                        <td> 
                                            @if ($businessplan->business_plan_status_id < 4)
                                                    <a class="text-info" href="{{route('dashboard.company.project.minitbp.edit',['id' => $businessplan->minitbp->id])}}" class="breadcrumb-item">{{$businessplan->minitbp->project}} </a>
                                                @elseif($businessplan->business_plan_status_id >= 4)
                                                    @if ($businessplan->minitbp->fulltbp->canceldate != null)
                                                            {{$businessplan->minitbp->project}} <span class="badge badge-flat border-danger text-danger-400 rounded-0">โครงการถูกยกเลิก</span>
                                                        @else
                                                            <a class="text-info" href="{{route('dashboard.company.project.fulltbp.edit',['id' => $businessplan->minitbp->fulltbp->id])}}" class="breadcrumb-item">{{$businessplan->minitbp->project}} </a>
                                                    @endif       
                                                @else
                                                    {{$businessplan->minitbp->project}} 
                                            @endif
                                        </td> 
                                        <td> {{$businessplan->code}} </td> 
                                        <td>
                                            <div class="progress" style="height: 1.375rem;">
                                                <div class="progress-bar bg-success" style="width: {{$businessplan->businessplanstatus->progress}}%">
                                                    {{-- <span class="sr-only"></span> --}}
                                                    <span style="font-size: 14px">{{$businessplan->businessplanstatus->progress}}%</span>
                                                </div>
                                            </div>
                                        </td> 
                                        <td style="white-space: nowrap"> 
                                            @if ($businessplan->business_plan_status_id > 3 && $businessplan->business_plan_status_id < 10)
                                                <span class="badge badge-flat border-warning text-warning-400 rounded-0">อยู่ระหว่างการประเมิน</span>
                                                @elseif($businessplan->business_plan_status_id >= 9)
                                                <span class="badge badge-flat border-success text-success-400 rounded-0">ประเมินเสร็จสิ้น</span>
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
        @endif
        <div class="row" 
        @if (@$businessplans->first()->business_plan_status_id >= 9)
            hidden
        @endif
        >
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">ความก้าวหน้าโครงการ</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="chart-container" >
                                    <div class="chart has-fixed-height" style="margin-top:-40px; " id="progress_chart"></div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">TimeLine</h6>
                        <div class="header-elements">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>วันที่</th> 
                                        <th>รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody id="timeline_wrapper_tr">
                                    @foreach ($timelinehistories as $timelinehistory)
                                        <tr>
                                            <td> {{$timelinehistory->createdatth}} </td>                            
                                            <td> {!!$timelinehistory->details!!} </td>  
                                        </tr>
                                    @endforeach
                                </tbody>  
                            </table>   
                        </div>
                        <div class="float-right mt-2">
                            {{$timelinehistories->links()}} 
                        </div>
                         
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

            <!-- /striped rows -->
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

<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
<script>
    var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content'),
        branchid: "{{Auth::user()->branch_id}}"
    };
    
    var bpstatus = "{{@$businessplans[0]->business_plan_status_id}}";
    var _bpstatus = "";
    if(bpstatus >= 3){
        _bpstatus = 'อยู่ระหว่างการประเมิน';
    }

    var dom = document.getElementById("progress_chart");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    var check = "{{@$businessplans[0]->businessplanstatus->progress}}";
    var datavalue = '0';
    if(check.length!=0){
        datavalue = check
    }

    option = {
        textStyle: {
                    fontFamily: 'Kanit',
                },
                
         series: [
             {
                 type: "gauge",
                 center: ["50%", "50%"], 
                 radius: "100%", 
                 startAngle: 200, 
                 endAngle: -20, 
                 axisLine: {
                     show: false,
                     lineStyle: { 
                         color: [
                             [ 0.5,  new echarts.graphic.LinearGradient(0, 0, 1, 0, [{
                                 offset: 1,
                                 color: "#E75F25" // 50% 
                             }, {
                                 offset: 0.8,
                                 color: "#D9452C" // 40% 
                             }], false) ], // 100% 
                              [ 0.7,  new echarts.graphic.LinearGradient(0, 0, 1, 0, [{
                                 offset: 1,
                                 color: "#FFC539" // 70% 
                             }, {
                                 offset: 0.8,
                                 color: "#FE951E" // 66% 
                             }, {
                                 offset: 0,
                                 color: "#E75F25" // 50% 
                             }], false) ],
                              [ 0.9,  new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                 offset: 1,
                                 color: "#C7DD6B" // 90% 
                             }, {
                                 offset: 0.8,
                                 color: "#FEEC49" // 86% 
                             }, {
                                 offset: 0,
                                 color: "#FFC539" // 70% 
                             }], false) ],
                             [1,  new echarts.graphic.LinearGradient(0, 0, 0, 1, [ {
                                 offset: 0.2,
                                 color: "#1CAD52" // 92% 
                             }, {
                                 offset: 0,
                                 color: "#C7DD6B" // 90% 
                             }], false) ]
                         ],
                         width: 10
                     }
                 },

                 splitLine: {
                     show: false
                 },
                 axisTick: {
                     show: false
                 },
                 axisLabel: {
                     show: false
                 },
                 pointer : { 
                     length: '45%'
                 },
                 detail: {
                     show: false
                 }
             },
             {
                 type : "gauge",
                 center: ["50%", "60%"], 
                 radius : "100%",
                 startAngle: 200,
                 endAngle: -20,
                 axisLine : {
                     show : true,
                     lineStyle : { 
                         color : [ 
                             [ 0.3, "#DA462C" ],//0-50%
                             [ 0.7, "#FF9618" ],//51%-70%
                             [ 0.9, "#FFED44" ],//70%-90%
                             [ 1,"#20AE51" ]//90%-100%
                         ],
                         width : 30
                     }
                 },
                 splitLine : { 
                     length : 30,
                     lineStyle : { 
                         width : 2
                     }
                 },
                 axisTick : { 
                      length : 20
                 },
                 axisLabel : { 
                     color : "black",
                     distance : 5 
                 },
                 detail: {
                     formatter : "{score|{value}%}",
                     offsetCenter: [0, "40%"],
                    //  backgroundColor: '#FFEC45',
                     height:30,
                     rich : {
                         score : {
                            //  color : "white",
                             fontFamily : "Kanit",
                             fontSize : 32
                         }
                     }
                 },
                data: [
                    {
                        value: datavalue, 
                        name: _bpstatus
                    }
                ]
             }
         ]
     };

    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }

    $( document ).ready(function() {
        if(bpstatus < 9){
            var events = [];
            getEvent().then(data => {
                data.forEach(function (event,index) {
                    events.push({
                        title: event["summary"],
                        start: event["start"]
                    });
                });
               
                var calendarBasicViewElement = document.querySelector('.fullcalendar');
                if(calendarBasicViewElement) {
                    var calendarBasicViewInit = new FullCalendar.Calendar(calendarBasicViewElement, {
                        locale: 'th',
                        plugins: ["dayGrid", "timeGrid", "list", "interaction", "googleCalendar"],
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,dayGridDay'
                        },
                        buttonText: {
                            today:    'วันนี้',
                            month:    'เดือน',
                            week:     'สัปดาห์',
                            day:      'วัน',
                            list:     'รายการ'
                        },
                        events: events,
                        editable: true,
                        eventLimit: true
                    }).render();
                }
            }).catch(error => {})
        }else{
            getFinalGrage().then(data => {
                topLeftChart($('#showscore').html(),$('#showgrade').html());
                var html1 =``;
                var html2 =``;
                var pillarpercent4 = 0;
                var pillarpercent3 = 0;
                var pillarpercent2 = 0;
                var pillarpercent1 = 0;
                data.forEach((grade,index) => {
                    $('#chartpillar' + (index+1)).html(grade.percent + ' %');
                    $('#pillar' + (index+1)).html(grade.percent + ' %');
                    $('#gradepillar' + (index+1)).html(grade.grade);
                    //console.log(index);
            
                    if(index == 0){
                        pillarpercent4 = grade.percent;
                    }else if(index == 1){
                        pillarpercent3 = grade.percent;
                    }else if(index == 2){
                        pillarpercent2 = grade.percent;
                    }else if(index == 3){
                        pillarpercent1 = grade.percent;
                    }
                    if(index < 4){
                        var basepillar = ``;
                        if(grade.pillar_id == 1){
                            basepillar = `Management`;
                        }
                        if(grade.pillar_id == 2){
                            basepillar = `Technology`;
                        }
                        if(grade.pillar_id == 3){
                            basepillar = `Marketability`;
                        }
                        if(grade.pillar_id == 4){
                            basepillar = `Business Prospet`;
                        }
                        html1 += `<tr>
                        <td>${basepillar}</td>
                        <td style="text-align: center;">${parseFloat(grade.percent).toFixed(2)}</td>
                        <td style="text-align: center;">${grade.grade}</td>
                        <tr>`
                    }else{
                        var basepillar = ``;
                        if(grade.pillar_id == 5){
                            basepillar = `Management`;
                        }
                        if(grade.pillar_id == 6){
                            basepillar = `เทคโนโลยี`;
                        }
                        if(grade.pillar_id == 7){
                            basepillar = `การตลาด`;
                        }
                        if(grade.pillar_id == 8){
                            basepillar = `ธุรกิจ`;
                        }
                        html2 += `<tr>
                        <td>${basepillar}</td>
                        <td style="text-align: center;">${parseFloat(grade.percent).toFixed(2)}</td>
                        <td style="text-align: center;" >${grade.grade}</td>
                        <tr>`
                    }

                });  
                // var angle = grade.percent*1.8;
                $('.chart-skills4').find('span:nth-child(1)').text(`${pillarpercent4}%`);
                $('.chart-skills4').find('li:nth-child(1)').css('transform', `rotate(${pillarpercent4*1.8}deg)`);
                $('.chart-skills4').find('span:nth-child(1)').css('transform', `rotate(${(-1.8)*pillarpercent4}deg)`);
                if(pillarpercent4 == 100){
                    $('.chart-skills4').find('span:nth-child(1)').css('top', `20px`);
                }

                $('.chart-skills3').find('span:nth-child(1)').text(`${pillarpercent3}%`);
                $('.chart-skills3').find('li:nth-child(1)').css('transform', `rotate(${pillarpercent3*1.8}deg)`);
                $('.chart-skills3').find('span:nth-child(1)').css('transform', `rotate(${(-1.8)*pillarpercent3}deg)`);
                if(pillarpercent3 == 100){
                    $('.chart-skills3').find('span:nth-child(1)').css('top', `20px`);
                }

                $('.chart-skills2').find('span:nth-child(1)').text(`${pillarpercent2}%`);
                $('.chart-skills2').find('li:nth-child(1)').css('transform', `rotate(${pillarpercent2*1.8}deg)`);
                $('.chart-skills2').find('span:nth-child(1)').css('transform', `rotate(${(-1.8)*pillarpercent2}deg)`);
                if(pillarpercent2 == 100){
                    $('.chart-skills2').find('span:nth-child(1)').css('top', `20px`);
                }

                $('.chart-skills').find('span:nth-child(1)').text(`${pillarpercent1}%`);
                $('.chart-skills').find('li:nth-child(1)').css('transform', `rotate(${pillarpercent1*1.8}deg)`);
                $('.chart-skills').find('span:nth-child(1)').css('transform', `rotate(${(-1.8)*pillarpercent1}deg)`);
                if(pillarpercent1 == 100){
                    $('.chart-skills1').find('span:nth-child(1)').css('top', `20px`);
                }

                $("#chartarea").attr("hidden",false);
                $("#gradesummary_wrapper_tr").html(html1); 
                $("#extra_gradesummary_wrapper_tr").html(html2); 

            }).catch(error => {})
        }    

        
        });

    $(document).on('click', '#alertmessage', function(e) {
        editTimeLineStatus($(this).data('id')).then(data => {
            data.forEach(function (timeline,index) {
                var doctype = '';
                if(timeline.message_type == 1){
                    doctype ='เอกสาร Mini TBP';
                }else if(timeline.message_type == 2){
                    doctype ='เอกสาร Mini TBP';
                }
                html += `<tr >                                        
                    <td> ${timeline.createdatth} </td>                            
                    <td> ${timeline.details} </td> 
                </tr>`
                });
            $("#timeline_wrapper_tr").html(html);
            $("#infostatus").html(infostatus);

        }).catch(error => {})
    });

    function getEvent() {
        return new Promise((resolve, reject) => {
            $.ajax({
                    url: `${route.url}/dashboard/company/report/getevent`,
                    type: 'POST',
                    headers: {"X-CSRF-TOKEN":route.token},
                    success: function(data) {
                    resolve(data)
                },
                    error: function(error) {
                    reject(error)
                },
            })
        })
    }

    function getFinalGrage() {
        return new Promise((resolve, reject) => {
            $.ajax({
                    url: `${route.url}/dashboard/company/report/getfinalgrade`,
                    type: 'POST',
                    headers: {"X-CSRF-TOKEN":route.token},
                    success: function(data) {
                    resolve(data)
                },
                    error: function(error) {
                    reject(error)
                },
            })
        })
    }

    
    function getTimeLine(userid){
        return new Promise((resolve, reject) => {
            $.ajax({
            url: `${route.url}/dashboard/company/report/gettimeline`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
                'userid': userid
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

    function editTimeLineStatus(id){
        return new Promise((resolve, reject) => {
            $.ajax({
                url: `${route.url}/dashboard/company/report/edittimelinestatus`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
                'id': id
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

    function topLeftChart(_percent,grade){
        if(isNaN(_percent)) {
            _percent = 0;
        }
        if( typeof grade === 'undefined' ) {
            grade = "";
        }
        var percent = parseInt(_percent);
        console.log(percent);
        var dom = document.getElementById('myChart');
        var echart = echarts.init(dom);
        echart.clear();
        var option = null;
        option = {
            series: [
                {
                    name: 'เกรด',
                    type: 'pie',
                    hoverAnimation: false,
                    animation: true,
                    radius: ['80%', '100%'],
                    avoidLabelOverlap: false,
                    label: {
                        show: true,
                        position: 'center',
                        fontSize : 26,
                        color: '#000000'
                    },
                    emphasis: {
                        label: {
                            show: true,
                            // fontSize: '16',
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: [
                        {value: 100-percent, name: '',},
                        {value: percent, name:   _percent + ' / ' + grade},
        
                    ],
                    color: ['#bbbbbb', '#4688ce'],
                    silent: true,
                }
            ]
        };

        if (option && typeof option === "object") {
            echart.setOption(option, true);
        }
}


</script>
@stop
