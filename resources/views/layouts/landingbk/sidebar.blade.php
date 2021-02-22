<aside class="sidebar">
    <form method="GET" action="{{route('landing.search')}}" >
        <div class="input-group mb-3 pb-1">
            <input class="form-control form-control-lg" name = "search" placeholder="ค้นหา..." id="s" type="text">
            <span class="input-group-append">
                <button type="submit" class="btn btn-dark text-1 p-2"><i class="fas fa-search m-2"></i></button>
            </span>
        </div>
    </form>
    <h5 class="font-weight-bold pt-4">หมวดหมู่</h5>
    <ul class="nav nav-list flex-column mb-5">
        @foreach($sharepagecategories as $sharepagecategory)
            <li class="nav-item">
            <a class="nav-link" href="#" style="font-size: 14px">{{$sharepagecategory->name}}@if (count($sharepagecategory->childs)>0) ({{count($sharepagecategory->childs)}}) @endif </a>
                @if(count($sharepagecategory->childs))
                    @include('layouts.landing.category.managechild',['childs' => $sharepagecategory->childs])
                @endif
            </li>
        @endforeach
    </ul>
    <div class="tabs tabs-dark mb-4 pb-2">
        <ul class="nav nav-tabs">
            <li class="nav-item active"><a class="nav-link show active text-1 font-weight-bold text-uppercase" href="#popularPosts" data-toggle="tab">ยอดนิยม</a></li>
            <li class="nav-item"><a class="nav-link text-1 font-weight-bold text-uppercase" href="#recentPosts" data-toggle="tab">ล่าสุด</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="popularPosts">
                <ul class="simple-post-list">
                    <li>
                        <div class="post-image">
                            <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                <a href="blog-post.html">
                                    <img src="img/blog/square/blog-11.jpg" width="50" height="50" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="post-info">
                            <a href="blog-post.html">Nullam Vitae Nibh Un Odiosters</a>
                            <div class="post-meta">
                                 Nov 10, 2018
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="post-image">
                            <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                <a href="blog-post.html">
                                    <img src="img/blog/square/blog-24.jpg" width="50" height="50" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="post-info">
                            <a href="blog-post.html">Vitae Nibh Un Odiosters</a>
                            <div class="post-meta">
                                 Nov 10, 2018
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="post-image">
                            <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                <a href="blog-post.html">
                                    <img src="img/blog/square/blog-42.jpg" width="50" height="50" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="post-info">
                            <a href="blog-post.html">Odiosters Nullam Vitae</a>
                            <div class="post-meta">
                                 Nov 10, 2018
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="tab-pane" id="recentPosts">
                <ul class="simple-post-list">
                    <li>
                        <div class="post-image">
                            <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                <a href="blog-post.html">
                                    <img src="img/blog/square/blog-24.jpg" width="50" height="50" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="post-info">
                            <a href="blog-post.html">Vitae Nibh Un Odiosters</a>
                            <div class="post-meta">
                                 Nov 10, 2018
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="post-image">
                            <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                <a href="blog-post.html">
                                    <img src="img/blog/square/blog-42.jpg" width="50" height="50" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="post-info">
                            <a href="blog-post.html">Odiosters Nullam Vitae</a>
                            <div class="post-meta">
                                 Nov 10, 2018
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="post-image">
                            <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                <a href="blog-post.html">
                                    <img src="img/blog/square/blog-11.jpg" width="50" height="50" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="post-info">
                            <a href="blog-post.html">Nullam Vitae Nibh Un Odiosters</a>
                            <div class="post-meta">
                                 Nov 10, 2018
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <h5 class="font-weight-bold pt-2 mb-2">ป้ายกำกับ</h5>
    <div class="mb-3 pb-1">
        @foreach ($tags as $tag)
            <a href="{{route('landing.tag',['slug' => $tag->slug])}}"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">{{$tag->name}}</span></a>&nbsp;
        @endforeach
    </div>
    <h5 class="font-weight-bold pt-4">Find us on Facebook</h5>
    <div class="fb-page" data-href="https://www.facebook.com/OklerThemes/" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/OklerThemes/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/OklerThemes/">Okler Themes</a></blockquote></div>
</aside>