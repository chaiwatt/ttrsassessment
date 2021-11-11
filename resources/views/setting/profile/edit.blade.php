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
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มรายการประสบการณ์</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>ตำแหน่ง</label><span class="text-danger">*</span>
								<input type="text"  id="expertexpienceposition" placeholder="ตำแหน่ง" class="form-control form-control-lg" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>หน่วยงาน/บริษัท</label><span class="text-danger">*</span>
								<input type="text" id="expertexpiencecompany" placeholder="หน่วยงาน/บริษัท" class="form-control form-control-lg" >
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
								<input type="number" maxlength="4" id="fromyear" placeholder="ปีที่เริ่ม" class="form-control form-control-lg" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>ปี่ที่สิ้นสุด</label><span class="text-danger">*</span>
								<input type="number" maxlength="4" id="toyear" placeholder="ปี่ที่สิ้นสุด" class="form-control form-control-lg" >
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
								<input type="text"  id="expertexpienceposition" placeholder="ตำแหน่ง" class="form-control form-control-lg" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>หน่วยงาน/บริษัท</label><span class="text-danger">*</span>
								<input type="text" id="expertexpiencecompany" placeholder="หน่วยงาน/บริษัท" class="form-control form-control-lg" >
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
								<input type="number" maxlength="4" id="fromyear" placeholder="ปีที่เริ่ม" class="form-control form-control-lg" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>ปี่ที่สิ้นสุด</label><span class="text-danger">*</span>
								<input type="number" maxlength="4" id="toyear" placeholder="ปี่ที่สิ้นสุด" class="form-control form-control-lg" >
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
								<input type="text" id="institute" placeholder="หน่วยงาน/บริษัท" class="form-control form-control-lg" >
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
								<input type="number" maxlength="4" id="graduatedyear" placeholder="ปีที่จบการศึกษา" class="form-control form-control-lg" >
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
								<input type="text"  id="expertexpienceposition" placeholder="ตำแหน่ง" class="form-control form-control-lg" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>สาขาวิชา/วิชาเอก</label><span class="text-danger">*</span>
								<input type="text" id="expertexpiencecompany" placeholder="หน่วยงาน/บริษัท" class="form-control form-control-lg" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>สถาบันการศึกษา</label>
								<input type="text" id="expertexpiencecompany" placeholder="หน่วยงาน/บริษัท" class="form-control form-control-lg" >
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>ประเทศ</label><span class="text-danger">*</span>
								<input type="text"  id="fromyear" placeholder="ปีที่เริ่ม" class="form-control form-control-lg" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>ปีพ.ศ.ที่จบการศึกษา</label><span class="text-danger">*</span>
								<input type="text" maxlength="4" id="toyear" placeholder="ปี่ที่สิ้นสุด" class="form-control form-control-lg" >
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

	{{-- modal add position --}}
	<div id="modal_add_position" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มตำแหน่ง</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>ตำแหน่ง</label><span class="text-danger">*</span>
								<input type="text" id="modalposition" placeholder="ตำแหน่ง" class="form-control form-control-lg" >
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
	<div id="modal_message" class="modal fade" >
		<div class="modal-dialog modal-lg">
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
					<button type="button" id="btn_modal_message" data-dismiss="modal" class="btn bg-primary">ปิด</button>
				</div>
			</div>
		</div>
	</div>
<!-- /modal with subtitle -->
	<!-- Modal with subtitle -->
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
										  {{-- <div class="description" ></div> --}}
									<p>ลายมือชื่อ</p>
										  <div class="signature-pad--actions">
											<div>
											  <button type="button" class="btn bg-teal clear" onclick="document.getElementById('signature').click();">อัปโหลด</button>
											  <button type="button" class="btn bg-primary clear" data-action="clear">เคลียร์</button>
											  <button type="button" class="btn bg-primary" data-action="undo">ยกเลิก</button>
											  <button type="button" class="btn bg-success save" data-action="save-png">บันทึก</button>								
											</div>
											<input type="file" style="display:none;" id="signature" name="picture" accept="image/*"/>
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
					{{-- <button type="button" id="btn_modal_message" data-dismiss="modal" class="btn bg-primary">ปิด</button> --}}
				</div>
			</div>
		</div>
	</div>

	<div id="modal_add_companydoc" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มเอกสารแนบ</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ชื่อเอกสาร</label><span class="text-danger">*</span>
                                <input type="text" id="companydocname" placeholder="โปรดระบุชื่อเอกสาร" class="form-control form-control-lg">
                            </div>
                        </div>
                        <div class="col-md-12">	
                            <div class="input-group">													
                                <button id="btnuploadcompanydoc" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('companydoc').click();" >อัปโหลด</button>													
                            </div>
                            <input type="file" style="display:none;" id="companydoc" data-id="{{$user->company->id}}" name="companydoc" accept="image/jpeg,image/gif,image/png,application/pdf"/>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_add_companydoc" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal_add_authorized_director --}}
    <div id="modal_add_authorized_director" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มผู้มีอำนาจลงนาม</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>คำนำหน้าชื่อ<span class="text-danger">*</span></label>
                                <select id="directorprefix" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-select2">
                                    @foreach ($prefixes as $prefix)
                                        <option value="{{$prefix->id}}" >{{$prefix->name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>ชื่อ</label><span class="text-danger">*</span>
                                <input type="text" id="directorname" placeholder="ชื่อ" class="form-control form-control-lg">
                            </div>

                            <div class="form-group">
                                <label>นามสกุล</label><span class="text-danger">*</span>
                                <input type="text" id="directorlastname" placeholder="นามสกุล" class="form-control form-control-lg">
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

	<!-- Cover area -->
	{{-- <div class="profile-cover">
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
				<span class="d-block">{{$user->position}}</span>
			</div>
			<div class="ml-md-3 mt-2 mt-md-0">
				<ul class="list-inline list-inline-condensed mb-0">
					<div class="form-group">
						<div class="input-group">													
							<button id="btnuploadcoverimg" class="btn btn-light border-transparent" type="button" onclick="document.getElementById('coverimg').click();"><i class="icon-file-picture mr-2"></i> รูปหน้าปก</button>													
						</div>
						<input type="file" style="display:none;" id="coverimg" name="coverimg" accept="image/*"/>
					</div>
				</ul>
			</div>
		</div>
	</div> --}}
	<!-- /cover area -->
	<!-- Profile navigation -->
	{{-- <div class="navbar navbar-expand-lg navbar-light bg-light">
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
				@if (Auth::user()->user_type_id == 3)
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
			</ul>

			<ul class="navbar-nav">
			
			</ul>
		</div>
	</div> --}}
	<!-- /profile navigation -->
	<div id="modal_reject_join" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เหตุผลการไม่เข้าร่วม</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
		<input type="text" id="linkurl" hidden>
						<div class="col-md-12">
							<div class="form-group">
								<label>ระบุเหตุผล<span class="text-danger">*</span></label>
								<textarea style="font-size:16px"  id="reject" rows="5"  placeholder="ระบุเหตุผล" class="form-control form-control-lg"></textarea>
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_reject_join" class="btn bg-primary" ><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i><i class="icon-checkmark3 font-size-base mr-1"></i> บันทึก</button>
				</div>
			</div>
		</div>
	</div>

	<div id="modal_reject_expertassignment" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เหตุผลการปฏิเสธ</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
		<input type="text" id="linkurl" hidden>
						<div class="col-md-12">
							<div class="form-group">
								<label>ระบุเหตุผล<span class="text-danger">*</span></label>
								<textarea style="font-size:16px"  id="reject1" rows="5"  placeholder="ระบุเหตุผล" class="form-control form-control-lg"></textarea>
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_reject_expertassignment" class="btn bg-primary" ><i class="icon-spinner spinner mr-2" id="spinicon1" hidden></i><i class="icon-checkmark3 font-size-base mr-1"></i> บันทึก</button>
				</div>
			</div>
		</div>
	</div>
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
			<input name="usergroup" value="{{$user->user_group_id}}" type="text" hidden>
			<div class="d-flex align-items-start flex-column flex-md-row">
				<div class="tab-content w-100 order-2 order-md-1">
					<div class="tab-pane fade active show" id="messagebox">
						<div class="card">
							<div class="card-header bg-transparent header-elements-inline">
								<h6 class="card-title" style="font-size:16px;font-weight: bold">กล่องข้อความ</h6>
								<div class="header-elements">
									@if ($messagereceives->count()>0 && $unreadmessages->count() > 0)
									<span class="badge bg-teal" id="newmessagecount2">
										{{$unreadmessages->count()}} ข้อความใหม่
									</span>
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
									</div>
								</div>
							</div>
							<div class="table-responsive" >
								{{--  class="table table-bordered table-striped" --}}
								<table class="table  table-inbox table-striped">
									<tbody >										
										@foreach ($messagereceives as $messagereceive)
										@php
											$status = "";
											if($messagereceive->message_read_status_id==1){
												$status = "unread";
											}
										@endphp
											<tr class="{{$status}} messagelink" data-id="{{$messagereceive->id}}">
												{{-- <td class="table-inbox-checkbox ">
													<a href="#">
														@if ($messagereceive->message_priority_id == 2 )
																<i class="icon-star-full2 text-warning-300"></i>
															@else
																<i class="icon-star-empty3 text-muted"></i>
														@endif
													</a>
												</td> --}}
												@php
													$f = substr($messagereceive->sender->email, 0, 1);
													
												@endphp
												{{-- <td class="table-inbox-image">
													<span class="btn bg-pink-400 rounded-circle btn-icon btn-sm">
														<span class="letter-icon">{{strtoupper($f)}}</span>
													</span>
												</td> --}}
												<td class="table-inbox-name" style="width:25%" >
													<a href="#" data-id="{{$messagereceive->id}} ">
														<div class="letter-icon-title text-default">&nbsp; {{$messagereceive->sender->name}} {{$messagereceive->sender->lastname}}</div>
													</a>
												</td>
												<td class="table-inbox-message">
													<span class="table-inbox-subject">{{$messagereceive->title}}</span>
													{{-- <span class="text-muted font-weight-normal">{{ strip_tags($messagereceive->body)}}</span> --}}
												</td>
												{{-- <td class="table-inbox-attachment">
													@if ($messagereceive->messageboxattachment->count() > 0)
														<i class="icon-attachment text-muted"></i>
													@endif
												</td> --}}
												<td class="table-inbox-time" style="white-space: nowrap">
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
															<label>หน่วยงาน</label>
															<input type="text" name="organizationname" value="{{$generalinfo->company}}" data-placeholder="สำนักงาน"class="form-control form-control-lg">
														</div>
														<div class="col-md-6">
															<label>ที่อยู่</label>
															<input type="text" name="organizationaddress" value="{{$generalinfo->address}}" data-placeholder="คำนำหน้า" class="form-control form-control-lg">
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
															<label>อำเภอ/เขต<span class="text-danger">*</span></label>
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
															<label>ตำบล/แขวง<span class="text-danger">*</span></label>
															<select name="organizationtambol" id="organizationtambol" data-placeholder="ตำบล" class="form-control form-control-select2">
																@foreach ($tambols as $tambol)                                                                
																	<option value="{{$tambol->id}}" @if ($tambol->id == $generalinfo->tambol_id) selected @endif> {{$tambol->name}} </option>
																@endforeach    
															</select>
														</div>
														<div class="col-md-6">
															<label>รหัสไปรษณีย์</label>
															<input type="text" name="organizationpostalcode" value="{{$generalinfo->postalcode}}" data-placeholder="รหัสไปรษณีย์" class="form-control form-control-lg">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>โทรศัพท์1</label>
															<input type="text" name="phone1" value="{{$generalinfo->phone1}}" data-placeholder="อีเมล" class="form-control form-control-lg">
														</div>
														<div class="col-md-6">
															<label>Call Center</label>
															<input type="text" name="phone2" value="{{$generalinfo->phone2}}" data-placeholder="Call Center" class="form-control form-control-lg">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>แฟ๊กซ์</label>
															<input type="text" name="organizationfax" value="{{$generalinfo->fax}}" data-placeholder="แฟ๊กซ์" class="form-control form-control-lg ">
														</div>
														<div class="col-md-6">
															<label>อีเมล</label>
															<input type="email" name="organizationemail" value="{{$generalinfo->email}}" data-placeholder="อีเมล" class="form-control form-control-lg">
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
															<label>lineclint <a href="https://notify-bot.line.me/en/" target="_blank">ลิงก์</a></label>
															<input type="text" name="lineclint" value="{{$generalinfo->client_id}}" data-placeholder="lineclint" class="form-control form-control-lg">
														</div>
														<div class="col-md-6">
															<label>linesecret</label>
															<input type="text" name="linesecret" value="{{$generalinfo->client_secret}}" data-placeholder="linesecret" class="form-control form-control-lg">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>thaisms (sms คงเหลือ <span class="text-success">{{$smscredit}}</span> )</label>
															<input type="text" name="thaisms" value="{{$generalinfo->thsmsuser}}" data-placeholder="thaisms" class="form-control form-control-lg">
														</div>
														<div class="col-md-6">
															<label>รหัสผ่าน thaisms</label>
															<input type="password" name="thaismspassword" value="" data-placeholder="รหัสผ่าน thaisms" class="form-control form-control-lg">
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
															<input type="text" name="workdaytime" value="{{$generalinfo->workdaytime}}" data-placeholder="เวลาทำการ จันทร์-ศุกร์" class="form-control form-control-lg">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>เวลาทำการ วันเสาร์</label>
															<input type="text" name="saturdaytime" value="{{$generalinfo->saturdaytime}}" data-placeholder="เวลาทำการ วันเสาร์" class="form-control form-control-lg">
														</div>
														<div class="col-md-6">
															<label>เวลาทำการ วันอาทิตย์</label>
															<input type="text" name="sundaytime" value="{{$generalinfo->sundaytime}}" data-placeholder="เวลาทำการ วันอาทิตย์" class="form-control form-control-lg">
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label>Youtube</label>
															<input type="text" name="youtube" value="{{$generalinfo->youtube}}" data-placeholder="Youtube" class="form-control form-control-lg">
														</div>
														<div class="col-md-6">
															<label>Facebook</label>
															<input type="text" name="facebook" value="{{$generalinfo->facebook}}" data-placeholder="Facebook" class="form-control form-control-lg">
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
								<div class="table-responsive" >
									<table style="width: 100%" class="table table-bordered table-striped" id="testtopictable">
										<thead>
											<tr>
												<th>ชื่อ</th>
												<th >ค่าเดิม</th> 
												<th >ค่าเปลี่ยนแปลง</th> 
												<th >วันที่</th> 
											</tr>
										</thead>
										<tbody>
{{-- 
											@foreach ($activitylogs as $activitylog)
											<tr>    
												<td> {{$activitylog->log_name}} </td>
													@foreach ($activitylog->properties as $item)
														@foreach ($item as $key => $_item)
														<td>{{$key}}: {{$_item}}</td> 
														@endforeach
													@endforeach
												<td> {{$activitylog->created_at}} </td>
											</tr>
											@endforeach --}}
										</tbody>
									</table>      
								</div>
							</div>
						</div>
						<!-- /profile info -->

					</div>

				</div>
				<!-- /left content -->
			</div>
		</form>

    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script type="module" src="{{asset('assets/dashboard/js/app/helper/locationhelper.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/profilehelper.js?v=3')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/signaturepad/signature_pad.umd.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/signaturepad/signaturecontrol.js')}}"></script>
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

