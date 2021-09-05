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
                <h4> <span class="font-weight-semibold">โครงการทั้งหมดแยกตามปี</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> รายงาน</a>
                    <span class="breadcrumb-item">โครงการ</span>
                    <span class="breadcrumb-item active">โครงการทั้งหมดแยกตามปี</span>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">โครงการทั้งหมดแยกตามปี</h6>
                        <div class="header-elements">
                            <a class="text-default daterange font-weight-semibold cursor-pointer dropdown-toggle">
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('dashboard.admin.realtimereport.project.getallbyyear')}}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
									<div class="form-group">
										<label>เลือกปี</label>
										<select name="year" data-placeholder="ปี" value="{{old('year')}}"  class="form-control form-control-lg form-control-select2">
                                            <option value="0" > == เลือกทั้งหมด ==</option>
											@foreach ($years as $year)
                                                <option value="{{$year}}" @if ($year == Request::get('year')) selected @endif >{{$year+543}}</option> 
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
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-2" id="searchtable">
                                        <thead>
                                            <tr class="bg-info">
                                                <th style="text-align: center;width:1%;white-space: nowrap">เลขที่โครงการ</th> 
                                                <th style="text-align: center">วันที่ขอรับการประเมิน</th> 
                                                <th style="text-align: center">โครงการ</th> 
                                                <th style="text-align: center">บริษัท</th> 
                                                <th style="text-align: center;width:1%;white-space: nowrap">ปี พ.ศ.</th> 
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @foreach ($fulltbps as $fulltbp)
                                                @if ($fulltbp->minitbp->businessplan->business_plan_status_id >2)
                                                    <tr>
                                                        <td style="text-align: center">{{$fulltbp->minitbp->businessplan->code}}</td>
                                                        <td style="text-align: center">{{$fulltbp->submitdateth}}</td>
                                                        <td><a href="{{route('dashboard.admin.report.detail.view',['id' => $fulltbp->minitbp->businessplan->id])}}" class="text-info">{{$fulltbp->minitbp->project}}</a></td>
                                                        <td><a href="{{route('dashboard.admin.search.company.profile',['id' => $fulltbp->minitbp->businessplan->company->id])}}" class="text-info">{{$fulltbp->minitbp->businessplan->company->fullname}}</a> </td>
                                                        <td style="text-align: center">{{$fulltbp->submitdateyearth}}</td>
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
            "paging":   true,
            "ordering": true,
            "order": [[ 4, 'desc' ]],
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
