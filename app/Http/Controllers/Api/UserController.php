<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function UpdateVerifyExpert(Request $request){
        User::find($request->userid)->update([
            'verify_expert' => $request->status
        ]);
    }
}
