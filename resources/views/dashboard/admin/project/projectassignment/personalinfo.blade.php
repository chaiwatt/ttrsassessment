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
								<label>ตำแหน่ง</label>
								<input type="text"  id="expertexpienceposition" placeholder="ตำแหน่ง" class="form-control form-control-lg" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>หน่วยงาน/บริษัท</label>
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
								<label>ปีที่เริ่ม</label>
								<input type="number" maxlength="4" id="fromyear" placeholder="ปีที่เริ่ม" class="form-control form-control-lg" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>ปี่ที่สิ้นสุด</label>
								<input type="number" maxlength="4" id="toyear" placeholder="ปี่ที่สิ้นสุด" class="form-control form-control-lg" >
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_expertexpience" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
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
								<label>ตำแหน่ง</label>
								<input type="text"  id="expertexpienceposition" placeholder="ตำแหน่ง" class="form-control form-control-lg" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>หน่วยงาน/บริษัท</label>
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
								<label>ปีที่เริ่ม</label>
								<input type="number" maxlength="4" id="fromyear" placeholder="ปีที่เริ่ม" class="form-control form-control-lg" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>ปี่ที่สิ้นสุด</label>
								<input type="number" maxlength="4" id="toyear" placeholder="ปี่ที่สิ้นสุด" class="form-control form-control-lg" >
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_edit_expertexpience" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
				</div>
			</div>
		</div>
	</div>

		{{-- modal add_expertfield --}}
		<div id="modal_add_expertfield" class="modal fade" style="overflow:hidden;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ความเชี่ยวชาญ</h5>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>ลำดับ (ให้กรอกตัวเลข เช่น 1)</label>
									<input type="ลำดับ"  id="expertfieldnum" placeholder="ลำดับ" class="form-control form-control-lg numeralformat2" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>ความเชี่ยวชาญ</label>
									<input type="text" id="expertfielddetail" placeholder="ความเชี่ยวชาญ" class="form-control form-control-lg" >
								</div>
							</div>
						</div>
					</div>           
					<div class="modal-footer">
						<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
						<button id="btn_modal_add_expertfield" class="btn bg-primary" ><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
					</div>
				</div>
			</div>
		</div>
		{{-- modal edit_expertfield --}}
		<div id="modal_edit_expertfield" class="modal fade" style="overflow:hidden;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ความเชี่ยวชาญ</h5>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<input type="text" id="expertfieldid" hidden>
							<input type="text" id="currentid" hidden>
							<div class="col-md-12">
								<div class="form-group">
									<label>ลำดับ (ให้กรอกตัวเลข เช่น 1)</label>
									<input type="ลำดับ"  id="expertfieldnum_edit" placeholder="ลำดับ" class="form-control form-control-lg numeralformat2" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>ความเชี่ยวชาญ</label>
									<input type="text" id="expertfielddetail_edit" placeholder="ความเชี่ยวชาญ" class="form-control form-control-lg" >
								</div>
							</div>
						</div>
					</div>           
					<div class="modal-footer">
						<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
						<button id="btn_modal_edit_expertfield" class="btn bg-primary" ><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
					</div>
				</div>
			</div>
		</div>
		<div id="modal_add_expertdoc" class="modal fade" style="overflow:hidden;">
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
									<label>ชื่อเอกสาร <small>เช่น ประวัติย่อ, วุฒิการศึกษา, ใบรับรองวิชาชีพ, ใบรับรองคุณวุฒิ หรืออื่นๆ</small></label>
									<input type="text" id="expertdocname" placeholder="โปรดระบุชื่อเอกสาร" class="form-control form-control-lg">
								</div>
							</div>
							{{-- <div class="col-md-12">	
								<div class="input-group">													
									<button id="btnuploadexpertdoc" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('expertdoc').click();" >อัปโหลด</button>													
								</div>
								<input type="file" style="display:none;" id="expertdoc" data-id="{{$user->company->id}}" name="expertdoc" accept="image/jpeg,image/gif,image/png,application/pdf"/>
							</div> --}}
						</div>
					</div>           
					<div class="modal-footer">
						<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
						<button id="btn_modal_add_expertdoc" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
					</div>
				</div>
			</div>
		</div>
	

	<!-- Cover area -->

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
				@foreach ($errors->all() as $error)
					<div class="alert alert-warning alert-styled-left alert-dismissible">
						<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
						{{ $error}}
					</div>
				@endforeach
			@endif
		<!-- Inner container -->
		<form method="POST" action="{{route('setting.profile.officer.editsave',['userid' => $user->id ])}}" enctype="multipart/form-data">
			@csrf
			<input name="usergroup" value="{{$user->user_group_id}}" type="text" hidden>
			<div class="d-flex align-items-start flex-column flex-md-row">
				<input name="usergroup" value="{{$user->user_group_id}}" type="text" hidden>
					<!-- personalinfo -->
					<div class="card border-top-info rounded-top-1 mb-0">

						<div class="card-header header-elements-sm-inline">
                            <h6 class="card-title" style="font-size:16px;font-weight: bold">Profile: {{$user->name}} {{$user->lastname}}</h6>
                            <div class="header-elements">
                                <div class="list-icons ml-3">
                                    <div class="list-icons-item dropdown">
                                        <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                        <div class="dropdown-menu">
                                            {{-- <a href="#" data-toggle="modal" id="select_fulltbptable_excel" class="dropdown-item"><i class="icon-file-excel"></i>Excel</a> --}}

											@if ($user->company->saveprofile != 0)
													<a href="{{route('dashboard.admin.realtimereport.singledownload',['id' => $user->id])}}"  class="dropdown-item"><i class="icon-file-excel"></i>Excel</a>
													@else
													<a href="" data-toggle="modal" class="dropdown-item">ยังไม่ได้ตั้งค่าโปรไฟล์</a>
											@endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


						<div class="card-body">												
							<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>คำนำหน้า</label>
											<select name="prefix" id="prefix" data-placeholder="คำนำหน้า" class="form-control form-control-lg form-control-select2" disabled>
												@foreach ($prefixes as $prefix)
													<option value="{{$prefix->id}}" 
														@if (empty(old('prefix')))
															@if ($user->prefix_id == $prefix->id) selected @endif 
															@else
															@if (old('prefix') == $prefix->id) selected @endif 
														@endif
												>{{$prefix->name}}</option> 
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6" id="alter_prefix_wrapper" 
										@if (Empty($user->alter_prefix))
											hidden
										@endif
										>
										<div class="form-group">
											<label>คำนำหน้า อื่น</label>
											<input type="text" name="alter_prefix" id="alter_prefix" value="{{$user->alter_prefix}}" data-placeholder="คำนำหน้า อื่น"class="form-control form-control-lg stringformat60" disabled>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>ชื่อ</label>
											<input type="text" name="name" value="{{old('name') ?? $user->name}}" data-placeholder="ชื่อ" class="form-control form-control-lg stringformat60" disabled>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>นามสกุล</label>
											<input type="text" name="lastname" value="{{old('lastname') ?? $user->lastname}}" data-placeholder="นามสกุล" class="form-control form-control-lg stringformat60" disabled>
										</div>
									</div>
									{{-- <div class="col-md-6">
										<div class="form-group">
											<label>เลขบัตรประจำตัวประชาชน</label></span>
											<input type="text" name="hid" id="hid" value="{{old('hid') ?? '$user->hid'}}" data-placeholder="เลขบัตรประจำตัวประชาชน" class="form-control form-control-lg numeralformath13" 
											@if (!Empty($user->hid))
												readonly
											@endif
                                            disabled
											>
											<small id="hidinvalid" class="form-text text-danger" hidden></small>
										</div>
									</div> --}}
							<legend>
								<label for="">ที่อยู่ตามบัตรประจำตัวประชาชน</label>
							</legend>		 

								<div class="col-md-6">  
									<div class="form-group">
										<label>ที่อยู่</label>
										<input type="text"  name="address" id="address"  value="{{old('address') ?? $user->address}}"  placeholder="ที่อยู่" class="form-control form-control-lg stringformat60" disabled>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>จังหวัด</label>
										{{-- {{old('province')}} --}}
										<select name="province" id="province" data-placeholder="จังหวัด" class="form-control form-control-lg form-control-select2" disabled>
											<option value="0">===เลือกจังหวัด===</option>
											@foreach ($provinces as $province)
												<option value="{{$province->id}}" 
													@if($user->province_id == $province->id) 
															selected 
														@else	
															@if (old('province') == $province->id) selected @endif
													@endif>{{$province->name}}</option> 
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>อำเภอ/เขต</label>
										<select name="amphur" id="amphur" data-placeholder="อำเภอ" class="form-control form-control-lg form-control-select2" disabled>
											{{-- @foreach ($amphurs as $amphur)                                                                
												<option value="{{$amphur->id}}" @if ($amphur->id == $user->amphur_id) selected @endif> {{$amphur->name}} </option>
											@endforeach    --}}
											@foreach ($amphurs as $amphur)   
												@php
													$string = strpos($amphur,"*");
												@endphp
												@if ($string == null)
												
													<option value="{{$amphur->id}}" 
													@if ($user->amphur_id == $amphur->id) 
															selected 
														@else
															@if (old('amphur') == $amphur->id) selected @endif
													@endif> {{$amphur->name}}</option>
												@endif                                                            
											@endforeach 
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>ตำบล/แขวง</label>
										<select name="tambol" id="tambol" data-placeholder="ตำบล" class="form-control form-control-lg form-control-select2" disabled>
											@foreach ($tambols as $tambol)                                                                
												{{-- <option value="{{$tambol->id}}" @if ($tambol->id == $user->tambol_id) selected @endif> {{$tambol->name}} </option> --}}
												<option value="{{$tambol->id}}" 
												@if ($user->tambol_id == $tambol->id) 
													selected
													@else	
														@if (old('tambol') == $amphur->id) selected @endif
												@endif> {{$tambol->name}} </option>

											@endforeach    
										</select>
									</div>
								</div>
								<div class="col-md-6">  
									<div class="form-group">
										<label>รหัสไปรษณีย์</label>
										<input type="text"  name="postalcode"  id="postalcode"  value="{{old('postalcode') ?? $user->postal}}"  placeholder="รหัสไปรษณีย์" class="form-control form-control-lg numeralformatpostal" disabled>
									</div>
								</div>
								<legend>
									<label for="">ที่อยู่ที่ติดต่อได้ (<label class="form-check-label"  >
									<div class="form-check">
										<label class="form-check-label">
											<input type="checkbox" name="sameaddress" id="sameaddress" class="form-check-input-styled-primary"  data-fouc
											@if (($user->address == $user->address1 && $user->province_id == $user->province1_id && $user->amphur_id == $user->amphur1_id && $user->tambol_id == $user->tambol1_id && $user->postal == $user->postal1) && $user->address != '')
												checked
											@endif
                                            disabled
											>
											ที่อยู่เดียวกับที่อยู่ตามบัตรประจำตัวประชาชน
										</label>)
									</div>
								</legend>	
								<div class="col-md-12" id="contact_address_wrapper"> 
									<div class="row">
										<div class="col-md-6">  
											<div class="form-group">
												<label>ที่อยู่อื่น</label>
												<input type="text"  name="address1" id="address1" value="{{old('address1') ?? $user->address1}}"  placeholder="ที่อยู่อื่น" class="form-control form-control-lg stringformat60" disabled>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>จังหวัด</label>
												<select name="province1" id="province1" data-placeholder="จังหวัด" class="form-control form-control-lg form-control-select2" disabled>
													<option value="0">===เลือกจังหวัด===</option>
													{{-- @foreach ($provinces as $province) --}}
														{{-- <option value="{{$province->id}}" @if($user->province1_id == $province->id) selected @endif>{{$province->name}}</option>  --}}
		
														@foreach ($provinces as $province)
															<option value="{{$province->id}}" 
																@if($user->province1_id == $province->id) 
																		selected 
																	@else	
																		@if (old('province1') == $province->id) selected @endif
																@endif>{{$province->name}}</option> 
														@endforeach
		
													{{-- @endforeach --}}
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>อำเภอ/เขต</label>
												<select name="amphur1" id="amphur1" data-placeholder="อำเภอ" class="form-control form-control-lg form-control-select2" disabled>
													{{-- @foreach ($amphurs1 as $amphur1)                                                                
														<option value="{{$amphur1->id}}" @if ($amphur1->id == $user->amphur1_id) selected @endif> {{$amphur1->name}} </option>
													@endforeach    --}}
													@foreach ($amphurs1 as $amphur1)                                                                
														<option value="{{$amphur1->id}}" 
															@if ($user->amphur1_id == $amphur1->id) 
																	selected 
																@else
																	@if (old('amphur1') == $amphur1->id) selected @endif
															@endif> {{$amphur1->name}} </option>
													@endforeach 
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>ตำบล/แขวง</label>
												<select name="tambol1" id="tambol1" data-placeholder="ตำบล" class="form-control form-control-lg form-control-select2" disabled>
													{{-- @foreach ($tambols1 as $tambol1)                                                                
														<option value="{{$tambol1->id}}" @if ($tambol1->id == $user->tambol1_id) selected @endif> {{$tambol1->name}} </option>
													@endforeach  --}}
													
													@foreach ($tambols1 as $tambol1)                                                                
														<option value="{{$tambol1->id}}" 
														@if ($user->tambol1_id == $tambol1->id) 
															selected
															@else	
																@if (old('tambol1') == $tambol1->id) selected @endif
														@endif> {{$tambol1->name}} </option>
													@endforeach    
												</select>
											</div>
										</div>
										<div class="col-md-6">  
											<div class="form-group">
												<label>รหัสไปรษณีย์</label>
												<input type="text"  name="postalcode1" id="postalcode1" value="{{old('postalcode1') ?? $user->postal1}}"  placeholder="รหัสไปรษณีย์" class="form-control form-control-lg numeralformatpostal" disabled>
											</div>
										</div>
									</div>
									<legend>

									</legend>	
								</div>
								
								<div class="col-md-6"> 
									<div class="form-group">
										<label>โทรศัพท์</label>
										<input type="text"  name="phone" value="{{old('phone') ?? $user->phone}}"  placeholder="โทรศัพท์" class="form-control form-control-lg numeralformathphone" disabled>
									</div>
								</div>
								<div class="col-md-6"> 
									<div class="form-group">
										<label>อีเมล</label>
										<input type="text"  name="email" value="{{$user->email ?? $user->company->email}}"  placeholder="อีเมล" class="form-control form-control-lg stringformat30" disabled>
									</div>
								</div>
								<div class="col-md-6"> 
									<div class="form-group">
										<label>เว็บไซต์</label>
										<input type="text"  name="website" value="{{old('website') ?? $user->website}}"  placeholder="เว็บไซต์" class="form-control form-control-lg stringformat20" disabled>
									</div>
								</div>
								<div class="col-md-6">  
									<div class="form-group">
										<label>พิกัดละติจูด (เช่น 14.076868486942407)<a href="https://google.com/maps/place/{{$user->lat}},{{$user->lng}}" target="_blank" rel="noopener noreferrer"> เปิดแผนที่</a></label>
										<input type="text"  name="lat" value="{{old('lat') ?? $user->lat}}"  placeholder="ละติจูด" class="form-control form-control-lg stringformat60">
									</div>
								</div>
								<div class="col-md-6">  
									<div class="form-group">
										<label>พิกัดลองจิจูด (เช่น 100.60153839991285) </label>
										<input type="text"  name="lng" value="{{old('lng') ?? $user->lng}}"  placeholder="ลองจิจูด" class="form-control form-control-lg stringformat60" disabled>
									</div>
								</div>
								<div class="col-md-6">  
									<div class="form-group">
										<label>ประเภทผู้เชี่ยวชาญ</label>
										{{$officer->user_group_id}}
										<input type="text"  name="experttype" value="{{$user->usergroup->name}}"  placeholder="ประเภทผู้เชี่ยวชาญ" class="form-control form-control-lg" disabled>
									</div>
								</div>
								<div class="col-md-6">  
									<div class="form-group">
										<label>หน่วยงานที่สังกัด</label>
										<input type="text"  name="organization" value="{{old('organization') ?? $officer->organization}}"  placeholder="หน่วยงานที่สังกัด" class="form-control form-control-lg stringformat60" disabled>
									</div>
								</div>
								<div class="col-md-6">  
									<div class="form-group">
										<label>ตำแหน่ง</label>
										<input type="text"  name="position" value="{{old('position') ?? $officer->position}}"  placeholder="ตำแหน่ง" class="form-control form-control-lg stringformat60" disabled>
									</div>
								</div>
								<div class="col-md-6">  
									<div class="form-group">
										<label>วุฒิการศึกษาสูงสุด</label>
										<select name="educationlevel" id="educationlevel" data-placeholder="วุฒิการศึกษาสูงสุด" class="form-control form-control-lg form-control-select2" disabled>
											@foreach ($educationlevels as $educationlevel)     
												@if ($educationlevel->name !="อื่นๆ")
													<option value="{{$educationlevel->id}}" 
													@if ($educationlevel->id == $officer->education_level_id) 
															selected 
														@else
															@if (old('educationlevel') == $educationlevel->id) selected @endif
													@endif > {{$educationlevel->name}} </option>
												@endif                                                           

											@endforeach    
										</select>
									</div>
								</div>
								<div class="col-md-6">  
									<div class="row">
										<div class="col-md-6"> 
											<div class="form-group">
												<label>ประสบการณ์การทำงาน (ปี)</label>
												<input type="text"  name="expereinceyear" value="{{old('expereinceyear') ?? $officer->expereinceyear}}"  placeholder="ประสบการณ์การทำงาน (ปี)" class="form-control form-control-lg numeralformat2" disabled>
											</div>
										</div>
										<div class="col-md-6"> 
											<div class="form-group">
												<label>ประสบการณ์การทำงาน (เดือน)</label>
												<input type="text" id="expereincemonth" name="expereincemonth" value="{{old('expereincemonth') ?? $officer->expereincemonth}}"  placeholder="ประสบการณ์การทำงาน (เดือน)" class="form-control form-control-lg numeralformat2" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">  
									<div class="form-group">
										<label>สาขาความเชี่ยวชาญ</label>
										<select name="expertbranch" id="expertbranch" data-placeholder="สาขาความเชี่ยวชาญ" class="form-control form-control-lg form-control-select2" disabled>
											@foreach ($officerbanches as $officerbanch)                                                                
												<option value="{{$officerbanch->id}}" 
													@if ($officerbanch->id == $officer->officer_branch_id) 
															selected 
														@else	
															@if (old('expertbranch') == $officerbanch->id) selected @endif
													@endif> {{$officerbanch->name}} </option>
											@endforeach    
										</select>
									</div>
								</div>
								<div class="col-md-6" id="other_branch_wrapper"
								@if ($officer->officer_branch_id != 19)
									hidden
								@endif
								> 
									<div class="form-group">
										<label>โปรดระบุ</label>
										<input type="text" id="other_branch" name="other_branch" value="{{old('other_branch') ?? $officer->other_branch}}"  class="form-control form-control-lg " disabled>
									</div>
								</div>
								<hr>
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" name="officerfield" id="inpexpertfield" value="{{($officerfields->count() > 0) ? $officerfields->count() : ''}}" hidden>
										<label for="">ความเชี่ยวชาญ</label>
										{{-- <a href="#" id="btnexpertfield"  class="text-primary" data-toggle="modal" data-target="#modal_add_expertfield">คลิกเพิ่ม</a> --}}
											<div class="table-responsive" >
												<table style="width: 100%" class="table table-bordered table-striped" id="expertfield_wrapper" >
													<thead>
														<tr class="bg-info">
															<th style="width:10%">ลำดับ</th> 
															<th style="width:70%">รายละเอียด</th> 
															{{-- <th style="width:1%;white-space: nowrap">เพิ่มเติม</th>                                                                                    --}}
														</tr>
													</thead>
													<tbody id="expertfield_wrapper_tr"> 
														@foreach ($officerfields as $officerfield)
															<tr class="item">                                        
																<td> <span>{{$officerfield->order}}</span> </td>                                            
																<td> {{$officerfield->detail}}</td>    
																{{-- <td style="width:1%;white-space: nowrap"> 
																	<a href="#" data-id="{{$officerfield->id}}" class="btn btn-sm bg-danger deleteexpertfield" data-toggle="modal">ลบ</a>                                       
																	<a href="#" data-id="{{$officerfield->id}}" data-toggle="modal" class="btn btn-sm bg-info editexpertfield">แก้ไข</a>                                       
																</td> --}}
															</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										
										<label for="">โครงการที่รับผิดชอบ</label>
										{{-- <a href="#" id="btnexpertfield"  class="text-primary" data-toggle="modal" data-target="#modal_add_expertfield">คลิกเพิ่ม</a> --}}
											<div class="table-responsive" >
												<table style="width: 100%" class="table table-bordered table-striped" >
													<thead>
														<tr class="bg-info">
															<th style="width:80%">ชื่อโครงการ</th> 
															<th style="width:20%">สถานภาพ</th> 
															{{-- <th style="width:1%;white-space: nowrap">เพิ่มเติม</th>                                                                                    --}}
														</tr>
													</thead>
													<tbody id="expertfield_wrapper_tr"> 
                                                        @if (!empty($user->projectbelongofficer))
                                                            @foreach ($user->projectbelongofficer as $fulltbp)
                                                                @php
                                                                    $color = "bg-grey-300";
                                                                    $status = "กำลังดำเนินการ";
                                                                    if($fulltbp->status == 3){
                                                                        $color = "bg-success-400";
                                                                        $status = "เสร็จสิ้น";
                                                                    }
                                                                @endphp
                                                                <tr class="item">                                        
                                                                    <td> <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="text-info" target="_blank" >{{$fulltbp->minitbp->project}} </a>   </td>                                            
                                                                    <td> <span class="badge badge-pill {{$color}} ml-20 ml-md-0">{{$status}}</span></td>    
                                                                </tr>
                                                            @endforeach
                                                        @endif
													</tbody>
												</table>
											</div>
										</div>
								</div>



								<hr>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">แนบเอกสาร  </label>
										{{-- <a href="#" id="btnuploadexpertdoc"  class="text-primary" data-toggle="modal" onclick="document.getElementById('expertdoc').click();">คลิกเพิ่ม</a>  --}}
										<input type="file" style="display:none;" id="expertdoc" data-id="{{$user->company->id}}" name="expertdoc" accept="image/jpeg,image/gif,image/png,application/pdf"/>
										<p><i> (ประวัติย่อ, วุฒิการศึกษา, ใบรับรองวิชาชีพ, ใบรับรองคุณวุฒิ, อื่นๆ)</i></p> 
											<div class="table-responsive" >
												<table style="width: 100%" class="table table-bordered table-striped" >
													<thead>
														<tr class="bg-info">
															<th style="width:80%">ไฟล์</th> 
															<th style="width:1%;white-space: nowrap">เพิ่มเติม</th>                                                                                   
														</tr>
													</thead>
													<tbody id="fulltbp_expertdoc_wrapper_tr"> 
														@foreach ($officerdocs as $officerdoc)
															<tr >                                        
																<td> {{$officerdoc->name}}</td>                                            
																<td style="width:1%;white-space: nowrap"> 
																	<a href="{{asset($officerdoc->path)}}" class="btn btn-sm bg-primary"  target="_blank">ดูเอกสาร</a>
																	{{-- <a  data-id="{{$officerdoc->id}}" data-name="" class="btn btn-sm bg-danger deleteexpertdoc">ลบ</a>                                        --}}
																</td>
															</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
								</div>
								<div class="col-md-12">  
									<div class="form-group">
										{{-- <label>รูป Avatar (ขนาด 500x500) พิกเซล</label> --}}
										{{-- <div class="input-group">													
											<input type="text" id="filename" class="form-control border-right-0" placeholder="โลโก้"  >
											<span class="input-group-append">
												<button class="btn bg-info" type="button" onclick="document.getElementById('file').click();">อัปโหลดรูป</button>																																						
											</span>
										</div> --}}
										<input type="file" style="display:none;" id="file" name="picture" accept="image/*"/>
										@if (!Empty($user->company->logo))
										<br>
											<img src="{{asset($user->company->logo)}}" width="300" height="300" alt="">
										@endif
									</div>
								</div>
							{{-- <div class="col-md-12 text-right">
								<button type="submit" name="action" value="personal" onclick="confirmsubmit(event);" class="btn bg-teal">บันทึก<i class="icon-paperplane ml-2"></i></button>
							</div> --}}
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
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/officerprofilehelper.js?v=5')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/inputformat.js?v=3')}}"></script>
    <script>
    	var route = {
			url: "{{ url('/') }}",
			token: $('meta[name="csrf-token"]').attr('content'),
        };



	// var cleave = new Cleave('.numeralformatpostal', {
	// 	numericOnly: true,
    //         blocks: [5]
	// });

		var oldprovince =  "{{old('province')}}";
		var oldamphur=  "{{old('amphur')}}";
		var oldtambol =  "{{old('tambol')}}";

		var oldprovince1 =  "{{old('province1')}}";
		var oldamphur1 =  "{{old('amphur1')}}";
		var oldtambol1 =  "{{old('tambol1')}}";

		if(oldprovince != '' && oldamphur != ''){
			amphur(oldprovince).then(data => {
				let  html = "";
				var select ='';
				data.forEach(function (amphur,index) {
					var select ='';
					if(oldamphur == amphur['id']){
						select = 'selected'
					}
					html += `<option value='${amphur.id}' ${select}>${amphur.name}</option>`
					});

				
				$("#amphur").html(html);
			})
			.catch(error => {})
		}

		if(oldamphur != '' && oldtambol != ''){
			tambol(oldamphur).then(data => {
				let  html = "";
				var select ='';
				data.forEach(function (tambol,index) {
					var select ='';
					if(oldtambol == tambol['id']){
						select = 'selected'
					}
					html += `<option value='${tambol.id}' ${select}>${tambol.name}</option>`
					});

				
				$("#tambol").html(html);
			})
			.catch(error => {})
		}

		if(oldprovince1 != '' && oldamphur1 != ''){
			amphur(oldprovince1).then(data => {
				let  html = "";
				var select ='';
				data.forEach(function (amphur,index) {
					var select ='';
					if(oldamphur1 == amphur['id']){
						select = 'selected'
					}
					html += `<option value='${amphur.id}' ${select}>${amphur.name}</option>`
					});

				
				$("#amphur1").html(html);
			})
			.catch(error => {})
		}

		if(oldamphur1 != '' && oldtambol1 != ''){
			tambol(oldamphur1).then(data => {
				let  html = "";
				var select ='';
				data.forEach(function (tambol,index) {
					var select ='';
					if(oldtambol1 == tambol['id']){
						select = 'selected'
					}
					html += `<option value='${tambol.id}' ${select}>${tambol.name}</option>`
					});

				
				$("#tambol1").html(html);
			})
			.catch(error => {})
		}


		function amphur(provinceid){
			return new Promise((resolve, reject) => {
				$.ajax({
				url: `${route.url}/api/location/amphur`,
				type: 'POST',
				headers: {"X-CSRF-TOKEN":route.token},
				data: {
					proviceid : provinceid
				},
				success: function(data) {
					resolve(data)
				},
				error: function(error) {
					reject(error)
				},
				})
			})
		}
		function tambol(amphurid){

			return new Promise((resolve, reject) => {
				$.ajax({
				url: `${route.url}/api/location/tambol`,
				type: 'POST',
				headers: {"X-CSRF-TOKEN":route.token},
				data: {
					amphurid : amphurid
				},
				success: function(data) {
					resolve(data)
				},
				error: function(error) {
					reject(error)
				},
				})
			})
		}


        $("#file").on('change', function() {
            $("#filename").val(this.value);
        });
		$("#prefix").on('change', function() {
			if(this.value == 5){
				$("#alter_prefix_wrapper").attr("hidden",false);
			}else{
				$("#alter_prefix_wrapper").attr("hidden",true);
				$("#alter_prefix").val('');
			}
        });
        $('#paidupcapitaldate').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            clearButton: true,
            cancelText: "ยกเลิก",
            okText: "ตกลง",
            clearText: "เคลียร์",
            time: false
        });

		$(document).on('keyup', '#expereincemonth', function(e) {
			if($(this).val() > 11 ){
				$(this).val(11);
			}
		});

		function confirmsubmit(e) {

			e.preventDefault();
			var frm = e.target.form;
			Swal.fire({
					title: 'บันทึกข้อมูล',
					text: `ยืนยันการบันทึก`,
					type: 'info',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					confirmButtonText: 'ตกลง',
					cancelButtonText: 'ยกเลิก',
					closeOnConfirm: false,
					closeOnCancel: false
				}).then((result) => {
				if (result.value) {
					if($('#expertbranch').val() == 19){
						if($('#other_branch').val() == ''){
							Swal.fire({
								title: 'ผิดพลาด',
								text: 'โปรดระบุสาขาผู้เชี่ยวชาญ!',
								});
						}else{
							frm.submit();
						}
					}else{
						frm.submit();
					}
					
				}
			});
		}

		$(document).on('change', '#tambol', function(e) {
			// console.log($(this).find(':selected').data('id'));
			$('#postalcode').val($(this).find(':selected').data('id'));
		});

		$(document).on('change', '#tambol1', function(e) {
			// console.log($(this).find(':selected').data('id'));
			$('#postalcode1').val($(this).find(':selected').data('id'));
		});
    </script>	
@stop

