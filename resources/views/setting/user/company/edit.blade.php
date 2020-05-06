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
                        <form method="POST" action="{{route('setting.user.company.editsave',['id' => $company->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <fieldset>	
                                        <div class="form-group">
                                            <label>บริษัท</label>
                                            <input type="text"  name="company" value="{{$company->name}}"  placeholder="บริษัท" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>ประเภทธุรกิจ<span class="text-danger">*</span></label>
                                            <select name="businesstype" data-placeholder="ประเภทธุรกิจ" class="form-control form-control-select2">
                                                <option value=""></option>
                                                    @foreach ($businesstypes as $businesstype)
                                                        <option value="{{$businesstype->id}}" @if($company->registered_capital_type_id == $businesstype->id) selected @endif>{{$businesstype->name}}</option> 
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>กลุ่มธุรกิจ<span class="text-danger">*</span></label>
                                            <select name="industrygroup" data-placeholder="กลุ่มธุรกิจ" class="form-control form-control-select2">
                                                <option value=""></option>
                                                    @foreach ($industrygroups as $industrygroup)
                                                        <option value="{{$industrygroup->id}}" @if($company->industry_group_id == $industrygroup->id) selected @endif>{{$industrygroup->name}}</option> 
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>ประเภทการจดทะเบียน<span class="text-danger">*</span></label>
                                            <select name="registeredcapitaltype" data-placeholder="ประเภทการจดทะเบียน" class="form-control form-control-select2">
                                                <option value=""></option>
                                                    @foreach ($registeredcapitaltypes as $registeredcapitaltype)
                                                        <option value="{{$registeredcapitaltype->id}}" @if($company->business_type_id == $registeredcapitaltype->id) selected @endif>{{$registeredcapitaltype->name}}</option> 
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>โทรศัพท์</label>
                                            <input type="text"  name="phone" value="{{$company->phone}}"  placeholder="โทรศัพท์" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>แฟ็กซ์</label>
                                            <input type="text"  name="fax" value="{{$company->fax}}"  placeholder="แฟ็กซ์" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>อีเมล์</label>
                                            <input type="text"  name="email" value="{{$company->email}}"  placeholder="อีเมล์" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>ที่อยู่</label>
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
                                            <label>รหัสไปรษณีย์</label>
                                            <input type="text"  name="postalcode" value="{{$company->postalcode}}"  placeholder="โทรศัพท์" class="form-control">
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
<script type="module" src="{{asset('assets/dashboard/js/app/helper/companyhelper.js')}}"></script>
    <script>
    		var route = {
			url: "{{ url('/') }}",
			token: $('meta[name="csrf-token"]').attr('content'),
        };
    </script>	
@stop
