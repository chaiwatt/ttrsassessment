@extends('layouts.dashboard.main', ['mini' => '1'])
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
	{{-- modal expertexpience --}}
	<div id="modal_expertexpience" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มรายการประสบการณ์</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>ตำแหน่ง</label><span class="text-danger">*</span>
								<input type="text"  id="expertexpienceposition" placeholder="ตำแหน่ง" class="form-control" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>หน่วยงาน/บริษัท</label><span class="text-danger">*</span>
								<input type="text" id="expertexpiencecompany" placeholder="หน่วยงาน/บริษัท" class="form-control" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>รายละเอียดของประสบการณ์</label>
								<textarea  id="expertexpiencedetail" rows="3"  placeholder="รายละเอียดของประสบการณ์" class="form-control"></textarea>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>ปีที่เริ่ม</label><span class="text-danger">*</span>
								<input type="number" maxlength="4" id="fromyear" placeholder="ปีที่เริ่ม" class="form-control" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>ปี่ที่สิ้นสุด</label><span class="text-danger">*</span>
								<input type="number" maxlength="4" id="toyear" placeholder="ปี่ที่สิ้นสุด" class="form-control" >
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_expertexpience" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่มรายการ</button>
				</div>
			</div>
		</div>
	</div>
	{{-- modal edit expertexpience --}}
	<div id="modal_edit_expertexpience" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มรายการประสบการณ์</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>ตำแหน่ง</label><span class="text-danger">*</span>
								<input type="text"  id="expertexpienceposition" placeholder="ตำแหน่ง" class="form-control" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>หน่วยงาน/บริษัท</label><span class="text-danger">*</span>
								<input type="text" id="expertexpiencecompany" placeholder="หน่วยงาน/บริษัท" class="form-control" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>รายละเอียดของประสบการณ์</label>
								<textarea  id="expertexpiencedetail" rows="3"  placeholder="รายละเอียดของประสบการณ์" class="form-control"></textarea>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>ปีที่เริ่ม</label><span class="text-danger">*</span>
								<input type="number" maxlength="4" id="fromyear" placeholder="ปีที่เริ่ม" class="form-control" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>ปี่ที่สิ้นสุด</label><span class="text-danger">*</span>
								<input type="number" maxlength="4" id="toyear" placeholder="ปี่ที่สิ้นสุด" class="form-control" >
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_edit_expertexpience" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่มรายการ</button>
				</div>
			</div>
		</div>
	</div>
	{{-- modal experteducation --}}
	<div id="modal_experteducation" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มรายการประวัติการศึกษา</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>ระดับการศึกษา</label><span class="text-danger">*</span>
								<select id="educationlevel" data-placeholder="สาขาวิชา/วิชาเอก" class="form-control form-control-select2">
									@foreach ($educationlevels as $educationlevel)
										<option value="{{$educationlevel->id}}" data-name="{{$educationlevel->name}}">{{$educationlevel->name}}</option> 
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>สาขาวิชา/วิชาเอก</label><span class="text-danger">*</span>
								<select id="educationbranch" data-placeholder="สาขาวิชา/วิชาเอก" class="form-control form-control-select2">
									@foreach ($educationbranches as $educationbranch)
										<option value="{{$educationbranch->id}}" data-name="{{$educationbranch->name}}">{{$educationbranch->name}}</option> 
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>สถาบันการศึกษา</label>
								<input type="text" id="institute" placeholder="หน่วยงาน/บริษัท" class="form-control" >
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>ประเทศ</label><span class="text-danger">*</span>
								<select id="country" data-placeholder="ประเทศ" class="form-control form-control-select2">
									@foreach ($countries as $country)
										<option value="{{$country->id}}" data-name="{{$country->name}}">{{$country->name}}</option> 
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>ปีพ.ศ.ที่จบการศึกษา</label><span class="text-danger">*</span>
								<input type="number" maxlength="4" id="graduatedyear" placeholder="ปีที่จบการศึกษา" class="form-control" >
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_experteducation" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่มรายการ</button>
				</div>
			</div>
		</div>
	</div>
 	{{-- modal edit experteducation --}}
	 <div id="modal_edit_experteducation" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มรายการประวัติการศึกษา</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>ระดับการศึกษา</label><span class="text-danger">*</span>
								<input type="text"  id="expertexpienceposition" placeholder="ตำแหน่ง" class="form-control" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>สาขาวิชา/วิชาเอก</label><span class="text-danger">*</span>
								<input type="text" id="expertexpiencecompany" placeholder="หน่วยงาน/บริษัท" class="form-control" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>สถาบันการศึกษา</label>
								<input type="text" id="expertexpiencecompany" placeholder="หน่วยงาน/บริษัท" class="form-control" >
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>ประเทศ</label><span class="text-danger">*</span>
								<input type="text"  id="fromyear" placeholder="ปีที่เริ่ม" class="form-control" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>ปีพ.ศ.ที่จบการศึกษา</label><span class="text-danger">*</span>
								<input type="text" maxlength="4" id="toyear" placeholder="ปี่ที่สิ้นสุด" class="form-control" >
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_edit_experteducation" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่มรายการ</button>
				</div>
			</div>
		</div>
	</div>

	{{-- modal user list --}}
	<div id="modal_user" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มขอเป็นเพื่อน</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="form-group">
									<label>ผู้ใช้งานระบบ<span class="text-danger">*</span></label>
									<select name="user[]" multiple="multiple" placeholder="ผู้ใช้งานระบบ"  class="form-control form-control-select2">
										@foreach ($users as $user)
										<option value="{{$user->id}}" > {{$user->name}} {{$user->lastname}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_user" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> ส่งคำร้อง</button>
				</div>
			</div>
		</div>
	</div>
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
					<li class="list-inline-item"><a href="#" class="btn btn-light border-transparent"><i class="icon-file-picture mr-2"></i> รูปหน้าปก</a></li>
					{{-- <li class="list-inline-item"><a href="#" class="btn btn-light border-transparent"><i class="icon-file-stats mr-2"></i> Statistics</a></li> --}}
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
					<a href="#messagebox" class="navbar-nav-link active" data-toggle="tab">
						<i class="icon-mail5 mr-2"></i>กล่องข้อความ @if ($messagereceives->count()>0) <span class="badge badge-pill bg-success-400 ">{{$messagereceives->count()}}</span>@endif
					</a>
				</li>
				<li class="nav-item">
					<a href="#personalinfo" class="navbar-nav-link" data-toggle="tab"><i class="icon-user mr-2"></i>ข้อมูลส่วนตัว			
					</a>
				</li>
				<li class="nav-item">
					<a href="#expertinfo" class="navbar-nav-link" data-toggle="tab"><i class="icon-medal-star mr-2"></i>ข้อมูลผู้เชี่ยวชาญ
					</a>
				</li>
				<li class="nav-item">
					<a href="#organizationinfo" class="navbar-nav-link" data-toggle="tab"><i class="icon-cog3 mr-2"></i>ข้อมูลหน่วยงาน
					</a>
				</li>
				<li class="nav-item">
					<a href="#activitylog" class="navbar-nav-link" data-toggle="tab">
						<i class="icon-stack-text mr-2"></i>ข้อมูล Log
					</a>
				</li>
				<li class="nav-item">
					<a href="#friends" class="navbar-nav-link" data-toggle="tab">
						<i class="icon-users mr-2"></i>เพื่อน @if ($friendrequestcomings->count() > 0) <span class="badge bg-warning badge-pill ml-2">{{$friendrequestcomings->count()}}</span> @endif
					</a>
				</li>
			</ul>

			<ul class="navbar-nav">
			
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
						<div class="tab-pane fade active show" id="messagebox">
							<!-- Sales stats -->
							{{-- <div class="card">
								<div class="card-header header-elements-sm-inline">
									<h6 class="card-title">Weekly statistics</h6>
									<div class="header-elements">
										<span><i class="icon-history mr-2 text-success"></i> Updated 3 hours ago</span>

										<div class="list-icons ml-3">
					                		<a class="list-icons-item" data-action="reload"></a>
					                	</div>
				                	</div>
								</div> --}}

								{{-- <div class="card-body"> --}}
									<!-- Single line -->
									<div class="card">
										<div class="card-header bg-transparent header-elements-inline">
											<h6 class="card-title">กล่องข้อความ</h6>

											<div class="header-elements">
												@if ($messagereceives->count()>0)
												<span class="badge bg-blue">{{$messagereceives->count()}} ข้อความใหม่</span>
												@endif
											</div>
										</div>

										<!-- Action toolbar -->
										<div class="bg-light">
											<div class="navbar navbar-light bg-light navbar-expand-lg py-lg-2">
												<div class="text-center d-lg-none w-100">
													<button type="button" class="navbar-toggler w-100" data-toggle="collapse" data-target="#inbox-toolbar-toggle-single">
														<i class="icon-circle-down2"></i>
													</button>
												</div>

												<div class="navbar-collapse text-center text-lg-left flex-wrap collapse" id="inbox-toolbar-toggle-single">
													<div class="mt-3 mt-lg-0">
														<div class="btn-group">
															<button type="button" class="btn btn-light btn-icon btn-checkbox-all">
																<input type="checkbox" class="form-input-styled" data-fouc>
															</button>

															<button type="button" class="btn btn-light btn-icon dropdown-toggle" data-toggle="dropdown"></button>
															<div class="dropdown-menu">
																<a href="#" class="dropdown-item">เลือกทั้งหมด</a>
																<a href="#" class="dropdown-item">อ่านอ่านแล้ว</a>
																<a href="#" class="dropdown-item">เลือกไม่ได้อ่าน</a>
																<div class="dropdown-divider"></div>
																<a href="#" class="dropdown-item">เคลียร์</a>
															</div>
														</div>

														<div class="btn-group ml-3 mr-lg-3">
															<button type="button" class="btn btn-light"><i class="icon-pencil7"></i> <span class="d-none d-lg-inline-block ml-2">ทำเครื่องหมายอ่านแล้ว</span></button>
															<button type="button" class="btn btn-light"><i class="icon-bin"></i> <span class="d-none d-lg-inline-block ml-2">ลบที่เลือก</span></button>
															
														</div>
													</div>

													<div class="navbar-text ml-lg-auto"><span class="font-weight-semibold">1-50</span> of <span class="font-weight-semibold">528</span></div>

													<div class="ml-lg-3 mb-3 mb-lg-0">
														<div class="btn-group">
															<button type="button" class="btn btn-light btn-icon disabled"><i class="icon-arrow-left12"></i></button>
															<button type="button" class="btn btn-light btn-icon"><i class="icon-arrow-right13"></i></button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- /action toolbar -->


										<!-- Table -->
										<div class="table-responsive">
											<table class="table table-inbox">
												<tbody data-link="row" class="rowlink">
													<tr class="unread">
														<td class="table-inbox-checkbox rowlink-skip">
															<input type="checkbox" class="form-input-styled" data-fouc>
														</td>
														<td class="table-inbox-star rowlink-skip">
															<a href="#">
																<i class="icon-star-empty3 text-muted"></i>
															</a>
														</td>
														<td class="table-inbox-name">
															<a href="mail_read.html">
																<div class="letter-icon-title text-default">James Alexander</div>
															</a>
														</td>
														<td class="table-inbox-message">
															<span class="table-inbox-subject"><span class="badge bg-success mr-2">Promo</span> There are three whales and three boats &nbsp;-&nbsp;</span>
															<span class="text-muted font-weight-normal">And one of the boats (presumed to contain the missing leg in all its original integrity) is being crunched by the jaws of the foremost whale</span>
														</td>
														<td class="table-inbox-attachment">
															<i class="icon-attachment text-muted"></i>
														</td>
														<td class="table-inbox-time">
															10:21 pm
														</td>
													</tr>

													<tr class="unread">
														<td class="table-inbox-checkbox rowlink-skip">
															<input type="checkbox" class="form-input-styled" data-fouc>
														</td>
														<td class="table-inbox-star rowlink-skip">
															<a href="#">
																<i class="icon-star-full2 text-warning-300"></i>
															</a>
														</td>
														<td class="table-inbox-name">
															<a href="mail_read.html">
																<div class="letter-icon-title text-default">Nathan Jacobson</div>
															</a>
														</td>
														<td class="table-inbox-message">
															<span class="table-inbox-subject">Any time these ten years, they tell me, has that man held up &nbsp;-&nbsp;</span>
															<span class="text-muted font-weight-normal">That picture, and exhibited that stump to an incredulous world. But the time of his justification has now come. His three whales are as good whales as were ever published in Wapping, at any rate; and his stump</span>
														</td>
														<td class="table-inbox-attachment"></td>
														<td class="table-inbox-time">
															8:37 pm
														</td>
													</tr>

													<tr>
														<td class="table-inbox-checkbox rowlink-skip">
															<input type="checkbox" class="form-input-styled" data-fouc>
														</td>
														<td class="table-inbox-star rowlink-skip">
															<a href="#">
																<i class="icon-star-full2 text-warning-300"></i>
															</a>
														</td>
														<td class="table-inbox-name">
															<a href="mail_read.html">
																<div class="letter-icon-title text-default">Margo Baker</div>
															</a>
														</td>
														<td class="table-inbox-message">
															<span class="table-inbox-subject">Throughout the Pacific, and also in Nantucket, and New Bedford &nbsp;-&nbsp;</span>
															<span class="text-muted font-weight-normal">and Sag Harbor, you will come across lively sketches of whales and whaling-scenes, graven by the fishermen themselves on Sperm Whale-teeth, or ladies' busks wrought out of the Right Whale-bone</span>
														</td>
														<td class="table-inbox-attachment"></td>
														<td class="table-inbox-time">
															4:28 am
														</td>
													</tr>

													<tr>
														<td class="table-inbox-checkbox rowlink-skip">
															<input type="checkbox" class="form-input-styled" data-fouc>
														</td>
														<td class="table-inbox-star rowlink-skip">
															<a href="#">
																<i class="icon-star-empty3 text-muted"></i>
															</a>
														</td>
														<td class="table-inbox-name">
															<a href="mail_read.html">
																<div class="letter-icon-title text-default">Dribbble</div>
															</a>
														</td>
														<td class="table-inbox-message">
															<span class="table-inbox-subject">The whalemen call the numerous little ingenious contrivances &nbsp;-&nbsp;</span>
															<span class="text-muted font-weight-normal">They elaborately carve out of the rough material, in their hours of ocean leisure. Some of them have little boxes of dentistical-looking implements</span>
														</td>
														<td class="table-inbox-attachment"></td>
														<td class="table-inbox-time">
															Dec 5
														</td>
													</tr>

												</tbody>
											</table>
										</div>
										<!-- /table -->

									</div>
									<!-- /single line -->
								{{-- </div> --}}
							{{-- </div> --}}
							<!-- /sales stats -->
					    </div>

					    <div class="tab-pane fade" id="personalinfo">
				    		<!-- personalinfo -->
							<div class="card">
								<div class="card-body">										
									<div class="form-group">
										<div class="row">
											<div class="col-md-2">
												<label>คำนำหน้า<span class="text-danger">*</span></label>
												<select name="prefix" data-placeholder="คำนำหน้า" class="form-control form-control-select2">
													@foreach ($prefixes as $prefix)
														<option value="{{$prefix->id}}" >{{$prefix->name}}</option> 
													@endforeach
												</select>
											</div>
											<div class="col-md-4">
												<label>ชื่อ</label>
												<input type="text" name="name" data-placeholder="ชื่อ"class="form-control">
											</div>
											<div class="col-md-6">
												<label>นามสกุล</label>
												<input type="text" name="lastname" data-placeholder="นามสกุล" class="form-control">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>ตำแหน่ง<span class="text-danger">*</span></label>
													<select name="userposition" data-placeholder="ตำแหน่ง" class="form-control form-control-select2">
														@foreach ($userpositions as $userposition)
															<option value="{{$userposition->id}}" >{{$userposition->name}}</option> 
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<label>โทรศัพท์มือถือ</label>
												<input type="text" name="phone" data-placeholder="โทรศัพท์มือถือ" class="form-control">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>อีเมล์</label>
												<input type="email" name="email" data-placeholder="อีเมล์" class="form-control">
											</div>
											<div class="col-md-6">
												<label>รหัสผ่าน</label>
												<input type="password" name="password" data-placeholder="รหัสผ่าน" class="form-control">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>ที่อยู่</label>
												<input type="text" name="address" data-placeholder="คำนำหน้า" class="form-control">
											</div>
											<div class="col-md-6">
												<label>จังหวัด<span class="text-danger">*</span></label>
												<select name="province" id="province" data-placeholder="จังหวัด" class="form-control form-control-select2">
													<option value=""></option>
													@foreach ($provinces as $province)
														<option value="{{$province->id}}" @if($user->province_id == $province->id) selected @endif>{{$province->name}}</option> 
													@endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>อำเภอ<span class="text-danger">*</span></label>
												<select name="amphur" id="amphur" data-placeholder="อำเภอ" class="form-control form-control-select2">
													@foreach ($amphurs as $amphur)                                                                
														<option value="{{$amphur->id}}" @if ($amphur->id == $user->amphur_id) selected @endif> {{$amphur->name}} </option>
													@endforeach   
												</select>
											</div>
											<div class="col-md-6">
												<label>ตำบล<span class="text-danger">*</span></label>
												<select name="tambol" id="tambol" data-placeholder="ตำบล" class="form-control form-control-select2">
													@foreach ($tambols as $tambol)                                                                
														<option value="{{$tambol->id}}" @if ($tambol->id == $user->tambol_id) selected @endif> {{$tambol->name}} </option>
													@endforeach    
												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>รูปถ่าย</label>
												<div class="input-group">													
													<input type="text" id="filename" class="form-control border-right-0" placeholder="รูปถ่าย" disabled>
													<span class="input-group-append">
														<button class="btn bg-info" type="button" onclick="document.getElementById('file').click();">อัพโหลดรูป</button>													
													</span>
												</div>
												<input type="file" style="display:none;" id="file" name="picture"/>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /personalinfo -->
				    	</div>
					    <div class="tab-pane fade" id="expertinfo">
							<!-- expertinfo -->
							<div class="card">
								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-highlight">
										<li class="nav-item"><a href="#left-icon-expertexpience" class="nav-link active" data-toggle="tab"><i class="icon-stack-star mr-2"></i> ประสบการณ์การทำงาน</a></li>
										<li class="nav-item"><a href="#left-icon-experteducation" class="nav-link" data-toggle="tab"><i class="icon-medal mr-2"></i> ประวัติการศึกษา</a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade show active" id="left-icon-expertexpience">
											<div class="row">
												<div class="col-md-12">	
												<a href="" class="btn btn-info  btn-icon ml-2 btn-sm float-right" data-toggle="modal" data-target="#modal_expertexpience"><i class="icon-add"></i></a>
												</div>
											</div>																								
											<div class="row">	
												<div class="col-md-12" id="expertexpience_wrapper" >	
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">	
													<div class="table-responsive">
														<table class="table table-striped">
															<thead>
																<tr>
																	<th>หน่วยงาน/บริษัท</th>
																	<th>ตำแหน่ง</th>
																	<th>ปีที่เริ่ม</th>      
																	<th>ปีที่สิ้นสุด</th>                                                                             
																	<th style="width:120px">เพิ่มเติม</th>
																</tr>
															</thead>
															<tbody id="expertexpience_wrapper_tr">                                
															</tbody>
														</table>
													</div>
												</div>      
											</div>
										</div>
	
										<div class="tab-pane fade" id="left-icon-experteducation">
											<div class="row">
												<div class="col-md-12">	
												<a href="" class="btn btn-info  btn-icon ml-2 btn-sm float-right" data-toggle="modal" data-target="#modal_experteducation"><i class="icon-add"></i></a>
												</div>
											</div>																								
											<div class="row">	
												<div class="col-md-12" id="experteducation_wrapper" >	
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">	
													<div class="table-responsive">
														<table class="table table-striped">
															<thead>
																<tr>
																	<th>ระดับการศึกษา</th>
																	<th>สาขาวิชา/วิชาเอก</th>
																	<th>สถาบัน</th>      
																	{{-- <th>ประเทศ</th>   
																	<th>ปีที่จบ</th>                                                                          --}}
																	<th style="width:120px">เพิ่มเติม</th>
																</tr>
															</thead>
															<tbody id="experteducation_wrapper_tr">                                
															</tbody>
														</table>
													</div>
												</div>      
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--/expertinfo -->
						</div>
						<div class="tab-pane fade" id="organizationinfo">
							<!-- organizationinfo info -->
							<div class="card">
								<div class="card-body">	
									<ul class="nav nav-tabs nav-tabs-highlight">
										<li class="nav-item"><a href="#left-icon-oganizationinfo" class="nav-link active" data-toggle="tab"><i class="icon-home2 mr-2"></i> ข้อมูลทั่วไป</a></li>
										<li class="nav-item"><a href="#left-icon-oganizationsetup" class="nav-link" data-toggle="tab"><i class="icon-gear mr-2"></i> ตั้งค่า</a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade show active" id="left-icon-oganizationinfo">
											<div class="row">
												<div class="col-md-12">	
													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label>สำนักงาน</label>
																<input type="text" name="organizationname" data-placeholder="ชื่อ"class="form-control">
															</div>
															<div class="col-md-6">
																<label>ที่อยู่</label>
																<input type="text" name="organizationaddress" data-placeholder="นามสกุล" class="form-control">
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label>อีเมล์</label>
																<input type="email" name="organizationemail" data-placeholder="อีเมล์" class="form-control">
															</div>
															<div class="col-md-6">
																<label>โทรศัพท์มือถือ</label>
																<input type="text" name="organizationphone" data-placeholder="โทรศัพท์มือถือ" class="form-control">
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label>ที่อยู่</label>
																<input type="text" name="organizationaddress" data-placeholder="คำนำหน้า" class="form-control">
															</div>
															<div class="col-md-6">
																<label>จังหวัด<span class="text-danger">*</span></label>
																<select name="organizationprovince" id="organizationprovince" data-placeholder="จังหวัด" class="form-control form-control-select2">
																	<option value=""></option>
																	@foreach ($provinces as $province)
																		<option value="{{$province->id}}" @if($user->province_id == $province->id) selected @endif>{{$province->name}}</option> 
																	@endforeach
																</select>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label>อำเภอ<span class="text-danger">*</span></label>
																<select name="organizationamphur" id="organizationamphur" data-placeholder="อำเภอ" class="form-control form-control-select2">
																	@foreach ($amphurs as $amphur)                                                                
																		<option value="{{$amphur->id}}" @if ($amphur->id == $user->amphur_id) selected @endif> {{$amphur->name}} </option>
																	@endforeach   
																</select>
															</div>
															<div class="col-md-6">
																<label>ตำบล<span class="text-danger">*</span></label>
																<select name="organizationtambol" id="organizationtambol" data-placeholder="ตำบล" class="form-control form-control-select2">
																	@foreach ($tambols as $tambol)                                                                
																		<option value="{{$tambol->id}}" @if ($tambol->id == $user->tambol_id) selected @endif> {{$tambol->name}} </option>
																	@endforeach    
																</select>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label>รหัสไปรษณีย์</label>
																<input type="text" name="organizationpostalcode" data-placeholder="รหัสไปรษณีย์" class="form-control">
															</div>
															<div class="col-md-6">
																<label>แฟกซ์</label>
																<input type="text" name="organizationfax" data-placeholder="แฟกซ์" class="form-control">
															</div>
														</div>
													</div>
												</div>      
											</div>
										</div>
	
										<div class="tab-pane fade" id="left-icon-oganizationsetup">																							
											<div class="row">
												<div class="col-md-12">	
													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label>lineclint <a href="https://notify-bot.line.me/en/" target="_blank">ลิงค์</a></label>
																<input type="text" name="lineclint" data-placeholder="lineclint" class="form-control">
															</div>
															<div class="col-md-6">
																<label>linesecret</label>
																<input type="text" name="linesecret" data-placeholder="linesecret" class="form-control">
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label>thaisms (sms คงเหลือ xx)</label>
																<input type="text" name="thaisms" data-placeholder="thaisms" class="form-control">
															</div>
															<div class="col-md-6">
																<label>รหัสผ่าน thaisms</label>
																<input type="password" name="thaismspassword" data-placeholder="รหัสผ่าน thaisms" class="form-control">
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-md-6">
																<label>การ verify ผู้สมัคร<span class="text-danger">*</span></label>
																<select name="organizationamphur" id="organizationamphur" data-placeholder="อำเภอ" class="form-control form-control-select2">
																	@foreach ($verifystatuses as $verifystatus)                                                                
																		<option value="{{$verifystatus->id}}" > {{$verifystatus->name}} </option>
																	@endforeach   
																</select>
															</div>
														</div>
													</div>
												</div>      
											</div>
										</div>
									</div>									
								</div>
							</div>
							<!-- /organizationinfo info -->

						</div>
						<div class="tab-pane fade" id="activitylog">

							<!-- Profile info -->
							<div class="card">
								<div class="card-header header-elements-inline">
									<h5 class="card-title">ข้อมูล Log</h5>
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

						<div class="tab-pane fade" id="friends">

							<!-- Profile info -->
							<div class="card">
								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-highlight">
										<li class="nav-item"><a href="#left-icon-friend" class="nav-link active" data-toggle="tab"><i class="icon-user-check mr-2"></i> เพื่อนของฉัน</a></li>
										<li class="nav-item"><a href="#left-icon-friendrequest" class="nav-link" data-toggle="tab"><i class="icon-paperplane mr-2"></i> คำขอของฉัน</a></li>
										<li class="nav-item"><a href="#left-icon-friendrequestcomming" class="nav-link" data-toggle="tab"><i class="icon-new mr-2"></i> ขอเป็นเพื่อนฉัน @if ($friendrequestcomings->count() > 0) <span class="badge bg-warning badge-pill ml-2">{{$friendrequestcomings->count()}}</span> @endif </a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade show active" id="left-icon-friend">
											<div class="table-responsive">
												<table class="table table-striped">
													<thead>
														<tr>
															<th>#</th>
															<th>ชื่อ-สกุล</th>    
															<th>ประเภท</th>                         
															<th style="width:150px">เพิ่มเติม</th>
														</tr>
													</thead>
													<tbody>
														@foreach ($friends as $key => $friend)
														<tr>    
															<td> {{$key+1}} </td>
															<td> {{$friend->user->name}}   {{$friend->user->lastname}} </td>    
															<td> {{$friend->user->usertype->name}} </td> 
															<td> 
																<a href="{{route('setting.admin.user.delete',['id' => $friend->id])}}" data-name="" onclick="confirmation(event)" class=" badge bg-danger">ลบ</a>                                       
															</td>
														</tr>
														@endforeach
													</tbody>
												</table>      
											</div>
										</div>
	
										<div class="tab-pane fade" id="left-icon-friendrequest">																							
											<div class="row">
												<div class="col-md-12">	
							
													<div class="table-responsive">
														<table class="table table-striped">
															<thead>
																<tr>
																	<th>#</th>
																	<th>ชื่อ-สกุล</th>    
																	<th>ประเภท</th>  
																	<th>สถานะ</th>                          
																	<th style="width:150px">เพิ่มเติม</th>
																</tr>
															</thead>
															<tbody>
																@foreach ($friendrequests as $key => $friendrequest)
																	<tr>    
																		<td> {{$key+1}} </td>
																		<td> {{$friendrequest->request->name}}   {{$friendrequest->request->lastname}} </td>    
																		<td> {{$friendrequest->request->usertype->name}} </td> 
																		<td> <span class="badge badge-flat border-warning text-warning">รอการตอบรับ</span></td> 
																		<td> 
																			<a href="{{route('setting.admin.user.delete',['id' => $friendrequest->id])}}" data-name="" onclick="confirmation(event)" class=" badge bg-danger">ลบ</a>                                       
																		</td>
																	</tr>
																@endforeach
															</tbody>
														</table>      
													</div>
					
												</div>      
											</div>
										</div>
										<div class="tab-pane fade" id="left-icon-friendrequestcomming">																							
											<div class="row">
												<div class="col-md-12">	
							
													<div class="table-responsive">
														<table class="table table-striped">
															<thead>
																<tr>
																	<th>#</th>
																	<th>ชื่อ-สกุล</th>    
																	<th>ประเภท</th>  
																	<th>สถานะ</th>                          
																	<th style="width:180px">เพิ่มเติม</th>
																</tr>
															</thead>
															<tbody>
																@foreach ($friendrequestcomings as $key => $friendrequestcoming)
																	<tr>    
																		<td> {{$key+1}} </td>
																		<td> {{$friendrequestcoming->Requestcoming->name}}   {{$friendrequest->requestcoming->lastname}} </td>    
																		<td> {{$friendrequestcoming->requestcoming->usertype->name}} </td> 
																		<td> <span class="badge badge-flat border-info text-info">ยังไม่ได้ตอบรับ</span> </td> 
																		<td> 
																			<a href="{{route('setting.admin.user.delete',['id' => $friendrequestcoming->id])}}" class=" badge bg-teal">ยืนยันตอบรับ</a>                                       
																			<a href="{{route('setting.admin.user.delete',['id' => $friendrequestcoming->id])}}" data-name="" onclick="confirmation(event)" class=" badge bg-danger">ไม่รับ</a>                                       
																		</td>
																	</tr>
																@endforeach
															</tbody>
														</table>      
													</div>
					
												</div>      
											</div>
										</div>
									</div>	

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
							<div class="card">
								<div class="card-header bg-transparent header-elements-inline">
									<span class="card-title font-weight-semibold">ส่งข้อความ</span>
									<div class="header-elements">
										<div class="list-icons">
					                		<a class="list-icons-item" data-action="collapse"></a>
				                		</div>
			                		</div>
								</div>

								<div class="card-body">
									<form action="#">
										<div class="form-group">
											{{-- <label>เพื่อน<span class="text-danger">*</span></label> --}}
											{{-- <input type="text" placeholder="เลือกเพื่อน" class="form-control"> --}}
											<div class="form-group">
												<div class="form-group">
													<label>เพื่อน<span class="text-danger">*</span> <a href="" class="float-right" data-toggle="modal" data-target="#modal_user">&nbsp<i class="icon-add small" style="color:grey"></i></a></label>
													<select name="criterialist[]" multiple="multiple" placeholder="เลือกเกณฑ์"  class="form-control form-control-select2">
														@foreach ($friends as $friend)
														<option value="{{$friend->id}}" > {{$friend->user->name}} </option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
									
										<div class="form-group">
											<label>เร่งด่วน<span class="text-danger">*</span></label>
											<select name="messagepriority" id="organizationamphur" data-placeholder="เร่งด่วน" class="form-control form-control-select2">
												@foreach ($messagepriorities as $messagepriority)                                                                
													<option value="{{$messagepriority->id}}" > {{$messagepriority->name}} </option>
												@endforeach   
											</select>
										</div>
										<div class="form-group">
											<textarea name="enter-message" class="form-control mb-3" rows="7" cols="1" placeholder="ข้อความ"></textarea>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<div class="input-group">													
														<button id="btnuploadattachment"  class="btn bg-grey-300" type="button" onclick="document.getElementById('attachment').click();">ไฟล์แนบ</button>													
													</div>
													<input type="file" style="display:none;" id="attachment" name="attachment[]" multiple/>
												</div>
											</div>
											<div class="col-md-6">
												<button type="button" class="btn bg-blue btn-labeled btn-labeled-right ml-auto"><b><i class="icon-paperplane"></i></b> ส่งข้อความ</button>
											</div>
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
<script type="module" src="{{asset('assets/dashboard/js/app/helper/locationhelper.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/profilehelper.js')}}"></script>
    <script>
		var route = {
			url: "{{ url('/') }}",
			token: $('meta[name="csrf-token"]').attr('content'),
		};
		$("#file").on('change', function() {
            $("#filename").val(this.value);
        });
		// $("#attachment").on('change', function() {
        //     $("#attachmentname").val(this.value);
        // });
		$("#attachment").on('change', function() {
			var files = $(this)[0].files;
			$("#btnuploadattachment").text(`ไฟล์แนบ (${files.length})`);
		});
    </script>	
@stop

