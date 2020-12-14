<section id="services" class="services">
  <div class="container mb-5">

    <div class="section-title">
      <h2 class="sarabun" class="content">{{trans('lang.registrationprocess')}}</h2>
    </div>

    <div class="row">
      @foreach ($homepageservices as $homepageservice)
        <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
          <div class="icon"><img src="{{asset($homepageservice->icon)}}" alt=""></i></div>
          @if (Config::get('app.locale') == 'th')
                <h4 class="title sarabun"><a href="{{$homepageservice->link}}">{{$homepageservice->titlethai}}</a></h4>
                <p  id="sarabun" class="description sarabun">{{$homepageservice->descriptionthai}}</p>
              @else
                <h4 class="title sarabun"><a href="">{{$homepageservice->titleeng}}</a></h4>
                <p  id="sarabun" class="description sarabun">{{$homepageservice->descriptioneng}}</p>
          @endif
        </div>
      @endforeach
    <a href="{{route('register')}}" class="btn-get-started float-right" data-aos="fade-up" data-aos-delay="550">เริ่มต้นใช้งาน</a>
  </div>
</section>