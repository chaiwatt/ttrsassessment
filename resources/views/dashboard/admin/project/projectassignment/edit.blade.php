@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Assignment: {{$minitbp->project}}</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> การประเมิน</a>
                    <a href="{{route('dashboard.admin.project.projectassignment')}}" class="breadcrumb-item"> รายการ Assignment</a>
                    <span class="breadcrumb-item active">Assignment {{$minitbp->project}}</span>
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
                        <form method="POST" action="{{route('dashboard.admin.project.projectassignment.editsave',['id' => $projectassignment->id])}}" enctype="multipart/form-data">
                            @csrf
                            <fieldset>	
                                <div class="form-group">
									<label for="">Leader<span class="text-danger">*</span></label>
									<select name="leader" id="leader" value="{{$projectassignment->leader_id}}" id="" class="form-control form-control-select2">
                                        <option value="0">===เลือก Leader===</option>
                                        @foreach ($users as $user)
											<option value="{{$user->id}}" @if($projectassignment->leader_id == $user->id) selected @endif >{{$user->prefix->name}}{{$user->name}} {{$user->lastname}}</option>
										@endforeach
									</select>
                                </div>
                                <div class="form-group">
									<label for="">Co-Leader<span class="text-danger">*</span></label>
									<select name="coleader" id="coleader" value="{{$projectassignment->coleader_id}}" id="" class="form-control form-control-select2">
										@foreach ($users as $user)
											<option value="{{$user->id}}" @if($projectassignment->coleader_id == $user->id) selected @endif >{{$user->prefix->name}}{{$user->name}} {{$user->lastname}}</option>
										@endforeach
									</select>
								</div>
                                <div class="text-right">
                                    <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </fieldset>
                        </form>
					</div>
				</div>
				<!-- /multiple selection -->
            <!-- /striped rows -->
            </div>
        </div>
        <div id="main_wrapper" hidden>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-body border-top-pink-400">
                        <div class="card-body text-center">
                        <i class="icon-new icon-2x text-pink-400 border-pink-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="card-title"><span id="pending"></span> โครงการ</h5>
                            <p class="mb-3">จำนวนโครงการทำกำลังดำเนินการ</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body border-top-success-400">
                        <div class="card-body text-center">
                        <i class="icon-medal-star icon-2x text-success-400 border-success-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="card-title"><span id="finished"></span> โครงการ</h5>
                            <p class="mb-3">จำนวนโครงการเสร็จสิ้น</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body border-top-teal-400">
                        <div class="card-body text-center">
                        <i class="icon-archive icon-2x text-teal-400 border-teal-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="card-title"><span id="total"></span> โครงการ</h5>
                            <p class="mb-3">จำนวนโครงการทั้งหมด</p>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h6 class="card-title">รายการโครงการ</h6>
                            <div class="header-elements">
                                <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                    {{-- <i class="icon-calendar3 mr-2"></i> --}}
                                    <span></span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>เลขที่โครงการ</th> 
                                            <th>ชื่อโครงการ</th> 
                                            <th>บริษัท</th>
                                            <th>สถานะ</th>
                                        </tr>
                                    </thead>
                                    <tbody id="fulltbp_wrapper_tr">
                                        {{-- @foreach ($fulltbps as $fulltbp)
                                            <td> {{$fulltbp->updatedatth}} </td> 
                                            <td> {{$fulltbp->minitbp->businessplan->code}} </td> 
                                            <td> {{$fulltbp->minitbp->project}} </td>  
                                            <td> {{$fulltbp->minitbp->businessplan->businessplanstatus->name}} </td>  
                                            <td> 
                                                <a href="{{route('dashboard.admin.report.search.view',['id' => $fulltbp->id])}}" class=" badge bg-primary">รายละเอียด</a>
                                                <a href="{{route('dashboard.admin.report.search.pdf',['id' => $fulltbp->id])}}" class=" badge bg-teal">PDF</a>
                                                <a href="{{route('dashboard.admin.report.search.excel',['id' => $fulltbp->id])}}" class=" badge bg-info">EXCEL</a>
                                            </td> 
                                        @endforeach --}}
                                    </tbody>
                                </table>      
                            </div>
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
<script type="module" src="{{asset('assets/dashboard/js/app/helper/projectassignmenthelper.js')}}"></script>
<script>
    var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            userid: "{{Auth::user()->id}}"
        };

    $("#attachment").on('change', function() {
        $("#filename").val(this.value);
    });

</script>
@stop
