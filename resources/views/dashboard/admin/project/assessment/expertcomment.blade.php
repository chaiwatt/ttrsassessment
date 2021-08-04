@extends('layouts.dashboard.main')
@section('pageCss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">
<style>
    th{
        text-align: left !important;
    }
</style>
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">ความเห็นผู้เชี่ยวชาญ: โครงการ{{$fulltbp->minitbp->project}}</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <div class="form-check ">
                    </div>
                </div>
               
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>โครงการ</a>
                    <a href="{{route('dashboard.admin.project.assessment')}}" class="breadcrumb-item">ลงคะแนน</a>
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
            @foreach ($expertcomments as $expertcomment)
            <div class="col-md-12">
                
                <div class="card">
                    
                    <div class="card-body">
                      <div class="mb-3"> <strong >ความเห็น: คุณ{{$expertcomment->user->name}} {{$expertcomment->user->lastname}}</strong> </div>
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
                                    <div style="border-style:dashed;border-width:1px;border-radius:5px;padding:10px;height:200px;width:100%;overflow:auto;">{{@$expertcomment->overview}}</div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-management">
                                <div class="form-group">
                                    <div style="border-style:dashed;border-width:1px;border-radius:5px;padding:10px;height:200px;width:100%;overflow:auto;">{{@$expertcomment->management}}</div>    
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-technology">
                                <div class="form-group">
                                    <div style="border-style:dashed;border-width:1px;border-radius:5px;padding:10px;height:200px;width:100%;overflow:auto;">{{@$expertcomment->technology}}</div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-marketing">
                                <div class="form-group">
                                    <div style="border-style:dashed;border-width:1px;border-radius:5px;padding:10px;height:200px;width:100%;overflow:auto;">{{@$expertcomment->marketing}}</div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="left-icon-businessprospect">
                                <div class="form-group">
                                    <div style="border-style:dashed;border-width:1px;border-radius:5px;padding:10px;height:200px;width:100%;overflow:auto;">{{@$expertcomment->businessprospect}}</div>
                                </div>
                            </div>
                        </div>     
                    </div>
                </div>
            </div>
            @endforeach

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
    
@stop
