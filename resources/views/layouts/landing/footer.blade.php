<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 col-md-6 footer-info">
         
            <a href="{{route('landing.index')}}"><img src="{{asset($generalinfo->logo)}}" class="w-75" alt="" class="img-fluid"></a>
       
            <p class="sarabun">
              111 อุทยานวิทยาศาสตร์ประเทศไทย ถนนพหลโยธิน ตำบลคลองหนึ่ง อำเภอคลองหลวง จังหวัดปทุมธานี 12120 
           
    
          </p>
          <div class="social-links mt-3">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-7 footer-links">
          <h4 style="font-family: Sarabun; font-weight:200">เวลาทำการ</h4>
           จันทร์-ศุกร์: <strong>{{$generalinfo->workdaytime}}</strong> 
          <br>
          อาทิตย์: <strong> {{$generalinfo->sundaytime}}</strong> 

        </div>

        <div class="col-lg-4 col-md-6 footer-newsletter">
          <h4 style="font-family: Sarabun; font-weight:200">ติดต่อ</h4>
          โทรศัพท์: <strong>{{$generalinfo->phone1}}, {{$generalinfo->phone2}}</strong>
          <br>
          แฟ็กซ์: <strong>{{$generalinfo->fax}}</strong>
        </div>

        <div class="col-lg-2 col-md-5 footer-links">
          <h4 style="font-family: Sarabun; font-weight:200">เมนู ด่วน</h4>
          <ul>
            @foreach($directmenus as $key => $menu)
            @if ($key == 0)
                  <li><i class="bx bx-chevron-right"></i><a href="{{url('/').'/'.$menu->url}}" class="sarabun">@if (Config::get('app.locale') == 'th') {{ $menu->name }} @else {{ $menu->engname }} @endif</a></li>
                @else
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
      &copy;สงวนลิขสิทธิ์ {{date('Y')}}  <strong><span>{{$generalinfo->company}}</span></strong>. 
    </div>
  
  </div>
</footer>