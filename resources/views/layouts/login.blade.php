<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>TTRS | สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)</title>

    {{-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css"> --}}
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/icons/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/layout.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/colors.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/extend.css?v=10')}}" rel="stylesheet" type="text/css">
    @section('pageCss')
    @show
</head>

<body class="bg-slate-800">

	<!-- Page content -->
	<div class="page-content" style="background-image: url('{{asset('assets/dashboard/images/auth/bgimg.png')}}');background-size:cover;background-repeat:no-repeat;box-shadow: inset 2000px 0 0 0 rgba(0, 0, 0, 0.7);">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">
				<!-- Login card -->
                @yield('content')
				<!-- /login card -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->
	<!-- Core JS files -->
	<script src="{{asset('assets/dashboard/js/main/jquery.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/main/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('assets/dashboard/js/plugins/forms/selects/select2.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/forms/styling/uniform.min.js')}}"></script>

	<script src="{{asset('assets/dashboard/js/app.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/demo_pages/form_layouts.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('assets/dashboard/js/app.js')}}"></script>
	@section('pageScript')
	
	@show
	
</body>

</html>
