<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardAdminRealtimeReportProjectController extends Controller
{
    public function Index(){
        return view('dashboard.admin.realtimereport.project.index');
    }
}
