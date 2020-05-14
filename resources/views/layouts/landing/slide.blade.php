<div class="slider-container light rev_slider_wrapper" style="height: 650px;">
    <div id="revolutionSlider" class="slider rev_slider" data-version="5.4.8" data-plugin-revolution-slider data-plugin-options="{'delay': 9000, 'gridwidth': 1170, 'gridheight': 650, 'disableProgressBar': 'on', 'responsiveLevels': [4096,1200,992,500], 'navigation' : {'arrows': { 'enable': true, 'style': 'arrows-style-1 arrows-big arrows-dark' }, 'bullets': {'enable': false, 'style': 'bullets-style-1 bullets-color-primary', 'h_align': 'center', 'v_align': 'bottom', 'space': 7, 'v_offset': 70, 'h_offset': 0}}}">
        <ul>
            @foreach ($slides as $slide)
                @if ($slide->slide_style_id == 1)                  
                    <li data-transition="fade">
                        <img src="{{asset('assets/landing/img/slides/slide-corporate-3-2.jpg')}}"  
                            alt=""
                            data-bgposition="right center"
                            data-bgpositionend="center center"
                            data-bgfit="cover" 
                            data-bgrepeat="no-repeat" 
                            data-kenburns="on"
                            data-duration="9000"
                            data-ease="Linear.easeNone"
                            data-scalestart="110"
                            data-scaleend="100"
                            data-rotatestart="0"
                            data-rotateend="0"
                            data-offsetstart="0 0"
                            data-offsetend="0 0"
                            data-bgparallax="0"
                            class="rev-slidebg">
        
                        <div class="tp-caption font-weight-extra-bold text-color-dark negative-ls-2"
                            data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:1.5;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
                            data-x="center"
                            data-y="center" data-voffset="['-50','-50','-50','-75']"
                            data-fontsize="['50','50','50','90']"
                            data-lineheight="['55','55','55','95']">                                
                            @if (Config::get('app.locale') == 'th')
                                {{ $slide->textone }}
                            @else
                                {{ $slide->textengone }}
                            @endif  
                        </div>
        
                        <div class="tp-caption font-weight-light text-color-dark"
                            data-frames='[{"from":"opacity:0;","speed":300,"to":"o:1;","delay":2000,"split":"chars","splitdelay":0.05,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
                            data-x="center"
                            data-y="center" 
                            data-fontsize="['18','18','18','50']"
                            data-lineheight="['20','20','20','55']"
                            style="color: #b5b5b5;">                            
                            @if (Config::get('app.locale') == 'th')
                                {{ $slide->texttwo }}
                            @else
                                {{ $slide->textengtwo }}
                            @endif  
                        </div>
        
                        <a class="tp-caption btn btn-primary font-weight-bold"
                            href="{{$slide->url}}"
                            data-frames='[{"delay":3000,"speed":2000,"frame":"0","from":"y:50%;opacity:0;","to":"y:0;o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
                            data-x="center" data-hoffset="0"
                            data-y="center" data-voffset="70"
                            data-paddingtop="['15','15','15','30']"
                            data-paddingbottom="['15','15','15','30']"
                            data-paddingleft="['40','40','40','57']"
                            data-paddingright="['40','40','40','57']"
                            data-fontsize="['13','13','13','25']"
                            data-lineheight="['20','20','20','25']">
                            @if (Config::get('app.locale') == 'th')
                                {{ $slide->textthree}}
                            @else
                                {{ $slide->textengthree }}
                            @endif  
                        <i class="fas fa-arrow-right ml-1"></i></a>
                    </li>
                @else
                    <li data-transition="fade">
                        <img src="{{asset('assets/landing/img/slides/slide-corporate-3-1.jpg')}}"  
                            alt=""
                            data-bgposition="center center" 
                            data-bgfit="cover" 
                            data-bgrepeat="no-repeat" 
                            class="rev-slidebg">
        
                        <h1 class="tp-caption font-weight-extra-bold text-color-dark negative-ls-2"
                            data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:1.5;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
                            data-x="['left','left','center','center']" data-hoffset="['152','152','0','0']"
                            data-y="center"
                            data-fontsize="['50','50','50','90']"
                            data-lineheight="['55','55','55','95']"
                            data-letterspacing="-1">
                                @if (Config::get('app.locale') == 'th')
                                    {{ $slide->textone }}
                                @else
                                    {{ $slide->textengone }}
                                @endif   
                            </h1>

                        <div class="tp-caption font-weight-light text-color-dark"
                            data-frames='[{"from":"opacity:0;","speed":300,"to":"o:1;","delay":2000,"split":"chars","splitdelay":0.05,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
                            data-x="['left','left','center','center']" data-hoffset="['166','166','0','0']"
                            data-y="center" data-voffset="['40','40','40','80']"
                            data-fontsize="['18','18','18','50']"
                            data-lineheight="['20','20','20','55']">
                            @if (Config::get('app.locale') == 'th')
                                {{ $slide->texttwo }}
                            @else
                                {{ $slide->textengtwo }}
                            @endif 
                        </div>
        
                        <a class="tp-caption btn btn-primary font-weight-bold"
                            href="{{$slide->url}}"
                            data-frames='[{"delay":3000,"speed":2000,"frame":"0","from":"y:50%;opacity:0;","to":"y:0;o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
                            data-x="center" data-hoffset="-280"
                            data-y="center" data-voffset="95"
                            data-paddingtop="['15','15','15','30']"
                            data-paddingbottom="['15','15','15','30']"
                            data-paddingleft="['40','40','40','57']"
                            data-paddingright="['40','40','40','57']"
                            data-fontsize="['13','13','13','25']"
                            data-lineheight="['20','20','20','25']">
                            @if (Config::get('app.locale') == 'th')
                                {{ $slide->textthree}}
                            @else
                                {{ $slide->textengthree }}
                            @endif
                        <i class="fas fa-arrow-right ml-1"></i></a>               
                    </li>  
                @endif
            @endforeach
        </ul>
    </div>
</div>