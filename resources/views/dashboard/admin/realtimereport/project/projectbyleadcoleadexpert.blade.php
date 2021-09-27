@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/core/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/daygrid/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/timegrid/main.css')}}">
<link href="{{asset('assets/dashboard/js/plugins/ui/fullcalendar/list/main.css')}}">

@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">จำนวนผู้รับผิดชอบ/ผู้เข้าร่วมประเมินโครงการในแต่ละโครงการ Lead / Co-lead / Expert (ภายใน-ภายนอก)</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> รายงาน</a>
                    <a href="{{route('dashboard.admin.realtimereport')}}" class="breadcrumb-item"> ค้นหารายงาน</a>
                    <span class="breadcrumb-item active">จำนวนผู้รับผิดชอบ/ผู้เข้าร่วมประเมินโครงการในแต่ละโครงการ Lead / Co-lead / Expert (ภายใน-ภายนอก)</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <input id="attendeventid" type="text" hidden>
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">จำนวนผู้รับผิดชอบ/ผู้เข้าร่วมประเมินโครงการในแต่ละโครงการ Lead / Co-lead / Expert (ภายใน-ภายนอก)</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange font-weight-semibold cursor-pointer dropdown-toggle">
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('dashboard.admin.realtimereport.project.getprojectbyleadcoleadexpert')}}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
									<div class="form-group">
										<label>เลือกโครงการ</label>
										<select name="fulltbp" data-placeholder="เลือกโครงการ" value="{{old('fulltbp')}}"  class="form-control form-control-lg form-control-select2">
											@foreach ($fulltbps as $key => $fulltbp)
                                            <option value="{{$fulltbp->id}}" @if ($fulltbp->id == Request::get('fulltbp')) selected @endif >{{$fulltbp->minitbp->project}}</option> 
											@endforeach
										</select>
									</div>
								</div>
                                <div class="col-md-12">
                                    <button type="submit" name="btnsubmit" value="excel" class="btn btn-sm bg-teal float-right ml-1">Excel</button>  
                                    <button type="submit" name="btnsubmit" value="search" class="btn btn-sm bg-teal float-right">ค้นหา</button>  
                                </div>
                            </div>
                        </form>
                        {{-- <hr> --}}
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="table-responsive" >
                                    <table style="width: 100%" class="table table-bordered table-striped" id="searchtable">
                                        <thead>
                                            <tr class="bg-info">
                                                <th style="width:600px;text-align:center">ตำแหน่งรับผิดชอบ</th> 
                                                <th style="text-align: center">ชื่อ-นามสกุล</th> 
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <td>Leader</td>  
                                                <td>
                                                    @if (!Empty($projectassignment->leader_id))
                                                    {{$projectassignment->leader->name}} {{$projectassignment->leader->lastname}}
                                
                                                    @endif
                                                   
                                                </td>                                     
                                            </tr>  
                                            <tr>
                                                <td>Co-Leader</td>  
                                                <td>
                                                    @if (!Empty($projectassignment->coleader_id))
                                                        {{$projectassignment->coleader->name}} {{$projectassignment->coleader->lastname}}
                                                 
                                                    @endif                                                   
                                                </td>                                   
                                            </tr>
                                            @foreach ($expertassignments as $key => $expertassignment)
                                            <tr>
                                                @if ($key == 0)
                                                <td rowspan="{{$expertassignments->count()}}" >ผู้เชี่ยวชาญ</td>  
                                                @endif
                                                <td>
                                                 {{$expertassignment->user->name}} {{$expertassignment->user->lastname}} {{$expertassignment->isExternal($expertassignment->user_id)}}
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
 
        </div>

        {{-- <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">โครงการต่อการยื่น ปี2563</h6>
                        <div class="header-elements">
                            <a class="text-default font-weight-semibold cursor-pointer dropdown-toggle">
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="reportproject_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">ข้อมูลย้อนหลัง ปี2561-2563</h6>
                        <div class="header-elements">
                            <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                <span></span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="bar_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
{{-- <script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/echart/echarts.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/pickers/daterangepicker.js')}}"></script> --}}
{{-- <script type="module" src="{{asset('assets/dashboard/js/app/helper/reportprojecthelper.js')}}"></script> --}}
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
<script>
    var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content'),
        branchid: "{{Auth::user()->branch_id}}"
    };

</script>

@stop
