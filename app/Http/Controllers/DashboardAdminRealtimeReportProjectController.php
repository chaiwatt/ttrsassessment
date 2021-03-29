<?php

namespace App\Http\Controllers;
use Excel;
use Input;
use App\User;
use App\Model\Grade;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use App\Model\DownloadStat;
use App\Model\ProjectGrade;
use App\Model\IndustryGroup;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\RegisteredCapitalType;
use App\ExcelFromView\Report\Project\ReportProjectExport;
use App\ExcelFromView\Report\Project\ReportProjectExportByGrade;
use App\ExcelFromView\Report\Project\ReportProjectExportDocDownload;
use App\ExcelFromView\Report\Project\ReportProjectExportByRegCapital;
use App\ExcelFromView\Report\Project\ReportProjectExportByBusinessType;
use App\ExcelFromView\Report\Project\ReportProjectExportByIndustryGroup;

class DashboardAdminRealtimeReportProjectController extends Controller
{
    public function Index(){
        $fulltbps = FullTbp::get();
        return view('dashboard.admin.realtimereport.project.index')->withFulltbps($fulltbps); 
    }
    public function GetProject(Request $request){
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
    public function GetProjectByGrade(Request $request){
        $grades = Grade::get();
        $grade = Grade::find($request->grade)->name;
        $startdate = DateConversion::thaiToEngDate($request->fromdate);
        $enddate = DateConversion::thaiToEngDate($request->todate);
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByGrade($startdate,$enddate,$grade), 'project.xlsx');
        }else if($request->btnsubmit == 'search'){
            $projectgrades = ProjectGrade::where('grade',$grade)->pluck('full_tbp_id')->toArray();
            $fulltbps = FullTbp::whereIn('id', $projectgrades)->whereBetween('created_at', [$startdate, $enddate])->get();
            return view('dashboard.admin.realtimereport.project.bygrade')->withFulltbps($fulltbps)->withGrades($grades); 
        }
    }
    public function ByIndustryGroup(){
        $industrygroups = IndustryGroup::get();
        $fulltbps = FullTbp::get();
        return view('dashboard.admin.realtimereport.project.byindustrygroup')->withFulltbps($fulltbps)->withIndustrygroups($industrygroups); 
    }
    public function ByBusinessType(){
        $businesstypes = BusinessType::get();
        $fulltbps = FullTbp::get();
        return view('dashboard.admin.realtimereport.project.bybusinesstype')->withFulltbps($fulltbps)->withBusinesstypes($businesstypes); 
    }
    
    public function ByRegCapital(){
        $registeredcapitaltypes = RegisteredCapitalType::get();
        $fulltbps = FullTbp::get();
        return view('dashboard.admin.realtimereport.project.byregcapital')->withFulltbps($fulltbps)->withRegisteredcapitaltypes($registeredcapitaltypes); 
    }
    public function GetProjectByIndustrygroup(Request $request){
        $industrygroups = IndustryGroup::get();
        $startdate = DateConversion::thaiToEngDate($request->fromdate);
        $enddate = DateConversion::thaiToEngDate($request->todate);
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByIndustryGroup($startdate,$enddate,$request->industrygroup), 'project.xlsx');
        }else if($request->btnsubmit == 'search'){
            $companies = Company::where('industry_group_id',$request->industrygroup)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->whereBetween('created_at', [$startdate, $enddate])->get();
            return view('dashboard.admin.realtimereport.project.byindustrygroup')->withFulltbps($fulltbps)->withIndustrygroups($industrygroups); 
        }
    }
    public function GetProjectByBusinessType(Request $request){
        $businesstypes = BusinessType::get();
        $startdate = DateConversion::thaiToEngDate($request->fromdate);
        $enddate = DateConversion::thaiToEngDate($request->todate);
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByBusinessType($startdate,$enddate,$request->businesstype), 'project.xlsx');
        }else if($request->btnsubmit == 'search'){
            $companies = Company::where('business_type_id',$request->businesstype)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->whereBetween('created_at', [$startdate, $enddate])->get();
            return view('dashboard.admin.realtimereport.project.bybusinesstype')->withFulltbps($fulltbps)->withBusinesstypes($businesstypes); 
        }
    }
    public function GetProjectByRegCapital(Request $request){
       
        $registeredcapitaltypes = RegisteredCapitalType::get();
        $startdate = DateConversion::thaiToEngDate($request->fromdate);
        $enddate = DateConversion::thaiToEngDate($request->todate);
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByRegCapital($startdate,$enddate,$request->regcapital), 'project.xlsx');
        }else if($request->btnsubmit == 'search'){
            $companies = Company::where('registeredcapitaltype',$request->regcapital)->pluck('id')->toArray();
            
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->whereBetween('created_at', [$startdate, $enddate])->get();
            return view('dashboard.admin.realtimereport.project.byregcapital')->withFulltbps($fulltbps)->withRegisteredcapitaltypes($registeredcapitaltypes); 
        }
    }
    public function DocDownload(){
        $downloadstats = DownloadStat::get();
        return view('dashboard.admin.realtimereport.project.docdownload')->withDownloadstats($downloadstats); 
    }
    public function GetDocDownload(Request $request){
        
        $startdate = DateConversion::thaiToEngDate($request->fromdate);
        $enddate = DateConversion::thaiToEngDate($request->todate);
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportDocDownload($startdate,$enddate), 'docdownload.xlsx');
        }else if($request->btnsubmit == 'search'){
            $downloadstats = DownloadStat::whereBetween('created_at', [$startdate, $enddate])->get();
            return view('dashboard.admin.realtimereport.project.docdownload')->withDownloadstats($downloadstats); 
        }
    }
}
