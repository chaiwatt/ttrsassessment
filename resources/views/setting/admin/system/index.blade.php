@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/plugins/summernote/summernote.min.css')}}" rel="stylesheet">
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">ตั้งค่าระบบ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> ตั้งค่าระบบ</a>
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
                                        <label>สำนักงาน</label>
                                        <input type="text" name="organizationname" value="{{$generalinfo->company}}" data-placeholder="สำนักงาน"class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ที่อยู่</label>
                                        <input type="text" name="organizationaddress" value="{{$generalinfo->address}}" data-placeholder="คำนำหน้า" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>จังหวัด<span class="text-danger">*</span></label>
                                        <select name="organizationprovince" id="province" data-placeholder="จังหวัด" class="form-control form-control-select2">
                                            <option value=""></option>
                                            @foreach ($provinces as $province)
                                                <option value="{{$province->id}}" @if($generalinfo->province_id == $province->id) selected @endif>{{$province->name}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>อำเภอ<span class="text-danger">*</span></label>
                                        <select name="organizationamphur" id="amphur" data-placeholder="อำเภอ" class="form-control form-control-select2">
                                            @foreach ($amphurs as $amphur)                                                                
                                                <option value="{{$amphur->id}}" @if ($amphur->id == $generalinfo->amphur_id) selected @endif> {{$amphur->name}} </option>
                                            @endforeach   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ตำบล<span class="text-danger">*</span></label>
                                        <select name="organizationtambol" id="tambol" data-placeholder="ตำบล" class="form-control form-control-select2">
                                            @foreach ($tambols as $tambol)                                                                
                                                <option value="{{$tambol->id}}" @if ($tambol->id == $generalinfo->tambol_id) selected @endif> {{$tambol->name}} </option>
                                            @endforeach    
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>รหัสไปรษณีย์</label>
                                        <input type="text" name="organizationpostalcode" value="{{$generalinfo->postalcode}}" data-placeholder="รหัสไปรษณีย์" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>โทรศัพท์1</label>
                                        <input type="text" name="phone1" value="{{$generalinfo->phone1}}" data-placeholder="อีเมล" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>โทรศัพท์2</label>
                                        <input type="text" name="phone2" value="{{$generalinfo->phone2}}" data-placeholder="โทรศัพท์2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>โทรสาร</label>
                                        <input type="text" name="organizationfax" value="{{$generalinfo->fax}}" data-placeholder="แฟ๊กซ์" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>อีเมล</label>
                                        <input type="email" name="organizationemail" value="{{$generalinfo->email}}" data-placeholder="อีเมล" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>เวลาทำการ</label>
                                        <input type="text" name="workdaytime" value="{{$generalinfo->workdaytime}}" data-placeholder="เวลาทำการ วันอาทิตย์" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>เวลาทำการ วันอาทิตย์</label>
                                        <input type="text" name="sundaytime" value="{{$generalinfo->sundaytime}}" data-placeholder="เวลาทำการ วันอาทิตย์" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Youtube</label>
                                        <input type="text" name="youtube" value="{{$generalinfo->youtube}}" data-placeholder="Youtube" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <input type="text" name="facebook" value="{{$generalinfo->facebook}}" data-placeholder="Facebook" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Twitter</label>
                                        <input type="text" name="twitter" value="{{$generalinfo->twitter}}" data-placeholder="Twitter" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Instagram</label>
                                        <input type="text" name="instagram" value="{{$generalinfo->instagram}}" data-placeholder="Instagram" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Skype</label>
                                        <input type="text" name="skype" value="{{$generalinfo->skype}}" data-placeholder="Skype" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Linkedin</label>
                                        <input type="text" name="linkedin" value="{{$generalinfo->linkedin}}" data-placeholder="Linkedin" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Front page</label>
                                        <select name="frontpage" data-placeholder="Front page" class="form-control form-control-select2">
                                            @foreach ($frontpagestatuses as $frontpagestatus)                                                                
                                                <option value="{{$frontpagestatus->id}}" @if ($generalinfo->front_page_status_id == $frontpagestatus->id) selected @endif> {{$frontpagestatus->name}} </option>
                                            @endforeach   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ผู้อำนวยการ/ผู้มีอำนาจลงนาม</label>
                                        <input type="text" name="director" value="{{$generalinfo->director}}" data-placeholder="Facebook" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Consent</label></span>
                                        <textarea name="consent" id="consent" class="form-control" cols="3" rows="15">{!!$generalinfo->consent!!}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>โลโก้ 274x99 px</label>
                                        <div class="input-group">													
                                            <input type="text" id="filename" class="form-control border-right-0" placeholder="โลโก้"  >											
                                                <span class="input-group-append">
                                                    <button class="btn bg-info" type="button" onclick="document.getElementById('file').click();">อัปโหลด</button>
                                                </span>
                                        </div>
                                        <input type="file" style="display:none;" id="file" name="picture"/>
                                        @if (!Empty($generalinfo->logo))
                                        <br>
                                            <img src="{{asset($generalinfo->logo)}}" width="274" height="99" alt="">
                                        @endif
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
<script src="{{asset('assets/dashboard/plugins/summernote/summernote.min.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/locationhelper.js')}}"></script>
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
		});
</script>
@stop
