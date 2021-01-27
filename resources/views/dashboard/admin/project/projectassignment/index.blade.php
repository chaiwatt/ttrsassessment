@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    {{-- modal_add_jdmessage --}}
    <div id="modal_add_jdmessage" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ความเห็น JD</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="text" id="minitbpid" hidden>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ความเห็น</label>
                                <textarea type="text" rows="5" id="messagebody" placeholder="ความเห็น JD" class="form-control form-control-lg"></textarea>
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_add_jdmessage" class="btn bg-primary"><i class="icon-spinner spinner mr-2" id="userspinicon" hidden></i> เพิ่ม</button>
                </div>
            </div>
        </div>
    </div>

    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">รายการมอบหมาย</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <a href="#" class="breadcrumb-item"> การมอบหมาย</a>
                    <span class="breadcrumb-item active">รายการมอบหมาย</span>
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
                        <h6 class="card-title">รายการมอบหมาย</h6>
                        <div class="header-elements">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="testtopictable">
                                <thead>
                                    <tr>
                                        <th>ชื่อโครงการ</th> 
                                        <th>บริษัท</th>
                                        <th>ความเห็น JD</th>
                                        <th>Leader</th>
                                        {{-- <th>Co-Leader</th> --}}
                                        <th>สถานะ</th>
                                        @if (Auth::user()->user_type_id>=6)
                                            <th>เพิ่มเติม</th> 
                                        @endif                             
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projectassignments as $key => $projectassignment)
                                    <tr>    
                                        <td> 
                                            <a href="#" data-toggle="modal" data-id="{{$projectassignment->id}}" class="controlflowicon"><i class="icon-circle2 text-success mr-2"></i></a>
                                            <a href="{{route('dashboard.admin.project.minitbp.view',['id' => $projectassignment->businessplan->minitbp->id])}}" class="text-info" target="_blank">{{$projectassignment->businessplan->minitbp->project}} </a>
                                        </td> 
                                        <td> 
                                            {{$projectassignment->businessplan->company->name}}
                                        </td> 
                                        <td> 
                                            @if (Empty($projectassignment->businessplan->minitbp->jdmessage))
                                                    <a type="button" href="#" data-id="{{$projectassignment->businessplan->minitbp->id}}" class="btn-sm bg-warning jdmessage">เพิ่มความเห็น</a>
                                                @else
                                                    <a type="button" href="#" data-id="{{$projectassignment->businessplan->minitbp->id}}" class="btn-sm bg-info jdmessage">ดูความเห็น</a>
                                            @endif
                                            
                                        </td>  
                                        <td> 
                                            @if (!Empty($projectassignment->leader))
                                                {{$projectassignment->leader->prefix->name}}{{$projectassignment->leader->name}} {{$projectassignment->leader->lastname}}
                                            @endif
                                        </td>  
                                        {{-- <td> 
                                            @if (!Empty($projectassignment->coleader))
                                                {{$projectassignment->coleader->prefix->name}}{{$projectassignment->coleader->name}} {{$projectassignment->coleader->lastname}}
                                            @endif
                                        </td>  --}}
                                        <td>
                                            @if ($projectassignment->leader_id == null)
                                                <span class="badge badge-flat border-warning text-warning-600">ยังไม่ได้มอบหมาย</span>
                                                @else
                                                <span class="badge badge-flat border-success text-success-600">มอบหมายแล้ว</span>
                                            @endif
                                        </td>
                                        @if (Auth::user()->user_type_id>=6)
                                            <td> 
                                                @if ($projectassignment->leader_id == null)
                                                         <a type="button" href="{{route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id])}}" class="btn-sm bg-primary">มอบหมาย</a>
                                                    @else
                                                         <a type="button" href="{{route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id])}}" class="btn-sm bg-warning">แก้ไข</a>
                                                @endif
                                                
                                            </td>    
                                        @endif
                               
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
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

        $(document).on('click', '.jdmessage', function(e) {
            getJdMessage($(this).data('id')).then(data => {
                $('#messagebody').html(data.jdmessage);
                $('#minitbpid').val($(this).data('id'));
                
                $('#modal_add_jdmessage').modal('show');
            })
            .catch(error => {}) 
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
    </script>
@stop