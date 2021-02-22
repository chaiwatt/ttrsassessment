@extends('layouts.idle')
    @section('content')
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
        <div class="text-center mb-2">
            {{-- {{$otp}} --}}
            <h5 class="mb-2">กรุณายืนยันตัวตน</h5>
            <span class="d-block text-muted mb-2">กรุณากรอกรหัส OTP ที่ได้รับทางโทรศัพท์</span>
            <form method="POST" action="{{ route('sms.verify') }}">
                @csrf
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="number" class="form-control form-control-lg" name="otp" value="{{ old('otp') }}" required placeholder="รหัส otp">
                    <div class="form-control-feedback">
                        <i class="icon-mobile3 text-muted"></i>
                    </div>
                </div>
    
                <button type="submit" class="btn bg-blue btn-block">ยืนยัน OTP</button>.
            </form>
            @if( Session::has('error') )
            @php
                $otp = rand (1000 , 9999);
                Session::put('otp', $otp);
            @endphp
                <a href="{{route('sms')}}" class="btn bg-warning btn-block">รับ OTP ใหม่</a>.
            @endif
        </div>    
    @endsection


