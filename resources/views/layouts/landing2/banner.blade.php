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
                        <li><a class="readon started text-center" style="min-width:200px"  href="{{route('register')}}">
                            
                                @if (Config::get('app.locale') == 'th')
                                    สมัคร
                                @else
                                    Apply
                                @endif
                            </a>
                        </li>
                        <li><a class="readon started" style="min-width:200px ; margin-left:25px;text-align:center;white-space: nowrap" href="{{route('login')}}">
                            
                            @if (Config::get('app.locale') == 'th')
                                เข้าสู่ระบบ
                            @else
                                Login
                            @endif
                        </a>
                    </li>

                    </ul>
                    <div class="rs-videos" >
                        <div class="animate-border white-color" style="height:100px" >
                            <a class="popup-border popup-videos" style="text-align:center" href=" {{$shareheadertext->youtube}}">
                                <i class="fa fa-play"></i>
                            </a>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>           
    <img class="d-none d-md-block images-part img-animate m-40" src="{{asset('assets/landing2/images/banner/banner-01.png')}}" alt="">
</div>