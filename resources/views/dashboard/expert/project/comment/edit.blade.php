@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">ความเห็นผู้เชี่ยวชาญ </span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> โครงการ</a>
                    <a href="#" class="breadcrumb-item"> Full Tbp</a>
                    <span class="breadcrumb-item active">ความเห็นผู้เชี่ยวชาญ</span>
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
                    <form method="POST" action="{{route('dashboard.expert.project.comment.editsave',['id' => $fulltbp->id])}}" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-highlight">
                            {{-- <li class="nav-item"><a href="#left-icon-fulltbp" class="nav-link active" data-toggle="tab"><i class="icon-files-empty mr-2"></i>Full Tbp</a></li> --}}
                            <li class="nav-item"><a href="#left-icon-overview" class="nav-link active" data-toggle="tab"><i class="icon-magic-wand2 mr-2"></i>Overview</a></li>
                            <li class="nav-item"><a href="#left-icon-management" class="nav-link" data-toggle="tab"><i class="icon-stamp mr-2"></i>Management</a></li>
                            <li class="nav-item"><a href="#left-icon-technology" class="nav-link" data-toggle="tab"><i class="icon-atom2 mr-2"></i>Technology</a></li>
                            <li class="nav-item"><a href="#left-icon-marketing" class="nav-link" data-toggle="tab"><i class="icon-stats-growth mr-2"></i>Marketing</a></li>
                            <li class="nav-item"><a href="#left-icon-businessprospect" class="nav-link" data-toggle="tab"><i class="icon-pie-chart5 mr-2"></i>Business Prospect</a></li>
                            {{-- <li class="nav-item"><a href="#left-icon-attachment" class="nav-link" data-toggle="tab"><i class="icon-attachment mr-2"></i>ไฟล์แนบ</a></li> --}}
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="left-icon-overview">
                                <div class="form-group">
                                    <textarea name="overview" id="" cols="30" rows="15" class="form-control">{{@$expertcomment->overview}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-management">
                                <div class="form-group">
                                    <textarea name="management" id="" cols="30" rows="15" class="form-control">{{@$expertcomment->management}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-technology">
                                <div class="form-group">
                                    <textarea name="technology" id="" cols="30" rows="15" class="form-control">{{@$expertcomment->technology}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-marketing">
                                <div class="form-group">
                                    <textarea name="marketing" id="" cols="30" rows="15" class="form-control">{{@$expertcomment->marketing}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-businessprospect">
                                <div class="form-group">
                                    <textarea name="businessprospect" id="" cols="30" rows="15" class="form-control">{{@$expertcomment->businessprospect}}</textarea>
                                </div>
                            </div>
                            {{-- <div class="tab-pane fade" id="left-icon-attachment">
                               
                            </div> --}}
                            {{-- <div class="tab-pane fade" id="left-icon-share">
                                <div class="form-group">
                                    <label>เลือกผู้รับ</label><span class="text-danger">*</span>
                                    <select id="users" data-placeholder="เลือกผู้รับ" class="form-control form-control-select2" multiple>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}" >{{$user->name}} {{$user->lastname}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
                        </div>
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
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
    </script>
@stop