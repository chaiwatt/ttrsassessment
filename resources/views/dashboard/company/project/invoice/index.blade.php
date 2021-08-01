@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">ใบแจ้งหนี้</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            {{-- <div class="header-elements d-none">
                <a href="{{route('setting.admin.assessment.criteriagroup.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่มรายการเกณฑ์การประเมิน<b><i class="icon-plus3"></i></b></a>
            </div> --}}
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <span class="breadcrumb-item active">ใบแจ้งหนี้</span>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">รายการใบแจ้งหนี้</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                
                                <span></span>
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th>วันที่</th>
                                        <th>เลขที่เอกสาร</th>    
                                        <th>รายละเอียด</th>   
                                        <th>สถานภาพ</th>                             
                                        <th style="text-align: right">เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoicetransactions as $key => $invoicetransaction)
                                    <tr>    
                                        <td> {{$invoicetransaction->issuedate}} </td> 
                                        <td> {{$invoicetransaction->docno}} </td> 
                                        <td> {{$invoicetransaction->description}} </td>                                      
                                        <td> 
                                            @if ($invoicetransaction->status == 3)
                                                    <span class="badge badge-flat border-success text-success-600 rounded-0">จ่ายเงินแล้ว</span>
                                                @elseif($invoicetransaction->status == 2)
                                                    <span class="badge badge-flat border-info text-info-600 rounded-0">รอการตรวจสอบ</span>
                                                    
                                                @elseif($invoicetransaction->status == 1)
                                                    <a href="{{route('dashboard.company.project.invoice.paymentnotification',['id' => $invoicetransaction->id])}}" class=" btn btn-sm bg-primary"><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i>แจ้งการจ่ายเงิน</a>
                                                @else                                       
                                            @endif
                                        </td> 
                                        <td style="text-align: right">
                                            @if($invoicetransaction->status == 1)
                                            <a href="{{route('dashboard.company.project.invoice.view',['id' => $invoicetransaction->id])}}" class=" btn btn-sm bg-info" target="_blank" >ดาวน์โหลดใบแจ้งหนี้</a>
                                            @endif
                                            
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
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
    </script>
@stop