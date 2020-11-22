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
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">เอกสาร Mini TBP</span></h4>
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
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> การประเมิน</a>
                    <a href="{{route('dashboard.company.project.minitbp')}}" class="breadcrumb-item"> รายการ Mini TBP</a>
                    <span class="breadcrumb-item active">Mini TBP</span>
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
					{{-- <button type="button" id="btn_modal_message" data-dismiss="modal" class="btn bg-primary">เสร็จสิ้น</button> --}}
				</div>
			</div>
		</div>
	</div>

    <!-- /page header -->

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
        <div class="row">
            <div class="col-md-12">
				<!-- Colors -->
            	<div class="card">

                	<div class="card-body">
						{{-- <ul class="nav nav-tabs nav-tabs-highlight">
							<li class="nav-item"><a href="#left-icon-minitbp" class="nav-link active" data-toggle="tab"><i class="icon-stack3 mr-2"></i> ข้อมูล Mini TBP</a></li>
							<li class="nav-item"><a href="#left-icon-contact" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> ข้อมูลผู้ผู้รับผิดชอบ</a></li>
							<li class="nav-item"><a href="#left-icon-manager" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> ข้อมูลผู้ลงนาม</a></li>
						</ul>
						<form method="POST" action="{{route('dashboard.company.project.minitbp.editsave',['id'=>$minitbp->id])}}" enctype="multipart/form-data">
							@csrf
						<div class="tab-content">
							<div class="tab-pane fade show active" id="left-icon-minitbp">
								@csrf

							</div>
							<div class="tab-pane fade" id="left-icon-contact">

							</div>
							<div class="tab-pane fade" id="left-icon-manager">

							</div>
						</div>
							<div class="text-right">
								<button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
							</div>
						</form> --}}

						{{-- <form id="frmminitbp" method="POST" class="wizard-form step-minitbp" action="{{route('dashboard.company.project.minitbp.editsave',['id'=>$minitbp->id])}}" data-fouc> --}}
						<form id="frmminitbp" method="POST" class="wizard-form step-minitbp" action="" data-fouc>
							@csrf
							<h6>ผู้ยื่นแบบคำขอ</h6>
							<fieldset>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ชื่อบริษัท<span class="text-danger">*</span></label>
											<input type="text" name ="companyname" id ="companyname" value="{{old('companyname') ?? $minitbp->businessplan->company->name}}" class="form-control required" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ที่อยู่บริษัท<span class="text-danger">*</span></label>
											<input type="text" name ="address" id ="address" value="{{$user->company->companyaddress->first()->address}}" class="form-control required" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>จังหวัด<span class="text-danger">*</span></label>
											<select name="province" id="province" data-placeholder="จังหวัด" class="form-control form-control-select2 required" disabled>
												<option value=""></option>
												{{-- @foreach ($provinces as $province)
													<option value="{{$province->id}}" @if($user->company->province_id == $province->id) selected @endif>{{$province->name}}</option> 
												@endforeach --}}
												@foreach ($provinces as $province)
													<option value="{{$province->id}}" @if($user->company->companyaddress->first()->province_id == $province->id) selected @endif>{{$province->name}}</option> 
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>อำเภอ<span class="text-danger">*</span></label>
											<select name="amphur" id="amphur" data-placeholder="อำเภอ" class="form-control form-control-select2 required" disabled>
												{{-- @foreach ($amphurs as $amphur)                                                                
													<option value="{{$amphur->id}}" @if ($user->company->amphur->id == $user->amphur_id) selected @endif> {{$amphur->name}} </option>
												@endforeach    --}}
												@foreach ($amphurs as $amphur)                                                                
													<option value="{{$amphur->id}}" @if ($user->company->companyaddress->first()->amphur_id == $amphur->id) selected @endif> {{$amphur->name}} </option>
												@endforeach   
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>ตำบล<span class="text-danger">*</span></label>
											<select name="tambol" id="tambol" data-placeholder="ตำบล" class="form-control form-control-select2 required" disabled>
												{{-- @foreach ($tambols as $tambol)                                                                
													<option value="{{$tambol->id}}" @if ($user->company->tambol->id == $user->tambol_id) selected @endif> {{$tambol->name}} </option>
												@endforeach     --}}
												@foreach ($tambols as $tambol)                                                                
													<option value="{{$tambol->id}}" @if ($user->company->companyaddress->first()->tambol_id == $tambol->id) selected @endif> {{$tambol->name}} </option>
												@endforeach   
											</select>
										</div>
									</div>
									<div class="col-md-6">  
										<div class="form-group">
											<label>รหัสไปรษณีย์<span class="text-danger">*</span></label>
											{{-- <input type="text" name="postalcode" id="postalcode" value="{{$user->company->postalcode}}"  placeholder="รหัสไปรษณีย์" class="form-control required" readonly> --}}
											<input type="text" name="postalcode" id="postalcode" value="{{$user->company->companyaddress->first()->postalcode}}"  placeholder="รหัสไปรษณีย์" class="form-control required" readonly>
										</div>
									</div>
									<legend>
										<label>ข้อมูลผู้ยื่นแบบคำขอ</label>
									</legend>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">คำนำหน้าชื่อ<span class="text-danger">*</span></label>
											<select name="contactprefix" id="contactprefix" class="form-control form-control-select2 required" disabled>
												@foreach ($contactprefixes as $contactprefix)
													<option value="{{$contactprefix->id}}" @if($minitbp->contactprefix == $contactprefix->id) selected @endif >{{$contactprefix->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ชื่อ<span class="text-danger">*</span></label>
											<input type="text" name ="contactname" id ="contactname" value="{{old('contactname') ?? $minitbp->contactname}}" class="form-control required" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">นามสกุล<span class="text-danger">*</span></label>
											<input type="text" name ="contactlastname" id ="contactlastname" value="{{old('contactlastname') ?? $minitbp->contactlastname}}" class="form-control required" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ตำแหน่ง</label>
											<input type="text" name ="contactposition" value="{{$minitbp->contactposition}}" class="form-control" readonly >
											{{-- <select name="contactposition" id="contactposition" value="{{$minitbp->contactposition}}" id="" class="form-control form-control-select2">
												@foreach ($contactpositions as $contactposition)
													<option value="{{$contactposition->id}}" @if($minitbp->contactposition_id == $contactposition->id) selected @endif >{{$contactposition->name}}</option>
												@endforeach
											</select> --}}
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">เบอร์โทรศัพท์<span class="text-danger">*</span></label>
											<input type="text" name ="contactphone" id ="contactphone" value="{{old('contactphone') ?? $minitbp->contactphone}}" class="form-control required" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">อีเมล<span class="text-danger">*</span></label>
											<input type="text" name ="contactemail" id ="contactemail" value="{{old('contactemail') ?? $minitbp->contactemail}}" class="form-control required" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">เว็บไซต์</label>
											<input type="text" name ="website" id ="website" value="{{old('website') ?? $minitbp->website}}" class="form-control" readonly>
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
												<input type="text" id="project" name="project" value="{{old('project') ?? $minitbp->project}}"  placeholder="ชื่อโครงการ/เทคโนโลยี" class="form-control required" readonly >
											</div>
										</fieldset>
									</div>
									<div class="col-md-6">
										<fieldset>	
											<div class="form-group">
												<label>ชื่อโครงการ/เทคโนโลยี ภาษาอังกฤษ (ถ้ามี)</label>
												<input type="text" id="projecteng" name="projecteng" value="{{old('projecteng') ?? $minitbp->projecteng}}"  placeholder="ชื่อโครงการ/เทคโนโลยี ภาษาอังกฤษ" class="form-control" readonly>
											</div>
										</fieldset>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group mb-3 mb-md-2">
											<label class="font-weight-semibold">สิทธิประโยชน์ทางการเงิน (Finance)</label>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" name="finance1"  id="finance1" class="form-check-input-styled-primary" @if (!Empty($minitbp->finance1)) checked @endif data-fouc disabled>
																ขอสินเชื่อกับธนาคาร
															</label>
															<div class="row" id="financediv1" style="margin-top: 5px" @if (Empty($minitbp->thai_bank_id) || Empty($minitbp->finance1)) hidden @endif >
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="">เลือกธนาคาร</label>
																		<select name="bank" id="bank" class="form-control form-control-select2" disabled>
																			@foreach ($banks as $bank)
																				<option value="{{$bank->id}}" @if($minitbp->thai_bank_id == $bank->id) selected @endif >{{$bank->name}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="">วงเงินสินเชื่อที่ต้องการ</label>
																		<input type="number" name="finance1loan" id="finance1loan" value="{{old('finance1loan') ?? $minitbp->finance1_loan}}" class="form-control" readonly>
																	</div>
																</div>
															</div>	
														</div>
													</div>
	
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="finance2" id="finance2" class="form-check-input-styled-primary" @if (!Empty($minitbp->finance2)) checked @endif  data-fouc disabled>
															ขอรับการค้ำประกันสินเชื่อฯ บสย. (บรรษัทประกันสินเชื่ออุตสาหกรรมขนาดย่อม)
														</label>														
													</div>
	
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="finance3" id="finance3" class="form-check-input-styled-primary" @if (!Empty($minitbp->finance3)) checked @endif data-fouc disabled>
															โครงการเงินกู้ดอกเบี้ยต่ำ (สวทช.)
														</label>
													</div>
												</div>
	
												<div class="col-md-6">
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="finance4" id="finance4" class="form-check-input-styled-primary" @if (!Empty($minitbp->finance4)) checked @endif data-fouc disabled>
															บริษัทร่วมทุน (สวทช.)
														</label>
														<div class="row" id="financediv2" style="margin-top: 5px" @if (Empty($minitbp->finance4_joint_min) || Empty($minitbp->finance4)) hidden @endif >
															<div class="col-md-4">
																<div class="form-group">
																	<label for="">วงเงินสินเชื่อที่ต้องการ</label>
																	<input type="text" name ="finance4joint" id="finance4joint" class="form-control" value="{{old('finance4joint') ?? $minitbp->finance4_joint}}" readonly>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label for="">สัดส่วนลงทุน บริษัท</label>
																	<input type="number" name="finance4jointmin" id="finance4jointmin" class="form-control" value="{{old('finance4jointmin') ?? $minitbp->finance4_joint_min}}" readonly>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label for="">: สวทช</label>
																	<input type="number" name="finance4jointmax" id="finance4jointmax" class="form-control" value="{{old('finance4jointmax') ?? $minitbp->finance4_joint_max}}" readonly>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group mb-3 mb-md-2">
											<label class="font-weight-semibold">สิทธิประโยชน์ที่ไม่ใช่การเงิน (Non-Finance)</label>
											<div class="row">
												<div class="col-md-6">
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="nonefinance1" id="nonefinance1" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance1)) checked @endif data-fouc disabled>
															โครงการขึ้นทะเบียนบัญชีนวัตกรรมไทย
														</label>
													</div>
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="nonefinance2" id="nonefinance2" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance2)) checked @endif data-fouc disabled>
															รับรองสิทธิประโยชน์ทางภาษี
														</label>
													</div>
	
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="nonefinance3" id="nonefinance3" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance3)) checked @endif data-fouc disabled>
															โครงการ spin-off
														</label>
													</div>
												</div>
	
												<div class="col-md-6">
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="nonefinance4" id="nonefinance4" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance4)) checked @endif data-fouc disabled>
															ที่ปรึกษาทางด้านเทคนิค/ด้านธุรกิจ
														</label>
													</div>
	
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="nonefinance5" id="nonefinance5" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance5)) checked @endif data-fouc disabled>
															โครงการสนับสนุนผู้ประกอบการภาครัฐ
														</label>
														<div class="row" id="nonefinancediv1" style="margin-top: 5px" @if (Empty($minitbp->nonefinance5_detail) || Empty($minitbp->nonefinance5)) hidden @endif>
															<div class="col-md-12">
																<div class="form-group">
																	<label for="">โปรดระบุ</label>
																	<input type="text" name ="nonefinance5detail" id ="nonefinance5detail" class="form-control" value="{{old('nonefinance5detail') ?? $minitbp->nonefinance5_detail}}" readonly>
																</div>
															</div>
														</div>
													</div>
	
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" id="nonefinance6" name="nonefinance6" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance6)) checked @endif data-fouc disabled>
															อื่น ๆ
														</label>
														<div class="row" id="nonefinancediv2" style="margin-top: 5px"  @if (Empty($minitbp->nonefinance6_detail) || Empty($minitbp->nonefinance6) ) hidden @endif>
															<div class="col-md-12">
																<div class="form-group">
																	<label for="">โปรดระบุ</label>
																	<input type="text" name="nonefinance6detail" id="nonefinance6detail" class="form-control" value="{{old('nonefinance6detail') ?? $minitbp->nonefinance6_detail}}" readonly>
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
									<div class="col-md-6">
										<div class="form-group">
											<label for="">คำนำหน้าชื่อ<span class="text-danger">*</span></label>
											<select name="managerprefix" id="managerprefix" class="form-control form-control-select2" disabled>
												@foreach ($contactprefixes as $contactprefix)
													<option value="{{$contactprefix->id}}" @if($minitbp->managerprefix_id == $contactprefix->id) selected @endif >{{$contactprefix->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ชื่อ<span class="text-danger">*</span></label>
											<input type="text" name ="managername" id ="managername" value="{{old('managername') ?? $minitbp->managername}}" class="form-control required" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">นามสกุล<span class="text-danger">*</span></label>
											<input type="text" name ="managerlastname" id="managerlastname" value="{{old('managerlastname') ?? $minitbp->managerlastname}}" class="form-control required" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ตำแหน่ง<span class="text-danger">*</span></label>
											<select name="managerposition" id="managerposition" value="{{$minitbp->managerposition}}" id="" class="form-control form-control-select2 required" disabled>
												@foreach ($contactpositions as $contactposition)
													<option value="{{$contactposition->id}}" @if($minitbp->managerposition_id == $contactposition->id) selected @endif >{{$contactposition->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">ลายมือชื่ออิเล็กทรอนิกส์<span class="text-danger">*</span></label>
											<select name="signature" id="usersignature" value="{{$minitbp->signature_status_id}}" id="" class="form-control form-control-select2" disabled>
												@foreach ($signaturestatuses as $signaturestatus)
													<option value="{{$signaturestatus->id}}" @if($minitbp->signature_status_id == $signaturestatus->id) selected @endif >{{$signaturestatus->name}}</option>
												@endforeach
											</select>
										</div>
										{{-- <div class="form-group" id="signature_wrapper" @if($minitbp->signature_status_id == 1) hidden @endif>
											<a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_signature">ลายมือชื่อ</a>
											<div class="col-md-12">
												<div id='sigdiv'>
													@if (!Empty(Auth::user()->signature))
													<br>
													<img src="{{asset(Auth::user()->signature)}}" style="width: 180px;height:45px" alt="">
													@endif
												</div>
											</div>
										</div> --}}
									</div>
								</div>
							</fieldset>
								<h6>เสร็จสิ้น</h6>
								<fieldset>
									<div class="col-md-12">
										<div class="form-group">
											<div style="width:100%;height:600px;" class="col-md-12 center"  >
												{{-- <canvas id="the-canvas"></canvas> --}}
												<div id="example1"></div>
											</div>
											<input type="file" style="display:none;" id="minitbppdf"/>
										</div>
									</div>
									<div class="col-md-12 " id="appceptagreement_wrapper">
										<div class="form-group float-right">
											<div class="form-check">
												<label class="form-check-label">
													<input type="checkbox" name="appceptagreement"  id="appceptagreement" class="form-check-input-styled-primary"  data-fouc disabled>
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
<script src="{{asset('assets/dashboard/js/plugins/signaturepad/signaturecontrol.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/pdfobject/pdfobject.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/locationhelper.js')}}"></script>
{{-- <script src="{{asset('assets/dashboard/js/plugins/pdfjs/pdf.js')}}"></script> --}}
<script>
	var route = {
		url: "{{ url('/') }}",
		token: $('meta[name="csrf-token"]').attr('content'),
		branchid: "{{Auth::user()->branch_id}}"
	};
	var submitstatus = "{{$minitbp->businessplan->business_plan_status_id}}";
	var refixstatus = "{{$minitbp->refixstatus}}";
	// Basic wizard setup
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
			// alert('Form submitted.');
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
			form.validate().settings.ignore = ':disabled,:hidden';
			return form.valid();
		},
		onFinishing: function (event, currentIndex) {
			form.validate().settings.ignore = ':disabled';
			return form.valid();
		},
		onStepChanged:function (event, currentIndex, newIndex) {
			console.log('current step ' + currentIndex);
			if(currentIndex == 3){
				var hidden = '';
				if(submitstatus !=2 && refixstatus == 0){
					hidden = 'hidden';
					$("#appceptagreement_wrapper").attr("hidden",true);
				}
				$(document).find(".actions ul").append(`
					<li class='libtn'><a href='#' id='downloadpdf' class='btn btn-primary' target="_blank"> ดาวน์โหลด <i class='icon-floppy-disk ml-2' /></a></li>
					<li class='libtn' ${hidden}><a href='#' id='submitminitbp' class='btn bg-teal' ><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i>ส่งขอประเมิน<i class='icon-paperplane ml-2' /></a></li>
				`);

				if(submitstatus == 2 || refixstatus != 0){
					var formData = new FormData();
					formData.append('id',$('#minitbpid').val());
					formData.append('project',$('#project').val());
					formData.append('projecteng',$('#projecteng').val());
					formData.append('finance1',$('#finance1').is(':checked') === true ? '1' : '');
					formData.append('bank',$('#bank').val());
					formData.append('finance1loan',$('#finance1loan').val());
					formData.append('finance2',$('#finance2').is(':checked') === true ? '1' : '');
					formData.append('finance3',$('#finance3').is(':checked') === true ? '1' : '');
					formData.append('finance4',$('#finance4').is(':checked') === true ? '1' : '');
					formData.append('finance4joint',$('#finance4joint').val());
					formData.append('finance4jointmin',$('#finance4jointmin').val());
					formData.append('finance4jointmax',$('#finance4jointmax').val());
					formData.append('nonefinance1',$('#nonefinance1').is(':checked') === true ? '1' : '');
					formData.append('nonefinance2',$('#nonefinance2').is(':checked') === true ? '1' : '');
					formData.append('nonefinance3',$('#nonefinance3').is(':checked') === true ? '1' : '');
					formData.append('nonefinance4',$('#nonefinance4').is(':checked') === true ? '1' : '');
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
					
					$.ajax({
						url: `${route.url}/api/minitbp/editsave`,  //Server script to process data
						type: 'POST',
						headers: {"X-CSRF-TOKEN":route.token},
						data: formData,
						contentType: false,
						processData: false,
						success: function(data){
							// console.log(data);
							createPdf($('#minitbpid').val()).then(data => {
								var pdfpath = route.url + '/'+ data;
								var url = pdfpath;
								$('#downloadpdf').attr('href', url);
								PDFObject.embed(pdfpath, "#example1");
							}).catch(error => {})
						}
					});
				}else{
					
					createPdf($('#minitbpid').val()).then(data => {
						var pdfpath = route.url + '/'+ data;
						var url = pdfpath;
						$('#downloadpdf').attr('href', url);
						PDFObject.embed(pdfpath, "#example1");
					}).catch(error => {})
				}
			
			}else{
				// console.log('why here');
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
	        }
	    }
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
		console.log($('#appceptagreement').is(':checked'));
		if($('#appceptagreement').is(':checked') === false){
			Swal.fire({
				title: 'ผิดพลาด!',
				type: 'warning',
				text: 'กรุณารับรองว่าข้อมูลทั้งหมดเป็นความจริง',
			});
			return;
		}
		var text = 'ยืนยันส่งแบบคำขอรับการประเมิน TTRS หรือไม่'
		if($('#usersignature').val() == 1){
			text = 'ยืนยันส่งแบบคำขอรับการประเมิน TTRS และเลือกไฟล์ที่ลงลายมือชื่อเรียบร้อยแล้ว'
		}
		Swal.fire({
			title: 'เอกสาร mini TBP',
			text: text,
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
					submitNoAttachement($('#minitbpid').val()).then(data => {
						$("#submitminitbp").attr("hidden",true);
						$("#spinicon").attr("hidden",true);
						$("#appceptagreement_wrapper").attr("hidden",true);
							var html = ``;
							Swal.fire({
								title: 'สำเร็จ...',
								text: 'ส่งแบบคำขอรับการประเมิน TTRS สำเร็จ!',
							});
						})
					.catch(error => {})
				}
			}
		});
	});

	$(document).on('change', '#minitbppdf', function(e) {
		var file = this.files[0];
		if (file === undefined) {
			return ;
		}
		if (this.files[0].size/1024/1024*1000 > 2000 ){
			alert('ไฟล์ขนาดมากกว่า 2 MB');
			return ;
		}
		var formData = new FormData();
		formData.append('attachment',file);
		formData.append('id',$('#minitbpid').val());

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
				});
			}
		});
	});

	function submitNoAttachement(id){
		return new Promise((resolve, reject) => {
			$.ajax({
				url: `${route.url}/api/minitbp/submitnoattachement`,
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

</script>
@stop
