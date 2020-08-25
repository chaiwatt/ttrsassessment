@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')

    {{-- modal_add_clustergroup --}}
    <div id="modal_add_clustergroup" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่ม Criteria Weight</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="text" id="assessmentgroupid" value="{{$assessmentgroup->id}}" hidden>
                        <div class="col-md-12">
                            <div class="form-group" id="cluster_wrapper">
                                <label>Cluster<span class="text-danger">*</span></label>
                                <select name="cluster" id="cluster" data-placeholder="Cluster" class="form-control form-control-select2" >
                                </select> 
                            </div>
                            <div class="form-group" id="subcluster_wrapper" hidden>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label>Sub Cluster<span class="text-danger">*</span></label>
                                        <select name="subcluster" id="subcluster" data-placeholder="Sub Cluster" class="form-control form-control-select2" >
                                        </select> 
                                    </div>
                                    <div class="col-md-4">
                                        <label>Weight</label>
                                        <input type="text"  name="subclusterweight" id="subclusterweight" value=""  placeholder="Weight" class="form-control">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group" id="extrafactor_wrapper" hidden>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Extra factor<span class="text-danger">*</span></label>
                                        <select name="extrafactor" id="extrafactor" data-placeholder="Extra factor" class="form-control form-control-select2" multiple >
                                        </select> 
                                    </div>
                                </div>

                            </div>
                            <div id="extrafactor2_wrapper">
                                    
                            </div>
                            
                            <div class="form-group" id="subextrafactor_wrapper" hidden>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>SubExtra factor<span class="text-danger">*</span></label>
                                        <select name="subextrafactor" id="subextrafactor" data-placeholder="Sub Extra factor" class="form-control form-control-select2" multiple>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                            <div id="subextrafactor2_wrapper">
                                    
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_add_clustergroup" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">EV Template: {{$assessmentgroup->name}}</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> การประเมิน</a>
                    <a href="#" class="breadcrumb-item"> EV Template</a>
                    <a href="{{route('setting.admin.assessment.ev')}}" class="breadcrumb-item"> รายการ EV Template</a>
                    <span class="breadcrumb-item active">{{$assessmentgroup->name}}</span>
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
				<!-- Multiple selection -->
				<div class="card">
					<div class="card-body">
                        <div class="form-group">
                            <label>ชื่อรายการ</label>
                            <input type="text"  name="name" id="name" value="{{$assessmentgroup->name}}"  placeholder="ชื่อรายการ" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>เวอร์ชั่น</label>
                            <input type="text" name="version" value="{{$assessmentgroup->version}}"  placeholder="เวอร์ชั่น" class="form-control" readonly>
                        </div>
                        <div class="form-group">	
                            <button type="button" class="btn btn-info  btn-icon ml-2 btn-sm float-right" data-id="" id="btnaddclustergroup" ><i class="icon-add"></i></button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Cluster</th>  
                                        <th>Sub Cluster</th>                                                                                    
                                        <th>Extra Factor</th>       
                                        <th>Sub Extractor</th>  
                                        <th>เพิ่มเติม</th>    
                                    </tr>
                                </thead>
                                <tbody id="cluster_transaction_wrapper_tr">    
                                </tbody>
                            </table>
                        </div>
					</div>
				</div>
				<!-- /multiple selection -->
            <!-- /striped rows -->
            </div>
        </div>
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script type="module" src="{{asset('assets/dashboard/js/app/helper/clusterhelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
    </script>
@stop
