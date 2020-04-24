<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardExpertController extends Controller
{
    public function Index(){
        return view('dashboard.expert.index');
    }
}
