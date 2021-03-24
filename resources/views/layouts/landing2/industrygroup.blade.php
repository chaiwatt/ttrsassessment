<div id="rs-industrygrop" class="rs-about style2 pt-110 pb-120 md-pt-75 md-pb-80">
    <div class="image-part">
       <img src="{{asset($sharehomepageindustrygrouptext->picture)}}" data-aos="fade-right" alt="about"> 
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
                      <span class="skillbar-title" style="font-size: 16px">
                            @if (Config::get('app.locale') == 'th')
                                {{$shareindustrygroups[0]->nameth}}
                            @else
                                {{$shareindustrygroups[0]->nameeng}}
                            @endif
                        </span>
                        @php
                            $percent0 = 0;
                            if($total != 0){
                                $percent0 = round($shareindustrygroups[0]->companybelong/$total*100);
                            }
                        @endphp
                      <div class="skillbar" data-percent="{{$percent0}}">
                          <p class="skillbar-bar"></p>
                          <span class="skill-bar-percent"></span> 
                      </div>
                      <!-- Start Skill Bar -->
                      <span class="skillbar-title" style="font-size: 16px">
                        @if (Config::get('app.locale') == 'th')
                            {{$shareindustrygroups[1]->nameth}}
                        @else
                            {{$shareindustrygroups[1]->nameeng}}
                        @endif
                      </span>
                      @php
                        $percent1 = 0;
                            if($total != 0){
                                $percent1 = round($shareindustrygroups[1]->companybelong/$total*100);
                            }
                        @endphp
                      <div class="skillbar" data-percent="{{$percent1}}">
                          <p class="skillbar-bar paste-bg"></p>
                          <span class="skill-bar-percent"></span> 
                      </div>
                      <!-- Start Skill Bar -->
                      <span class="skillbar-title" style="font-size: 16px">
                        @if (Config::get('app.locale') == 'th')
                            {{$shareindustrygroups[2]->nameth}}
                        @else
                            {{$shareindustrygroups[2]->nameeng}}
                        @endif
                      </span>
                      @php
                        $percent2 = 0;
                            if($total != 0){
                                $percent2 = round($shareindustrygroups[2]->companybelong/$total*100);
                            }
                        @endphp
                      <div class="skillbar" data-percent="{{$percent2}}">
                          <p class="skillbar-bar blue-bg"></p>
                          <span class="skill-bar-percent"></span> 
                      </div>    
                      <!-- Start Skill Bar -->
                      <span class="skillbar-title" style="font-size: 16px">
                        @if (Config::get('app.locale') == 'th')
                            {{$shareindustrygroups[3]->nameth}}
                        @else
                            {{$shareindustrygroups[3]->nameeng}}
                        @endif
                      </span>
                      @php
                      $percent3 = 0;
                          if($total != 0){
                              $percent3= round($shareindustrygroups[3]->companybelong/$total*100);
                          }
                      @endphp
                      <div class="skillbar" data-percent="{{$percent3}}">
                          <p class="skillbar-bar pink-bg"></p>
                          <span class="skill-bar-percent"></span> 
                      </div>

                      <div class="btn-part mt-55">
                          <a class="readon started" href="{{url('').'/'.$sharehomepageindustrygrouptext->url}}">
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