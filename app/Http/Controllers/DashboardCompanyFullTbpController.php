<?php

namespace App\Http\Controllers;

use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardCompanyFullTbpController extends Controller
{
    public function Index(){
        $companyinfo = collect();
        $company = Company::where('user_id',Auth::user()->id)->first();
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $fulltpbs = FullTbp::where('mini_tbp_id',$minitbp->id)->get();
        return view('dashboard.company.fulltbp.index')->withFulltbps($fulltpbs);
    }
}
