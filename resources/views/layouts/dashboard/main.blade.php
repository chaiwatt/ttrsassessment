<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>TTRS | ศูนย์สนับสนุนและให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศ</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/landing2/images/favicon.png')}}">
	<!-- Global stylesheets -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css"> --}}
	<link href="{{asset('assets/dashboard/css/new.css')}}" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/icons/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/step2.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
	
	<link href="{{asset('assets/dashboard/js/plugins/materialdatetimepickerth/css/materialDateTimePicker.css') }}" rel="stylesheet" />
	<link href="{{asset('assets/dashboard/css/layout.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/colors.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/extend.css?v=11')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/customlogo.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/css-loader.css')}}" rel="stylesheet" type="text/css">
	{{-- <link href="{{asset('assets/dashboard/css/new.css')}}" rel="stylesheet" type="text/css"> --}}
	{{-- <link href="{{asset('assets/dashboard/js/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>  
	<link href="{{asset('assets/dashboard/js/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"/>   --}}
	
	<!-- /global stylesheets -->
    @section('pageCss')
    @show
</head>

{{-- <body class="sidebar-xs"> --}}
<body id="html_body" 
	@if ($generalinfo->togglebar == 1)
		class="sidebar-xs"
	@endif
>
	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand" style="min-width: 150px">
			<a href="{{url('/')}}" class="d-inline-block">
				<img src="{{asset('assets/dashboard/images/headerlogowhite.png')}}" alt="">
			</a>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3 "></i>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					{{-- @if ($generalinfo->togglebar == 1)
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block" data-popup="tooltip-demo" title="คลิกเพื่อขยาย" data-placement="left" data-container="body" data-trigger="hover">
					@else
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block" data-placement="left" data-container="body" data-trigger="hover">
					@endif --}}
					{{-- <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block" data-popup="tooltip-demo" title="คลิกเพื่อขยาย" data-placement="left" data-container="body" data-trigger="hover"> --}}
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block" data-placement="left" data-container="body" data-trigger="hover">
						<i class="icon-paragraph-justify3 togglebar"></i>
					</a>
				</li>
			</ul>

			<span class="navbar-text ml-md-3 mr-md-auto">
				{{$generalinfo->company_titlebar}}
			</span>

			<ul class="navbar-nav ml-auto">	
				<li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
						<img src="{{asset(Auth::user()->company->logo)}}" class="rounded-circle mr-2" height="34" alt="">
						<div id="_newmessagecount_wrapper">
							<span>@if ($shareunreadmessages->count()>0) <span class="badge badge-pill bg-warning-400 d-flex align-items-left" style="width:22px" id="_newmessagecount">{{$shareunreadmessages->count()}} @endif </span>{{Auth::user()->name}} {{Auth::user()->lastname}}
							@if (Auth::user()->user_type_id >= 3)
								({{@Auth::user()->UserType->name}})
							@endif
						</span>
						</div>

					</a>
					<div class="dropdown-menu dropdown-menu-right">
						@if (Auth::user()->user_type_id ==1 || Auth::user()->user_type_id ==2)
								<a href="{{route('setting.profile.user.edit',['userid' => Auth::user()->id])}}" class="dropdown-item"><i class="icon-user-plus"></i> Profile</a>
							{{-- @elseif(Auth::user()->user_type_id == 2) --}}
								
							@elseif(Auth::user()->user_type_id == 3)
								<a href="{{route('setting.profile.expert.edit',['userid' => Auth::user()->id])}}" class="dropdown-item"><i class="icon-user-plus"></i> Profile</a>
								@elseif(Auth::user()->user_type_id >= 4)
								<a href="{{route('setting.profile.officer.edit',['userid' => Auth::user()->id])}}" class="dropdown-item"><i class="icon-user-plus"></i> Profile</a>
							{{-- @elseif(Auth::user()->user_type_id == 4) --}}
						@endif
						
						<a href="{{route('setting.profile.edit',['userid' => Auth::user()->id])}}" class="dropdown-item"><i class="icon-comment-discussion"></i> ข้อความ @if ($shareunreadmessages->count() > 0) <span class="badge badge-pill bg-blue ml-auto">{{$shareunreadmessages->count()}}</span> @endif
						</a>
						<div class="dropdown-divider"></div>
						<a data-placement="bottom" class="dropdown-item" title="ออกจากระบบ" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-switch2"></i>ออกจากระบบ</a>
					</div>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->
	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				เมนูหลัก
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->

			<!-- Sidebar content -->
			<div class="sidebar-content">
				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">
						{{-- <li class="nav-item">
								<a href="{{route('landing2.index')}}" class="nav-link">
							<i class="icon-home4"></i>
							<span>เว็บไซต์</span>
							</a>
						</li> --}}
						@if (Auth::user()->user_type_id !=0)
								@include('layouts.dashboard.sidemenu')
							@else
								@include('layouts.dashboard.sidemenu2')
						@endif
						
					</ul>
				</div>
			</div>			
		</div>

		<!-- Main content -->
		<div class="content-wrapper">
            
            @yield('content')

			<!-- Footer -->
			<div class="navbar navbar-expand-lg navbar-light">
				{{-- <div class="text-center d-lg-none w-100">
					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
						<i class="icon-unfold mr-2"></i>
						Footer
					</button>
				</div> --}}

				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy;สงวนลิขสิทธิ์ {{date('Y')}} {{$generalinfo->company}} <a href="{{url('')}}">
					</span>

				</div>
			</div>
			<!-- /footer -->
		</div>
		<!-- /main content -->
	</div>


	<script src="{{asset('assets/dashboard/js/main/jquery.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/main/jquery-ui.min.js')}}"></script>	
	<script src="{{asset('assets/dashboard/js/main/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/loaders/blockui.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/app/helper/togglebarstatus.js')}}"></script>
	<script src="{{ asset('assets/dashboard/js/plugins/momentjs/moment.js') }}"></script> <!-- Moment Plugin Js -->
	<script src="{{asset('assets/dashboard/js/plugins/sweetalert2/sweetalert2.js')}}"></script>
	
	<script src="{{ asset('assets/dashboard/js/plugins/materialdatetimepickerth/js/materialDateTimePicker.js') }}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/forms/selects/select2.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/handsontable.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/forms/styling/uniform.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/cleave/cleave.min.js')}}"></script>
	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script> --}}
	
	<script src="{{asset('assets/dashboard/js/plugins/datatables/datatables.min.js')}}"></script>

	<script src="{{asset('assets/dashboard/js/app.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/demo_pages/form_layouts.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/removenextaction.js')}}"></script>
	
	<script>
		var route = {
			 url: "{{ url('/') }}",
			 token: $('meta[name="csrf-token"]').attr('content')
		 };
	 </script>

	@section('pageScript')
	
	@show
	

</body>
</html>

