@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">แก้ไข Homepage Pillar</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <a href="#" class="breadcrumb-item"> Homepage Pillar</a>
                    {{-- <span class="breadcrumb-item active">แก้ไข Intro section</span> --}}
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
                                            <input type="text"  name="textth1" value="{{$homepagepillar->textth1}}"  placeholder="ข้อความที่ 1 (ภาษาไทย)" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่ 1 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="texteng1" value="{{$homepagepillar->texteng1}}"  placeholder="ข้อความที่ 1 (ภาษาอังกฤษ)" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่ 2 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="textth2" value="{{$homepagepillar->textth2}}"  placeholder="ข้อความที่ 2 (ภาษาไทย)" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อความที่2 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="texteng2" value="{{$homepagepillar->texteng2}}"  placeholder="ข้อความที่2 (ภาษาอังกฤษ)" class="form-control form-control-lg">
                                        </div>


                                        <div class="form-group">
                                            <label>Title Pillar1 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillartitleth1" value="{{$homepagepillar->pillartitleth1}}"  placeholder="Title Pillar1 (ภาษาไทย)" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>Title Pillar1 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillartitleeng1" value="{{$homepagepillar->pillartitleeng1}}"  placeholder="Title Pillar1 (ภาษาอังกฤษ)" class="form-control form-control-lg">
                                        </div>

                                        <div class="form-group">
                                            <label>Description Pillar1 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillardescth1" value="{{$homepagepillar->pillardescth1}}"  placeholder="Description Pillar1 (ภาษาไทย)" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>Description Pillar1 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillardesceng1" value="{{$homepagepillar->pillardesceng1}}"  placeholder="Description Pillar1 (ภาษาอังกฤษ)" class="form-control form-control-lg">
                                        </div>

                                        <div class="form-group">
                                            <label>Title Pillar2 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillartitleth2" value="{{$homepagepillar->pillartitleth2}}"  placeholder="Title Pillar2 (ภาษาไทย)" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>Title Pillar2 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillartitleeng2" value="{{$homepagepillar->pillartitleeng2}}"  placeholder="Title Pillar2 (ภาษาอังกฤษ)" class="form-control form-control-lg">
                                        </div>

                                        <div class="form-group">
                                            <label>Description Pillar2 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillardescth2" value="{{$homepagepillar->pillardescth2}}"  placeholder="Description Pillar2 (ภาษาไทย)" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>Description Pillar2 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillardesceng2" value="{{$homepagepillar->pillardesceng2}}"  placeholder="Description Pillar2 (ภาษาอังกฤษ)" class="form-control form-control-lg">
                                        </div>

                                        <div class="form-group">
                                            <label>Title Pillar3 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillartitleth3" value="{{$homepagepillar->pillartitleth3}}"  placeholder="Title Pillar3 (ภาษาไทย)" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>Title Pillar3 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillartitleeng3" value="{{$homepagepillar->pillartitleeng3}}"  placeholder="Title Pillar3 (ภาษาอังกฤษ)" class="form-control form-control-lg">
                                        </div>

                                        <div class="form-group">
                                            <label>Description Pillar3 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillardescth3" value="{{$homepagepillar->pillardescth3}}"  placeholder="Description Pillar3 (ภาษาไทย)" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>Description Pillar3 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillardesceng3" value="{{$homepagepillar->pillardesceng3}}"  placeholder="Description Pillar3 (ภาษาอังกฤษ)" class="form-control form-control-lg">
                                        </div>

                                        <div class="form-group">
                                            <label>Title Pillar4 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillartitleth4" value="{{$homepagepillar->pillartitleth4}}"  placeholder="Title Pillar4 (ภาษาไทย)" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>Title Pillar4 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillartitleeng4" value="{{$homepagepillar->pillartitleeng4}}"  placeholder="Title Pillar4 (ภาษาอังกฤษ)" class="form-control form-control-lg">
                                        </div>

                                        <div class="form-group">
                                            <label>Description Pillar4 (ภาษาไทย)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillardescth4" value="{{$homepagepillar->pillardescth4}}"  placeholder="Description Pillar4 (ภาษาไทย)" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>Description Pillar4 (ภาษาอังกฤษ)<span class="text-danger">*</span></label>
                                            <input type="text"  name="pillardesceng4" value="{{$homepagepillar->pillardesceng4}}"  placeholder="Description Pillar4 (ภาษาอังกฤษ)" class="form-control form-control-lg">
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
    <script type="text/javascript">
        $("#file").on('change', function() {
            $("#filename").val(this.value);
        });
    </script>
@stop
