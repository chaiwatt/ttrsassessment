@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">รายงานหน้าเพจ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            {{-- <div class="header-elements d-none">
                <a href="{{route('setting.admin.website.page.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่มหน้าเพจ<b><i class="icon-plus3"></i></b></a>
            </div> --}}
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> รายงาน</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <span class="breadcrumb-item active">การเข้าชมเว็บไซต์</span>
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
            {{-- <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">การเข้าชมเว็บไซต์</h6>
                        <div class="header-elements">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th>หน้าเพจ</th>                               
                                        <th style="width: 200px">จำนวนเข้าชม</th>
                                        <th style="width: 250px">เข้าดูล่าสุด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($directmenus as $key => $directmenu)
                                        <tr>    
                                            <td> <a href="{{url('/').'/'.$directmenu->url}}" class="text-info" target="_blank">{{$directmenu->name}}</a> </td>                                         
                                            <td> {{$directmenu->view}} </td> 
                                            <td> {{$directmenu->viewdate}} </td> 
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>      
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">การเข้าชมหน้าเพจ</h6>
                        <div class="header-elements">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th>หน้าเพจ</th>                               
                                        <th style="width: 200px">จำนวนเข้าชม</th>
                                        <th style="width: 250px">เข้าดูล่าสุด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pages as $key => $page)
                                    <tr>    
                                        <td> <a href="{{route('landing.page',['slug' => $page->slug])}}" class="text-info" target="_blank">{{$page->name}}</a> </td>                                         
                                        <td> {{$page->pageview->count()}} </td> 
                                        <td> {{$page->viewdate}} </td> 
                                    </tr>
                                    @endforeach
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
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
    </script>
@stop