@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
{{-- modal_edit_fulltbp --}}
<div id="modal_edit_fulltbp" class="modal fade" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;การอนุมัติ Full TBP</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="text" id="fulltbpid" hidden>
                    <form id="my_radio_box">
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-input-styled" name="result" value="1" checked data-fouc>
                                    ผ่านการอนุมัติ
                                </label>
                            </div>
        
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-input-styled" name="result" value="2" data-fouc>
                                    ไม่การอนุมัติ/ให้แก้ไข
                                </label>
                            </div>
                        </div>
                    </form>

                    <hr>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>ข้อความเพิ่มเติม<span class="text-danger">*</span></label>
                            <textarea type="text" rows="5"  id="note" placeholder="ข้อความเพิ่มเติม แจ้งไปยังผู้ประกอบการ" class="form-control" readonly></textarea>
                        </div>
                    </div>
                </div>
            </div>           
            <div class="modal-footer">
                <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                <button id="btn_modal_edit_fulltbp" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> บันทึก</button>
            </div>
        </div>
    </div>
</div>
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">รายการ Full TBP </span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <a href="#" class="breadcrumb-item"> FullTBP</a>
                    <span class="breadcrumb-item active">รายการ FullTBP</span>
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
                        <h6 class="card-title">รายการ Full TBP</h6>
                        <div class="header-elements">
                            <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                {{-- <i class="icon-calendar3 mr-2"></i> --}}
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="testtopictable">
                                <thead>
                                    <tr>
                                        {{-- <th style="width:50px">#</th> --}}
                                        <th>วันที่ขอส่ง</th> 
                                        <th>เลขที่โครงการ</th> 
                                        <th>ชื่อโครงการ</th> 
                                        <th>บริษัท</th>
                                        <th>การอนุมัติ</th> 
                                        <th>เกณฑ์การประเมิน</th> 
                                        <th>ผู้เชี่ยวชาญ</th> 
                                        <th>เพิ่มเติม</th> 
                                                                  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fulltbps as $key => $fulltbp)
                                    <tr>    
                                        {{-- <td> {{$key+1}} </td> --}}
                                        <td> {{$fulltbp->updatedatth}} </td> 
                                        <td> {{$fulltbp->minitbp->businessplan->code}} </td> 
                                        <td> {{$fulltbp->minitbp->project}} </td>  
                                        <td> {{$fulltbp->minitbp->businessplan->company->name}} </td>
                                        <td>    
                                            @if ($fulltbp->minitbp->businessplan->business_plan_status_id > 5 )
                                                    <a href="#" type="button" data-id="{{$fulltbp->id}}" class="badge badge-flat border-success text-success-600">ผ่านการอนุมัติ</a>
                                                @else
                                                    <a href="#" type="button" data-id="{{$fulltbp->id}}" id="editapprove" class="btn-sm bg-warning"><i class="icon-spinner spinner mr-2" id="spinicon{{$fulltbp->id}}" hidden></i>ยังไม่ได้อนุมัติ</a>
                                            @endif
                                        </td>  
                                        <td> 
                                            @if (!Empty($fulltbp->criteria_group_id))
                                                    <a type="button" href="{{route('dashboard.admin.project.fulltbp.assigngroup',['id' => $fulltbp->id])}}" class="btn-sm bg-success">เพิ่มแล้ว</a>
                                                @else
                                                    <a type="button" href="{{route('dashboard.admin.project.fulltbp.assigngroup',['id' => $fulltbp->id])}}" class="btn-sm bg-warning">ยังไม่ได้เพิ่ม</a>
                                            @endif
                                             
                                        </td> 
                                        <th> 
                                            @if ($fulltbp->assignexpert == '2')
                                                    <a type="button" href="{{route('dashboard.admin.project.fulltbp.assignexpert',['id' => $fulltbp->id])}}" class="btn-sm bg-success">มอบหมายแล้ว</a>
                                                @else
                                                    <a type="button" href="{{route('dashboard.admin.project.fulltbp.assignexpert',['id' => $fulltbp->id])}}" class="btn-sm bg-warning">ยังไม่ได้มอบหมาย</a>
                                            @endif
                                        </th> 
                                        <td> 
                                            <a type="button" href="{{asset($fulltbp->file)}}" class="btn-sm bg-teal">ดาวน์โหลด</a>
                                            <a type="button" href="{{route('dashboard.admin.project.fulltbp.view',['id' => $fulltbp->id])}}" class="btn-sm bg-primary">รายละเอียด</a>
                                            <a type="button" href="{{route('dashboard.admin.project.fulltbp.delete',['id' => $fulltbp->id])}}" data-name="" onclick="confirmation(event)" class="btn-sm bg-danger">ลบ</a>                                       
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
<script type="module" src="{{asset('assets/dashboard/js/app/helper/approvefulltbphelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
    </script>
@stop