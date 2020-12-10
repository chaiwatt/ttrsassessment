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
           
             <li class="drop-down"><a href=""><img src="{{asset('assets/landing/img/Thai_Flag.png')}}" alt="" srcset=""></a>
              <ul>
                  <li><a class="sarabun" href="#"><img src="{{asset('assets/landing/img/Thai_Flag.png')}}" alt="" srcset=""> ภาษาไทย</a></li>
                  <li><a class="sarabun" href="#"><img src="{{asset('assets/landing/img/Us_Flag.png')}}" alt="" srcset=""> ภาษาอังกฤษ</a></li>
                </ul>
            </li>

            {{-- <li>
              <a href="#" class="sarabun" style="color: #fff;" class="btn-get-started animate__animated animate__fadeInUp scrollto"><i class="icofont-login"></i>  เข้าสู่ระบบ</a>
            
            </li> --}}
          </ul>
        </nav><!-- .nav-menu -->
  
      </div>
    </header><!-- End Header -->