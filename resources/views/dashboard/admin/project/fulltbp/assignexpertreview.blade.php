@extends('layouts.dashboard.main')
@section('pageCss')

@stop
@section('content')

{{-- modal_add_expert --}}
<div id="modal_add_expert" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มผู้เชี่ยวชาญ</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
                        <div class="form-group">
                            <label>ผู้เชี่ยวชาญ<span class="text-danger">*</span></label>
                            <select id="expert" class="form-control form-control-lg form-control-select2">
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
                                    <textarea name="overview" id="overview" cols="30" rows="15" class="form-control form-control-lg" disabled></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-management">
                                <div class="form-group">
                                    <textarea name="management" id="management" cols="30" rows="15" class="form-control form-control-lg" disabled></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-technology">
                                <div class="form-group">
                                    <textarea name="technology" id="technology" cols="30" rows="15" class="form-control form-control-lg" disabled></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-marketing">
                                <div class="form-group">
                                    <textarea name="marketing" id="marketing" cols="30" rows="15" class="form-control form-control-lg" disabled></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-businessprospect">
                                <div class="form-group">
                                    <textarea name="businessprospect" id="businessprospect" cols="30" rows="15" class="form-control form-control-lg" disabled></textarea>
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

<div id="modal_expert_workload" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;Workload</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
                        <div class="form-group" id="expert_workload_wrapper">
                        </div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				{{-- <button id="btn_modal_add_expert" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button> --}}
			</div>
		</div>
	</div>
</div>
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">มอบหมายผู้เชี่ยวชาญ </span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            @if (Auth::user()->user_type_id != 6 )
                <div class="header-elements d-none">
                    {{-- <a href="#" class="btn btn-labeled btn-labeled-right bg-info" id="sendtojd"><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i>นำส่ง JD</a> --}}
                    {{-- <button id="sendtojd" class="btn bg-teal"><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i>นำส่ง JD<i class="icon-paperplane ml-2"></i></button> --}}
                </div>
            @endif    
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>โครงการ</a>
                    <a href="{{route('dashboard.admin.project.fulltbp')}}" class="breadcrumb-item">แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)</a>
                    <span class="breadcrumb-item active">มอบหมายผู้เชี่ยวชาญ</span>
                </div>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

        </div>
    </div>

    <div id="modal_show_reason" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;สาเหตุการไม่เข้าร่วมโครงการ
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div id="rejectreason_wrapper" style="border-style:dashed;border-width:1px;border-radius:5px;padding:10px;height:150px;width:100%;overflow: auto;"></div>
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                </div>
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
        <form method="POST" action="{{route('dashboard.admin.project.fulltbp.assignexpertreviewsave',['id' => $fulltbp->id])}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="bg-info">
                                            @if ($fulltbp->assignexpert != 2)
                                            <th style="width:15px">เลือก</th>
                                            @endif
                                            
                                            <th >ชื่อ-นามสกุล</th>
                                            <th >ตำแหน่ง</th>
                                            <th >JD มอบหมาย</th>
                                            <th >การตอบรับ</th>
                                            <th >โครงการรับผิดชอบ</th> 
                                            <th >กำลังดำเนินการ</th>    
                                            <th >เสร็จสิ้น</th>
                                        </tr>
                                    </thead>
                                    <tbody id="authorized_director_wrapper_tr"> 
                                        @foreach ($experts as $key => $user)
                                            @php
                                                $check = $user->IsExpert($fulltbp->id);
                                                $isjd = 'expert';
                                                if(Auth::user()->user_type_id !=6 )$isjd = '';
                                            @endphp
                                        <tr >  
                                            @if ($fulltbp->assignexpert != 2)
                                                <td>
                                                    <i class="icon-spinner spinner mr-2" id="spiniconcheck{{$user->id}}" hidden></i>
                                                    <input type="checkbox" name="expert[]" data-id="{{$user->id}}" value="{{$user->id}}"  class="form-check-input-styled {{$isjd}}" data-fouc   
                                                    @if (!Empty($check))
                                                        @if (Auth::user()->user_type_id <=4)
                                                            @if ($check->expert_assignment_status_id == 2)
                                                                hidden
                                                            @endif
                                                            @else
                                                                @if ($check->expert_assignment_status_id == 2 && $check->accepted == 1)
                                                                    hidden
                                                                @endif
                                                        @endif

                                                        checked 
                                                    @endif
                                                    >
                                                </td>  
                                            @endif
                                            @php
                                            $userprefix = $user->prefix->name;
                                            if($userprefix == 'อื่นๆ'){
                                                $userprefix = $user->alter_prefix;
                                            }
                                            @endphp
                                            <td>{{$userprefix}}{{$user->name}} {{$user->lastname}}</td>
                                            <td>
                                                {{$user->usertype->name}} {{$user->expertType}}
                                            </td> 
                                            <td>
                                                @if (!Empty($check))
                                                    @if ($check->expert_assignment_status_id == 1)
                                                        @if (Auth::user()->user_type_id == 6)
                                                           <a  data-id="{{$user->id}}" class="btn btn-sm bg-warning assingexpert"><i class="icon-spinner spinner mr-2" id="btnassign{{$user->id}}" hidden></i>มอบหมาย</a>
                                                        @else
                                                            <span class="badge badge-flat border-warning text-warning-600 rounded-0">ยังไม่ได้มอบหมาย</span>
                                                        @endif
                                                            
                                                    @elseif($check->expert_assignment_status_id == 2)
                                                            <span class="badge badge-flat border-success text-success-600 rounded-0">มอบหมายแล้ว</span>
                                                    @endif
                                                @endif
                                            </td> 
                                            <td>
                                                @if (!Empty($check))
                                                    @if($check->expert_assignment_status_id == 2)
                                                        @if ($check->accepted == 0)
                                                            <span class="badge badge-flat border-warning text-warning-600 rounded-0">ยังไม่ได้ตอบรับ</span>
                                                        @elseif($check->accepted == 1) 
                                                            <span class="badge badge-flat border-success text-success-600 rounded-0">ตอบรับแล้ว</span>
                                                        @elseif($check->accepted == 2)
                                                            <a  data-id="{{$user->id}}" data-fulltbpid="{{$fulltbp->id}}" data-toggle="modal" class="btn btn-sm bg-info showreject">ปฏิเสธเข้าร่วม</a>
                                                        @endif
                                                    @endif
                                                @endif
                                            </td> 
                                            <td>{{$user->projecthandle->count()}}</td>      
                                            <td>{{$user->projecthandle->count()-$user->projecthandle->where('ststus',3)->count()}}</td>  
                                            <td>{{$user->projecthandle->where('ststus',3)->count()}}</td> 
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if (Auth::user()->user_type_id == 4 && $fulltbp->assignexpert != 2)
                            <div class="form-group">
                                <div class="text-right">
                                    <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </div>
                        @endif
                        @if (Auth::user()->user_type_id == 6 && $fulltbp->assignexpert !=2)
                        <div class="form-group">
                            <div class="text-right">
                                <button type="button" id="jdconfirmteam" class="btn bg-teal"><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i>ยืนยันทีมผู้เชี่ยวชาญ <i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </div>
                    @endif

                </div>
    
            </div>
        </form>
 
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

        
    $(document).on('click', '.showreject', function(e) {
        showReject($(this).data('id'),$(this).data('fulltbpid')).then(data => {
            $('#rejectreason_wrapper').html(data);
            $('#modal_show_reason').modal('show');
        })
        
    }); 

    function showReject(id,fulltbpid){
        return new Promise((resolve, reject) => {
            $.ajax({
            url: `${route.url}/api/expert/showreject`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
                'id': id,
                'fulltbpid': fulltbpid
            },
            success: function(data) {
                resolve(data)
            },
            error: function(error) {
                reject(error)
            },
            })
        })
    }

    $(document).on('click', '#jdconfirmteam', function(e) {
        Swal.fire({
            title: 'คำเตือน!',
            text: `ต้องการยืนยันทีมผู้เชี่ยวชาญ หรือไม่`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก',
            closeOnConfirm: false,
            closeOnCancel: false
            }).then((result) => {
            if (result.value) {
                $("#spinicon").attr("hidden",false);
                    jdConfirmExpert("{{$fulltbp->id}}").then(data => {
                        if(data == ''){
                            Swal.fire({
                            title: 'ผิดพลาด...',
                            text: 'ไม่พบข้อมูลผู้เชี่ยวชาญที่ตอบรับ',
                        }).then((result) => {
                            window.location.reload();
                        });
                        }else{
                            window.location.reload();
                        }
                    })
               .catch(error => {})
            }
        });






        
    });
    // 

    function jdConfirmExpert(fulltbpid){
        return new Promise((resolve, reject) => {
            $.ajax({
            url: `${route.url}/api/expert/jdconfirm`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
                'fulltbpid': fulltbpid
            },
            success: function(data) {
                resolve(data)
            },
            error: function(error) {
                reject(error)
            },
            })
        })
    }
    </script>
@stop