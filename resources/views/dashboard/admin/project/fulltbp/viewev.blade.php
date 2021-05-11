@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">รายการ EV </span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            @if ($evs->count() == 0)
                <div class="header-elements d-none">
                    <a href="{{route('dashboard.admin.project.fulltbp.createev',['id' => $fulltbp->id])}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่ม EV<b><i class="icon-plus3"></i></b></a>
                </div>
            @endif
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <a href="#" class="breadcrumb-item"> FullTBP</a>
                    <a href="#" class="breadcrumb-item"> รายการ FullTBP</a>
                    <span class="breadcrumb-item active">EV</span>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">รายการ EV</h6>
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
                                        <th>ชื่อ</th> 
                                        <th>เวอร์ชั่น</th> 
                                        <th>สำหรับโครงการ</th> 
                                        <th>Criteria</th> 
                                        <th>เพิ่มเติม</th>                    
                                    </tr>
                                </thead>
                                <div class="theme_tail theme_tail_circle loadprogress">
                                    <div class="pace_progress" data-progress-text="60%" data-progress="60"></div>
                                    <div class="pace_activity"></div>
                                </div> 
                                <tbody>
                                    @foreach ($evs as $key => $ev)
                                    <tr>    
                                        <td> {{$ev->name}} </td> 
                                        <td> {{$ev->version}} </td> 
                                        <td> {{$ev->fulltbp->minitbp->project}} </td>  
                                        <td> 
                                            @if (Auth::user()->user_type_id == 4)
                                                    <a type="button" href="{{route('dashboard.admin.project.fulltbp.editev',['id' => $ev->id])}}" class="btn btn-sm bg-info">แก้ไข Criteria</a>
                                                @elseif(Auth::user()->user_type_id == 5 || Auth::user()->user_type_id == 6)
                                                    <a type="button" href="{{route('dashboard.admin.project.fulltbp.admin.editev',['id' => $ev->id])}}" class="btn btn-sm bg-info">แก้ไข Criteria</a>
                                            @endif
                                            
                                        </td>     
                                        <td> 
                                            <a type="button" href="{{route('dashboard.admin.project.fulltbp.editev',['id' => $ev->id])}}" class="btn btn-sm bg-primary">แก้ไข</a>
                                            <a type="button" href="{{route('dashboard.admin.project.fulltbp.deleteev',['id' => $ev->id])}}" data-name="" onclick="confirmation(event)" class="btn btn-sm bg-danger">ลบ</a>                                       
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

        $( document ).ready(function() {
            $(".loadprogress").attr("hidden",false);
            getEvByFulltbp("{{$fulltbp->id}}").then(data => {
                $(".loadprogress").attr("hidden",true);
                RenderTable(data);
                
                RowSpan();
            }).catch(error => {
                
            })
        });
        function getEvByFulltbp(fulltbpid){
            return new Promise((resolve, reject) => {
                $.ajax({
                url: `${route.url}/api/assessment/ev/getevbyfulltbp`,
                type: 'POST',
                headers: {"X-CSRF-TOKEN":route.token},
                data: {
                    fulltbpid : fulltbpid
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

        function RenderTable(data){
            var html =``;
            data.forEach(function (criteria,index) {
                var criterianame = '-';
                if(criteria.criteria != null){
                    criterianame = criteria.criteria['name']
                }
                html += `<tr > 
                <td> ${criteria.pillar['name']} <a href="#" data-pillar="${criteria.pillar['id']}" class="text-grey-300 deletepillar"><i class="icon-trash"></i></a></td>                                            
                <td> ${criteria.subpillar['name']} <a href="#" data-pillar="${criteria.pillar['id']}" data-subpillar="${criteria.subpillar['id']}" class="text-grey-300 deletesubpillar"><i class="icon-trash"></i></a></td>    
                <td> ${criteria.subpillarindex['name']} <a href="#" data-pillar="${criteria.pillar['id']}" data-subpillar="${criteria.subpillar['id']}" data-subpillarindex="${criteria.subpillarindex['id']}"  class="text-grey-300 deletesubpillarindex"><i class="icon-trash"></i></a></td>   
                <td> ${criterianame} </td>                                            
                </tr>`
                });
            $("#criteria_transaction_wrapper_tr").html(html);
        }

        function RowSpan(){
            const table = document.querySelector('table');
            let cell1 = null;
            let cell2 = null;
            let cell3 = null;
            for (let row of table.rows) {
                const firstCell = row.cells[0];
                const secondCell = row.cells[1];
                const thirdCell = row.cells[2];
                if (cell1 === null || firstCell.innerText !== cell1.innerText) {
                    cell1 = firstCell;
                } else {
                    cell1.rowSpan++;
                    firstCell.remove();
                }
                if (cell2 === null || secondCell.innerText !== cell2.innerText) {
                    cell2 = secondCell;
                } else {
                    cell2.rowSpan++;
                    secondCell.remove();
                }
                if (cell3 === null || thirdCell.innerText !== cell3.innerText) {
                    cell3 = thirdCell;
                } else {
                    cell3.rowSpan++;
                    thirdCell.remove();
                }
            }
        }
    </script>
@stop