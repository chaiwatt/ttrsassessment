<div class="gray-color">
    <div class="rs-process modify1 pt-160 pb-120 md-pt-75 md-pb-80">
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
                            <div class="sub-text new">4 PILLARS</div>
                            <h2 class="title white-color">
                                
                                @if (Config::get('app.locale') == 'th')
                                    4 หมวดการประเมิน
                                @else
                                    4 Pillars
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
                                        <h3 class="title"> Management</h3>
                                    </div>
                                    <p class="number-txt">  
                                        @if (Config::get('app.locale') == 'th')
                                            {{$homepagepillar->pillardescriptionthai1}}
                                        @else
                                            {{$homepagepillar->pillardescriptioneng1}}
                                        @endif
                                        {{-- Quisque placerat vitae lacus ut scelerisque. Fusce luctus odio ac nibh luctus, in porttitor theo lacus egestas. --}}
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
                                        <h3 class="title">Technology</h3>
                                    </div>
                                    <p class="number-txt">
                                        @if (Config::get('app.locale') == 'th')
                                            {{$homepagepillar->pillardescriptionthai2}}
                                        @else
                                            {{$homepagepillar->pillardescriptioneng2}}
                                        @endif
                                        {{-- Quisque placerat vitae lacus ut scelerisque. Fusce luctus odio ac nibh luctus, in porttitor theo lacus egestas. --}}
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
                                        <h3 class="title">Marketability</h3>
                                    </div>
                                    <p class="number-txt">
                                        @if (Config::get('app.locale') == 'th')
                                            {{$homepagepillar->pillardescriptionthai3}}
                                        @else
                                            {{$homepagepillar->pillardescriptioneng3}}
                                        @endif
                                        {{-- Quisque placerat vitae lacus ut scelerisque. Fusce luctus odio ac nibh luctus, in porttitor theo lacus egestas. --}}
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
                                        <h3 class="title">Business Prospect</h3>
                                    </div>
                                    <p class="number-txt">
                                        @if (Config::get('app.locale') == 'th')
                                            {{$homepagepillar->pillardescriptionthai4}}
                                        @else
                                            {{$homepagepillar->pillardescriptioneng4}}
                                        @endif
                                        {{-- Quisque placerat vitae lacus ut scelerisque. Fusce luctus odio ac nibh luctus, in porttitor theo lacus egestas.</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>