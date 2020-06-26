@extends('layouts.login')
    @if( Session::has('error') )
        <div class="alert bg-warning text-white alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <span class="font-weight-semibold">{{ Session::get('error') }}</span>
        </div>
    @endif
@section('content')

    <div class="card mb-0">
        <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="text-center mb-0">
                    <i class="icon-lock icon-2x text-warning-400 border-warning-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                    {{-- <h5 class="mb-0">เข้าสู่ระบบ</h5> --}}
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="password" type="password" class="form-control" name="password" required>
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    {{-- <a href="login_password_recover.html" class="ml-auto">{{trans('lang.forgotpassword')}}</a> --}}
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{trans('lang.forgotpassword')}}
                    </a>
                @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">{{trans('lang.login')}} <i class="icon-circle-right2 ml-2"></i></button>
                </div>
                @if ($generalinfo->social_login_status == 2)
                    <div class="form-group text-center">
                        <a href="{{route('social.login',['provider' => 'facebook'])}}" class="btn btn-outline bg-indigo border-indigo text-indigo btn-icon rounded-round border-2"><i class="icon-facebook"></i></a>
                        <a href="{{route('social.login',['provider' => 'google'])}}" class="btn btn-outline bg-pink-300 border-pink-300 text-pink-300 btn-icon rounded-round border-2 ml-2"><i class="icon-google"></i></a>
                    </div>
                @endif
                <div class="form-group text-center text-muted content-divider">
                    <span class="px-2">{{trans('lang.noaccount')}}</span>
                </div>

                <div class="form-group">
                    <a href="{{ route('register') }}" class="btn btn-light btn-block">{{trans('lang.register')}}</a>
                </div>
            </form>
        </div>
    </div>
@endsection



