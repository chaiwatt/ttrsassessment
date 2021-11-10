@php
    $section1 = $sharehomepagesections->where('id',6)->first();
@endphp
<div id="custom-section1" class="pb-50 gray-color style3 pt-50 " style="{{$section1->bg}}">
    @if (!empty($section1->title))
        <h2 style="{{$section1->titlecss}}">{{$section1->title}}</h2>
    @endif
    
    <div class="container">
        
        <div class="row">
           <div class="col-lg-12">
                {!!$section1->content!!}
           </div>  
        </div>
    </div>
</div>