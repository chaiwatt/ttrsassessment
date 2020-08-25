@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <div id="modal_edit_minitbp" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;การอนุมัติ mini TBP</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="text" id="minitbpid" hidden>
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
                                        ไม่อนุมัติ/ให้แก้ไข
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
                    <button id="btn_modal_edit_minitbp" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> บันทึก</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page header -->
    <div class="page-header page-header-light">  
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">รายการ mini TBP</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <a href="#" class="breadcrumb-item"> mini TBP</a>
                    <span class="breadcrumb-item active">รายการ mini TBP</span>
                </div>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>


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
                        <h6 class="card-title">รายการขอรับการประเมิน</h6>
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
                                        <th style="width:50px">#</th>
                                        <th>วันที่ขอส่ง</th> 
                                        <th>เลขที่โครงการ</th> 
                                        <th>ชื่อโครงการ</th> 
                                        <th>บริษัท</th>
                                        <th>การอนุมัติ</th> 
                                        <th >เพิ่มเติม</th>                                  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($minitbps as $key => $minitbp)
                                    <tr>    
                                        <td> {{$key+1}} </td>
                                        <td> {{$minitbp->updatedatth}} </td> 
                                        <td> {{$minitbp->businessplan->code}} </td> 
                                        <td> {{$minitbp->project}} </td>  
                                        <td> {{$minitbp->businessplan->company->name}} </td> 
                                        <td> 
                                            @if ($minitbp->businessplan->business_plan_status_id > 3)
                                                    <a href="#"  data-id="{{$minitbp->id}}" class="badge badge-flat border-success text-success-600">ผ่านการอนุมัติ</a>
                                                @else
                                                <a href="#" data-id="{{$minitbp->id}}" id="editapprove" class="btn-sm bg-warning"><i class="icon-spinner spinner mr-2" id="spinicon{{$minitbp->id}}" hidden></i>ยังไม่ได้อนุมัติ</a>
                                            @endif
                                        </td> 
                                        <td> 
                                            <a href="{{asset($minitbp->attachment)}}" class="btn-sm bg-teal">ดาวน์โหลด</a>
                                            <a href="{{route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id])}}" class="btn-sm bg-primary">รายละเอียด</a>
                                            <a href="{{route('dashboard.admin.project.minitbp.delete',['id' => $minitbp->id])}}" data-name="" onclick="confirmation(event)" class="btn-sm bg-danger">ลบ</a>                                       
                                        </td>                                
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>      
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /form layouts -->

    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/approveminitbphelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
    </script>
@stop