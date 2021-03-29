<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            padding: 0;
            background-color:#{{$sharefrontpage->bgcolor}};
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
        }
    </style>
</head>
<body >
    <a href="{{ route('landing.front') }}"><img class="center fit" src="{{asset($sharefrontpage->file)}}" alt="Bill Board" ></a>
    
     {{-- <br>
    <a href="{{ route('landing.front') }}"><img class="center" src="{{asset($sharefrontpage->entersitebtn)}}" style="max-width: 12%;max-height: 12%" alt="Paris" class="center"></a>  --}}
   
</body>
</html>