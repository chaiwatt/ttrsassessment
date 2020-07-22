<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardAdminReportController extends Controller
{
    public function Index(){
        return view('dashboard.admin.report.index');
    }
}
