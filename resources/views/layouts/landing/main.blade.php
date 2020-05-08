
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
				@include('layouts.landing.slide')
				@include('layouts.landing.introsection')
				@include('layouts.landing.blog')
				@include('layouts.landing.bottom_one')
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
