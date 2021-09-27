@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">ข้อมูลการติดต่อ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            {{-- <div class="header-elements d-none">
                <a href="{{route('setting.admin.website.page.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่มบทความ<b><i class="icon-plus3"></i></b></a>
            </div> --}}
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> รายงาน</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <span class="breadcrumb-item active">ข้อมูลการติดต่อ</span>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">ข้อมูลการติดต่อ</h6>
                        <div class="header-elements">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table style="width: 100%" class="table table-bordered table-striped" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th>หัวข้อ</th>                               
                                        <th>ผู้ติดต่อ</th>
                                        <th>อีเมล</th>
                                        <th style="width:200px">สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contactinfos as $key => $contactinfo)
                                        <tr>    
                                            <td> {{$contactinfo->subject}} </td> 
                                            <td> {{$contactinfo->name}} </td> 
                                            <td> {{$contactinfo->email}} </td> 
                                            @if ($contactinfo->status == 1)
                                                    <td> <a href="{{route('dashboard.admin.realtimereport.website.view',['id' => $contactinfo->id ])}}" class="btn btn-sm btn-warning">อ่าน</a>  
                                                    <a href="{{route('dashboard.admin.realtimereport.website.delete',['id' => $contactinfo->id ])}}"  onclick="confirmation(event)" class="btn btn-sm btn-danger">ลบ</a> </td> 
                                                @else
                                                    <td> <a href="{{route('dashboard.admin.realtimereport.website.view',['id' => $contactinfo->id ])}}" class="btn btn-sm btn-success">อ่านแล้ว</a> 
                                                        <a href="{{route('dashboard.admin.realtimereport.website.delete',['id' => $contactinfo->id ])}}"  onclick="confirmation(event)" class="btn btn-sm btn-danger">ลบ</a> </td> 
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{$contactinfos->links()}}
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