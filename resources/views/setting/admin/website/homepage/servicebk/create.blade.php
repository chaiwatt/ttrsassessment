@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/plugins/summernote/summernote.min.css')}}" rel="stylesheet">
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">เพิ่ม Service</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <a href="#" class="breadcrumb-item"> หน้าแรก (Homepage)</a>
                    <a href="{{route('setting.admin.website.homepage.service')}}" class="breadcrumb-item"> Service</a>
                    <span class="breadcrumb-item active">เพิ่ม Service</span>
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
                        <form method="POST" action="{{route('setting.admin.website.homepage.service.createsave')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Title<span class="text-danger">*</span></label>
                                            <input type="text"  name="titlethai" value="{{old('titlethai')}}"  placeholder="Title" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>Title (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="titleeng" value="{{old('titleeng')}}"  placeholder="Title (ภาษาอังกฤษ)" class="form-control form-control-lg">
                                        </div>                             
                                        <div class="form-group">
                                            <label>Description<span class="text-danger">*</span></label>
                                            <input type="text"  name="descriptionthai" value="{{old('descriptionthai')}}"  placeholder="Description" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>Description (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="descriptioneng" value="{{old('descriptioneng')}}"  placeholder="Description (ภาษาอังกฤษ)" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>ลิงก์</label>
                                            <input type="text"  name="link" value="{{old('link')}}"  placeholder="ลิงก์" class="form-control form-control-lg">
                                        </div>
                                </div>
                                <div class="col-md-12">
                                    <button href="#" id="avatar"  type="button" class="btn btn-sm btn-info" onclick="document.getElementById('iconimg').click();">แนบไฟล์รูป</button><span class="text-danger"> *</span>
                                    <input type="file" style="display:none;" id="iconimg" name="iconimg" accept="image/*"/>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
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


$("#iconimg").on('change', function() {
    var file = this.files[0];
        if (this.files[0].size/1024/1024*1000 > 1024 ){
            alert('ไฟล์ขนาดมากกว่า 1 MB');
            return ;
        }
        if (this.files[0].name.length > 70 ){
            Swal.fire({
                title: 'ผิดพลาด',
                text: 'ชื่อไฟล์ยาวมากกว่า 70 ตัวอักษร',
                });
            return ;
        }
    $('#avatar').html('แนบไฟล์รูป [1]');
});
</script>
@stop
