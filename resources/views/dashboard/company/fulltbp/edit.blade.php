@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
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
					{{-- <div class="card-header header-elements-inline">
					
					</div> --}}

                	<div class="card-body">
						<ul class="nav nav-tabs nav-tabs-highlight">
							<li class="nav-item"><a href="#left-icon-minitbp" class="nav-link active" data-toggle="tab"><i class="icon-stack3 mr-2"></i> ข้อมูลทั่วไป</a></li>
							<li class="nav-item"><a href="#left-icon-contact" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> แผนผังองค์กร</a></li>
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
							<div class="tab-pane fade" id="left-icon-contact">
								<div class="row">	
									<div class="col-md-12"  >	
										<div class="d-md-flex" >
											<ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-2 wmin-md-200 mb-md-0 border-bottom-0">
												<li class="nav-item"><a href="#vertical-left-employee" class="nav-link active" data-toggle="tab"><i class="icon-arrow-right5"></i> บุคลากร</a></li>
												<li class="nav-item"><a href="#vertical-left-organizelist" class="nav-link" data-toggle="tab"><i class="icon-arrow-right5"></i> แผนผังองค์กร</a></li>
											</ul>
											<div class="tab-content" style="word-break:break-all;width:100%" >
												<div class="tab-pane fade show active" id="vertical-left-employee">
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
												<div class="tab-pane fade" id="vertical-left-organizelist">
													<div class="form-group">
														<label for="">organizelist </label>
														<input type="number" name ="department5_qty" value="{{$fulltbpemployee->department5_qty}}" class="form-control" >
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="left-icon-oganization">
								<div class="row">	
									<div class="col-md-12"  >	
										<div class="d-md-flex" >
											<ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-2 wmin-md-200 mb-md-0 border-bottom-0">
												<li class="nav-item"><a href="#vertical-left-companyprofile" class="nav-link active" data-toggle="tab"><i class="icon-arrow-right5"></i> ประวัติของบริษัท</a></li>
												<li class="nav-item"><a href="#vertical-left-boardhistory" class="nav-link" data-toggle="tab"><i class="icon-arrow-right5"></i> ข้อมูลผู้บริหารระดับสูง</a></li>
												<li class="nav-item"><a href="#vertical-left-teamhistory" class="nav-link" data-toggle="tab"><i class="icon-arrow-right5"></i> ข้อมูลทีมบริหาร</a></li>															
												<li class="nav-item"><a href="#vertical-left-stockholder" class="nav-link" data-toggle="tab"><i class="icon-arrow-right5"></i> บัญชีรายชื่อผู้ถือหุ้น</a></li>							
												<li class="nav-item"><a href="#vertical-left-researcher" class="nav-link" data-toggle="tab"><i class="icon-arrow-right5"></i> ข้อมูลพนักงาน</a></li>							
												<li class="nav-item"><a href="#vertical-left-takeowner" class="nav-link" data-toggle="tab"><i class="icon-arrow-right5"></i> ผู้รับผิดชอบโครงการ</a></li>							
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
															{{-- <a href="" class="btn btn-info  btn-icon ml-2 btn-sm float-left" ><i class="icon-add"></i></a> --}}
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
																					<a href="" data-id="{{$fulltbpcompanyprofileattachment->id}}" data-name="" onclick="confirmation(event)" class=" badge bg-danger">ลบ</a>                                       
																				</td>
																			</tr>
																		@endforeach                            
																	</tbody>
																</table>
															</div>
														</div>      
													</div>
												</div>
		
												<div class="tab-pane fade" id="vertical-left-boardhistory">
													<div class="form-group">
														<label for="">rrrr </label>
														<input type="number" name ="department5_qty" value="{{$fulltbpemployee->department5_qty}}" class="form-control" >
													</div>
												</div>
												<div class="tab-pane fade" id="vertical-left-teamhistory">
													<div class="form-group">
														<label for="">dfdsfsdf </label>
														<input type="number" name ="department5_qty" value="{{$fulltbpemployee->department5_qty}}" class="form-control" >
													</div>
												</div>
												<div class="tab-pane fade" id="vertical-left-stockholder">
													<div class="form-group">
														<label for="">rrrrrrrrrrrrss </label>
														<input type="number" name ="department5_qty" value="{{$fulltbpemployee->department5_qty}}" class="form-control" >
													</div>
												</div>
	
												<div class="tab-pane fade" id="vertical-left-researcher">
													<div class="form-group">
														<label for="">ข้อมูลพนักงาน </label>
														<input type="number" name ="department5_qty" value="{{$fulltbpemployee->department5_qty}}" class="form-control" >
													</div>
												</div>
												<div class="tab-pane fade" id="vertical-left-takeowner">
													<div class="form-group">
														<label for="">sdfsdf </label>
														<input type="number" name ="department5_qty" value="{{$fulltbpemployee->department5_qty}}" class="form-control" >
													</div>
												</div>
												<div class="form-group">
													<button type="button" id="btnaddcompanyprofile" data-id="{{$fulltbp->id}}" class="btn btn-success" >บันทึกประวัติบริษัท</button>
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
