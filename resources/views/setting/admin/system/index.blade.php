@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/plugins/summernote/summernote.min.css')}}" rel="stylesheet">
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">ตั้งค่าระบบ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> ระบบ</a>
                    <span class="breadcrumb-item active">ตั้งค่าระบบ</span>
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
                        <form method="POST" action="{{route('setting.admin.system.save')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>หน่วยงาน</label>
                                        <input type="text" name="organizationname" value="{{$generalinfo->company}}" data-placeholder="สำนักงาน"class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ที่อยู่</label>
                                        <input type="text" name="organizationaddress" value="{{$generalinfo->address}}" data-placeholder="คำนำหน้า" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>จังหวัด<span class="text-danger">*</span></label>
                                        <select name="organizationprovince" id="province" data-placeholder="จังหวัด" class="form-control form-control-lg form-control-select2">
                                            <option value=""></option>
                                            @foreach ($provinces as $province)
                                                <option value="{{$province->id}}" @if($generalinfo->province_id == $province->id) selected @endif>{{$province->name}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>อำเภอ/เขต<span class="text-danger">*</span></label>
                                        <select name="organizationamphur" id="amphur" data-placeholder="อำเภอ" class="form-control form-control-lg form-control-select2">
                                            @foreach ($amphurs as $amphur)                                                                
                                                <option value="{{$amphur->id}}" @if ($amphur->id == $generalinfo->amphur_id) selected @endif> {{$amphur->name}} </option>
                                            @endforeach   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ตำบล/แขวง<span class="text-danger">*</span></label>
                                        <select name="organizationtambol" id="tambol" data-placeholder="ตำบล" class="form-control form-control-lg form-control-select2">
                                            @foreach ($tambols as $tambol)                                                                
                                                <option value="{{$tambol->id}}" @if ($tambol->id == $generalinfo->tambol_id) selected @endif> {{$tambol->name}} </option>
                                            @endforeach    
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>รหัสไปรษณีย์</label>
                                        <input type="text" name="organizationpostalcode" value="{{$generalinfo->postalcode}}" data-placeholder="รหัสไปรษณีย์" class="form-control form-control-lg numeralformatpostal">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>โทรศัพท์1</label>
                                        <input type="text" name="phone1" value="{{$generalinfo->phone1}}" data-placeholder="อีเมล" class="form-control form-control-lg stringformat11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ต่อ</label>
                                        <input type="text" name="phone1_ext" value="{{$generalinfo->phone1_ext}}" data-placeholder="ต่อ" class="form-control form-control-lg stringformat11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Call Center</label>
                                        <input type="text" name="phone2" value="{{$generalinfo->phone2}}" data-placeholder="Call Center" class="form-control form-control-lg stringformat11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>โทรสาร</label>
                                        <input type="text" name="organizationfax" value="{{$generalinfo->fax}}" data-placeholder="แฟ๊กซ์" class="form-control form-control-lg stringformat11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>อีเมล</label>
                                        <input type="email" name="organizationemail" value="{{$generalinfo->email}}" data-placeholder="อีเมล" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>เวลาทำการ</label>
                                        <input type="text" name="workdaytime" value="{{$generalinfo->workdaytime}}" data-placeholder="เวลาทำการ" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>เวลาทำการ</label>
                                        <input type="text" name="sundaytime" value="{{$generalinfo->sundaytime}}" data-placeholder="เวลาทำการ" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <input type="text" name="facebook" value="{{$generalinfo->facebook}}" data-placeholder="Facebook" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Youtube</label>
                                        <input type="text" name="youtube" value="{{$generalinfo->youtube}}" data-placeholder="Youtube" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Instagram</label>
                                        <input type="text" name="instagram" value="{{$generalinfo->instagram}}" data-placeholder="Instagram" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Twitter</label>
                                        <input type="text" name="twitter" value="{{$generalinfo->twitter}}" data-placeholder="Facebook" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>แสดง Social media</label>
                                        <select name="showsocialmedia" data-placeholder="แสดง Social media" class="form-control form-control-lg form-control-select2">                                                              
                                            <option value="0" @if ($generalinfo->showsocialmedia == 0) selected @endif> ไม่แสดง </option>
                                            <option value="1" @if ($generalinfo->showsocialmedia == 1) selected @endif> แสดง </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>สถานภาพเกรดแยกตาม Pillar</label>
                                        <select name="showgradeperpillar" data-placeholder="สถานภาพเกรดแยกตาม Pillar" class="form-control form-control-lg form-control-select2">
                                            @foreach ($showalerts as $showalert)                                                                
                                                <option value="{{$showalert->id}}" @if ($generalinfo->showgradeperpillar == $showalert->id) selected @endif> {{$showalert->name}} </option>
                                            @endforeach   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>สถานภาพเกรดแยกตามขนาดธุรกิจ</label>
                                        <select name="showgradeperbusinesssize" data-placeholder="สถานภาพเกรดแยกตามขนาดธุรกิจ" class="form-control form-control-lg form-control-select2">
                                            @foreach ($showalerts as $showalert)                                                                
                                                <option value="{{$showalert->id}}" @if ($generalinfo->showgradeperbusinesssize == $showalert->id) selected @endif> {{$showalert->name}} </option>
                                            @endforeach   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>สถานภาพเกรดแยกตามภูมิภาค</label>
                                        <select name="showgradepersection" data-placeholder="สถานภาพเกรดแยกตามภูมิภาค" class="form-control form-control-lg form-control-select2">
                                            @foreach ($showalerts as $showalert)                                                                
                                                <option value="{{$showalert->id}}" @if ($generalinfo->showgradepersection == $showalert->id) selected @endif> {{$showalert->name}} </option>
                                            @endforeach   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>สถานภาพเกรดแยกตามประเภทธุรกิจ</label>
                                        <select name="showgradeperbusinesstype" data-placeholder="สถานภาพเกรดแยกตามประเภทธุรกิจ" class="form-control form-control-lg form-control-select2">
                                            @foreach ($showalerts as $showalert)                                                                
                                                <option value="{{$showalert->id}}" @if ($generalinfo->showgradeperbusinesstype == $showalert->id) selected @endif> {{$showalert->name}} </option>
                                            @endforeach   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>สถานภาพเกรดแยกตามกลุ่มอุตสาหกรรม</label>
                                        <select name="showgradeperindustrygroup" data-placeholder="สถานภาพเกรดแยกตามกลุ่มอุตสาหกรรม" class="form-control form-control-lg form-control-select2">
                                            @foreach ($showalerts as $showalert)                                                                
                                                <option value="{{$showalert->id}}" @if ($generalinfo->showgradeperindustrygroup == $showalert->id) selected @endif> {{$showalert->name}} </option>
                                            @endforeach   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>สถานภาพเกรดแยกตาม Isic</label>
                                        <select name="showgradeperisic" data-placeholder="สถานภาพเกรดแยกตาม Isic" class="form-control form-control-lg form-control-select2">
                                            @foreach ($showalerts as $showalert)                                                                
                                                <option value="{{$showalert->id}}" @if ($generalinfo->showgradeperisic == $showalert->id) selected @endif> {{$showalert->name}} </option>
                                            @endforeach   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>การแสดง Billboard</label>
                                        <select name="frontpage" data-placeholder="Front page (Bill board)" class="form-control form-control-lg form-control-select2">
                                            @foreach ($frontpagestatuses as $frontpagestatus)                                                                
                                                <option value="{{$frontpagestatus->id}}" @if ($generalinfo->front_page_status_id == $frontpagestatus->id) selected @endif> {{$frontpagestatus->name}} </option>
                                            @endforeach   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ผู้อำนวยการ/ผู้มีอำนาจลงนาม</label><span class="text-danger">*</span></label>
                                        <input type="text" name="director" value="{{$generalinfo->director}}" data-placeholder="ผู้อำนวยการ/ผู้มีอำนาจลงนาม" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ยืนยันผู้เจ้าหน้าที่ TTRS /เชี่ยวชาญ</label>
                                        <select name="verifyexpert" data-placeholder="ยืนยันผู้เจ้าหน้าที่ TTRS /เชี่ยวชาญ" class="form-control form-control-lg form-control-select2">
                                            @foreach ($verifyexpertstatuses as $verifyexpertstatus)                                                                
                                                <option value="{{$verifyexpertstatus->id}}" @if ($generalinfo->verify_expert_status_id == $verifyexpertstatus->id) selected @endif> {{$verifyexpertstatus->name}} </option>
                                            @endforeach   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>การใช้ Invoice</label>
                                        <select name="useinvoicestatus" data-placeholder="การใช้ Invoice" class="form-control form-control-lg form-control-select2">
                                            @foreach ($useinvoicestatuses as $useinvoicestatus)                                                                
                                                <option value="{{$useinvoicestatus->id}}" @if ($generalinfo->use_invoice_status_id == $useinvoicestatus->id) selected @endif> {{$useinvoicestatus->name}} </option>
                                            @endforeach   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ใช้ลายน้ำ PDF (Mini TBP & Full TBP)</label>
                                        <select name="watermark" data-placeholder="ใช้ลายน้ำ PDF (Mini TBP & Full TBP)" class="form-control form-control-lg form-control-select2">                                                             
                                            <option value="0" @if ($generalinfo->watermark == 0) selected @endif>ไม่ใช้</option>
                                            <option value="1" @if ($generalinfo->watermark == 1) selected @endif>ใช้</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ลายน้ำ PDF (Mini TBP & Full TBP)</label>
                                        <input type="text" name="watermarktext" value="{{$generalinfo->watermarktext}}" data-placeholder="ลายน้ำ PDF (Mini TBP & Full TBP)" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>แสดง Alert หน้า Dashboard</label>
                                        <select name="showalert" data-placeholder="การใช้ Invoice" class="form-control form-control-lg form-control-select2">
                                            @foreach ($showalerts as $showalert)                                                                
                                                <option value="{{$showalert->id}}" @if ($generalinfo->showalert_id == $showalert->id) selected @endif> {{$showalert->name}} </option>
                                            @endforeach   
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>แสดงรายการที่สิ้นสุดโครงการแล้ว</label>
                                        <select name="showfinishedproject" data-placeholder="การใช้ Invoice" class="form-control form-control-lg form-control-select2">
                                            @foreach ($showfinishedprojects as $showfinishedproject)                                                                
                                                <option value="{{$showfinishedproject->id}}" @if ($showfinishedproject->id == $generalinfo->show_finished_project_id) selected @endif> {{$showfinishedproject->name}} </option>
                                            @endforeach   
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Consent</label></span>
                                        <textarea name="consent" id="consent" class="form-control form-control-lg" cols="3" rows="15">{!!$generalinfo->consent!!}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>โลโก้ 274x99 px</label>
                                        <div class="input-group">													
                                            <input type="text" id="filename" class="form-control form-control-lg border-right-0" placeholder="โลโก้"  >											
                                                <span class="input-group-append">
                                                    <button class="btn bg-info" type="button" onclick="document.getElementById('file').click();">อัปโหลด</button>
                                                </span>
                                        </div>
                                        <input type="file" style="display:none;" id="file" name="picture" accept="image/*"/>
                                        @if (!Empty($generalinfo->logo))
                                        <br>
                                            <img src="{{asset($generalinfo->logo)}}" width="274" height="99" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="text-right">
                               
                            </div> --}}
                            <div class="text-right">
                                <button type="submit" name="submit" value="default" class="btn bg-info">ค่าเริ่มต้น <i class="icon-rotate-ccw3 ml-2"></i></button>
                                <button type="submit" name="submit" value="save" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
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
<script src="{{asset('assets/dashboard/plugins/summernote/summernote.min.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/locationhelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/inputformat.js?v=3')}}"></script>
<script>
    var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content'),
    };
    $("#file").on('change', function() {
        $("#filename").val(this.value);
    });
    $('#consent').summernote({
			toolbar: false,
			height: 300,
            callbacks: {
				onPaste: function (e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
</script>
@stop
