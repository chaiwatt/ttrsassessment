@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">ผลการดำเนินงาน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <a href="#" class="breadcrumb-item"> หน้าแรก (Homepage)</a>
                    <span class="breadcrumb-item active">ผลการดำเนินงาน</span>
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
                        <form method="POST" action="{{route('setting.admin.website.homepage.industryugroup.editsave',['id' => $homepageindustrygroup->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <fieldset>	
                                        <div class="form-group">
                                            <label>ข้อความที่ 1 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="titleth" value="{{$homepageindustrygroup->titleth}}"  placeholder="ข้อความที่ 1 (ภาษาไทย)" class="form-control form-control-lg stringformat30" >
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่ 1 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="titleeng" value="{{$homepageindustrygroup->titleeng}}"  placeholder="ข้อความที่ 1 (ภาษาอังกฤษ)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่ 2 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="subtitleth" value="{{$homepageindustrygroup->subtitleth}}"  placeholder="ข้อความที่ 2 (ภาษาไทย)" class="form-control form-control-lg stringformat200">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่2 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="subtitleeng" value="{{$homepageindustrygroup->subtitleeng}}"  placeholder="ข้อความที่ 2 (ภาษาอังกฤษ)" class="form-control form-control-lg stringformat200">
                                        </div>
                                        {{-- <div class="form-group">
                                            <label>ลิงก์</label>
                                            <input type="text"  name="url" value="{{$homepageindustrygroup->url}}"  placeholder="ลิงก์" class="form-control form-control-lg stringformat100">
                                        </div> --}}
										<div class="form-group">
											<label>รูป<span class="text-danger">*</span></label>
											<div class="input-group">													
												<input type="text" id="filename" class="form-control border-right-0" placeholder="รูป" disabled>
												<span class="input-group-append">
													<button class="btn bg-info" type="button" onclick="document.getElementById('file').click();">อัปโหลดรูป</button>													
												</span>
											</div>
											<input type="file" style="display:none;" id="file" name="picture" accept="image/*"/>
                                            <div class="row mt-4" >	
                                                <div class="col-md-12">
                                                    <img class="img-responsive" src="{{asset($homepageindustrygroup->picture)}}" style="width:500px;width:500px" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-md-2 mt-3">
                                            <div class="form-check form-check-inline">
                                                @php
                                                    $check = 'checked';
                                                    if(!Empty($homepageindustryurl)  && $homepageindustryurl->url_type == 1){
                                                        $check = '';
                                                    }
                                                @endphp
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input-styled selectlink" name="selectlink" value="0" {{$check}} data-fouc>
                                                    ลิงก์ (เช่น https://google.com)
                                                </label>
                                            </div>
            
                                            @php
                                                $check1 = 'checked';
                                                if(Empty($homepageindustryurl)  || $homepageindustryurl->url_type == 0){
                                                    $check1 = '';
                                                }
                                            @endphp
            
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input-styled selectlink" name="selectlink" {{$check1}} data-fouc>
                                                    หน้าเพจ&nbsp;<a href="#" data-toggle="modal" id="editpage"> <i class="icon-pencil5 text-info"></i></a>
                                                </label>
                                            </div>
                                        </div>
                                        @if (Empty($homepageindustryurl))
                                            <input type="text" id="linktype" name="linktype" value="0" hidden>
                                        @else
                                            <input type="text" id="linktype" name="linktype" value="{{@$homepageindustryurl->url_type}}" hidden>
                                        @endif
            
            
                                        <div class="form-group" style="margin-top:-20px" id="linksource" @if (!Empty($homepageindustryurl) && $homepageindustryurl->url_type == 1) hidden @endif>
                                            <input type="text" name="link" value="{{@$homepageindustryurl->url}}"  placeholder="เช่น https://www.google.co.th" class="form-control form-control-lg stringformat100">
                                        </div>
            
                                        <div class="form-group" style="margin-top:-20px" id="linksourceinternal"
                                            @if (Empty($homepageindustryurl))
                                                    hidden
                                                @else
                                                    @if ($homepageindustryurl->url_type == 0)
                                                        hidden
                                                    @endif
                                            @endif
                                        >
                                            <div class="form-group">
                                                @php
                                                    $lasttext = substr(@$homepageindustryurl->url, strrpos(@$homepageindustryurl->url, '/' )+1)
                                                @endphp
                                                <select id="page" name="page" data-placeholder="หน้าเพจ" class="form-control form-control-lg form-control-select2">
                                                    @foreach ($pages as $page)
                                                        <option value="{{$page->id}}"
                                                            @if ($lasttext == $page->name)
                                                                selected
                                                            @endif
                                                            >{{$page->name}}</option> 
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>สถานะการแสดงหน้าแรก</label>
                                            <select name="status" id="status" placeholder="สถานะการแสดง" class="form-control form-control-select2">
                                                    <option value="0" @if ($homepagesection->show == 0) selected @endif >ซ่อน</option>
                                                    <option value="1" @if ($homepagesection->show == 1) selected @endif >แสดง</option>
                                            </select>
                                        </div>
                            
                                        <br>
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
<script src="{{asset('assets/dashboard/js/app/helper/inputformat.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
    <script type="text/javascript">
        $("#file").on('change', function() {
            $("#filename").val(this.value);
        });

        $(document).on('change', '.selectlink', function(e) {
            if($("input[name='selectlink']:checked").val()=='0'){
                $("#linksourceinternal").attr("hidden",true);
                $("#linksource").attr("hidden",false);
                $('#linktype').val(0);
            }else{
                $("#linksourceinternal").attr("hidden",false);
                $("#linksource").attr("hidden",true);
                $('#linktype').val(1);
            }
        });
        $(document).on('click', '#editpage', function(e) {
            if($("input[name='selectlink']:checked").val() != '0'){
                window.location.replace(route.url +'/setting/admin/website/webpage/edit/' + $('select[name=page] option').filter(':selected').val());
            }
        });
    </script>
@stop
