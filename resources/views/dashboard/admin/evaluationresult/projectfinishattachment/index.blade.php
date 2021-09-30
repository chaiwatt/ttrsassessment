@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
{{-- modal_add_bol --}}
<div id="modal_add_bol" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มเอกสารแนบสำหรับผู้ประเมิน</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>ชื่อเอกสาร</label><span class="text-danger">*</span>
							<input type="text" id="docname" placeholder="โปรดระบุชื่อเอกสาร" class="form-control form-control-lg">
						</div>
					</div>
					{{-- <div class="col-md-12">	
						<div class="input-group">													
							<button id="btnaddboldoc" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('boldoc').click();" >อัปโหลด</button>													
						</div>
						<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="boldoc" name="boldoc" accept="image/jpeg,image/gif,image/png,application/pdf"/>
					</div> --}}
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
			</div>
		</div>
	</div>
</div>
    <!-- Page header -->
    <div class="page-header page-header-light">  
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">รายการเอกสารแนบ : {{$fulltbp->minitbp->project}}</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>รายงานผล</a>
                    
                    <a href="{{route('dashboard.admin.evaluationresult')}}" class="breadcrumb-item">รายงานผลการประเมิน</a>
                    <span class="breadcrumb-item active">รายการเอกสารแนบ</span>
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
                        {{-- @if (Auth::user()->user_type_id == 4) --}}
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">เอกสารแนบ (เอกสารที่ต้องการส่งให้ผู้ขอรับการประเมิน เช่น จดหมายแจ้งผล, ตัวอย่าง Certificate หรืออื่นๆ)</h6> 
                        @if (Auth::user()->user_type_id == 4 && @$fulltbp->projectstatustransaction(7)->status != 2)
                            <button type="button" class="btn btn-info btn-icon ml-2 btn-sm hiddenelement" data-toggle="modal" onclick="document.getElementById('attachmentdoc').click();"><i class="icon-add mr-2"></i>อัปโหลด</button> 
                        @endif
                        {{-- <p>(เอกสารที่ต้องการส่งให้ผู้ขอรับการประเมิน เช่น จดหมายแจ้งผล, ตัวอย่าง Certificate หรืออื่นๆ)</p> --}}
                        <input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="attachmentdoc" name="attachmentdoc" accept="image/jpeg,image/gif,image/png,application/pdf"/>
                        
                    
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table style="width: 100%" class="table table-bordered table-striped" id="testtopictable" >
                                <thead>
                                    <tr class="bg-info">
                                        <th style="text-align: center">ชื่อไฟล์</th> 
                                        <th style="text-align: center;width:1%;white-space: nowrap">แสดงที่ผู้ขอรับการประเมิน</th>      
                                        <th style="text-align: center;width:1%;white-space: nowrap">เพิ่มเติม</th>                                  
                                    </tr>
                                </thead>
                                <tbody id="attachment_wrapper_tr">
                                    @foreach ($projectfinishattachments as $key => $projectfinishattachment)
                                        <tr>    
                                            <td> {{$projectfinishattachment->name}} </td> 
                                            <td style="text-align: center"> 
                                                @if ($projectfinishattachment->publicstatus == 0)
                                                     <a href="#" data-id="{{$projectfinishattachment->id}}" data-status="{{$projectfinishattachment->publicstatus}}" data-toggle="modal" class="btn btn-sm bg-warning showattachment" >ยังไม่แสดง</a> 
                                                   @else 
                                                    <a href="#" data-id="{{$projectfinishattachment->id}}" data-status="{{$projectfinishattachment->publicstatus}}" data-toggle="modal" class="btn btn-sm bg-info hideattachment" >แสดงแล้ว</a> 
                                                @endif 
                                            </td> 
                                            <td style="white-space: nowrap;text-align: center"> 
                                                <a href="{{asset($projectfinishattachment->path)}}" class="btn btn-sm bg-primary" target="_blank">ดาวน์โหลด</a>
                                                @if (Auth::user()->user_type_id == 4 && @$fulltbp->projectstatustransaction(7)->status != 2)
                                                <a  data-id="{{$projectfinishattachment->id}}" class="btn btn-sm bg-danger deleteprojectfinishattachment">ลบ</a>  
                                                @endif
                                                                                     
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

    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/projectfinishattachment.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

    </script>
@stop