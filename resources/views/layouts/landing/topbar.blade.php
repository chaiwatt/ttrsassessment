    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-none d-lg-block">
        <div class="container clearfix">
          <div class="contact-info float-left" id="color">
            <i class="icofont-envelope"></i><a href="mailto:contact@example.com">info@nstda.or.th</a>
            <i class="icofont-phone"></i><a href="tel:0-256-7000"> 0-2564-7000</a>
    
             <!-- ======= Social-Links ======= -->
            <a class="ml-4" href="#" class="twitter"><i class="icofont-twitter"></i></a>
            <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
            <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
            <a href="#" class="skype"><i class="icofont-skype"></i></a>
            <a href="#" class="linkedin"><i class="icofont-linkedin"></i></a>
          </div>
          
          <div class="social-links float-right" >
            @if (!Auth::check())
              <a href="{{route('login')}}" id="thaifont" class="linkedin"><i class="icofont-login"></i> {{trans('lang.login')}}</a>
              <a href="{{route('register')}}" id="thaifont" class="linkedin"><i class="icofont-address-book"></i> {{trans('lang.register')}}</a>
            @else
              <a href="{{route('logout')}}" id="thaifont" class="linkedin" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icofont-logout"></i> {{trans('lang.signout')}}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
              @if (Auth::user()->user_type_id >= 4)
                <a href="{{route('dashboard.admin.report')}}" id="thaifont" class="linkedin"><i class="icofont-home"></i> {{trans('lang.dashboard')}}</a>
              @elseif(Auth::user()->user_type_id == 3)
                <a href="{{route('dashboard.expert.report')}}" id="thaifont" class="linkedin"><i class="icofont-home"></i> {{trans('lang.dashboard')}}</a>
              @else
                <a href="{{route('dashboard.company.report')}}" id="thaifont" class="linkedin"><i class="icofont-home"></i> {{trans('lang.dashboard')}}</a>
              @endif
            @endif
          </div>
          
        </div>
      </section> 