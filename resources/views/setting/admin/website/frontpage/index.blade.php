@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/plugins/summernote/summernote.min.css')}}" rel="stylesheet">
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">แก้ไขหน้าเพจ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <a href="{{route('setting.admin.website.page')}}" class="breadcrumb-item"> หน้าเพจ</a>
                    <span class="breadcrumb-item active">แก้ไขหน้าเพจ</span>
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
                        <form method="POST" action="{{route('setting.admin.website.frontpage.save',['id' => $frontpage->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <fieldset>	
                                        <div class="form-group">
                                            <label>สีพื้น<span class="text-danger">*</span></label>
                                            <input type="text"  name="bgcolor" value="{{$frontpage->bgcolor}}"  placeholder="สีพื้น" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>เปอร์เซนต์ขนาดรูปพื้น<span class="text-danger">*</span></label>
                                            <input type="text"  name="percent" value="{{$frontpage->percentimg}}"  placeholder="หัวเรื่อง" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>รูปพื้น (ขนาด 1200x857 px)<span class="text-danger">*</span></label>
                                            <div class="input-group">													
                                                <button id ="_frontimg" class="btn bg-info" type="button" onclick="document.getElementById('frontimg').click();">อัพโหลดรูปพื้น</button>													
                                            </div>
                                            <input type="file" style="display:none;" id="frontimg" name="frontimg"/>
                                        </div>
                                        <div class="form-group">
                                            <img src="{{asset($frontpage->file)}}" class="img-fluid" alt="Responsive image">
                                        </div>
                                        <div class="form-group">
                                            <label>รูปปุ่มกด (ขนาด 600x128 px)<span class="text-danger">*</span></label>
                                            <div class="input-group">													
                                                <button id="_btnimg" class="btn bg-info" type="button" onclick="document.getElementById('btnimg').click();">อัพโหลดรูปปุ่มกด</button>													
                                            </div>
                                            <input type="file" style="display:none;" id="btnimg" name="btnimg"/>
                                        </div>
                                        <div class="form-group">
                                            <img src="{{asset($frontpage->entersitebtn)}}" class="img-fluid" alt="Responsive image">
                                        </div>
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

<script  type="text/javascript">
	var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content')
    };

    $("#frontimg").on('change', function() {
        $("#_frontimg").html('อัพโหลดรูปพื้น(1)');
    });
    $("#btnimg").on('change', function() {
        $("#_btnimg").html('อัพโหลดรูปปุ่มกด(1)');
    });
</script>
@stop
