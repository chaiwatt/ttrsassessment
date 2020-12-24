@inject('getpercent', 'App\Helper\GetEvPercent')
@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$company->businessplan->minitbp->project}}</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> แดชบอร์ด</a>
                    <span class="breadcrumb-item active">ค้นหา</span>
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
                        <h6 class="card-title">รายการเอกสาร</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:600px">Mini TBP/Full TBP</th> 
                                        <th style="width:200px">PDF</th>
                                        <th>เอกสารแนบ</th> 
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr>
                                        <td>
                                            <a href="{{route('dashboard.admin.project.minitbp.view',['id' => $company->businessplan->minitbp->id])}}" class="text-info" target="_blank">Mini TBP</a>
                                        </td>  
                                        <td> 
                                            <a href="{{asset($company->businessplan->minitbp->attachment)}}" class="btn-sm bg-info" target="_blank">ดาวน์โหลด PDF</a>
                                            {{-- <a type="button" href="#" class="btn btn-sm bg-info">ดาวน์โหลด PDF</a> --}}
                                        </td>  
                                        <td>
                                            -
                                        </td>                                       
                                    </tr>  
                                    <tr>
                                        <td>
                                            <a href="{{route('dashboard.admin.project.fulltbp.view',['id' => $company->businessplan->minitbp->fulltbp->id])}}" class="text-info" target="_blank">Full TBP</a>
                                        </td>  
                                        <td> 
                                            <a href="{{asset($company->businessplan->minitbp->fulltbp->attachment)}}" class="btn-sm bg-info" target="_blank">ดาวน์โหลด PDF</a>
                                            {{-- <a type="button" href="#" class="btn btn-sm bg-info">ดาวน์โหลด PDF</a> --}}
                                        </td>  
                                        <td>
                                            <a type="button" href="{{route('dashboard.admin.project.fulltbp.downloadzip',['id' => $company->businessplan->minitbp->fulltbp->id])}}" class="btn btn-sm bg-teal">ดาวน์โหลดเอกสารแนบ</a>
                                        </td>                                       
                                    </tr> 
                                </tbody>
                            </table>      
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">เกณฑ์การประเมิน</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:600px">ชื่อ-สกุล</th> 
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">คะแนน/เกรด</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:300px">คะแนน</th> 
                                        <th style="width:300px">เกรด</th>
                                        <th>รายงานผล</th> 
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr>
                                        <td>{{number_format(@$company->businessplan->minitbp->fulltbp->projectgrade->percent, 2, '.', '')}}</td>  
                                        <td>{{@$company->businessplan->minitbp->fulltbp->projectgrade->grade}}</td>    
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
        </div>
    </div>
@endsection
@section('pageScript')
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

    </script>
@stop