<?php

namespace App\Http\Controllers;
use Excel;
use Input;
use App\User;
use Carbon\Carbon;
use App\Model\Isic;
use App\Model\Grade;
use App\Model\Sector;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\Province;
use App\Model\Companysize;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use App\Model\DownloadStat;
use App\Model\ProjectGrade;
use App\Model\IndustryGroup;
use App\Model\ProjectBudget;
use App\Model\ProjectMember;
use App\Model\ProjectStatus;
use Illuminate\Http\Request;
use App\Model\CompanyAddress;
use App\Helper\DateConversion;
use App\Model\EvaluationMonth;
use App\Model\ExpertAssignment;
use App\Model\FullTbpInvestment;
use App\Model\ProjectAssignment;
use App\Model\BusinessPlanStatus;
use App\Model\RegisteredCapitalType;
use App\Model\ProjectStatusTransaction;
use App\ExcelFromView\Report\Project\ReportProjectExport;
use App\ExcelFromView\Report\Project\ReportProjectExportByIsic;
use App\ExcelFromView\Report\Project\ReportProjectExportByYear;
use App\ExcelFromView\Report\Project\ReportProjectExportByGrade;
use App\ExcelFromView\Report\Project\ReportProjectExportByScore;
use App\ExcelFromView\Report\Project\ReportProjectExportByBudget;
use App\ExcelFromView\Report\Project\ReportProjectExportByExpert;
use App\ExcelFromView\Report\Project\ReportProjectExportByLeader;
use App\ExcelFromView\Report\Project\ReportProjectExportBySector;
use App\ExcelFromView\Report\Project\ReportProjectExportByProvince;
use App\ExcelFromView\Report\Project\ReportProjectExportByObjective;
use App\ExcelFromView\Report\Project\ReportProjectExportDocDownload;
use App\ExcelFromView\Report\Project\ReportProjectExportByProjectAll;
use App\ExcelFromView\Report\Project\ReportProjectExportByRegCapital;
use App\ExcelFromView\Report\Project\ReportProjectExportByYearBudget;
use App\ExcelFromView\Report\Project\ReportProjectExportCancelByYear;
use App\ExcelFromView\Report\Project\ReportProjectExportByCertificate;
use App\ExcelFromView\Report\Project\ReportProjectExportCancelByMonth;
use App\ExcelFromView\Report\Project\ReportProjectExportFullTbpByYear;
use App\ExcelFromView\Report\Project\ReportProjectExportMiniTbpByYear;
use App\ExcelFromView\Report\Project\ReportProjectExportByBusinessSize;
use App\ExcelFromView\Report\Project\ReportProjectExportByBusinessType;
use App\ExcelFromView\Report\Project\ReportProjectExportFinishedByYear;
use App\ExcelFromView\Report\Project\ReportProjectExportFullTbpByMonth;
use App\ExcelFromView\Report\Project\ReportProjectExportMiniTbpByMonth;
use App\ExcelFromView\Report\Project\ReportProjectExportRatingByLeader;
use App\ExcelFromView\Report\Project\ReportProjectExportByIndustryGroup;
use App\ExcelFromView\Report\Project\ReportProjectExportFinishedByMonth;
use App\ExcelFromView\Report\Project\ReportProjectExportByLeadColeadExpert;
use App\ExcelFromView\Report\Project\ReportProjectExportByObjectiveApprove;
use App\ExcelFromView\Report\Project\ReportProjectExportCancelByYearBudget;
use App\ExcelFromView\Report\Project\ReportProjectExportFullTbpByYearBudget;
use App\ExcelFromView\Report\Project\ReportProjectExportGradeByBusinessSize;
use App\ExcelFromView\Report\Project\ReportProjectExportMiniTbpByYearBudget;
use App\ExcelFromView\Report\Project\ReportProjectExportBusinessSizeBySector;
use App\ExcelFromView\Report\Project\ReportProjectExportByBusinessPlanStatus;
use App\ExcelFromView\Report\Project\ReportProjectExportFinishedByYearBudget;
use App\ExcelFromView\Report\Project\ReportProjectExportGradeByIndustryGroup;
use App\ExcelFromView\Report\Project\ReportProjectExportRatingLeaderBySector;
use App\ExcelFromView\Report\Project\ReportProjectExportExpertByIndustryGroup;
use App\ExcelFromView\Report\Project\ReportProjectExportIndustryGroupBySector;
use App\ExcelFromView\Report\Project\ReportProjectExportLeaderByIndustryGroup;
use App\ExcelFromView\Report\Project\ReportProjectExportRatingLeaderByCompanySize;
use App\ExcelFromView\Report\Project\ReportProjectExportExpertByBusinessPlanStatus;
use App\ExcelFromView\Report\Project\ReportProjectExportLeaderByBusinessPlanStatus;
use App\ExcelFromView\Report\Project\ReportProjectExportBusinessSizeByIndustryGroup;
use App\ExcelFromView\Report\Project\ReportProjectExportRatingLeaderByIndustryGroup;

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
    // public function GetProjectByGrade(Request $request){
    //     $grades = Grade::get();
    //     $grade = Grade::find($request->grade)->name;
    //     $startdate = DateConversion::thaiToEngDate($request->fromdate);
    //     $enddate = DateConversion::thaiToEngDate($request->todate);
    //     if($request->btnsubmit == 'excel'){
    //         return Excel::download(new ReportProjectExportByGrade($startdate,$enddate,$grade), 'project.xlsx');
    //     }else if($request->btnsubmit == 'search'){
    //         $projectgrades = ProjectGrade::where('grade',$grade)->pluck('full_tbp_id')->toArray();
    //         $fulltbps = FullTbp::whereIn('id', $projectgrades)->whereBetween('created_at', [$startdate, $enddate])->get();
    //         return view('dashboard.admin.realtimereport.project.bygrade')->withFulltbps($fulltbps)->withGrades($grades); 
    //     }
    // }
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
    // public function GetProjectByIndustrygroup(Request $request){
    //     $industrygroups = IndustryGroup::get();
    //     $startdate = DateConversion::thaiToEngDate($request->fromdate);
    //     $enddate = DateConversion::thaiToEngDate($request->todate);
    //     if($request->btnsubmit == 'excel'){
    //         return Excel::download(new ReportProjectExportByIndustryGroup($startdate,$enddate,$request->industrygroup), 'project.xlsx');
    //     }else if($request->btnsubmit == 'search'){
    //         $companies = Company::where('industry_group_id',$request->industrygroup)->pluck('id')->toArray();
    //         $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
    //         $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
    //         $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->whereBetween('created_at', [$startdate, $enddate])->get();
    //         return view('dashboard.admin.realtimereport.project.byindustrygroup')->withFulltbps($fulltbps)->withIndustrygroups($industrygroups); 
    //     }
    // }
    // public function GetProjectByBusinessType(Request $request){
    //     $businesstypes = BusinessType::get();
    //     $startdate = DateConversion::thaiToEngDate($request->fromdate);
    //     $enddate = DateConversion::thaiToEngDate($request->todate);
    //     if($request->btnsubmit == 'excel'){
    //         return Excel::download(new ReportProjectExportByBusinessType($startdate,$enddate,$request->businesstype), 'project.xlsx');
    //     }else if($request->btnsubmit == 'search'){
    //         $companies = Company::where('business_type_id',$request->businesstype)->pluck('id')->toArray();
    //         $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
    //         $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
    //         $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->whereBetween('created_at', [$startdate, $enddate])->get();
    //         return view('dashboard.admin.realtimereport.project.bybusinesstype')->withFulltbps($fulltbps)->withBusinesstypes($businesstypes); 
    //     }
    // }
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
        $projectbudget = $request->projectbudget;

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByBudget($projectbudget), 'allbyyearbudget.xlsx');
        }else if($request->btnsubmit == 'search'){
            $projectbudgetcapital = ProjectBudget::find($request->projectbudget);
            $fulltbpinvestmentarr = FullTbpInvestment::distinct('full_tbp_id')->pluck('full_tbp_id')->toArray();
            $arr = array();
            foreach ($fulltbpinvestmentarr as $key => $item) {
                $check = FullTbpInvestment::where('full_tbp_id',$item)->sum('cost');
                if($check > $projectbudgetcapital->minbudget && $check <= $projectbudgetcapital->maxbudget){
                    array_push($arr,$item);
                }
            }
            $fulltbps = FullTbp::whereIn('id',$arr)->get();
            return view('dashboard.admin.realtimereport.project.projectbycapital')->withProjectbudgets($projectbudgets)->withFulltbps($fulltbps); 
        }
    }

    public function projectbybusinesstype(Request $request){
        $businesstypes = BusinessType::get();
        $companies = Company::where('business_type_id',1)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
        return view('dashboard.admin.realtimereport.project.projectbybusinesstype')->withBusinesstypes($businesstypes)->withFulltbps($fulltbps);
    }
    public function getprojectbybusinesstype(Request $request){
        $businesstypes = BusinessType::get();
        $businesstype = BusinessType::find($request->businesstype);
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByBusinessType($businesstype->id), 'projectbybusinesstype.xlsx');
        }else if($request->btnsubmit == 'search'){
            $companies = Company::where('business_type_id',$businesstype->id)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
            return view('dashboard.admin.realtimereport.project.projectbybusinesstype')->withBusinesstypes($businesstypes)->withFulltbps($fulltbps); 
        }
    }

    public function projectbybusinesssize(Request $request){
        $companysizes = Companysize::get();
        $companies = Company::where('company_size_id',1)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
        return view('dashboard.admin.realtimereport.project.projectbybusinesssize')->withCompanysizes($companysizes)->withFulltbps($fulltbps);
    }
    public function getprojectbybusinesssize(Request $request){
        $companysizes = Companysize::get();
        $companysize = Companysize::find($request->companysize);
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByBusinessSize($companysize->id), 'projectbybusinesssize.xlsx');
        }else if($request->btnsubmit == 'search'){
            $companies = Company::where('company_size_id',$companysize->id)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
            return view('dashboard.admin.realtimereport.project.projectbybusinesssize')->withCompanysizes($companysizes)->withFulltbps($fulltbps); 
        }
    }

    public function projectbyisiccode(Request $request){
        $isics = Isic::get();
        $companies = Company::where('isic_id',1)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
        return view('dashboard.admin.realtimereport.project.projectbyisiccode')->withIsics($isics)->withFulltbps($fulltbps);
    }
    public function getprojectbyisiccode(Request $request){
        $isics = Isic::get();
        $isic = Isic::find($request->isic);
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByIsic($isic->id), 'projectbyisiccode.xlsx');
        }else if($request->btnsubmit == 'search'){
            $companies = Company::where('isic_id',$isic->id)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
            return view('dashboard.admin.realtimereport.project.projectbyisiccode')->withIsics($isics)->withFulltbps($fulltbps); 
        }
    }

    public function projectbyindustrygroup(Request $request){
        $industrygroups = IndustryGroup::get();
        $companies = Company::where('industry_group_id',1)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
        return view('dashboard.admin.realtimereport.project.projectbyindustrygroup')->withIndustrygroups($industrygroups)->withFulltbps($fulltbps);
    }
    public function getprojectbyindustrygroup(Request $request){
        $industrygroups = IndustryGroup::get();
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByIndustrygroup($request->industrygroup), 'projectbyindustrygroup.xlsx');
        }else if($request->btnsubmit == 'search'){
            $companies = Company::where('industry_group_id',$request->industrygroup)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
            return view('dashboard.admin.realtimereport.project.projectbyindustrygroup')->withIndustrygroups($industrygroups)->withFulltbps($fulltbps); 
        }
    }

    public function projectbyprovince(Request $request){
        $provinces = Province::get();
        $addressarray = array_unique(CompanyAddress::where('province_id',1)->pluck('company_id')->toArray());
        $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
        return view('dashboard.admin.realtimereport.project.projectbyprovince')->withProvinces($provinces)->withFulltbps($fulltbps);
    }
    public function getprojectbyprovince(Request $request){
        $provinces = Province::get();
        $addressarray = array_unique(CompanyAddress::where('province_id',$request->province)->pluck('company_id')->toArray());
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByProvince($request->province), 'projectbyprovince.xlsx');
        }else if($request->btnsubmit == 'search'){
            $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
            return view('dashboard.admin.realtimereport.project.projectbyprovince')->withProvinces($provinces)->withFulltbps($fulltbps); 
        }
    }

    public function projectbysector(Request $request){
        $sectors = Sector::get();
        $provincearray = Province::where('map_code',1)->pluck('id')->toArray();

        $addressarray = array_unique(CompanyAddress::whereIn('province_id',$provincearray)->whereNull('addresstype')->pluck('company_id')->toArray());
        $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
        return view('dashboard.admin.realtimereport.project.projectbysector')->withSectors($sectors)->withFulltbps($fulltbps);
    }
    public function getprojectbysector(Request $request){
        $sectors = Sector::get();
        $provincearray = Province::where('map_code',$request->sector)->pluck('id')->toArray();
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportBySector($request->sector), 'projectbysector.xlsx');
        }else if($request->btnsubmit == 'search'){
            $addressarray = array_unique(CompanyAddress::whereIn('province_id',$provincearray)->whereNull('addresstype')->pluck('company_id')->toArray());
            
            $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
            
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
            return view('dashboard.admin.realtimereport.project.projectbysector')->withSectors($sectors)->withFulltbps($fulltbps); 
        }
    }

    public function projectbystatus(Request $request){
        $businessplanstatuses = BusinessPlanStatus::get();
        $businessplanarray = BusinessPlan::where('business_plan_status_id',3)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
        return view('dashboard.admin.realtimereport.project.projectbystatus')->withBusinessplanstatuses($businessplanstatuses)->withFulltbps($fulltbps);
    }
    public function getprojectbystatus(Request $request){
        $businessplanstatuses = BusinessPlanStatus::get();
        $businessplanstatus = BusinessPlanStatus::find($request->businessplanstatus);
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByBusinessPlanStatus($businessplanstatus->id), 'projectbystatus.xlsx');
        }else if($request->btnsubmit == 'search'){
            $businessplanarray = BusinessPlan::where('business_plan_status_id',$businessplanstatus->id)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
            return view('dashboard.admin.realtimereport.project.projectbystatus')->withBusinessplanstatuses($businessplanstatuses)->withFulltbps($fulltbps); 
        }
    }

    public function projectbyscore(Request $request){
        $scores = Grade::get();
        $score = Grade::first();
        $projectgradearray = ProjectGrade::whereBetween('percent', [intVal($score->min), intVal($score->max)])->pluck('full_tbp_id')->toArray();                
        $fulltbps = FullTbp::whereIn('id', $projectgradearray)->get();
        return view('dashboard.admin.realtimereport.project.projectbyscore')->withScores($scores)->withFulltbps($fulltbps);
    }
    public function getprojectbyscore(Request $request){
        $scores = Grade::get();
        $score = Grade::find($request->score);
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByScore($score->id), 'projectbyscore.xlsx');
        }else if($request->btnsubmit == 'search'){
            $projectgradearray = ProjectGrade::whereBetween('percent', [intVal($score->min), intVal($score->max)])->pluck('full_tbp_id')->toArray();
            $fulltbps = FullTbp::whereIn('id', $projectgradearray)->get();
            return view('dashboard.admin.realtimereport.project.projectbyscore')->withScores($scores)->withFulltbps($fulltbps); 
        }
    }

    public function projectbygrade(Request $request){
        $grades = Grade::get();
        $grade = Grade::first();
        $projectgradearray = ProjectGrade::where('grade',$grade->name)->pluck('full_tbp_id')->toArray();
        $fulltbps = FullTbp::whereIn('id', $projectgradearray)->get();
        return view('dashboard.admin.realtimereport.project.projectbygrade')->withGrades($grades)->withFulltbps($fulltbps);
    }
    public function getprojectbygrade(Request $request){
        $grades = Grade::get();
        $grade = Grade::find($request->grade);
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByGrade($request->grade), 'projectbygrade.xlsx');
        }else if($request->btnsubmit == 'search'){
            $projectgradearray = ProjectGrade::where('grade',$grade->name)->pluck('full_tbp_id')->toArray();
            $fulltbps = FullTbp::whereIn('id', $projectgradearray)->get();
            return view('dashboard.admin.realtimereport.project.projectbygrade')->withGrades($grades)->withFulltbps($fulltbps); 
        }
    }

    public function projectbycertificate(Request $request){
        $businessplanarray = BusinessPlan::where('business_plan_status_id',10)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
        return view('dashboard.admin.realtimereport.project.projectbycertificate')->withFulltbps($fulltbps);
    }
    public function getprojectbycertificate(Request $request){
        $businessplanarray = BusinessPlan::where('business_plan_status_id',10)->pluck('id')->toArray();
        if($request->status != 1){
            $businessplanarray = BusinessPlan::where('business_plan_status_id','!=',10)->pluck('id')->toArray();
        }

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByCertificate($request->status), 'projectbycertificate.xlsx');
        }else if($request->btnsubmit == 'search'){
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
            return view('dashboard.admin.realtimereport.project.projectbycertificate')->withFulltbps($fulltbps); 
        }
    }

    public function projectbyobjective(Request $request){
        $minitbparray = MiniTBP::whereNotNull('finance1')
                                ->orWhereNotNull('finance2')
                                ->orWhereNotNull('finance3')
                                ->orWhereNotNull('finance4')
                                ->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
        return view('dashboard.admin.realtimereport.project.projectbyobjective')->withFulltbps($fulltbps);
    }
    public function getprojectbyobjective(Request $request){
            $minitbparray = MiniTBP::whereNotNull('finance1')
                                ->orWhereNotNull('finance2')
                                ->orWhereNotNull('finance3')
                                ->orWhereNotNull('finance4')
                                ->pluck('id')->toArray();

        if($request->objecttivetype != 1){
            $minitbparray = MiniTBP::whereNotNull('nonefinance1')
                                    ->orWhereNotNull('nonefinance2')
                                    ->orWhereNotNull('nonefinance3')
                                    ->orWhereNotNull('nonefinance4')
                                    ->orWhereNotNull('nonefinance5')
                                    ->orWhereNotNull('nonefinance6')
                                    ->pluck('id')->toArray();
        }

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByObjective($request->objecttivetype), 'projectbyobjective.xlsx');
        }else if($request->btnsubmit == 'search'){

            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
            return view('dashboard.admin.realtimereport.project.projectbyobjective')->withFulltbps($fulltbps); 
        }
    }

    public function projectbyobjectiveapprove(Request $request){
        $minitbparray = MiniTBP::whereNotNull('finance1')
                                ->orWhereNotNull('finance2')
                                ->orWhereNotNull('finance3')
                                ->orWhereNotNull('finance4')
                                ->pluck('id')->toArray();
                            
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->where('success_objective',1)->get(); 
        return view('dashboard.admin.realtimereport.project.projectbyobjectiveapprove')->withFulltbps($fulltbps);
    }
    public function getprojectbyobjectiveapprove(Request $request){
            $minitbparray = MiniTBP::whereNotNull('finance1')
                                ->orWhereNotNull('finance2')
                                ->orWhereNotNull('finance3')
                                ->orWhereNotNull('finance4')
                                ->pluck('id')->toArray();

        if($request->objecttivetype != 1){
            $minitbparray = MiniTBP::whereNotNull('nonefinance1')
                                    ->orWhereNotNull('nonefinance2')
                                    ->orWhereNotNull('nonefinance3')
                                    ->orWhereNotNull('nonefinance4')
                                    ->orWhereNotNull('nonefinance5')
                                    ->orWhereNotNull('nonefinance6')
                                    ->pluck('id')->toArray();
        }

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByObjectiveApprove($request->objecttivetype), 'projectbyobjectiveapprove.xlsx');
        }else if($request->btnsubmit == 'search'){

            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->where('success_objective',1)->get();
            return view('dashboard.admin.realtimereport.project.projectbyobjectiveapprove')->withFulltbps($fulltbps); 
        }
    }

    public function projectbyleader(Request $request){
        $first= ProjectAssignment::whereNotNull('leader_id')->first();
        $firstleader= $first->leader_id;
        $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
        $leaders = User::whereIn('id',$leaderarray)->get();
        $fulltbparray = ProjectAssignment::where('leader_id',$first->leader_id)->pluck('full_tbp_id')->toArray();
        $fulltbps = FullTbp::whereIn('id',$fulltbparray)->get();
        return view('dashboard.admin.realtimereport.project.projectbyleader')->withFirstleader($firstleader)->withLeaders($leaders)->withFulltbps($fulltbps);
    }
    public function getprojectbyleader(Request $request){
        $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
        $leaders = User::whereIn('id',$leaderarray)->get();
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByLeader($request->leader), 'projectbyleader.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbparray = ProjectAssignment::where('leader_id',$request->leader)->pluck('full_tbp_id')->toArray();
            $fulltbps = FullTbp::whereIn('id',$fulltbparray)->get();
            return view('dashboard.admin.realtimereport.project.projectbyleader')->withLeaders($leaders)->withFulltbps($fulltbps); 
        }
    }

    public function projectleadbystatus(Request $request){
        $first= ProjectAssignment::whereNotNull('leader_id')->first();
        $firstleader= $first->leader_id;
        $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
        $leaders = User::whereIn('id',$leaderarray)->get();
        $fulltbparray = ProjectAssignment::where('leader_id',$first->leader_id)->pluck('full_tbp_id')->toArray();
        $fulltbps1 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();

        $businessplanstatuses = BusinessPlanStatus::get();
        $businessplanarray = BusinessPlan::where('business_plan_status_id',3)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }
        $fulltbps = FullTbp::whereIn('id', $intersec)->get();
        return view('dashboard.admin.realtimereport.project.projectleadbystatus')->withFirstleader($firstleader)
                                                                ->withLeaders($leaders)
                                                                ->withBusinessplanstatuses($businessplanstatuses)
                                                                ->withFulltbps($fulltbps);
    }
    public function getprojectleadbystatus(Request $request){
        $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
        $leaders = User::whereIn('id',$leaderarray)->get();
        $fulltbparray = ProjectAssignment::where('leader_id',$request->leader)->pluck('full_tbp_id')->toArray();
        $fulltbps1 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();
        $businessplanstatuses = BusinessPlanStatus::get();
        $businessplanarray = BusinessPlan::where('business_plan_status_id',$request->businessplanstatus)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportLeaderByBusinessPlanStatus($request->leader,$request->businessplanstatus), 'projectleadbystatus.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereIn('id', $intersec)->get();
            return view('dashboard.admin.realtimereport.project.projectleadbystatus')->withLeaders($leaders)
                                                                                ->withBusinessplanstatuses($businessplanstatuses)
                                                                                ->withFulltbps($fulltbps); 
        }
    }

    public function projectleadbyindustrygroup(Request $request){
        $first= ProjectAssignment::whereNotNull('leader_id')->first();
        $firstleader= $first->leader_id;
        $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
        $leaders = User::whereIn('id',$leaderarray)->get();
        $fulltbparray = ProjectAssignment::where('leader_id',$first->leader_id)->pluck('full_tbp_id')->toArray();
        $fulltbps1 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();

        $industrygroups = IndustryGroup::get();
        $companies = Company::where('industry_group_id',1)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }
        $fulltbps = FullTbp::whereIn('id', $intersec)->get();
        return view('dashboard.admin.realtimereport.project.projectleadbyindustrygroup')->withFirstleader($firstleader)
                                                                ->withLeaders($leaders)
                                                                ->withIndustrygroups($industrygroups)
                                                                ->withFulltbps($fulltbps);
    }
   
   
    public function getprojectleadbyindustrygroup(Request $request){
        $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
        $leaders = User::whereIn('id',$leaderarray)->get();
        $fulltbparray = ProjectAssignment::where('leader_id',$request->leader)->pluck('full_tbp_id')->toArray();
        $fulltbps1 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();

       $industrygroups = IndustryGroup::get();
       $companies = Company::where('industry_group_id',$request->industrygroup)->pluck('id')->toArray();
       $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
       $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
       $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportLeaderByIndustryGroup($request->leader,$request->industrygroup), 'projectleadbyindustrygroup.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereIn('id', $intersec)->get();
            return view('dashboard.admin.realtimereport.project.projectleadbyindustrygroup')->withLeaders($leaders)
                                                                                ->withIndustrygroups($industrygroups)
                                                                                ->withFulltbps($fulltbps); 
        }
    }

    public function projectbyexpert(Request $request){
        $first= ExpertAssignment::first();
        $firstexpert= $first->user_id;
        $expertarray= array_unique(ExpertAssignment::pluck('user_id')->toArray());
        $experts = User::whereIn('id',$expertarray)->get();
        $fulltbparray = ExpertAssignment::where('user_id',$first->user_id)->pluck('full_tbp_id')->toArray();

        $fulltbps = FullTbp::whereIn('id',$fulltbparray)->get();
        return view('dashboard.admin.realtimereport.project.projectbyexpert')->withFirstexpert($firstexpert)->withExperts($experts)->withFulltbps($fulltbps);
    }
    public function getprojectbyexpert(Request $request){
        $expertarray= array_unique(ExpertAssignment::pluck('user_id')->toArray());
        $experts = User::whereIn('id',$expertarray)->get();

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByExpert($request->expert), 'projectbyexpert.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbparray = ExpertAssignment::where('user_id',$request->expert)->pluck('full_tbp_id')->toArray();
            $fulltbps = FullTbp::whereIn('id',$fulltbparray)->get();
            return view('dashboard.admin.realtimereport.project.projectbyexpert')->withExperts($experts)->withFulltbps($fulltbps); 
        }
    }

    public function projectexpertbystatus(Request $request){
        $first= ExpertAssignment::first();
        $firstexpert= $first->user_id;
        $expertarray= array_unique(ExpertAssignment::pluck('user_id')->toArray());
        $experts = User::whereIn('id',$expertarray)->get();
        $fulltbps1 = ExpertAssignment::where('user_id',$first->user_id)->pluck('full_tbp_id')->toArray();

        $businessplanstatuses = BusinessPlanStatus::get();
        $businessplanarray = BusinessPlan::where('business_plan_status_id',3)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }

        $fulltbps = FullTbp::whereIn('id', $intersec)->get();
        return view('dashboard.admin.realtimereport.project.projectexpertbystatus')->withFirstexpert($firstexpert)
                                                                ->withExperts($experts)
                                                                ->withBusinessplanstatuses($businessplanstatuses)
                                                                ->withFulltbps($fulltbps);
    }
    public function getprojectexpertbystatus(Request $request){
        $expertarray= array_unique(ExpertAssignment::pluck('user_id')->toArray());
        $experts = User::whereIn('id',$expertarray)->get();
        
        $fulltbparray = ExpertAssignment::where('user_id',$request->expert)->pluck('full_tbp_id')->toArray();
        $fulltbps1 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();

        $businessplanstatuses = BusinessPlanStatus::get();
        $businessplanarray = BusinessPlan::where('business_plan_status_id',$request->businessplanstatus)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportExpertByBusinessPlanStatus($request->expert,$request->businessplanstatus), 'projectexpertbystatus.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereIn('id', $intersec)->get();
            return view('dashboard.admin.realtimereport.project.projectexpertbystatus')->withExperts($experts)
                                                                                ->withBusinessplanstatuses($businessplanstatuses)
                                                                                ->withFulltbps($fulltbps); 
        }
    }


    
    public function projectexpertbyindustrygroup(Request $request){
        $first= ExpertAssignment::first();
        $firstexpert= $first->user_id;
        $expertarray= array_unique(ExpertAssignment::pluck('user_id')->toArray());
        $experts = User::whereIn('id',$expertarray)->get();
        $fulltbps1 = ExpertAssignment::where('user_id',$first->user_id)->pluck('full_tbp_id')->toArray();

        $industrygroups = IndustryGroup::get();
        $companies = Company::where('industry_group_id',1)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }

        $fulltbps = FullTbp::whereIn('id', $intersec)->get();
        return view('dashboard.admin.realtimereport.project.projectexpertbyindustrygroup')->withFirstexpert($firstexpert)
                                                                ->withExperts($experts)
                                                                ->withIndustrygroups($industrygroups)
                                                                ->withFulltbps($fulltbps);
    }
    public function getprojectexpertbyindustrygroup(Request $request){
        $expertarray= array_unique(ExpertAssignment::pluck('user_id')->toArray());
        $experts = User::whereIn('id',$expertarray)->get();
        $fulltbparray = ExpertAssignment::where('user_id',$request->expert)->pluck('full_tbp_id')->toArray();
        $fulltbps1 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();

        $industrygroups = IndustryGroup::get();
        $companies = Company::where('industry_group_id',$request->industrygroup)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportExpertByIndustryGroup($request->expert,$request->industrygroup), 'projectexpertbyindustrygroup.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereIn('id', $intersec)->get();
            return view('dashboard.admin.realtimereport.project.projectexpertbyindustrygroup')->withExperts($experts)
                                                                                ->withIndustrygroups($industrygroups)
                                                                                ->withFulltbps($fulltbps); 
        }
    }

    public function projectgradebybusinesssize(Request $request){
        $grades = Grade::get();
        $grade = Grade::first();
        $projectgradearray = ProjectGrade::where('grade',$grade->name)->pluck('full_tbp_id')->toArray();
        $fulltbps1 = FullTbp::whereIn('id', $projectgradearray)->pluck('id')->toArray();

        $companysizes = Companysize::get();
        $companies = Company::where('company_size_id',1)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }

        $fulltbps = FullTbp::whereIn('id', $intersec)->get();
        return view('dashboard.admin.realtimereport.project.projectgradebybusinesssize')->withGrades($grades)->withCompanysizes($companysizes)->withFulltbps($fulltbps);
    }
    public function getprojectgradebybusinesssize(Request $request){
        $grades = Grade::get();
        $grade = Grade::find($request->grade);
        $projectgradearray = ProjectGrade::where('grade',$grade->name)->pluck('full_tbp_id')->toArray();
        $fulltbps1 = FullTbp::whereIn('id', $projectgradearray)->pluck('id')->toArray();

        $companysizes = Companysize::get();
        $companies = Company::where('company_size_id',$request->companysize)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportGradeByBusinessSize($request->grade,$request->companysize), 'projectgradebybusinesssize.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereIn('id', $intersec)->get();
            return view('dashboard.admin.realtimereport.project.projectgradebybusinesssize')->withGrades($grades)->withCompanysizes($companysizes)->withFulltbps($fulltbps); 
        }
    }

    public function projectgradebyindustrygroup(Request $request){
        $grades = Grade::get();
        $grade = Grade::first();
        $projectgradearray = ProjectGrade::where('grade',$grade->name)->pluck('full_tbp_id')->toArray();
        $fulltbps1 = FullTbp::whereIn('id', $projectgradearray)->pluck('id')->toArray();

        $industrygroups = IndustryGroup::get();
        $companies = Company::where('industry_group_id',1)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }

        $fulltbps = FullTbp::whereIn('id', $intersec)->get();
        return view('dashboard.admin.realtimereport.project.projectgradebyindustrygroup')->withGrades($grades)->withIndustrygroups($industrygroups)->withFulltbps($fulltbps);
    }
    public function getprojectgradebyindustrygroup(Request $request){
        $grades = Grade::get();
        $grade = Grade::find($request->grade);
        $projectgradearray = ProjectGrade::where('grade',$grade->name)->pluck('full_tbp_id')->toArray();
        $fulltbps1 = FullTbp::whereIn('id', $projectgradearray)->pluck('id')->toArray();

        $industrygroups = IndustryGroup::get();
        $companies = Company::where('industry_group_id',$request->industrygroup)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportGradeByIndustryGroup($request->grade,$request->industrygroup), 'projectgradebyindustrygroup.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereIn('id', $intersec)->get();
            return view('dashboard.admin.realtimereport.project.projectgradebyindustrygroup')->withGrades($grades)->withIndustrygroups($industrygroups)->withFulltbps($fulltbps); 
        }
    }

    
    public function projectbusinesssizebyindustrygroup(Request $request){
        $companysizes = Companysize::get();
        $companies = Company::where('company_size_id',1)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $industrygroups = IndustryGroup::get();
        $companies = Company::where('industry_group_id',1)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }

        $fulltbps = FullTbp::whereIn('id', $intersec)->get();
        return view('dashboard.admin.realtimereport.project.projectbusinesssizebyindustrygroup')->withCompanysizes($companysizes)->withIndustrygroups($industrygroups)->withFulltbps($fulltbps);
    }
    public function getprojectbusinesssizebyindustrygroup(Request $request){
        $companysizes = Companysize::get();
        $companies = Company::where('company_size_id',$request->companysize)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $industrygroups = IndustryGroup::get();
        $companies = Company::where('industry_group_id',$request->industrygroup)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportBusinessSizeByIndustryGroup($request->companysize,$request->industrygroup), 'projectbusinesssizebyindustrygroup.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereIn('id', $intersec)->get();
            return view('dashboard.admin.realtimereport.project.projectbusinesssizebyindustrygroup')->withCompanysizes($companysizes)->withIndustrygroups($industrygroups)->withFulltbps($fulltbps); 
        }
    }
    
    public function projectbusinesssizebysector(Request $request){
        $companysizes = Companysize::get();
        $companies = Company::where('company_size_id',1)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $sectors = Sector::get();
        $provincearray = Province::where('map_code',1)->pluck('id')->toArray();

        $addressarray = array_unique(CompanyAddress::whereIn('province_id',$provincearray)->whereNull('addresstype')->pluck('company_id')->toArray());
        $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }

        $fulltbps = FullTbp::whereIn('id', $intersec)->get();
        return view('dashboard.admin.realtimereport.project.projectbusinesssizebysector')->withCompanysizes($companysizes)->withSectors($sectors)->withFulltbps($fulltbps);
    }
    public function getprojectbusinesssizebysector(Request $request){
        $companysizes = Companysize::get();
        $companies = Company::where('company_size_id',$request->companysize)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $sectors = Sector::get();
        $provincearray = Province::where('map_code',$request->sector)->pluck('id')->toArray();
        $addressarray = array_unique(CompanyAddress::whereIn('province_id',$provincearray)->whereNull('addresstype')->pluck('company_id')->toArray());           
        $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportBusinessSizeBySector($request->companysize,$request->sector), 'projectbusinesssizebysector.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereIn('id', $intersec)->get();
            return view('dashboard.admin.realtimereport.project.projectbusinesssizebysector')->withCompanysizes($companysizes)->withSectors($sectors)->withFulltbps($fulltbps); 
        }
    }

    public function projectindustrygroupbysector(Request $request){
        $industrygroups = IndustryGroup::get();
        $companies = Company::where('industry_group_id',1)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $sectors = Sector::get();
        $provincearray = Province::where('map_code',1)->pluck('id')->toArray();
        $addressarray = array_unique(CompanyAddress::whereIn('province_id',$provincearray)->whereNull('addresstype')->pluck('company_id')->toArray());
        $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }

        $fulltbps = FullTbp::whereIn('id', $intersec)->get();
        return view('dashboard.admin.realtimereport.project.projectindustrygroupbysector')->withIndustrygroups($industrygroups)->withSectors($sectors)->withFulltbps($fulltbps);
    }
    public function getprojectindustrygroupbysector(Request $request){
        $industrygroups = IndustryGroup::get();
        $companies = Company::where('industry_group_id',$request->industrygroup)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $sectors = Sector::get();
        $provincearray = Province::where('map_code',$request->sector)->pluck('id')->toArray();
        $addressarray = array_unique(CompanyAddress::whereIn('province_id',$provincearray)->whereNull('addresstype')->pluck('company_id')->toArray());           
        $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportIndustryGroupBySector($request->industrygroup,$request->sector), 'projectindustrygroupbysector.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereIn('id', $intersec)->get();
            return view('dashboard.admin.realtimereport.project.projectindustrygroupbysector')->withIndustrygroups($industrygroups)->withSectors($sectors)->withFulltbps($fulltbps); 
        }
    }

    public function projectall(Request $request){
        $businessplanarray = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
        return view('dashboard.admin.realtimereport.project.projectall')->withFulltbps($fulltbps);
    }
    public function getprojectall(Request $request){
        $businessplanarray = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByProjectAll(), 'projectall.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
            return view('dashboard.admin.realtimereport.project.projectall')->withFulltbps($fulltbps); 
        }
    }

    public function projectstatusbyleader(Request $request){
        $businessplanarray = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $first= ProjectAssignment::whereNotNull('leader_id')->first();
        $firstleader= $first->leader_id;
        $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
        $leaders = User::whereIn('id',$leaderarray)->get();
        $fulltbparray = ProjectAssignment::where('leader_id',$first->leader_id)->pluck('full_tbp_id')->toArray();
        $fulltbps2 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();

        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }

        $fulltbps = FullTbp::whereIn('id', $intersec)->get();
        return view('dashboard.admin.realtimereport.project.projectstatusbyleader')->withFirstleader($firstleader)->withLeaders($leaders)->withFulltbps($fulltbps);
    }
    public function getprojectstatusbyleader(Request $request){
        $businessplanarray = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
        $leaders = User::whereIn('id',$leaderarray)->get();
        $fulltbparray = ProjectAssignment::where('leader_id',$request->leader)->pluck('full_tbp_id')->toArray();
        $fulltbps2 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();
        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportRatingByLeader($request->leader), 'projectstatusbyleader.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereIn('id', $intersec)->get();
            return view('dashboard.admin.realtimereport.project.projectstatusbyleader')->withLeaders($leaders)->withFulltbps($fulltbps); 
        }
    }

    public function leadprojectstatusbyindustrygroup(Request $request){
        $businessplanarray = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
      
        $first= ProjectAssignment::whereNotNull('leader_id')->first();
        $firstleader= $first->leader_id;
        $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
        $leaders = User::whereIn('id',$leaderarray)->get();
        $fulltbparray = ProjectAssignment::where('leader_id',$first->leader_id)->pluck('full_tbp_id')->toArray();
        $fulltbps2 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();

        $industrygroups = IndustryGroup::get();
        $companies = Company::where('industry_group_id',1)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps3 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $_intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($_intersec,$f1);
            } 
        }

        $intersec = array();
        foreach($_intersec as $f1) {
            if (in_array($f1,$fulltbps3)) {
                array_push($intersec,$f1);
            } 
        }

        $fulltbps = FullTbp::whereIn('id', $intersec)->get();
        return view('dashboard.admin.realtimereport.project.leadprojectstatusbyindustrygroup')->withFirstleader($firstleader)->withIndustrygroups($industrygroups)->withLeaders($leaders)->withFulltbps($fulltbps);
    }
    public function getleadprojectstatusbyindustrygroup(Request $request){
        $businessplanarray = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
        $leaders = User::whereIn('id',$leaderarray)->get();
        $fulltbparray = ProjectAssignment::where('leader_id',$request->leader)->pluck('full_tbp_id')->toArray();
        $fulltbps2 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();
        
        $industrygroups = IndustryGroup::get();
        $companies = Company::where('industry_group_id',$request->industrygroup)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps3 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $_intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($_intersec,$f1);
            } 
        }

        $intersec = array();
        foreach($_intersec as $f1) {
            if (in_array($f1,$fulltbps3)) {
                array_push($intersec,$f1);
            } 
        }

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportRatingLeaderByIndustryGroup($request->leader,$request->industrygroup), 'leadprojectstatusbyindustrygroup.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereIn('id', $intersec)->get();
            return view('dashboard.admin.realtimereport.project.leadprojectstatusbyindustrygroup')->withLeaders($leaders)->withIndustrygroups($industrygroups)->withFulltbps($fulltbps); 
        }
    }

    public function leadprojectstatusbysector(Request $request){
        $businessplanarray = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
        $first= ProjectAssignment::whereNotNull('leader_id')->first();
        $firstleader= $first->leader_id;
        $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
        $leaders = User::whereIn('id',$leaderarray)->get();
        $fulltbparray = ProjectAssignment::where('leader_id',$first->leader_id)->pluck('full_tbp_id')->toArray();
        $fulltbps2 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();

        $sectors = Sector::get();
        $provincearray = Province::where('map_code',1)->pluck('id')->toArray();
        $addressarray = array_unique(CompanyAddress::whereIn('province_id',$provincearray)->whereNull('addresstype')->pluck('company_id')->toArray());
        $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps3 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $_intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($_intersec,$f1);
            } 
        }

        $intersec = array();
        foreach($_intersec as $f1) {
            if (in_array($f1,$fulltbps3)) {
                array_push($intersec,$f1);
            } 
        }

        $fulltbps = FullTbp::whereIn('id', $intersec)->get();
        return view('dashboard.admin.realtimereport.project.leadprojectstatusbysector')->withFirstleader($firstleader)->withSectors($sectors)->withLeaders($leaders)->withFulltbps($fulltbps);
    }
    public function getleadprojectstatusbysector(Request $request){
        $businessplanarray = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
        $leaders = User::whereIn('id',$leaderarray)->get();
        $fulltbparray = ProjectAssignment::where('leader_id',$request->leader)->pluck('full_tbp_id')->toArray();
        $fulltbps2 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();
        
        $sectors = Sector::get();
        $provincearray = Province::where('map_code',$request->sector)->pluck('id')->toArray();
        $addressarray = array_unique(CompanyAddress::whereIn('province_id',$provincearray)->whereNull('addresstype')->pluck('company_id')->toArray());           
        $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps3 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $_intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($_intersec,$f1);
            } 
        }

        $intersec = array();
        foreach($_intersec as $f1) {
            if (in_array($f1,$fulltbps3)) {
                array_push($intersec,$f1);
            } 
        }

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportRatingLeaderBySector($request->leader,$request->sector), 'leadprojectstatusbysector.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereIn('id', $intersec)->get();
            return view('dashboard.admin.realtimereport.project.leadprojectstatusbysector')->withLeaders($leaders)->withSectors($sectors)->withFulltbps($fulltbps); 
        }
    }

    //==
    
    public function leadprojectstatusbybusinesssize(Request $request){
        $businessplanarray = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
        $first= ProjectAssignment::whereNotNull('leader_id')->first();
        $firstleader= $first->leader_id;
        $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
        $leaders = User::whereIn('id',$leaderarray)->get();
        $fulltbparray = ProjectAssignment::where('leader_id',$first->leader_id)->pluck('full_tbp_id')->toArray();
        $fulltbps2 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();

        $companysizes = Companysize::get();
        $companies = Company::where('company_size_id',1)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $_intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($_intersec,$f1);
            } 
        }

        $intersec = array();
        foreach($_intersec as $f1) {
            if (in_array($f1,$fulltbps3)) {
                array_push($intersec,$f1);
            } 
        }

        $fulltbps = FullTbp::whereIn('id', $intersec)->get();
        return view('dashboard.admin.realtimereport.project.leadprojectstatusbybusinesssize')->withFirstleader($firstleader)->withCompanysizes($companysizes)->withLeaders($leaders)->withFulltbps($fulltbps);
    }
    public function getleadprojectstatusbybusinesssize(Request $request){
        $businessplanarray = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
        $leaders = User::whereIn('id',$leaderarray)->get();
        $fulltbparray = ProjectAssignment::where('leader_id',$request->leader)->pluck('full_tbp_id')->toArray();
        $fulltbps2 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();
        
        $companysizes = Companysize::get();
        $companies = Company::where('company_size_id',$request->companysize)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps3 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $_intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($_intersec,$f1);
            } 
        }

        $intersec = array();
        foreach($_intersec as $f1) {
            if (in_array($f1,$fulltbps3)) {
                array_push($intersec,$f1);
            } 
        }

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportRatingLeaderByCompanySize($request->leader,$request->companysize), 'leadprojectstatusbybusinesssize.xlsx');
        }else if($request->btnsubmit == 'search'){
            $fulltbps = FullTbp::whereIn('id', $intersec)->get();
            return view('dashboard.admin.realtimereport.project.leadprojectstatusbybusinesssize')->withLeaders($leaders)->withCompanysizes($companysizes)->withFulltbps($fulltbps); 
        }
    } 

    public function projectbyleadcoleadexpert(Request $request){
        $businessplanarray = BusinessPlan::where('business_plan_status_id','>',3)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
        $fulltbp = FullTbp::first();
        $minitbp = MiniTbp::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $expertassignments = ExpertAssignment::where('full_tbp_id',$fulltbp->id)->get();
        return view('dashboard.admin.realtimereport.project.projectbyleadcoleadexpert')->withFulltbps($fulltbps)
                                                                                ->withExpertassignments($expertassignments)
                                                                                ->withProjectassignment($projectassignment);
    }
    public function getprojectbyleadcoleadexpert(Request $request){
        $businessplanarray = BusinessPlan::where('business_plan_status_id','>',3)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
        $fulltbp = FullTbp::find($request->fulltbp);
        $minitbp = MiniTbp::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $expertassignments = ExpertAssignment::where('full_tbp_id',$fulltbp->id)->get();

        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportProjectExportByLeadColeadExpert($request->fulltbp), 'projectbyleadcoleadexpert.xlsx');
        }else if($request->btnsubmit == 'search'){
            return view('dashboard.admin.realtimereport.project.projectbyleadcoleadexpert')->withFulltbps($fulltbps)
                                                                                    ->withExpertassignments($expertassignments)
                                                                                    ->withProjectassignment($projectassignment);
        }
    }
}

