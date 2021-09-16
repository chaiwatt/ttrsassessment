<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Isic;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\IndustryGroup;
use Illuminate\Http\Request;
use App\Model\RegisteredCapitalType;

class DashboardAdminSearchCompanyController extends Controller
{
    public function Index(){

        $industrygroups = IndustryGroup::get();
        $isics = Isic::get();
        $registeredcapitals = RegisteredCapitalType::get();
        $userarr = User::where('user_type_id',1)->pluck('id')->toArray();
        $companies = Company::whereIn('user_id',$userarr)->get();
        return view('dashboard.admin.search.company.index')->withIndustrygroups($industrygroups)
                                                        ->withIsics($isics)
                                                        ->withRegisteredcapitals($registeredcapitals)
                                                        ->withCompanies($companies);
    }

    public function Search(Request $request){
        $industrygroups = IndustryGroup::get();
        $isics = Isic::get();
        $registeredcapitals = RegisteredCapitalType::get();
        $userarr = User::where('user_type_id',1)->pluck('id')->toArray();
        
        if($request->searchgroup == 0){
            $companies = Company::whereIn('user_id',$userarr)->get();
        }
        if($request->searchgroup == 1){
            $companies = Company::whereIn('user_id',$userarr)->get();
        }
        return view('dashboard.admin.search.company.index')->withIndustrygroups($industrygroups)
                                                            ->withIsics($isics)
                                                            ->withRegisteredcapitals($registeredcapitals)
                                                            ->withCompanies($companies);
    }
}

// public function getprojectleadbystatus(Request $request){
//     $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
//     $leaders = User::whereIn('id',$leaderarray)->get();
//     $businessplanstatuses = BusinessPlanStatus::get();


//     if($request->btnsubmit == 'excel'){
//         return Excel::download(new ReportProjectExportLeaderByBusinessPlanStatus($request->leader,$request->businessplanstatus), 'โครงการของ Lead แยกตามสถานะของการประเมิน Lead.xlsx');
//     }else if($request->btnsubmit == 'search'){
//         if($request->leader ==0 && $request->businessplanstatus == 0){
//             $fulltbparray = ProjectAssignment::pluck('full_tbp_id')->toArray();
//             $fulltbps1 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();
            
//             $businessplanarray = BusinessPlan::pluck('id')->toArray();
//             $minitbparray = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
//             $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
//             $intersec = array();
//             foreach($fulltbps1 as $f1) {
//                 if (in_array($f1,$fulltbps2)) {
//                     array_push($intersec,$f1);
//                 } 
//             }
//             $fulltbps = FullTbp::whereIn('id', $intersec)->get();
//         }else if($request->leader !=0 && $request->businessplanstatus != 0){
//             $fulltbparray = ProjectAssignment::where('leader_id',$request->leader)->pluck('full_tbp_id')->toArray();
//             $fulltbps1 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();
            
//             $businessplanarray = BusinessPlan::where('business_plan_status_id',$request->businessplanstatus)->pluck('id')->toArray();
//             $minitbparray = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
//             $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
//             $intersec = array();
//             foreach($fulltbps1 as $f1) {
//                 if (in_array($f1,$fulltbps2)) {
//                     array_push($intersec,$f1);
//                 } 
//             }

//             $fulltbps = FullTbp::whereIn('id', $intersec)->get();

//         }else if($request->leader ==0 && $request->businessplanstatus != 0){

//             $fulltbparray = ProjectAssignment::pluck('full_tbp_id')->toArray();
//             $fulltbps1 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();
            
//             $businessplanarray = BusinessPlan::where('business_plan_status_id',$request->businessplanstatus)->pluck('id')->toArray();
//             $minitbparray = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
//             $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
//             $intersec = array();
//             foreach($fulltbps1 as $f1) {
//                 if (in_array($f1,$fulltbps2)) {
//                     array_push($intersec,$f1);
//                 } 
//             }
//             $fulltbps = FullTbp::whereIn('id', $intersec)->get();
//         }else if($request->leader !=0 && $request->businessplanstatus == 0){
//             $fulltbparray = ProjectAssignment::where('leader_id',$request->leader)->pluck('full_tbp_id')->toArray();
//             $fulltbps1 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();
            
//             $businessplanarray = BusinessPlan::pluck('id')->toArray();
//             $minitbparray = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
//             $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
//             $intersec = array();
//             foreach($fulltbps1 as $f1) {
//                 if (in_array($f1,$fulltbps2)) {
//                     array_push($intersec,$f1);
//                 } 
//             }
//             $fulltbps = FullTbp::whereIn('id', $intersec)->get();
//         }
       
//         return view('dashboard.admin.realtimereport.project.projectleadbystatus')->withLeaders($leaders)
//                                                                             ->withBusinessplanstatuses($businessplanstatuses)
//                                                                             ->withFulltbps($fulltbps); 
//     }
// }

