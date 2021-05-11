@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">รายการแบบคำขอรับการประเมิน (Mini TBP)</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> การประเมิน</a>
                    <span class="breadcrumb-item active">รายการแบบคำขอรับการประเมิน (Mini TBP)</span>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">สถานะการวางแผนธุรกิจ</h6>
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
                                        <th>เลขที่โครงการ</th>
                                        <th>ชื่อโครงการ</th>    
                                        <th>สถานะ</th>                               
                                        <th style="text-align: right">เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($minitbps as $key => $minitbp)
                                    <tr>    
                                        <td> {{$minitbp->businessplan->code}} </td> 
                                        <td> {{$minitbp->project}} </td>      
                                        <td> 
                                            @if ($minitbp->businessplan->business_plan_status_id < 3)
                                                    <span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้ส่ง</span>
                                                @else
                                                    @if ($minitbp->refixstatus == 0)
                                                        @if ($minitbp->businessplan->business_plan_status_id == 3)
                                                                <span class="badge badge-flat border-warning text-warning-600">อยู่ระหว่างพิจารณา Mini TBP</span>
                                                            @else
                                                                <span class="badge badge-flat border-success text-success-600">ผ่านอนุมัติแล้ว</span>
                                                        @endif 
                                                        @elseif($minitbp->refixstatus == 1)
                                                            <span class="badge badge-flat border-warning text-warning-600">ให้มีการแก้ไข</span>
                                                        @elseif($minitbp->refixstatus == 2)
                                                            <span class="badge badge-flat border-warning text-warning-600">ส่งรายการแก้ไขแล้ว</span>
                                                    @endif
                                            @endif
                                        </td>                                     
                                        <td style="text-align: right"> 
                                            @if (!Empty($minitbp->attachment))
                                                <a href="{{asset($minitbp->attachment)}}" class=" btn btn-sm bg-primary">ดาวน์โหลดไฟล์</a> 
                                            @endif
                                            <a href="{{route('dashboard.company.project.minitbp.edit',['id' => $minitbp->id])}}" class=" btn btn-sm bg-warning">แก้ไข</a>
                                            @if (!Empty($minitbp->project))
                                                <a href="{{route('dashboard.company.project.minitbp.downloadpdf',['id' => $minitbp->id])}}" class=" btn btn-sm bg-teal">ดาวน์โหลด PDF</a>
                                                <a href="{{route('dashboard.company.project.minitbp.submit',['id' => $minitbp->id])}}" class=" btn btn-sm bg-info">ส่ง Mini TBP</a>
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