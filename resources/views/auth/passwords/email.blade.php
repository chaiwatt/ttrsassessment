@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title" style="font-size:16px;font-weight: bold">ขอรีเซตรหัสผ่านใหม่</h6>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('กรอกอีเมลที่ลงทะเบียน') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>
                                        @if ($message == 'passwords.user')
                                                {{ __('ไม่พบอีเมลนี้ในระบบ') }}
                                            @else
                                                {{ $message }}
                                        @endif
                                        </strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn bg-blue ml-3">ส่ง</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
