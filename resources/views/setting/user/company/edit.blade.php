@extends('layouts.dashboard.main')
@section('pageCss')

<style>   
    #map {
        height: 100%;
      }
</style>
@stop
@section('content')
    <div id="modal_add_companydoc" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มเอกสารแนบ</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ชื่อเอกสาร</label><span class="text-danger">*</span>
                                <input type="text" id="companydocname" placeholder="โปรดระบุชื่อเอกสาร" class="form-control form-control-lg">
                            </div>
                        </div>
                        <div class="col-md-12">	
                            <div class="input-group">													
                                <button id="btnuploadcompanydoc" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('companydoc').click();" >อัปโหลด</button>													
                            </div>
                            <input type="file" style="display:none;" id="companydoc" data-id="{{$company->id}}" name="companydoc" accept="application/pdf"/>
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
    {{-- modal_add_authorized_director --}}
    <div id="modal_add_authorized_director" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มผู้มีอำนาจลงนาม</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>คำนำหน้าชื่อ<span class="text-danger">*</span></label>
                                <select id="directorprefix" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-select2">
                                    @foreach ($prefixes as $prefix)
                                        <option value="{{$prefix->id}}" >{{$prefix->name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>ชื่อ</label><span class="text-danger">*</span>
                                <input type="text" id="directorname" placeholder="ชื่อ" class="form-control form-control-lg">
                            </div>

                            <div class="form-group">
                                <label>นามสกุล</label><span class="text-danger">*</span>
                                <input type="text" id="directorlastname" placeholder="นามสกุล" class="form-control form-control-lg">
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_add_authorized_director" class="btn bg-primary" data-id="{{$company->id}}" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> เพิ่ม</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">ข้อมูลสถานประกอบการ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                {{-- <div class="d-flex justify-content-center">
                    <div class="form-check ">
                        <i class="icon-spinner spinner mr-2" id="spinicon" hidden></i><input type="checkbox" id="chkassessment" data-id="{{$company->id}}" data-on-color="success" data-off-color="danger" data-on-text="ประเมิน" data-off-text="ไม่ประเมิน" class="form-check-input-switch" @if (!Empty($company->businessplan)) checked @endif >
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ข้อมูลสถานประกอบการ</a>
                    <span class="breadcrumb-item active">ข้อมูลสถานประกอบการ</span>
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
                        
                        <form method="POST" action="{{route('setting.user.company.editsave',['id' => $company->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <input name="usergroup" value="{{Auth::user()->user_group_id}}" type="text" hidden>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@if (Auth::user()->user_group_id == 1) ชื่อนิติบุคคล<span class="text-danger">*</span> @else ชื่อสถานประกอบการ @endif</label>
                                        <input type="text"  name="company" value="{{$company->name}}"  placeholder="@if (Auth::user()->user_group_id == 1) ชื่อนิติบุคคล @else ชื่อสถานประกอบการ @endif" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@if (Auth::user()->user_group_id == 1) เลขทะเบียนนิติบุคคล<span class="text-danger">*</span> @else เลขประจำตัวผู้เสียภาษีอากร @endif</label>
                                        <input type="text"  name="vatno" value="{{$company->vatno}}"  placeholder="@if (Auth::user()->user_group_id == 1) เลขทะเบียนนิติบุคคล @else เลขประจำตัวผู้เสียภาษีอากร @endif" class="form-control form-control-lg" readonly>
                                    </div>
                                </div>
                                @if (Auth::user()->user_group_id == 2)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>เลขทะเบียนพาณิชย์</label>
                                            <input type="number"  name="commercialregnumber" value="{{$company->commercialregnumber}}"  placeholder="เลขทะเบียนพาณิชย์" class="form-control form-control-lg" >
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ปีที่จดทะเบียน@if (Auth::user()->user_group_id == 1)<span class="text-danger">*</span> @endif</label>
                                        <input type="number" name="registeredyear" value="{{$registeredyear}}"  placeholder="ปีที่จดทะเบียน" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ทุนจดทะเบียน@if (Auth::user()->user_group_id == 1)<span class="text-danger">*</span> @endif</label>
                                        <input type="number"  name="registeredcapital" value="{{$company->registeredcapital}}"  placeholder="ทุนจดทะเบียน" class="form-control form-control-lg" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ทุนจดทะเบียนที่เรียกชำระแล้ว@if (Auth::user()->user_group_id == 1)<span class="text-danger">*</span> @endif</label>
                                        <input type="number"  name="paidupcapital" value="{{$company->paidupcapital}}"  placeholder="ทุนจดทะเบียนที่เรียกชำระแล้ว" class="form-control form-control-lg" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>วันที่ชำระทุนจดทะเบียน</label>
                                        <input type="text"  name="paidupcapitaldate" id="paidupcapitaldate" value="{{$company->paidupcapitaldateth}}"  placeholder="เมื่อวันที่" class="form-control form-control-lg" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>หมวดหมู่หลัก ISIC</label>
                                        <select name="isic" id="isic" data-placeholder="หมวดหมู่หลัก ISIC" class="form-control form-control-select2">
                                            @foreach ($isics as $isic)
                                                <option value="{{$isic->id}}" @if($company->isic_id == $isic->id) selected @endif>{{$isic->name}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">                                          
                                    <div class="form-group">
                                        <label>หมวดหมู่ย่อย ISIC</label>
                                        <select name="subisic" id="subisic" data-placeholder="หมวดหมู่ย่อย ISIC" class="form-control form-control-select2">
                                            @foreach ($isicsubs as $isicsub)
                                                <option value="{{$isicsub->id}}" @if($company->isic_sub_id == $isicsub->id) selected @endif>{{$isicsub->name}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>กลุ่มอุตสาหกรรม<span class="text-danger">*</span></label>
                                        <select name="industrygroup" data-placeholder="กลุ่มอุตสาหกรรม" class="form-control form-control-select2">
                                            @foreach ($industrygroups as $industrygroup)
                                                <option value="{{$industrygroup->id}}" @if($company->industry_group_id == $industrygroup->id) selected @endif>{{$industrygroup->name}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label>โทรศัพท์<span class="text-danger">*</span></label>
                                        <input type="text"  name="phone" value="{{$company->phone}}"  placeholder="โทรศัพท์" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">   
                                    <div class="form-group">
                                        <label>โทรสาร</label>
                                        <input type="text"  name="fax" value="{{$company->fax}}"  placeholder="โทรสาร" class="form-control form-control-lg">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">   
                                    <div class="form-group">
                                        <label>อีเมล<span class="text-danger">*</span></label>
                                        <input type="text"  name="email" value="{{$company->email}}"  placeholder="อีเมล" class="form-control form-control-lg">
                                    </div>
                                </div> --}}
                                @if (Auth::user()->user_group_id == 1)
                                    <div class="col-md-6">  
                                        <div class="form-group">
                                            <label>อีเมล<span class="text-danger">*</span></label>
                                            <input type="text"  name="email" value="{{$company->email}}"  placeholder="อีเมล" class="form-control form-control-lg">
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-md-6">  
                                        <div class="form-group">
                                            <label>อีเมล<span class="text-danger">*</span></label>
                                            <input type="text"  name="email" value="{{Auth::user()->email}}"  placeholder="อีเมล" class="form-control form-control-lg" readonly>
                                        </div>
                                    </div>
                                @endif

                                @if (Auth::user()->user_group_id == 1)
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>คำนำหน้าผู้ประสานงาน<span class="text-danger">*</span></label>
                                                    <select name="prefix" data-placeholder="คำนำหน้า" class="form-control form-control-select2">
                                                        @foreach ($prefixes as $key => $prefix)
                                                            @if ($key+1 != $prefixes->count())
                                                            <option value="{{$prefix->id}}" @if (Auth::user()->prefix_id == $prefix->id) selected @endif >{{$prefix->name}}</option> 
                                                            @endif
                                                           
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label>ชื่อผู้ประสานงาน</label>
                                                    <input type="text" name="name" value="{{Auth::user()->name}}" data-placeholder="ชื่อ"class="form-control form-control-lg">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>นามสกุลผู้ประสานงาน</label>
                                            <input type="text" name="lastname" value="{{Auth::user()->lastname}}" data-placeholder="นามสกุล" class="form-control form-control-lg">
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>ที่อยู่บริษัท<span class="text-danger">*</span></label>
                                        <input type="text"  name="address" value="{{$company->companyaddress->first()->address}}"  placeholder="ที่อยู่บริษัท" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>จังหวัด<span class="text-danger">*</span></label>
                                        <select name="province" id="province" data-placeholder="จังหวัด" class="form-control form-control-select2">
                                            <option value=""></option>
                                            @foreach ($provinces as $province)
                                                <option value="{{$province->id}}" @if($company->province_id == $province->id) selected @endif>{{$province->name}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>อำเภอ<span class="text-danger">*</span></label>
                                        <select name="amphur" id="amphur" data-placeholder="อำเภอ" class="form-control form-control-select2">
                                            @foreach ($amphurs as $amphur)                                                                
                                                <option value="{{$amphur->id}}" @if ($amphur->id == $company->amphur_id) selected @endif> {{$amphur->name}} </option>
                                            @endforeach   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>ตำบล<span class="text-danger">*</span></label>
                                        <select name="tambol" id="tambol" data-placeholder="ตำบล" class="form-control form-control-select2">
                                            @foreach ($tambols as $tambol)                                                                
                                                <option value="{{$tambol->id}}" @if ($tambol->id == $company->tambol_id) selected @endif> {{$tambol->name}} </option>
                                            @endforeach    
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>รหัสไปรษณีย์<span class="text-danger">*</span></label>
                                        <input type="text"  name="postalcode" value="{{$company->postalcode}}"  placeholder="รหัสไปรษณีย์" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>พิกัดละติจูด (เช่น 14.076868486942407)</label>
                                        <input type="text"  name="lat" value="{{$company->lat}}"  placeholder="ละติจูด" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>พิกัดลองจิจูด (เช่น 100.60153839991285)<a href="https://google.com/maps/place/{{$company->lat}},{{$company->lng}}" target="_blank" rel="noopener noreferrer"> เปิดแผนที่</a> </label>
                                        <input type="text"  name="lng" value="{{$company->lng}}"  placeholder="ลองจิจูด" class="form-control form-control-lg">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>โลโก้ (ขนาด 500x500) px</label>
                                        <div class="input-group">													
                                            <input type="text" id="filename" class="form-control border-right-0" placeholder="โลโก้"  >
                                            <span class="input-group-append">
                                                <button class="btn bg-info" type="button" onclick="document.getElementById('file').click();">อัปโหลดรูป</button>																																						
                                            </span>
                                        </div>
                                        <input type="file" style="display:none;" id="file" name="picture" accept="image/*"/>
                                        @if (!Empty($company->logo))
                                        <br>
                                            <img src="{{asset($company->logo)}}" width="300" height="300" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
   
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">รายชื่อกรรมการ</label>
                                    <a href="#" class="text-primary" data-toggle="modal" data-target="#modal_add_authorized_director">คลิกเพิ่ม</a>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" >
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width:80%">ชื่อ  นามสกุล</th> 
                                                        <th style="width:20%">เพิ่มเติม</th>                                                                                   
                                                    </tr>
                                                </thead>
                                                <tbody id="authorized_director_wrapper_tr"> 
                                                    @foreach ($authorizeddirectors as $authorizeddirector)
                                                    <tr >                                        
                                                        <td> {{$authorizeddirector->prefix->name}}{{$authorizeddirector->name}} {{$authorizeddirector->lastname}}</td>                                            
                                                        <td> 
                                                            <a type="button" data-id="{{$authorizeddirector->id}}" data-name="" class="btn btn-sm bg-danger deleteauthorizeddirector">ลบ</a>                                       
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                     
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">เอกสารแนบ  </label>
                                    <a href="#" id="btnuploadcompanydoc" class="text-primary" data-toggle="modal" data-target="#modal_add_companydoc">คลิกเพิ่ม</a> <small>(หนังสือบริคณห์สนธิ (บอจ.2), สำเนาบัญชีรายชื่อผู้ถือหุ้น (บอจ.5), สำเนารับรองการจดทะเบียนพาณิชย์ หรืออื่นๆ)</small>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" >
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width:80%">ไฟล์</th> 
                                                        <th style="width:20%">เพิ่มเติม</th>                                                                                   
                                                    </tr>
                                                </thead>
                                                <tbody id="fulltbp_companydoc_wrapper_tr"> 
                                                    @foreach ($fulltbpcompanydocs as $fulltbpcompanydoc)
                                                    <tr >                                        
                                                        <td> {{$fulltbpcompanydoc->name}}</td>                                            
                                                        <td> 
                                                            <a href="{{asset($fulltbpcompanydoc->path)}}" class="btn btn-sm bg-primary">ดาวน์โหลด</a>
                                                            <a type="button" data-id="{{$fulltbpcompanydoc->id}}" data-name="" class="btn btn-sm bg-danger deletefulltbpcompanydocattachment">ลบ</a>                                       
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="text-right">
                                <button type="submit" class="btn bg-teal" onclick="confirmsubmit(event,'ข้อมูลกิจการ');">บันทึก <i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            <!-- /striped rows -->
            </div>
        </div>
        <!-- /form layouts -->
        {{-- <div class="loader loader-default" data-text="กำลังบันทึก..."></div> --}}
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')

<script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/locationhelper.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/companyhelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
    <script>
    	var route = {
			url: "{{ url('/') }}",
			token: $('meta[name="csrf-token"]').attr('content'),
        };
        $("#file").on('change', function() {
            $("#filename").val(this.value);
        });
        $('#paidupcapitaldate').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            clearButton: true,
            cancelText: "ยกเลิก",
            okText: "ตกลง",
            clearText: "เคลียร์",
            time: false
        });
    </script>	
@stop
