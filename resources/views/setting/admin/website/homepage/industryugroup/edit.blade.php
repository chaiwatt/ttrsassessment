@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">แก้ไข Homepage กลุ่มอุตสาหกรรม</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <a href="#" class="breadcrumb-item"> Homepage กลุ่มอุตสาหกรรม</a>
                    {{-- <span class="breadcrumb-item active">แก้ไข Intro section</span> --}}
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
                        <form method="POST" action="{{route('setting.admin.website.homepage.industryugroup.editsave',['id' => $homepageindustrygroup->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <fieldset>	
                                        <div class="form-group">
                                            <label>ข้อความที่ 1 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="titleth" value="{{$homepageindustrygroup->titleth}}"  placeholder="ข้อความที่ 1 (ภาษาไทย)" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่ 1 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="titleeng" value="{{$homepageindustrygroup->titleeng}}"  placeholder="ข้อความที่ 1 (ภาษาอังกฤษ)" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่ 2 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="subtitleth" value="{{$homepageindustrygroup->subtitleth}}"  placeholder="ข้อความที่ 2 (ภาษาไทย)" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่2 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="subtitleeng" value="{{$homepageindustrygroup->subtitleeng}}"  placeholder="ข้อความที่ 2 (ภาษาอังกฤษ)" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>ลิงก์</label>
                                            <input type="text"  name="url" value="{{$homepageindustrygroup->url}}"  placeholder="ลิงก์" class="form-control form-control-lg">
                                        </div>
										<div class="form-group">
											<label>รูป<span class="text-danger">*</span></label>
											<div class="input-group">													
												<input type="text" id="filename" class="form-control border-right-0" placeholder="รูปไอคอน" disabled>
												<span class="input-group-append">
													<button class="btn bg-info" type="button" onclick="document.getElementById('file').click();">อัปโหลดรูป</button>													
												</span>
											</div>
											<input type="file" style="display:none;" id="file" name="picture" accept="image/*"/>
                                        </div>
                                        <div class="row">	
                                            <div class="col-md-12">
                                                <img class="img-responsive" src="{{asset($homepageindustrygroup->picture)}}" style="width:500px;width:500px" >
                                            </div>
                                        </div>
                                        <br>
                                    </fieldset>
                                    
                                </div>
                                
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            <!-- /striped rows -->
            </div>
        </div>
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
    <script type="text/javascript">
        $("#file").on('change', function() {
            $("#filename").val(this.value);
        });
    </script>
@stop
