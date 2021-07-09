@inject('provider', 'App\Http\Controllers\DashboardAdminEvaluationResultController')
@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/plugins/summernote/summernote.min.css')}}" rel="stylesheet">
{{-- <link href="{{asset('assets/dashboard/js/plugins/jqueryui/jquery-ui.css')}}" rel="stylesheet"> --}}
<style>
th {
  text-align: center !important;
}
</style>
@stop
@section('content')


{{-- modal_add_ceo --}}
<div id="modal_add_ceo" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มผู้บริหารระดับสูง (CEO หรือกรรมการผู้จัดการ)</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>คำนำหน้าชื่อ<span class="text-danger">*</span></label>
							<select id="employprefix_ceo" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-lg form-control-select2">
								@foreach ($prefixes as $prefix)
									<option value="{{$prefix->id}}" >{{$prefix->name}}</option> 
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-6" id="otherprefix_ceo_wrapper" hidden>
						<div class="form-group">
							<label>ระบุคำนำหน้าชื่อ</label>
							<input type="text" id="otherprefix_ceo" placeholder="ระบุ" class="form-control form-control-lg stringformat20">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ชื่อ</label><span class="text-danger">*</span>
							<input type="text" id="employname_ceo" placeholder="ชื่อ" class="form-control form-control-lg stringformat20">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>นามสกุล</label><span class="text-danger">*</span>
							<input type="text" id="employlastname_ceo" placeholder="นามสกุล" class="form-control form-control-lg stringformat20">
						</div>
					</div>
					{{-- <div class="col-md-6">
						<div class="form-group">
							<label>ตำแหน่ง<span class="text-danger">*</span></label>
							<div id="employ_position_wrapper"></div>
						</div>
					</div> --}}
					{{-- <div class="col-md-6" id="employ_otherposition_wrapper" hidden>
						<div class="form-group">
							<label>ตำแหน่ง โปรดระบุ</label><span class="text-danger">*</span>
							<input type="text" id="otherboardposition" placeholder="ตำแหน่ง โปรดระบุ" class="form-control form-control-lg">
						</div>
					</div> --}}
					<div class="col-md-6">
						<div class="form-group">
							<label>โทรศัพท์</label><span class="text-danger">*</span>
							<input type="text" id="employphone_ceo" placeholder="โทรศัพท์" class="form-control form-control-lg numeralformathphone">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>โทรศัพท์มือถือ</label><span class="text-danger">*</span>
							<input type="text" id="employworkphone_ceo" placeholder="โทรศัพท์มือถือ" class="form-control form-control-lg numeralformathphone">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>อีเมล</label><span class="text-danger">*</span>
							<input type="text" id="employemail_ceo" placeholder="อีเมล" class="form-control form-control-lg stringformat30">
						</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_ceo" class="btn bg-primary" ><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
			</div>
		</div>
	</div>
</div>



{{-- modal_add_employ --}}
<div id="modal_add_employ" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ผู้บริหารระดับสูง</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>คำนำหน้าชื่อ<span class="text-danger">*</span></label>
							<select id="employprefix" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-lg form-control-select2">
								@foreach ($prefixes as $prefix)
									<option value="{{$prefix->id}}" >{{$prefix->name}}</option> 
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-6" id="otherprefix_wrapper" hidden>
						<div class="form-group">
							<label>ระบุคำนำหน้าชื่อ</label>
							<input type="text" id="otherprefix" placeholder="ระบุ" class="form-control form-control-lg stringformat20">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ชื่อ</label><span class="text-danger">*</span>
							<input type="text" id="employname" placeholder="ชื่อ" class="form-control form-control-lg stringformat20">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>นามสกุล</label><span class="text-danger">*</span>
							<input type="text" id="employlastname" placeholder="นามสกุล" class="form-control form-control-lg stringformat20">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ตำแหน่ง<span class="text-danger">*</span></label>
							<div id="employ_position_wrapper"></div>
						</div>
					</div>
					<div class="col-md-6" id="employ_otherposition_wrapper" hidden>
						<div class="form-group">
							<label>ตำแหน่ง โปรดระบุ</label><span class="text-danger">*</span>
							<input type="text" id="otherboardposition" placeholder="ตำแหน่ง โปรดระบุ" class="form-control form-control-lg">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>โทรศัพท์</label><span class="text-danger">*</span>
							<input type="text" id="employphone" placeholder="โทรศัพท์" class="form-control form-control-lg numeralformathphone">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>โทรศัพท์มือถือ</label><span class="text-danger">*</span>
							<input type="text" id="employworkphone" placeholder="โทรศัพท์มือถือ" class="form-control form-control-lg numeralformathphone">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>อีเมล</label><span class="text-danger">*</span>
							<input type="text" id="employemail" placeholder="อีเมล" class="form-control form-control-lg stringformat30">
						</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_employ" class="btn bg-primary" ><i class="icon-spinner spinner mr-2" id="spinicon_add_employ" hidden></i><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
			</div>
		</div>
	</div>
</div>

<div id="modal_add_employ_research" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;นักวิจัย</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>คำนำหน้าชื่อ<span class="text-danger">*</span></label>
							<select id="employprefix_research" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-lg form-control-select2">
								@foreach ($prefixes as $prefix)
								    @if ($prefix->name != 'อื่นๆ')
									<option value="{{$prefix->id}}" >{{$prefix->name}}</option> 
									@endif
									
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-6" id="otherprefix_research_wrapper" hidden>
						<div class="form-group">
							<label>ระบุคำนำหน้าชื่อ</label>
							<input type="text" id="otherprefix_research" placeholder="ระบุ" class="form-control form-control-lg stringformat20">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ชื่อ</label><span class="text-danger">*</span>
							<input type="text" id="employname_research" placeholder="ชื่อ" class="form-control form-control-lg stringformat20">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>นามสกุล</label><span class="text-danger">*</span>
							<input type="text" id="employlastname_research" placeholder="นามสกุล" class="form-control form-control-lg stringformat20">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ตำแหน่ง<span class="text-danger">*</span></label>
							<div id="employ_position_research_wrapper"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>โทรศัพท์</label><span class="text-danger">*</span>
							<input type="text" id="employphone_research" placeholder="เบอร์โทรศัพท์" class="form-control form-control-lg numeralformathphone">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>โทรศัพท์มือถือ</label><span class="text-danger">*</span>
							<input type="text" id="employworkphone_research" placeholder="โทรศัพท์มือถือ" class="form-control form-control-lg numeralformathphone">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>อีเมล</label><span class="text-danger">*</span>
							<input type="text" id="employemail_research" placeholder="อีเมล" class="form-control form-control-lg stringformat30">
						</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_employ_research" class="btn bg-primary" data-dismiss="modal"><i class="icon-spinner spinner mr-2" id="spinicon_add_employ_research" hidden></i><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
			</div>
		</div>
	</div>
</div>

<div id="modal_add_employ_projectmember" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ทีมงานในโครงการ</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>คำนำหน้าชื่อ<span class="text-danger">*</span></label>
							<select id="employprefix_projectmember" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-lg form-control-select2">
								@foreach ($prefixes as $prefix)
									<option value="{{$prefix->id}}" >{{$prefix->name}}</option> 
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ชื่อ</label><span class="text-danger">*</span>
							<input type="text" id="employname_projectmember" placeholder="ชื่อ" class="form-control form-control-lg stringformat20">
						</div>
					</div>
					<div class="col-md-6" id="otherprefix_projectmember_wrapper" hidden>
						<div class="form-group">
							<label>ระบุคำนำหน้าชื่อ</label>
							<input type="text" id="otherprefix_projectmember" placeholder="ระบุ" class="form-control form-control-lg stringformat20">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>นามสกุล</label><span class="text-danger">*</span>
							<input type="text" id="employlastname_projectmember" placeholder="นามสกุล" class="form-control form-control-lg stringformat20">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ตำแหน่ง<span class="text-danger">*</span></label>
							<div id="employ_position_projectmember_wrapper"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>โทรศัพท์</label><span class="text-danger">*</span>
							<input type="text" id="employphone_projectmember" placeholder="โทรศัพท์" class="form-control form-control-lg numeralformathphone">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>โทรศัพท์มือถือ</label><span class="text-danger">*</span>
							<input type="text" id="employworkphone_projectmember" placeholder="โทรศัพท์มือถือ" class="form-control form-control-lg numeralformathphone">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>อีเมล</label><span class="text-danger">*</span>
							<input type="text" id="employemail_projectmember" placeholder="อีเมล" class="form-control form-control-lg stringformat30">
						</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_employ_projectmember" class="btn bg-primary" ><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
			</div>
		</div>
	</div>
</div>

{{-- modal_edit_employ --}}
<div id="modal_edit_employ" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog modal-full modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ข้อมูลบุคลากร</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
						<div class="card-body">
							<ul class="nav nav-tabs nav-tabs-highlight">
								<li class="nav-item bg-info-300" style="margin-right: 5px;border-right: 1px solid #778;"><a href="#left-icon-employinfo" id="employinfo_tab" class="nav-link active" data-toggle="tab">ข้อมูลส่วนตัว</a></li>
								<li class="nav-item bg-info-300" style="margin-right: 5px;border-right: 1px solid #778;"><a href="#left-icon-employeducation" id="employeducation_tab" class="nav-link" data-toggle="tab">ประวัติการศึกษา</a></li>
								<li class="nav-item bg-info-300" style="margin-right: 5px;border-right: 1px solid #778;"><a href="#left-icon-employexpereince" id="employexpereince_tab" class="nav-link" data-toggle="tab">ประวัติการทำงาน</a></li>
								<li class="nav-item bg-info-300" style="margin-right: 5px;border-right: 1px solid #778;"><a href="#left-icon-employtraining" id="employtraining_tab" class="nav-link" data-toggle="tab">ประวัติการฝึกอบรม</a></li>								
								<li class="nav-item bg-info-300" style="margin-right: 5px;border-right: 1px solid #778;"><a href="#left-icon-attachment" id="attachment_tab" class="nav-link" data-toggle="tab">เอกสารแนบ</a></li>	
							</ul>

							<div class="tab-content">
								<div class="tab-pane fade show active" id="left-icon-employinfo">
									<input type="text" id="employid" value="" hidden>
									<div class="row">
										<input type="text" id="employtype" hidden>
										<div class="col-md-4">
											<div class="form-group">
												<label>คำนำหน้าชื่อ<span class="text-danger">*</span></label>
												<div id="employprefix_wrapper"></div>
											</div>
										</div>
										<div class="col-md-4" id="get_otherprefix_wrapper" hidden>
											<div class="form-group">
												<label>ระบุคำนำหน้าชื่อ</label>
												<input type="text" id="getotherprefix" placeholder="ระบุ" class="form-control form-control-lg stringformat20" >
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>ชื่อ</label><span class="text-danger">*</span>
												<input type="text" id="employname_edit" placeholder="ชื่อ" class="form-control form-control-lg stringformat20" >
											</div>
										</div>
										<div class="col-md-4">
										<div class="form-group">
											<label>นามสกุล</label><span class="text-danger">*</span>
											<input type="text" id="employlastname_edit" placeholder="นามสกุล" class="form-control form-control-lg stringformat20" >
										</div>
										</div>

										<div class="col-md-4">
										<div class="form-group">
											<label>โทรศัพท์</label><span class="text-danger">*</span>
											<input type="text" id="employphone_edit" placeholder="โทรศัพท์" class="form-control form-control-lg numeralformathphone">
										</div>
										</div>
										<div class="col-md-4">
										<div class="form-group">
											<label>โทรศัพท์มือถือ</label><span class="text-danger">*</span>
											<input type="text" id="employworkphone_edit" placeholder="เบอร์โทรศัพท์" class="form-control form-control-lg numeralformathphone">
										</div>
										</div>
										<div class="col-md-4">
										<div class="form-group">
											<label>อีเมล</label><span class="text-danger">*</span>
											<input type="text" id="employemail_edit" placeholder="อีเมล" class="form-control form-control-lg stringformat30">
										</div>
										</div>
										<div class="col-md-12">
												<button id="btn_edit_employ" data-type="" data-id="" class="btn bg-primary float-right hiddenelement" ><i class="icon-spinner spinner mr-2" id="spinicon_edit_employ" hidden></i><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
											</div>
									</div>
							
									
									{{-- <div class="form-group"> --}}
										
									{{-- </div> --}}
									
								</div>

								<div class="tab-pane fade" id="left-icon-employeducation">
									
									<div class="form-group">	
										<a href="" class="btn btn-warning btn-icon btn-sm hiddenelement" data-toggle="modal" id="btnaddemployee"><i class="icon-add mr-2"></i>เพิ่ม</a>
										
									</div>
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead class="bg-info">
												<tr>
													<th >ระดับ</th>  
													<th>ชื่อสถานศึกษา</th>                                                                                    
													<th>สาขาวิชาเอก</th>       
													<th>ปีที่ศึกษา</th>  
													<th style="width:1%;white-space: nowrap">เพิ่มเติม</th>    
												</tr>
											</thead>
											<tbody id="fulltbp_companyemployeducation_wrapper_tr">    
											</tbody>
										</table>
									</div>

								</div>
								<div class="tab-pane fade" id="left-icon-employexpereince">
									<div class="form-group">	
										<a href="" class="btn btn-warning btn-icon btn-sm hiddenelement" data-toggle="modal" data-target="#modal_add_employexperience"><i class="icon-add mr-2"></i>เพิ่ม</a>
										
									</div>

									<div class="table-responsive">
										<table class="table table-bordered">
											<thead class="bg-info">
												<tr>
													<th>เริ่มต้น-สิ้นสุด</th>  
													<th>บริษัท</th>                                                                                    
													<th>ประเภทธุรกิจ</th>       
													<th>ตำแหน่งแรกเข้า</th>  
													<th>ตำแหน่งล่าสุด</th> 
													<th style="width:1%;white-space: nowrap">เพิ่มเติม</th>    
												</tr>
											</thead>
											<tbody id="fulltbp_companyemployexperience_wrapper_tr">    
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="left-icon-attachment">
									<div class="input-group">													
										<label for="">เอกสารแนบ (ไฟล์ขนาดไม่เกิน 2 MB) เช่น ประวัติย่อ, วุฒิการศึกษา, ใบรับรองวิชาชีพ, ใบรับรองคุณวุฒิ, อื่นๆ <button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement"  id="btnuploadboardattachment" onclick="document.getElementById('boardattachment').click();"><i class="icon-add mr-2"></i>อัปโหลดไฟล์</button></label>
									</div>
									<input type="file" style="display:none;" data-id="" id="boardattachment" name="boardattachment" accept="image/jpeg,image/gif,image/png,application/pdf"/>

									<div class="table-responsive">
										<table class="table table-bordered">
											<thead class="bg-info">
												<tr>
													<th>เอกสารแนบ</th>                                                                                  
													<th style="width:1%;white-space: nowrap">เพิ่มเติม</th>
												</tr>
											</thead>
											<tbody id="fulltbp_board_attachment_wrapper_tr">                             
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="left-icon-employtraining">
									
									<div class="form-group">	
										
										<a href="" class="btn btn-warning btn-icon btn-sm hiddenelement" data-toggle="modal" data-target="#modal_add_employtraining"><i class="icon-add mr-2"></i>เพิ่ม</a>
									</div>

									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr class="bg-info">
													<th>วัน เดือน ปี</th>  
													<th>หลักสูตร</th>                                                                                    
													<th>หน่วยงานผู้จัด</th>       
													<th style="width:1%;white-space: nowrap">เพิ่มเติม</th>    
												</tr>
											</thead>
											<tbody id="fulltbp_companyemploytraining_wrapper_tr">    
											</tbody>
										</table>
									</div>
								</div>

							</div>
						</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				{{-- <button id="btn_modal_edit_employ" class="btn bg-primary" data-dismiss="modal"><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button> --}}
			</div>
		</div>
	</div>
</div>
<div id="modal_add_employeducation" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ประวัติการศึกษา</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<label for="" class="text-danger">*กรุณาบันทึกวุฒิการศึกษาสูงสุดก่อน แล้วเรียงลำดับลงมา</label>
					<div class="col-md-6">
						<div class="form-group">
							<label>ระดับการศึกษา</label>
							<select id="educationlevel" data-placeholder="ระดับการศึกษา" class="form-control form-control-lg form-control-select2">
								@foreach ($educationlevels as $educationlevel)
									<option value="{{$educationlevel->id}}" >{{$educationlevel->name}}</option> 
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-6" id="othereducationlevel_wrapper" hidden>
						<div class="form-group">
							<label>ระบุระดับการศึกษา</label><span class="text-danger">*</span>
							<input type="text" id="othereducationlevel" placeholder="ระบุระดับการศึกษา" class="form-control form-control-lg stringformat30">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ชื่อสถานศึกษา</label><span class="text-danger">*</span>
							<input type="text" id="employeducationinstitute" placeholder="ชื่อสถานศึกษา" class="form-control form-control-lg stringformat30">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>สาขาวิชาเอก</label><span class="text-danger">*</span>
							<input type="text" id="employeducationmajor" placeholder="สาขาวิชาเอก" class="form-control form-control-lg stringformat20">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ปี พ.ศ. ที่เริ่มต้นศึกษา</label><span class="text-danger">*</span>
							<input type="text" id="employeducationyearstart" placeholder="" class="form-control form-control-lg numeralformatyear">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ปี พ.ศ. ที่สิ้นสุดศึกษา</label><span class="text-danger">*</span>
							<input type="text" id="employeducationyearend" placeholder="" class="form-control form-control-lg numeralformatyear">
						</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_employeducation" class="btn bg-primary" ><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
			</div>
		</div>
	</div>
</div>

{{-- modal_add_employexperience --}}
<div id="modal_add_employexperience" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ประวัติการทำงาน</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<label for="" class="text-danger">*กรุณาบันทึกประสบการณ์ทำงานจากปัจจุบันก่อน แล้วเรียงลำดับลงมา</label>
					<div class="col-md-6">
						<div class="form-group">
							<label>ปี พ.ศ. ที่เริ่มงาน</label><span class="text-danger">*</span>
							<input type="text" id="employexperiencestartdate" placeholder="" class="form-control form-control-lg numeralformatyear">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ปี พ.ศ. ที่สิ้นสุดงาน</label><span class="text-danger">*</span>
							<input type="text" id="employexperienceenddate" placeholder="" class="form-control form-control-lg numeralformatyear">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>บริษัท</label><span class="text-danger">*</span>
							<input type="text" id="employexperiencecompany" placeholder="บริษัท" class="form-control form-control-lg stringformat30">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ประเภทธุรกิจ</label><span class="text-danger">*</span>
							<input type="text" id="employexperiencebusinesstype" placeholder="ประเภทธุรกิจ" class="form-control form-control-lg stringformat30">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ตำแหน่งแรกเข้า</label><span class="text-danger">*</span>
							<input type="text" id="employexperiencestartposition" placeholder="ตำแหน่งแรกเข้า" class="form-control form-control-lg stringformat30">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ตำแหน่งล่าสุด</label><span class="text-danger">*</span>
							<input type="text" id="employexperienceendposition" placeholder="ตำแหน่งล่าสุด" class="form-control form-control-lg stringformat30">
						</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_employexperience" class="btn bg-primary"><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
			</div>
		</div>
	</div>
</div>

{{-- modal_add_employtraining --}}
<div id="modal_add_employtraining" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ประวัติการฝึกอบรม</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<label for="" class="text-danger">*กรุณาบันทึกประวัติการฝึกอบรมจากปัจจุบันก่อน แล้วเรียงลำดับลงมา</label>
					<div class="col-md-12">
						<div class="form-group">
							<label>วันที่ (วดป. เช่น {{date("d")}}/{{date("m")}}/{{intVal(date("Y"))+543}})</label><span class="text-danger">*</span>
							<input type="text" id="employtrainingdate" placeholder="วัน เดือน ปี" class="form-control form-control-lg dmyformat">
						</div>

						<div class="form-group">
							<label>หลักสูตร</label><span class="text-danger">*</span>
							<input type="text" id="employtrainingcourse" placeholder="หลักสูตร" class="form-control form-control-lg stringformat30">
						</div>
						<div class="form-group">
							<label>หน่วยงานผู้จัด</label><span class="text-danger">*</span>
							<input type="text" id="employtrainingowner" placeholder="หน่วยงานผู้จัด" class="form-control form-control-lg stringformat60">
						</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_employtraining" class="btn bg-primary"><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
			</div>
		</div>
	</div>
</div>

{{-- modal_add_stockholder --}}
<div id="modal_add_stockholder" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ผู้ถือหุ้น</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>ชื่อ-นามสกุล</label><span class="text-danger">*</span>
							<input type="text" id="employsearch" class="form-control form-control-lg">
							<div id="employsearch_wrapper" class="dropdown-menu" style="display: block; position: static; width: 100%; margin-top: 0; float: none; z-index: auto;" hidden>
								
							</div>
						</div>
						<div class="form-group">
							<label>ความสัมพันธ์กับ CEO</label><span class="text-danger">*</span>
							<input type="text" id="relationwithceo" placeholder="ความสัมพันธ์กับ CEO" class="form-control form-control-lg">
						</div>

					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_stockholder" class="btn bg-primary" ><i class="icon-spinner spinner mr-2" id="spinicon_add_stockholder" hidden></i><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
			</div>
		</div>
	</div>
</div>

{{-- modal_add_tectdevlevel --}}
<div id="modal_add_tectdevlevel" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ระดับของเทคโนโลยีและความใหม่ของผลิตภัณฑ์</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>รายละเอียดเทคโนโลยี</label><span class="text-danger">*</span>
							<input type="text" id="tectdevleveltechnology" placeholder="รายการ" class="form-control form-control-lg stringformat60">
						</div>
						<div class="form-group">
							<label>เทคโนโลยีที่มีอยู่ในปัจจุบัน</label><span class="text-danger">*</span>
							<input type="text" id="tectdevleveltechnologypresent" placeholder="เทคโนโลยีที่มีอยู่ในปัจจุบัน" class="form-control form-control-lg stringformat200">
						</div>
						<div class="form-group">
							<label>เทคโนโลยีในโครงการ</label><span class="text-danger">*</span>
							<input type="text" id="tectdevleveltechnologyproject" placeholder="เทคโนโลยีในโครงการ" class="form-control form-control-lg stringformat200">
						</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_tectdevlevel" data-id="{{$fulltbp->id}}" class="btn bg-primary" ><i class="icon-spinner spinner mr-2" id="spinicon_add_tectdevlevel" hidden></i><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
			</div>
		</div>
	</div>
</div>

{{-- modal_add_certify --}}
<div id="modal_add_certify" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เอกสารแนบสิทธิบัตรการประดิษฐ์/การออกแบบ/อนุสิทธิบัตร</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>ชื่อเอกสาร <small>เช่น เอกสารแนบสิทธิบัตรการประดิษฐ์/การออกแบบ/อนุสิทธิบัตร</small></label><span class="text-danger">*</span>
							<input type="text" id="certifyname" placeholder="โปรดระบุชื่อเอกสาร" class="form-control form-control-lg stringformat30">
						</div>
					</div>
					<div class="col-md-12">	
						<div class="input-group">													
							<button class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('certify').click();" >อัปโหลดไฟล์</button>													
						</div>
						{{-- <input type="file" style="display:none;"  data-id="{{$fulltbpprojectcertify->id}}" id="certify" name="certify" accept="image/jpeg,image/gif,image/png,application/pdf"/> --}}
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				
			</div>
		</div>
	</div>
</div>

{{-- modal_add_bmc --}}
<div id="modal_add_bmc" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เอกสารแนบ Business Model Canvas</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>ชื่อเอกสาร <small>เช่น เอกสารแนบ Business Model Canvas</small></label><span class="text-danger">*</span>
							<input type="text" id="bmcname" placeholder="โปรดระบุชื่อเอกสาร" class="form-control form-control-lg stringformat30">
						</div>
					</div>
					{{-- <div class="col-md-12">	
						<div class="input-group">													
							<button class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('businessmodelcanvas').click();" >อัปโหลดไฟล์</button>													
						</div>
						<input type="file" style="display:none;"  data-id="{{$fulltbpprojectcertify->id}}" id="businessmodelcanvas" name="businessmodelcanvas" accept="image/jpeg,image/gif,image/png,application/pdf"/>
					</div> --}}
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				
			</div>
		</div>
	</div>
</div>

{{-- modal_add_swot --}}
<div id="modal_add_swot" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เอกสารแนบ SWOT Analysis, Five Forces Analysis</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>ชื่อเอกสาร <small>เช่น เอกสารแนบ SWOT Analysis, Five Forces Analysis</small></label><span class="text-danger">*</span>
							<input type="text" id="swotname" placeholder="โปรดระบุชื่อเอกสาร" class="form-control form-control-lg stringformat30">
						</div>
					</div>
					{{-- <div class="col-md-12">	
						<div class="input-group">													
							<button class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('swotfile').click();" >อัปโหลดไฟล์</button>													
						</div>
						<input type="file" style="display:none;"  data-id="{{$fulltbpprojectcertify->id}}" id="swotfile" name="swotfile" accept="image/jpeg,image/gif,image/png,application/pdf"/>
					</div> --}}
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				
			</div>
		</div>
	</div>
</div>

{{-- modal_add_award --}}
<div id="modal_add_award" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;รางวัลด้านเทคโนโลยี/นวัตกรรม</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>ชื่อรางวัล <small>เช่น ด้านเทคโนโลยี/นวัตกรรมที่ได้รับ </small></label><span class="text-danger">*</span>
							<input type="text" id="awardname" placeholder="โปรดระบุชื่อเอกสาร" class="form-control form-control-lg stringformat30">
						</div>
					</div>
					{{-- <div class="col-md-12">	
						<div class="input-group">													
							<button id="btnuploadcertify" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('award').click();" >อัปโหลดไฟล์</button>													
						</div>
						<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="award" name="award" accept="image/jpeg,image/gif,image/png,application/pdf"/>
					</div> --}}
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				
			</div>
		</div>
	</div>
</div>

{{-- modal_add_standard --}}
<div id="modal_add_standard" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ใบรับรองมาตรฐาน</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>ชื่อเอกสาร <small>เช่น ใบรับรองมาตรฐาน เช่น ISO, อย., มอก., GMP, HACCP, CMMI</small></label><span class="text-danger">*</span>
							<input type="text" id="standardname" placeholder="โปรดระบุชื่อเอกสาร" class="form-control form-control-lg stringformat30">
						</div>
					</div>
					{{-- <div class="col-md-12">	
						<div class="input-group">													
							<button id="btnuploadstandard" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('standard').click();" >อัปโหลดไฟล์</button>													
						</div>
						<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="standard" name="standard" accept="image/jpeg,image/gif,image/png,application/pdf"/>
					</div> --}}
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				{{-- <button id="btn_modal_add_standard" class="btn bg-primary" data-dismiss="modal"><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button> --}}
			</div>
		</div>
	</div>
</div>


{{-- modal_add_projectplan --}}
<div id="modal_add_projectplan" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;แผนการดำเนินงาน</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>รายละเอียด</label><span class="text-danger">*</span>
							<input type="text" id="plandetail" placeholder="โปรดระบุแผนการดำเนินงาน" class="form-control form-control-lg">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label class="font-weight-semibold">เลือกเดือนที่ดำเนินการ</label>
						<div class="row ml-2" id="month_wrapper">
						</div>
					</div>
					
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_projectplan" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-spinner spinner mr-2" id="spinicon_add_projectplan" hidden></i><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
			</div>
		</div>
	</div>
</div>

{{-- modal_edit_projectplan --}}
<div id="modal_edit_projectplan" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;แผนการดำเนินงาน</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<input type="text" id="projectplan" value="" hidden >
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>รายละเอียดการดำเนินงาน</label><span class="text-danger">*</span>
							<input type="text" id="plandetail_edit" placeholder="โปรดระบุแผนการดำเนินงาน" class="form-control form-control-lg">
						</div>
					</div>
				</div>

				<div class="row">
					
					<div class="col-md-12">
						<label class="font-weight-semibold">เลือกเดือนที่ดำเนินการ</label>
						<div class="form-group" id="monthplan">
						</div>
					</div>
					
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_edit_projectplan" class="btn bg-primary" data-id="{{$fulltbp->id}}" data-dismiss="modal"><i class="icon-spinner spinner mr-2" id="spinicon_edit_projectplan" hidden></i><i class="icon-pencil font-size-base mr-1"></i> แก้ไข</button>
			</div>
		</div>
	</div>
</div>

	{{-- modal_add_tectdevlevel --}}
	<div id="modal_add_sell" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ยอดขาย (หน่วยบาท)</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>ชื่อผลิตภัณฑ์</label><span class="text-danger">*</span>
								<input type="text" id="productname" placeholder="ชื่อผลิตภัณฑ์" class="form-control form-control-lg stringformat30">
							</div>
							<div class="form-group">
								<label>ยอดขายปีปัจจุบัน ({{$fulltbp->presentyear}})</label><span class="text-danger">*</span>
								<input type="text" id="sellpresent" placeholder="ยอดขายปีปัจจุบัน ({{$fulltbp->presentyear}})" class="form-control form-control-lg numeralformat10">
							</div>
							<div class="form-group">
								<label>ยอดขายปี{{$fulltbp->past1}}</label><span class="text-danger">*</span>
								<input type="text" id="sellpast1" placeholder="ยอดขายปี{{$fulltbp->past1}}" class="form-control form-control-lg numeralformat10">
							</div>
							<div class="form-group">
								<label>ยอดขายปี{{$fulltbp->past2}}</label><span class="text-danger">*</span>
								<input type="text" id="sellpast2" placeholder="ยอดขายปี{{$fulltbp->past2}}" class="form-control form-control-lg numeralformat10">
							</div>
							<div class="form-group">
								<label>ยอดขายปี{{$fulltbp->past3}}</label><span class="text-danger">*</span>
								<input type="text" id="sellpast3" placeholder="ยอดขายปี{{$fulltbp->past3}}" class="form-control form-control-lg numeralformat10">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_add_sell" data-id="{{$fulltbp->id}}" class="btn bg-primary" ><i class="icon-spinner spinner mr-2" id="spinicon_add_sell" hidden></i><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
				</div>
			</div>
		</div>
	</div>

	{{-- modal_edit_sell --}}
	<div id="modal_edit_sell" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ข้อมูลยอดขาย</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<input type="text" id="sellid" value="" hidden >
							<div class="form-group">
								<label>ชื่อผลิตภัณฑ์</label><span class="text-danger">*</span>
								<input type="text" id="productnameedit" placeholder="ชื่อผลิตภัณฑ์" class="form-control form-control-lg stringformat30">
							</div>
							<div class="form-group">
								<label>ปีปัจจุบัน ({{$fulltbp->presentyear}})</label><span class="text-danger">*</span>
								<input type="text" id="sellpresentedit" placeholder="ปีปัจจุบัน ({{$fulltbp->presentyear}})" class="form-control form-control-lg numeralformat10">
							</div>
							<div class="form-group">
								<label>ปี {{$fulltbp->past1}}</label><span class="text-danger">*</span>
								<input type="text" id="sellpastedit1" placeholder="ปี{{$fulltbp->past1}}" class="form-control form-control-lg numeralformat10">
							</div>
							<div class="form-group">
								<label>ปี {{$fulltbp->past2}}</label><span class="text-danger">*</span>
								<input type="text" id="sellpastedit2" placeholder="ปี{{$fulltbp->past2}}" class="form-control form-control-lg numeralformat10">
							</div>
							<div class="form-group">
								<label>ปี {{$fulltbp->past3}}</label><span class="text-danger">*</span>
								<input type="text" id="sellpastedit3" placeholder="ปี{{$fulltbp->past3}}" class="form-control form-control-lg numeralformat10">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_edit_sell" data-id="{{$fulltbp->id}}" class="btn bg-primary" ><i class="icon-spinner spinner mr-2" id="spinicon_edit_sell" hidden></i><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
				</div>
			</div>
		</div>
	</div>

	{{-- modal_edit_sellstatus --}}
	<div id="modal_edit_sellstatus" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;รายการ</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<input type="text" id="sellstatusid" value="" hidden >
							<div class="form-group">
								<label>รายการยอดขาย</label><span class="text-danger">*</span>
								<input type="text" id="sellstatus" placeholder="รายการ" class="form-control form-control-lg" readonly>
							</div>
							<div class="form-group">
								<label>ยอดขายปีปัจจุบัน ({{$fulltbp->presentyear}})</label><span class="text-danger">*</span>
								<input type="text" id="sellstatuspresentedit" placeholder="ปีปัจจุบัน ({{$fulltbp->presentyear}})" class="form-control form-control-lg numeralformat10">
							</div>
							<div class="form-group">
								<label>ยอดขายปี {{$fulltbp->past1}}</label><span class="text-danger">*</span>
								<input type="text" id="sellstatuspastedit1" placeholder="ปี {{$fulltbp->past1}}" class="form-control form-control-lg numeralformat10">
							</div>
							<div class="form-group">
								<label>ยอดขายปี {{$fulltbp->past2}}</label><span class="text-danger">*</span>
								<input type="text" id="sellstatuspastedit2" placeholder="ปี {{$fulltbp->past2}}" class="form-control form-control-lg numeralformat10">
							</div>
							<div class="form-group">
								<label>ยอดขายปี {{$fulltbp->past3}}</label><span class="text-danger">*</span>
								<input type="text" id="sellstatuspastedit3" placeholder="ปี {{$fulltbp->past3}}" class="form-control form-control-lg numeralformat10">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_edit_sellstatus" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-spinner spinner mr-2" id="spinicon_edit_sellstatus" hidden></i><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
				</div>
			</div>
		</div>
	</div>

	{{-- modal_add_debtpartner --}}
	<div id="modal_add_debtpartner" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ลูกหนี้การค้า</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>ลูกหนี้การค้า</label><span class="text-danger">*</span>
								<input type="text" id="debtpartner" placeholder="" class="form-control form-control-lg stringformat30" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>จำนวนผลิตภัณฑ์หรือโครงการ</label><span class="text-danger">*</span>
								<input type="text" id="numproject" placeholder="" class="form-control form-control-lg numeralformat3">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)</label><span class="text-danger">*</span>
								<input type="text" id="debtpartnertaxid" placeholder="" class="form-control form-control-lg numeralformath13">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>ยอดขายต่อปี (บาท)</label><span class="text-danger">*</span>
								<input type="text" id="debttotalyearsell" placeholder="" class="form-control form-control-lg numeralformat10">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>เปรียบเทียบกับยอดขาย (%)</label><span class="text-danger">*</span>
								<input type="text" id="debtpercenttosale" placeholder="" class="form-control form-control-lg numeralformat2">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)</label><span class="text-danger">*</span>
								<input type="text" id="debtpartneryear" placeholder="" class="form-control form-control-lg numeralformat3">
							</div>
						</div>
			
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_add_debtpartner" data-id="{{$fulltbp->id}}" class="btn bg-primary"><i class="icon-spinner spinner mr-2" id="spinicon_add_debtpartner" hidden></i><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
				</div>
			</div>
		</div>
	</div>

		{{-- modal_edit_debtpartner --}}
		<div id="modal_edit_debtpartner" class="modal fade" style="overflow:hidden;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ลูกหนี้การค้า</h5>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<input type="text" id="debtpartnerid" value="" hidden >
								<div class="form-group">
									<label>ลูกหนี้การค้า</label><span class="text-danger">*</span>
									<input type="text" id="debtpartneredit" placeholder="" class="form-control form-control-lg stringformat30" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>จำนวนผลิตภัณฑ์หรือโครงการ</label><span class="text-danger">*</span>
									<input type="text" id="numprojectedit" placeholder="" class="form-control form-control-lg numeralformat3">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)</label><span class="text-danger">*</span>
									<input type="text" id="debtpartnertaxidedit" placeholder="" class="form-control form-control-lg numeralformath13">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>ยอดขายต่อปี (บาท)</label><span class="text-danger">*</span>
									<input type="text" id="debttotalyearselledit" placeholder="" class="form-control form-control-lg numeralformat10">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>เปรียบเทียบกับยอดขาย (%)</label><span class="text-danger">*</span>
									<input type="text" id="debtpercenttosaleedit" placeholder="" class="form-control form-control-lg numeralformat2">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)</label><span class="text-danger">*</span>
									<input type="text" id="debtpartneryearedit" placeholder="" class="form-control form-control-lg numeralformat3">
								</div>
							</div>
						</div>
					</div>           
					<div class="modal-footer">
						<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
						<button id="btn_modal_edit_debtpartner" data-id="{{$fulltbp->id}}" class="btn bg-primary" ><i class="icon-spinner spinner mr-2" id="spinicon_edit_debtpartner" hidden></i><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
					</div>
				</div>
			</div>
		</div>

	{{-- modal_add_creditpartner --}}
	<div id="modal_add_creditpartner" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เจ้าหนี้การค้า</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>เจ้าหนี้การค้า</label><span class="text-danger">*</span>
								<input type="text" id="creditpartner" placeholder="" class="form-control form-control-lg stringformat30" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)</label><span class="text-danger">*</span>
								<input type="text" id="creditpartnertaxid" placeholder="" class="form-control form-control-lg numeralformath13">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>ยอดซื้อต่อปี (บาท)</label><span class="text-danger">*</span>
								<input type="text" id="credittotalyearsell" placeholder="" class="form-control form-control-lg numeralformat10">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>เปรียบเทียบกับยอดซื้อ (%)</label><span class="text-danger">*</span>
								<input type="text" id="creditpercenttosale" placeholder="" class="form-control form-control-lg numeralformat2">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)</label><span class="text-danger">*</span>
								<input type="text" id="creditpartneryear" placeholder="" class="form-control form-control-lg numeralformat3">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_add_creditpartner" data-id="{{$fulltbp->id}}" class="btn bg-primary" ><i class="icon-spinner spinner mr-2" id="spinicon_add_creditpartner" hidden></i><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
				</div>
			</div>
		</div>
	</div>

	{{-- modal_edit_creditpartner --}}
	<div id="modal_edit_creditpartner" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เจ้าหนี้การค้า</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<input type="text" id="creditpartnerid" value="" hidden >
						<div class="col-md-6">
							<div class="form-group">
								<label>เจ้าหนี้การค้า</label><span class="text-danger">*</span>
								<input type="text" id="creditpartneredit" placeholder="" class="form-control form-control-lg stringformat30" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)</label><span class="text-danger">*</span>
								<input type="text" id="creditpartnertaxidedit" placeholder="" class="form-control form-control-lg numeralformath13">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>ยอดซื้อต่อปี (บาท)</label><span class="text-danger">*</span>
								<input type="text" id="credittotalyearselledit" placeholder="" class="form-control form-control-lg numeralformat10">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>เปรียบเทียบกับยอดซื้อ (%)</label><span class="text-danger">*</span>
								<input type="text" id="creditpercenttosaleedit" placeholder="" class="form-control form-control-lg numeralformat2">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)</label><span class="text-danger">*</span>
								<input type="text" id="creditpartneryearedit" placeholder="" class="form-control form-control-lg numeralformat3">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_edit_creditpartner" data-id="{{$fulltbp->id}}" class="btn bg-primary"><i class="icon-spinner spinner mr-2" id="spinicon_edit_creditpartner" hidden></i><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
				</div>
			</div>
		</div>
	</div>

	
	{{-- modal_edit_asset --}}
	<div id="modal_edit_asset" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เงินลงทุนในสินทรัพย์ถาวรของโครงการ</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<input type="text" id="assetid" value="" hidden >
							<div class="form-group">
								<label>รายการ</label><span class="text-danger">*</span>
								<input type="text" id="asset" placeholder="รายการ" class="form-control form-control-lg " readonly >
							</div>
							<div class="form-group">
								<label>จำนวนเงิน (บาท)</label><span class="text-danger">*</span>
								<input type="text" id="assetcostedit" placeholder="จำนวนเงิน (บาท)" class="form-control form-control-lg numeralformat10">
							</div>
							<div class="form-group">
								<label>จำนวน (<span id="unit">หน่วย</span>)</label><span class="text-danger">*</span>
								<input type="text" id="assetquantityedit" placeholder="จำนวน (หน่วย)" class="form-control form-control-lg numeralformat10">
							</div>
							<div class="form-group">
								<label>ราคาต่อหน่วย (บาท)</label><span class="text-danger">*</span>
								<input type="text" id="assetpriceedit" placeholder="ราคาต่อหน่วย (บาท)" class="form-control form-control-lg numeralformat10">
							</div>
							<div class="form-group">
								<label>ข้อมูลจำเพาะทางเทคนิค (Specification)</label><span class="text-danger">*</span>
								<input type="text" id="assetspecificationedit" placeholder="ข้อมูลจำเพาะทางเทคนิค (Specification)" class="form-control form-control-lg">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_edit_asset" data-id="{{$fulltbp->id}}" class="btn bg-primary" ><i class="icon-spinner spinner mr-2" id="spinicon_edit_asset" hidden></i><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
				</div>
			</div>
		</div>
	</div>

	{{-- modal_edit_investment --}}
	<div id="modal_edit_investment" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เงินลงทุนสำหรับการดำเนินการโครงการ</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<input type="text" id="investmentid" value="" hidden >
							<div class="form-group">
								<label>รายการ</label><span class="text-danger">*</span>
								<input type="text" id="investment" placeholder="รายการ" class="form-control form-control-lg" readonly >
							</div>
							<div class="form-group">
								<label>จำนวนเงิน (บาท)</label><span class="text-danger">*</span>
								<input type="text" id="investmentcostedit" placeholder="จำนวนเงิน (บาท)" class="form-control form-control-lg numeralformat10">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_edit_investment" data-id="{{$fulltbp->id}}" class="btn bg-primary" ><i class="icon-spinner spinner mr-2" id="spinicon_edit_investment" hidden></i><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
				</div>
			</div>
		</div>
	</div>

	{{-- modal_edit_cost --}}
	<div id="modal_edit_cost" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;<span id="sourcetitle"></span></h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<input type="text" id="costid" value="" hidden >
							<div class="form-group">
								<label>แหล่งเงินทุน</label><span class="text-danger">*</span>
								<input type="text" id="costnameedit" placeholder="แหล่งเงินทุน" class="form-control form-control-lg" readonly >
							</div>
							<div class="form-group">
								<label>เงินทุนที่มีอยู่แล้ว</label><span class="text-danger">*</span>
								<input type="text" id="costexistingedit" placeholder="เงินทุนที่มีอยู่แล้ว" class="form-control form-control-lg numeralformat10">
							</div>
							<div class="form-group">
								<label>เงินทุนที่เสนอขออนุมัติ</label><span class="text-danger">*</span>
								<input type="text" id="costneededit" placeholder="เงินทุนที่เสนอขออนุมัติ" class="form-control form-control-lg numeralformat10">
							</div>
							<div class="form-group">
								<label>เงินทุนที่ได้รับการอนุมัติแล้ว</label><span class="text-danger">*</span>
								<input type="text" id="costapprovededit" placeholder="เงินทุนที่ได้รับการอนุมัติแล้ว" class="form-control form-control-lg numeralformat10">
							</div>
							<div class="form-group">
								<label>แผนการหาเงินทุนเพิ่ม</label><span class="text-danger">*</span>
								<input type="text" id="costplanedit" placeholder="แผนการหาเงินทุนเพิ่ม" class="form-control form-control-lg numeralformat10">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_edit_cost" data-id="{{$fulltbp->id}}" class="btn bg-primary" ><i class="icon-spinner spinner mr-2" id="spinicon_edit_cost" hidden></i><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
				</div>
			</div>
		</div>
	</div>

{{-- modal_add_companydoc --}}
<div id="modal_add_companydoc" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เอกสารแนบข้อมูลทั่วไป</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						{{-- <div class="form-group"> --}}
							<label>อัปโหลดไฟล์เอกสาร เช่น หนังสือบริคณห์สนธิ (บอจ.2), สำเนาบัญชีรายชื่อผู้ถือหุ้น (บอจ.5), สำเนาหนังสือรับรองการจดทะเบียนพาณิชย์ หรืออื่นๆ</label>
							{{-- <input type="text" id="companydocname" placeholder="โปรดระบุชื่อเอกสาร" class="form-control form-control-lg stringformat30"> --}}
						{{-- </div> --}}
					</div>
					<div class="col-md-12">	
						<div class="input-group">													
							{{-- <button class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('companygeneraldoc').click();" >อัปโหลดไฟล์</button>													 --}}
						</div>
						{{-- <input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="companygeneraldoc" name="companygeneraldoc" accept="image/jpeg,image/gif,image/png,application/pdf"/> --}}
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				{{-- <button id="btn_modal_add_companydoc" class="btn bg-primary" data-dismiss="modal"><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button> --}}
			</div>
		</div>
	</div>
</div>

{{-- modal_add_researcher --}}
<div id="modal_add_researcher" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;นักวิจัย</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>คำนำหน้าชื่อ</label>
									<select id="researcherfix" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-lg form-control-select2">
										@foreach ($prefixes as $prefix)
											<option value="{{$prefix->id}}" >{{$prefix->name}}</option> 
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>ชื่อ</label>
									<input type="text" id="researchername" placeholder="ชื่อ" class="form-control form-control-lg">
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label>นามสกุล</label>
									<input type="text" id="researcherlastname" placeholder="นามสกุล" class="form-control form-control-lg">
								</div>
							</div>
						</div>
				
					</div>
					<div class="col-md-12">
							<div class="form-group">
								<label>ประวัติการศึกษา</label>
								<input type="text" id="researchereducation" placeholder="ประวัติการศึกษา" class="form-control form-control-lg">
							</div>
							<div class="form-group">
								<label>ประสบการณ์การทำงาน</label>
								<input type="text" id="researcherexperience" placeholder="ประสบการณ์การทำงาน" class="form-control form-control-lg">
							</div>
							<div class="form-group">
								<label>ประวัติการฝึกอบรม</label>
								<input type="text" id="researchertraining" placeholder="ประวัติการฝึกอบรม" class="form-control form-control-lg">
							</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_researcher" class="btn bg-primary" data-dismiss="modal"><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
			</div>
		</div>
	</div>
</div>


{{-- modal_add_projectmember --}}
<div id="modal_add_projectmember" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ทีมงานในโครงการ</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>คำนำหน้าชื่อ</label>
									<select id="projectmemberfix" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-lg form-control-select2">
										@foreach ($prefixes as $prefix)
											<option value="{{$prefix->id}}" >{{$prefix->name}}</option> 
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>ชื่อ</label>
									<input type="text" id="projectmembername" placeholder="ชื่อ" class="form-control form-control-lg">
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label>นามสกุล</label>
									<input type="text" id="projectmemberlastname" placeholder="นามสกุล" class="form-control form-control-lg">
								</div>
							</div>
						</div>
				
					</div>
					<div class="col-md-12">
							<div class="form-group">
								<label>ประวัติการศึกษา</label>
								<input type="text" id="projectmembereducation" placeholder="ประวัติการศึกษา" class="form-control form-control-lg">
							</div>
							<div class="form-group">
								<label>ประสบการณ์การทำงาน</label>
								<input type="text" id="projectmemberexperience" placeholder="ประสบการณ์การทำงาน" class="form-control form-control-lg">
							</div>
							<div class="form-group">
								<label>ประวัติการฝึกอบรม</label>
								<input type="text" id="projectmembertraining" placeholder="ประวัติการฝึกอบรม" class="form-control form-control-lg">
							</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_projectmember" class="btn bg-primary" data-dismiss="modal"><i class="icon-floppy-disk font-size-base mr-1"></i> บันทึก</button>
			</div>
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

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
			{{-- <div class="text-right">
				<button type="button" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
			</div> --}}
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    {{-- <a href="{{route('dashboard.company.project.fulltbp')}}" class="breadcrumb-item"> แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)</a> --}}
                    <span class="breadcrumb-item active">แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)</span>
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
	

				<div class="card">

					<div class="card-body">


					<input type="text" id="companyid" value="{{$company->id}}" hidden>
					<input type="text" id="fulltbpid" value="{{$fulltbp->id}}" hidden>
						<form class="wizard-form steps-basic" action="#" data-fouc>
							<h6>1.ข้อมูลทั่วไป</h6>
							<input type="text" id="pdfname" hidden >
							@if ($fulltbp->refixstatus !=4 && ($fulltbp->refixstatus == 0 || $fulltbp->refixstatus == 2 ))
									<input type="text" id="fulltbpstatus" value="1" hidden>
								@else
									
									<input type="text" id="fulltbpstatus" value="2" hidden>
							@endif
							<fieldset>
								<div id="accordion-group">

									<div class="row">
										<div class="col-md-12">
											<div class="card card-body border-top-info-400">
												<div class="card-body">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label ><strong>1.1) ชื่อนิติบุคคล</strong></label><span class="text-danger">*</span>
																<input type="text"  value="{{$fulltbp->minitbp->businessplan->company->name}}"  placeholder="ชื่อนิติบุคคล" class="form-control form-control-lg" readonly>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label><strong>1.2) ทะเบียนนิติบุคคลเลขที่</strong></label><span class="text-danger">*</span>
																<input type="text" value="{{$fulltbp->minitbp->businessplan->company->vatno}}"  placeholder="เลขทะเบียนนิติบุคคล" class="form-control form-control-lg" readonly>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label><strong>1.3) ปีที่จดทะเบียน</strong></label><span class="text-danger">*</span>
																<input type="text"  value="{{$fulltbp->minitbp->businessplan->company->registeredyear}}"  placeholder="ปีที่จดทะเบียน" class="form-control form-control-lg" readonly>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label><strong>1.4) ทุนที่จดทะเบียน</strong></label><span class="text-danger">*</span>
																<input type="text" value="{{$fulltbp->minitbp->businessplan->company->registeredcapital}}"  placeholder="ทุนที่จดทะเบียน" class="form-control form-control-lg" readonly>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label><strong>1.5) ทุนจดทะเบียนที่เรียกชำระแล้ว</strong></label><span class="text-danger">*</span>
																<input type="text"  value="{{$fulltbp->minitbp->businessplan->company->paidupcapital}}"  placeholder="ทุนจดทะเบียนที่เรียกชำระแล้ว" class="form-control form-control-lg" readonly>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label><strong>วันที่ชำระทุนจดทะเบียน</strong></label><span class="text-danger">*</span>
																<input type="text" value="{{$fulltbp->minitbp->businessplan->company->paidupcapitaldateth}}"  placeholder="ทุนจดทะเบียนที่เรียกชำระแล้ว" class="form-control form-control-lg" readonly>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label><strong>1.6) แผนผังองค์กร (Organization Chart)</strong><span class="text-danger">*</span> (ไฟล์ jpg, png ขนาด 600 x 400px ขนาดไม่เกิน 1 MB)</label>
																<span id="organizationcharterror" class="form-text text-danger mb-2" hidden >*กรุณาเพิ่มแผนผังองค์กร</span>
																<button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement" onclick="document.getElementById('organizeimg').click();"><i class="icon-add mr-2"></i>อัปโหลด</button>
																	<input type="file" style="display:none;" id="organizeimg" data-id="{{$fulltbp->minitbp->businessplan->company->id}}" name="organizeimg" accept="image/*"/>
																<div class="text-center">
																	
																	@if (!Empty($fulltbp->minitbp->businessplan->company->organizeimg))
																		<br>
																		<img id="organizeimgholder" src="{{asset($fulltbp->minitbp->businessplan->company->organizeimg)}}" width="500" height="300" alt="">
																		@else
																		<br>
																		<img id="organizeimgholder" src="{{asset('assets/dashboard/images/orgimg.png')}}" width="500" height="300" alt="">
																	@endif
																</div>

															</div>
														</div>
														<div class="col-md-12">
															<label for="" style="font-size: 16px"><strong>1.7) จำนวนบุคลากรทั้งหมด</strong><span class="text-danger">*</span></label>
														</div>
														<div class="col-md-12">
															<div class="row">
																<div class="col-md-12">
																	<div class="form-group">
																		{{-- <label>จำนวนบุคลากรทั้งหมด</label><span class="text-danger">*</span> --}}
																		<input type="text" name ="department_qty" id ="department_qty" value="{{intval($fulltbpemployee->department_qty)}}" class="form-control form-control-lg numeralformat4" required >
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="form-group">
																		<label>ฝ่ายบริหาร</label><span class="text-danger">*</span>
																		<input type="text" name ="department1_qty"  id ="department1_qty" value="{{intval($fulltbpemployee->department1_qty)}}" class="form-control form-control-lg numeralformat4" required>
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="form-group">
																		<label>ฝ่ายวิจัยและพัฒนา</label><span class="text-danger">*</span>
																		<input type="text" name ="department2_qty" id ="department2_qty" value="{{intval($fulltbpemployee->department2_qty)}}" class="form-control form-control-lg numeralformat4" required>
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="form-group">
																		<label>ฝ่ายผลิต/วิศวกรรม</label><span class="text-danger">*</span>
																		<input type="text" name ="department3_qty" id ="department3_qty" value="{{intval($fulltbpemployee->department3_qty)}}" class="form-control form-control-lg numeralformat4" required>
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="form-group">
																		<label>ฝ่ายการตลาด</label><span class="text-danger">*</span>
																		<input type="text" name ="department4_qty" id ="department4_qty" value="{{intval($fulltbpemployee->department4_qty)}}" class="form-control form-control-lg numeralformat4" required>
																	</div>
																</div>
																<div class="col-md-3">
																	<div class="form-group">
																		<label>พนักงานทั่วไป</label><span class="text-danger">*</span>
																		<input type="text" name ="department5_qty" id ="department5_qty" value="{{intval($fulltbpemployee->department5_qty)}}" class="form-control form-control-lg numeralformat4" required>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label><strong>1.8) ประเภทธุรกิจ</strong></label><span class="text-danger">*</span>
																<select name="businesstype" id="businesstype" data-placeholder="ประเภทธุรกิจ" class="form-control form-control-lg form-control-select2" data-fouc>
																	<option value="" >==เลือกรายการ==</option> 
																	@foreach ($businesstypes as $businesstype)
																		<option value="{{$businesstype->id}}" @if($fulltbp->minitbp->businessplan->company->business_type_id == $businesstype->id) selected @endif >{{$businesstype->name}}</option> 
																	@endforeach
																</select>
															</div>
														</div>
					
												
														<div class="col-md-12">
															<label><strong>1.9) ประวัติบริษัท (Company Profile)</strong></label><span class="text-danger">*</span>
															<div class="form-group">
																<label for=""><i>รายละเอียด (การก่อตั้ง การเพิ่มทุน การเปลี่ยนแปลงชื่อบริษัท หรือการเปลี่ยนแปลงทางธุรกิจ ฯลฯ) </i><span id="companyhistoryerror" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span> </label>
																<textarea name="companyhistory" id="companyhistory" class="form-control form-control-lg summernoteelement" cols="3" rows="7" required >{!!$fulltbp->minitbp->businessplan->company->companyhistory!!}</textarea>
															</div>
															
															<div class="row">
																<div class="col-md-12">	
																	<div class="input-group">													
																		{{-- <label for="">แนบเอกสารข้อมูลทั่วไปของบริษัท <i>(หนังสือบริคณห์สนธิ (บอจ.2), สำเนาบัญชีรายชื่อผู้ถือหุ้น (บอจ.5), สำเนาหนังสือรับรองการจดทะเบียนพาณิชย์ หรืออื่นๆ ไฟล์ pdf ขนาดไม่เกิน 2 MB)</i><button type="button" class="btn btn-warning btn-icon ml-2 btn-sm " data-toggle="modal" data-target="#modal_add_companydoc"><i class="icon-add mr-2"></i>อัปโหลด</button></label> --}}
																		@if ($fulltbp->minitbp->businessplan->business_plan_status_id < 9)
																		<label for="">แนบเอกสารข้อมูลทั่วไปของบริษัท <i>(หนังสือบริคณห์สนธิ (บอจ.2), สำเนาบัญชีรายชื่อผู้ถือหุ้น (บอจ.5), สำเนาหนังสือรับรองการจดทะเบียนพาณิชย์ หรืออื่นๆ ไฟล์ pdf ขนาดไม่เกิน 2 MB)</i>
																			<button type="button" class="btn btn-warning btn-icon ml-2 btn-sm " onclick="document.getElementById('companygeneraldoc').click();"><i class="icon-add mr-2"></i>อัปโหลด</button></label>
																		<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="companygeneraldoc" name="companygeneraldoc" accept="image/jpeg,image/gif,image/png,application/pdf"/>
																		@endif
																	
																	</div>
																</div>
															</div>			
															
															<div class="row" id="fulltbp_companyprofile_attachment_wrapper" @if ($fulltbpcompanyprofileattachments->count() == 0) hidden @endif>
																<div class="col-md-12" >	
																	<div class="table-responsive">
																		<table class="table table-bordered">
																			<thead>
																				<tr class="bg-info">
																					<th>เอกสารแนบ</th>                                                                                  
																					<th style="width:1%;white-space: nowrap">เพิ่มเติม</th>
																				</tr>
																			</thead>
																			<tbody id="fulltbp_companyprofile_attachment_wrapper_tr">    
																				@foreach ($fulltbpcompanyprofileattachments->reverse() as $fulltbpcompanyprofileattachment)
																					<tr >                                        
																						<td> {{$fulltbpcompanyprofileattachment->name}} </td>                                            
																						<td style="white-space: nowrap"> 
																							<a href="{{asset($fulltbpcompanyprofileattachment->path)}}" class=" btn btn-sm bg-primary" target="_blank">ดูเอกสาร</a>
																							<a  data-id="{{$fulltbpcompanyprofileattachment->id}}" data-name=""  class="btn btn-sm bg-danger hiddenelement deletefulltbpcompanyprofileattachment">ลบ</a>                                       
																						</td>
																					</tr>
																				@endforeach                            
																			</tbody>
																		</table>
																	</div>
																</div>      
															</div>
	
														</div>

												
														<div class="col-md-12 mt-3">	
															<label for=""><strong>1.10) ข้อมูลผู้บริหารระดับสูง CEO</strong><span class="text-danger">*</span><button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement"  id="btnaddboardceo"><i class="icon-add mr-2"></i>เพิ่ม</button></label>
															<span id="fulltbp_companyemploy_wrapper_ceo_error" class="form-text text-danger"  hidden >*กรุณาเพิ่มข้อมูลผู้บริหารระดับสูง (CEO, CTO, CMO, CFO หรืออื่น ๆ โปรดระบุ)</span>
															<div class="table-responsive" id="fulltbp_companyemploy_ceo_wrapper" @if ($companyemploys->where('employ_position_id','<=',5)->count() == 0) hidden @endif>
																<table class="table table-bordered">
																	<thead>
																		<tr class="bg-info">
																			<th style="width:1%;white-space: nowrap">ชื่อ-นามสกุล</th>  
																			<th style="width:300px">ตำแหน่ง</th>                                                                                    
																			<th style="width:150px">โทรศัพท์</th>       
																			<th style="width:150px">โทรศัพท์มือถือ</th>  
																			<th style="width:150px">อีเมล</th>
																			<th style="width:1%;white-space: nowrap">เพิ่มเติม</th>    
																		</tr>
																	</thead>
																	<tbody id="fulltbp_companyemploy_ceo_wrapper_tr">    
																		@foreach ($companyemploys->where('employ_position_id',1) as $companyemploy)
																			<tr >                                        
																				<td> 
																					@if ($companyemploy->prefix->name == 'อื่นๆ')
																						{{$companyemploy->otherprefix}}{{$companyemploy->name}} {{$companyemploy->lastname}}
																						@else
																						{{$companyemploy->prefix->name}}{{$companyemploy->name}} {{$companyemploy->lastname}}
																					@endif
																					</td> 
																				<td> 
																					@if (@$companyemploy->employposition->name == 'อื่นๆ')
																					{{@$companyemploy->otherposition}} 
																						@else
																						{{@$companyemploy->employposition->name}} 
																					@endif
																					
																				</td> 
																				<td> {{$companyemploy->phone}} </td>                                            
																				<td> {{$companyemploy->workphone}} </td> 
																				<td> {{$companyemploy->email}} </td> 
																				<td style="white-space: nowrap"> 
																					<a  data-id="{{$companyemploy->id}}" data-type="ceo" class="btn btn-sm bg-teal editEmployinfo">ข้อมูลส่วนตัว</a>
																					<a  data-id="{{$companyemploy->id}}" data-type="ceo" class="btn btn-sm bg-danger hiddenelement deletecompanyceo hiddenelement">ลบ</a> 
																				</td> 
																			</tr>
																		@endforeach                            
																	</tbody>
																</table>
															</div>
														</div>

														
														<div class="col-md-12 mt-3">	
															<label for=""><strong>1.11) ข้อมูลผู้บริหารระดับสูง (CTO, CMO, CFO หรืออื่น ๆ โปรดระบุ)</strong><span class="text-danger">*</span><button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement"  id="btnaddboard"><i class="icon-add mr-2"></i>เพิ่ม</button></label>
															<span id="fulltbp_companyemploy_wrapper_error" class="form-text text-danger"  hidden >*กรุณาเพิ่มข้อมูลผู้บริหารระดับสูง (CEO, CTO, CMO, CFO หรืออื่น ๆ โปรดระบุ)</span>
															<div class="table-responsive" id="fulltbp_companyemploy_wrapper" @if ($companyemploys->where('employ_position_id','<=',5)->count() == 0) hidden @endif>
																<table class="table table-bordered">
																	<thead>
																		<tr class="bg-info">
																			<th style="width:1%;white-space: nowrap">ชื่อ-นามสกุล</th>  
																			<th style="width:300px">ตำแหน่ง</th>                                                                                    
																			<th style="width:150px">โทรศัพท์</th>       
																			<th style="width:150px">โทรศัพท์มือถือ</th>  
																			<th style="width:150px">อีเมล</th>
																			<th style="width:1%;white-space: nowrap">เพิ่มเติม</th>    
																		</tr>
																	</thead>
																	<tbody id="fulltbp_companyemploy_wrapper_tr">    
																		@foreach ($companyemploys->where('employ_position_id','>',1)->where('employ_position_id','<=',5) as $companyemploy)
																			<tr >                                        
																				<td> 
																					@if ($companyemploy->prefix->name == 'อื่นๆ')
																						{{$companyemploy->otherprefix}}{{$companyemploy->name}} {{$companyemploy->lastname}}
																						@else
																						{{$companyemploy->prefix->name}}{{$companyemploy->name}} {{$companyemploy->lastname}}
																					@endif
																					</td> 
																				<td> 
																					@if (@$companyemploy->employposition->name == 'อื่นๆ')
																						{{@$companyemploy->otherposition}} 
																						@else
																						{{@$companyemploy->employposition->name}} 
																					@endif
																					
																				</td> 
																				<td> {{$companyemploy->phone}} </td>                                            
																				<td> {{$companyemploy->workphone}} </td> 
																				<td> {{$companyemploy->email}} </td> 
																				<td style="white-space: nowrap"> 
																					<a  data-id="{{$companyemploy->id}}" data-type="board" class="btn btn-sm bg-teal editEmployinfo">ข้อมูลส่วนตัว</a>
																					<a  data-id="{{$companyemploy->id}}" data-type="board" class="btn btn-sm bg-danger hiddenelement deletecompanyemploy hiddenelement">ลบ</a> 
																				</td> 
																			</tr>
																		@endforeach                            
																	</tbody>
																</table>
															</div>
														</div>
													
														{{-- <div class="row"> --}}
															<div class="col-md-12 mt-3">	
																<label for=""><strong>1.12) บัญชีรายชื่อผู้ถือหุ้น</strong><span class="text-danger">*</span><button type="button" data-toggle="modal" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement" id="btnstckholder" data-id="{{$company->id}}"><i class="icon-add mr-2"></i>เพิ่ม</button></label>
																<span id="fulltbp_companystockholder_wrapper_error" class="form-text text-danger"  hidden >*กรุณาเพิ่มบัญชีรายชื่อผู้ถือหุ้น</span>
																<div class="table-responsive" id="fulltbp_companystockholder_wrapper" @if ($companystockholders->count() == 0) hidden @endif>
																	<table class="table table-bordered">
																		<thead>
																			<tr class="bg-info">
																				<th style="display: inline-block;white-space: nowrap;">ชื่อ-นามสกุล</th>  
																				<th>ความสัมพันธ์กับ CEO</th>
																				<th class="hiddenelement" style="width:180px;white-space: nowrap;">เพิ่มเติม</th>    
																			</tr>
																		</thead>
																		<tbody id="fulltbp_companystockholder_wrapper_tr">    
																			@foreach ($companystockholders->reverse() as $companystockholder)
																				<tr >                                        
																					<td> {{$companystockholder->name}}</td> 
																					<td> {{$companystockholder->ceorelation}} </td> 
																					<td class="hiddenelement"> <a  data-id="{{$companystockholder->id}}" class="btn btn-sm bg-danger hiddenelement deletestockholder">ลบ</a> </td> 
																				</tr>
																			@endforeach                            
																		</tbody>
																	</table>
																</div>
															</div>
														{{-- </div> --}}
														
														{{-- <div class="row"> --}}
															<div class="col-md-12 mt-3">	
																<label for=""><strong>1.13) ข้อมูลพนักงานด้านการนักวิจัย พัฒนา การผลิต และวิศวกรรม</strong><span class="text-danger">*</span><button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement" id="btnaddresearch"><i class="icon-add mr-2"></i>เพิ่ม</button></label>
																<span id="fulltbp_researcher_wrapper_error" class="form-text text-danger"  hidden >*กรุณาเพิ่มข้อมูลพนักงานด้านการนักวิจัย พัฒนา การผลิต และวิศวกรรม</span>
																<div class="table-responsive" id="fulltbp_researcher_wrapper" @if ($companyemploys->where('employ_position_id','>=',6)->count() == 0) hidden @endif>
																	<table class="table table-bordered">
																		<thead>
																			<tr class="bg-info">
																				<th style="width:1%;white-space: nowrap">ชื่อ-นามสกุล</th>  
																				<th style="width:300px">ตำแหน่ง</th>                                                                                    
																				<th style="width:150px">โทรศัพท์</th>       
																				<th style="width:150px">โทรศัพท์มือถือ</th>  
																				<th style="width:150px">อีเมล</th>
																				<th style="width:1%;white-space: nowrap">เพิ่มเติม</th>     
																			</tr>
																		</thead>
																		<tbody id="fulltbp_researcher_wrapper_tr">   
																			
																			@foreach ($companyemploys->where('employ_position_id','>=',6) as $companyemploy)
																				<tr >                                        
																					<td> {{$companyemploy->prefix->name}}{{$companyemploy->name}} {{$companyemploy->lastname}}</td> 
																					<td> {{$companyemploy->employposition->name}} </td> 
																					<td> {{$companyemploy->phone}} </td>                                            
																					<td> {{$companyemploy->workphone}} </td> 
																					<td> {{$companyemploy->email}} </td> 
																					<td style="white-space: nowrap">  
																						<a  data-id="{{$companyemploy->id}}" data-type="employee" class="btn btn-sm bg-teal editEmployinfo">ข้อมูลส่วนตัว</a>
																						<a  data-id="{{$companyemploy->id}}" data-type="employee" class="btn btn-sm bg-danger hiddenelement deletecompanyemploy_research">ลบ</a> 
																					</td> 
																				</tr>
																			@endforeach                            
																		</tbody>
																	</table>
																</div>
															</div>
															
															{{-- <div class="col-md-12 mt-3">	
																<label for="">ข้อมูลทีมงานในโครงการ<button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement" id="btnaddprojectmember"><i class="icon-add mr-2"></i>เพิ่ม</button></label>
																<div class="table-responsive">
																	<table class="table table-bordered">
																		<thead>
																			<tr class="bg-info">
																				<th style="width:25%">ชื่อ-นามสกุล</th>  
																				<th style="width:20%">ตำแหน่ง</th>                                                                                    
																				<th style="width:10%">โทรศัพท์</th>       
																				<th style="width:10%">โทรศัพท์มือถือ</th>  
																				<th style="width:10%">อีเมล</th>
																				<th class="hiddenelement" style="width:15%">เพิ่มเติม</th>     
																			</tr>
																		</thead>
																		<tbody id="fulltbp_projectmember_wrapper_tr">    
																			@foreach ($companyemploys->where('employ_position_id','>',6)->reverse() as $companyemploy)
																				<tr >                                        
																					<td> {{$companyemploy->name}} {{$companyemploy->lastname}}</td> 
																					<td> {{$companyemploy->employposition->name}} </td> 
																					<td> {{$companyemploy->phone}} </td>                                            
																					<td> {{$companyemploy->workphone}} </td> 
																					<td> {{$companyemploy->email}} </td> 
																					<td class="hiddenelement"> 
																						<a  data-id="{{$companyemploy->id}}" class="btn btn-sm bg-teal editEmployinfo">ข้อมูลส่วนตัว</a>
																						<a  data-id="{{$companyemploy->id}}" class="btn btn-sm bg-danger hiddenelement deletecompanyemploy_projectmember">ลบ</a> 
																					</td> 
																				</tr>
																			@endforeach                            
																		</tbody>
																	</table>
																</div>
															</div> --}}
														{{-- <br>
															<legend class="mt-2"><label for=""><strong>ข้อมูลผู้รับผิดชอบหลักในโครงการ</strong> </label></legend> --}}
															
															<div class="col-md-12 mt-3">
																
																<div class="form-group">
																	<label for=""><strong>1.14) ข้อมูลผู้รับผิดชอบหลักในโครงการ (ผู้จัดการโครงการ/หัวหน้าโครงการ)</strong></label><span class="text-danger">*</span>
																</div>
															</div>
															<div class="col-md-6">
																
																<div class="form-group">
																	{{-- {{Auth::user()->prefix->name}} --}}
																	<label>คำนำหน้าชื่อ</label><span class="text-danger">*</span>
																	<select id="responsibleprefix" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-lg form-control-select2">
																		@foreach ($prefixes as $prefix)
																			<option value="{{$prefix->id}}" 
																				@if (Empty(@$fulltbp->fulltbpresponsibleperson->prefix_id))
																						@if ($prefix->id == Auth::user()->prefix_id) 
																						selected 
																						@endif 
																					@else
																						@if ($prefix->id == @$fulltbp->fulltbpresponsibleperson->prefix_id) 
																						selected 
																						@endif 
																				@endif	
																				>{{$prefix->name}}</option> 
																		@endforeach
																	</select>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>ชื่อ</label><span class="text-danger">*</span>
																	<input type="text" name="responsiblename" id="responsiblename" value="{{@$fulltbp->fulltbpresponsibleperson->name ?? Auth::user()->name}}" placeholder="ชื่อ" class="form-control form-control-lg stringformat20"  required>
																</div>
																{{-- <div class="form-group">
																	<label>ฝ่ายผลิต/วิศวกรรม</label><span class="text-danger">*</span>
																	<input type="text" name ="department3_qty" id ="department3_qty" value="{{$fulltbpemployee->department3_qty}}" class="form-control form-control-lg numeralformat4" required>
																</div> --}}
															</div>
															{{-- </div> --}}
															<div class="col-md-6">
																<div class="form-group">
																	<label>นามสกุล</label><span class="text-danger">*</span>
																	<input type="text" name="responsiblelastname" id="responsiblelastname" value="{{@$fulltbp->fulltbpresponsibleperson->lastname ?? Auth::user()->lastname}}" placeholder="นามสกุล" class="form-control form-control-lg stringformat20" required>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>อีเมล</label><span class="text-danger">*</span>
																	<input type="text" name="responsibleemail" id="responsibleemail" value="{{@$fulltbp->fulltbpresponsibleperson->email ?? Auth::user()->email}}" placeholder="อีเมล" class="form-control form-control-lg stringformat30" required>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>ตำแหน่ง</label><span class="text-danger">*</span>
																	<input type="text" name="responsibleposition" id="responsibleposition" value="{{@$fulltbp->fulltbpresponsibleperson->position ?? Auth::user()->position}}" placeholder="ตำแหน่ง" class="form-control form-control-lg stringformat20" required>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>โทรศัพท์</label><span class="text-danger">*</span>
																	<input type="text" name="responsiblephone" id="responsiblephone" value="{{@$fulltbp->fulltbpresponsibleperson->phone1 ?? Auth::user()->phone}}" placeholder="เบอร์โทรศัพท์" class="form-control form-control-lg numeralformathphone" required>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>โทรศัพท์มือถือ</label><span class="text-danger">*</span>
																	<input type="text" name="responsibleworkphone" id="responsibleworkphone" value="{{@$fulltbp->fulltbpresponsibleperson->phone2 ?? Auth::user()->phone}}" placeholder="โทรศัพท์มือถือ" class="form-control form-control-lg numeralformathphone" required>
																</div>
															</div>
															<div class="col-md-12" hidden>
																<div class="form-group">
																	<label>ประวัติการศึกษา <span id="responsibleeducationhistory_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span></label><span class="text-danger">*</span>
																	<textarea name="responsibleeducationhistory" id="responsibleeducationhistory" class="form-control form-control-lg summernoteelement" cols="3" rows="3">{!!@$fulltbp->fulltbpresponsibleperson->educationhistory!!}</textarea>
																</div>
															</div>
															<div class="col-md-12" hidden>
																<div class="form-group">
																	<label>ประสบการณ์การทำงาน <span id="responsibleexperiencehistory_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span></label><span class="text-danger">*</span>
																	<textarea name="responsibleexperiencehistory" id="responsibleexperiencehistory"  class="form-control form-control-lg summernoteelement" cols="3" rows="3">{!!@$fulltbp->fulltbpresponsibleperson->experiencehistory!!}</textarea>
																</div>
															</div>
															<div class="col-md-12" hidden>
																<div class="form-group">
																	<label>ประวัติการฝึกอบรม <span id="responsibletraininghistory_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span></label><span class="text-danger">*</span>
																	
																	<textarea name="responsibletraininghistory" id="responsibletraininghistory"  class="form-control form-control-lg summernoteelement" cols="3" rows="3">{!!@$fulltbp->fulltbpresponsibleperson->traininghistory!!}</textarea>
																</div>
															</div>
													</div>
													
												</div>
											</div>
										<!-- /striped rows -->
										</div>
									</div>
								
								</div>
								<!-- /accordion group -->
						
							</fieldset>


							

							<h6>2. ภาพรวมโครงการที่ขอรับประเมิน</h6>
							<fieldset>
							
									<div id="accordion-group">

										<div class="row">
											<div class="col-md-12">
												<div class="card card-body border-top-info-400">
													<div class="card-body">
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label for=""><strong>2.1) ชื่อโครงการ</strong></label>
																	<input type="text"  value="{{$minitbp->project}}" class="form-control form-control-lg" disabled>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label for=""><strong>2.2) ชื่อโครงการ (ภาษาอังกฤษ)</strong></label>
																	<input type="text" value="{{$minitbp->projecteng}}" class="form-control form-control-lg" disabled>
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<div class="form-group">
																		<label for=""><strong>2.3) บทคัดย่อโครงการ </strong></label><span class="text-danger">*</span>  <span class="text-primary" id="projectabtracttextlength"></span>
																		</label>
																		<p><i> ควรประกอบด้วย 3 ย่อหน้า (1) ปัญหาหรือความต้องการของอุตสาหกรรมที่จะแก้ไข (Pain Point) (2) การแก้ปัญหาหรือตอบโจทย์ความต้องการของอุตสาหกรรมในโครงการ และ (3) ผลที่จะได้จากโครงการ รวมถึงผลกระทบเชิงเศรษฐกิจและสังคม</i></p>
																		<span id="projectabtract_input_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
																		
																		<textarea name="projectabtract_input" id="projectabtract_input" class="form-control form-control-lg summernoteelement" cols="3" rows="5">{!!$fulltbp->abtract!!}</textarea>
																	</div>
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<label for=""><strong>2.4) ผลิตภัณฑ์หลัก (สินค้า/บริการ) ของโครงการ</strong> </label><span class="text-danger">*</span></label>
																	<p><i>อธิบายลักษณะของผลิตภัณฑ์หลัก (สินค้า/บริการ) ภายในโครงการ</i></p>
																	<span id="mainproduct_input_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
																	<textarea name="mainproduct_input" id="mainproduct_input" class="form-control form-control-lg summernoteelement" cols="3" rows="5">{!!$fulltbp->mainproduct!!}</textarea>
																
																</div>

	
															</div>
	
															<div class="col-md-12">
																<div class="form-group">
																	<label for=""><strong>2.5) จุดเด่นของผลิตภัณฑ์หลัก (สินค้าและบริการ) ของโครงการ</strong> </label><span class="text-danger">*</span> <span class="text-primary" id="productdetailstextlength"></span></label>
																	<p><i>อธิบายจุดเด่นหรือความแตกต่างของผลิตภัณฑ์หลัก (สินค้า/บริการ) ภายในโครงการ</i></p>
																	<span id="productdetails_input_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
																	<textarea name="productdetails_input" id="productdetails_input" class="form-control form-control-lg summernoteelement" cols="3" rows="5">{!!$fulltbp->productdetail!!}</textarea>
																	
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<label for=""><strong><u>2.6) ข้อมูลเทคโนโลยี</u></strong></label>
																</div>
															</div>

															<div class="col-md-12" >
																<div class="form-group">
																	<label for=""><strong>2.6.1) การพัฒนาเทคโนโลยี</strong></label> <span class="text-primary" id="projectechdevtextlength"></span><span class="text-danger">*</span> </label>
																	<p><i>เขียนอธิบายการพัฒนาเทคโนโลยี และนวัตกรรมในโครงการ</i></p>
																	<span class="text-primary" id="productdetailstextlength"></span><span id="projectechdev_input_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
																	<textarea name="" id="projectechdev_input" class="form-control form-control-lg summernoteelement" cols="3" rows="7">{!!$fulltbp->techdev!!}</textarea>
																</div>
															</div>
															<div class="col-md-12">
																{{-- <div class="form-group">	 --}}
																	<label for="">ระดับของเทคโนโลยีและความใหม่ของผลิตภัณฑ์<button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement" data-toggle="modal" data-target="#modal_add_tectdevlevel"><i class="icon-add mr-2"></i>เพิ่ม</button></label>
																	
																{{-- </div> --}}
																
																<div class="table-responsive" id="fulltbp_projectechdevlevel_wrapper" @if ($fulltbpprojecttechdevlevels->count() == 0) hidden @endif >
																	
																	<table class="table table-bordered">
																		<thead>
																			<tr class="bg-info">
																				<th>รายการ</th>  
																				<th>เทคโนโลยีที่มีอยู่ในปัจจุบัน</th>
																				<th>เทคโนโลยีในโครงการ</th>
																				<th style="width:1%;white-space: nowrap">เพิ่มเติม</th>    
																			</tr>
																		</thead>
																		<tbody id="fulltbp_projectechdevlevel_wrapper_tr">    
																			@foreach ($fulltbpprojecttechdevlevels->reverse() as $fulltbpprojecttechdevlevel)
																				<tr >                                        
																					<td> {{$fulltbpprojecttechdevlevel->technology}} </td> 
																					<td> {{$fulltbpprojecttechdevlevel->presenttechnology}} </td> 
																					<td> {{$fulltbpprojecttechdevlevel->projecttechnology}} </td> 
																					<td style="white-space: nowrap"> <a  data-id="{{$fulltbpprojecttechdevlevel->id}}" class="btn btn-sm bg-danger hiddenelement deleteprojectechdevlevel">ลบ</a> </td> 
																				</tr>
																			@endforeach                            
																		</tbody>
																	</table>
																</div>
																<br>
															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<label for="">อุปสรรค ความเสี่ยง และโอกาสในการพัฒนาด้านเทคโนโลยี (<i>เขียนอธิบายอุปสรรค ความเสี่ยง และโอกาสในการพัฒนาด้านเทคโนโลยี</i>)</label> <span class="text-primary" id="projectechdevproblemtextlength"></span><span class="text-danger">*</span> </label>
																	<span class="text-primary" id="productdetailstextlength"></span><span id="projectechdevproblem_input_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
																	<textarea name="" id="projectechdevproblem_input" class="form-control form-control-lg summernoteelement" cols="3" rows="7">{!!$fulltbp->techdevproblem!!}</textarea>
																
																</div>
															</div>
															<div class="col-md-12">
																<label for=""><strong>2.6.2) การจัดการด้านทรัพย์สินทางปัญญา</strong> </label>
																<div class="form-group mb-3 mb-md-2">
																	<label class="font-weight-semibold"><u>สิทธิบัตรการประดิษฐ์/การออกแบบ/อนุสิทธิบัตร</u></label>
																	<div class="row">
																		<div class="col-md-4">
																			<div class="form-check">
																				<label class="form-check-label">
																					<input type="checkbox" id="cer1" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer1)) checked @endif data-fouc >
																					ได้รับการจดสิทธิบัตรการประดิษฐ์
																				</label>
																				<span id="cer1qty_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
																				<div class="row" id="cer1qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer1) || Empty(@$fulltbpprojectcertify->cer1_qty) ) hidden @endif>
																					<div class="col-md-9">
																						<div class="form-group">
																							<input type="text" id="cer1qty" placeholder="จำนวน" class="form-control form-control-lg numeralformat2" value="{{$fulltbpprojectcertify->cer1_qty ?? 0}}">
																						</div>
																					</div>
																				</div>
																			</div>
							
																			<div class="form-check">
																				<label class="form-check-label">
																					<input type="checkbox" id="cer2" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer2)) checked @endif data-fouc >
																					ยื่นจดสิทธิบัตรการประดิษฐ์
																				</label>
																				<span id="cer2qty_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
																				<div class="row" id="cer2qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer2) || Empty(@$fulltbpprojectcertify->cer2_qty) ) hidden @endif>
																					<div class="col-md-9">
																						<div class="form-group">
																							<input type="text" id="cer2qty" placeholder="จำนวน" class="form-control form-control-lg numeralformat2" value="{{$fulltbpprojectcertify->cer2_qty ?? 0}}">
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
							
																		<div class="col-md-4">
																			<div class="form-check">
																				<label class="form-check-label">
																					<input type="checkbox" id="cer3" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer3)) checked @endif data-fouc >
																					ได้รับการจดสิทธิบัตรการออกแบบ
																				</label>
																				<span id="cer3qty_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
																				<div class="row" id="cer3qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer3) || Empty(@$fulltbpprojectcertify->cer3_qty) ) hidden @endif>
																					<div class="col-md-9">
																						<div class="form-group">
																							<input type="text" id="cer3qty" placeholder="จำนวน" class="form-control form-control-lg numeralformat2" value="{{$fulltbpprojectcertify->cer3_qty ?? 0}}">
																						</div>
																					</div>
																				</div>
																			</div>
							
																			<div class="form-check">
																				<label class="form-check-label">
																					<input type="checkbox" id="cer4" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer4)) checked @endif data-fouc >
																					ยื่นจดสิทธิบัตรการออกแบบ
																				</label>
																				<span id="cer4qty_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
																				<div class="row" id="cer4qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer4) || Empty(@$fulltbpprojectcertify->cer4_qty) ) hidden @endif>
																					<div class="col-md-9">
																						<div class="form-group">
																							<input type="text" id="cer4qty" placeholder="จำนวน" class="form-control form-control-lg numeralformat2" value="{{$fulltbpprojectcertify->cer4_qty ?? 0}}">
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
				
																		<div class="col-md-4">
																			<div class="form-check">
																				<label class="form-check-label">
																					<input type="checkbox" id="cer5" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer5)) checked @endif data-fouc >
																					ได้รับการจดอนุสิทธิบัตร
																				</label>
																				<span id="cer5qty_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
																				<div class="row" id="cer5qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer5) || Empty(@$fulltbpprojectcertify->cer5_qty) ) hidden @endif>
																					<div class="col-md-9">
																						<div class="form-group">
																							<input type="text" id="cer5qty" placeholder="จำนวน" class="form-control form-control-lg numeralformat2" value="{{$fulltbpprojectcertify->cer5_qty ?? 0}}">
																						</div>
																					</div>
																				</div>
																			</div>
							
																			<div class="form-check">
																				<label class="form-check-label">
																					<input type="checkbox" id="cer6" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer6)) checked @endif data-fouc >
																					ยื่นจดอนุสิทธิบัตร
																				</label>
																				<span id="cer6qty_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
																				<div class="row" id="cer6qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer6) || Empty(@$fulltbpprojectcertify->cer6_qty) ) hidden @endif>
																					<div class="col-md-9">
																						<div class="form-group">
																							<input type="text" id="cer6qty" placeholder="จำนวน" class="form-control form-control-lg numeralformat2" value="{{$fulltbpprojectcertify->cer6_qty ?? 0}}">
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-12">
																<label class="font-weight-semibold"><u>ลิขสิทธิ์/เครื่องหมายการค้า</u></label>
																<div class="row">
																	<div class="col-md-4">
																		<div class="form-check">
																			<label class="form-check-label">
																				<input type="checkbox" id="cer7" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer7)) checked @endif data-fouc >
																				ลิขสิทธิ์
																			</label>
																			<span id="cer7qty_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
																			<div class="row" id="cer7qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer7) || Empty(@$fulltbpprojectcertify->cer7_qty) ) hidden @endif>
																				<div class="col-md-9">
																					<div class="form-group">
																						<input type="text" id="cer7qty" placeholder="จำนวน" class="form-control form-control-lg numeralformat2" value="{{$fulltbpprojectcertify->cer7_qty ?? 0}}">
																					</div>
																				</div>
																			</div>
																		</div>
						
																		<div class="form-check">
																			<label class="form-check-label">
																				<input type="checkbox" id="cer9" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer9)) checked @endif data-fouc >
																				เครื่องหมายการค้า
																			</label>
																			<span id="cer9qty_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
																			<div class="row" id="cer9qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer9) || Empty(@$fulltbpprojectcertify->cer9_qty) ) hidden @endif>
																				<div class="col-md-9">
																					<div class="form-group">
																						<input type="text" id="cer9qty" placeholder="จำนวน" class="form-control form-control-lg numeralformat2" value="{{$fulltbpprojectcertify->cer9_qty ?? 0}}">
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
						
																	<div class="col-md-4">
																		<div class="form-check">
																			<label class="form-check-label">
																				<input type="checkbox" id="cer8" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer8)) checked @endif data-fouc >
																				ความลับทางการค้า
																			</label>
																			<span id="cer8qty_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
																			<div class="row" id="cer8qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer8) || Empty(@$fulltbpprojectcertify->cer8_qty) ) hidden @endif>
																				<div class="col-md-9">
																					<div class="form-group">
																						<input type="text" id="cer8qty" placeholder="จำนวน" class="form-control form-control-lg numeralformat2" value="{{$fulltbpprojectcertify->cer8_qty ?? 0}}">
																					</div>
																				</div>
																			</div>
																		</div>
						
																		<div class="form-check">
																			<label class="form-check-label">
																				<input type="checkbox" id="cer10" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer10)) checked @endif data-fouc >
																				ซื้อหรือต่อยอดทรัพย์สินทางปัญญา
																			</label>
																		</div>
																	</div>
																	
			
																	<div class="col-md-4">
																		<div class="form-check">
																			<label class="form-check-label">
																				<input type="checkbox" id="cer11" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer11)) checked @endif data-fouc >
																				อื่นๆ เช่น สิ่งบ่งชี้ทางภูมิศาสตร์ (GI) ความหลากหลายทางพันธุ์พืช แบบผังภูมิของวงจรรวม
																			</label>
																			<span id="cer11qty_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
																			<div class="row" id="cer11qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer11) || Empty(@$fulltbpprojectcertify->cer11_qty) ) hidden @endif>
																				<div class="col-md-9">
																					<div class="form-group">
																						<input type="text" id="cer11qty" placeholder="จำนวน" class="form-control form-control-lg numeralformat2" value="{{$fulltbpprojectcertify->cer11_qty ?? 0}}">
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-12 mt-4">	
																		{{-- <div class="form-group">												 --}}
																			<label for="">เอกสารแนบสิทธิบัตรการประดิษฐ์/การออกแบบ/อนุสิทธิบัตร (ไฟล์ PDF, JPG, PNG ขนาดไม่เกิน 2 MB)
																				<button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement" data-toggle="modal" onclick="document.getElementById('certify').click();"><i class="icon-add mr-2"></i>อัปโหลด</button></label>
																				<input type="file" style="display:none;"  data-id="{{$fulltbpprojectcertify->id}}" id="certify" name="certify" accept="image/jpeg,image/gif,image/png,application/pdf"/>
																		{{-- </div> --}}
																	</div>
																	
																															
																	<div class="col-md-12">	
																		<div class="table-responsive" id="fulltbp_certify_wrapper"
																			@if ($fulltbpprojectcertifyattachments->count() == 0)
																				hidden
																			@endif
																		>
																			<table class="table table-bordered">
																				<thead>
																					<tr class="bg-info">
																						<th>เอกสารแนบสิทธิบัตรการประดิษฐ์/การออกแบบ/อนุสิทธิบัตร</th>                                                                                  
																						<th style="width:1%;white-space: nowrap">เพิ่มเติม</th>
																					</tr>
																				</thead>
																				<tbody id="fulltbp_certify_wrapper_tr">    
																					@foreach ($fulltbpprojectcertifyattachments->reverse() as $fulltbpprojectcertifyattachment)
																						<tr >                                        
																							<td> {{$fulltbpprojectcertifyattachment->name}} </td>                                            
																							<td style="white-space: nowrap"> 
																								<a href="{{asset($fulltbpprojectcertifyattachment->path)}}" class=" btn btn-sm bg-primary" target="_blank">ดูเอกสาร</a>
																								<a  data-id="{{$fulltbpprojectcertifyattachment->id}}" data-name=""  class="btn btn-sm bg-danger hiddenelement deletefulltbpcertifyattachment">ลบ</a>                                       
																							</td>
																						</tr>
																					@endforeach                            
																				</tbody>
																			</table>
																		</div>
																	</div>  
																</div>
															</div>
															<div class="col-md-12 mt-3">
																<label for=""><strong>2.6.3) รางวัลทางด้านเทคโนโลยี/นวัตกรรม ที่ได้รับ</strong> </label>
																<div class="form-group">
																	<label for="">เอกสารแนบรางวัลด้านเทคโนโลยี/นวัตกรรมที่ได้รับ</label><span class="text-danger">*<span id="projectinnovation_input_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span></label>
																	
																	<textarea name="" id="projectinnovation_input" class="form-control form-control-lg summernoteelement" cols="3" rows="7">{!!$fulltbp->innovation!!}</textarea>
																</div>	
																{{-- <div class="form-group">												 --}}
																	<label for="">เอกสารแนบรางวัลด้านเทคโนโลยี/นวัตกรรมที่ได้รับ (ไฟล์ขนาดไม่เกิน 2 MB)
																		<button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement" data-toggle="modal"  onclick="document.getElementById('award').click();"><i class="icon-add mr-2"></i>อัปโหลด</button></label>
																		<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="award" name="award" accept="image/jpeg,image/gif,image/png,application/pdf"/>
																{{-- </div> --}}
																<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="award" name="award"/>
																<div class="col-md-12">	
																	<div class="table-responsive" id="fulltbp_award_wrapper" 
																	@if ($fulltbpprojectawardattachments->count() == 0)
																		hidden
																	@endif
																	>
																		<table class="table table-bordered">
																			<thead>
																				<tr class="bg-info">
																					<th>เอกสารรางวัลด้านเทคโนโลยี/นวัตกรรม</th>                                                                                  
																					<th style="width:1%;white-space: nowrap">เพิ่มเติม</th>
																				</tr>
																			</thead>
																			<tbody id="fulltbp_award_wrapper_tr">    
																				@foreach ($fulltbpprojectawardattachments->reverse() as $fulltbpprojectawardattachment)
																					<tr>                                        
																						<td> {{$fulltbpprojectawardattachment->name}} </td>                                            
																						<td style="white-space: nowrap"> 
																							<a href="{{asset($fulltbpprojectawardattachment->path)}}" class=" btn btn-sm bg-primary" target="_blank">ดูเอกสาร</a>
																							<a  data-id="{{$fulltbpprojectawardattachment->id}}" data-name=""  class="btn btn-sm bg-danger hiddenelement deletefulltbpawardattachment">ลบ</a>                                       
																						</td>
																					</tr>
																				@endforeach                            
																			</tbody>
																		</table>
																	</div>
																</div>  
															</div>
															<div class="col-md-12 mt-3">	
																<label for=""><strong>2.6.4) ใบรับรองมาตรฐานต่างๆ ที่ได้รับ ใบรับรองมาตรฐานต่างๆ ที่ได้รับ เช่น ISO, อย., มอก., GMP, HACCP, CMMI ฯลฯ</strong> </label><span class="text-danger">*</span><span id="projectstandard_input_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span></label>
																<div class="form-group">
																	
																	<textarea name="" id="projectstandard_input" class="form-control form-control-lg summernoteelement" cols="3" rows="7">{!!$fulltbp->standard!!}</textarea>
																</div>	

															
																<div class="form-group">												
																	
																	<label for="">เอกสารใบรับรองมาตรฐานต่างๆ ที่ได้รับ (ไฟล์ขนาดไม่เกิน 2 MB)</label>
																	<button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement" data-toggle="modal" onclick="document.getElementById('standard').click();"><i class="icon-add mr-2"></i>อัปโหลด</button>
																	<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="standard" name="standard" accept="image/jpeg,image/gif,image/png,application/pdf"/>
																</div>
																<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="standard" name="standard"/>

																<div class="col-md-12">	
																	<div class="table-responsive" id="fulltbp_standard_wrapper"
																	@if ($fulltbpprojectstandards->count() == 0)
																		hidden
																	@endif
																	>
																		<table class="table table-bordered">
																			<thead>
																				<tr class="bg-info">
																					<th>เอกสารใบรับรองมาตรฐานต่างๆ ที่ได้รับ</th>                                                                                  
																					<th style="width:1%;white-space: nowrap">เพิ่มเติม</th>
																				</tr>
																			</thead>
																			<tbody id="fulltbp_standard_wrapper_tr">    
																				@foreach ($fulltbpprojectstandards->reverse() as $fulltbpprojectstandard)
																					<tr >                                        
																						<td> {{$fulltbpprojectstandard->name}} </td>                                            
																						<td style="white-space: nowrap"> 
																							<a href="{{asset($fulltbpprojectstandard->path)}}" class=" btn btn-sm bg-primary" target="_blank">ดูเอกสาร</a>
																							<a  data-id="{{$fulltbpprojectstandard->id}}" data-name=""  class="btn btn-sm bg-danger hiddenelement deletefulltbpstandardattachment">ลบ</a>                                       
																						</td>
																					</tr>
																				@endforeach                            
																			</tbody>
																		</table>
																	</div>
																</div> 
															</div>


															<div class="col-md-12 mt-3">	
																<label for=""><strong>2.7) แผนการดำเนินงาน (Gantt Chart)</strong> </label><span class="text-primary" id="projectechdevproblemtextlength"></span>
																<span id="ganttchart_wrapper_error" class="form-text text-danger mb-2"  hidden ><i class="icon-cancel-circle2 text-danger"></i>  กรุณากรอกรายละเอียดแผนการดำเนินงาน (Gantt Chart)</span>
																<span id="notmatch_wrapper_error" class="form-text text-danger mb-2"  hidden > <i class="icon-cancel-circle2 text-danger"></i> จำนวนเดือนที่ดำเนินงานไม่เท่ากับจำนวนเดือนในแผนงาน</span>
																<div class="row">
																	<div class="col-md-12">
																		<label for="">
																		<u>ขั้นตอนการเพิ่ม Gantt Chart</u>
																			<ul class="mt-2">
																				<li> เลือกปีที่เริ่มดำเนินงานและจำนวนเดือนที่ดำเนินงานทั้งหมดของโครงการ</li>
																				<li> เพิ่มรายละเอียดการดำเนินงานและช่วงเดือนที่ดำเนินงาน</li>
																			</ul>
																		</label>
																	</div>
																	<div class="col-md-6">	
																		<div class="form-group">
																			<label for="">ปีที่เริ่มดำเนินงาน<span class="text-danger">*</span></label>
																			@php
																				$currentyear = date('Y')+543;
																			@endphp
																			<select name="ganttyear" id="ganttyear" class="form-control form-control-lg form-control-select2">
																				@for ($i = -2; $i <= 2; $i++)
																				<option value="{{$currentyear + $i}}" @if (($currentyear + $i) == $fulltbpgantt->startyear) selected @endif >{{$currentyear + $i}}</option>
																				@endfor
																			</select>
																		</div>
																	</div>
																	
																	<div class="col-md-6">	
																
																		<div class="form-group">
																			<label for="">จำนวนเดือนที่ดำเนินงาน<span class="text-danger">*</span></label>
																			<input type="text" name="ganttnummonth" id="ganttnummonth" value="{{$fulltbpgantt->numofmonth}}" class="form-control form-control-lg numeralformat2" required>
																		</div>
																	</div>
																	
																	<div class="col-md-12">	

																		<div class="form-group">	
																			<button type="button" id ="btn_add_projectplan" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement" data-toggle="modal" ><i class="icon-add mr-2"></i>เพิ่มรายละเอียด</button>
																		</div>
																		<label for=""><strong>ถ้าต้องการเปลี่ยนลำดับรายละเอียดการดำเนินงานให้คลิกที่รายการแล้วลากขึ้นหรือลง</strong></label>
																		
																	</div>
																	<div class="col-md-12">			
																		<table class="table-bordered" style="width: 100%" id="table_gantt_wrapper">
																			<thead>
																				<tr>
																					<tr>
																						<th rowspan="2" style="width:1%;white-space: nowrap;padding:5px">รายละเอียดการดำเนินงาน</th> 
																						@foreach ($allyears as $key => $item)
																							@if ($item != 0)
																								<th colspan="{{$item}}" class="text-center">{{$fulltbpgantt->startyear + $key}} </th> 
																							@endif
																						@endforeach
																						<th rowspan="2" class="text-center hiddenelement" style="width: 140px;">เพิ่มเติม</th> 
																					</tr>
																					@if ($minmonth != 0 && $maxmonth !=0)
																						<tr >
																							@for ($i = $minmonth; $i <= $maxmonth; $i++)
																								<th class="text-center" style="width: 40px !important;font-size:12px;padding:5px">
																									@php
																										$full = 12;
																										if($i%12 == 0){
																											echo (12);
																										}else{
																											echo($i%12);
																										}
																									@endphp
																								</th>
																							@endfor
																						</tr>
																					@endif
																				</tr>
																			</thead>
																			
																			<tbody id="ganttchart_wrapper_tr">  
																				@foreach ($fulltbpprojectplans as $fulltbpprojectplan)
																				
																					<tr id= "{{$fulltbpprojectplan->id}}" >                                        
																						<td style="width:1%;white-space: nowrap;padding:5px"> {{$fulltbpprojectplan->name}}</td> 
																						@php
																							$_count = 1;
																						@endphp
																						@for ($i = $minmonth; $i <= $maxmonth; $i++)
																							@php
																								$color = 'white';
																								$check = $fulltbpprojectplan->fulltbpprojectplantransaction->where('month',$i)->first();
																								if (!Empty($check)) {
																									$color = 'grey';
																								}
																							@endphp
																							<td style="background-color:{{$color}};width: 30px !important;font-size:12px;padding:5px;text-align:center">
																								@if ($color == 'grey')
																								 {{$_count}}
																								@endif
																							</td> 
																							@php
																								$_count++;
																							@endphp
																						@endfor															
																						<td class="hiddenelement" style="width:1%;white-space: nowrap"> 
																							<a  data-id="{{$fulltbpprojectplan->id}}" class="btn btn-sm bg-info editprojectplan">แก้ไข</a>
																							<a  data-id="{{$fulltbpprojectplan->id}}" class="btn btn-sm bg-danger deleteprojectplan">ลบ</a> 
																						</td> 
																					</tr>
																				@endforeach                            
																			</tbody>
																		</table>
																		<input type="text" id="maxrow" value="{{@$_count-1}}" hidden>
																	</div>
																</div>
															
															</div>

														</div>
													</div>
												</div>
											<!-- /striped rows -->
											</div>
										</div>


									</div>
									<!-- /accordion group -->
							</fieldset>

							<h6>3. ความเป็นไปได้ด้านการตลาดแผนสู่เชิงพาณิชย์</h6>
							<fieldset>
								<div id="accordion-group">
									<div class="row">
										<div class="col-md-12">
											<div class="card border-top-info rounded-top-1 mb-0 mb-3">
												<div class="card-body">
													<div class="col-md-12">	
														<div class="form-group">
															<label for=""><strong>3.1 ข้อมูลด้านการตลาด</strong></label>
														</div>
													</div>
													<div class="col-md-12">	
														<div class="form-group">
															<label for=""><u>Market Analysis</u> </label><span class="text-danger">*</span>
															<p>อธิบายความเป็นไปได้ทางการตลาดของผลิตภัณฑ์หรือบริการในโครงการ และ ระบุแผนงานในการนำผลลัพธ์ของโครงการออกสู่เชิงพาณิชย์  โดยให้ข้อมูลในประเด็นต่างๆ ดังนี้ 
																<ul>
																	<li><i>การแก้ไขปัญหานี้จะตอบสนองความต้องการของตลาดได้อย่างไร (Market needs/Market requirements)</i></li>
																	<li><i>ระบุและให้รายละเอียดเกี่ยวกับตลาดภายในและนอกประเทศ (Market size)</i></li>
																	<li><i>ส่วนแบ่งของตลาดที่คาดว่าผลิตภัณฑ์จะครอบครอง (Market share)</i></li>
																	<li><i>ข้อได้เปรียบที่สำคัญของผลิตภัณฑ์ หรือ บริการโดยเปรียบเทียบกับผลิตภัณฑ์ หรือ บริการของคู่แข่ง (Competitive analysis/ Benchmarking matrix)</i></li>
																</ul>
																</p>
																<span id="analysis_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
															<textarea name="" id="analysis" class="form-control form-control-lg summernoteelement" cols="3" rows="10">{!!@$fulltbp->fulltbpmarketanalysis->detail!!}</textarea>
														</div>
													</div>
													<div class="col-md-12">	
														<div class="form-group">
															<label for=""><u>Business Model Canvas / Lean Canvas / อื่นๆ</u></label><span class="text-danger">*</span>
															<p><i>แผนที่ได้วางไว้เพื่อนำไปสู่เชิงพาณิชย์/ การประยุกต์ใช้และวิธีการที่จะบรรลุผลเหล่านั้น</i></p>
															<span id="modelcanvas_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
															<textarea name="modelcanvas" id="modelcanvas" class="form-control form-control-lg summernoteelement" cols="3" rows="5">{!!@$fulltbp->fulltbpmarketbusinessmodelcanvas->detail!!}</textarea>
														</div>
														<div class="col-md-12">	
															<div class="input-group">													
																<label for="">เอกสารแนบ Business Model Canvas (ไฟล์ขนาดไม่เกิน 2 MB)
																	<button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement" data-toggle="modal" onclick="document.getElementById('businessmodelcanvas').click();"><i class="icon-add mr-2"></i>อัปโหลด</button></label>
																	<input type="file" style="display:none;"  data-id="{{$fulltbpprojectcertify->id}}" id="businessmodelcanvas" name="businessmodelcanvas" accept="image/jpeg,image/gif,image/png,application/pdf"/>
															</div>
															
														</div>

														<div class="col-md-12">	
															<div class="table-responsive" id="fulltbp_businessmodelcanvas_wrapper"
															@if ($fullTbpmarketattachmentmodelcanvases->count() == 0)
																hidden
															@endif
															>
																<table class="table table-bordered">
																	<thead>
																		<tr class="bg-info">
																			<th>เอกสาร Business Model Canvas</th>                                                                                  
																			<th style="width:1%;white-space: nowrap">เพิ่มเติม</th>
																		</tr>
																	</thead>
																	<tbody id="fulltbp_businessmodelcanvas_wrapper_tr">    
																		@foreach ($fullTbpmarketattachmentmodelcanvases->reverse() as $fullTbpmarketattachmentmodelcanvas)
																			<tr >                                        
																				<td> {{$fullTbpmarketattachmentmodelcanvas->name}} </td>                                            
																				<td style="white-space: nowrap"> 
																					<a href="{{asset($fullTbpmarketattachmentmodelcanvas->path)}}" class=" btn btn-sm bg-primary" target="_blank">ดูเอกสาร</a>
																					<a  data-id="{{$fullTbpmarketattachmentmodelcanvas->id}}" data-name=""  class="btn btn-sm bg-danger hiddenelement deletefulltbpmodelcanvasattachment">ลบ</a>                                       
																				</td>
																			</tr>
																		@endforeach                            
																	</tbody>
																</table>
															</div>
														</div>      
														<br>
														<div class="col-md-12">	
															<div class="form-group">
																<label for="" ><u>วิเคราะห์ศักยภาพทางการค้า</u></label><span class="text-danger">*</span>
																<p><i>SWOT Analysis, Five Forces Analysis</i></p>
																<span id="swot_error" class="form-text text-danger" hidden ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรายละเอียด</span>
																<textarea name="swot" id="swot" class="form-control form-control-lg summernoteelement" cols="3" rows="5">{!!@$fulltbp->fulltbpmarketswot->detail!!}</textarea>
															</div>
															<div class="col-md-12">	
																<div class="input-group">													
																	
																	<label for="">SWOT Analysis, Five Forces Analysis (ไฟล์ขนาดไม่เกิน 2 MB)
																		<button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement" data-toggle="modal" onclick="document.getElementById('swotfile').click();"><i class="icon-add mr-2"></i>อัปโหลด</button></label>
																		<input type="file" style="display:none;"  data-id="{{$fulltbpprojectcertify->id}}" id="swotfile" name="swotfile" accept="image/jpeg,image/gif,image/png,application/pdf"/>
																</div>
																
															</div>
				
		
															<div class="col-md-12">	
																<div class="table-responsive" id="fulltbp_swot_wrapper" 
																@if ($fullTbpmarketattachmentswots->count() == 0)
																	hidden
																@endif
																>
																	<table class="table table-bordered">
																		<thead>
																			<tr class="bg-info">
																				<th>เอกสาร SWOT Analysis, Five Forces Analysis</th>                                                                                  
																				<th style="width:1%;white-space: nowrap">เพิ่มเติม</th>
																			</tr>
																		</thead>
																		<tbody id="fulltbp_swot_wrapper_tr">    
																			@foreach ($fullTbpmarketattachmentswots->reverse() as $fullTbpmarketattachmentswot)
																				<tr >                                        
																					<td> {{$fullTbpmarketattachmentswot->name}} </td>                                            
																					<td style="white-space: nowrap"> 
																						<a href="{{asset($fullTbpmarketattachmentswot->path)}}" class=" btn btn-sm bg-primary" target="_blank">ดูเอกสาร</a>
																						<a  data-id="{{$fullTbpmarketattachmentswot->id}}" data-name=""  class="btn btn-sm bg-danger hiddenelement deletefulltbpswotattachment">ลบ</a>                                       
																					</td>
																				</tr>
																			@endforeach                            
																		</tbody>
																	</table>
																</div>
															</div>  
															
															<div class="col-md-12 mt-3">	
																<label for=""><strong>3.2) ข้อมูลยอดขายของบริษัท</strong> </label>
															</div>
															
															<div class="col-md-12">	
																<div class="form-group">	
																	<label for=""><u>ข้อมูลยอดขายของแต่ละผลิตภัณฑ์/บริการ (ยอดขาย 3 ปีย้อนหลัง)</u><button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement" data-toggle="modal" data-target="#modal_add_sell"><i class="icon-add mr-2"></i>เพิ่ม</button></label>
																	{{-- <p><small><i>ข้อมูลยอดขายของแต่ละผลิตภัณฑ์/บริการ (ยอดขาย 3 ปีย้อนหลัง)</i> </small></p> --}}
																</div>
																<div class="table-responsive" id="fulltbp_sell_wrapper"
																@if ($fulltbpsells->count() == 0)
																	hidden
																@endif
																>
																	<table class="table table-bordered">
																		<thead>
																			<tr class="bg-info">
																				<th>ยอดขายแยกตามประเภทผลิตภัณฑ์</th>  
																				<th class="text-center" style="width: 13%">{{$fulltbp->past3}}</th>  
																				<th class="text-center" style="width: 13%">{{$fulltbp->past2}}</th> 
																				<th class="text-center" style="width: 13%">{{$fulltbp->past1}}</th> 
																				<th class="text-center" style="width: 13%">{{$fulltbp->past1+1}}</th> 
																				<th class="text-center hiddenelement" style="width:1%;white-space: nowrap">เพิ่มเติม</th>    
																			</tr>
																		</thead>
																		<tbody id="fulltbp_sell_wrapper_tr">    
																			@foreach ($fulltbpsells->reverse() as $fulltbpsell)
																				<tr>                                        
																					<td  > {{$fulltbpsell->name}}</td> 
																					<td class="text-right"> {{number_format($fulltbpsell->past3, 2)}}</td> 
																					<td class="text-right"> {{number_format($fulltbpsell->past2, 2)}}</td>  
																					<td class="text-right"> {{number_format($fulltbpsell->past1, 2)}}</td> 
																					<td class="text-right"> {{number_format($fulltbpsell->present, 2)}} </td> 
																				
																					                                          															
																				
																					<td style="width:1%;white-space: nowrap" class="hiddenelement"> 
																						<a  data-id="{{$fulltbpsell->id}}" class="btn btn-sm bg-info editsell">แก้ไข</a>
																						<a  data-id="{{$fulltbpsell->id}}" class="btn btn-sm bg-warning hiddenelement deletesell">ลบ</a> 
																					</td> 
																				</tr>
																			@endforeach                            
																		</tbody>
																	</table>
																</div>
															</div>
															
															<div class="col-md-12 mt-4">
																<label for=""><u>(สถานะยอดขาย 3 ปีย้อนหลัง)</u> </label>
																<small><i>(สถานะยอดขาย 3 ปีย้อนหลัง)</i> </small>
																<div class="table-responsive">
																	<table class="table table-bordered">
																		<thead>
																			<tr  class="bg-info">
																				<th>ยอดขายแยกตามสถานะ</th>  
																				<th class="text-center" style="width: 13%">{{$fulltbp->past3}}</th> 
																				<th class="text-center" style="width: 13%">{{$fulltbp->past2}}</th>  
																				<th class="text-center" style="width: 13%">{{$fulltbp->past1}}</th>    
																				<th class="text-center" style="width: 13%">{{$fulltbp->past1+1}}</th> 

																				<th class="hiddenelement" style="width:1%;white-space: nowrap">เพิ่มเติม</th>    
																			</tr>
																		</thead>
																		<tbody id="fulltbp_sellstatus_wrapper_tr">    
																			@foreach ($fulltbpsellstatuses as $key => $fulltbpsellstatus)
																				<tr >                                        
																					<td>@if ($key > 1) &nbsp;&nbsp; @endif {{$fulltbpsellstatus->name}}</td> 
																					<td class="text-right"> {{number_format($fulltbpsellstatus->past3, 2)}} </td> 
																					<td class="text-right"> {{number_format($fulltbpsellstatus->past2, 2)}} </td>  
																					<td class="text-right"> {{number_format($fulltbpsellstatus->past1, 2)}} </td> 
																					<td class="text-right"> {{number_format($fulltbpsellstatus->present, 2)}} </td> 
																					<td class="hiddenelement"> 
																						<a  data-id="{{$fulltbpsellstatus->id}}" class="btn btn-sm bg-info editsellstatus">แก้ไข</a> 
																					</td> 
																				</tr>
																			@endforeach                            
																		</tbody>
																	</table>
																</div>
															</div>
															<div class="col-md-12 mt-3">
																{{-- <div class="form-group"> --}}
																	<label for=""><strong>คู่ค้าหลักทางธุรกิจของโครงการ</strong> </label>
																{{-- </div> --}}
															</div>
															<div class="col-md-12">
																<div class="form-group">	
																	<label for=""><u>ลูกหนี้การค้า</u><button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement" data-toggle="modal" data-target="#modal_add_debtpartner"><i class="icon-add mr-2"></i>เพิ่ม</button></label>
																	{{-- <p><small><i>ลูกหนี้การค้า</i> </small></p> --}}
																</div>
																<div class="table-responsive" id="fulltbp_debtpartner_wrapper"
																@if ($fulltbpdebtpartners->count() == 0)
																	hidden
																@endif
																>
																	<table class="table table-bordered">
																		<thead>
																			<tr class="bg-info">
																				<th>คู่ค้าหลักของธุรกิจ</th>  
																				<th>จำนวนผลิตภัณฑ์/โครงการ</th> 
																				<th>เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)</th>                                                                                    
																				<th>ยอดขายต่อปี (บาท)</th>       
																				<th>เปรียบเทียบกับยอดขาย (%)</th>  
																				<th>จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)</th> 
																				<th class="hiddenelement" style="width:1%;white-space: nowrap">เพิ่มเติม</th>    
																			</tr>
																		</thead>
																		<tbody id="fulltbp_debtpartner_wrapper_tr">    
																			@foreach ($fulltbpdebtpartners->reverse() as $fulltbpdebtpartner)
																				<tr>
																					<td> {{$fulltbpdebtpartner->debtpartner}}</td> 
																					<td class="text-right"> {{$fulltbpdebtpartner->numproject}} </td> 
																					<td class="text-right"> {{$fulltbpdebtpartner->partnertaxid}} </td> 
																					<td class="text-right"> {{number_format($fulltbpdebtpartner->totalyearsell, 2)}} </td>                                            															
																					<td class="text-right"> {{number_format($fulltbpdebtpartner->percenttosale,2)}} </td> 
																					<td class="text-right"> {{$fulltbpdebtpartner->businessyear}} </td> 
																					<td style="width:1%;white-space: nowrap" class="hiddenelement"> 
																						<a  data-id="{{$fulltbpdebtpartner->id}}" class="btn btn-sm bg-info editdebtpartner">แก้ไข</a>
																						<a  data-id="{{$fulltbpdebtpartner->id}}" class="btn btn-sm bg-danger hiddenelement deletedebtpartner">ลบ</a> 
																					</td> 
																				</tr>
																			@endforeach              
																		</tbody>
																	</table>
																</div>
															</div>
															<div class="col-md-12 mt-4">
																<div class="form-group">	
																	<label for=""><u>เจ้าหนี้การค้า</u><button type="button" class="btn btn-warning btn-icon ml-2 btn-sm hiddenelement" data-toggle="modal" data-target="#modal_add_creditpartner"><i class="icon-add mr-2"></i>เพิ่ม</button></label>
																	{{-- <p><small><i>เจ้าหนี้การค้า</i> </small></p> --}}
																</div>
																<div class="table-responsive" id="fulltbp_creditpartner_wrapper"
																@if ($fulltbpcreditpartners->count() == 0)
																	hidden
																@endif
																>
																	<table class="table table-bordered">
																		<thead>
																			<tr class="bg-info">
																				<th>คู่ค้าหลักของธุรกิจ</th>  
																				<th>เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)</th>                                                                                    
																				<th>ยอดซื้อต่อปี (บาท)</th>       
																				<th>เปรียบเทียบกับยอดซื้อ (%)</th>  
																				<th>จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)</th> 
																				<th class="hiddenelement" style="width:1%;white-space: nowrap">เพิ่มเติม</th>    
																			</tr>
																		</thead>
																		<tbody id="fulltbp_creditpartner_wrapper_tr">    
																			@foreach ($fulltbpcreditpartners->reverse() as $fulltbpcreditpartner)
																				<tr >
																					<td> {{$fulltbpcreditpartner->creditpartner}}</td> 
																					<td class="text-right"> {{$fulltbpcreditpartner->partnertaxid}} </td> 
																					<td class="text-right"> {{number_format($fulltbpcreditpartner->totalyearpurchase, 2)}}</td>                                            															
																					<td class="text-right"> {{number_format($fulltbpcreditpartner->percenttopurchase, 2)}} </td> 
																					<td class="text-right"> {{$fulltbpcreditpartner->businessyear}} </td> 
																					<td style="width:1%;white-space: nowrap" class="hiddenelement"> 
																						<a  data-id="{{$fulltbpcreditpartner->id}}" class="btn btn-sm bg-info editcreditpartner">แก้ไข</a>
																						<a  data-id="{{$fulltbpcreditpartner->id}}" class="btn btn-sm bg-danger hiddenelement deletecreditpartner">ลบ</a> 
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
									</div>


						

								

								
								</div>
								<!-- /accordion group -->
		
							</fieldset>
							<h6>4. ข้อมูลทางด้านการเงิน</h6>
							<fieldset>	
								<div id="accordion-group">

									<div class="row">
										<div class="col-md-12">
											<div class="card border-top-info rounded-top-1 mb-0">
												<div class="card-body">
													<div class="col-md-12">
														<div class="form-group">
															<label for=""><strong>4.1) เงินลงทุนที่จำเป็นและการจัดหาแหล่งเงินทุนทั้งหมดของโครงการ</strong></label>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label for=""><u>เงินลงทุนในสินทรัพย์ถาวรของโครงการ</u></label>
															{{-- <p><small><i>ตารางแสดงรายละเอียดเงินลงทุนในสินทรัพย์ถาวรของโครงการ</i> </small></p> --}}
														</div>
														<div class="table-responsive">
															<table class="table table-bordered">
																<thead>
																	<tr class="bg-info">
																		<th>รายการ</th>  
																		<th>จำนวนเงิน (บาท)</th>                                                                                    
																		<th>จำนวน (หน่วย)</th>       
																		<th>ราคาต่อหน่วย (บาท)</th>  
																		<th>ข้อมูลจำเพาะทางเทคนิค</th> 
																		<th class="hiddenelement" style="width:1%;white-space: nowrap">เพิ่มเติม</th>    
																	</tr>
																</thead>
																<tbody id="fulltbp_asset_wrapper_tr">    
																	@foreach ($fulltbpassets as $fulltbpasset)
																		<tr >
																			<td> {{$fulltbpasset->asset}}</td> 
																			<td class="text-right"> {{number_format($fulltbpasset->cost, 2)}} </td> 
																			<td class="text-right"> {{$fulltbpasset->quantity}} </td>                                            															
																			<td class="text-right"> {{number_format($fulltbpasset->price, 2)}}</td> 
																			<td> {{$fulltbpasset->specification}} </td> 
																			<td style="width:1%;white-space: nowrap" class="hiddenelement"> 
																				<a  data-id="{{$fulltbpasset->id}}" data-assetname="{{$fulltbpasset->asset}}" class="btn btn-sm bg-info editasset">แก้ไข</a>
																			</td> 
																		</tr>
																	@endforeach              
																</tbody>
															</table>
														</div>
													</div>
													<div class="col-md-12 mt-3" >
														{{-- <div class="form-group"> --}}
															<label for=""><u>เงินลงทุนสำหรับดำเนินการของโครงการ</u></label>
															{{-- <p><small><i>ตารางแสดงรายละเอียดเงินลงทุนสำหรับดำเนินการของโครงการ</i> </small></p> --}}
														{{-- </div> --}}
														<div class="table-responsive">
															<table class="table table-bordered">
																<thead>
																	<tr class="bg-info">
																		<th>รายการ</th>  
																		<th class="text-right">จำนวนเงิน (บาท)</th>                                                                                    
																		<th class="hiddenelement" style="width:1%;white-space: nowrap">เพิ่มเติม</th>    
																	</tr>
																</thead>
																<tbody id="fulltbp_investment_wrapper_tr">    
																	@foreach ($fulltbpinvestments as $fulltbpinvestment)
																		<tr >
																			<td> {{$fulltbpinvestment->investment}}</td> 
																			<td class="text-right"> {{number_format($fulltbpinvestment->cost, 2)}}</td> 
																			<td style="width:1%;white-space: nowrap" class="hiddenelement"> 
																				<a  data-id="{{$fulltbpinvestment->id}}" class="btn btn-sm bg-info editinvestment">แก้ไข</a>
																			</td> 
																		</tr>
																	@endforeach              
																</tbody>
															</table>
														</div>
													</div>
													<div class="col-md-12 mt-4">
														<label for=""><u>แหล่งเงินทุนของโครงการ</u></label>
														<div class="table-responsive">
															<table class="table table-bordered">
																<thead class="bg-info">
																	<tr>
																		<th>รายการ</th>  
																		<th>เงินทุนที่มีอยู่แล้ว</th>                                                                                    
																		<th>เงินทุนที่เสนอขออนุมัติ</th>   
																		<th>เงินทุนที่ได้รับการอนุมัติแล้ว</th>   
																		<th>แผนการหาเงินทุนเพิ่ม</th>  
																		<th class="hiddenelement" style="width:150px;display: inline-block;white-space: nowrap;">เพิ่มเติม</th>    
																	</tr>
																</thead>
																<tbody id="fulltbp_cost_wrapper_tr">    
																	@foreach ($fulltbpcosts as $fulltbpcost)
																		<tr >
																			<td> {{$fulltbpcost->costname}}</td> 
																			<td class="text-right"> {{number_format(intval($fulltbpcost->existing), 2)}}</td> 
																			<td class="text-right"> {{number_format(intval($fulltbpcost->need), 2)}}</td> 
																			<td class="text-right"> {{number_format(intval($fulltbpcost->approved), 2)}}</td> 
																			<td class="text-right"> {{number_format(intval($fulltbpcost->plan), 2)}}</td> 
																			<td style="width:1%;white-space: nowrap" class="hiddenelement"> 
																				<a  data-id="{{$fulltbpcost->id}}" data-name="{{$fulltbpcost->costname}}" class="btn btn-sm bg-info editcost">เพิ่มข้อมูลแหล่งเงินทุน</a>
																			</td> 
																		</tr>
																	@endforeach              
																</tbody>
															</table>
														</div>
													</div>
													<div class="col-md-12 mt-3">
														<label for=""><strong>4.2) ประมาณการผลตอบแทนจากการลงทุน</strong></label>
														<fieldset>	
															<div class="form-group">
																<label>ประมาณการรายได้ที่จะเพิ่มขึ้น (บาท)</label>
																<input type="text"  value="{{$fulltbpreturnofinvestment->income}}" id="income" placeholder="ประมาณการรายได้ที่จะเพิ่มขึ้น" class="form-control form-control-lg numeralformat10" >
															</div>
															<div class="form-group">
																<label>ประมาณการกำไรสุทธิที่จะเพิ่มขึ้น (บาท)</label>
																<input type="text" value="{{$fulltbpreturnofinvestment->profit}}" id="profit" placeholder="ประมาณการกำไรสุทธิที่จะเพิ่มขึ้น" class="form-control form-control-lg numeralformat10" >
															</div>
															<div class="form-group">
																<label>ประมาณการต้นทุนที่จะลดลง (บาท)</label>
																<input type="text" value="{{$fulltbpreturnofinvestment->reduce}}" id="reduce" placeholder="ประมาณการต้นทุนที่จะลดลง" class="form-control form-control-lg numeralformat10" >
															</div>
														</fieldset>
													</div>
												</div>
											</div>
										<!-- /striped rows -->
										</div>
									</div>
								</div>
								<br>
							 <strong>ผู้มีอำนาจลงนามในแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)</strong>	
								<div class="col-md-12 mt-2">
									<div class="form-group">
										<div class="table-responsive">
											<table class="table table-bordered table-striped">
												<thead>
													<tr class="bg-info">
														<th style="width:300px">เลือกผู้ลงนามในแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)</th>
														<th style="width:300px">ลายมือชื่อ</th> 
														<th style="width:200px">ตำแหน่ง</th>
													</tr>
												</thead>
												<tbody id="authorized_director_wrapper_tr"> 
													@foreach ($authorizeddirectors as $authorizeddirector)
													<tr >      
														<td>
															<div class="form-check">
																<label class="form-check-label">

																	@if (Empty($authorizeddirector->signature_id))
																			<input type="checkbox" data-id="1" value="{{$authorizeddirector->id}}" class="form-check-input-styled chkauthorizeddirector" data-fouc 
																			@if ($authorizeddirector->usesignature == 2)
																				checked
																			@endif
																			>
																		@else
																			<input type="checkbox" data-id="2" value="{{$authorizeddirector->id}}" class="form-check-input-styled chkauthorizeddirector" data-fouc
																			@if ($authorizeddirector->usesignature == 2)
																				checked
																			@endif
																			>
																	@endif
																	
																	@if ($authorizeddirector->prefix->name == 'อื่นๆ')
																			{{$authorizeddirector->otherprefix}}{{$authorizeddirector->name}} {{$authorizeddirector->lastname}}
																		@else
																			{{$authorizeddirector->prefix->name}}{{$authorizeddirector->name}} {{$authorizeddirector->lastname}}
																	@endif

																	{{-- {{$authorizeddirector->prefix->name}}{{$authorizeddirector->name}} {{$authorizeddirector->lastname}} --}}
																</label>
															</div>
														</td>  
														<td>
														@if (Empty($authorizeddirector->signature_id))
																<span class="badge badge-flat border-warning text-warning">ไม่พบลายมือชื่อ</span>
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
									{{-- </div> --}}
								</div>
								<br>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">ลายมือชื่ออิเล็กทรอนิกส์<span class="text-danger">*</span></label>
										<select name="signature" id="usersignature" value="{{$fulltbp->signature_status_id}}" id="" class="form-control form-control-lg form-control-select2">
											<option value="0">โปรดเลือก</option>
											@foreach ($signaturestatuses as $signaturestatus)
												<option value="{{$signaturestatus->id}}" @if($fulltbp->signature_status_id == $signaturestatus->id) selected @endif >{{$signaturestatus->name}}</option>
											@endforeach
										</select>
									</div>
								</div>
		
							</fieldset>
							<h6>เสร็จสิ้น</h6>
							<fieldset>
								<div class="col-md-12">
									<div class="form-group">
										<div style="width:100%;height:600px;" class="col-md-12 center"  >
											<div style="width:100%;height:600px;" id="example1"></div>
										</div>
										<input type="file" style="display:none;" id="fulltbppdf" accept="image/jpeg,image/gif,image/png,application/pdf"/>
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
{{-- <script src="{{asset('assets/dashboard/js/plugins/jqueryui/jquery.js')}}"></script> --}}
<script src="{{asset('assets/dashboard/plugins/summernote/summernote.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/fulltbphelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/forms/wizards/steps.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/tablednd/jquery.tablednd.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/forms/validation/validate.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/pdfjs/pdf.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/signaturepad/signature_pad.umd.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/signaturepad/signaturecontrol.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/pdfobject/pdfobject.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/inputformat.js')}}"></script>
{{-- <script src="{{asset('assets/dashboard/js/plugins/jqueryui/jquery-ui.js')}}"></script> --}}
{{--  --}}
<script>

	var route = {
		url: "{{ url('/') }}",
		token: $('meta[name="csrf-token"]').attr('content'),
		branchid: "{{Auth::user()->branch_id}}",
		submitstatus: "{{$minitbp->businessplan->business_plan_status_id}}",
		refixstatus: "{{$fulltbp->refixstatus}}"
	};

	$( "#tabs" ).tabs();
	$( "#dialog-link, #icons li" ).hover(
		function() {
			$( this ).addClass( "ui-state-hover" );
		},
		function() {
			$( this ).removeClass( "ui-state-hover" );
		}
	);

	$(document).ready(function() {
		$(window).keydown(function(event){
			if((event.keyCode == 13)) {
				event.preventDefault();
				return false;
			}
		});

		$('#pdfname').val("{{$fulltbp->attachment}}");
		$('#companyhistory').summernote({
			toolbar: false,
			height: 200,
			callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
		$('#responsibleeducationhistory').summernote({
			toolbar: false,
			height: 200,
			callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
		$('#responsibleexperiencehistory').summernote({
			toolbar: false,
			height: 200,
			callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
		$('#responsibletraininghistory').summernote({
			toolbar: false,
			height: 200,
			callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
		$('#projectabtract_input').summernote({
			toolbar: false,
			height: 200,
			callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
		$('#mainproduct_input').summernote({
			toolbar: false,
			height: 200,
			callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
		$('#productdetails_input').summernote({
			toolbar: false,
			height: 200,
			callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
		$('#projectechdev_input').summernote({
			toolbar: false,
			height: 200,
			callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
		$('#projectechdevproblem_input').summernote({
			toolbar: false,
			height: 200,
			callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
		$('#projectinnovation_input').summernote({
			toolbar: false,
			height: 200,
			callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
		$('#projectstandard_input').summernote({
			toolbar: false,
			height: 200,
			callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
		$('#analysis').summernote({
			toolbar: false,
			height: 200,
			callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
		$('#swot').summernote({
			toolbar: false,
			height: 200,
			callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
		$('#modelcanvas').summernote({
			toolbar: false,
			height: 200,
			callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});



		if("{{$minitbp->businessplan->business_plan_status_id}}" == "4" || "{{$fulltbp->refixstatus}}" == "1" ){ 
			$(".hiddenelement").attr("hidden",false);   
		}else{
			$(".hiddenelement").attr("hidden",true);   
			$('.summernoteelement').next().find(".note-editable").attr("contenteditable", false);
			$('.form-check-input-styled').prop("disabled", true);
			$('.form-check-input-styled-primary').prop("disabled", true);
			$('.form-control-select2').prop("disabled", true);
			$('.form-control-lg').prop("disabled", true);
			$('#companydocname').prop("disabled", false);
			
		}

	    var orgrow = [];
		var newrow = [];
		table_2 = $("#table_gantt_wrapper");
        table_2.tableDnD({
            onDrop: function(table, row) {
                var rows = table.tBodies[0].rows;
                for (var i=0; i<rows.length; i++) {
					newrow.push(rows[i].id);
                }
				var fulltbpid = "{{$fulltbp->id}}";
				updateGanttOrder(newrow,fulltbpid).then(data => {

				})
				.catch(error => {})

            },
            onDragStart: function(table, row) {
				orgrow = [];
				newrow = [];
				var rows = table.tBodies[0].rows;
                for (var i=0; i<rows.length; i++) {
					orgrow.push(rows[i].id);
                }
            }
        });

		function updateGanttOrder(order,fulltbpid){
			return new Promise((resolve, reject) => {
				$.ajax({
				url: `${route.url}/api/fulltbp/project/plan/updateganttorder`,
				type: 'POST',
				headers: {"X-CSRF-TOKEN":route.token},
				data: {
					'order': order,
					'fulltbpid': fulltbpid,
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

	});
	$(document).on('keyup', '#ganttnummonth', function(e) {
	
	});
</script>
@stop

