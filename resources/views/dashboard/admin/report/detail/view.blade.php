@inject('getpercent', 'App\Helper\GetEvPercent')
@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">{{$company->businessplan->minitbp->project}}</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> แดชบอร์ด</a>
                    <span class="breadcrumb-item active">{{$company->businessplan->minitbp->project}}</span>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">รายงานสถานะ</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th >รายการ</th> 
                                        <th >วันที่กำหนด</th>
                                        <th>สถานะ</th> 
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($projectstatuses as $projectstatus)
                                        <tr>
                                            <td>{{$projectstatus->projectflow}}</td>
                                            <td>{{$projectstatus->startdateth}} - {{$projectstatus->enddateth}}</td>
                                            <td>
                                               {!!$projectstatus->projectstatustransaction($projectstatus->project_flow_id,$company->businessplan->minitbp->id)!!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>      
                        </div>
                    </div>
                </div>
            </div>
            @if ($company->businessplan->business_plan_status_id >=3)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h6 class="card-title" style="font-size:16px;font-weight: bold">เอกสารของโครงการ</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="bg-info">
                                            <th style="width:300px">Mini TBP/Full TBP</th> 
                                            <th >วันที่ส่งเอกสาร</th>
                                            <th >PDF</th>
                                            <th style="width:200px">เอกสารแนบ</th> 
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <tr>
                                            <td>
                                                @if (Auth::user()->user_type_id == 3)
                                                       @if (Auth::user()->experttype == "(ภายนอก)")
                                                                Mini TBP
                                                           @else
                                                                <a href="{{route('dashboard.admin.project.minitbp.view',['id' => $company->businessplan->minitbp->id])}}" class="text-info" target="_blank">Mini TBP</a>
                                                       @endif
                                                    @else
                                                        <a href="{{route('dashboard.admin.project.minitbp.view',['id' => $company->businessplan->minitbp->id])}}" class="text-info" target="_blank">Mini TBP</a>
                                                @endif
                                                
                                            </td> 
                                            <td>{{$company->businessplan->minitbp->submitdateth}}</td> 
                                            <td> 
                                                <a href="{{asset($company->businessplan->minitbp->attachment)}}" data-docname="PDF Mini TBP-{{$company->businessplan->minitbp->project}}" class="btn btn-sm bg-info downloadlink" target="_blank" >ดาวน์โหลด PDF</a>
                                            </td>  
                                            <td>
                                                
                                            </td>                                       
                                        </tr> 
                                        @if ($company->businessplan->business_plan_status_id >=5)
                                            <tr>
                                                <td>
                                                    @if (Auth::user()->user_type_id == 3)
                                                        @if (Auth::user()->experttype == "(ภายนอก)")
                                                            Full TBP
                                                        @else
                                                            <a href="{{route('dashboard.admin.project.fulltbp.view',['id' => $company->businessplan->minitbp->fulltbp->id])}}" class="text-info" target="_blank">Full TBP</a>
                                                        @endif
                                                    @else
                                                        <a href="{{route('dashboard.admin.project.fulltbp.view',['id' => $company->businessplan->minitbp->fulltbp->id])}}" class="text-info" target="_blank">Full TBP</a>
                                                    @endif
                                                    
                                                </td>  
                                                <td>{{$company->businessplan->minitbp->fulltbp->submitdateth}}</td> 
                                                <td> 
                                                    @if (Auth::user()->user_type_id == 3)
                                                        @if (Auth::user()->experttype == "(ภายนอก)")
                                                            <a href="{{asset($company->businessplan->minitbp->fulltbp->shortpdf)}}" class="btn btn-sm bg-info downloadlink" data-docname="PDF Full TBP-{{$company->businessplan->minitbp->project}}" target="_blank ">ดาวน์โหลด PDF</a>
                                                        @else
                                                            <a href="{{asset($company->businessplan->minitbp->fulltbp->attachment)}}" class="btn btn-sm bg-info downloadlink" data-docname="PDF Full TBP-{{$company->businessplan->minitbp->project}}" target="_blank ">ดาวน์โหลด PDF</a>
                                                        @endif
                                                    @else
                                                        <a href="{{asset($company->businessplan->minitbp->fulltbp->attachment)}}" class="btn btn-sm bg-info downloadlink" data-docname="PDF Full TBP-{{$company->businessplan->minitbp->project}}" target="_blank ">ดาวน์โหลด PDF</a>
                                                    @endif
                                                    
                                                </td>  
                                                <td>
                                                    <a  href="{{route('dashboard.admin.project.fulltbp.downloadzip',['id' => $company->businessplan->minitbp->fulltbp->id])}}" data-docname="เอกสารแนบ Full TBP-{{$company->businessplan->minitbp->project}}" class="btn btn-sm bg-teal downloadlink" >ดาวน์โหลดเอกสารแนบ</a>
                                                </td>                                       
                                            </tr> 
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
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="bg-info">
                                                <th style="width:600px">ตำแหน่งรับผิดชอบ</th> 
                                                <th>ชื่อ-นามสกุล</th> 
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
                    @if (@$company->businessplan->business_plan_status_id >= 5)
                        <div class="col-md-12" {{$hidden}}>
                            <div class="card">
                                <div class="card-header header-elements-sm-inline">
                                    <h6 class="card-title" style="font-size:16px;font-weight: bold">รายการ EV</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="bg-info">
                                                    <th style="width:600px">ชื่อ EV</th> 
                                                    <th>เวอร์ชั่น</th> 
                                                    <th>เพิ่มเติม</th> 
                                                </tr>
                                            </thead>
                                            <tbody >
                                                <tr>
                                                    <td>{{@$company->businessplan->minitbp->fulltbp->ev->name}}</td>  
                                                    <td>
                                                    
                                                        {{@$company->businessplan->minitbp->fulltbp->ev->version}}
                                                    </td>    
                                                    <td>
                                                        @if (@$company->businessplan->minitbp->fulltbp->ev->status >= 4)
                                                        <a href="{{route('dashboard.admin.project.fulltbp.editev',['id' => @$company->businessplan->minitbp->fulltbp->ev->id])}}" class="btn btn-sm bg-info" target="_blank">รายละเอียด</a>
                                                        @else
                                                        
                                                        <span class="badge badge-flat border-pink text-pink-600">กำลังดำเนินการ</span>
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
                @endif
            @endif
            @if ($company->businessplan->business_plan_status_id >=8)
                <div class="col-md-12" {{$hidden}}>
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h6 class="card-title" style="font-size:16px;font-weight: bold">รายการผู้เชี่ยวชาญ</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr >
                                            <th style="width:600px">ชื่อ-นามสกุล</th> 
                                            <th>ความแม่นยำ</th> 
                                            <th>การลงคะแนน</th> 
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach ($projectmembers as $projectmember)
                                        <tr>
                                            <td>{{$projectmember->user->name}} {{$projectmember->user->lastname}}</td>  
                                            <td>{{number_format($getpercent::getEvPercent($projectmember->user_id,$projectmember->fulltbp->id), 2, '.', '')}} %</td>
                                            <td>
                                                <a href="{{route('dashboard.admin.project.assessment.edit',['id' => $projectmember->fulltbp->id, 'userid' => $projectmember->user->id])}}" class="btn btn-sm bg-info" target="_blank">การลงคะแนน</a>
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
            @if ($company->businessplan->business_plan_status_id >=9)
                <div class="col-md-12" {{$hidden}}>
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h6 class="card-title" style="font-size:16px;font-weight: bold">คะแนน/เกรด</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" >
                                    <thead>
                                        <tr>
                                            <th style="width:200px">คะแนน</th> 
                                            <th style="width:200px">เกรด</th>
                                            <th >จดหมายแจ้งผล</th>
                                            <th >Certificate</th>
                                            <th>รายงานผล</th> 
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <tr>
                                            <td>{{number_format(@$company->businessplan->minitbp->fulltbp->projectgrade->percent, 2, '.', '')}}</td>  
                                            <td>{{@$company->businessplan->minitbp->fulltbp->projectgrade->grade}}</td>
                                            
                                            <td> <a href="{{route('dashboard.admin.evaluationresult.pdf',['id' => @$company->businessplan->minitbp->fulltbp->evaluationresult->id])}}" class="btn btn-sm bg-primary">จดหมายแจ้งผล</a></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm bg-success dropdown-toggle" data-toggle="dropdown">Certificate</button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="{{route('dashboard.admin.evaluationresult.certificate',['id' => @$company->businessplan->minitbp->fulltbp->evaluationresult->id, 'type' => '1'])}}" class="dropdown-item"><i class="icon-file-eye"></i> ตัวอย่างการแสดงผล</a>
                                                        <a href="{{route('dashboard.admin.evaluationresult.certificate',['id' => @$company->businessplan->minitbp->fulltbp->evaluationresult->id, 'type' => '2'])}}" class="dropdown-item"><i class="icon-download"></i> ดาวน์โหลด</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a type="button" href="{{route('dashboard.admin.assessment.summary',['id' => $company->businessplan->minitbp->fulltbp->id])}}" class="btn btn-sm bg-info" target="_blank">ผลคะแนน</a>
                                            </td>                                     
                                        </tr>  
                                    </tbody>
                                </table>      
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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