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
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> ผู้ใช้งานระบบ</a>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">ผู้ใช้งานระบบ</h6>
                        <div class="header-elements">
                            <div class="list-icons ml-3">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="#" data-toggle="modal" id="select_testtopictable_excel" class="dropdown-item"><i class="icon-file-excel"></i>Excel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table style="width: 100%" class="table table-bordered mb-2" id="testtopictable">
                                <thead>
                                    <tr class="bg-info">
                                        <th style="width:1%;white-space: nowrap;text-align: center">#</th>
                                        <th style="text-align: center">ชื่อ-นามสกุล</th> 
                                        <th style="text-align: center">อีเมล</th> 
                                        <th style="width:1%;white-space: nowrap;text-align: center">กลุ่มผู้ใช้งาน</th>    
                                        {{-- <th style="width:1%;white-space: nowrap">ออนไลน์</th>   --}}
                                        <th style="width:1%;white-space: nowrap;text-align: center">ยืนยันการใช้งาน</th>    
                                        <th style="width:1%;white-space: nowrap;text-align: center">สถานะ</th>                          
                                        <th style="width:1%;white-space: nowrap;text-align: center">เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($users as $key => $user)
                                    <tr>    
                                        <td > {{$key+1}} </td>
                                        @php
                                            $userprefix = $user->prefix->name;
                                                if($userprefix == 'อื่นๆ'){
                                                $userprefix = $user->alter_prefix;
                                            }
                                        @endphp
                                        <td style="white-space: nowrap"> {{$userprefix}}{{$user->name}}   {{$user->lastname}} </td>    
                                        <td> {{$user->email}}</td>    
                                        <td style="white-space: nowrap;"> 
                                            @if ($user->user_type_id == 1 )
                                                @if ($user->user_group_id == 1)
                                                        ผู้ขอรับการประเมินนิติบุคคล
                                                    @else
                                                        ผู้ขอรับการประเมินบุคคลธรรมดา
                                                @endif
                                            @elseif($user->user_type_id == 3)
                                                @if ($user->expertdetail->expert_type_id == 1)
                                                        {{@$user->usertype->name}} (ภายใน)
                                                    @else
                                                        {{@$user->usertype->name}} (ภายนอก)
                                                @endif
                                            @else 
                                                {{@$user->usertype->name}} 
                                            @endif
                                            
                
                                            </td> 
                                        {{-- @if ($user->isonline() == 1)
                                            <td> <span class="badge badge-mark border-success mr-1"></span> <span class="badge badge-flat border-success text-success-600">ออนไลน์</span> </td>  
                                            @else
                                            <td> <span class="badge badge-mark border-danger mr-1"></span> {{$user->isonline()}} </td>  
                                        @endif   --}}
                                        <td style="white-space: nowrap;text-align:center">
                                            @if ($user->user_type_id == 3 || $user->user_type_id == 4)
                                                @if ($user->verify_expert == 2)
                                                        {{-- <span class="badge badge-flat border-success text-success-600">ยืนยันแล้ว</span> --}}
                                                        {{-- <button type="button" data-id="{{$user->id}}" data-status="{{$user->verify_expert}}" class="btn btn-sm bg-success user">ยืนยันแล้ว</button> --}}
                                                   @else 
                                                        <button type="button" data-id="{{$user->id}}" data-status="{{$user->verify_expert}}" class="btn btn-sm bg-warning user">ไม่ได้ยืนยัน</button>
                                                @endif
                                                
                                            @endif 
                                        </td>
                                        @if ($user->user_status_id == 1)
                                                <td style="white-space: nowrap;text-align:center"><span class="badge badge-flat border-info text-info-600 rounded-0">{{@$user->userstatus->name}}</span></td> 
                                           @else 
                                                <td style="white-space: nowrap;text-align:center"><span class="badge badge-flat border-danger text-danger-600 rounded-0">{{@$user->userstatus->name}}</span></td> 
                                        @endif                                     
                                        
                                        <td style="white-space: nowrap;text-align:center"> 
                                            @if ($user->user_type_id < 5)
                                            <a href="{{route('setting.admin.user.edit',['id' => $user->id])}}" class="btn btn-sm bg-primary">แก้ไข</a>
                                            @endif
                                            
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
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
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
            "pageLength" : 20,
            "language": {
                "zeroRecords": " ",
                "search": "ค้นหา: ",  
                "sLengthMenu": "จำนวน _MENU_ รายการ",
                'paginate': {
                    'previous': 'ก่อนหน้า',
                    'next': 'ถัดไป'
                }
            },
            buttons: [
                    { 
                        extend: 'excelHtml5',
                        className: 'btn-primary',
                        text: 'Excel',
                        title: function () { 
                            return null; 
                        },
                        filename: function() {
                            return "ผู้ใช้งานระบบ" ;      
                        }, 
                        exportOptions: {
                            columns: [0,  1,2,3,4, 5]
                        },
                        customize: function( xlsx ) {
                            var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                            source.setAttribute('name','ผู้ใช้งานระบบ');
                        }, 
                    }        
                ],
                drawCallback: function() {
                    // $('.buttons-excel')[0].style.visibility = 'hidden';
                }
        });
        $(document).on('click', '#select_testtopictable_excel', function(e) {
            $('#testtopictable').DataTable().buttons(0,0).trigger();
        });
    </script>
@stop