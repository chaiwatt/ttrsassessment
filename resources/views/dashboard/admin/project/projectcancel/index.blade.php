@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">ยกเลิกโครงการ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            {{-- <div class="header-elements d-none">
                <a href="{{route('setting.admin.assessment.criteriagroup.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่มรายการเกณฑ์การประเมิน<b><i class="icon-plus3"></i></b></a>
            </div> --}}
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <span class="breadcrumb-item active">ยกเลิกโครงการ</span>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">รายการโครงการ</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                
                                <span></span>
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="maintable">
                                <thead>
                                    <tr>
                                        <th  style="width:20%;">เลขที่โครงการ</th>
                                        <th>ชื่อโครงการ</th>    
                                        <th>วันที่ยกเลิก</th>                             
                                        <th style="width:1%;white-space: nowrap">เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fulltbps as $key => $fulltbp)
                                    @if ($fulltbp->minitbp->businessplan->business_plan_status_id >= 3)
                                    <tr>    
                                        <td> {{$fulltbp->minitbp->businessplan->code}} </td> 
                                        <td> <a class="text-info" href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}">{{$fulltbp->minitbp->project}} </a> </td> 
                                        <td> {{$fulltbp->canceldateth}} </td> 
                                        {{-- <td>
                                            @if ($fulltbp->minitbp->businessplan->business_plan_status_id < 5)
                                                    <span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้ส่ง</span>
                                                @else
                                                    @if ($fulltbp->refixstatus == 0)
                                                        @if($fulltbp->minitbp->businessplan->business_plan_status_id == 5)
                                                                <span class="badge badge-flat border-warning text-warning-600">อยู่ระหว่างพิจารณา Full TBP</span>
                                                            @elseif($fulltbp->minitbp->businessplan->business_plan_status_id > 5)
                                                                <span class="badge badge-flat border-success text-success-600">ผ่านอนุมัติแล้ว</span>
                                                        @endif 
                                                        @elseif($fulltbp->refixstatus == 1)
                                                            <span class="badge badge-flat border-warning text-warning-600">ให้มีการแก้ไข</span>
                                                        @elseif($fulltbp->refixstatus == 2)
                                                            <span class="badge badge-flat border-warning text-warning-600">ส่งรายการแก้ไขแล้ว</span>
                                                    @endif
                                            @endif
                                        </td>                                         --}}
                                        <td style="white-space: nowrap"> 
                                            @if (!Empty($fulltbp->canceldate))
                                                    
                                                    <a href="{{route('dashboard.admin.project.cancel',['id' => $fulltbp->id])}}" class="badge badge-flat border-danger text-danger-600">ยกเลิกโครงการแล้ว</a>
                                                @else
                                                @if ($fulltbp->minitbp->businessplan->business_plan_status_id < 10)
                                                    <a href="{{route('dashboard.admin.project.cancel',['id' => $fulltbp->id])}}" class="btn btn-sm bg-warning">ยกเลิกโครงการ</a>
                                                @else
                                                    <span class="badge badge-flat border-success text-success-600">สิ้นสุดโครงการ</span>
                                                @endif
                                                  
                                            @endif
                                            
                                        </td>
                                    </tr>
                                    @endif
                           
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
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

        var countitemtable =  "{{$fulltbps->count()}}";
        if (countitemtable >= 10) {
            $('#maintable').DataTable( {
                "paging":   true,
                "ordering": true,
                "order": [[ 2, "desc" ]],
                "info":     false,
                "pageLength" : 10,
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
        }

        $(document).on("click",".btncancel",function(e){
            var urlToRedirect = e.currentTarget.getAttribute('href');
            //console.log(urlToRedirect)
            Swal.fire({
                    title: 'คำเตือน!',
                    text: `ต้องการยกเลิกโครงการหรือไม่? `,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ยืนยัน',
                    cancelButtonText: 'ยกเลิก',
                    closeOnConfirm: false,
                    closeOnCancel: false
                }).then((result) => {
                $("#spincancelproject").attr("hidden",false);
                if (result.value) {
                    window.location.href = urlToRedirect;
                }
            });
        }); 
    </script>
@stop