@php
    $section4 = $sharehomepagesections->where('id',9)->first();
@endphp
<div id="custom-section4" class="pb-50 gray-color style3 pt-50 " style="{{$section4->bg}}">
    @if (!empty($section4->title))
        <h2 style="{{$section4->titlecss}}">{{$section4->title}}</h2>
    @endif
    
    <div class="container">
        
        <div class="row">
           <div class="col-lg-12">
                {!!$section4->content!!}
           </div>  
        </div>
    </div>
</div>