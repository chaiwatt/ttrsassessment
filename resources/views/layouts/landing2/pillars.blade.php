
            <!-- Specialty Section Start -->
   
            <!-- Specialty Section End -->

<div class="gray-color pt-50" >
    <div id="rs-services-benefit" class="rs-process modify1 bgProcess pt-120 pb-120 md-pt-55 md-pb-80">
        <div class="shape-animation">
            <div class="shape-process">
                <img class="dance2" src="{{asset('assets/landing2/images/process/circle.png')}}" alt="images">
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="container">

                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <!-- Features Section Start -->
                            <div class="rs-feature">
                                <div class="row">
                                    <div class="col-md-6 mt-20 pr-6  md-pb-20">
                                        <div class="icon-box-area mb-20" style="min-height:250px;{{$homepagepillar->color1}}">
                                            <div class="box-inner">
                                                <div class="icon-area">
                                                   <a href="{{route('landing.pillars')}}"><img src="{{asset($homepagepillar->pillaricon1)}}" width="100" height="100" alt=""></a> 
                                                </div>
                                                <div class="content-part">
                                                    <h4 class="title"><a href="{{route('landing.pillars')}}">
                                                        @if (Config::get('app.locale') == 'th')
                                                            {{$homepagepillar->pillartitleth1}}
                                                        @else
                                                            {{$homepagepillar->pillartitleeng1}}
                                                        @endif
                                                </a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="icon-box-area" style="min-height:250px;{{$homepagepillar->color2}}">
                                            <div class="box-inner">
                                                <div class="icon-area">
                                                   <a href="{{route('landing.pillars')}}"><img src="{{asset($homepagepillar->pillaricon2)}}" width="100" height="100" alt=""></a> 
                                                </div>
                                                <div class="content-part">
                                                    <h4 class="title"><a href="{{route('landing.pillars')}}">
                                                        @if (Config::get('app.locale') == 'th')
                                                            {{$homepagepillar->pillartitleth2}}
                                                        @else
                                                            {{$homepagepillar->pillartitleeng2}}
                                                        @endif
                                                    </a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="icon-box-area mb-20" style="min-height:250px;{{$homepagepillar->color3}}">
                                            <div class="box-inner">
                                                <div class="icon-area">
                                                   <a href="{{route('landing.pillars')}}"><img src="{{asset($homepagepillar->pillaricon3)}}" width="100" height="100" alt=""></a> 
                                                </div>
                                                <div class="content-part">
                                                    <h4 class="title"><a href="{{route('landing.pillars')}}">
                                                        @if (Config::get('app.locale') == 'th')
                                                            {{$homepagepillar->pillartitleth3}}
                                                        @else
                                                            {{$homepagepillar->pillartitleeng3}}
                                                        @endif
                                                    </a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="icon-box-area" style="min-height:250px;{{$homepagepillar->color4}}">
                                            <div class="box-inner">
                                                <div class="icon-area">
                                                   <a href="{{route('landing.pillars')}}"><img src="{{asset($homepagepillar->pillaricon4)}}" width="100" height="100" alt=""></a> 
                                                </div>
                                                <div class="content-part">
                                                    <h4 class="title"><a href="{{route('landing.pillars')}}">
                                                        @if (Config::get('app.locale') == 'th')
                                                            {{$homepagepillar->pillartitleth4}}
                                                        @else
                                                            {{$homepagepillar->pillartitleeng4}}
                                                        @endif
                                                    </a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Features Section Start -->
                        </div>
                        <div class="col-lg-6 pl-55 md-pl-15 md-pt-60">
                            <div class="sec-title6 mb-30">
                                <h2 class="title pb-20 white-color">
                                    @if (Config::get('app.locale') == 'th')
                                        {{$homepagepillar->textth1}}
                                    @else
                                        {{$homepagepillar->texteng1}}
                                    @endif
                                </h2>
                                <div class="white-color">
                                    @if (Config::get('app.locale') == 'th')
                                        {!!$homepagepillar->textth2!!}
                                    @else
                                    {{-- <span class="fa-stack"><span class="fa fa-circle-o fa-stack-2x"></span><strong class="fa-stack-1x">1</strong></span> {!!$homepagepillar->texteng2!!} --}}
                                    {!!$homepagepillar->texteng2!!}
                                    @endif
                                </div>
                            </div>


                            <div class="btn-part mt-55">
                                @if (!Empty($sharehomepagepillarurl))
                                <a class="readon started" href="{{@$sharehomepagepillarurl->url}}">
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
                    
      
                </div>   

            </div>
        </div>
    </div>
  </div>