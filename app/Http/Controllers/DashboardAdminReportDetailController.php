<?php

namespace App\Http\Controllers;

use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\ProjectMember;
use App\Model\ProjectStatus;
use Illuminate\Http\Request;
use App\Helper\OnlyBelongPerson;
use App\Model\ProjectAssignment;
use Illuminate\Support\Facades\Auth;
use App\Model\ProjectStatusTransaction;
use Illuminate\Support\Facades\Session;

class DashboardAdminReportDetailController extends Controller
{
    public function __construct() 
    { 
        $this->middleware(['auth', 'verified']);
        $this->middleware('role:3,4,5,6'); 
    }
    public function View($id){
        $check = ProjectMember::where('user_id',Auth::user()->id)->first();
        $auth = Auth::user();
        $company = Company::find($id);
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
        $projectmembers = ProjectMember::where('full_tbp_id',$fulltbp->id)->get();
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $projectstatuses = ProjectStatus::where('mini_tbp_id',$minitbp->id)->get();
        $projectstatustransactions = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->get();

        if(OnlyBelongPerson::LeaderAndExpert($minitbp->id) == false){
            return view('dashboard.admin.report.detail.view')->withCompany($company)
                ->withProjectmembers($projectmembers)
                ->withProjectstatustransactions($projectstatustransactions)
                ->withProjectstatuses($projectstatuses)
                ->withProjectassignment($projectassignment);
        }else{
            Auth::logout();
            Session::flush();
            return redirect()->route('login');
        }

    }

}
