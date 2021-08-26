@extends('layouts.dashboard.main')
@section('pageCss')
	<style>
		.pdfobject-container { 
			height: 100%; 
			width: 100%;
			border: 1rem solid rgba(0,0,0,.1); 
		}
	</style>
@stop
@section('content')

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
									<p>ลงลายมือชื่อ ที่นี่</p>
									  <div class="signature-pad--actions">
										<div>
										  <button type="button" class="btn bg-teal save" data-action="save-png"><i class="icon-floppy-disk mr-2"></i>เพิ่ม</button>
										  <button type="button" class="btn bg-primary" data-action="undo" hidden>ยกเลิก</button>
										  <button type="button" class="btn bg-primary clear" data-action="clear" id="clearpad"><i class="icon-trash-alt mr-2"></i>ล้างข้อมูล</button>
										  
											  
										  <div class="form-group text-center text-muted content-divider mb-2 mt-2">
											<span class="px-2">หรืออัปโหลดลายมือชื่อจากไฟล์</span>
										  </div>
										   <button type="button" class="btn btn-light clear" onclick="document.getElementById('signature').click();"><i class="icon-folder-upload mr-2"></i>อัปโหลด</button>							
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
			</div>
		</div>
	</div>
</div>

    {{-- modal_add_authorized_director --}}
    <div id="modal_add_authorized_director" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ผู้มีอำนาจลงนาม</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{-- <div class="col-md-12"> --}}
							<div class="col-md-6">
								<div class="form-group">
									<label>คำนำหน้าชื่อ<span class="text-danger">*</span></label>
									<select id="directorprefix" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-lg form-control-select2">
										@foreach ($prefixes as $prefix)
											<option value="{{$prefix->id}}" >{{$prefix->name}}</option> 
										@endforeach
									</select>
								</div>
							</div>

							<div class="col-md-6" id="otherprefix_wrapper" hidden>
								<div class="form-group" >
									<label>ระบุคำนำหน้าชื่อ</label><span class="text-danger">*</span>
									<input type="text" id="otherprefix" placeholder="ระบุคำนำหน้าชื่อ" class="form-control form-control-lg stringformat60">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>ชื่อ</label><span class="text-danger">*</span>
									<input type="text" id="directorname" placeholder="ชื่อ" class="form-control form-control-lg stringformat60">
								</div>
							</div>
						

							<div class="col-md-6">
								<div class="form-group">
									<label>นามสกุล</label><span class="text-danger">*</span>
									<input type="text" id="directorlastname" placeholder="นามสกุล" class="form-control form-control-lg stringformat60">
								</div>
							</div>
             
							<div class="col-md-6">
								<div class="form-group">
									<label>ตำแหน่ง</label><span class="text-danger">*</span>
									<select id="directorposition" data-placeholder="ตำแหน่ง" class="form-control form-control-lg form-control-select2">
										<option value=""></option>
										@foreach ($employpositions as $employposition)
											<option value="{{$employposition->id}}" >{{$employposition->name}}</option> 
										@endforeach
									</select>
								</div>
							</div>
						
							<div class="col-md-6" id="otherposition_wrapper" hidden>
								<div class="form-group" >
									<label>ระบุตำแหน่ง</label><span class="text-danger">*</span>
									<input type="text" id="otherposition" placeholder="ระบุ" class="form-control form-control-lg stringformat60">
								</div>
							</div>
						
							<div class="col-md-12">
								
								<div class="form-group">
									<a href="" class="btn btn-sm bg-teal" id="btnaddsig" data-toggle="modal" ><i class="icon-pen2 mr-2"></i>เพิ่มลายมือชื่อ</a>
									<div class="col-md-12">
										<div id='sigdiv'>
										</div>
									</div>
								</div>
							</div>
							
                        </div>
                    {{-- </div> --}}
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_add_authorized_director" class="btn bg-primary" data-id="{{$user->company->id}}" ><i class="icon-spinner spinner mr-2" id="spinicon_director_add" hidden></i><i class="icon-floppy-disk mr-2"></i> บันทึก</button>
                </div>
            </div>
        </div>
	</div>


<div id="modal_edit_authorized_director" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ผู้มีอำนาจลงนาม</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					{{-- <div class="col-md-12"> --}}

						<div class="col-md-6" >
							<input type="text" id="authorized_director_id" hidden>
							<div class="form-group">
								<label>คำนำหน้าชื่อ<span class="text-danger">*</span></label>
								<select id="directorprefix_edit" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-lg form-control-select2">
								</select>
							</div>
						</div>

						<div class="col-md-6" id="otherprefix_edit_wrapper" hidden>
							<div class="form-group" >
								<label>ระบุคำนำหน้าชื่อ</label><span class="text-danger">*</span>
								<input type="text" id="otherprefix_edit" placeholder="ระบุคำนำหน้าชื่อ" class="form-control form-control-lg stringformat60">
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label>ชื่อ</label><span class="text-danger">*</span>
								<input type="text" id="directorname_edit" placeholder="ชื่อ" class="form-control form-control-lg stringformat60">
							</div>
						</div>



						<div class="col-md-6">
							<div class="form-group">
								<label>นามสกุล</label><span class="text-danger">*</span>
								<input type="text" id="directorlastname_edit" placeholder="นามสกุล" class="form-control form-control-lg stringformat60">
							</div>
						</div>

				

						<div class="col-md-6">
							<div class="form-group">
								<label>ตำแหน่ง</label><span class="text-danger">*</span>
								<select id="directorposition_edit" data-placeholder="ตำแหน่ง" class="form-control form-control-lg form-control-select2">
								</select>
							</div>
						</div>

					

						<div class="col-md-6" id="otherposition_edit_wrapper" hidden>

							<div class="form-group" >
								<label>ระบุตำแหน่ง</label><span class="text-danger">*</span>
								<input type="text" id="otherposition_edit" placeholder="ระบุ" class="form-control form-control-lg stringformat60">
							</div>
						</div>


						<div class="col-md-12">
							<div class="form-group">
								<a href="" class="btn btn-sm bg-teal" data-toggle="modal" id="call_model_edit" ><i class="icon-pen2 mr-2"></i>ลายมือชื่อ</a>
								<div class="col-md-12 mt-2">
									<div id='sigdiv_edit'>
										
									</div>
								</div>
							</div>
						</div>




					{{-- </div> --}}
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_edit_authorized_director" class="btn bg-primary" data-dismiss="modal"><i class="icon-spinner spinner mr-2" id="spinicon_director_edit" hidden></i><i class="icon-floppy-disk mr-2"></i> บันทึก</button>
			</div>
		</div>
	</div>
</div>

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">แบบคำขอรับบริการประเมิน TTRS (Mini TBP)</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
			<div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    {{-- <div class="form-check ">
                        <input type="checkbox" id="chkassessment" data-id="{{$company->id}}" data-on-color="success" data-off-color="danger" data-on-text="ประเมิน" data-off-text="ไม่ประเมิน" class="form-check-input-switch" @if (!Empty($company->businessplan)) checked @endif >
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>โครงการ</a>
                    <span class="breadcrumb-item active">แบบคำขอรับบริการประเมิน</span>
                </div>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
	</div>
	
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

    <!-- /page header -->

    <!-- Content area -->
    <div class="content">
        {{-- @if (Session::has('success'))
            <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                {{ Session::get('success') }}
            </div>
        @elseif --}}
		@if( Session::has('error') )
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
        <div class="row">
            <div class="col-md-12">
				<!-- Colors -->
            	<div class="card border-top-info rounded-top-0">
                	<div class="card-body">
						<form id="frmminitbp" method="POST" class="wizard-form step-minitbp" action="" data-fouc>
							@csrf
							<h6>ผู้ยื่นแบบคำขอ</h6>
							<fieldset>
								<div class="row">
									<input type="text" id="companyid" value="{{$user->company->id}}" hidden>
									<input type="text" id="pdfname" hidden>
									<legend>
										<label style="font-size: 16px"><strong>ข้อมูลบริษัท</strong></label>
									</legend>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ชื่อบริษัท<span class="text-danger">*</span></label>
											<input type="text" name ="companyname" id ="companyname" value="{{old('companyname') ?? $minitbp->businessplan->company->name}}" class="form-control form-control-lg required" >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ที่อยู่บริษัท<span class="text-danger">*</span></label>
											<input type="text" name ="address" id ="address" value="{{$user->company->companyaddress->first()->address}}" class="form-control form-control-lg required" >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>จังหวัด<span class="text-danger">*</span></label>
											<select name="province" id="province" data-placeholder="จังหวัด" class="form-control form-control-lg form-control-select2 required">
												<option value=""></option>
												@foreach ($provinces as $province)
													<option value="{{$province->id}}" @if($user->company->companyaddress->first()->province_id == $province->id) selected @endif>{{$province->name}}</option> 
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>อำเภอ/เขต<span class="text-danger">*</span></label>
											<select name="amphur" id="amphur" data-placeholder="อำเภอ" class="form-control form-control-lg form-control-select2 required">
												@foreach ($amphurs as $amphur)                                                                
													<option value="{{$amphur->id}}" @if ($user->company->companyaddress->first()->amphur_id == $amphur->id) selected @endif> {{$amphur->name}} </option>
												@endforeach   
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>ตำบล/แขวง<span class="text-danger">*</span></label>
											<select name="tambol" id="tambol" data-placeholder="ตำบล" class="form-control form-control-lg form-control-select2 required">
												@foreach ($tambols as $tambol)                                                                
													<option value="{{$tambol->id}}" @if ($user->company->companyaddress->first()->tambol_id == $tambol->id) selected @endif> {{$tambol->name}} </option>
												@endforeach    
											</select>
										</div>
									</div>
									<div class="col-md-6">  
										<div class="form-group">
											<label>รหัสไปรษณีย์<span class="text-danger">*</span></label>
											<input type="text" name="postalcode" id="postalcode" value="{{$user->company->companyaddress->first()->postalcode}}"  placeholder="รหัสไปรษณีย์" class="form-control form-control-lg required numeralformatpostal" >
											<span id="postalcode_format_error" class="form-text text-danger" hidden><i class="icon-cancel-circle2 text-danger"></i> รหัสไปรษณีย์ไม่ถูกต้อง</span>
										</div>
									</div>
									<legend>
										<label style="font-size: 16px"><strong >ข้อมูลผู้ยื่นแบบคำขอ</strong></label>
									</legend>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">คำนำหน้าชื่อ<span class="text-danger">*</span></label>
											<select name="contactprefix" id="contactprefix" class="form-control form-control-lg form-control-select2 required">
												@foreach ($contactprefixes as $contactprefix)
													<option value="{{$contactprefix->id}}" 
														@if ($minitbp->contactprefix != 0)
																@if($minitbp->contactprefix == $contactprefix->id) 
																	selected 
																@endif 
															@else
																@if($user->prefix_id == $contactprefix->id) 
																	selected 
																@endif 
														@endif

														>{{$contactprefix->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ชื่อ<span class="text-danger">*</span></label>
											@php
											       $position = "ผู้ประสานงาน";
													$name = $user->name;
													$lastname = $user->lastname;
												if($user->user_group_id == 1){ //นิติบุคคล
													if(!Empty($minitbp->contactposition)){
														$position = $minitbp->contactposition;
													}
												}else{ //บุคคลธรรมดา
													$position = $user->position;
													// if(!Empty($minitbp->contactposition)){
													// 	$position = $minitbp->contactposition;
													// }
												}
												if(!Empty($minitbp->contactname) || !Empty($minitbp->contactlastname) ){
														$name = $minitbp->contactname;
														$lastname = $minitbp->contactlastname;
												}
												// echo($minitbp->contactposition);
											@endphp
											<input type="text" name ="contactname" id ="contactname" value="{{$name}}" class="form-control form-control-lg stringformat60 required" >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">นามสกุล<span class="text-danger">*</span></label>
											<input type="text" name ="contactlastname" id ="contactlastname" value="{{$lastname}}" class="form-control form-control-lg stringformat60 required" >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ตำแหน่ง</label>
											<input type="text" name ="contactposition" id="contactposition" value="{{$position}}" class="form-control form-control-lg stringformat60" >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">เบอร์โทรศัพท์<span class="text-danger">*</span></label>
											@php
												$phone = $minitbp->contactphone;
												if(Empty($minitbp->contactphone)){
													$phone = Auth::user()->phone;
												}
											@endphp
											<input type="text" name ="contactphone" id ="contactphone" value="{{old('contactphone') ?? $phone}}" class="form-control form-control-lg required numeralformathphone">
											<span id="contactphone_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> เบอร์โทรศัพท์ไม่ถูกต้อง</span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">อีเมล<span class="text-danger">*</span></label>
											@php
												$email = $minitbp->contactemail;
												if(Empty($minitbp->contactemail)){
													$email = Auth::user()->email;
												}
											@endphp
											<input type="email" name ="contactemail" id ="contactemail" value="{{old('contactemail') ?? $email}}" class="form-control form-control-lg required">
											<span id="contactemail_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> รูปแบบอีเมลไม่ถูกต้อง</span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">เว็บไซต์</label>
											<input type="text" name ="website" id ="website" value="{{$company->website ?? $minitbp->website}}" class="form-control form-control-lg" >
										</div>
									</div>
								</div>
							</fieldset>
							<h6>ข้อมูล Mini TBP</h6>
							<fieldset>
								<div class="row">	
									<input type="text" id="minitbpid" value="{{$minitbp->id}}" hidden>
									<div class="col-md-6">
										<fieldset>	
											<div class="form-group">
												<label>ชื่อโครงการ/เทคโนโลยี<span class="text-danger">*</span></label>
												<input type="text" id="project" name="project" value="{{old('project') ?? $minitbp->project}}" placeholder="ชื่อโครงการ/เทคโนโลยี" class="form-control form-control-lg stringformat60 required" >
											</div>
										</fieldset>
									</div>
									<div class="col-md-6">
										<fieldset>	
											<div class="form-group">
												<label>ชื่อโครงการ/เทคโนโลยี ภาษาอังกฤษ (ถ้ามี)</label>
												<input type="text" id="projecteng" name="projecteng" value="{{old('projecteng') ?? $minitbp->projecteng}}" placeholder="ชื่อโครงการ/เทคโนโลยี ภาษาอังกฤษ" class="form-control form-control-lg stringformat60">
											</div>
										</fieldset>
									</div>
								</div>
								<div class="row">
									<legend>
										<label style="font-size: 16px"><strong>วัตถุประสงค์ของการยื่นขอรับบริการประเมิน TTRS (สามารถเลือกได้มากกว่า 1 ข้อ)</strong></label>
										<span id="noneselect" class="form-text text-danger" style="font-size: 16px" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณาเลือกวัตถุประสงค์อย่างน้อย 1 ข้อ</span>
									</legend>
									<div class="col-md-12">
										<div class="form-group mb-3 mb-md-2">
											<label class="font-weight-semibold"><u>สิทธิประโยชน์ทางการเงิน (Finance)</u></label>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" name="finance1"  id="finance1" class="form-check-input-styled-primary" @if (!Empty($minitbp->finance1)) checked @endif data-fouc>
																ขอสินเชื่อกับธนาคาร (สามารถเลือกได้มากกว่า 1 รายการ)
															</label>
															<div class="row" id="financediv1" style="margin-top: 5px" @if (Empty($minitbp->thai_bank_id) || Empty($minitbp->finance1)) hidden @endif >
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="">เลือกธนาคาร</label>
																		<select name="bank" id="bank" class="form-control form-control-lg form-control-select2">
																			<option value="0">=== โปรดเลือกธนาคาร ===</option>
																			@foreach ($banks as $bank)
																				<option value="{{$bank->id}}" @if($minitbp->thai_bank_id == $bank->id) selected @endif >{{$bank->name}}</option>
																			@endforeach
																		</select>
																	</div>
																	@if (@$minitbp->bank == 'อื่นๆ โปรดระบุ')
																			<input type="text" name="otherbank" id="otherbank" value="{{$minitbp->otherbank}}" placeholder="ระบุชื่อธนาคาร" class="form-control form-control-lg stringformat40" >
																		@else
																			<input type="text" name="otherbank" id="otherbank" value="{{$minitbp->otherbank}}" placeholder="ระบุชื่อธนาคาร" class="form-control form-control-lg stringformat40" hidden >
																	@endif
																	
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="">มูลค่าเงินลงทุนที่ต้องการ</label>
																		<input type="text" name="finance1loan" id="finance1loan" value="{{old('finance1loan') ?? $minitbp->finance1_loan}}" class="form-control form-control-lg numeralformat10" >
																	</div>
																</div>
																<div class="col-md-6 mt-2">
																	<div class="form-group">
																		<label for="">เลือกธนาคาร</label>
																		<select name="bank1" id="bank1" class="form-control form-control-lg form-control-select2">
																			<option value="0">=== โปรดเลือกธนาคาร ===</option>
																			@foreach ($banks as $bank)
																				<option value="{{$bank->id}}" @if($minitbp->thai_bank_1_id == $bank->id) selected @endif >{{$bank->name}}</option>
																			@endforeach
																		</select>
																	</div>
																	@if (@$minitbp->bank1 == 'อื่นๆ โปรดระบุ')
																			<input type="text" name="otherbank1" id="otherbank1" value="{{$minitbp->otherbank1}}" placeholder="ระบุชื่อธนาคาร" class="form-control form-control-lg stringformat40" >
																		@else
																			<input type="text" name="otherbank1" id="otherbank1" value="{{$minitbp->otherbank1}}" placeholder="ระบุชื่อธนาคาร" class="form-control form-control-lg stringformat40" hidden >
																	@endif
																	
																</div>
																<div class="col-md-6 mt-2">
																	<div class="form-group">
																		<label for="">มูลค่าเงินลงทุนที่ต้องการ</label>
																		<input type="text" name="finance1_1_loan" id="finance1_1_loan" value="{{old('finance1_1_loan') ?? $minitbp->finance1_1_loan}}" class="form-control form-control-lg numeralformat10" >
																	</div>
																</div>


																<div class="col-md-6 mt-2">
																	<div class="form-group">
																		<label for="">เลือกธนาคาร</label>
																		<select name="bank2" id="bank2" class="form-control form-control-lg form-control-select2">
																			<option value="0">=== โปรดเลือกธนาคาร ===</option>
																			@foreach ($banks as $bank)
																				<option value="{{$bank->id}}" @if($minitbp->thai_bank_2_id == $bank->id) selected @endif >{{$bank->name}}</option>
																			@endforeach
																		</select>
																	</div>
																	@if (@$minitbp->bank2 == 'อื่นๆ โปรดระบุ')
																			<input type="text" name="otherbank2" id="otherbank2" value="{{$minitbp->otherbank2}}" placeholder="ระบุชื่อธนาคาร" class="form-control form-control-lg stringformat40" >
																		@else
																			<input type="text" name="otherbank2" id="otherbank2" value="{{$minitbp->otherbank2}}" placeholder="ระบุชื่อธนาคาร" class="form-control form-control-lg stringformat40" hidden >
																	@endif
																	
																</div>
																<div class="col-md-6 mt-2">
																	<div class="form-group">
																		<label for="">มูลค่าเงินลงทุนที่ต้องการ</label>
																		<input type="text" name="finance1_2_loan" id="finance1_2_loan" value="{{old('finance1_2_loan') ?? $minitbp->finance1_2_loan}}" class="form-control form-control-lg numeralformat10" >
																	</div>
																</div>
																
															</div>	
														</div>
													</div>
													<div class="form-group">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" name="finance2" id="finance2" class="form-check-input-styled-primary" @if (!Empty($minitbp->finance2)) checked @endif  data-fouc>
																ขอรับการค้ำประกันสินเชื่อฯ บสย. (บรรษัทประกันสินเชื่ออุตสาหกรรมขนาดย่อม)
															</label>														
														</div>
													</div>

													<div class="form-group">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" id="finance3_other" name="finance3_other" class="form-check-input-styled-primary" @if (!Empty($minitbp->finance3_other)) checked @endif data-fouc>
																อื่นๆ โปรดระบุ
															</label>
															<div class="row" id="finance3_other_div" style="margin-top: 5px"  @if (Empty($minitbp->finance3_other_detail) || Empty($minitbp->finance3_other) ) hidden @endif>
																<div class="col-md-6">
																	<div class="form-group">
																		{{-- <label for="">โปรดระบุ</label> --}}
																		<input type="text" name="finance3_other_detail" id="finance3_other_detail" class="form-control form-control-lg stringformat30"  value="{{old('finance3_other_detail') ?? $minitbp->finance3_other_detail}}">
																	</div>
																</div>
															</div>
														</div>
													</div>


													{{-- <div class="form-group">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" name="finance3" id="finance3" class="form-check-input-styled-primary" @if (!Empty($minitbp->finance3)) checked @endif data-fouc>
																โครงการเงินกู้ดอกเบี้ยต่ำ (สวทช.)
															</label>
														</div>
													</div>
													<div class="form-group">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" name="finance4" id="finance4" class="form-check-input-styled-primary" @if (!Empty($minitbp->finance4)) checked @endif data-fouc>
																บริษัทร่วมทุน (สวทช.)
															</label>
															<div class="row" id="financediv2" style="margin-top: 5px" @if (Empty($minitbp->finance4_joint_min) || Empty($minitbp->finance4)) hidden @endif >
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="">มูลค่าเงินลงทุนที่ต้องการ</label>
																		<input type="text" name ="finance4joint" id="finance4joint" class="form-control form-control-lg numeralformat10" value="{{old('finance4joint') ?? $minitbp->finance4_joint}}">
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="">สัดส่วนการลงทุนของบริษัทและผู้ถือหุ้นอื่น %</label>
																		<input type="text" name="finance4jointmin" id="finance4jointmin" class="form-control form-control-lg numeralformat2" value="{{old('finance4jointmin') ?? $minitbp->finance4_joint_min}}">
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="">สัดส่วนการลงทุนของ สวทช. %</label>
																		<input type="text" name="finance4jointmax" id="finance4jointmax" class="form-control form-control-lg numeralformat2" value="{{old('finance4jointmax') ?? $minitbp->finance4_joint_max}} readonly">
																	</div>
																</div>
															</div>
														</div>
													</div> --}}
												</div>
											</div>
										</div>
									</div>
								</div>
								{{-- <hr> --}}
								<div class="row mt-2">
									<div class="col-md-12">
										<div class="form-group mb-3 mb-md-2">
											<label class="font-weight-semibold"><u>สิทธิประโยชน์ที่ไม่ใช่การเงิน (Non-Finance)</u></label>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" name="nonefinance1" id="nonefinance1" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance1)) checked @endif data-fouc>
																ที่ปรึกษาด้านเทคโนโลยี/เทคนิค
															</label>
														</div>
													</div>
													<div class="form-group">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" name="nonefinance2" id="nonefinance2" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance2)) checked @endif data-fouc>
																ที่ปรึกษาด้านการตลาด
															</label>
														</div>
													</div>
													<div class="form-group">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" name="nonefinance3" id="nonefinance3" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance3)) checked @endif data-fouc>
																ที่ปรึกษาด้านการเงิน
															</label>
														</div>
													</div>
												</div>
	
												<div class="col-md-6">
													{{-- <div class="form-group">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" name="nonefinance4" id="nonefinance4" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance4)) checked @endif data-fouc>
																ที่ปรึกษาทางด้านเทคนิค/ด้านธุรกิจ
															</label>
														</div>
													</div> --}}
													<div class="form-group">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" name="nonefinance5" id="nonefinance5" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance5)) checked @endif data-fouc >
																โครงการสนับสนุนผู้ประกอบการภาครัฐ โปรดระบุ
															</label>
															<div class="row" id="nonefinancediv1" style="margin-top: 5px" @if (Empty($minitbp->nonefinance5_detail) || Empty($minitbp->nonefinance5)) hidden @endif>
																<div class="col-md-12">
																	<div class="form-group">
																		{{-- <label for="">โปรดระบุ</label> --}}
																		<input type="text" name ="nonefinance5detail" id ="nonefinance5detail" class="form-control form-control-lg stringformat45" value="{{old('nonefinance5detail') ?? $minitbp->nonefinance5_detail}}">
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" id="nonefinance6" name="nonefinance6" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance6)) checked @endif data-fouc>
																อื่นๆ โปรดระบุ
															</label>
															<div class="row" id="nonefinancediv2" style="margin-top: 5px"  @if (Empty($minitbp->nonefinance6_detail) || Empty($minitbp->nonefinance6) ) hidden @endif>
																<div class="col-md-12">
																	<div class="form-group">
																		{{-- <label for="">โปรดระบุ</label> --}}
																		<input type="text" name="nonefinance6detail" id="nonefinance6detail" class="form-control form-control-lg stringformat45" value="{{old('nonefinance6detail') ?? $minitbp->nonefinance6_detail}}">
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
							<h6>ข้อมูลผู้ลงนาม</h6>
							<fieldset>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											{{-- <div class="col-md-12" > --}}
												<input type="text" id="authorizeddirectorid" hidden>
												<div class="table-responsive">
													<table class="table table-bordered table-striped">
														<thead>
															<tr class="bg-info">
																<th style="width:50%">เลือกผู้ลงนามในแบบคำขอรับบริการประเมิน TTRS (Mini TBP)</th>
																<th style="width:15%">ลายมือชื่อ</th> 
																<th style="width:30%">ตำแหน่ง</th>
															</tr>
														</thead>
														<tbody id="authorized_director_wrapper_tr"> 
															@foreach ($authorizeddirectors as $authorizeddirector)
																<tr >      
																	<td>
																		<div class="form-check">
																			<label class="form-check-label">
																				@if (Empty($authorizeddirector->signature_id))
																						@if ($authorizeddirector->IsSelectDirector($minitbp->id) == 1)
																							<input type="checkbox" id="auth{{$authorizeddirector->id}}" data-id="1" value="{{$authorizeddirector->id}}" class="form-check-input-styled chkauthorizeddirector" data-fouc checked>
																							@else
																							<input type="checkbox" id="auth{{$authorizeddirector->id}}" data-id="1" value="{{$authorizeddirector->id}}" class="form-check-input-styled chkauthorizeddirector" data-fouc >
																						@endif
																					@else
																						@if ($authorizeddirector->IsSelectDirector($minitbp->id) == 1)
																							<input type="checkbox" id="auth{{$authorizeddirector->id}}" data-id="2" value="{{$authorizeddirector->id}}" class="form-check-input-styled chkauthorizeddirector" data-fouc checked>
																							@else
																							<input type="checkbox" id="auth{{$authorizeddirector->id}}" data-id="2" value="{{$authorizeddirector->id}}" class="form-check-input-styled chkauthorizeddirector" data-fouc >
																						@endif
																				@endif

																				{{-- @if ($authorizeddirector->IsSelectDirector($minitbp->id) == 1)
																						<input type="checkbox" data-id="1" value="{{$authorizeddirector->id}}" class="form-check-input-styled chkauthorizeddirector" data-fouc checked>
																					@else
																						<input type="checkbox" data-id="2" value="{{$authorizeddirector->id}}" class="form-check-input-styled chkauthorizeddirector" data-fouc >
																				@endif --}}
																				
																				@if ($authorizeddirector->prefix->name == 'อื่นๆ')
																						{{$authorizeddirector->otherprefix}}{{$authorizeddirector->name}} {{$authorizeddirector->lastname}}
																					@else
																						{{$authorizeddirector->prefix->name}}{{$authorizeddirector->name}} {{$authorizeddirector->lastname}}
																				@endif
																				
																			</label>
																		</div>
																	</td>  
																	<td>
																	@if (Empty($authorizeddirector->signature_id))
																			<span id="edit{{$authorizeddirector->id}}"><button type="button" data-id="{{$authorizeddirector->id}}" class="btn btn-sm bg-warning btnaddsig">ไม่พบลายมือชื่อ</button></span>
																			{{-- <span id="sig{{$authorizeddirector->id}}" class="badge badge-flat border-warning text-warning">ไม่พบลายมือชื่อ</span> --}}
																		@else
																			<span class="badge badge-flat border-success text-success">มีลายมือชื่อแล้ว</span>
																	@endif
																	</td>                                
																	
																	<td> 
																		@if ($authorizeddirector->employposition->name == 'อื่นๆ')
																				{{$authorizeddirector->otherposition}}
																			@else
																				{{$authorizeddirector->employposition->name}}
																		@endif
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
										<div class="form-group">
											<label for="">ลายมือชื่ออิเล็กทรอนิกส์<span class="text-danger">*</span></label>
											<select name="signature" id="usersignature" value="{{$minitbp->signature_status_id}}" id="" class="form-control form-control-lg form-control-select2">
												<option value="0">โปรดเลือก</option>
												@foreach ($signaturestatuses as $signaturestatus)
													<option value="{{$signaturestatus->id}}" @if($minitbp->signature_status_id == $signaturestatus->id) selected @endif >{{$signaturestatus->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</fieldset>
								<h6>เสร็จสิ้น</h6>
								<fieldset>
									<div class="col-md-12">
										<div class="form-group">
											<div style="width:100%;height:600px;" class="col-md-12 center"  >
												<div id="example1"></div>
											</div>
											<input type="file" style="display:none;" id="minitbppdf" accept="image/jpeg,image/gif,image/png,application/pdf"/>
										</div>
									</div>
									<div class="col-md-12 " id="appceptagreement_wrapper">
										<div class="form-group float-right">
											<div class="form-check">
												<label class="form-check-label">
													<input type="checkbox" name="appceptagreement"  id="appceptagreement" class="form-check-input-styled-primary"  data-fouc>
													ข้าพเจ้าขอรับรองว่าข้อมูลทั้งหมดเป็นความจริงทุกประการ
												</label>
											</div>
										</div>
									</div>

								</fieldset>
						</form>

					</div>
				</div>
            </div>
        </div>
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/minitbphelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/forms/wizards/steps.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/forms/validation/validate.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/signaturepad/signature_pad.umd.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/signaturepad/signaturecontrol_edit.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/pdfobject/pdfobject.min.js')}}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.5/pdfobject.min.js"></script> --}}
<script type="module" src="{{asset('assets/dashboard/js/app/helper/locationhelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/inputformat.js')}}"></script>

<script>
	var route = {
		url: "{{ url('/') }}",
		token: $('meta[name="csrf-token"]').attr('content'),
		branchid: "{{Auth::user()->branch_id}}"
	};
	var submitstatus = "{{$minitbp->businessplan->business_plan_status_id}}";
	var refixstatus = "{{$minitbp->refixstatus}}";
	var usermessage = '';

	if(submitstatus == 2 || refixstatus == 1 ){ 
			$('.form-control-lg').prop("disabled", false);  
	}else{
		$('.form-check-input-styled').prop("disabled", true);
		$('.form-check-input-styled-primary').prop("disabled", true);
		$('.form-control-lg').prop("disabled", true);
	}

	var form = $('.step-minitbp').show();
	$('.step-minitbp').steps({
		headerTag: 'h6',
		bodyTag: 'fieldset',
		transitionEffect: 'fade',
		titleTemplate: '<span class="number">#index#</span> #title#',
		labels: {
			previous: '<i class="icon-arrow-left13 mr-2" /> ก่อนหน้า',
			next: 'ต่อไป <i class="icon-arrow-right14 ml-2" />',
			finish: 'บันทึก <i class="icon-arrow-right14 ml-2" />'
		},
		enableFinishButton: false,
		onFinished: function (event, currentIndex) {
			$("#frmminitbp").submit();
		},
		transitionEffect: 'fade',
		autoFocus: true,
		onStepChanging: function (event, currentIndex, newIndex) {
			if (currentIndex > newIndex) {
				return true;
			}
			if (currentIndex < newIndex) {
				form.find('.body:eq(' + newIndex + ') label.error').remove();
				form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
			}
			if(newIndex == 3){
				if($('#usersignature').val() == 0){
					Swal.fire({
						title: 'ผิดพลาด!',
						text: 'กรุณาเลือกการใช้ลายมือชื่ออิเล็กทรอนิกส์',
					});
					return false;
				}
			}
			if(newIndex == 1){
				if($("#contactphone").val().length < 9 || $("#contactphone").val().length > 10){
					$("#contactphone_error").attr("hidden",false);
					return false;
				}else{
					$("#contactphone_error").attr("hidden",true);
				}
			}	

			if(newIndex == 2){
				//finance3_other_div
				if($("#finance1").is(":checked") == false && $("#finance2").is(":checked") == false && $("#finance3_other").is(":checked") == false
				&& $("#nonefinance1").is(":checked") == false && $("#nonefinance2").is(":checked") == false && $("#nonefinance3").is(":checked") == false 
				&& $("#nonefinance5").is(":checked") == false && $("#nonefinance6").is(":checked") == false){
					$("#noneselect").attr("hidden",false);
					return false;
				}else{
					$("#noneselect").attr("hidden",true);
				}
				if($("#finance1").is(":checked") == true){
					if($('#bank').val() == 0 && $('#bank1').val() == 0 && $('#bank2').val() == 0){
						Swal.fire({
							title: 'ผิดพลาด!',
							text: 'กรุณาเลือกธนาคาร',
						});
						return false;
					}
				}
			}

			if(currentIndex == 2){
				if($('.chkauthorizeddirector').filter(':checked').length == 0){
					Swal.fire({
						title: 'ผิดพลาด!',
						text: 'ยังไม่ได้เลือกผู้ลงนามในแบบคำขอรับบริการประเมิน',
					});
        			return false; 
				}else{
					if($('#usersignature').val() == 2){
						var iserror = false;
						$(".chkauthorizeddirector:checked").each(function(){
							if($(this).data('id') == 1){
								iserror = true;
							}
						});
						if(iserror == true ){
							Swal.fire({
									title: 'ผิดพลาด!',
									text: 'มีผู้ลงนามที่ยังไม่ได้เพิ่มลายมือชื่อ',
								})

							return false;
						}
					}
				}
			}
			form.validate().settings.ignore = ':disabled,:hidden';
			return form.valid();
		},
		onFinishing: function (event, currentIndex) {
			form.validate().settings.ignore = ':disabled';
			return form.valid();
		},
		onStepChanged:function (event, currentIndex, newIndex) {
			if(currentIndex == 1){
				updateCompanyAddress($('#companyid').val(),$('#companyname').val(),$('#address').val(),$('#province').val(),$('#amphur').val(),$('#tambol').val(),$('#postalcode').val()).then(data => {

					})
				.catch(error => {})
			}

			if(currentIndex == 3){
				var hidden = '';
				if(submitstatus !=2 && (refixstatus == 0 || refixstatus == 2 )){
					hidden = 'hidden';
					$("#appceptagreement_wrapper").attr("hidden",true);
				}
				$(document).find(".actions ul").append(`
					<li class='libtn'><a href='#' id='downloadpdf' class='btn btn-primary' target="_blank"> ดาวน์โหลด <i class='icon-download4 ml-2' /></a></li>
					<li class='libtn' ${hidden}><a  id='submitminitbp' class='btn bg-teal' ><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i>ส่งแบบคำขอฯ<i class='icon-paperplane ml-2' /></a></li>
				`);
				var selected_director = [];
					$(".chkauthorizeddirector:checked").each(function(){
						selected_director.push($(this).val());
				});
				if((submitstatus == 2 && refixstatus == 0) || (submitstatus == 3 && refixstatus == 1) ){
					$("#submitminitbp").attr("hidden",true);
					var formData = new FormData();
					formData.append('id',$('#minitbpid').val());
					formData.append('project',$('#project').val());
					formData.append('projecteng',$('#projecteng').val());
					formData.append('finance1',$('#finance1').is(':checked') === true ? '1' : '');
					
					formData.append('bank',$('#bank').val());
					formData.append('bank1',$('#bank1').val());
					formData.append('bank2',$('#bank2').val());
					formData.append('finance1loan',$('#finance1loan').val().replace(/,/g, ''));
					formData.append('finance1_1_loan',$('#finance1_1_loan').val().replace(/,/g, ''));
					formData.append('finance1_2_loan',$('#finance1_2_loan').val().replace(/,/g, ''));

			
					formData.append('finance2',$('#finance2').is(':checked') === true ? '1' : '');
					formData.append('finance3_other',$('#finance3_other').is(':checked') === true ? '1' : '');
					formData.append('finance3_other_detail',$('#finance3_other_detail').val());
					// formData.append('finance4',$('#finance4').is(':checked') === true ? '1' : '');
					// formData.append('finance4joint',$('#finance4joint').val().replace(/,/g, ''));
					// formData.append('finance4jointmin',$('#finance4jointmin').val().replace(/,/g, ''));
					// formData.append('finance4jointmax',$('#finance4jointmax').val().replace(/,/g, ''));
					formData.append('nonefinance1',$('#nonefinance1').is(':checked') === true ? '1' : '');
					formData.append('nonefinance2',$('#nonefinance2').is(':checked') === true ? '1' : '');
					formData.append('nonefinance3',$('#nonefinance3').is(':checked') === true ? '1' : '');
					// formData.append('nonefinance4',$('#nonefinance4').is(':checked') === true ? '1' : '');
					formData.append('nonefinance5',$('#nonefinance5').is(':checked') === true ? '1' : '');
					formData.append('nonefinance5detail',$('#nonefinance5detail').val());
					formData.append('nonefinance6',$('#nonefinance6').is(':checked') === true ? '1' : '');
					formData.append('nonefinance6detail',$('#nonefinance6detail').val());
					formData.append('companyname',$('#companyname').val());
					formData.append('address',$('#address').val());
					formData.append('province',$('#province').val());
					formData.append('amphur',$('#amphur').val());
					formData.append('tambol',$('#tambol').val());
					formData.append('postalcode',$('#postalcode').val());
					formData.append('contactprefix',$('#contactprefix').val());
					formData.append('contactname',$('#contactname').val());
					formData.append('contactlastname',$('#contactlastname').val());
					formData.append('contactposition',$('#contactposition').val());
					formData.append('contactphone',$('#contactphone').val());
					formData.append('contactemail',$('#contactemail').val());
					formData.append('website',$('#website').val());
					formData.append('managerprefix',$('#managerprefix').val());
					formData.append('managername',$('#managername').val());
					formData.append('managerlastname',$('#managerlastname').val());
					formData.append('managerposition',$('#managerposition').val());
					formData.append('signature',$('#usersignature').val());	
					formData.append('director', JSON.stringify(selected_director));	
					formData.append('otherbank',$('#otherbank').val());	
					formData.append('otherbank1',$('#otherbank1').val());	
					formData.append('otherbank2',$('#otherbank2').val());	
					
					$.ajax({
						url: `${route.url}/api/minitbp/editsave`,  //Server script to process data
						type: 'POST',
						headers: {"X-CSRF-TOKEN":route.token},
						data: formData,
						contentType: false,
						processData: false,
						success: function(data){
							createPdf($('#minitbpid').val()).then(data => {
								var pdfpath = route.url + '/'+ data;
								var url = pdfpath;
								$('#downloadpdf').attr('href', url);
								$('#pdfname').val(data);
								PDFObject.embed(pdfpath, "#example1");
								$("#submitminitbp").attr("hidden",false);
							}).catch(error => {})
						}
					});
				}else{	
					var pdfpath = "{{url('/')}}" + '/'+ "{{$minitbp->attachment}}";
					$('#pdfname').val("{{$minitbp->attachment}}");
					PDFObject.embed(pdfpath, "#example1");
					$('#downloadpdf').attr('href', pdfpath);
					$("#submitminitbp").attr("hidden",false);
				}
			
			}else{
				$(".actions").find(".libtn").remove();
			}
		return true;
		},
		
	});

	// Initialize validation
	$('.step-minitbp').validate({
	    ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
	    errorClass: 'validation-invalid-label',
	    highlight: function(element, errorClass) {
	        $(element).removeClass(errorClass);
	    },
	    unhighlight: function(element, errorClass) {
	        $(element).removeClass(errorClass);
	    },

	    // Different components require proper error label placement
	    errorPlacement: function(error, element) {

	        // Unstyled checkboxes, radios
	        if (element.parents().hasClass('form-check')) {
	            error.appendTo( element.parents('.form-check').parent() );
	        }

	        // Input with icons and Select2
	        else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
	            error.appendTo( element.parent() );
	        }

	        // Input group, styled file input
	        else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
	            error.appendTo( element.parent().parent() );
	        }

	        // Other elements
	        else {
	            error.insertAfter(element);
	        }
	    },
	    rules: {
	        email: {
	            email: true
	        },
			finance1loan: {
				required: function(element){
					return $('#finance1').is(':checked') === true;
				}
			},
			finance3_other_detail: {
				required: function(element){
					return $('#finance3_other').is(':checked') === true;
				}
			},
			// finance4jointmin: {
			// 	required: function(element){
			// 		return $('#finance4').is(':checked') === true;
			// 	}
			// },
			// finance4jointmax: {
			// 	required: function(element){
			// 		return $('#finance4').is(':checked') === true;
			// 	}
			// },
			nonefinance5detail: {
				required: function(element){
					return $('#nonefinance5').is(':checked') === true;
				}
			},
			nonefinance6detail: {
				required: function(element){
					return $('#nonefinance6').is(':checked') === true;
				}
			}
	    },
		messages: {
			project: {
				required: 'กรุณากรอกชื่อโครงการ'
			},			
			finance1loan: {
				required: 'กรุณากรอกมูลค่าเงินลงทุนที่ต้องการ'
			},			
			finance3_other_detail: {
				required: 'กรุณาระบุรายละเอียด'
			},			
			// finance4jointmin: {
			// 	required: 'กรุณากรอกสัดส่วนลงทุน บริษัท %'
			// },			
			// finance4jointmax: {
			// 	required: 'กรุณากรอกสวทช. %'
			// },			
			nonefinance5detail: {
				required: 'กรุณาระบุรายละเอียด'
			},			
			nonefinance6detail: {
				required: 'กรุณาระบุรายละเอียด'
			},			
			companyname: {
				required: 'กรุณากรอกชื่อบริษัท'
			},			
			address: {
				required: 'กรุณากรอกที่อยู่บริษัท'
			},			
			postalcode: {
				required: 'กรุณากรอกรหัสไปรษณีย์'
			},			
			contactname: {
				required: 'กรุณากรอกชื่อ'
			},			
			contactlastname: {
				required: 'กรุณากรอกนามสกุล'
			},						
			contactemail: {
				required: 'กรุณากรอกอีเมล'
			}
		}
	});

	
	$(".btnaddsig").on('click', function() {
		signaturePad.clear();
		$('#authorizeddirectorid').val($(this).data('id'));
		$('#modal_signature').modal('show');
	});

	// $(".chkauthorizeddirector").on('change', function() {
	// 	if($('.chkauthorizeddirector').filter(':checked').length > 3){
	// 		$(this).prop('checked', false);
	// 		Swal.fire({
	// 			title: 'ผิดพลาด!',
	// 			text: 'เลือกผู้ลงนามได้ไม่เกิน 3 คน',
	// 		});
	// 	}
	// });

	$("#finance4jointmin").on('keyup', function() {
		$("#finance4jointmax").val(100-$("#finance4jointmin").val());
	});

	function createPdf(id){
		return new Promise((resolve, reject) => {
			$.ajax({
				url: `${route.url}/api/minitbp/createpdf`,
				type: 'POST',
				headers: {"X-CSRF-TOKEN":route.token},
				data: {
				id : id
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

	$(document).on('click', '#submitminitbp', function(e) {
		if($('#appceptagreement').is(':checked') === false){
			Swal.fire({
				title: 'ผิดพลาด',
				type: 'warning',
				html: 'โปรดทำเครื่องหมาย <i class="icon-checkbox-checked"></i> เพื่อรับรองข้อมูลก่อนดำเนินการ',
			});
			return;
		}
		var text = 'ยืนยันการส่งแบบคำขอรับการประเมิน TTRS หรือไม่'
		if($('#usersignature').val() == 1){
			text = 'ส่งแบบคำขอรับการประเมิน TTRS และเลือกไฟล์ PDF <br>ที่ลงลายมือชื่อเรียบร้อยแล้ว'
		}
		if(refixstatus == 0){
			Swal.fire({
				title: 'โปรดยืนยัน',
				html: text,
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'ตกลง',
				cancelButtonText: 'ยกเลิก',
				closeOnConfirm: false,
				closeOnCancel: false
				}).then((result) => {
				if (result.value) {
					if($('#usersignature').val() == 1){
						$("#minitbppdf").trigger('click');
					}else{
						$("#spinicon").attr("hidden",false);
						submitNoAttachement($('#minitbpid').val(),$('#pdfname').val(),usermessage).then(data => {
							$("#submitminitbp").attr("hidden",true);
							$("#spinicon").attr("hidden",true);
							$("#appceptagreement_wrapper").attr("hidden",true);
								var html = ``;
								Swal.fire({
									title: 'ส่งแบบคำขอฯ เรียบร้อยแล้ว',
									html: 'เจ้าหน้าที่ TTRS จะพิจารณาและแจ้งผลการดำเนินการให้ทราบทาง<br>อีเมลที่ท่านแจ้งไว้',
								}).then((result) => {
									window.location.replace(`${route.url}/dashboard/company/report`);
								});
							})
						.catch(error => {})
					}
				}
			});
		}else{
			Swal.fire({
				title: 'ข้อมูลแก้ไข',
				text: 'กรุณากรอกรายการ/รายละเอียดที่ท่านได้แก้เอกสาร Mini TBP',
				input: 'textarea',
				inputAttributes: {
				autocapitalize: 'off'
				},
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'ตกลง',
				cancelButtonText: 'ยกเลิก',
				closeOnConfirm: false,
				closeOnCancel: false
		
				}).then((result) => {
					if(typeof(result.dismiss) != "undefined"){
						return;
					}else{
					if (result.value) {
						usermessage = result.value;
						Swal.fire({
							title: 'โปรดยืนยัน',
							html: text,
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'ตกลง',
							cancelButtonText: 'ยกเลิก',
							}).then((result) => {
							if (result.value) {
								if($('#usersignature').val() == 1){
									$("#minitbppdf").trigger('click');
								}else{
									$("#spinicon").attr("hidden",false);
									submitNoAttachement($('#minitbpid').val(),$('#pdfname').val(),usermessage).then(data => {
										$("#submitminitbp").attr("hidden",true);
										$("#spinicon").attr("hidden",true);
										$("#appceptagreement_wrapper").attr("hidden",true);
											var html = ``;
											Swal.fire({
												title: 'ส่งแบบคำขอฯ เรียบร้อยแล้ว',
												html: 'เจ้าหน้าที่ TTRS จะพิจารณาและแจ้งผลการดำเนินการให้ทราบ<br>ทางอีเมลที่ท่านแจ้งไว้',
											}).then((result) => {
												window.location.replace(`${route.url}/dashboard/company/report`);
											});
										})
									.catch(error => {})
								}
							}
						});
					}else{
						if(refixstatus != 0 & usermessage == ''){
							Swal.fire({
								title: 'ผิดพลาด...',
								text: 'กรุณาระบุข้อมูลที่แก้ไขใน Mini TBP',
								});
						}
					}
				}
			});
		}	
		return;
	});

	$(document).on('change', '#minitbppdf', function(e) {
		var file = this.files[0];
		var fextension = file.name.substring(file.name.lastIndexOf('.')+1);
		var validExtensions = ["jpg","pdf","jpeg","gif","png","bmp"];
		if(!validExtensions.includes(fextension)){
			Swal.fire({
				title: 'ผิดพลาด...',
				text: 'รูปแบบไฟล์ไม่ถูกต้อง!',
				});
			this.value = "";
			return false;
		}
		if (file === undefined) {
			return ;
		}
		if (this.files[0].size/1024/1024*1000 > 2048 ){
			Swal.fire({
				title: 'ผิดพลาด...',
				text: 'ไฟล์ขนาดมากกว่า 2 MB',
				});
			return ;
		}
		if (this.files[0].name.length > 70 ){
			Swal.fire({
				title: 'ผิดพลาด...',
				text: 'ชื่อไฟล์ยาวมากกว่า 70 ตัวอักษร',
				});
			return ;
		}
		var formData = new FormData();
		formData.append('attachment',file);
		formData.append('id',$('#minitbpid').val());
		formData.append('message',usermessage);

		$.ajax({
			url: `${route.url}/api/minitbp/submitwithattachement`,  //Server script to process data
			type: 'POST',
			headers: {"X-CSRF-TOKEN":route.token},
			data: formData,
			contentType: false,
			processData: false,
			beforeSend: function ( xhr ) {
				$("#spinicon").attr("hidden",false);
			},
			success: function(data){
				$("#submitminitbp").attr("hidden",true);
				$("#spinicon").attr("hidden",true);
				$("#appceptagreement_wrapper").attr("hidden",true);
				Swal.fire({
					title: 'สำเร็จ...',
					text: 'ส่งแบบคำขอรับการประเมิน TTRS สำเร็จ!',
				}).then((result) => {
					window.location.replace(`${route.url}/dashboard/company/report`);
				});
			}
		});
	});

	function submitNoAttachement(id,pdfname,message){
		return new Promise((resolve, reject) => {
			$.ajax({
				url: `${route.url}/api/minitbp/submitnoattachement`,
				type: 'POST',
				headers: {"X-CSRF-TOKEN":route.token},
				data: {
				id : id,
				pdfname : pdfname,
				message : message
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

	
	function updateCompanyAddress(id,name,address,province,amphur,tambol,postal){
		return new Promise((resolve, reject) => {
			$.ajax({
				url: `${route.url}/api/company/updatecompanyaddress`,
				type: 'POST',
				headers: {"X-CSRF-TOKEN":route.token},
				data: {
				id : id,
				name : name,
				address : address,
				province : province,
				amphur : amphur,
				tambol : tambol,
				postal : postal
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

	$(document).on('change', '#projecteng', function(e) {
		var re = new RegExp("^([a-zA-Z0-9!@#\$%\^\&*\)\(+=._-]|[0-9]|[/]|[\\]|[ ]|[\n]|[.])+$", "g");
		if(re.test($(this).val()) == false){
			$(this).val('')
			Swal.fire({
				title: 'ผิดพลาด...',
				text: 'กรุณากรอกเป็นภาษาอังกฤษ!',
			});
		}

	});

	$(document).on('click', '#btn_add_authorized_director', function(e) {
		$("#clearpad").trigger("click");
		$('select#directorprefix').val(1).select2();
		$('select#directorposition').val(1).select2();
		$('#directorname').val('');
		$('#directorlastname').val('');
		$('#signature_type').val('1');
		$('#signatureid').val('');
		$("#sigdiv").html('');
		$("#otherprefix_wrapper").attr("hidden",true);
		$("#otherposition_wrapper").attr("hidden",true);
		$('#modal_add_authorized_director').modal('show');
	});


	
$(document).on('click', '#btn_modal_add_authorized_director', function(e) {
    if($('#directorname').val() =='' || $('#directorlastname').val() =='' || $('#directorposition').val() == ''){
        return ;
    }
    if($('#directorposition').val() == 5){
        if($('#otherposition').val() == ''){
            return ;
        }
    }
    if($("#directorprefix option:selected").text() == 'อื่นๆ'){
        if($('#otherprefix').val() == ''){
            return ;
        }
    } 
    $("#spinicon_director_add").attr("hidden",false);
    addAuthorizedDirector($(this).data('id'),$('#directorprefix').val(),$('#otherprefix').val(),$('#directorname').val(),$('#directorlastname').val(),$('#directorposition').val(),$('#otherposition').val(),$('#dataurl').val()).then(data => {
        var html = ``;
        data.forEach(function (director,index) {
            console.log(director);
            var check = '<span class="badge badge-flat border-warning text-warning">ไม่พบลายมือชื่อ</span>';
            if(director.signature_id != null){
                check =  '<span class="badge badge-flat border-success text-success">มีลายมือชื่อแล้ว</span>'
            }
            var otherposition = director.employposition['name'];
            if(director.employ_position_id == 5){
                otherposition = director.otherposition;
            }
            var prefix = director.prefix['name'];
            if(prefix == 'อื่นๆ'){
                prefix = director.otherprefix;
            }
            html += `<tr >                                        
               <td> ${prefix}${director.name}  ${director.lastname}</td>                                          
                <td> ${otherposition} </td>  
                <td>
                    ${check}
                </td>   
                <td style="width:1%;white-space: nowrap" class="text-center">
                    <a  data-id="${director.id}" class="btn btn-sm bg-info editauthorizeddirector">แก้ไข</a>  
                    <a  data-id="${director.id}" class="btn btn-sm bg-danger deleteauthorizeddirector">ลบ</a>  
                </td> 
            </tr>`
            });
            $('#dataurl').val('');
            $("#spinicon_director_add").attr("hidden",true);
         $('#authorizeddirector').val(data.length);
         $("#authorized_director_wrapper_tr").html(html);
         $('#modal_add_authorized_director').modal('hide');
    })
    .catch(error => {})
});

$(document).on("change","#contactphone",function(e){
	if(($("#contactphone").val().length < 9 || $("#contactphone").val().length > 10) || $("#contactphone").val().charAt(0) != '0'){
		$("#contactphone_error").attr("hidden",false);
		$(this).val('');
	}else{
		$("#contactphone_error").attr("hidden",true);
	}
}); 


$(document).on('change', '#contactemail', function(e) {
    if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test($('#contactemail').val())== false)
    {
		$(this).val('')
		$("#contactemail_error").attr("hidden",false);
    }else{
		$("#contactemail_error").attr("hidden",true);
	}
});

$(document).on('change', '#tambol', function(e) {
	// console.log($(this).find(':selected').data('id'));
	$('#postalcode').val($(this).find(':selected').data('id'));
});

$(document).on('change', '#website', function(e) {
	var patt = /[ก-๙]/g;
	var res = patt.test($(this).val());
	if(res == true &&  $(this).val() != ''){
		Swal.fire({
			title: 'ผิดพลาด...',
			text: 'กรุณากรอกเว็ปไซต์เป็นภาษาอังกฤษ!',
		});
		$(this).val('');
	}
});

$(document).on("change","#postalcode",function(e){
	if($(this).val().length != 5){
		$("#postalcode_format_error").attr("hidden",false);
		$(this).val('');
	}else{
		$("#postalcode_format_error").attr("hidden",true);
	}
}); 
</script>
@stop

