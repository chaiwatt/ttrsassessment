@extends('layouts.idle')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('เราได้ส่งอีเมล์ยืนยันใหม่แล้ว') }}
                    </div>
                @endif

                {{ __('กรุณายืนยันการใช้งานผ่านอีเมล์เดรสเดรส ') }}
                {{ __('ถ้าคุณไม่ได้รับอีเมล์') }},
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('กรุณาคลิกเพื่อขอรับการยืนยันใหม่') }}</button>.
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
