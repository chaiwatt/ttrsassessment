@extends('layouts.dashboard.main')
@section('pageCss')
<style>
      select.form-control{
        display: inline;
        width: 200px;
        margin-left: 25px;
        font-size: 16px
    }
</style>
@stop
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">รายงานผลการประเมิน</span></h4>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">ผลการประเมินโครงการ</h6>
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
                        
                        <div class="table-responsive">
                            @if ($fulltbps->count() > 0)
                                <div >
                                    <select id="gradeFilter_tb1" class="form-control">
                                    <option value="">== เกรด ==</option>
                                    @foreach ($gradecollection->sortDesc()->reverse() as $grade)
                                        <option value="{{$grade}}">{{$grade}}</option>
                                    @endforeach
                                    {{-- <option value="AAA">AAA</option>
                                    <option value="AA">AA</option>
                                    <option value="A">A</option>
                                    <option value="BBB">BBB</option>
                                    <option value="BB">BB</option>
                                    <option value="B">B</option>
                                    <option value="CCC">CCC</option>
                                    <option value="CC">CC</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option> --}}
                                    </select>
                                </div>
                                <div >
                                    <select id="leaderFilter_tb1" class="form-control ">
                                    <option value="">== Leader ==</option>
                                    @foreach ($leaders as $leader)
                                        <option value="{{$leader->name}} {{$leader->lastname}}">{{$leader->name}} {{$leader->lastname}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div >
                                    <select id="expertFilter_tb1" class="form-control">
                                    <option value="">== ผู้เชี่ยวชาญ ==</option>
                                        @foreach ($experts as $expert)
                                            <option value="{{$expert->name}} {{$expert->lastname}}">{{$expert->name}} {{$expert->lastname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <table class="table table-bordered text-nowrap mb-2" id="maintable">
                                <thead>
                                    <tr class="bg-info">
                                        <th hidden>date</th>
                                        <th style="width:1%;white-space: nowrap;text-align:center">เลขที่โครงการ</th>
                                        <th style="text-align: center">ชื่อโครงการ</th> 
                                         
                                        <th style="text-align: center">คะแนน</th>
                                        <th style="text-align: center">เกรด</th>     
                                        <th style="width:1%;white-space: nowrap;text-align: center">รายงานผล</th>    
                                        <th style="width:1%;white-space: nowrap;text-align: center">แจ้งผล</th> 
                                        <th style="width:1%;white-space: nowrap;text-align: center">แจ้งผลทางจดหมาย</th>  
                                        <th style="width:1%;white-space: nowrap;text-align: center">สิ้นสุดโครงการ</th>   
                                        <th style="width:1%;white-space: nowrap;text-align:center" hidden>hidden_leader</th> 
                                        <th style="width:1%;white-space: nowrap;text-align:center" hidden>hidden_expert</th>                             
                                        <th style="width:1%;white-space: nowrap;text-align:center" hidden>hidden_grade</th>   
           
                                    </tr>
                                </thead>
                                <tbody style="min-height:300px">
                                    @foreach ($fulltbps as $key => $fulltbp)
                                        @if ($fulltbp->minitbp->businessplan->business_plan_status_id >= 8 && $fulltbp->canceldate == null)
                                            @if (Auth::user()->isProjectLeader($fulltbp->id) == 1 || Auth::user()->user_type_id >= 5)
                                                <tr>    
                                                    <td hidden>{{$fulltbp->updated_at}}</td>
                                                    <td style="white-space: nowrap;text-align:center">{{$fulltbp->fulltbp_code}}</td>  
                                                    <td> {{$fulltbp->minitbp->project}} </td> 
                                                   
                                                    <td style="text-align: center"> {{number_format(@$fulltbp->projectgrade->percent, 2, '.', '')}} </td>  
                                                    <td style="text-align: center"> {{@$fulltbp->projectgrade->grade}} </td> 
                                                    <td style="white-space: nowrap"> 
                                                        @if(@$fulltbp->projectstatustransaction(8)->status != 2)
                                                            <a href="{{route('dashboard.admin.evaluationresult.edit',['id' => $fulltbp->evaluationresult->id])}}" class="btn btn-sm bg-info">เขียนบทวิเคราะห์</a>
                                                        @endif  
                                                        @if (!Empty(@$fulltbp->evaluationresult->management) && !Empty(@$fulltbp->evaluationresult->technoandinnovation) && !Empty(@$fulltbp->evaluationresult->marketability) && !Empty(@$fulltbp->evaluationresult->businessprospect))
                                                            <button type="button" class="btn btn-sm bg-info dropdown-toggle" data-toggle="dropdown">จดหมายแจ้งผล</button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="{{route('dashboard.admin.evaluationresult.pdf',['id' => $fulltbp->evaluationresult->id])}}" class="dropdown-item" target="_blank"><i class="icon-download"></i> ไฟล์ PDF</a>
                                                                <a href="{{route('dashboard.admin.evaluationresult.word',['id' => $fulltbp->evaluationresult->id])}}" class="dropdown-item" target="_blank"><i class="icon-download"></i> ไฟล์ WORD</a>
                                                            </div>
                                                        @endif
                                                        
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm bg-info dropdown-toggle" data-toggle="dropdown">Certificate</button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="{{route('dashboard.admin.evaluationresult.certificate',['id' => $fulltbp->evaluationresult->id, 'type' => '1'])}}" class="dropdown-item" target="_blank"><i class="icon-file-eye"></i> ตัวอย่างการแสดงผล</a>
                                                                <a href="{{route('dashboard.admin.evaluationresult.certificate',['id' => $fulltbp->evaluationresult->id, 'type' => '2'])}}" class="dropdown-item" target="_blank"><i class="icon-download"></i> ดาวน์โหลด PDF</a>
                                                                <a href="{{route('dashboard.admin.evaluationresult.ppt',['id' => $fulltbp->evaluationresult->id, 'type' => '2'])}}" class="dropdown-item" target="_blank"><i class="icon-download"></i> ดาวน์โหลด PPT</a>
                                                            </div>
                                                        </div>
                                                    </td> 
                                                    <td style="white-space: nowrap;text-align: center"> 
                                                        @if ($fulltbp->minitbp->businessplan->business_plan_status_id >=9)
                                                            <span class="badge badge-flat border-success text-success-600">แจ้งผลแล้ว</span>
                                                        @else
                                                            @if ($fulltbp->minitbp->businessplan->business_plan_status_id == 8 && $generalinfo->use_invoice_status_id == 2)
                                                                <button class="btn btn-sm bg-warning notifyresult" data-id="{{$fulltbp->minitbp->id}}"><i class="icon-spinner spinner mr-2" id="spinresultnity" hidden></i>แจ้งผล</button>
                                                            @endif
                                                        @endif

                                                    </td>
                                                    <td style="white-space: nowrap;text-align: center">
                                                        @if (!Empty($fulltbp->projectstatustransaction(7)))
                                                                @if ($fulltbp->projectstatustransaction(7)->status == 2)  
                                                                        <span class="badge badge-flat border-success text-success-600">ส่งจดหมายแล้ว</span>
                                                                    @elseif($fulltbp->projectstatustransaction(7)->status == 1)
                                                                    
                                                                        @if (Auth::user()->user_type_id == 4)
                                                                        {{-- dashboard.admin.evaluationresult.attachment --}}
                                                                            <a href="{{route('dashboard.admin.evaluationresult.attachment',['id' => $fulltbp->id])}}" data-name="" class="btn btn-sm bg-info">เอกสารแนบ</a>
                                                                            <button class="btn btn-sm bg-warning confirmsendletter" data-id="{{$fulltbp->minitbp->id}}"><i class="icon-spinner spinner mr-2" id="spinlettersent" hidden></i>ยืนยันส่งจดหมาย</button>
                                                                        @else 
                                                                            {{-- <button class="btn btn-sm bg-warning confirmsendletter" data-id="{{$fulltbp->minitbp->id}}">ยืนยันส่งจดหมาย</button> --}}
                                                                            <span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้ส่งจดหมายแจ้งผล</span>
                                                                        @endif
                                                                @endif  
                                                            @else
                                                                <span class="badge badge-flat border-warning text-warning-600">รอการยืนยัน</span>
                                                        @endif
                                                    </td>
                                                    <td style="white-space: nowrap;text-align: center"> 
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
                                                    <td hidden>{{@$fulltbp->searchprojectleader}}</td>
                                                    <td hidden>{{@$fulltbp->searchprojectexpert}}</td>
                                                    <td hidden>{{@$fulltbp->searchprojectgrade}}</td>
                                            </tr>
                                            @endif
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
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>

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
                    title: 'โปรดยืนยัน',
                    text: `ต้องการสิ้นสุดโครงการ`,
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
                title: 'โปรดยืนยัน',
                text: `ยืนยันการส่งจดหมายแล้ว `,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                closeOnConfirm: false,
                closeOnCancel: false
                }).then((result) => {
                if (result.value) {
                    $("#spinlettersent").attr("hidden",false);
                    LetterSent($(this).data('id')).then(data => {
                        window.location.reload();
                    })
                .catch(error => {})
                }
            });
        }); 

        $(document).on("click",".notifyresult",function(e){
            Swal.fire({
                title: 'โปรดยืนยัน',
                text: `การแจ้งผลจะแสดงเกรดและผลการประเมินให้ผู้ประกอบการทราบ ยืนยันแจ้งผลการประเมิน`,
                type: 'warning',
                showCancelButton: true,
                showDenyButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                denyButtonText: `Preview`,
                closeOnConfirm: false,
                closeOnCancel: false
                }).then((result) => {
                if (result.value) {
                    $("#spinresultnity").attr("hidden",false);
                    NotifyResult($(this).data('id')).then(data => {
                        window.location.reload();
                    })
                .catch(error => {})
                }
            });
        }); 

        function NotifyResult(id){
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: `${route.url}/api/assessment/notifyresult`,
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

        var countitemtable =  "{{$fulltbps->count()}}";
        // if (countitemtable >= 7) {
            $('#maintable').DataTable( {
                "paging":   true,
                "ordering": true,
                "order": [[ 0, 'desc' ]],
                "info":     false,
                "pageLength" : 7,
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
                            return "ผลการประเมินโครงการ" ;      
                        }, 
                        exportOptions: {
                            columns: [  1,2,3,4, 6,7,8]
                        },
                        customize: function( xlsx ) {
                            var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                            source.setAttribute('name','ผลการประเมินโครงการ');
                        }, 
                    }        
                ],
                drawCallback: function() {
                    // $('.buttons-excel')[0].style.visibility = 'hidden';
                }
            });

            var table_tb1 = $('#maintable').DataTable();
            $("#maintable_filter.dataTables_filter").append($("#leaderFilter_tb1"));
            $("#maintable_filter.dataTables_filter").append($("#expertFilter_tb1"));
            $("#maintable_filter.dataTables_filter").append($("#gradeFilter_tb1"));

            var leaderindex_tb1 = 0;
            var expertrindex_tb1 = 0;
            var gradeindex_tb1 = 0;
            
            $("#maintable th").each(function (i) {
                if ($($(this)).html() == "hidden_leader") {
                    leaderindex_tb1 = i; 
                }
                if ($($(this)).html() == "hidden_expert") {
                    expertrindex_tb1 = i; 
                }
                if ($($(this)).html() == "hidden_grade") {
                    gradeindex_tb1 = i; 
                }
            });
            $("#leaderFilter_tb1").change(function (e) {
                customSearhExact_tb1("#leaderFilter_tb1",leaderindex_tb1);
                $("#expertFilter_tb1").prop("selectedIndex", 0);
                $("#gradeFilter_tb1").prop("selectedIndex", 0);
            });
            $("#expertFilter_tb1").change(function (e) {
                customSearhContain_tb1("#expertFilter_tb1",expertrindex_tb1);
                $("#leaderFilter_tb1").prop("selectedIndex", 0);
                $("#gradeFilter_tb1").prop("selectedIndex", 0);
            });
            $("#gradeFilter_tb1").change(function (e) {
                customSearhExact_tb1("#gradeFilter_tb1",gradeindex_tb1);
                $("#leaderFilter_tb1").prop("selectedIndex", 0);
                $("#expertFilter_tb1").prop("selectedIndex", 0);
            });

            function customSearhContain_tb1(el,elindex){
                $.fn.dataTable.ext.search = [];
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        var elval = $(el).val();

                        var arr = data[elindex];
                            if (elval === '' || arr.includes(elval)) {  
                                return true;
                            }
                        return false;
                    }
                );
                table_tb1.draw();
            }
            function customSearhExact_tb1(el,elindex){
                $.fn.dataTable.ext.search = [];
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        var elval = $(el).val();
                        var arr = data[elindex];
                            if (elval === '' || (arr == elval)) {  
                                return true;
                            }
                        return false;
                    }
                );
                table_tb1.draw();
            }
        // }
        $(document).on('click', '#select_maintable_excel', function(e) {
            $('#maintable').DataTable().buttons(0,0).trigger();
        });

    </script>
@stop