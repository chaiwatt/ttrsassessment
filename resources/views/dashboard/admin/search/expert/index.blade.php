@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">โครงการ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> แดชบอร์ด</a>
                    <span class="breadcrumb-item active">ค้นหา</span>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ประเภทการค้นหา</label><span class="text-danger">*</span>
                                        <select name="searchgroup" id="searchgroup" data-placeholder="ประเภทการค้นหา" class="form-control form-control-select2">
                                            {{-- <option value="0000">===เลือก รายการ===</option> --}}
                                            <option value="1">สาขาความเชี่ยวชาญ</option>
                                            <option value="2">ชื่อโครงการ</option>
                                            <option value="3">สถานะโครงการ</option>
                                        </select>
                                    </div>
                                </div>      
                                <div id="searchexpertbranch_wrapper" class="col-md-6">
                                    <label>สาขาความเชี่ยวชาญ</label><span class="text-danger">*</span>
                                    <select name="searchexpertbranch" id="searchexpertbranch" data-placeholder="สาขาความเชี่ยวชาญ" class="form-control form-control-select2">
                                        <option value="0000">===เลือก สาขาความเชี่ยวชาญ===</option>
                                        @foreach ($expertbranches as $expertbranch)
                                            <option value="{{$expertbranch->id}}">{{$expertbranch->name}}</option> 
                                        @endforeach
                                    </select>
                                </div> 
                                {{-- <div id="searchprojectname_wrapper" class="col-md-6" hidden>
                                    <label>ชื่อโครงการ</label>
                                    <input type="text"  name="searchprojectname" id="searchprojectname" value=""  placeholder="ชื่อโครงการ" class="form-control" >
                                </div>      --}}
                                <div id="searchprojectname_wrapper" class="col-md-6" hidden >
                                    <label>โครงการ</label>
                                    <select name="searchprojectname" id="searchprojectname" data-placeholder="โครงการ" class="form-control form-control-select2">
                                        <option value="0000">===เลือก โครงการ===</option>
                                        @foreach ($minitbps as $minitbp)
                                            <option value="{{$minitbp->id}}">{{$minitbp->project}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                                <div id="projectstatus_wrapper" class="col-md-6" hidden>
                                    <label>สถานะโครงการ</label><span class="text-danger">*</span>
                                    <select name="searchprojectstatus" id="searchprojectstatus" data-placeholder="สถานะโครงการ" class="form-control form-control-select2">
                                        <option value="0000">===เลือก สถานะโครงการ===</option>
                                        <option value="2">กำลังดำเนินการ</option>
                                        <option value="3">สิ้นสุดโครงการ</option>
                                    </select>
                                </div>        
                                <div id="searchword_wrapper" class="col-md-6" hidden>
                                    <label>คำค้น</label>
                                    <input type="text"  name="searchword" id="searchword" value=""  placeholder="คำค้น" class="form-control" >
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">รายการโครงการ</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ชื่อ-สกุล</th>
                                        <th>ความเชี่ยวชาญ</th> 
                                        {{-- <th>เพิ่มเติม</th>  --}}
                                    </tr>
                                </thead>
                                <tbody id="reportsearch_wrapper">
                                    @foreach ($experts as $expert)
                                    <tr>
                                        <td> {{$expert->name}} {{$expert->lastname}}</td> 
                                        {{-- <td> {{$expert->expertdetail->expertbranch->name}} </td>   --}}
                                        <td> ดหกดหกด</td>  
                                        {{-- <td> yyy </td>   --}}
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
    </div>
@endsection
@section('pageScript')
<script type="module" src="{{asset('assets/dashboard/js/app/helper/searchexperthelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

    </script>
@stop