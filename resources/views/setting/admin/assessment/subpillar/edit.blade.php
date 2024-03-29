@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">แก้ไข Sub Pillar</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> EV</a>
                    <a href="{{route('setting.admin.assessment.subpillar')}}" class="breadcrumb-item"> Sub Pillar</a>
                    <span class="breadcrumb-item active">แก้ไข Sub Pillar</span>
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
                        <form method="POST" action="{{route('setting.admin.assessment.subpillar.editsave',['id' => $subpillar->id])}}" enctype="multipart/form-data">
                            @csrf
                            <fieldset>	
                                <div class="form-group">
                                    <label>Pillar</label><span class="text-danger">*</span>
                                        <select name="pillarid" id="pillar" aria-placeholder="pillar" class="form-control form-control-lg form-control-select2">
                                            @foreach ($pillars as $pillar)
                                            <option value="{{$pillar->id}}" @if ($subpillar->pillar_id == $pillar->id) selected @endif>{{$pillar->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>Sub Pillar</label><span class="text-danger">*</span>
                                    <input type="text" name="subpillar" value="{{$subpillar->name}}"  placeholder="Sub Pillar" class="form-control form-control-lg" required>
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
@stop
