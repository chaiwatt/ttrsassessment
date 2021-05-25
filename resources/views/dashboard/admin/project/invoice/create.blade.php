@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">เพิ่มใบแจ้งหนี้</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <a href="{{route('dashboard.admin.project.invoice')}}" class="breadcrumb-item"> ใบแจ้งหนี้</a>
                    <span class="breadcrumb-item active">เพิ่มใบแจ้งหนี้</span>
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
                        <form method="POST" action="{{route('dashboard.admin.project.invoice.createsave')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>บริษัท</label>
                                        <select name="company" data-placeholder="บริษัท" class="form-control form-control-lg form-control-select2">
                                            @foreach ($companies as $company)
                                                <option value="{{$company->id}}">{{$company->name}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>                               
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>รหัสลูกค้า/Customer ID</label>
                                        <input type="text"  name="customer" value="{{old('customer')}}"  placeholder="รหัสลูกค้า/Customer ID" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>เลขที่เอกสาร/Document No.</label>
                                        <input type="text"  name="docno" value="{{old('docno')}}"  placeholder="เลขที่เอกสาร/Document No." class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>เลขที่ใบเสนอราคา/Quotation No.</label>
                                        <input type="text"  name="quotationno" value="{{old('quotationno')}}"  placeholder="เลขที่ใบเสนอราคา/Quotation No." class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>เลขที่ใบสั่งซื้อ/Purchase Order No.</label>
                                        <input type="text"  name="purchaseorderno" value="{{old('purchaseorderno')}}"  placeholder="เลขที่ใบสั่งซื้อ/Purchase Order No." class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>เลขที่ใบสั่งขาย/Sale Order No.</label>
                                        <input type="text"  name="saleorderno" value="{{old('saleorderno')}}"  placeholder="เลขที่ใบสั่งขาย/Sale Order No." class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>วันที่ใบสั่งขาย/Sale Order Date</label>
                                        <input type="text"  name="saleorderdate" id="saleorderdate" value="{{old('saleorderdate')}}"  placeholder="วันที่ใบสั่งขาย/Sale Order Date" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>เลขที่เอกสารอ้างอิง/Reference No.</label>
                                        <input type="text"  name="refno" value="{{old('refno')}}"  placeholder="เลขที่เอกสารอ้างอิง/Reference No." class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>รายการ/Description</label>
                                        <input type="text"  name="description" value="{{old('description')}}"  placeholder="รายการ/Description" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>จำนวนเงิน/Amount (THB) (บาท)</label>
                                        <input type="number"  name="price" value="{{old('price')}}"  placeholder="จำนวนเงิน/Amount (THB)" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>Biller ID</label>
                                        <input type="text"  name="billerid" value="{{old('billerid')}}"  placeholder="Biller ID" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>Branch ID</label>
                                        <input type="text"  name="branchid" value="{{old('branchid')}}"  placeholder="Branch ID" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>Service Code</label>
                                        <input type="text"  name="servicecode" value="{{old('servicecode')}}"  placeholder="Service Code" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>Comp Code</label>
                                        <input type="text"  name="compcode" value="{{old('compcode')}}"  placeholder="Comp Code" class="form-control form-control-lg">
                                    </div>
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
	<script>
        $('#saleorderdate').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            clearButton: true,
            cancelText: "ยกเลิก",
            okText: "ตกลง",
            clearText: "เคลียร์",
            time: false
        });
    </script>
@stop
