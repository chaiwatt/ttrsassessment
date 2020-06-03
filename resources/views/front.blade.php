{{-- @extends('layouts.login')
    @section('content')
        <div class="card mb-0">
            <div class="card-body">
                    test
                    <div class="form-group">
                        <a href="{{ route('landing.splash') }}" class="btn btn-light btn-block">{{trans('lang.register')}}</a>
                    </div>
                </form>
            </div>
        </div>
    @endsection
 --}}


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
            margin: 20;
            background-color:#{{$sharefrontpage->bgcolor}};
        }
        .fit { /* set relative picture size */
            max-width: {{$sharefrontpage->percentimg}}%;
            max-height: {{$sharefrontpage->percentimg}}%;
        }
        .center {
            display: block;
            margin: auto;
        }
    </style>
</head>
<body >
    
    <img class="center fit" src="{{asset($sharefrontpage->file)}}" alt="Front Image" class="center">
    <br>
    <a href="{{ route('landing.front') }}"><img class="center" src="{{asset($sharefrontpage->entersitebtn)}}" style="max-width: 12%;max-height: 12%" alt="Paris" class="center"></a>
   
</body>
</html>