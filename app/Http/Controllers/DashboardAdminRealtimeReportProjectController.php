<?php

namespace App\Http\Controllers;
use Excel;
use Input;
use App\User;
use Carbon\Carbon;
use App\Model\Grade;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use App\Model\DownloadStat;
use App\Model\ProjectGrade;
use App\Model\IndustryGroup;
use App\Model\ProjectBudget;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\EvaluationMonth;
use App\Model\FullTbpInvestment;
use App\Model\RegisteredCapitalType;
use App\ExcelFromView\Report\Project\ReportProjectExport;
use App\ExcelFromView\Report\Project\ReportProjectExportByYear;
use App\ExcelFromView\Report\Project\ReportProjectExportByGrade;
use App\ExcelFromView\Report\Project\ReportProjectExportDocDownload;
use App\ExcelFromView\Report\Project\ReportProjectExportByRegCapital;
use App\ExcelFromView\Report\Project\ReportProjectExportByYearBudget;
use App\ExcelFromView\Report\Project\ReportProjectExportCancelByYear;
use App\ExcelFromView\Report\Project\ReportProjectExportCancelByMonth;
use App\ExcelFromView\Report\Project\ReportProjectExportFullTbpByYear;
use App\ExcelFromView\Report\Project\ReportProjectExportMiniTbpByYear;
use App\ExcelFromView\Report\Project\ReportProjectExportByBusinessType;
use App\ExcelFromView\Report\Project\ReportProjectExportFinishedByYear;
use App\ExcelFromView\Report\Project\ReportProjectExportFullTbpByMonth;
use App\ExcelFromView\Report\Project\ReportProjectExportMiniTbpByMonth;
use App\ExcelFromView\Report\Project\ReportProjectExportByIndustryGroup;
use App\ExcelFromView\Report\Project\ReportProjectExportFinishedByMonth;
use App\ExcelFromView\Report\Project\ReportProjectExportCancelByYearBudget;
use App\ExcelFromView\Report\Project\ReportProjectExportFullTbpByYearBudget;
use App\ExcelFromView\Report\Project\ReportProjectExportMiniTbpByYearBudget;
use App\ExcelFromView\Report\Project\ReportProjectExportFinishedByYearBudget;

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
    public function minitbpbymonth(Request $request){
        $minitbparray = MiniTBP::whereMonth('submitdate','01')->whereYear('created_at',Carbon::now()->year)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        $months = EvaluationMonth::get();
        return view('dashboard.admin.realtimereport.project.minitbpbymonth')->withMonths($months)->withYears($years)->withFulltbps($fulltbps);
    }

    public function getminitbpbymonth(Request $request){
        $month = str_pad($request->month, 2, '0', STR_PAD_LEFT);
        $year = $request->year;
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        $months = EvaluationMonth::get();
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportMiniTbpByMonth($year,$month), 'minitbpbymonth.xlsx');
        }else if($request->btnsubmit == 'search'){
            $minitbparray = MiniTBP::whereMonth('submitdate',$month)->whereYear('submitdate',$year)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
            return view('dashboard.admin.realtimereport.project.minitbpbymonth')->withMonths($months)->withYears($years)->withFulltbps($fulltbps); 
        }
    }

    public function fulltbpbymonth(Request $request){
        $fulltbps = FullTbp::whereMonth('submitdate','01')->whereYear('created_at',Carbon::now()->year)->get();
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        $months = EvaluationMonth::get();
        return view('dashboard.admin.realtimereport.project.fulltbpbymonth')->withMonths($months)->withYears($years)->withFulltbps($fulltbps);
    }

    public function getfulltbpbymonth(Request $request){
        $month = str_pad($request->month, 2, '0', STR_PAD_LEFT);
        $year = $request->year;
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        $months = EvaluationMonth::get();
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportFullTbpByMonth($year,$month), 'fulltbpbymonth.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereMonth('submitdate',$month)->whereYear('submitdate',$year)->get();
            return view('dashboard.admin.realtimereport.project.fulltbpbymonth')->withMonths($months)->withYears($years)->withFulltbps($fulltbps); 
        }
    }

    public function finishedbymonth(Request $request){
        $fulltbps = FullTbp::whereMonth('submitdate','01')->whereYear('created_at',Carbon::now()->year)->whereNotNull('finishdate')->get();
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        $months = EvaluationMonth::get();
        return view('dashboard.admin.realtimereport.project.finishedbymonth')->withMonths($months)->withYears($years)->withFulltbps($fulltbps);
    }
    public function getfinishedbymonth(Request $request){
        $month = str_pad($request->month, 2, '0', STR_PAD_LEFT);
        $year = $request->year;
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        $months = EvaluationMonth::get();
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportFinishedByMonth($year,$month), 'finishedbymonth.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereMonth('submitdate',$month)->whereYear('submitdate',$year)->whereNotNull('finishdate')->get();
            return view('dashboard.admin.realtimereport.project.finishedbymonth')->withMonths($months)->withYears($years)->withFulltbps($fulltbps); 
        }
    }
    public function canceledbymonth(Request $request){
        $fulltbps = FullTbp::whereMonth('submitdate','01')->whereYear('created_at',Carbon::now()->year)->whereNotNull('canceldate')->get();
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        $months = EvaluationMonth::get();
        return view('dashboard.admin.realtimereport.project.canceledbymonth')->withMonths($months)->withYears($years)->withFulltbps($fulltbps);
    }
    public function getcanceledbymonth(Request $request){
        $month = str_pad($request->month, 2, '0', STR_PAD_LEFT);
        $year = $request->year;
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        $months = EvaluationMonth::get();
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportCancelByMonth($year,$month), 'canceledbymonth.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereMonth('submitdate',$month)->whereYear('submitdate',$year)->whereNotNull('canceldate')->get();
            return view('dashboard.admin.realtimereport.project.canceledbymonth')->withMonths($months)->withYears($years)->withFulltbps($fulltbps); 
        }
    }

    public function minitbpbyyear(Request $request){
        
        $minitbparray = MiniTBP::whereYear('created_at',Carbon::now()->year)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        return view('dashboard.admin.realtimereport.project.minitbpbyyear')->withYears($years)->withFulltbps($fulltbps);
    }

    public function getminitbpbyyear(Request $request){
        $year = $request->year;
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportMiniTbpByYear($year), 'minitbpbyyear.xlsx');
        }else if($request->btnsubmit == 'search'){
            $minitbparray = MiniTBP::whereYear('submitdate',$year)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
            return view('dashboard.admin.realtimereport.project.minitbpbyyear')->withYears($years)->withFulltbps($fulltbps); 
        }
    }

    public function fulltbpbyyear(Request $request){
        $fulltbps = FullTbp::whereYear('created_at',Carbon::now()->year)->get();
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        $months = EvaluationMonth::get();
        return view('dashboard.admin.realtimereport.project.fulltbpbyyear')->withYears($years)->withFulltbps($fulltbps);
    }

    public function getfulltbpbyyear(Request $request){
        $year = $request->year;
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportFullTbpByYear($year), 'fulltbpbyyear.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereYear('submitdate',$year)->get();
            return view('dashboard.admin.realtimereport.project.fulltbpbyyear')->withYears($years)->withFulltbps($fulltbps); 
        }
    }

    public function finishedbyyear(Request $request){
        $fulltbps = FullTbp::whereYear('created_at',Carbon::now()->year)->whereNotNull('finishdate')->get();
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        return view('dashboard.admin.realtimereport.project.finishedbyyear')->withYears($years)->withFulltbps($fulltbps);
    }
    public function getfinishedbyyear(Request $request){
        $year = $request->year;
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportFinishedByYear($year), 'finishedbyyear.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereYear('submitdate',$year)->whereNotNull('finishdate')->get();
            return view('dashboard.admin.realtimereport.project.finishedbyyear')->withYears($years)->withFulltbps($fulltbps); 
        }
    }

    public function canceledbyyear(Request $request){
        $fulltbps = FullTbp::whereYear('created_at',Carbon::now()->year)->whereNotNull('canceldate')->get();
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        return view('dashboard.admin.realtimereport.project.canceledbyyear')->withYears($years)->withFulltbps($fulltbps);
    }
    public function getcanceledbyyear(Request $request){
        $year = $request->year;
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        $months = EvaluationMonth::get();
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportCancelByYear($year), 'cancelbyyear.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereYear('submitdate',$year)->whereNotNull('canceldate')->get();
            return view('dashboard.admin.realtimereport.project.canceledbyyear')->withMonths($months)->withYears($years)->withFulltbps($fulltbps); 
        }
    }

    public function minitbpbyyearbudget(Request $request){
        $_startdate = (Carbon::now()->year-1) . '-10-1';
        $_enddate = (Carbon::now()->year) . '-9-30';
        $startdate = Carbon::createFromFormat('Y-m-d', $_startdate)->subDay(1);
        $enddate = Carbon::createFromFormat('Y-m-d', $_enddate)->addDays(1);
        $minitbparray = MiniTbp::whereBetween('submitdate',[$startdate, $enddate])->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        return view('dashboard.admin.realtimereport.project.minitbpbyyearbudget')->withYears($years)->withFulltbps($fulltbps);
    }

    public function getminitbpbyyearbudget(Request $request){
        $year = intVal($request->year) - 543;
        $_startdate = ($year-1) . '-10-1';
        $_enddate = ($year) . '-9-30';
        $startdate = Carbon::createFromFormat('Y-m-d', $_startdate)->subDay(1);
        $enddate = Carbon::createFromFormat('Y-m-d', $_enddate)->addDays(1);

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportMiniTbpByYearBudget($startdate,$enddate,$year), 'minitbpbyyearbudget.xlsx');
        }else if($request->btnsubmit == 'search'){
            $minitbparray = MiniTbp::whereBetween('submitdate',[$startdate, $enddate])->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
            $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
            return view('dashboard.admin.realtimereport.project.minitbpbyyearbudget')->withYears($years)->withFulltbps($fulltbps);
        }
    }

    public function fulltbpbyyearbudget(Request $request){
        $_startdate = (Carbon::now()->year-1) . '-10-1';
        $_enddate = (Carbon::now()->year) . '-9-30';
        $startdate = Carbon::createFromFormat('Y-m-d', $_startdate)->subDay(1);
        $enddate = Carbon::createFromFormat('Y-m-d', $_enddate)->addDays(1);
        $fulltbps = FullTbp::whereBetween('submitdate',[$startdate, $enddate])->get();
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        return view('dashboard.admin.realtimereport.project.fulltbpbyyearbudget')->withYears($years)->withFulltbps($fulltbps);
    }

    public function getfulltbpbyyearbudget(Request $request){
        $year = intVal($request->year) - 543;
        $_startdate = ($year-1) . '-10-1';
        $_enddate = ($year) . '-9-30';
        $startdate = Carbon::createFromFormat('Y-m-d', $_startdate)->subDay(1);
        $enddate = Carbon::createFromFormat('Y-m-d', $_enddate)->addDays(1);

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportFullTbpByYearBudget($startdate,$enddate,$year), 'fulltbpbyyearbudget.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereBetween('submitdate',[$startdate, $enddate])->get();
            $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
            return view('dashboard.admin.realtimereport.project.fulltbpbyyearbudget')->withYears($years)->withFulltbps($fulltbps);
        }
    }

    public function finishedbyyearbudget(Request $request){
        $_startdate = (Carbon::now()->year-1) . '-10-1';
        $_enddate = (Carbon::now()->year) . '-9-30';
        $startdate = Carbon::createFromFormat('Y-m-d', $_startdate)->subDay(1);
        $enddate = Carbon::createFromFormat('Y-m-d', $_enddate)->addDays(1);

        $fulltbps = FullTbp::whereBetween('submitdate',[$startdate, $enddate])->whereNotNull('finishdate')->get();

        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        return view('dashboard.admin.realtimereport.project.finishedbyyearbudget')->withYears($years)->withFulltbps($fulltbps);
    }
    public function getfinishedbyyearbudget(Request $request){
        $year = intVal($request->year) - 543;
        $_startdate = (Carbon::now()->year-1) . '-10-1';
        $_enddate = (Carbon::now()->year) . '-9-30';
        $startdate = Carbon::createFromFormat('Y-m-d', $_startdate)->subDay(1);
        $enddate = Carbon::createFromFormat('Y-m-d', $_enddate)->addDays(1);

        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportFinishedByYearBudget($startdate,$enddate,$year), 'finishedbyyearbudget.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereBetween('submitdate',[$startdate, $enddate])->whereNotNull('finishdate')->get();
            return view('dashboard.admin.realtimereport.project.finishedbyyearbudget')->withYears($years)->withFulltbps($fulltbps); 
        }
    }

    public function canceledbyyearbudget(Request $request){
        $_startdate = (Carbon::now()->year-1) . '-10-1';
        $_enddate = (Carbon::now()->year) . '-9-30';
        $startdate = Carbon::createFromFormat('Y-m-d', $_startdate)->subDay(1);
        $enddate = Carbon::createFromFormat('Y-m-d', $_enddate)->addDays(1);
        $fulltbps = FullTbp::whereBetween('submitdate',[$startdate, $enddate])->whereNotNull('canceldate')->get();
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        return view('dashboard.admin.realtimereport.project.canceledbyyearbudget')->withYears($years)->withFulltbps($fulltbps);
    }
    public function getcanceledbyyearbudget(Request $request){
        $year = intVal($request->year) - 543;
        $_startdate = (Carbon::now()->year-1) . '-10-1';
        $_enddate = (Carbon::now()->year) . '-9-30';
        $startdate = Carbon::createFromFormat('Y-m-d', $_startdate)->subDay(1);
        $enddate = Carbon::createFromFormat('Y-m-d', $_enddate)->addDays(1);

        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportCancelByYearBudget($startdate,$enddate,$year), 'canceledbyyearbudget.xlsx');
        }else if($request->btnsubmit == 'search'){
           
            $fulltbps = FullTbp::whereBetween('submitdate',[$startdate, $enddate])->whereNotNull('canceldate')->get();
            return view('dashboard.admin.realtimereport.project.canceledbyyearbudget')->withYears($years)->withFulltbps($fulltbps); 
        }
    }
    public function allbyyear(Request $request){
        $fulltbps = FullTbp::whereYear('created_at',Carbon::now()->year)->get();
        return view('dashboard.admin.realtimereport.project.allbyyear')->withFulltbps($fulltbps);
    }
    public function getallbyyear(Request $request){
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByYear(), 'allbyyear.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereYear('submitdate',$year)->get();
            return view('dashboard.admin.realtimereport.project.allbyyear')->withFulltbps($fulltbps); 
        }
    }
    public function allbyyearbudget(Request $request){
        $fulltbps = FullTbp::whereYear('created_at',Carbon::now()->year)->get();
        return view('dashboard.admin.realtimereport.project.allbyyearbudget')->withFulltbps($fulltbps);
    }
    public function getallbyyearbudget(Request $request){
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByYearBudget(), 'allbyyearbudget.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereYear('submitdate',$year)->get();
            return view('dashboard.admin.realtimereport.project.allbyyearbudget')->withFulltbps($fulltbps); 
        }
    }
    public function projectbycapital(Request $request){
        $projectbudgets = ProjectBudget::get();
        $fulltbpinvestmentarr = FullTbpInvestment::distinct('full_tbp_id')->pluck('full_tbp_id')->toArray();
        $arr = array();
        foreach ($fulltbpinvestmentarr as $key => $item) {
            $check = FullTbpInvestment::where('full_tbp_id',$item)->sum('cost');
            if($check < $projectbudgets[0]->budget){
                array_push($arr,$item);
            }
        }
        $fulltbps = FullTbp::whereIn('id',$arr)->get();
        return view('dashboard.admin.realtimereport.project.projectbycapital')->withProjectbudgets($projectbudgets)->withFulltbps($fulltbps);
    }
    public function getprojectbycapital(Request $request){
        $projectbudgets = ProjectBudget::get();
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByYearBudget(), 'allbyyearbudget.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereYear('submitdate',$year)->get();
            return view('dashboard.admin.realtimereport.project.projectbycapital')->withProjectbudgets($projectbudgets)->withFulltbps($fulltbps); 
        }
    }
}
