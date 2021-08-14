@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title" style="font-size:16px;font-weight: bold">เปลี่ยนรหัสผ่าน</h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf


                        <div id="pwd-container">

                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="input-group form-group form-group-feedback form-group-feedback-left">
                                {{-- <label>อีเมล:</label> --}}
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus readonly>
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="input-group form-group form-group-feedback form-group-feedback-left" >
                                {{-- <label>รหัสผ่าน:</label> --}}
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" title="ข้อแนะนำ: กรุณาใช้รหัสผ่านภาษาอังกฤษ ตัวเลข และอักขระพิเศษ รวมกันอย่างน้อย 8 ตัวอักษร" placeholder="รหัสผ่าน" autocomplete="new-password">
                                
                                <div class="form-control-feedback">
                                    <i class="icon-eye-blocked text-muted toggle_password"></i>
                                </div>
                                
                                @error('password')
                                    <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                                @enderror

                                {{-- <span id="password_input_error" class="form-text text-danger" hidden  ><i class="icon-cancel-circle2 text-danger"></i> กรุณากรอกรหัสผ่านภาษาอังกฤษ ตัวเลข และอักขระพิเศษ รวมกันอย่างน้อย 8 ตัวอักษร</span> --}}
                            </div>
            
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" title="ข้อแนะนำ: กรุณาใช้รหัสผ่านภาษาอังกฤษ ตัวเลข และอักขระพิเศษ รวมกันอย่างน้อย 8 ตัวอักษร" placeholder="ยืนยันรหัสผ่าน">
                                <div class="form-control-feedback ">
                                    <i class="icon-eye-blocked text-muted toggle_password"></i>
                                </div>
                                {{-- <div class="col-sm-12" style="padding-top: 5px;"> --}}
                                <div class="pwstrength_viewport_progress" style="padding-top: 10px;"></div>
                                {{-- </div> --}}
                            </div>
    
                        </div>
    


                        {{-- <div class="form-group form-group-feedback form-group-feedback-left">
                            <label>ยืนยันรหัสผ่าน:</label>
                            <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password">
                            <div class="form-control-feedback ">
                                <i class="icon-eye-blocked text-muted toggle_password"></i>
                            </div>
                        </div> --}}

                        <div class="d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn bg-blue ml-3">รีเซตรหัสผ่าน</button>
                        </div>
                    </form>
                </div>
            </div>
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
                $('#password-confirm').attr("type", "text");
            } else {
                $('.toggle_password').addClass("icon-eye-blocked");
                $('.toggle_password').removeClass("icon-eye");
                $('#password').attr("type", "password");
                $('#password-confirm').attr("type", "password");
            }
        });
</script>
@stop
{{--  --}}

@endsection


