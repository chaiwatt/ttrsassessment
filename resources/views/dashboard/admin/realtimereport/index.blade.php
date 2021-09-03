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
                <h4> <span class="font-weight-semibold">รายงาน</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    {{-- <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> รายงาน</a> --}}
                    <span class="breadcrumb-item active">รายงาน</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->




    <div class="content" >
        <div class="card card-body">
            <div class="form-group">
                <label>ค้นหารายงาน</label>
                <input type="text" id="searchreport" placeholder="ค้นหา..." class="form-control form-control-lg">
            </div>
        </div>
        <div id="report_wrapper">
        @foreach ($reporttypes as $key => $reporttype)
            @php
                $_reportlists = $reportlists->where('group_id',$reporttype->id);
                // echo(($key+1) . ' ' . count($_reportlists) . '<br>');
            @endphp
           
                @if(count($_reportlists) > 0)
                    <div class="card card-body border-top-{{$reporttype->color}}">
                        {{-- <div class="card-body"> --}}
                            <label for="">{{$reporttype->name}}</label>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row" >

                                        @foreach ($_reportlists as $reportlist)
                                            <div class="col-md-4">
                                                <div class="card card-body ">
                                                    <div class="media">
                                                        <div class="mr-3">
                                                            <a href="{{route($reportlist->reportroute)}}"><i class="{{$reportlist->icon}} text-success-400 icon-2x mt-1"></i></a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6 class="mb-0 text-left" style="margin-top:-20px"><span style="font-size: 16px"> <a href="{{route($reportlist->reportroute)}}" class="text-primary">{{$reportlist->reportname}}</a></span></h6>
                                                            <span class="text-muted">แสดงรายงานหมวด {{$reporttype->name}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        {{-- </div> --}}
                    </div>
                @endif
           

        @endforeach
    </div>
  


{{--  --}}
    </div>
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/echart/echarts.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/ui/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/pickers/daterangepicker.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/reportprojecthelper.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
<script>
    var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content'),
        branchid: "{{Auth::user()->branch_id}}"
    };


        // Initialize
        $('.daterange').daterangepicker(
            {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2015',
                maxDate: '12/31/2050',
                dateLimit: { days: 60 },
                ranges: {
                    'วันนี้': [moment(), moment()],
                    'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'สัปดาห์ที่ผ่านมา': [moment().subtract(6, 'days'), moment()],
                    'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
                    'เดือนที่ผ่านมา': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: $('html').attr('dir') == 'rtl' ? 'right' : 'left',
                applyClass: 'btn-sm bg-slate-600 btn-block',
                cancelClass: 'btn-sm btn-light btn-block',
                locale: {
                    format: 'MM/DD/YYYY',
                    startLabel: 'เริ่มวันที่',
                    endLabel: 'ถึงวันที่',
                    applyLabel: 'ตกลง',
                    cancelLabel: 'ยกเลิก',
                    customRangeLabel: 'กำหนดเอง',
                    direction: $('html').attr('dir') == 'rtl' ? 'rtl' : 'ltr'
                }
            },
            function(start, end) {               
                $('.daterange span').html(start.format('D') + ' ' + thaiMonth(start.format('MM')) + ' - ' + end.format('D') + ' ' + thaiMonth(end.format('MM')));
            }
        );
        $('.daterange span').html(moment().subtract(29, 'days').format('D') + ' ' + thaiMonth(moment().subtract(29, 'days').format('MM')) + ' - ' + moment().format('D') + ' ' + thaiMonth(moment().format('MM')));

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

        $('#fromdate').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            clearButton: true,
            cancelText: "ยกเลิก",
            okText: "ตกลง",
            clearText: "เคลียร์",
            time: false
        });
        $('#todate').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            clearButton: true,
            cancelText: "ยกเลิก",
            okText: "ตกลง",
            clearText: "เคลียร์",
            time: false
		});

        $(document).on('keyup', '#searchreport', function(e) {
            searchReport($(this).val()).then(data => {
                var html = ``;
                $("#report_wrapper").html('');
                data.reporttypes.forEach(function (reporttype,index) {
                    var _reportlists = data.reportlists.filter(x => x.group_id == reporttype.id); 
                    if(typeof(_reportlists[0]) != "undefined"){
                        html += `<div class="card card-body border-top-${reporttype.color}">
                                <label for="">${reporttype.name}</label>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="row" >`;

                                            _reportlists.forEach(function (reportlist,index) {
                                                $routeconv = reportlist.reportroute.replace(/\./g,'/')
                                                html += `<div class="col-md-4">
                                                     <div class="card card-body ">
                                                         <div class="media">
                                                            <div class="mr-3">
                                                                <a href="${route.url}/${$routeconv}"><i class="${reportlist.icon} text-success-400 icon-2x mt-1"></i></a>
                                                            </div>
                                                            <div class="media-body">
                                                                 <h6 class="mb-0 text-left" style="margin-top:-20px"><span style="font-size: 16px"> <a href="${route.url}/${$routeconv}" class="text-primary">${reportlist.reportname}</a></span></h6>
                                                                <span class="text-muted">แสดงรายงานหมวด ${reporttype.name}</span>
                                                             </div>
                                                        </div>
                                                     </div>
                                                 </div>`;
                                            });
                                            
                        html += `</div>
                            </div>
                        </div>
                    </div>`;
                    }
        
                  $("#report_wrapper").html(html);
                });
            }).catch(error => {})
        
    });
        function searchReport(search){
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: `${route.url}/dashboard/admin/realtimereport/searchreport`,
                    type: 'POST',
                    headers: {"X-CSRF-TOKEN":route.token},
                    data: {
                    search : search
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
