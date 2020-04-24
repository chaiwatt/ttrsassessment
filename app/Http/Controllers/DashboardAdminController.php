<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function Index(){
        return view('dashboard.admin.index');
    }
}
