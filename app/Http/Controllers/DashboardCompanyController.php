<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardCompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function Index(){
        return view('dashboard.company.index');
    }
}
