@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">หน้าเพจ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <a href="{{route('setting.admin.website.announce.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่มประกาศ<b><i class="icon-plus3"></i></b></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <span class="breadcrumb-item active">ประกาศ</span>
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
                        <h6 class="card-title">หน้าเพจ</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                
                                <span></span>
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th>ชื่อ</th>                               
                                        <th>หมวดประกาศ</th>
                                        <th>ผู้ประกาศ</th>
                                        <th>สถานะ</th>
                                        <th style="width:250px">เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($announces as $key => $announce)
                                        <tr>    
                                            <td> {{$announce->title}} </td>                                         
                                            <td> {{$announce->announcecategory->name}} </td>  
                                            <td> {{$announce->user->name}} {{$announce->user->lastname}}</td> 
                                            <td> {{$announce->pagestatus->name}} </td>                                                                         
                                            <td> 
                                                <a href="{{route('landing.announcenews',['slug' => $announce->slug])}}" class="btn btn-sm bg-info" target="_blank">หน้าเพจ</a>
                                                <a href="{{route('setting.admin.website.announce.edit',['id' => $announce->id])}}" class="btn btn-sm bg-primary">แก้ไข</a>
                                                <a href="{{route('setting.admin.website.announce.delete',['id' => $announce->id])}}" data-name="" onclick="confirmation(event)" class="btn btn-sm bg-danger">ลบ</a>                                       
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