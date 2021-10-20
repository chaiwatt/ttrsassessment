@extends('layouts.dashboard.main')
@section('pageCss')
{{-- 
<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"> --}}

@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">กลุ่มอุตสาหกรรม</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            {{-- <div class="header-elements d-none">
                <a href="{{route('setting.admin.dashboard.industrygroup.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่มกลุ่มอุตสาหกรรม <b><i class="icon-plus3"></i></b></a>
            </div> --}}
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> ทั่วไป</a>
                    <span class="breadcrumb-item active">กลุ่มอุตสาหกรรม</span>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">กลุ่มอุตสาหกรรม</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                
                                <span></span>
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="float-right mb-2">
                            <button id="btnOnExcel" class="btn btn-sm bg-info">ส่งออก EXCEL</button>
                            <button id="btnOnPdf" class="btn btn-sm bg-info">ส่งออก PDF</button>
                        </div>

                        <div class="table-responsive" >
                            <table style="width: 100%" class="table table-bordered table-striped"  id="industrygrouptable">
                                <thead>
                                    <tr class="bg-info">
                                        <th style="width:150px;text-align: center">#</th>
                                        <th style="text-align: center">กลุ่มอุตสาหกรรม</th>                               
                                        <th style="width:250px;text-align: center">เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($industrygroups as $key => $industrygroup)
                                    <tr>    
                                        <td style="text-align: center"> {{$key+1}} </td>
                                        <td> {{$industrygroup->name}} </td>                                         
                                        <td style="text-align: center"> 
                                            <a href="{{route('setting.admin.dashboard.industrygroup.edit',['id' => $industrygroup->id])}}" class="btn btn-sm bg-primary">แก้ไข</a>
                                            @if ($key > 12)
                                            <a href="{{route('setting.admin.dashboard.industrygroup.delete',['id' => $industrygroup->id])}}" data-name="" onclick="confirmation(event)" class="btn btn-sm bg-danger">ลบ</a>                                       
                                            @endif
                                            
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
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script> --}}
<script src="{{asset('assets/dashboard/js/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/utility.js?v=1')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

        $("#btnOnExcel").on('click', function() {
            $('#industrygrouptable').DataTable().buttons(0,0).trigger();
        });
        $("#btnOnPdf").on('click', function() {
            $('#industrygrouptable').DataTable().buttons(0,1).trigger();
        });

        $(document).ready(function() {
            pdfMake.fonts = {
                    THSarabun: {
                        normal: 'THSarabun.ttf',
                        bold: 'THSarabun-Bold.ttf',
                        italics: 'THSarabun-Italic.ttf',
                        bolditalics: 'THSarabun-BoldItalic.ttf'
                    }
                }
          
            $('#industrygrouptable').DataTable( {
                dom: 'Bfrtip',
                paging:   true,
                ordering: true,
                info:     false,
                pageLength : 10,
                language: {
                    zeroRecords: " ",
                    search: "ค้นหา: ",  
                    sLengthMenu: "จำนวน _MENU_ รายการ",
                    info: "จำนวน _START_ - _END_ จาก _TOTAL_ รายการ",
                    paginate: {
                        previous: 'ก่อนหน้า',
                        next: 'ถัดไป'
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
                            return "กลุ่มอุตสาหกรรม"      
                        }, 
                        exportOptions: {
                            columns: [ 0, 1 ]
                        },
                    },
                    { 
                        extend: 'pdfHtml5',
                        customize: function(doc) {
                            doc.defaultStyle = {
                                font:'THSarabun',
                                fontSize:14                                 
                            };
                            doc.content[1].table.widths = [50,450];
                            var rowCount = doc.content[1].table.body.length; 
                            for (i = 1; i < rowCount; i++) { 
                                doc.content[1].table.body[i][0].alignment = 'center'; 
                                doc.content[1].table.body[i][1].alignment = 'left';
                            }; 
                        },
                        exportOptions: {
                            columns: [ 0, 1 ]
                        },
                        title: function () { 
                            return "รายการกลุ่มอุตสาหกรรม"; 
                        },
                        filename: function() {
                            return "กลุ่มอุตสาหกรรม"      
                        }, 
                    },    
                ],
                drawCallback: function() {
                    $('.buttons-excel')[0].style.visibility = 'hidden'
                    $('.buttons-pdf')[0].style.visibility = 'hidden'
                }
            } );
            
        } );
    </script>
@stop