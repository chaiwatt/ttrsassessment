@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">แก้ไขผู้ใช้งานระบบ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ผู้ใช้งาน</a>
                    <a href="{{route('setting.admin.user')}}" class="breadcrumb-item"> ผู้ใช้งานระบบ</a>
                    <span class="breadcrumb-item active">แก้ไขผู้ใช้งานระบบ</span>
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
                        <form method="POST" action="{{route('setting.admin.user.editsave',['id' => $user->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <fieldset>	
                                        <div class="form-group">
                                            <label>คำนำหน้า<span class="text-danger">*</span></label>
                                            <select name="prefix" data-placeholder="คำนำหน้า" class="form-control form-control-select2">
                                                @foreach ($prefixes as $prefix)
                                                    <option value="{{$prefix->id}}" @if($user->prefix_id == $prefix->id) selected @endif>{{$prefix->name}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>ชื่อ<span class="text-danger">*</span></label>
                                            <input type="text"  name="name" value="{{$user->name}}"  placeholder="ชื่อ" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>นามสกุล<span class="text-danger">*</span></label>
                                            <input type="text"  name="lastname" value="{{$user->lastname}}"  placeholder="นามสกุล" class="form-control form-control-lg">
                                        </div>

                                        <div class="form-group">
                                            <label>กลุ่มผู้ใช้งาน<span class="text-danger">*</span></label>
                                            <select name="usertype" id="usertype" data-placeholder="กลุ่มผู้ใช้งาน" class="form-control form-control-select2" >
                                                @foreach ($usertypes as $usertype)
                                                    <option value="{{$usertype->id}}" @if($user->user_type_id == $usertype->id) selected @endif>{{$usertype->name}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group" id="experttype_wrapper" hidden>
                                            <label>ประเภทผู้เชี่ยวชาญ</label>
                                            <select name="experttype" id="experttype" data-placeholder="กลุ่มผู้ใช้งาน" class="form-control form-control-select2" >
                                                <option value="1" >ผู้เชี่ยวชาญภายใน</option> 
                                                <option value="2" >ผู้เชี่ยวชาญภายนอก</option> 
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>อีเมล<span class="text-danger">*</span></label>
                                            <input type="text"  name="email" value="{{$user->email}}"  placeholder="อีเมล" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>รหัสผ่าน<span class="text-danger">*</span></label>
                                            <input type="password"  name="password" value="{{old('password')}}"  placeholder="รหัสผ่าน" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>สถานะการใช้งาน<span class="text-danger">*</span></label>
                                            <select name="userstatus" data-placeholder="สถานะการใช้งาน" class="form-control form-control-select2" >
                                                @foreach ($userstatuses as $userstatus)
                                                    <option value="{{$userstatus->id}}" @if($user->user_status_id == $userstatus->id) selected @endif>{{$userstatus->name}}</option> 
                                                @endforeach
                                            </select>
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
	<script>
        $(document).on('change', '#usertype', function(e) {
            if($(this).val() == 3){
                console.log('expert');
                $("#experttype_wrapper").attr("hidden",false);
            }else{
                $("#experttype_wrapper").attr("hidden",true);
            }
        });
    </script>
@stop
