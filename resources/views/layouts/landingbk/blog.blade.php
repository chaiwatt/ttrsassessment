<div class="container mb-5" style="margin-top: 20px">
    <div class="row">
        <div class="col">
            <div class="blog-posts">
                <div class="row">
                    @foreach ($sharepages as $page)
                        <div class="col-md-4">
                            <article class="post post-medium border-0 pb-0 mb-5">
                                @if (!Empty($page->feature_image_thumbnail_id))
                                    <div class="post-image">
                                        <a href="{{route('landing.page',['slug' => $page->slug])}}">
                                            <img src="{{asset($page->featureimagethumbnail->name)}}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                                        </a>
                                    </div>
                                @endif
                                <div class="post-content">
                                    <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a href="{{route('landing.page',['slug' => $page->slug])}}">{{$page->name}}</a></h2>
                                    <p>{{$page->header}}</p>
                                    <div class="post-meta">
                                        <span><i class="far fa-user"></i> โดย <a href="#">{{$page->user->name}}</a> </span>
                                        <span><i class="far fa-eye"></i>{{$page->pageview->count()}}</span>
                                        <span><i class="far fa-folder"></i> 
                                            @foreach ($page->pagetag as $tag)
                                                <a href="#">{{$tag->tag->name}}</a>&nbsp;
                                            @endforeach
                                        </span>
                                        <span class="d-block mt-2"><a href="{{route('landing.page',['slug' => $page->slug])}}" class="btn btn-xs btn-light text-1 text-uppercase">เพิ่มเติม...</a></span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col">
                        {{$sharepages->links()}} 
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>