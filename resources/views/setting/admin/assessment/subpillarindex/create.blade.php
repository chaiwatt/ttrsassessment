@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">เพิ่ม Sub Pillar Index</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> การประเมิน</a>
                    <a href="#" class="breadcrumb-item"> Sub Pillar</a>
                    <a href="{{route('setting.admin.assessment.subpillarindex')}}" class="breadcrumb-item"> รายการ Sub Pillar Index</a>
                    <span class="breadcrumb-item active">เพิ่ม Sub Pillar Index</span>
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
				<!-- Multiple selection -->
				<div class="card">
					<div class="card-body">
                        <form method="POST" action="{{route('setting.admin.assessment.subpillarindex.createsave')}}" enctype="multipart/form-data">
                            @csrf
                            <fieldset>	
                                <div class="form-group">
                                    <label>Pillar</label>
                                        <select name="pillar" id="pillar" aria-placeholder="pillar" class="form-control form-control-select2">
                                            <option value="0">==เลือก Pillar==</option>
                                            @foreach ($pillars as $pillar)
                                                <option value="{{$pillar->id}}">{{$pillar->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div id="pillar_wrapper" hidden>
                                    <div class="form-group">
                                        <label>Sub Pillar</label>
                                            <select name="subpillar" id="subpillar" aria-placeholder="subpillar" class="form-control form-control-select2">
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Sub Pillar Index</label>
                                        <input type="text" name="subpillarindex" value="{{old('subpillar')}}"  placeholder="subpillar" class="form-control">
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
					</div>
				</div>
				<!-- /multiple selection -->
            <!-- /striped rows -->
            </div>
        </div>
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

        $(document).on('change', '#pillar', function(e) {
            var html ='';
            getSubpillar($(this).val()).then(data => {
                data.forEach(function (ev,index) {
                        html += `<option value="${ev['id']}" >${ev['name']}</option>`
                    });
                if(data.length == 0){
                    $("#pillar_wrapper").attr("hidden",true);
                }else{
                    $("#pillar_wrapper").attr("hidden",false);
                }
                $("#subpillar").html(html);

            }).catch(error => {})
        });

        function getSubpillar(pillar){
            return new Promise((resolve, reject) => {
                    $.ajax({
                    url: `${route.url}/setting/admin/assessment/subpillarindex/getsubpillar`,
                    type: 'POST',
                    headers: {"X-CSRF-TOKEN":route.token},
                    data: {
                        pillar : pillar
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
