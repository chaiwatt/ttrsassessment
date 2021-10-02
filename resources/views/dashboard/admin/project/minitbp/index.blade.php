@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/plugins/summernote/summernote.min.css')}}" rel="stylesheet">
<style>
    td{
        padding-left:5px !important;
        padding-right:5px !important;
    }

    textarea{
        font-size: 16px !important;
    }
</style>
@stop
@section('content')
    <div id="modal_edit_minitbp" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;<span id="minitbptitle"></span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="text" id="minitbpid" hidden>
                        <form id="my_radio_box">
                            <div class="col-md-12">
                                @if (Auth::user()->user_type_id == 4)
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-input-styled" name="result" value="1" data-fouc>
                                            อนุมัติ
                                        </label>
                                    </div>
                                @endif
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-input-styled" name="result" value="2" checked data-fouc>
                                        ให้แก้ไข
                                    </label>
                                </div>
                            </div>
                        </form>

                        <hr>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label id="messageshow">ข้อความเพิ่มเติม</label>
                                <textarea type="text" rows="5"  id="note" placeholder="ข้อความเพิ่มเติม แจ้งไปยังผู้ประกอบการ" class="form-control form-control-lg"></textarea>
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_edit_minitbp" class="btn bg-primary"><i class="icon-checkmark3 font-size-base mr-1"></i> บันทึก</button>
                </div>
            </div>
        </div>
    </div>

        {{-- modal_add_jdmessage --}}
        <div id="modal_add_jdmessage" class="modal fade" style="overflow:hidden;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ความเห็น Manager</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="text" id="minitbpid" hidden>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>ความเห็น</label>
                                    <textarea type="text" rows="5" id="messagebody" placeholder="ความเห็น Manager" class="form-control form-control-lg" @if (Auth::user()->user_type_id != 6) readonly @endif></textarea>
                                </div>
                            </div>
                        </div>
                    </div>           
                    <div class="modal-footer">
                        <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                        @if (Auth::user()->user_type_id == 6)
                            <button id="btn_modal_add_jdmessage" class="btn bg-primary"><i class="icon-spinner spinner mr-2" id="userspinicon" hidden></i> <span id="btnname">เพิ่ม</span> </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
            {{-- modal_show_controlflow --}}
            <div id="modal_show_controlflow" class="modal fade" style="overflow:hidden;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;Control Flow</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="text" id="minitbpid" hidden>
                                <div class="col-md-12" id="flowlist_wrapper">
        
                                </div>
                            </div>
                        </div>           
                    </div>
                </div>
            </div>

    <div id="modal_show_reviselog" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;รายการแก้ไข โครงการ<span id="showlogminitbp"></span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" >
                            <div class="table-responsive" >
                                <table style="width: 100%" class="table table-bordered table-striped" >
                                    <thead>
                                        <tr>
                                            <th style="white-space: nowrap;text-align: center">รายละเอียด</th> 
                                            <th style="white-space: nowrap;text-align: center">ให้แก้ไขโดย</th>
                                            <th style="white-space: nowrap;text-align: center">วันที่</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="reviselog_wrapper_tr"> 
        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal_show_approvelog" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;โครงการ: <span id="showapprovelogminitbp"></span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" >
                            <div class="table-responsive" >
                                <table style="width: 100%" class="table table-bordered table-striped" >
                                    <thead>
                                        <tr>
                                            <th style="white-space: nowrap;text-align: center">รายละเอียด</th> 
                                            <th style="white-space: nowrap;text-align: center">อนุมัติโดย</th>
                                            <th style="white-space: nowrap;text-align: center">วันที่</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <td id="approvelog_detail"></td>
                                        <td id="approvelog_info"></td>
                                        <td style="text-align: center;width:1%;white-space: nowrap" id="approvelog_date"></td>
        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page header -->
    <div class="page-header page-header-light">  
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">แบบคำขอรับการประเมิน (Mini TBP)</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <span class="breadcrumb-item active">แบบคำขอรับการประเมิน (Mini TBP)</span>
                </div>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>


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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">รายการขอรับการประเมิน</h6>
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
                                        <th hidden>date</th>
                                        <th style="width:1%;white-space: nowrap;text-align:center">เลขที่ Mini TBP</th> 
                                        <th style="width:1%;white-space: nowrap;text-align:center">ชื่อโครงการ</th> 
                                        
                                        <th style="width:1%;white-space: nowrap;text-align:center">บริษัท</th>
                                        <th style="width:1%;white-space: nowrap;text-align:center">ความเห็น Manager</th>
                                        <th style="width:1%;white-space: nowrap;text-align:center" hidden>ความเห็น Manager</th>
                                        @if (Auth::user()->user_type_id == 4)
                                            <th style="width:1%;white-space: nowrap;text-align:center">การอนุมัติ</th> 
                                        @endif
                                        
                                        <th style="width:1%;white-space: nowrap;text-align:center">เพิ่มเติม</th>                                  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($minitbps as $key => $minitbp)
                                        @if (Empty($minitbp->fulltbp->canceldate))
                                            <tr>    
                                                <td hidden>{{$minitbp->updated_at}}</td> 
                                                <td style="width:1%;white-space: nowrap;text-align:center">{{$minitbp->minitbp_code}}</td>
                                                <td style="white-space: nowrap;"> 
                                                    <a href="#" data-toggle="modal" data-id="{{$minitbp->id}}" class="controlflowicon"><i class="icon-cog2 text-info mr-2"></i></a>
                                                    <a href="{{route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id])}}" class="text-info" target="_blank">{{$minitbp->project}}</a>
                                                </td> 
                                                 
                                                <td style="white-space: nowrap"> 
                                                    @php
                                                        $company = $minitbp->businessplan->company;
                                                        $company_name = (!Empty($company->name))?$company->name:'';
                                                        $bussinesstype = $company->business_type_id;
                                                        $fullcompanyname = ' ' . $company_name;
                                                        if($bussinesstype == 1){
                                                            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด (มหาชน)';
                                                        }else if($bussinesstype == 2){
                                                            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด'; 
                                                        }else if($bussinesstype == 3){
                                                            $fullcompanyname = ' ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
                                                        }else if($bussinesstype == 4){
                                                            $fullcompanyname = ' ห้างหุ้นส่วนสามัญ ' . $company_name; 
                                                        }else{
                                                            $fullcompanyname = $minitbp->businessplan->company->name; 
                                                        }
                                                    @endphp
                                                    {{$fullcompanyname}} 
                                                </td> 
                                                <td style="width:1%;white-space: nowrap;text-align:center"> 
                                                    @if (Empty($minitbp->jdmessage))
                                                            @if (Auth::user()->user_type_id == 6)
                                                                @if ($minitbp->businessplan->business_plan_status_id == 3 && $minitbp->businessplan->projectassignment->leader_id == null)
                                                                        <a data-message="{{$minitbp->businessplan->projectassignment->leader_id}}" href="#" data-id="{{$minitbp->businessplan->projectassignment->id}}" data-toggle="modal" class="btn btn-sm bg-warning jdmessage">เพิ่มความเห็น</a>
                                                                @endif
                                                                
                                                            @endif
                                                        @else
                                                            <a data-message="{{$minitbp->businessplan->projectassignment->leader_id}}" href="#" data-id="{{$minitbp->id}}" data-toggle="modal" class="btn btn-sm bg-info jdmessage">ดูความเห็น</a>
                                                    @endif
                                                </td>  
                                                <td hidden>{{$minitbp->jdmessage}}</td>
                                                @if (Auth::user()->user_type_id == 4)
                                                    <td style="width:1%;white-space: nowrap;text-align:center"> 
                                                        @if ($minitbp->businessplan->business_plan_status_id > 3)
                                                            <span class="badge badge-flat border-success text-success-600">ผ่านการอนุมัติ</span>
                                                                @if (!Empty($minitbp->approvelog))
                                                                    
                                                                        <a href="#" data-id="{{$minitbp->id}}" data-doctype="1" data-project="{{$minitbp->project}}" class="btn btn-sm bg-success showapprovelog">การอนุมัติ</a>
                                                                @endif

                                                                @if ($minitbp->reviselog(1)->count() > 0)
                                                                    <a href="#" data-id="{{$minitbp->id}}" data-doctype="1" data-project="{{$minitbp->project}}" class="btn btn-sm bg-pink showlog">รายการแก้ไข</a>
                                                                @endif
                                                            @else
                                                                @if ($minitbp->refixstatus == 0)
                                                                        <a href="#" data-id="{{$minitbp->id}}" id="editapprove" data-project="{{$minitbp->project}}" class="btn btn-sm bg-warning"><i class="icon-spinner spinner mr-2" id="spinicon{{$minitbp->id}}" hidden></i>ยังไม่ได้อนุมัติ</a>
                                                                    @elseif($minitbp->refixstatus == 1)
                                                                            <span class="badge badge-flat border-pink text-pink-600">ส่งคืนแก้ไข</span>
                                                                            
                                                                        @if ($minitbp->reviselog(1)->count() > 0)
                                                                            <a href="#" data-id="{{$minitbp->id}}" data-project="{{$minitbp->project}}" data-doctype="1" class="btn btn-sm bg-pink showlog" ><i class="icon-spinner spinner mr-2" id="spinicon_showlog{{$minitbp->id}}" hidden></i>รายการแก้ไข</a>
                                                                        @endif
                                                                    @elseif($minitbp->refixstatus == 2)
                                                                        <a  href="#" data-id="{{$minitbp->id}}" id="editapprove" data-project="{{$minitbp->project}}" class="btn btn-sm bg-indigo"><i class="icon-spinner spinner mr-2" id="spinicon{{$minitbp->id}}" hidden></i>มีการแก้ไขแล้ว</a>
                                                                        @if ($minitbp->reviselog(1)->count() > 0)
                                                                            <a href="#" data-id="{{$minitbp->id}}" data-project="{{$minitbp->project}}" data-doctype="1" class="btn btn-sm bg-pink showlog"><i class="icon-spinner spinner mr-2" id="spinicon_showlog{{$minitbp->id}}" hidden></i>รายการแก้ไข</a>
                                                                        @endif
                                                                @endif
                                                        @endif
                                                    </td> 
                                                @endif
                                                <td style="width:1%;white-space: nowrap;"> 
                                                    <a  href="{{asset($minitbp->attachment)}}" class="btn btn-sm bg-teal" target="_blank">ดาวน์โหลด</a>
                                                    <a  href="{{route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id])}}" class="btn btn-sm bg-primary" target="_blank">รายละเอียด</a>
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

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>

<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
<script src="{{asset('assets/dashboard/plugins/summernote/summernote.min.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/approveminitbphelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/controlflow.js?v=1')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}",
            popupmessages : JSON.parse(JSON.stringify({!! json_encode($popupmessages) !!}))
        };

        $(document).on('click', '.jdmessage', function(e) {
            getJdMessage($(this).data('id')).then(data => {
                $('#messagebody').val('');
                if(data.jdmessage != null && $(this).data('message') != ''){
                    $("#messagebody").prop("readonly",true);
                    $("#btn_modal_add_jdmessage").attr("hidden",true);
                }else{
                    $("#messagebody").prop("readonly",false);
                    $("#btn_modal_add_jdmessage").attr("hidden",false); 
                }

                if(data.jdmessage !=  null){
                    $('#btnname').html("แก้ไข");
                }

                $('#messagebody').val(data.jdmessage);
                $('#minitbpid').val($(this).data('id'));
                

                $('#modal_add_jdmessage').modal('show');
            })
            .catch(error => {}) 
        });

        $('#note').summernote({
            toolbar: false,
            height: 200,
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }
        });
          
        $(document).on('click', '#btn_modal_add_jdmessage', function(e) {
            addJdMessage($('#minitbpid').val(),$('#messagebody').val()).then(data => {
                $('#modal_add_jdmessage').modal('hide');
                window.location.reload();
            })
            .catch(error => {}) 
        });

        function getJdMessage(id){
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: `${route.url}/api/minitbp/getjdmessage`,
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

        function addJdMessage(id,message){
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: `${route.url}/api/minitbp/addjdmessage`,
                    type: 'POST',
                    headers: {"X-CSRF-TOKEN":route.token},
                    data: {
                        id : id,
                        message : message
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

        var countitemtable =  "{{$minitbps->count()}}";
        if (countitemtable >= 1) {
            $('#maintable').DataTable( {
                "paging":   true,
                "ordering": true,
                "order": [[ 0, 'desc' ]],
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
                            return "รายการขอรับการประเมิน" ;      
                        }, 
                        exportOptions: {
                            columns: [  1,2,3, 5]
                        },
                        customize: function( xlsx ) {
                            var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                            source.setAttribute('name','รายการขอรับการประเมิน');
                        }, 
                    }        
                ],
                drawCallback: function() {
                    // $('.buttons-excel')[0].style.visibility = 'hidden';
                }
            });
        }

        $(document).on('click', '#select_maintable_excel', function(e) {
            $('#maintable').DataTable().buttons(0,0).trigger();
        });

    </script>
@stop