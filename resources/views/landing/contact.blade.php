@extends('layouts.contact.main')
@section('pageCss')
@stop
@section('content')
    
 <!-- ======= Contact Us Section ======= -->
 <section id="contact" class="contact">
    <div class="container">
  
      <div class="section-title">
        <h2>ติดต่อเรา</h2>
      </div>
  
      <div class="row">
  
        <div class="col-lg-6 d-flex align-items-stretch" data-aos="fade-up">
          <div class="info-box">
            <i class="bx bx-map"></i>
            <h3>ศูนย์สนับสนุนและให้บริการประเมินจัดอันดับเทคโนโลยี</h3>
             {{-- <p class="contact-p">{{$generalinfo->address}} ตำบล{{$generalinfo->tambol->name}} อำเภอ{{$generalinfo->amphur->name}} จังหวัด{{$generalinfo->province->name}} {{$generalinfo->postalcode}}</p> --}}
             <p class="contact-p">111 อุทยานวิทยาศาสตร์ประเทศไทย ถ.พหลโยธิน ตำบลคลองหนึ่ง <br>อำเภอคลองหลวง จังหวัดปทุมธานี 12120</p>
          </div>
        </div>
  
        <div class="col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
          <div class="info-box">
            <i class="bx bx-time"></i>
            <h3>เวลาทำการ</h3>
            <p>จันทร์-ศุกร์: {{$generalinfo->workdaytime}}<br>
              {{-- เสาร์: {{$generalinfo->saturdaytime}}<br> --}}
              </p>
          </div>
        </div>
  
        <div class="col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <div class="info-box ">
            <i class="bx bx-phone-call"></i>
            <h3>ติดต่อ</h3>
            <p>โทรศัพท์: {{$generalinfo->phone1}} <br>
              แฟ็กซ์: {{$generalinfo->fax}}
              <br>
              อีเมล: {{$generalinfo->email}}</p>
          </div>
        </div>
  
        <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
          @if (Session::has('success'))
            <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
                {{ Session::get('success') }}
            </div>
            @elseif( Session::has('error') )
            <div class="alert alert-danger alert-styled-left alert-dismissible">
                {{ Session::get('error') }}
            </div>
            @endif
            @if ($errors->count() > 0)
            <div class="alert alert-danger alert-styled-left alert-dismissible">
                {{ $errors->first() }}
            </div>
        @endif
          <form action="{{route('landing.addcontact')}}" method="post" role="form" class="php-email-form">
            @csrf
            <div class="form-row">
              <div class="col-lg-6 form-group">
                <input type="text" name="name" class="form-control form-control-lg" value="{{old('name')}}" placeholder="ชื่อ-สกุล"  />
              </div>
              <div class="col-lg-6 form-group">
                <input type="text" class="form-control form-control-lg" name="email" value="{{old('email')}}" placeholder="อีเมล"  />
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-lg" name="subject"  value="{{old('subject')}}" placeholder="หัวข้อ" />
            </div>
            <div class="form-group">
              <textarea class="form-control form-control-lg" name="message" rows="5"  value="{{old('message')}}" placeholder="ข้อความ" ></textarea>
            </div>
            <div class="text-center"><button type="submit">ส่งข้อความ</button></div>
          </form>
        </div>
      </div>
  
    </div>
  </section>
  <!-- End Contact Us Section -->
@endsection

@section('pageScript')

@stop
