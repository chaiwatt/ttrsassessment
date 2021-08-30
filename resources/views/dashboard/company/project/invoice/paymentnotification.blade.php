@extends('layouts.dashboard.main')
@section('pageCss')
<style>
    textarea{
        font-size: 16px !important;
    }
</style>
@stop
@section('content')
  
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">แจ้งการชำระเงิน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <a href="{{route('dashboard.company.project.invoice')}}" class="breadcrumb-item"> ใบแจ้งหนี้</a>
                    <span class="breadcrumb-item active">แจ้งการชำระเงิน</span>
                </div>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>

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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>เลขที่เอกสาร</label>
                                        <input type="text"  name="docno" value="{{$invoicetransaction->docno}}"  placeholder="เลขที่เอกสาร" class="form-control form-control-lg" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>จำนวนเงิน (บาท)<span class="text-danger">*</span></label>
                                        <input type="text"  name="price" value="{{$invoicetransaction->price}}"  placeholder="จำนวนเงิน" class="form-control form-control-lg numeralformat10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>จ่ายผ่านธนาคาร<span class="text-danger">*</span></label>
                                        <select name="bank" data-placeholder="ธนาคาร" class="form-control form-control-lg form-control-select2">
                                            @foreach ($banks as $key => $bank)
                                            @if ($key != $banks->count()-1)
                                            <option value="{{$bank->id}}" @if ($bank->id == $invoicetransaction->bank_id ) selected @endif >{{$bank->name}}</option> 
                                            @endif
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>วันที่<span class="text-danger">*</span></label>
                                        <input type="text"  name="paymentdate" id="paymentdate" value="{{old('paymentdate')}}"  placeholder="วันที่" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>เวลา<span class="text-danger">*</span></label>
                                        <input type="text"  name="paymenttime" value="{{old('paymenttime')}}" placeholder="เวลา" class="form-control form-control-lg timeformat">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>เอกสารการชำระเงิน</label>
                                        <div class="input-group">													
                                            <input type="text" id="filename" class="form-control form-control-lg border-right-0" placeholder="เอกสารการชำระเงิน"  >
                                            <span class="input-group-append">
                                                <button class="btn bg-info" type="button" onclick="document.getElementById('file').click();">อัปโหลด</button>																																						
                                            </span>
                                        </div>
                                        <input type="file" style="display:none;" id="file" name="file" accept="image/jpeg,image/gif,image/png,application/pdf"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">เพิ่มเติม</label>
                                        <textarea name="note" class="form-control form-control-lg stringformat200" cols="3" rows="6">{{$invoicetransaction->note}}</textarea>
                                    </div>
                                </div>
                            </div>
                            @if ($invoicetransaction->status == 1)
                                <div class="text-right">
                                    <button type="submit" class="btn bg-teal" onclick="confirmsubmit(event);">แจ้งการชำระเงิน<i class="icon-paperplane ml-2"></i></button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('pageScript')
    <script src="{{asset('assets/dashboard/js/app/helper/inputformat.js')}}"></script>
    <script>
        $('#paymentdate').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            clearButton: true,
            cancelText: "ยกเลิก",
            okText: "ตกลง",
            clearText: "เคลียร์",
            time: false
        });
        $("#file").on('change', function() {
            $("#filename").val(this.value);
        });
        function confirmsubmit(e) {
            e.preventDefault();
            var frm = e.target.form;
            Swal.fire({
                    title: 'ยืนยัน',
                    text: `ต้องการแจ้งการชำระเงินหรือไม่ `,
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ตกลง',
                    cancelButtonText: 'ยกเลิก',
                    closeOnConfirm: false,
                    closeOnCancel: false
                }).then((result) => {
                if (result.value) {
                    frm.submit();
                }
            });
        }
    </script>
@stop
