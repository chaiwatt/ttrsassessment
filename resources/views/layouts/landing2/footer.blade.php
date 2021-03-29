<footer id="rs-contact" class="rs-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 footer-widget">
                    <div class="footer-logo mb-30">
                        <a href="index.html"><img src="{{asset($generalinfo->logo)}}" alt=""></a>
                    </div>
                      <div class="textwidget pb-30"><p>111 อุทยานวิทยาศาสตร์ประเทศไทย <br>ถ.พหลโยธิน ตำบลคลองหนึ่ง อำเภอคลองหลวง จังหวัดปทุมธานี 12120 </p>
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
                    <h3 class="widget-title">เวลาทำการ</h3>
                    <p class="widget-desc">จันทร์-ศุกร์: {{$generalinfo->workdaytime}}</p>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 md-mb-30">
                    <h3 class="widget-title">ติดต่อ</h3>
                    <ul class="address-widget">
                        {{-- <li>
                            <i class="flaticon-location"></i>
                            <div class="desc">374 FA Tower, William S Blvd 2721, IL, USA</div>
                        </li> --}}
                        <li>
                            <i class="flaticon-call"></i>
                            <div class="desc">
                               <a href="tel:{{$generalinfo->phone1}}">{{$generalinfo->phone1}}</a>
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
                    {{-- <p class="widget-desc">We denounce with righteous and in and dislike men who are so beguiled and demo realized.</p> --}}
                    {{-- <p>
                        <input type="email" name="EMAIL" placeholder="อีเมล" required="">
                        <em class="paper-plane"><input type="submit" value="Sign up"></em>
                        <i class="flaticon-send"></i>
                    </p> --}}
                    {{-- <div class="row y-middle">  --}}
                        {{-- <div class="col-lg-12 text-left"> --}}
                            <ul class="copy-right-menu" >
                                <li><a href="index.html">Home</a></li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="shop.html">Shop</a></li>
                                <li><a href="faq.html">FAQs</a></li>
                            </ul>
                        {{-- </div> --}}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container" style="text-align:center">                    
            {{-- <div class="row y-middle"> --}}
                {{-- <div class="col-lg-6 text-right md-mb-10 order-last">
                    <ul class="copy-right-menu">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="shop.html">Shop</a></li>
                        <li><a href="faq.html">FAQs</a></li>
                    </ul>
                </div> --}}
                <div class="col-lg-12">
                    <div class="copyright">
                        <p>&copy; สงวนลิขสิทธิ์ {{date('Y')}} <span>{{$generalinfo->company}}</span> </p>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</footer>