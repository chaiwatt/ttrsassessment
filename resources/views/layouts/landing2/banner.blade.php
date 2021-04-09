<div class="rs-banner style3 bgStyle3 pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-content">
                   {{-- <div class="sub-title">Secure & Clean Code</div> --}}
                   <h1 class="title title-animate">
                        @if (Config::get('app.locale') == 'th')
                            {{$shareheadertext->titleth}}
                        @else
                            {{$shareheadertext->titleeng}}
                        @endif
                   </h1>
                    <p class="desc desc-animate">
                        @if (Config::get('app.locale') == 'th')
                            {{$shareheadertext->detailth}}
                        @else
                            {{$shareheadertext->detaileng}}
                        @endif
                    </p>
                    <ul class="banner-btn">
                        <li><a class="readon started" href="{{route('register')}}">
                            
                            @if (Config::get('app.locale') == 'th')
                                สมัคร
                            @else
                                Apply
                            @endif
                        </a></li>
                        <li>
                            <div class="rs-videos">
                                <div class="animate-border white-color">
                                    <a class="popup-border popup-videos" href=" {{$shareheadertext->youtube}}">
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
    <img class="d-none d-md-block images-part img-animate m-40" src="{{asset('assets/landing2/images/banner/banner-01.png')}}" alt="">
</div>