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
			    <h4> <span class="font-weight-semibold">เอกสาร Mini TBP : {{$minitbp->project}}</span></h4>
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
                    <a href="{{route('dashboard.company.project.minitbp')}}" class="breadcrumb-item"> รายการแบบคำขอรับการประเมิน (Mini TBP)</a>
                    <span class="breadcrumb-item active">แบบคำขอรับการประเมิน (Mini TBP)</span>
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
						<form id="frmminitbp" method="POST" class="wizard-form step-minitbp" action="" data-fouc>
							@csrf
							<h6>ผู้ยื่นแบบคำขอ</h6>
							<fieldset>
								<div class="row mb-2">
									
									<div class="col-md-12">	
										<label><strong><u>ข้อมูลบริษัท</u></strong></label>
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr class="bg-info">
														<th style="width:200px">รายการ</th>                                                                                  
														<th>รายละเอียด</th>
													</tr>
												</thead>
												<tbody >    
													<tr >                                        
														<td>ชื่อบริษัท</td>
														<td>
															@php
																$company = $minitbp->businessplan->company;
																$company_name = (!Empty($company->name))?$company->name:'';
																$bussinesstype = $company->business_type_id;
																$fullcompanyname = $company_name;
																if($bussinesstype == 1){
																	$fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด (มหาชน)';
																}else if($bussinesstype == 2){
																	$fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด'; 
																}else if($bussinesstype == 3){
																	$fullcompanyname = 'ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
																}else if($bussinesstype == 4){
																	$fullcompanyname = 'ห้างหุ้นส่วนสามัญ ' . $company_name; 
																}else{
																	$fullcompanyname = $minitbp->businessplan->company->name; 
																}
															@endphp
															{{$fullcompanyname}}
														</td>
													</tr>       
													<tr >                                        
														<td>ที่อยู่บริษัท</td>
														<td>{{@$user->company->companyaddress->first()->address}} ตำบล{{$user->company->companyaddress->first()->tambol->name}} อำเภอ{{$user->company->companyaddress->first()->amphur->name}} จังหวัด{{$user->company->companyaddress->first()->province->name}} {{$user->company->companyaddress->first()->postalcode}}</td>
													</tr>              
												</tbody>
											</table>
										</div>
									</div>   
									
									
									<div class="col-md-12 mt-3">	
										<label><strong ><u>ข้อมูลผู้ยื่นแบบคำขอ</u></strong></label>
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr class="bg-info">
														<th style="width:200px">รายการ</th>                                                                                  
														<th>รายละเอียด</th>
													</tr>
												</thead>
												<tbody >    
													<tr >                                       
														<td>ชื่อ-นามสกุล</td>
														<td>{{@$minitbp->prefix->name}}{{@$minitbp->contactname}} {{@$minitbp->contactlastname }}</td>
													</tr>       
													<tr >                                        
														<td>ตำแหน่ง</td>
														<td>{{@$minitbp->contactposition}}</td>
													</tr>    
													<tr >                                        
														<td>เบอร์โทรศัพท์</td>
														<td>{{@$minitbp->contactphone}}</td>
													</tr>  
													<tr >                                        
														<td>อีเมล</td>
														<td>{{@$minitbp->contactemail}}</td>
													</tr>  
													<tr >                                        
														<td>เว็บไซต์</td>
														<td>{{@$minitbp->website}}</td>
													</tr>              
												</tbody>
											</table>
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
												<input type="text" id="project" name="project" value="{{old('project') ?? $minitbp->project}}"  placeholder="ชื่อโครงการ/เทคโนโลยี" class="form-control form-control-lg required" readonly >
											</div>
										</fieldset>
									</div>
									<div class="col-md-6">
										<fieldset>	
											<div class="form-group">
												<label>ชื่อโครงการ/เทคโนโลยี ภาษาอังกฤษ (ถ้ามี)</label>
												<input type="text" id="projecteng" name="projecteng" value="{{old('projecteng') ?? $minitbp->projecteng}}"  placeholder="ชื่อโครงการ/เทคโนโลยี ภาษาอังกฤษ" class="form-control form-control-lg" readonly>
											</div>
										</fieldset>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group mb-3 mb-md-2">
											<label class="font-weight-semibold">สิทธิประโยชน์ทางการเงิน (Finance)</label>
											<div class="row">
												<div class="col-md-12">
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
																		<select name="bank" id="bank" class="form-control form-control-lg form-control-select2" disabled>
																			@foreach ($banks as $bank)
																				<option value="{{$bank->id}}" @if($minitbp->thai_bank_id == $bank->id) selected @endif >{{$bank->name}}</option>
																			@endforeach
																		</select>
																	</div>
																	@if (@$minitbp->bank == 'อื่นๆ โปรดระบุ')
																			<input type="text" name="otherbank" id="otherbank" value="{{$minitbp->otherbank}}" placeholder="ระบุชื่อธนาคาร" class="form-control form-control-lg form-control-lg stringformat60" disabled>
																		@else
																			<input type="text" name="otherbank" id="otherbank" value="{{$minitbp->otherbank}}" placeholder="ระบุชื่อธนาคาร" class="form-control form-control-lg form-control-lg stringformat60" disabled hidden >
																	@endif
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="">มูลค่าเงินลงทุนที่ต้องการ</label>
																		<input type="text" name="finance1loan" id="finance1loan" value="{{old('finance1loan') ?? $minitbp->finance1_loan}}" class="form-control form-control-lg numeralformat10" readonly>
																	</div>
																</div>

																<div class="col-md-6 mt-2">
																	<div class="form-group">
																		<label for="">เลือกธนาคาร</label>
																		<select name="bank1" id="bank1" class="form-control form-control-lg form-control-select2" disabled>
																			<option value="0">=== โปรดเลือกธนาคาร ===</option>
																			@foreach ($banks as $bank)
																				<option value="{{$bank->id}}" @if($minitbp->thai_bank_1_id == $bank->id) selected @endif >{{$bank->name}}</option>
																			@endforeach
																		</select>
																	</div>
																	@if (@$minitbp->bank1 == 'อื่นๆ โปรดระบุ')
																			<input type="text" name="otherbank1" id="otherbank1" value="{{$minitbp->otherbank1}}" placeholder="ระบุชื่อธนาคาร" class="form-control form-control-lg stringformat60" disabled>
																		@else
																			<input type="text" name="otherbank1" id="otherbank1" value="{{$minitbp->otherbank1}}" placeholder="ระบุชื่อธนาคาร" class="form-control form-control-lg stringformat60" disabled hidden >
																	@endif
																	
																</div>
																<div class="col-md-6 mt-2">
																	<div class="form-group">
																		<label for="">มูลค่าเงินลงทุนที่ต้องการ</label>
																		<input type="text" name="finance1_1_loan" id="finance1_1_loan" value="{{old('finance1_1_loan') ?? $minitbp->finance1_1_loan}}" class="form-control form-control-lg numeralformat10" readonly>
																	</div>
																</div>



																<div class="col-md-6 mt-2">
																	<div class="form-group">
																		<label for="">เลือกธนาคาร</label>
																		<select name="bank2" id="bank2" class="form-control form-control-lg form-control-select2" disabled>
																			<option value="0">=== โปรดเลือกธนาคาร ===</option>
																			@foreach ($banks as $bank)
																				<option value="{{$bank->id}}" @if($minitbp->thai_bank_2_id == $bank->id) selected @endif >{{$bank->name}}</option>
																			@endforeach
																		</select>
																	</div>
																	@if (@$minitbp->bank2 == 'อื่นๆ โปรดระบุ')
																			<input type="text" name="otherbank2" id="otherbank2" value="{{$minitbp->otherbank1}}" placeholder="ระบุชื่อธนาคาร" class="form-control form-control-lg stringformat60" disabled>
																		@else
																			<input type="text" name="otherbank2" id="otherbank2" value="{{$minitbp->otherbank1}}" placeholder="ระบุชื่อธนาคาร" class="form-control form-control-lg stringformat60" disabled hidden >
																	@endif
																	
																</div>
																<div class="col-md-6 mt-2">
																	<div class="form-group">
																		<label for="">มูลค่าเงินลงทุนที่ต้องการ</label>
																		<input type="text" name="finance1_2_loan" id="finance1_2_loan" value="{{old('finance1_2_loan') ?? $minitbp->finance1_2_loan}}" class="form-control form-control-lg numeralformat10" readonly>
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

													<div class="form-group">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" id="finance3_other" name="finance3_other" class="form-check-input-styled-primary" @if (!Empty($minitbp->finance3_other)) checked @endif data-fouc disabled>
																อื่นๆ โปรดระบุ
															</label>
															<div class="row" id="finance3_other_div" style="margin-top: 5px"  @if (Empty($minitbp->finance3_other_detail) || Empty($minitbp->finance3_other) ) hidden @endif>
																<div class="col-md-6">
																	<div class="form-group">
																		{{-- <label for="">โปรดระบุ</label> --}}
																		<input type="text" name="finance3_other_detail" id="finance3_other_detail" class="form-control form-control-lg" value="{{old('finance3_other_detail') ?? $minitbp->finance3_other_detail}}">
																	</div>
																</div>
															</div>
														</div>
													</div>

	
													{{-- <div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="finance3" id="finance3" class="form-check-input-styled-primary" @if (!Empty($minitbp->finance3)) checked @endif data-fouc disabled>
															โครงการเงินกู้ดอกเบี้ยต่ำ (สวทช.)
														</label>
													</div>
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="finance4" id="finance4" class="form-check-input-styled-primary" @if (!Empty($minitbp->finance4)) checked @endif data-fouc disabled>
															บริษัทร่วมทุน (สวทช.)
														</label>
														<div class="row" id="financediv2" style="margin-top: 5px" @if (Empty($minitbp->finance4_joint_min) || Empty($minitbp->finance4)) hidden @endif >
															<div class="col-md-4">
																<div class="form-group">
																	<label for="">มูลค่าเงินลงทุนที่ต้องการ</label>
																	<input type="text" name ="finance4joint" id="finance4joint" class="form-control form-control-lg numeralformat10" value="{{old('finance4joint') ?? $minitbp->finance4_joint}}" readonly>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label for="">สัดส่วนการลงทุนของบริษัทและผู้ถือหุ้นอื่น %</label>
																	<input type="number" name="finance4jointmin" id="finance4jointmin" class="form-control form-control-lg" value="{{old('finance4jointmin') ?? $minitbp->finance4_joint_min}}" readonly>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label for="">สัดส่วนการลงทุนของ สวทช. %</label>
																	<input type="number" name="finance4jointmax" id="finance4jointmax" class="form-control form-control-lg" value="{{old('finance4jointmax') ?? $minitbp->finance4_joint_max}}" readonly>
																</div>
															</div>
														</div>
													</div> --}}
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
													<div class="form-group">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" name="nonefinance1" id="nonefinance1" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance1)) checked @endif data-fouc disabled>
																ที่ปรึกษาด้านเทคโนโลยี/เทคนิค
															</label>
														</div>
													</div>
													<div class="form-group">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" name="nonefinance2" id="nonefinance2" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance2)) checked @endif data-fouc disabled>
																ที่ปรึกษาด้านการตลาด
															</label>
														</div>
													</div>
													<div class="form-group">
														<div class="form-check">
															<label class="form-check-label">
																<input type="checkbox" name="nonefinance3" id="nonefinance3" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance3)) checked @endif data-fouc disabled>
																ที่ปรึกษาด้านการเงิน
															</label>
														</div>
													</div>
													{{-- <div class="form-check">
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
													</div> --}}
												</div>
	
												<div class="col-md-6">
													{{-- <div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="nonefinance4" id="nonefinance4" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance4)) checked @endif data-fouc disabled>
															ที่ปรึกษาทางด้านเทคนิค/ด้านธุรกิจ
														</label>
													</div>
	 --}}
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="nonefinance5" id="nonefinance5" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance5)) checked @endif data-fouc disabled>
															โครงการสนับสนุนผู้ประกอบการภาครัฐ
														</label>
														<div class="row" id="nonefinancediv1" style="margin-top: 5px" @if (Empty($minitbp->nonefinance5_detail) || Empty($minitbp->nonefinance5)) hidden @endif>
															<div class="col-md-12">
																<div class="form-group">
																	<label for="">โปรดระบุ</label>
																	<input type="text" name ="nonefinance5detail" id ="nonefinance5detail" class="form-control form-control-lg" value="{{old('nonefinance5detail') ?? $minitbp->nonefinance5_detail}}" readonly>
																</div>
															</div>
														</div>
													</div>
	
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" id="nonefinance6" name="nonefinance6" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance6)) checked @endif data-fouc disabled>
															อื่นๆ
														</label>
														<div class="row" id="nonefinancediv2" style="margin-top: 5px"  @if (Empty($minitbp->nonefinance6_detail) || Empty($minitbp->nonefinance6) ) hidden @endif>
															<div class="col-md-12">
																<div class="form-group">
																	<label for="">โปรดระบุ</label>
																	<input type="text" name="nonefinance6detail" id="nonefinance6detail" class="form-control form-control-lg" value="{{old('nonefinance6detail') ?? $minitbp->nonefinance6_detail}}" readonly>
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
							{{-- @if (($minitbp->businessplan->business_plan_status_id == 3) && ($minitbp->refixstatus != 0))
								<h6>การแก้ไขล่าสุด</h6>
								<fieldset>
									<div class="col-md-12 mb-2">
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr class="bg-info">
														<th>วันที่</th>
														<th>รายการ</th>                                                                                  
														<th>เดิม</th>
														<th>ใหม่</th>
													</tr>
												</thead>
												<tbody >  
													@foreach ($logcollections as $key => $activity)
														<tr>
															@if ($key == 0)
																<td rowspan="{{$logcollections->count()+1}}" >{{$activity['edit']}}</td>
															@endif
															<td>{{$activity['key']}}</td>
															<td>{{$activity['old']}}</td>
															<td>{{$activity['new']}}</td>
														</tr>
													@endforeach  
												</tbody>
											</table>
										</div>
									</div>
								</fieldset>
							@endif --}}

							<h6>เสร็จสิ้น</h6>
							<fieldset>
								{{-- {{$projectassignment}} --}}
								@if (!Empty($projectassignment->leader_id))
										<input type="text" id="leaderid" value="{{$projectassignment->leader_id}}" hidden>
									@else
									<input type="text" id="leaderid" value="" hidden>
								@endif
								
								<div class="col-md-12">
									<div class="form-group">
										<div style="width:100%;height:600px;" class="col-md-12 center"  >
											<div id="example1"></div>
										</div>
										<input type="file" style="display:none;" id="minitbppdf" accept="image/jpeg,image/gif,image/png,application/pdf"/>
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
<script src="{{asset('assets/dashboard/js/app/helper/inputformat.js')}}"></script>

<script>
	var route = {
		url: "{{ url('/') }}",
		token: $('meta[name="csrf-token"]').attr('content'),
		// branchid: "{{Auth::user()->branch_id}}"
	};
	var submitstatus = "{{$minitbp->businessplan->business_plan_status_id}}";
	var refixstatus = "{{$minitbp->refixstatus}}";

	// Basic wizard setup
	var mytype = "{{Auth::user()->user_type_id}}";
	var myid = "{{Auth::user()->id}}";
	var btnstatus = true;
    if (mytype == 4) {
		if (myid != $("#leaderid").val()) {
			btnstatus = false;
		}
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
			finish: 'ดำเนินการ <i class="icon-arrow-right14 ml-2" />'
		},
		enableFinishButton: btnstatus,
		onFinished: function (event, currentIndex) {
			 window.location.replace(`${route.url}/dashboard/admin/project/minitbp`);
		},
		transitionEffect: 'fade',
		autoFocus: true,
		onFinishing: function (event, currentIndex) {
			form.validate().settings.ignore = ':disabled';
			return form.valid();
		},
		onStepChanged:function (event, currentIndex, newIndex) {
			if(currentIndex == 2){
			var pdfpath = "{{url('/')}}" + '/'+ "{{$minitbp->attachment}}";
			PDFObject.embed(pdfpath, "#example1");
		}
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
		if($('#appceptagreement').is(':checked') === false){
			Swal.fire({
				title: 'ผิดพลาด!',
				type: 'warning',
				html: 'โปรดทำเครื่องหมาย <i class="icon-checkbox-checked"></i> เพื่อรับรองข้อมูลก่อนดำเนินการ',
			});
			return;
		}
		var text = 'ส่งแบบคำขอรับการประเมิน TTRS หรือไม่'
		if($('#usersignature').val() == 1){
			text = 'ส่งแบบคำขอรับการประเมิน TTRS และเลือกไฟล์ PDF ที่ลงลายมือชื่อเรียบร้อยแล้ว'
		}
		Swal.fire({
			title: 'โปรดยืนยัน',
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
		if (this.files[0].size/1024/1024*1000 > 2000 ){
			Swal.fire({
				title: 'ผิดพลาด...',
				text: 'ไฟล์ขนาดมากกว่า 2 MB',
				});
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
