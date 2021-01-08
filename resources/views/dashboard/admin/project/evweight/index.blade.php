@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')

    {{-- modal_approve_ev --}}
    <div id="modal_approve_ev" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;การอนุมัติ EV</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="my_radio_box">
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-input-styled" name="result" value="1" checked data-fouc>
                                        ผ่านการอนุมัติ
                                    </label>
                                </div>
            
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-input-styled" name="result" value="2" data-fouc>
                                        ไม่การอนุมัติ/ให้แก้ไข
                                    </label>
                                </div>
                            </div>
                        </form>

                        <hr>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ข้อความเพิ่มเติม<span class="text-danger">*</span></label>
                                <textarea type="text" rows="5"  id="note" placeholder="ข้อความเพิ่มเติม แจ้งไปยัง Admin" class="form-control form-control-lg"></textarea>
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_approve_ev" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> บันทึก</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">รายการ Full TBP (กำหนด Weight)</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <a href="#" class="breadcrumb-item"> กำหนด Weight</a>
                    <span class="breadcrumb-item active">รายการ FullTBP (กำหนด Weight)</span>
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
                        <h6 class="card-title">รายการ FullTBP (กำหนด Weight)</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                <span></span>
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <input id="evid" type="text" hidden>
                        <div class="table-responsive">
                            <table class="table table-striped" id="testtopictable">
                                <thead>
                                    <tr>
                                        {{-- <th>วันที่ขอส่ง</th>  --}}
                                        <th>เลขที่โครงการ</th> 
                                        <th>ชื่อโครงการ</th> 
                                        <th>บริษัท</th>
                                        <th>สถานะ EV</th>
                                        <th>เกณฑ์การประเมิน</th>                  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fulltbps as $key => $fulltbp)
                                    <tr>    
                                        {{-- <td> {{$fulltbp->updatedatth}} </td>  --}}
                                        <td> {{$fulltbp->minitbp->businessplan->code}} </td> 
                                        <td> {{$fulltbp->minitbp->project}} </td>  
                                        <td> {{$fulltbp->minitbp->businessplan->company->name}} </td> 
                                        <td> 
                                            @if (Auth::user()->user_type_id >= 6)
                                                    @if ($fulltbp->ev->refixstatus == 0)
                                                        @if ($fulltbp->ev->status >= 4)
                                                                <span class="badge badge-flat border-success text-success-600">ผ่านการอนุมัติ</span>
                                                            @else
                                                                <button type="button" id="editapprove" data-id="{{$fulltbp->ev->id}}" class="btn btn-sm bg-warning"><i class="icon-spinner spinner mr-2" id="spinicon{{$fulltbp->ev->id}}" hidden></i>อยู่ระหว่าง JD พิจารณา</button> 
                                                        @endif
                                                    @elseif($fulltbp->ev->refixstatus == 1)
                                                        <button type="button" id="editapprove" data-id="{{$fulltbp->ev->id}}" class="btn btn-sm bg-pink"><i class="icon-spinner spinner mr-2" id="spinicon{{$fulltbp->ev->id}}" hidden></i>ส่งคืนให้ Admin แก้ไข</button> 
                                                    @elseif($fulltbp->ev->refixstatus == 2)
                                                        <button type="button" id="editapprove" data-id="{{$fulltbp->ev->id}}" class="btn btn-sm bg-indigo"><i class="icon-spinner spinner mr-2" id="spinicon{{$fulltbp->ev->id}}" hidden></i>มีการแก้ไขแล้ว</button> 
                                                    @endif
                                                @else
                                                    @if ($fulltbp->ev->refixstatus == 0)
                                                        @if ($fulltbp->ev->status >= 4)
                                                                <span class="badge badge-flat border-success text-success-600">ผ่านการอนุมัติ</span>
                                                            @else
                                                                <span class="badge badge-flat border-warning text-warning-600">{{$fulltbp->ev->evstatus->name}}</span> 
                                                        @endif    
                                                    @elseif($fulltbp->ev->refixstatus == 1)
                                                        <span class="badge badge-flat border-pink text-pink-600">ให้แก้ไข EV</span>
                                                    @elseif($fulltbp->ev->refixstatus == 2)
                                                        <span class="badge badge-flat border-indigo text-indigo-600">ส่งการแก้ไขแล้ว</span>                                                       
                                                    @endif
                                            @endif
                                        </td>
                                        <td> 
                                            <a type="button" href="{{route('dashboard.admin.project.evweight.edit',['id' => $fulltbp->ev->id])}}" class="btn-sm bg-info">เพิ่มเติม</a>
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
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
{{-- <script type="module" src="{{asset('assets/dashboard/js/app/helper/approvefulltbphelper.js')}}"></script> --}}
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
    </script>
    <script>
        // $('#my_radio_box').change(function(){
        //     if($("input[name='result']:checked").val()=='1'){
        //         console.log('1');
        //         $('#note').attr('readonly', true);
        //     }else{
        //         console.log('2');
        //         $('#note').attr('readonly', false);
        //     }
        // });
        $(document).on('click', '#editapprove', function(e) {
            $('#evid').val($(this).data('id'));
            $('#modal_approve_ev').modal('show');
        });
        $(document).on('click', '#btn_modal_approve_ev', function(e) {
            $("#spinicon"+$('#evid').val()).attr("hidden",false);
            editApproveEv($('#evid').val(),$("input[name='result']:checked").val(),$('#note').val()).then(data => {
               window.location.replace(`${route.url}/dashboard/admin/project/evweight`);
           }).catch(error => {})
        });

    function editApproveEv(id,val,note){
        return new Promise((resolve, reject) => {
            $.ajax({
            url: `${route.url}/api/assessment/ev/editapprove`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
                id : id,
                val : val,
                note : note
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