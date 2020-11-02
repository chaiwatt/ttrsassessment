<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{

    use SendsPasswordResetEmails;

    protected function sendResetLinkResponse($response)
    {
        return redirect()->route('login')->withSuccess('โปรดตรวจสอบอีเมลเพื่อรีเซตรหัสผ่านใหม่');
    }
}
