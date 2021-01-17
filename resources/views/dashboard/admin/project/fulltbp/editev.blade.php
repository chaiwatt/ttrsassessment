@extends('layouts.dashboard.main')
@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">
@stop
@section('content')
    {{-- modal_add_clustergroup --}}
    <div id="modal_add_clustergroup" class="modal fade " style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่ม Index Criteria</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body context-menu-one" id="criteriamodal">
                    <input type="text" id="evid" value="{{$ev->id}}" hidden>
                    <input type="text" id="fulltbpid" value="{{$ev->fulltbp->id}}" hidden>
                        <form class="wizard-form steps-basic " action="#" data-fouc>
                            <h6>Pillar</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" id="cluster_wrapper">
                                            <select name="pillar" id="pillar" data-placeholder="Pillar" class="form-control form-control-lg form-control-select2" >
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
                                            <select name="subpillar" id="subpillar" data-placeholder="Sub Pillar" class="form-control form-control-lg form-control-select2" >
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
                                            <select name="subpillarindex" id="subpillarindex" data-placeholder="Index" class="form-control form-control-lg form-control-select2" >
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">ประเภท Index</label>
                                            <select name="indextype" id="indextype" data-placeholder="Index" class="form-control form-control-lg form-control-select2" >
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
                                                        <input type="text" min="0"  id="gradea" value=""  placeholder="ข้อ" class="form-control form-control-lg numeralformat2" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>เกรด B</label>
                                                        <input type="text" min="0"  id="gradeb" value=""  placeholder="ข้อ" class="form-control form-control-lg numeralformat2">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>เกรด C</label>
                                                        <input type="text" min="0" id="gradec" value=""  placeholder="ข้อ" class="form-control form-control-lg numeralformat2">
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
                                                            <input type="text" min="0"  id="graded" value=""  placeholder="ข้อ" class="form-control form-control-lg numeralformat2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label>เกรด E</label>
                                                            <input type="text" min="0"  id="gradee" value=""  placeholder="ข้อ" class="form-control form-control-lg numeralformat2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label>เกรด F</label>
                                                            <input type="text" min="0"  id="gradef" value=""  placeholder="ข้อ" class="form-control form-control-lg numeralformat2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
    
                            <h6>Criteria</h6>
                            <fieldset>
                                <div class="row" id="criteria_wrapper">
                                    {{-- <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <select name="criteria" id="criteria" data-placeholder="Index" class="form-control form-control-lg form-control-select2" multiple >
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-12 mb-3">
                                        <div class="row" id="chklist">
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
                                        <select name="subcluster" id="subcluster" data-placeholder="Sub Cluster" class="form-control form-control-lg form-control-select2" >
                                        </select> 
                                    </div>
                                    <div class="col-md-4">
                                        <label>Weight</label>
                                        <input type="text"  name="subclusterweight" id="subclusterweight" value=""  placeholder="Weight" class="form-control form-control-lg">
                                    </div>
                                </div>
                            </div>
                            

                            <div class="form-group" id="extrafactor_wrapper" hidden>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Extra factor<span class="text-danger">*</span></label>
                                        <select name="extrafactor" id="extrafactor" data-placeholder="Extra factor" class="form-control form-control-lg form-control-select2" multiple >
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
                                        <select name="subextrafactor" id="subextrafactor" data-placeholder="Sub Extra factor" class="form-control form-control-lg form-control-select2" multiple>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                            <div id="subextrafactor2_wrapper">
                                    
                            </div>
                            
                        </div>
                        <div id="relateev"></div>
                    </div>
                </div>           
                {{-- <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_add_clustergroup" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
                </div> --}}
            </div>
        </div>
    </div>
    
    <div id="modal_add_extracriteria" class="modal fade " style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่ม Extra Criteria</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body context-menu-one" id="extracriteriamodal">
                    {{-- <input type="text" id="evid" value="{{$ev->id}}" hidden> --}}
                    {{-- <input type="text" id="fulltbpid" value="{{$ev->fulltbp->id}}" hidden> --}}
                        <form class="wizard-form steps-basic-extra" action="#" data-fouc>
                            <h6>Pillar</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" id="extra_criteria_wrapper">
                                            <select name="extrapillar" id="extrapillar" data-placeholder="Pillar" class="form-control form-control-lg form-control-select2" >
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
                                            <select name="extrasubpillar" id="extrasubpillar" data-placeholder="Sub Pillar" class="form-control form-control-lg form-control-select2" >
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
                                            <select name="extrasubpillarindex" id="extrasubpillarindex" data-placeholder="Index" class="form-control form-control-lg form-control-select2" >
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">ประเภท Indexfff</label>
                                            <select name="indextype" id="indextype" data-placeholder="Index" class="form-control form-control-lg form-control-select2" >
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="row" id="grade_wrapper">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>เกรด A</label>
                                                        <input type="number" min="0"  id="gradea" value=""  placeholder="ข้อ" class="form-control form-control-lg" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>เกรด B</label>
                                                        <input type="number" min="0"  id="gradeb" value=""  placeholder="ข้อ" class="form-control form-control-lg">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>เกรด C</label>
                                                        <input type="number" min="0" id="gradec" value=""  placeholder="ข้อ" class="form-control form-control-lg">
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
                                                            <input type="number" min="0"  id="graded" value=""  placeholder="ข้อ" class="form-control form-control-lg">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label>เกรด E</label>
                                                            <input type="number" min="0"  id="gradee" value=""  placeholder="ข้อ" class="form-control form-control-lg">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label>เกรด F</label>
                                                            <input type="number" min="0"  id="gradef" value=""  placeholder="ข้อ" class="form-control form-control-lg">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </fieldset>
    
                        </form>
                    {{-- </div> --}}
  
                </div>           
                {{-- <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_add_clustergroup" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
                </div> --}}
            </div>
        </div>
    </div>

    {{-- modal_exisingev --}}
    <div id="modal_exisingev" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;EV ในระบบ</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="criteriatable_modal">
                            <thead>
                                <tr>
                                    <th>Pillar</th>  
                                    <th>Sub Pillar</th>   
                                    <th>Index</th>                                                                                   
                                    <th>Criteria</th>  
                                </tr>
                            </thead>
                            <tbody id="criteria_transaction_modal_wrapper_tr"> 

                            </tbody>
                        </table>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_exisingev" class="btn bg-primary" data-dismiss="modal"><i class="icon-copy3 font-size-base mr-1"></i> คัดลอก</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal_additem --}}
    <div id="modal_additem" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มรายการ Index</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{-- <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                        <li class="list-inline-item text-muted"><span id="parent"></span></li>
                        <li class="list-inline-item text-muted"><span id="clientname"></span></li>
                    </ul> --}}
                    <div class="form-group">
                        <label>ชื่อรายการ</label>
                        <input type="text"  name="name" id="name" value=""  placeholder="ชื่อรายการ" class="form-control form-control-lg">
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_additem" class="btn bg-info" data-dismiss="modal"><i class="icon-add font-size-base mr-1"></i> เพิ่ม</button>
                </div>
            </div>
        </div>
    </div>

        {{-- modal_addextraitem --}}
        <div id="modal_addextraitem" class="modal fade" style="overflow:hidden;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มรายการ Extra</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ชื่อรายการ</label>
                            <input type="text"  name="extraitemname" id="extraitemname" value=""  placeholder="ชื่อรายการ" class="form-control form-control-lg">
                        </div>
                    </div>           
                    <div class="modal-footer">
                        <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                        <button id="btn_modal_addextraitem" class="btn bg-info" data-dismiss="modal"><i class="icon-add font-size-base mr-1"></i> เพิ่ม</button>
                    </div>
                </div>
            </div>
        </div>

    {{-- modal_edit_weight --}}
    <div id="modal_edit_weight" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;แก้ไข Weight</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="text" id="subpillarindexid" hidden >
                    <div class="form-group">
                        <label>ค่า Weight</label>
                        <input type="number"  name="weight" id="weight" value=""  placeholder="ค่า Weight" class="form-control form-control-lg">
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_edit_weight" class="btn bg-info" data-dismiss="modal"><i class="icon-add font-size-base mr-1"></i> เพิ่ม</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal_add_comment" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มความเห็น</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Comment<span class="text-danger">*</span></label>
                            <textarea type="text" rows="5" id="comment" placeholder="ข้อความเพิ่มเติมแจ้ง Leader" class="form-control form-control-lg" ></textarea>
                        </div>
                    </div>
                </div>         
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_add_comment" class="btn bg-primary" ><i class="icon-spinner spinner mr-2" id="addcommentspinicon" hidden></i><i class="icon-checkmark3 font-size-base mr-1"></i> บันทึก</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">EV Template: {{$ev->name}}
                @if ($ev->status != 0)
                  <span class="text-success">(นำส่งแล้ว)</span> 
                @endif
                
                </span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    {{-- @if ($ev->status <= 1) --}}
                        {{-- <div class="form-check ">
                            <i class="icon-spinner spinner mr-2" id="spinicon" hidden></i><input type="checkbox" id="chkevstatus" data-id="{{$ev->id}}" data-on-color="success" data-off-color="danger" data-on-text="ส่งแล้ว" data-off-text="ยังไม่ได้ส่ง" class="form-check-input-switch" @if ($ev->status != 0) checked @endif >
                        </div>      --}}
                    {{-- @endif --}}
                </div>
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
                <div class="card">
					<div class="card-body">
                        {{-- <input type="text" id="evstatus" value="{{$ev->status}}" hidden> --}}
                        {{-- <div class="text-right">
                            <button id="editev" class="btn bg-primary">แก้ไขข้อมูล<i class="icon-floppy-disk ml-2"></i></button>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-6">	
                                <div class="form-group">
                                    <label>ชื่อ EV</label>
                                    <input type="text"  id="evname" value="{{$ev->name}}"  placeholder="ชื่อ EV เช่น ttrs.01" @if ($ev->status == 1 || $ev->refixstatus != 0) readonly @endif class="form-control form-control-lg">
                                </div>
                            </div>
                            <div class="col-md-6">	
                                <div class="form-group">
                                    <label>เวอร์ชั่น</label>
                                    <input type="text" id="version" value="{{$ev->version}}"  placeholder="เวอร์ชั่น" @if ($ev->status == 1 || $ev->refixstatus != 0) readonly @endif class="form-control form-control-lg">
                                </div>
                            </div>
                            <div class="col-md-6">	
                                <div class="form-group">
                                    <label>เปอร์เซนต์ Index</label>
                                    <input type="text" id="percentindex" value="{{$ev->percentindex}}"  placeholder="เปอร์เซนต์ Index" @if ($ev->status == 1 || $ev->refixstatus != 0) readonly @endif class="form-control form-control-lg">
                                </div>
                            </div>
                            <div class="col-md-6">	
                                <div class="form-group">
                                    <label>เปอร์เซนต์ Extra</label>
                                    <input type="text" id="percentextra" value="{{$ev->percentextra}}"  placeholder="เปอร์เซนต์ Extra" @if ($ev->status == 1 || $ev->refixstatus != 0) readonly @endif class="form-control form-control-lg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- Multiple selection -->
				<div class="card">
					<div class="card-body">
                        <input type="text" id="tmpstepindex" value="0" hidden>
                        <div class="text-right">
                            @if (($ev->status == 0 || $ev->refixstatus == 1) && Auth::user()->user_type_id != 6)
                                <button id="updateev" data-id="{{$ev->id}}" class="btn bg-teal"><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i>นำส่ง JD<i class="icon-paperplane ml-2"></i></button>
                            @endif
                            @if (($ev->status == 1 || $ev->refixstatus == 1))
                                @if (Auth::user()->user_type_id == 6)
                                    <button id="approveevstageone" data-id="{{$ev->id}}" class="btn bg-teal"><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i>อนุมัติ EV<i class="icon-paperplane ml-2"></i></button>
                                @endif
                            @endif
                            {{--  <i class="icon-spinner spinner mr-2" id="spinicon" hidden></i><input type="checkbox" id="chkevstatus" data-id="{{$ev->id}}" data-on-color="success" data-off-color="danger" data-on-text="ส่งแล้ว" data-off-text="ยังไม่ได้ส่ง" class="form-check-input-switch" @if ($ev->status != 0) checked @endif > --}}
                        </div>
                        <div class="form-group">
                            <label>EV ในระบบ</label>
                            <select name="existingev" id="existingev" placeholder="EV ในระบบ" class="form-control form-control-lg form-control-select2">
                                <option value="0">==เลือกจาก EV ในระบบ==</option>
                                @foreach ($evs as $_ev)
                                    <option value="{{$_ev->id}}" >
                                        {{$_ev->name}}
                                        @if (Empty($_ev->fulltbp))
                                            (Template)
                                            @else
                                            ({{$_ev->fulltbp->minitbp->project}})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <ul class="nav nav-tabs nav-tabs-highlight ">
                            <li class="nav-item"><a href="#indextab" class="nav-link active" data-toggle="tab"><i class="icon-menu7 mr-2"></i>Index Criteria</a></li>
                            <li class="nav-item"><a href="#extratab" class="nav-link" data-toggle="tab"><i class="icon-mention mr-2"></i>Extra Criteria</a></li>
                            @if ($evedithistories->count() > 0 || Auth::user()->user_type_id == 6)
                            <li class="nav-item"><a href="#commenttab" class="nav-link" data-toggle="tab"><i class="icon-bubble-dots4 mr-2"></i>JD Comment @if ($evcommenttabs->count() > 0) <span class="badge badge-warning badge-pill mr-2">ใหม่</span> @endif </a></li>
                            @endif
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="indextab">
                                <div class="form-group">	
                                    @if ($ev->status == 0 || $ev->refixstatus == 1)
                                        <button type="button" class="btn btn-info btn-icon ml-2 btn-sm float-right mb-2" data-id="" id="btnaddclustergroup" ><i class="icon-add"></i></button>
                                    @endif
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="criteriatable">
                                        <thead>
                                            <tr class="bg-info">
                                                <th>Pillar</th>  
                                                <th>Sub Pillar</th>   
                                                <th>Index</th>                                                                                
                                                <th>Criteria</th>  
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

                            <div class="tab-pane fade" id="extratab">
                                <div class="form-group">	
                                    @if ($ev->status == 0 || $ev->refixstatus == 1)
                                    <button type="button" class="btn btn-info btn-icon ml-2 btn-sm float-right mb-2" data-id="" id="btnaddextracriteria" ><i class="icon-add"></i></button>
                                    @endif
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="extracriteriatable">
                                        <thead>
                                            <tr class="bg-info">
                                                <th>Pillar</th>  
                                                <th>Sub Pillar</th>   
                                                <th>Index</th>                                                                                
                                                <th>Criteria</th>  
                                            </tr>
                                        </thead>
                                        <div class="theme_tail theme_tail_circle loadprogress">
                                            <div class="pace_progress" data-progress-text="60%" data-progress="60"></div>
                                            <div class="pace_activity"></div>
                                        </div> 
                                        <tbody id="extra_criteria_transaction_wrapper_tr"> 
          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="commenttab">
                                @if (Auth::user()->user_type_id == 6)
                                <div class="form-group">	
                                    <a href="" class="btn btn-info btn-icon ml-2 btn-sm float-right"  data-toggle="modal" data-target="#modal_add_comment"><i class="icon-add"></i></a>
                                    <br>
                                </div>
                                @endif

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="criteriatable">
                                        <thead>
                                            <tr class="bg-info">
                                                <th>วันที่</th>  
                                                <th>รายละเอียด</th>   
                                                @if (Auth::user()->user_type_id == 6)
                                                    <th>เพิ่มเติม</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody id="ev_edit_history_wrapper_tr"> 
                                            @foreach ($evedithistories->reverse() as $evedithistory)
                                            <tr>
                                                <td>{{$evedithistory->thaidate}}</td>
                                                <td>{{$evedithistory->detail}}</td>
                                                @if (Auth::user()->user_type_id == 6)
                                                <td><a href="#" type="button" data-id="{{$evedithistory->id}}" class="btn btn-sm bg-danger deletecomment">ลบ</a></td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
<script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.ui.position.js"></script>
<script src="{{asset('assets/dashboard/js/plugins/forms/wizards/steps.min.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/fulltbpevhelper.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/inputformat.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            usertypeid: "{{Auth::user()->user_type_id}}"
        };

    </script>
@stop
