<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>TTRS | ศูนย์สนับสนุนและให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศ</title>
	<!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/icons/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/step2.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/js/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>  
	<link href="{{asset('assets/dashboard/js/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"/>  
	{{-- <link href="{{asset('assets/dashboard/js/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" /> --}}
	<link href="{{asset('assets/dashboard/js/plugins/materialdatetimepickerth/css/materialDateTimePicker.css') }}" rel="stylesheet" />
	<link href="{{asset('assets/dashboard/css/layout.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/colors.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/extend.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/dashboard/css/css-loader.css')}}" rel="stylesheet" type="text/css">
	
	<!-- /global stylesheets -->
    @section('pageCss')
    @show
</head>

<body @isset($mini) class="sidebar-xs" @endisset>
	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand">
			<a href="{{url('/')}}" class="d-inline-block">
				<img src="{{asset('assets/dashboard/images/user.jpg')}}" alt="">
			</a>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
			</ul>

			<span class="navbar-text ml-md-3 mr-md-auto">
				{{$generalinfo->company}}
			</span>

			<ul class="navbar-nav ml-auto">

						{{-- <li class="nav-item dropdown">
							<a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
								<i class="icon-people"></i>
								<span class="d-md-none ml-2">Users</span>
							</a>
							
							<div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-300">
								<div class="dropdown-content-header">
									<span class="font-weight-semibold">ผู้ใช้ออนไลน์</span>
									<a href="#" class="text-default"><i class="icon-search4 font-size-base"></i></a>
								</div>
		
								<div class="dropdown-content-body dropdown-scrollable">
									<ul class="media-list">
										<li class="media">
											<div class="mr-3">
												<img src="{{asset('assets/dashboard/images/user.jpg')}}" width="36" height="36" class="rounded-circle" alt="">
											</div>
											<div class="media-body">
												<a href="#" class="media-title font-weight-semibold">Jordana Ansley</a>
												<span class="d-block text-muted font-size-sm">Lead web developer</span>
											</div>
											<div class="ml-3 align-self-center"><span class="badge badge-mark border-success"></span></div>
										</li>
		
										<li class="media">
											<div class="mr-3">
												<img src="{{asset('assets/dashboard/images/user.jpg')}}" width="36" height="36" class="rounded-circle" alt="">
											</div>
											<div class="media-body">
												<a href="#" class="media-title font-weight-semibold">Will Brason</a>
												<span class="d-block text-muted font-size-sm">Marketing manager</span>
											</div>
											<div class="ml-3 align-self-center"><span class="badge badge-mark border-danger"></span></div>
										</li>
									</ul>
								</div>
		
								<div class="dropdown-content-footer bg-light">
									<a href="#" class="text-grey mr-auto">All users</a>
									<a href="#" class="text-grey"><i class="icon-gear"></i></a>
								</div>
							</div>
						</li> --}}

						
				<li class="nav-item dropdown">
						<a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
							<i class="icon-bubbles4"></i>
							<span class="d-md-none ml-2">Messages</span>
							@if ($shareunreadmessages->count() > 0)
								<span class="badge badge-pill bg-warning-400 ml-auto ml-md-0" id="_newmessagecount">{{$shareunreadmessages->count()}}</span>
							@endif
							
						</a>
						
						<div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
							<div class="dropdown-content-header">
								<span class="font-weight-semibold">ข้อความใหม่</span>
								{{-- <a href="#" class="text-default"><i class="icon-compose"></i></a> --}}
							</div>
	
							<div class="dropdown-content-body dropdown-scrollable">
								<ul class="media-list" id="unreadmessages">
									@foreach ($shareunreadmessages as $unreadmessage)
										<li class="media">
											<div class="mr-3 position-relative">
												<span class="btn bg-pink-400 rounded-circle btn-icon btn-sm">
													<span class="letter-icon">J</span>
												</span>
											</div>
											<div class="media-body">
												<div class="media-title">
													{{-- <a href="#"> --}}
														<span class="font-weight-semibold">{{$unreadmessage->sender->name}} {{$unreadmessage->sender->lastname}} {{$unreadmessage->sender->name}}:  {{$unreadmessage->title}}</span>
														<span class="text-muted float-right font-size-sm">{{$unreadmessage->timeago}}</span>
													{{-- </a> --}}
												</div>
		
												<span class="text-muted">{{substr($unreadmessage->title,0,50)}}...</span>
											</div>
										</li>
									@endforeach
								</ul>
							</div>
							{{-- <div class="dropdown-content-footer justify-content-center p-0">
								<a href="#" class="bg-light text-grey w-100 py-2" data-popup="tooltip" title="Load more"><i class="icon-menu7 d-block top-0"></i></a>
							</div> --}}
						</div>
					</li>

					<li class="nav-item dropdown dropdown-user">
							<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
								{{-- @if (!Empty(Auth::user()->picture))
								<img src="{{asset(Auth::user()->picture)}}" class="rounded-circle mr-2" height="34" alt="">
								@endif								 --}}
								<span>{{Auth::user()->name}} {{Auth::user()->lastname}}</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="{{route('setting.profile.edit',['userid' => Auth::user()->id])}}" class="dropdown-item"><i class="icon-user-plus"></i> โปรไฟล์ของฉัน</a>
								{{-- <a href="#" class="dropdown-item"><i class="icon-coins"></i> My balance</a> --}}
								<a href="{{route('setting.profile.edit',['userid' => Auth::user()->id])}}" class="dropdown-item"><i class="icon-comment-discussion"></i> ข้อความ @if ($shareunreadmessages->count() > 0) <span class="badge badge-pill bg-blue ml-auto">{{$shareunreadmessages->count()}}</span> @endif
								</a>
								<div class="dropdown-divider"></div>
								{{-- <a href="#" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a> --}}
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
				Navigation
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
						<li class="nav-item">
								<a href="{{route('landing.index')}}" class="nav-link">
							<i class="icon-home4"></i>
							<span>เว็บไซต์</span>
							</a>
						</li>
						@include('layouts.dashboard.sidemenu')
					</ul>
				</div>
			</div>			
		</div>

		<!-- Main content -->
		<div class="content-wrapper">
            
            @yield('content')

			<!-- Footer -->
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="text-center d-lg-none w-100">
					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
						<i class="icon-unfold mr-2"></i>
						Footer
					</button>
				</div>

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
	<script src="{{asset('assets/dashboard/js/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/datatable/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/datatable/buttons/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/datatable/ajax/jszip.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/datatable/ajax/pdfmake.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/datatable/ajax/vfs_fonts.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/datatable/buttons/buttons.html5.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/datatable/buttons/buttons.print.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/datatable/buttons/buttons.colVis.min.js')}}"></script>
	<script src="{{ asset('assets/dashboard/js/plugins/momentjs/moment.js') }}"></script> <!-- Moment Plugin Js -->
	<script src="{{asset('assets/dashboard/js/plugins/sweetalert2/sweetalert2.js')}}"></script>
	{{-- <script src="{{ asset('assets/dashboard/js/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script> --}}
	<script src="{{ asset('assets/dashboard/js/plugins/materialdatetimepickerth/js/materialDateTimePicker.js') }}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/forms/selects/select2.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/handsontable.min.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/plugins/forms/styling/uniform.min.js')}}"></script>

	<script src="{{asset('assets/dashboard/js/app.js')}}"></script>
	<script src="{{asset('assets/dashboard/js/demo_pages/form_layouts.js')}}"></script>


	@section('pageScript')
	
	@show
	
	<script>

	</script>
</body>
</html>

