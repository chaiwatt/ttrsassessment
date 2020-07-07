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

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Full TBP</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>

        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> การประเมิน</a>
                    <a href="{{route('dashboard.company.fulltbp')}}" class="breadcrumb-item"> รายการ Full TBP</a>
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
							{{-- <li class="nav-item"><a href="#left-icon-contact" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> แผนผังองค์กร</a></li> --}}
							<li class="nav-item"><a href="#left-icon-oganization" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> ข้อมูลองค์กร</a></li>
							<li class="nav-item"><a href="#left-icon-tab3" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> โครงการ</a></li>
							<li class="nav-item"><a href="#left-icon-tab4" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> การตลาด</a></li>
							<li class="nav-item"><a href="#left-icon-financial" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> การเงิน</a></li>
						</ul>
						<form method="POST" action="{{route('dashboard.company.fulltbp.editsave',['id'=>$fulltbp->id])}}" enctype="multipart/form-data">
							@csrf
						<div class="tab-content">
							<div class="tab-pane fade show active" id="left-icon-minitbp">
								@csrf
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
							<div class="tab-pane fade" id="left-icon-oganization">
								<div class="row">	
									<div class="col-md-12"  >	
										<div class="d-md-flex" >
											<ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-2 wmin-md-200 mb-md-0 border-bottom-0">
												<li class="nav-item"><a href="#vertical-left-companyprofile" class="nav-link active" data-toggle="tab"><i class="icon-arrow-right5"></i> ประวัติของบริษัท</a></li>
												<li class="nav-item"><a href="#vertical-left-quantityemploy" class="nav-link" data-toggle="tab"><i class="icon-arrow-right5"></i> จำนวนบุคลากร</a></li>
												<li class="nav-item"><a href="#vertical-left-employhistory" class="nav-link" data-toggle="tab"><i class="icon-arrow-right5"></i> ข้อมูลบุคลากร</a></li>
												<li class="nav-item"><a href="#vertical-left-stockholder" class="nav-link" data-toggle="tab"><i class="icon-arrow-right5"></i> บัญชีรายชื่อผู้ถือหุ้น</a></li>
											</ul>
											<div class="tab-content" style="word-break:break-all;width:100%" >
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
													<div class="form-group">
														<button type="button" id="btnaddcompanyprofile" data-id="{{$fulltbp->id}}" class="btn btn-success float-right" >บันทึกประวัติบริษัท</button>
													</div>
												</div>
												<div class="tab-pane fade" id="vertical-left-quantityemploy">
													<div class="form-group">
														<label for="">ฝ่ายบริหาร</label>
														<input type="number" name ="department1_qty" value="{{$fulltbpemployee->department1_qty}}" class="form-control" >
													</div>
													<div class="form-group">
														<label for="">ฝ่ายวิจัยและพัฒนา</label>
														<input type="number" name ="department2_qty" value="{{$fulltbpemployee->department2_qty}}" class="form-control" >
													</div>
													<div class="form-group">
														<label for="">ฝ่ายผลิต/วิศวกรรม</label>
														<input type="number" name ="department3_qty" value="{{$fulltbpemployee->department3_qty}}" class="form-control" >
													</div>
													<div class="form-group">
														<label for="">ฝ่ายการตลาด</label>
														<input type="number" name ="department4_qty" value="{{$fulltbpemployee->department4_qty}}" class="form-control" >
													</div>
													<div class="form-group">
														<label for="">พนักงานทั่วไป </label>
														<input type="number" name ="department5_qty" value="{{$fulltbpemployee->department5_qty}}" class="form-control" >
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
							</div>
							<div class="tab-pane fade" id="left-icon-tab3">
								<div class="form-group">
									<label for="">3</label>
									<input type="text" name ="contactname" value="" class="form-control" >
								</div>
							</div>
							<div class="tab-pane fade" id="left-icon-tab4">
								<div class="form-group">
									<label for="">4</label>
									<input type="text" name ="contactname" value="" class="form-control" >
								</div>
							</div>

						</div>
							<div class="text-right">
								<button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
							</div>
						</form>
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
