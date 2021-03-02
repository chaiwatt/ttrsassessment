
@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">แก้ไขประเภทบัญชีเงินฝาก</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('dashboard.admin.realtimereport.website.update',['id' => $contactinfo->id])}}" enctype="multipart/form-data">
                            @csrf
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>เรื่อง</label>
										<input type="text" placeholder="เรื่อง" value="{{$contactinfo->subject}}" class="form-control form-control-lg" readonly>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>รายละเอียด</label>
										<textarea rows="3" placeholder="รายละเอียด" class="form-control form-control-lg">{{$contactinfo->message}}</textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>ผู้ติดต่อ</label>
										<input type="text" placeholder="ผู้ติดต่อ" class="form-control form-control-lg" value="{{$contactinfo->name}}" readonly>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>อีเมล</label>
										<input type="text" placeholder="อีเมล" class="form-control form-control-lg" value="{{$contactinfo->email}}" readonly>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>วันที่ส่ง</label>
										<input type="text" placeholder="วันที่ส่ง" class="form-control form-control-lg" value="{{$contactinfo->created_at}}" readonly>
									</div>
								</div>
							</div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-teal">บันทึกอ่านแล้ว <i class="icon-paperplane ml-2"></i></button>
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
@stop
