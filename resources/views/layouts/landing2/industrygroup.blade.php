<div id="rs-about" class="rs-about style2 pt-110 pb-120 md-pt-75 md-pb-80">
    <div class="image-part">
       <img src="{{asset('assets/landing2/images/about/about-4.png')}}" alt="about"> 
    </div> 
    <div class="container">
        <div class="row">
            <div class="col-lg-5"></div>
            <div class="col-lg-7 pl-55 md-pl-15 z-index-1">
                <div class="sec-title mb-30">
                    {{-- <div class="sub-text style4-bg">About Us</div> --}}
                    <h2 class="title pb-20">
                        @if (Config::get('app.locale') == 'th')
                            {{$sharehomepageindustrygrouptext->titleth}}
                        @else
                            {{$sharehomepageindustrygrouptext->titleeng}}
                        @endif
                    </h2>
                    <div class="desc">
                        @if (Config::get('app.locale') == 'th')
                            {{$sharehomepageindustrygrouptext->subtitleth}}
                        @else
                            {{$sharehomepageindustrygrouptext->subtitleeng}}
                        @endif
                    </div>
                </div>
                <!-- Skillbar Section Start -->
               <div class="rs-skillbar style1 home4">
                   <div class="cl-skill-bar">
                      <!-- Start Skill Bar -->
                      @php
                          $total = $shareindustrygroups->sum('companybelong');
                      @endphp
                      <span class="skillbar-title">
                            @if (Config::get('app.locale') == 'th')
                                {{$shareindustrygroups[0]->nameth}}
                            @else
                                {{$shareindustrygroups[0]->nameeng}}
                            @endif
                        </span>
                      <div class="skillbar" data-percent="{{round($shareindustrygroups[0]->companybelong/$total*100)}}">
                          <p class="skillbar-bar"></p>
                          <span class="skill-bar-percent"></span> 
                      </div>
                      <!-- Start Skill Bar -->
                      <span class="skillbar-title">
                        @if (Config::get('app.locale') == 'th')
                            {{$shareindustrygroups[1]->nameth}}
                        @else
                            {{$shareindustrygroups[1]->nameeng}}
                        @endif
                      </span>
                      <div class="skillbar" data-percent="{{round($shareindustrygroups[1]->companybelong/$total*100)}}">
                          <p class="skillbar-bar paste-bg"></p>
                          <span class="skill-bar-percent"></span> 
                      </div>
                      <!-- Start Skill Bar -->
                      <span class="skillbar-title">
                        @if (Config::get('app.locale') == 'th')
                            {{$shareindustrygroups[2]->nameth}}
                        @else
                            {{$shareindustrygroups[2]->nameeng}}
                        @endif
                      </span>
                      
                      <div class="skillbar" data-percent="{{round($shareindustrygroups[2]->companybelong/$total*100)}}">
                          <p class="skillbar-bar blue-bg"></p>
                          <span class="skill-bar-percent"></span> 
                      </div>    
                      <!-- Start Skill Bar -->
                      <span class="skillbar-title">
                        @if (Config::get('app.locale') == 'th')
                            {{$shareindustrygroups[3]->nameth}}
                        @else
                            {{$shareindustrygroups[3]->nameeng}}
                        @endif
                      </span>
                      
                      <div class="skillbar" data-percent="{{round($shareindustrygroups[3]->companybelong/$total*100)}}">
                          <p class="skillbar-bar pink-bg"></p>
                          <span class="skill-bar-percent"></span> 
                      </div>

                      <div class="btn-part mt-55">
                          <a class="readon started" href="{{route('register')}}">
                            @if (Config::get('app.locale') == 'th')
                                เพิ่มเติม
                            @else
                                More
                            @endif
                            </a>
                      </div>
                  </div>
               </div>
               <!-- Skillbar Section End -->
            </div>
        </div>
    </div>
</div>