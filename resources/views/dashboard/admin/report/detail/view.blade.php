@inject('getpercent', 'App\Helper\GetEvPercent')
@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">รายละเอียดโครงการ: {{$minitbp->project}} (<a  href="{{route('dashboard.admin.search.company.profile',['id' => $businessplan->company->id])}}" class="text-info" target="_blank">{{$fullcompanyname}}</a>)</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> แดชบอร์ด</a>
                    <span class="breadcrumb-item active">{{$minitbp->project}}</span>
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
        @php
            $hidden = "";
            $check = Auth::user()->experttype;
            if($check == "(ภายนอก)"){
                $hidden = "hidden";
            }
           
        @endphp
        <div class="row">
            <div class="col-md-12" {{$hidden}}>
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">รายงานสถานะ</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="bg-info">
                                        <th style="text-align: center">รายการ</th> 
                                        <th style="text-align: center">วันที่กำหนด</th>
                                        <th style="text-align: center">วันที่ Action</th>
                                        <th style="text-align: center">ภาพรวม</th>
                                        <th style="text-align: center">สถานภาพ</th> 
                                    </tr>
                                </thead>
                                <tbody >
                                    {{-- @php
                                        $sum = 0;
                                    @endphp --}}
                                    @foreach ($projectstatuses as $projectstatus)
                                    
                                        {{-- @php
                                            if(!Empty($projectstatus->projectdatediff)){
                                                $sum += intVal($projectstatus->projectdatediff);
                                            }
                                        @endphp --}}
                                        <tr>
                                            <td>{{$projectstatus->projectflow}}</td>
                                            <td style="text-align: center">{{$projectstatus->startdateth}} - {{$projectstatus->enddateth}}</td>
                                            <td style="text-align: center">{{$projectstatus->actualdateth}}</td>
                                            <td style="text-align:center">
                                                {{-- @if ()
                                                    
                                                @endif --}}
                                                {{$projectstatus->projectdatediff}}
                                            </td>
                                            <td>
                                               {!!$projectstatus->projectstatustransaction($projectstatus->project_flow_id,$minitbp->id)!!}
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                    {{-- <td colspan="3">
                                        รวม
                                    </td> --}}
                                    {{-- <td style="text-align:center;border-right: 0px solid !important">
                                        @if ($sum > 0)
                                           +{{$sum}}
                                            @else
                                            {{$sum}}
                                        @endif
                                       
                                    </td> --}}
                                </tbody>
                            </table>      
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12" {{$hidden}}>
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">TimeLine ของโครงการ</h6>
                        <div class="header-elements">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="bg-info">
                                        <th style="text-align: center">วันที่</th> 
                                        <th style="text-align: center">รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody id="timeline_wrapper_tr">
                                    @foreach ($timelinehistories as $timelinehistory)
                                        <tr>
                                            <td style="text-align: center"> {{$timelinehistory->createdatth}} </td>                            
                                            <td> {{html_entity_decode(strip_tags($timelinehistory->details))}} </td>  
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
            @if ($businessplan->business_plan_status_id >=3)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h6 class="card-title" style="font-size:16px;font-weight: bold">เอกสารของโครงการ</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="bg-info">
                                        <th style="width:150px;text-align: center">Mini TBP</th> 
                                        <th style="text-align: center" >วันที่ส่งเอกสาร</th>
                                        {{-- <th style="width:1%">เอกสารแนบ</th>  --}}
                                        <th style="width:1%;white-space: nowrap">PDF</th>
                                       
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr>
                                        <td>
                                            @if (Auth::user()->user_type_id == 3)
                                                   @if (Auth::user()->experttype == "(ภายนอก)")
                                                            Mini TBP
                                                       @else
                                                            <a href="{{route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id])}}" class="text-info" target="_blank">Mini TBP</a>
                                                   @endif
                                                @else
                                                    <a href="{{route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id])}}" class="text-info" target="_blank">Mini TBP</a>
                                            @endif
                                            
                                        </td> 
                                        <td >{{$minitbp->submitdateth}}</td> 
                                       
                                        <td style="white-space: nowrap"> 
                                            <a href="{{asset($minitbp->attachment)}}" data-docname="PDF Mini TBP-{{$minitbp->project}}" class="btn btn-sm bg-info downloadlink" target="_blank" >ดาวน์โหลด PDF</a>
                                        </td>  
                                                                            
                                    </tr>
                                </tbody>
                            </table>
                            <div class="table-responsive mt-4">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="bg-info">
                                            <th style="width:150px;text-align: center">Full TBP</th> 
                                            <th style="width:1%; white-space: nowrap;text-align: center">วันที่ส่งเอกสาร</th>
                                            <th style="text-align: center">รายละเอียดการแก้ไข</th>
                                            <th style="width:1%; white-space: nowrap;text-align: center">PDF</th>
                                            <th style="width:1% ;white-space: nowrap;text-align: center">เอกสารแนบ</th> 
                                          
                                           
                                        </tr>
                                    </thead>
                                    <tbody >
                                     
                                        @if ($businessplan->business_plan_status_id >=5)
                                            @foreach ($fulltbphistories as $key => $fulltbphistory)
                                                <tr>
                                                    @if ($key == 0)
                                                    <td rowspan="{{$fulltbphistories->count()}}">
                                                        @if (Auth::user()->user_type_id == 3)
                                                            @if (Auth::user()->experttype == "(ภายนอก)")
                                                                Full TBP
                                                            @else
                                                                <a href="{{route('dashboard.admin.project.fulltbp.view',['id' => $fulltbphistory->fulltbp->id])}}" class="text-info" target="_blank">Full TBP</a>
                                                            @endif
                                                        @else
                                                            <a href="{{route('dashboard.admin.project.fulltbp.view',['id' => $fulltbphistory->fulltbp->id])}}" class="text-info" target="_blank">Full TBP</a>
                                                        @endif
                                                        
                                                    </td> 
                                                    @endif
 
                                                    <td style="text-align: center">{{$fulltbphistory->submitdateth}}</td> 
                                                    <td>{{$fulltbphistory->message}}</td> 

                                                    <td style="white-space: nowrap"> 
                                                        @if (Auth::user()->user_type_id == 3)
                                                            @if (Auth::user()->experttype == "(ภายนอก)")
                                                                <a href="{{asset($fulltbphistory->fulltbp->shortpdf)}}" class="btn btn-sm bg-info downloadlink" data-docname="PDF Full TBP-{{$fulltbphistory->fulltbp->shortpdf}}" target="_blank ">ดาวน์โหลด PDF</a>
                                                            @else
                                                                <a href="{{asset($fulltbphistory->path)}}" class="btn btn-sm bg-info downloadlink" data-docname="PDF Full TBP-{{$fulltbphistory->path}}" target="_blank ">ดาวน์โหลด PDF</a>
                                                            @endif
                                                        @else
                                                            <a href="{{asset($fulltbphistory->path)}}" class="btn btn-sm bg-info downloadlink" data-docname="PDF Full TBP-{{$fulltbphistory->path}}" target="_blank ">ดาวน์โหลด PDF</a>
                                                        @endif
                                                        
                                                    </td>  
                                                    @if ($key == 0)
                                                    <td rowspan="{{$fulltbphistories->count()}}" style="white-space: nowrap">
                                                        <a  href="{{route('dashboard.admin.project.fulltbp.downloadzip',['id' => $fulltbphistory->fulltbp->id])}}" data-docname="เอกสารแนบ Full TBP-{{$fulltbphistory->project}}" class="btn btn-sm bg-teal downloadlink" >ดาวน์โหลดเอกสารแนบ</a>
                                                    </td>  
                                                    @endif
                                                </tr> 
                                            @endforeach

                                        @endif 
                                    </tbody>
                                </table>      
                            </div>
                        </div>
                    </div>
                </div>
                @if (!Empty($projectassignment))
                    <div class="col-md-12" {{$hidden}}>
                        <div class="card">
                            <div class="card-header header-elements-sm-inline">
                                <h6 class="card-title" style="font-size:16px;font-weight: bold">Leader และ Co-Leader ของโครงการ</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="bg-info">
                                                <th style="width:600px;text-align: center">ตำแหน่งรับผิดชอบ</th> 
                                                <th style="text-align: center">ชื่อ-นามสกุล</th> 
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <td>Leader</td>  
                                                <td>
                                                    @if (!Empty($projectassignment->leader_id))
                                                    {{$projectassignment->leader->name}} {{$projectassignment->leader->lastname}}
                                                    @else
                                                    
                                                    <span class="badge badge-flat border-grey text-grey-600">ยังไม่ได้มอบหมาย</span>
                                                    @endif
                                                   
                                                </td>                                     
                                            </tr>  
                                            <tr>
                                                <td>Co-Leader</td>  
                                                <td>
                                                    @if (!Empty($projectassignment->coleader_id))
                                                        {{$projectassignment->coleader->name}} {{$projectassignment->coleader->lastname}}
                                                        @else
                                                        
                                                        <span class="badge badge-flat border-grey text-grey-600">ยังไม่ได้มอบหมาย</span>
                                                    @endif                                                   
                                                </td>                                   
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (!Empty($projectassignment))
                    @if (@$businessplan->business_plan_status_id >= 5)
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header header-elements-sm-inline">
                                    <h6 class="card-title" style="font-size:16px;font-weight: bold">รายการ EV</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr class="bg-info">
                                                    <th style="width:600px;text-align: center">ชื่อ EV</th> 
                                                    <th style="text-align: center">เวอร์ชั่น</th> 
                                                    <th style="width:1%;text-align: center">เพิ่มเติม</th> 
                                                </tr>
                                            </thead>
                                            <tbody >
                                                <tr>
                                                    <td>{{@$fulltbp->ev->name}}</td>  
                                                    <td>
                                                    
                                                        {{@$fulltbp->ev->version}}
                                                    </td>    
                                                    <td style="white-space: nowrap">
                                                        @if (@$fulltbp->ev->status >= 4)
                                                        <a href="{{route('dashboard.admin.project.fulltbp.editev',['id' => @$fulltbp->ev->id])}}" class="btn btn-sm bg-info" target="_blank">รายละเอียด</a>
                                                        @else
                                                        
                                                        <span class="badge badge-flat border-pink text-pink-600">อยู่ระหว่างการดำเนินการ</span>
                                                        @endif
                                                        
                                                    
                                                    </td>                                   
                                                </tr>  
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" {{$hidden}}>
                            <div class="card">
                                <div class="card-header header-elements-sm-inline">
                                    <h6 class="card-title" style="font-size:16px;font-weight: bold">รายการเอกสาร BOL
                                    
                                    @if ($bols->count() == 0)
                                    <span class="text-pink-600"> (ยังไม่ได้อัปโหลด)</span>
                                    @endif
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr class="bg-info">
                                                    <th style="text-align: center">ชื่อเอกสาร</th> 
                                                    <th style="width:1%;white-space: nowrap;text-align: center">เพิ่มเติม</th> 
                                                </tr>
                                            </thead>
                                            <tbody >
                                                @foreach ($bols as $bol)
                                                <tr>
                                                    <td>{{@$bol->name}}</td>     
                                                    <td style="white-space: nowrap">
                                                        <a href="{{asset($bol->path)}}" class="btn btn-sm bg-primary" target="_blank">ดาวน์โหลด</a>
                                                    </td>                                   
                                                </tr>    
                                                @endforeach
 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endif
            @if ($businessplan->business_plan_status_id >=8)
                <div class="col-md-12" {{$hidden}}>
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h6 class="card-title" style="font-size:16px;font-weight: bold">รายการผู้เชี่ยวชาญ</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="bg-info">
                                            <th style="width:600px;text-align: center">ชื่อ-นามสกุล</th> 
                                            <th style="text-align: center">ความแม่นยำ</th> 
                                            <th style="width:1%;white-space: nowrap;text-align: center">การลงคะแนน</th> 
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach ($projectmembers as $projectmember)
                                        @if (Auth::user()->user_type_id >= 5)
                                        <tr>
                                            <td>{{$projectmember->user->name}} {{$projectmember->user->lastname}}</td>  
                                            <td style="text-align:center">{{number_format($getpercent::getEvPercent($projectmember->user_id,$projectmember->fulltbp->id), 2, '.', '')}} %</td>
                                            <td  style="white-space: nowrap">
                                                <a href="{{route('dashboard.admin.project.assessment.edit',['id' => $projectmember->fulltbp->id, 'userid' => $projectmember->user->id])}}" class="btn btn-sm bg-info" target="_blank">การลงคะแนน</a>
                                            </td>                                       
                                        </tr> 
                                        @else
                                        @if (Auth::user()->id == $projectmember->user->id)
                                        <tr>
                                            <td>{{$projectmember->user->name}} {{$projectmember->user->lastname}}</td>  
                                            <td style="text-align:center">{{number_format($getpercent::getEvPercent($projectmember->user_id,$projectmember->fulltbp->id), 2, '.', '')}} %</td>
                                            <td  style="white-space: nowrap">
                                                <a href="{{route('dashboard.admin.project.assessment.edit',['id' => $projectmember->fulltbp->id, 'userid' => $projectmember->user->id])}}" class="btn btn-sm bg-info" target="_blank">การลงคะแนน</a>
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
            @endif
            {{-- @if ($businessplan->business_plan_status_id >=9) --}}
            @if (Auth::user()->user_type_id >= 5 || Auth::user()->isLeader() != 0)
            <div class="col-md-12" {{$hidden}}>
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">คะแนน/เกรด</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="min-height: 150px">
                            <table class="table table-bordered table-striped"  >
                                <thead>
                                    <tr class="bg-info">
                                        <th style="text-align: center">คะแนน</th> 
                                        <th style="text-align: center">เกรด</th>
                                        <th style="text-align: center">จดหมายแจ้งผล</th>
                                        <th style="text-align: center">Certificate</th>
                                        <th style="width:1%;white-space: nowrap;text-align: center">รายงานผล</th> 
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr>
                                        <td>
                                            @if ($businessplan->business_plan_status_id >= 8)
                                            {{number_format(@$fulltbp->projectgrade->percent, 2, '.', '')}}
                                            @else
                                            <span class="badge badge-flat border-pink text-pink-600">อยู่ระหว่างการดำเนินการ</span>
                                            @endif
                                        </td>  
                                        <td>
                                            @if ($businessplan->business_plan_status_id >= 8)
                                            {{@$fulltbp->projectgrade->grade}}
                                            @else
                                            <span class="badge badge-flat border-pink text-pink-600">อยู่ระหว่างการดำเนินการ</span>
                                            @endif
                                        </td>
                                        
                                        <td> 
                                            {{-- @if (@$fulltbp->isevaluationresultready == 1) --}}
                                            @if (@$fulltbp->projectstatustransaction(7)->status == 2)
                                            {{-- $fulltbp->projectstatustransaction(7)->status != 2 --}}
                                            {{-- @if ($businessplan->business_plan_status_id >=9) --}}
                                                    {{-- <a href="{{route('dashboard.admin.evaluationresult.pdf',['id' => @$fulltbp->evaluationresult->id])}}" class="btn btn-sm bg-primary">จดหมายแจ้งผล</a> --}}
                                                    <button type="button" class="btn btn-sm bg-info dropdown-toggle" data-toggle="dropdown">จดหมายแจ้งผล</button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="{{route('dashboard.admin.evaluationresult.pdf',['id' => @$fulltbp->evaluationresult->id])}}" class="dropdown-item" target="_blank"><i class="icon-download"></i> ไฟล์ PDF</a>
                                                        <a href="{{route('dashboard.admin.evaluationresult.word',['id' => @$fulltbp->evaluationresult->id])}}" class="dropdown-item" target="_blank"><i class="icon-download"></i> ไฟล์ WORD</a>
                                                        {{-- <a href="{{route('dashboard.admin.evaluationresult.certificate',['id' => $fulltbp->evaluationresult->id, 'type' => '2'])}}" class="dropdown-item" target="_blank"><i class="icon-download"></i> ดาวน์โหลด PDF</a> --}}
                                                      
                                                    </div>
                                                @else
                                                    <span class="badge badge-flat border-pink text-pink-600">อยู่ระหว่างการดำเนินการ</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($businessplan->business_plan_status_id >=9)
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm bg-success dropdown-toggle" data-toggle="dropdown">Certificate</button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="{{route('dashboard.admin.evaluationresult.certificate',['id' => @$fulltbp->evaluationresult->id, 'type' => '1'])}}" class="dropdown-item" target="_blank"><i class="icon-file-eye"></i> ตัวอย่างการแสดงผล</a>
                                                        <a href="{{route('dashboard.admin.evaluationresult.certificate',['id' => @$fulltbp->evaluationresult->id, 'type' => '2'])}}" class="dropdown-item" target="_blank"><i class="icon-download"></i> ดาวน์โหลด PDF</a>
                                                        <a href="{{route('dashboard.admin.evaluationresult.ppt',['id' => @$fulltbp->evaluationresult->id, 'type' => '2'])}}" class="dropdown-item" target="_blank"><i class="icon-download"></i> ดาวน์โหลด PPT</a>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="badge badge-flat border-pink text-pink-600">อยู่ระหว่างการดำเนินการ</span>
                                            @endif

                                        </td>
                                        <td  style="white-space: nowrap">
                                            @if ($businessplan->business_plan_status_id >= 8)
                                            <a  href="{{route('dashboard.admin.assessment.summary',['id' => $fulltbp->id])}}" class="btn btn-sm bg-info" target="_blank">ผลคะแนน</a>
                                            @else
                                            <span class="badge badge-flat border-pink text-pink-600">อยู่ระหว่างการดำเนินการ</span>
                                            @endif
                                            
                                        </td>                                     
                                    </tr>  
                                </tbody>
                            </table>      
                        </div>
                    </div>
                </div>
            </div>
            @endif
              
            <div class="col-md-12" {{$hidden}}>
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">Log ของโครงการ (เจ้าหน้าที่)</h6>
                        <div class="header-elements">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead >
                                    <tr class="bg-info">
                                        <th style="text-align: center">วันที่</th> 
                                        <th style="width:70%;text-align: center">รายละเอียด</th>
                                        <th style="text-align: center">โดย</th> 
                                    </tr>
                                </thead>
                                <tbody id="timeline_wrapper_tr">
                                    @foreach ($projectlogs as $projectlog)
                                        <tr>
                                            <td style="text-align: center"> {{$projectlog->createdatth}} </td>                            
                                            <td> {{html_entity_decode(strip_tags($projectlog->action))}} </td>  
                                            <td> คุณ{{$projectlog->user->name}} {{$projectlog->user->lastname}}</td>  
                                        </tr>
                                    @endforeach
                                </tbody>  
                            </table>   
                        </div>
                        <div class="float-right mt-2">
                            {{$projectlogs->links()}} 
                        </div>
                    </div>
                </div>
            </div>
            {{-- @endif --}}
        </div>
    </div>
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/js/app/helper/downloadstat.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content')
        };

    </script>
@stop