@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    {{-- <div class="page-header page-header-light">
        
 

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ผู้ใช้งานระบบ</a>
                    <span class="breadcrumb-item active">ผู้ใช้งาน</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div> --}}
    <!-- /page header -->
 
				<!-- Cover area -->
				<div class="profile-cover">
					<div class="profile-cover-img" style="background-image: url({{asset('assets/dashboard/images/cover.jpg')}})"></div>
					<div class="media align-items-center text-center text-md-left flex-column flex-md-row m-0">
						<div class="mr-md-3 mb-2 mb-md-0">
							<a href="#" class="profile-thumb">
								<img src="{{asset('assets/dashboard/images/user.jpg')}}" class="border-white rounded-circle" width="48" height="48" alt="">
							</a>
						</div>

						<div class="media-body text-white">
				    		<h1 class="mb-0">{{Auth::user()->name}} {{Auth::user()->lastname}}</h1>
				    		<span class="d-block">{{Auth::user()->userposition->name}}</span>
						</div>

						<div class="ml-md-3 mt-2 mt-md-0">
							<ul class="list-inline list-inline-condensed mb-0">
								<li class="list-inline-item"><a href="#" class="btn btn-light border-transparent"><i class="icon-file-picture mr-2"></i> Cover image</a></li>
								<li class="list-inline-item"><a href="#" class="btn btn-light border-transparent"><i class="icon-file-stats mr-2"></i> Statistics</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /cover area -->


				<!-- Profile navigation -->
				<div class="navbar navbar-expand-lg navbar-light bg-light">
					<div class="text-center d-lg-none w-100">
						<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-second">
							<i class="icon-menu7 mr-2"></i>
							Profile navigation
						</button>
					</div>

					<div class="navbar-collapse collapse" id="navbar-second">
						<ul class="nav navbar-nav">
							<li class="nav-item">
								<a href="#activity" class="navbar-nav-link active" data-toggle="tab">
									<i class="icon-menu7 mr-2"></i>
									Activity
								</a>
							</li>
							<li class="nav-item">
								<a href="#schedule" class="navbar-nav-link" data-toggle="tab">
									<i class="icon-calendar3 mr-2"></i>
									Schedule
									<span class="badge badge-pill bg-success position-static ml-auto ml-lg-2">32</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#settings" class="navbar-nav-link" data-toggle="tab">
									<i class="icon-cog3 mr-2"></i>
									Settings
								</a>
							</li>
						</ul>

						<ul class="navbar-nav ml-lg-auto">
							<li class="nav-item">
								<a href="#" class="navbar-nav-link">
									<i class="icon-stack-text mr-2"></i>
									Notes
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="navbar-nav-link">
									<i class="icon-collaboration mr-2"></i>
									Friends
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="navbar-nav-link">
									<i class="icon-images3 mr-2"></i>
									Photos
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
									<i class="icon-gear"></i>
									<span class="d-lg-none ml-2">Settings</span>
								</a>

								<div class="dropdown-menu dropdown-menu-right">
									<a href="#" class="dropdown-item"><i class="icon-image2"></i> Update cover</a>
									<a href="#" class="dropdown-item"><i class="icon-clippy"></i> Update info</a>
									<a href="#" class="dropdown-item"><i class="icon-make-group"></i> Manage sections</a>
									<div class="dropdown-divider"></div>
									<a href="#" class="dropdown-item"><i class="icon-three-bars"></i> Activity log</a>
									<a href="#" class="dropdown-item"><i class="icon-cog5"></i> Profile settings</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!-- /profile navigation -->

    <!-- Content area -->
    <div class="content">
 				<!-- Inner container -->
                 <div class="d-flex align-items-start flex-column flex-md-row">

					<!-- Left content -->
					<div class="tab-content w-100 order-2 order-md-1">
						<div class="tab-pane fade active show" id="activity">

							<!-- Sales stats -->
							<div class="card">
								<div class="card-header header-elements-sm-inline">
									<h6 class="card-title">Weekly statistics</h6>
									<div class="header-elements">
										<span><i class="icon-history mr-2 text-success"></i> Updated 3 hours ago</span>

										<div class="list-icons ml-3">
					                		<a class="list-icons-item" data-action="reload"></a>
					                	</div>
				                	</div>
								</div>

								<div class="card-body">
									<div class="chart-container">
										<div class="chart has-fixed-height" id="tornado_negative_stack"></div>
									</div>
								</div>
							</div>
							<!-- /sales stats -->

					    </div>

					    <div class="tab-pane fade" id="schedule">

				    		<!-- Available hours -->
							<div class="card">
								<div class="card-header header-elements-inline">
									<h6 class="card-title">Available hours</h6>
									<div class="header-elements">
										<div class="list-icons">
					                		<a class="list-icons-item" data-action="collapse"></a>
					                		<a class="list-icons-item" data-action="reload"></a>
					                		<a class="list-icons-item" data-action="remove"></a>
					                	</div>
				                	</div>
								</div>

								<div class="card-body">
									<div class="chart-container">
										<div class="chart has-fixed-height" id="available_hours"></div>
									</div>
								</div>
							</div>
							<!-- /available hours -->



				    	</div>

					    <div class="tab-pane fade" id="settings">

							<!-- Profile info -->
							<div class="card">
								<div class="card-header header-elements-inline">
									<h5 class="card-title">Profile information</h5>
									<div class="header-elements">
										<div class="list-icons">
					                		<a class="list-icons-item" data-action="collapse"></a>
					                		<a class="list-icons-item" data-action="reload"></a>
					                		<a class="list-icons-item" data-action="remove"></a>
					                	</div>
				                	</div>
								</div>

								<div class="card-body">
									<form action="#">
										<div class="form-group">
											<div class="row">
												<div class="col-md-6">
													<label>Username</label>
													<input type="text" value="Eugene" class="form-control">
												</div>
												<div class="col-md-6">
													<label>Full name</label>
													<input type="text" value="Kopyov" class="form-control">
												</div>
											</div>
										</div>

										<div class="form-group">
											<div class="row">
												<div class="col-md-6">
													<label>Address line 1</label>
													<input type="text" value="Ring street 12" class="form-control">
												</div>
												<div class="col-md-6">
													<label>Address line 2</label>
													<input type="text" value="building D, flat #67" class="form-control">
												</div>
											</div>
										</div>

										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>City</label>
													<input type="text" value="Munich" class="form-control">
												</div>
												<div class="col-md-4">
													<label>State/Province</label>
													<input type="text" value="Bayern" class="form-control">
												</div>
												<div class="col-md-4">
													<label>ZIP code</label>
													<input type="text" value="1031" class="form-control">
												</div>
											</div>
										</div>

										<div class="form-group">
											<div class="row">
												<div class="col-md-6">
													<label>Email</label>
													<input type="text" readonly="readonly" value="eugene@kopyov.com" class="form-control">
												</div>
												<div class="col-md-6">
						                            <label>Your country</label>
						                            <select class="form-control form-control-select2" data-fouc>
						                                <option value="germany" selected>Germany</option> 
						                                <option value="france">France</option> 
						                                <option value="spain">Spain</option> 
						                                <option value="netherlands">Netherlands</option> 
						                                <option value="other">...</option> 
						                                <option value="uk">United Kingdom</option> 
						                            </select>
												</div>
											</div>
										</div>

				                        <div class="form-group">
				                        	<div class="row">
				                        		<div class="col-md-6">
													<label>Phone #</label>
													<input type="text" value="+99-99-9999-9999" class="form-control">
													<span class="form-text text-muted">+99-99-9999-9999</span>
				                        		</div>

												<div class="col-md-6">
													<label>Upload profile image</label>
				                                    <input type="file" class="form-input-styled" data-fouc>
				                                    <span class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
												</div>
				                        	</div>
				                        </div>

				                        <div class="text-right">
				                        	<button type="submit" class="btn btn-primary">Save changes</button>
				                        </div>
									</form>
								</div>
							</div>
							<!-- /profile info -->

				    	</div>
					</div>
					<!-- /left content -->


					<!-- Right sidebar component -->
					<div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right wmin-300 border-0 shadow-0 order-1 order-lg-2 sidebar-expand-md">

						<!-- Sidebar content -->
						<div class="sidebar-content">

							<!-- Navigation -->
							<div class="card">
								<div class="card-header bg-transparent header-elements-inline">
									<span class="card-title font-weight-semibold">Navigation</span>
									<div class="header-elements">
										<div class="list-icons">
					                		<a class="list-icons-item" data-action="collapse"></a>
				                		</div>
			                		</div>
								</div>

								<div class="card-body p-0">
									<ul class="nav nav-sidebar my-2">
										<li class="nav-item">
											<a href="#" class="nav-link">
												<i class="icon-user"></i>
												 My profile
											</a>
										</li>
										<li class="nav-item">
											<a href="#" class="nav-link">
												<i class="icon-cash3"></i>
												Balance
												<span class="text-muted font-size-sm font-weight-normal ml-auto">$1,430</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="#" class="nav-link">
												<i class="icon-tree7"></i>
												Connections
												<span class="badge bg-danger badge-pill ml-auto">29</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="#" class="nav-link">
												<i class="icon-users"></i>
												Friends
											</a>
										</li>

										<li class="nav-item-divider"></li>

										<li class="nav-item">
											<a href="#" class="nav-link">
												<i class="icon-calendar3"></i>
												Events
												<span class="badge bg-teal-400 badge-pill ml-auto">48</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="#" class="nav-link">
												<i class="icon-cog3"></i>
												Account settings
											</a>
										</li>
									</ul>
								</div>
							</div>
							<!-- /navigation -->


							<!-- Share your thoughts -->
							<div class="card">
								<div class="card-header bg-transparent header-elements-inline">
									<span class="card-title font-weight-semibold">Share your thoughts</span>
									<div class="header-elements">
										<div class="list-icons">
					                		<a class="list-icons-item" data-action="collapse"></a>
				                		</div>
			                		</div>
								</div>

								<div class="card-body">
									<form action="#">
				                    	<textarea name="enter-message" class="form-control mb-3" rows="3" cols="1" placeholder="Enter your message..."></textarea>

				                    	<div class="d-flex align-items-center">
				                    		<div class="list-icons list-icons-extended">
				                                <a href="#" class="list-icons-item" data-popup="tooltip" title="Add photo" data-container="body"><i class="icon-images2"></i></a>
				                            	<a href="#" class="list-icons-item" data-popup="tooltip" title="Add video" data-container="body"><i class="icon-film2"></i></a>
				                                <a href="#" class="list-icons-item" data-popup="tooltip" title="Add event" data-container="body"><i class="icon-calendar2"></i></a>
				                    		</div>

				                    		<button type="button" class="btn bg-blue btn-labeled btn-labeled-right ml-auto"><b><i class="icon-paperplane"></i></b> Share</button>
				                    	</div>
									</form>
								</div>
							</div>
							<!-- /share your thoughts -->

						</div>
						<!-- /sidebar content -->

					</div>
					<!-- /right sidebar component -->

				</div>
				<!-- /inner container -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
    </script>
@stop