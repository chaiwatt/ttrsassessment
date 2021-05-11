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
            <div class="header-elements d-none">
                <a href="{{route('setting.admin.user.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่มผู้ใช้งานระบบ<b><i class="icon-plus3"></i></b></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ผู้ใช้งานระบบ</a>
                    <span class="breadcrumb-item active">ผู้ใช้งาน</span>
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
                        <h6 class="card-title" style="font-size:16px">ผู้ใช้งานระบบ</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="testtopictable">
                                <thead>
                                    <tr>
                                        {{-- <th>#</th> --}}
                                        <th>ชื่อ-นามสกุล</th> 
                                        <th>กลุ่ม</th>    
                                        <th>ออนไลน์</th>  
                                        <th>Verify</th>    
                                        <th>สถานะ</th>                          
                                        <th style="width:170px">เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                    <tr>    
                                        {{-- <td> {{$key+1}} </td> --}}
                                        @php
                                            $userprefix = $user->prefix->name;
                                                if($userprefix == 'อื่นๆ'){
                                                $userprefix = $user->alter_prefix;
                                            }
                                        @endphp
                                        <td> {{$userprefix}}{{$user->name}}   {{$user->lastname}} </td>    
                                        <td> {{$user->usertype->name}} </td> 
                                        @if ($user->isonline() == 1)
                                            <td> <span class="badge badge-mark border-success mr-1"></span> <span class="badge badge-flat border-success text-success-600">ออนไลน์</span> </td>  
                                            @else
                                            <td> <span class="badge badge-mark border-danger mr-1"></span> {{$user->isonline()}} </td>  
                                        @endif  
                                        <td>
                                            @if ($user->user_type_id == 3 || $user->user_type_id == 4)
                                                @if ($user->verify_expert == 2)
                                                        <button type="button" data-id="{{$user->id}}" data-status="{{$user->verify_expert}}" class="btn btn-sm bg-success user">ยืนยันแล้ว</button>
                                                   @else 
                                                        <button type="button" data-id="{{$user->id}}" data-status="{{$user->verify_expert}}" class="btn btn-sm bg-warning user">ไม่ได้ยืนยัน</button>
                                                @endif
                                                
                                            @endif 
                                        </td>
                                        @if ($user->user_status_id == 1)
                                                <td><span class="badge badge-flat border-info text-info-600 rounded-0">{{$user->userstatus->name}}</span></td> 
                                           @else 
                                                <td><span class="badge badge-flat border-danger text-danger-600 rounded-0">{{$user->userstatus->name}}</span></td> 
                                        @endif                                     
                                        
                                        <td> 
                                            <a href="{{route('setting.admin.user.edit',['id' => $user->id])}}" class="btn btn-sm bg-primary">แก้ไข</a>
                                            {{-- <a href="{{route('setting.admin.user.delete',['id' => $user->id])}}" data-name="" onclick="confirmation(event)" class=" btn btn-sm bg-danger">ลบ</a>                                        --}}
                                        </td>
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
<script type="module" src="{{asset('assets/dashboard/js/app/helper/userhelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
        $('#testtopictable').DataTable( {
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