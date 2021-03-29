<!DOCTYPE html>
<html lang="zxx">  
    
<head>
        <!-- meta tag -->
        <meta charset="utf-8">
        <title>TTRS - Thailand Technology Rating Support and Service (TTRS)</title>
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
        
        <!--Preloader area start here-->
        <div id="loader" class="loader">
            <div class="loader-container"></div>
        </div>
        <!--Preloader area End here--> 
     
    <!-- Main content Start -->
        <div class="main-content">
            
            <!--Full width header Start-->
            @include('layouts.landing2.header')
            <!--Full width header End-->
         
            <!-- Banner Section Start -->
            @include('layouts.landing2.banner')
            <!-- Banner Section End -->
                
            <!-- Services Section Start -->

            @include('layouts.landing2.services')
            <!-- Services Section End -->

            <!-- About Section Start -->
            @include('layouts.landing2.industrygroup')
            <!-- About Section End -->


            <!-- Process Section Start -->
            @include('layouts.landing2.pillars')
            <!-- Process Section End -->       

            <!-- Blog Section Start -->
            @include('layouts.landing2.blogs')
            <!-- Blog Section End -->

            <!-- Faq Start -->
            @include('layouts.landing2.faq')
            <!-- Faq End -->

            <!-- Partner Start -->
            {{-- @include('layouts.landing2.partner') --}}
            <!-- Partner End -->

        </div> 
        <!-- Main content End -->
             <!-- Cookie Start -->
             @include('layouts.landing2.cookie')
             <!-- Cookie End -->
        <!-- Footer Start -->
        @include('layouts.landing2.footer')
        <!-- Footer End -->

        <!-- start scrollUp  -->
        <div id="scrollUp" class="orange-color">
            <i class="fa fa-angle-up"></i>
        </div>
        <!-- End scrollUp  -->

        <!-- Search Modal Start -->
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