<div id="custom-section5" class="pb-50 gray-color style3 pt-50 " style="{{$sharehomepagesections->where('id',10)->first()->bg}}">
    <div class="container">
        <div class="row">
           <div class="col-lg-12">
                {!!$sharehomepagesections->where('id',10)->first()->content!!}
           </div>  
        </div>
    </div>
</div>