<div class="full-width-header">
    <!--Header Start-->
    <header id="rs-header" class="rs-header style3 header-transparent">
        <!-- Topbar Area Start -->
        <div class="topbar-area style2 modify1">
           <div class="container">
               <div class="row y-middle">
                   <div class="col-lg-7">
                       <div class="topbar-contact">
                          <ul>
                              <li>
                                  <i class="flaticon-email"></i>
                                  <a href="mailto:{{$generalinfo->email}}" style="font-size: 16px"> {{$generalinfo->email}}</a>
                              </li>
                              <li>
                                  <i class="flaticon-call"></i>
                                  <a href="tel:{{$generalinfo->phone1}}" style="font-size: 16px">{{$generalinfo->phone1}}</a>
                              </li>
                          </ul>
                       </div>
                   </div>
                   <div class="col-lg-5 text-right">
                       <div class="toolbar-sl-share ">
                           <ul>
                                <li>
                                    @if (!Auth::check())
                                    <a href="{{route('register')}}" style="font-size: 16px"><i class="fa fa-user" aria-hidden="true"></i> 
                                        {{trans('lang.register')}} &nbsp;&nbsp;
                                    <a href="{{route('login')}}" style="font-size: 16px"><i class="fa fa-sign-in" aria-hidden="true"></i> 
                                        {{trans('lang.login')}}
                                    @else
                                        @if (Auth::user()->user_type_id >= 4)
                                            <a href="{{route('dashboard.admin.report')}}" class="linkedin sarabun" style="text-decoration: none" ><i class="fa fa-user"></i> <span style="font-size: 16px"> {{trans('lang.dashboard')}}</span> </a>
                                        @elseif(Auth::user()->user_type_id == 3)
                                            <a href="{{route('dashboard.expert.report')}}" class="linkedin sarabun" style="text-decoration: none" style="font-size: 16px"><i class="fa fa-user"></i> <span style="font-size: 16px"> {{trans('lang.dashboard')}}</span> </a>
                                        @else
                                            <a href="{{route('dashboard.company.report')}}" class="linkedin sarabun" style="text-decoration: none" style="font-size: 16px"><i class="fa fa-user"></i> <span style="font-size: 16px"> {{trans('lang.dashboard')}}</span> </a>
                                        @endif

                                        &nbsp
                                        <a href="{{route('logout')}}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-size: 16px"><i class="fa fa-sign-out" aria-hidden="true"></i> 
                                                {{trans('lang.signout')}}
                                            
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                            @endif
                                        </a>
                            </li>
                                <li>
                                    {{-- @if (Config::get('app.locale') == 'th') --}}
                                        <li><a href="{{route('change',['locale' => 'th'])}}" class="thai-font" style="font-size: 16px"><img class="flag" src="{{asset('assets/landing2/images/flag/thflag.png')}}" alt=""> ไทย</a></li>
                                    {{-- @else --}}
                                        <li><a href="{{route('change',['locale' => 'en'])}}" class="thai-font" style="font-size: 16px"><img class="flag" src="{{asset('assets/landing2/images/flag/usflag.png')}}" alt=""> English</a></li>
                                    {{-- @endif --}}
                                </li>
                        
                           </ul>
                       </div>
                   </div>
               </div>
           </div>
       </div>
        <!-- Topbar Area End -->
        <!-- Menu Start -->
        <div class="menu-area menu-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="logo-part">
                            <a href="{{url('')}}">
                                <img class="normal-logo" src="{{asset($generalinfo->logo2)}}" alt="logo">  
                                <img class="sticky-logo" src="{{asset($generalinfo->logo)}}" alt="logo">
                            </a>
                        </div>
                        <div class="mobile-menu">
                            <a href="#" class="rs-menu-toggle rs-menu-toggle-close">
                                <i class="fa fa-bars"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-9 text-right"> 
                        <div class="rs-menu-area">
                            <div class="main-menu">
                                <nav class="rs-menu pr-0 md-pr-0">
                                    <ul id="onepage-menu" class="nav-menu">
                                        @foreach($directmenus2 as $key => $menu)
                                            @if (Config::get('app.locale') == 'th')
                                                @if ($key == 0)
                                                        <li> <a href="{{url('')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->name}}</a></li>
                                                    @else
                                                        @if ($menu->name != 'เข้าสู่ระบบ')
                                                                @if (substr("$menu->url",0,1) == '#')
                                                                        <li> <a href="{{url('').'/'.$menu->url}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->name}}</a></li>
                                                                    @else
                                                                        <li> <a href="//{{$menu->url}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->name}}</a></li>
                                                                @endif    
                                                            @else
                                                                @if ($shareagent->isPhone() == 1)
                                                                    <li>
                                                                        @if (!Auth::check())
                                                                            <a href="{{route('login')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->name}}</a>
                                                                        @else
                                                                            @if (Auth::user()->user_type_id >= 4)
                                                                                <a href="{{route('dashboard.admin.report')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{trans('lang.dashboard')}}</a>
                                                                            @elseif(Auth::user()->user_type_id == 3)
                                                                                <a href="{{route('dashboard.expert.report')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{trans('lang.dashboard')}}</a>
                                                                            @else
                                                                                <a href="{{route('dashboard.company.report')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{trans('lang.dashboard')}}</a>
                                                                            @endif
                                                                        @endif
                                                                    </li>
                                                                @endif
                                                        @endif                                                      
                                                @endif
                                            @else
                                                @if ($key == 0)
                                                        <li> <a href="{{url('')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->engname}}</a></li>
                                                    @else
                                                    @if ($menu->name != 'เข้าสู่ระบบ')
                                                        <li> <a href="{{url('').'/'.$menu->url}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->engname}}</a></li>
                                                    @else
                                                        @if ($shareagent->isPhone() == 1)
                                                            <li> <a href="{{url('').'/'.$menu->url}}" style="font-family: kanit; font-weight:200; font-size:20px">{{trans('lang.login')}}</a></li>
                                                        @endif
                                                    @endif                                                       
                                                @endif
                                            @endif
                                        @endforeach
                                    </ul> 
                                </nav>                                     
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu End -->
    </header>
    <!--Header End-->
    <!-- Canvas Menu start -->
    <nav class="right_menu_togle hidden-md">
        <div class="close-btn"><span id="nav-close" class="text-center"><i class="fa fa-close"></i></span></div>
        <div class="canvas-logo">
            <a href="index.html"><img src="{{asset($generalinfo->logo)}}" alt="logo"></a>
        </div>
        <div class="offcanvas-text">
            <p>111 อุทยานวิทยาศาสตร์ประเทศไทย ถ.พหลโยธิน ตำบลคลองหนึ่ง อำเภอคลองหลวง จังหวัดปทุมธานี 12120</p>
        </div>
        {{-- <div class="canvas-contact">
            <h5 class="canvas-contact-title">Contact Info</h5>
            <ul class="contact">
                <li><i class="fa fa-globe"></i>Middle Badda, Dhaka, BD</li>
                <li><i class="fa fa-phone"></i>+123445789</li>
                <li><i class="fa fa-envelope"></i><a href="mailto:info@yourcompany.com">info@yourcompany.com</a></li>
                <li><i class="fa fa-clock-o"></i>10:00 AM - 11:30 PM</li>
            </ul>
            <ul class="social">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
        </div> --}}

    </nav>
    <!-- Canvas Menu end -->
    
</div>

