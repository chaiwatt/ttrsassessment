<div id="carouselExampleIndicators" class="carousel slide  carousel-fade" data-ride="carousel">
  <ol class="carousel-indicators">
    @foreach ($slides as $key => $slide)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" ></li>
    @endforeach
  </ol>
  <div class="carousel-inner">
    @foreach ($slides as $key => $slide)
        @if ($key == 0)
          <div class="carousel-item active">
            <img class="d-block w-100" src="{{asset($slide->file)}}" alt="First slide">
          </div>
          @else 
          <div class="carousel-item">
              <img class="d-block w-100" src="{{asset($slide->file)}}" alt="First slide">
            </div>
        @endif
    @endforeach


  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>