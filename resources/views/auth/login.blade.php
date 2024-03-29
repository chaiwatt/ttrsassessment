@extends('layouts.login')
@section('content')
<div class="login-form wmin-xl-400">
    @if (Session::has('success'))
        <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            {{ Session::get('success') }}
        </div>
    @elseif( Session::has('error') )
        <div class="alert alert-warning alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            {{ Session::get('error') }}
        </div>
    @endif
    @if ($errors->has('email'))
        <div class="alert alert-warning alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            อีเมลหรือรหัสผ่านไม่ถูกต้อง
        </div>
    @endif
    <div class="text-center mb-2">
        <a href="{{url('')}}"><img  src="{{asset('assets/dashboard/images/headerlogowhite.png')}}" alt=""></a> 
    </div>
    <div class="card mb-0">
        <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                @csrf

               
                <div class="text-center mb-3 mb-md-2" style="font-size:40px;margin-top:-10px">
                    
                    เข้าสู่ระบบ
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="email" type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="password" type="password" class="form-control form-control-lg" name="password" required>
                    <div class="form-control-feedback">
                        <i class="icon-eye-blocked text-muted toggle_password"></i>
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    {{-- <a href="login_password_recover.html" class="ml-auto">{{trans('lang.forgotpassword')}}</a> --}}
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        <span style="font-size: 18px">  {{trans('lang.forgotpassword')}}</span>
                    </a>
                @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"><span style="font-size: 18px">{{trans('lang.login')}}</span> <i class="icon-circle-right2 ml-2"></i></button>
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
                    <a href="{{ route('register') }}" class="btn btn-light btn-block"><span style="font-size: 18px">{{trans('lang.register')}}</span></a>
                </div>
            </form>
        </div>
    </div>
</div>
@section('pageScript')
<script>
    $(".toggle_password").click(function() {
             var check = $('#password').attr("type");
             if (check == "password") {
                 $('.toggle_password').removeClass("icon-eye-blocked");
                 $('.toggle_password').addClass("icon-eye");
                 $('#password').attr("type", "text");
             } else {
                 $('.toggle_password').addClass("icon-eye-blocked");
                 $('.toggle_password').removeClass("icon-eye");
                 $('#password').attr("type", "password");
             }
         });

         $(document).on('keyup', '#password', function(e) {
                this.selectionStart = this.selectionEnd = this.value.length;
                var patt = /[ก-๙]/g;
                var res = patt.test($(this).val());
                if(res == true &&  $(this).val() != ''){
                   $(this).val().substring(0, $(this).val().length - 1);
                   $(this).val(($(this).val().substring(0, $(this).val().length - 1)));
                }
            });
</script>
@stop
{{--  --}}

@endsection





