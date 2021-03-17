<div id="rs-faq" class="rs-faq rs-project style3 gray-color pt-50 md-pb-395 pb-50 md-pt-90 ">
    <div class="container">
        {{-- <div class="sec-title2 text-center mt-30"> --}}
   
        {{-- <div class="desc">
            We've been building creative tools together for over a decade and have a deep appreciation for software applications
        </div> --}}
        {{-- </div> --}}
        <div class="row">
           {{-- <div class="col-lg-6 pr-40 md-pr-15">
                <div class="images-part">
                    <img src="assets/images/about/about-home.png" alt="">
                </div>
           </div> --}}
           <div class="col-lg-12">
                {{-- <div class="sec-title2 mb-45">
                    <span class="sub-text style-bg">Faqs</span>
                    <h2 class="title title6">
                       Do You Have Any Questions?
                    </h2>
                </div> --}}
               <div class="faq-content">
                   <div id="accordion" class="accordion">
                       @foreach ($sharefaqs as $key => $faq)
                       <div class="card">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapse{{$key}}"  aria-expanded="false">
                                    @if (Config::get('app.locale') == 'th')
                                        {{$faq->title}}
                                    @else
                                        {{$faq->titleeng}}
                                    @endif
                                </a>
                            </div>
                            <div id="collapse{{$key}}" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    @if (Config::get('app.locale') == 'th')
                                        {{$faq->body}}
                                    @else
                                        {{$faq->bodyeng}}
                                    @endif
                                </div>
                            </div>
                        </div>
                       @endforeach
                   </div>
               </div>
           </div>  
        </div>
    </div>
</div>