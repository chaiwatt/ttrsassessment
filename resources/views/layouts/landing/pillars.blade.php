<section class="counts section-bg">
  <div class="container">
    <div class="section-title">
      
      @if (Config::get('app.locale') == 'th')
          <h2 class="sarabun"> 4 {{$homepagepillar->headerthai}}</h2>
          <p>{{$homepagepillar->descriptionthai}}</p>
        @else
          <h2 class="sarabun"> 4 {{$homepagepillar->headereng}}</h2>
          <p>{{$homepagepillar->descriptioneng}}</p>
      @endif
      
    </div>
    <div class="row">

      <div class="col-lg-3 col-md-6 text-center" data-aos="fade-up">
        <div class="count-box">
          <p><img src="{{asset($homepagepillar->pillarimage1)}}" alt=""></p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 text-center" data-aos="fade-up" data-aos-delay="200">
        <div class="count-box">
          <p><img src="{{asset($homepagepillar->pillarimage2)}}" alt=""></p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 text-center" data-aos="fade-up" data-aos-delay="400">
        <div class="count-box">
          <p><img src="{{asset($homepagepillar->pillarimage3)}}" alt=""></p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 text-center" data-aos="fade-up" data-aos-delay="600">
        <div class="count-box">
          <p><img src="{{asset($homepagepillar->pillarimage4)}}" alt=""></p>
        </div>
      </div>

    </div>

  </div>
</section>