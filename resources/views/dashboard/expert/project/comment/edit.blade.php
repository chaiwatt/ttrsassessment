@extends('layouts.dashboard.main')
@section('pageCss')
<style>
    textarea{
        font-size: 16px !important;
    }
</style>
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">ความเห็นผู้เชี่ยวชาญ </span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{route('dashboard.expert.report')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> แดชบอร์ด</a>
                    {{-- <a href="#" class="breadcrumb-item"> Full TBP</a> --}}
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
            {{-- @if ($errors->count() > 0)
                <div class="alert alert-warning alert-styled-left alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{ $errors->first() }}
                </div>


            @endif --}}

        
			@if ($errors->count() > 0)
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-styled-left alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{ $error}}
                </div>
            @endforeach
        @endif

        @php
            $disable = '';
            if($businessplan->business_plan_status_id >= 8){
                $disable = 'disabled';
            }
        @endphp
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" action="{{route('dashboard.expert.project.comment.editsave',['id' => $fulltbp->id])}}" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-highlight">
                           
                            <li class="nav-item"><a href="#left-icon-overview" class="nav-link active" data-toggle="tab"><i class="icon-magic-wand2 mr-2"></i>Overview</a></li>
                            <li class="nav-item"><a href="#left-icon-management" class="nav-link" data-toggle="tab"><i class="icon-stamp mr-2"></i>Management</a></li>
                            <li class="nav-item"><a href="#left-icon-technology" class="nav-link" data-toggle="tab"><i class="icon-atom2 mr-2"></i>Technology</a></li>
                            <li class="nav-item"><a href="#left-icon-marketing" class="nav-link" data-toggle="tab"><i class="icon-stats-growth mr-2"></i>Marketability</a></li>
                            <li class="nav-item"><a href="#left-icon-businessprospect" class="nav-link" data-toggle="tab"><i class="icon-pie-chart5 mr-2"></i>Business Prospect</a></li>
                         
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="left-icon-overview">
                                <div class="form-group">
                                    @if ($businessplan->business_plan_status_id < 8)
                                            <textarea name="overview" id="" cols="30" rows="15" class="form-control form-control-lg" {{$disable}}>{{@$expertcomment->overview}}</textarea>
                                        @else
                                            <div style="border-style:dashed;border-width:1px;border-radius:5px;padding:10px;height:300px;width:100%;overflow:auto;">{{@$expertcomment->overview}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-management">
                                <div class="form-group">
                                    @if ($businessplan->business_plan_status_id < 8)
                                            <textarea name="management" id="" cols="30" rows="15" class="form-control form-control-lg" {{$disable}}>{{@$expertcomment->management}}</textarea>
                                        @else
                                            <div style="border-style:dashed;border-width:1px;border-radius:5px;padding:10px;height:300px;width:100%;overflow:auto;">{{@$expertcomment->management}}</div>
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-technology">
                                <div class="form-group">
                                    @if ($businessplan->business_plan_status_id < 8)
                                            <textarea name="technology" id="" cols="30" rows="15" class="form-control form-control-lg" {{$disable}}>{{@$expertcomment->technology}}</textarea>
                                        @else
                                            <div style="border-style:dashed;border-width:1px;border-radius:5px;padding:10px;height:300px;width:100%;overflow:auto;">{{@$expertcomment->technology}}</div>
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-marketing">
                                <div class="form-group">
                                    @if ($businessplan->business_plan_status_id < 8)
                                            <textarea name="marketing" id="" cols="30" rows="15" class="form-control form-control-lg" {{$disable}}>{{@$expertcomment->marketing}}</textarea>
                                        @else
                                            <div style="border-style:dashed;border-width:1px;border-radius:5px;padding:10px;height:300px;width:100%;overflow:auto;">{{@$expertcomment->marketing}}</div>
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-businessprospect">
                                <div class="form-group">
                                    @if ($businessplan->business_plan_status_id < 8)
                                            <textarea name="businessprospect" id="" cols="30" rows="15" class="form-control form-control-lg" {{$disable}}>{{@$expertcomment->businessprospect}}</textarea>
                                        @else
                                            <div style="border-style:dashed;border-width:1px;border-radius:5px;padding:10px;height:300px;width:100%;overflow:auto;">{{@$expertcomment->businessprospect}}</div>
                                    @endif
                                </div>
                            </div>

                        </div>
                        @if ($businessplan->business_plan_status_id < 8)
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
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
    </script>
@stop