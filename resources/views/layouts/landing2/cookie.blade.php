<!-- START Cookie-Alert -->
<div class="alert  cookiealert" role="alert">
    <div class="container">
        
        <div class="row">
           
            <div class="col-md-1">
                <img src="{{asset('assets/landing2/images/ck.png')}}" alt="">
            </div>
        <div class="col-md-7">
                <b>
                @if (Config::get('app.locale') == 'th')
                เว็บไซต์นี้ใช้คุกกี้
                @else
                Your privacy
                @endif
                </b>
                <p>  @if (Config::get('app.locale') == 'th')
                    เราใช้คุกกี้เพื่อนำเสนอเนื้อหาและนโยบายที่ท่านอาจสนใจ เพื่อให้ท่านได้รับประสบการณ์ที่ดียิ่งขึ้น <br>คลิกเพื่อดูข้อมูลเพิ่มเติมเกี่ยวกับการใช้คุกกี้ของเราผ่านทาง <a href="{{route('landing.policy').'#cookie_policy'}}" target="_blank"> <u>'นโยบายคุกกี้'</u>
                    @else
                    By clicking "Accept all cookies", you agree TTRS website can store cookies on your device and disclose information in accordance with our <a href="{{route('landing.policy').'#cookie_policy'}}" target="_blank"> <u>'Cookie Policy.'</u>
                    @endif  </a></p>  
        </div>
        <div class="col-md-4 mt-3">
           <a href="{{route('landing.policy')}}" id="btn-cookie" class="  btn  btn-outline-secondary rounded-pill">@if (Config::get('app.locale') == 'th')
            นโยบายความเป็นส่วนตัว
            @else
            Website Policy
            @endif</a>
           <a href="#" id="btn-cookie"   class="  btn  btn-primary rounded-pill acceptcookies">@if (Config::get('app.locale') == 'th')
            ตกลง
            @else
            Accept
            @endif</a>
        </div>
    </div>
</div>
</div> 
<!-- END Cookie-Alert -->