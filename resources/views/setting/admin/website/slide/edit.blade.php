@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">ภาพสไลด์</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <a href="{{route('setting.admin.website.slide')}}" class="breadcrumb-item"> ภาพสไลด์</a>
                    <span class="breadcrumb-item active">เพิ่มภาพสไลด์</span>
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
                        <form method="POST" action="{{route('setting.admin.website.slide.editsave',['id' => $slide->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <fieldset>	
                                        <div class="form-group">
                                            <label>สถานะการแสดง<span class="text-danger">*</span></label>
                                            <select name="slidestatus" data-placeholder="สถานะการแสดง" class="form-control form-control-select2">
                                                @foreach ($slidestatuses as $slidestatus)
                                                    <option value="{{$slidestatus->id}}"  @if ($slide->slide_status_id == $slidestatus->id) selected @endif >{{$slidestatus->name}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>สไตล์<span class="text-danger">*</span></label>
                                            <select name="slidestyle" data-placeholder="คำนำหน้า" class="form-control form-control-select2">
                                                @foreach ($slidestyles as $slidestyle)
                                                    <option value="{{$slidestyle->id}}" @if ($slide->slide_style_id == $slidestyle->id) selected @endif >{{$slidestyle->name}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่1 ภาษาไทย</label>
                                            <input type="text"  name="textone" value="{{$slide->textone}}"  placeholder="ข้อความที่1 ภาษาไทย" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่1 ภาษาอังกฤษ</label>
                                            <input type="text"  name="textengone" value="{{$slide->textengone}}"  placeholder="ข้อความที่1 ภาษาอังกฤษ" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่2 ภาษาไทย</label>
                                            <input type="text"  name="texttwo" value="{{$slide->texttwo}}"  placeholder="ข้อความที่2 ภาษาไทย" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่2 ภาษาอังกฤษ</label>
                                            <input type="text"  name="textengtwo" value="{{$slide->textengtwo}}"  placeholder="ข้อความที่2 ภาษาอังกฤษ" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่3 ภาษาไทย</label>
                                            <input type="text"  name="textthree" value="{{$slide->textthree}}"  placeholder="ข้อความที่3 ภาษาไทย" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่3 ภาษาอังกฤษ</label>
                                            <input type="text"  name="textengthree" value="{{$slide->textengthree}}"  placeholder="ข้อความที่3 ภาษาอังกฤษ" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>ลิงค์ URL</label>
                                            <input type="text"  name="url" value="{{$slide->url}}"  placeholder="ลิงค์ URL" class="form-control">
                                        </div>
										<div class="form-group">
											<label>รูปสไลด์<span class="text-danger">*</span></label>
											<div class="input-group">													
												<input type="text" id="filename" class="form-control border-right-0" placeholder="รูปสไลด์" disabled>
												<span class="input-group-append">
													<button class="btn bg-info" type="button" onclick="document.getElementById('file').click();">อัพโหลดรูป</button>													
												</span>
											</div>
											<input type="file" style="display:none;" id="file" name="picture"/>
                                        </div>
                                        <div class="row">	
                                            <div class="col-md-12">
                                                <img class="img-responsive" src="{{asset($slide->file)}}" style="width: 100%">
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
