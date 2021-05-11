@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
{{-- modal_add_bol --}}
<div id="modal_add_bol" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มเอกสาร BOL</h5>
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
					<div class="col-md-12">	
						<div class="input-group">													
							<button id="btnaddboldoc" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('boldoc').click();" >อัปโหลด</button>													
						</div>
						<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="boldoc" name="boldoc" accept="application/pdf"/>
					</div>
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
                <h4> <span class="font-weight-semibold">รายการเอกสาร BOL : {{$fulltbp->minitbp->project}}</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>โครงการ</a>
                    
                    <a href="{{route('dashboard.admin.project.fulltbp')}}" class="breadcrumb-item">แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)</a>
                    <span class="breadcrumb-item active">รายการเอกสาร BOL</span>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">เอกสาร BOL </h6> @if (Auth::user()->user_type_id == 4)<button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement" data-toggle="modal" data-target="#modal_add_bol"><i class="icon-add mr-2"></i>อัปโหลด</button> @endif
                        {{-- @endif --}}
                        
                    
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th>ชื่อไฟล์</th> 
                                        <th style="width:20%">เพิ่มเติม</th>                                  
                                    </tr>
                                </thead>
                                <tbody id="fulltbp_bol_wrapper_tr">
                                    @foreach ($bols as $key => $bol)
                                        <tr>    
                                            <td> {{$bol->name}} </td> 
                                            <td> 
                                                <a href="{{asset($bol->path)}}" class="btn btn-sm bg-primary" target="_blank">ดาวน์โหลด</a>
                                                @if (Auth::user()->user_type_id == 4)
                                                <a type="button" data-id="{{$bol->id}}" class="btn btn-sm bg-danger deletebol">ลบ</a>  
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
<script type="module" src="{{asset('assets/dashboard/js/app/helper/bolhelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

    </script>
@stop