@extends('layouts.blog.main')
@section('pageCss')
@stop
@section('content')
<section>
    <div class="container">

      <div class="section-title">
        <h2 class="sarabun">ข่าวสาร</h2>
      </div>
      
      @foreach ($pages as $page)
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5"> <img src="{{asset($page->sidebarimage->name)}}" class="img-responsive"></div>
                <div class="col-md-7">
                    <h3 class="sarabun">{{$page->name}}</h3>
                    <i class="icofont-calendar"></i> โพสต์: {{$page->day}} {{$page->month}} {{$page->year}} &nbsp; <i class="icofont-eye"></i> เข้าดู: {{$page->pageview->count()}}
                    <p class="mt-2">{{$page->header}}...</p>
                    <a class="btn  btn-info" href="{{route('landing.page',['slug' => $page->slug])}}">ดูเพิ่มเติม</a>
            </div>
            </div>
            <hr>
        </div>
      @endforeach

 
       <div class="col-md-12">
           <div class="container text-center">
            <nav aria-label="...">
                {{-- <ul class="pagination pagination-lg justify-content-center">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">ย้อนกลับ</a>
                  </li>
                  <li class="page-item active" aria-current="page">
                      <a class="page-link" href="#">1</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item">
                      <a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">ต่อไป</a>
                  </li>
                </ul> --}}
                {{$pages->links()}} 
              </nav>
           </div>
       </div>

    </div>

    
  </section>

@endsection
@section('pageScript')

@stop
