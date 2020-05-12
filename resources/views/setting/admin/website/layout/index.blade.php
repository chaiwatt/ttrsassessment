@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">หน้าเพจ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <a href="{{route('setting.admin.website.page.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่มหน้าเพจ<b><i class="icon-plus3"></i></b></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <span class="breadcrumb-item active">หน้าเพจ</span>
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
                    <div class="col-md-6">

                        <h4 class="text-center">ลำดับการแสดงผลหน้าแรก</h4>

                        <!-- product list -->
                        <div id="productList" class="list-group list-group-flush">
                            <div class="card card-body">
                                <div class="media flex-column flex-sm-row">
                                    <div class="media-body">
                                        <ul class="list-inline list-inline-dotted text-muted mb-2">
                                            <li class="list-inline-item"><a href="#" class="text-muted"><span id="title[]">ส่วนแสดงภาพสไลด์</span></a></li>
                                            {{-- <li class="list-inline-item">Amsterdam, Netherlands</li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <div class="card card-body">
                            <div class="media flex-column flex-sm-row">
                                <div class="media-body">
                                    <ul class="list-inline list-inline-dotted text-muted mb-2">
                                        <li class="list-inline-item"><a href="#" class="text-muted"><span id="title[]">ส่วนIntro</span></a></li>
                                        {{-- <li class="list-inline-item">Amsterdam, Netherlands</li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card card-body">
                            <div class="media flex-column flex-sm-row">
                                <div class="media-body">
                                    <ul class="list-inline list-inline-dotted text-muted mb-2">
                                        <li class="list-inline-item"><a href="#" class="text-muted"><span id="title[]">ส่วนแสดงบทความ</span></a></li>
                                        {{-- <li class="list-inline-item">Amsterdam, Netherlands</li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card card-body">
                            <div class="media flex-column flex-sm-row">
                                <div class="media-body">
                                    <ul class="list-inline list-inline-dotted text-muted mb-2">
                                        <li class="list-inline-item"><a href="#" class="text-muted"><span id="title[]">ส่วนแสดงท้าย</span></a></li>
                                        {{-- <li class="list-inline-item">Amsterdam, Netherlands</li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card card-body">
                            <div class="media flex-column flex-sm-row">
                                <div class="media-body">
                                    <ul class="list-inline list-inline-dotted text-muted mb-2">
                                        <li class="list-inline-item"><a href="#" class="text-muted"><span id="title[]">เพิ่มเติม1</span></a></li>
                                        {{-- <li class="list-inline-item">Amsterdam, Netherlands</li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card card-body">
                        <div class="media flex-column flex-sm-row">
                            <div class="media-body">
                                <ul class="list-inline list-inline-dotted text-muted mb-2">
                                    <li class="list-inline-item"><a href="#" class="text-muted"><span id="title[]">เพิ่มเติม2</span></a></li>
                                    {{-- <li class="list-inline-item">Amsterdam, Netherlands</li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card card-body">
                        <div class="media flex-column flex-sm-row">
                            <div class="media-body">
                                <ul class="list-inline list-inline-dotted text-muted mb-2">
                                    <li class="list-inline-item"><a href="#" class="text-muted"><span id="title[]">เพิ่มเติม3</span></a></li>
                                    {{-- <li class="list-inline-item">Amsterdam, Netherlands</li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                        </div>
                        <br>
                        <div class="text-center">
                        <button type="button" id="generateJSON" class="btn btn-info">Generate JSON</button>
                        </div>

                    </div>
                   

                    <div class="col-md-6">
                        <h4 class="text-center">JSON</h4>
                        <pre id="printCode"></pre>
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
<script src="{{asset('assets/dashboard/js/Sortable.js')}}"></script>
    <script>

        Sortable.create(productList, {
            group: "sorting",
            sort: true
        });
        $('#generateJSON').click(function() {

        let data = {};

        var titles = $('span[id^=title]').map(function(idx, elem) {
        return $(elem).text();
        }).get();

        data['products'] = titles;

        // encode to JSON format
        var products_json = JSON.stringify(data,null,'\t');
            $('#printCode').html(products_json);
        });
    </script>
@stop