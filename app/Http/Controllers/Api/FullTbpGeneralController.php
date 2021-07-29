<?php

namespace App\Http\Controllers\Api;

use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Model\FullTbpEmployee;
use App\Model\FullTbpResearcher;
use App\Http\Controllers\Controller;
use App\Model\FullTbpResponsiblePerson;

class FullTbpGeneralController extends Controller
{
    public function Edit(Request $request){
        
        $fulltbp = FullTbp::find($request->id);
        FullTbpEmployee::where('full_tbp_id',$request->id)->first()->update([
            'department_qty' => $request->department_qty,
            'department1_qty' => $request->department1_qty,
            'department2_qty' => $request->department2_qty,
            'department3_qty' => $request->department3_qty,
            'department4_qty' => $request->department4_qty,
            'department5_qty' => $request->department5_qty
        ]); 
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        Company::find($businessplan->company_id)->update([
            'companyhistory' => $request->companyhistory,
            'business_type_id' => $request->businesstype
        ]);   
        $check = FullTbpResponsiblePerson::where('full_tbp_id',$request->id)->first();
        if(Empty($check)){
            $fulltbpresponsibleperson = new FullTbpResponsiblePerson();
            $fulltbpresponsibleperson->full_tbp_id = $request->id;
            $fulltbpresponsibleperson->prefix_id = $request->responsibleprefix;
            $fulltbpresponsibleperson->name = $request->responsiblename;
            $fulltbpresponsibleperson->lastname = $request->responsiblelastname;
            $fulltbpresponsibleperson->email = $request->responsibleemail;
            $fulltbpresponsibleperson->position = $request->responsibleposition;
            $fulltbpresponsibleperson->phone1 = $request->responsiblephone;
            $fulltbpresponsibleperson->phone2 = $request->responsibleworkphone;
            // $fulltbpresponsibleperson->educationhistory = $request->responsibleeducationhistory;
            // $fulltbpresponsibleperson->experiencehistory = $request->responsibleexperiencehistory;
            // $fulltbpresponsibleperson->traininghistory = $request->responsibletraininghistory;
            $fulltbpresponsibleperson->save();
        }else{
            FullTbpResponsiblePerson::where('full_tbp_id',$request->id)->first()->update([
                'prefix_id' => $request->responsibleprefix,
                'name' => $request->responsiblename,
                'lastname' => $request->responsiblelastname,
                'email' => $request->responsibleemail,
                'position' => $request->responsibleposition,
                'phone1' => $request->responsiblephone,
                'phone2' => $request->responsibleworkphone,
                // 'educationhistory' => $request->responsibleeducationhistory,
                // 'experiencehistory' => $request->responsibleexperiencehistory,
                // 'traininghistory' => $request->responsibletraininghistory,
            ]);
        }
    }

    public function AddResearcher(Request $request){
        $fulltbpresearcher = new FullTbpResearcher();
        $fulltbpresearcher->employtype = $request->employtype;
        $fulltbpresearcher->full_tbp_id = $request->id;
        $fulltbpresearcher->prefix_id = $request->researcherfix;
        $fulltbpresearcher->name = $request->researchername;
        $fulltbpresearcher->lastname = $request->researcherlastname;
        $fulltbpresearcher->education = $request->researchereducation;
        $fulltbpresearcher->experience = $request->researcherexperience;
        $fulltbpresearcher->training = $request->researchertraining;
        $fulltbpresearcher->save();
        $fulltbpresearchers = FullTbpResearcher::where('full_tbp_id',$request->id)->where('employtype',$request->employtype)->get();
        return response()->json($fulltbpresearchers);  
    }
    public function DeleteResearcher(Request $request){
        $fulltbpid = FullTbpResearcher::find($request->id)->full_tbp_id;
        FullTbpResearcher::find($request->id)->delete();
        $fulltbpresearchers = FullTbpResearcher::where('full_tbp_id',$fulltbpid)->where('employtype',$request->employtype)->get();
        return response()->json($fulltbpresearchers);  
    }
}
