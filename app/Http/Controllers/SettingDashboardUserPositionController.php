<?php

namespace App\Http\Controllers;

use App\Model\UserPosition;
use Illuminate\Http\Request;

class SettingDashboardUserPositionController extends Controller
{
    public function Index(){
        return UserPosition::get();
    }
}
