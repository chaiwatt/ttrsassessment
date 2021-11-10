@php
    $section5 = $sharehomepagesections->where('id',10)->first();
@endphp
<div id="custom-section5" class="pb-50 gray-color style3 pt-50 " style="{{$section5->bg}}">
    @if (!empty($section5->title))
        <h2 style="{{$section5->titlecss}}">{{$section5->title}}</h2>
    @endif
    
    <div class="container">
        
        <div class="row">
           <div class="col-lg-12">
                {!!$section5->content!!}
           </div>  
        </div>
    </div>
</div>