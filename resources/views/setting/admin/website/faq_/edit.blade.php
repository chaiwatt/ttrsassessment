@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/plugins/summernote/summernote.min.css')}}" rel="stylesheet">
<style>
    textarea {
        font-size: 16px !important;
    }
</style>
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">คำถามที่พบบ่อย</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <a href="{{route('setting.admin.website.page')}}" class="breadcrumb-item"> คำถามที่พบบ่อย</a>
                    <span class="breadcrumb-item active">คำถามที่พบบ่อย</span>
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
                        <form method="POST" action="{{route('setting.admin.website.homepage.faq.editsave',['id' => $faq->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <fieldset>	
                                        <div class="form-group">
                                            <label>คำถามภาษาไทย<span class="text-danger">*</span></label>
                                            <input type="text"  name="title" value="{{$faq->title}}"  placeholder="คำถามภาษาไทย" class="form-control form-control-lg stringformat120">
                                        </div>
                                        <div class="form-group">
                                            <label>คำถามภาษาอังกฤษ<span class="text-danger">*</span></label>
                                            <input type="text"  name="titleeng" value="{{$faq->titleeng}}"  placeholder="คำถามภาษาอังกฤษ" class="form-control form-control-lg stringformat120">
                                        </div>
                                        <div class="form-group">
                                            <label>คำตอบภาษาไทย<span class="text-danger">*</span></label>
											<textarea name="body" class="form-control mb-3 stringformat600" rows="7" cols="1" placeholder="คำตอบภาษาไทย">{{$faq->body}}</textarea>
                                        </div>    
                                        <div class="form-group">
                                            <label>คำตอบภาษาอังกฤษ<span class="text-danger">*</span></label>
											<textarea name="bodyeng" class="form-control mb-3 stringformat600" rows="7" cols="1" placeholder="คำตอบภาษาอังกฤษ">{{$faq->bodyeng}}</textarea>
                                        </div>                            
                                        <div class="form-group">
                                            <label>สถานะการแสดง</label>
                                            <select name="status" placeholder="สถานะการแสดง" class="form-control form-control-select2">
                                                @foreach ($statuses as $status)
                                                    <option value="{{$status->id}}"
                                                        @if ($status->id == $faq->status)
                                                            selected
                                                        @endif
                                                        >{{$status->name}}</option>
                                                @endforeach
                                            </select>
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
            </div>
        </div>
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/js/app/helper/inputformat.js?v=3')}}"></script>
<script  type="text/javascript">
	var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content')
    };
});
</script>
@stop
