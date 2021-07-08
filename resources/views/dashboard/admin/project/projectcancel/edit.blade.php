@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">โครงการ: {{$fulltbp->minitbp->project}}</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <a href="{{route('dashboard.admin.project.projectcancel')}}" class="breadcrumb-item"> ยกเลิกโครงการ</a>
                    <span class="breadcrumb-item active">ยกเลิกโครงการ{{$fulltbp->minitbp->project}}</span>
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
                        <form method="POST" action="{{route('dashboard.admin.project.savecancel',['id' => $fulltbp->id])}}" enctype="multipart/form-data">
                            @csrf
                            <fieldset>	
                                <div class="form-group">
                                    <label for="">เหตุผลการยกเลิกโครงการ</label>
                                    <textarea name="cancelreason" class="form-control form-control-lg" cols="3" rows="7" required
                                    @if (!Empty($fulltbp->canceldate))
                                        disabled
                                    @endif
                                    
                                    >{{$fulltbp->cancel_reason}}</textarea>
                                </div>
                                @if (Empty($fulltbp->canceldate))
                                    <div class="text-right">
                                        <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
                                    </div>
                                @endif

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
