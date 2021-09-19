@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">แนะนำบริการ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <a href="#" class="breadcrumb-item"> หน้าแรก (Homepage)</a>
                    <span class="breadcrumb-item active">แนะนำบริการ</span>
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
                        <form method="POST" action="{{route('setting.admin.website.homepage.pillar.editsave',['id' => $homepagepillar->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <fieldset>	
                                        <div class="form-group">
                                            <label>ข้อความที่ 1 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="textth1" value="{{$homepagepillar->textth1}}"  placeholder="ข้อความที่ 1 (ภาษาไทย)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่ 1 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="texteng1" value="{{$homepagepillar->texteng1}}"  placeholder="ข้อความที่ 1 (ภาษาอังกฤษ)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่ 2 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="textth2" value="{{$homepagepillar->textth2}}"  placeholder="ข้อความที่ 2 (ภาษาไทย)" class="form-control form-control-lg stringformat300">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่2 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="texteng2" value="{{$homepagepillar->texteng2}}"  placeholder="ข้อความที่2 (ภาษาอังกฤษ)" class="form-control form-control-lg stringformat300">
                                        </div>

                                        <div class="form-group">
                                            <label>Title Pillar1 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillartitleth1" value="{{$homepagepillar->pillartitleth1}}"  placeholder="Title Pillar1 (ภาษาไทย)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group">
                                            <label>Title Pillar1 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillartitleeng1" value="{{$homepagepillar->pillartitleeng1}}"  placeholder="Title Pillar1 (ภาษาอังกฤษ)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group">
                                            <label>สีพื้น Title Pillar1<span class="text-danger">*</span> </label>
                                            <input type="text"  name="color1" value="{{$homepagepillar->color1}}"  placeholder="สีพื้น Title Pillar1" class="form-control form-control-lg stringformat200">
                                            <code>default: background-image: linear-gradient(180deg, #dd4c23 0%, #f27c1e 100%);</code>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label>Description Pillar1 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillardescth1" value="{{$homepagepillar->pillardescth1}}"  placeholder="Description Pillar1 (ภาษาไทย)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group" hidden>
                                            <label>Description Pillar1 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillardesceng1" value="{{$homepagepillar->pillardesceng1}}"  placeholder="Description Pillar1 (ภาษาอังกฤษ)" class="form-control form-control-lg stringformat30">
                                        </div>

                                        <div class="form-group">
                                            <label>Title Pillar2 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillartitleth2" value="{{$homepagepillar->pillartitleth2}}"  placeholder="Title Pillar2 (ภาษาไทย)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group">
                                            <label>Title Pillar2 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillartitleeng2" value="{{$homepagepillar->pillartitleeng2}}"  placeholder="Title Pillar2 (ภาษาอังกฤษ)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group">
                                            <label>สีพื้น Title Pillar2<span class="text-danger">*</span></label>
                                            <input type="text"  name="color2" value="{{$homepagepillar->color2}}"  placeholder="สีพื้น Title Pillar2" class="form-control form-control-lg stringformat200">
                                            <code>default: background-image: linear-gradient(90deg, #a040f3 41%, #a86ae3 100%);</code>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label>Description Pillar2 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillardescth2" value="{{$homepagepillar->pillardescth2}}"  placeholder="Description Pillar2 (ภาษาไทย)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group" hidden>
                                            <label>Description Pillar2 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillardesceng2" value="{{$homepagepillar->pillardesceng2}}"  placeholder="Description Pillar2 (ภาษาอังกฤษ)" class="form-control form-control-lg stringformat30">
                                        </div>

                                        <div class="form-group">
                                            <label>Title Pillar3 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillartitleth3" value="{{$homepagepillar->pillartitleth3}}"  placeholder="Title Pillar3 (ภาษาไทย)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group">
                                            <label>Title Pillar3 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillartitleeng3" value="{{$homepagepillar->pillartitleeng3}}"  placeholder="Title Pillar3 (ภาษาอังกฤษ)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group">
                                            <label>สีพื้น Title Pillar3<span class="text-danger">*</span></label>
                                            <input type="text"  name="color3" value="{{$homepagepillar->color3}}"  placeholder="สีพื้น Title Pillar3" class="form-control form-control-lg stringformat200">
                                            <code>default: background-image: linear-gradient(90deg, #559cea 41%, #6ba3cb 100%);</code>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label>Description Pillar3 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillardescth3" value="{{$homepagepillar->pillardescth3}}"  placeholder="Description Pillar3 (ภาษาไทย)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group" hidden>
                                            <label>Description Pillar3 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillardesceng3" value="{{$homepagepillar->pillardesceng3}}"  placeholder="Description Pillar3 (ภาษาอังกฤษ)" class="form-control form-control-lg stringformat30">
                                        </div>

                                        <div class="form-group">
                                            <label>Title Pillar4 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillartitleth4" value="{{$homepagepillar->pillartitleth4}}"  placeholder="Title Pillar4 (ภาษาไทย)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group">
                                            <label>Title Pillar4 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillartitleeng4" value="{{$homepagepillar->pillartitleeng4}}"  placeholder="Title Pillar4 (ภาษาอังกฤษ)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group">
                                            <label>สีพื้น Title Pillar4<span class="text-danger">*</span></label>
                                            <input type="text"  name="color4" value="{{$homepagepillar->color4}}"  placeholder="สีพื้น Title Pillar4" class="form-control form-control-lg stringformat200">
                                            <code>default: background-image: linear-gradient(90deg, #f954a1 41%, #f2a1c6 100%);</code>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label>Description Pillar4 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillardescth4" value="{{$homepagepillar->pillardescth4}}"  placeholder="Description Pillar4 (ภาษาไทย)" class="form-control form-control-lg stringformat30">
                                        </div>
                                        <div class="form-group" hidden>
                                            <label>Description Pillar4 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillardesceng4" value="{{$homepagepillar->pillardesceng4}}"  placeholder="Description Pillar4 (ภาษาอังกฤษ)" class="form-control form-control-lg stringformat30">
                                        </div>

                                        
                            <div class="form-group mb-md-2 mt-4">
                                
                                <div class="form-check form-check-inline">
                                    @php
                                        $check = 'checked';
                                        if(!Empty($homepagepillarurl)  && $homepagepillarurl->url_type == 1){
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
                                    if(Empty($homepagepillarurl)  || $homepagepillarurl->url_type == 0){
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
                            @if (Empty($homepagepillarurl))
                                <input type="text" id="linktype" name="linktype" value="0" hidden>
                            @else
                                <input type="text" id="linktype" name="linktype" value="{{@$homepagepillarurl->url_type}}" hidden>
                            @endif


                            <div class="form-group" style="margin-top:-20px" id="linksource" @if (!Empty($homepagepillarurl) && $homepagepillarurl->url_type == 1) hidden @endif>
                                <input type="text" name="link" value="{{@$homepagepillarurl->url}}"  placeholder="เช่น https://www.google.co.th" class="form-control form-control-lg stringformat100">
                            </div>

                            <div class="form-group" style="margin-top:-20px" id="linksourceinternal"
                                @if (Empty($homepagepillarurl))
                                        hidden
                                    @else
                                        @if ($homepagepillarurl->url_type == 0)
                                            hidden
                                        @endif
                                @endif
                            >
								<div class="form-group">
                                    @php
                                        $lasttext = substr(@$homepagepillarurl->url, strrpos(@$homepagepillarurl->url, '/' )+1)
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
                console.log('a')
            }else{
                $("#linksourceinternal").attr("hidden",false);
                $("#linksource").attr("hidden",true);
                $('#linktype').val(1);
                console.log('b')
            }
        });
        $(document).on('click', '#editpage', function(e) {
            if($("input[name='selectlink']:checked").val() != '0'){
                window.location.replace(route.url +'/setting/admin/website/webpage/edit/' + $('select[name=page] option').filter(':selected').val());
            }
        });
    </script>
@stop
