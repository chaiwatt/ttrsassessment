@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">ผู้รับการประเมิน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ค้นหา</a>
                    <span class="breadcrumb-item active">ผู้รับการประเมิน</span>
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
                                        <select name="searchgroup" id="searchgroup" data-placeholder="ประเภทการค้นหา" class="form-control form-control-lg form-control-select2">
                                            {{-- <option value="0000">===เลือก รายการ===</option> --}}
                                            <option value="1">ชื่อโครงการ</option>
                                            <option value="2">ชื่อบริษัท</option>
                                            <option value="3">ทุนจดทะเบียน</option>
                                            <option value="4">กลุ่มอุตสาหกรรม</option>
                                            <option value="5">รหัส ISIC</option>
                                        </select>
                                    </div>
                                </div>      
                                <div id="searchindustrygroup_wrapper" class="col-md-6" hidden>
                                    <label>กลุ่มอุตสาหกรรม</label><span class="text-danger">*</span>
                                    <select name="searchindustrygroup" id="searchindustrygroup" data-placeholder="กลุ่มอุตสาหกรรม" class="form-control form-control-lg form-control-select2">
                                        <option value="0000">===เลือก กลุ่มอุตสาหกรรม===</option>
                                        @foreach ($industrygroups as $industrygroup)
                                            <option value="{{$industrygroup->id}}">{{$industrygroup->name}}</option> 
                                        @endforeach
                                    </select>
                                </div>        
                                <div id="isic_wrapper" class="col-md-6" hidden>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>ISIC</label><span class="text-danger">*</span>
                                            <select name="isic" id="isic" data-placeholder="ISIC" class="form-control form-control-lg form-control-select2">
                                                <option value="0000">===เลือก ISIC===</option>
                                                @foreach ($isics as $isic)
                                                    <option value="{{$isic->id}}">{{$isic->name}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="mt-3">หมวดหมู่ย่อย</label><span class="text-danger">*</span>
                                            <select name="searchisic" id="searchisic" data-placeholder="หมวดหมู่ย่อย" class="form-control form-control-lg form-control-select2 ">

                                            </select>
                                        </div>
                                    </div>
                              
                                </div>                    
                                <div id="searchcompanyname_wrapper" class="col-md-6" hidden>
                                    <label>ชื่อบริษัท</label>
                                    <input type="text"  name="searchcompanyname" id="searchcompanyname" value=""  placeholder="ชื่อบริษัท" class="form-control form-control-lg" >
                                </div>  
                                <div id="searchprojectname_wrapper" class="col-md-6" >
                                    <label>ชื่อโครงการ</label>
                                    <input type="text"  name="searchprojectname" id="searchprojectname" value=""  placeholder="ชื่อโครงการ" class="form-control form-control-lg" >
                                </div>     
                                <div id="registeredcapital_wrapper" class="col-md-6" hidden>
                                    <label>ทุนจดทะเบียน</label><span class="text-danger">*</span>
                                    <select name="searchregisteredcapital" id="searchregisteredcapital" data-placeholder="ทุนจดทะเบียน" class="form-control form-control-lg form-control-select2">
                                        <option value="0000">===เลือก ทุนจดทะเบียน===</option>
                                        @foreach ($registeredcapitals as $registeredcapital)
                                            <option value="{{$registeredcapital->id}}">{{$registeredcapital->detail}}</option> 
                                        @endforeach
                                    </select>
                                </div> 
                                <div id="searchword_wrapper" class="col-md-6" hidden>
                                    <label>คำค้น</label>
                                    <input type="text"  name="searchword" id="searchword" value=""  placeholder="คำค้น" class="form-control form-control-lg" >
                                </div>

                                <div id="soundex_wrapper" class="col-md-12"  >
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="sounddex" id="sounddex" class="form-check-input-styled-primary"  data-fouc>
                                            ค้นหา soundex <small><span id="soundex_res"></span></small>
                                        </label>
                                    </div>
                                
                                </div>  
                                <div class="col-md-12" >
                                    <div class="text-right">
                                        <button type="button" id="btnsearch" class="btn bg-teal">ค้นหา <i class="icon-search4 ml-2"></i></button>
                                    </div>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">รายการผู้รับการประเมิน</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="bg-info">
                                        <th style="text-align: center">บริษัท</th>
                                        <th style="text-align: center">ชื่อโครงการ</th> 
                                    </tr>
                                </thead>
                                <tbody id="reportsearch_wrapper">
                                    @foreach ($fulltbps as $fulltbp)
                                    <tr>
                                        <td>
                                            <a  href="{{route('dashboard.admin.search.company.profile',['id' => $fulltbp->minitbp->businessplan->company->id])}}" class="text-info" target="_blank">{{$fulltbp->minitbp->businessplan->company->name}} </a>
                                        </td> 
                                        <td>
                                            <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="text-info" target="_blank" >{{$fulltbp->minitbp->project}} </a>  
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
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/searchcompanyhelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

    </script>
@stop