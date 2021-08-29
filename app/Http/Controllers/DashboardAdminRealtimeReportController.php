<?php

namespace App\Http\Controllers;

use App\Model\ReportList;
use Illuminate\Http\Request;

class DashboardAdminRealtimeReportController extends Controller
{
    public function Index(){
        $reportlists = ReportList::get();
        return view('dashboard.admin.realtimereport.index')->withReportlists($reportlists);
    }

    public function Searchreport(Request $request){
        $reportlists = ReportList::where('reportname', 'like', '%' . $request->search . '%')->get();
        return response()->json($reportlists); 
    }
}
