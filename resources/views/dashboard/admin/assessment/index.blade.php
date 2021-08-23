@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
  {{-- modal_show_conflict --}}
  <div id="modal_pending_user" class="modal fade" style="overflow:hidden;">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;รายการผู้ยังไม่ได้ลงคะแนน</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="criteriatable_modal">
                        <thead>
                            <tr>
                                <th>ชื่อ-นามสกุล</th>                                                                                   
                            </tr>
                        </thead>
                        <tbody id="pending_user_modal_wrapper_tr"> 

                        </tbody>
                    </table>
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
                <h4> <span class="font-weight-semibold">สรุปคะแนน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ประเมิน</a>
                    <span class="breadcrumb-item active">สรุปคะแนน</span>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">สรุปคะแนนการประเมิน</h6>
                        <div class="header-elements">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap mb-2" id="maintable">
                                <thead>
                                    <tr class="bg-info">
                                        <th hidden>date</th>
                                        <th style="text-align: center">ชื่อโครงการ</th>
                                        <th style="text-align: center">บริษัท</th>
                                        <th style="width:1%;white-space: nowrap">สถานะ</th>                   
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fulltbps as $key => $fulltbp)
                                        @if (Empty($fulltbp->canceldate))
                                            @if (!Empty($fulltbp->finalassessmentdate) && $fulltbp->canceldate == null)
                                                @if (Auth::user()->isProjectLeader($fulltbp->id) == 1 || Auth::user()->user_type_id >= 5)
                                                    <tr>  
                                                        <td hidden>{{$fulltbp->updated_at}}</td>   
                                                        <td> {{$fulltbp->minitbp->project}} </td>  
                                                        <td> {{$fulltbp->minitbp->businessplan->company->fullname}} </td>
                                                        
                                                        <td style="white-space: nowrap">
                                                                @if ($fulltbp->allscoring == 0)
                                                                    @if ($fulltbp->done_assessment != 0)
                                                                            @if ($fulltbp->ev->status == 5)
                                                                                    <a href="{{route('dashboard.admin.assessment.summary',['id' => $fulltbp->id])}}" class="btn btn-sm bg-success">สรุปเกรด</a>
                                                                                @else
                                                                                    <a href="{{route('dashboard.admin.assessment.edit',['id' => $fulltbp->id])}}" class="btn btn-sm bg-warning">ปรับปรุงคะแนน</a>
                                                                            @endif
                                                                        @else
                                                                        <span class="badge badge-flat border-warning text-warning-600">รอเวลาสรุปคะแนน ({{@$fulltbp->finalassessmentdate}})</span>
                                                                            
                                                                    @endif     
                                                                @else   
                                                                        <button data-id="{{$fulltbp->id}}" class="btn btn-sm bg-warning pendinguser">ยังไม่ได้ประเมิน {{$fulltbp->allscoring}} คน</button>
                                                                @endif 
                                                        </td>                                
                                                    </tr>
                                                @endif
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
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/dashboardadminassessmentindexhelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
        
        var countitemtable =  "{{$fulltbps->count()}}";
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
                }
            });
        }
    </script>
@stop