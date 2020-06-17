<?php

namespace App\Http\Controllers;

use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use Illuminate\Http\Request;
use App\Model\FullTbpEmployee;
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

    public function Edit($id){
        $businesstypes = BusinessType::get();
        $fulltbp = FullTbp::find($id);
        $fulltbpemployee = FullTbpEmployee::where('full_tbp_id', $fulltbp->id)->first();
        return view('dashboard.company.fulltbp.edit')->withFulltbp($fulltbp)
                                                ->withFulltbpemployee($fulltbpemployee)
                                                ->withBusinesstypes($businesstypes);
    }

    public function EditSave(Request $request,$id){
        // return $request->department1_qty;
        FullTbpEmployee::find($id)->update([
            'department1_qty' => $request->department1_qty,
            'department2_qty' => $request->department2_qty,
            'department3_qty' => $request->department3_qty,
            'department4_qty' => $request->department4_qty,
            'department5_qty' => $request->department5_qty,
        ]); 
        return redirect()->back()->withSuccess('แก้ไข Full TBP สำเร็จ');
    }



}
