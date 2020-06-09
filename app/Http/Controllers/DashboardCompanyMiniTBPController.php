<?php

namespace App\Http\Controllers;

use App\Model\Company;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardCompanyMiniTBPController extends Controller
{
    public function Edit(){
     $company = Company::where('user_id',Auth::user()->id)->first();
     $businessplan = BusinessPlan::where('company_id',$company->id)->first();
     $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
     return view('dashboard.company.minitbp.edit')->withMinitbp($minitbp);
    }
}
