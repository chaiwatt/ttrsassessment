<div class="gray-color">
    <div class="rs-process modify1 bgProcess pt-160 pb-120 md-pt-75 md-pb-80">
        <div class="shape-animation">
            <div class="shape-process">
                <img class="dance2" src="{{asset('assets/landing2/images/process/circle.png')}}" alt="images">
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 pr-40 md-pr-15 md-pb-80">
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
                </div>
            </div>
        </div>
    </div>
  </div>