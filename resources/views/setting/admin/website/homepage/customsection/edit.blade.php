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
                <h4> <span class="font-weight-semibold">Custom Section</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <a href="#" class="breadcrumb-item"> หน้าแรก (Homepage)</a>
                    {{-- <a href="#" class="breadcrumb-item"> Custom Section</a> --}}
                    <span class="breadcrumb-item active">Custom Section</span>
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
                        <form method="POST" action="{{route('setting.admin.website.homepage.customsection.editsave',['id' => $customsection->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Link ID</label>
                                        @php
                                            $sectionid = 'custom-section1';
                                            if($customsection->id == 7){
                                                $sectionid = 'custom-section2';
                                            }else if($customsection->id == 8){
                                                $sectionid = 'custom-section3';
                                            }else if($customsection->id == 9){
                                                $sectionid = 'custom-section4';
                                            }else if($customsection->id == 10){
                                                $sectionid = 'custom-section5';
                                            }
                                        @endphp
                                        <input type="text" name="bgcss" value="{{$sectionid}}" class="form-control form-control-lg" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Header</label>
                                        <input type="text"  name="header" value="{{$customsection->title}}"  placeholder="Header" class="form-control form-control-lg" >
                                    </div>
                                    <div class="form-group" style="margin-bottom: -15px">
                                        <label>Header css</label>
                                        <input type="text"  name="headercss" value="{{$customsection->titlecss}}"  placeholder="Header css" class="form-control form-control-lg" >
                                        <code >
                                            <label>ตัวอย่าง CSS</label>
                                            <div style="padding-left:10px">
                                                <p>font-size: 2.3em;color:#ffffff;text-align:center</p>
                                            </div>
                                        </code>
                                    </div>
                                    <div class="form-group">
                                        <label>พื้นหลัง CSS<span class="text-danger">*</span></label>
                                        <input type="text" name="bgcss" value="{{$customsection->bg}}"  placeholder="ตัวอย่าง เช่น background: linear-gradient(to right, #e9eaeb 0%, #c9cbcd 100%)" class="form-control form-control-lg">
                                        <code>
                                            <label>ตัวอย่าง CSS</label>
                                            <div style="padding-left:10px">
                                                <p>background: linear-gradient(to right, #e9eaeb 0%, #c9cbcd 100%)</p>
                                                <p>background-image: url(assets/landing2/images/bg/about.jpg);height: 100%;background-repeat: no-repeat;background-size: cover;</p>
                                            </div>
                                        </code>
                                    </div>
                                    
                                    <div class="form-group" style="margin-top:-30px">
                                        <div class="form-group">
                                            <label>รายละเอียด section<span class="text-danger">*</span></label>
                                            <textarea name="content" id="content" class="form-control mb-3" rows="7" cols="1" placeholder="บทความ">{{$customsection->content}}</textarea>
                                        </div>
                                    </div>
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>สถานะการแสดง</label>
                                            <select name="status" id="status" placeholder="สถานะการแสดง" class="form-control form-control-select2">
                                                    <option value="0" @if ($customsection->show == 0) selected @endif >ซ่อน</option>
                                                    <option value="1" @if ($customsection->show == 1) selected @endif >แสดง</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row"> 
                                    <div class="col-md-6">
                                        <div id="orderlist_wrapper" hidden >
                                            @foreach ($homepagesections as $homepagesection)
                                               <input value="{{$homepagesection->order_list}}" name="orderlist[]" type="text">
                                            @endforeach
                                           </div>
        
                                           <label for=""><strong>ลำดับการแสดงผล (ลาก วางเพื่อเปลี่ยน)</strong> </label>
                                            <ul id="sortable">
                                                @foreach ($homepagesections as $homepagesection)
                                                @php
                                                    $color = 'gray';
                                                    $border = 'solid';
                                                    if($homepagesection->id == $customsection->order_list){
                                                        $color = 'green';
                                                        $border = 'dashed';
                                                    }
                                                @endphp
                                                    <li class="orderitem" data-id="{{$homepagesection->order_list}}" style="margin-bottom:30px"><span style="border-style: {{$border}};width:300px;background-color:{{$color}};padding-left:5px" >{{$homepagesection->aliasname}}</span></li>
                                                @endforeach
                                               
                                              </ul>
                                    </div>
                                </div> --}}
                                <div class="text-right">
                                    <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </div>
                            
                        </form>

                    </div>
                </div>
            <!-- /striped rows -->
            </div>
        </div>
        </div>
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
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
        $( function() {
            $( "#sortable" ).sortable({
                update: function( ) {
                    var array = $(".orderitem").map(function() {
                        return $(this).data("id");
                    }).get();
                    var html  = '';
                var array = $(".orderitem").map(function() {
                    html += `<input type="text" name="orderlist[]" value="${$(this).data("id")}" >`
                        return $(this).data("id");
                    }).get();
                    $("#orderlist_wrapper").html(html);
                }
            });
            $( "#sortable" ).disableSelection();
        } );
        $('#content').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],          
            callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
        });
    });


    $(document).on('change', '#status', function(e) {
        if($(this).val() == 1){
            $( "#publicdate" ).prop( "disabled", false );
        }else{
            $("#publicdate").val('');
            $( "#publicdate" ).prop( "disabled", true );
        }
    });
</script>
@stop
