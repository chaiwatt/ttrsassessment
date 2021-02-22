<section id="services" class="services">
    <div class="container">

      <div class="section-title">
        <h2 class="sarabun">{{trans('lang.news')}}</h2>
      </div>
    

      <div class="row">
          @foreach ($sharepages->reverse() as $key => $page)
          @php
              $datadelay = $key*200;
          @endphp
          <div class="col-md-4 d-flex " data-aos="fade-up" data-aos-delay="{{$datadelay}}">
                <div class="card mb-3">
                    <img class="card-img-top" src="{{asset($page->homepageblogimage->name)}}" alt="Amanda Shah">
                    <div class="card-body py-3">
                        <h5 class="mb-0 sarabun">{{$page->name}}</h5>
                        <span class="sarabun">{{$page->pageCategory->name}}</span>
                    </div>
                    <div class="card-footer ">
                        <a  class="sarabun" href="{{route('landing.page',['slug' => $page->slug])}}">อ่านเพิ่มเติม</a>
                    </div>
                </div>
            </div>
          @endforeach
    </div>
    </div>
  
      

   
    </div>
  </section>