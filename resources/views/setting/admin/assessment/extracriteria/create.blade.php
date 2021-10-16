@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">เพิ่ม Extra Criteria</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> EV</a>
                    <a href="{{route('setting.admin.assessment.extracriteria')}}" class="breadcrumb-item"> Extra Criteria</a>
                    <span class="breadcrumb-item active">เพิ่ม Extra Criteria</span>
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
                        <form method="POST" action="{{route('setting.admin.assessment.extracriteria.createsave')}}" enctype="multipart/form-data">
                            @csrf
                            <fieldset>	
                                <div class="form-group">
                                    <label>Extra Category</label>
                                        <select name="extracategory" aria-placeholder="extracategory" class="form-control form-control-lg form-control-select2">
                                            <option value="">===เลือก Extra Category===</option>
                                            @foreach ($extracaterories as $extracaterory)
                                                <option value="{{$extracaterory->id}}">{{$extracaterory->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>Extra Criteria</label>
                                    <input type="text" name="extracriteria" value="{{old('extracriteria')}}"  placeholder="Extra Criteria" class="form-control form-control-lg form-control-lg">
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
