@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">ใบแจ้งหนี้</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <a href="{{route('dashboard.admin.project.invoice.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่มใบแจ้งหนี้<b><i class="icon-plus3"></i></b></a>
            </div>
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
                        <h6 class="card-title">สถานะการวางแผนธุรกิจ</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                
                                <span></span>
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th>วันที่</th>
                                        <th>บริษัท</th>
                                        <th>เลขที่เอกสาร</th>    
                                        <th>สถานะ</th> 
                                        <th>เพิ่มเติม</th>                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoicetransactions as $key => $invoicetransaction)
                                        @if (Auth::user()->isProjectLeader($invoicetransaction->company->businessplan->minitbp->fulltbp->id) == 1 || Auth::user()->user_type_id >= 5)
                                            <tr>    
                                                <td> {{$invoicetransaction->issuedateth}} </td>  
                                                <td> {{$invoicetransaction->company->name}} </td> 
                                                <td> {{$invoicetransaction->docno}} </td> 
                                                <td> 
                                                @if ($invoicetransaction->status == 3)
                                                    <a href="{{route('dashboard.admin.project.invoice.payment',['id' => $invoicetransaction->id])}}" class="badge badge-flat border-success text-success-600 rounded-0">จ่ายเงินแล้ว</a>
                                                    @elseif($invoicetransaction->status == 2)
                                                    <a href="{{route('dashboard.admin.project.invoice.payment',['id' => $invoicetransaction->id])}}" class=" btn btn-sm bg-info">แจ้งการชำระแล้ว</a>
                                                    @elseif($invoicetransaction->status == 1)
                                                    <span class="badge badge-flat border-warning text-warning-600 rounded-0">ยังไม่จ่ายเงิน</span>
                                                    @else                                     
                                                    <a href="#" id="notifyuser" type="button" data-id="{{$invoicetransaction->id}}" class=" btn btn-sm bg-warning"><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i>แจ้งผู้ประเมิน</a>
                                                @endif
                                                </td>                                   
                                                <td>
                                                    <a href="{{route('dashboard.admin.project.invoice.edit',['id' => $invoicetransaction->id])}}" class=" btn btn-sm bg-info">รายละเอียด</a>
                                                    <a href="{{route('dashboard.admin.project.invoice.view',['id' => $invoicetransaction->id])}}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
                                                    @if ($invoicetransaction->status == 1)
                                                    <a href="{{route('dashboard.admin.project.invoice.delete',['id' => $invoicetransaction->id])}}" class=" btn btn-sm bg-danger">ลบ</a>
                                                    @endif
                                                    
                                                </td>    
                                            </tr>
                                        @endif

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
<script src="{{asset('assets/dashboard/js/app/helper/invoicehelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
    </script>
@stop