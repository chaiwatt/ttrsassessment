@extends('layouts.landing.page')
@section('pageCss')
@stop
@section('content')
    <div class="blog-posts single-post">
        <article class="post post-large blog-single-post border-0 m-0 p-0">
            <div class="post-image ml-0">
                <a href="{{route('landing.page',['slug' => $page->slug])}}">
                    <img src="{{asset($page->featureimg)}}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                </a>
            </div>							
            <div class="post-date ml-0">
                <span class="day">{{$page->day}}</span>
                <span class="month">{{$page->month}}</span>
            </div>

            <div class="post-content ml-0">
                <h2 ><a href="{{route('landing.page',['slug' => $page->slug])}}" >{{$page->name}}</a></h2>
                <div class="post-meta">
                    <span><i class="far fa-user"></i> โดย <a href="#">{{$page->user->name}}</a> </span>
                    <span><i class="far fa-eye"></i>{{$page->pageview->count()}}</span>
                    <span><i class="far fa-folder"></i> 
                        @foreach ($pagetags as $tag)
                            <a href="{{route('landing.tag',['slug' => $tag->tag->slug])}}">{{$tag->tag->name}}</a>&nbsp;
                        @endforeach
                    </span>
                </div>

                <p>{!!$page->content!!}</p>
                
                @if ($pageimages->count() > 0)
                <div class="row">
                     <strong>รูปแกลอรี่</strong>
                     <hr>
                    <div class="col">
                        <div class="lightbox" data-plugin-options="{'delegate': 'a', 'type': 'image', 'gallery': {'enabled': true}, 'mainClass': 'mfp-with-zoom', 'zoom': {'enabled': true, 'duration': 300}}">
                            <div class="owl-carousel owl-theme stage-margin" data-plugin-options="{'items': 3, 'margin': 10, 'loop': false, 'nav': true, 'dots': false, 'stagePadding': 40}">
                                @foreach ($pageimages as $pageimage)
                                <div>
                                    <a class="img-thumbnail img-thumbnail-no-borders img-thumbnail-hover-icon" href="{{asset($pageimage->image)}}">
                                        <img class="img-fluid" src="{{asset($pageimage->image)}}" alt="Project Image">
                                    </a>
                                </div> 
                                @endforeach 
                            </div>
                        </div>
                    </div>
                </div>
                @endif
     
                {{-- <div class="post-block mt-5 post-share">
                    <h4 class="mb-3">Share this Post</h4>
                    <div class="addthis_toolbox addthis_default_style ">
                        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>						
                        <a class="addthis_counter addthis_pill_style"></a>
                    </div>
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-50faf75173aadc53"></script>
                </div> --}}

            </div>
        </article>							
    </div>
@endsection
@section('pageScript')
	
@stop
