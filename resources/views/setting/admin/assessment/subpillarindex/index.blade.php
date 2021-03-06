@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">รายการ Sub Pillar Index</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <a href="{{route('setting.admin.assessment.subpillarindex.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่ม Sub Pillar Index<b><i class="icon-plus3"></i></b></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> EV</a>
                    {{-- <a href="#" class="breadcrumb-item"> Pillar</a> --}}
                    <span class="breadcrumb-item active">Sub Pillar Index</span>
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
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">Sub Pillar Index</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                
                                <span></span>
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th>Pillar</th>                           
                                        <th>Sub Pillar</th>
                                        <th>Sub Pillar Index</th>
                                        <th style="width:200px">เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subpillarindexes as $key => $subpillarindex)
                                    <tr>    
                                        <td> {{$subpillarindex->subpillar->pillar->name}} </td>  
                                        <td> {{$subpillarindex->subpillar->name}} </td>  
                                        <td> {{$subpillarindex->name}} </td> 
                                        <td>   
                                            <a href="{{route('setting.admin.assessment.subpillarindex.edit',['id' => $subpillarindex->id])}}" class="btn btn-sm bg-primary">แก้ไข</a>
                                            <a href="{{route('setting.admin.assessment.subpillarindex.delete',['id' => $subpillarindex->id])}}" data-name="" onclick="confirmation(event)" class="btn btn-sm bg-danger">ลบ</a>                                       
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>      
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script>
        $('#testtopictable').DataTable( {
            "paging":   true,
            "ordering": true,
            "info":     false,
            "pageLength" : 20,
            "language": {
                "zeroRecords": " ",
                "search": "ค้นหา: ",  
                "sLengthMenu": "จำนวน _MENU_ รายการ",
                'paginate': {
                    'previous': 'ก่อนหน้า',
                    'next': 'ถัดไป'
                }
            }
        });
</script>
@stop