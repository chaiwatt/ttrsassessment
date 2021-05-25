@extends('layouts.dashboard.main')
@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">

@stop
@section('content')
    {{-- modal_show_conflict --}}
    <div id="modal_show_conflict" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;การลงคะแนน <span id="title"></span> </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="criteriatable_modal">
                            <thead>
                                <tr>
                                    <th>ชื่อ-นามสกุล</th>                                                                                   
                                    <th>Score</th>  
                                    <th>ความเห็น</th>  
                                </tr>
                            </thead>
                            <tbody id="show_conflict_modal_wrapper_tr"> 

                            </tbody>
                        </table>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    {{-- <button id="btn_modal_show_conflict" class="btn bg-primary" data-dismiss="modal"><i class="icon-copy3 font-size-base mr-1"></i> ตกลง</button> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">EV Template: {{$ev->name}}</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            {{-- <div class="header-elements d-none">
                <button id="saveupdate" data-id="{{$ev->id}}" class="btn btn-labeled btn-labeled-right bg-teal"><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i>บันทึกคะแนน <b><i class="icon-floppy-disk"></i></b></button>
            </div> --}}
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ประเมิน</a>
                    <a href="#" class="breadcrumb-item"> สรุปคะแนน</a>
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
                        <input type="text" id="projectname" value="{{$ev->fulltbp->minitbp->project}}" hidden>
                        <input type="text" id="fulltbpid" value="{{$ev->fulltbp->id}}" hidden>
                        <input type="text" id="evid" value="{{$ev->id}}" hidden>
                        <input type="text" id="evstatus" value="{{$ev->status}}" hidden>
                            <input type="text" id="percentextra" value="{{$ev->percentextra}}" hidden>
                            <form id="frmminitbp" method="POST" class="wizard-form step-evweight" action="" data-fouc>
                                @csrf
                                <h6>Index Criteria</h6>
                                <fieldset class="mb-2">
                                    <div class="float-left mb-2">
                                        <button type="button" id="btnOnExcel" class="btn btn-sm bg-info">ส่งออก Excel (Index)</button>
                                        <button type="button"  id="btnOnPdf" class="btn btn-sm bg-info">ส่งออก Pdf (Index)</button>
                                    </div>
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
                                            <tbody id="criteria_transaction_wrapper_tr"> 
              
                                            </tbody>
                                        </table>
                                    </div>
                                    <table id="evexporttable" width="100%" hidden>
                                        <thead>
                                            <tr >
                                                <th style="text-align: left">Pillar</th>  
                                                <th style="text-align: left">Sub Pillar</th>   
                                                <th style="text-align: left">Sub Pillar Index</th>                                                                                
                                                <th style="text-align: left">Criteria</th>  
                                                <th style="text-align: left">Score</th>  
                                                <th style="text-align: left">Comment</th> 
                                            </tr>
                                        </thead>
                                    </table> 
                                </fieldset>
                                @if ($ev->percentextra > 0)
                                <h6>Extra Criteria</h6>
                                <fieldset class="mb-2">
                                    
                                    {{-- <input type="text" id="tmpstepindex" value="0" hidden> --}}
                                    {{-- <ul class="nav nav-tabs nav-tabs-highlight"> --}}
                                        {{-- <li class="nav-item"><a href="#extradetailtab" class="nav-link active" data-toggle="tab"><i class="icon-menu7 mr-2"></i> รายละเอียด</a></li> --}}
                                        {{-- <li class="nav-item"><a href="#extraweighttab" class="nav-link active" data-toggle="tab"><i class="icon-mention mr-2"></i> กรอกคะแนน <span id="extraweight"></span></a></li>
                                    </ul> --}}
                                    {{-- <div class="tab-content mb-2">
                     
            
                                        <div class="tab-pane fade show active" id="extraweighttab"> --}}
                                            <div class="float-left mb-2">
                                                <button type="button" id="btnOnExcelExtra" class="btn btn-sm bg-info">ส่งออก Excel (Extra)</button>
                                                <button type="button"  id="btnOnPdfExtra" class="btn btn-sm bg-info">ส่งออก Pdf (Extra)</button>
                                            </div>
                                            <div class="table-responsive">
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
                                        {{-- </div>
                                    </div> --}}
                                    <table id="evextraexporttable" width="100%" hidden>
                                        <thead>
                                            <tr >
                                                <th style="text-align: left">Category</th>  
                                                <th style="text-align: left">Extra Criteria</th>   
                                                <th style="text-align: left">Score</th>  
                                                <th style="text-align: left">Comment</th> 
                                            </tr>
                                        </thead>
                                    </table> 
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

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="{{asset('assets/dashboard/js/vfs_fonts.js')}}"></script>

<script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/forms/wizards/steps.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/plugins/forms/validation/validate.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.ui.position.js"></script>
<script src="{{asset('assets/dashboard/js/plugins/forms/wizards/steps.min.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/dashboardadminassessmenthelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            usertypeid: "{{Auth::user()->user_type_id}}",
            ev: "{{$ev}}"
        };
    </script>
@stop
