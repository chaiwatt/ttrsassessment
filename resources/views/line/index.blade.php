@extends('layouts.idle')
    @section('content')
        <div class="text-center mb-2">
            <h5 class="mb-2">ขอบคุณที่ลงทะเบียน</h5>
            <span class="d-block text-muted">โปรดยืนยันตัวตนด้วยแอพลิเคชั่นไลน์ เพื่อเริ่มต้นใช้งานระบบ</span>
            <div class="form-group">
                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(240)->generate(url('').'/line/linesubscribe/'.Auth::user()->id)) !!} ">
            </div>
            <a href="{{route('line.subcribe',['id'=> Auth::user()->id])}}" class="btn bg-blue btn-block">หรือคลิกลิงก์</a>.
        </div>    
    @endsection


