<!DOCTYPE html>
<html lang="zxx">  
    
<head>
        <!-- meta tag -->
        <meta charset="utf-8">
        <title>TTRS - {{$page->name}}</title>
        <meta name="description" content="">
        <!-- responsive tag -->
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon -->
        <link rel="apple-touch-icon" href="apple-touch-icon.html">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/landing2/images/favicon.png')}}">
        <!-- Bootstrap v4.4.1 css -->

        @include('layouts.landing2.css')

    </head>
    <body class="defult-home">
        
        <!--Preloader area start here-->
        <div id="loader" class="loader">
            <div class="loader-container"></div>
        </div>
        <!--Preloader area End here--> 
     
    <!-- Main content Start -->
        <div class="main-content">
            
            
            <!--Full width header Start-->
            {{-- @include('layouts.landing2.header') --}}
            <!--Full width header End-->
         
            <!-- Banner Section Start -->
            {{-- @include('layouts.landing2.banner') --}}
            <!-- Banner Section End -->

    <!-- Main content Start -->
    {{-- <div class="main-content"> --}}
        
        <!--Full width header Start-->
        <div class="full-width-header pd-140">
            <!--Header Start-->
            <header id="rs-header" class="rs-header style3 header-transparent">
                <!-- Topbar Area Start -->
                <div class="bg-transparent topbar-area style2 modify1">
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
                                            @if (Config::get('app.locale') == 'th')
                                                  <a href="tel:{{$generalinfo->phone1}}">{{$generalinfo->phone1}} ต่อ {{$generalinfo->phone1_ext}}</a>
                                              @else
                                                  <a href="tel:{{$generalinfo->phone1}}">{{$generalinfo->phone1}} Ext {{$generalinfo->phone1_ext}}</a>
                                              @endif
                                        </li>
                                        @if ($generalinfo->showsocialmedia == 1)
                                            @if (!Empty($generalinfo->facebook)) <a href="{{$generalinfo->facebook}}" class="mr-2"><i class="fa fa-facebook text-white"></i></a> @endif
                                            @if (!Empty($generalinfo->twitter)) <a href="{{$generalinfo->twitter}}" class="mr-2"><i class="fa fa-twitter text-white"></i></a> @endif
                                            @if (!Empty($generalinfo->youtube)) <a href="{{$generalinfo->youtube}}" class="mr-2"><i class="fa fa-youtube text-white"></i></a> @endif
                                            @if (!Empty($generalinfo->instagram)) <a href="{{$generalinfo->instagram}}" class="mr-2"><i class="fa fa-instagram text-white"></i></a>@endif  
                                        @endif
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
                <div class="bg-transparent menu-area menu-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-2">
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
                            <div class="col-lg-10 text-right"> 
                                <div class="rs-menu-area">
                                    <div class="main-menu">
                                        <nav class="rs-menu pr-70 md-pr-0">
                                            <ul id="onepage-menu" class="nav-menu">
                                                @foreach($directmenus2 as $key => $menu)
                                                    @php
                                                        $menuurl = url('').'/'.$menu->url;
                                                        if(filter_var($menu->url, FILTER_VALIDATE_URL) == true){
                                                            $menuurl = $menu->url;
                                                        }
                                                    @endphp
                                                    @if (Config::get('app.locale') == 'th')
                                                        @if ($key == 0)
                                                                <li> <a href="{{url('')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->name}}</a></li>
                                                            @else
                                                                @if ($menu->name != 'เข้าสู่ระบบ')
                                                                    @if (substr("$menu->url",0,1) == '#')
                                                                        @if ($menu->menu_type_id == 2)
                                                                                <li class="menu-item-has-children"> <a href="{{url('').'/'.$menu->url}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->name}}</a>
                                                                                    @if (count($directmenus2->where('submenu',$menu->id)) > 0)
                                                                                        <ul class="sub-menu">
                                                                                            @foreach ($directmenus2->where('submenu',$menu->id) as $submenu)
                                                                                                @php
                                                                                                    $_menuurl = url('').'/'.$submenu->url;
                                                                                                    if(filter_var($submenu->url, FILTER_VALIDATE_URL) == true){
                                                                                                        $_menuurl = $submenu->url;
                                                                                                    }
                                                                                                @endphp
                                                                                                <li ><a href="{{$_menuurl}}" style="font-family: kanit; font-weight:200; font-size:18px">{{$submenu->name}}</a> </li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    @endif
                                                                                </li>
                                                                            @elseif($menu->menu_type_id != 3)
                                                                                <li> <a href="{{url('').'/'.$menu->url}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->name}}</a></li>
                                                                        @endif
                                                                @else
                                                                    @if ($menu->menu_type_id == 2)
                                                                        <li class="menu-item-has-children"> <a href="{{$menuurl}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->name}}</a>
                                                                            @if (count($directmenus2->where('submenu',$menu->id)) > 0)
                                                                                <ul class="sub-menu">
                                                                                    @foreach ($directmenus2->where('submenu',$menu->id) as $submenu)
                                                                                        @php
                                                                                            $_menuurl = url('').'/'.$submenu->url;
                                                                                            if(filter_var($submenu->url, FILTER_VALIDATE_URL) == true){
                                                                                                $_menuurl = $submenu->url;
                                                                                            }
                                                                                        @endphp
                                                                                        <li ><a href="{{$_menuurl}}" style="font-family: kanit; font-weight:200; font-size:18px">{{$submenu->name}}</a> </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            @endif
                                                                        </li>
                                                                    @elseif($menu->menu_type_id != 3)
                                                                        <li> <a href="{{$menuurl}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->name}}</a></li>
                                                                    @endif
                                                                @endif      
                                                            @else
                                                                @if (Empty($shareagent->isDesktop()))
                                                                    <li>
                                                                        @if (!Auth::check())
                                                                            <a href="{{route('login')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->name}}</a>
                                                                        @else
                                                                            @if (Auth::user()->user_type_id >= 4)
                                                                                <a href="{{route('dashboard.admin.report')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{trans('lang.dashboard')}}</a>
                                                                            @elseif(Auth::user()->user_type_id == 3)
                                                                                <a href="{{route('dashboard.expert.report')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{trans('lang.dashboard')}}</a>
                                                                            @elseif(Auth::user()->user_type_id == 1)
                                                                                <a href="{{route('dashboard.company.report')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{trans('lang.dashboard')}}</a>
                                                                            @elseif(Auth::user()->user_type_id == 0)
                                                                                <a href="{{route('setting.admin.user')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{trans('lang.dashboard')}}</a>
                                                                            @endif
                                                                        @endif
                                                                    </li>
                                                                    {{-- @if (Auth::check())
                                                                        <li>
                                                                            <a href="{{route('logout')}}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-family: kanit; font-weight:200; font-size:20px"><i class="fa fa-sign-out" aria-hidden="true"></i> ออกจากระบบ
                                                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                                    @csrf
                                                                                </form>
                                                                            </a>   
                                                                        </li>
                                                                    @endif --}}
                                                                @endif
                                                        @endif                                                      
                                                        @endif
                                                    @else
                                                        @if ($key == 0)
                                                                <li> <a href="{{url('')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->engname}}</a></li>
                                                                @else
                                                                @if ($menu->name != 'เข้าสู่ระบบ')
                                                                    @if (substr("$menu->url",0,1) == '#')
                                                                        @if ($menu->menu_type_id == 2)
                                                                                <li class="menu-item-has-children"> <a href="{{url('').'/'.$menu->url}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->engname}}</a>
                                                                                    @if (count($directmenus2->where('submenu',$menu->id)) > 0)
                                                                                        <ul class="sub-menu">
                                                                                            @foreach ($directmenus2->where('submenu',$menu->id) as $submenu)
                                                                                                @php
                                                                                                    $_menuurl = url('').'/'.$submenu->url;
                                                                                                    if(filter_var($submenu->url, FILTER_VALIDATE_URL) == true){
                                                                                                        $_menuurl = $submenu->url;
                                                                                                    }
                                                                                                @endphp
                                                                                                <li ><a href="{{$_menuurl}}" style="font-family: kanit; font-weight:200; font-size:18px">{{$submenu->engname}}</a> </li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    @endif
                                                                                </li>
                                                                            @elseif($menu->menu_type_id != 3)
                                                                                <li> <a href="{{url('').'/'.$menu->url}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->engname}}</a></li>
                                                                        @endif
                                                                @else
                                                                    @if ($menu->menu_type_id == 2)
                                                                        <li class="menu-item-has-children"> <a href="{{$menuurl}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->engname}}</a>
                                                                            @if (count($directmenus2->where('submenu',$menu->id)) > 0)
                                                                                <ul class="sub-menu">
                                                                                    @foreach ($directmenus2->where('submenu',$menu->id) as $submenu)
                                                                                        @php
                                                                                            $_menuurl = url('').'/'.$submenu->url;
                                                                                            if(filter_var($submenu->url, FILTER_VALIDATE_URL) == true){
                                                                                                $_menuurl = $submenu->url;
                                                                                            }
                                                                                        @endphp
                                                                                        <li ><a href="{{$_menuurl}}" style="font-family: kanit; font-weight:200; font-size:18px">{{$submenu->engname}}</a> </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            @endif
                                                                        </li>
                                                                    @elseif($menu->menu_type_id != 3)
                                                                        <li> <a href="{{$menuurl}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->engname}}</a></li>
                                                                    @endif
                                                                @endif      
                                                            @else
                                                                @if (Empty($shareagent->isDesktop()))
                                                                <li>
                                                                    @if (!Auth::check())
                                                                        <a href="{{route('login')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->engname}}</a>
                                                                    @else
                                                                        @if (Auth::user()->user_type_id >= 4)
                                                                            <a href="{{route('dashboard.admin.report')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{trans('lang.dashboard')}}</a>
                                                                        @elseif(Auth::user()->user_type_id == 3)
                                                                            <a href="{{route('dashboard.expert.report')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{trans('lang.dashboard')}}</a>
                                                                        @elseif(Auth::user()->user_type_id == 1)
                                                                            <a href="{{route('dashboard.company.report')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{trans('lang.dashboard')}}</a>
                                                                        @elseif(Auth::user()->user_type_id == 0)
                                                                            <a href="{{route('setting.admin.user')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{trans('lang.dashboard')}}</a>
                                                                        @endif
                                                                    @endif
                                                                </li>
                                                                {{-- @if (Auth::check())
                                                                    <li>
                                                                        
                                                                            <a href="{{route('logout')}}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-family: kanit; font-weight:200; font-size:20px"><i class="fa fa-sign-out" aria-hidden="true"></i>Sign Out
                                                                            
                                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                                @csrf
                                                                            </form>
                                                                        
                                                                    </li>
                                                                @endif --}}
                                                                @endif
                                                            @endif                                                       
                                                        @endif
                                                    @endif
                                                @endforeach
                                   
                                                @if (Empty($shareagent->isDesktop()))
                          
                                                    @if (Auth::check())
                                                            @if (Config::get('app.locale') == 'th')
                                                                <li> <a href="{{route('logout2')}}" style="font-family: kanit; font-weight:200; font-size:20px">ออกจากระบบ</a></li>
                                                                <li><a href="{{route('change',['locale' => 'en'])}}" style="font-family: kanit; font-weight:200; font-size:20px"> English</a></li>
                                                            @else
                                                                <li> <a href="{{route('logout2')}}" style="font-family: kanit; font-weight:200; font-size:20px">Sign Out</a></li>
                                                                <li><a href="{{route('change',['locale' => 'th'])}}" style="font-family: kanit; font-weight:200; font-size:20px">ไทย</a></li>
                                                            @endif 
                                                        {{-- @else
                                                            @if (Config::get('app.locale') == 'th')
                                                                <li> <a href="{{route('login')}}" style="font-family: kanit; font-weight:200; font-size:20px">เข้าสู่ระบบ</a></li>
                                                                <li><a href="{{route('change',['locale' => 'en'])}}" style="font-family: kanit; font-weight:200; font-size:20px"> English</a></li>
                                                            @else
                                                                <li> <a href="{{route('login')}}" style="font-family: kanit; font-weight:200; font-size:20px">Log In</a></li>
                                                                <li><a href="{{route('change',['locale' => 'th'])}}" style="font-family: kanit; font-weight:200; font-size:20px">ไทย</a></li>
                                                            @endif  --}}
                                                    @endif
                                                  
                                                @endif
                                            </ul> 
                                        </nav>                                     
                                    </div> <!-- //.main-menu -->                               
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
                    {{-- <a href="index.html"><img src="assets/images/logo-dark.png" alt="logo"></a> --}}
                </div>
                <div class="offcanvas-text">
                </div>
            </nav>
            <!-- Canvas Menu end -->
        </div>
        <!--Full width header End-->
        <!-- Breadcrumbs Start -->
        <div class="rs-breadcrumbs img4 mt-0" style="height: 450px">
            <div class="breadcrumbs-inner text-center">
                <h1 class="page-title mt-50">@if (Config::get('app.locale') == 'th')
                    หน้าเพจ
                @else
                    Page
                @endif</h1>
                <ul>
                    <li>
                        <a class="active" href="{{url('')}}" style="font-size: 16px"> @if (Config::get('app.locale') == 'th')
                            หน้าแรก
                        @else
                            Home
                        @endif</a>
                    </li>
                   <li style="font-size: 16px">@if (Config::get('app.locale') == 'th')
                    {{$page->name}}
                @else
                    {{$page->name}}
                @endif</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumbs End -->
        
        <div class="rs-inner-blog pt-70 pb-120 md-pt-90 md-pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 pr-35 md-pr-15">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="blog-details">
                                   
                                    <div class="blog-full">
                                        <h2>@if (Config::get('app.locale') == 'th')
                                            {{$page->name}}
                                        @else
                                        {{$page->name}}
                                        @endif</h2>
                                
                                    </div>
                                    {{-- <div class="bs-img mb-35"> --}}
                                        {{-- <a href="#"><img src="{{asset($page->featureimage->name)}}" alt=""></a> --}}
                                    {{-- </div> --}}
                                    <div class="blog-full">
                                        <p>
                                         {!!$page->body!!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div> 
            </div>
        </div>
{{-- </div>  --}}
    <!-- Main content End -->


        </div> 
        <!-- Main content End -->
    

        <!-- Footer Start -->
        @include('layouts.landing2.footer')
        <!-- Footer End -->

        <!-- start scrollUp  -->
        <div id="scrollUp" class="orange-color">
            <i class="fa fa-angle-up"></i>
        </div>
        <!-- End scrollUp  -->

        <!-- Search Modal Start -->
        <div aria-hidden="true" class="modal fade search-modal" role="dialog" tabindex="-1">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="flaticon-cross"></span>
            </button>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="search-block clearfix">
                        <form>
                            <div class="form-group">
                                <input class="form-control" placeholder="Search Here..." type="text">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search Modal End -->
        {{-- {{asset('assets/landing2/css/responsive.css')}} --}}
         <!-- modernizr js -->
         @include('layouts.landing2.js')
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <script>
            function fbShare(url, title, descr, winWidth, winHeight) {
                var winTop = (screen.height / 2) - (winHeight / 2);
                var winLeft = (screen.width / 2) - (winWidth / 2);
                window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url , 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
            }
        </script>
    </body>

</html>