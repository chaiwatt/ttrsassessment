@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">ข้อมูลบริษัท</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ข้อมูลบริษัท</a>
                    <span class="breadcrumb-item active">ข้อมูลบริษัท</span>
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
                        <form method="POST" action="{{route('setting.user.businessplan.editsave',['id' => $businessplan->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
								<ul class="nav nav-tabs nav-tabs-highlight">
									<li class="nav-item"><a href="#left-icon-history" class="nav-link active" data-toggle="tab"><i class="icon-home2 mr-2"></i> ประวัติความเป็นมา</a></li>
                                    <li class="nav-item"><a href="#left-icon-performance" class="nav-link" data-toggle="tab"><i class="icon-magic-wand mr-2"></i> การวิเคราะห์ด้านการตลาด</a></li>
                                    <li class="nav-item"><a href="#left-icon-marketopponent" class="nav-link" data-toggle="tab"><i class="icon-meter-fast mr-2"></i> คู่แข่งในธุรกิจ</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="left-icon-history">
                                        <div class="row">	
                                            <div class="col-md-12">
                                                <fieldset>	
                                                    <div class="form-group">
                                                        <label>ประวัติของกิจการ/ผู้เริ่มกิจการ</label>
                                                        <textarea name="establishedhistory" cols="30" rows="5" placeholder="ประวัติของกิจการ/ผู้เริ่มกิจการ" class="form-control">{{@$businessplanhistory->establishedhistory}}</textarea>
                                                    </div>
            
                                                    <div class="form-group">
                                                        <label>แนวความคิดในการก่อตั้งกิจการ</label>
                                                        <textarea name="concepthistory" cols="30" rows="5" placeholder="แนวความคิดในการก่อตั้งกิจการ" class="form-control">{{@$businessplanhistory->concepthistory}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ความสำเร็จที่ผ่านมา</label>
                                                        <textarea name="successhistory" cols="30" rows="5" placeholder="ความสำเร็จที่ผ่านมา" class="form-control">{{@$businessplanhistory->successhistory}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>อุปสรรคที่ผ่านมา</label>
                                                        <textarea name="obstaclehistory" cols="30" rows="5" placeholder="อุปสรรคที่ผ่านมา" class="form-control">{{@$businessplanhistory->obstaclehistory}}</textarea>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
									<div class="tab-pane fade" id="left-icon-performance">
										<div class="tab-pane fade show active" id="left-icon-history">
                                            <div class="row">	
                                                <div class="col-md-12">
                                                    <fieldset>	
                                                        <div class="form-group">
                                                            <label>สภาวะอุตสาหกรรม และสภาวะตลาด</label>
                                                            <textarea name="condition" cols="30" rows="5" placeholder="สภาวะอุตสาหกรรม และสภาวะตลาด" class="form-control">{{@$businessplanmarketanalyse->condition}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>การแบ่งส่วนตลาด และส่วนแบ่งทางการตลาด</label>
                                                            <textarea name="share" cols="30" rows="5" placeholder="การแบ่งส่วนตลาด และส่วนแบ่งทางการตลาด" class="form-control">{{@$businessplanmarketanalyse->share}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>แนวโน้มทางการตลาด</label>
                                                            <textarea name="trend" cols="30" rows="5" placeholder="แนวโน้มทางการตลาด" class="form-control">{{@$businessplanmarketanalyse->trend}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>ตลาดเป้าหมาย</label>
                                                            <textarea name="tarket" cols="30" rows="5" placeholder="ตลาดเป้าหมาย" class="form-control">{{@$businessplanmarketanalyse->tarket}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>ลักษณะทั่วไปของลูกค้า</label>
                                                            <textarea name="characteristicofcustomer" cols="30" rows="5" placeholder="ลักษณะทั่วไปของลูกค้า" class="form-control">{{@$businessplanmarketanalyse->characteristicofcustomer}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>สภาพการแข่งขัน</label>
                                                            <textarea name="competition" cols="30" rows="5" placeholder="สภาพการแข่งขัน" class="form-control">{{@$businessplanmarketanalyse->competition}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>คู่แข่งขัน</label>
                                                            <textarea name="opponent" cols="30" rows="5" placeholder="คู่แข่งขัน" class="form-control">{{@$businessplanmarketanalyse->opponent}}</textarea>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="tab-pane fade" id="left-icon-marketopponent">
										<div class="row">	
                                            <div class="col-md-12">
                                                <fieldset>	
                                                    <div class="form-group">
                                                        <label>ธุรกิจของเรา</label>
                                                        <textarea name="detail" cols="30" rows="5" placeholder="ธุรกิจของเรา เช่น ราคาหรือคะแนน" class="form-control">{{@$businessplanmarketopponent->detail}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ธุรกิจของคู่แข่ง</label>
                                                        <textarea name="opponentdetail" cols="30" rows="5" placeholder="ธุรกิจของคู่แข่ง เช่น ราคาหรือคะแนน" class="form-control">{{@$businessplanmarketopponent->opponentdetail}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ชื่อคู่แข่ง</label>
                                                        <textarea name="opponentname" cols="30" rows="5" placeholder="ชื่อคู่แข่ง" class="form-control">{{@$businessplanmarketopponent->opponentname}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ด้านบริการ</label>
                                                        <textarea name="service" cols="30" rows="5" placeholder="ด้านบริการ" class="form-control">{{@$businessplanmarketopponent->service}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ด้านราคา</label>
                                                        <textarea name="price" cols="30" rows="5" placeholder="ด้านราคา" class="form-control">{{@$businessplanmarketopponent->price}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ด้านช่องทางการจัดจำหน่าย</label>
                                                        <textarea name="distributionchannel" cols="30" rows="5" placeholder="ด้านช่องทางการจัดจำหน่าย" class="form-control">{{@$businessplanmarketopponent->distributionchannel}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ด้านส่งเสริมการตลาด</label>
                                                        <textarea name="promotemarketing" cols="30" rows="5" placeholder="ด้านส่งเสริมการตลาด" class="form-control">{{@$businessplanmarketopponent->promotemarketing}}</textarea>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
									</div>
								</div>
							</div>



                          
                            <div class="text-right">
                                <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            <!-- /striped rows -->
            </div>
        </div>
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
{{-- <script type="module" src="{{asset('assets/dashboard/js/app/helper/locationhelper.js')}}"></script> --}}
    <script>
    		var route = {
			url: "{{ url('/') }}",
			token: $('meta[name="csrf-token"]').attr('content'),
        };
    </script>	
@stop
