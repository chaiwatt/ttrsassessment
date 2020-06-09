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
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Color options</h5>
						<div class="header-elements">
							{{-- <div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a>
		                	</div> --}}
	                	</div>
					</div>

                	<div class="card-body">
						<form method="POST" action="" enctype="multipart/form-data">
                            @csrf
							<div class="row">	
								<div class="col-md-12">
									<fieldset>	
										<div class="form-group">
											<label>โครงการ</label>
											<input type="text"  name="bank" value="{{old('bank')}}"  placeholder="ธนาคาร" class="form-control">
										</div>
									</fieldset>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group mb-3 mb-md-2">
										<label class="font-weight-semibold">สิทธิประโยชน์ทางการเงิน (Finance)</label>
										<div class="row">
											<div class="col-md-4">
												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-primary" checked data-fouc>
														Primary checkbox
													</label>
												</div>

												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-danger" checked data-fouc>
														Danger checkbox
													</label>
												</div>

												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-success" checked data-fouc>
														Success checkbox
													</label>
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-warning" checked data-fouc>
														Warning checkbox
													</label>
												</div>

												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-info" checked data-fouc>
														Info checkbox
													</label>
												</div>

												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-custom" checked data-fouc>
														Custom color
													</label>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-warning" checked data-fouc>
														Warning checkbox
													</label>
												</div>

												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-info" checked data-fouc>
														Info checkbox
													</label>
												</div>

												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-custom" checked data-fouc>
														Custom color
													</label>
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
											<div class="col-md-4">
												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-primary" checked data-fouc>
														Primary checkbox
													</label>
												</div>

												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-danger" checked data-fouc>
														Danger checkbox
													</label>
												</div>

												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-success" checked data-fouc>
														Success checkbox
													</label>
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-warning" checked data-fouc>
														Warning checkbox
													</label>
												</div>

												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-info" checked data-fouc>
														Info checkbox
													</label>
												</div>

												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-custom" checked data-fouc>
														Custom color
													</label>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-warning" checked data-fouc>
														Warning checkbox
													</label>
												</div>

												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-info" checked data-fouc>
														Info checkbox
													</label>
												</div>

												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input-styled-custom" checked data-fouc>
														Custom color
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
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
@stop
