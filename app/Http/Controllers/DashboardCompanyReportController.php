<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardCompanyReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function Index(){
        return view('dashboard.company.report.index');
    }
}
