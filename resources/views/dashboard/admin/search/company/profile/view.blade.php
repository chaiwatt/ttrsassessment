@extends('layouts.dashboard.main')
@section('pageCss')

@stop

@section('content')
    <!-- Page header -->


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
		{{-- <form method="POST" action="{{route('setting.profile.user.editsave',['userid' => $user->id ])}}" enctype="multipart/form-data">
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
												<label>เลขบัตรประจำตัวประชาชน</label><span class="text-danger">*</span></span>
												<input type="text" name="hid" id="hid" value="{{$user->hid}}" data-placeholder="เลขบัตรประจำตัวประชาชน" class="form-control form-control-lg">
												<small id="hidinvalid" class="form-text text-danger" hidden></small>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>ตำแหน่ง</label>
												<input type="text" name="userposition" value="{{$user->position}}" data-placeholder="ตำแหน่ง" class="form-control form-control-lg">
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
											<input type="text" name="company" value="{{old('company') ?? $user->company->name}}"  class="form-control form-control-lg">
										</div>
									</div>

									@if (Auth::user()->user_type_id <=2)
										<div class="col-md-6">
											<div class="form-group">
												<label>@if (Auth::user()->user_group_id == 1) เลขทะเบียนนิติบุคคล <span class="text-danger">*</span> @else เลขประจำตัวผู้เสียภาษีอากร @endif</label></span><label></label> <span id="msg" class="text-success"></span>
												<input type="number" name="vatno" id="vatno" value="{{old('vatno') ?? $user->companyvatid}}" data-placeholder="หมายเลขผู้เสียภาษีนิติบุคคล" class="form-control form-control-lg" @if ($user->user_group_id == 2) @endif>
											</div>
										</div>
									@endif

									@if ($user->user_group_id == 2)
										<div class="col-md-6">
											<div class="form-group">
												<label>เลขทะเบียนพาณิชย์</label>
												<input type="number"  name="commercialregnumber" value="{{old('commercialregnumber') ?? $user->company->commercialregnumber}}"  placeholder="เลขทะเบียนพาณิชย์" class="form-control form-control-lg" >
											</div>
										</div>
									@endif
									<div class="col-md-6">
										<div class="form-group">
											<label>ปีที่จดทะเบียน@if ($user->user_group_id == 1)<span class="text-danger">*</span> @endif</label>
											<input type="number" name="registeredyear" value="{{old('registeredyear') ?? $user->company->registeredyear}}"  placeholder="ปีที่จดทะเบียน" class="form-control form-control-lg">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>ทุนจดทะเบียน@if ($user->user_group_id == 1)<span class="text-danger">*</span> @endif</label>
											<input type="number" min="0" name="registeredcapital" value="{{old('registeredcapital') ?? $user->company->registeredcapital}}"  placeholder="ทุนจดทะเบียน" class="form-control form-control-lg" >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>ทุนจดทะเบียนที่เรียกชำระแล้ว@if ($user->user_group_id == 1)<span class="text-danger">*</span> @endif</label>
											<input type="number" min="0" name="paidupcapital" value="{{old('paidupcapital') ?? $user->company->paidupcapital}}"  placeholder="ทุนจดทะเบียนที่เรียกชำระแล้ว" class="form-control form-control-lg" >
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
											<input type="text"  name="phone" value="{{$phone}}"  placeholder="โทรศัพท์" class="form-control form-control-lg">
										</div>
									</div>
									<div class="col-md-6">   
										<div class="form-group">
											<label>โทรสาร</label>
											<input type="text"  name="fax" value="{{$user->company->fax}}"  placeholder="โทรสาร" class="form-control form-control-lg">
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
											<input type="text"  name="email" value="{{$email}}"  placeholder="อีเมล" class="form-control form-control-lg">
										</div>
									</div>
									<div class="col-md-6">  
										<div class="form-group">
											<label>เว็บไซต์</label>
											<input type="text"  name="website" value="{{$user->company->website}}"  placeholder="เว็บไซต์" class="form-control form-control-lg">
										</div>
									</div>
									@if ($user->user_group_id == 1)
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
														<input type="text" name="name" value="{{$user->name}}" data-placeholder="ชื่อ"class="form-control form-control-lg">
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>นามสกุลผู้ประสานงาน<span class="text-danger">*</span></label>
												<input type="text" name="lastname" value="{{$user->lastname}}" data-placeholder="นามสกุล" class="form-control form-control-lg">
											</div>
										</div>
									@endif
									{{-- <div class="col-md-12">  
										<legend>
											<label for=""><strong>ที่อยู่</strong> <a href="#" class="text-primary" data-toggle="modal" data-target="#modal_add_address">คลิกเพิ่มที่อยู่อื่น ๆ</a></label>
										</legend>
									</div> --}}


									@php
										$companyaddress = $user->company->companyaddress->first();
									@endphp
										<div class="col-md-6">  
											<div class="form-group">
												<label>@if ($user->user_group_id == 1) ที่อยู่บริษัท @else ที่ตั้งสถานประกอบการ @endif</label><span class="text-danger">*</span>
												<input type="text"  name="address" value="{{old('address') ?? $companyaddress->address}}"  placeholder="" class="form-control form-control-lg">
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
												<input type="text"  name="postalcode" value="{{$companyaddress->postalcode}}"  placeholder="รหัสไปรษณีย์" class="form-control form-control-lg">
											</div>
										</div>
										<div class="col-md-6">  
											<div class="form-group">
												<label>พิกัดละติจูด (เช่น 14.076868486942407)<a href="https://google.com/maps/place/{{$companyaddress->lat}},{{$companyaddress->lng}}" target="_blank" rel="noopener noreferrer"> เปิดแผนที่</a> </label>
												<input type="text"  name="lat" value="{{$companyaddress->lat}}"  placeholder="ละติจูด" class="form-control form-control-lg">
											</div>
										</div>
										<div class="col-md-6">  
											<div class="form-group">
												<label>พิกัดลองจิจูด (เช่น 100.60153839991285)</label>
												<input type="text"  name="lng" value="{{$companyaddress->lng}}"  placeholder="ลองจิจูด" class="form-control form-control-lg">
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
												{{-- <a href="#" class="text-primary" data-toggle="modal" data-target="#modal_add_authorized_director">คลิกเพิ่ม</a> --}}
												<div class="table-responsive">
													<table class="table table-bordered table-striped">
														<thead>
															<tr class="bg-info">
																<th style="width:80%">ชื่อ  นามสกุล</th> 
																{{-- <th style="width:20%">เพิ่มเติม</th>                                                                                    --}}
															</tr>
														</thead>
														<tbody id="authorized_director_wrapper_tr"> 
															@foreach ($authorizeddirectors as $authorizeddirector)
															<tr >                                        
																<td> {{$authorizeddirector->prefix->name}}{{$authorizeddirector->name}} {{$authorizeddirector->lastname}}</td>                                            
																{{-- <td> 
																	<a type="button" data-id="{{$authorizeddirector->id}}" data-name="" class="btn btn-sm bg-danger deleteauthorizeddirector">ลบ</a>                                       
																</td> --}}
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
												<label for="">แนบเอกสารข้อมูลทั่วไป  </label>
											{{-- <a href="#"  id="btnuploadcompanydoc"  class="text-primary" data-toggle="modal" data-target="#modal_add_companydoc">อัปโหลดเอกสารแนบ</a>  --}}
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
																	{{-- <a type="button" data-id="{{$fulltbpcompanydoc->id}}" data-name="" class="btn btn-sm bg-danger deletefulltbpcompanydocattachment">ลบ</a>                                        --}}
																</td>
															</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
										{{-- </div> --}}
									</div>
									{{-- <div class="col-md-6">  
										<div class="form-group">
											<label>โลโก้ (ขนาด 500x500) px</label>
											<div class="input-group">													
												<input type="text" id="filename" class="form-control form-control-lg border-right-0" placeholder="โลโก้"  >											
													<span class="input-group-append">
														<button class="btn bg-info" type="button" onclick="document.getElementById('file').click();">อัปโหลดรูป</button>
													</span>
											</div>
											<input type="file" style="display:none;" id="file" name="picture" accept="image/*"/>
											@if (!Empty($user->company->logo))
											<br>
												<img src="{{asset($user->company->logo)}}" width="300" height="300" alt="">
											@endif
										</div>
										<div class="form-group">
											<a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_signature">ลายมือชื่อ</a>
											<div class="col-md-12">
												<div id='sigdiv'>
													@if (!Empty($user->signature))
													<br>
													<img src="{{asset($user->signature)}}" style="width: 180px;height:45px" alt="">
													@endif
												</div>
											</div>
										</div>
									</div> --}}
									
									{{-- <div class="col-md-12 text-right">
										<button type="submit" name="action" value="personal" class="btn bg-teal">บันทึกข้อมูลส่วนตัว <i class="icon-paperplane ml-2"></i></button>
									</div> --}}
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
		{{-- </form> --}}

    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script type="module" src="{{asset('assets/dashboard/js/app/helper/locationhelper.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/profilehelper.js')}}"></script>
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

