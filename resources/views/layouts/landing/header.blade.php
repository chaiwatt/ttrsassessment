    <!-- ======= Header ======= -->
    <header id="header">
      <div class="container">
        <div class="logo float-left">
  
          <a href="#"><img src="{{asset($generalinfo->logo)}}" alt="" class="img-fluid"></a>
        </div>
  
        <nav class="nav-menu float-right d-none d-lg-block " >
          <ul id="menulist">
            <li class="active "><a href="#" class="sarabun">หน้าหลัก</a></li>
            <li><a class="sarabun" href="{{route('landing.blog')}}">ข่าวสาร</a></li>
            <li><a class="sarabun" href="#">ประกาศ</a></li>
            <li><a class="sarabun" href="#">งานบริการ</a></li>
            <li><a class="sarabun" href="#">เกี่ยวกับเรา</a></li>
            <li><a class="sarabun" href="#">ติดต่อเรา</a></li>
           
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