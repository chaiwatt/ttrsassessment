@extends('layouts.dashboard.main')
@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">

@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">ผลการสรุปคะแนน: {{$ev->name}}</h4>
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
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>ประเมิน</a>
                    <a href="{{route('dashboard.admin.assessment')}}" class="breadcrumb-item">สรุปคะแนน</a>
                    <span class="breadcrumb-item active">ผลการสรุปคะแนน</span>

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


                        <div class="row" id="chartarea" hidden>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header header-elements-sm-inline">
                                        <h6 class="card-title" style="font-size:16px;font-weight: bold">ร้อยละเกรดแยกตาม Pillar</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row l-400">
                                            <div class="col-md-2 c-20">
                                                <canvas id="myChart" width=180  height=180 ></canvas>
                                            </div>
                                            <div class="col-md-9 l-40 none">
                                              <div style="margin-top: 300px;"></div>
                                              <div id="mainchart">
                                                <ul class="chart-skills">
                                                    <li>
                                                      <span id="chartpillar4"></span>
                                                    </li>
                                                  </ul>
                                                  <ul class="chart-skills2"> 
                                                    <li>
                                                        <span id="chartpillar3"></span>
                                                    </li>
                                                  </ul>
                                                  <ul class="chart-skills3"> 
                                                    <li>
                                                        <span id="chartpillar2"></span>
                                                    </li>
                                                  </ul>
                                                  <ul class="chart-skills4"> 
                                                    <li>
                                                        <span id="chartpillar1"></span>
                                                    </li>
                                                  </ul>
                                              </div>
                                              <div>
                                                
                                            </div>
                                            </div>
                                            <div class="col-md-1 c-table">
                                                  <table class="table-score table-7 table-bordered table-dark" >
                                                <thead>
                                                  <tr>
                                                   
                                                    <td class="bg-01 white" colspan="2" style="padding-left: 5px !important; padding-right:5px !important">Level Classification</td>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <tr class="bg-02">
                                                    <td >87-100</td>
                                                    <td>AAA</td>
                                                  </tr>
                                                  <tr class="bg-03">
                                                    <td>80-86</td>
                                                    <td>AA</td>
                                                  </tr>
                                                  <tr class="bg-02">
                                                    <td>74-79</td>
                                                    <td>A</td>
                                                  </tr>
                                                  <tr class="bg-03">
                                                    <td>70-73</td>
                                                    <td>BBB</td>
                                                  </tr>
                                                  <tr class="bg-02">
                                                    <td>64-69</td>
                                                    <td>BB</td>
                                                  </tr>
                                                  <tr class="bg-03">
                                                    <td>56-63</td>
                                                    <td>B</td>
                                                  </tr>
                                                  <tr class="bg-02">
                                                    <td>54-55</td>
                                                    <td>CCC</td>
                                                  </tr>
                                                  <tr class="bg-03">
                                                    <td>51-52</td>
                                                    <td>CC</td>
                                                  </tr>
                                                  <tr class="bg-02">
                                                    <td>48-50</td>
                                                    <td>C</td>
                                                  </tr>
                                                  <tr class="bg-03">
                                                    <td>25-47</td>
                                                    <td>D</td>
                                                  </tr>
                                                  <tr class="bg-02">
                                                    <td>0-24</td>
                                                    <td>E</td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row l-50">
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <div class="col-sm-6"></div>
                                                            <div class="col-sm-6"> 
                                                                <h2><span style="font-weight: bold"> 01</span></h2>
                                                                <img src="{{asset('assets/dashboard/images/chart/01.png')}}" width="100px" alt=""></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <h6 class="color-01" style="font-weight: bold">Management</h6>
                                                        <h5><span id="pillar1"></span></h5>
                                                        <h4 class="color-01"><span id="gradepillar1"></span></h4>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <div class="col-sm-6"></div>
                                                            <div class="col-sm-6"> 
                                                                <h2><span style="font-weight: bold"> 02</span></h2>
                                                                <img src="{{asset('assets/dashboard/images/chart/02.png')}}" width="100px" alt=""></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <h6 class="color-02" style="font-weight: bold">Technology</h6>
                                                        <h5><span id="pillar2"></span></h5>
                                                        <h4 class="color-02"><span id="gradepillar2"></span></h4>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3"> 
                                                <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-6"></div>
                                                        <div class="col-sm-6"> 
                                                            <h2><span style="font-weight: bold"> 03</span></h2>
                                                            <img src="{{asset('assets/dashboard/images/chart/03.png')}}" width="100px" alt=""></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6 class="color-03" style="font-weight: bold">Marketability</h6>
                                                    <h5><span id="pillar3"></span></h5>
                                                    <h4 class="color-03"><span id="gradepillar3"></span></h4>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-md-3">  <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-6"></div>
                                                        <div class="col-sm-6"> 
                                                            <h2><span style="font-weight: bold"> 04</span></h2>
                                                            <img src="{{asset('assets/dashboard/images/chart/04.png')}}" width="100px" alt=""></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6 class="color-04" style="font-weight: bold">Business Prospet</h6>
                                                    <h5><span id="pillar4"></span></h5>
                                                    <h4 class="color-04"><span id="gradepillar4"></span></h4>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="card">
                                    <div class="card-header header-elements-sm-inline">
                                        <h6 class="card-title" style="font-size:16px;font-weight: bold">เกรดแยกตาม Pillar</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1 c-20">
                                                <canvas id="myChart" width=200  height=200 ></canvas>
                                            </div>
                                            <div class="col-md-9 l-40 none">
                                              <div style="margin-top: 300px;"></div>
                                              <div id="mainchart" >
                                                <ul class="chart-skills">
                                                    <li>
                                                      <span id="chartpillar4"></span>
                                                    </li>
                                                  </ul>
                                                  <ul class="chart-skills2"> 
                                                    <li>
                                                        <span id="chartpillar3"></span>
                                                    </li>
                                                  </ul>
                                                  <ul class="chart-skills3"> 
                                                    <li>
                                                        <span id="chartpillar2"></span>
                                                    </li>
                                                  </ul>
                                                  <ul class="chart-skills4"> 
                                                    <li>
                                                        <span id="chartpillar1"></span>
                                                    </li>
                                                  </ul>

                                              </div>
                                              <div>
                                               
                                            </div>

                                            </div>
                                            <div class="col-md-1 c-100">
                                                  <table class="table-score table-7 table-bordered table-dark">
                                                <thead>
                                                  <tr>
                                                   
                                                    <td class="bg-01 white" colspan="2" style="padding-left: 5px !important; padding-right:5px !important">Level Classification</td>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <tr class="bg-02">
                                                    <td> 87-100</td>
                                                    <td>AAA</td>
                                                  </tr>
                                                  <tr class="bg-03">
                                                    <td>80-86</td>
                                                    <td>AA</td>
                                                  </tr>
                                                  <tr class="bg-02">
                                                    <td>74-79</td>
                                                    <td>A</td>
                                                  </tr>
                                                  <tr class="bg-03">
                                                    <td>70-73</td>
                                                    <td>BBB</td>
                                                  </tr>
                                                  <tr class="bg-02">
                                                    <td>64-69</td>
                                                    <td>BB</td>
                                                  </tr>
                                                  <tr class="bg-03">
                                                    <td>56-63</td>
                                                    <td>B</td>
                                                  </tr>
                                                  <tr class="bg-02">
                                                    <td>54-55</td>
                                                    <td>CCC</td>
                                                  </tr>
                                                  <tr class="bg-03">
                                                    <td>51-52</td>
                                                    <td>CC</td>
                                                  </tr>
                                                  <tr class="bg-02">
                                                    <td>48-50</td>
                                                    <td>C</td>
                                                  </tr>
                                                  <tr class="bg-03">
                                                    <td>25-47</td>
                                                    <td>D</td>
                                                  </tr>
                                                  <tr class="bg-02">
                                                    <td>0-24</td>
                                                    <td>E</td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row l-50">
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <div class="col-sm-6"></div>
                                                            <div class="col-sm-6"> 
                                                                <h2><span style="font-weight: bold"> 01</span></h2>
                                                                <img src="{{asset('assets/dashboard/images/chart/01.png')}}" width="100px" alt=""></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <h6 class="color-01" style="font-weight: bold">Management</h6>
                                                        <h5><span id="pillar1"></span></h5>
                                                        <h4 class="color-01"><span id="gradepillar1"></span></h4>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <div class="col-sm-6"></div>
                                                            <div class="col-sm-6"> 
                                                                <h2><span style="font-weight: bold"> 02</span></h2>
                                                                <img src="{{asset('assets/dashboard/images/chart/02.png')}}" width="100px" alt=""></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <h6 class="color-02" style="font-weight: bold">Technology</h6>
                                                        <h5><span id="pillar2"></span></h5>
                                                        <h4 class="color-02"><span id="gradepillar2"></span></h4>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3"> 
                                                <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-6"></div>
                                                        <div class="col-sm-6"> 
                                                            <h2><span style="font-weight: bold"> 03</span></h2>
                                                            <img src="{{asset('assets/dashboard/images/chart/03.png')}}" width="100px" alt=""></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6 class="color-03" style="font-weight: bold">Marketability</h6>
                                                    <h5><span id="pillar3"></span></h5>
                                                    <h4 class="color-03"><span id="gradepillar3"></span></h4>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-md-3">  <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-6"></div>
                                                        <div class="col-sm-6"> 
                                                            <h2><span style="font-weight: bold"> 04</span></h2>
                                                            <img src="{{asset('assets/dashboard/images/chart/04.png')}}" width="100px" alt=""></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6 class="color-04" style="font-weight: bold">Business Prospet</h6>
                                                    <h5><span id="pillar4"></span></h5>
                                                    <h4 class="color-04"><span id="gradepillar4"></span></h4>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>







                        <table class="table table-bordered table-striped" id="gradesummary">
                            <thead>
                                <tr class="bg-info">
                                    <th>Pillar (Index)</th>  
                                    <th style="width:30%;text-align: center">เปอร์เซนต์</th>          
                                    <th style="width:30%;text-align: center">เกรด</th>                                                                             
                                </tr>
                            </thead>
                            <tbody id="gradesummary_wrapper_tr"> 

                            </tbody>
                        </table>
                        <input type="text" id="evid" value="{{$ev->id}}" hidden>
                        <input type="text" id="evstatus" value="{{$ev->status}}" hidden>
                            <input type="text" id="percentextra" value="{{$ev->percentextra}}" hidden>
                            <form id="frmminitbp" method="POST" class="wizard-form step-evweight"  action="" data-fouc>
                                @csrf
                                <h6>Index Criteria</h6>
                                <fieldset>
                                    <div class="float-left mb-2">
                                        <button type="button" id="btnOnExcel" class="btn btn-sm bg-info">ส่งออก Excel (Index)</button>
                                        <button type="button"  id="btnOnPdf" class="btn btn-sm bg-info">ส่งออก Pdf (Index)</button>
                                    </div>
                                    <div class="table-responsive mb-3">
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
                                <fieldset>
                                    <div class="float-left mb-2">
                                        <button type="button" id="btnOnExcelExtra" class="btn btn-sm bg-info">ส่งออก Excel (Extra)</button>
                                        <button type="button"  id="btnOnPdfExtra" class="btn btn-sm bg-info">ส่งออก Pdf (Extra)</button>
                                    </div>
                                    <div class="table-responsive mb-3">
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
<script type="module" src="{{asset('assets/dashboard/js/app/helper/scoresummaryhelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            usertypeid: "{{Auth::user()->user_type_id}}"
        };
    </script>
@stop
