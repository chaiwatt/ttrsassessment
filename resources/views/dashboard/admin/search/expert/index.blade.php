@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">ผู้เชี่ยวชาญ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ค้นหา</a>
                    <span class="breadcrumb-item active">ผู้เชี่ยวชาญ</span>
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
                        <h6 class="card-title" style="font-size:16px">รายการผู้เชี่ยวชาญ</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="experttable">
                                <thead>
                                    <tr>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>ความเชี่ยวชาญ</th>
                                        <th>โครงการรับผิดชอบ</th> 
                                    </tr>
                                </thead>
                                <tbody id="reportsearch_wrapper">
                                    @foreach ($experts as $expert)
                                    <tr>
                                        <td> 
                                            <a href="{{route('dashboard.admin.search.expert.profile',['id' => $expert->id])}}" class="text-info" target="_blank">{{$expert->name}} {{$expert->lastname}}</a>
                                        </td> 
                                        <td>
                                            {{$expert->expertbranch}}
                                        </td>
                                        <td> 
                                            {{-- {{$expert->projectbelongexpert}} --}}
                                            <ul class="list list-unstyled mb-0">
                                                @if ($expert->projectbelongexpert->count() > 0)
                                                    @foreach ($expert->projectbelongexpert as $fulltbp)
                                                        @php
                                                            $color = "bg-grey-300";
                                                            $status = "กำลังดำเนินการ";
                                                            if($fulltbp->status == 3){
                                                                $color = "bg-success-400";
                                                                $status = "เสร็จสิ้น";
                                                            }
                                                        @endphp
                                                        <li>
                                                            <i class="icon-primitive-dot mr-2"></i>
                                                            <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->company->id])}}" class="text-info" target="_blank" >{{$fulltbp->minitbp->project}} </a>  
                                                            <span class="badge badge-pill {{$color}} ml-20 ml-md-0">{{$status}}</span>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
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
    </div>
@endsection
@section('pageScript')
<script type="module" src="{{asset('assets/dashboard/js/app/helper/searchexperthelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
        $('#experttable').DataTable( {
            "paging":   true,
            "ordering": true,
            "info":     false,
            "pageLength" : 50,
            "language": {
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