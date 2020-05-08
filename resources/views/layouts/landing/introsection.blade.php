<section class="section bg-color-grey-scale-1 m-0 border-0 border-0 m-0">
    <div class="container">
        <div class="row text-center text-md-left mt-4">
            @foreach ($introsections as $introsection)
                <div class="col-md-4 mb-4 mb-md-0 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="200">
                    <div class="row justify-content-center justify-content-md-start">
                        <div class="col-4">
                            @if (!Empty($introsection->icon))
                                    <img class="img-fluid mb-4" src="{{asset($introsection->icon)}}" alt="{{$introsection->text1}}">
                                @else
                                    <img class="img-fluid mb-4" src="{{asset('assets/landing/img/icons/icon.png')}}" >
                            @endif
                        </div>
                        <div class="col-lg-8">
                        <h2 class="font-weight-bold text-5 line-height-5 mb-1">{{$introsection->text1}}</h2>
                            <p class="mb-0">{{$introsection->text2}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>