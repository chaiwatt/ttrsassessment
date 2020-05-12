<header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 200, 'stickySetTop': '-200px', 'stickyChangeLogo': true}">
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
                                            <a class="nav-link pl-0" href="{{route('login')}}" style="font-size: 14px"><i class="fas fa-angle-right"></i> {{trans('lang.login')}}</a>
                                        </li>
                                        <li class="nav-item nav-item-anim-icon">
                                            <a class="nav-link" href="{{route('register')}}" style="font-size: 14px"><i class="fas fa-angle-right"></i> {{trans('lang.register')}}</a>
                                        </li>
                                    @else
                                        <li class="nav-item nav-item-anim-icon">
                                            <a class="dropdown-item" href="{{route('logout')}}" style="font-size: 14px" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-angle-right"></i>{{trans('lang.signout')}}</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    @endif
                                    <li class="nav-item dropdown nav-item-left-border d-none d-sm-block nav-item-left-border-remove nav-item-left-border-md-show">
                                        <a class="nav-link" href="#" role="button" id="dropdownLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            @if (Config::get('app.locale') == 'th')
                                                    <img src="{{asset('assets/landing/img/blank.gif')}}" class="flag flag-th" alt="Thai" /> {{trans('lang.th')}}
                                                @else
                                                    <img src="{{asset('assets/landing/img/blank.gif')}}" class="flag flag-us" alt="English" /> {{trans('lang.en')}}
                                            @endif
                                            
                                            <i class="fas fa-angle-down"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownLanguage">
                                            <a class="dropdown-item" href="{{route('change',['locale' => 'th'])}}"><img src="{{asset('assets/landing/img/blank.gif')}}" class="flag flag-th" alt="Thai" /> {{trans('lang.th')}}</a>
                                            <a class="dropdown-item" href="{{route('change',['locale' => 'en'])}}"><img src="{{asset('assets/landing/img/blank.gif')}}" class="flag flag-us" alt="English" /> {{trans('lang.en')}}</a>
                                        </div>
                                    </li>
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
                                <img class="header-logo-sticky opacity-0" style="padding-bottom:-20px" alt="Porto" width="479" height="99" data-sticky-width="100" data-sticky-height="43" data-sticky-top="140" src="{{asset('assets/landing/img/logo-dark.png')}}">
                                <img class="header-logo-non-sticky opacity-0" alt="Porto" width="479" height="99" src="{{asset('assets/landing/img/ttrs.png')}}">
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
                                                        @if (Config::get('app.locale') == 'th')
                                                            {{ $menu->name }}
                                                        @else
                                                            {{ $menu->engname }}
                                                        @endif   
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