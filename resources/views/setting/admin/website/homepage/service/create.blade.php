@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">เพิ่มขั้นตอนการบริการ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <a href="#" class="breadcrumb-item"> หน้าแรก (Homepage)</a>
                    <a href="{{route('setting.admin.website.homepage.service')}}" class="breadcrumb-item"> ขั้นตอนการบริการ</a>
                    <span class="breadcrumb-item active">เพิ่มขั้นตอนการบริการ</span>
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
                        <form method="POST" action="{{route('setting.admin.website.homepage.service.createsave')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <fieldset>	
                                        <div class="form-group">
                                            <label>ข้อความ (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="titlethai" value=""  placeholder="ข้อความที่ (ภาษาไทย)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความ (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="titleeng" value=""  placeholder="ข้อความที่ (ภาษาอังกฤษ)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความอธิบาย (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="descriptionthai" value=""  placeholder="ข้อความอธิบาย (ภาษาไทย)" class="form-control form-control-lg stringformat100">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความอธิบาย (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="descriptioneng" value=""  placeholder="ข้อความอธิบาย (ภาษาอังกฤษ)" class="form-control form-control-lg stringformat100">
                                        </div>
                                        <div class="form-group">
                                            <label>ลิงก์<span class="text-danger">*</span></label>
                                            <input type="text"  name="link" value=""  placeholder="ลิงก์" class="form-control form-control-lg stringformat100">
                                        </div>

                                        
                                    <input type="text" id="colortypeinp" name="colortypeinp" value="0"  >
                                    <input type="text" id="hexcolor" name="hexcolor" value=""  >
                                        <div class="form-group">
                                            
                                            <label>เลือกสีพื้น<span class="text-danger">*</span></label>
                                            <div class="form-group" >
                                                <div class="form-check form-check-inline">
                            
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input-styled colortype" name="colortype" value="0" checked data-fouc>
                                                        เลือกรายการ
                                                    </label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input-styled colortype" name="colortype" value="1" data-fouc>
                                                        กำหนดเอง
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-top: -30px">
                                                <div class="col-lg-11">
                                                    <select name="cardcolor" placeholder="เลือกสีพื้น" class="form-control form-control-select2" >
                                                        @foreach($cardcolors as $key => $cardcolor)
                                                            <option value="{{$cardcolor->id}}" >{{$cardcolor->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-1">
                                                    <div class="form-group">
                                                        <div class="d-inline-block">
                                                            <input type="text" id="colorpick" class="form-control colorpicker-basic form-control-lg" style="font-size:18px;width:100%;height:200px;" value="" data-fouc>
                                                        </div>
                                                     </div>
                                                </div>
                                        </div>
                                   
                                         </div>
                               
										<div class="form-group">
											<label>Icon ปกติ<span class="text-danger">*</span></label>
											<div class="input-group">													
												<input type="text" id="_iconnormal" class="form-control border-right-0" placeholder="Icon ปกติ" disabled>
												<span class="input-group-append">
													<button class="btn bg-info" type="button" onclick="document.getElementById('iconnormal').click();">อัปโหลดรูป</button>													
												</span>
											</div>
											<input type="file" style="display:none;" id="iconnormal" name="iconnormal" accept="image/*"/>
                                        </div>

                                        <div class="form-group">
											<label>Icon Hover<span class="text-danger">*</span></label>
											<div class="input-group">													
												<input type="text" id="_iconhover" class="form-control border-right-0" placeholder="Icon Hover" disabled>
												<span class="input-group-append">
													<button class="btn bg-info" type="button" onclick="document.getElementById('iconhover').click();">อัปโหลดรูป</button>													
												</span>
											</div>
											<input type="file" style="display:none;" id="iconhover" name="iconhover" accept="image/*"/>
                                        </div>
                                    </fieldset>
                                    
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
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/pickers/color/spectrum.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/picker_color.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/inputformat.js')}}"></script>
    <script type="text/javascript">
        $("#iconnormal").on('change', function() {
            $("#_iconnormal").val(this.value);
        });
        $("#iconhover").on('change', function() {
            $("#_iconhover").val(this.value);
        });
 

        $(document).on('change', '.colortype', function(e) {
            if($("input[name='colortype']:checked").val()=='0'){
                $('#colortypeinp').val(0);
            }else{
                $('#hexcolor').val($('#colorpick').spectrum('get').toHexString());
                $('#colortypeinp').val(1);
            }
        });
        $("#colorpick").on('change', function() {
            $('#hexcolor').val($('#colorpick').spectrum('get').toHexString());
        });
    </script>
@stop
