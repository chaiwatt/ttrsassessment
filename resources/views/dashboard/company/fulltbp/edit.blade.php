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
							<li class="nav-item"><a href="#left-icon-employee" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> บุคลากร</a></li>
							<li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> แทบ2</a></li>
							<li class="nav-item"><a href="#left-icon-tab3" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> แทบ3</a></li>
							<li class="nav-item"><a href="#left-icon-tab4" class="nav-link" data-toggle="tab"><i class="icon-user mr-2"></i> แทบ4</a></li>
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
												<label>ชื่อนิติบุคคล</label>
												<input type="text"  value="{{$fulltbp->minitbp->businessplan->company->name}}"  placeholder="ชื่อนิติบุคคล" class="form-control" readonly>
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
								<div class="form-group">
									<label for="">ชื่อ</label>
									<input type="text" name ="contactname" value="" class="form-control" >
								</div>
							</div>
							<div class="tab-pane fade" id="left-icon-employee">
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
							<div class="tab-pane fade" id="left-icon-tab2">
								<div class="form-group">
									<label for="">2</label>
									<input type="text" name ="contactname" value="" class="form-control" >
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

@stop
