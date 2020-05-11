@extends('layouts.dashboard.main')
@section('pageCss')
{{-- <link href="{{asset('assets/dashboard/css/treeview.css')}}" rel="stylesheet"> --}}
@stop
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">เพิ่มหน้าเพจ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <a href="{{route('setting.admin.website.page')}}" class="breadcrumb-item"> หน้าเพจ</a>
                    <span class="breadcrumb-item active">เพิ่มหน้าเพจ</span>
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
                           <div class="col-md-6">
                              <form action="" method="post">
                                 @csrf
                                  @if(count($errors) > 0)
                                      <div class="alert alert-danger  alert-dismissible">
                                         <button type="button" class="close" data-dismiss="alert">×</button>
                                         @foreach($errors->all() as $error)
                                                  {{ $error }}<br>
                                         @endforeach
                                      </div>
                                   @endif
                                   @if ($message = Session::get('success'))
                                    <div class="alert alert-success  alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">×</button>   
                                            <strong>{{ $message }}</strong>
                                    </div>
                                 @endif
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label>ชื่อเมนู</label>
                                          <input type="text" name="title" class="form-control">   
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label>เมนูหลัก</label>
                                          <select name="menu" placeholder="เมนู" class="form-control form-control-select2">
                                            <option value="" >เลือกเมนูหลัก</option>
                                            @foreach($allMenus as $key => $menu)
                                                <option value="{{$key}}" >{{$menu}}</option>
                                            @endforeach
                                        </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
                                        <a href="" class="btn bg-info">แก้ไข <i class="icon-pencil ml-2"></i></a>
                                        <a href="" class="btn bg-danger">ลบ <i class="icon-trash-alt ml-2"></i></a>
                                    </div>
                                 </div>
                              </form>
                           </div>
                           <div class="col-md-6">
                               <ul id="tree1">
                                  @foreach($menus as $menu)
                                     <li>
                                       <strong class="text-teal">{{$menu->name}}</strong>  
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
            <!-- /striped rows -->
            </div>
        </div>
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
{{-- <script src="{{asset('assets/dashboard/js/treeview.js')}}"></script> --}}

<script  type="text/javascript">

</script>
@stop
