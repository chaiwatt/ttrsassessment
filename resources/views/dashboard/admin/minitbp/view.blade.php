@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">เพิ่มรายการบัญชี</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> ทั่วไป</a>
                    <a href="{{route('setting.admin.dashboard.bankaccount')}}" class="breadcrumb-item"> รายการบัญชี</a>
                    <span class="breadcrumb-item active">เพิ่มรายการบัญชี</span>
                </div>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
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
					{{-- <div class="card-header header-elements-inline">
					
					</div> --}}

                	<div class="card-body">
						<ul class="nav nav-tabs nav-tabs-highlight">
							<li class="nav-item"><a href="#left-icon-minitbp" class="nav-link active" data-toggle="tab"><i class="icon-stack3 mr-2"></i> ข้อมูล Mini TBP</a></li>
							<li class="nav-item"><a href="#left-icon-contact" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> ข้อมูลผู้ติดต่อ</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade show active" id="left-icon-minitbp">
								@csrf
								<div class="row">	
									<div class="col-md-12">
										<fieldset>	
											<div class="form-group">
												<label>โครงการ</label>
												<input type="text"  name="project" value="{{$minitbp->project}}"  placeholder="โครงการ" class="form-control" disabled>
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
															<div class="row" id="financediv1" style="margin-top: 5px" @if (Empty($minitbp->thai_bank_id) || Empty($minitbp->finance1)) hidden @endif disabled>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="">เลือกธนาคาร</label>
																		<select name="bank" id="" class="form-control form-control-select2">
																			@foreach ($banks as $bank)
																				<option value="{{$bank->id}}" @if($minitbp->thai_bank_id == $bank->id) selected @endif >{{$bank->name}}</option>
																			@endforeach
																		</select>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="">วงเงินสินเชื่อที่ต้องการ</label>
																		<input type="number" name="finance1loan" value="{{$minitbp->finance1_loan}}" class="form-control" disabled>
																	</div>
																</div>
															</div>	
														</div>
													</div>
	
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="finance2" class="form-check-input-styled-primary" @if (!Empty($minitbp->finance2)) checked @endif  data-fouc disabled>
															ขอรับการค้ำประกันสินเชื่อฯบสย(บรรษัทประกันสินเชื่ออุตสาหกรรมขนาดย่อม)
														</label>
														
													</div>
	
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="finance3" class="form-check-input-styled-primary" @if (!Empty($minitbp->finance3)) checked @endif data-fouc disabled>
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
																	<input type="text" name ="finance4joint" class="form-control" value="{{$minitbp->finance4_joint}}" disabled>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label for="">สัดส่วนลงทุน บริษัท</label>
																	<input type="number" name="finance4jointmin" class="form-control" value="{{$minitbp->finance4_joint_min}}" disabled>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label for="">: สวทช</label>
																	<input type="number" name="finance4jointmax" class="form-control" value="{{$minitbp->finance4_joint_max}}" disabled>
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
															<input type="checkbox" name="nonefinance1" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance1)) checked @endif data-fouc disabled>
															โครงการขึ้นทะเบียนบัญชีนวัตกรรมไทย
														</label>
													</div>
	
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="nonefinance2" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance2)) checked @endif data-fouc disabled>
															รับรองสิทะฺประโยชน์ทางภาษี
														</label>
													</div>
	
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="nonefinance3" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance3)) checked @endif data-fouc disabled>
															โครงการ spin-off
														</label>
													</div>
												</div>
	
												<div class="col-md-6">
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" name="nonefinance4" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance4)) checked @endif data-fouc disabled>
															ที่ปรึกษาทางด้านเทคนิค/ด้านธุรกิจ
														</label>
													</div>
	
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox"id="nonefinance4" name="nonefinance5" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance5)) checked @endif data-fouc disabled>
															โครงการสนับสนุนผู้ประกอบการภาครัฐ
														</label>
														<div class="row" id="nonefinancediv1" style="margin-top: 5px" @if (Empty($minitbp->nonefinance5_detail) || Empty($minitbp->nonefinance5)) hidden @endif>
															<div class="col-md-12">
																<div class="form-group">
																	<label for="">โปรดระบุ</label>
																	<input type="text" name ="nonefinance5detail" class="form-control" value="{{$minitbp->nonefinance5_detail}}" disabled>
																</div>
															</div>
														</div>
													</div>
	
													<div class="form-check">
														<label class="form-check-label">
															<input type="checkbox" id="nonefinance5" name="nonefinance6" class="form-check-input-styled-primary" @if (!Empty($minitbp->nonefinance6)) checked @endif data-fouc disabled>
															อื่น ๆ
														</label>
														<div class="row" id="nonefinancediv2" style="margin-top: 5px"  @if (Empty($minitbp->nonefinance6_detail) || Empty($minitbp->nonefinance6) ) hidden @endif>
															<div class="col-md-12">
																<div class="form-group">
																	<label for="">โปรดระบุ</label>
																	<input type="text" name="nonefinance6detail" class="form-control" value="{{$minitbp->nonefinance6_detail}}" disabled>
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
							<div class="tab-pane fade" id="left-icon-contact">
								<div class="form-group">
									<label for="">คำนำหน้าชื่อ</label>
									<select name="contactprefix" id="" class="form-control form-control-select2" disabled>
										@foreach ($contactprefixes as $contactprefix)
											<option value="{{$contactprefix->id}}" @if($minitbp->contactprefix == $contactprefix->id) selected @endif >{{$contactprefix->name}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="">ชื่อ</label>
									<input type="text" name ="contactname" value="{{$minitbp->contactname}}" class="form-control" disabled>
								</div>
								<div class="form-group">
									<label for="">นามสกุล</label>
									<input type="text" name ="contactlastname" value="{{$minitbp->contactlastname}}" class="form-control" disabled>
								</div>
								<div class="form-group">
									<label for="">ตำแหน่ง</label>
									<select name="contactposition" value="{{$minitbp->contactposition}}" id="" class="form-control form-control-select2" disabled>
										@foreach ($contactpositions as $contactposition)
											<option value="{{$contactposition->id}}" @if($minitbp->contactposition_id == $contactposition->id) selected @endif >{{$contactposition->name}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="">เบอร์โทร</label>
									<input type="text" name ="contactphone" value="{{$minitbp->contactphone}}" class="form-control" disabled>
								</div>
								<div class="form-group">
									<label for="">อีเมล์</label>
									<input type="text" name ="contactemail" value="{{$minitbp->contactemail}}" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /colors -->
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

@stop
