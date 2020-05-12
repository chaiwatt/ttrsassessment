
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
				@php
					$layoutname = 'layouts.landing.slide';
				@endphp
				@include($layoutname)
				@include('layouts.landing.introsection')
				@include('layouts.landing.blog')
				@include('layouts.landing.bottom_one')
			</div>
			@include('layouts.landing.footer')
		</div>

		@include('layouts.landing.js')
		
	</body>
</html>
