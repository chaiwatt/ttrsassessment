<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\ProjectGrade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportChartController extends Controller
{
    public function GetProject(Request $request){
        $minitbps = MiniTBP::get();
        $fulltbps = FullTbp::get();
        $completes = FullTbp::where('status',3)->get();
        return response()->json(array(
            "minitbps" => $minitbps,
            "fulltbps" => $fulltbps,
            "completes" => $completes
        ));
    }

    public function ChartData(Request $request){
        $thisyear = Carbon::now()->year;
        $minitbps = BusinessPlan::where('business_plan_status_id','>=',4)->whereYear('created_at', $thisyear)->count();
        $fulltbps = BusinessPlan::where('business_plan_status_id','>=',6)->whereYear('created_at', $thisyear)->count();
        $finish = BusinessPlan::where('business_plan_status_id','>=',8)->whereYear('created_at', $thisyear)->count();
        $numprojects = array("minitbp"=>$minitbps,"fulltbp"=>$fulltbps,"finish"=>$finish);

        $aaa = ProjectGrade::where('grade','AAA')->whereYear('created_at', $thisyear)->count();
        $aa = ProjectGrade::where('grade','AA')->whereYear('created_at', $thisyear)->count();
        $a = ProjectGrade::where('grade','A')->whereYear('created_at', $thisyear)->count();
        $bbb = ProjectGrade::where('grade','BBB')->whereYear('created_at', $thisyear)->count();
        $bb = ProjectGrade::where('grade','BB')->whereYear('created_at', $thisyear)->count();
        $b = ProjectGrade::where('grade','B')->whereYear('created_at', $thisyear)->count();
        $ccc = ProjectGrade::where('grade','CCC')->whereYear('created_at', $thisyear)->count();
        $cc = ProjectGrade::where('grade','CC')->whereYear('created_at', $thisyear)->count();
        $c = ProjectGrade::where('grade','C')->whereYear('created_at', $thisyear)->count();
        $d = ProjectGrade::where('grade','D')->whereYear('created_at', $thisyear)->count();

        $projectgrades = array("AAA" => $aaa, "AA" => $aa,"A" => $a,"BBB" => $bbb, "BB" => $bb,"B" => $b,"CCC" => $ccc, "CC" => $cc,"C" => $c,"D" => $d);

        $automotivearr = Company::where('industry_group_id',1)->pluck('id')->toArray();
        $automotive = BusinessPlan::whereIn('company_id',$automotivearr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $thisyear)->count();
        $smartelectronicarr = Company::where('industry_group_id',2)->pluck('id')->toArray();
        $smartelectronic = BusinessPlan::whereIn('company_id',$smartelectronicarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $thisyear)->count();
        $affluentarr = Company::where('industry_group_id',3)->pluck('id')->toArray();
        $affluent = BusinessPlan::whereIn('company_id',$affluentarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $thisyear)->count();
        $agriculturearr = Company::where('industry_group_id',4)->pluck('id')->toArray();
        $agriculture = BusinessPlan::whereIn('company_id',$agriculturearr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $thisyear)->count();
        $foodarr = Company::where('industry_group_id',5)->pluck('id')->toArray();
        $food = BusinessPlan::whereIn('company_id',$foodarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $thisyear)->count();
        $roboticarr = Company::where('industry_group_id',6)->pluck('id')->toArray();
        $robotic = BusinessPlan::whereIn('company_id',$roboticarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $thisyear)->count();
        $aviationarr = Company::where('industry_group_id',7)->pluck('id')->toArray();
        $aviation = BusinessPlan::whereIn('company_id',$aviationarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $thisyear)->count();
        $biofuelarr = Company::where('industry_group_id',8)->pluck('id')->toArray();
        $biofuel = BusinessPlan::whereIn('company_id',$biofuelarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $thisyear)->count();
        $digitalarr = Company::where('industry_group_id',9)->pluck('id')->toArray();
        $digital = BusinessPlan::whereIn('company_id',$digitalarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $thisyear)->count();
        $medicalarr = Company::where('industry_group_id',10)->pluck('id')->toArray();
        $medical = BusinessPlan::whereIn('company_id',$medicalarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $thisyear)->count();
        $defensearr = Company::where('industry_group_id',11)->pluck('id')->toArray();
        $defense = BusinessPlan::whereIn('company_id',$defensearr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $thisyear)->count();
        $educationarr = Company::where('industry_group_id',12)->pluck('id')->toArray();
        $education = BusinessPlan::whereIn('company_id',$educationarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $thisyear)->count();
        $otherarr = Company::where('industry_group_id',13)->pluck('id')->toArray();
        $other = BusinessPlan::whereIn('company_id',$otherarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $thisyear)->count();

        $projectindustries = array("automotive" => $automotive, "smartelectronic" => $smartelectronic,"affluent" => $affluent,"agriculture" => $agriculture, "food" => $food,"robotic" => $robotic,"aviation" => $aviation, "biofuel" => $biofuel,"digital" => $digital,"medical" => $medical,"defense" => $defense,"education" => $education,"other" => $other);

        $financeojective = MiniTBP::where('minitbp_objecttive',1)->count();
        $nonefinanceojective = MiniTBP::where('minitbp_objecttive',2)->count();
        $bothojective = MiniTBP::where('minitbp_objecttive',3)->count();

        $objectives = array("finance" => $financeojective, "nonfinance" => $nonefinanceojective,"bothobjecttive" => $bothojective);

        return response()->json(array(
            "numprojects" => $numprojects,
            "projectgrades" => $projectgrades,
            "projectindustries" => $projectindustries,
            "objectives" => $objectives
        ));
    }
}
