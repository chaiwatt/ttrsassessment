<?php

namespace App\Http\Controllers\Api;

use App\Model\GeneralInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ToggleBarController extends Controller
{
    public function Save(Request $request){
        GeneralInfo::first()->update([
            'togglebar' => $request->status
        ]);
    }
}
