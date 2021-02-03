<?php

namespace App\Http\Controllers;
use Excel;
use Input;
use App\User;
use App\Model\Grade;
use App\Model\FullTbp;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\ExcelFromView\Report\Project\ReportProjectExport;

class DashboardAdminRealtimeReportProjectController extends Controller
{
    public function Index(){
        $fulltbps = FullTbp::get();
        return view('dashboard.admin.realtimereport.project.index')->withFulltbps($fulltbps); 
    }
    public function DownloadExcel(Request $request){
        $startdate = DateConversion::thaiToEngDate($request->fromdate);
        $enddate = DateConversion::thaiToEngDate($request->todate);
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExport($startdate,$enddate), 'project.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereBetween('created_at', [$startdate, $enddate])->get();
            return view('dashboard.admin.realtimereport.project.index')->withFulltbps($fulltbps); 
        }
    }
    public function ByGrade(){
        $grades = Grade::get();
        $fulltbps = FullTbp::get();
        return view('dashboard.admin.realtimereport.project.bygrade')->withFulltbps($fulltbps)->withGrades($grades); 
    }
}
