<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
     protected $redirectTo = 'dashboard/company/report'; // RouteServiceProvider::HOME;

    // protected function redirectTo()
    // {
    //     Auth::logout();
    //     Session::flush();
    //     return redirect()->route('login')->withSuccess('รีเซตรหัสผ่านสำเร็จ กรุณาเข้าสู่ระบบ');
    // }

    protected function resetPassword($user, $password)
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login')->withSuccess('รีเซตรหัสผ่านสำเร็จ กรุณาเข้าสู่ระบบ');
    }
}
