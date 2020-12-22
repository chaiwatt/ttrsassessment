<?php

namespace App\Http\Controllers\Api;

use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\ProjectGrade;
use Illuminate\Http\Request;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use App\Http\Controllers\Controller;

class SearchProjectController extends Controller
{
    public function Year(Request $request){
        $fulltbps = FullTbp::whereYear('created_at', ($request->year-543))->get();
        return response()->json($fulltbps);  
    }

    public function ProjectName(Request $request){
        $minitbpids = MiniTBP::where('project', 'like', '%' . $request->projectname . '%')
                    ->orWhere('projecteng', 'like', '%' . $request->projectname . '%')->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        return response()->json($fulltbps); 
    }

    public function CompanyName(Request $request){
        $companyids = Company::where('name', 'like', '%' . $request->companyname . '%')->pluck('id')->toArray();
        $businessplanids = BusinessPlan::whereIn('company_id', $companyids)->pluck('id')->toArray();
        $minitbpids = MiniTBP::whereIn('business_plan_id', $businessplanids)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        return response()->json($fulltbps); 
    }

    public function DocNo(Request $request){
        $minitbpids = MiniTBP::where('minitbp_code', 'like', '%' . $request->docno . '%')->pluck('id')->toArray();
        $fulltbpids1 = FullTbp::whereIn('mini_tbp_id', $minitbpids)->pluck('id')->toArray();
        $fulltbpids2 = FullTbp::where('fulltbp_code', 'like', '%' . $request->docno . '%')->pluck('id')->toArray();
        $fulltbpiduniques = array_unique(array_merge($fulltbpids1,$fulltbpids2));
        $fulltbps = FullTbp::whereIn('id', $fulltbpiduniques)->get();
        return response()->json($fulltbps); 
    }

    public function Isic(Request $request){
        $companyids = Company::where('isic_id', $request->isic)->where('isic_sub_id', $request->subisic)->pluck('id')->toArray();
        $businessplanids = BusinessPlan::whereIn('company_id', $companyids)->pluck('id')->toArray();
        $minitbpids = MiniTBP::whereIn('business_plan_id', $businessplanids)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        return response()->json($fulltbps); 
    }

    public function IndustryGroup(Request $request){
        $companyids = Company::where('industry_group_id', $request->industrygroup)->pluck('id')->toArray();
        $businessplanids = BusinessPlan::whereIn('company_id', $companyids)->pluck('id')->toArray();
        $minitbpids = MiniTBP::whereIn('business_plan_id', $businessplanids)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        return response()->json($fulltbps); 
    }

    public function Leader(Request $request){
        $projectassignmentids = ProjectAssignment::where('leader_id', $request->leader)->pluck('business_plan_id')->toArray();
        $businessplanuniqueids = array_unique($projectassignmentids);
        $businessplanids = BusinessPlan::whereIn('id', $businessplanuniqueids)->pluck('id')->toArray();
        $minitbpids = MiniTBP::whereIn('business_plan_id', $businessplanids)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        return response()->json($fulltbps); 
    }
    
    public function Expert(Request $request){
        $expertassignmentids = ExpertAssignment::where('user_id', $request->expert)->pluck('full_tbp_id')->toArray();
        $fulltbpuniqueids = array_unique($expertassignmentids);
        $fulltbps = FullTbp::whereIn('id', $fulltbpuniqueids)->get();
        return response()->json($fulltbps); 
    }

    public function Grade(Request $request){
        $projectgradeids = ProjectGrade::where('grade', $request->grade)->pluck('full_tbp_id')->toArray();
        $fulltbpuniqueids = array_unique($projectgradeids);
        $fulltbps = FullTbp::whereIn('id', $fulltbpuniqueids)->get();
        return response()->json($fulltbps); 
    }
    public function RegisteredCapital(Request $request){
        $companyids = Company::where('registeredcapitaltype', $request->registeredcapital)->pluck('id')->toArray();
        $businessplanids = BusinessPlan::whereIn('company_id', $companyids)->pluck('id')->toArray();
        $minitbpids = MiniTBP::whereIn('business_plan_id', $businessplanids)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        return response()->json($fulltbps); 
    }
    
}
