@extends('layouts.blog.single.main')
@section('pageCss')
@stop
@section('content')
<div class="container ">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="sarabun">{{$announce->title}}</h3>
            {{-- <hr> --}}
            <p><i class="icofont-calendar"></i> โพสต์: {{$announce->day}} {{$announce->month}} {{$announce->year}} &nbsp; <i class="icofont-tags mt-2"></i> หมวดประกาศ: {{$announce->announcecategory->name}}</p>
            </p>

            <hr>
            <div class="blog-content">                
              <p>{!!$announce->content!!}</p>

              <table class="table table-bordered table-striped">
                  <thead>
                      <tr class="bg-info text-white">
                          <td >เอกสารแนบประกาศ</td> 
                          <td style="width:120px">เพิ่มเติม</td>                                                                                   
                      </tr>
                  </thead>
                  <tbody id="announceattachment_wrapper_tr"> 
                      @foreach ($announceattachments as $announceattachment)
                      <tr >                                        
                          <td> {{$announceattachment->name}} </td>                                            
                          <td> 
                              <a href="{{asset($announceattachment->path)}}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>

            </div>
            <hr>
        </div>
  </div>
</div>
@endsection

@section('pageScript')

@stop
