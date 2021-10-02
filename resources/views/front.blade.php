<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/landing2/css/extend.css')}}">
    <title>Billboard</title>
    <style>
        /* body{
            padding: 0;
            background-color:{{$sharefrontpage->bgcolor}};
        }
        .fit { 
            max-width: {{$sharefrontpage->percent}}%;
            max-height: {{$sharefrontpage->percent}}%;
        }
        .center {
            position: absolute;
            top:0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        } */
        *
        {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
       
            font-family: 'Kanit', sans-serif;
        }
        .main
        {
            position: relative;
            width: 100%;
            height: 100vh;
            background: {{$sharefrontpage->bgcolor}};
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            align-items: center;
        }
        .banner
        {
            position: relative;
            width: 100%;
            height: 100vh;
            /* background: #3475ca; */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .banner img
        {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .enterwebsite
        {
            padding: 15px 0;
        }
        .enterwebsite a
        {
            text-decoration: none
        }

        @media (max-width: 991px)
        {
            .banner{
                height: 100vh;
                padding:50px;
            }
            .enterwebsite{
                padding:5px;
            }

        }

    </style>
</head>
<body >
    {{-- <a href="{{ route('landing.front') }}"><img class="center fit" src="{{asset($sharefrontpage->file)}}" alt="Bill Board" ></a> --}}
    <div class="main">
        <div class="banner">

            <img src="{{asset($sharefrontpage->file)}}" alt="">
        </div>
        <div class="enterwebsite">
            <h3><a href="{{ route('landing.front') }}" style="{{$sharefrontpage->linkcss}}">เข้าสู่เว็บไซต์</a> </h3>
        </div>
    </div>
   
</body>

</html>