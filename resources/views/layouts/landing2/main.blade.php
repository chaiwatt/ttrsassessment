<!DOCTYPE html>
<html lang="zxx">  
    
<head>
        <!-- meta tag -->
        <meta charset="utf-8">
        <title>TTRS - TTRS rating</title>
        <meta name="description" content="">
        <!-- responsive tag -->
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon -->
        <link rel="apple-touch-icon" href="apple-touch-icon.html">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/landing2/images/fav.png')}}">
        <!-- Bootstrap v4.4.1 css -->

        <link rel="stylesheet" type="text/css" href="{{asset('assets/landing2/css/bootstrap.min.css')}}">
        <!-- font-awesome css -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/landing2/css/font-awesome.min.css')}}">
        <!-- flaticon css -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/landing2/fonts/flaticon.css')}}">
        <!-- animate css -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/landing2/css/animate.css')}}">
        <!-- owl.carousel css -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/landing2/css/owl.carousel.css')}}">
        <!-- slick css -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/landing2/css/slick.css')}}">
        <!-- off canvas css -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/landing2/css/off-canvas.css')}}">
        <!-- magnific popup css -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/landing2/css/magnific-popup.css')}}">
        <!-- Main Menu css -->
        <link rel="stylesheet" href="{{asset('assets/landing2/css/rsmenu-main.css')}}">
        <!-- spacing css -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/landing2/css/rs-spacing.css')}}">
        <!-- style css -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/landing2/css/style.css')}}"> <!-- This stylesheet dynamically changed from style.less -->
        <!-- responsive css -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/landing2/css/responsive.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/landing2/css/extend.css')}}">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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
                                              <a href="mailto:support@rstheme.com">{{$generalinfo->email}}</a>
                                          </li>
                                          <li>
                                              <i class="flaticon-call"></i>
                                              <a href="tel:++1(990)999–5554">{{$generalinfo->phone1}}</a>
                                          </li>
                                          {{-- <li>
                                              <i class="flaticon-location"></i>
                                              05 kandi BR. New York
                                          </li> --}}
                                      </ul>
                                   </div>
                               </div>
                               <div class="col-lg-4 text-right">
                                   <div class="toolbar-sl-share">
                                       <ul>
                                            {{-- <li class="opening"> <em><i class="flaticon-clock"></i> 08:00am-6:00pm</em> </li> --}}
                                            <li><a href="#" style="; font-size:16px"><i class="fa fa-sign-in" aria-hidden="true"></i> เข้าสู่ระบบ</a></li>
                                            <li><a href="#"><i class="fas fa-language"></i> ไทย</a></li>
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
                                            <img class="normal-logo" src="{{asset('assets/landing2/images/logo-light.png')}}" alt="logo">  
                                            <img class="sticky-logo" src="{{asset('assets/landing2/images/logo-dark.png')}}" alt="logo">
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
                                                    <li> <a href="#rs-header" style="font-family: kanit; font-weight:200; font-size:20px">หน้าแรก</a></li>
                                                    <li><a href="#rs-services" style="font-family: kanit; font-weight:200;font-size:20px">บริการ</a></li>
                                                    <li><a href="#rs-about" style="font-family: kanit; font-weight:200;font-size:20px">กลุ่มอุตสาหกรรม</a></li>
                                                    <li><a href="#rs-blog" style="font-family: kanit; font-weight:200;font-size:20px">ข่าว</a></li>
                                                    <li><a href="#rs-team" style="font-family: kanit; font-weight:200;font-size:20px">Faq</a></li>
                                                    <li><a href="#rs-footer" style="font-family: kanit; font-weight:200;font-size:20px">ติดต่อ</a></li>
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
                        <a href="index.html"><img src="{{asset('assets/landing2/images/logo-dark.png')}}" alt="logo"></a>
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
            <!--Full width header End-->
         
            <!-- Banner Section Start -->
            <div class="rs-banner style3 pt-100 pb-100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="banner-content">
                               {{-- <div class="sub-title">Secure & Clean Code</div> --}}
                               <h1 class="title">Thailand Technology Rating Support and Service (TTRS)</h1>
                                <p class="desc">
                                    ระบบการประเมินเทคโนโลยีของผู้ประกอบการ SMEs สะท้อนระดับเทคโนโลยีเพิ่มโอกาสเข้าถึงแหล่งเงินทุน TTRS
                                </p>
                                <ul class="banner-btn">
                                    <li><a class="readon started" href="{{route('register')}}">สมัคร</a></li>
                                    <li>
                                        <div class="rs-videos">
                                            <div class="animate-border white-color">
                                                <a class="popup-border popup-videos" href="https://www.youtube.com/watch?v=4Lp7YZilTrU">
                                                    <i class="fa fa-play"></i>
                                                </a>
                                            </div>
                                        </div> 
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>           
                <img class="d-none d-md-block images-part" src="{{asset('assets/landing2/images/banner/banner-3.png')}}" alt="">
            </div>
            <!-- Banner Section End -->
                
            <!-- Services Section Start -->
            <div id="rs-services" class="rs-services style3 pt-110 pb-120 md-pt-75 md-pb-80">
                <div class="container">
                    <div class="sec-title2 text-center mb-45">
                        {{-- <span class="sub-text">Services</span> --}}
                        <h2 class="title testi-title">
                            {{trans('lang.registrationprocess')}}
                        </h2>
                    </div>
                    <div class="row">

                    @foreach ($homepageservices as $key => $homepageservice)
                        <div class="col-lg-4 col-md-6 mb-20">
                            <div class="services-item {{$homepageservice->cardcolor}}">
                                <div class="services-icon">
                                    <div class="image-part">
                                        <img class="main-img" src="{{asset($homepageservice->iconnormal)}}" alt="">
                                        <img class="hover-img" src="{{asset($homepageservice->iconhover)}}" alt="">
                                    </div>
                                </div>
                                <div class="services-content">
                                    @if (Config::get('app.locale') == 'th')
                                            {{-- <h4 class="title sarabun"><a href="{{$homepageservice->link}}">{{$homepageservice->titlethai}}</a></h4>
                                            <p  id="sarabun" class="description sarabun">{{$homepageservice->descriptionthai}}</p> --}}

                                            <div class="services-text">
                                                <h3 class="title"><a href="web-development.html">{{$homepageservice->titlethai}}</a></h3>
                                            </div>
                                            <div class="services-desc">
                                                <p>
                                                    {{$homepageservice->descriptionthai}}
                                                </p>
                                            </div>
                                        @else
                                            {{-- <h4 class="title sarabun"><a href="">{{$homepageservice->titleeng}}</a></h4>
                                            <p  id="sarabun" class="description sarabun">{{$homepageservice->descriptioneng}}</p> --}}
                                            <div class="services-text">
                                                <h3 class="title"><a href="web-development.html">{{$homepageservice->titleeng}}</a></h3>
                                            </div>
                                            <div class="services-desc">
                                                <p>
                                                    {{$homepageservice->descriptioneng}}
                                                </p>
                                            </div>
                                    @endif


                                    <div class="serial-number">

                                         {{sprintf('%02d', $key+1)}}
                                     </div>
                                </div>
                            </div> 
                         </div>
                      @endforeach 

                    </div>
                </div>
            </div>
            <!-- Services Section End -->

            <!-- About Section Start -->
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
                                    กลุ่มอุตสาหกรรมที่ขอรับการประเมิน
                                </h2>
                                <div class="desc">
                                   Over 25 years working in IT services developing software applications and mobile apps for clients all over the world.
                                </div>
                            </div>
                            <!-- Skillbar Section Start -->
                           <div class="rs-skillbar style1 home4">
                               <div class="cl-skill-bar">
                                  <!-- Start Skill Bar -->
                                  <span class="skillbar-title">Next-generation Automotive</span>
                                  <div class="skillbar" data-percent="92">
                                      <p class="skillbar-bar"></p>
                                      <span class="skill-bar-percent"></span> 
                                  </div>
                                  <!-- Start Skill Bar -->
                                  <span class="skillbar-title">Smart Electronics</span>
                                  <div class="skillbar" data-percent="80">
                                      <p class="skillbar-bar paste-bg"></p>
                                      <span class="skill-bar-percent"></span> 
                                  </div>
                                  <!-- Start Skill Bar -->
                                  <span class="skillbar-title">Affluent, Medical and Wellness Tourism</span>
                                  <div class="skillbar" data-percent="95">
                                      <p class="skillbar-bar blue-bg"></p>
                                      <span class="skill-bar-percent"></span> 
                                  </div>    
                                  <!-- Start Skill Bar -->
                                  <span class="skillbar-title">Agriculture and Biotechnology</span>
                                  <div class="skillbar" data-percent="78">
                                      <p class="skillbar-bar pink-bg"></p>
                                      <span class="skill-bar-percent"></span> 
                                  </div>

                                  <div class="btn-part mt-55">
                                      <a class="readon started" href="{{route('register')}}">เพิ่มเติม</a>
                                  </div>
                              </div>
                           </div>
                           <!-- Skillbar Section End -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- About Section End -->


            <!-- Process Section Start -->
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
                                          4 หมวดการประเมิน
                                      </h2>
                                  </div>
                                  <div class="btn-part mt-40">
                                      <a class="readon started" href="{{route('register')}}">เพิ่มเติม</a>
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
                                              <p class="number-txt">  Quisque placerat vitae lacus ut scelerisque. Fusce luctus odio ac nibh luctus, in porttitor theo lacus egestas.</p>
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
                                              <p class="number-txt">Quisque placerat vitae lacus ut scelerisque. Fusce luctus odio ac nibh luctus, in porttitor theo lacus egestas.</p>
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
                                              <p class="number-txt">Quisque placerat vitae lacus ut scelerisque. Fusce luctus odio ac nibh luctus, in porttitor theo lacus egestas.</p>
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
                                              <p class="number-txt">Quisque placerat vitae lacus ut scelerisque. Fusce luctus odio ac nibh luctus, in porttitor theo lacus egestas.</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <!-- Process Section End -->       

            <!-- Blog Section Start -->
            <div id="rs-blog" class="rs-blog pt-110 pb-120 md-pt-75 md-pb-80">
                <div class="container">  
                    <div class="sec-title2 text-center mb-30">
                            <h2 class="title testi-title">
                                {{trans('lang.news')}}
                            </h2>
                        {{-- <div class="desc">
                            We've been building creative tools together for over a decade and have a deep appreciation for software applications
                        </div> --}}
                    </div>
                    <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="2" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="3" data-md-device-nav="false" data-md-device-dots="false">
                        <div class="blog-item">
                            <div class="image-wrap">
                                <a href="#"><img src="{{asset('assets/landing2/images/blog/main-home/1.jpg')}}" alt=""></a>
                                <ul class="post-categories">
                                    <li><a href="blog-details.html">Software Development</a></li>
                                </ul>
                            </div>
                            <div class="blog-content">
                               <ul class="blog-meta">
                                   <li class="date"><i class="fa fa-calendar-check-o"></i> 16 Nov 2020</li>
                                   <li class="admin"><i class="fa fa-user-o"></i> admin</li>
                               </ul>
                               <h3 class="blog-title"><a href="blog-details.html">Necessity May Give Us Your Best Virtual Court System</a></h3>
                               <p class="desc">We denounce with righteous indige nation and dislike men who are so beguiled...</p>
                               <div class="blog-button"><a href="blog-details.html">เพิ่มเติม</a></div>
                            </div>
                        </div>
                        <div class="blog-item">
                            <div class="image-wrap">
                                <a href="#"><img src="{{asset('assets/landing2/images/blog/main-home/2.jpg')}}" alt=""></a>
                                <ul class="post-categories">
                                    <li><a href="blog-details.html"> Web Development</a></li>
                                </ul>
                            </div>
                            <div class="blog-content">
                               <ul class="blog-meta">
                                   <li class="date"><i class="fa fa-calendar-check-o"></i> 20 December 2020</li>
                                   <li class="admin"><i class="fa fa-user-o"></i> admin</li>
                               </ul>
                               <h3 class="blog-title"><a href="blog-details.html">Tech Products That Makes Its Easier to Stay at Home</a></h3>
                               <p class="desc">We denounce with righteous indige nation and dislike men who are so beguiled...</p>
                               <div class="blog-button"><a href="blog-details.html">เพิ่มเติม</a></div>
                            </div>
                        </div>
                        <div class="blog-item">
                            <div class="image-wrap">
                                <a href="#"><img src="{{asset('assets/landing2/images/blog/main-home/3.jpg')}}" alt=""></a>
                                <ul class="post-categories">
                                    <li><a href="blog-details.html">It Services</a></li>
                                </ul>
                            </div>
                            <div class="blog-content">
                               <ul class="blog-meta">
                                   <li class="date"><i class="fa fa-calendar-check-o"></i> 22 December 2020</li>
                                   <li class="admin"><i class="fa fa-user-o"></i> admin</li>
                               </ul>
                               <h3 class="blog-title"><a href="blog-details.html">Open Source Job Report Show More Openings Fewer</a></h3>
                               <p class="desc">We denounce with righteous indige nation and dislike men who are so beguiled...</p>
                               <div class="blog-button"><a href="blog-details.html">เพิ่มเติม</a></div>
                            </div>
                        </div>
                        <div class="blog-item">
                            <div class="image-wrap">
                                <a href="#"><img src="{{asset('assets/landing2/images/blog/main-home/4.jpg')}}" alt=""></a>
                                <ul class="post-categories">
                                    <li><a href="blog-details.html">Artifical Intelligence</a></li>
                                </ul>
                            </div>
                            <div class="blog-content">
                               <ul class="blog-meta">
                                   <li class="date"><i class="fa fa-calendar-check-o"></i> 26 December 2020</li>
                                   <li class="admin"><i class="fa fa-user-o"></i> admin</li>
                               </ul>
                               <h3 class="blog-title"><a href="blog-details.html">Types of Social Proof What its Makes Them Effective</a></h3>
                               <p class="desc">We denounce with righteous indige nation and dislike men who are so beguiled...</p>
                               <div class="blog-button"><a href="blog-details.html">เพิ่มเติม</a></div>
                            </div>
                        </div>
                        <div class="blog-item">
                            <div class="image-wrap">
                                <a href="#"><img src="{{asset('assets/landing2/images/blog/main-home/5.jpg')}}" alt=""></a>
                                <ul class="post-categories">
                                    <li><a href="blog-details.html">Digital Technology</a></li>
                                </ul>
                            </div>
                            <div class="blog-content">
                               <ul class="blog-meta">
                                   <li class="date"><i class="fa fa-calendar-check-o"></i> 28 December 2020</li>
                                   <li class="admin"><i class="fa fa-user-o"></i> admin</li>
                               </ul>
                               <h3 class="blog-title"><a href="blog-details.html">Tech Firms Support Huawei Restriction, Balk at Cost</a></h3>
                               <p class="desc">We denounce with righteous indige nation and dislike men who are so beguiled...</p>
                               <div class="blog-button"><a href="blog-details.html">เพิ่มเติม</a></div>
                            </div>
                        </div>
                        <div class="blog-item">
                            <div class="image-wrap">
                                <a href="#"><img src="{{asset('assets/landing2/images/blog/main-home/6.jpg')}}" alt=""></a>
                                <ul class="post-categories">
                                    <li><a href="blog-details.html">It Services</a></li>
                                </ul>
                            </div>
                            <div class="blog-content">
                               <ul class="blog-meta">
                                   <li class="date"><i class="fa fa-calendar-check-o"></i> 30 December 2020</li>
                                   <li class="admin"><i class="fa fa-user-o"></i> admin</li>
                               </ul>
                               <h3 class="blog-title"><a href="blog-details.html">Servo Project Joins The Linux Foundation Fold Desco</a></h3>
                               <p class="desc">We denounce with righteous indige nation and dislike men who are so beguiled...</p>
                               <div class="blog-button"><a href="blog-details.html">เพิ่มเติม</a></div>
                            </div>
                        </div>
                     </div>
                </div>
            </div>
            <!-- Blog Section End -->

            <!-- Partner Start -->
            <div class="rs-partner pt-80 pb-70" style="margin-top:20px">
                <div class="container">
                    <div class="rs-carousel owl-carousel" data-loop="true" data-items="5" data-margin="30" data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800" data-dots="false" data-nav="false" data-nav-speed="false" data-center-mode="false" data-mobile-device="1" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="3" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="2" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="5" data-md-device-nav="false" data-md-device-dots="false">
                        <div class="partner-item">
                            <div class="logo-img">
                                <a href="#">
                                    <img class="hover-logo" src="{{asset('assets/landing2/images/partner/1.png')}}" alt="">
                                    <img class="main-logo" src="{{asset('assets/landing2/images/partner/1.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="partner-item">
                            <div class="logo-img">
                                <a href="#">
                                    <img class="hover-logo" src="{{asset('assets/landing2/images/partner/2.png')}}" alt="">
                                    <img class="main-logo" src="{{asset('assets/landing2/images/partner/2.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="partner-item">
                            <div class="logo-img">
                                <a href="#">
                                    <img class="hover-logo" src="{{asset('assets/landing2/images/partner/3.png')}}" alt="">
                                    <img class="main-logo" src="{{asset('assets/landing2/images/partner/3.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="partner-item">
                            <div class="logo-img">
                                <a href="#">
                                    <img class="hover-logo" src="{{asset('assets/landing2/images/partner/4.png')}}" alt="">
                                    <img class="main-logo" src="{{asset('assets/landing2/images/partner/4.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="partner-item">
                            <div class="logo-img">
                                <a href="#">
                                    <img class="hover-logo" src="{{asset('assets/landing2/images/partner/5.png')}}" alt="">
                                    <img class="main-logo" src="{{asset('assets/landing2/images/partner/5.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="partner-item">
                            <div class="logo-img">
                                <a href="#">
                                    <img class="hover-logo" src="{{asset('assets/landing2/images/partner/6.png')}}" alt="">
                                    <img class="main-logo" src="{{asset('assets/landing2/images/partner/6.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="partner-item">
                            <div class="logo-img">
                                <a href="#">
                                    <img class="hover-logo" src="{{asset('assets/landing2/images/partner/7.png')}}" alt="">
                                    <img class="main-logo" src="{{asset('assets/landing2/images/partner/7.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="partner-item">
                            <div class="logo-img">
                                <a href="#">
                                    <img class="hover-logo" src="{{asset('assets/landing2/images/partner/8.png')}}" alt="">
                                    <img class="main-logo" src="{{asset('assets/landing2/images/partner/8.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="partner-item">
                            <div class="logo-img">
                                <a href="#">
                                    <img class="hover-logo" src="{{asset('assets/landing2/images/partner/9.png')}}" alt="">
                                    <img class="main-logo" src="{{asset('assets/landing2/images/partner/9.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Partner End -->

        </div> 
        <!-- Main content End -->
     
        <!-- Footer Start -->
        <footer id="rs-footer" class="rs-footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-12 col-sm-12 footer-widget">
                            <div class="footer-logo mb-30">
                                <a href="index.html"><img src="{{asset('assets/landing2/images/logo-dark.png')}}" alt=""></a>
                            </div>
                              <div class="textwidget pb-30"><p>111 อุทยานวิทยาศาสตร์ประเทศไทย <br>ถ.พหลโยธิน ตำบลคลองหนึ่ง อำเภอคลองหลวง จังหวัดปทุมธานี 12120 </p>
                              </div>
                              {{-- <ul class="footer-social md-mb-30">  
                                  <li> 
                                      <a href="#" target="_blank"><span><i class="fa fa-facebook"></i></span></a> 
                                  </li>
                                  <li> 
                                      <a href="# " target="_blank"><span><i class="fa fa-twitter"></i></span></a> 
                                  </li>

                                  <li> 
                                      <a href="# " target="_blank"><span><i class="fa fa-pinterest-p"></i></span></a> 
                                  </li>
                                  <li> 
                                      <a href="# " target="_blank"><span><i class="fa fa-instagram"></i></span></a> 
                                  </li>
                                                                           
                              </ul> --}}
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <h3 class="widget-title">เวลาทำการ</h3>
                            <p class="widget-desc">จันทร์-ศุกร์: {{$generalinfo->workdaytime}}</p>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 md-mb-30">
                            <h3 class="widget-title">ติดต่อ</h3>
                            <ul class="address-widget">
                                {{-- <li>
                                    <i class="flaticon-location"></i>
                                    <div class="desc">374 FA Tower, William S Blvd 2721, IL, USA</div>
                                </li> --}}
                                <li>
                                    <i class="flaticon-call"></i>
                                    <div class="desc">
                                       <a href="tel:(+880)155-69569">{{$generalinfo->phone1}}</a>
                                    </div>
                                </li>
                                <li>
                                    <i class="flaticon-email"></i>
                                    <div class="desc">
                                        <a href="mailto:support@rstheme.com">{{$generalinfo->email}}</a>
                                    </div>
                                </li>
                                {{-- <li>
                                    <i class="flaticon-clock-1"></i>
                                    <div class="desc">
                                        Opening Hours: 10:00 - 18:00   
                                    </div>
                                </li> --}}
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <h3 class="widget-title">Newsletter</h3>
                            {{-- <p class="widget-desc">We denounce with righteous and in and dislike men who are so beguiled and demo realized.</p> --}}
                            <p>
                                <input type="email" name="EMAIL" placeholder="อีเมล" required="">
                                <em class="paper-plane"><input type="submit" value="Sign up"></em>
                                <i class="flaticon-send"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container" style="text-align:center">                    
                    {{-- <div class="row y-middle"> --}}
                        {{-- <div class="col-lg-6 text-right md-mb-10 order-last">
                            <ul class="copy-right-menu">
                                <li><a href="index.html">Home</a></li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="shop.html">Shop</a></li>
                                <li><a href="faq.html">FAQs</a></li>
                            </ul>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="copyright">
                                <p>&copy; สงวนลิขสิทธิ์ {{date('Y')}} <span>{{$generalinfo->company}}</span> </p>
                            </div>
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        </footer>
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
        <script src="{{asset('assets/landing2/js/modernizr-2.8.3.min.js')}}"></script>
        <!-- jquery latest version -->
        <script src="{{asset('assets/landing2/js/jquery.min.js')}}"></script>
        <!-- Bootstrap v4.4.1 js -->
        <script src="{{asset('assets/landing2/js/bootstrap.min.js')}}"></script>
        <!-- Menu js -->
        <script src="{{asset('assets/landing2/js/rsmenu-main.js')}}"></script> 
        <!-- op nav js -->
        <script src="{{asset('assets/landing2/js/jquery.nav.js')}}"></script>
        <!-- owl.carousel js -->
        <script src="{{asset('assets/landing2/js/owl.carousel.min.js')}}"></script>
        <!-- wow js -->
        <script src="{{asset('assets/landing2/js/wow.min.js')}}"></script>
        <!-- Skill bar js -->
        <script src="{{asset('assets/landing2/js/skill.bars.jquery.js')}}"></script>
        <script src="{{asset('assets/landing2/js/jquery.counterup.min.js')}}"></script> 
         <!-- counter top js -->
        <script src="{{asset('assets/landing2/js/waypoints.min.js')}}"></script>
        <!-- swiper js -->
        <script src="{{asset('assets/landing2/js/swiper.min.js')}}"></script>   
        <!-- particles js -->
        <script src="{{asset('assets/landing2/js/particles.min.js')}}"></script>  
        <!-- magnific popup js -->
        <script src="{{asset('assets/landing2/js/jquery.magnific-popup.min.js')}}"></script>      
        <!-- plugins js -->
        <script src="{{asset('assets/landing2/js/plugins.js')}}"></script>
        <!-- pointer js -->
        <script src="{{asset('assets/landing2/js/pointer.js')}}"></script>
        <!-- contact form js -->
        <script src="{{asset('assets/landing2/js/contact.form.js')}}"></script>
        <!-- main js -->
        <script src="{{asset('assets/landing2/js/main.js')}}"></script>
    </body>

</html>