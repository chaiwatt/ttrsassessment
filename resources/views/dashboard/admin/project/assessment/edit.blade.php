@extends('layouts.dashboard.main')
@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">

@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">EV Template: {{$ev->name}}</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <div class="form-check ">
                        {{-- <i class="icon-spinner spinner mr-2" id="spinicon" hidden></i><input type="checkbox" id="chkscorestatus" data-id="{{$ev->id}}" data-on-color="success" data-off-color="danger" data-on-text="ส่งแล้ว" data-off-text="ยังไม่ได้ส่ง" class="form-check-input-switch" @if ($ev->scoringstatus->count() != 0) checked @endif > --}}
                        {{-- @if (Empty($scoringstatus))
                            <button id="submitscore" data-id="{{$ev->id}}" class="btn bg-teal"><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i>ส่งคะแนน<i class="icon-paperplane ml-2"></i></button>
                        @endif --}}
                        <input type="text" id="scoringstatus" value="{{$scoringstatus}}" hidden>
                    </div>
                </div>
               
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>โครงการ</a>
                    <a href="{{route('dashboard.admin.project.assessment')}}" class="breadcrumb-item">ลงคะแนน</a>
                    <span class="breadcrumb-item active">ลงคะแนนโครงการ</span>

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
                        <input type="text" id="isfinal" value="{{$projectgrade->count()}}" hidden>
                        <input type="text" id="evid" value="{{$ev->id}}" hidden>
                        <input type="text" id="evstatus" value="{{$ev->status}}" hidden>
                            <input type="text" id="percentextra" value="{{$ev->percentextra}}" hidden>
                            <form id="frmminitbp" method="POST" class="wizard-form step-evweight" action="" data-fouc>
                                @csrf
                                <h6>Index Weight</h6>
                                <fieldset>
                                    <div class="table-responsive mb-2">
                                        <table class="table table-bordered table-striped" id="criteriatable">
                                            <thead>
                                                <tr class="bg-info">
                                                    <th>Pillar</th>  
                                                    <th>Sub Pillar</th>   
                                                    <th>Index</th>                                                                                
                                                    <th>Criteria <a href="#" class="text-white" id="togglecomment"><i class="icon-comments"></i></a> </th>  
                                                    @if ($projectgrade->count() !=0)
                                                        <th>Final</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <div class="theme_tail theme_tail_circle loadprogress">
                                                <div class="pace_progress" data-progress-text="60%" data-progress="60"></div>
                                                <div class="pace_activity"></div>
                                            </div> 
                                            <tbody id="criteria_transaction_wrapper_tr"> 
              
                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>
                                @if ($ev->percentextra > 0)
                                <input type="text" id="inppercentextra" value="{{$ev->percentextra}}" hidden>
                                    <h6>Extra Weight</h6>
                                    <fieldset>
                                        <div class="table-responsive mb-2">
                                            <table class="table table-bordered table-striped" id="extra_subpillarindex">
                                                <thead>
                                                    <tr class="bg-info">
                                                        <th>Category</th>  
                                                        <th>Extra Criteria</th>   
                                                        <th>Weight</th>                                                                                
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
<script type="module" src="{{asset('assets/dashboard/js/app/helper/scoringhelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            usertypeid: "{{$user->user_type_id}}",
            userid: "{{$user->id}}",
        };
    </script>
    
@stop
