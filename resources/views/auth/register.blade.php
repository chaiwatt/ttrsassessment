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
                <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="text-center mb-0">
                    <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                    {{-- <h5 class="mb-0">เข้าสู่ระบบ</h5> --}}
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">                    
                    <select id="usergroup" name="usergroup" data-placeholder="ประเภท" class="form-control form-control-select2">
                        @foreach ($usergroups as $usergroup)
                            <option value="{{$usergroup->id}}" >{{$usergroup->name}}</option> 
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="vatwrapper" hidden>
                    <input id="vatno" type="number" max ="13" class="form-control @error('vatno') is-invalid @enderror" name="vatno" value="{{ old('vatno') }}" required placeholder="เลขประจำตัวผู้เสียภาษีนิติบุคคล" autofocus>
                    <label id="vatnomessage" class="validation-invalid-label" hidden><small id="msg"></small></label>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="ชื่อ" autofocus>
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>             

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="อีเมล์">
                    <div class="form-control-feedback">
                        <i class="icon-mention text-muted"></i>
                    </div>
                    @error('email')
                        <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required placeholder="เบอร์มือถือ">
                    <div class="form-control-feedback">
                        <i class="icon-phone2 text-muted"></i>
                    </div>
                    @error('phone')
                        <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="รหัสผ่าน">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                    @error('password')
                        <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="ยืนยันรหัสผ่าน">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">ลงทะเบียน <i class="icon-circle-right2 ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
    @section('pageScript')
    <script type="module" src="{{asset('assets/dashboard/js/app/helper/registerhelper.js')}}"></script>
        <script>
                var route = {
                url: "{{ url('/') }}",
                token: $('meta[name="csrf-token"]').attr('content'),
            };
        </script>	
    @stop

@endsection




