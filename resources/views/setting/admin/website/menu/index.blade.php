@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">หน้าเพจ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <a href="{{route('setting.admin.website.menu.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่มเมนู<b><i class="icon-plus3"></i></b></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <span class="breadcrumb-item active">เพิ่มเมนู</span>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">หน้าเพจ</h6>
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
                                        {{-- <th>#</th> --}}
                                        <th>ชื่อเมนูภาษาไทย</th>                               
                                        <th>ชื่อเมนูภาษาอังกฤษ</th>
                                        <th>ลิงก์</th>
                                        <th style="width:1%;white-space: nowrap">เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{$directmenus}} --}}
                                    @foreach ($directmenu2s as $key => $directmenu)
                                    <tr>    
                                        {{-- <td> {{$key+1}} </td> --}}
                                        <td> {{$directmenu->name}} </td>                                         
                                        <td> {{$directmenu->engname}} </td>  
                                        <td> {{$directmenu->url}}</td> 
                                        {{-- <td> {{$page->pageviewunique->count()}} </td>  --}}
                                        <td style="white-space: nowrap"> 
                                            {{-- <a href="{{route('landing.page',['slug' => $page->slug])}}" class="btn btn-sm bg-info" target="_blank">หน้าเพจ</a> --}}
                                            <a href="{{route('setting.admin.website.menu.edit',['id' => $directmenu->id])}}" class="btn btn-sm bg-primary">แก้ไข</a>
                                            @if ($key >= 7)
                                                <a href="{{route('setting.admin.website.menu.delete',['id' => $directmenu->id])}}" data-name="" onclick="confirmation(event)" class="btn btn-sm bg-danger">ลบ</a>                                       
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