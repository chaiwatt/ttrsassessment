
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
	<link href="{{asset('assets/dashboard/js/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
	<link href="{{asset('assets/dashboard/css/layout.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/colors.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/extend.css?v=12')}}" rel="stylesheet" type="text/css">
</head>

<body>

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Password recovery form -->
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-0">
								<i class="icon-checkmark3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
							</div>

							@yield('content')

						</div>
					</div>
				<!-- /password recovery form -->

			</div>
			<!-- /content area -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
	
	<!-- Global stylesheets -->
	<script src="{{asset('assets/dashboard/js/main/jquery.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/main/jquery-ui.min.js')}}"></script>	
	<script src="{{asset('assets/dashboard/js/main/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/loaders/blockui.min.js')}}"></script>
	<script src="{{ asset('assets/dashboard/js/plugins/momentjs/moment.js') }}"></script> <!-- Moment Plugin Js -->
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('assets/dashboard/js/plugins/forms/selects/select2.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/forms/styling/uniform.min.js')}}"></script>
	
	<script src="{{asset('assets/dashboard/js/app.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/demo_pages/form_layouts.js')}}"></script>
	{{-- <script src="{{asset('assets/dashboard/js/app/checkregister.js')}}"></script> --}}
</body>

</html>
