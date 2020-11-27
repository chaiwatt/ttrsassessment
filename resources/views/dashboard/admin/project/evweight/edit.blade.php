@extends('layouts.dashboard.main')
@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">
@stop
@section('content')
    <div id="modal_add_comment" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เพิ่มความเห็น</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Comment<span class="text-danger">*</span></label>
                            <textarea type="text" rows="5" id="comment" placeholder="ข้อความเพิ่มเติมแจ้ง Leader" class="form-control" ></textarea>
                        </div>
                    </div>
                </div>         
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_add_comment" class="btn bg-primary" ><i class="icon-spinner spinner mr-2" id="addcommentspinicon" hidden></i><i class="icon-checkmark3 font-size-base mr-1"></i> บันทึก</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">EV Template: {{$ev->name}} (Weight รวม <span id="sumofweight"></span>)</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                @if (Auth::user()->user_type_id >= 5)
                    @if ($ev->status >= 3)
                            <div class="text-right">
                                {{-- <button type="button" id="sendedittojd" data-id="{{$ev->id}}" class="btn bg-teal"><i class="icon-spinner spinner mr-2" id="spiniconev" hidden></i>ส่งรายการแก้ไข <i class="icon-paperplane ml-2"></i></button> --}}
                                
                            </div>
                        @else
                            <div class="d-flex justify-content-center">
                                <div class="form-check ">
                                    {{-- <i class="icon-spinner spinner mr-2" id="spinicon" hidden></i><input type="checkbox" id="chkevstatus" data-id="{{$ev->id}}" data-on-color="success" data-off-color="danger" data-on-text="ส่งแล้ว" data-off-text="ส่ง JD พิจารณา" class="form-check-input-switch" @if ($ev->status == 3) checked @endif > --}}
                                    {{-- <button id="updateevstatus" data-id="{{$ev->id}}" class="btn bg-teal"><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i>นำส่ง JD<i class="icon-paperplane ml-2"></i></button> --}}
                                    {{-- <button type="button" id="sendedittojd" data-id="{{$ev->id}}" class="btn bg-teal"><i class="icon-spinner spinner mr-2" id="spiniconev" hidden></i>นำส่ง JD fff<i class="icon-paperplane ml-2"></i></button> --}}
                                </div>
                            </div>
                    @endif
                @endif
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
                    <input type="text" id="evstatus" value="{{$ev->status}}" hidden>
                    <div class="card-body">
                        <input type="text" id="tmpstepindex" value="0" hidden>
                        <div class="text-right">
                            {{-- {{$ev}} --}}
                            @if (($ev->status == 2 || $ev->refixstatus == 1) && Auth::user()->user_type_id != 6)
                                <button id="sendedittojd" data-id="{{$ev->id}}" class="btn bg-teal"><i class="icon-spinner spinner mr-2" id="spiniconev" hidden></i>นำส่ง JD<i class="icon-paperplane ml-2"></i></button>
                            @endif
                            @if (($ev->status == 2))
                                @if (Auth::user()->user_type_id == 6)
                                    <button id="approveevstagetwo" data-id="{{$ev->id}}" class="btn bg-teal"><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i>อนุมัติ EV<i class="icon-paperplane ml-2"></i></button>
                                @endif
                            @endif
                            {{--  <i class="icon-spinner spinner mr-2" id="spinicon" hidden></i><input type="checkbox" id="chkevstatus" data-id="{{$ev->id}}" data-on-color="success" data-off-color="danger" data-on-text="ส่งแล้ว" data-off-text="ยังไม่ได้ส่ง" class="form-check-input-switch" @if ($ev->status != 0) checked @endif > --}}
                        </div>
                        <ul class="nav nav-tabs nav-tabs-highlight">
                            <li class="nav-item"><a href="#detailtab" class="nav-link active" data-toggle="tab"><i class="icon-menu7 mr-2"></i> รายละเอียด</a></li>
                            <li class="nav-item"><a href="#weighttab" class="nav-link" data-toggle="tab"><i class="icon-mention mr-2"></i> กำหนด Weigth</a></li>
                            @if ($evedithistories->count() > 0 || Auth::user()->user_type_id == 6)
                                <li class="nav-item"><a href="#commenttab" class="nav-link" data-toggle="tab"><i class="icon-bubble-dots4 mr-2"></i>JD Comment @if ($evcommenttabs->count() > 0) <span class="badge badge-warning badge-pill mr-2">ใหม่</span> @endif </a></li>
                            @endif
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="detailtab">
                                <input type="text" id="evid" value="{{$ev->id}}" hidden>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="criteriatable">
                                        <thead>
                                            <tr>
                                                <th>Pillar</th>  
                                                <th>Sub Pillar</th>   
                                                <th>Index</th>                                                                                
                                                <th>Criteria</th>  
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
                            </div>

                            <div class="tab-pane fade" id="weighttab">
                                <table class="table table-bordered table-striped" id="subpillarindex">
                                    <thead>
                                        <tr>
                                            <th>Pillar</th>  
                                            <th>Sub Pillar</th>   
                                            <th>Weigth</th>                                                                                
                                        </tr>
                                    </thead>
                                    <tbody id="subpillar_index_transaction_wrapper_tr"> 
      
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="commenttab">
                                @if (Auth::user()->user_type_id == 6)
                                <div class="form-group">	
                                    <a href="" class="btn btn-info btn-icon ml-2 btn-sm float-right"  data-toggle="modal" data-target="#modal_add_comment"><i class="icon-add"></i></a>
                                    <br>
                                </div>
                                @endif

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="criteriatable">
                                        <thead>
                                            <tr class="bg-info">
                                                <th>วันที่</th>  
                                                <th>รายละเอียด</th>   
                                                @if (Auth::user()->user_type_id == 6)
                                                    <th>เพิ่มเติม</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody id="ev_edit_history_wrapper_tr"> 
                                            @foreach ($evedithistories->reverse() as $evedithistory)
                                            <tr>
                                                <td>{{$evedithistory->thaidate}}</td>
                                                <td>{{$evedithistory->detail}}</td>
                                                @if (Auth::user()->user_type_id == 6)
                                                <td><a href="#" type="button" data-id="{{$evedithistory->id}}" class="btn btn-sm bg-danger deletecomment">ลบ</a></td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
<script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.ui.position.js"></script>
<script src="{{asset('assets/dashboard/js/plugins/forms/wizards/steps.min.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/evweigthhelper.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            usertypeid: "{{Auth::user()->user_type_id}}"
        };

    </script>
@stop
