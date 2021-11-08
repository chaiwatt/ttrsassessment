@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">ผู้ใช้งาน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="{{route('setting.admin.user')}}" class="breadcrumb-item"> ผู้ใช้งานระบบ</a>
                    <span class="breadcrumb-item active">นำเข้าไฟล์ Excel</span>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">นำเข้าไฟล์ Excel (สำหรับผู้เชี่ยวชาญ / เจ้าหน้าที่ TTRS)</h6>
                        <div class="header-elements">
                            <div class="list-icons ml-3">
                                <div class="list-icons-item dropdown">
                                    {{-- <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a> --}}
                                    {{-- <div class="dropdown-menu">
                                        <a href="#" data-toggle="modal" id="select_testtopictable_excel" class="dropdown-item"><i class="icon-file-excel"></i>Excel</a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('setting.admin.user.importsave') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <input type="file" name="file" class="form-control">
                                </div>
                                <div class="col-md-12 mt-2 d-flex justify-content-end">
                                    <a href="{{asset('assets/dashboard/template/format.xlsx')}}" class="btn btn-primary mr-1 text-white"><i class="icon-file-excel text-white mr-1"></i> รูปแบบไฟล์</a>
                                    <button class="btn btn-info"><i class="icon-floppy-disk mr-1"></i> เพิ่ม</button>
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
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/userhelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/utility.js?v=1')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
    </script>
@stop