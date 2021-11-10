@php
    $section3 = $sharehomepagesections->where('id',8)->first();
@endphp
<div id="custom-section3" class="pb-50 gray-color style3 pt-50 " style="{{$section3->bg}}">
    @if (!empty($section3->title))
        <h2 style="{{$section3->titlecss}}">{{$section3->title}}</h2>
    @endif
    
    <div class="container">
        
        <div class="row">
           <div class="col-lg-12">
                {!!$section3->content!!}
           </div>  
        </div>
    </div>
</div>