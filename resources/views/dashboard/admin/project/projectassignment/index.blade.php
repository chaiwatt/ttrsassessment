@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">รายการมอบหมาย</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <a href="#" class="breadcrumb-item"> การมอบหมาย</a>
                    <span class="breadcrumb-item active">รายการมอบหมาย</span>
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
                        <h6 class="card-title">รายการ Assignment</h6>
                        <div class="header-elements">
                            <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                {{-- <i class="icon-calendar3 mr-2"></i> --}}
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th style="width:50px">#</th> 
                                        <th>เลขที่โครงการ</th> 
                                        <th>ชื่อโครงการ</th> 
                                        <th>บริษัท</th>
                                        <th>Leader</th>
                                        <th>Co-Leader</th>
                                        <th>สถานะ</th>
                                        @if (Auth::user()->user_type_id>=6)
                                            <th>เพิ่มเติม</th> 
                                        @endif                             
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projectassignments as $key => $projectassignment)
                                    <tr>    
                                        <td> {{$key+1}}</td>
                                        <td> {{$projectassignment->businessplan->code}} </td> 
                                        <td> {{$projectassignment->businessplan->minitbp->project}} </td> 
                                        <td> {{$projectassignment->businessplan->company->name}} </td> 
                                        <td> 
                                            @if (!Empty($projectassignment->leader))
                                                {{$projectassignment->leader->prefix->name}}{{$projectassignment->leader->name}} {{$projectassignment->leader->lastname}}
                                            @endif
                                        </td>  
                                        <td> 
                                            @if (!Empty($projectassignment->coleader))
                                                {{$projectassignment->coleader->prefix->name}}{{$projectassignment->coleader->name}} {{$projectassignment->coleader->lastname}}
                                            @endif
                                           
                                        </td> 
                                        <td>
                                            @if ($projectassignment->leader_id == null)
                                                <span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้ยืนยัน</span>
                                                @else
                                                <span class="badge badge-flat border-success text-success-600">ยืนยันแล้ว</span>
                                            @endif
                                        </td>
                                        @if (Auth::user()->user_type_id>=6)
                                            <td> 
                                                <a href="{{route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id])}}" class="btn-sm bg-primary">รายละเอียด</a>
                                            </td>    
                                        @endif
                               
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