@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">รายการประเมิน Expert</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <span class="breadcrumb-item active">รายการประเมิน</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-lg-3">

                <!-- Members online -->
                <div class="card bg-teal-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">152</h3>
                            {{-- <span class="badge bg-teal-800 badge-pill align-self-center ml-auto">+53,6%</span> --}}
                        </div>
                        
                        <div>
                            ผ่านการประเมิน
                            {{-- <div class="font-size-sm opacity-75">489 avg</div> --}}
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div id="members-online"></div>
                    </div>
                </div>
                <!-- /members online -->

            </div>

            {{-- <div class="col-lg-3">

                <!-- Current server load -->
                <div class="card bg-pink-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">49.4%</h3>
                            <div class="list-icons ml-auto">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-sync"></i> Update data</a>
                                        <a href="#" class="dropdown-item"><i class="icon-list-unordered"></i> Detailed log</a>
                                        <a href="#" class="dropdown-item"><i class="icon-pie5"></i> Statistics</a>
                                        <a href="#" class="dropdown-item"><i class="icon-cross3"></i> Clear list</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            Current server load
                            <div class="font-size-sm opacity-75">34.6% avg</div>
                        </div>
                    </div>

                    <div id="server-load"></div>
                </div>
                <!-- /current server load -->

            </div> --}}

            <div class="col-lg-3">

                <!-- Today's revenue -->
                <div class="card bg-blue-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">50</h3>
                            {{-- <div class="list-icons ml-auto">
                                <a class="list-icons-item" data-action="reload"></a>
                            </div> --}}
                        </div>
                        
                        <div>
                            กำลังประเมิน
                            {{-- <div class="font-size-sm opacity-75">$37,578 avg</div> --}}
                        </div>
                    </div>

                    <div id="today-revenue"></div>
                </div>
                <!-- /today's revenue -->

            </div>
            <div class="col-lg-3">

                <!-- Today's revenue -->
                <div class="card bg-pink-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">20</h3>
                            {{-- <div class="list-icons ml-auto">
                                <a class="list-icons-item" data-action="reload"></a>
                            </div> --}}
                        </div>
                        
                        <div>
                            รอรับการยืนยัน
                            {{-- <div class="font-size-sm opacity-75">$37,578 avg</div> --}}
                        </div>
                    </div>

                    <div id="today-revenue"></div>
                </div>
                <!-- /today's revenue -->

            </div>
            <div class="col-lg-3">

                <!-- Today's revenue -->
                <div class="card bg-orange-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">50</h3>
                            {{-- <div class="list-icons ml-auto">
                                <a class="list-icons-item" data-action="reload"></a>
                            </div> --}}
                        </div>
                        
                        <div>
                            ไม่ผ่านการประเมิน
                            {{-- <div class="font-size-sm opacity-75">$37,578 avg</div> --}}
                        </div>
                    </div>

                    <div id="today-revenue"></div>
                </div>
                <!-- /today's revenue -->

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">รอรับการยืนยัน</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                
                                <span></span>
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th>วันที่</th>
                                        <th>ชื่อบริษัท</th>
                                        <th>สถานะ</th>                                   
                                        <th style="width:150px">เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>    
                                        <td> 26/2/2563 </td>
                                        <td> บริษัท ทดสอบ จำกัด </td> 
                                        <td> <span class="badge badge-flat border-info text-info-600">รอรับยืนยัน</span>  </td>                                                            
                                        <td> 
                                            <a href="" class="btn btn-sm bg-primary">แก้ไข</a>
                                            <a href="" data-name="" onclick="confirmation(event)" class="btn btn-sm bg-danger">ลบ</a>                                       
                                        </td>
                                    </tr>
                                    {{-- @foreach ($testtopics as $key => $testtopic)                                    
                                    <tr>    
                                        <td hidden> {{$key +1}} </td>
                                        <td> {{$testtopic->subject->name}} </td>
                                        <td> {{$testtopic->category->name}} </td> 
                                        <td> {{$testtopic->name}} </td>                                                            
                                        <td> {{$testtopic->classroom->name}} </td>
                                        <td> 
                                            @if ($testtopic->public == 1)
                                                    <span class="badge badge-flat border-warning text-warning-600">{{$testtopic->publicstatus->name}}</span> 
                                                @else
                                                    <span class="badge badge-flat border-success text-success-600">{{$testtopic->publicstatus->name}}</span> 
                                            @endif
                                            
                                        </td>
                                    </tr>
                                    @endforeach --}}
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
@stop
