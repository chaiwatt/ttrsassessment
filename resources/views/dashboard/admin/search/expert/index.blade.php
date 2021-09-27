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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">ผู้เชี่ยวชาญ</h6>
                        <div class="header-elements">
                            <div class="list-icons ml-3">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="#" data-toggle="modal" id="select_experttable_excel" class="dropdown-item"><i class="icon-file-excel"></i>Excel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table style="width: 100%" class="table table-bordered table-striped mb-2" id="experttable">
                                <thead>
                                    <tr class="bg-info">
                                        <th style="text-align: center">ชื่อ-นามสกุล</th>
                                        <th style="text-align: center">ความเชี่ยวชาญ</th>
                                        <th style="text-align: center">โครงการรับผิดชอบ</th> 
                                        <th style="text-align: center" hidden >โครงการรับผิดชอบ</th>
                                        <th style="text-align: center">โครงการเสร็จสิ้น</th> 
                                        <th style="text-align: center">โครงการกำลังดำเนินการ</th> 
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
                                                            <a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="text-info" target="_blank" >{{$fulltbp->minitbp->project}} </a>  
                                                            <span class="badge badge-pill {{$color}} ml-20 ml-md-0">{{$status}}</span>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </td> 
                                        <td  hidden>
                                            
                                            @php
                                               $appendtext =''; 
                                               if($expert->projectbelongexpert->count() == 1){
                                                        $appendtext = $expert->projectbelongexpert[0]->minitbp->project;
                                               }else if($expert->projectbelongexpert->count() > 1){
                                                    foreach ($expert->projectbelongexpert as $key => $fulltbp){
                                                        $appendtext .= $key+1 . '. ' .$fulltbp->minitbp->project .'  ';
                                                    }
                                               }
                                            @endphp
                                            {{$appendtext}}
                             
                                        </td> 
                                        <td style="text-align: center"> 
                                            @if ($expert->projectbelongexpert->count() > 0)
                                                {{$expert->projectbelongexpert->where('status',3)->count()}}
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            @if ($expert->projectbelongexpert->count() > 0)
                                                {{$expert->projectbelongexpert->where('status','!=',3)->count()}}
                                            @endif
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
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
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
                            return "ผู้เชี่ยวชาญ" ;      
                        }, 
                        exportOptions: {
                            columns: [0,1,3,4,5],
                        },
                        customize: function( xlsx ) {
                            var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                            source.setAttribute('name','ผู้เชี่ยวชาญ');
                        }, 
                    }        
                ],
                drawCallback: function() {
                    // $('.buttons-excel')[0].style.visibility = 'hidden';
                }
        });
        $(document).on('click', '#select_experttable_excel', function(e) {
            $('#experttable').DataTable().buttons(0,0).trigger();
        });
    </script>
@stop