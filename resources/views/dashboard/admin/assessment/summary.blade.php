@extends('layouts.dashboard.main')
@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">

@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">EV Template: {{$ev->name}}</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    {{-- <div class="form-check ">
                        <i class="icon-spinner spinner mr-2" id="spinicon" hidden></i><input type="checkbox" id="chkscorestatus" data-id="{{$ev->id}}" data-on-color="success" data-off-color="danger" data-on-text="ส่งแล้ว" data-off-text="ยังไม่ได้ส่ง" class="form-check-input-switch" @if ($ev->scoringstatus->count() != 0) checked @endif >
                    </div> --}}
                </div>
               
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> การประเมิน</a>
                    <a href="#" class="breadcrumb-item"> EV Template</a>
                    <a href="{{route('setting.admin.assessment.ev')}}" class="breadcrumb-item"> รายการ EV Template</a>
                    <span class="breadcrumb-item active">{{$ev->name}}</span>
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Members online -->
                                <div class="card bg-success-400">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <h3 class="font-weight-semibold mb-0"><span id="showpercent"></span></h3>
                                        </div>
                                        <div>
                                            เปอร์เซนต์
                                        </div>
                                    </div>
                
                                    <div class="container-fluid">
                                        <div id="members-online"></div>
                                    </div>
                                </div>
                                <!-- /members online -->
                
                            </div>
                
                            <div class="col-lg-6">
                                <!-- Today's revenue -->
                                <div class="card bg-teal-400">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <h3 class="font-weight-semibold mb-0"><span id="showgrade"></span></h3>
                                        </div>
                                        
                                        <div>
                                            เกรดการประเมิน
                                        </div>
                                    </div>
                
                                    <div id="today-revenue"></div>
                                </div>
                                <!-- /today's revenue -->
                
                            </div>


                        </div>
                        <table class="table table-bordered table-striped" id="gradesummary">
                            <thead>
                                <tr class="bg-info">
                                    <th>Pillar (Index)</th>  
                                    <th style="width:30%">เปอร์เซนต์</th>                                                                                 
                                </tr>
                            </thead>
                            <tbody id="gradesummary_wrapper_tr"> 

                            </tbody>
                        </table>
                        @if ($ev->percentextra > 0)
                            <br>
                            <table class="table table-bordered table-striped" id="extra_gradesummary">
                                <thead>
                                    <tr class="bg-info">
                                        <th>Pillar (Extra)</th>  
                                        <th style="width:30%">เปอร์เซนต์</th>                                                                                 
                                    </tr>
                                </thead>
                                <tbody id="extra_gradesummary_wrapper_tr"> 

                                </tbody>
                            </table>
                        @endif
                        <input type="text" id="evid" value="{{$ev->id}}" hidden>
                        <input type="text" id="evstatus" value="{{$ev->status}}" hidden>
                            <input type="text" id="percentextra" value="{{$ev->percentextra}}" hidden>
                            <form id="frmminitbp" method="POST" class="wizard-form step-evweight" action="" data-fouc>
                                @csrf
                                <h6>Index Weight</h6>
                                <fieldset>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="criteriatable">
                                            <thead>
                                                <tr>
                                                    <th>Pillar</th>  
                                                    <th>Sub Pillar</th>   
                                                    <th>Index</th>                                                                                
                                                    <th>Criteria <a href="#" class="text-default" id="togglecomment"><i class="icon-comments"></i></a> </th>  
                                                    {{-- <th style="width:250px">Weightsum(Portion*Pillar*Weight*Score)</th>  --}}
                                                </tr>
                                            </thead>
                                            <div class="theme_tail theme_tail_circle loadprogress">
                                                <div class="pace_progress" data-progress-text="60%" data-progress="60"></div>
                                                <div class="pace_activity"></div>
                                            </div> 
                                            <tbody id="criteria_summary_wrapper_tr"> 
              
                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>
                                @if ($ev->percentextra > 0)
                                <h6>Index Weight</h6>
                                <fieldset>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="extra_criteriatable">
                                            <thead>
                                                <tr>
                                                    <th>Pillar</th>  
                                                    <th>Sub Pillar</th>   
                                                    <th>Index</th>                                                                                
                                                    <th>Criteria <a href="#" class="text-default" id="togglecomment"><i class="icon-comments"></i></a> </th>  
                                                </tr>
                                            </thead>
                                            <div class="theme_tail theme_tail_circle loadprogress">
                                                <div class="pace_progress" data-progress-text="60%" data-progress="60"></div>
                                                <div class="pace_activity"></div>
                                            </div> 
                                            <tbody id="extra_criteria_transaction_wrapper_tr"> 
            
                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>
                                @endif

                            </form>

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
<script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/forms/wizards/steps.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/forms/validation/validate.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.ui.position.js"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/scoresummaryhelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            usertypeid: "{{Auth::user()->user_type_id}}"
        };
    </script>
@stop
