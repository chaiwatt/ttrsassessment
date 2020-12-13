    <!-- ======= Header ======= -->
    <header id="header">
      <div class="container">
        <div class="logo float-left">
  
          <a href="{{route('landing.index')}}"><img src="{{asset($generalinfo->logo)}}" alt="" class="img-fluid"></a>
        </div>
  
        <nav class="nav-menu float-right d-none d-lg-block " >
          <ul id="menulist">
            @foreach($directmenus as $key => $menu)
              @if ($key == 0)
                    <li class="active"><a href="{{$menu->url}}" class="sarabun">@if (Config::get('app.locale') == 'th') {{ $menu->name }} @else {{ $menu->engname }} @endif </a></li>
                  @else
                    <li ><a href="{{$menu->url}}" class="sarabun">@if (Config::get('app.locale') == 'th') {{ $menu->name }} @else {{ $menu->engname }} @endif </a></li>
              @endif
            @endforeach

            {{-- <li class="active"><a href="#" class="sarabun">หน้าหลัก</a></li>
            <li><a class="sarabun" href="{{route('landing.blog')}}">ข่าวสาร</a></li>
            <li><a class="sarabun" href="#">ประกาศ</a></li>
            <li><a class="sarabun" href="#">งานบริการ</a></li>
            <li><a class="sarabun" href="#">เกี่ยวกับเรา</a></li>
            <li><a class="sarabun" href="#">ติดต่อเรา</a></li> --}}

{{-- 
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
          </ul> --}}
           
             
              @if (Config::get('app.locale') == 'th')
                      <li class="drop-down"><a href=""><img src="{{asset('assets/landing/img/Thai_Flag.png')}}" alt="" srcset=""></a>
                  @else
                      <li class="drop-down"><a href=""><img src="{{asset('assets/landing/img/Us_FlagFill out the form.png')}}" alt="" srcset=""></a>
              @endif
              <ul>
                  <li><a class="sarabun" href="{{route('change',['locale' => 'th'])}}"><img src="{{asset('assets/landing/img/Thai_Flag.png')}}" alt="" srcset=""> {{trans('lang.th')}}</a></li>
                  <li><a class="sarabun" href="{{route('change',['locale' => 'en'])}}"><img src="{{asset('assets/landing/img/Us_Flag.png')}}" alt="" srcset=""> {{trans('lang.en')}}</a></li>
                </ul>
            </li>


            {{-- <li class="nav-item dropdown nav-item-left-border d-none d-sm-block nav-item-left-border-remove nav-item-left-border-md-show">
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
            </li> --}}

            {{-- <li>
              <a href="#" class="sarabun" style="color: #fff;" class="btn-get-started animate__animated animate__fadeInUp scrollto"><i class="icofont-login"></i>  เข้าสู่ระบบ</a>
            
            </li> --}}
          </ul>
        </nav><!-- .nav-menu -->
  
      </div>
    </header><!-- End Header -->