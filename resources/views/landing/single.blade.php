@extends('layouts.blog.single.main')
@section('pageCss')
@stop
@section('content')
<div class="container ">
    <div class="row">
        <div class="col-lg-9">
            <h3 class="sarabun">{{$page->name}}</h3>
            <hr>
            <p><i class="icofont-calendar"></i> โพสต์: {{$page->day}} {{$page->month}} {{$page->year}} &nbsp; <i class="icofont-eye"></i> เข้าดู: {{$page->pageview->count()}}</p>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <i class="icofont-tags mt-2"></i> ป้ายกำกับ: &nbsp;
                @foreach ($pagetags as $tag)
                    <li class="breadcrumb-item"><a href="#">{{$tag->tag->name}}</a></li> 
                @endforeach
              </ol>
            </nav>
            </p>

            <hr>
            <div class="blog-content">
              <img src="{{asset($page->featureimage->name)}}" class="img-responsive">
              <hr>                 
              <p>{!!$page->content!!}</p>
            </div>
           
            <div class="well">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
                        {{ Session::get('success') }}
                    </div>
                    @elseif( Session::has('error') )
                    <div class="alert alert-danger alert-styled-left alert-dismissible">
                        {{ Session::get('error') }}
                    </div>
                    @endif
                    @if ($errors->count() > 0)
                    <div class="alert alert-danger alert-styled-left alert-dismissible">
                        {{ $errors->first() }}
                    </div>
                @endif
                <h4><i class="fa fa-paper-plane-o"></i> แสดงความเห็น:</h4>
                <form method="POST" action="{{route('blog.comment',['id' => $page->id])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <textarea name="comment" class="form-control form-control-lg" rows="3"></textarea>
                    </div>
                    <button type="submit" class=" btn btn-lg btn-info"><i class="fa fa-reply"></i> แสดงความเห็น</button>
                </form>
            </div>
            <hr>

            <!-- the comments -->
            <div class="container">
                @foreach ($page->blogcomment->reverse() as $blogcomment)
                    <div class="col-sm-12">
                        <div class="row">
                        <div class="col-sm-1">
                            @if (Empty($blogcomment->user->picture))
                               <h3 class="ml-2"><img class="rounded-circle" src="{{asset('assets/landing/img/user/user.png')}}" width="60" height="60" alt="">
                                @else
                                <h3 class="ml-2"><img class="rounded-circle" src="{{asset($blogcomment->user->picture)}}" alt="">
                            @endif
                            
                            </div>
                            <div class="col-sm-6 ml-3">
                            <b> {{$blogcomment->user->name}} {{$blogcomment->user->lastname}} :</b>
                            <small> {{$blogcomment->createatth}} </small>
                            @if (Auth::check())
                                @if (Auth::user()->user_type_id >= 5)
                                <a href="{{route('blog.delete',['id' => $blogcomment->id])}}" class="text-danger" style="text-decoration: none"><i class="icofont-close"></i>ลบ</a>
                                @endif
                            @endif
                            </h3>
                            <p>{{$blogcomment->comment}}</p>
                        </div>
                    </div>
                    <hr>
                    </div>
                @endforeach
             </div>
        </div>
       
    <div class="col-lg-3">
          <div class="well">
                <h4 class="sarabun"> <i class="icofont-tags mt-2"></i> <b> ข่าวสาร</b></h3>
                <div class="row">
                    @foreach ($pages->reverse() as $_page)
                    <div class="card">
                        <img src="{{asset($_page->sidebarimage->name)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <a href="{{route('landing.page',['slug' => $_page->slug])}}" class="card-text">{{$_page->name}}</a>
                        </div>
                      </div>
                    @endforeach
                </div>
          </div>
    </div>
  </div>
</div>
@endsection

@section('pageScript')

@stop
