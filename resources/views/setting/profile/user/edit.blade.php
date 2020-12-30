@extends('layouts.dashboard.main')
@section('pageCss')

@stop

@section('content')
    <!-- Page header -->
	{{-- modal expertexpience --}}
	<div id="modal_expertexpience" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;รายการประสบการณ์</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>ตำแหน่ง</label><span class="text-danger">*</span>
								<input type="text"  id="expertexpienceposition" placeholder="ตำแหน่ง" class="form-control form-control-lg stringformat60" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>หน่วยงาน/บริษัท</label><span class="text-danger">*</span>
								<input type="text" id="expertexpiencecompany" placeholder="หน่วยงาน/บริษัท" class="form-control form-control-lg stringformat60" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>รายละเอียดของประสบการณ์</label>
								<textarea  id="expertexpiencedetail" rows="3"  placeholder="รายละเอียดของประสบการณ์" class="form-control form-control-lg"></textarea>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>ปีที่เริ่ม</label><span class="text-danger">*</span>
								<input type="text" id="fromyear" placeholder="ปีที่เริ่ม" class="form-control form-control-lg numeralformatyear" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>ปี่ที่สิ้นสุด</label><span class="text-danger">*</span>
								<input type="text" id="toyear" placeholder="ปี่ที่สิ้นสุด" class="form-control form-control-lg numeralformatyear" >
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
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;รายการประสบการณ์</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>ตำแหน่ง</label><span class="text-danger">*</span>
								<input type="text"  id="expertexpienceposition" placeholder="ตำแหน่ง" class="form-control form-control-lg stringformat60" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>หน่วยงาน/บริษัท</label><span class="text-danger">*</span>
								<input type="text" id="expertexpiencecompany" placeholder="หน่วยงาน/บริษัท" class="form-control form-control-lg stringformat60" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>รายละเอียดของประสบการณ์</label>
								<textarea  id="expertexpiencedetail" rows="3"  placeholder="รายละเอียดของประสบการณ์" class="form-control form-control-lg"></textarea>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>ปีที่เริ่ม</label><span class="text-danger">*</span>
								<input type="text" id="fromyear" placeholder="ปีที่เริ่ม" class="form-control form-control-lg numeralformatyear" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>ปี่ที่สิ้นสุด</label><span class="text-danger">*</span>
								<input type="text" id="toyear" placeholder="ปี่ที่สิ้นสุด" class="form-control form-control-lg numeralformatyear" >
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

	{{-- modal add position --}}
	<div id="modal_add_position" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ตำแหน่ง</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>ตำแหน่ง</label><span class="text-danger">*</span>
								<input type="text" id="modalposition" placeholder="ตำแหน่ง" class="form-control form-control-lg stringformat60" >
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_add_position" class="btn bg-primary" data-dismiss="modal" ><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
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
	<!-- Modal with subtitle -->


	<div id="modal_add_companydoc" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เอกสารแนบ</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ชื่อเอกสาร <small>เช่น หนังสือบริคณห์สนธิ (บอจ.2), สำเนาบัญชีรายชื่อผู้ถือหุ้น (บอจ.5), สำเนารับรองการจดทะเบียนพาณิชย์ หรืออื่น ๆ</small></label><span class="text-danger">*</span>
                                <input type="text" id="companydocname" placeholder="โปรดระบุชื่อเอกสาร" class="form-control form-control-lg stringformat60">
                            </div>
                        </div>
                        <div class="col-md-12">	
                            <div class="input-group">													
                                <button id="btnuploadcompanydoc" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('companydoc').click();" >อัปโหลด</button>													
                            </div>
                            <input type="file" style="display:none;" id="companydoc" data-id="{{$user->company->id}}" name="companydoc"/>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    {{-- <button id="btn_modal_add_companydoc" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- modal_add_authorized_director --}}
    <div id="modal_add_authorized_director" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ผู้มีอำนาจลงนาม</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>คำนำหน้าชื่อ<span class="text-danger">*</span></label>
                                <select id="directorprefix" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-lg form-control-select2">
                                    @foreach ($prefixes as $prefix)
                                        <option value="{{$prefix->id}}" >{{$prefix->name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>ชื่อ</label><span class="text-danger">*</span>
                                <input type="text" id="directorname" placeholder="ชื่อ" class="form-control form-control-lg stringformat60">
                            </div>

                            <div class="form-group">
                                <label>นามสกุล</label><span class="text-danger">*</span>
                                <input type="text" id="directorlastname" placeholder="นามสกุล" class="form-control form-control-lg stringformat60">
							</div>

							<div class="form-group">
                                <label>ตำแหน่ง</label><span class="text-danger">*</span>
								<select id="directorposition" data-placeholder="ตำแหน่ง" class="form-control form-control-lg form-control-select2">
									<option value=""></option>
									@foreach ($employpositions as $employposition)
										<option value="{{$employposition->id}}" >{{$employposition->name}}</option> 
									@endforeach
								</select>
							</div>
							
							<div class="form-group">
								<a href="" class="btn btn-sm bg-teal" data-toggle="modal" data-target="#modal_signature">ลายมือชื่อ</a>
								<div class="col-md-12">
									<div id='sigdiv'>
										{{-- @if (!Empty($user->signature))
										<br>
										<img src="{{asset($user->signature)}}" style="width: 180px;height:45px" alt="">
										@endif --}}
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_add_authorized_director" class="btn bg-primary" data-id="{{$user->company->id}}" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
                </div>
            </div>
        </div>
	</div>

	   {{-- modal_edit_authorized_director --}}
	   <div id="modal_edit_authorized_director" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ผู้มีอำนาจลงนาม</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
							<input type="text" id="authorized_director_id" hidden>
                            <div class="form-group">
                                <label>คำนำหน้าชื่อ<span class="text-danger">*</span></label>
                                <select id="directorprefix_edit" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-lg form-control-select2">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>ชื่อ</label><span class="text-danger">*</span>
                                <input type="text" id="directorname_edit" placeholder="ชื่อ" class="form-control form-control-lg stringformat60">
                            </div>

                            <div class="form-group">
                                <label>นามสกุล</label><span class="text-danger">*</span>
                                <input type="text" id="directorlastname_edit" placeholder="นามสกุล" class="form-control form-control-lg stringformat60">
							</div>

							<div class="form-group">
                                <label>ตำแหน่ง</label><span class="text-danger">*</span>
								<select id="directorposition_edit" data-placeholder="ตำแหน่ง" class="form-control form-control-lg form-control-select2">
								</select>
							</div>
							{{-- <input name="signatureid" id="signatureid" type="text" hidden> --}}
							<div class="form-group">
								<a href="" class="btn btn-sm bg-teal" data-toggle="modal" data-target="#modal_signature">ลายมือชื่อ</a>
								<div class="col-md-12 mt-2">
									<div id='sigdiv_edit'>
										
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_edit_authorized_director" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> แก้ไข</button>
                </div>
            </div>
        </div>
	</div>

	<div id="modal_signature" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="messagetitle">ลายมือชื่อ</h5>		
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div id="signature-pad" class="signature-pad" style="text-align: center">
										<canvas width="400" height="100" style="border: dashed 1px"></canvas>
										<div class="signature-pad--footer">
										<p>ลายมือชื่อ</p>
										  <div class="signature-pad--actions">
											<div>
											  <button type="button" class="btn bg-teal clear" onclick="document.getElementById('signature').click();">อัปโหลด</button>
											  <button type="button" class="btn bg-primary clear" data-action="clear">เคลียร์</button>
											  <button type="button" class="btn bg-primary" data-action="undo">ยกเลิก</button>
											  <button type="button" class="btn bg-success save" data-action="save-png">บันทึก</button>								
											</div>
											<input type="file" style="display:none;" id="signature" name="picture"/>
										  </div>
										</div>
									  </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				</div>
			</div>
		</div>
	</div>

	{{-- modal add_address --}}
	<div id="modal_add_address" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ที่อยู่</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>ประเภทที่อยู่</label><small> เช่น ที่อยู่สาขา, ที่อยู่โรงงาน</small><span class="text-danger">*</span>
								<input type="text"  id="addressname" placeholder="ชื่อประเภท เช่น ชื่อบริษัท, ชื่อสาขา, ชื่อโรงงาน" class="form-control form-control-lg stringformat60" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>ที่อยู่</label><span class="text-danger">*</span>
								<input type="text"  id="address" placeholder="ที่อยู่" class="form-control form-control-lg stringformat60" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>จังหวัด</label><span class="text-danger">*</span>
								<select id="provincemodal" data-placeholder="จังหวัด" class="form-control form-control-lg form-control-select2">
									<option value=""></option>
									@foreach ($provinces as $province)
										<option value="{{$province->id}}" >{{$province->name}}</option> 
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>อำเภอ</label><span class="text-danger">*</span>
								<select id="amphurmodal" data-placeholder="อำเภอ" class="form-control form-control-lg form-control-select2">
									@foreach ($amphurs as $amphur)                                                                
										<option value="{{$amphur->id}}"> {{$amphur->name}} </option>
									@endforeach   
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>ตำบล</label><span class="text-danger">*</span>
								<select id="tambolmodal" data-placeholder="ตำบล" class="form-control form-control-lg form-control-select2">
									@foreach ($tambols as $tambol)                                                                
										<option value="{{$tambol->id}}"> {{$tambol->name}} </option>
									@endforeach    
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>รหัสไปรษณีย์</label><span class="text-danger">*</span>
								<input type="number" id="postalcode" placeholder="รหัสไปรษณีย์" class="form-control form-control-lg numeralformatpostal" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>พิกัดละติจูด (เช่น 14.076868486942407)</label>
								<input type="text" id="lat" placeholder="ละติจูด" class="form-control form-control-lg" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>พิกัดลองจิจูด (เช่น 100.60153839991285)</label>
								<input type="text" id="lng" placeholder="ลองจิจูด" class="form-control form-control-lg" >
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_add_address" data-id="{{$user->company->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่มรายการ</button>
				</div>
			</div>
		</div>
	</div>
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
				<a href="#" id="avatar"  type="button" onclick="document.getElementById('avatarimg').click();" class="profile-thumb">
					@if (!Empty($user->picture))
						<img src="{{asset($user->picture)}}" class="border-white rounded-circle" width="48" height="48" alt="">
					@else
						<img src="{{asset('assets/dashboard/images/user.jpg')}}" class="border-white rounded-circle" width="48" height="48" alt="">
					@endif
				</a>
				<input type="file" style="display:none;" id="avatarimg" name="avatarimg"/>
			</div>
			<div class="media-body text-white">
				<h1 class="mb-0">{{$user->name}} {{$user->lastname}}</h1>
				{{-- <span class="d-block">{{$user->userposition->name}}</span> --}}
			</div>
			<div class="ml-md-3 mt-2 mt-md-0">
				<ul class="list-inline list-inline-condensed mb-0">
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
					<a href="#personalinfo" class="navbar-nav-link" data-toggle="tab"><i class="icon-user mr-2"></i>ข้อมูลส่วนตัว</a>
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
		<form method="POST" action="{{route('setting.profile.user.editsave',['userid' => $user->id ])}}" enctype="multipart/form-data">
			@csrf
			<input name="signatureid" id="signatureid" type="text" hidden>
			<input id="signature_type" value="1" type="text" hidden>
			<input name="usergroup" value="{{$user->user_group_id}}" type="text" hidden>
			<div class="d-flex align-items-start flex-column flex-md-row">
				<input name="usergroup" value="{{$user->user_group_id}}" type="text" hidden>
						<!-- personalinfo -->
						<div class="card">
							<div class="card-body">													
								<div class="row">
									@if (Auth::user()->user_group_id !=1)
										<div class="col-md-6">
											<div class="form-group">
												<label>คำนำหน้า<span class="text-danger">*</span></label>
												<select name="prefix" data-placeholder="คำนำหน้า" class="form-control form-control-lg form-control-select2">
													@foreach ($prefixes as $prefix)
														<option value="{{$prefix->id}}" @if ($user->prefix_id == $prefix->id) selected @endif >{{$prefix->name}}</option> 
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>ชื่อ<span class="text-danger">*</span></label>
												<input type="text" name="name" value="{{$user->name}}" data-placeholder="ชื่อ"class="form-control form-control-lg stringformat60">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>นามสกุล<span class="text-danger">*</span></label>
												<input type="text" name="lastname" value="{{$user->lastname}}" data-placeholder="นามสกุล" class="form-control form-control-lg stringformat60">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>เลขบัตรประจำตัวประชาชน</label><span class="text-danger">*</span></span>
												<input type="text" name="hid" id="hid" value="{{$user->hid}}" data-placeholder="เลขบัตรประจำตัวประชาชน" class="form-control form-control-lg numeralformath13">
												<small id="hidinvalid" class="form-text text-danger" hidden></small>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>ตำแหน่ง</label>
												<input type="text" name="userposition" value="{{$user->position}}" data-placeholder="ตำแหน่ง" class="form-control form-control-lg stringformat60">
												{{-- <select name="userposition" id="userposition" data-placeholder="ตำแหน่ง" class="form-control form-control-lg form-control-select2">
													@foreach ($userpositions as $userposition)
														<option value="{{$userposition->id}}"
															@if ($userposition->id == $user->user_position_id) selected @endif >{{$userposition->name}}</option> 
													@endforeach
												</select> --}}
											</div>
										</div>
									@endif
									<div class="col-md-6">
										<div class="form-group">
											<label>@if (Auth::user()->user_group_id == 1) ชื่อนิติบุคคล<span class="text-danger">*</span> @else ชื่อสถานประกอบการ @endif</label></span>
											<input type="text" name="company" value="{{$user->company->name}}"  class="form-control form-control-lg stringformat60">
										</div>
									</div>

									@if (Auth::user()->user_type_id <=2)
										<div class="col-md-6">
											<div class="form-group">
												<label>@if (Auth::user()->user_group_id == 1) เลขทะเบียนนิติบุคคล <span class="text-danger">*</span> @else เลขประจำตัวผู้เสียภาษีอากร @endif</label></span><label></label> <span id="msg" class="text-success"></span>
												<input type="text" name="vatno" id="vatno" value="{{old('vatno') ?? $user->companyvatid}}" data-placeholder="หมายเลขผู้เสียภาษีนิติบุคคล" class="form-control form-control-lg numeralformath13" @if ($user->user_group_id == 2) @endif>
											</div>
										</div>
									@endif

									@if ($user->user_group_id == 2)
										<div class="col-md-6">
											<div class="form-group">
												<label>เลขทะเบียนพาณิชย์</label>
												<input type="text"  name="commercialregnumber" value="{{old('commercialregnumber') ?? $user->company->commercialregnumber}}"  placeholder="เลขทะเบียนพาณิชย์" class="form-control form-control-lg numeralformath13" >
											</div>
										</div>
									@endif
									<div class="col-md-6">
										<div class="form-group">
											<label>ปีที่จดทะเบียน@if ($user->user_group_id == 1)<span class="text-danger">*</span> @endif</label>
											<input type="text" name="registeredyear" value="{{old('registeredyear') ?? $user->company->registeredyear}}"  placeholder="ปีที่จดทะเบียน" class="form-control form-control-lg numeralformatyear">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>ทุนจดทะเบียน@if ($user->user_group_id == 1)<span class="text-danger">*</span> @endif</label>
											<input type="text" min="0" name="registeredcapital" value="{{old('registeredcapital') ?? $user->company->registeredcapital}}"  placeholder="ทุนจดทะเบียน" class="form-control form-control-lg numeralformat10" >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>ทุนจดทะเบียนที่เรียกชำระแล้ว@if ($user->user_group_id == 1)<span class="text-danger">*</span> @endif</label>
											<input type="text" min="0" name="paidupcapital" value="{{old('paidupcapital') ?? $user->company->paidupcapital}}"  placeholder="ทุนจดทะเบียนที่เรียกชำระแล้ว" class="form-control form-control-lg numeralformat10" >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>วันที่ชำระทุนจดทะเบียน</label>
											<input type="text"  name="paidupcapitaldate" id="paidupcapitaldate" value="{{old('paidupcapitaldate') ?? $user->company->paidupcapitaldateth}}"  placeholder="เมื่อวันที่" class="form-control form-control-lg" >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>หมวดหมู่หลัก ISIC</label>
											<select name="isic" id="isic" data-placeholder="หมวดหมู่หลัก ISIC" class="form-control form-control-lg form-control-select2">
												@foreach ($isics as $isic)
													<option value="{{$isic->id}}" @if($user->company->isic_id == $isic->id) selected @endif>{{$isic->name}}</option> 
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">                                          
										<div class="form-group">
											<label>หมวดหมู่ย่อย ISIC</label>
											<select name="subisic" id="subisic" data-placeholder="หมวดหมู่ย่อย ISIC" class="form-control form-control-lg form-control-select2">
												@foreach ($isicsubs as $isicsub)
													<option value="{{$isicsub->id}}" @if($user->company->isic_sub_id == $isicsub->id) selected @endif>{{$isicsub->name}}</option> 
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>กลุ่มอุตสาหกรรม<span class="text-danger">*</span></label>
											<select name="industrygroup" data-placeholder="กลุ่มอุตสาหกรรม" class="form-control form-control-lg form-control-select2">
												@foreach ($industrygroups as $industrygroup)
													<option value="{{$industrygroup->id}}" @if($user->company->industry_group_id == $industrygroup->id) selected @endif>{{$industrygroup->name}}</option> 
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6"> 
										<div class="form-group">
											<label>โทรศัพท์<span class="text-danger">*</span></label>
											@php
												$phone = $user->company->phone;
												if(Empty($user->company->phone)){
													$phone = Auth::user()->phone;
												}
											@endphp
											<input type="text"  name="phone" value="{{$phone}}"  placeholder="โทรศัพท์" class="form-control form-control-lg numeralformathphone">
										</div>
									</div>
									<div class="col-md-6">   
										<div class="form-group">
											<label>โทรสาร</label>
											<input type="text"  name="fax" value="{{$user->company->fax}}"  placeholder="โทรสาร" class="form-control form-control-lg numeralformathphone">
										</div>
									</div>
									<div class="col-md-6">  
										<div class="form-group">
											<label>อีเมล<span class="text-danger">*</span></label>
											@php
												$email = $user->company->email;
												if(Empty($user->company->email)){
													$email = Auth::user()->email;
												}
											@endphp
											<input type="text"  name="email" value="{{$email}}"  placeholder="อีเมล" class="form-control form-control-lg stringformat60">
										</div>
									</div>
									<div class="col-md-6">  
										<div class="form-group">
											<label>เว็ปไซต์</label>
											<input type="text"  name="website" value="{{$user->company->website}}"  placeholder="เว็บไซต์" class="form-control form-control-lg stringformat60">
										</div>
									</div>
									@if ($user->user_group_id == 1)
									<div class="col-md-12">  
										<legend>
											<label><strong>ผู้ประสานงาน</strong></label>
										</legend>
									</div>
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label>คำนำหน้า<span class="text-danger">*</span></label>
														<select name="prefix" data-placeholder="คำนำหน้า" class="form-control form-control-lg form-control-select2">
															@foreach ($prefixes as $prefix)
																<option value="{{$prefix->id}}" @if ($user->prefix_id == $prefix->id) selected @endif >{{$prefix->name}}</option> 
															@endforeach
														</select>
													</div>
												</div>
												<div class="col-md-9">
													<div class="form-group">
														<label>ชื่อผู้ประสานงาน<span class="text-danger">*</span></label>
														<input type="text" name="name" value="{{$user->name}}" data-placeholder="ชื่อ"class="form-control form-control-lg stringformat60">
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>นามสกุลผู้ประสานงาน<span class="text-danger">*</span></label>
												<input type="text" name="lastname" value="{{$user->lastname}}" data-placeholder="นามสกุล" class="form-control form-control-lg stringformat60">
											</div>
										</div>
									@endif
									<div class="col-md-12">  
										<legend>
											<label for=""><strong>ที่อยู่</strong> <a href="#" class="text-primary" data-toggle="modal" data-target="#modal_add_address">คลิกเพิ่มที่อยู่อื่น ๆ</a></label>
										</legend>
									</div>


									@php
										$companyaddress = $user->company->companyaddress->first();
									@endphp
										<div class="col-md-6">  
											<div class="form-group">
												<label>@if ($user->user_group_id == 1) ที่อยู่บริษัท @else ที่ตั้งสถานประกอบการ @endif</label><span class="text-danger">*</span>
												<input type="text"  name="address" value="{{old('address') ?? $companyaddress->address}}"  placeholder="" class="form-control form-control-lg stringformat60">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>จังหวัด<span class="text-danger">*</span></label>
												<select name="province" id="province" data-placeholder="จังหวัด" class="form-control form-control-lg form-control-select2">
													<option value=""></option>
													@foreach ($provinces as $province)
														<option value="{{$province->id}}" @if($companyaddress->province_id == $province->id) selected @endif>{{$province->name}}</option> 
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>อำเภอ<span class="text-danger">*</span></label>
												<select name="amphur" id="amphur" data-placeholder="อำเภอ" class="form-control form-control-lg form-control-select2">
													@foreach ($amphurs as $amphur)                                                                
														<option value="{{$amphur->id}}" @if ($companyaddress->amphur_id == $amphur->id) selected @endif> {{$amphur->name}} </option>
													@endforeach   
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>ตำบล<span class="text-danger">*</span></label>
												<select name="tambol" id="tambol" data-placeholder="ตำบล" class="form-control form-control-lg form-control-select2">
													@foreach ($tambols as $tambol)                                                                
														<option value="{{$tambol->id}}" @if ($companyaddress->tambol_id == $tambol->id) selected @endif> {{$tambol->name}} </option>
													@endforeach    
												</select>
											</div>
										</div>
										<div class="col-md-6">  
											<div class="form-group">
												<label>รหัสไปรษณีย์<span class="text-danger">*</span></label>
												<input type="text"  name="postalcode" value="{{$companyaddress->postalcode}}"  placeholder="รหัสไปรษณีย์" class="form-control form-control-lg numeralformatpostal">
											</div>
										</div>
										<div class="col-md-6">  
											<div class="form-group">
												<label>พิกัดละติจูด (เช่น 14.076868486942407)<a href="https://google.com/maps/place/{{$companyaddress->lat}},{{$companyaddress->lng}}" target="_blank" rel="noopener noreferrer"> เปิดแผนที่</a> </label>
												<input type="text"  name="lat" value="{{$companyaddress->lat}}"  placeholder="ละติจูด" class="form-control form-control-lg decimalformat">
											</div>
										</div>
										<div class="col-md-6">  
											<div class="form-group">
												<label>พิกัดลองจิจูด (เช่น 100.60153839991285)</label>
												<input type="text"  name="lng" value="{{$companyaddress->lng}}"  placeholder="ลองจิจูด" class="form-control form-control-lg decimalformat">
											</div>
										</div>
										<div class="col-md-12" id="other_address_wrapper" @if ($user->company->companyaddress->count() == 1) hidden @endif>
											<div class="form-group">
												<hr>
												<label for="">ที่อยู่อื่น ๆ</label>
												<div class="table-responsive">
													<table class="table table-bordered table-striped">
														<thead>
															<tr class="bg-info">
																<th >ประเภท</th> 
																<th >ที่อยู่</th> 
																<th >ตำบล</th> 
																<th >อำเภอ</th> 
																<th >จังหวัด</th> 
																<th >รหัสไปรษณีย์</th> 
																<th >เพิ่มเติม</th>                                                                                   
															</tr>
														</thead>
														<tbody id="authorized_address_wrapper_tr"> 
															@foreach ($user->company->companyaddress as $key => $companyaddress)
																@if ($key != 0)
																	<tr >                                        
																		<td> {{$companyaddress->addresstype}}</td>                                            
																		<td> {{$companyaddress->address}}</td>   
																		<td> {{$companyaddress->tambol->name}}</td>   
																		<td> {{$companyaddress->amphur->name}}</td>   
																		<td> {{$companyaddress->province->name}}</td>   
																		<td> {{$companyaddress->postalcode}}</td>   
																		<td> 
																			<a type="button" data-id="{{$companyaddress->id}}" class="btn btn-sm bg-danger deleteaddress">ลบ</a>
																		</td>   
																	</tr>	
																@endif
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
										</div>
									<hr>
									<div class="col-md-12">
										<div class="form-group">
											{{-- <div class="col-md-12" > --}}
												<input type="text" name="authorizeddirector" id="authorizeddirector" value="{{$authorizeddirectors->count()}}" hidden >
												<label for="">รายชื่อกรรมการ/ผู้มีอำนาจลงนาม<span class="text-danger">*</span></label>
												<a href="#" type="button" id="btn_add_authorized_director" data-toggle="modal" class="text-primary" >คลิกเพิ่ม</a>
												<div class="table-responsive">
													<table class="table table-bordered table-striped">
														<thead>
															<tr class="bg-info">
																<th style="width:55%">ชื่อ  นามสกุล</th> 
																<th style="width:15%">ตำแหน่ง</th>   
																<th style="width:15%">ลายมือชื่อ</th>
																<th style="width:15%">เพิ่มเติม</th>                                                                                   
															</tr>
														</thead>
														<tbody id="authorized_director_wrapper_tr"> 
															@foreach ($authorizeddirectors->reverse() as $authorizeddirector)
															<tr >                                        
																<td> {{$authorizeddirector->prefix->name}}{{$authorizeddirector->name}} {{$authorizeddirector->lastname}}</td>                                            
																<td> {{$authorizeddirector->employposition->name}}</td> 
																<td>
																	@if (Empty($authorizeddirector->signature_id))
																			<span class="badge badge-flat border-warning text-warning">ไม่พบลายมือชื่อ</span>
																		@else
																			<span class="badge badge-flat border-success text-success">มีลายมือชื่อแล้ว</span>
																	@endif  
																</td>   
																<td> 
																	<a type="button" data-id="{{$authorizeddirector->id}}" class="btn btn-sm bg-info editauthorizeddirector">แก้ไข</a>                                       
																	<a type="button" data-id="{{$authorizeddirector->id}}" class="btn btn-sm bg-danger deleteauthorizeddirector">ลบ</a>                                       
																</td>
															</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
										{{-- </div> --}}
									</div>

									<div class="col-md-12">
										<div class="form-group">
											{{-- <div class="col-md-12" > --}}
												<label for="">แนบเอกสาร </label>
											<a href="#"  id="btnuploadcompanydoc"  class="text-primary" data-toggle="modal" data-target="#modal_add_companydoc">อัปโหลดเอกสารแนบ</a> 
											<p><small>(หนังสือบริคณห์สนธิ (บอจ.2), สำเนาบัญชีรายชื่อผู้ถือหุ้น (บอจ.5), สำเนารับรองการจดทะเบียนพาณิชย์ หรืออื่น ๆ)</small></p>
											
												<div class="table-responsive">
													<table class="table table-bordered table-striped">
														<thead>
															<tr class="bg-info">
																<th style="width:80%">ไฟล์</th> 
																<th style="width:20%">เพิ่มเติม</th>                                                                                   
															</tr>
														</thead>
														<tbody id="fulltbp_companydoc_wrapper_tr"> 
															@foreach ($fulltbpcompanydocs as $fulltbpcompanydoc)
															<tr >                                        
																<td> {{$fulltbpcompanydoc->name}}</td>                                            
																<td> 
																	<a href="{{asset($fulltbpcompanydoc->path)}}" class="btn btn-sm bg-primary">ดาวน์โหลด</a>
																	<a type="button" data-id="{{$fulltbpcompanydoc->id}}" data-name="" class="btn btn-sm bg-danger deletefulltbpcompanydocattachment">ลบ</a>                                       
																</td>
															</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
										{{-- </div> --}}
									</div>
									<div class="col-md-6">  
										{{-- <div class="form-group">
											<label>โลโก้ (ขนาด 500x500) px</label>
											<div class="input-group">													
												<input type="text" id="filename" class="form-control form-control-lg border-right-0" placeholder="โลโก้"  >											
													<span class="input-group-append">
														<button class="btn bg-info" type="button" onclick="document.getElementById('file').click();">อัปโหลดรูป</button>
													</span>
											</div>
											<input type="file" style="display:none;" id="file" name="picture"/>
											@if (!Empty($user->company->logo))
											<br>
												<img src="{{asset($user->company->logo)}}" width="300" height="300" alt="">
											@endif
										</div> --}}
										{{-- <div class="form-group">
											<a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_signature">ลายมือชื่อ</a>
											<div class="col-md-12">
												<div id='sigdiv'>
													@if (!Empty($user->signature))
													<br>
													<img src="{{asset($user->signature)}}" style="width: 180px;height:45px" alt="">
													@endif
												</div>
											</div>
										</div> --}}
									</div>
									
									<div class="col-md-12 text-right">
										<button type="submit" name="action" value="personal" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
									</div>
							</div>
						</div>
		
			
				
{{-- 
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

					</div> --}}
				</div>
				<!-- /left content -->


				<!-- Right sidebar component -->
				{{-- <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right wmin-300 border-0 shadow-0 order-1 order-lg-2 sidebar-expand-md">

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
											<select name="friends[]" multiple="multiple" placeholder="เพื่อน"  class="form-control form-control-lg form-control-select2">
												@foreach ($friends as $friend)
												<option value="{{$friend->friend_id}}" > {{$friend->user->name}} </option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							
								<div class="form-group">
									<label>เร่งด่วน<span class="text-danger">*</span></label>
									<select name="messagepriority" id="organizationamphur" data-placeholder="เร่งด่วน" class="form-control form-control-lg form-control-select2">
										@foreach ($messagepriorities as $messagepriority)                                                                
											<option value="{{$messagepriority->id}}" > {{$messagepriority->name}} </option>
										@endforeach   
									</select>
								</div>
								<div class="form-group">
									<textarea name="messagetosend" class="form-control form-control-lg mb-3" rows="7" cols="1" placeholder="ข้อความ"></textarea>
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
				</div> --}}
			</div>
		</form>

    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script type="module" src="{{asset('assets/dashboard/js/app/helper/locationhelper.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/profilehelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/signaturepad/signature_pad.umd.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/signaturepad/signaturecontrol.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/inputformat.js')}}"></script>
    <script>
    	var route = {
			url: "{{ url('/') }}",
			token: $('meta[name="csrf-token"]').attr('content'),
        };
        $("#file").on('change', function() {
            $("#filename").val(this.value);
        });
        $('#paidupcapitaldate').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            clearButton: true,
            cancelText: "ยกเลิก",
            okText: "ตกลง",
            clearText: "เคลียร์",
            time: false
		});
    </script>	
@stop

