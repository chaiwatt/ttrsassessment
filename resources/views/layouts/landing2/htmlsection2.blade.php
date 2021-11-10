@php
    $section2 = $sharehomepagesections->where('id',7)->first();
@endphp
<div id="custom-section2" class="pb-50 gray-color style3 pt-50 " style="{{$section2->bg}}">
    @if (!empty($section2->title))
        <h2 style="{{$section2->titlecss}}">{{$section2->title}}</h2>
    @endif
    
    <div class="container">
        
        <div class="row">
           <div class="col-lg-12">
                {!!$section2->content!!}
           </div>  
        </div>
    </div>
</div>