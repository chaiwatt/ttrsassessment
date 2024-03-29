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
                <h4> <span class="font-weight-semibold">โครงการที่อยู่ระหว่างการประเมินของ Lead แยกรายคน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> รายงาน</a>
                    <a href="{{route('dashboard.admin.realtimereport')}}" class="breadcrumb-item"> ค้นหารายงาน</a>
                    <span class="breadcrumb-item active">โครงการที่อยู่ระหว่างการประเมินของ Lead แยกรายคน</span>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">โครงการที่อยู่ระหว่างการประเมินของ Lead แยกรายคน</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange font-weight-semibold cursor-pointer dropdown-toggle">
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('dashboard.admin.realtimereport.project.getprojectstatusbyleader')}}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
									<div class="form-group">
										<label>เลือก Lead</label>
                                        @php
                                            $check = Request::get('leader');
                                            // if(Empty($check)){
                                            //     $check = $firstleader;
                                            // }
                                        @endphp
										<select name="leader" data-placeholder="เลือก Lead" value="{{old('leader')}}"  class="form-control form-control-lg form-control-select2">
                                            <option value="0" > == เลือกทั้งหมด ==</option>
                                            @foreach ($leaders as $leader)
                                                <option value="{{$leader->id}}" @if ($leader->id == $check) selected @endif >{{$leader->name}} {{$leader->lastname}}</option> 
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
                        <hr>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="table-responsive" >
                                    <table style="width: 100%" class="table table-bordered table-striped mb-2" id="searchtable" >
                                        <thead>
                                            <tr class="bg-info">
                                                <th style="text-align: center;width:1%;white-space: nowrap">เลขที่โครงการ</th> 
                                                <th style="text-align: center">วันที่ขอรับการประเมิน</th> 
                                                <th style="text-align: center">โครงการ</th> 
                                                <th style="text-align: center">บริษัท</th> 
                                                <th style="text-align: center">Leader</th> 
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @foreach ($fulltbps as $fulltbp)
                                                {{-- @if ($fulltbp->minitbp->businessplan->business_plan_status_id >2) --}}
                                                <tr>
                                                    <td style="text-align: center;width:1%;white-space: nowrap">{{$fulltbp->fulltbp_code}}</td>
                                                    <td style="text-align: center">{{$fulltbp->minitbp->submitdateth}}</td>
                                                    <td><a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="text-info">{{$fulltbp->minitbp->project}}</a></td>
                                                    <td><a href="{{route('dashboard.admin.search.company.profile',['id' => $fulltbp->minitbp->businessplan->company->id])}}" class="text-info">{{$fulltbp->minitbp->businessplan->company->fullname}}</a> </td>
                                                    <td >{{$fulltbp->minitbp->projectleader}}</td>
                                                    
                                                </tr>
                                                {{-- @endif --}}
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

    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
{{-- <script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/echart/echarts.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/pickers/daterangepicker.js')}}"></script> --}}
{{-- <script type="module" src="{{asset('assets/dashboard/js/app/helper/reportprojecthelper.js?v=1')}}"></script> --}}
<script src="{{asset('assets/dashboard/js/app/helper/utility.js?v=1')}}"></script>
<script>
    var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content'),
        branchid: "{{Auth::user()->branch_id}}"
    };

        function thaiMonth($check){
            var stmonth = 'มกราคม';
            if($check == 1){
                stmonth = 'มกราคม';
            }else if($check == 2){
                stmonth = 'กุมภาพันธ์';
            }else if($check == 3){
                stmonth = 'มีนาคม';
            }else if($check == 4){
                stmonth = 'เมษายน';
            }else if($check == 5){
                stmonth = 'พฤษภาคม';
            }else if($check == 6){
                stmonth = 'มิถุนายน ';
            }else if($check == 7){
                stmonth = 'กรกฎาคม';
            }else if($check == 8){
                stmonth = 'สิงหาคม';
            }else if($check == 9){
                stmonth = 'กันยายน';
            }else if($check == 10){
                stmonth = 'ตุลาคม';
            }else if($check == 11){
                stmonth = 'พฤศจิกายน';
            }else if($check == 12){
                stmonth = 'ธันวาคม';
            }
            return stmonth;
        }

        $('#searchtable').DataTable( {
            "searching": false,
            "paging":   true,
            "ordering": true,
            "order": [
                [ 1, 'desc' ],
                ],
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
            }
        });
</script>

@stop
