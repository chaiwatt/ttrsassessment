@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')

    {{-- modal_add_clustergroup --}}
    <div id="modal_add_clustergroup" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่ม Criteria</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="text" id="evid" value="{{$ev->id}}" hidden>
                        <form class="wizard-form steps-basic" action="#" data-fouc>
                            <h6>Pillar</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" id="cluster_wrapper">
                                            <select name="pillar" id="pillar" data-placeholder="Pillar" class="form-control form-control-select2" >
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
    
                            <h6>Sub Pillar</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="subpillar" id="subpillar" data-placeholder="Sub Pillar" class="form-control form-control-select2" >
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
    
                            <h6>Index</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="subpillarindex" id="subpillarindex" data-placeholder="Index" class="form-control form-control-select2" >
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">ประเภท Index</label>
                                            <select name="indextype" id="indextype" data-placeholder="Index" class="form-control form-control-select2" >
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="grade_wrapper" hidden>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>เกรด A</label>
                                                        <input type="number" min="0"  id="gradea" value=""  placeholder="ข้อ" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>เกรด B</label>
                                                        <input type="number" min="0"  id="gradeb" value=""  placeholder="ข้อ" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>เกรด C</label>
                                                        <input type="number" min="0" id="gradec" value=""  placeholder="ข้อ" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label>เกรด D</label>
                                                            <input type="number" min="0"  id="graded" value=""  placeholder="ข้อ" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label>เกรด E</label>
                                                            <input type="number" min="0"  id="gradee" value=""  placeholder="ข้อ" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label>เกรด F</label>
                                                            <input type="number" min="0"  id="gradef" value=""  placeholder="ข้อ" class="form-control">
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
    
                            <h6>Criteria</h6>
                            <fieldset>
                                <div class="row" id="criteria_wrapper">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <select name="criteria" id="criteria" data-placeholder="Index" class="form-control form-control-select2" multiple >
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    {{-- </div> --}}
                    <div class="row">
                        <input type="text" id="assessmentgroupid" value="{{$ev->id}}" hidden>
                        <div class="col-md-12">

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
                {{-- <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_add_clustergroup" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">EV Template: {{$ev->name}}</span></h4>
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
                    <span class="breadcrumb-item active">{{$ev->name}}</span>
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
                            <input type="text"  name="name" id="name" value="{{$ev->name}}"  placeholder="ชื่อรายการ" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>เวอร์ชั่น</label>
                            <input type="text" name="version" value="{{$ev->version}}"  placeholder="เวอร์ชั่น" class="form-control" readonly>
                        </div>
                        <div class="form-group">	
                            <button type="button" class="btn btn-info  btn-icon ml-2 btn-sm float-right" data-id="" id="btnaddclustergroup" ><i class="icon-add"></i></button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="criteriatable">
                                <thead>
                                    <tr>
                                        <th>Pillar</th>  
                                        <th>Sub Pillar</th>   
                                        <th>Index</th>                                                                                   
                                        <th>Criteria</th>  
                                        {{-- <th>เพิ่มเติม</th>     --}}
                                    </tr>
                                </thead>
                                <div class="theme_tail theme_tail_circle loadprogress">
                                    <div class="pace_progress" data-progress-text="60%" data-progress="60"></div>
                                    <div class="pace_activity"></div>
                                </div> 
                                <tbody id="criteria_transaction_wrapper_tr"> 
  
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
<script src="{{asset('assets/dashboard/js/plugins/forms/wizards/steps.min.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/evhelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
    </script>
@stop
