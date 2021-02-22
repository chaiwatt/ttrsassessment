@extends('layouts.blog.single.main')
@section('pageCss')
@stop
@section('content')
<section>
    <div class="container">
      <div class="section-title">
        <h2 class="content sarabun">คำถามที่พบบ่อย</h2>
      </div>
      <div class="row">
        <div class="col-md-12">
            <div class="pxlr-club-faq">
                <div class="content">
                    <div class="panel-group" id="accordion" role="tablist"
                        aria-multiselectable="true">
                        @foreach ($faqs as $key => $faq)
                            <div class="panel panel-default mt-2">
                                <div class="panel-heading" id="heading{{$key+1}}" role="tab">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                            data-parent="#accordion" href="#collapse{{$key+1}}"
                                            aria-expanded="false" aria-controls="collapse{{$key+1}}">{{$key+1}}.
                                            {{$faq->title}}
                                            <i class="pull-right icofont-plus"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapse{{$key+1}}" role="tabpanel"
                                        aria-labelledby="heading{{$key+1}}">
                                    <div class="panel-body pxlr-faq-body mt-4">
                                        <p>{{$faq->body}}</p>
                                    </div>
                                </div>
                            </div>  
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
      </div>

    </div>
</section>
@endsection

@section('pageScript')

@stop
