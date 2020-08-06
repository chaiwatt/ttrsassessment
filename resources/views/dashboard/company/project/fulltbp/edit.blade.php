@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
{{-- modal_add_employ --}}
<div id="modal_add_employ" class="modal fade" style="overflow:hidden;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่ม employ</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>คำนำหน้าชื่อ<span class="text-danger">*</span></label>
							<select id="employprefix" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-select2">
								@foreach ($prefixes as $prefix)
									<option value="{{$prefix->id}}" >{{$prefix->name}}</option> 
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>ชื่อ</label><span class="text-danger">*</span>
							<input type="text" id="employname" placeholder="ชื่อ" class="form-control">
						</div>

						<div class="form-group">
							<label>นามสกุล</label><span class="text-danger">*</span>
							<input type="text" id="employlastname" placeholder="นามสกุล" class="form-control">
						</div>
						<div class="form-group">
							<label>ตำแหน่ง<span class="text-danger">*</span></label>
							<select id="employposition" data-placeholder="ตำแหน่ง" class="form-control form-control-select2">
								@foreach ($employpositions as $employposition)
									<option value="{{$employposition->id}}" >{{$employposition->name}}</option> 
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>โทรศัพท์</label><span class="text-danger">*</span>
							<input type="text" id="employphone" placeholder="เบอร์โทรศัพท์" class="form-control">
						</div>
						<div class="form-group">
							<label>โทรศัพท์มือถือ</label><span class="text-danger">*</span>
							<input type="text" id="employworkphone" placeholder="โทรศัพท์มือถือ" class="form-control">
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
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่ม employ</h5>
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
										<label>ตำแหน่ง<span class="text-danger">*</span></label>
										<div id="employposition_wrapper"></div>
									</div>
									<div class="form-group">
										<label>โทรศัพท์</label><span class="text-danger">*</span>
										<input type="text" id="employphone_edit" placeholder="เบอร์โทรศัพท์" class="form-control">
									</div>
									<div class="form-group">
										<label>โทรศัพท์มือถือ</label><span class="text-danger">*</span>
										<input type="text" id="employworkphone_edit" placeholder="เบอร์โทรศัพท์" class="form-control">
									</div>
									<div class="form-group">
										<button id="btn_edit_employ" data-id="" class="btn bg-primary" ><i class="icon-checkmark3 font-size-base mr-1"></i> แก้ไขข้อมูล employ</button>
									</div>
									
								</div>

								<div class="tab-pane fade" id="left-icon-employeducation">
									<div class="form-group">	
										<a href="" class="btn btn-info  btn-icon ml-2 btn-sm float-right" data-toggle="modal" data-target="#modal_add_employeducation"><i class="icon-add"></i></a>
									</div>
									<div class="table-responsive">
										<table class="table table-striped">
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
										<table class="table table-striped">
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
								<div class="tab-pane fade" id="left-icon-employtraining">
									<div class="form-group">	
										<a href="" class="btn btn-info  btn-icon ml-2 btn-sm float-right" data-toggle="modal" data-target="#modal_add_employtraining"><i class="icon-add"></i></a>
									</div>

									<div class="table-responsive">
										<table class="table table-striped">
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
							<input type="text" id="employeducationyear" placeholder="เบอร์โทรศัพท์" class="form-control">
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
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่ม employ</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
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
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่ม employ</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
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
								<label>ยอดขายต่อปี(บาท)</label><span class="text-danger">*</span>
								<input type="number" id="debttotalyearsell" placeholder="ยอดขายต่อปี(บาท)" class="form-control">
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
									<label>ยอดขายต่อปี(บาท)</label><span class="text-danger">*</span>
									<input type="number" id="debttotalyearselledit" placeholder="ยอดขายต่อปี(บาท)" class="form-control">
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
								<label>ยอดซื้อต่อปี(บาท)</label><span class="text-danger">*</span>
								<input type="number" id="credittotalyearsell" placeholder="ยอดซื้อต่อปี(บาท)" class="form-control">
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
								<label>ยอดซื้อต่อปี(บาท)</label><span class="text-danger">*</span>
								<input type="number" id="credittotalyearselledit" placeholder="ยอดซื้อต่อปี(บาท)" class="form-control">
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
								<label>จำนวนเงิน(บาท)</label><span class="text-danger">*</span>
								<input type="number" id="assetcostedit" placeholder="จำนวนเงิน(บาท)" class="form-control">
							</div>
							<div class="form-group">
								<label>จำนวน(ชิ้น)</label><span class="text-danger">*</span>
								<input type="number" id="assetquantityedit" placeholder="จำนวน(ชิ้น)" class="form-control">
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
								<label>จำนวนเงิน(บาท)</label><span class="text-danger">*</span>
								<input type="number" id="investmentcostedit" placeholder="จำนวนเงิน(บาท)" class="form-control">
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
				<h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มประวัติการศึกษา</h5>
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
						<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="companydoc" name="companydoc"/>
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


    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Full TBP</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
			<div class="text-right">
				<button type="button" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
			</div>
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
				<!-- Colors -->
            	<div class="card">
                	<div class="card-body">
						<ul class="nav nav-tabs nav-tabs-highlight">
							<li class="nav-item"><a href="#left-icon-minitbp" class="nav-link active" data-toggle="tab"><i class="icon-stack3 mr-2"></i> ข้อมูลทั่วไป</a></li>
							<li class="nav-item"><a href="#left-icon-oganization" class="nav-link" data-toggle="tab"><i class="icon-archive mr-2"></i> ข้อมูลองค์กร</a></li>
							<li class="nav-item"><a href="#left-icon-project" class="nav-link" data-toggle="tab"><i class="icon-box mr-2"></i> โครงการ</a></li>
							<li class="nav-item"><a href="#left-icon-technology" class="nav-link" data-toggle="tab"><i class="icon-cog2 mr-2"></i> เทคโนโลยี</a></li>
							<li class="nav-item"><a href="#left-icon-marketanalysis" class="nav-link" data-toggle="tab"><i class="icon-stats-growth mr-2"></i> การตลาด</a></li>
							<li class="nav-item"><a href="#left-icon-sell" class="nav-link" data-toggle="tab"><i class="icon-clipboard3 mr-2"></i> ยอดซื้อ/ขาย</a></li>
							<li class="nav-item"><a href="#left-icon-financial" class="nav-link" data-toggle="tab"><i class="icon-cash3 mr-2"></i> การเงิน</a></li>
						</ul>
						{{-- <form method="POST" action="{{route('dashboard.company.project.fulltbp.editsave',['id'=>$fulltbp->id])}}" enctype="multipart/form-data">
							@csrf --}}
						<div class="tab-content">
							<div class="tab-pane fade show active" id="left-icon-minitbp">
								<ul class="nav nav-tabs">
									<li class="nav-item"><a href="#left-icon-companyinfo" class="nav-link active" data-toggle="tab"> ข้อมูลกิจการ</a></li>
									<li class="nav-item"><a href="#left-icon-companydoc" class="nav-link" data-toggle="tab"> เอกสารสำคัญ</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="left-icon-companyinfo" >	
										<div class="row">	
											<div class="col-md-12">
												<fieldset>	
													<div class="form-group">
														<label>ชื่อกิจการ</label>
														<input type="text"  value="{{$fulltbp->minitbp->businessplan->company->name}}"  placeholder="ชื่อนิติบุคคล" class="form-control" readonly>
													</div>
													 <div class="form-group">
														<label>การจดทะเบียน<span class="text-danger">*</span></label>
														<select name="businesstype" data-placeholder="การจดทะเบียน" class="form-control form-control-select2" disabled>
															<option value=""></option>
																@foreach ($businesstypes as $businesstype)
																	<option value="{{$businesstype->id}}" @if($fulltbp->minitbp->businessplan->company->business_type_id == $businesstype->id) selected @endif >{{$businesstype->name}}</option> 
																@endforeach
														</select>
													</div>
													<div class="form-group">
														<label>เลขทะเบียนนิติบุคคล</label>
														<input type="text" value="{{$fulltbp->minitbp->businessplan->company->vatno}}"  placeholder="เลขทะเบียนนิติบุคคล" class="form-control" readonly>
													</div>
													<div class="form-group">
														<label>ปีที่จดทะเบียน</label>
														<input type="number"  value="{{$fulltbp->minitbp->businessplan->company->registeredyear}}"  placeholder="ปีที่จดทะเบียน" class="form-control" readonly>
													</div>
													<div class="form-group">
														<label>ทุนที่จดทะเบียน</label>
														<input type="number" value="{{$fulltbp->minitbp->businessplan->company->registeredcapital}}"  placeholder="ทุนที่จดทะเบียน" class="form-control" readonly>
													</div>
													<div class="form-group">
														<label>ทุนจดทะเบียนที่เรียกชำระแล้ว</label>
														<input type="number"  value="{{$fulltbp->minitbp->businessplan->company->paidupcapital}}"  placeholder="ทุนจดทะเบียนที่เรียกชำระแล้ว" class="form-control" readonly>
													</div>
													<div class="form-group">
														<label>ทุนจดทะเบียนที่เรียกชำระแล้ว เมื่อวันที่</label>
														<input type="text" value="{{$fulltbp->minitbp->businessplan->company->paidupcapitaldateth}}"  placeholder="ทุนจดทะเบียนที่เรียกชำระแล้ว" class="form-control" readonly>
													</div>
												</fieldset>
											</div>
										</div>
									</div>
									<div class="tab-pane fade show active" id="left-icon-companydoc" >	
										<div class="row">
											<div class="col-md-12">	
												<div class="input-group">													
													<button id="btnuploadcompanydoc" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" data-toggle="modal" data-target="#modal_add_companydoc"><i class="icon-add"></i></button>
												</div>
												
											</div>
										</div>																								
										<div class="row">	
											<div class="col-md-12" id="fulltbp_companydoc_wrapper" >	
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">	
												<div class="table-responsive">
													<table class="table table-striped">
														<thead>
															<tr>
																<th>เอกสารแนบ</th>                                                                                  
																<th style="width:150px">ดาวน์โหลด</th>
															</tr>
														</thead>
														<tbody id="fulltbp_companydoc_wrapper_tr">    
															@foreach ($fulltbpcompanydocs as $fulltbpcompanydoc)
																<tr >                                        
																	<td> {{$fulltbpcompanydoc->name}} </td>                                            
																	<td> 
																		<a href="{{asset($fulltbpcompanydoc->path)}}" class=" badge bg-primary">ดาวน์โหลด</a>
																		<a type="button" data-id="{{$fulltbpcompanydoc->id}}" data-name=""  class="btn badge bg-danger deletefulltbpcompanydocattachment">ลบ</a>                                       
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
							<div class="tab-pane fade" id="left-icon-oganization">
								<div class="row">	
									<div class="col-md-12"  >	
										<ul class="nav nav-tabs">
											<li class="nav-item"><a href="#vertical-left-companyprofile" class="nav-link active" data-toggle="tab"> ประวัติของบริษัท</a></li>
											<li class="nav-item"><a href="#vertical-left-quantityemploy" class="nav-link" data-toggle="tab"> จำนวนบุคลากร</a></li>
											<li class="nav-item"><a href="#vertical-left-employhistory" class="nav-link" data-toggle="tab"> ข้อมูลบุคลากรที่สำคัญ</a></li>
											<li class="nav-item"><a href="#vertical-left-stockholder" class="nav-link" data-toggle="tab"> บัญชีรายชื่อผู้ถือหุ้น</a></li>
										</ul>
		
										<div class="tab-content">
											<div class="tab-pane fade show active" id="vertical-left-companyprofile" >	
												<div class="form-group">
													<div class="form-group">
														<label for="">ข้อความ </label> <span class="text-primary" id="companyprofiletextlength"></span>
														<input type="text" id="companyprofile_input" class="form-control companyprofileclass" >
													</div>
													<div id="fulltbp_companyprofile_wrapper" style="border: dashed 1px #999999">
														@foreach ($fulltbpcompanyprofiledetails as $fulltbpcompanyprofiledetail)
															<input type="text" name ="companyprofile[]" value="{{$fulltbpcompanyprofiledetail->line}}" class="form-control companyprofileclass" style="border: 0" >
														@endforeach
													</div>
												</div>
												<hr>	
												<div class="row">
													<div class="col-md-12">	
														<div class="input-group">													
															<button id="btnuploadattachment" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('attachment').click();"><i class="icon-add"></i></button>													
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
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th>เอกสารแนบ</th>                                                                                  
																		<th style="width:150px">ดาวน์โหลด</th>
																	</tr>
																</thead>
																<tbody id="fulltbp_companyprofile_attachment_wrapper_tr">    
																	@foreach ($fulltbpcompanyprofileattachments as $fulltbpcompanyprofileattachment)
																		<tr >                                        
																			<td> {{$fulltbpcompanyprofileattachment->name}} </td>                                            
																			<td> 
																				<a href="{{asset($fulltbpcompanyprofileattachment->path)}}" class=" badge bg-primary">ดาวน์โหลด</a>
																				<a type="button" data-id="{{$fulltbpcompanyprofileattachment->id}}" data-name=""  class="btn badge bg-danger deletefulltbpcompanyprofileattachment">ลบ</a>                                       
																			</td>
																		</tr>
																	@endforeach                            
																</tbody>
															</table>
														</div>
													</div>      
												</div>
												<div class="row">
													<div class="col-md-12">	
														<div class="form-group">
															<br>
															<button type="button" id="btnaddcompanyprofile" data-id="{{$fulltbp->id}}" class="btn bg-teal float-right" >บันทึกประวัติบริษัท</button>
														</div>
													</div>
												</div>
												
											</div>
											<div class="tab-pane fade" id="vertical-left-quantityemploy">
												<div class="row">
													<div class="col-md-12">	
														<div class="form-group">
															<label for="">ฝ่ายบริหาร</label>
															<input type="number" name ="department1_qty"  id ="department1_qty" value="{{$fulltbpemployee->department1_qty}}" class="form-control" >
														</div>
														<div class="form-group">
															<label for="">ฝ่ายวิจัยและพัฒนา</label>
															<input type="number" name ="department2_qty" id ="department2_qty" value="{{$fulltbpemployee->department2_qty}}" class="form-control" >
														</div>
														<div class="form-group">
															<label for="">ฝ่ายผลิต/วิศวกรรม</label>
															<input type="number" name ="department3_qty" id ="department3_qty" value="{{$fulltbpemployee->department3_qty}}" class="form-control" >
														</div>
														<div class="form-group">
															<label for="">ฝ่ายการตลาด</label>
															<input type="number" name ="department4_qty" id ="department4_qty" value="{{$fulltbpemployee->department4_qty}}" class="form-control" >
														</div>
														<div class="form-group">
															<label for="">พนักงานทั่วไป </label>
															<input type="number" name ="department5_qty" id ="department5_qty" value="{{$fulltbpemployee->department5_qty}}" class="form-control" >
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">	
														<div class="form-group">
															<br>
															<button type="button" id="btneditquantityemploy" data-id="{{$fulltbp->id}}" class="btn bg-teal float-right" >บันทึกจำนวนบุคลากร</button>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="vertical-left-employhistory">
												<div class="form-group">	
													<a href="" class="btn btn-info  btn-icon ml-2 btn-sm float-right" id="btnaddemploy" data-toggle="modal" data-target="#modal_add_employ"><i class="icon-add"></i></a>
												</div>
												<div class="table-responsive">
													<table class="table table-striped">
														<thead>
															<tr>
																<th>ชื่อ-สกุล</th>  
																<th>ตำแหน่ง</th>                                                                                    
																<th>โทรศัพท์</th>       
																<th>โทรศัพท์มือถือ</th>  
																<th>เพิ่มเติม</th>    
															</tr>
														</thead>
														<tbody id="fulltbp_companyemploy_wrapper_tr">    
															@foreach ($companyemploys as $companyemploy)
																<tr >                                        
																	<td> {{$companyemploy->name}} {{$companyemploy->lastname}}</td> 
																	<td> {{$companyemploy->employposition->name}} </td> 
																	<td> {{$companyemploy->phone}} </td>                                            
																	<td> {{$companyemploy->workphone}} </td> 
																	<td> 
																		<a type="button" data-id="{{$companyemploy->id}}" class="btn badge bg-info editEmployinfo">แก้ไข</a>
																		<a type="button" data-id="{{$companyemploy->id}}" class="btn badge bg-warning deletecompanyemploy">ลบ</a> 
																	</td> 
																</tr>
															@endforeach                            
														</tbody>
													</table>
												</div>
												
											</div>
										
											<div class="tab-pane fade" id="vertical-left-stockholder">
												<div class="form-group">	
													<button type="button" class="btn btn-info  btn-icon ml-2 btn-sm float-right" data-id="{{$company->id}}" id="btnstckholder" ><i class="icon-add"></i></button>
												</div>
												<div class="table-responsive">
													<table class="table table-striped">
														<thead>
															<tr>
																<th>ชื่อ-สกุล</th>  
																<th>ความสัมพันธ์กับ CEO</th>
																<th>เพิ่มเติม</th>    
															</tr>
														</thead>
														<tbody id="fulltbp_companystockholder_wrapper_tr">    
															@foreach ($companystockholders as $companystockholder)
																<tr >                                        
																	<td> {{$companystockholder->companyemploy->name}} {{$companystockholder->companyemploy->lastname}}</td> 
																	<td> {{$companystockholder->relationwithceo}} </td> 
																	<td> <a type="button" data-id="{{$companystockholder->id}}" class="btn badge bg-warning deletestockholder">ลบ</a> </td> 
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
							<div class="tab-pane fade" id="left-icon-project">
								<ul class="nav nav-tabs">
									<li class="nav-item"><a href="#responsibleperson-tab" class="nav-link active" data-toggle="tab">ผู้รับผิดชอบโครงการ</a></li>
									<li class="nav-item"><a href="#projectabtract-tab" class="nav-link" data-toggle="tab">รายละเอียดโครงการ</a></li>
									<li class="nav-item"><a href="#mainproduct-tab" class="nav-link" data-toggle="tab">ผลิตภัณฑ์หลัก</a></li>
									<li class="nav-item"><a href="#productdetails-tab" class="nav-link" data-toggle="tab">จุดเด่นผลิตภัณฑ์หลัก</a></li>
									<li class="nav-item"><a href="#projectplan-tab" class="nav-link" data-toggle="tab">แผนการดำเนินงาน</a></li>
								</ul>

								<div class="tab-content">
									<div class="tab-pane fade show active" id="responsibleperson-tab">
										<div class="form-group">
											<label for="">คำนำหน้าชื่อ<span class="text-danger">*</span></label>
											<select name="contactprefix" id="" class="form-control form-control-select2" disabled>
												@foreach ($contactprefixes as $contactprefix)
													<option value="{{$contactprefix->id}}" @if($minitbp->contactprefix == $contactprefix->id) selected @endif >{{$contactprefix->name}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label for="">ชื่อ<span class="text-danger">*</span></label>
											<input type="text" name ="contactname" value="{{$minitbp->contactname}}" class="form-control" disabled>
										</div>
										<div class="form-group">
											<label for="">นามสกุล<span class="text-danger">*</span></label>
											<input type="text" name ="contactlastname" value="{{$minitbp->contactlastname}}" class="form-control" disabled>
										</div>
										<div class="form-group">
											<label for="">ตำแหน่ง<span class="text-danger">*</span></label>
											<select name="contactposition" value="{{$minitbp->contactposition}}" id="" class="form-control form-control-select2" disabled>
												@foreach ($contactpositions as $contactposition)
													<option value="{{$contactposition->id}}" @if($minitbp->contactposition_id == $contactposition->id) selected @endif >{{$contactposition->name}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label for="">เบอร์โทร<span class="text-danger">*</span></label>
											<input type="text" name ="contactphone" value="{{Auth::user()->phone}}" class="form-control" disabled>
										</div>
										<div class="form-group">
											<label for="">อีเมล<span class="text-danger">*</span></label>
											<input type="text" name ="contactemail" value="{{Auth::user()->email}}" class="form-control" disabled>
										</div>
									</div>
									<div class="tab-pane fade" id="projectabtract-tab">
										<div class="form-group">
											<label for="">ชื่อภาษาไทย<span class="text-danger">*</span></label>
											<input type="text"  value="{{$minitbp->project}}" class="form-control" disabled>
										</div>
										<div class="form-group">
											<label for="">ชื่อภาษาอังกฤษ<span class="text-danger">*</span></label>
											<input type="text" value="{{$minitbp->projecteng}}" class="form-control" disabled>
										</div>
										<div class="form-group">
											<div class="form-group">
												<label for="">บทคัดย่อ </label> <span class="text-primary" id="projectabtracttextlength"></span>
												<p><small><i>ควรประกอบด้วย 3 ย่อหน้า (1) ปัญหาหรือความต้องการของอุตสาหกรรมที่จะแก้ไข (Pain Point) (2) การแก้ปัญหาหรือ
													ตอบโจทย์ความต้องการของอุตสาหกรรมในโครงการ และ (3) ผลที่จะได้จากโครงการ รวมถึงผลกระทบเชิงเศรษฐกิจและ
													สังคม</i> </small></p>
												
												<input type="text" id="projectabtract_input" class="form-control projectabtractclass" >
											</div>
											<div id="fulltbp_projectabtract_wrapper" style="border: dashed 1px #999999">
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
											</div>
										</div>
									</div>

									<div class="tab-pane fade" id="mainproduct-tab">
										<div class="form-group">
											<div class="form-group">
												<label for="">ผลิตภัณฑ์หลัก(สินค้าและบริการ)ของโครงการ </label> <span class="text-primary" id="mainproducttextlength"></span>
												<p><small><i>อธิบายลักษณะของผลิตภัณฑ์หลัก (สินค้า/บริการ) ภายในโครงการ</i> </small></p>
												<input type="text" id="mainproduct_input" class="form-control mainproductclass" >
											</div>
											<div id="fulltbp_mainproduct_wrapper" style="border: dashed 1px #999999">
												@foreach ($fulltbpMainproductdetails as $fulltbpMainproductdetail)
													<input type="text" name ="mainproduct[]" value="{{$fulltbpMainproductdetail->line}}" class="form-control mainproductclass" style="border: 0" >
												@endforeach
											</div>
											<div class="row">
												<div class="col-md-12">	
													<div class="form-group">
														<br>
														<button type="button" id="btnaddmainproduct" data-id="{{$fulltbp->id}}" class="btn bg-teal float-right" >บันทึกผลิตภัณฑ์หลัก</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="productdetails-tab">
										<div class="form-group">
											<div class="form-group">
												<label for="">จุดเด่นผลิตภัณฑ์หลัก(สินค้าและบริการ)ของโครงการ </label> <span class="text-primary" id="productdetailstextlength"></span>
												<p><small><i>อธิบายจุดเด่นหรือความแตกต่างของผลิตภัณฑ์หลัก (สินค้า/บริการ) ภายในโครงการ</i> </small></p>
												<input type="text" id="productdetails_input" class="form-control productdetailsclass" >
											</div>
											<div id="fulltbp_productdetails_wrapper" style="border: dashed 1px #999999">
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
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="projectplan-tab">
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
																<a type="button" data-id="{{$fulltbpprojectplan->id}}" class="btn badge bg-info editprojectplan">แก้ไข</a>
																<a type="button" data-id="{{$fulltbpprojectplan->id}}" class="btn badge bg-warning deleteprojectplan">ลบ</a> 
															</td> 
														</tr>
													@endforeach                            
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="left-icon-technology">
								<ul class="nav nav-tabs">
									<li class="nav-item"><a href="#projectechdev-tab" class="nav-link active" data-toggle="tab">การพัฒนาเทคโนโลยี</a></li>
									<li class="nav-item"><a href="#projectechdevlevel-tab" class="nav-link " data-toggle="tab">ระดับเทคโนโลยี</a></li>
									<li class="nav-item"><a href="#projectechdevproblem-tab" class="nav-link " data-toggle="tab">อุปสรรค ความเสี่ยง</a></li>
									<li class="nav-item"><a href="#projectcertify-tab" class="nav-link " data-toggle="tab">สิทธิบัตรที่ได้รับ</a></li>
									<li class="nav-item"><a href="#projectaward-tab" class="nav-link" data-toggle="tab">รางวัลเทคโนโลยี</a></li>
									<li class="nav-item"><a href="#projectcertificate-tab" class="nav-link" data-toggle="tab">ใบรับรองมาตรฐาน</a></li>
								</ul>

								<div class="tab-content">
									<div class="tab-pane fade  show active" id="projectechdev-tab">
										<div class="form-group">
											<div class="form-group">
												<label for="">การพัฒนาเทคโนโลยี</label> <span class="text-primary" id="projectechdevtextlength"></span>
												<p><small><i>เขียนอธิบายการพัฒนาเทคโนโลยี และนวัตกรรมในโครงการ (ประมาณ 1-3 หน้า)</i> </small></p>
												<input type="text" id="projectechdev_input" class="form-control projectechdevclass" >
											</div>
											<div id="fulltbp_projectechdev_wrapper" style="border: dashed 1px #999999">
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
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="projectechdevlevel-tab">
										<div class="form-group">	
											<a href="" class="btn btn-info btn-icon ml-2 btn-sm float-right"  data-toggle="modal" data-target="#modal_add_tectdevlevel"><i class="icon-add"></i></a>
										</div>
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
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
															<td> <a type="button" data-id="{{$fulltbpprojecttechdevlevel->id}}" class="btn badge bg-warning deleteprojectechdevlevel">ลบ</a> </td> 
														</tr>
													@endforeach                            
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane fade" id="projectechdevproblem-tab">
										<div class="form-group">
											<div class="form-group">
												<label for="">อุปสรรค ความเสี่ยง และโอกาสในการพัฒนาด้านเทคโนโลยี</label> <span class="text-primary" id="projectechdevproblemtextlength"></span>
												<input type="text" id="projectechdevproblem_input" class="form-control projectechdevproblemclass" >
											</div>
											<div id="fulltbp_projectechdevproblem_wrapper" style="border: dashed 1px #999999">
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
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="projectcertify-tab">
										<div class="row">
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
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-12">	
												<div class="input-group">													
													<button id="btnuploadcertify" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('certify').click();"><i class="icon-add"></i></button>													
												</div>
												<input type="file" style="display:none;" data-id="{{$fulltbpprojectcertify->id}}" id="certify" name="certify"/>
											</div>
										</div>																								
										<div class="row">	
											<div class="col-md-12" id="fulltbp_certify_wrapper" >	
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">	
												<div class="table-responsive">
													<table class="table table-striped">
														<thead>
															<tr>
																<th>เอกสารแนบ</th>                                                                                  
																<th style="width:150px">ดาวน์โหลด</th>
															</tr>
														</thead>
														<tbody id="fulltbp_certify_wrapper_tr">    
															@foreach ($fulltbpprojectcertifyattachments as $fulltbpprojectcertifyattachment)
																<tr >                                        
																	<td> {{$fulltbpprojectcertifyattachment->name}} </td>                                            
																	<td> 
																		<a href="{{asset($fulltbpprojectcertifyattachment->path)}}" class=" badge bg-primary">ดาวน์โหลด</a>
																		<a type="button" data-id="{{$fulltbpprojectcertifyattachment->id}}" data-name=""  class="btn badge bg-danger deletefulltbpcertifyattachment">ลบ</a>                                       
																	</td>
																</tr>
															@endforeach                            
														</tbody>
													</table>
												</div>
											</div>      
										</div>
										<div class="row">
											<div class="col-md-12">	
												<div class="form-group">
													<br>
													<button type="button" id="btnaddprojectcertify" data-id="{{$fulltbpprojectcertify->id}}" class="btn bg-teal float-right" >บันทึกข้อมูลสิทธิบัตร</button>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="projectaward-tab">
										<div class="row">
											<div class="col-md-12">	
												<div class="input-group">													
													<button id="btnuploadaward" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" data-toggle="modal" data-target="#modal_add_award"><i class="icon-add"></i></button>
												</div>
												<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="award" name="award"/>
											</div>
										</div>																								
										<div class="row">	
											<div class="col-md-12" id="fulltbp_award_wrapper" >	
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">	
												<div class="table-responsive">
													<table class="table table-striped">
														<thead>
															<tr>
																<th>เอกสารแนบ</th>                                                                                  
																<th style="width:150px">ดาวน์โหลด</th>
															</tr>
														</thead>
														<tbody id="fulltbp_award_wrapper_tr">    
															@foreach ($fulltbpprojectawardattachments as $fulltbpprojectawardattachment)
																<tr >                                        
																	<td> {{$fulltbpprojectawardattachment->name}} </td>                                            
																	<td> 
																		<a href="{{asset($fulltbpprojectawardattachment->path)}}" class=" badge bg-primary">ดาวน์โหลด</a>
																		<a type="button" data-id="{{$fulltbpprojectawardattachment->id}}" data-name=""  class="btn badge bg-danger deletefulltbpawardattachment">ลบ</a>                                       
																	</td>
																</tr>
															@endforeach                            
														</tbody>
													</table>
												</div>
											</div>      
										</div>
									</div>
									<div class="tab-pane fade" id="projectcertificate-tab">
										<div class="row">
											<div class="col-md-12">	
												<div class="input-group">													
													<button id="btnuploadstandard" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" data-toggle="modal" data-target="#modal_add_standard"><i class="icon-add"></i></button>
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
													<table class="table table-striped">
														<thead>
															<tr>
																<th>เอกสารแนบ</th>                                                                                  
																<th style="width:150px">ดาวน์โหลด</th>
															</tr>
														</thead>
														<tbody id="fulltbp_standard_wrapper_tr">    
															@foreach ($fulltbpprojectstandards as $fulltbpprojectstandard)
																<tr >                                        
																	<td> {{$fulltbpprojectstandard->name}} </td>                                            
																	<td> 
																		<a href="{{asset($fulltbpprojectstandard->path)}}" class=" badge bg-primary">ดาวน์โหลด</a>
																		<a type="button" data-id="{{$fulltbpprojectstandard->id}}" data-name=""  class="btn badge bg-danger deletefulltbpstandardattachment">ลบ</a>                                       
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
							<div class="tab-pane fade" id="left-icon-marketanalysis">
								<ul class="nav nav-tabs">
									<li class="nav-item"><a href="#marketneed-tab" class="nav-link active" data-toggle="tab">Market need</a></li>
									<li class="nav-item"><a href="#marketsize-tab" class="nav-link " data-toggle="tab">Market size</a></li>
									<li class="nav-item"><a href="#marketshare-tab" class="nav-link " data-toggle="tab">Market share</a></li>
									<li class="nav-item"><a href="#competitive-tab" class="nav-link " data-toggle="tab">Competitive</a></li>
									<li class="nav-item"><a href="#businessmodelcanvas-tab" class="nav-link" data-toggle="tab">Business model canvas</a></li>
									<li class="nav-item"><a href="#swot-tab" class="nav-link" data-toggle="tab">SWOT</a></li>
									<li class="nav-item"><a href="#financialplan-tab" class="nav-link" data-toggle="tab">Finalcial plan</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="marketneed-tab">
										<div class="form-group">
											<div class="form-group">
												<label for="">การแก้ไขปัญหานี้จะตอบสนองความต้องการของตลาดได้อย่างไร (Market needs/ Market requirements) </label> <span class="text-primary" id="marketneedtextlength"></span>
												<input type="text" id="marketneed_input" class="form-control marketneedclass" >
											</div>
											<div id="fulltbp_marketneed_wrapper" style="border: dashed 1px #999999">
												@foreach ($fulltbpmarketneeds as $fulltbpmarketneed)
													<input type="text" name ="marketneed[]" value="{{$fulltbpmarketneed->line}}" class="form-control marketneedclass" style="border: 0" >
												@endforeach
											</div>
											<div class="row">
												<div class="col-md-12">	
													<div class="form-group">
														<br>
														<button type="button" id="btnaddmarketneed" data-id="{{$fulltbp->id}}" class="btn bg-teal float-right" >บันทึก Market need</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="marketsize-tab">
										<div class="form-group">
											<div class="form-group">
												<label for="">ระบุและให้รายละเอียดเกี่ยวกับตลาดภายในและนอกประเทศ (Market size)</label> <span class="text-primary" id="marketsizetextlength"></span>
												<input type="text" id="marketsize_input" class="form-control marketsizeclass" >
											</div>
											<div id="fulltbp_marketsize_wrapper" style="border: dashed 1px #999999">
												@foreach ($fulltbpmarketsizes as $fulltbpmarketsize)
													<input type="text" name ="marketsize[]" value="{{$fulltbpmarketsize->line}}" class="form-control marketsizeclass" style="border: 0" >
												@endforeach
											</div>
											<div class="row">
												<div class="col-md-12">	
													<div class="form-group">
														<br>
														<button type="button" id="btnaddmarketsize" data-id="{{$fulltbp->id}}" class="btn bg-teal float-right" >บันทึก Market size</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="marketshare-tab">
										<div class="form-group">
											<div class="form-group">
												<label for="">ส่วนแบ่งของตลาดที่คาดว่าผลิตภัณฑ์จะครอบครอง (Market share)</label> <span class="text-primary" id="marketsharetextlength"></span>
												<input type="text" id="marketshare_input" class="form-control marketshareclass" >
											</div>
											<div id="fulltbp_marketshare_wrapper" style="border: dashed 1px #999999">
												@foreach ($fulltbpmarketshares as $fulltbpmarketshare)
													<input type="text" name ="marketshare[]" value="{{$fulltbpmarketshare->line}}" class="form-control marketshareclass" style="border: 0" >
												@endforeach
											</div>
											<div class="row">
												<div class="col-md-12">	
													<div class="form-group">
														<br>
														<button type="button" id="btnaddmarketshare" data-id="{{$fulltbp->id}}" class="btn bg-teal float-right" >บันทึก Market share</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="competitive-tab">
										<div class="form-group">
											<div class="form-group">
												<label for="">ข้อได้เปรียบที่สำคัญของผลิตภัณฑ์ หรือ บริการ โดยเปรียบเทียบกับผลิตภัณฑ์ หรือ บริการของคู่แข่ง (Competitive analysis/ Benchmarking matrix)</label> <span class="text-primary" id="marketcompetitivetextlength"></span>
												<input type="text" id="marketcompetitive_input" class="form-control marketcompetitiveclass" >
											</div>
											<div id="fulltbp_marketcompetitive_wrapper" style="border: dashed 1px #999999">
												@foreach ($fulltbpmarketcompetitives as $fulltbpmarketcompetitive)
													<input type="text" name ="marketcompetitive[]" value="{{$fulltbpmarketcompetitive->line}}" class="form-control marketcompetitiveclass" style="border: 0" >
												@endforeach
											</div>
											<div class="row">
												<div class="col-md-12">	
													<div class="form-group">
														<br>
														<button type="button" id="btnaddmarketcompetitive" data-id="{{$fulltbp->id}}" class="btn bg-teal float-right" >บันทึก Market competitive</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="businessmodelcanvas-tab">
										<div class="row">
											<div class="col-md-12">	
												<div class="input-group">													
													<button id="btnuploadbusinessmodelcanvas" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('businessmodelcanvas').click();"><i class="icon-add"></i></button>													
												</div>
												<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="businessmodelcanvas" name="businessmodelcanvas"/>
											</div>
										</div>																								
										<div class="row">	
											<div class="col-md-12" id="fulltbp_businessmodelcanvas_wrapper" >	
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">	
												<div class="table-responsive">
													<table class="table table-striped">
														<thead>
															<tr>
																<th>เอกสารแนบ</th>                                                                                  
																<th style="width:150px">ดาวน์โหลด</th>
															</tr>
														</thead>
														<tbody id="fulltbp_businessmodelcanvas_wrapper_tr">    
															@foreach ($fullTbpmarketattachmentmodelcanvases as $fullTbpmarketattachmentmodelcanvas)
																<tr >                                        
																	<td> {{$fullTbpmarketattachmentmodelcanvas->name}} </td>                                            
																	<td> 
																		<a href="{{asset($fullTbpmarketattachmentmodelcanvas->path)}}" class=" badge bg-primary">ดาวน์โหลด</a>
																		<a type="button" data-id="{{$fullTbpmarketattachmentmodelcanvas->id}}" data-name=""  class="btn badge bg-danger deletefulltbpmodelcanvasattachment">ลบ</a>                                       
																	</td>
																</tr>
															@endforeach                            
														</tbody>
													</table>
												</div>
											</div>      
										</div>
									</div>
									<div class="tab-pane fade" id="swot-tab">
										<div class="row">
											<div class="col-md-12">	
												<div class="input-group">													
													<button id="btnuploadswot" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('swot').click();"><i class="icon-add"></i></button>													
												</div>
												<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="swot" name="swot"/>
											</div>
										</div>																								
										<div class="row">	
											<div class="col-md-12" id="fulltbp_swot_wrapper" >	
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">	
												<div class="table-responsive">
													<table class="table table-striped">
														<thead>
															<tr>
																<th>เอกสารแนบ</th>                                                                                  
																<th style="width:150px">ดาวน์โหลด</th>
															</tr>
														</thead>
														<tbody id="fulltbp_swot_wrapper_tr">    
															@foreach ($fullTbpmarketattachmentswots as $fullTbpmarketattachmentswot)
																<tr >                                        
																	<td> {{$fullTbpmarketattachmentswot->name}} </td>                                            
																	<td> 
																		<a href="{{asset($fullTbpmarketattachmentswot->path)}}" class=" badge bg-primary">ดาวน์โหลด</a>
																		<a type="button" data-id="{{$fullTbpmarketattachmentswot->id}}" data-name=""  class="btn badge bg-danger deletefulltbpswotattachment">ลบ</a>                                       
																	</td>
																</tr>
															@endforeach                            
														</tbody>
													</table>
												</div>
											</div>      
										</div>
									</div>
									<div class="tab-pane fade" id="financialplan-tab">
										<div class="row">
											<div class="col-md-12">	
												<div class="input-group">													
													<button id="btnuploadfinancialplan" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('financialplan').click();"><i class="icon-add"></i></button>													
												</div>
												<input type="file" style="display:none;" data-id="{{$fulltbp->id}}" id="financialplan" name="financialplan"/>
											</div>
										</div>
										<div class="row">	
											<div class="col-md-12" id="fulltbp_financialplan_wrapper" >	
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">	
												<div class="table-responsive">
													<table class="table table-striped">
														<thead>
															<tr>
																<th>เอกสารแนบ</th>                                                                                  
																<th style="width:150px">ดาวน์โหลด</th>
															</tr>
														</thead>
														<tbody id="fulltbp_financialplan_wrapper_tr">    
															@foreach ($fullTbpmarketattachmentfinancialplans as $fullTbpmarketattachmentfinancialplan)
																<tr >                                        
																	<td> {{$fullTbpmarketattachmentfinancialplan->name}} </td>                                            
																	<td> 
																		<a href="{{asset($fullTbpmarketattachmentfinancialplan->path)}}" class=" badge bg-primary">ดาวน์โหลด</a>
																		<a type="button" data-id="{{$fullTbpmarketattachmentfinancialplan->id}}" data-name=""  class="btn badge bg-danger deletefulltbpfinancialplanattachment">ลบ</a>                                       
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

							<div class="tab-pane fade" id="left-icon-sell">
								<ul class="nav nav-tabs">
									<li class="nav-item"><a href="#sell-tab" class="nav-link active" data-toggle="tab">มูลค่ายอดขาย</a></li>
									<li class="nav-item"><a href="#sellstatus-tab" class="nav-link " data-toggle="tab">สถานะยอดขาย</a></li>
									<li class="nav-item"><a href="#buyin-tab" class="nav-link " data-toggle="tab">คู่ค้าหลัก(ยอดซื้อ)</a></li>
									<li class="nav-item"><a href="#sellout-tab" class="nav-link " data-toggle="tab">คู่ค้าหลัก(ยอดขาย)</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="sell-tab">
										<div class="form-group">	
											<a href="" class="btn btn-info  btn-icon ml-2 btn-sm float-right" id="btnaddsell" data-toggle="modal" data-target="#modal_add_sell"><i class="icon-add"></i></a>
										</div>
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
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
														<tr >                                        
															<td> {{$fulltbpsell->name}}</td> 
															<td> {{$fulltbpsell->present}} </td> 
															<td> {{$fulltbpsell->past1}} </td> 
															<td> {{$fulltbpsell->past2}} </td>                                            															
															<td> {{$fulltbpsell->past3}} </td> 
															<td> 
																<a type="button" data-id="{{$fulltbpsell->id}}" class="btn badge bg-info editsell">แก้ไข</a>
																<a type="button" data-id="{{$fulltbpsell->id}}" class="btn badge bg-warning deletesell">ลบ</a> 
															</td> 
														</tr>
													@endforeach                            
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane fade" id="sellstatus-tab">
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th>ยอดขายแยกตามประเภทผลิตภัณฑ์</th>  
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
																<a type="button" data-id="{{$fulltbpsellstatus->id}}" class="btn badge bg-info editsellstatus">แก้ไข</a> 
															</td> 
														</tr>
													@endforeach                            
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane fade" id="buyin-tab">
										<div class="form-group">	
											<a href="" class="btn btn-info btn-icon ml-2 btn-sm float-right"  data-toggle="modal" data-target="#modal_add_debtpartner"><i class="icon-add"></i></a>
											<br>
										</div>
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th>รายชื่อคู่ค้าหลักของธุรกิจ</th>  
														<th>จำนวนผลิตภัณฑ์หรือโครงการ</th> 
														<th>เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)</th>                                                                                    
														<th>ยอดขายต่อปี(บาท)</th>       
														<th>เปรียบเทียบกับยอดขาย (%)</th>  
														<th>จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)</th> 
														<th style="width:120px">เพิ่มเติม</th>    
													</tr>
												</thead>
												<tbody id="fulltbp_debtpartner_wrapper_tr">    
													@foreach ($fulltbpdebtpartners as $fulltbpdebtpartner)
														<tr >
															<td> {{$fulltbpdebtpartner->debtpartner}}</td> 
															<td> {{$fulltbpdebtpartner->numproject}} </td> 
															<td> {{$fulltbpdebtpartner->partnertaxid}} </td> 
															<td> {{$fulltbpdebtpartner->totalyearsell}} </td>                                            															
															<td> {{$fulltbpdebtpartner->percenttosale}} </td> 
															<td> {{$fulltbpdebtpartner->businessyear}} </td> 
															<td> 
																<a type="button" data-id="{{$fulltbpdebtpartner->id}}" class="btn badge bg-info editdebtpartner">แก้ไข</a>
																<a type="button" data-id="{{$fulltbpdebtpartner->id}}" class="btn badge bg-warning deletedebtpartner">ลบ</a> 
															</td> 
														</tr>
													@endforeach              
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane fade" id="sellout-tab">
										<div class="form-group">	
											<a href="" class="btn btn-info btn-icon ml-2 btn-sm float-right"  data-toggle="modal" data-target="#modal_add_creditpartner"><i class="icon-add"></i></a>
											<br>
										</div>
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th>รายชื่อคู่ค้าหลักของธุรกิจ</th>  
														<th>เลขทะเบียนนิติบุคคล (หนังสือรับรองบริษัท)</th>                                                                                    
														<th>ยอดซื้อต่อปี(บาท)</th>       
														<th>เปรียบเทียบกับยอดซื้อ (%)</th>  
														<th>จำนวนปีที่ทำธุรกิจร่วมกัน (ปี)</th> 
														<th style="width:120px">เพิ่มเติม</th>    
													</tr>
												</thead>
												<tbody id="fulltbp_creditpartner_wrapper_tr">    
													@foreach ($fulltbpcreditpartners as $fulltbpcreditpartner)
														<tr >
															<td> {{$fulltbpcreditpartner->creditpartner}}</td> 
															<td> {{$fulltbpcreditpartner->partnertaxid}} </td> 
															<td> {{$fulltbpcreditpartner->totalyearpurchase}} </td>                                            															
															<td> {{$fulltbpcreditpartner->percenttopurchase}} </td> 
															<td> {{$fulltbpcreditpartner->businessyear}} </td> 
															<td> 
																<a type="button" data-id="{{$fulltbpcreditpartner->id}}" class="btn badge bg-info editcreditpartner">แก้ไข</a>
																<a type="button" data-id="{{$fulltbpcreditpartner->id}}" class="btn badge bg-warning deletecreditpartner">ลบ</a> 
															</td> 
														</tr>
													@endforeach              
												</tbody>
											</table>
										</div>
									</div>
								</div>

							</div>
							<div class="tab-pane fade" id="left-icon-financial">
								<ul class="nav nav-tabs">
									<li class="nav-item"><a href="#asset-tab" class="nav-link active" data-toggle="tab">การจัดหาแหล่งเงินลงทุน</a></li>
									<li class="nav-item"><a href="#investment-tab" class="nav-link " data-toggle="tab">เงินลงทุนสำหรับดำเนินการของโครงการ</a></li>
									<li class="nav-item"><a href="#cost-tab" class="nav-link " data-toggle="tab">แหล่งเงินทุนของโครงการ</a></li>
									<li class="nav-item"><a href="#returnofinvestment-tab" class="nav-link " data-toggle="tab">ประมาณการผลตอบแทน</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="asset-tab">
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th>รายการ</th>  
														<th>จำนวนเงิน (บาท)</th>                                                                                    
														<th>จำนวน(ชิ้น)</th>       
														<th>ราคาต่อเครื่อง(บาท)</th>  
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
																<a type="button" data-id="{{$fulltbpasset->id}}" class="btn badge bg-info editasset">แก้ไข</a>
															</td> 
														</tr>
													@endforeach              
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane fade" id="investment-tab">
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
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
																<a type="button" data-id="{{$fulltbpinvestment->id}}" class="btn badge bg-info editinvestment">แก้ไข</a>
															</td> 
														</tr>
													@endforeach              
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane fade" id="cost-tab">
										<div class="table-responsive">
											<table class="table table-striped">
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
																<a type="button" data-id="{{$fulltbpcost->id}}" class="btn badge bg-info editcost">แก้ไข</a>
															</td> 
														</tr>
													@endforeach              
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane fade" id="returnofinvestment-tab">
										<div class="row">	
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
											</div>
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

						{{-- </form> --}}
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
<script type="module" src="{{asset('assets/dashboard/js/app/helper/fulltbphelper.js')}}"></script>
<script>
	var route = {
		url: "{{ url('/') }}",
		token: $('meta[name="csrf-token"]').attr('content'),
		branchid: "{{Auth::user()->branch_id}}"
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
