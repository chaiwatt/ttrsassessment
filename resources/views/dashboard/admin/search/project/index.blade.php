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
                                            @foreach ($searchgroups as $searchgroup)
                                                <option value="{{$searchgroup->id}}">{{$searchgroup->name}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>    
                                <div id="searchyear_wrapper" class="col-md-6">
                                    <label>ปี</label><span class="text-danger">*</span>
                                    <select name="searchyear" id="searchyear" data-placeholder="ปี" class="form-control form-control-select2">
                                        <option value="0000">===เลือก ปี===</option>
                                        @foreach ($years as $year)
                                            <option value="{{$year}}">{{$year}}</option> 
                                        @endforeach
                                    </select>
                                </div>   
                                <div id="searchindustrygroup_wrapper" class="col-md-6" hidden>
                                    <label>กลุ่มอุตสาหกรรม</label><span class="text-danger">*</span>
                                    <select name="searchindustrygroup" id="searchindustrygroup" data-placeholder="กลุ่มอุตสาหกรรม" class="form-control form-control-select2">
                                        <option value="0000">===เลือก กลุ่มอุตสาหกรรม===</option>
                                        @foreach ($industrygroups as $industrygroup)
                                            <option value="{{$industrygroup->id}}">{{$industrygroup->name}}</option> 
                                        @endforeach
                                    </select>
                                </div>     
                                <div id="grage_wrapper" class="col-md-6" hidden>
                                    <label>เกรด</label><span class="text-danger">*</span>
                                    <select name="searchgrade" id="searchgrade" data-placeholder="เกรด" class="form-control form-control-select2">
                                        <option value="0000">===เลือก เกรด===</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{$grade->id}}">{{$grade->name}}</option> 
                                        @endforeach
                                    </select>
                                </div>    
                                <div id="leader_wrapper" class="col-md-6" hidden>
                                    <label>Leader</label><span class="text-danger">*</span>
                                    <select name="searchleader" id="searchleader" data-placeholder="Leader" class="form-control form-control-select2">
                                        <option value="0000">===เลือก Leader===</option>
                                        @foreach ($leaders as $leader)
                                            <option value="{{$leader->id}}">{{$leader->name}} {{$leader->lastname}}</option> 
                                        @endforeach
                                    </select>
                                </div>  
                                <div id="expert_wrapper" class="col-md-6" hidden>
                                    <label>ผู้เชี่ยวชาญ</label><span class="text-danger">*</span>
                                    <select name="searchexpert" id="searchexpert" data-placeholder="ผู้เชี่ยวชาญ" class="form-control form-control-select2">
                                        <option value="0000">===เลือก ผู้เชี่ยวชาญ===</option>
                                        @foreach ($experts as $expert)
                                            <option value="{{$expert->id}}">{{$expert->name}} {{$expert->lastname}}</option> 
                                        @endforeach
                                    </select>
                                </div>  
                                <div id="isic_wrapper" class="col-md-6" hidden>
                                    <label>ISIC</label><span class="text-danger">*</span>
                                    <select name="isic" id="isic" data-placeholder="ISIC" class="form-control form-control-select2">
                                        <option value="0000">===เลือก ISIC===</option>
                                        @foreach ($isics as $isic)
                                            <option value="{{$isic->id}}">{{$isic->name}}</option> 
                                        @endforeach
                                    </select>
                                    <label class="mt-3">หมวดหมู่ย่อย</label><span class="text-danger">*</span>
                                    <select name="searchisic" id="searchisic" data-placeholder="หมวดหมู่ย่อย" class="form-control form-control-select2">

                                    </select>
                                </div>                    

                                <div id="searchword_wrapper" class="col-md-6" hidden>
                                    <label>คำค้น</label>
                                    <input type="text"  name="searchword" id="searchword" value=""  placeholder="คำค้น" class="form-control" >
                                </div>
                                <div id="searchprojectname_wrapper" class="col-md-6" hidden>
                                    <label>ชื่อโครงการ</label>
                                    <input type="text"  name="searchprojectname" id="searchprojectname" value=""  placeholder="ชื่อโครงการ" class="form-control" >
                                </div>
                                <div id="searchcompanyname_wrapper" class="col-md-6" hidden>
                                    <label>ชื่อบริษัท</label>
                                    <input type="text"  name="searchcompanyname" id="searchcompanyname" value=""  placeholder="ชื่อบริษัท" class="form-control" >
                                </div>
                                <div id="searchdocno_wrapper" class="col-md-6" hidden>
                                    <label>เลขที่โครงการ/Mini TBP/Full TBP</label>
                                    <input type="text"  name="searchdocno" id="searchdocno" value=""  placeholder="เลขที่โครงการ/Mini TBP/Full TBP" class="form-control" >
                                </div>
                                
                                <div id="registeredcapital_wrapper" class="col-md-6" hidden>
                                    <label>ทุนจดทะเบียน</label><span class="text-danger">*</span>
                                    <select name="searchregisteredcapital" id="searchregisteredcapital" data-placeholder="ทุนจดทะเบียน" class="form-control form-control-select2">
                                        <option value="0000">===เลือก ทุนจดทะเบียน===</option>
                                        @foreach ($registeredcapitals as $registeredcapital)
                                            <option value="{{$registeredcapital->id}}">{{$registeredcapital->detail}}</option> 
                                        @endforeach
                                    </select>
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
                                        <th>ชื่อโครงการ</th> 
                                        <th>บริษัท</th>
                                        <th>สถานะ</th>
                                        {{-- <th>เพิ่มเติม</th> --}}
                                        {{-- <th>Mini TBP</th> 
                                        <th>Full TBP</th> 
                                        <th>เกณฑ์การประเมิน</th> 
                                        <th>เกรด</th>  --}}
                                    </tr>
                                </thead>
                                <tbody id="reportsearch_wrapper">
                                    @foreach ($fulltbps as $fulltbp)
                                    <tr>
                                        <td>  
                                            <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->company->id])}}" class="text-info" target="_blank" >{{$fulltbp->minitbp->project}} </a>  
                                        </td>  
                                        <td>  
                                            <a href="{{route('dashboard.admin.search.company.profile',['id' => $fulltbp->minitbp->businessplan->company->id])}}" class="text-info" target="_blank">{{$fulltbp->minitbp->businessplan->company->name}} </a>  
                                        </td>  
                                        <td>
                                            <span class="badge badge-flat border-success text-success-600">{{$fulltbp->minitbp->businessplan->businessplanstatus->name}}</span> 
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
    </div>
@endsection
@section('pageScript')
<script type="module" src="{{asset('assets/dashboard/js/app/helper/searchprojecthelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

    </script>
@stop