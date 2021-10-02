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
                <h4> <span class="font-weight-semibold">Layout</span></h4>
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
                    <span class="breadcrumb-item active">Layout</span>
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
                        <form method="POST" action="{{route('setting.admin.website.homepage.layout.save')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12" >
                                {{-- <div class="row"> 
                                    <div class="col-md-12" style="text-align:center" > --}}
                                        <div id="orderlist_wrapper" hidden >
                                         
                                            @foreach ($homepagesections as $homepagesection)
                                               <input value="{{$homepagesection->order_list}}" name="orderlist[]" type="text" >
                                            @endforeach
                                           </div>
        
                                           <label for=""><strong>ลำดับการแสดงผล Homepage (ลาก วางเพื่อเปลี่ยน)</strong> </label>
                                            <ul id="sortable" style="margin-top: 10px">
                                                @foreach ($homepagesections->sortBy('order_list') as $homepagesection)
                                                    <li class="orderitem bg-teal" data-id="{{$homepagesection->id}}" style="margin-bottom:10px;height:50px;width:300px;padding-left:50px" >
                                                        {{-- <span style="width:300px;padding-left:10px;" class="bg-teal"> --}}
                                                            
                                                        <a href="{{url('').'/'.$homepagesection->editurl}}" class="text-white"  > <span style="font-size: 20px">{{$homepagesection->aliasname}}</span> </a>
                                                        {{-- </span>   --}}
                                                    </li>
                                                @endforeach
                                               
                                              </ul>
                                    {{-- </div>
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
<script src="{{asset('assets/dashboard/js/app/helper/inputformat.js?v=1')}}"></script>
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

                    console.log(array);
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
