@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">แก้ไขตำแหน่งผู้เชี่ยวชาญ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> ทั่วไป</a>
                    <a href="{{route('setting.admin.dashboard.expertposition')}}" class="breadcrumb-item"> ตำแหน่งผู้เชี่ยวชาญ</a>
                    <span class="breadcrumb-item active">แก้ไขตำแหน่งผู้เชี่ยวชาญ</span>
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
                        <form method="POST" action="{{route('setting.admin.dashboard.expertposition.editsave',['id' => $expertposition->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">	
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>lineclint <a href="https://notify-bot.line.me/en/" target="_blank">ลิงก์</a></label>
                                                <input type="text" name="lineclint" value="{{$generalinfo->client_id}}" data-placeholder="lineclint" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>linesecret</label>
                                                <input type="text" name="linesecret" value="{{$generalinfo->client_secret}}" data-placeholder="linesecret" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>thaisms (sms คงเหลือ <span class="text-success">{{$smscredit}}</span> )</label>
                                                <input type="text" name="thaisms" value="{{$generalinfo->thsmsuser}}" data-placeholder="thaisms" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>รหัสผ่าน thaisms</label>
                                                <input type="password" name="thaismspassword" value="" data-placeholder="รหัสผ่าน thaisms" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>การ verify ผู้สมัคร<span class="text-danger">*</span></label>
                                                <select name="verifyuser" id="verifyuser" data-placeholder="อำเภอ" class="form-control form-control-select2">
                                                    @foreach ($verifystatuses as $verifystatus)                                                                
                                                        <option value="{{$verifystatus->id}}" @if ($generalinfo->verify_type_id == $verifystatus->id) selected @endif> {{$verifystatus->name}} </option>
                                                    @endforeach   
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>เวลาทำการ จันทร์-ศุกร์</label>
                                                <input type="text" name="workdaytime" value="{{$generalinfo->workdaytime}}" data-placeholder="เวลาทำการ จันทร์-ศุกร์" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>เวลาทำการ วันเสาร์</label>
                                                <input type="text" name="saturdaytime" value="{{$generalinfo->saturdaytime}}" data-placeholder="เวลาทำการ วันเสาร์" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>เวลาทำการ วันอาทิตย์</label>
                                                <input type="text" name="sundaytime" value="{{$generalinfo->sundaytime}}" data-placeholder="เวลาทำการ วันอาทิตย์" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Youtube</label>
                                                <input type="text" name="youtube" value="{{$generalinfo->youtube}}" data-placeholder="Youtube" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Facebook</label>
                                                <input type="text" name="facebook" value="{{$generalinfo->facebook}}" data-placeholder="Facebook" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Front page<span class="text-danger">*</span></label>
                                                <select name="frontpage" data-placeholder="Front page" class="form-control form-control-select2">
                                                    @foreach ($frontpagestatuses as $frontpagestatus)                                                                
                                                        <option value="{{$frontpagestatus->id}}" @if ($generalinfo->front_page_status_id == $frontpagestatus->id) selected @endif> {{$frontpagestatus->name}} </option>
                                                    @endforeach   
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Social login</label>
                                                <select name="sociallogin" data-placeholder="Social login" class="form-control form-control-select2">
                                                    @foreach ($socialloginstatuses as $socialloginstatus)                                                                
                                                        <option value="{{$socialloginstatus->id}}" @if ($generalinfo->social_login_status == $socialloginstatus->id) selected @endif> {{$socialloginstatus->name}} </option>
                                                    @endforeach   
                                                </select>
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
@stop
