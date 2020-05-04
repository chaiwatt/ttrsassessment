
<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	
        <meta name="csrf-token" content="{{ csrf_token() }}" />
		<title>TTRS | ศูนย์สนับสนุนและให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศ</title>

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{asset('assets/landing/img/apple-touch-icon.png')}}">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{asset('assets/landing/vendor/bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/landing/vendor/fontawesome-free/css/all.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/landing/vendor/animate/animate.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/landing/vendor/simple-line-icons/css/simple-line-icons.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/landing/vendor/owl.carousel/assets/owl.carousel.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/landing/vendor/owl.carousel/assets/owl.theme.default.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/landing/vendor/magnific-popup/magnific-popup.min.css')}}">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{asset('assets/landing/css/theme.css')}}">
		<link rel="stylesheet" href="{{asset('assets/landing/css/theme-elements.css')}}">
		<link rel="stylesheet" href="{{asset('assets/landing/css/theme-blog.css')}}">
		<link rel="stylesheet" href="{{asset('assets/landing/css/theme-shop.css')}}">

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="{{asset('assets/landing/vendor/rs-plugin/css/settings.css')}}">
		<link rel="stylesheet" href="{{asset('assets/landing/vendor/rs-plugin/css/layers.css')}}">
		<link rel="stylesheet" href="{{asset('assets/landing/vendor/rs-plugin/css/navigation.css')}}">
		
		<!-- Demo CSS -->
        <link rel="stylesheet" href="{{asset('assets/landing/css/extend.css')}}">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{asset('assets/landing/css/skins/skin-corporate-3.css')}}"> 

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{asset('assets/landing/css/custom.css')}}">

		<!-- Head Libs -->
		<script src="{{asset('assets/landing/vendor/modernizr/modernizr.min.js')}}"></script>

	</head>
	<body class="boxed">

		<div class="body">
			<header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 148, 'stickySetTop': '-148px', 'stickyChangeLogo': true}">
				<div class="header-body border-color-primary border-top-0 box-shadow-none">

					<div class="header-top header-top-default border-bottom-0 border-top-0">
						<div class="container">
							<div class="header-row py-2">
								<div class="header-column justify-content-start">
									<div class="header-row">
										<nav class="header-nav-top">
											<ul class="nav nav-pills text-uppercase text-2">
												@if (!Auth::check())
													<li class="nav-item nav-item-anim-icon">
														<a class="nav-link pl-0" href="{{route('login')}}" style="font-size: 14px"><i class="fas fa-angle-right"></i> เข้าสู่ระบบ</a>
													</li>
													<li class="nav-item nav-item-anim-icon">
														<a class="nav-link" href="{{route('register')}}" style="font-size: 14px"><i class="fas fa-angle-right"></i> ลงทะเบียน</a>
													</li>
												@else
													<li class="nav-item nav-item-anim-icon">
														<a class="dropdown-item" href="{{route('logout')}}" style="font-size: 14px" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-angle-right"></i>ออกจากระบบ</a>
														<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
															@csrf
														</form>
													</li>
												@endif
											</ul>
										</nav>
									</div>
								</div>
								<div class="header-column justify-content-end">
									<div class="header-row">
										<ul class="header-social-icons social-icons d-none d-sm-block social-icons-clean">
											<li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
											<li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-youtube"></i></a></li>											
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="header-container container z-index-2">
						<div class="header-row py-2">
							<div class="header-column">
								<div class="header-row">
									<div class="header-logo header-logo-sticky-change">
										<a href="index.html">
											<img class="header-logo-sticky opacity-0" alt="Porto" width="100" height="48" data-sticky-width="89" data-sticky-height="43" data-sticky-top="88" src="{{asset('assets/landing/img/logo-dark.png')}}">
											<img class="header-logo-non-sticky opacity-0" alt="Porto" width="100" height="48" src="{{asset('assets/landing/img/logo-default.png')}}">
										</a>
									</div>
								</div>
							</div>
							<div class="header-column justify-content-end">
								<div class="header-row">
									<ul class="header-extra-info d-flex align-items-center">
										<li class="d-none d-sm-inline-flex">
											<div class="header-extra-info-text">
												<label>SEND US AN EMAIL</label>
												<strong><a href="mailto:mail@example.com">MAIL@EXAMPLE.COM</a></strong>
											</div>
										</li>
										<li>
											<div class="header-extra-info-text">
												<label>CALL US NOW</label>
												<strong><a href="tel:8001234567">800-123-4567</a></strong>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="header-nav-bar bg-primary" data-sticky-header-style="{'minResolution': 991}" data-sticky-header-style-active="{'background-color': 'transparent'}" data-sticky-header-style-deactive="{'background-color': '#0088cc'}">
						<div class="container">
							<div class="header-row">
								<div class="header-column">
									<div class="header-row justify-content-end">
										<div class="header-nav header-nav-force-light-text justify-content-start py-2 py-lg-3" data-sticky-header-style="{'minResolution': 991}" data-sticky-header-style-active="{'margin-left': '135px'}" data-sticky-header-style-deactive="{'margin-left': '0'}">
											<div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1">
												<nav class="collapse">
													<ul class="nav nav-pills" id="mainNav">
                                                        @foreach($menus as $menu)
                                                            <li class="{{ $menu->childs->count() ? 'dropdown' :'' }} dropdown-full-color dropdown-light">
                                                                <a href="{{$menu->url}}" class="dropdown-item {{$menu->childs->count() ? 'dropdown-toggle' :'' }}" style="font-weight: 100;font-size:16px">
                                                                    {{ $menu->name }}
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    @if($menu->childs->count())
                                                                    @include('layouts.landing.menu.menusub',['childs' => $menu->childs])
                                                                    @endif
                                                                </ul>
                                                            </li>
                                                        @endforeach
													</ul>
												</nav>
											</div>
											<button class="btn header-btn-collapse-nav my-2" data-toggle="collapse" data-target=".header-nav-main nav">
												<i class="fas fa-bars"></i>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>

			<div role="main" class="main">
				<div class="slider-container light rev_slider_wrapper" style="height: 650px;">
					<div id="revolutionSlider" class="slider rev_slider" data-version="5.4.8" data-plugin-revolution-slider data-plugin-options="{'delay': 9000, 'gridwidth': 1170, 'gridheight': 650, 'disableProgressBar': 'on', 'responsiveLevels': [4096,1200,992,500], 'navigation' : {'arrows': { 'enable': true, 'style': 'arrows-style-1 arrows-big arrows-dark' }, 'bullets': {'enable': false, 'style': 'bullets-style-1 bullets-color-primary', 'h_align': 'center', 'v_align': 'bottom', 'space': 7, 'v_offset': 70, 'h_offset': 0}}}">
						<ul>
							<li data-transition="fade">
								<img src="{{asset('assets/landing/img/slides/slide-corporate-3-1.jpg')}}"  
									alt=""
									data-bgposition="center center" 
									data-bgfit="cover" 
									data-bgrepeat="no-repeat" 
									class="rev-slidebg">
				
								<div class="tp-caption text-color-dark font-weight-normal"
									data-x="['left','left','center','center']" data-hoffset="['200','200','0','0']"
									data-y="center" data-voffset="['-50','-50','-50','-75']"
									data-start="700"
									data-fontsize="['22','22','22','40']"
									data-lineheight="['25','25','25','45']"
									data-transform_in="y:[-50%];opacity:0;s:500;">DO YOU NEED A NEW</div>
				
								<h1 class="tp-caption font-weight-extra-bold text-color-dark negative-ls-2"
									data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:1.5;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
									data-x="['left','left','center','center']" data-hoffset="['152','152','0','0']"
									data-y="center"
									data-fontsize="['50','50','50','90']"
									data-lineheight="['55','55','55','95']"
									data-letterspacing="-1">WEB DESIGN?</h1>
				
								<div class="tp-caption font-weight-light text-color-dark"
									data-frames='[{"from":"opacity:0;","speed":300,"to":"o:1;","delay":2000,"split":"chars","splitdelay":0.05,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
									data-x="['left','left','center','center']" data-hoffset="['166','166','0','0']"
									data-y="center" data-voffset="['40','40','40','80']"
									data-fontsize="['18','18','18','50']"
									data-lineheight="['20','20','20','55']">Check out our options and features</div>
								
							</li>
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
									data-lineheight="['55','55','55','95']">INCREDIBLE DESIGNS</div>
				
								<div class="tp-caption font-weight-light text-color-dark"
									data-frames='[{"from":"opacity:0;","speed":300,"to":"o:1;","delay":2000,"split":"chars","splitdelay":0.05,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
									data-x="center"
									data-y="center" 
									data-fontsize="['18','18','18','50']"
									data-lineheight="['20','20','20','55']"
									style="color: #b5b5b5;">Porto is a Huge success in the of one of the world's largest MarketPlace.</div>
				
								<a class="tp-caption btn btn-primary font-weight-bold"
									href="#"
									data-frames='[{"delay":3000,"speed":2000,"frame":"0","from":"y:50%;opacity:0;","to":"y:0;o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
									data-x="center" data-hoffset="0"
									data-y="center" data-voffset="70"
									data-paddingtop="['15','15','15','30']"
									data-paddingbottom="['15','15','15','30']"
									data-paddingleft="['40','40','40','57']"
									data-paddingright="['40','40','40','57']"
									data-fontsize="['13','13','13','25']"
									data-lineheight="['20','20','20','25']">GET STARTED NOW <i class="fas fa-arrow-right ml-1"></i></a>
				
							</li>
						</ul>
					</div>
				</div>
				
				<section class="section bg-color-grey-scale-1 m-0 border-0 border-0 m-0">
					<div class="container">
						<div class="row text-center text-md-left mt-4">
							<div class="col-md-4 mb-4 mb-md-0 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="200">
								<div class="row justify-content-center justify-content-md-start">
									<div class="col-4">
										<img class="img-fluid mb-4" src="{{asset('assets/landing/img/icons/seo-grey.png')}}" alt="">
									</div>
									<div class="col-lg-8">
										<h2 class="font-weight-bold text-5 line-height-5 mb-1">SEO Optimization</h2>
										<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-4 mb-md-0 appear-animation" data-appear-animation="fadeIn">
								<div class="row justify-content-center justify-content-md-start">
									<div class="col-4">
										<img class="img-fluid mb-4" src="{{asset('assets/landing/img/icons/marketing-grey.png')}}" alt="">
									</div>
									<div class="col-lg-8">
										<h2 class="font-weight-bold text-5 line-height-5 mb-1">Pro Marketing Ads</h2>
										<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</div>
								</div>
							</div>
							<div class="col-md-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">
								<div class="row justify-content-center justify-content-md-start">
									<div class="col-4">
										<img class="img-fluid mb-4" src="{{asset('assets/landing/img/icons/support-grey.png')}}" alt="">
									</div>
									<div class="col-lg-8">
										<h2 class="font-weight-bold text-5 line-height-5 mb-1">Secure Support</h2>
										<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</div>
								</div>
							</div>
                        </div>
                        <div class="row text-center text-md-left mt-4">
							<div class="col-md-4 mb-4 mb-md-0 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="200">
								<div class="row justify-content-center justify-content-md-start">
									<div class="col-4">
										<img class="img-fluid mb-4" src="{{asset('assets/landing/img/icons/seo-grey.png')}}" alt="">
									</div>
									<div class="col-lg-8">
										<h2 class="font-weight-bold text-5 line-height-5 mb-1">SEO Optimization</h2>
										<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-4 mb-md-0 appear-animation" data-appear-animation="fadeIn">
								<div class="row justify-content-center justify-content-md-start">
									<div class="col-4">
										<img class="img-fluid mb-4" src="{{asset('assets/landing/img/icons/marketing-grey.png')}}" alt="">
									</div>
									<div class="col-lg-8">
										<h2 class="font-weight-bold text-5 line-height-5 mb-1">Pro Marketing Ads</h2>
										<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</div>
								</div>
							</div>
							<div class="col-md-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">
								<div class="row justify-content-center justify-content-md-start">
									<div class="col-4">
										<img class="img-fluid mb-4" src="{{asset('assets/landing/img/icons/support-grey.png')}}" alt="">
									</div>
									<div class="col-lg-8">
										<h2 class="font-weight-bold text-5 line-height-5 mb-1">Secure Support</h2>
										<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				{{-- <section class="section section-height-3 bg-color-grey-scale-1 m-0 border-0">
					<div class="container">
						<div class="row align-items-center justify-content-center">
							<div class="col-lg-6 pb-sm-4 pb-lg-0 pr-lg-5 mb-sm-5 mb-lg-0">
								<h2 class="text-color-dark font-weight-normal text-6 mb-2">Who <strong class="font-weight-extra-bold">We Are</strong></h2>
								<p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit massa enim. Nullam id varius nunc. </p>
								<p class="pr-5 mr-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc. Vivamus bibendum magna ex, et faucibus lacus venenatis eget</p>
								<a href="#" class="btn btn-dark font-weight-semibold btn-px-4 btn-py-2 text-2">LEARN MORE</a>
							</div>
							<div class="col-sm-8 col-md-6 col-lg-4 offset-sm-4 offset-md-4 offset-lg-2 mt-sm-5" style="top: 1.7rem;">
								<img src="{{asset('assets/landing/img/generic/generic-corporate-3-1.jpg')}}" class="img-fluid position-absolute d-none d-sm-block appear-animation" data-appear-animation="expandIn" data-appear-animation-delay="300" style="top: 10%; left: -50%;" alt="" />
								<img src="{{asset('assets/landing/img/generic/generic-corporate-3-2.jpg')}}" class="img-fluid position-absolute d-none d-sm-block appear-animation" data-appear-animation="expandIn" style="top: -33%; left: -29%;" alt="" />
								<img src="{{asset('assets/landing/img/generic/generic-corporate-3-3.jpg')}}" class="img-fluid position-relative appear-animation mb-2" data-appear-animation="expandIn" data-appear-animation-delay="600" alt="" />
							</div>
						</div>
					</div>
				</section> --}}
				
				  <div class="container mb-5" style="margin-top: 20px">
                    <div class="row">
						<div class="col">
							<div class="blog-posts">

								<div class="row">

									<div class="col-md-4">
										<article class="post post-medium border-0 pb-0 mb-5">
											<div class="post-image">
												<a href="blog-post.html">
													<img src="{{asset('assets/landing/img/blog/medium/blog-1.jpg')}}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
												</a>
											</div>

											<div class="post-content">

												<h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a href="blog-post.html">Amazing Mountain</a></h2>
												<p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>

												<div class="post-meta">
													<span><i class="far fa-user"></i> By <a href="#">Bob Doe</a> </span>
													<span><i class="far fa-folder"></i> <a href="#">News</a>, <a href="#">Design</a> </span>
													<span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span>
													<span class="d-block mt-2"><a href="blog-post.html" class="btn btn-xs btn-light text-1 text-uppercase">Read More</a></span>
												</div>

											</div>
										</article>
									</div>

									<div class="col-md-4">
										<article class="post post-medium border-0 pb-0 mb-5">
											<div class="post-image">
												<a href="blog-post.html">
													<img src="{{asset('assets/landing/img/blog/medium/blog-2.jpg')}}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
												</a>
											</div>

											<div class="post-content">

												<h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a href="blog-post.html">Creative Business</a></h2>
												<p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>

												<div class="post-meta">
													<span><i class="far fa-user"></i> By <a href="#">John Doe</a> </span>
													<span><i class="far fa-folder"></i> <a href="#">News</a>, <a href="#">Design</a> </span>
													<span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span>
													<span class="d-block mt-2"><a href="blog-post.html" class="btn btn-xs btn-light text-1 text-uppercase">Read More</a></span>
												</div>

											</div>
										</article>
									</div>

									<div class="col-md-4">
										<article class="post post-medium border-0 pb-0 mb-5">
											<div class="post-image">
												<a href="blog-post.html">
													<img src="{{asset('assets/landing/img/blog/medium/blog-3.jpg')}}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
												</a>
											</div>

											<div class="post-content">

												<h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a href="blog-post.html">Unlimited Ways</a></h2>
												<p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>

												<div class="post-meta">
													<span><i class="far fa-user"></i> By <a href="#">John Doe</a> </span>
													<span><i class="far fa-folder"></i> <a href="#">News</a>, <a href="#">Design</a> </span>
													<span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span>
													<span class="d-block mt-2"><a href="blog-post.html" class="btn btn-xs btn-light text-1 text-uppercase">Read More</a></span>
												</div>

											</div>
										</article>
									</div>

									<div class="col-md-4">
										<article class="post post-medium border-0 pb-0 mb-5">
											<div class="post-image">
												<a href="blog-post.html">
													<img src="{{asset('assets/landing/img/blog/medium/blog-4.jpg')}}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
												</a>
											</div>

											<div class="post-content">

												<h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a href="blog-post.html">Developer Life</a></h2>
												<p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>

												<div class="post-meta">
													<span><i class="far fa-user"></i> By <a href="#">Jessica Doe</a> </span>
													<span><i class="far fa-folder"></i> <a href="#">News</a>, <a href="#">Design</a> </span>
													<span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span>
													<span class="d-block mt-2"><a href="blog-post.html" class="btn btn-xs btn-light text-1 text-uppercase">Read More</a></span>
												</div>

											</div>
										</article>
									</div>

									<div class="col-md-4">
										<article class="post post-medium border-0 pb-0 mb-5">
											<div class="post-image">
												<a href="blog-post.html">
													<img src="{{asset('assets/landing/img/blog/medium/blog-5.jpg')}}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
												</a>
											</div>

											<div class="post-content">

												<h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a href="blog-post.html">The Blue Sky</a></h2>
												<p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>

												<div class="post-meta">
													<span><i class="far fa-user"></i> By <a href="#">Robert Doe</a> </span>
													<span><i class="far fa-folder"></i> <a href="#">News</a>, <a href="#">Design</a> </span>
													<span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span>
													<span class="d-block mt-2"><a href="blog-post.html" class="btn btn-xs btn-light text-1 text-uppercase">Read More</a></span>
												</div>

											</div>
										</article>
									</div>

									<div class="col-md-4">
										<article class="post post-medium border-0 pb-0 mb-5">
											<div class="post-image">
												<a href="blog-post.html">
													<img src="{{asset('assets/landing/img/blog/medium/blog-6.jpg')}}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
												</a>
											</div>

											<div class="post-content">

												<h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a href="blog-post.html">Night Life</a></h2>
												<p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>

												<div class="post-meta">
													<span><i class="far fa-user"></i> By <a href="#">Robert Doe</a> </span>
													<span><i class="far fa-folder"></i> <a href="#">News</a>, <a href="#">Design</a> </span>
													<span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span>
													<span class="d-block mt-2"><a href="blog-post.html" class="btn btn-xs btn-light text-1 text-uppercase">Read More</a></span>
												</div>

											</div>
										</article>
									</div>
								</div>
	
								<div class="row">
									<div class="col">
										<ul class="pagination float-right">
											<li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>
											<li class="page-item active"><a class="page-link" href="#">1</a></li>
											<li class="page-item"><a class="page-link" href="#">2</a></li>
											<li class="page-item"><a class="page-link" href="#">3</a></li>
											<a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
										</ul>
									</div>
								</div>

							</div>
						</div>

					</div>
					</div>
				</div>
				
                <div class="container-fluid">
					<div class="row">

						<div class="col-lg-6 p-0">
							<section class="section section-height-3 section-primary h-100 m-0 border-0">
								<div class="row justify-content-end m-0">
									<div class="col-half-section col-half-section-right mb-5 appear-animation" data-appear-animation="fadeInRightShorter">
										<h2 class="text-light text-7">Latest <strong>Posts</strong></h2>
										<div class="row recent-posts">
											<div class="col-md-6 mb-4 mb-md-0">
												<article>
													<div class="row">
														<div class="col-auto pr-0">
															<div class="date">
																<span class="day bg-color-light text-color-dark font-weight-extra-bold">15</span>
																<span class="month bg-color-light font-weight-semibold text-color-primary text-1">JAN</span>
															</div>
														</div>
														<div class="col pl-1">
															<h4 class="font-weight-normal line-height-3 text-4"><a href="blog-post.html" class="text-light">Lorem ipsum dolor sit amet, consectetur</a></h4>
															<p class="text-color-light line-height-5 opacity-6 pr-4 mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
															<a href="/" class="read-more text-color-light font-weight-semibold text-2">read more <i class="fas fa-chevron-right text-1 ml-1"></i></a>
														</div>
													</div>
												</article>
											</div>
											<div class="col-md-6">
												<article>
													<div class="row">
														<div class="col-auto pr-0">
															<div class="date">
																<span class="day bg-color-light text-color-dark font-weight-extra-bold">14</span>
																<span class="month bg-color-light font-weight-semibold text-color-primary text-1">JAN</span>
															</div>
														</div>
														<div class="col pl-1">
															<h4 class="font-weight-normal line-height-3 text-4"><a href="blog-post.html" class="text-light">Lorem ipsum dolor sit amet, consectetur</a></h4>
															<p class="text-color-light line-height-5 opacity-6 pr-4 mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
															<a href="/" class="read-more text-color-light font-weight-semibold text-2">read more <i class="fas fa-chevron-right text-1 ml-1"></i></a>
														</div>
													</div>
												</article>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>

						<div class="col-lg-6 p-0">
							<section class="section section-height-3 section-secondary h-100 m-0 border-0">
								<div class="row m-0 mt-lg-5 pt-lg-2">
									<div class="col-half-section mb-5 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="400">
										<div class="row counters counters-sm counters-text-light">
											<div class="col-md-6 mb-5">
												<div class="counter">
													<strong class="font-weight-extra-bold" data-to="30000" data-append="+">0</strong>
													<label class="opacity-5 text-4 mt-1">Happy Clients</label>
												</div>
											</div>
											<div class="col-md-6 mb-5">
												<div class="counter">
													<strong class="font-weight-extra-bold" data-to="3500" data-append="+">0</strong>
													<label class="opacity-5 text-4 mt-1">Answered Tickets</label>
												</div>
											</div>
											<div class="col-md-6 mb-5 mb-md-0">
												<div class="counter">
													<strong class="font-weight-extra-bold" data-to="16">0</strong>
													<label class="opacity-5 text-4 mt-1">Pre-made Demos</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="counter">
													<strong class="font-weight-extra-bold" data-to="3000" data-append="+">0</strong>
													<label class="opacity-5 text-4 mt-1">Development Hours</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>

					</div>
				</div>
				
				{{-- <section class="section bg-color-grey-scale-1 section-height-3 border-0 m-0">
					<div class="container pb-2">
						<div class="row">
							<div class="col-lg-12 text-center text-md-left mb-5 mb-lg-0">
								<h2 class="text-color-dark font-weight-normal text-6 mb-2">About <strong class="font-weight-extra-bold">Our Clients</strong></h2>
								<p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit massa enim. Nullam id varius nunc.</p>
								<div class="row justify-content-center my-5">
									<div class="col-8 text-center col-md-4">
										<img src="{{asset('assets/landing/img/logos/logo-1.png')}}" class="img-fluid hover-effect-3" alt="" />
									</div>
									<div class="col-8 text-center col-md-4 my-3 my-md-0">
										<img src="{{asset('assets/landing/img/logos/logo-2.png')}}" class="img-fluid hover-effect-3" alt="" />
									</div>
									<div class="col-8 text-center col-md-4">
										<img src="{{asset('assets/landing/img/logos/logo-3.png')}}" class="img-fluid hover-effect-3" alt="" />
									</div>
								</div>
								<a href="#" class="btn btn-dark font-weight-semibold btn-px-4 btn-py-2 text-2">LEARN MORE</a>
							</div>
						</div>
					</div>
				</section> --}}
			</div>

			<footer id="footer" class="mt-0">
				<div class="container my-4">
					<div class="row py-5">
						<div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
							<h5 class="text-5 text-transform-none font-weight-semibold text-color-light mb-4">Contact Details</h5>
							<p class="text-4 mb-0">Porto Template 123</p>
							<p class="text-4 mb-0">Porto Blvd, Suite</p>
							<p class="text-4 mb-0">New York</p>
						</div>
						<div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
							<h5 class="text-5 text-transform-none font-weight-semibold text-color-light mb-4">Opening Hours</h5>
							<p class="text-4 mb-0">Mon-Fri: <span class="text-color-light">8:30 am to 5:00 pm</span></p>
							<p class="text-4 mb-0">Saturday: <span class="text-color-light">9:30 am to 1:00 pm</span></p>
							<p class="text-4 mb-0">Sunday: <span class="text-color-light">Closed</span></p>
						</div>
						<div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
							<h5 class="text-5 text-transform-none font-weight-semibold text-color-light mb-4">Call Us Now</h5>
							<p class="text-7 text-color-light font-weight-bold mb-2">(800) 123 4567</p>
							<p class="text-4 mb-0">Sales: <span class="text-color-light">(800) 123 4568</span></p>
						</div>
						<div class="col-md-6 col-lg-3">
							<h5 class="text-5 text-transform-none font-weight-semibold text-color-light mb-4">Social Media</h5>
							<ul class="footer-social-icons social-icons m-0">
								<li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
								<li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
								<li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="footer-copyright footer-copyright-style-2 pb-4">
						<div class="py-2">
							<div class="row py-4">
								<div class="col d-flex align-items-center justify-content-center mb-4 mb-lg-0">
									<p>© Copyright 2019. All Rights Reserved.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<!-- Vendor -->
		<script src="{{asset('assets/landing/vendor/jquery/jquery.min.js')}}"></script>
		<script src="{{asset('assets/landing/vendor/jquery.appear/jquery.appear.min.js')}}"></script>
		<script src="{{asset('assets/landing/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
		<script src="{{asset('assets/landing/vendor/jquery.cookie/jquery.cookie.min.js')}}"></script>
		<script src="{{asset('assets/landing/vendor/popper/umd/popper.min.js')}}"></script>
		<script src="{{asset('assets/landing/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('assets/landing/vendor/common/common.min.js')}}"></script>
		<script src="{{asset('assets/landing/vendor/jquery.validation/jquery.validate.min.js')}}"></script>
		<script src="{{asset('assets/landing/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
		<script src="{{asset('assets/landing/vendor/jquery.gmap/jquery.gmap.min.js')}}"></script>
		<script src="{{asset('assets/landing/vendor/jquery.lazyload/jquery.lazyload.min.js')}}"></script>
		<script src="{{asset('assets/landing/vendor/isotope/jquery.isotope.min.js')}}"></script>
		<script src="{{asset('assets/landing/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
		<script src="{{asset('assets/landing/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
		<script src="{{asset('assets/landing/vendor/vide/jquery.vide.min.js')}}"></script>
		<script src="{{asset('assets/landing/vendor/vivus/vivus.min.js')}}"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="{{asset('assets/landing/js/theme.js')}}"></script>
		
		<!-- Current Page Vendor and Views -->
		<script src="{{asset('assets/landing/vendor/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
		<script src="{{asset('assets/landing/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>

		<!-- Current Page Vendor and Views -->
		<script src="{{asset('assets/landing/js/views/view.contact.js')}}"></script>
		
		<!-- Theme Custom -->
		<script src="{{asset('assets/landing/js/custom.js')}}"></script>
		
		<!-- Theme Initialization Files -->
		<script src="{{asset('assets/landing/js/theme.init.js')}}"></script>

		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
			ga('create', 'UA-12345678-1', 'auto');
			ga('send', 'pageview');
		</script>
		 -->

	</body>
</html>
