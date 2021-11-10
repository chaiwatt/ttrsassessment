@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/plugins/summernote/summernote.min.css')}}" rel="stylesheet">

<style>
    .ui-draggable, .ui-droppable {
        background-position: top;
    }
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
    #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
    #sortable li span { position: absolute; margin-left: -1.3em; }
</style>
@stop
@section('content')


    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">เพิ่มหน้าเพจ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <a href="{{route('setting.admin.website.webpage')}}" class="breadcrumb-item"> หน้าเพจ</a>
                    {{-- <a href="#" class="breadcrumb-item"> Custom Section</a> --}}
                    <span class="breadcrumb-item active">เพิ่มหน้าเพจ</span>
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
                        <form method="POST" action="{{route('setting.admin.website.webpage.createsave')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>ชื่อเรื่อง<span class="text-danger">*</span></label>
                                        <input type="text" name="title" value=""  placeholder="ชื่อเรื่อง" class="form-control form-control-lg stringformat60" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>รายละเอียด<span class="text-danger">*</span></label>
                                            <textarea name="body" id="body" class="form-control mb-3" rows="10" cols="1" placeholder="รายละเอียด" style="font-size: 16px" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>สถานะการแสดง</label>
                                        <select name="status" id="status" placeholder="สถานะการแสดง" class="form-control form-control-select2">
                                                <option value="0" >ไม่แสดง</option>
                                                <option value="1" >แสดง</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12" style="float-right">
                                    <div class="text-right" >
                                        <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
                                    </div>
                                </div>
                            </div>     
                        </form>        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/plugins/summernote/summernote.min.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/pagehelper.js?v=1')}}"></script>
<script src="{{ asset('assets/dashboard/js/plugins/media/fancybox.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/demo_pages/gallery.js') }}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/inputformat.js?v=3')}}"></script>
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
<script  type="text/javascript">
	var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content')
    };

    $(document).ready(function() {
        $('#body').summernote({
            height: 300,
            callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
        });
    });
</script>
@stop
