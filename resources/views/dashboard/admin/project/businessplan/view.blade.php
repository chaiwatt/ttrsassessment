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
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <div class="form-check ">
                        <i class="icon-spinner spinner mr-2" id="spinicon" hidden></i><input type="checkbox" id="chkassessment" data-id="{{$company->id}}" data-on-color="success" data-off-color="danger" data-on-text="ให้ประเมิน" data-off-text="ไม่ให้ประเมิน" class="form-check-input-switch" @if ($company->businessplan->business_plan_status_id != 1 ) checked @endif >
                    </div>
                </div>
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
                        <div class="row">	
                            <div class="col-md-12">
                                <fieldset>	
                                    <div class="form-group">
                                        <label>การจดทะเบียน<span class="text-danger">*</span></label>
                                        <select name="businesstype" data-placeholder="การจดทะเบียน" class="form-control form-control-select2" disabled>
                                            <option value=""></option>
                                                @foreach ($businesstypes as $businesstype)
                                                    <option value="{{$businesstype->id}}" @if($company->business_type_id == $businesstype->id) selected @endif >{{$businesstype->name}}</option> 
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>ชื่อกิจการ/บริษัท</label>
                                        <input type="text"  name="company" value="{{$company->name}}"  placeholder="ชื่อกิจการ/บริษัท" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>หมายเลขประจำตัวผู้เสียภาษี</label>
                                        <input type="text"  name="vatno" value="{{$company->vatno}}"  placeholder="หมายเลขผู้เสียภาษี" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>กลุ่มธุรกิจ<span class="text-danger">*</span></label>
                                        <select name="industrygroup" data-placeholder="กลุ่มธุรกิจ" class="form-control form-control-select2" disabled>
                                            <option value=""></option>
                                                @foreach ($industrygroups as $industrygroup)
                                                    <option value="{{$industrygroup->id}}" @if($company->industry_group_id == $industrygroup->id) selected @endif >{{$industrygroup->name}}</option> 
                                                @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>ประเภททุนจดทะเบียน<span class="text-danger">*</span></label>
                                        <select name="registeredcapitaltype" data-placeholder="ประเภททุนจดทะเบียน" class="form-control form-control-select2" disabled>
                                            <option value=""></option>
                                                @foreach ($registeredcapitaltypes as $registeredcapitaltype)
                                                    <option value="{{$registeredcapitaltype->id}}" @if($company->business_type_id == $registeredcapitaltype->id) selected @endif>{{$registeredcapitaltype->name}}: {{$registeredcapitaltype->detail}}</option> 
                                                @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="form-group">
                                        <label>โทรศัพท์<span class="text-danger">*</span></label>
                                        <input type="text"  name="phone" value="{{$company->phone}}"  placeholder="โทรศัพท์" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>แฟ็กซ์<span class="text-danger">*</span></label>
                                        <input type="text"  name="fax" value="{{$company->fax}}"  placeholder="แฟ็กซ์" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>อีเมล<span class="text-danger">*</span></label>
                                        <input type="text"  name="email" value="{{$company->email}}"  placeholder="อีเมล" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>ที่อยู่<span class="text-danger">*</span></label>
                                        <input type="text"  name="address" value="{{$company->companyaddress->first()->address}}"  placeholder="ที่อยู่" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>จังหวัด<span class="text-danger">*</span></label>
                                        <select name="province" id="province" data-placeholder="จังหวัด" class="form-control form-control-select2" disabled>
                                            <option value=""></option>
                                            @foreach ($provinces as $province)
                                                <option value="{{$province->id}}" @if($company->province_id == $province->id) selected @endif >{{$province->name}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>อำเภอ<span class="text-danger">*</span></label>
                                        <select name="amphur" id="amphur" data-placeholder="อำเภอ" class="form-control form-control-select2" disabled>
                                            @foreach ($amphurs as $amphur)                                                                
                                                <option value="{{$amphur->id}}" @if ($amphur->id == $company->amphur_id) selected @endif > {{$amphur->name}} </option>
                                            @endforeach   
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>ตำบล<span class="text-danger">*</span></label>
                                        <select name="tambol" id="tambol" data-placeholder="ตำบล" class="form-control form-control-select2" disabled>
                                            @foreach ($tambols as $tambol)                                                                
                                                <option value="{{$tambol->id}}" @if ($tambol->id == $company->tambol_id) selected @endif > {{$tambol->name}} </option>
                                            @endforeach    
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>รหัสไปรษณีย์<span class="text-danger">*</span></label>
                                        <input type="text"  name="postalcode" value="{{$company->postalcode}}"  placeholder="รหัสไปรษณีย์" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>ละติจูด<span class="text-danger">*</span></label>
                                        <input type="text"  name="lat" value="{{$company->lat}}"  placeholder="ละติจูด" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>ลองติจูด<span class="text-danger">*</span> <a href="https://google.com/maps/place/{{$company->lat}},{{$company->lng}}" target="_blank" rel="noopener noreferrer" >เปิดแผนที่</a> </label>
                                        <input type="text"  name="lng" value="{{$company->lng}}"  placeholder="ลองติจูด" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        @if (!Empty($company->logo))
                                        <br>
                                            <img src="{{asset($company->logo)}}" width="300" height="300" alt="">
                                        @endif
                                    </div>

                                </fieldset>
                            </div>
                        </div>
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
<script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script>
    var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content'),
    };

    $('#chkassessment').on('change.bootstrapSwitch', function(e) {
        var status = 0
        $("#spinicon").attr("hidden",false);
        if(e.target.checked==true){
            status =1;
        }        
        updateBusinessPlanStatus("{{$company->businessplan->id}}",status).then(data => {
               $("#spinicon").attr("hidden",true);
            })
            .catch(error => {})
    });

    function updateBusinessPlanStatus(id,status){
        return new Promise((resolve, reject) => {
            $.ajax({
            url: `${route.url}/api/businessplan/status/update`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
                id : id,
                status : status
            },
            success: function(data) {
                resolve(data)
            },
            error: function(error) {
                reject(error)
            },
            })
      })
}
</script>
@stop
