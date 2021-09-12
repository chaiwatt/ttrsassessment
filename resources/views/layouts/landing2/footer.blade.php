<footer id="rs-contact" class="rs-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 footer-widget">
                    <div class="footer-logo mb-30">
                        <a href="{{url('')}}"><img src="{{asset($generalinfo->logo)}}" alt=""></a>
                    </div>
                      <div class="textwidget pb-30">
                          
                          @if (Config::get('app.locale') == 'th')
                          <p>111 อุทยานวิทยาศาสตร์ประเทศไทย <br>ถ.พหลโยธิน ตำบลคลองหนึ่ง <br>อำเภอคลองหลวง จังหวัดปทุมธานี <br>12120 </p>
                          @else
                          <p>111 Thailand Science Park <br>Phahonyothin Rd, Khlong Luang District, Pathum Thani 12120 </p>
                          @endif
                      </div>
                      {{-- <ul class="footer-social md-mb-30">  
                          <li> 
                              <a href="#" target="_blank"><span><i class="fa fa-facebook"></i></span></a> 
                          </li>
                          <li> 
                              <a href="# " target="_blank"><span><i class="fa fa-twitter"></i></span></a> 
                          </li>

                          <li> 
                              <a href="# " target="_blank"><span><i class="fa fa-pinterest-p"></i></span></a> 
                          </li>
                          <li> 
                              <a href="# " target="_blank"><span><i class="fa fa-instagram"></i></span></a> 
                          </li>
                                                                   
                      </ul> --}}
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <h3 class="widget-title">
                        @if (Config::get('app.locale') == 'th')
                        เวลาทำการ
                        @else
                        Office Hours
                        @endif
                        
                    </h3>
                    <p class="widget-desc">
                        @if (Config::get('app.locale') == 'th')
                        จันทร์-ศุกร์:
                        {{$generalinfo->workdaytime}} น.
                        @else
                        Mon-Fri:
                        {{$generalinfo->workdaytime}}
                        @endif</p>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 md-mb-30">
                    <h3 class="widget-title">
                        @if (Config::get('app.locale') == 'th')
                        ติดต่อ
                        @else
                        Contact
                        @endif
                    </h3>
                    <ul class="address-widget">
                        {{-- <li>
                            <i class="flaticon-location"></i>
                            <div class="desc">374 FA Tower, William S Blvd 2721, IL, USA</div>
                        </li> --}}
                        <li>
                            <i class="flaticon-call"></i>
                            <div class="desc">
                                @if (Config::get('app.locale') == 'th')
                                    <a href="tel:{{$generalinfo->phone1}}">{{$generalinfo->phone1}} ต่อ {{$generalinfo->phone1_ext}}</a>
                                @else
                                    <a href="tel:{{$generalinfo->phone1}}">{{$generalinfo->phone1}} Ext {{$generalinfo->phone1_ext}}</a>
                                @endif
                               {{-- <a href="tel:{{$generalinfo->phone1}}">{{$generalinfo->phone1}} ต่อ {{$generalinfo->phone1_ext}}</a> --}}
                            </div>
                        </li>
                        <li>
                            <i class="flaticon-email"></i>
                            <div class="desc">
                                <a href="mailto:{{$generalinfo->email}}">{{$generalinfo->email}}</a>
                            </div>
                        </li>
                        {{-- <li>
                            <i class="flaticon-clock-1"></i>
                            <div class="desc">
                                Opening Hours: 10:00 - 18:00   
                            </div>
                        </li> --}}
                    </ul>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <h3 class="widget-title">Site map</h3>
                        <ul class="copy-right-menu" >
                            <li><a href="{{route('landing.sitemap')}}" target="_blank">Site map</a></li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container" style="text-align:center">                    
            <div class="col-lg-12">
                <div class="copyright">
                    <p>&copy;
                        @if (Config::get('app.locale') == 'th')
                        สงวนลิขสิทธิ์
                        @else
                        Copyright
                        @endif
                          {{date('Y')}} <span> @if (Config::get('app.locale') == 'th')
                            {{$generalinfo->company}}
                            @else
                            National Science and Technology Development Agency : NSTDA.  
                            @endif</span> </p>
                </div>
            </div>
        </div>
    </div>
</footer>