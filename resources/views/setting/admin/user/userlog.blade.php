@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">ผู้ใช้งาน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            {{-- <div class="header-elements d-none">
                <a href="{{route('setting.admin.user.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่มผู้ใช้งานระบบ<b><i class="icon-plus3"></i></b></a>
            </div> --}}
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ผู้ใช้งานระบบ</a>
                    <span class="breadcrumb-item active">Log</span>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">ผู้ใช้งานระบบ</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-2" id="userlogtable">
                                <thead>
                                    <tr class="bg-info">
                                        <th style="width:1%;white-space: nowrap;text-align: center">วันที่</th>
                                        <th style="text-align: center">ชื่อ-นามสกุล</th> 
                                        <th style="text-align: center">Log</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userlogs as $key => $userlog)
                                    @php
                                        $userprefix = $userlog->user->prefix->name;
                                        if($userprefix == 'อื่นๆ'){
                                            $userprefix = $userlog->user->alter_prefix;
                                        }
                                    @endphp
                                    <tr>    
                                        <td style="width:1%;white-space: nowrap">{{$userlog->createdatth}}</td>
                                        <td style="white-space: nowrap"> {{$userprefix}}{{$userlog->user->name}} {{$userlog->user->lastname}} </td>    
                                        <td> {{$userlog->document}} </td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>      
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
{{-- <script type="module" src="{{asset('assets/dashboard/js/app/helper/userhelper.js')}}"></script> --}}
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
        $('#userlogtable').DataTable( {
            "paging":   true,
            "ordering": true,
            "order": [[ 0, 'desc' ]],
            "info":     false,
            "pageLength" : 50,
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