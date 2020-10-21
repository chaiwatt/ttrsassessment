<?php

namespace App\Http\Controllers;

use App\Model\Amphur;
use App\Model\Tambol;
use App\Model\Company;
use App\Model\Province;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use App\Model\IndustryGroup;
use Illuminate\Http\Request;
use App\Model\NotificationBubble;
// use App\Model\RegisteredCapitalType;
use Illuminate\Support\Facades\Auth;

class DashboardAdminProjectBusinessPlanController extends Controller
{
    public function Index(){
        NotificationBubble::where('target_user_id',Auth::user()->id)
                        ->where('notification_category_id',1)
                        ->where('notification_sub_category_id',2)
                        ->where('status',0)->delete();
        $businessplans = BusinessPlan::where('business_plan_active_status_id',1)
                                        ->where('business_plan_status_id',1)->get();
        return view('dashboard.admin.project.businessplan.index')->withBusinessplans($businessplans);
    }
    public function View($id){
        $businessplan = BusinessPlan::find($id);
        $company = Company::find($businessplan->company_id);
        // $registeredcapitaltypes = RegisteredCapitalType::get();
        $industrygroups = IndustryGroup::get();
        $businesstypes = BusinessType::get();
        $provinces = Province::get();
        $amphurs = Amphur::where('province_id',$company->province_id)->get();
        $tambols = Tambol::where('amphur_id',$company->amphur_id)->get();
        return view('dashboard.admin.project.businessplan.view')->withCompany($company)
                                        // ->withRegisteredcapitaltypes($registeredcapitaltypes)
                                        ->withIndustrygroups($industrygroups)
                                        ->withBusinesstypes($businesstypes)
                                        ->withAmphurs($amphurs)
                                        ->withTambols($tambols)
                                        ->withProvinces($provinces)
                                        ->withCompany($company);
    }
    public function Delete($id){
        BusinessPlan::find($id)->delete();
        return redirect()->back()->withSuccess('ลบโครงการสำเร็จ');
    }
}

