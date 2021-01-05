@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <div id="modal_expert_accept" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;ยอมรับการมอบหมาย</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="text" id="fulltbpid" hidden>
                        <form id="my_radio_box">
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-input-styled" name="result" value="2" checked data-fouc>
                                        ยอมรับ
                                    </label>
                                </div>
            
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-input-styled" name="result" value="1" data-fouc>
                                        ปฏิเสธ
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_expert_accept" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> บันทึก</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">รายการ Full TBP </span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <span class="breadcrumb-item active">รายการ Full TBP</span>
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
                        <h6 class="card-title">รายการ Full TBP</h6>
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
                                        <th>เลขที่โครงการ</th> 
                                        <th>ชื่อโครงการ</th> 
                                        <th>บริษัท</th>
                                        <th>ยอมรับการมอบหมาย</th>
                                        <th>ลงความเห็น</th>
                                        <th>เพิ่มเติม</th>                                                                  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fulltbps as $key => $fulltbp)
                                    <tr>    
                                        <td> {{$fulltbp->minitbp->businessplan->code}} </td> 
                                        <td> {{$fulltbp->minitbp->project}} </td>  
                                        <td> {{$fulltbp->minitbp->businessplan->company->name}} </td> 
                                        <td> 
                                            @if ($fulltbp->expertassignment->accepted > 1)
                                                    <a href="#" data-id="{{$fulltbp->id}}" class="badge badge-flat border-success text-success-600 acceptfulltbp">ยอมรับ</a>
                                                @elseif($fulltbp->expertassignment->accepted == 1)
                                                    <a href="#" data-id="{{$fulltbp->id}}" class="badge badge-flat border-danger text-danger-600 acceptfulltbp">ปฏิเสธ</a>
                                                @elseif($fulltbp->expertassignment->accepted == 0)
                                                    <a href="#" data-id="{{$fulltbp->id}}" class="btn-sm bg-warning acceptfulltbp"><i class="icon-spinner spinner mr-2" id="spinicon{{$fulltbp->id}}" hidden></i>ยังไม่ได้ยอมรับ</a>
                                            @endif
                                        </td> 
                                        <td> 
                                            @if ($fulltbp->expertassignment->accepted > 1)
                                                <a href="{{route('dashboard.expert.project.comment.edit',['fulltbpid' => $fulltbp->id])}}" class="btn-sm bg-info">ลงความเห็น</a>                                      
                                            @endif  
                                        </td> 
                                        <td> 
                                            @if ($fulltbp->expertassignment->accepted > 1)
                                                <a href="{{asset($fulltbp->attachment)}}" class="btn-sm bg-teal">ดาวน์โหลด</a>
                                                <a href="{{route('dashboard.expert.project.fulltbp.view',['id' => $fulltbp->id])}}" class="btn-sm bg-primary">รายละเอียด</a>                                      
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
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };

        // 

        $(document).on('click', '.acceptfulltbp', function(e) {
            $('#fulltbpid').val($(this).data('id'));
            $('#modal_expert_accept').modal('show');
        });

        $(document).on('click', '#btn_modal_expert_accept', function(e) {
            $("#spinicon"+$('#fulltbpid').val()).attr("hidden",false);
            editAccept($('#fulltbpid').val(),$("input[name='result']:checked").val()).then(data => {
                console.log(data);
                var html = ``;        
                window.location.replace(`${route.url}/dashboard/expert/project/fulltbp`);

            }).catch(error => {})
        });

        function editAccept(id,value){
            return new Promise((resolve, reject) => {
                $.ajax({
                url: `${route.url}/dashboard/expert/project/fulltbp/editaccept`,
                type: 'POST',
                headers: {"X-CSRF-TOKEN":route.token},
                data: {
                    'id': id,
                    'value': value
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