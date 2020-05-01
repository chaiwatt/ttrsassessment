@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">ผู้ใช้งาน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <a href="{{route('setting.user.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่มผู้ใช้งานระบบ<b><i class="icon-plus3"></i></b></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ผู้ใช้งานระบบ</a>
                    <span class="breadcrumb-item active">ผู้ใช้งาน</span>
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
                        <h6 class="card-title">ผู้ใช้งานระบบ</h6>
                        {{-- <div class="header-elements">
                            <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                <i class="icon-calendar3 mr-2"></i>
                                <span></span>
                            </a>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ชื่อ-สกุล</th> 
                                        <th>กลุ่ม</th>       
                                        <th>สถานะ</th>                          
                                        <th style="width:150px">เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                    <tr>    
                                        <td> {{$key+1}} </td>
                                        <td> {{$user->prefix->name}}{{$user->name}}   {{$user->lastname}} </td>    
                                        <td> {{$user->usertype->name}} </td>   
                                        @if ($user->user_status_id == 1)
                                                <td><span class="badge badge-flat border-success text-success-600 rounded-0">{{$user->userstatus->name}}</span></td> 
                                           @else 
                                                <td><span class="badge badge-flat border-danger text-danger-600 rounded-0">{{$user->userstatus->name}}</span></td> 
                                        @endif                                     
                                        
                                        <td> 
                                            <a href="{{route('setting.user.edit',['id' => $user->id])}}" class=" badge bg-primary">แก้ไข</a>
                                            <a href="{{route('setting.user.delete',['id' => $user->id])}}" data-name="" onclick="confirmation(event)" class=" badge bg-danger">ลบ</a>                                       
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