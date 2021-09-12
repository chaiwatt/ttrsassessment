@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">คำถามที่พบบ่อย</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <a href="{{route('setting.admin.website.homepage.faq.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่มคำถามที่พบบ่อย<b><i class="icon-plus3"></i></b></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <a href="#" class="breadcrumb-item"> หน้าแรก (Homepage)</a>
                    <span class="breadcrumb-item active">คำถามที่พบบ่อย</span>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">คำถามที่พบบ่อย</h6>
                        <div class="header-elements">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="testtopictable">
                                <thead>
                                    <tr class="bg-info">
                                        <th style="text-align: center">คำถาม</th>                               
                                        <th style="text-align: center">คำตอบ</th>
                                        <th style="width:1%;white-space: nowrap;text-align: center">สถานะ</th>
                                        <th  style="width:1%;white-space: nowrap;text-align: center">เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faqs as $key => $faq)
                                        <tr>    
                                            <td style="text-align: center"> {{$faq->title}} </td>                                         
                                            <td> {{$faq->body}}</td>      
                                            <td style="white-space: nowrap;text-align: center"> {{$faq->showstatus->name}}</td>                                                                                                               
                                            <td  style="white-space: nowrap;text-align: center"> 
                                                <a href="{{route('setting.admin.website.homepage.faq.edit',['id' => $faq->id])}}" class="btn btn-sm bg-primary">แก้ไข</a>
                                                <a href="{{route('setting.admin.website.homepage.faq.delete',['id' => $faq->id])}}" data-name="" onclick="confirmation(event)" class="btn btn-sm bg-danger">ลบ</a>                                       
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>      
                        </div>
                        <form method="POST" action="{{route('setting.admin.website.homepage.faq.editsavestatus')}}" >
                            @csrf
                            <div class="form-group mt-2">
                                <label>สถานะการแสดงหน้าแรก</label>
                                <select name="status" id="status" placeholder="สถานะการแสดง" class="form-control form-control-select2">
                                        <option value="0" @if ($homepagesection->show == 0) selected @endif >ซ่อน</option>
                                        <option value="1" @if ($homepagesection->show == 1) selected @endif >แสดง</option>
                                </select>

                                <div class="text-right mt-2">
                                    <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </div>
                        </form>
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