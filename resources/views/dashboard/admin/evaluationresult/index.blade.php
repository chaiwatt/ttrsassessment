@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">สรุปการประเมินโครงการ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <span class="breadcrumb-item active">สรุปการประเมินโครงการ</span>
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
                        <h6 class="card-title">สรุปผลการประเมินโครงการ</h6>
                        <div class="header-elements">
                            <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table text-nowrap" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th>ชื่อโครงการ</th> 
                                        <th>คะแนน</th>
                                        <th>เกรด</th>     
                                        <th style="width:300px">รายงานผล</th>                 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fulltbps as $key => $fulltbp)
                                    <tr>    
                                        <td> {{$fulltbp->minitbp->project}} </td> 
                                        <td> yyyy </td>  
                                        <td> xxxx </td> 
                                        <td> 
                                            <a href="{{route('dashboard.admin.evaluationresult.edit',['id' => $fulltbp->evaluationresult->id])}}" class="btn btn-sm bg-info">รายละเอียดการแจ้งผล</a> 
                                            <a href="{{route('dashboard.admin.evaluationresult.pdf',['id' => $fulltbp->evaluationresult->id])}}" class="btn btn-sm bg-primary">เอกสารแจ้งผล</a>
                                            <a href="{{route('dashboard.admin.evaluationresult.certificate',['id' => $fulltbp->evaluationresult->id])}}" class="btn btn-sm bg-success">ดาวน์โหลด Certificate</a>
                                        </td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>      
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
    </script>
@stop