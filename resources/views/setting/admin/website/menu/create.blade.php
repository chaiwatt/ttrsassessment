@extends('layouts.dashboard.main')
@section('pageCss')
{{-- <link href="{{asset('assets/dashboard/css/treeview.css')}}" rel="stylesheet"> --}}
@stop
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4> <span class="font-weight-semibold">จัดการเมนู</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <a href="{{route('setting.admin.website.menu')}}" class="breadcrumb-item"> เมนู</a>
                    <span class="breadcrumb-item active">เพิ่มเมนู</span>
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
                           <div class="col-md-12">
                              <form action="{{route('setting.admin.website.menu.createsave')}}" method="post">
                                 @csrf
                                 <input type="text" id="menuid" name="menuid" hidden>
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label>ประเภทเมนู</label>
                                          <select name="menutype" id="menutype" placeholder="ประเภทเมนู" class="form-control form-control-select2">
                                            @foreach($menutypes as $key => $menutype)
                                                <option value="{{$menutype->id}}" >{{$menutype->name}}</option>
                                            @endforeach
                                        </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row" id="parent_wrapper" hidden>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label>Parent</label>
                                          <select name="parent" id="parent" placeholder="Parent" class="form-control form-control-select2">
                                            @foreach($directmenu2s as $key => $directmenu2)
                                                <option value="{{$directmenu2->id}}" >{{$directmenu2->name}}</option>
                                            @endforeach
                                        </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label>เมนูภาษาไทย<span class="text-danger">*</span></label>
                                          <input type="text" name="menuthai" value="{{old('menuthai')}}" id="menuthai" class="form-control form-control-lg">   
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <label>เมนูภาษาอังกฤษ<span class="text-danger">*</span></label>
                                           <input type="text" name="menuenglish" value="{{old('menuenglish')}}" id="menuenglish" class="form-control form-control-lg">   
                                        </div>
                                     </div>
                                     <div class="col-md-12">
                                        <div class="form-group">
                                           <label>ลิงก์ (ถ้าเป็นลิงก์ภายในให้ใส่เครื่องหมาย # เช่น #rs-header, #custom-section1 เป็นต้น)<span class="text-danger">*</span></label>
                                           <input type="text" name="url" id="url" class="form-control form-control-lg">   
                                        </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label>แสดงผลเมนู</label>
                                          <select name="showstatus" placeholder="แสดงผลเมนู" class="form-control form-control-select2">
                                            @foreach($showstatuses as $key => $showstatus)
                                                <option value="{{$showstatus->id}}" >{{$showstatus->name}}</option>
                                            @endforeach
                                        </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" name="action" value="create" class="btn bg-teal float-right">บันทึก <i class="icon-paperplane ml-2"></i></button>
                                        {{-- <button type="submit" name="action" value="edit" class="btn bg-info">แก้ไข <i class="icon-pencil ml-2"></i></button> --}}
                                        {{-- <button type="submit" name="action" value="delete" class="btn bg-danger">ลบ <i class="icon-trash-alt ml-2"></i></button> --}}
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                    </div>   
                </div>
            </div>
            {{-- <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                               <ul id="tree1">
                                  @foreach($menus as $menu)
                                     <li>
                                       <strong class="text-teal" style="line-height:24px">{{$menu->name}} ({{$menu->engname}})</strong>  
                                         @if(count($menu->childs))
                                             @include('layouts.landing.menu.managechild',['childs' => $menu->childs])
                                         @endif
                                     </li>
                                  @endforeach
                                 </ul>
                           </div>
                        </div>
                    </div>   
                </div>
            </div> --}}
    </div>
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script type="module" src="{{asset('assets/dashboard/js/app/helper/menuhelper.js')}}"></script>

<script  type="text/javascript">
	var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content')
    };

    $(document).on('change', '#menutype', function(e) {
        console.log($(this).val());
        if($(this).val() == 3){
            $("#parent_wrapper").attr("hidden",false);
        }else if($(this).val() == 2){
            $("#url").val("#");
            $("#parent_wrapper").attr("hidden",true);
        }else{
            $("#parent_wrapper").attr("hidden",true); 
            $("#url").val("");
        }
    });
</script>
@stop
