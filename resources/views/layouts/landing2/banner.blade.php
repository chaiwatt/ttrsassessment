<div class="rs-banner style3 pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-content">
                   {{-- <div class="sub-title">Secure & Clean Code</div> --}}
                   <h1 class="title">
                    @if (Config::get('app.locale') == 'th')
                        {{$shareheadertext->titleth}}
                    @else
                        {{$shareheadertext->titleeng}}
                    @endif
                   </h1>
                    <p class="desc">
                        @if (Config::get('app.locale') == 'th')
                            {{$shareheadertext->detailth}}
                        @else
                            {{$shareheadertext->detaileng}}
                        @endif
                    </p>
                    <ul class="banner-btn">
                        <li><a class="readon started" href="{{route('register')}}">สมัคร</a></li>
                        <li>
                            <div class="rs-videos">
                                <div class="animate-border white-color">
                                    <a class="popup-border popup-videos" href="https://www.youtube.com/watch?v=4Lp7YZilTrU">
                                        <i class="fa fa-play"></i>
                                    </a>
                                </div>
                            </div> 
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>           
    <img class="d-none d-md-block images-part" src="{{asset('assets/landing2/images/banner/banner-3.png')}}" alt="">
</div>