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
                    <a href="{{route('dashboard.admin.projectassignment')}}" class="breadcrumb-item"> รายการ Assignment</a>
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
				<!-- Multiple selection -->
				<div class="card">
					<div class="card-body">
                        <form method="POST" action="{{route('dashboard.admin.projectassignment.editsave',['id' => $projectassignment->id])}}" enctype="multipart/form-data">
                            @csrf
                            <fieldset>	
                                <div class="form-group">
									<label for="">Leader<span class="text-danger">*</span></label>
									<select name="leader" value="{{$projectassignment->leader_id}}" id="" class="form-control form-control-select2">
										@foreach ($users as $user)
											<option value="{{$user->id}}" @if($projectassignment->leader_id == $user->id) selected @endif >{{$user->prefix->name}}{{$user->name}} {{$user->lastname}}</option>
										@endforeach
									</select>
                                </div>
                                <div class="form-group">
									<label for="">Co-Leader<span class="text-danger">*</span></label>
									<select name="coleader" value="{{$projectassignment->coleader_id}}" id="" class="form-control form-control-select2">
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
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script>
    $("#attachment").on('change', function() {
        $("#filename").val(this.value);
    });
</script>
@stop
