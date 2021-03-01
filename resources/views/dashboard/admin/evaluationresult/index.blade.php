@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">รายงานผลการประเมิน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ผลการประเมิน</a>
                    <span class="breadcrumb-item active">รายงานผลการประเมิน</span>
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
                        <h6 class="card-title">ผลการประเมินโครงการ</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                <span></span>
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table text-nowrap" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th>ชื่อโครงการ</th> 
                                        <th>คะแนน</th>
                                        <th>เกรด</th>     
                                        <th>รายงานผล</th>    
                                        <th>แจ้งผลทางจดหมาย</th>  
                                        <th>สิ้นสุดโครงการ</th>              
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fulltbps as $key => $fulltbp)
                                        @if ($fulltbp->minitbp->businessplan->business_plan_status_id >= 8)
                                            <tr>    
                                                <td> {{$fulltbp->minitbp->project}} </td> 
                                                <td> {{number_format(@$fulltbp->projectgrade->percent, 2, '.', '')}} </td>  
                                                <td> {{@$fulltbp->projectgrade->grade}} </td> 
                                                <td> 
                                                    <a href="{{route('dashboard.admin.evaluationresult.edit',['id' => $fulltbp->evaluationresult->id])}}" class="btn btn-sm bg-info">รายละเอียด</a> 
                                                    <a href="{{route('dashboard.admin.evaluationresult.pdf',['id' => $fulltbp->evaluationresult->id])}}" class="btn btn-sm bg-primary">เอกสารแจ้งผล</a>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm bg-success dropdown-toggle" data-toggle="dropdown">Certificate</button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="{{route('dashboard.admin.evaluationresult.certificate',['id' => $fulltbp->evaluationresult->id, 'type' => '1'])}}" class="dropdown-item"><i class="icon-file-eye"></i> ตัวอย่างการแสดงผล</a>
                                                            <a href="{{route('dashboard.admin.evaluationresult.certificate',['id' => $fulltbp->evaluationresult->id, 'type' => '2'])}}" class="dropdown-item"><i class="icon-download"></i> ดาวน์โหลด</a>
                                                        </div>
                                                    </div>
                                                </td> 
                                                <td>
                                                    @if (!Empty($fulltbp->projectstatustransaction(7)))
                                                            @if ($fulltbp->projectstatustransaction(7)->status == 2)  
                                                                    <span class="badge badge-flat border-success text-success-600">ส่งจดหมายแล้ว</span>
                                                                @elseif($fulltbp->projectstatustransaction(7)->status == 1)
                                                                    <button class="btn btn-sm bg-warning confirmsendletter" data-id="{{$fulltbp->minitbp->id}}">ยืนยันส่งจดหมาย</button>
                                                            @endif  
                                                        @else
                                                            <span class="badge badge-flat border-warning text-warning-600">รอการยืนยัน</span>
                                                    @endif
                                                </td>
                                                <td> 
                                                    @if (!Empty($fulltbp->projectstatustransaction(8)))
                                                            @if ($fulltbp->projectstatustransaction(8)->status == 2)
                                                                    <span class="badge badge-flat border-success text-success-600">สิ้นสุดโครงการ</span>
                                                                @elseif($fulltbp->projectstatustransaction(8)->status == 1)
                                                                    <a href="{{route('dashboard.admin.project.fulltbp.finishproject',['id' => $fulltbp->id])}}" data-name="" onclick="confirmfinish(event)" class="btn btn-sm bg-warning">สิ้นสุดโครงการ</a>
                                                            @endif  
                                                        @else
                                                            <span class="badge badge-flat border-warning text-warning-600">รอการยืนยัน</span>
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
        function confirmfinish(e) {
            e.preventDefault();
            var urlToRedirect = e.currentTarget.getAttribute('href');
            Swal.fire({
                    title: 'ยืนยัน!',
                    text: `ต้องการสิ้นสุดโครงการหรือไม่? `,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ตกลง',
                    cancelButtonText: 'ยกเลิก',
                    closeOnConfirm: false,
                    closeOnCancel: false
                }).then((result) => {
                if (result.value) {
                    window.location.href = urlToRedirect;
                }
            });
        }
        $(document).on("click",".confirmsendletter",function(e){
            Swal.fire({
                title: 'ยืนยัน!',
                text: `ต้องการยืนยันรายการ หรือไม่`,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                closeOnConfirm: false,
                closeOnCancel: false
                }).then((result) => {
                if (result.value) {
                    LetterSent($(this).data('id')).then(data => {
                        window.location.reload();
                    })
                .catch(error => {})
                }
            });
        }); 

        function LetterSent(id){
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: `${route.url}/api/assessment/lettersent`,
                    type: 'POST',
                    headers: {"X-CSRF-TOKEN":route.token},
                    data: {
                    id : id
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