<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-4 col-md-6 footer-info">
         
            <a href="{{route('landing.index')}}"><img src="{{asset($generalinfo->logo)}}" class="w-50" alt="" class="img-fluid"></a>
       
            <p class="sarabun">
              111 อุทยานวิทยาศาสตร์ประเทศไทย <br>ถ.พหลโยธิน ตำบลคลองหนึ่ง อำเภอคลองหลวง <br>จังหวัดปทุมธานี 12120 
           
    
          </p>
          {{-- <div class="social-links mt-3">
            <a href="{{$generalinfo->twitter}}" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="{{$generalinfo->youtube}}" class="youtube"><i class="bx bxl-youtube"></i></a>
            <a href="{{$generalinfo->facebook}}" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="{{$generalinfo->instagram}}" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="{{$generalinfo->skype}}" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="{{$generalinfo->linkedin}}" class="linkedin"><i class="bx bxl-linkedin"></i></a>
          </div> --}}
        </div>

        <div class="col-lg-3 col-md-7 footer-links">
          <h4 style="font-family: Sarabun; font-weight:200">เวลาทำการ</h4>
           จันทร์-ศุกร์: {{$generalinfo->workdaytime}}
          <br>
          {{-- อาทิตย์: {{$generalinfo->sundaytime}} --}}

        </div>

        <div class="col-lg-3 col-md-6 footer-newsletter">
          <h4 style="font-family: Sarabun; font-weight:200">ติดต่อ</h4>
          โทรศัพท์: {{$generalinfo->phone1}} ต่อ {{$generalinfo->phone1_ext}}
          <br>
          แฟ็กซ์: {{$generalinfo->fax}}
          <br>
          อีเมล: {{$generalinfo->email}}
        </div>

        <div class="col-lg-2 col-md-5 footer-links">
          <h4 style="font-family: Sarabun; font-weight:200">เมนู ด่วน</h4>
          <ul>
            @foreach($directmenus as $key => $menu)
            @if ($key != 0)
                  <li ><i class="bx bx-chevron-right"></i><a href="{{url('/').'/'.$menu->url}}" class="sarabun">@if (Config::get('app.locale') == 'th') {{ $menu->name }} @else {{ $menu->engname }} @endif</a></li>
            @endif
          @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy;สงวนลิขสิทธิ์ {{date('Y')}} <span>{{$generalinfo->company}}</span> 
    </div>
  
  </div>
</footer>