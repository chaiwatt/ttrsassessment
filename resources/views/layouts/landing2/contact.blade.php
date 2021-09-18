
<!DOCTYPE html>
<html lang="zxx">  
    
<head>
        <!-- meta tag -->
        <meta charset="utf-8">
        <title>TTRS | สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)</title>
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
                                                                @if ($shareagent->isPhone() == 1)
                                                                <li>
                                                                    @if (!Auth::check())
                                                                        <a href="{{route('login')}}" style="font-family: kanit; font-weight:200; font-size:20px">{{$menu->engname}}</a>
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
                                                    @endif
                                                @endforeach
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
                    {{-- <p>{{$servicepage->titleth}}</p> --}}
                </div>

            </nav>
            <!-- Canvas Menu end -->
        </div>
        <!--Full width header End-->
        <!-- Breadcrumbs Start -->
        <div class="rs-breadcrumbs img4 mt-0" style="height: 450px">
            <div class="breadcrumbs-inner text-center">
                <h1 class="page-title mt-50">@if (Config::get('app.locale') == 'th')
                    ติดต่อเรา
                @else
                    Contact
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
                    ติดต่อเรา
                @else
                Contact
                @endif</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumbs End -->
        
        <div class="rs-contact pt-100 md-pt-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 ">
                       <div class="contact-box">
                         
                            <div class="address-box mb-25">
                                <div class="address-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="address-text">
                                    <span class="label" style="font-weight: 300">
                                        @if (Config::get('app.locale') == 'th')
                                            โทรศัพท์:
                                        @else
                                            Phone:
                                        @endif
                                </span>
                                    <a href="#">0-2564-7000 
                                        @if (Config::get('app.locale') == 'th')
                                            ต่อ
                                        @else
                                            ext
                                        @endif 
                                    1411-1417</a>
                                </div>
                            </div>
                            <div class="address-box mb-25">
                                <div class="address-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="address-text">
                                    <span class="label" style="font-weight: 300">
                                        @if (Config::get('app.locale') == 'th')
                                        โทรสาร:
                                        @else
                                        fax:
                                        @endif 
                                </span>
                                    <a href="#">0-2564-7001</a>
                                </div>
                            </div>
                            <div class="address-box mb-25">
                                <div class="address-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="address-text">
                                    <span class="label" style="font-weight: 300">Call Center:</span>
                                    <a href="#">0-2564-8000</a>
                                </div>
                            </div>
                           <div class="address-box mb-25">
                               <div class="address-icon">
                                   <i class="fa fa-envelope"></i>
                               </div>
                               <div class="address-text">
                                <span class="label" style="font-weight: 300">
                                    @if (Config::get('app.locale') == 'th')
                                    อีเมล:
                                    @else
                                    email:
                                    @endif 
                                </span>
                                    <a href="tel:123222-8888">ttrs@nstda.or.th</a>
                               </div>
                           </div>

                       </div>
                    </div> 
                    <div class="col-lg-8 pl-70 md-pl-15">
                        @if (Session::has('success'))
                            <div class="sec-title2 text-center mb-45">
                                <span class="sub-text style-bg" style="background-color: green;color:white">
                                    @if (Config::get('app.locale') == 'th')
                                    เราได้รับข้อความของคุณแล้วค่ะ
                                                @else
                                                We received your message.
                                                @endif 
                                    
                                </span>
                            </div>
                        
                        @endif
                   
                        <div class="contact-widget">
                           <div class="sec-title2 mb-40">
                               <h2 class="title testi-title" style="font-size: 24px">
                                @if (Config::get('app.locale') == 'th')
                                สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)
                                @else
                                National Science and Technology Development Agency : NSTDA.
                                @endif 
                                </h2>
                              
                               
                                <span class="sub-text mt-10" style="font-size: 18px;margin-top:20px ">
                                    @if (Config::get('app.locale') == 'th')
                                    111 อุทยานวิทยาศาสตร์ประเทศไทย ถนนพหลโยธิน ตำบลคลองหนึ่ง อำเภอคลองหลวง จังหวัดปทุมธานี 12120
                                    @else
                                    111 Thailand Science Park Phahonyothin Rd, Khlong Luang District, Pathum Thani 12120
                                    @endif 
                                    </span>
                            
                           </div>
                            <div id="form-messages"></div>
                            <form method="post" action="{{route('landing.addcontact')}}">
                                @csrf
                                <fieldset>
                                    <div class="row">
                                        <div class="col-lg-6 mb-30 col-md-6 col-sm-6">
                                            <input class="from-control stringformat30" type="text" id="name" name="name" placeholder="@if(Config::get('app.locale') == 'th') ชื่อ @else name @endif*" required="">
                                        </div> 
                                        <div class="col-lg-6 mb-30 col-md-6 col-sm-6">
                                            <input class="from-control stringformat30" type="text" id="email" name="email" placeholder="@if(Config::get('app.locale') == 'th') อีเมล @else email @endif*" required="">
                                        </div>   
                                        <div class="col-lg-6 mb-30 col-md-6 col-sm-6">
                                            <input class="from-control numeralformathphone" type="text" id="phone" name="phone" placeholder="@if(Config::get('app.locale') == 'th') เบอร์โทรศัพท์ @else phone @endif*" required="">
                                        </div>   
                                        <div class="col-lg-6 mb-30 col-md-6 col-sm-6">
                                            <input class="from-control stringformat30" type="text" id="Website" name="website" placeholder="@if(Config::get('app.locale') == 'th') เว็บไซต์ @else website @endif">
                                        </div>
                                  
                                        <div class="col-lg-12 mb-30">
                                            <textarea class="from-control stringformat200" id="message" name="message" placeholder="@if(Config::get('app.locale') == 'th') ข้อความ @else message @endif*" required=""></textarea>
                                            <span style="float:right"><i><small>
                                                @if (Config::get('app.locale') == 'th')
                                                *ต้องการ
                                                @else
                                                *require
                                                @endif 
                                            </small></i> </span>
                                        </div>
                                        
                                    </div>
                                    <div class="btn-part">                                            
                                        <div class="form-group mb-0">
                                            <input class="readon learn-more submit" type="submit" value="@if(Config::get('app.locale') == 'th') ส่งข้อความ @else Send @endif ">
                                        </div>
                                    </div> 
                                </fieldset>
                            </form> 
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mt-20">
                    <div class="col-lg-12 md-mb-60">
                        <label for="" style="font-size: 22px">
                            @if (Config::get('app.locale') == 'th')
                            แผนที่การเดินทาง อุทยานวิทยาศาสตร์ประเทศไทย
                            @else
                            Science Park Map
                            @endif
                                    </label>
                        
                        <img src="{{asset('assets/landing2/images/map-nstda-scaled.jpg')}}" alt="">
                        <img src="{{asset('assets/landing2/images/map-scipark.jpg')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="map-canvas pt-120 md-pt-80">
                <iframe loading="lazy" class="embed-responsive-item" style="border: 0;" tabindex="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3870.0036987338754!2d100.59944871595559!3d14.07695879346525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e27f94917b26d3%3A0x5309db1a3574088d!2z4Liq4Liz4LiZ4Lix4LiB4LiH4Liy4LiZ4Lie4Lix4LiS4LiZ4Liy4Lin4Li04LiX4Lii4Liy4Lio4Liy4Liq4LiV4Lij4LmM4LmB4Lil4Liw4LmA4LiX4LiE4LmC4LiZ4LmC4Lil4Lii4Li14LmB4Lir4LmI4LiH4LiK4Liy4LiV4Li0!5e0!3m2!1sth!2sth!4v1599718330629!5m2!1sth!2sth" width="600" height="450" frameborder="0" allowfullscreen="allowfullscreen" aria-hidden="false"></iframe>
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
        <script src="{{asset('assets/dashboard/js/plugins/sweetalert2/sweetalert2.js')}}"></script>
        <script src="{{asset('assets/dashboard/js/plugins/cleave/cleave.min.js')}}"></script>
        <script src="{{asset('assets/dashboard/js/app/helper/inputformat.js')}}"></script>
        <script>
            function fbShare(url, title, descr, winWidth, winHeight) {
                var winTop = (screen.height / 2) - (winHeight / 2);
                var winLeft = (screen.width / 2) - (winWidth / 2);
                window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url , 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
            }

            $(document).on('change', '#phone', function(e) {
                if(($(this).val().length < 9 || $(this).val().length > 10) || $(this).val().charAt(0) != '0'){
                    Swal.fire({
                        title: 'ผิดพลาด',
                        text: 'กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง!',
                    });
                    $(this).val('')
                    return;
                }
            });

            $(document).on('change', '#email', function(e) {
                if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test($(this).val())== false)
                {
                    Swal.fire({
                        title: 'ผิดพลาด',
                        text: 'รูปแบบอีเมลไม่ถูกต้อง!',
                        });
                    $(this).val('') ;
                    return;
                }
            });
        </script>
    </body>

</html>












