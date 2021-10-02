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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">รายละเอียดโครงการ</h6>
                        <div class="header-elements">
                            <div class="list-icons ml-3">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="#" data-toggle="modal" id="select_maintable_excel" class="dropdown-item"><i class="icon-file-excel"></i>Excel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table style="width: 100%" class="table table-bordered table-striped mb-2" id="maintable" >
                                <thead>
                                    <tr class="bg-info">
                                        <th style="width:1%;white-space: nowrap;text-align: center">เลขที่โครงการ</th>  
                                        <th style="white-space: nowrap;text-align: center">ชื่อโครงการ</th> 
                                        
                                        <th style="width:1%;white-space: nowrap;text-align: center">วันที่ยกเลิก</th>                             
                                        <th style="width:1%;white-space: nowrap;text-align: center">เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fulltbps as $key => $fulltbp)
                                    @if ($fulltbp->minitbp->businessplan->business_plan_status_id >= 3)
                                    <tr>    
                                        <td style="white-space: nowrap;text-align:center">{{$fulltbp->fulltbp_code}}</td>
                                        <td style="white-space: nowrap"> <a class="text-info" href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}">{{$fulltbp->minitbp->project}} </a> </td> 
                                        
                                        <td style="text-align: center"> {{$fulltbp->canceldateth}} </td> 

                                        <td style="white-space: nowrap;text-align: center"> 
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
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>\

<script src="{{asset('assets/dashboard/js/app/helper/utility.js?v=1')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

        var countitemtable =  "{{$fulltbps->count()}}";
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
                            return "ยกเลิกโครงการ" ;      
                        }, 
                        exportOptions: {
                            columns: [ 0, 1,2]
                        },
                        customize: function( xlsx ) {
                            var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                            source.setAttribute('name','ยกเลิกโครงการ');
                        }, 
                    }        
                ],
                drawCallback: function() {
                    // $('.buttons-excel')[0].style.visibility = 'hidden';
                }
            });

        $(document).on('click', '#select_maintable_excel', function(e) {
            $('#maintable').DataTable().buttons(0,0).trigger();
        });


        $(document).on("click",".btncancel",function(e){
            var urlToRedirect = e.currentTarget.getAttribute('href');
            //console.log(urlToRedirect)
            Swal.fire({
                    title: 'คำเตือน',
                    text: `ต้องการยกเลิกโครงการ`,
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