@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">ลงคะแนน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <span class="breadcrumb-item active">ลงคะแนน</span>
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
                        <h6 class="card-title">ลงคะแนนโครงการ</h6>
                        <div class="header-elements">
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
                                        <th>เพิ่มเติม</th>                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fulltbps as $key => $fulltbp)
                                        @if ($fulltbp->finished_onsite != 1)
                                            @if ($fulltbp->minitbp->businessplan->business_plan_status_id >= 6 && $fulltbp->minitbp->businessplan->business_plan_status_id <= 8)
                                                <tr>    
                                                    <td> {{$fulltbp->minitbp->businessplan->code}} </td> 
                                                    <td> {{$fulltbp->minitbp->project}} </td>  
                                                    <td> {{$fulltbp->minitbp->businessplan->company->name}} </td> 
                                                    <td> 
                                                        @if (!Empty($fulltbp->finalassessmentdate))
                                                                @if (!Empty($fulltbp->ev->scoringstatus->count() != 0))
                                                                        <a href="{{route('dashboard.admin.project.assessment.edit',['id' => $fulltbp->id, 'userid' => Auth::user()->id])}}" class="btn btn-sm bg-success">ส่งแล้ว</a>
                                                                    @else
                                                                        <a href="{{route('dashboard.admin.project.assessment.edit',['id' => $fulltbp->id, 'userid' => Auth::user()->id])}}" class="btn btn-sm bg-warning">ยังไม่ได้ลงคะแนน</a>
                                                                @endif
                                                            @else
                                                            @if ($fulltbp->finished_onsite == 0)
                                                                <span class="badge badge-flat border-warning text-warning-600">รอ Leader ยืนยันลงพื้นที่</span>
                                                            @else
                                                                
                                                                @if (Auth::user()->user_type_id == 4)
                                                                        @if ($fulltbp->minitbp->businessplan->business_plan_status_id < 7)
                                                                            @if (Auth::user()->isProjectLeader($fulltbp->id) == 0)
                                                                                <span class="badge badge-flat border-warning text-warning-600">รอ Leader นัดหมายการสรุปคะแนน</span>
                                                                                @else
                                                                                    <a href="{{route('dashboard.admin.calendar.create')}}" class="btn btn-sm bg-warning">เพิ่มปฏิทินนัดหมายสรุปคะแนน</a>
                                                                            @endif
                                                                            
                                                                        @endif
                                                                    @else
                                                                        <span class="badge badge-flat border-warning text-warning-600">รอ Leader นัดหมายการสรุปคะแนน</span>
                                                                @endif

                                                            @endif        
                                                        @endif
                                                    </td>                                
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
    </script>
@stop