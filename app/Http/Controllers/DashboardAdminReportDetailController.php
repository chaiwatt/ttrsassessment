<?php

namespace App\Http\Controllers;

use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAdminReportDetailController extends Controller
{
    // public function __construct() 
    // { 
    //     $this->middleware(['auth', 'verified']);
    //     $this->middleware('role:3,4,5,6'); 
    // }
    public function View($id){
        $check = ProjectMember::where('user_id',Auth::user()->id)->first();
        // return  $check ;
        if(Empty($check)){
            return redirect()->back();
        }
        $auth = Auth::user();
        $company = Company::find($id);
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
        $projectmembers = ProjectMember::where('full_tbp_id',$fulltbp->id)->get();
        return view('dashboard.admin.report.detail.view')->withCompany($company)
                                                        ->withProjectmembers($projectmembers);
    }
}
