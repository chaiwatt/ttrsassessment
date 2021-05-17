@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">ส่ง Full TBP</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> การประเมิน</a>
                    <a href="{{route('dashboard.company.project.fulltbp')}}" class="breadcrumb-item"> Full TBP</a>
                    <span class="breadcrumb-item active">ส่ง Full TBP</span>
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
                        <form method="POST" action="{{route('dashboard.company.project.fulltbp.submitsave',['id' => $fulltbp->id])}}" enctype="multipart/form-data">
                            @csrf
                            <fieldset>	
                                <div class="form-group">
                                    <label>ไฟล์สแกน Full TBP</label>
                                    <div class="input-group">													
                                        <input type="text" id="filename" class="form-control form-control-lg border-right-0" placeholder="ไฟล์สแกน Full TBP" >
                                        <span class="input-group-append">
                                            <button class="btn bg-info" type="button" onclick="document.getElementById('attachment').click();">เลือกไฟล์</button>													
                                        </span>
                                    </div>
                                    <input type="file" style="display:none;" id="attachment" name="attachment" accept="image/jpeg,image/gif,image/png,application/pdf"/>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn bg-teal">ส่ง Full TBP <i class="icon-paperplane ml-2"></i></button>
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
