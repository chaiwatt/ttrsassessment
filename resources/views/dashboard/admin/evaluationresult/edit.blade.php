@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/plugins/summernote/summernote.min.css')}}" rel="stylesheet">
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">บทวิเคราะห์ </span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ผลการประเมิน</a>
                    <a href="{{route('dashboard.admin.evaluationresult')}}" class="breadcrumb-item">รายงานผลการประเมิน</a>
                    <span class="breadcrumb-item active">บทวิเคราะห์</span>
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
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-styled-left alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{ $error }}
                </div>
            @endforeach
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" action="{{route('dashboard.admin.evaluationresult.editsave',['id' => $evaluationresult->id])}}" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-highlight">
                            <li class="nav-item"><a href="#left-icon-info" class="nav-link active" data-toggle="tab"><i class="icon-user mr-2"></i>ข้อมูลผู้รับผิดชอบ</a></li>
                            <li class="nav-item"><a href="#left-icon-management" class="nav-link" data-toggle="tab"><i class="icon-stamp mr-2"></i>Management</a></li>
                            <li class="nav-item"><a href="#left-icon-technology" class="nav-link" data-toggle="tab"><i class="icon-atom2 mr-2"></i>Technology</a></li>
                            <li class="nav-item"><a href="#left-icon-marketing" class="nav-link" data-toggle="tab"><i class="icon-stats-growth mr-2"></i>Marketability</a></li>
                            <li class="nav-item"><a href="#left-icon-businessprospect" class="nav-link" data-toggle="tab"><i class="icon-pie-chart5 mr-2"></i>Business Prospect</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="left-icon-info">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>รหัสหน่วยงาน<span class="text-danger">*</span></label>
                                            <input type="text" name="headercode" id="headercode" value="{{$evaluationresult->headercode}}"  placeholder="รหัสหน่วยงาน" class="form-control form-control-lg required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ชื่อ<span class="text-danger">*</span></label>
                                            <input type="text" name="contactname" id="contactname" value="{{$evaluationresult->contactname ?? $user->name}}"  placeholder="ชื่อ" class="form-control form-control-lg required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>นามสกุล<span class="text-danger">*</span></label>
                                            <input type="text" name="contactlastname" id="contactlastname" value="{{$evaluationresult->contactlastname ?? $user->lastname}}"  placeholder="นามสกุล" class="form-control form-control-lg required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ตำแหน่ง<span class="text-danger">*</span></label>
                                            <input type="text" name="contactposition" id="contactposition" value="{{$evaluationresult->contactposition ?? $user->expertposition}}"  placeholder="ตำแหน่ง" class="form-control form-control-lg required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>เบอร์โทรศัพท์<span class="text-danger">*</span></label>
                                            <input type="text" name="contactphone" id="contactphone" value="{{$evaluationresult->contactphone ?? $generalinfo->phone1}}"  placeholder="เบอร์โทรศัพท์" class="form-control form-control-lg required" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>เบอร์ต่อ<span class="text-danger">*</span></label>
                                            <input type="text" name="contactphoneext" id="contactphoneext" value="{{$evaluationresult->contactphoneext}}"  placeholder="เบอร์ต่อ" class="form-control form-control-lg required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>โทรสาร<span class="text-danger">*</span></label>
                                            <input type="text" name="contactfax" id="contactfax" value="{{$evaluationresult->contactfax ?? $generalinfo->fax}}"  placeholder="โทรสาร" class="form-control form-control-lg required" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>อีเมล<span class="text-danger">*</span></label>
                                            <input type="text" name="contactemail" id="contactemail" value="{{$evaluationresult->contactemail ?? $user->email}}"  placeholder="อีเมล" class="form-control form-control-lg required" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>วันที่ในจดหมาย<span class="text-danger">*</span></label>
                                            <select name="evaluationday" id="evaluationday" data-placeholder="วันที่ในจดหมาย" class="form-control form-control-lg form-control-select2">
                                                @foreach ($evaluationdays as $evaluationday)                                                                
                                                    <option value="{{$evaluationday->id}}" @if ($evaluationday->id == $evaluationresult->evaluation_day_id) selected @endif> {{$evaluationday->name}} </option>
                                                @endforeach   
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>เดือนในจดหมาย<span class="text-danger">*</span></label>
                                            <select name="evaluationmonth" id="evaluationmonth" data-placeholder="เดือนในจดหมาย" class="form-control form-control-lg form-control-select2">
                                                @foreach ($evaluationmonths as $evaluationmonth)                                                                
                                                    <option value="{{$evaluationmonth->id}}" @if ($evaluationmonth->id == $evaluationresult->evaluation_month_id) selected @endif> {{$evaluationmonth->name}} </option>
                                                @endforeach   
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ปีในจดหมาย<span class="text-danger">*</span></label>
                                            <input type="text" name="evaluationyear" id="evaluationyear" value="{{$evaluationresult->evaluation_year ?? (date('Y')+543)}}"  placeholder="ปีในจดหมาย" class="form-control form-control-lg required" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-management">
                                <div class="form-group">
                                    <textarea name="management" id="management" cols="30" rows="15" class="form-control form-control-lg">{{old('management') ?? $evaluationresult->management}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-technology">
                                <div class="form-group">
                                    <textarea name="technoandinnovation" id="technoandinnovation" cols="30" rows="15" class="form-control form-control-lg">{{old('technoandinnovation') ?? $evaluationresult->technoandinnovation}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-marketing">
                                <div class="form-group">
                                    <textarea name="marketability" id="marketability" cols="30" rows="15" class="form-control form-control-lg">{{old('marketability') ?? $evaluationresult->marketability}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-businessprospect">
                                <div class="form-group">
                                    <textarea name="businessprospect" id="businessprospect" cols="30" rows="15" class="form-control form-control-lg">{{old('businessprospect') ?? $evaluationresult->businessprospect}}</textarea>
                                </div>
                            </div>
                        </div>
                        @if ($evaluationresult->fulltbp->status != 3)
                            <div class="text-right">
                                <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
                            </div>
                        @endif
                    </div>
                    </form>
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
<script src="{{asset('assets/dashboard/plugins/summernote/summernote.min.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
        $(document).ready(function() {
            $('#management').summernote({
                toolbar:false,
                height: 300,
                callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });
            $('#technoandinnovation').summernote({
                toolbar:false,
                height: 300,
                callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });
            $('#marketability').summernote({
                toolbar:false,
                height: 300,
                callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });
            $('#businessprospect').summernote({
                toolbar:false,
                height: 300,
                callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });
        });
    </script>
@stop