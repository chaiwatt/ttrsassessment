@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">เลย์เอาท์</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            {{-- <div class="header-elements d-none">
                <a href="{{route('setting.admin.website.page.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่มหน้าเพจ<b><i class="icon-plus3"></i></b></a>
            </div> --}}
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <span class="breadcrumb-item active">เลย์เอาท์</span>
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
                                <div id="productList" class="list-group list-group-flush">
                                    <div class="content d-flex justify-content-center align-items-center">
                                        <div class="form-group" style="width: 500px;margin-bottom: 10px">
                                            <label>รูปแบบเลย์เอาท์</label>
                                            <select name="menu" placeholder="เมนู" class="form-control form-control-select2">
                                                @foreach ($layoutstyles as $layoutstyle)
                                                    <option value="{{$layoutstyle->id}}" >{{$layoutstyle->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <h5 class="text-center" style="margin-bottom: 0px">ลำดับการแสดงผลหน้าแรก</h5>
                                    <div class="content d-flex justify-content-center align-items-center" style="margin-bottom: -30px">
                                        <div class="card mb-0 form-check-inline">
                                            <div class="card-body" style="width: 500px">
                                                <div class="form-check form-check-right form-check-switchery">
                                                    <label class="form-check-label">
                                                        <span id="title[]" data-id="1">ส่วนการแสดงภาพสไลด์</span>
                                                        <input type="checkbox" data-id="1" class="form-check-input-switchery" checked >
                                                    </label>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="content d-flex justify-content-center align-items-center" style="margin-bottom: -30px">
                                        <div class="card mb-0 form-check-inline">
                                            <div class="card-body " style="width: 500px">
                                                <div class="form-check form-check-right form-check-switchery">
                                                    <label class="form-check-label">
                                                        <span id="title[]" data-id="2">ส่วนIntro</span>
                                                        <input type="checkbox" data-id="2" class="form-check-input-switchery" checked >
                                                    </label>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="content d-flex justify-content-center align-items-center" style="margin-bottom: -30px">
                                        <div class="card mb-0 form-check-inline">
                                            <div class="card-body " style="width: 500px">
                                                <div class="form-check form-check-right form-check-switchery">
                                                    <label class="form-check-label">
                                                        <span id="title[]" data-id="3">ส่วนแสดงบทความ</span>
                                                        <input type="checkbox" data-id="3" class="form-check-input-switchery" checked >
                                                    </label>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="content d-flex justify-content-center align-items-center" style="margin-bottom: -30px">
                                        <div class="card mb-0 form-check-inline">
                                            <div class="card-body " style="width: 500px">
                                                <div class="form-check form-check-right form-check-switchery">
                                                    <label class="form-check-label">
                                                        <span id="title[]" data-id="4">ส่วนแสดงท้าย</span>
                                                        <input type="checkbox" data-id="4" class="form-check-input-switchery" checked >
                                                    </label>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="content d-flex justify-content-center align-items-center" style="margin-bottom: -30px">
                                        <div class="card mb-0 form-check-inline">
                                            <div class="card-body " style="width: 500px">
                                                <div class="form-check form-check-right form-check-switchery">
                                                    <label class="form-check-label">
                                                        <span id="title[]" data-id="5">เพิ่มเติม1</span>
                                                        <input type="checkbox" data-id="5" class="form-check-input-switchery" checked >
                                                    </label>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="content d-flex justify-content-center align-items-center" style="margin-bottom: -30px">
                                        <div class="card mb-0 form-check-inline">
                                            <div class="card-body " style="width: 500px">
                                                <div class="form-check form-check-right form-check-switchery">
                                                    <label class="form-check-label">
                                                        <span id="title[]" data-id="6">เพิ่มเติม2</span>
                                                        <input type="checkbox" data-id="6" class="form-check-input-switchery" checked >
                                                    </label>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="content d-flex justify-content-center align-items-center" style="margin-bottom: -30px">
                                        <div class="card mb-0 form-check-inline">
                                            <div class="card-body " style="width: 500px">
                                                <div class="form-check form-check-right form-check-switchery">
                                                    <label class="form-check-label">
                                                        <span id="title[]" data-id="7">เพิ่มเติม3</span>
                                                        <input type="checkbox" data-id="7" class="form-check-input-switchery" checked >
                                                    </label>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <br>
                                <div class="text-center">
                                    <button type="button" id="generateJSON" class="btn btn-info">Generate JSON</button>
                                </div>
                            </div>
                            <div class="col-md-12">
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
<script src="{{asset('assets/dashboard/js/plugins/forms/styling/switchery.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script src="{{asset('assets/dashboard/js/Sortable.js')}}"></script>
    <script>

        Sortable.create(productList, {
            group: "sorting",
            sort: true
        });
        $('#generateJSON').click(function() {

            var favorite = [];
            $.each($("input:checked"), function(){            
                favorite.push($(this).data('id'));
            });
            alert("My favourite sports are: " + favorite.join(", "));

            // let data = {};

            // var titles = $('span[id^=title]').map(function(idx, elem) {
            //     return $(elem).data('id');// $('elem').data('id');//  $(elem).text();
            // }).get();

            // data['id'] = titles;

            // var products_json = JSON.stringify(data,null,'\t');
            //     $('#printCode').html(products_json);
        });
    </script>
@stop