
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	
        <meta name="csrf-token" content="{{ csrf_token() }}" />
		<title>TTRS | ศูนย์สนับสนุนและให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศ</title>
		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{asset('assets/landing/img/apple-touch-icon.png')}}">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
        @include('layouts.landing.css')
	</head>
	<body class="boxed">
		<div class="body">
            @include('layouts.landing.header')
			<div role="main" class="main">
                <div class="container py-4">
					<div class="row">
						<div class="col-lg-3 order-lg-2">
							@include('layouts.landing.sidebar')
						</div>
						<div class="col-lg-9 order-lg-1">
							<div class="blog-posts single-post">
								<article class="post post-large blog-single-post border-0 m-0 p-0">
                                    <div class="post-image ml-0">
										<a href="blog-post.html">
											<img src="{{asset('/assets/landing/img/feature/blog.jpg')}}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
										</a>
									</div>							
									<div class="post-date ml-0">
										<span class="day">10</span>
										<span class="month">Jan</span>
									</div>
							
									<div class="post-content ml-0">
										<h2 ><a href="blog-post.html" >พยากรณ์อากาศ 10 พ.ค. 63 ระวัง! อันตรายจากพายุฝนและลมกระโชกแรง</a></h2>
										<div class="post-meta">
											<span><i class="far fa-user"></i> โดย <a href="#">John Doe</a> </span>
											<span><i class="far fa-folder"></i> <a href="#">Lifestyle</a>, <a href="#">Design</a> </span>
										</div>

										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur lectus lacus, rutrum sit amet placerat et, bibendum nec mauris. Duis molestie, purus eget placerat viverra, nisi odio gravida sapien, congue tincidunt nisl ante nec tellus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sagittis, massa fringilla consequat blandit, mauris ligula porta nisi, non tristique enim sapien vel nisl. Suspendisse vestibulum lobortis dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent nec tempus nibh. Donec mollis commodo metus et fringilla. Etiam venenatis, diam id adipiscing convallis, nisi eros lobortis tellus, feugiat adipiscing ante ante sit amet dolor. Vestibulum vehicula scelerisque facilisis. Sed faucibus placerat bibendum. Maecenas sollicitudin commodo justo, quis hendrerit leo consequat ac. Proin sit amet risus sapien, eget interdum dui. Proin justo sapien, varius sit amet hendrerit id, egestas quis mauris.</p>
										<p>Ut ac elit non mi pharetra dictum nec quis nibh. Pellentesque ut fringilla elit. Aliquam non ipsum id leo eleifend sagittis id a lorem. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam massa mauris, viverra et rhoncus a, feugiat ut sem. Quisque ultricies diam tempus quam molestie vitae sodales dolor sagittis. Praesent commodo sodales purus. Maecenas scelerisque ligula vitae leo adipiscing a facilisis nisl ullamcorper. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
										<p>Curabitur non erat quam, id volutpat leo. Nullam pretium gravida urna et interdum. Suspendisse in dui tellus. Cras luctus nisl vel risus adipiscing aliquet. Phasellus convallis lorem dui. Quisque hendrerit, lectus ut accumsan gravida, leo tellus porttitor mi, ac mattis eros nunc vel enim. Nulla facilisi. Nam non nulla sed nibh sodales auctor eget non augue. Pellentesque sollicitudin consectetur mauris, eu mattis mi dictum ac. Etiam et sapien eu nisl dapibus fermentum et nec tortor.</p>
								
                                        <div class="row">
                                            <div class="col">
                                                <div class="lightbox" data-plugin-options="{'delegate': 'a', 'type': 'image', 'gallery': {'enabled': true}, 'mainClass': 'mfp-with-zoom', 'zoom': {'enabled': true, 'duration': 300}}">
                                                    <div class="owl-carousel owl-theme stage-margin" data-plugin-options="{'items': 3, 'margin': 10, 'loop': false, 'nav': true, 'dots': false, 'stagePadding': 40}">
                                                        <div>
                                                            <a class="img-thumbnail img-thumbnail-no-borders img-thumbnail-hover-icon" href="{{asset('/assets/landing/img/gallery/project-1.jpg')}}">
                                                                <img class="img-fluid" src="{{asset('/assets/landing/img/gallery/project-1.jpg')}}" alt="Project Image">
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a class="img-thumbnail img-thumbnail-no-borders img-thumbnail-hover-icon" href="{{asset('/assets/landing/img/gallery/project-2.jpg')}}">
                                                                <img class="img-fluid" src="{{asset('/assets/landing/img/gallery/project-2.jpg')}}" alt="Project Image">
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a class="img-thumbnail img-thumbnail-no-borders img-thumbnail-hover-icon" href="{{asset('/assets/landing/img/gallery/project-3.jpg')}}">
                                                                <img class="img-fluid" src="{{asset('/assets/landing/img/gallery/project-3.jpg')}}" alt="Project Image">
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a class="img-thumbnail img-thumbnail-no-borders img-thumbnail-hover-icon" href="{{asset('/assets/landing/img/gallery/project-4.jpg')}}">
                                                                <img class="img-fluid" src="{{asset('/assets/landing/img/gallery/project-4.jpg')}}" alt="Project Image">
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a class="img-thumbnail img-thumbnail-no-borders img-thumbnail-hover-icon" href="{{asset('/assets/landing/img/gallery/project-5.jpg')}}">
                                                                <img class="img-fluid" src="{{asset('/assets/landing/img/gallery/project-5.jpg')}}" alt="Project Image">
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a class="img-thumbnail img-thumbnail-no-borders img-thumbnail-hover-icon" href="{{asset('/assets/landing/img/gallery/project-6.jpg')}}">
                                                                <img class="img-fluid" src="{{asset('/assets/landing/img/gallery/project-6.jpg')}}" alt="Project Image">
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a class="img-thumbnail img-thumbnail-no-borders img-thumbnail-hover-icon" href="{{asset('/assets/landing/img/gallery/project-7.jpg')}}">
                                                                <img class="img-fluid" src="{{asset('/assets/landing/img/gallery/project-7.jpg')}}" alt="Project Image">
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a class="img-thumbnail img-thumbnail-no-borders img-thumbnail-hover-icon" href="{{asset('/assets/landing/img/gallery/project.jpg')}}">
                                                                <img class="img-fluid" src="{{asset('/assets/landing/img/gallery/project.jpg')}}" alt="Project Image">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
							
										{{-- <div class="post-block mt-5 post-share">
											<h4 class="mb-3">Share this Post</h4>
											<div class="addthis_toolbox addthis_default_style ">
												<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>						
												<a class="addthis_counter addthis_pill_style"></a>
											</div>
											<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-50faf75173aadc53"></script>
										</div> --}}
							
									</div>
								</article>							
							</div>
						</div>
					</div>
				</div>
			</div>
            @include('layouts.landing.footer')
        </div> 
        @include('layouts.landing.js')
	</body>
</html>
