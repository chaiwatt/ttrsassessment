<div id="rs-services-procedure" class="rs-services style3 pt-110 pb-120 md-pt-75 md-pb-80">
    <div class="container">
        <div class="sec-title2 text-center mb-45">
            <h2 class="title testi-title">
                {{trans('lang.registrationprocess')}}
            </h2>
        </div>
        <div class="row">
        @foreach ($homepageservices as $key => $homepageservice)
            <div class="col-lg-4 col-md-6 mb-20" data-aos="fade-up" data-aos-delay="{{($key + 1)*100}}">
                @if ($homepageservice->colortype == 0)
                        <div class="services-item {{$homepageservice->cardcolor->name}}" style="height:330px">
                    @else
                        <div class="services-item" onmouseover="this.style.backgroundColor='{{$homepageservice->color}}'" onmouseout="this.style.backgroundColor=''" style="height:330px;">
                @endif

                    <div class="services-icon">
                        <div class="image-part">
                            <img class="main-img" src="{{asset($homepageservice->iconnormal)}}" width="300" height="300">
                            <img class="hover-img" src="{{asset($homepageservice->iconhover)}}" width="300" height="300">
                        </div>
                    </div>
                    <div class="services-content">
                        @if (Config::get('app.locale') == 'th')
                                <div class="services-text">
                                    <h3 class="title"><a href="{{url('').'/'.$homepageservice->link}}">{{$homepageservice->titlethai}}</a></h3>
                                </div>
                                <div class="services-desc">
                                    <p>
                                        {{$homepageservice->descriptionthai}}
                                    </p>
                                </div>
                            @else
                                <div class="services-text">
                                    <h3 class="title"><a href="{{url('').'/'.$homepageservice->link}}">{{$homepageservice->titleeng}}</a></h3>
                                </div>
                                <div class="services-desc">
                                    <p>
                                        {{$homepageservice->descriptioneng}}
                                    </p>
                                </div>
                        @endif
                        <div class="serial-number">
                             {{sprintf('%02d', $key+1)}}
                         </div>
                    </div>
                    
                </div> 
             </div>
          @endforeach 
    
        </div>
        <div class="getStart text-right" >
            @if (!Empty($sharehomepageserviceurl))
                    <a class="readon started" href="{{@$sharehomepageserviceurl->url}}">
                @else
                    <a class="readon started" href="#">
            @endif
            
                
                @if (Config::get('app.locale') == 'th')
                    เพิ่มเติม
                @else
                    More
                @endif
            </a>
        </div>
    </div>
</div>