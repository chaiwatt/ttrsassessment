<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TTRS | ศูนย์สนับสนุนและให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศ</title>

    <link href="{{asset($generalinfo->logo)}}" rel="shortcut icon">
    
    @include('layouts.landing.css')
    <!-- Vendor CSS Files -->
<link href="{{asset('assets/landing/vendor/bootstrap/css/bootstrap_blog.min.css')}}" rel="stylesheet">


</head>
<body>

  <!-- ======= Top Bar ======= -->
  @include('layouts.landing.topbar')

	<!-- ======= Header ======= -->
	@include('layouts.landing.header')
  <!-- End Header -->

  @yield('content')

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
