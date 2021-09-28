<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function Logout2(){
        // return 'ok';
        // CreateUserLog::createlog('ออกจากระบบ');
        Auth::logout();
        Session::flush();
        return redirect()->route('landing2.index');
    }
}
