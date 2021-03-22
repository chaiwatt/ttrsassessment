<div class="full-width-header">
    <!--Header Start-->
    <header id="rs-header" class="rs-header style3 header-transparent">
        <!-- Topbar Area Start -->
        <div class="topbar-area style2 modify1">
           <div class="container">
               <div class="row y-middle">
                   <div class="col-lg-8">
                       <div class="topbar-contact">
                          <ul>
                              <li>
                                  <i class="flaticon-email"></i>
                                  <a href="mailto:{{$generalinfo->email}}">{{$generalinfo->email}}</a>
                              </li>
                              <li>
                                  <i class="flaticon-call"></i>
                                  <a href="tel:{{$generalinfo->phone1}}">{{$generalinfo->phone1}}</a>
                              </li>
                              {{-- <li>
                                  <i class="flaticon-location"></i>
                                  05 kandi BR. New York
                              </li> --}}
                          </ul>
                       </div>
                   </div>
                   <div class="col-lg-4 text-right">
                       <div class="toolbar-sl-share ">
                           <ul>
                                {{-- <li class="opening"> <em><i class="flaticon-clock"></i> 08:00am-6:00pm</em> </li> --}}
                                <li>
                                    @if (!Auth::check())
                                        <a href="{{route('login')}}" ><i class="fa fa-sign-in" aria-hidden="true"></i> 
                                        {{trans('lang.login')}}
                                    @else
                                        @if (Auth::user()->user_type_id >= 4)
                                            <a href="{{route('dashboard.admin.report')}}" class="linkedin sarabun" style="text-decoration: none"><i class="fa fa-user"></i> {{trans('lang.dashboard')}} </a>
                                        @elseif(Auth::user()->user_type_id == 3)
                                            <a href="{{route('dashboard.expert.report')}}" class="linkedin sarabun" style="text-decoration: none"><i class="fa fa-user"></i> {{trans('lang.dashboard')}} </a>
                                        @else
                                            <a href="{{route('dashboard.company.report')}}" class="linkedin sarabun" style="text-decoration: none"><i class="fa fa-user"></i> {{trans('lang.dashboard')}} </a>
                                        @endif

                                        &nbsp
                                        <a href="{{route('logout')}}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> 
                                                {{trans('lang.signout')}}
                                            
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                            @endif
                                        </a>
                            </li>
                                <li>
                                    @if (Config::get('app.locale') == 'th')
                                        <li><a href="{{route('change',['locale' => 'en'])}}"><i class="fa fa-reply-all"></i> ไทย</a></li>
                                    @else
                                        <li><a href="{{route('change',['locale' => 'th'])}}"><i class="fa fa-reply-all"></i> English</a></li>
                                    @endif
                                </li>
                                
                              
                               
                                {{-- <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li> --}}
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
                            <a href="index.html">
                                <img class="normal-logo" src="{{asset($generalinfo->logo)}}" alt="logo">  
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
                                <nav class="rs-menu pr-70 md-pr-0">
                                    <ul id="onepage-menu" class="nav-menu">
                                        @foreach($directmenus2 as $key => $menu)
                                            {{-- <li ><a href="{{url('/').'/'.$menu->url}}" class="sarabun">@if (Config::get('app.locale') == 'th') {{ $menu->name }} @else {{ $menu->engname }} @endif</a></li> --}}
                                            
                                            @if (Config::get('app.locale') == 'th')
                                                <li> <a href="{{$menu->url}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->name}}</a></li>
                                            @else
                                                <li> <a href="{{$menu->url}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->engname}}</a></li>
                                            @endif
                                        @endforeach
                                        {{-- <li> <a href="#rs-header" style="font-family: kanit; font-weight:200; font-size:20px">หน้าแรก</a></li>
                                        <li><a href="#rs-services" style="font-family: kanit; font-weight:200;font-size:20px">การลงทะเบียน</a></li>
                                        <li><a href="#rs-industrygrop" style="font-family: kanit; font-weight:200;font-size:20px">กลุ่มอุตสาหกรรม</a></li>
                                        <li><a href="#rs-blog" style="font-family: kanit; font-weight:200;font-size:20px">ข่าว</a></li>
                                        <li><a href="#rs-faq" style="font-family: kanit; font-weight:200;font-size:20px">คำถามพบบ่อย</a></li>
                                        <li><a href="#rs-contact" style="font-family: kanit; font-weight:200;font-size:20px">ติดต่อ</a></li> --}}
                                    </ul> <!-- //.nav-menu -->
                                </nav>                                     
                            </div> <!-- //.main-menu -->
                            {{-- <div class="expand-btn-inner search-icon hidden-md">
                                <ul>
                                    <li class="sidebarmenu-search">
                                        <a class="hidden-xs rs-search" data-target=".search-modal" data-toggle="modal" href="#">
                                            <i class="flaticon-search"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>                                 --}}
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
            <p>Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ‘Content here, content here’, making it look like readable English.</p>
        </div>
        <div class="canvas-contact">
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
        </div>
    </nav>
    <!-- Canvas Menu end -->
</div>