@extends('layouts.dashboard.main')
@section('pageCss')

@stop
@section('content')

{{-- modal_add_expert --}}
<div id="modal_add_expert" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มประวัติการศึกษา</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
                        <div class="form-group">
                            <label>ผู้เชี่ยวชาญ<span class="text-danger">*</span></label>
                            <select id="expert" class="form-control form-control-select2">
                                <option value="">==เลือกผู้เชี่ยวชาญ==</option>
                                @foreach ($experts as $expert)
                                    <option value="{{$expert->id}}" >{{$expert->name}} {{$expert->lastname}}</option> 
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="assignedproject">
                        </div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_expert" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
			</div>
		</div>
	</div>
</div>
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">มอบหมายผู้เชี่ยวชาญ </span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <a href="#" class="btn btn-labeled btn-labeled-right bg-info" id="sendtojd">ส่งต่อ JD<b><i class="icon-redo2"></i></b></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <a href="#" class="breadcrumb-item"> Full-TBP</a>
                    <a href="{{route('dashboard.admin.project.fulltbp')}}" class="breadcrumb-item"> รายการ Full-TBP</a>
                    <span class="breadcrumb-item active">{{$fulltbp->minitbp->project}}</span>
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
                        <div class="form-group">	
                            <a href="" class="btn btn-info btn-icon ml-2 btn-sm float-right"  data-toggle="modal" data-target="#modal_add_expert"><i class="icon-add"></i></a>
                            <br>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th >ชื่อ-สกุล</th> 
                                        @if (Auth::user()->user_type_id == 7 )
                                            <th>การรับมอบหมาย</th> 
                                        @endif     
                                        <th>สถานะ</th> 
                                        <th>เพิ่มเติม</th>                                                                 
                                    </tr>
                                </thead>
                                <tbody id="expert_wrapper">
                                    @foreach ($expertassignments as $key => $expertassignment)
                                    <tr>    
                                        <td class='userid' data-id='{{$expertassignment->user->id}}'> {{$expertassignment->user->name}} {{$expertassignment->user->lastname}}</td> 
                                        @if (Auth::user()->user_type_id == 7 )
                                            <td> <input type="checkbox" data-id="{{$expertassignment->id}}" class="form-check assignexpert" @if ($expertassignment->expert_assignment_status_id == 2) checked @endif></td> 
                                        @endif
                                        <td> {{$expertassignment->expertassignmentstatus->name}}</td> 
                                        <td> 
                                            <button type="button" data-id="{{$expertassignment->id}}" class="btn badge bg-danger deleteexpert">ลบ</button>                                       
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
        <div class="loader loader-default" data-text="กำลังบันทึก..."></div>
    </div>

    <!-- /content area -->
@endsection
@section('pageScript')
    <script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/plugins/forms/styling/switchery.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/app/helper/assignexperthelper.js')}}"></script>
    <script>
        var route = {
            url: "{{url('/')}}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}",
            usertypeid: "{{Auth::user()->user_type_id}}",
            fulltbpid: "{{$fulltbp->id}}",
        };


 
    </script>
@stop