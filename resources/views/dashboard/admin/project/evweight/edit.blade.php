@extends('layouts.dashboard.main')
@section('pageCss')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css"> --}}
<style>
    textarea{
        font-size: 16px !important;
    }
    .pdfobject-container { 
        height: 600px; 
        width: 100%;
        border: 1rem solid rgba(0,0,0,.1); 
    }
</style>
@stop
@section('content')

{{-- modal_view_full tbp --}}
    <div id="modal_view_fulltbp" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;Full TBP</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div id="example1"></div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    
                </div>
            </div>
        </div>
    </div>

    <div id="modal_preview_weight" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;Preview</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for=""> <strong>Index Criteria</strong> </label>
                            <table style="width: 100%" class="table table-bordered table-striped" id="subpillarindex">
                                <thead>
                                    <tr class="bg-info">
                                        <th style="text-align: center">Pillar</th>  
                                        <th style="text-align: center">Sub Pillar</th>   
                                        <th style="text-align: center">Sub Pillar Index</th>  
                                        <th style="text-align: center;width: 200px" >Weight</th>                                                                                
                                    </tr>
                                </thead>
                                <tbody id="preview_wrapper_tr"> 
  
                                </tbody>
                            </table>
                        </div>


                    </div>
                    <div class="row mt-2" id="extra_preview_wrapper" hidden>
                        <div class="col-md-12" >
                            <label for=""> <strong>Extra Criteria</strong> </label>
                            <table style="width: 100%" class="table table-bordered table-striped" id="subpillarindex">
                                <thead>
                                    <tr class="bg-info">
                                        <th style="text-align: center">Category</th>  
                                        <th style="text-align: center">Extra Criteria</th>   
                                        <th style="text-align: center;width: 200px">Weight</th>                                                                                
                                    </tr>
                                </thead>
                                <tbody id="extra_preview_wrapper_tr"> 
  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    
                </div>
            </div>
        </div>
    </div>

    <div id="modal_add_comment" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มรายการแก้ไข</h5>
                    <button type="button" data-toggle="modal" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>รายละเอียด<span class="text-danger">*</span></label>
                            <textarea type="text" rows="5" id="comment" placeholder="" class="form-control form-control-lg" ></textarea>
                        </div>
                    </div>
                </div>         
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_add_comment" class="btn bg-primary" ><i class="icon-spinner spinner mr-2" id="addcommentspinicon" hidden></i><i class="icon-checkmark3 font-size-base mr-1"></i> ส่งคืน</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">EV: {{$ev->name}}</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                @if (Auth::user()->user_type_id >= 5)
                    @if ($ev->status >= 4)
                            <div class="text-right">
                                {{-- <button type="button" id="sendedittojd" data-id="{{$ev->id}}" class="btn bg-teal"><i class="icon-spinner spinner mr-2" id="spiniconev" hidden></i>ส่งรายการแก้ไข <i class="icon-paperplane ml-2"></i></button> --}}
                                
                            </div>
                        @else
                            <div class="d-flex justify-content-center">
                                <div class="form-check ">
                                    @if (($ev->status == 3))
                                        @if (Auth::user()->user_type_id == 6)
                                            @if ($evcommenttabs->count() == 0)
                                                <button id="approveevstagetwo" data-id="{{$ev->id}}" class="btn bg-teal"><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i>อนุมัติ EV<i class="icon-paperplane ml-2"></i></button>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                    @endif
                @endif
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    {{-- <a href="#" class="breadcrumb-item"> แบบฟอร์มแผนธุรกิจเทคโนโลยี</a> --}}
                    <a href="{{route('dashboard.admin.project.fulltbp')}}" class="breadcrumb-item">แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)</a>
                    <span class="breadcrumb-item active">กำหนด Weight</span>
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
                <div id="weightstick" style="background-color: #ccc;width 100px;height:35px;position: fixed;z-index:1;right:0 ;margin-right:25px;padding:5px;border-radius:5px">Index weight <span id="float-weight"></span> </div>
                <div class="card">
                    {{-- {{$ev->refixstatus}} --}}
                    <input type="text" id="projectname" value="{{$ev->fulltbp->minitbp->project}}" hidden>
                    <input type="text" id="evid" value="{{$ev->id}}" hidden>
                    <input type="text" id="evstatus" value="{{$ev->status}}" hidden>
                    <div class="card-body">
                        <div class="form-group">
                            <button type="button" id="showfulltbp" class="btn bg-warning" data-toggle="modal" >Full TBP <i class="icon-eye ml-2"></i></button>
                        </div>
                        <input type="text" id="percentextra" value="{{$ev->percentextra}}" hidden>
                        <form id="frmminitbp" method="POST" class="wizard-form step-evweight" action="" data-fouc>
                            @csrf
                            <h6>Index Weight</h6>
							<fieldset>
                                <input type="text" id="tmpstepindex" value="0" hidden>
                                <ul class="nav nav-tabs nav-tabs-highlight indexweight">
                                   
                                    <li class="nav-item"><a href="#weighttab" class="nav-link active" data-toggle="tab"><i class="icon-mention mr-2"></i>กำหนด Weight <span id="weight"></span></a></li>
                                    @if ($evedithistories->count() > 0 || Auth::user()->user_type_id == 6)
                                        <li class="nav-item">
                                            <a href="#commenttab" class="nav-link" data-toggle="tab"><i class="icon-bubble-dots4 mr-2"></i>ส่งคืนแก้ไข@if ($evcommenttabs->count() > 0) <span class="badge badge-warning badge-pill mr-2">ใหม่</span> @endif </a>
                                        </li>
                                    @endif
                                </ul>
                                <div class="tab-content mb-2">
                                    <div class="tab-pane fade show active" id="weighttab">
                                        <div class="float-left mb-2">
                                            <button type="button" id="btnOnExcel" class="btn btn-sm bg-info">ส่งออก EXCEL</button>
                                            <button type="button" id="btnOnPdf" class="btn btn-sm bg-info">ส่งออก PDF</button>
                                            <button type="button" class="btn btn-sm bg-info preview">Preview <i class="icon-eye"></i></button>
                                        </div>
                                        <table style="width: 100%" class="table table-bordered table-striped" id="subpillarindex">
                                            <thead>
                                                <tr class="bg-info">
                                                    <th>Pillar</th>  
                                                    <th>Sub Pillar</th>   
                                                    <th>Weight<a href="#" class="text-white" data-toggle="modal" id="togglecomment"> <i class="icon-comments"></i></a></th>                                                                                
                                                </tr>
                                            </thead>
                                            <tbody id="subpillar_index_transaction_wrapper_tr"> 
              
                                            </tbody>
                                        </table>
                                        <table id="evexporttable" width="100%" hidden>
                                            <thead>
                                                <tr >
                                                    <th style="text-align: left">Pillar</th>  
                                                    <th style="text-align: left">Sub Pillar</th>  
                                                    <th style="text-align: left">Sub Pillar Index</th>   
                                                    <th style="text-align: left">Weight</th>                                                                                
                                                </tr>
                                            </thead>
                                        </table> 
                                    </div>
                                    <div class="tab-pane fade" id="commenttab">
                                        @if (Auth::user()->user_type_id == 6 && $ev->status < 4)
                                        <div class="form-group">	
                                            {{-- <a href="" class="btn btn-info btn-icon ml-2 btn-sm float-right"  data-toggle="modal" data-target="#modal_add_comment"><i class="icon-add"></i></a> --}}
                                            <a class="btn bg-warning" data-toggle="modal" data-target="#modal_add_comment">ส่งคืนแก้ไข</a>
                                            <br>
                                        </div>
                                        @endif
        
                                        <div class="table-responsive" >
                                            <table style="width: 100%" class="table table-bordered table-striped"  >
                                                <thead>
                                                    <tr class="bg-info">
                                                        <th style="text-align: center;width:250px">วันที่</th>  
                                                        <th style="text-align: center">รายละเอียด</th>   
                                                        {{-- @if (Auth::user()->user_type_id == 6)
                                                            <th>เพิ่มเติม</th>
                                                        @endif --}}
                                                    </tr>
                                                </thead>
                                                <tbody id="ev_edit_history_wrapper_tr"> 
                                                    @foreach ($evedithistories->reverse() as $evedithistory)
                                                    <tr>
                                                        <td style="text-align: center">{{$evedithistory->thaidate}}</td>
                                                        <td>{{$evedithistory->detail}}</td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            @if ($ev->percentextra > 0)
                            <h6>Extra Weight</h6>
							<fieldset>
                                <ul class="nav nav-tabs nav-tabs-highlight">
                                    <li class="nav-item"><a href="#extraweighttab" class="nav-link active" data-toggle="tab"><i class="icon-mention mr-2"></i> กำหนด Weight <span id="extraweight"></span></a></li>
                                </ul>
                                <div class="tab-content mb-2">
                                    <div class="tab-pane fade show active" id="extraweighttab">
                                        <div class="float-left mb-2">
                                            <button type="button" id="btnOnExcelExtra" class="btn btn-sm bg-info">ส่งออก EXCEL</button>
                                            <button type="button" id="btnOnPdfExtra" class="btn btn-sm bg-info">ส่งออก PDF</button>
                                            <button type="button" class="btn btn-sm bg-info preview">Preview <i class="icon-eye"></i></button>
                                        </div>
                                        <div class="table-responsive" >
                                            <table style="width: 100%" class="table table-bordered table-striped" id="extra_subpillarindex" >
                                                <thead>
                                                    <tr class="bg-info">
                                                        <th>Category</th>  
                                                        <th>Extra Criteria</th>   
                                                        <th>Weight </th>                                                                                
                                                    </tr>
                                                </thead>
                                                <div class="theme_tail theme_tail_circle loadprogress">
                                                    <div class="pace_progress" data-progress-text="60%" data-progress="60"></div>
                                                    <div class="pace_activity"></div>
                                                </div> 
                                                <tbody id="extra_criteria_transaction_wrapper_tr"> 
                  
                                                </tbody>
                                            </table>
                                            <table id="evextraexporttable" width="100%" hidden>
                                                <thead>
                                                    <tr >
                                                        <th style="text-align: left">Category</th>  
                                                        <th style="text-align: left">Extra Criteria</th>   
                                                        <th style="text-align: left">Weight</th>   
                                                    </tr>
                                                </thead>
                                            </table> 
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            @endif
                        </form>   
                    </div>
                </div>
            </div>
        </div>
    </div>

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
<script src="{{asset('assets/dashboard/js/plugins/pdfobject/pdfobject.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/evweigthhelper.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/inputformat.js')}}"></script>

<script>

    $(function() {
            // define container
        var redips = {};
        
        // append scroll parameter to URL or return scroll value
        redips.scroll = function (url) {
            let scroll, q;
            // DOM compliant
            if (document.body && document.body.scrollTop) {
                scroll = document.body.scrollTop;
            }
            // old - Netscape compliant
            else if (typeof (window.pageYOffset) === 'number') {
                scroll = window.pageYOffset;
            }
            // very very old - IE6 standards compliant mode
            else if (document.documentElement && document.documentElement.scrollTop) {
                scroll = document.documentElement.scrollTop;
            }
            // when vertical scroll bar is on the top
            else {
                scroll = 0;
            }
            // if input parameter does not exist then return scroll value
            if (url === undefined) {
                return scroll;
            }
            // else append scroll parameter to URL
            else {
                // set "?" or "&" before scroll parameter
                q = url.indexOf('?') === -1 ? '?' : '&';
                // load page with scroll position parameter
                window.location.href = url + q + 'scroll=' + scroll;
            }
        };
        
        // set scroll position if URL contains scroll=nnn parameter
        redips.setScrollOnLoad = function () {
            // get query string parameter with "?"
            let search = window.location.search,
                matches;
            // if query string exists
            if (search) {
                // find scroll parameter in query string
                matches = /scroll=(\d+)/.exec(search);
                // jump to scroll position if scroll parameter exists
                if (matches) {
                    window.scrollTo(0, matches[1]);
                }
            }
        };
        
        // add onload event listener
        if (window.addEventListener) {
            window.addEventListener('load', redips.setScrollOnLoad, false);
        }
        else if (window.attachEvent) {
            window.attachEvent('onload', redips.setScrollOnLoad);
        }
        
    });


        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            usertypeid: "{{Auth::user()->user_type_id}}",
            refixstatus: "{{$ev->refixstatus}}",
            popupmessages : JSON.parse(JSON.stringify({!! json_encode($popupmessages) !!}))
        };

        $(document).on('click', '#showfulltbp', function(e) {
            PDFObject.embed("{{asset($ev->fulltbp->attachment)}}", "#example1");
            $('#modal_view_fulltbp').modal('show');
        });
        
    </script>
@stop