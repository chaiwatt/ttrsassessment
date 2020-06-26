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
									<select name="userrequest[]" id="userrequest" multiple="multiple" placeholder="ผู้ใช้งานระบบ"  class="form-control form-control-select2">
										@foreach ($users as $_user)
										<option value="{{$_user->id}}" > {{$_user->name}} {{$_user->lastname}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_user" class="btn bg-primary" data-dismiss="modal" data-id="{{$user->id}}" ><i class="icon-checkmark3 font-size-base mr-1"></i> ส่งคำร้อง</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal with subtitle -->
	<div id="modal_message" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="messagetitle"></h5>
				
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<p id="messagebody"></p>
				<div id="tablemessage"></div>
			</div>

			<div class="modal-footer">
				{{-- <button type="button" class="btn btn-link" data-dismiss="modal">Close</button> --}}
				<button type="button" id="btn_modal_message" data-dismiss="modal" class="btn bg-primary">เสร็จสิ้น</button>
			</div>
		</div>
	</div>
</div>
<!-- /modal with subtitle -->
	<!-- Cover area -->
	<div class="profile-cover">
		<div id="bgcover">
			@if (!Empty($user->cover))
				<div class="profile-cover-img" style="background-image: url({{asset($user->cover)}})"></div>
			@else
				<div class="profile-cover-img" style="background-image: url({{asset('assets/dashboard/images/cover.jpg')}})"></div>
			@endif
		</div>
		<div class="media align-items-center text-center text-md-left flex-column flex-md-row m-0">
			<div class="mr-md-3 mb-2 mb-md-0">
				<a href="#" class="profile-thumb">
					@if (!Empty($user->picture))
						<img src="{{asset($user->picture)}}" class="border-white rounded-circle" width="48" height="48" alt="">
					@else
						<img src="{{asset('assets/dashboard/images/user.jpg')}}" class="border-white rounded-circle" width="48" height="48" alt="">
					@endif
				</a>
			</div>
			<div class="media-body text-white">
				<h1 class="mb-0">{{$user->name}} {{$user->lastname}}</h1>
				<span class="d-block">{{$user->userposition->name}}</span>
			</div>
			<div class="ml-md-3 mt-2 mt-md-0">
				<ul class="list-inline list-inline-condensed mb-0">
					{{-- <li class="list-inline-item"><a href="#" class="btn btn-light border-transparent"><i class="icon-file-picture mr-2"></i> รูปหน้าปก</a></li> --}}
					{{-- <li class="list-inline-item"><a href="#" class="btn btn-light border-transparent"><i class="icon-file-stats mr-2"></i> Statistics</a></li> --}}
					<div class="form-group">
						<div class="input-group">													
							<button id="btnuploadcoverimg" class="btn btn-light border-transparent" type="button" onclick="document.getElementById('coverimg').click();"><i class="icon-file-picture mr-2"></i> รูปหน้าปก</button>													
						</div>
						<input type="file" style="display:none;" id="coverimg" name="coverimg"/>
					</div>
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
						<i class="icon-mail5 mr-2"></i>กล่องข้อความ @if ($unreadmessages->count()>0) <span class="badge badge-pill bg-success-400" id="newmessagecount1" >{{$unreadmessages->count()}}</span>@endif
					</a>
				</li>
				<li class="nav-item">
					<a href="#personalinfo" class="navbar-nav-link" data-toggle="tab"><i class="icon-user mr-2"></i>ข้อมูลส่วนตัว			
					</a>
				</li>
				@if (Auth::user()->user_type_id == 2)
					<li class="nav-item">
						<a href="#expertinfo" class="navbar-nav-link" data-toggle="tab"><i class="icon-medal-star mr-2"></i>ข้อมูลผู้เชี่ยวชาญ
						</a>
					</li>
				@endif
				@if (Auth::user()->user_type_id >= 4)
					<li class="nav-item">
						<a href="#organizationinfo" class="navbar-nav-link" data-toggle="tab"><i class="icon-cog3 mr-2"></i>ข้อมูลหน่วยงาน
						</a>
					</li>
				@endif	
				<li class="nav-item">
					<a href="#activitylog" class="navbar-nav-link" data-toggle="tab">
						<i class="icon-stack-text mr-2"></i>ข้อมูล Log
					</a>
				</li>
				<li class="nav-item">
					<a href="#friends" class="navbar-nav-link" data-toggle="tab">
						<i class="icon-users mr-2"></i>เพื่อน @if ($friendrequestcomings->count() > 0) <span class="badge bg-warning badge-pill ml-2" id="_friendrequestcomingcount">{{$friendrequestcomings->count()}}</span> @endif
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
		@if (Session::has('success'))
			<div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
				<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
				{{ Session::get('success') }}
			</div>
			@elseif( Session::has('error') )
			<div class="alert alert-warning alert-styled-left alert-dismissible">
				<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
				{{ Session::get('error') }}
			</div>
			@endif
			@if ($errors->count() > 0)
			<div class="alert alert-warning alert-styled-left alert-dismissible">
				<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
				{{ $errors->first() }}
			</div>
		@endif
		<!-- Inner container -->
		<form method="POST" action="{{route('setting.profile.editsave',['userid' => $user->id ])}}" enctype="multipart/form-data">
			@csrf
			<div class="d-flex align-items-start flex-column flex-md-row">
				<div class="tab-content w-100 order-2 order-md-1">
					<div class="tab-pane fade active show" id="messagebox">
						<div class="card">
							<div class="card-header bg-transparent header-elements-inline">
								<h6 class="card-title">กล่องข้อความ</h6>
								<div class="header-elements">
									@if ($messagereceives->count()>0)
									<span class="badge bg-teal" id="newmessagecount2">{{$unreadmessages->count()}} ข้อความใหม่</span>
									@endif
								</div>
							</div>

							<!-- Action toolbar -->
							<div class="bg-light">
								<div class="navbar navbar-light bg-light navbar-expand-lg ">
									<div class="text-center d-lg-none w-100">
										<button type="button" class="navbar-toggler w-100" data-toggle="collapse" data-target="#inbox-toolbar-toggle-single">
											<i class="icon-circle-down2"></i>
										</button>
									</div>
									<div class="navbar-collapse text-center text-lg-left flex-wrap collapse" id="inbox-toolbar-toggle-single">
										{{-- <div class="mt-3 mt-lg-0">
											<div class="btn-group ml-3 mr-lg-3">
												<button type="button" class="btn btn-light"><i class="icon-pencil7"></i> <span class="d-none d-lg-inline-block ml-2">ทำเครื่องหมายอ่านแล้ว</span></button>
												<button type="button" class="btn btn-light"><i class="icon-bin"></i> <span class="d-none d-lg-inline-block ml-2">ลบที่เลือก</span></button>
												
											</div>
										</div> --}}
										
									</div>
								</div>
							</div>
							<div class="table-responsive">
								<table class="table table-inbox">
									<tbody >										
										@foreach ($messagereceives as $messagereceive)
										@php
											$status = "";
											if($messagereceive->message_read_status_id==1){
												$status = "unread";
											}
										@endphp
											<tr class="{{$status}} messagelink" data-id="{{$messagereceive->id}}">
												<td class="table-inbox-checkbox ">
													{{-- <input type="checkbox" class="form-input-styled" data-fouc> --}}
													<a href="#">
														@if ($messagereceive->message_priority_id == 2 )
																<i class="icon-star-full2 text-warning-300"></i>
															@else
																<i class="icon-star-empty3 text-muted"></i>
														@endif
													</a>
												</td>
												<td class="table-inbox-image">
													<span class="btn bg-pink-400 rounded-circle btn-icon btn-sm">
														<span class="letter-icon">J</span>
													</span>
												</td>
												<td class="table-inbox-name">
													<a href="#" data-id="{{$messagereceive->id}} ">
														<div class="letter-icon-title text-default">{{$messagereceive->sender->name}} {{$messagereceive->sender->lastname}}</div>
													</a>
												</td>
												<td class="table-inbox-message">
													<span class="table-inbox-subject">{{$messagereceive->title}} &nbsp;-&nbsp;</span>
													<span class="text-muted font-weight-normal">{{ strip_tags($messagereceive->body)}}</span>
												</td>
												<td class="table-inbox-attachment">
													@if ($messagereceive->messageboxattachment->count() > 0)
														<i class="icon-attachment text-muted"></i>
													@endif
												</td>
												<td class="table-inbox-time">
													{{$messagereceive->timeago}}
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<div class="navbar-text ml-lg-auto" style="margin-right:10px"><span class="font-weight-semibold">{{$messagereceives->links()}}</span></div>
						</div>
					</div>

					<div class="tab-pane fade" id="personalinfo">
						<!-- personalinfo -->
						<div class="card">
							<div class="card-body">	
								@if ($user->user_alert_status_id == 1 && Empty($user->otp))
									<div class="alert alert-danger alert-styled-left alert-dismissible">
										<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
										<span class="font-weight-semibold">คุณยังไม่ได้ยืนยันเบอร์โทรศัพท์.
									</div>
								@endif		
								@if ($user->user_alert_status_id == 1 && Empty($user->linetoken))
									<div class="alert alert-danger alert-styled-left alert-dismissible">
										<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
										<span class="font-weight-semibold">คุณยังไม่ได้ Subscribe Line Notification.
									</div>
								@endif								
								<ul class="nav nav-tabs nav-tabs-highlight">
									<li class="nav-item"><a href="#left-icon-personal" class="nav-link active" data-toggle="tab"><i class="icon-stack-star mr-2"></i> ทั่วไป</a></li>
									<li class="nav-item"><a href="#left-icon-subscribe" class="nav-link" data-toggle="tab"><i class="icon-medal mr-2"></i> Subscribe</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="left-icon-personal">
																							
										<div class="form-group">
											<div class="row">
												<div class="col-md-6">
													<label>คำนำหน้า<span class="text-danger">*</span></label>
													<select name="prefix" data-placeholder="คำนำหน้า" class="form-control form-control-select2">
														@foreach ($prefixes as $prefix)
															<option value="{{$prefix->id}}" @if ($user->prefix_id == $prefix->id) selected @endif >{{$prefix->name}}</option> 
														@endforeach
													</select>
												</div>
												<div class="col-md-6">
													<label>ชื่อ</label>
													<input type="text" name="name" value="{{$user->name}}" data-placeholder="ชื่อ"class="form-control">
												</div>
											</div>
										</div>

										<div class="form-group">
											<div class="row">
												<div class="col-md-6">
													<label>นามสกุล</label>
													<input type="text" name="lastname" value="{{$user->lastname}}" data-placeholder="นามสกุล" class="form-control">
												</div>
												<div class="col-md-6">
													<label>เลขประจำตัวประชาชน</label></span>
													<input type="number" name="hid" id="hid" value="{{$user->hid}}" data-placeholder="เลขประจำตัวประชาชน" class="form-control">
													<small id="hidinvalid" class="form-text text-danger" hidden></small>
												</div>
											</div>
										</div>
										@if (Auth::user()->user_type_id <=2)
											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>ประเภท<span class="text-danger">*</span></label>
															<select name="usergroup" id= "usergroup" data-placeholder="ประเภท" class="form-control form-control-select2">
																@foreach ($usergroups as $usergroup)
																	<option value="{{$usergroup->id}}" @if($user->user_group_id == $usergroup->id) selected @endif >{{$usergroup->name}}</option> 
																@endforeach
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<label>หมายเลขผู้เสียภาษีนิติบุคคล</label> <span id="msg" class="text-success"></span>
														<input type="number" name="vatno" id="vatno" value="{{$user->companyvatid}}" data-placeholder="หมายเลขผู้เสียภาษีนิติบุคคล" class="form-control" @if ($user->user_group_id == 2) readonly @endif>
													</div>
												</div>
											</div>
										@endif
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
													<label>โทรศัพท์มือถือ
														@if (!Empty($user->otp))
																<span class="text-success"><i class="icon-checkmark3 text-success"></i> ยืนยันแล้ว</span>
															@else
																<span class="text-danger"><i class="icon-cross3 text-danger"></i> ยังไม่ได้ยืนยัน</span>
																<a id="getotp" href="#">คลิกเพื่อยืนยัน</a>
															@endif
													</label>
													<input type="text" name="phone" id="phone" value="{{$user->phone}}" data-placeholder="โทรศัพท์มือถือ" class="form-control">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-6">
													<label>อีเมล์</label>
													<input type="email" name="email" value="{{$user->email}}" data-placeholder="อีเมล์" class="form-control">
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
													<input type="text" name="address" value="{{$user->address}}" data-placeholder="ที่อยู่" class="form-control">
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
												<div class="col-md-6">
													<label>แจ้งเตือน subscribe sms, line<span class="text-danger">*</span></label>
													<select name="alert" data-placeholder="แจ้งเตือน" class="form-control form-control-select2">
														@foreach ($useralertstatuses as $useralertstatus)                                                                
															<option value="{{$useralertstatus->id}}" @if ($useralertstatus->id == $user->user_alert_status_id) selected @endif> {{$useralertstatus->name}} </option>
														@endforeach    
													</select>
												</div>
											</div>
										</div>
										<div class="text-right">
											<button type="submit" name="action" value="personal" class="btn bg-teal">บันทึกข้อมูลส่วนตัว <i class="icon-paperplane ml-2"></i></button>
										</div>
		
									</div>

									<div class="tab-pane fade" id="left-icon-subscribe">
										<label>Subscribe Line Notification
											@if (!Empty($user->linetoken))
													<span class="text-success"><i class="icon-checkmark3 text-success"></i> ยืนยัน subcribe แล้ว</span>
												@else
													<span class="text-danger"><i class="icon-cross3 text-danger"></i> ยังไม่ได้ subcribe</span>
												@endif
										</label>
										<div class="col-md-6">
											
											<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(240)->generate(url('').'/line/linesubscribe/'.Auth::user()->id)) !!} ">
										</div>
										<div class="col-md-6">
											<a href="{{route('line.subcribe',['id'=> Auth::user()->id])}}" >หรือคลิกลิงค์</a>
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
															@foreach ($expertexperiences as $expertexperience)
																<tr>
																	<td>{{$expertexperience->company}}</td>
																	<td>{{$expertexperience->position}}</td>		
																	<td>{{$expertexperience->fromyear}}</td>
																	<td>{{$expertexperience->toyear}}</td>
																	<td><a type="button" data-id="{{$expertexperience->id}}" class="btn btn-danger-400 btn-sm deleteexpertexpienceclass" id="deleteexpertexpienceclass_editview"><i class="icon-trash danger"></i></a></td>
																</tr>
															@endforeach                             
														</tbody>
													</table>
												</div>
											</div>      
										</div>
									</div>

									<div class="tab-pane fade" id="left-icon-experteducation">
										<div class="row">
											<div class="col-md-12">	
											<a href="" class="btn btn-info  btn-icon ml-2 btn-sm float-right" data-toggle="modal" data-target="#modal_experteducation" ><i class="icon-add"></i></a>
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
															@foreach ($experteducations as $experteducation)
																<tr>
																	<td>{{$experteducation->educationlevel->name}}</td>
																	<td>{{$experteducation->educationbranch->name}}</td>		
																	<td>{{$experteducation->institute}}</td>
																	<td><a type="button" data-id="{{$experteducation->id}}" class="btn btn-danger-400 btn-sm deleteexperteducationclass" id="deleteexperteducationclass_editview"><i class="icon-trash danger"></i></a></td>
																</tr>
															@endforeach                          
														</tbody>
													</table>
												</div>
											</div>      
										</div>
									</div>
								</div>
								<div class="text-right">
									<button type="submit" name="action" value="expert" class="btn bg-teal">บันทึกข้อมูลผู้เชี่ยวชาญ <i class="icon-paperplane ml-2"></i></button>
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
															<input type="text" name="organizationname" value="{{$generalinfo->company}}" data-placeholder="สำนักงาน"class="form-control">
														</div>
														<div class="col-md-6">
															<label>ที่อยู่</label>
															<input type="text" name="organizationaddress" value="{{$generalinfo->address}}" data-placeholder="คำนำหน้า" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>จังหวัด<span class="text-danger">*</span></label>
															<select name="organizationprovince" id="organizationprovince" data-placeholder="จังหวัด" class="form-control form-control-select2">
																<option value=""></option>
																@foreach ($provinces as $province)
																	<option value="{{$province->id}}" @if($generalinfo->province_id == $province->id) selected @endif>{{$province->name}}</option> 
																@endforeach
															</select>
														</div>
														<div class="col-md-6">
															<label>อำเภอ<span class="text-danger">*</span></label>
															<select name="organizationamphur" id="organizationamphur" data-placeholder="อำเภอ" class="form-control form-control-select2">
																@foreach ($amphurs as $amphur)                                                                
																	<option value="{{$amphur->id}}" @if ($amphur->id == $generalinfo->amphur_id) selected @endif> {{$amphur->name}} </option>
																@endforeach   
															</select>
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>ตำบล<span class="text-danger">*</span></label>
															<select name="organizationtambol" id="organizationtambol" data-placeholder="ตำบล" class="form-control form-control-select2">
																@foreach ($tambols as $tambol)                                                                
																	<option value="{{$tambol->id}}" @if ($tambol->id == $generalinfo->tambol_id) selected @endif> {{$tambol->name}} </option>
																@endforeach    
															</select>
														</div>
														<div class="col-md-6">
															<label>รหัสไปรษณีย์</label>
															<input type="text" name="organizationpostalcode" value="{{$generalinfo->postalcode}}" data-placeholder="รหัสไปรษณีย์" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>โทรศัพท์1</label>
															<input type="text" name="phone1" value="{{$generalinfo->phone1}}" data-placeholder="อีเมล์" class="form-control">
														</div>
														<div class="col-md-6">
															<label>โทรศัพท์2</label>
															<input type="text" name="phone2" value="{{$generalinfo->phone2}}" data-placeholder="โทรศัพท์2" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>แฟ๊กซ์</label>
															<input type="text" name="organizationfax" value="{{$generalinfo->fax}}" data-placeholder="แฟ๊กซ์" class="form-control">
														</div>
														<div class="col-md-6">
															<label>อีเมล์</label>
															<input type="email" name="organizationemail" value="{{$generalinfo->email}}" data-placeholder="อีเมล์" class="form-control">
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
															<input type="text" name="lineclint" value="{{$generalinfo->client_id}}" data-placeholder="lineclint" class="form-control">
														</div>
														<div class="col-md-6">
															<label>linesecret</label>
															<input type="text" name="linesecret" value="{{$generalinfo->client_secret}}" data-placeholder="linesecret" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>thaisms (sms คงเหลือ <span class="text-success">{{$smscredit}}</span> )</label>
															<input type="text" name="thaisms" value="{{$generalinfo->thsmsuser}}" data-placeholder="thaisms" class="form-control">
														</div>
														<div class="col-md-6">
															<label>รหัสผ่าน thaisms</label>
															<input type="password" name="thaismspassword" value="" data-placeholder="รหัสผ่าน thaisms" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>การ verify ผู้สมัคร<span class="text-danger">*</span></label>
															<select name="verifyuser" id="verifyuser" data-placeholder="อำเภอ" class="form-control form-control-select2">
																@foreach ($verifystatuses as $verifystatus)                                                                
																	<option value="{{$verifystatus->id}}" @if ($generalinfo->verify_type_id == $verifystatus->id) selected @endif> {{$verifystatus->name}} </option>
																@endforeach   
															</select>
														</div>
														<div class="col-md-6">
															<label>เวลาทำการ จันทร์-ศุกร์</label>
															<input type="text" name="workdaytime" value="{{$generalinfo->workdaytime}}" data-placeholder="เวลาทำการ จันทร์-ศุกร์" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>เวลาทำการ วันเสาร์</label>
															<input type="text" name="saturdaytime" value="{{$generalinfo->saturdaytime}}" data-placeholder="เวลาทำการ วันเสาร์" class="form-control">
														</div>
														<div class="col-md-6">
															<label>เวลาทำการ วันอาทิตย์</label>
															<input type="text" name="sundaytime" value="{{$generalinfo->sundaytime}}" data-placeholder="เวลาทำการ วันอาทิตย์" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>Youtube</label>
															<input type="text" name="youtube" value="{{$generalinfo->youtube}}" data-placeholder="Youtube" class="form-control">
														</div>
														<div class="col-md-6">
															<label>Facebook</label>
															<input type="text" name="facebook" value="{{$generalinfo->facebook}}" data-placeholder="Facebook" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>Front page<span class="text-danger">*</span></label>
															<select name="frontpage" data-placeholder="อำเภอ" class="form-control form-control-select2">
																@foreach ($frontpagestatuses as $frontpagestatus)                                                                
																	<option value="{{$frontpagestatus->id}}" @if ($generalinfo->front_page_status_id == $frontpagestatus->id) selected @endif> {{$frontpagestatus->name}} </option>
																@endforeach   
															</select>
														</div>
														<div class="col-md-6">
															<label>Social login</label>
															<select name="sociallogin" data-placeholder="Social login" class="form-control form-control-select2">
																@foreach ($socialloginstatuses as $socialloginstatus)                                                                
																	<option value="{{$socialloginstatus->id}}" @if ($generalinfo->social_login_status == $socialloginstatus->id) selected @endif> {{$socialloginstatus->name}} </option>
																@endforeach   
															</select>
														</div>
													</div>
													
												</div>
											</div>      
										</div>
									</div>
									<div class="text-right">
										<button type="submit" name="action" value="organization" class="btn bg-teal">บันทึกข้อมูลหน่วยงาน<i class="icon-paperplane ml-2"></i></button>
									</div>  
								</div>									
							</div>
						</div>
						<!-- /organizationinfo info -->

					</div>
					<div class="tab-pane fade" id="activitylog">

						<!-- Profile info -->
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-striped" id="testtopictable">
										<thead>
											<tr>
												<th>ชื่อ</th>
												{{-- <th >คำอธิบาย</th>                                --}}
												<th >ค่าเดิม</th> 
												<th >ค่าเปลี่ยนแปลง</th> 
												<th >วันที่</th> 
											</tr>
										</thead>
										<tbody>

											@foreach ($activitylogs as $activitylog)
											<tr>    
												<td> {{$activitylog->log_name}} </td>
												{{-- <td> {{$activitylog->description}} </td>        --}}
													@foreach ($activitylog->properties as $item)
														@foreach ($item as $key => $_item)
														<td>{{$key}}: {{$_item}}</td> 
														@endforeach
													@endforeach
												<td> {{$activitylog->created_at}} </td>
											</tr>
											@endforeach
										</tbody>
									</table>      
								</div>
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
									<li class="nav-item"><a href="#left-icon-friendrequestcomming" class="nav-link" data-toggle="tab"><i class="icon-new mr-2"></i> ขอเป็นเพื่อนฉัน @if ($friendrequestcomings->count() > 0) <span class="badge bg-warning badge-pill ml-2" id="friendrequestcomingcount">{{$friendrequestcomings->count()}}</span> @endif </a></li>
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
												<tbody id="friend_wrapper_tr"> 
													@foreach ($friends as $key => $friend)
														<tr>    
															<td> {{$key+1}} </td>
															<td> {{$friend->user->name}}  {{$friend->user->lastname}} </td>    
															<td> {{$friend->user->usertype->name}} </td> 
															<td> 
																<a type="button" data-id="{{$friend->id}}" class="badge bg-danger deletefriendclass" id="deletefriendclass_editview">ลบ</a> 
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
														<tbody id="requestfriend_wrapper_tr"> 
															@foreach ($friendrequests as $key => $friendrequest)
																<tr>    
																	<td> {{$key+1}} </td>
																	<td> {{$friendrequest->request->name}}   {{$friendrequest->request->lastname}} </td>    
																	<td> {{$friendrequest->request->usertype->name}} </td> 
																	<td> <span class="badge badge-flat border-warning text-warning">รอการตอบรับ</span></td> 
																	<td> 
																		<a type="button" data-id="{{$friendrequest->id}}" class="btn btn-danger-400 btn-sm deleterequestfriendclass" id="deleterequestfriendclass_editview"><i class="icon-trash danger"></i></a>
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
														<tbody id="comingrequestfriend_wrapper_tr"> 
															@foreach ($friendrequestcomings as $key => $friendrequestcoming)
																<tr>    
																	<td> {{$key+1}} </td>
																	<td> {{$friendrequestcoming->requestcoming->name}}   {{$friendrequestcoming->requestcoming->lastname}} </td>    
																	<td> {{$friendrequestcoming->requestcoming->usertype->name}} </td> 
																	<td> <span class="badge badge-flat border-info text-info">ยังไม่ได้ตอบรับ</span> </td> 
																	<td> 
																		<a type="button" data-id="{{$friendrequestcoming->id}}" class="badge bg-teal acceptfriendclass" id="acceptfriendclass_editview">ยืนยันตอบรับ</a>                                       
																		<a type="button" data-id="{{$friendrequestcoming->id}}" class="badge bg-danger rejectfriendclass" id="rejectfriendclass_editview">ไม่รับ</a>                                       
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
								<div class="form-group">
									<div class="form-group">
										<div class="form-group">
											<label>เพื่อน<span class="text-danger">*</span> <a href="" class="float-right" data-toggle="modal" data-target="#modal_user">&nbsp<i class="icon-add small" style="color:grey"></i></a></label>
											<select name="friends[]" multiple="multiple" placeholder="เพื่อน"  class="form-control form-control-select2">
												@foreach ($friends as $friend)
												<option value="{{$friend->friend_id}}" > {{$friend->user->name}} </option>
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
									<textarea name="messagetosend" class="form-control mb-3" rows="7" cols="1" placeholder="ข้อความ"></textarea>
								</div>
								<div id="input_attachment_wrapper"></div>
								<div class="form-group" id="attachment_wrapper">
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">													
												<button id="btnuploadattachment" class="btn bg-grey-300" type="button" onclick="document.getElementById('attachment').click();">ไฟล์แนบ</button>													
											</div>
											<input type="file" style="display:none;" id="attachment" name="attachment"/>
										</div>
									</div>
									<div class="col-md-6">
										<button type="submit" name="action" value="message" class="btn bg-blue btn-labeled btn-labeled-right ml-auto"><b><i class="icon-paperplane"></i></b> ส่งข้อความ</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
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
    </script>	
@stop

