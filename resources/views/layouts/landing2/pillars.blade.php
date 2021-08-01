
            <!-- Specialty Section Start -->
   
            <!-- Specialty Section End -->

<div class="gray-color pt-50" >
    <div class="rs-process modify1 bgProcess pt-120 pb-120 md-pt-55 md-pb-80">
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
                                        <div class="icon-box-area mb-20">
                                            <div class="box-inner">
                                                <div class="icon-area">
                                                   <a href="{{route('landing.pillars')}}"><img src="{{asset('assets/dashboard/images/pillar/01.png')}}" alt=""></a> 
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
                                        <div class="icon-box-area purple-bg">
                                            <div class="box-inner">
                                                <div class="icon-area">
                                                   <a href="{{route('landing.pillars')}}"><img src="{{asset('assets/dashboard/images/pillar/03.png')}}" alt=""></a> 
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
                                        <div class="icon-box-area blue-bg mb-20">
                                            <div class="box-inner">
                                                <div class="icon-area">
                                                   <a href="{{route('landing.pillars')}}"><img src="{{asset('assets/dashboard/images/pillar/02.png')}}" alt=""></a> 
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
                                        <div class="icon-box-area pink-bg">
                                            <div class="box-inner">
                                                <div class="icon-area">
                                                   <a href="{{route('landing.pillars')}}"><img src="{{asset('assets/dashboard/images/pillar/04.png')}}" alt=""></a> 
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
                                <div class="desc white-color">
                                    @if (Config::get('app.locale') == 'th')
                                        {{$homepagepillar->textth2}}
                                    @else
                                        {{$homepagepillar->texteng2}}
                                    @endif
                                </div>
                            </div>
                            <!-- Skillbar Section Start -->
                            {{-- <div class="rs-skillbar style1 modify3">
                                <div class="cl-skill-bar">
                                   <!-- Start Skill Bar -->
                                   <span class="skillbar-title white-color">
                                       @if (Config::get('app.locale') == 'th')
                                            {{$homepagepillar->pillartitleth1}}
                                        @else
                                            {{$homepagepillar->pillartitleeng1}}
                                        @endif
                                </span>
                                   <div class="skillbar " data-percent="92">
                                       <p class="skillbar-bar"></p>
                                       <span class="skill-bar-percent white-color"></span> 
                                   </div>
                                   <!-- Start Skill Bar -->
                                   <span class="skillbar-title white-color">
                                    @if (Config::get('app.locale') == 'th')
                                        {{$homepagepillar->pillartitleth2}}
                                    @else
                                        {{$homepagepillar->pillartitleeng2}}
                                    @endif
                                    </span>
                                   <div class="skillbar purple-style" data-percent="80">
                                       <p class="skillbar-bar"></p>
                                       <span class="skill-bar-percent white-color"></span> 
                                   </div>
                                   <!-- Start Skill Bar -->
                                   <span class="skillbar-title white-color">
                                    @if (Config::get('app.locale') == 'th')
                                        {{$homepagepillar->pillartitleth3}}
                                    @else
                                        {{$homepagepillar->pillartitleeng3}}
                                    @endif
                                    </span>
                                   <div class="skillbar blue-style" data-percent="95">
                                       <p class="skillbar-bar"></p>
                                       <span class="skill-bar-percent white-color"></span> 
                                   </div>

                                   <span class="skillbar-title white-color">
                                    @if (Config::get('app.locale') == 'th')
                                        {{$homepagepillar->pillartitleth4}}
                                    @else
                                        {{$homepagepillar->pillartitleeng4}}
                                    @endif
                                   </span>
                                   <div class="skillbar pink-style" data-percent="75">
                                       <p class="skillbar-bar"></p>
                                       <span class="skill-bar-percent white-color"></span> 
                                   </div>
                               </div>
                            </div> --}}
                            <!-- Skillbar Section End -->

                            <div class="btn-part mt-55">
                                <a class="readon started" href="{{route('landing.pillars')}}">
                                  @if (Config::get('app.locale') == 'th')
                                      เพิ่มเติม
                                  @else
                                      More
                                  @endif
                                  </a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="sec-title mb-50">
                                <h2 class="title pb-20 white-color">
                                    Over 25+ Years Helping Brands to Reach Full Potential
                                </h2>
                                <div class="desc white-color">
                                   Over 25 years working in IT services developing software applications and mobile apps for clients all over the world. From its medieval origins to the digital era, learn everything there is to know about the ubiquitous lorem ipsum passage. Creation timelines for the standard lorem ipsum passage vary, with some citing the 15th century
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-7">
                            <div class="rs-services style3 md-pt-50">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6 pr-10 pt-40 sm-pt-0 sm-pr-0 sm-pl-0">
                                           <div class="services-item mb-20">
                                               <div class="services-icon">
                                                   <div class="image-part">
                                                       <img class="main-img" src="{{asset('assets/dashboard/images/chart/01.png')}}" alt="">
                                                       <img class="hover-img" src="{{asset('assets/dashboard/images/chart/01.png')}}" alt="">
                                                   </div>
                                               </div>
                                               <div class="services-content">
                                                   <div class="services-text">
                                                       <h3 class="title"><a href="#">{{$homepagepillar->pillartitleth1}}</a></h3>
                                                   </div>
                                                   <div class="services-desc">
                                                       <p >
                                                           At vero eos et accusamus etiusto odio praesentium accusamus.
                                                       </p>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="services-item cyan-bg">
                                               <div class="services-icon">
                                                   <div class="image-part">
                                                       <img class="main-img" src="{{asset('assets/dashboard/images/chart/02.png')}}" alt="">
                                                       <img class="hover-img" src="{{asset('assets/dashboard/images/chart/02.png')}}" alt="">
                                                   </div>
                                               </div>
                                               <div class="services-content">
                                                   <div class="services-text">
                                                       <h3 class="title"><a href="#">{{$homepagepillar->pillartitleth2}}</a></h3>
                                                   </div>
                                                   <div class="services-desc">
                                                       <p>
                                                           At vero eos et accusamus etiusto odio praesentium accusamus.
                                                       </p>
                                                   </div>
                                               </div>
                                           </div>  
                                        </div>
                                        <div class="col-md-6 pl-10 sm-pr-0 sm-pl-0 sm-mt-20">
                                           <div class="services-item gold-bg mb-20">
                                               <div class="services-icon">
                                                   <div class="image-part">
                                                       <img class="main-img" src="{{asset('assets/dashboard/images/chart/03.png')}}" alt="">
                                                       <img class="hover-img" src="{{asset('assets/dashboard/images/chart/03.png')}}" alt="">
                                                   </div>
                                               </div>
                                               <div class="services-content">
                                                   <div class="services-text">
                                                       <h3 class="title"><a href="#">{{$homepagepillar->pillartitleth3}}</a></h3>
                                                   </div>
                                                   <div class="services-desc">
                                                       <p>
                                                           At vero eos et accusamus etiusto odio praesentium accusamus.
                                                       </p>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="services-item blue-bg">
                                               <div class="services-icon">
                                                   <div class="image-part">
                                                       <img class="main-img" src="{{asset('assets/dashboard/images/chart/04.png')}}" alt="">
                                                       <img class="hover-img" src="{{asset('assets/dashboard/images/chart/04.png')}}" alt="">
                                                   </div>
                                               </div>
                                               <div class="services-content">
                                                   <div class="services-text">
                                                       <h3 class="title"><a href="#">{{$homepagepillar->pillartitleth4}}</a></h3>
                                                   </div>
                                                   <div class="services-desc">
                                                       <p>
                                                           At vero eos et accusamus etiusto odio praesentium accusamus.
                                                       </p>
                                                   </div>
                                               </div>
                                           </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
      
                </div>   


                {{-- <div class="col-lg-4 pr-40 md-pr-15 md-pb-80">
                    <div class="process-wrap md-center">
                        <div class="sec-title mb-30">
                            <div class="sub-text new">
                                @if (Config::get('app.locale') == 'th')
                                    {{$homepagepillar->textth1}}
                                @else
                                    {{$homepagepillar->texteng1}}
                                @endif

                            </div>
                            <h2 class="title white-color">     
                                @if (Config::get('app.locale') == 'th')
                                    {{$homepagepillar->textth2}}
                                @else
                                    {{$homepagepillar->texteng2}}
                                @endif
                            </h2>
                        </div>
                        <div class="btn-part mt-40">
                            <a class="readon started" href="{{route('register')}}">
                                @if (Config::get('app.locale') == 'th')
                                    สมัคร
                                @else
                                    Apply
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 sm-pl-40 sm-pr-20">
                    <div class="row">
                        <div class="col-md-6 mb-70">
                            <div class="rs-addon-number">
                                <div class="number-text">
                                    <div class="number-area">
                                        1
                                    </div>
                                    <div class="number-title">
                                        <h3 class="title">
                                            @if (Config::get('app.locale') == 'th')
                                                {{$homepagepillar->pillartitleth1}}
                                            @else
                                                {{$homepagepillar->pillartitleeng1}}
                                            @endif
                                        </h3>
                                    </div>
                                    <p class="number-txt">  
                                        @if (Config::get('app.locale') == 'th')
                                            {{$homepagepillar->pillardescth1}}
                                        @else
                                            {{$homepagepillar->pillardesceng1}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-70">
                            <div class="rs-addon-number">
                                <div class="number-text">
                                    <div class="number-area green-bg">
                                        2
                                    </div>
                                    <div class="number-title">
                                        <h3 class="title">
                                            @if (Config::get('app.locale') == 'th')
                                            {{$homepagepillar->pillartitleth2}}
                                        @else
                                            {{$homepagepillar->pillartitleeng2}}
                                        @endif
                                        </h3>
                                    </div>
                                    <p class="number-txt">
                                        @if (Config::get('app.locale') == 'th')
                                            {{$homepagepillar->pillardescth2}}
                                        @else
                                            {{$homepagepillar->pillardesceng2}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 sm-mb-70">
                            <div class="rs-addon-number">
                                <div class="number-text">
                                    <div class="number-area plum-bg">
                                        3
                                    </div>
                                    <div class="number-title">
                                        <h3 class="title">
                                            @if (Config::get('app.locale') == 'th')
                                                {{$homepagepillar->pillartitleth3}}
                                            @else
                                                {{$homepagepillar->pillartitleeng3}}
                                            @endif
                                        </h3>
                                    </div>
                                    <p class="number-txt">
                                        @if (Config::get('app.locale') == 'th')
                                            {{$homepagepillar->pillardescth3}}
                                        @else
                                            {{$homepagepillar->pillardesceng3}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="rs-addon-number">
                                <div class="number-text">
                                    <div class="number-area pink-bg">
                                        4
                                    </div>
                                    <div class="number-title">
                                        <h3 class="title">
                                            @if (Config::get('app.locale') == 'th')
                                                {{$homepagepillar->pillartitleth4}}
                                            @else
                                                {{$homepagepillar->pillartitleeng4}}
                                            @endif
                                        </h3>
                                    </div>
                                    <p class="number-txt">
                                        @if (Config::get('app.locale') == 'th')
                                            {{$homepagepillar->pillardescth4}}
                                        @else
                                            {{$homepagepillar->pillardesceng4}}
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
  </div>