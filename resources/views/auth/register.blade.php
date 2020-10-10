@extends('layouts.login')
    @if( Session::has('error') )
        <div class="alert bg-warning text-white alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <span class="font-weight-semibold">{{ Session::get('error') }}</span>
        </div>
    @endif
@section('content')
    <div id="modal_term" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header pb-3">
                    <h5 class="modal-title">นโยบายและข้อกำหนด</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body py-0">
                    {!!$generalinfo->consent!!}
                </div>
                <div class="modal-footer pt-3">
                    <button type="button" class="btn btn-link" data-dismiss="modal">ปิด</button>
                    <button type="button" id="btnaccept" class="btn bg-primary" data-dismiss="modal" disabled>ยอมรับ</button>
                </div>
            </div>
        </div>
    </div>
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

                <div class="form-group" id="vatwrapper" >
                    <input id="vatno" type="number" class="form-control @error('vatno') is-invalid @enderror" name="vatno" value="{{ old('vatno') }}" placeholder="เลขประจำตัวผู้เสียภาษีนิติบุคคล" >
                    <label id="vatnomessage" class="validation-invalid-label" hidden><small id="msg"></small></label>
                    <input type="text" name="companyname" id="companyname" hidden>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  placeholder="ชื่อ" autofocus>
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>             

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="อีเมล">
                    <div class="form-control-feedback">
                        <i class="icon-mention text-muted"></i>
                    </div>
                    @error('email')
                        <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  placeholder="เบอร์มือถือ">
                    <div class="form-control-feedback">
                        <i class="icon-phone2 text-muted"></i>
                    </div>
                    @error('phone')
                        <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="รหัสผ่าน">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                    @error('password')
                        <span class="form-text text-danger"><i class="icon-cancel-circle2 mr-2"></i>{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="ยืนยันรหัสผ่าน">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <a href="#" data-toggle="modal" data-target="#modal_term" class="text-primary"><u>ยอมรับนโยบายและข้อกำหนด</u></a>  
                </div>
                <div class="form-group">
                    <button type="submit" id="term" class="btn btn-primary btn-block" disabled>ลงทะเบียน <i class="icon-circle-right2 ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
    @section('pageScript')
    <script src="{{asset('assets/dashboard/js/plugins/forms/styling/switchery.min.js')}}"></script>
        <script src="{{asset('assets/dashboard/js/plugins/forms/styling/switch.min.js')}}"></script>
        <script src="{{asset('assets/dashboard/js/demo_pages/form_checkboxes_radios.js')}}"></script>
        <script type="module" src="{{asset('assets/dashboard/js/app/helper/registerhelper.js')}}"></script>
        <script>
                var route = {
                url: "{{ url('/') }}",
                token: $('meta[name="csrf-token"]').attr('content'),
            };
        </script>	
    @stop

@endsection




