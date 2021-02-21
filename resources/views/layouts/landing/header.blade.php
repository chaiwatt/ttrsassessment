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
                    <li class="active"><a href="{{url('/').'/'.$menu->url}}" class="sarabun">@if (Config::get('app.locale') == 'th') {{ $menu->name }} @else {{ $menu->engname }} @endif</a></li>
                  @else
                    <li ><a href="{{url('/').'/'.$menu->url}}" class="sarabun">@if (Config::get('app.locale') == 'th') {{ $menu->name }} @else {{ $menu->engname }} @endif</a></li>
              @endif
            @endforeach

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
          </ul>
        </nav>
  
      </div>
    </header>