@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">แจ้งการจำระเงิน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ผู้ใช้งาน</a>
                    <a href="{{route('setting.admin.user')}}" class="breadcrumb-item"> ผู้ใช้งานระบบ</a>
                    <span class="breadcrumb-item active">เพิ่มผู้ใช้งานระบบ</span>
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
                        <form method="POST" action="{{route('setting.admin.user.createsave')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <fieldset>	
                                        <div class="form-group">
                                            <label>หมายเลขแจ้งหนี้<span class="text-danger">*</span></label>
                                            <input type="text"  name="name" value="{{$businessplanfeetransaction->invoiceno}}"  placeholder="ชื่อ" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>จำนวนที่ชำระ<span class="text-danger">*</span></label>
                                            <input type="text"  name="lastname" value="{{$businessplanfeetransaction->feetype->price}}"  placeholder="นามสกุล" class="form-control" readonly>
                                        </div>
                                        <label class="d-block font-weight-semibold">เลือกวิธีการชำระเงิน<span class="text-danger">*</span></label>
                                        <div class="form-group mb-3 mb-md-2">     
                                            @foreach ($paymenttypes as $paymenttype)
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" data-id="{{$paymenttype->id}}" class="form-check-input-styled" name="radio-inline-left" data-fouc>
                                                        {{$paymenttype->name}}
                                                    </label>
                                                </div>   
                                            @endforeach
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label class="font-weight-semibold">เลือกธนาคารที่ชำระเงิน</label>
                                            @foreach ($bankaccounts as $bankaccount)
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" data-id="{{$bankaccount->id}}" class="form-check-input-styled" name="stacked-radio-left" data-fouc>
                                                        {{$bankaccount->bank}} ชื่อบัญชี {{$bankaccount->name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="form-group">
                                            <label>เอกสารแนบ<span class="text-danger">*</span></label>
                                            <input type="text"  name="email" value="{{old('email')}}"  placeholder="อีเมล์" class="form-control">
                                        </div>
                                        
                                    </fieldset>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
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
<script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
@stop
