@extends('layouts.dashboard.main')
@section('pageCss')
@stop
<style>
    textarea{
        font-size: 16px !important;
    }
</style>
@section('content')
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">การมอบหมาย : {{$minitbp->project}}</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    {{-- <a href="#" class="breadcrumb-item"> การมอบหมาย</a> --}}
                    <a href="{{route('dashboard.admin.project.projectassignment')}}" class="breadcrumb-item"> การมอบหมาย</a>
                    <span class="breadcrumb-item active">{{$minitbp->project}}</span>
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
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">รายงานสถานะ</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table style="width: 100%" class="table table-bordered table-striped" >
                                <thead>
                                    <tr class="bg-info">
                                        <th style="text-align: center">รายการ</th> 
                                        <th style="text-align: center">วันที่กำหนด</th>
                                        <th style="text-align: center">สถานภาพ</th> 
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($projectstatuses as $_projectstatus)
                                        <tr>
                                            <td>{{$_projectstatus->projectflow}}</td>
                                            <td>{{$_projectstatus->startdateth}} - {{$_projectstatus->enddateth}}</td>
                                            <td>
                                               {!!$_projectstatus->projectstatustransaction($_projectstatus->project_flow_id,$projectstatus->mini_tbp_id)!!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>      
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
				<div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">Dashboard - Workload</h6>
                        <div class="header-elements">
                        </div>
                    </div>
					<div class="card-body">
                        <form method="POST" action="{{route('dashboard.admin.project.projectassignment.editsave',['id' => $projectassignment->id])}}" enctype="multipart/form-data">
                            @csrf
                            {{-- @if (Empty($projectassignment->leader_id))
                                <div  class="col-md-12" id="toast">
                                    <div class="mb-4">
                                        <div class="toast bg-slate border-transparent" style="opacity: 1; max-width: none;">
                                            <div class="toast-header bg-slate-600 border-bottom-slate-400">
                                                <span class="font-weight-semibold mr-auto blink" style="font-size: 16px">ข้อแนะนำ</span>
                                                <button type="button" class="close" data-dismiss="toast" id="closetoast">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="toast-body" style="font-size: 16px">
                                                <span id="toastmessage">
                                                    <span class="badge bg-success" style="font-size:16px">การมอบหมาย Leader และ Co-Leader</span> ของโครงการ{{$minitbp->project}} มีกำหนดจำนวน {{$projectstatus->duration}} วัน โปรดดำเนินการให้เสร็จสิ้น ภายในวันที่ {{$projectstatus->enddateth}}</span>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="table-responsive" >
                                        <table style="width: 100%" class="table table-bordered table-striped" >
                                            <thead>
                                                <tr class="bg-info">
                                                    <th style="width:120px" class="text-center">Leader</th>
                                                    <th style="width:120px" class="text-center">Co Leader</th>
                                                    <th class="text-center">ชื่อ สกุล</th>
                                                    <th class="text-center">โครงการรับผิดชอบ</th> 
                                                    <th class="text-center">กำลังดำเนินการ</th>    
                                                    <th class="text-center">เสร็จสิ้น</th>
                                                </tr>
                                            </thead>
                                            <tbody id="authorized_director_wrapper_tr"> 
                                                @foreach ($users as $key => $user)
                                                <tr >  
                                                    @php
                                                        $userprefix = $user->prefix->name;
                                                        if($userprefix == 'อื่นๆ'){
                                                            $userprefix = $user->alter_prefix;
                                                        }
                                                    @endphp 
                                                    <td style="text-align: center" ><input type="radio" name="leader" value="{{$user->id}}" class="form-check-input-styled leader" style="text-align: center" data-fouc @if($projectassignment->leader_id == $user->id) checked @endif  
                                                        @if (Auth::user()->user_type_id !==6)
                                                            disabled
                                                        @endif
                                                        ></td>  
                                                    <td style="text-align: center" ><input type="radio" name="coleader" value="{{$user->id}}" class="form-check-input-styled coleader" style="text-align: center" data-fouc   @if($projectassignment->coleader_id == $user->id) checked @endif 
                                                        @if (Auth::user()->user_type_id !==6)
                                                            disabled
                                                        @endif
                                                        ></td>      
                                                    <td><a href="{{route('dashboard.admin.project.projectassignment.personalinfo',['id' => $user->id])}}" class="text-info" target="_blank">{{$userprefix}}{{$user->name}} {{$user->lastname}} </a>  </td>
                                                    <td class="text-center">{{$user->projecthandle->count()}}
                                                        {{-- @if ($user->projecthandle->count() != 0)
                                                        <a href="#" data-toggle="modal" data-id="{{$user->id}}" class="text-info projectinfo" > (รายละเอียด)</a> 
                                                        @endif --}}
                                                       
                                                    </td>      
                                                    <td class="text-center">{{$user->projecthandle->count()-$user->projecthandle->where('ststus',3)->count()}}</td>  
                                                    <td class="text-center">{{$user->projecthandle->where('ststus',3)->count()}}</td> 
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @if (Auth::user()->user_type_id>=6)
                                    <div class="form-group">
                                        <div class="text-right">
                                            <button type="submit" class="btn bg-teal">บันทึก<i class="icon-paperplane ml-2"></i></button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </form>
					</div>
				</div>
            </div>
        </div>
        <div id="main_wrapper" hidden>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-body border-top-pink-400">
                        <div class="card-body text-center">
                        <i class="icon-new icon-2x text-pink-400 border-pink-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="card-title"><span id="pending"></span> โครงการ</h5>
                            <p class="mb-3">จำนวนโครงการทำกำลังดำเนินการ</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body border-top-success-400">
                        <div class="card-body text-center">
                        <i class="icon-medal-star icon-2x text-success-400 border-success-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="card-title"><span id="finished"></span> โครงการ</h5>
                            <p class="mb-3">จำนวนโครงการเสร็จสิ้น</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body border-top-teal-400">
                        <div class="card-body text-center">
                        <i class="icon-archive icon-2x text-teal-400 border-teal-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="card-title"><span id="total"></span> โครงการ</h5>
                            <p class="mb-3">จำนวนโครงการทั้งหมด</p>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header header-elements-sm-inline">
                            <h6 class="card-title" style="font-size:16px;font-weight: bold">รายละเอียดโครงการ</h6>
                            <div class="header-elements">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" >
                                <table style="width: 100%" class="table table-bordered table-striped" >
                                    <thead>
                                        <tr class="bg-info">
                                            <th style="text-align: center">เลขที่โครงการ</th> 
                                            <th style="text-align: center">ชื่อโครงการ</th> 
                                            <th style="text-align: center">บริษัท</th>
                                            <th style="text-align: center">สถานภาพ</th>
                                        </tr>
                                    </thead>
                                    <tbody id="fulltbp_wrapper_tr">
                                    </tbody>
                                </table>      
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/projectassignmenthelper.js')}}"></script>
<script>
    var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            userid: "{{Auth::user()->id}}"
        };

    $("#attachment").on('change', function() {
        $("#filename").val(this.value);
    });

    $(document).on('click', '#closetoast', function(e) {
        $("#toast").attr("hidden",true);
    });

</script>
@stop
