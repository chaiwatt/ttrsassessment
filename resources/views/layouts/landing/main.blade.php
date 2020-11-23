<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TTRS | ศูนย์สนับสนุนและให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศ</title>

    <link href="{{asset('assets/landing/img/logo.png')}}" rel="shortcut icon">

	@include('layouts.landing.css')

</head>
<body>
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



  
  <!-- ======= Footer ======= -->
  @include('layouts.landing.footer')
  <!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  @include('layouts.landing.js')

</body>
</html>
