@extends('layouts.dashboard.main')
@section('pageCss')
@stop
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">ขั้นตอนการบริการ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <a href="{{route('setting.admin.website.homepage.service.create')}}" class="btn btn-labeled btn-labeled-right bg-info">เพิ่มขั้นตอนการบริการ<b><i class="icon-plus3"></i></b></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <a href="{{route('setting.admin.website.homepage.service')}}" class="breadcrumb-item"> หน้าแรก (Homepage)</a>
                    <span class="breadcrumb-item active">ขั้นตอนการบริการ</span>
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
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title" style="font-size:16px;font-weight: bold">Service</h6>
                        <div class="header-elements">
                            {{-- <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                                
                                <span></span>
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" >
                                <thead>
                                    <tr class="bg-info">
                                        <th style="text-align: center">ข้อความ (ภาษาไทย)</th>
                                        <th style="text-align: center">ข้อความอธิบาย (ภาษาไทย)</th>                            
                                        <th style="width:150px;text-align: center">เพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($homepageservices as $key => $homepageservice)
                                    <tr>   
                                        <td> {{$homepageservice->titlethai}} </td>   
                                        <td> {{$homepageservice->descriptionthai}} </td>                                   
                                        <td style="text-align: center"> 
                                            <a href="{{route('setting.admin.website.homepage.service.edit',['id' => $homepageservice->id])}}" class="btn btn-sm bg-primary">แก้ไข</a>
                                            <a href="{{route('setting.admin.website.homepage.service.delete',['id' => $homepageservice->id])}}"  onclick="confirmation(event)" class="btn btn-sm bg-danger">ลบ</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>      
                        </div>
                        <form method="POST" action="{{route('setting.admin.website.homepage.service.editsavestatus')}}" >
                            @csrf

                            <div class="form-group mb-md-2 mt-4">
                                <div class="form-check form-check-inline">
                                    @php
                                        $check = 'checked';
                                        if(!Empty($homepageserviceurl)  && $homepageserviceurl->url_type == 1){
                                            $check = '';
                                        }
                                    @endphp
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input-styled selectlink" name="selectlink" value="0" {{$check}} data-fouc>
                                        ลิงก์ (เช่น https://google.com)
                                    </label>
                                </div>

                                @php
                                    $check1 = 'checked';
                                    if(Empty($homepageserviceurl)  || $homepageserviceurl->url_type == 0){
                                        $check1 = '';
                                    }
                                @endphp

                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input-styled selectlink" name="selectlink" {{$check1}} data-fouc>
                                        หน้าเพจ&nbsp;<a href="#" data-toggle="modal" id="editpage"> <i class="icon-pencil5 text-info"></i></a>
                                    </label>
                                </div>
                            </div>
                            @if (Empty($homepageserviceurl))
                                <input type="text" id="linktype" name="linktype" value="0" hidden>
                            @else
                                <input type="text" id="linktype" name="linktype" value="{{@$homepageserviceurl->url_type}}" hidden>
                            @endif


                            <div class="form-group" style="margin-top:-20px" id="linksource" @if (!Empty($homepageserviceurl) && $homepageserviceurl->url_type == 1) hidden @endif>
                                <input type="text" name="link" value="{{@$homepageserviceurl->url}}"  placeholder="เช่น https://www.google.co.th" class="form-control form-control-lg stringformat100">
                            </div>

                            <div class="form-group" style="margin-top:-20px" id="linksourceinternal"
                                @if (Empty($homepageserviceurl))
                                        hidden
                                    @else
                                        @if ($homepageserviceurl->url_type == 0)
                                            hidden
                                        @endif
                                @endif
                            >
								<div class="form-group">
                                    @php
                                        $lasttext = substr(@$homepageserviceurl->url, strrpos(@$homepageserviceurl->url, '/' )+1)
                                    @endphp
                                        {{-- {{$lasttext}} --}}
									<select id="page" name="page" data-placeholder="หน้าเพจ" class="form-control form-control-lg form-control-select2">
										@foreach ($pages as $page)
											<option value="{{$page->id}}"
                                                @if ($lasttext == $page->name)
                                                    selected
                                                @endif
                                            >{{$page->name}}</option> 
										@endforeach
									</select>
								</div>
                            </div>

                            <div class="form-group mt-2">
                                <label>สถานะการแสดงหน้าแรก</label>
                                <select name="status" id="status" placeholder="สถานะการแสดง" class="form-control form-control-select2">
                                        <option value="0" @if ($homepagesection->show == 0) selected @endif >ซ่อน</option>
                                        <option value="1" @if ($homepagesection->show == 1) selected @endif >แสดง</option>
                                </select>

                                <div class="text-right mt-2">
                                    <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </div>
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
<script src="{{asset('assets/dashboard/js/app/helper/utility.js')}}"></script>
<script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
    <script>
        var route = {
            url: "{{ url('/') }}",
            token: $('meta[name="csrf-token"]').attr('content'),
            branchid: "{{Auth::user()->branch_id}}"
        };
        
        var page =  "{{ $lasttext }}"
        $(document).on('change', '.selectlink', function(e) {
            if($("input[name='selectlink']:checked").val()=='0'){
                $("#linksourceinternal").attr("hidden",true);
                $("#linksource").attr("hidden",false);
                $('#linktype').val(0);
            }else{
                $("#linksourceinternal").attr("hidden",false);
                $("#linksource").attr("hidden",true);
                $('#linktype').val(1);
            }
        });

        $(document).on('click', '#editpage', function(e) {
            if($("input[name='selectlink']:checked").val() != '0'){
                window.location.replace(route.url +'/setting/admin/website/webpage/edit/' + $('select[name=page] option').filter(':selected').val());
            }
        });
    </script>
@stop