<?php

namespace App\Http\Controllers;

use App\Model\ReportList;
use App\Model\ReportType;
use Illuminate\Http\Request;

class DashboardAdminRealtimeReportController extends Controller
{
    public function Index(){
        $reporttypes = ReportType::get();
        $reportlists = ReportList::get();
        return view('dashboard.admin.realtimereport.index')->withReportlists($reportlists)->withReporttypes($reporttypes);
    }

    public function Searchreport(Request $request){
        $reportlists = ReportList::where('reportname', 'like', '%' . $request->search . '%')
                ->orWhere('groupname', 'like', '%' . $request->search . '%')->get();
        $reporttypes = ReportType::get();

        return response()->json(array(
            "reportlists" => $reportlists,
            "reporttypes" => $reporttypes
        ));
    }
}
