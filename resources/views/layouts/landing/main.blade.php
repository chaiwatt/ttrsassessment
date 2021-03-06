<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TTRS | ศูนย์สนับสนุนและให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศ</title>

    <link href="{{asset($generalinfo->logo)}}" rel="shortcut icon">

	@include('layouts.landing.css')

</head>
<body>
  @if (Auth::check())
    <input type="text" id="authcheck" value="0" hidden>
    @if (Auth::user()->user_type_id >= 4)
        <input type="text" id="url" value="{{route('dashboard.admin.report')}}" hidden>
    @elseif(Auth::user()->user_type_id == 3)
        <input type="text" id="url" value="{{route('dashboard.expert.report')}}" hidden>
    @else
        <input type="text" id="url" value="{{route('dashboard.company.report')}}" hidden>
    @endif
  @else
    <input type="text" id="authcheck" value="1" hidden>
    <input type="text" id="url" value="{{route('login')}}" hidden>
  @endif
  <!-- ======= Top Bar ======= -->
  @include('layouts.landing.topbar')
  
	<!-- ======= Header ======= -->
	@include('layouts.landing.header')
  <!-- End Header -->
  
	<!-- ======= Hero Section ======= -->
	@include('layouts.landing.slide')
  <!-- End Hero -->

  <!-- ======= Services Section ======= -->
  @include('layouts.landing.service')
  <!-- End Services Section -->

  <!-- ======= Counts Section ======= -->
  @include('layouts.landing.pillars')
  <!-- End Counts Section -->

  <!-- ======= News Section ======= -->
  @include('layouts.landing.news')
  <!-- End News Section -->

  
  <!-- ======= Cookie ======= -->
  @include('layouts.landing.cookie')
  <!-- End Cookie -->
  
  <!-- ======= Footer ======= -->
  @include('layouts.landing.footer')
  <!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  @include('layouts.landing.js')

</body>
</html>
