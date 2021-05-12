@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">แจ้งการจ่ายเงิน @if ($invoicetransaction->status == 3)<span class="text-success">(ยืนยันจ่ายเงินแล้ว)</span> @endif    
                </span></h4>
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
                        <form method="POST" action="{{route('dashboard.admin.project.invoice.paymentprove',['id' => $invoicetransaction->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                {{-- <div class="col-md-12"> --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>เลขที่เอกสาร<span class="text-danger">*</span></label>
                                            <input type="text"  name="docno" value="{{$invoicetransaction->docno}}"  placeholder="ชื่อ" class="form-control form-control-lg" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>จำนวนเงิน<span class="text-danger">*</span></label>
                                            <input type="number"  name="price" value="{{$invoicetransaction->price}}"  placeholder="จำนวนเงิน" class="form-control form-control-lg" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>จ่ายผ่านธนาคาร<span class="text-danger">*</span></label>
                                            <select name="bank" data-placeholder="ธนาคาร" class="form-control form-control-lg form-control-select2" disabled>
                                                @foreach ($banks as $bank)
                                                    <option value="{{$bank->id}}" 
                                                      @if ($bank->id == $invoicetransaction->bank_id ) selected @endif >{{$bank->name}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>วันที่<span class="text-danger">*</span></label>
                                            <input type="text"  name="paymentdate" id="paymentdate" value="{{$invoicetransaction->paymentdateth}}"  placeholder="วันที่" class="form-control form-control-lg" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>เวลา เช่น 12.35<span class="text-danger">*</span></label>
                                            <input type="text"  name="paymenttime" value="{{$invoicetransaction->paymenttime}}" placeholder="เวลา" class="form-control form-control-lg" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">เพิ่มเติม</label>
                                            <textarea name="note" class="form-control form-control-lg" cols="3" rows="7" readonly >{{$invoicetransaction->note}}</textarea>
                                        </div>
                                    </div>
                                {{-- </div> --}}
                             
                                
                            </div>
                            <div class="col-md-12">
                                <div class="text-right">
                                    <a  href="{{asset($invoicetransaction->attachment)}}" class="btn bg-primary" target="blank" >ดาวน์โหลดเอกสารแนบ<i class="icon-download ml-2"></i></a>
                                    @if ($invoicetransaction->status == 2)
                                    <button type="submit" class="btn bg-teal" onclick="confirmsubmit(event);">ตรวจสอบเอกสารการจ่ายเงิน<i class="icon-paperplane ml-2"></i></button>
                                    @endif
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
                text: `ยืนยันได้ตรวจสอบเอกสารการจ่ายเงิน แล้วหรือไม่?`,
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ยืนยัน',
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
