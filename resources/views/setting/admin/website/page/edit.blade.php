@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/plugins/summernote/summernote.min.css')}}" rel="stylesheet">
@stop
@section('content')
    {{-- modal create category --}}
    <div id="modal_create_category" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มหมวดหมู่</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>หมวดหมู่</label><span class="text-danger">*</span>
                                <input type="text" id="modalcreatecategory" placeholder="หมวดหมู่" class="form-control" >
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_create_category" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่มหมวดหมู่</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal edit category --}}
    <div id="modal_edit_category" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;แก้ไขหมวดหมู่</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>หมวดหมู่</label><span class="text-danger">*</span>
                                <input type="text" id="modalcategory_edit" placeholder="หมวดหมู่" class="form-control" >
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_edit_category" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> แก้ไขหมวดหมู่</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal create tag --}}
    <div id="modal_create_tag" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มป้ายกำกับ</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ป้ายกำกับ</label><span class="text-danger">*</span>
                                <input type="text" id="modalcreatetag" placeholder="ป้ายกำกับ" class="form-control" >
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_create_tag" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่มป้ายกำกับ</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal edit tag --}}
    <div id="modal_edit_tag" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;แก้ไขป้ายกำกับ</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ป้ายกำกับ</label><span class="text-danger">*</span>
                                <input type="text" id="modaltag_edit" placeholder="ป้ายกำกับ" class="form-control" >
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_edit_tag" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> แก้ไขป้ายกำกับ</button>
                </div>
            </div>
        </div>
    </div>
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
                        <form method="POST" action="{{route('setting.admin.website.page.editsave',['id' => $page->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <fieldset>	
                                        <div class="form-group">
                                            <label>เมนู</label>
                                                <select name="menu" placeholder="เมนู" class="form-control form-control-select2">
                                                    <option value="" >เลือกรายการเมนู</option>                                                     
                                                    @foreach ($menus as $menu)
                                                        <option value="{{$menu->id}}" @if ($menu->page_id == $page->id) selected @endif >{{$menu->name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                        <div class="form-group">
                                            <label>หัวเรื่อง<span class="text-danger">*</span></label>
                                            <input type="text"  name="title" value="{{$page->name}}"  placeholder="หัวเรื่อง" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>คำอธิบายย่อ<span class="text-danger">*</span></label>
                                            <textarea type="text"  name="description" rows="3" cols="1"  placeholder="คำอธิบายย่อ" class="form-control">{{$page->header}}</textarea>
                                        </div>
                                        <div class="form-group">                                                
                                            <label>หมวดหมู่</label><span class="text-danger">*</span> <a href="" class="icon-cog5 text-info" data-toggle="dropdown"></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a data-toggle="modal" href="#modal_create_category"  class="dropdown-item" ><i class="icon-folder-plus2"></i> เพิ่มหมวดหมู่</a>
                                                <a data-toggle="modal"  class="dropdown-item" id="editcategory"><i class="icon-pencil"></i> แก้ไขหมวดหมู่</a>
                                                <hr>
                                                <a data-toggle="modal" href="#"  class="dropdown-item" id="deletecategory"><i class="icon-trash"></i> ลบหมวดหมู่</a>
                                            </div>
                                            <select name="pagecategory" id="pagecategory" placeholder="หมวดหมู่" class="form-control form-control-select2">
                                                @foreach ($pagecategories as $pagecategory)
                                                <option value="{{$pagecategory->id}}" @if ($pagecategory->id == $page->page_category_id) selected @endif >{{$pagecategory->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>รูป Feature (ขนาด 960x540 px)<span class="text-danger">*</span></label>
                                            <div class="input-group">													
                                                <button class="btn bg-info" type="button" onclick="document.getElementById('file').click();">อัปโหลด Feature</button>													
                                            </div>
                                            <input type="file" style="display:none;" id="file" name="feature" accept="image/*"/>
                                            <br>
                                            @if (!Empty($page->feature_image_id))
                                                <div class="col-md-12" id="feature_input_wrapper">
                                                    <input name="featureinp" value="{{$page->feature_image_id}}" data-id="{{$page->feature_image_id}}" class="featureinp" hidden> 
                                                </div>
                                                <div class="col-md-12" id="featurethumbnail_input_wrapper" >
                                                    {{-- <input name="featurethumbnailinp" value="{{$page->feature_image_thumbnail_id}}" data-id="{{$page->feature_image_thumbnail_id}}" class="featurethumbnailinp" hidden>  --}}
                                                    <input name="blogsidebarimage" value="{{$page->blogsidebarimage_id}}" data-id="{{$page->blogsidebarimage_id}}" class="blogsidebarimage" hidden> 
                                                    <input name="bloghomepageimage" value="{{$page->bloghomepageimage_id}}" data-id="{{$page->bloghomepageimage_id}}" class="bloghomepageimage" hidden> 
                                                </div>
                                                <div id="featurethumbnail_wrapper">
                                                    <div class="form-group" id="featurediv" >
                                                        <div class="row">
                                                            <div class="col-sm-6 col-xl-6">
                                                                <div class="card">
                                                                    <div class="card-img-actions mx-1 mt-1">
                                                                        <img class="card-img img-fluid" src="{{asset($page->featureimage->name)}}" alt="">
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="d-flex align-items-start flex-nowrap">
                                                                            <div class="list-icons list-icons-extended ml-auto">
                                                                                <a href="#" id="deletefeature" data-id="{{$page->feature_image_id}}" data-thumbnail="{{$page->feature_image_thumbnail_id}}"  class="list-icons-item"><i class="icon-bin top-0"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        <div class="card-img-actions-overlay card-img">
                                            <a href="{{asset($page->featureimg)}}" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group">
                                                <i class="icon-plus3"></i>
                                            </a>
                                            <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                                                <i class="icon-link"></i>
                                            </a>
                                        </div>
                                        <div class="form-group">
                                            <label>บทความ<span class="text-danger">*</span></label>
											<textarea name="content" id="summernote" class="form-control mb-3" rows="7" cols="1" placeholder="บทความ">{{$page->content}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>ป้ายกำกับ</label><span class="text-danger">*</span> <a href="" class="icon-cog5 text-info" data-toggle="dropdown"></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a data-toggle="modal" href="#modal_create_tag"  class="dropdown-item" ><i class="icon-folder-plus2"></i> เพิ่มป้ายกำกับ</a>
                                                    <a data-toggle="modal"  class="dropdown-item" id="edittag"><i class="icon-pencil"></i> แก้ไขป้ายกำกับ</a>
                                                    <hr>
                                                    <a data-toggle="modal" href="#"  class="dropdown-item" id="deletetag"><i class="icon-trash"></i> ลบป้ายกำกับ</a>
                                                </div>
                                                <select name="pagetag[]" id="pagetag" multiple placeholder="ป้ายกำกับ" class="form-control form-control-select2">
                                                    @foreach ($tags as $tag)
                                                        @php
                                                            $check = $pagetags->where('tag_id',$tag->id)->first();
                                                        @endphp
                                                        <option value="{{$tag->id}}"  @if (!Empty($check)) selected @endif >{{$tag->name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                        <div id="images_wrapper">
                                            <div class="form-group">
                                                <div class="row">
                                                    @foreach ($pageimages as $pageimage)
                                                        <div class="col-sm-6 col-xl-3">
                                                            <div class="card">
                                                                <div class="card-img-actions mx-1 mt-1">
                                                                    <img class="card-img img-fluid" src="{{asset($pageimage->image)}}" alt="">
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="d-flex align-items-start flex-nowrap">
                                                                        <div class="list-icons list-icons-extended ml-auto">
                                                                            <a href="#" id="deletegallery" data-id="{{$pageimage->id}}" class="list-icons-item"><i class="icon-bin top-0"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12" id="gallery_wrapper" >	
                                            @foreach ($pageimages as $pageimage)
                                                <input name="gal[]" value="{{$pageimage->id}}" data-id="{{$pageimage->id}}" class="gal" hidden>
                                            @endforeach
                                        </div>    

                                        {{-- <div class="form-group">
                                            <label>รูปแกลอรี่ (ขนาด 500x500 px)<span class="text-danger">*</span></label>
                                            <div class="input-group">													
                                                <button class="btn bg-info" type="button" onclick="document.getElementById('singlefile').click();">อัปโหลดรูป</button>													
                                            </div>
                                            <input type="file" style="display:none;" id="singlefile" />
                                        </div>                                        --}}
                                        <div class="form-group">
                                            <label>สถานะการแสดง</label>
                                            <select name="status" placeholder="สถานะการแสดง" class="form-control form-control-select2">
                                                @foreach ($pagestatuses as $pagestatus)
                                                    <option value="{{$pagestatus->id}}" @if ($pagestatus->id == $page->page_status_id) selected @endif >{{$pagestatus->name}}</option>
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
            <!-- /striped rows -->
            </div>
        </div>
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/plugins/summernote/summernote.min.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/pagehelper.js')}}"></script>
<script src="{{ asset('assets/dashboard/js/plugins/media/fancybox.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/demo_pages/gallery.js') }}"></script>

<script  type="text/javascript">
	var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content')
    };

    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,
        });
    });
    $("#file").on('change', function() {
        $("#filename").val(this.value);
    });
</script>
@stop
