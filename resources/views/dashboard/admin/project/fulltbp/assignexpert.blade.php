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

{{-- modal_expert_comment --}}
<div id="modal_expert_comment" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ความคิดเห็นผู้เชี่ยวชาญ</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
                        <ul class="nav nav-tabs nav-tabs-highlight">
                            <li class="nav-item"><a href="#left-icon-overview" class="nav-link active" data-toggle="tab"><i class="icon-magic-wand2 mr-2"></i>Overview</a></li>
                            <li class="nav-item"><a href="#left-icon-management" class="nav-link" data-toggle="tab"><i class="icon-stamp mr-2"></i>Management</a></li>
                            <li class="nav-item"><a href="#left-icon-technology" class="nav-link" data-toggle="tab"><i class="icon-atom2 mr-2"></i>Technology</a></li>
                            <li class="nav-item"><a href="#left-icon-marketing" class="nav-link" data-toggle="tab"><i class="icon-stats-growth mr-2"></i>Marketing</a></li>
                            <li class="nav-item"><a href="#left-icon-businessprospect" class="nav-link" data-toggle="tab"><i class="icon-pie-chart5 mr-2"></i>Business Prospect</a></li>
                            {{-- <li class="nav-item"><a href="#left-icon-attachment" class="nav-link" data-toggle="tab"><i class="icon-attachment mr-2"></i>ไฟล์แนบ</a></li> --}}
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="left-icon-overview">
                                <div class="form-group">
                                    <textarea name="overview" id="overview" cols="30" rows="15" class="form-control" disabled></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-management">
                                <div class="form-group">
                                    <textarea name="management" id="management" cols="30" rows="15" class="form-control" disabled></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-technology">
                                <div class="form-group">
                                    <textarea name="technology" id="technology" cols="30" rows="15" class="form-control" disabled></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-marketing">
                                <div class="form-group">
                                    <textarea name="marketing" id="marketing" cols="30" rows="15" class="form-control" disabled></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-businessprospect">
                                <div class="form-group">
                                    <textarea name="businessprospect" id="businessprospect" cols="30" rows="15" class="form-control" disabled></textarea>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				{{-- <button id="btn_modal_expert_comment" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button> --}}
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
            @if (Auth::user()->user_type_id != 6 )
                <div class="header-elements d-none">
                    <a href="#" class="btn btn-labeled btn-labeled-right bg-info" id="sendtojd"><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i>ส่งต่อ JD<b><i class="icon-redo2"></i></b></a>
                </div>
            @endif    
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
                                        @if (Auth::user()->user_type_id == 6 )
                                            <th>การรับมอบหมาย</th> 
                                        @endif     
                                        <th>สถานะ</th> 
                                        <th>การตอบรับ</th> 
                                        <th>ความคิดเห็น</th> 
                                        <th>เพิ่มเติม</th>                                                                 
                                    </tr>
                                </thead>
                                <tbody id="expert_wrapper">
                                    @foreach ($expertassignments as $key => $expertassignment)
                                    <tr>    
                                        <td class='userid' data-id='{{$expertassignment->user->id}}'> {{$expertassignment->user->name}} {{$expertassignment->user->lastname}}</td> 
                                        @if (Auth::user()->user_type_id == 6 )
                                            <td> <i class="icon-spinner spinner mr-2" id="spiniconcheck{{$expertassignment->id}}" hidden></i><input type="checkbox" data-id="{{$expertassignment->id}}" class="form-check assignexpert" @if ($expertassignment->expert_assignment_status_id == 2) checked @endif></td> 
                                        @endif
                                        <td> {{$expertassignment->expertassignmentstatus->name}}</td> 
                                        <td> 
                                            @if ($expertassignment->accepted == 0)
                                                   <span class="badge badge-flat border-info text-info-600">ยังไม่ได้ตอบรับ</span> 
                                                @elseif($expertassignment->accepted == 1)
                                                    <span class="badge badge-flat border-success text-success-600">ตอบรับการเข้าร่วมแล้ว</span> 
                                                @elseif($expertassignment->accepted == 2)
                                                    <span class="badge badge-flat border-danger text-danger-600">ปฎิเสธการเข้าร่วม</span>   
                                            @endif
                                        </td> 
                                        <td>
                                            @if (!Empty($expertassignment->expertcomment))
                                                <button type="button" data-id="{{$expertassignment->id}}" class="btn btn-sm bg-info expertcomment">ความเห็น</button>                                                                           
                                            @endif  
                                        </td>
                                        <td> 
                                            <button type="button" data-id="{{$expertassignment->id}}" class="btn btn-sm bg-danger deleteexpert">ลบ</button>                                       
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