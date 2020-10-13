@extends('layouts.dashboard.main')
@section('pageCss')

<style>   
    #map {
        height: 100%;
      }
</style>
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">ข้อมูลบริษัท</span></h4>
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
                        <form method="POST" action="{{route('setting.user.company.editsave',['id' => $company->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <fieldset>	
                                        <div class="form-group">
                                            <label>การจดทะเบียน<span class="text-danger">*</span></label>
                                            <select name="businesstype" data-placeholder="ประเภทการจดทะเบียน" class="form-control form-control-select2">
                                                @foreach ($businesstypes as $businesstype)
                                                    @if (Auth::user()->user_group_id == $businesstype->user_group_id)
                                                        <option value="{{$businesstype->id}}" @if($company->registered_capital_type_id == $businesstype->id) selected @endif>{{$businesstype->name}}</option> 
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>ชื่อกิจการ/บริษัท<span class="text-danger">*</span></label>
                                            <input type="text"  name="company" value="{{$company->name}}"  placeholder="ชื่อกิจการ/บริษัท" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>หมายเลขประจำตัวผู้เสียภาษี</label>
                                            <input type="text"  name="vatno" value="{{$company->vatno}}"  placeholder="หมายเลขผู้เสียภาษี" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>ประเภทอุตสาหกรรม<span class="text-danger">*</span></label>
                                            <select name="industrygroup" data-placeholder="กลุ่มธุรกิจ" class="form-control form-control-select2">
                                                @foreach ($industrygroups as $industrygroup)
                                                    <option value="{{$industrygroup->id}}" @if($company->industry_group_id == $industrygroup->id) selected @endif>{{$industrygroup->name}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">	
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>หมวดหมู่หลัก ISIC<span class="text-danger">*</span></label>
                                                    <select name="isic" id="isic" data-placeholder="หมวดหมู่หลัก ISIC" class="form-control form-control-select2">
                                                        @foreach ($isics as $isic)
                                                            <option value="{{$isic->id}}" @if($company->isic_id == $isic->id) selected @endif>{{$isic->name}}</option> 
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                
                                            <div class="form-group">
                                                <label>หมวดหมู่ย่อย ISIC<span class="text-danger">*</span></label>
                                                <select name="subisic" id="subisic" data-placeholder="หมวดหมู่ย่อย ISIC" class="form-control form-control-select2">
                                                    @foreach ($isicsubs as $isicsub)
                                                        <option value="{{$isicsub->id}}" @if($company->isic_sub_id == $isicsub->id) selected @endif>{{$isicsub->name}}</option> 
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>ประเภททุนจดทะเบียน<span class="text-danger">*</span></label>
                                            <select name="registeredcapitaltype" data-placeholder="ประเภททุนจดทะเบียน" class="form-control form-control-select2">
                                                @foreach ($registeredcapitaltypes as $registeredcapitaltype)
                                                    <option value="{{$registeredcapitaltype->id}}" @if($company->business_type_id == $registeredcapitaltype->id) selected @endif>{{$registeredcapitaltype->name}}: {{$registeredcapitaltype->detail}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>ปีที่จดทะเบียน</label>
                                            <input type="number" name="registeredyear" value="{{$registeredyear}}"  placeholder="ปีที่จดทะเบียน" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>ทุนจดทะเบียน</label>
                                            <input type="number"  name="registeredcapital" value="{{$company->registeredcapital}}"  placeholder="ทุนจดทะเบียน" class="form-control" >
                                        </div>
                                        <div class="row">	
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>ทุนจดทะเบียนที่เรียกชำระแล้ว</label>
                                                    <input type="number"  name="paidupcapital" value="{{$company->paidupcapital}}"  placeholder="ทุนจดทะเบียนที่เรียกชำระแล้ว" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>เมื่อวันที่</label>
                                                    <input type="text"  name="paidupcapitaldate" id="paidupcapitaldate" value="{{$company->paidupcapitaldateth}}"  placeholder="เมื่อวันที่" class="form-control" >
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label>โทรศัพท์<span class="text-danger">*</span></label>
                                            <input type="text"  name="phone" value="{{$company->phone}}"  placeholder="โทรศัพท์" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>แฟ็กซ์<span class="text-danger">*</span></label>
                                            <input type="text"  name="fax" value="{{$company->fax}}"  placeholder="แฟ็กซ์" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>อีเมล<span class="text-danger">*</span></label>
                                            <input type="text"  name="email" value="{{$company->email}}"  placeholder="อีเมล" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <ul class="nav nav-tabs nav-tabs-highlight">
                                                <li class="nav-item"><a href="#left-icon-company" class="nav-link active" data-toggle="tab"><i class="icon-home2 mr-2"></i> ที่อยู่บริษัท</a></li>
                                                <li class="nav-item"><a href="#left-icon-factory" class="nav-link" data-toggle="tab"><i class="icon-office mr-2"></i> ที่อยู่โรงงาน</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="left-icon-company">
                                                    <div class="form-group">
                                                        <label>ที่อยู่<span class="text-danger">*</span></label>
                                                        <input type="text"  name="address" value="{{$company->address}}"  placeholder="ที่อยู่" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>จังหวัด<span class="text-danger">*</span></label>
                                                        <select name="province" id="province" data-placeholder="จังหวัด" class="form-control form-control-select2">
                                                            <option value=""></option>
                                                            @foreach ($provinces as $province)
                                                                <option value="{{$province->id}}" @if($company->province_id == $province->id) selected @endif>{{$province->name}}</option> 
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>อำเภอ<span class="text-danger">*</span></label>
                                                        <select name="amphur" id="amphur" data-placeholder="อำเภอ" class="form-control form-control-select2">
                                                            @foreach ($amphurs as $amphur)                                                                
                                                                <option value="{{$amphur->id}}" @if ($amphur->id == $company->amphur_id) selected @endif> {{$amphur->name}} </option>
                                                            @endforeach   
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ตำบล<span class="text-danger">*</span></label>
                                                        <select name="tambol" id="tambol" data-placeholder="ตำบล" class="form-control form-control-select2">
                                                            @foreach ($tambols as $tambol)                                                                
                                                                <option value="{{$tambol->id}}" @if ($tambol->id == $company->tambol_id) selected @endif> {{$tambol->name}} </option>
                                                            @endforeach    
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>รหัสไปรษณีย์<span class="text-danger">*</span></label>
                                                        <input type="text"  name="postalcode" value="{{$company->postalcode}}"  placeholder="รหัสไปรษณีย์" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ละติจูด<span class="text-danger">*</span></label>
                                                        <input type="text"  name="lat" value="{{$company->lat}}"  placeholder="ละติจูด" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ลองติจูด<span class="text-danger">*</span> <a href="https://google.com/maps/place/{{$company->lat}},{{$company->lng}}" target="_blank" rel="noopener noreferrer">เปิดแผนที่</a> </label>
                                                        <input type="text"  name="lng" value="{{$company->lng}}"  placeholder="ลองติจูด" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="left-icon-factory">
                                                    <div class="form-group">
                                                        <label>ที่อยู่<span class="text-danger">*</span></label>
                                                        <input type="text"  name="factoryaddress" value="{{$company->factoryaddress}}"  placeholder="ที่อยู่" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>จังหวัด<span class="text-danger">*</span></label>
                                                        <select name="factoryprovince" id="factoryprovince" data-placeholder="จังหวัด" class="form-control form-control-select2">
                                                            <option value=""></option>
                                                            @foreach ($provinces as $province)
                                                                <option value="{{$province->id}}" @if($company->factoryprovince_id == $province->id) selected @endif>{{$province->name}}</option> 
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>อำเภอ<span class="text-danger">*</span></label>
                                                        <select name="factoryamphur" id="factoryamphur" data-placeholder="อำเภอ" class="form-control form-control-select2">
                                                            @foreach ($amphurs as $amphur)                                                                
                                                                <option value="{{$amphur->id}}" @if ($amphur->id == $company->factoryamphur_id) selected @endif> {{$amphur->name}} </option>
                                                            @endforeach   
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ตำบล<span class="text-danger">*</span></label>
                                                        <select name="factorytambol" id="factorytambol" data-placeholder="ตำบล" class="form-control form-control-select2">
                                                            @foreach ($tambols as $tambol)                                                                
                                                                <option value="{{$tambol->id}}" @if ($tambol->id == $company->factorytambol_id) selected @endif> {{$tambol->name}} </option>
                                                            @endforeach    
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>รหัสไปรษณีย์<span class="text-danger">*</span></label>
                                                        <input type="text"  name="factorypostalcode" value="{{$company->factorypostalcode}}"  placeholder="รหัสไปรษณีย์" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ละติจูด<span class="text-danger">*</span></label>
                                                        <input type="text"  name="factorylat" value="{{$company->factorylat}}"  placeholder="ละติจูด" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ลองติจูด<span class="text-danger">*</span> <a href="https://google.com/maps/place/{{$company->factorylat}},{{$company->factorylng}}" target="_blank" rel="noopener noreferrer">เปิดแผนที่</a> </label>
                                                        <input type="text"  name="factorylng" value="{{$company->factorylng}}"  placeholder="ลองติจูด" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label>โลโก้ (ขนาด 500x500) px</label>
                                            <div class="input-group">													
                                                <input type="text" id="filename" class="form-control border-right-0" placeholder="โลโก้" >
                                                <span class="input-group-append">
                                                    <button class="btn bg-info" type="button" onclick="document.getElementById('file').click();">อัพโหลดรูป</button>													
                                                </span>
                                            </div>
                                            <input type="file" style="display:none;" id="file" name="picture"/>
                                            @if (!Empty($company->logo))
                                            <br>
                                                <img src="{{asset($company->logo)}}" width="300" height="300" alt="">
                                            @endif
                                        </div>
                                       
                                    </fieldset>
                                </div>
                            </div>
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
