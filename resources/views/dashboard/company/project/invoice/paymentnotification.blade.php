@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">แจ้งการจ่ายเงิน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <a href="{{route('dashboard.company.project.invoice')}}" class="breadcrumb-item"> ใบแจ้งหนี้</a>
                    <span class="breadcrumb-item active">แจ้งการจ่ายเงิน</span>
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
                        <form method="POST" action="{{route('dashboard.company.project.invoice.paymentnotificationsave',['id' => $invoicetransaction->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <fieldset>	
                                        <div class="form-group">
                                            <label>เลขที่เอกสาร<span class="text-danger">*</span></label>
                                            <input type="text"  name="docno" value="{{$invoicetransaction->docno}}"  placeholder="ชื่อ" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>จำนวนเงิน<span class="text-danger">*</span></label>
                                            <input type="number"  name="price" value="{{old('price')}}"  placeholder="จำนวนเงิน" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>จ่ายผ่านธนาคาร<span class="text-danger">*</span></label>
                                            <select name="prefix" data-placeholder="ธนาคาร" class="form-control form-control-select2">
                                                @foreach ($banks as $bank)
                                                    <option value="{{$bank->id}}" >{{$bank->name}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>วันที่<span class="text-danger">*</span></label>
                                            <input type="text"  name="paymentdate" id="paymentdate" value="{{old('paymentdate')}}"  placeholder="วันที่" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>เวลา เช่น 12.35<span class="text-danger">*</span></label>
                                            <input type="text"  name="paymenttime" value="{{old('paymenttime')}}"  placeholder="เวลา" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">เพิ่มเติม</label>
                                            <textarea name="note" class="form-control" cols="3" rows="3">{{old('note')}}</textarea>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-teal">แจ้งการจ่ายเงิน<i class="icon-paperplane ml-2"></i></button>
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
    $('#paymentdate').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        clearButton: true,
        cancelText: "ยกเลิก",
        okText: "ตกลง",
        clearText: "เคลียร์",
        time: false
    });
</script>
@stop
