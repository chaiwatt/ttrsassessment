<!DOCTYPE html>
<html lang="zxx">  
    
<head>
        <!-- meta tag -->
        <meta charset="utf-8">
        <title>TTRS | สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)</title>
        <meta name="description" content="">
        <!-- responsive tag -->
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon -->
        <link rel="apple-touch-icon" href="apple-touch-icon.html">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/landing2/images/favicon.png')}}">
        <!-- Bootstrap v4.4.1 css -->

        @include('layouts.landing2.css')

    </head>
    <body class="defult-home">
        
        <div id="loader" class="loader">
            <div class="loader-container"></div>
        </div>

        <div class="main-content">
            
            @include('layouts.landing2.header')
            @if ($generalinfo->showbanner == 1)
                @include('layouts.landing2.banner')
            @endif
           
            @foreach ($sharehomepagesections as $sharehomepagesection)
                @include($sharehomepagesection->name)
            @endforeach
        </div> 
        @include('layouts.landing2.cookie')
        @include('layouts.landing2.footer')

        <div id="scrollUp" class="orange-color">
            <i class="fa fa-angle-up"></i>
        </div>

        <div aria-hidden="true" class="modal fade search-modal" role="dialog" tabindex="-1">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="flaticon-cross"></span>
            </button>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="search-block clearfix">
                        <form>
                            <div class="form-group">
                                <input class="form-control" placeholder="Search Here..." type="text">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search Modal End -->
        {{-- {{asset('assets/landing2/css/responsive.css')}} --}}
         <!-- modernizr js -->
         @include('layouts.landing2.js')
    </body>

</html>