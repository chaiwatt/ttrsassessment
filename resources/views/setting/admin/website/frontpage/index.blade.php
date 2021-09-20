@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/plugins/summernote/summernote.min.css')}}" rel="stylesheet">
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">หน้า Billboard</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <span class="breadcrumb-item active">หน้า Billboard</span>
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
                                            <input type="text"  name="bgcolor" id="bgcolor" value="{{$frontpage->bgcolor}}"  placeholder="สีพื้น" class="form-control form-control-lg" hidden>
                                            <div class="form-group">
                                                <div class="d-inline-block">
                                                    <input type="text" id="colorpick" class="form-control colorpicker-basic form-control-lg" style="font-size:18px;width:100%;height:200px;" value="{{$frontpage->bgcolor}}" data-fouc>
                                                </div>
                                            </div>
                                        </div>

         
                    
                                  

                                        {{-- <div class="form-group">
                                            <input type="text" class="form-control colorpicker-show-input" data-preferred-format="hex" value="#f75d1c" data-fouc>
                                        </div> --}}

                                        <div class="form-group">
                                            <label>เปอร์เซนต์แสดงผล Billboard<span class="text-danger">*</span></label>
                                            <input type="text"  name="percent" value="{{$frontpage->percentimg}}"  placeholder="หัวเรื่อง" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>Billboard (ขนาด 1000x720px ความละเอียด 300px/inch)<span class="text-danger">*</span></label>
                                            <div class="input-group">													
                                                <button id ="_frontimg" class="btn bg-info" type="button" onclick="document.getElementById('frontimg').click();">อัปโหลดรูป Billboard</button>													
                                            </div>
                                            <input type="file" style="display:none;" id="frontimg" name="frontimg" accept="image/*"/>
                                        </div>
                                        <div class="form-group">
                                            <img src="{{asset($frontpage->file)}}" class="img-fluid" alt="Responsive image">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>การแสดง Bill board</label>
                                                <select name="billboard" data-placeholder="การแสดง Bill board" class="form-control form-control-lg form-control-select2">
                                                    @foreach ($frontpagestatuses as $frontpagestatus)                                                                
                                                        <option value="{{$frontpagestatus->id}}" @if ($generalinfo->front_page_status_id == $frontpagestatus->id) selected @endif> {{$frontpagestatus->name}} </option>
                                                    @endforeach   
                                                </select>
                                            </div>
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
<script src="{{asset('assets/dashboard/js/plugins/pickers/color/spectrum.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/picker_color.js')}}"></script>
<script  type="text/javascript">
	var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content')
    };

    var _URL = window.URL || window.webkitURL;

    $("#frontimg").on('change', function() {
        var file, img;
        if ((file = this.files[0])) {
            img = new Image();
            img.onload = function() {
                if(this.width <= 1000 || this.height <= 720){
                    $("#_frontimg").html('อัปโหลดรูปพื้นหลัง(1)');
                }else{
                    $('#frontimg').val('');
                    Swal.fire({
                    title: 'ผิดพลาด',
                    text: 'ขนาดไฟล์ เกิน 1000x720px',
                    });
                }
            };
            img.onerror = function() {
                Swal.fire({
                    title: 'ผิดพลาด',
                    text: 'กรุณาเลือกไฟล์รูปภาพ',
                    });
            };
            img.src = _URL.createObjectURL(file);
        }
    });
    $("#btnimg").on('change', function() {
        $("#_btnimg").html('อัปโหลดรูปปุ่มกด(1)');
    });

    $("#colorpick").on('change', function() {
            $('#bgcolor').val($('#colorpick').spectrum('get').toHexString());
        });

</script>
@stop
