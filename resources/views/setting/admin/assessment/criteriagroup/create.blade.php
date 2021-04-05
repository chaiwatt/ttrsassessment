@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">เพิ่มรายการเกณฑ์การประเมิน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> การประเมิน</a>
                    <a href="{{route('setting.admin.assessment.criteriagroup')}}" class="breadcrumb-item"> รายการเกณฑ์การประเมิน</a>
                    <span class="breadcrumb-item active">เพิ่มรายการเกณฑ์การประเมิน</span>
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
                        <form method="POST" action="{{route('setting.admin.assessment.criteriagroup.createsave')}}" enctype="multipart/form-data">
                            @csrf
                            <fieldset>	
                                <div class="form-group">
                                    <label>ชื่อรายการ</label>
                                    <input type="text"  name="name" value="{{old('name')}}"  placeholder="ชื่อรายการ" class="form-control form-control-lg">
                                </div>
                                <div class="form-group">
                                    <label>ประเภทธุรกิจ<span class="text-danger">*</span></label>
                                    <select name="industrygroup" data-placeholder="สถานะการใช้งาน" class="form-control form-control-select2" >
                                        @foreach ($industrygroups as $industrygroup)
                                            <option value="{{$industrygroup->id}}">{{$industrygroup->name}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>เวอร์ชั่น</label>
                                    <input type="number" min="0.01" step="0.01" max="10000.00" name="version" value="{{old('version')}}"  placeholder="เวอร์ชั่น" class="form-control form-control-lg">
                                </div>
                                <div class="form-group">
                                    <label>เลือกเกณฑ์<span class="text-danger">*</span></label>
                                    <select name="criterialist[]" multiple="multiple" placeholder="เลือกเกณฑ์"  class="form-control form-control-select2">
                                        @foreach ($criterias as $criteria)
                                            <option value="{{$criteria->id}}">{{$criteria->name}}</option> 
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
@stop
