@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">แก้ไขรายการบัญชี</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> ทั่วไป</a>
                    <a href="{{route('setting.admin.dashboard.bankaccount')}}" class="breadcrumb-item"> รายการบัญชี</a>
                    <span class="breadcrumb-item active">แก้ไขรายการบัญชี</span>
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
                        <form method="POST" action="{{route('setting.admin.dashboard.bankaccount.editsave',['id' =>$bankaccount->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <fieldset>	
                                        <div class="form-group">
                                            <label>ธนาคาร</label>
                                            <input type="text"  name="bank" value="{{$bankaccount->bank}}"  placeholder="ธนาคาร" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>ชื่อบัญชี</label>
                                            <input type="text"  name="name" value="{{$bankaccount->name}}"  placeholder="ชื่อบัญชี" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>หมายเลขบัญชี</label>
                                            <input type="text"  name="accountno" value="{{$bankaccount->accountno}}"  placeholder="หมายเลขบัญชี" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>ประเภทบัญชีเงินฝาก</label>
                                            <select name="banktypeid" placeholder="ประเภทบัญชีเงินฝาก" class="form-control form-control-select2">
                                                @foreach ($banktypes as $banktype)
                                                    <option value="{{$banktype->id}}" @if ($bankaccount->bank_type_id == $banktype->id) selected @endif>{{$banktype->name}}</option>
                                                @endforeach
                                            </select>
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
@stop
