@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">รายการเกณฑ์การประเมิน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> การประเมิน</a>
                    <span class="breadcrumb-item active">รายการเกณฑ์การประเมิน</span>
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
                        <div class="table-responsive" >
                            <table style="width: 100%" class="table table-bordered table-striped" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th style="width:50px">#</th>
                                        <th>หมายเลขแจ้งหนี้</th>
                                        <th>รายการ</th>    
                                        <th>จำนวนเงิน (บาท)</th>                  
                                        <th>ใบแจ้งหนี้</th>  
                                        <th>ยืนยันชำระเงิน</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($businessplanfeetransactions as $key => $businessplanfeetransaction)
                                    <tr>    
                                        <td> {{$key+1}} </td>
                                        <td> {{$businessplanfeetransaction->invoiceno}} </td>  
                                        <td> {{$businessplanfeetransaction->feetype->name}} </td> 
                                        <td> {{$businessplanfeetransaction->feetype->price}} </td>   
                                        <td> 
                                            <a href="{{route('dashboard.company.project.fee.invoice',['id' => $businessplanfeetransaction->id])}}" class="btn btn-sm bg-primary">ใบแจ้งหนี้</a>
                                        </td>    
                                        <td> 
                                            <a href="{{route('dashboard.company.project.fee.payment',['id' => $businessplanfeetransaction->id])}}" class=" btn btn-sm bg-teal">แจ้งชำระเงิน</a>
                                        </td>                              
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>      
                        </div>
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
<script src="{{asset('assets/dashboard/js/app/helper/utility.js?v=1')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
    </script>
@stop