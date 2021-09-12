<div id="rs-blog" class="rs-blog pt-110 pb-120 md-pt-75 md-pb-80">
    <div class="container">  
        <div class="sec-title2 text-center mb-30">
                <h2 class="title testi-title">
                    {{trans('lang.news')}}
                </h2>
            {{-- <div class="desc">
                We've been building creative tools together for over a decade and have a deep appreciation for software applications
            </div> --}}
        </div>
        <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="2" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="3" data-md-device-nav="false" data-md-device-dots="false">
            @foreach ($sharepages as $page)
                <div class="blog-item" style="height: 740px">
                    <div class="image-wrap">
                        <a href="{{route('landing.page',['slug' => $page->slug])}}"><img src="{{asset($page->featureimagethumbnail->name)}}" alt=""></a>
                        {{-- <ul class="post-categories">
                            <li><a href="{{route('landing.page',['slug' => $page->slug])}}">{{@$page->pageCategory->name}}</a></li>
                        </ul> --}}
                    </div>
                    <div class="blog-content">
                       <ul class="blog-meta">
                           <li class="date"><i class="fa fa-calendar-check-o"></i> 
                            @if (Config::get('app.locale') == 'th')
                                โพสต์:
                            @else
                                Post:
                            @endif

                            {{$page->day}} 
                            
                            {{-- Monthen --}}
                            @if (Config::get('app.locale') == 'th')
                            {{$page->month}} {{$page->year}}
                            @else
                            {{$page->monthen}} {{$page->year-543}}
                            @endif
                            
                            </li>
                           <li class="admin"><i class="fa fa-eye"></i>  
                             
                            @if (Config::get('app.locale') == 'th')
                                เข้าดู:
                            @else
                                View:
                            @endif
                            
                            {{$page->pageview->count()}}</li>
                       </ul>
                       <h3 class="blog-title"><a href="{{route('landing.page',['slug' => @$page->slug])}}">{{@$page->name}}</a></h3>
                       <p class="desc">{{@$page->header}}...</p>
                       <div class="blog-button"><a href="{{route('landing.page',['slug' => @$page->slug])}}">
                        
                        @if (Config::get('app.locale') == 'th')
                            เพิ่มเติม:
                        @else
                            More:
                        @endif
                    
                    
                    </a></div>
                    </div>
                </div>
            @endforeach

         </div>
         <div class="btn-part mt-40" style="text-align: center">
            <a class="readon started" href="{{route('landing.news')}}">
                @if (Config::get('app.locale') == 'th')
                    ข่าวทั้งหมด
                @else
                    All news
                @endif
            
            </a>
        </div>
    </div>
</div>