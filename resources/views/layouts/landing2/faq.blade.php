<div id="rs-faq" class="rs-faq rs-project style3 bgProject gray-color pt-50 md-pb-395 pb-50 md-pt-90 ">
    <div class="container">
        <div class="row">
           <div class="col-lg-12">
                <div class="sec-title2 mb-45 mt-0">
                    <h2 class="title title6 text-white"  style="margin-top: -50px">
                      
                      @if (Config::get('app.locale') == 'th')
                      คำถามที่พบบ่อย
                        @else
                            FAQ
                        @endif
                    </h2>
                </div>
               <div class="faq-content">
                   <div id="accordion" class="accordion">
                       @foreach ($sharefaqs as $key => $faq)
                       <div class="card" data-aos="fade-right" data-aos-delay="{{($key + 1)*100}}" style="margin-top: 15px">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapse{{$key}}"  aria-expanded="false" >
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