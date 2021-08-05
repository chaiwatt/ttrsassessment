@extends('layouts.dashboard.main')
@section('pageCss')

@stop

@section('content')
    <!-- Page header -->

	<!-- Cover area -->

	<!-- /cover area -->
	<!-- Profile navigation -->

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
		{{-- <form method="POST" action="{{route('setting.profile.expert.editsave',['userid' => $user->id ])}}" enctype="multipart/form-data">
			@csrf --}}
			<input name="usergroup" value="{{$user->user_group_id}}" type="text" hidden>
			<div class="d-flex align-items-start flex-column flex-md-row">
				<input name="usergroup" value="{{$user->user_group_id}}" type="text" hidden>
				{{-- <div class="tab-content w-100 order-2 order-md-1"> --}}
					

					{{-- <div class="tab-pane fade" id="personalinfo"> --}}
						<!-- personalinfo -->
						<div class="card">
							<div class="card-body">																						
										<div class="row">
											{{-- <div class="col-md-6">  
												<div class="form-group">
													<label>อีเมลผู้ใช้งาน<span class="text-danger">*</span></label>
													<input type="text"  name="useremail" value="{{$user->email}}"  placeholder="อีเมล" class="form-control form-control-lg" disabled>
												</div>
											</div>
											<div class="col-md-6">
												<label>รหัสผ่านผู้ใช้งาน</label>
												<input type="password" name="password" value="" data-placeholder="รหัสผ่าน" class="form-control form-control-lg">
											</div> --}}
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
														<input type="text" name="name" value="{{$user->name}}" data-placeholder="ชื่อ"class="form-control form-control-lg">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>นามสกุล<span class="text-danger">*</span></label>
														<input type="text" name="lastname" value="{{$user->lastname}}" data-placeholder="นามสกุล" class="form-control form-control-lg">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>เลขบัตรประจำตัวประชาชน<span class="text-danger">*</span></label></span>
														<input type="text" name="hid" id="hid" value="{{old('hid') ?? $user->hid}}" data-placeholder="เลขบัตรประจำตัวประชาชน" class="form-control form-control-lg" >
														<small id="hidinvalid" class="form-text text-danger" hidden></small>
													</div>
												</div>

										<legend>
											<label for="">ที่อยู่ตามบัตรประจำตัวประชาชน</label>
										</legend>		 

											<div class="col-md-6">  
												<div class="form-group">
													<label>ที่อยู่</label><span class="text-danger">*</span>
													<input type="text"  name="address" id="address" value="{{old('address') ?? $user->address}}"  placeholder="ที่อยู่ตามบัตรประจำตัวประชาชน" class="form-control form-control-lg">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>จังหวัด<span class="text-danger">*</span></label>
													<select name="province" id="province" data-placeholder="จังหวัด" class="form-control form-control-lg form-control-select2">
														<option value=""></option>
														@foreach ($provinces as $province)
															<option value="{{$province->id}}" @if($user->province_id == $province->id) selected @endif>{{$province->name}}</option> 
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>อำเภอ/เขต<span class="text-danger">*</span></label>
													<select name="amphur" id="amphur" data-placeholder="อำเภอ" class="form-control form-control-lg form-control-select2">
														@foreach ($amphurs as $amphur)                                                                
															<option value="{{$amphur->id}}" @if ($amphur->id == $user->amphur_id) selected @endif> {{$amphur->name}} </option>
														@endforeach   
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>ตำบล/แขวง<span class="text-danger">*</span></label>
													<select name="tambol" id="tambol" data-placeholder="ตำบล" class="form-control form-control-lg form-control-select2">
														@foreach ($tambols as $tambol)                                                                
															<option value="{{$tambol->id}}" @if ($tambol->id == $user->tambol_id) selected @endif> {{$tambol->name}} </option>
														@endforeach    
													</select>
												</div>
											</div>
											<div class="col-md-6">  
												<div class="form-group">
													<label>รหัสไปรษณีย์<span class="text-danger">*</span></label>
													<input type="text"  name="postalcode" id="postalcode" value="{{old('postalcode') ?? $user->postal}}"  placeholder="รหัสไปรษณีย์" class="form-control form-control-lg">
												</div>
											</div>
											<legend>
												<label for="">ที่อยู่ที่ติดต่อได้ <label class="form-check-label"  >
													
											</legend>	
											<div class="col-md-6">  
												<div class="form-group">
													<label>ที่อยู่อื่น</label><span class="text-danger">*</span>
													<input type="text"  name="address1" id="address1" value="{{old('address1') ?? $user->address1}}"  placeholder="ที่อยู่อื่น" class="form-control form-control-lg">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>จังหวัด<span class="text-danger">*</span></label>
													<select name="province1" id="province1" data-placeholder="จังหวัด" class="form-control form-control-lg form-control-select2">
														<option value=""></option>
														@foreach ($provinces as $province)
															<option value="{{$province->id}}" @if($user->province1_id == $province->id) selected @endif>{{$province->name}}</option> 
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>อำเภอ/เขต<span class="text-danger">*</span></label>
													<select name="amphur1" id="amphur1" data-placeholder="อำเภอ" class="form-control form-control-lg form-control-select2">
														@foreach ($amphurs1 as $amphur1)                                                                
															<option value="{{$amphur1->id}}" @if ($amphur1->id == $user->amphur1_id) selected @endif> {{$amphur1->name}} </option>
														@endforeach   
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>ตำบล/แขวง<span class="text-danger">*</span></label>
													<select name="tambol1" id="tambol1" data-placeholder="ตำบล" class="form-control form-control-lg form-control-select2">
														@foreach ($tambols1 as $tambol1)                                                                
															<option value="{{$tambol1->id}}" @if ($tambol1->id == $user->tambol1_id) selected @endif> {{$tambol1->name}} </option>
														@endforeach    
													</select>
												</div>
											</div>
											<div class="col-md-6">  
												<div class="form-group">
													<label>รหัสไปรษณีย์<span class="text-danger">*</span></label>
													<input type="text"  name="postalcode1" id="postalcode1" value="{{old('postalcode1') ?? $user->postal1}}"  placeholder="รหัสไปรษณีย์" class="form-control form-control-lg">
												</div>
											</div>
											<legend>

											</legend>
											<div class="col-md-6"> 
												<div class="form-group">
													<label>โทรศัพท์<span class="text-danger">*</span></label>
													<input type="text"  name="phone" value="{{old('phone') ?? $user->phone}}"  placeholder="โทรศัพท์" class="form-control form-control-lg">
												</div>
											</div>
											<div class="col-md-6"> 
												<div class="form-group">
													<label>อีเมล<span class="text-danger">*</span></label>
													<input type="text"  name="email" value="{{old('email') ?? $user->company->email}}"  placeholder="อีเมล" class="form-control form-control-lg">
												</div>
											</div>
											<div class="col-md-6"> 
												<div class="form-group">
													<label>เว็บไซต์</label>
													<input type="text"  name="website" value="{{old('website') ?? $user->website}}"  placeholder="เว็บไซต์" class="form-control form-control-lg">
												</div>
											</div>
											<div class="col-md-6">  
												<div class="form-group">
													<label>พิกัดละติจูด (เช่น 14.076868486942407)<a href="https://google.com/maps/place/{{$user->lat}},{{$user->lng}}" target="_blank" rel="noopener noreferrer"> เปิดแผนที่</a> </label>
													<input type="text"  name="lat" value="{{old('lat') ?? $user->lat}}"  placeholder="ละติจูด" class="form-control form-control-lg">
												</div>
											</div>
											<div class="col-md-6">  
												<div class="form-group">
													<label>พิกัดลองจิจูด (เช่น 100.60153839991285)</label>
													<input type="text"  name="lng" value="{{old('lng') ?? $user->lng}}"  placeholder="ลองจิจูด" class="form-control form-control-lg">
												</div>
											</div>
											<div class="col-md-6">  
												<div class="form-group">
													<label>ประเภทผู้เชี่ยวชาญ<span class="text-danger">*</span></label>
													<input type="text"  name="experttype" value="{{$expert->user->usergroup->name}}"  placeholder="ประเภทผู้เชี่ยวชาญ" class="form-control form-control-lg" readonly >
												</div>
											</div>
											<div class="col-md-6">  
												<div class="form-group">
													<label>หน่วยงานที่สังกัด<span class="text-danger">*</span></label>
													<input type="text"  name="organization" value="{{old('organization') ?? $expert->organization}}"  placeholder="หน่วยงานที่สังกัด" class="form-control form-control-lg">
												</div>
											</div>
											<div class="col-md-6">  
												<div class="form-group">
													<label>ตำแหน่ง<span class="text-danger">*</span></label>
													<input type="text"  name="position" value="{{old('position') ?? $expert->position}}"  placeholder="ตำแหน่ง" class="form-control form-control-lg">
												</div>
											</div>
											<div class="col-md-6">  
												<div class="form-group">
													{{-- <label>วุฒิการศึกษาสูงสุด</label>
													<input type="text"  name="lat" value=""  placeholder="ละติจูด" class="form-control form-control-lg"> --}}
													<label>วุฒิการศึกษาสูงสุด<span class="text-danger">*</span></label>
													<select name="educationlevel" id="educationlevel" data-placeholder="วุฒิการศึกษาสูงสุด" class="form-control form-control-lg form-control-select2">
														@foreach ($educationlevels as $educationlevel)                                                                
															<option value="{{$educationlevel->id}}" @if ($educationlevel->id == $expert->education_level_id) selected @endif > {{$educationlevel->name}} </option>
														@endforeach    
													</select>
												</div>
											</div>
											<div class="col-md-6">  
												<div class="row">
													<div class="col-md-6"> 
														<div class="form-group">
															<label>ประสบการณ์การทำงาน (ปี)<span class="text-danger">*</span></label>
															<input type="text" id="expereinceyear" name="expereinceyear" value="{{old('expereinceyear') ?? $expert->expereinceyear}}"  placeholder="ประสบการณ์การทำงาน (ปี)" class="form-control form-control-lg">
														</div>
													</div>
													<div class="col-md-6"> 
														<div class="form-group">
															<label>ประสบการณ์การทำงาน (เดือน)<span class="text-danger">*</span></label>
															<input type="text"  name="expereincemonth" value="{{old('expereincemonth') ?? $expert->expereincemonth}}"  placeholder="ประสบการณ์การทำงาน (เดือน)" class="form-control form-control-lg">
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6">  
												<div class="form-group">
													<label>สาขาความเชี่ยวชาญ<span class="text-danger">*</span></label>
													<select name="expertbranch" id="tambol" data-placeholder="สาขาความเชี่ยวชาญ" class="form-control form-control-lg form-control-select2">
														@foreach ($expertbranches as $expertbranch)                                                                
															<option value="{{$expertbranch->id}}" @if ($expertbranch->id == $expert->expert_branch_id) selected @endif> {{$expertbranch->name}} </option>
														@endforeach    
													</select>
												</div>
											</div>
											{{-- <div class="col-md-6">  
												<div class="form-group">
													<label>รูปถ่าย (ขนาด 500x500) px</label>
													<div class="input-group">													
														<input type="text" id="filename" class="form-control form-control-lg border-right-0" placeholder="รูปถ่าย"  >
														<span class="input-group-append">
															<button class="btn bg-info" type="button" onclick="document.getElementById('file').click();">อัปโหลดรูป</button>													
														</span>							
													</div>
													<input type="file" style="display:none;" id="file" name="picture" accept="image/*"/>
													@if (!Empty($user->picture))
													<br>
														<img src="{{asset($user->picture)}}" width="300" height="300" alt="">
													@endif
												</div>
											</div> --}}
											<hr>
											<div class="col-md-12">
												<div class="form-group">
													<input type="text" name="inpexpertfield" id="inpexpertfield" value="{{($expertfields->count() > 0) ? $expertfields->count() : ''}}" hidden>
													<label for="">ความเชี่ยวชาญ<span class="text-danger">*</span></label>
													{{-- <a href="#" id="btnexpertfield"  class="text-primary" data-toggle="modal" data-target="#modal_add_expertfield">คลิกเพิ่ม</a> --}}
														<div class="table-responsive">
															<table class="table table-bordered table-striped">
																<thead>
																	<tr class="bg-info">
																		<th style="width:10%">ลำดับ</th> 
																		<th style="width:70%">รายละเอียด</th> 
																		{{-- <th style="width:20%">เพิ่มเติม</th>                                                                                    --}}
																	</tr>
																</thead>
																<tbody id="expertfield_wrapper_tr"> 
																	@foreach ($expertfields as $expertfield)
																		<tr >                                        
																			<td> {{$expertfield->order}}</td>                                            
																			<td> {{$expertfield->detail}}</td>    
																			{{-- <td> 
																				<a  data-id="{{$expertfield->id}}" data-name="" class="btn btn-sm bg-danger deleteexpertfield">ลบ</a>                                       
																			</td> --}}
																		</tr>
																	@endforeach
																</tbody>
															</table>
														</div>
													</div>
												{{-- </div> --}}
											</div>
											<hr>
											<div class="col-md-12">
												<div class="form-group">
													{{-- <div class="col-md-12" > --}}
														<label for="">เอกสารแนบ  </label>
													{{-- <a href="#" id="btnuploadexpertdoc"  class="text-primary" data-toggle="modal" data-target="#modal_add_expertdoc">คลิกเพิ่ม</a> --}}
													<p><small>(ประวัติย่อ, วุฒิการศึกษา, ใบรับรองวิชาชีพ, ใบรับรองคุณวุฒิ, อื่นๆ)</small></p> 
														<div class="table-responsive">
															<table class="table table-bordered table-striped">
																<thead>
																	<tr class="bg-info">
																		<th style="width:80%">ไฟล์</th> 
																		<th style="width:20%">เพิ่มเติม</th>                                                                                   
																	</tr>
																</thead>
																<tbody id="fulltbp_expertdoc_wrapper_tr"> 
																	@foreach ($expertdocs as $expertdoc)
																		<tr >                                        
																			<td> {{$expertdoc->name}}</td>                                            
																			<td> 
																				<a href="{{asset($expertdoc->path)}}" class="btn btn-sm bg-primary">ดาวน์โหลด</a>
																				{{-- <a  data-id="{{$expertdoc->id}}" data-name="" class="btn btn-sm bg-danger deleteexpertdoc">ลบ</a>                                        --}}
																			</td>
																		</tr>
																	@endforeach
																</tbody>
															</table>
														</div>
													</div>
												{{-- </div> --}}
											</div>
										{{-- </div> --}}
									
						</div>
						<!-- /personalinfo -->
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
											<table class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>#</th>
														<th>ชื่อ-นามสกุล</th>    
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
																<a  data-id="{{$friend->id}}" class="badge bg-danger deletefriendclass" id="deletefriendclass_editview">ลบ</a> 
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
													<table class="table table-bordered table-striped">
														<thead>
															<tr>
																<th>#</th>
																<th>ชื่อ-นามสกุล</th>    
																<th>ประเภท</th>  
																<th>สถานภาพ</th>                          
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
																		<a  data-id="{{$friendrequest->id}}" class="btn btn-danger-400 btn-sm deleterequestfriendclass" id="deleterequestfriendclass_editview"><i class="icon-trash danger"></i></a>
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
													<table class="table table-bordered table-striped">
														<thead>
															<tr>
																<th>#</th>
																<th>ชื่อ-นามสกุล</th>    
																<th>ประเภท</th>  
																<th>สถานภาพ</th>                          
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
																		<a  data-id="{{$friendrequestcoming->id}}" class="badge bg-teal acceptfriendclass" id="acceptfriendclass_editview">ยืนยันตอบรับ</a>                                       
																		<a  data-id="{{$friendrequestcoming->id}}" class="badge bg-danger rejectfriendclass" id="rejectfriendclass_editview">ไม่รับ</a>                                       
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
		{{-- </form> --}}

    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script type="module" src="{{asset('assets/dashboard/js/app/helper/locationhelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/expertprofilehelper.js')}}"></script>
{{-- <script src="{{asset('assets/dashboard/js/plugins/signaturepad/signature_pad.umd.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/signaturepad/signaturecontrol.js')}}"></script> --}}
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

