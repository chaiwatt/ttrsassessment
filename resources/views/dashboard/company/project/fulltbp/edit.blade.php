@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
{{-- modal_add_employ --}}
<div id="modal_add_employ" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มพนักงาน</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>คำนำหน้าชื่อ<span class="text-danger">*</span></label>
							<select id="employprefix" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-select2">
								@foreach ($prefixes as $prefix)
									<option value="{{$prefix->id}}" >{{$prefix->name}}</option> 
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ชื่อ</label><span class="text-danger">*</span>
							<input type="text" id="employname" placeholder="ชื่อ" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>นามสกุล</label><span class="text-danger">*</span>
							<input type="text" id="employlastname" placeholder="นามสกุล" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>ตำแหน่ง<span class="text-danger">*</span></label>
							<select id="employposition" data-placeholder="ตำแหน่ง" class="form-control form-control-select2">
								@foreach ($employpositions as $employposition)
									<option value="{{$employposition->id}}" >{{$employposition->name}}</option> 
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>โทรศัพท์</label><span class="text-danger">*</span>
							<input type="text" id="employphone" placeholder="เบอร์โทรศัพท์" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>โทรศัพท์มือถือ</label><span class="text-danger">*</span>
							<input type="text" id="employworkphone" placeholder="โทรศัพท์มือถือ" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>อีเมล</label><span class="text-danger">*</span>
							<input type="text" id="employemail" placeholder="อีเมล" class="form-control">
						</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_employ" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
			</div>
		</div>
	</div>
</div>

{{-- modal_edit_employ --}}
<div id="modal_edit_employ" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มข้อมูลบุคลากร</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
						<div class="card-body">
							<ul class="nav nav-tabs nav-tabs-highlight">
								<li class="nav-item"><a href="#left-icon-employinfo" class="nav-link active" data-toggle="tab"><i class="icon-stack3 mr-2"></i> ข้อมูลส่วนตัว</a></li>
								<li class="nav-item"><a href="#left-icon-employeducation" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> ประวัติการศึกษา</a></li>
								<li class="nav-item"><a href="#left-icon-employexpereince" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> ประวัติการทำงาน</a></li>
								<li class="nav-item"><a href="#left-icon-employtraining" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> ประวัติการฝึกอบรม</a></li>								
								<li class="nav-item"><a href="#left-icon-attachment" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> เอกสารแนบ</a></li>	
							</ul>

							<div class="tab-content">
								<div class="tab-pane fade show active" id="left-icon-employinfo">
									<input type="text" id="employid" value="" hidden>
									<div class="form-group">
										<label>คำนำหน้าชื่อ<span class="text-danger">*</span></label>
										<div id="employprefix_wrapper"></div>
									</div>

									<div class="form-group">
										<label>ชื่อ</label><span class="text-danger">*</span>
										<input type="text" id="employname_edit" placeholder="ชื่อ" class="form-control">
									</div>
									<div class="form-group">
										<label>นามสกุล</label><span class="text-danger">*</span>
										<input type="text" id="employlastname_edit" placeholder="นามสกุล" class="form-control">
									</div>
									<div class="form-group">
										<label>ตำแหน่ง</label>
										<div id="employposition_wrapper"></div>
									</div>
									<div class="form-group">
										<label>โทรศัพท์</label><span class="text-danger">*</span>
										<input type="text" id="employphone_edit" placeholder="เบอร์โทรศัพท์" class="form-control">
									</div>
									<div class="form-group">
										<label>โทรศัพท์มือถือ</label>
										<input type="text" id="employworkphone_edit" placeholder="เบอร์โทรศัพท์" class="form-control">
									</div>
									<div class="form-group">
										<label>อีเมล</label><span class="text-danger">*</span>
										<input type="text" id="employemail_edit" placeholder="อีเมล" class="form-control">
									</div>
									
									<div class="form-group">
										<button id="btn_edit_employ" data-id="" class="btn bg-primary" ><i class="icon-checkmark3 font-size-base mr-1"></i> แก้ไขข้อมูลพนักงาน</button>
									</div>
									
								</div>

								<div class="tab-pane fade" id="left-icon-employeducation">
									<div class="form-group">	
										<a href="" class="btn btn-info  btn-icon ml-2 btn-sm float-right" data-toggle="modal" data-target="#modal_add_employeducation"><i class="icon-add"></i></a>
									</div>
									<div class="table-responsive">
										<table class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>ระดับ</th>  
													<th>ชื่อสถานศึกษา</th>                                                                                    
													<th>สาขาวิชาเอก</th>       
													<th>ปีที่ศึกษา</th>  
													<th>เพิ่มเติม</th>    
												</tr>
											</thead>
											<tbody id="fulltbp_companyemployeducation_wrapper_tr">    
											</tbody>
										</table>
									</div>

								</div>
								<div class="tab-pane fade" id="left-icon-employexpereince">
									<div class="form-group">	
										<a href="" class="btn btn-info  btn-icon ml-2 btn-sm float-right" data-toggle="modal" data-target="#modal_add_employexperience"><i class="icon-add"></i></a>
									</div>

									<div class="table-responsive">
										<table class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>เริ่มต้น-สิ้นสุด</th>  
													<th>บริษัท</th>                                                                                    
													<th>ประเภทธุรกิจ</th>       
													<th>ตำแหน่งแรกเข้า</th>  
													<th>ตำแหน่งล่าสุด</th> 
													<th>เพิ่มเติม</th>    
												</tr>
											</thead>
											<tbody id="fulltbp_companyemployexperience_wrapper_tr">    
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="left-icon-attachment">
									<div class="input-group">													
										<label for="">เอกสารแนบ <a type="button" id="btnuploadboardattachment" onclick="document.getElementById('boardattachment').click();"><i class="icon-add text-info"></i></a></label>
									</div>
									<input type="file" style="display:none;" data-id="" id="boardattachment" name="boardattachment"/>

									<div class="table-responsive">
										<table class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>เอกสารแนบ</th>                                                                                  
													<th style="width:200px">ดาวน์โหลด</th>
												</tr>
											</thead>
											<tbody id="fulltbp_board_attachment_wrapper_tr">                             
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="left-icon-employtraining">
									<div class="form-group">	
										<a href="" class="btn btn-info  btn-icon ml-2 btn-sm float-right" data-toggle="modal" data-target="#modal_add_employtraining"><i class="icon-add"></i></a>
									</div>

									<div class="table-responsive">
										<table class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>วัน เดือน ปี</th>  
													<th>หลักสูตร</th>                                                                                    
													<th>หน่วยงานผู้จัด</th>       
													<th>เพิ่มเติม</th>    
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
				{{-- <button id="btn_modal_edit_employ" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button> --}}
			</div>
		</div>
	</div>
</div>
<div id="modal_add_employeducation" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มประวัติการศึกษา</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<label for="" class="text-danger">*กรุณาบันทึกวุฒิการศึกษาสูงสุดก่อน แล้วเรียงลำดับลงมา</label>
					<div class="col-md-12">
						<div class="form-group">
							<label>ระดับ</label><span class="text-danger">*</span>
							<input type="text" id="employeducationlevel" placeholder="ชื่อ" class="form-control">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>ชื่อสถานศึกษา</label><span class="text-danger">*</span>
							<input type="text" id="employeducationinstitute" placeholder="นามสกุล" class="form-control">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>สาขาวิชาเอก</label><span class="text-danger">*</span>
							<input type="text" id="employeducationmajor" placeholder="ตำแหน่ง" class="form-control">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>ปีที่ศึกษา (เริ่มต้น-สิ้นสุด)</label><span class="text-danger">*</span>
							<input type="text" id="employeducationyear" placeholder="ปีที่ศึกษา (เริ่มต้น-สิ้นสุด)" class="form-control">
						</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_employeducation" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
			</div>
		</div>
	</div>
</div>

{{-- modal_add_employexperience --}}
<div id="modal_add_employexperience" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มประวัติการทำงาน</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<label for="" class="text-danger">*กรุณาบันทึกประสบการณ์ทำงานจากปัจจุบันก่อน แล้วเรียงลำดับลงมา</label>
					<div class="col-md-12">
						<div class="form-group">
							<label>ช่วงเวลาการทำงานเริ่มต้น</label><span class="text-danger">*</span>
							<input type="text" id="employexperiencestartdate" placeholder="ช่วงเวลาการทำงานเริ่มต้น" class="form-control">
						</div>

						<div class="form-group">
							<label>ช่วงเวลาการทำงานสิ้นสุด</label><span class="text-danger">*</span>
							<input type="text" id="employexperienceenddate" placeholder="ช่วงเวลาการทำงานสิ้นสุด" class="form-control">
						</div>
						<div class="form-group">
							<label>บริษัท</label><span class="text-danger">*</span>
							<input type="text" id="employexperiencecompany" placeholder="บริษัท" class="form-control">
						</div>
						<div class="form-group">
							<label>ประเภทธุรกิจ</label><span class="text-danger">*</span>
							<input type="text" id="employexperiencebusinesstype" placeholder="ประเภทธุรกิจ" class="form-control">
						</div>
						<div class="form-group">
							<label>ตำแหน่งแรกเข้า</label><span class="text-danger">*</span>
							<input type="text" id="employexperiencestartposition" placeholder="ตำแหน่งแรกเข้า" class="form-control">
						</div>
						<div class="form-group">
							<label>ตำแหน่งล่าสุด</label><span class="text-danger">*</span>
							<input type="text" id="employexperienceendposition" placeholder="ตำแหน่งล่าสุด" class="form-control">
						</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_employexperience" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
			</div>
		</div>
	</div>
</div>

{{-- modal_add_employtraining --}}
<div id="modal_add_employtraining" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มประวัติการฝึกอบรม</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<label for="" class="text-danger">*กรุณาบันทึกประวัติการฝึกอบรมจากปัจจุบันก่อน แล้วเรียงลำดับลงมา</label>
					<div class="col-md-12">
						<div class="form-group">
							<label>วัน เดือน ปี</label><span class="text-danger">*</span>
							<input type="text" id="employtrainingdate" placeholder="วัน เดือน ปี" class="form-control">
						</div>

						<div class="form-group">
							<label>หลักสูตร</label><span class="text-danger">*</span>
							<input type="text" id="employtrainingcourse" placeholder="หลักสูตร" class="form-control">
						</div>
						<div class="form-group">
							<label>บริษัท</label><span class="text-danger">*</span>
							<input type="text" id="employtrainingowner" placeholder="บริษัท" class="form-control">
						</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_employtraining" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
			</div>
		</div>
	</div>
</div>

{{-- modal_add_stockholder --}}
<div id="modal_add_stockholder" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มผู้ถือหุ้น</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<div id="stockholderselect_wrapper"></div>
						</div>
						<div class="form-group">
							<label>ความสัมพันธ์กับ CEO</label><span class="text-danger">*</span>
							<input type="text" id="relationwithceo" placeholder="ความสัมพันธ์กับ CEO" class="form-control">
						</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_stockholder" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
			</div>
		</div>
	</div>
</div>

{{-- modal_add_tectdevlevel --}}
<div id="modal_add_tectdevlevel" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มระดับเทคโนโลยี</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>รายการ</label><span class="text-danger">*</span>
							<input type="text" id="tectdevleveltechnology" placeholder="รายการ" class="form-control">
						</div>
						<div class="form-group">
							<label>เทคโนโลยีที่มีอยู่ในปัจจุบัน</label><span class="text-danger">*</span>
							<input type="text" id="tectdevleveltechnologypresent" placeholder="เทคโนโลยีที่มีอยู่ในปัจจุบัน" class="form-control">
						</div>
						<div class="form-group">
							<label>เทคโนโลยีในโครงการ</label><span class="text-danger">*</span>
							<input type="text" id="tectdevleveltechnologyproject" placeholder="เทคโนโลยีในโครงการ" class="form-control">
						</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_tectdevlevel" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
			</div>
		</div>
	</div>
</div>

{{-- modal_add_award --}}
<div id="modal_add_award" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มประวัติการศึกษา</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>ชื่อรางวัล</label><span class="text-danger">*</span>
							<input type="text" id="awardname" placeholder="ชื่อ" class="form-control">
						</div>
					</div>
					<div class="col-md-12">	
						<div class="input-group">													
							<button id="btnuploadcertify" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('award').click();" >แนบเอกสาร</button>													
						</div>
						<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="award" name="award"/>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_award" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
			</div>
		</div>
	</div>
</div>

{{-- modal_add_standard --}}
<div id="modal_add_standard" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มประวัติการศึกษา</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>ใบรับรองมาตรฐาน</label><span class="text-danger">*</span>
							<input type="text" id="standardname" placeholder="ชื่อ" class="form-control">
						</div>
					</div>
					<div class="col-md-12">	
						<div class="input-group">													
							<button id="btnuploadstandard" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('standard').click();" >แนบเอกสาร</button>													
						</div>
						<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="standard" name="standard"/>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_standard" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
			</div>
		</div>
	</div>
</div>


{{-- modal_add_projectplan --}}
<div id="modal_add_projectplan" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มแผนการดำเนินงาน</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>รายละเอียดการดำเนินงาน</label><span class="text-danger">*</span>
							<input type="text" id="plandetail" placeholder="รายละเอียดการดำเนินงาน" class="form-control">
						</div>
					</div>
				</div>

				<div class="row">
					
					<div class="col-md-12">
						<label class="font-weight-semibold">เลือกเดือนที่ดำเนินการ</label>
						<div class="form-group">
							@for ($i = 1; $i <= 12; $i++)
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="plans[]" value="{{$i}}" class="custom-control-input checkboxplan" id="checkbox{{$i}}" >
								<label class="custom-control-label" for="checkbox{{$i}}">{{$i}}</label>
							</div>
							@endfor
						</div>
					</div>
					
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_projectplan" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
			</div>
		</div>
	</div>
</div>

{{-- modal_edit_projectplan --}}
<div id="modal_edit_projectplan" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มแผนการดำเนินงาน</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<input type="text" id="projectplan" value="" hidden >
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>รายละเอียดการดำเนินงาน</label><span class="text-danger">*</span>
							<input type="text" id="plandetail_edit" placeholder="รายละเอียดการดำเนินงาน" class="form-control">
						</div>
					</div>
				</div>

				<div class="row">
					
					<div class="col-md-12">
						<label class="font-weight-semibold">เลือกเดือนที่ดำเนินการ</label>
						<div class="form-group" id="monthplan">
							@for ($i = 1; $i <= 12; $i++)
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="plans[]" value="{{$i}}" class="custom-control-input checkboxplane_dit" id="checkbox{{$i}}" >
								<label class="custom-control-label" for="checkbox{{$i}}">{{$i}}</label>
							</div>
							@endfor
						</div>
					</div>
					
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_edit_projectplan" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
			</div>
		</div>
	</div>
</div>

	{{-- modal_add_tectdevlevel --}}
	<div id="modal_add_sell" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มยอดขาย</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>ชื่อผลิตภัณฑ์</label><span class="text-danger">*</span>
								<input type="text" id="productname" placeholder="รายการ" class="form-control">
							</div>
							<div class="form-group">
								<label>ยอดขายปีปัจจุบัน({{$fulltbp->presentyear}})</label><span class="text-danger">*</span>
								<input type="number" id="sellpresent" placeholder="ยอดขายปีปัจจุบัน({{$fulltbp->presentyear}})" class="form-control">
							</div>
							<div class="form-group">
								<label>ยอดขายปี{{$fulltbp->past1}}</label><span class="text-danger">*</span>
								<input type="number" id="sellpast1" placeholder="ยอดขายปี{{$fulltbp->past1}}" class="form-control">
							</div>
							<div class="form-group">
								<label>ยอดขายปี{{$fulltbp->past2}}</label><span class="text-danger">*</span>
								<input type="number" id="sellpast2" placeholder="ยอดขายปี{{$fulltbp->past2}}" class="form-control">
							</div>
							<div class="form-group">
								<label>ยอดขายปี{{$fulltbp->past3}}</label><span class="text-danger">*</span>
								<input type="number" id="sellpast3" placeholder="ยอดขายปี{{$fulltbp->past3}}" class="form-control">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_add_sell" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
				</div>
			</div>
		</div>
	</div>

	{{-- modal_edit_sell --}}
	<div id="modal_edit_sell" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มยอดขาย</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<input type="text" id="sellid" value="" hidden >
							<div class="form-group">
								<label>ชื่อผลิตภัณฑ์</label><span class="text-danger">*</span>
								<input type="text" id="productnameedit" placeholder="รายการ" class="form-control">
							</div>
							<div class="form-group">
								<label>ยอดขายปีปัจจุบัน({{$fulltbp->presentyear}})</label><span class="text-danger">*</span>
								<input type="number" id="sellpresentedit" placeholder="ยอดขายปีปัจจุบัน({{$fulltbp->presentyear}})" class="form-control">
							</div>
							<div class="form-group">
								<label>ยอดขายปี{{$fulltbp->past1}}</label><span class="text-danger">*</span>
								<input type="number" id="sellpastedit1" placeholder="ยอดขายปี{{$fulltbp->past1}}" class="form-control">
							</div>
							<div class="form-group">
								<label>ยอดขายปี{{$fulltbp->past2}}</label><span class="text-danger">*</span>
								<input type="number" id="sellpastedit2" placeholder="ยอดขายปี{{$fulltbp->past2}}" class="form-control">
							</div>
							<div class="form-group">
								<label>ยอดขายปี{{$fulltbp->past3}}</label><span class="text-danger">*</span>
								<input type="number" id="sellpastedit3" placeholder="ยอดขายปี{{$fulltbp->past3}}" class="form-control">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_edit_sell" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
				</div>
			</div>
		</div>
	</div>

	{{-- modal_edit_sellstatus --}}
	<div id="modal_edit_sellstatus" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มยอดขาย</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<input type="text" id="sellstatusid" value="" hidden >
							<div class="form-group">
								<label>รายการ</label><span class="text-danger">*</span>
								<input type="text" id="sellstatus" placeholder="รายการ" class="form-control" readonly>
							</div>
							<div class="form-group">
								<label>ยอดขายปีปัจจุบัน({{$fulltbp->presentyear}})</label><span class="text-danger">*</span>
								<input type="number" id="sellstatuspresentedit" placeholder="ยอดขายปีปัจจุบัน({{$fulltbp->presentyear}})" class="form-control">
							</div>
							<div class="form-group">
								<label>ยอดขายปี{{$fulltbp->past1}}</label><span class="text-danger">*</span>
								<input type="number" id="sellstatuspastedit1" placeholder="ยอดขายปี{{$fulltbp->past1}}" class="form-control">
							</div>
							<div class="form-group">
								<label>ยอดขายปี{{$fulltbp->past2}}</label><span class="text-danger">*</span>
								<input type="number" id="sellstatuspastedit2" placeholder="ยอดขายปี{{$fulltbp->past2}}" class="form-control">
							</div>
							<div class="form-group">
								<label>ยอดขายปี{{$fulltbp->past3}}</label><span class="text-danger">*</span>
								<input type="number" id="sellstatuspastedit3" placeholder="ยอดขายปี{{$fulltbp->past3}}" class="form-control">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_edit_sellstatus" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
				</div>
			</div>
		</div>
	</div>

	{{-- modal_add_debtpartner --}}
	<div id="modal_add_debtpartner" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มลูกหนี้การค้า</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>ลูกหนี้การค้า</label><span class="text-danger">*</span>
								<input type="text" id="debtpartner" placeholder="ลูกหนี้การค้า" class="form-control" >
							</div>
							<div class="form-group">
								<label>จำนวนผลิตภัณฑ์หรือโครงการ</label><span class="text-danger">*</span>
								<input type="number" id="numproject" placeholder="จำนวนผลิตภัณฑ์หรือโครงการ" class="form-control">
							</div>
							<div class="form-group">
								<label>เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)</label><span class="text-danger">*</span>
								<input type="number" id="debtpartnertaxid" placeholder="เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)" class="form-control">
							</div>
							<div class="form-group">
								<label>ยอดขายต่อปี (บาท)</label><span class="text-danger">*</span>
								<input type="number" id="debttotalyearsell" placeholder="ยอดขายต่อปี (บาท)" class="form-control">
							</div>
							<div class="form-group">
								<label>เปรียบเทียบกับยอดขาย (%)</label><span class="text-danger">*</span>
								<input type="number" id="debtpercenttosale" placeholder="เปรียบเทียบกับยอดขาย (%)" class="form-control">
							</div>
							<div class="form-group">
								<label>จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)</label><span class="text-danger">*</span>
								<input type="number" id="debtpartneryear" placeholder="จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)" class="form-control">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_add_debtpartner" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
				</div>
			</div>
		</div>
	</div>

		{{-- modal_edit_debtpartner --}}
		<div id="modal_edit_debtpartner" class="modal fade" style="overflow:hidden;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มลูกหนี้การค้า</h5>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<input type="text" id="debtpartnerid" value="" hidden >
								<div class="form-group">
									<label>ลูกหนี้การค้า</label><span class="text-danger">*</span>
									<input type="text" id="debtpartneredit" placeholder="ลูกหนี้การค้า" class="form-control" >
								</div>
								<div class="form-group">
									<label>จำนวนผลิตภัณฑ์หรือโครงการ</label><span class="text-danger">*</span>
									<input type="number" id="numprojectedit" placeholder="จำนวนผลิตภัณฑ์หรือโครงการ" class="form-control">
								</div>
								<div class="form-group">
									<label>เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)</label><span class="text-danger">*</span>
									<input type="number" id="debtpartnertaxidedit" placeholder="เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)" class="form-control">
								</div>
								<div class="form-group">
									<label>ยอดขายต่อปี (บาท)</label><span class="text-danger">*</span>
									<input type="number" id="debttotalyearselledit" placeholder="ยอดขายต่อปี (บาท)" class="form-control">
								</div>
								<div class="form-group">
									<label>เปรียบเทียบกับยอดขาย (%)</label><span class="text-danger">*</span>
									<input type="number" id="debtpercenttosaleedit" placeholder="เปรียบเทียบกับยอดขาย (%)" class="form-control">
								</div>
								<div class="form-group">
									<label>จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)</label><span class="text-danger">*</span>
									<input type="number" id="debtpartneryearedit" placeholder="จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)" class="form-control">
								</div>
							</div>
						</div>
					</div>           
					<div class="modal-footer">
						<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
						<button id="btn_modal_edit_debtpartner" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
					</div>
				</div>
			</div>
		</div>

	{{-- modal_add_creditpartner --}}
	<div id="modal_add_creditpartner" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มเจ้าหนี้การค้า</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>เจ้าหนี้การค้า</label><span class="text-danger">*</span>
								<input type="text" id="creditpartner" placeholder="เจ้าหนี้การค้า" class="form-control" >
							</div>
							<div class="form-group">
								<label>เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)</label><span class="text-danger">*</span>
								<input type="number" id="creditpartnertaxid" placeholder="เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)" class="form-control">
							</div>
							<div class="form-group">
								<label>ยอดซื้อต่อปี (บาท)</label><span class="text-danger">*</span>
								<input type="number" id="credittotalyearsell" placeholder="ยอดซื้อต่อปี (บาท)" class="form-control">
							</div>
							<div class="form-group">
								<label>เปรียบเทียบกับยอดซื้อ (%)</label><span class="text-danger">*</span>
								<input type="number" id="creditpercenttosale" placeholder="เปรียบเทียบกับยอดซื้อ (%)" class="form-control">
							</div>
							<div class="form-group">
								<label>จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)</label><span class="text-danger">*</span>
								<input type="number" id="creditpartneryear" placeholder="จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)" class="form-control">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_add_creditpartner" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
				</div>
			</div>
		</div>
	</div>

	{{-- modal_edit_creditpartner --}}
	<div id="modal_edit_creditpartner" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มเจ้าหนี้การค้า</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<input type="text" id="creditpartnerid" value="" hidden >
						<div class="col-md-12">
							<div class="form-group">
								<label>เจ้าหนี้การค้า</label><span class="text-danger">*</span>
								<input type="text" id="creditpartneredit" placeholder="เจ้าหนี้การค้า" class="form-control" >
							</div>
							<div class="form-group">
								<label>เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)</label><span class="text-danger">*</span>
								<input type="number" id="creditpartnertaxidedit" placeholder="เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)" class="form-control">
							</div>
							<div class="form-group">
								<label>ยอดซื้อต่อปี (บาท)</label><span class="text-danger">*</span>
								<input type="number" id="credittotalyearselledit" placeholder="ยอดซื้อต่อปี (บาท)" class="form-control">
							</div>
							<div class="form-group">
								<label>เปรียบเทียบกับยอดซื้อ (%)</label><span class="text-danger">*</span>
								<input type="number" id="creditpercenttosaleedit" placeholder="เปรียบเทียบกับยอดซื้อ (%)" class="form-control">
							</div>
							<div class="form-group">
								<label>จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)</label><span class="text-danger">*</span>
								<input type="number" id="creditpartneryearedit" placeholder="จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)" class="form-control">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_edit_creditpartner" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
				</div>
			</div>
		</div>
	</div>

	
	{{-- modal_edit_asset --}}
	<div id="modal_edit_asset" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มเจ้าหนี้การค้า</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<input type="text" id="assetid" value="" hidden >
							<div class="form-group">
								<label>รายการ</label><span class="text-danger">*</span>
								<input type="text" id="asset" placeholder="รายการ" class="form-control" readonly >
							</div>
							<div class="form-group">
								<label>จำนวนเงิน (บาท)</label><span class="text-danger">*</span>
								<input type="number" id="assetcostedit" placeholder="จำนวนเงิน (บาท)" class="form-control">
							</div>
							<div class="form-group">
								<label>จำนวน (ชิ้น)</label><span class="text-danger">*</span>
								<input type="number" id="assetquantityedit" placeholder="จำนวน (ชิ้น)" class="form-control">
							</div>
							<div class="form-group">
								<label>ราคาต่อเครื่อง (บาท)</label><span class="text-danger">*</span>
								<input type="number" id="assetpriceedit" placeholder="ราคาต่อเครื่อง (บาท)" class="form-control">
							</div>
							<div class="form-group">
								<label>ข้อมูลจำเพาะทางเทคนิค (Specification)</label><span class="text-danger">*</span>
								<input type="text" id="assetspecificationedit" placeholder="ข้อมูลจำเพาะทางเทคนิค (Specification)" class="form-control">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_edit_asset" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
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
								<input type="text" id="investment" placeholder="รายการ" class="form-control" readonly >
							</div>
							<div class="form-group">
								<label>จำนวนเงิน (บาท)</label><span class="text-danger">*</span>
								<input type="number" id="investmentcostedit" placeholder="จำนวนเงิน (บาท)" class="form-control">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_edit_investment" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
				</div>
			</div>
		</div>
	</div>

	{{-- modal_edit_cost --}}
	<div id="modal_edit_cost" class="modal fade" style="overflow:hidden;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เงินลงทุนสำหรับการดำเนินการโครงการ</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<input type="text" id="costid" value="" hidden >
							<div class="form-group">
								<label>แหล่งเงินทุน</label><span class="text-danger">*</span>
								<input type="text" id="costnameedit" placeholder="แหล่งเงินทุน" class="form-control" readonly >
							</div>
							<div class="form-group">
								<label>เงินทุนที่มีอยู่แล้ว</label><span class="text-danger">*</span>
								<input type="number" id="costexistingedit" placeholder="เงินทุนที่มีอยู่แล้ว" class="form-control">
							</div>
							<div class="form-group">
								<label>เงินทุนที่เสนอขออนุมัติ</label><span class="text-danger">*</span>
								<input type="number" id="costneededit" placeholder="เงินทุนที่เสนอขออนุมัติ" class="form-control">
							</div>
							<div class="form-group">
								<label>เงินทุนที่ได้รับการอนุมัติแล้ว</label><span class="text-danger">*</span>
								<input type="number" id="costapprovededit" placeholder="เงินทุนที่ได้รับการอนุมัติแล้ว" class="form-control">
							</div>
							<div class="form-group">
								<label>แผนการหาเงินทุนเพิ่ม</label><span class="text-danger">*</span>
								<input type="text" id="costplanedit" placeholder="แผนการหาเงินทุนเพิ่ม" class="form-control">
							</div>
						</div>
					</div>
				</div>           
				<div class="modal-footer">
					<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
					<button id="btn_modal_edit_cost" data-id="{{$fulltbp->id}}" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
				</div>
			</div>
		</div>
	</div>

{{-- modal_add_companydoc --}}
<div id="modal_add_companydoc" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มเอกสารสำคัญ</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>ชื่อเอกสาร</label><span class="text-danger">*</span>
							<input type="text" id="companydocname" placeholder="ชื่อเอกสาร" class="form-control">
						</div>
					</div>
					<div class="col-md-12">	
						<div class="input-group">													
							<button id="btnuploadcompanydoc" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('companydoc').click();" >แนบเอกสาร</button>													
						</div>
						<input type="file" style="display:none;" data-id="{{$company->id}}" id="companydoc" name="companydoc"/>
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

{{-- modal_add_researcher --}}
<div id="modal_add_researcher" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มนักวิจัย</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>คำนำหน้าชื่อ</label>
									<select id="researcherfix" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-select2">
										@foreach ($prefixes as $prefix)
											<option value="{{$prefix->id}}" >{{$prefix->name}}</option> 
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>ชื่อ</label>
									<input type="text" id="researchername" placeholder="ชื่อ" class="form-control">
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label>นามสกุล</label>
									<input type="text" id="researcherlastname" placeholder="นามสกุล" class="form-control">
								</div>
							</div>
						</div>
				
					</div>
					<div class="col-md-12">
							<div class="form-group">
								<label>ประวัติการศึกษา</label>
								<input type="text" id="researchereducation" placeholder="ประวัติการศึกษา" class="form-control">
							</div>
							<div class="form-group">
								<label>ประสบการณ์การทำงาน</label>
								<input type="text" id="researcherexperience" placeholder="ประสบการณ์การทำงาน" class="form-control">
							</div>
							<div class="form-group">
								<label>ประวัดิการฝึกอบรม</label>
								<input type="text" id="researchertraining" placeholder="ประวัดิการฝึกอบรม" class="form-control">
							</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_researcher" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
			</div>
		</div>
	</div>
</div>


{{-- modal_add_projectmember --}}
<div id="modal_add_projectmember" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มทีมงานในโครงการ</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>คำนำหน้าชื่อ</label>
									<select id="projectmemberfix" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-select2">
										@foreach ($prefixes as $prefix)
											<option value="{{$prefix->id}}" >{{$prefix->name}}</option> 
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>ชื่อ</label>
									<input type="text" id="projectmembername" placeholder="ชื่อ" class="form-control">
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label>นามสกุล</label>
									<input type="text" id="projectmemberlastname" placeholder="นามสกุล" class="form-control">
								</div>
							</div>
						</div>
				
					</div>
					<div class="col-md-12">
							<div class="form-group">
								<label>ประวัติการศึกษา</label>
								<input type="text" id="projectmembereducation" placeholder="ประวัติการศึกษา" class="form-control">
							</div>
							<div class="form-group">
								<label>ประสบการณ์การทำงาน</label>
								<input type="text" id="projectmemberexperience" placeholder="ประสบการณ์การทำงาน" class="form-control">
							</div>
							<div class="form-group">
								<label>ประวัดิการฝึกอบรม</label>
								<input type="text" id="projectmembertraining" placeholder="ประวัดิการฝึกอบรม" class="form-control">
							</div>
					</div>
				</div>
			</div>           
			<div class="modal-footer">
				<button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
				<button id="btn_modal_add_projectmember" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
			</div>
		</div>
	</div>
</div>

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Full TBP</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
			{{-- <div class="text-right">
				<button type="button" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
			</div> --}}
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> การประเมิน</a>
                    <a href="{{route('dashboard.company.project.fulltbp')}}" class="breadcrumb-item"> รายการ Full TBP</a>
                    <span class="breadcrumb-item active">Full TBP</span>
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
					{{-- <div class="card-header bg-white header-elements-inline">
						<h6 class="card-title">Basic example</h6>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a>
		                	</div>
	                	</div>
					</div> --}}
					<div class="card-body">
					<input type="text" id="fulltbpid" value="{{$fulltbp->id}}" hidden>
						<form class="wizard-form steps-basic" action="#" data-fouc>
							<h6>1.ข้อมูลทั่วไป</h6>

							<fieldset>
								<div id="accordion-group">
									<div class="card border-top-info rounded-top-1 mb-0 rounded-bottom-0">
										<div class="card-header">
											<h6 class="card-title">
												<a data-toggle="collapse" class="text-default list-icons-item" href="#accordion-item-group1"><div class="list-icons"><a class="list-icons-item mr-2 mb-2" data-action="collapse"></a></div>1.1 ข้อมูลกิจการ</a>
											</h6>
										</div>
		

										{{-- <div class="card-header text-white header-elements-inline">
											<h6 class="card-title"><a data-toggle="collapse" class="text-default" href="#accordion-item-group1">1.1 ข้อมูลกิจการ</a></h6>
											<div class="header-elements">
												<div class="list-icons">
													<a class="list-icons-item text-teal" data-action="collapse"></a>
												</div>
											</div>
										</div> --}}

										<div id="accordion-item-group1" class="collapse" data-parent="#accordion-group">
											<div class="card-body">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>ชื่อนิติบุคคล</label>
															<input type="text"  value="{{$fulltbp->minitbp->businessplan->company->name}}"  placeholder="ชื่อนิติบุคคล" class="form-control" readonly>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>ประเภทธุรกิจ</label>
															<select name="businesstype" id="businesstype" data-placeholder="ประเภทธุรกิจ" class="form-control form-control-select2" data-fouc>
																@foreach ($businesstypes as $businesstype)
																	<option value="{{$businesstype->id}}" @if($fulltbp->minitbp->businessplan->company->business_type_id == $businesstype->id) selected @endif >{{$businesstype->name}}</option> 
																@endforeach
															</select>
														</div>
													</div>
				
													<div class="col-md-6">
														<div class="form-group">
															<label>ทะเบียนนิติบุคคลเลขที่</label>
															<input type="text" value="{{$fulltbp->minitbp->businessplan->company->vatno}}"  placeholder="เลขทะเบียนนิติบุคคล" class="form-control" readonly>
														</div>
													</div>
				
													<div class="col-md-6">
														<div class="form-group">
															<label>ปีที่จดทะเบียน</label>
															<input type="number"  value="{{$fulltbp->minitbp->businessplan->company->registeredyear}}"  placeholder="ปีที่จดทะเบียน" class="form-control" readonly>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>ทุนที่จดทะเบียน</label>
															<input type="number" value="{{$fulltbp->minitbp->businessplan->company->registeredcapital}}"  placeholder="ทุนที่จดทะเบียน" class="form-control" readonly>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>ทุนจดทะเบียนที่เรียกชำระแล้ว</label>
															<input type="number"  value="{{$fulltbp->minitbp->businessplan->company->paidupcapital}}"  placeholder="ทุนจดทะเบียนที่เรียกชำระแล้ว" class="form-control" readonly>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>วันที่ชำระทุนจดทะเบียน</label>
															<input type="text" value="{{$fulltbp->minitbp->businessplan->company->paidupcapitaldateth}}"  placeholder="ทุนจดทะเบียนที่เรียกชำระแล้ว" class="form-control" readonly>
														</div>
													</div>
													{{-- <div class="col-md-6">
														<div class="form-group">
															<label>วันที่ชำระทุนจดทะเบียน</label>
															<input type="text" value="{{$fulltbp->minitbp->businessplan->company->paidupcapitaldateth}}"  placeholder="ทุนจดทะเบียนที่เรียกชำระแล้ว" class="form-control" readonly>
														</div>
													</div> --}}
													<div class="col-md-12">
														<div class="form-group">
															<label>แผนผังองค์กร (รูปขนาด 500 x 300px)</label>
															<div class="input-group">													
																{{-- <input type="text" id="fileorganizeimg" class="form-control border-right-0" placeholder="แผนผังองค์กร"  > --}}
																	<button class="btn bg-info" type="button" onclick="document.getElementById('organizeimg').click();">อัปโหลด</button>													
															</div>
															<input type="file" style="display:none;" id="organizeimg" data-id="{{$fulltbp->minitbp->businessplan->company->id}}" name="organizeimg"/>
															@if (!Empty($fulltbp->minitbp->businessplan->company->organizeimg))
																<br>
																<img id="organizeimgholder" src="{{asset($fulltbp->minitbp->businessplan->company->organizeimg)}}" width="500" height="300" alt="">
																@else
																<br>
																<img id="organizeimgholder" src="{{asset('assets/dashboard/images/orgimg.png')}}" width="500" height="300" alt="">
																
															@endif
														</div>
													</div>
													<legend>
														<label for=""><strong>รายการบุคลากร</strong></label>
													</legend>
													<div class="col-md-12">
														<div class="row">
															<div class="col-md-3">
																<div class="form-group">
																	<label>จำนวนบุคลากรทั้งหมด</label>
																	<input type="number" name ="department_qty" id ="department_qty" value="{{$fulltbpemployee->department_qty}}" class="form-control" >
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label>ผ่ายบริหาร</label>
																	<input type="number" name ="department1_qty"  id ="department1_qty" value="{{$fulltbpemployee->department1_qty}}" class="form-control" >
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label>ฝ่ายวิจัยและพัฒนา</label>
																	<input type="number" name ="department2_qty" id ="department2_qty" value="{{$fulltbpemployee->department2_qty}}" class="form-control" >
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label>ฝ่ายผลิต/วิศวกรรม</label>
																	<input type="number" name ="department3_qty" id ="department3_qty" value="{{$fulltbpemployee->department3_qty}}" class="form-control" >
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label>ผ่ายการตลาด</label>
																	<input type="number" name ="department4_qty" id ="department4_qty" value="{{$fulltbpemployee->department4_qty}}" class="form-control" >
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label>พนักงานทั่วไป</label>
																	<input type="number" name ="department5_qty" id ="department5_qty" value="{{$fulltbpemployee->department5_qty}}" class="form-control" >
																</div>
															</div>
														</div>
													</div>
													<legend>
														<label for="">ประวัติบริษัท</label>
													</legend>
													<div class="col-md-12">
														<div class="form-group">
															<label for="">รายละเอียด (การก่อตั้ง การเพิ่มทุน การเปลี่ยนแปลงชื่อบริษัท หรือการเปลี่ยนแปลงทางธุรกิจ ฯลฯ) </label> <span class="text-primary" id="companyprofiletextlength"></span>
															{{-- <input type="text" id="companyprofile_input" class="form-control companyprofileclass" > --}}
															<textarea name="companyhistory" id="companyhistory" class="form-control" cols="3" rows="7">{{$fulltbp->minitbp->businessplan->company->companyhistory}}</textarea>
														</div>
														{{-- <div id="fulltbp_companyprofile_wrapper" style="border: dashed 1px #999999">
															@foreach ($fulltbpcompanyprofiledetails as $fulltbpcompanyprofiledetail)
																<input type="text" name ="companyprofile[]" value="{{$fulltbpcompanyprofiledetail->line}}" class="form-control companyprofileclass" style="border: 0" >
															@endforeach
														</div>
														<hr>	 --}}
														<div class="row">
															<div class="col-md-12">	
																<div class="input-group">													
																	{{-- <button id="btnuploadattachment" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('attachment').click();"><i class="icon-add"></i></button>													 --}}
																	<label for="">เอกสารแนบข้อมูลทั่วไป <a type="button" id="btnuploadattachment" onclick="document.getElementById('attachment').click();"><i class="icon-add text-info"></i></a></label>
																</div>
																<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="attachment" name="attachment"/>
															</div>
														</div>			
														<div class="row">	
															<div class="col-md-12" id="fulltbp_companyprofile_attachment_wrapper" >	
															</div>
														</div>
														<div class="row">
															<div class="col-md-12">	
																<div class="table-responsive">
																	<table class="table table-striped table-bordered">
																		<thead>
																			<tr class="bg-info">
																				<th>เอกสารแนบ</th>                                                                                  
																				<th style="width:200px">ดาวน์โหลด</th>
																			</tr>
																		</thead>
																		<tbody id="fulltbp_companyprofile_attachment_wrapper_tr">    
																			@foreach ($fulltbpcompanyprofileattachments as $fulltbpcompanyprofileattachment)
																				<tr >                                        
																					<td> {{$fulltbpcompanyprofileattachment->name}} </td>                                            
																					<td> 
																						<a href="{{asset($fulltbpcompanyprofileattachment->path)}}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
																						<a type="button" data-id="{{$fulltbpcompanyprofileattachment->id}}" data-name=""  class="btn btn-sm bg-danger deletefulltbpcompanyprofileattachment">ลบ</a>                                       
																					</td>
																				</tr>
																			@endforeach                            
																		</tbody>
																	</table>
																</div>
															</div>      
														</div>
														{{-- <div class="row">
															<div class="col-md-12">	
																<div class="form-group">
																	<br>
																	<button type="button" id="btnaddcompanyprofile" data-id="{{$fulltbp->id}}" class="btn bg-teal float-right" >บันทึกประวัติบริษัท</button>
																</div>
															</div>
														</div>	 --}}
													</div>
												</div>
											</div>
										</div>
									</div>
		
									<div class="card mb-0 border-top-success rounded-top-0 rounded-0 border-y-0">
										<div class="card-header">
											<h6 class="card-title">
												<a class="collapsed text-default" data-toggle="collapse" href="#accordion-item-group2"><div class="list-icons"><a class="list-icons-item mr-2 mb-2" data-action="collapse"></a></div>1.2 ข้อมูลบุคลากร</a>
											</h6>
										</div>
		
										<div id="accordion-item-group2" class="collapse" data-parent="#accordion-group">
											<div class="card-body">
												<div class="row">
													<div class="col-md-12">	
														<label for="">ข้อมูลผู้บริหารระดับสูง <a href="" id="btnaddemploy" data-toggle="modal" data-target="#modal_add_employ"><i class="icon-add text-info"></i></a></label>
														<div class="table-responsive">
															<table class="table table-striped table-bordered">
																<thead>
																	<tr class="bg-info">
																		<th>ชื่อ-สกุล</th>  
																		<th>ตำแหน่ง</th>                                                                                    
																		<th>โทรศัพท์</th>       
																		<th>โทรศัพท์มือถือ</th>  
																		<th>อีเมล</th>
																		<th style="width:250px">เพิ่มเติม</th>    
																	</tr>
																</thead>
																<tbody id="fulltbp_companyemploy_wrapper_tr">    
																	@foreach ($companyemploys->where('employ_position_id','<=',5) as $companyemploy)
																		<tr >                                        
																			<td> {{$companyemploy->name}} {{$companyemploy->lastname}}</td> 
																			<td> {{$companyemploy->employposition->name}} </td> 
																			<td> {{$companyemploy->phone}} </td>                                            
																			<td> {{$companyemploy->workphone}} </td> 
																			<td> {{$companyemploy->email}} </td> 
																			<td> 
																				<a type="button" data-id="{{$companyemploy->id}}" class="btn btn-sm bg-teal editEmployinfo">เพิ่มเติมข้อมูลส่วนตัว</a>
																				<a type="button" data-id="{{$companyemploy->id}}" class="btn btn-sm bg-warning deletecompanyemploy">ลบ</a> 
																			</td> 
																		</tr>
																	@endforeach                            
																</tbody>
															</table>
														</div>
													</div>
												
													{{-- <div class="row"> --}}
														<div class="col-md-12 mt-3">	
															<label for="">ข้อมูลผู้ถือหุ้น <a type="button" id="btnstckholder" data-id="{{$company->id}}" ><i class="icon-add text-info"></i></a></label>
															<div class="table-responsive">
																<table class="table table-striped table-bordered">
																	<thead>
																		<tr class="bg-info">
																			<th>ชื่อ-สกุล</th>  
																			<th>ความสัมพันธ์กับ CEO</th>
																			<th style="width:200px">เพิ่มเติม</th>    
																		</tr>
																	</thead>
																	<tbody id="fulltbp_companystockholder_wrapper_tr">    
																		@foreach ($companystockholders as $companystockholder)
																			<tr >                                        
																				<td> {{$companystockholder->companyemploy->name}} {{$companystockholder->companyemploy->lastname}}</td> 
																				<td> {{$companystockholder->relationwithceo}} </td> 
																				<td> <a type="button" data-id="{{$companystockholder->id}}" class="btn btn-sm bg-warning deletestockholder">ลบ</a> </td> 
																			</tr>
																		@endforeach                            
																	</tbody>
																</table>
															</div>
														</div>
													{{-- </div> --}}
													
													{{-- <div class="row"> --}}
														<div class="col-md-12 mt-3">	
															<label for="">ข้อมูลทีมวิจัย <a href="#" data-toggle="modal" data-target="#modal_add_researcher"><i class="icon-add text-info"></i></a></label>
															<div class="table-responsive">
																<table class="table table-striped table-bordered">
																	<thead>
																		<tr class="bg-info">
																			<th>ชื่อ-สกุล</th>  
																			<th>ประวัติการศึกษา</th>
																			<th>ประสบการณ์การทำงาน</th>
																			<th>ประวัดิการฝึกอบรม</th>
																			<th style="width:200px">เพิ่มเติม</th>    
																		</tr>
																	</thead>
																	<tbody id="fulltbp_researcher_wrapper_tr">    
																		@foreach ($fulltbpresearchers->where('employtype',1) as $fulltbpresearcher)
																			<tr >                                        
																				<td> {{$fulltbpresearcher->prefix->name}}{{$fulltbpresearcher->name}} {{$fulltbpresearcher->name}}</td> 
																				<td> {{$fulltbpresearcher->education}} </td> 
																				<td> {{$fulltbpresearcher->experience}} </td> 
																				<td> {{$fulltbpresearcher->training}} </td> 
																				<td> <a type="button" data-id="{{$fulltbpresearcher->id}}" class="btn btn-sm bg-warning deleteresearcher">ลบ</a> </td> 
																			</tr>
																		@endforeach    			   
																	</tbody>
																</table>
															</div>
														</div>
														
														<div class="col-md-12 mt-3">	
															<label for="">ข้อมูลทีมงานในโครงการ <a href="#" data-toggle="modal" data-target="#modal_add_projectmember"><i class="icon-add text-info"></i></a></label>
															<div class="table-responsive">
																<table class="table table-striped table-bordered">
																	<thead>
																		<tr class="bg-info">
																			<th>ชื่อ-สกุล</th>  
																			<th>ประวัติการศึกษา</th>
																			<th>ประสบการณ์การทำงาน</th>
																			<th>ประวัดิการฝึกอบรม</th>
																			<th style="width:200px">เพิ่มเติม</th>    
																		</tr>
																	</thead>
																	<tbody id="fulltbp_projectmember_wrapper_tr">    
																		@foreach ($fulltbpresearchers->where('employtype',2) as $fulltbpresearcher)
																			<tr >                                        
																				<td> {{$fulltbpresearcher->prefix->name}}{{$fulltbpresearcher->name}} {{$fulltbpresearcher->name}}</td> 
																				<td> {{$fulltbpresearcher->education}} </td> 
																				<td> {{$fulltbpresearcher->experience}} </td> 
																				<td> {{$fulltbpresearcher->training}} </td> 
																				<td> <a type="button" data-id="{{$fulltbpresearcher->id}}" class="btn btn-sm bg-warning deleteresearcher">ลบ</a> </td> 
																			</tr>
																		@endforeach    			   
																	</tbody>
																</table>
															</div>
														</div>
													{{-- </div> --}}
													<br>
													{{-- <div class="row"> --}}
														<legend class="mt-2"><label for=""><strong>ข้อมูลผู้รับผิดชอบหลักในโครงการ</strong> </label></legend>
														<div class="col-md-6">
															<div class="form-group">
																<label>คำนำหน้าชื่อ</label>
																<select id="responsibleprefix" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-select2">
																	@foreach ($prefixes as $prefix)
																		<option value="{{$prefix->id}}" 
																			@if ($prefix->id == @$fulltbp->fulltbpresponsibleperson->prefix_id) selected @endif >{{$prefix->name}}</option> 
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>ชื่อ</label>
																<input type="text" id="responsiblename" value="{{@$fulltbp->fulltbpresponsibleperson->name}}" placeholder="ชื่อ" class="form-control">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>นามสกุล</label>
																<input type="text" id="responsiblelastname" value="{{@$fulltbp->fulltbpresponsibleperson->lastname}}" placeholder="นามสกุล" class="form-control">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>อีเมล</label>
																<input type="text" id="responsibleemail" value="{{@$fulltbp->fulltbpresponsibleperson->email}}" placeholder="อีเมล" class="form-control">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>ตำแหน่ง</label>
																<input type="text" id="responsibleposition" value="{{@$fulltbp->fulltbpresponsibleperson->position}}" placeholder="ตำแหน่ง" class="form-control">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>โทรศัพท์</label>
																<input type="text" id="responsiblephone" value="{{@$fulltbp->fulltbpresponsibleperson->phone1}}" placeholder="เบอร์โทรศัพท์" class="form-control">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label>โทรศัพท์มือถือ</label>
																<input type="text" id="responsibleworkphone" value="{{@$fulltbp->fulltbpresponsibleperson->phone2}}" placeholder="โทรศัพท์มือถือ" class="form-control">
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label>ประวัติการศึกษา</label>
																
																<textarea name="responsibleeducationhistory" id="responsibleeducationhistory" class="form-control" cols="3" rows="3">{{@$fulltbp->fulltbpresponsibleperson->educationhistory}}</textarea>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label>ประสบการณ์การทำงาน</label>
																
																<textarea name="responsibleexperiencehistory" id="responsibleexperiencehistory"  class="form-control" cols="3" rows="3">{{@$fulltbp->fulltbpresponsibleperson->experiencehistory}}</textarea>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label>ประวัติการฝึกอบรม</label>
																
																<textarea name="responsibletraininghistory" id="responsibletraininghistory"  class="form-control" cols="3" rows="3">{{@$fulltbp->fulltbpresponsibleperson->traininghistory}}</textarea>
															</div>
														</div>
													{{-- </div> --}}
												</div>
											</div>
										</div>
									</div>
		
								
								</div>
								<!-- /accordion group -->
						
							</fieldset>


							

							<h6>2.ภาพรวมโครงการที่ขอรับประเมิน</h6>
							<fieldset>
							
									<div id="accordion-group">
										<div class="card border-top-info rounded-top-1 mb-0 rounded-bottom-0">
											<div class="card-header">
												<h6 class="card-title">
													<a data-toggle="collapse" class="text-default" href="#accordion-item-group1"><div class="list-icons"><a class="list-icons-item mr-2 mb-2" data-action="collapse"></a></div>2.1 ข้อมูลทั่วไป</a>
												</h6>
											</div>

											<div id="accordion-item-group1" class="collapse" data-parent="#accordion-group">
												<div class="card-body">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label for="">ชื่อโครงการ<span class="text-danger">*</span></label>
																<input type="text"  value="{{$minitbp->project}}" class="form-control" disabled>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="">ชื่อโครงการ (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
																<input type="text" value="{{$minitbp->projecteng}}" class="form-control" disabled>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<div class="form-group">
																	<label for="">บทคัดย่อ </label> <span class="text-primary" id="projectabtracttextlength"></span>
																	<p><small><i>ควรประกอบด้วย 3 ย่อหน้า (1) ปัญหาหรือความต้องการของอุตสาหกรรมที่จะแก้ไข (Pain Point) (2) การแก้ปัญหาหรือตอบโจทย์ความต้องการของอุตสาหกรรมในโครงการ และ (3) ผลที่จะได้จากโครงการ รวมถึงผลกระทบเชิงเศรษฐกิจและสังคม</i> </small></p>
																	
																	{{-- <input type="text" id="projectabtract_input" class="form-control projectabtractclass" > --}}
																	<textarea name="" id="projectabtract_input" class="form-control" cols="3" rows="5">{!!$fulltbp->abtract!!}</textarea>
																</div>
																{{-- <div id="fulltbp_projectabtract_wrapper" style="border: dashed 1px #999999">
																	@foreach ($fulltbpprojectabtractdetails as $fulltbpprojectabtractdetail)
																		<input type="text" name ="projectabtract[]" value="{{$fulltbpprojectabtractdetail->line}}" class="form-control projectabtractclass" style="border: 0" >
																	@endforeach
																</div>
																<div class="row">
																	<div class="col-md-12">	
																		<div class="form-group">
																			<br>
																			<button type="button" id="btnaddprojectabtract" data-id="{{$fulltbp->id}}" class="btn bg-teal float-right" >บันทึกบทคัดย่อ</button>
																		</div>
																	</div>
																</div> --}}
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label for="">ผลิตภัณฑ์หลัก (สินค้า/บริการ) ของโครงการ </label>
																<p><small><i>อธิบายลักษณะของผลิตภัณฑ์หลัก (สินค้า/บริการ) ภายในโครงการ</i> </small></p>
																<textarea name="" id="mainproduct_input" class="form-control" cols="3" rows="5">{!!$fulltbp->mainproduct!!}</textarea>
																{{-- <input type="text" id="productdetails_input" class="form-control productdetailsclass" > --}}
															</div>
															{{-- <div id="fulltbp_productdetails_wrapper" style="border: dashed 1px #999999">
																@foreach ($fulltbpproductdetails as $fulltbpproductdetail)
																	<input type="text" name ="productdetails[]" value="{{$fulltbpproductdetail->line}}" class="form-control productdetailsclass" style="border: 0" >
																@endforeach
															</div>
															<div class="row">
																<div class="col-md-12">	
																	<div class="form-group">
																		<br>
																		<button type="button" id="btnaddproductdetails" data-id="{{$fulltbp->id}}" class="btn bg-teal float-right" >บันทึกจุดเด่นผลิตภัณฑ์หลัก</button>
																	</div>
																</div>
															</div> --}}

														</div>

														<div class="col-md-12">
															<div class="form-group">
																<label for="">จุดเด่นของผลิตภัณฑ์หลัก (สินค้าและบริการ) ของโครงการ </label> <span class="text-primary" id="productdetailstextlength"></span>
																<p><small><i>อธิบายจุดเด่นหรือความแตกต่างของผลิตภัณฑ์หลัก (สินค้า/บริการ) ภายในโครงการ</i> </small></p>
																<textarea name="" id="productdetails_input" class="form-control" cols="3" rows="5">{!!$fulltbp->productdetail!!}</textarea>
																{{-- <input type="text" id="productdetails_input" class="form-control productdetailsclass" > --}}
															</div>
															{{-- <div id="fulltbp_productdetails_wrapper" style="border: dashed 1px #999999">
																@foreach ($fulltbpproductdetails as $fulltbpproductdetail)
																	<input type="text" name ="productdetails[]" value="{{$fulltbpproductdetail->line}}" class="form-control productdetailsclass" style="border: 0" >
																@endforeach
															</div>
															<div class="row">
																<div class="col-md-12">	
																	<div class="form-group">
																		<br>
																		<button type="button" id="btnaddproductdetails" data-id="{{$fulltbp->id}}" class="btn bg-teal float-right" >บันทึกจุดเด่นผลิตภัณฑ์หลัก</button>
																	</div>
																</div>
															</div> --}}

														</div>

													</div>
												</div>
											</div>
										</div>

										<div class="card mb-0 rounded-0 border-y-0">
											<div class="card-header">
												<h6 class="card-title">
													<a class="collapsed text-default" data-toggle="collapse" href="#accordion-item-group2"><div class="list-icons"><a class="list-icons-item mr-2 mb-2" data-action="collapse"></a></div>2.2 ข้อมูลเทคโนโลยี</a>
												</h6>
											</div>

											<div id="accordion-item-group2" class="collapse" data-parent="#accordion-group">
												<div class="card-body">
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label for="">การพัฒนาเทคโนโลยี</label> <span class="text-primary" id="projectechdevtextlength"></span>
																<p><small><i>เขียนอธิบายการพัฒนาเทคโนโลยี และนวัตกรรมในโครงการ (ประมาณ 1-3 หน้า)</i> </small></p>
																<textarea name="" id="projectechdev_input" class="form-control" cols="3" rows="7">{!!$fulltbp->techdev!!}</textarea>
																{{-- <input type="text" id="projectechdev_input" class="form-control projectechdevclass" > --}}
															</div>
															{{-- <div id="fulltbp_projectechdev_wrapper" style="border: dashed 1px #999999">
																@foreach ($fulltbpprojecttechdevs as $fulltbpprojecttechdev)
																	<input type="text" name ="projectechdev[]" value="{{$fulltbpprojecttechdev->line}}" class="form-control projectechdevclass" style="border: 0" >
																@endforeach
															</div>
															<div class="row">
																<div class="col-md-12">	
																	<div class="form-group">
																		<br>
																		<button type="button" id="btnaddprojectechdev" data-id="{{$fulltbp->id}}" class="btn bg-teal float-right" >บันทึกการพัฒนาเทคโนโลยี</button>
																	</div>
																</div>
															</div> --}}
														</div>
														<div class="col-md-12">
															<div class="form-group">	
																{{-- <a href="" class="btn btn-info btn-icon ml-2 btn-sm float-right"  data-toggle="modal" data-target="#modal_add_tectdevlevel"><i class="icon-add"></i></a> --}}
																<label for="">ระดับของเทคโนโลยีและความใหม่ของผลิตภัณฑ์ <a type="button" data-toggle="modal" data-target="#modal_add_tectdevlevel"><i class="icon-add text-info"></i></a></label>
																<p><small><i>ตารางเปรียบเทียบเทคโนโลยีที่มีอยู่ในปัจจุบัน(เทคโนโลยีที่ใช้ทั่วไปในตลาด) /เทคโนโลยีที่ใช้ในโครงการ</i> </small></p>
															</div>
															<div class="table-responsive">
																<table class="table table-striped table-bordered">
																	<thead>
																		<tr class="bg-info">
																			<th>รายการ</th>  
																			<th>เทคโนโลยีที่มีอยู่ในปัจจุบัน</th>
																			<th>เทคโนโลยีในโครงการ</th>
																			<th>เพิ่มเติม</th>    
																		</tr>
																	</thead>
																	<tbody id="fulltbp_projectechdevlevel_wrapper_tr">    
																		@foreach ($fulltbpprojecttechdevlevels as $fulltbpprojecttechdevlevel)
																			<tr >                                        
																				<td> {{$fulltbpprojecttechdevlevel->technology}} </td> 
																				<td> {{$fulltbpprojecttechdevlevel->presenttechnology}} </td> 
																				<td> {{$fulltbpprojecttechdevlevel->projecttechnology}} </td> 
																				<td> <a type="button" data-id="{{$fulltbpprojecttechdevlevel->id}}" class="btn btn-sm bg-warning deleteprojectechdevlevel">ลบ</a> </td> 
																			</tr>
																		@endforeach                            
																	</tbody>
																</table>
															</div>
															<br>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label for="">อุปสรรค ความเสี่ยง และโอกาสในการพัฒนาด้านเทคโนโลยี</label> <span class="text-primary" id="projectechdevproblemtextlength"></span>
																<p><small><i>เขียนอธิบายอุปสรรค ความเสี่ยง และโอกาสในการพัฒนาด้านเทคโนโลยี</i> </small></p>
																<textarea name="" id="projectechdevproblem_input" class="form-control" cols="3" rows="7">{!!$fulltbp->techdevproblem!!}</textarea>
																{{-- <input type="text" id="projectechdevproblem_input" class="form-control projectechdevproblemclass" > --}}
															</div>
															{{-- <div id="fulltbp_projectechdevproblem_wrapper" style="border: dashed 1px #999999">
																@foreach ($fulltbpprojecttechdevproblems as $fulltbpprojecttechdevproblem)
																	<input type="text" name ="projectechdevproblem[]" value="{{$fulltbpprojecttechdevproblem->line}}" class="form-control projectechdevproblemclass" style="border: 0" >
																@endforeach
															</div>
															<div class="row">
																<div class="col-md-12">	
																	<div class="form-group">
																		<br>
																		<button type="button" id="btnaddprojectechdevproblem" data-id="{{$fulltbp->id}}" class="btn bg-teal float-right" >บันทึกอุปสรรคความเสี่ยง</button>
																	</div>
																</div>
															</div>	 --}}
														</div>
														<legend><label for=""><strong>การจัดการด้านทรัพย์สินทางปัญญา</strong> </label></legend>
														<div class="col-md-12">
															<div class="form-group mb-3 mb-md-2">
																<label class="font-weight-semibold">สิทธิบัตรการประดิษฐ์/การออกแบบ/อนุสิทธิบัตร</label>
																<div class="row">
																	<div class="col-md-4">
																		<div class="form-check">
																			<label class="form-check-label">
																				<input type="checkbox" id="cer1" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer1)) checked @endif data-fouc >
																				ได้รับการจดสิทธิบัตรการประดิษฐ์
																			</label>
																			<div class="row" id="cer1qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer1) || Empty(@$fulltbpprojectcertify->cer1_qty) ) hidden @endif>
																				<div class="col-md-9">
																					<div class="form-group">
																						<input type="text" id="cer1qty" placeholder="จำนวน" class="form-control" value="{{$fulltbpprojectcertify->cer1_qty}}">
																					</div>
																				</div>
																			</div>
																		</div>
						
																		<div class="form-check">
																			<label class="form-check-label">
																				<input type="checkbox" id="cer2" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer2)) checked @endif data-fouc >
																				ยื่นจดสิทธิบัตรการประดิษฐ์
																			</label>
																			<div class="row" id="cer2qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer2) || Empty(@$fulltbpprojectcertify->cer2_qty) ) hidden @endif>
																				<div class="col-md-9">
																					<div class="form-group">
																						<input type="text" id="cer2qty" placeholder="จำนวน" class="form-control" value="{{$fulltbpprojectcertify->cer2_qty}}">
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
																			<div class="row" id="cer3qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer3) || Empty(@$fulltbpprojectcertify->cer3_qty) ) hidden @endif>
																				<div class="col-md-9">
																					<div class="form-group">
																						<input type="text" id="cer3qty" placeholder="จำนวน" class="form-control" value="{{$fulltbpprojectcertify->cer3_qty}}">
																					</div>
																				</div>
																			</div>
																		</div>
						
																		<div class="form-check">
																			<label class="form-check-label">
																				<input type="checkbox" id="cer4" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer4)) checked @endif data-fouc >
																				ยื่นจดสิทธิบัตรการออกแบบ
																			</label>
																			<div class="row" id="cer4qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer4) || Empty(@$fulltbpprojectcertify->cer4_qty) ) hidden @endif>
																				<div class="col-md-9">
																					<div class="form-group">
																						<input type="text" id="cer4qty" placeholder="จำนวน" class="form-control" value="{{$fulltbpprojectcertify->cer4_qty}}">
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
																			<div class="row" id="cer5qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer5) || Empty(@$fulltbpprojectcertify->cer5_qty) ) hidden @endif>
																				<div class="col-md-9">
																					<div class="form-group">
																						<input type="text" id="cer5qty" placeholder="จำนวน" class="form-control" value="{{$fulltbpprojectcertify->cer5_qty}}">
																					</div>
																				</div>
																			</div>
																		</div>
						
																		<div class="form-check">
																			<label class="form-check-label">
																				<input type="checkbox" id="cer6" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer6)) checked @endif data-fouc >
																				ยื่นจดอนุสิทธิบัตร
																			</label>
																			<div class="row" id="cer6qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer6) || Empty(@$fulltbpprojectcertify->cer6_qty) ) hidden @endif>
																				<div class="col-md-9">
																					<div class="form-group">
																						<input type="text" id="cer6qty" placeholder="จำนวน" class="form-control" value="{{$fulltbpprojectcertify->cer6_qty}}">
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														
														<div class="col-md-12">
															<br>
															{{-- <hr> --}}
															<div class="form-group mb-3 mb-md-2">
																<label class="font-weight-semibold"> ลิขสิทธิ์/เครื่องหมายการค้า</label>
																<div class="row">
																	<div class="col-md-4">
																		<div class="form-check">
																			<label class="form-check-label">
																				<input type="checkbox" id="cer7" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer7)) checked @endif data-fouc >
																				ลิขสิทธิ์
																			</label>
																			<div class="row" id="cer7qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer7) || Empty(@$fulltbpprojectcertify->cer7_qty) ) hidden @endif>
																				<div class="col-md-9">
																					<div class="form-group">
																						<input type="text" id="cer7qty" placeholder="จำนวน" class="form-control" value="{{$fulltbpprojectcertify->cer7_qty}}">
																					</div>
																				</div>
																			</div>
																		</div>
						
																		<div class="form-check">
																			<label class="form-check-label">
																				<input type="checkbox" id="cer8" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer8)) checked @endif data-fouc >
																				เครื่องหมายการค้า
																			</label>
																			<div class="row" id="cer8qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer8) || Empty(@$fulltbpprojectcertify->cer8_qty) ) hidden @endif>
																				<div class="col-md-9">
																					<div class="form-group">
																						<input type="text" id="cer8qty" placeholder="จำนวน" class="form-control" value="{{$fulltbpprojectcertify->cer8_qty}}">
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
						
																	<div class="col-md-4">
																		<div class="form-check">
																			<label class="form-check-label">
																				<input type="checkbox" id="cer9" class="form-check-input-styled-primary" @if (!Empty($fulltbpprojectcertify->cer9)) checked @endif data-fouc >
																				ความลับทางการค้า
																			</label>
																			<div class="row" id="cer9qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer9) || Empty(@$fulltbpprojectcertify->cer9_qty) ) hidden @endif>
																				<div class="col-md-9">
																					<div class="form-group">
																						<input type="text" id="cer9qty" placeholder="จำนวน" class="form-control" value="{{$fulltbpprojectcertify->cer9_qty}}">
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
																				อื่น ๆ เช่น สิ่งบ่งชี้ทางภูมิศาสตร์ (GI)ความหลากหลายทางพันธุ์พืช แบบผังภูมิของวงจรรวม
																			</label>
																			<div class="row" id="cer11qtydiv" style="margin-top: 5px"  @if (Empty(@$fulltbpprojectcertify->cer11) || Empty(@$fulltbpprojectcertify->cer11_qty) ) hidden @endif>
																				<div class="col-md-9">
																					<div class="form-group">
																						<input type="text" name="cer11qty" placeholder="จำนวน" class="form-control" value="{{$fulltbpprojectcertify->cer11_qty}}">
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															{{-- <div class="row"> --}}
																<div class="col-md-12">	
																	<div class="form-group">												
																		{{-- <button id="btnuploadcertify" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('certify').click();"><i class="icon-add"></i></button>													 --}}
																		<label for="">เอกสารแนบสิทธิบัตรการประดิษฐ์/การออกแบบ/อนุสิทธิบัตร <a type="button" id="btnuploadcertify" onclick="document.getElementById('certify').click();"><i class="icon-add text-info"></i></a></label>
																	</div>
																	<input type="file" style="display:none;" data-id="{{$fulltbpprojectcertify->id}}" id="certify" name="certify"/>
																</div>
															{{-- </div>																								 --}}
															{{-- <div class="row">	 --}}
																<div class="col-md-12" id="fulltbp_certify_wrapper" >	
																</div>
															{{-- </div> --}}
															{{-- <div class="row"> --}}
																<div class="col-md-12">	
																	<div class="table-responsive">
																		<table class="table table-striped table-bordered">
																			<thead>
																				<tr class="bg-info">
																					<th>เอกสารแนบสิทธิบัตรการประดิษฐ์/การออกแบบ/อนุสิทธิบัตร</th>                                                                                  
																					<th style="width:200px">ดาวน์โหลด</th>
																				</tr>
																			</thead>
																			<tbody id="fulltbp_certify_wrapper_tr">    
																				@foreach ($fulltbpprojectcertifyattachments as $fulltbpprojectcertifyattachment)
																					<tr >                                        
																						<td> {{$fulltbpprojectcertifyattachment->name}} </td>                                            
																						<td> 
																							<a href="{{asset($fulltbpprojectcertifyattachment->path)}}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
																							<a type="button" data-id="{{$fulltbpprojectcertifyattachment->id}}" data-name=""  class="btn btn-sm bg-danger deletefulltbpcertifyattachment">ลบ</a>                                       
																						</td>
																					</tr>
																				@endforeach                            
																			</tbody>
																		</table>
																	</div>
																</div>      
															{{-- </div> --}}

															<br>
															<legend><label for=""><strong>รางวัลทางด้านเทคโนโลยี/นวัตกรรม ที่ได้รับ</strong> </label></legend>
															
																<div class="col-md-12">
																	<div class="form-group">
																		<label for="">เอกสารแนบรางวัลด้านเทคโนโลยี/นวัตกรรมที่ได้รับ</label> <span class="text-primary" id="projectechdevproblemtextlength"></span>
																		<p><small><i>เอกสารแนบรางวัลด้านเทคโนโลยี/นวัตกรรมที่ได้รับ</i> </small></p>
																		<textarea name="" id="projectinnovation_input" class="form-control" cols="3" rows="7">{!!$fulltbp->innovation!!}</textarea>
																	</div>	
																	<div class="form-group">												
																		<label for="">เอกสารแนบรางวัลด้านเทคโนโลยี/นวัตกรรมที่ได้รับ <a href="#" id="btnuploadaward" data-toggle="modal" data-target="#modal_add_award"><i class="icon-add text-info"></i></a></label>
																	</div>
																	<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="award" name="award"/>
																</div>
																<div class="col-md-12" id="fulltbp_award_wrapper" >	
																</div>
																<div class="col-md-12">	
																	<div class="table-responsive">
																		<table class="table table-striped table-bordered">
																			<thead>
																				<tr class="bg-info">
																					<th>เอกสารรางวัลด้านเทคโนโลยี/นวัตกรรม</th>                                                                                  
																					<th style="width:200px">ดาวน์โหลด</th>
																				</tr>
																			</thead>
																			<tbody id="fulltbp_award_wrapper_tr">    
																				@foreach ($fulltbpprojectawardattachments as $fulltbpprojectawardattachment)
																					<tr>                                        
																						<td> {{$fulltbpprojectawardattachment->name}} </td>                                            
																						<td> 
																							<a href="{{asset($fulltbpprojectawardattachment->path)}}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
																							<a type="button" data-id="{{$fulltbpprojectawardattachment->id}}" data-name=""  class="btn btn-sm bg-danger deletefulltbpawardattachment">ลบ</a>                                       
																						</td>
																					</tr>
																				@endforeach                            
																			</tbody>
																		</table>
																	</div>
																</div>      
															{{-- </div> --}}

															<br>
															<legend><label for=""><strong>ใบรับรองมาตรฐานต่าง ๆ ที่ได้รับ</strong> </label></legend>

															<div class="row">
																<div class="col-md-12">	
																	<div class="form-group">
																		<label for="">ใบรับรองมาตรฐานต่างๆ ที่ได้รับ เช่น ISO, อย., มอก., GMP, HACCP, CMMI</label> <span class="text-primary" id="projectechdevproblemtextlength"></span>
																		<p><small><i>เพิ่มรายการใบรับรองมาตรฐานต่าง ๆ ที่ได้รับ เช่น ISO, อย., มอก., GMP, HACCP, CMMI ฯลฯ</i> </small></p>
																		<textarea name="" id="projectstandard_input" class="form-control" cols="3" rows="7">{!!$fulltbp->standard!!}</textarea>
																	</div>	
																	<div class="form-group">												
																		{{-- <button id="btnuploadstandard" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" data-toggle="modal" data-target="#modal_add_standard"><i class="icon-add"></i></button> --}}
																		<label for="">เอกสารใบรับรองมาตรฐานต่างๆ ที่ได้รับ เช่น ISO, อย., มอก., GMP, HACCP, CMMI  <a href="#" id="btnuploadstandard" data-toggle="modal" data-target="#modal_add_standard"><i class="icon-add text-info"></i></a></label>
																		{{-- <p><small><i>เพิ่มรายการใบรับรองมาตรฐานต่าง ๆ ที่ได้รับ เช่น ISO, อย., มอก., GMP, HACCP, CMMI ฯลฯ</i> </small></p> --}}
																	</div>
																	<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="standard" name="standard"/>
																</div>
															</div>																								
															<div class="row">	
																<div class="col-md-12" id="fulltbp_standard_wrapper" >	
																</div>
															</div>
															<div class="row">
																<div class="col-md-12">	
																	<div class="table-responsive">
																		<table class="table table-striped table-bordered">
																			<thead>
																				<tr class="bg-info">
																					<th>เอกสารใบรับรองมาตรฐานต่าง ๆ ที่ได้รับ</th>                                                                                  
																					<th style="width:200px">ดาวน์โหลด</th>
																				</tr>
																			</thead>
																			<tbody id="fulltbp_standard_wrapper_tr">    
																				@foreach ($fulltbpprojectstandards as $fulltbpprojectstandard)
																					<tr >                                        
																						<td> {{$fulltbpprojectstandard->name}} </td>                                            
																						<td> 
																							<a href="{{asset($fulltbpprojectstandard->path)}}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
																							<a type="button" data-id="{{$fulltbpprojectstandard->id}}" data-name=""  class="btn btn-sm bg-danger deletefulltbpstandardattachment">ลบ</a>                                       
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

										<div class="card rounded-top-0">
											<div class="card-header">
												<h6 class="card-title">
													<a class="collapsed text-default" data-toggle="collapse" href="#accordion-item-group3"><div class="list-icons"><a class="list-icons-item mr-2 mb-2" data-action="collapse"></a></div>2.3 แผนการดำเนินงาน (Gantt Chart)</a>
												</h6>
											</div>

											<div id="accordion-item-group3" class="collapse" data-parent="#accordion-group">
												<div class="card-body">
													<div class="row">

														<div class="form-group">	
															<a href="" class="btn btn-info btn-icon ml-2 btn-sm float-right"  data-toggle="modal" data-target="#modal_add_projectplan"><i class="icon-add"></i></a>
															<br>
														</div>
														
														<div class="table-responsive" style="width: 100%">
															<table class="table table-bordered" style="width: 99.8%">
																<thead>
																	<tr>
																		<tr>
																			<th rowspan="2">รายละเอียดการดำเนินงาน</th> 
																			<th colspan="12" class="text-center">เดือนที่</th> 
																			<th rowspan="2" class="text-center" style="width: 150px">เพิ่มเติม</th> 
																		</tr>
																		<tr >
																			<th style="width: 30px">1</th>
																			<th style="width: 30px">2</th>
																			<th style="width: 30px">3</th>
																			<th style="width: 30px">4</th>
																			<th style="width: 30px">5</th>
																			<th style="width: 30px">6</th>
																			<th style="width: 30px">7</th>
																			<th style="width: 30px">8</th>  
																			<th style="width: 30px">9</th>
																			<th style="width: 30px">10</th>
																			<th style="width: 30px">11</th>
																			<th style="width: 30px">12</th>
																		</tr>
																	</tr>
																</thead>
																<tbody id="fulltbp_projectplan_wrapper_tr">    
																	@foreach ($fulltbpprojectplans as $fulltbpprojectplan)
																		<tr >                                        
																			<td> {{$fulltbpprojectplan->name}} </td> 
																			@for ($i = 1; $i <= 12; $i++)
																				@php
																					$color = 'white';
																					$check = $fulltbpprojectplan->fulltbpprojectplantransaction->where('month',$i)->first();
																					if (!Empty($check)) {
																						$color = 'grey';
																					}
																				@endphp
																				<td style="background-color:{{$color}}"> </td> 
																			@endfor															
																			<td> 
																				<a type="button" data-id="{{$fulltbpprojectplan->id}}" class="btn btn-sm bg-info editprojectplan">แก้ไข</a>
																				<a type="button" data-id="{{$fulltbpprojectplan->id}}" class="btn btn-sm bg-warning deleteprojectplan">ลบ</a> 
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
									<!-- /accordion group -->
			

							</fieldset>

							<h6>3.ความเป็นไปได้ด้านการตลาดแผนสู่เชิงพาณิชย์</h6>
							<fieldset>
								<div id="accordion-group">
									<div class="card border-top-info rounded-top-1 mb-0 rounded-bottom-0">
										<div class="card-header">
											<h6 class="card-title">
												<a data-toggle="collapse" class="text-default" href="#accordion-item-group1"><div class="list-icons"><a class="list-icons-item mr-2 mb-2" data-action="collapse"></a></div>3.1 ข้อมูลด้านการตลาด</a>
											</h6>
										</div>

										<div id="accordion-item-group1" class="collapse" data-parent="#accordion-group">
											<div class="card-body">
												<div class="row">
													<div class="col-md-12">	
														<div class="form-group">
															<label for=""><u>Market Analysis</u> </label>
															<p><small><i>อธิบายความเป็นไปได้ทางการตลาดของผลิตภัณฑ์หรือบริการในโครงการ และ ระบุแผนงานในการนำผลลัพธ์ของโครงการออกสู่เชิงพาณิชย์ (ประมาณ 1-3 หน้า) โดยให้ข้อมูลในประเด็นต่างๆ ดังนี้ 
																<ul>
																	<li>การแก้ไขปัญหานี้จะตอบสนองความต้องการของตลาดได้อย่างไร (Market needs/Market requirements)</li>
																	<li>ระบุและให้รายละเอียดเกี่ยวกับตลาดภายในและนอกประเทศ (Market size)</li>
																	<li>ส่วนแบ่งของตลาดที่คาดว่าผลิตภัณฑ์จะครอบครอง (Market share)</li>
																	<li>ข้อได้เปรียบที่สำคัญของผลิตภัณฑ์ หรือ บริการโดยเปรียบเทียบกับผลิตภัณฑ์ หรือ บริการของคู่แข่ง (Competitive analysis/ Benchmarking matrix)</li>
																</ul>
																</i> </small></p>
															<textarea name="" id="analysis" class="form-control" cols="3" rows="10">{{@$fulltbp->fulltbpmarketanalysis->detail}}</textarea>
														</div>
													</div>

													<div class="col-md-12">	
														<div class="form-group">
															<label for=""><u>Business Model Canvas</u></label>
															<p><small><i>แผนที่ได้วางไว้เพื่อนำไปสู่เชิงพาณิชย์/ การประยุกต์ใช้และวิธีการที่จะบรรลุผลเหล่านั้น</i> </small></p>
															<textarea name="" id="modelcanvas" class="form-control" cols="3" rows="5">{{@$fulltbp->fulltbpmarketbusinessmodelcanvas->detail}}</textarea>
														</div>
														<div class="col-md-12">	
															<div class="input-group">													
																<label for="">เอกสารแนบ Business Model Canvas <a href="#" id="btnuploadbusinessmodelcanvas" onclick="document.getElementById('businessmodelcanvas').click();"><i class="icon-add text-info"></i></a></label>
															</div>
															<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="businessmodelcanvas" name="businessmodelcanvas"/>
														</div>
														<div class="col-md-12" id="fulltbp_businessmodelcanvas_wrapper" >	
														</div>
														<div class="col-md-12">	
															<div class="table-responsive">
																<table class="table table-striped table-bordered">
																	<thead>
																		<tr class="bg-info">
																			<th>เอกสาร Business Model Canvas</th>                                                                                  
																			<th style="width:200px">ดาวน์โหลด</th>
																		</tr>
																	</thead>
																	<tbody id="fulltbp_businessmodelcanvas_wrapper_tr">    
																		@foreach ($fullTbpmarketattachmentmodelcanvases as $fullTbpmarketattachmentmodelcanvas)
																			<tr >                                        
																				<td> {{$fullTbpmarketattachmentmodelcanvas->name}} </td>                                            
																				<td> 
																					<a href="{{asset($fullTbpmarketattachmentmodelcanvas->path)}}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
																					<a type="button" data-id="{{$fullTbpmarketattachmentmodelcanvas->id}}" data-name=""  class="btn btn-sm bg-danger deletefulltbpmodelcanvasattachment">ลบ</a>                                       
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
																<label for="" ><u>วิเคราะห์ศักยภาพทางการค้า</u></label>
																<p><small><i>SWOT Analysis, Five Forces Analysis</i> </small></p>
																<textarea name="" id="swot" class="form-control" cols="3" rows="5">{{@$fulltbp->fulltbpmarketswot->detail}}</textarea>
															</div>
															<div class="col-md-12">	
																<div class="input-group">													
																	{{-- <button id="btnuploadswot" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('swot').click();"><i class="icon-add"></i></button>													 --}}
																	<label for="">SWOT Analysis, Five Forces Analysis<a href="#" id="btnuploadswot" onclick="document.getElementById('swot').click();"><i class="icon-add text-info"></i></a></label>
																</div>
																<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="swot" name="swot"/>
															</div>
				
															<div class="col-md-12" id="fulltbp_swot_wrapper" >	
															</div>
		
															<div class="col-md-12">	
																<div class="table-responsive">
																	<table class="table table-striped table-bordered">
																		<thead>
																			<tr class="bg-info">
																				<th>เอกสาร SWOT Analysis, Five Forces Analysis</th>                                                                                  
																				<th style="width:200px">ดาวน์โหลด</th>
																			</tr>
																		</thead>
																		<tbody id="fulltbp_swot_wrapper_tr">    
																			@foreach ($fullTbpmarketattachmentswots as $fullTbpmarketattachmentswot)
																				<tr >                                        
																					<td> {{$fullTbpmarketattachmentswot->name}} </td>                                            
																					<td> 
																						<a href="{{asset($fullTbpmarketattachmentswot->path)}}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
																						<a type="button" data-id="{{$fullTbpmarketattachmentswot->id}}" data-name=""  class="btn btn-sm bg-danger deletefulltbpswotattachment">ลบ</a>                                       
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

									<div class="card mb-0 rounded-0 border-y-0">
										<div class="card-header">
											<h6 class="card-title">
												<a class="collapsed text-default" data-toggle="collapse" href="#accordion-item-group2"><div class="list-icons"><a class="list-icons-item mr-2 mb-2" data-action="collapse"></a></div>3.2 ข้อมูลยอดขายของบริษัท</a>
											</h6>
										</div>

										<div id="accordion-item-group2" class="collapse" data-parent="#accordion-group">
											<div class="card-body">
												<div class="row">
													<div class="col-md-12">	
														<div class="form-group">	
															<label for=""><u>ข้อมูลยอดขายของแต่ละผลิตภัณฑ์/บริการ (ยอดขาย 3 ปีย้อนหลัง)</u><a href="#" id="btnuploadaward" data-toggle="modal" data-target="#modal_add_sell"><i class="icon-add text-info"></i></a></label>
															<p><small><i>ข้อมูลยอดขายของแต่ละผลิตภัณฑ์/บริการ (ยอดขาย 3 ปีย้อนหลัง)</i> </small></p>
														</div>
														<div class="table-responsive">
															<table class="table table-striped table-bordered">
																<thead>
																	<tr class="bg-info">
																		<th>ยอดขายแยกตามประเภทผลิตภัณฑ์</th>  
																		<th>ยอดขายปีปัจจุบัน</th> 
																		<th>{{$fulltbp->past1}}</th>                                                                                    
																		<th>{{$fulltbp->past2}}</th>       
																		<th>{{$fulltbp->past3}}</th>  
																		<th>เพิ่มเติม</th>    
																	</tr>
																</thead>
																<tbody id="fulltbp_sell_wrapper_tr">    
																	@foreach ($fulltbpsells as $fulltbpsell)
																		<tr>                                        
																			<td> {{$fulltbpsell->name}}</td> 
																			<td> {{$fulltbpsell->present}} </td> 
																			<td> {{$fulltbpsell->past1}} </td> 
																			<td> {{$fulltbpsell->past2}} </td>                                            															
																			<td> {{$fulltbpsell->past3}} </td> 
																			<td> 
																				<a type="button" data-id="{{$fulltbpsell->id}}" class="btn btn-sm bg-info editsell">แก้ไข</a>
																				<a type="button" data-id="{{$fulltbpsell->id}}" class="btn btn-sm bg-warning deletesell">ลบ</a> 
																			</td> 
																		</tr>
																	@endforeach                            
																</tbody>
															</table>
														</div>
													</div>
													
													<div class="col-md-12 mt-4">
														{{-- <div class="form-group">	 --}}
															<label for=""><u>สถานะยอดขาย (สถานะยอดขาย 3 ปีย้อนหลัง)</u> </label>
															<small><i>สถานะยอดขาย (สถานะยอดขาย 3 ปีย้อนหลัง)</i> </small>
														{{-- </div> --}}
														<div class="table-responsive">
															<table class="table table-striped table-bordered">
																<thead>
																	<tr  class="bg-info">
																		<th>ระยะเวลา</th>  
																		<th>ยอดขายปีปัจจุบัน</th> 
																		<th>{{$fulltbp->past1}}</th>                                                                                    
																		<th>{{$fulltbp->past2}}</th>       
																		<th>{{$fulltbp->past3}}</th>  
																		<th>เพิ่มเติม</th>    
																	</tr>
																</thead>
																<tbody id="fulltbp_sellstatus_wrapper_tr">    
																	@foreach ($fulltbpsellstatuses as $fulltbpsellstatus)
																		<tr >                                        
																			<td> {{$fulltbpsellstatus->name}}</td> 
																			<td> {{$fulltbpsellstatus->present}} </td> 
																			<td> {{$fulltbpsellstatus->past1}} </td> 
																			<td> {{$fulltbpsellstatus->past2}} </td>                                            															
																			<td> {{$fulltbpsellstatus->past3}} </td> 
																			<td> 
																				<a type="button" data-id="{{$fulltbpsellstatus->id}}" class="btn btn-sm bg-info editsellstatus">แก้ไข</a> 
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

									<div class="card rounded-top-0">
										<div class="card-header">
											<h6 class="card-title">
												<a class="collapsed text-default" data-toggle="collapse" href="#accordion-item-group3"><div class="list-icons"><a class="list-icons-item mr-2 mb-2" data-action="collapse"></a></div>3.3 ข้อมูลคู่ค้าหลักทางธุรกิจ</a>
											</h6>
										</div>

										<div id="accordion-item-group3" class="collapse" data-parent="#accordion-group">
											<div class="card-body">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">	
															<label for=""><u>ลูกหนี้การค้า</u><a href="#" data-toggle="modal" data-target="#modal_add_debtpartner"><i class="icon-add text-info"></i></a></label>
															<p><small><i>ลูกหนี้การค้า</i> </small></p>
														</div>
														<div class="table-responsive">
															<table class="table table-striped table-bordered">
																<thead>
																	<tr class="bg-info">
																		<th>รายชื่อคู่ค้าหลักของธุรกิจ</th>  
																		<th>จำนวนผลิตภัณฑ์หรือโครงการ</th> 
																		<th>เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)</th>                                                                                    
																		<th>ยอดขายต่อปี (บาท)</th>       
																		<th>เปรียบเทียบกับยอดขาย (%)</th>  
																		<th>จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)</th> 
																		<th style="width:120px">เพิ่มเติม</th>    
																	</tr>
																</thead>
																<tbody id="fulltbp_debtpartner_wrapper_tr">    
																	@foreach ($fulltbpdebtpartners as $fulltbpdebtpartner)
																		<tr>
																			<td> {{$fulltbpdebtpartner->debtpartner}}</td> 
																			<td> {{$fulltbpdebtpartner->numproject}} </td> 
																			<td> {{$fulltbpdebtpartner->partnertaxid}} </td> 
																			<td> {{$fulltbpdebtpartner->totalyearsell}} </td>                                            															
																			<td> {{$fulltbpdebtpartner->percenttosale}} </td> 
																			<td> {{$fulltbpdebtpartner->businessyear}} </td> 
																			<td> 
																				<a type="button" data-id="{{$fulltbpdebtpartner->id}}" class="btn btn-sm bg-info editdebtpartner">แก้ไข</a>
																				<a type="button" data-id="{{$fulltbpdebtpartner->id}}" class="btn btn-sm bg-warning deletedebtpartner">ลบ</a> 
																			</td> 
																		</tr>
																	@endforeach              
																</tbody>
															</table>
														</div>
													</div>
													<div class="col-md-12 mt-4">
														<div class="form-group">	
															<label for=""><u>เจ้าหนี้การค้า</u><a href="#" data-toggle="modal" data-target="#modal_add_creditpartner"><i class="icon-add text-info"></i></a></label>
															<p><small><i>เจ้าหนี้การค้า</i> </small></p>
														</div>
														<div class="table-responsive">
															<table class="table table-striped table-bordered">
																<thead>
																	<tr class="bg-info">
																		<th>รายชื่อคู่ค้าหลักของธุรกิจ</th>  
																		<th>เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)</th>                                                                                    
																		<th>ยอดซื้อต่อปี (บาท)</th>       
																		<th>เปรียบเทียบกับยอดซื้อ (%)</th>  
																		<th>จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)</th> 
																		<th style="width:120px">เพิ่มเติม</th>    
																	</tr>
																</thead>
																<tbody id="fulltbp_creditpartner_wrapper_tr">    
																	@foreach ($fulltbpcreditpartners as $fulltbpcreditpartner)
																		<tr >
																			<td> {{$fulltbpdebtpartner->creditpartner}}</td> 
																			<td> {{$fulltbpdebtpartner->partnertaxid}} </td> 
																			<td> {{$fulltbpdebtpartner->totalyearpurchase}} </td>                                            															
																			<td> {{$fulltbpdebtpartner->percenttopurchase}} </td> 
																			<td> {{$fulltbpdebtpartner->businessyear}} </td> 
																			<td> 
																				<a type="button" data-id="{{$fulltbpcreditpartner->id}}" class="btn btn-sm bg-info editcreditpartner">แก้ไข</a>
																				<a type="button" data-id="{{$fulltbpcreditpartner->id}}" class="btn btn-sm bg-warning deletecreditpartner">ลบ</a> 
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
								<!-- /accordion group -->
		
							</fieldset>
							<h6>4.ข้อมูลทางด้านการเงิน</h6>
							<fieldset>	
								<div id="accordion-group">
									<div class="card border-top-info rounded-top-1 mb-0">
										<div class="card-header">
											<h6 class="card-title">
												<a data-toggle="collapse" class="text-default" href="#accordion-item-group1"><div class="list-icons"><a class="list-icons-item mr-2 mb-2" data-action="collapse"></a></div>4.1 เงินลงทุนที่จำเป็นและการจัดหาแหล่งเงินทุนทั้งหมดของโครงการ</a>
											</h6>
										</div>
										<div id="accordion-item-group1" class="collapse" data-parent="#accordion-group">
											<div class="card-body">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label for=""><u>เงินลงทุนในสินทรัพย์ถาวรของโครงการ</u></label>
															<p><small><i>ตารางแสดงรายละเอียดเงินลงทุนในสินทรัพย์ถาวรของโครงการ</i> </small></p>
														</div>
														<div class="table-responsive">
															<table class="table table-striped table-bordered">
																<thead>
																	<tr class="bg-info">
																		<th>รายการ</th>  
																		<th>จำนวนเงิน (บาท)</th>                                                                                    
																		<th>จำนวน (ชิ้น)</th>       
																		<th>ราคาต่อเครื่อง (บาท)</th>  
																		<th>ข้อมูลจำเพาะทางเทคนิค</th> 
																		<th style="width:120px">เพิ่มเติม</th>    
																	</tr>
																</thead>
																<tbody id="fulltbp_asset_wrapper_tr">    
																	@foreach ($fulltbpassets as $fulltbpasset)
																		<tr >
																			<td> {{$fulltbpasset->asset}}</td> 
																			<td> {{$fulltbpasset->cost}} </td> 
																			<td> {{$fulltbpasset->quantity}} </td>                                            															
																			<td> {{$fulltbpasset->price}} </td> 
																			<td> {{$fulltbpasset->specification}} </td> 
																			<td> 
																				<a type="button" data-id="{{$fulltbpasset->id}}" class="btn btn-sm bg-info editasset">แก้ไข</a>
																			</td> 
																		</tr>
																	@endforeach              
																</tbody>
															</table>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label for=""><u>เงินลงทุนสำหรับดำเนินการของโครงการ</u></label>
															<p><small><i>ตารางแสดงรายละเอียดเงินลงทุนสำหรับดำเนินการของโครงการ</i> </small></p>
														</div>
														<div class="table-responsive">
															<table class="table table-striped table-bordered">
																<thead>
																	<tr class="bg-info">
																		<th>รายการ</th>  
																		<th>จำนวนเงิน (บาท)</th>                                                                                    
																		<th style="width:120px">เพิ่มเติม</th>    
																	</tr>
																</thead>
																<tbody id="fulltbp_investment_wrapper_tr">    
																	@foreach ($fulltbpinvestments as $fulltbpinvestment)
																		<tr >
																			<td> {{$fulltbpinvestment->investment}}</td> 
																			<td> {{$fulltbpinvestment->cost}} </td> 
																			<td> 
																				<a type="button" data-id="{{$fulltbpinvestment->id}}" class="btn btn-sm bg-info editinvestment">แก้ไข</a>
																			</td> 
																		</tr>
																	@endforeach              
																</tbody>
															</table>
														</div>
													</div>
													<div class="col-md-12 mt-4">
														<div class="form-group">
															<label for=""><u>แหล่งเงินทุนของโครงการ</u></label>
															<p><small><i>ตารางแสดงรายละเอียดแหล่งเงินทุนของโครงการ</i> </small></p>
														</div>
														<div class="table-responsive">
															<table class="table table-striped table-bordered">
																<thead>
																	<tr>
																		<th>รายการ</th>  
																		<th>เงินทุนที่มีอยู่แล้ว</th>                                                                                    
																		<th>เงินทุนที่เสนอขออนุมัติ</th>   
																		<th>เงินทุนที่ได้รับการอนุมัติแล้ว</th>   
																		<th>แผนการหาเงินทุนเพิ่ม</th>  
																		<th style="width:120px">เพิ่มเติม</th>    
																	</tr>
																</thead>
																<tbody id="fulltbp_cost_wrapper_tr">    
																	@foreach ($fulltbpcosts as $fulltbpcost)
																		<tr >
																			<td> {{$fulltbpcost->costname}}</td> 
																			<td> {{$fulltbpcost->existing}} </td> 
																			<td> {{$fulltbpcost->need}} </td> 
																			<td> {{$fulltbpcost->approved}} </td> 
																			<td> {{$fulltbpcost->plan}} </td> 
																			<td> 
																				<a type="button" data-id="{{$fulltbpcost->id}}" class="btn btn-sm bg-info editcost">แก้ไข</a>
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

									<div class="card mb-0 rounded-0 border-y-0">
										<div class="card-header">
											<h6 class="card-title">
												<a class="collapsed text-default" data-toggle="collapse" href="#accordion-item-group2"><div class="list-icons"><a class="list-icons-item mr-2 mb-2" data-action="collapse"></a></div>4.2 ประมาณการผลตอบแทนจากการลงทุน</a>
											</h6>
										</div>

										<div id="accordion-item-group2" class="collapse" data-parent="#accordion-group">
											<div class="card-body">
												<div class="row">
													{{-- <div class="row">	 --}}
														<div class="col-md-12">
															<fieldset>	
																<div class="form-group">
																	<label>ประมาณการรายได้ที่จะเพิ่มขึ้น (บาท)</label>
																	<input type="text"  value="{{$fulltbpreturnofinvestment->income}}" id="income" placeholder="ประมาณการรายได้ที่จะเพิ่มขึ้น" class="form-control" >
																</div>
																<div class="form-group">
																	<label>ประมาณการกำไรสุทธิที่จะเพิ่มขึ้น (บาท)</label>
																	<input type="text" value="{{$fulltbpreturnofinvestment->profit}}" id="profit" placeholder="ประมาณการกำไรสุทธิที่จะเพิ่มขึ้น" class="form-control" >
																</div>
																<div class="form-group">
																	<label>ประมาณการต้นทุนที่จะลดลง (บาท)</label>
																	<input type="text" value="{{$fulltbpreturnofinvestment->reduce}}" id="reduce" placeholder="ประมาณการต้นทุนที่จะลดลง" class="form-control" >
																</div>
															</fieldset>
														{{-- </div> --}}
													</div>
													<div class="row">
														<div class="col-md-12">	
															<div class="form-group">
																<br>
																<button type="button" id="btnaddreturnofinvestment" data-id="{{$fulltbp->id}}" class="btn bg-teal float-right" >บันทึกผลตอบแทนจากการลงทุน</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="col-md-12">
									<div class="form-group">
										<label for="">ลายมือชื่ออิเล็กทรอนิกส์<span class="text-danger">*</span></label>
										<select name="signature" id="usersignature" value="{{$fulltbp->signature_status_id}}" id="" class="form-control form-control-select2">
											@foreach ($signaturestatuses as $signaturestatus)
												<option value="{{$signaturestatus->id}}" @if($fulltbp->signature_status_id == $signaturestatus->id) selected @endif >{{$signaturestatus->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group" id="signature_wrapper" @if($fulltbp->signature_status_id == 1) hidden @endif>
										<a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_signature">ลายมือชื่อ</a>
										<div class="col-md-12">
											<div id='sigdiv'>
												@if (!Empty(Auth::user()->signature))
												<br>
												<img src="{{asset(Auth::user()->signature)}}" style="width: 180px;height:45px" alt="">
												@endif
											</div>
										</div>
									</div>
								</div>
								<!-- /accordion group -->
		
							</fieldset>
							<h6>5.เสร็จสิ้น</h6>
							<fieldset>
								<div class="col-md-12">
									<div class="form-group">
										<div style="width:100%;height:600px;" class="col-md-12 center"  >
											{{-- <canvas id="the-canvas"></canvas> --}}
											<div style="width:100%;height:600px;" id="example1"></div>
										</div>
										<input type="file" style="display:none;" id="fulltbppdf"/>
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
<script type="module" src="{{asset('assets/dashboard/js/app/helper/fulltbphelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/forms/wizards/steps.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/forms/validation/validate.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/pdfjs/pdf.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/pdfobject/pdfobject.js')}}"></script>
<script>

	var route = {
		url: "{{ url('/') }}",
		token: $('meta[name="csrf-token"]').attr('content'),
		branchid: "{{Auth::user()->branch_id}}",
		submitstatus: "{{$minitbp->businessplan->business_plan_status_id}}",
		refixstatus: "{{$minitbp->refixstatus}}"
	};
	$(document).ready(function() {
		$(window).keydown(function(event){
			if((event.keyCode == 13)) {
				event.preventDefault();
				return false;
			}
		});
	});

</script>
@stop
