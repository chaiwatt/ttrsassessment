<div id="rs-performance" class="rs-about style2 pt-110 pb-120 md-pt-75 md-pb-80">
    <div class="image-part">
       <img src="{{asset($sharehomepageindustrygrouptext->picture)}}" data-aos="fade-right" alt="about"> 
    </div> 
    <div class="container">
        <div class="row" style="min-height:470px">
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
                      @php
                          $total = $shareindustrygroups->sum('companybelong');
                          $c = 0;
                      @endphp

                    @foreach ($shareindustrygroupcollections->sortByDesc('occured')->take(4) as $key => $industrygroup)
                        @php
                            $bg = '';
                            if($c == 1){
                                $bg = 'paste-bg';
                            }else if($c == 2){
                                $bg = 'blue-bg';
                            }else if($c == 3){
                                $bg = 'pink-bg';
                            }
                            $c++;
                        @endphp
                        <span class="skillbar-title">
                            @if (Config::get('app.locale') == 'th')
                                {{$industrygroup['thname']}} ({{$industrygroup['occured']}} โครงการ)
                            @else
                            {{$industrygroup['engname']}} ({{$industrygroup['occured']}} projects)
                            @endif
                        </span>
                        @php
                            $percent = 0;
                            if($industrygroup['total'] != 0){
                                $percent = round($industrygroup['occured']/$industrygroup['total']*100);
                            }
                        @endphp
                        <div class="skillbar" data-percent="{{$percent}}">
                            <p class="skillbar-bar {{$bg}}"></p>
                            <span class="skill-bar-percent"></span> 
                        </div>
                    @endforeach

           
 

                      <div class="btn-part mt-55">
                          @if (!Empty($sharehomepageindustryurl))
                          <a class="readon started" href="{{$sharehomepageindustryurl->url}}">
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
               
               <!-- Skillbar Section End -->
            </div>
        </div>
    </div>
</div>