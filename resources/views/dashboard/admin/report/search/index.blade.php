@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">ค้นหา</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> รายงาน</a>
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
                        <form method="POST" action="{{route('dashboard.admin.calendar.createsave')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ประเภทการค้นหา</label><span class="text-danger">*</span>
                                        <select name="searchgroup" id="searchgroup" data-placeholder="โครงการ" class="form-control form-control-select2">
                                            @foreach ($searchgroups as $searchgroup)
                                                <option value="{{$searchgroup->id}}">{{$searchgroup->name}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>    
                                <div id="searchyear_wrapper" class="col-md-6">
                                    <label>ปี</label><span class="text-danger">*</span>
                                    <select name="searchyear" id="searchyear" data-placeholder="ปี" class="form-control form-control-select2">
                                        <option value="0000">เลือกปี</option>
                                        @foreach ($years as $year)
                                            <option value="{{$year}}">{{$year}}</option> 
                                        @endforeach
                                    </select>
                                </div>   
                                <div id="searchindustrygroup_wrapper" class="col-md-6" hidden>
                                    <label>กลุ่มอุตสาหกรรม</label><span class="text-danger">*</span>
                                    <select name="searchindustrygroup" id="searchindustrygroup" data-placeholder="กลุ่มอุตสาหกรรม" class="form-control form-control-select2">
                                        <option value="0000">เลือกกลุ่มอุตสาหกรรม</option>
                                        @foreach ($industrygroups as $industrygroup)
                                            <option value="{{$industrygroup->id}}">{{$industrygroup->name}}</option> 
                                        @endforeach
                                    </select>
                                </div>                          
                                <div id="searchdate_wrapper" class="col-md-6" hidden>
                                    <label>วันที่</label>
                                    <input type="text"  name="searchdate" id="searchdate" value=""  placeholder="วันที่" class="form-control" >
                                </div>
                                <div id="searchword_wrapper" class="col-md-6" hidden>
                                    <label>คำค้น</label>
                                    <input type="text"  name="searchword" id="searchword" value=""  placeholder="คำค้น" class="form-control" >
                                </div>
                            </div>
                            {{-- <div class="text-right">
                                <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
                            </div> --}}
                        </form>
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
                                        <th>เลขที่โครงการ</th> 
                                        <th>ชื่อโครงการ</th> 
                                        <th>บริษัท</th>
                                        <th>สถานะ</th> 
                                        <th>เพิ่มเติม</th> 
                                    </tr>
                                </thead>
                                <tbody id="reportsearch_wrapper">
                                    @foreach ($fulltbps as $fulltbp)
                                        <td> {{$fulltbp->updatedatth}} </td> 
                                        <td> {{$fulltbp->minitbp->project}} </td>  
                                        <td> {{$fulltbp->minitbp->businessplan->company->name}} </td>  
                                        <td> {{$fulltbp->minitbp->businessplan->businessplanstatus->name}} </td>                                       
                                        <td> 
                                            <a href="{{route('dashboard.admin.report.search.view',['id' => $fulltbp->id])}}" class=" badge bg-primary">รายละเอียด</a>
                                            <a href="{{route('dashboard.admin.report.search.pdf',['id' => $fulltbp->id])}}" class=" badge bg-teal">PDF</a>
                                            <a href="{{route('dashboard.admin.report.search.excel',['id' => $fulltbp->id])}}" class=" badge bg-info">EXCEL</a>
                                        </td> 
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
<script type="module" src="{{asset('assets/dashboard/js/app/helper/searchhelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

    </script>
@stop