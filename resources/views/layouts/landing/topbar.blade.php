    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-none d-lg-block">
        <div class="container clearfix">
          <div class="contact-info float-left" id="color">
            <i class="icofont-envelope"></i>{{$generalinfo->email}}
            <i class="icofont-phone"></i>{{$generalinfo->phone1}}
    
             <!-- ======= Social-Links ======= -->
            {{-- <a class="ml-4" href="{{$generalinfo->twitter}}" class="twitter"><i class="icofont-twitter"></i></a>
            <a href="{{$generalinfo->youtube}}" class="youtube"><i class="icofont-youtube"></i></a>
            <a href="{{$generalinfo->facebook}}" class="facebook"><i class="icofont-facebook"></i></a>
            <a href="{{$generalinfo->instagram}}" class="instagram"><i class="icofont-instagram"></i></a>
            <a href="{{$generalinfo->skype}}" class="skype"><i class="icofont-skype"></i></a>
            <a href="{{$generalinfo->linkedin}}" class="linkedin"><i class="icofont-linkedin"></i></a> --}}
          </div>
          
          <div class="social-links float-right" >
            @if (!Auth::check())
              {{-- <a href="{{route('login')}}" class="linkedin sarabun" style="text-decoration: none"><i class="icofont-login"></i> {{trans('lang.login')}}</a> --}}
              {{-- <a href="{{route('register')}}" class="linkedin sarabun" style="text-decoration: none"><i class="icofont-address-book"></i> {{trans('lang.register')}}</a> --}}
              <a href="{{url('login')}}" class="linkedin sarabun" style="text-decoration: none"><i class="icofont-login"></i> {{trans('lang.login')}}</a>
              <a href="{{url('register')}}" class="linkedin sarabun" style="text-decoration: none"><i class="icofont-address-book"></i> {{trans('lang.register')}}</a>
            @else
              <a href="{{route('logout')}}" class="linkedin sarabun" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icofont-logout"></i> {{trans('lang.signout')}}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
              @if (Auth::user()->user_type_id >= 4)
                <a href="{{route('dashboard.admin.report')}}" class="linkedin sarabun" style="text-decoration: none"><i class="icofont-home"></i> {{trans('lang.dashboard')}}</a>
              @elseif(Auth::user()->user_type_id == 3)
                <a href="{{route('dashboard.expert.report')}}" class="linkedin sarabun" style="text-decoration: none"><i class="icofont-home"></i> {{trans('lang.dashboard')}}</a>
              @else
                <a href="{{route('dashboard.company.report')}}" class="linkedin sarabun" style="text-decoration: none"><i class="icofont-home"></i> {{trans('lang.dashboard')}}</a>
              @endif
            @endif
          </div>
          
        </div>
      </section> 