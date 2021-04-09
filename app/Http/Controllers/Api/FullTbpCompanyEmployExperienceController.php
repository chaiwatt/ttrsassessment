<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\EmployExperience;
use App\Http\Controllers\Controller;

class FullTbpCompanyEmployExperienceController extends Controller
{
    public function Add(Request $request){
        $employexperience = new EmployExperience();
        $employexperience->company_employ_id = $request->id;
        $employexperience->company = $request->employexperiencecompany;
        $employexperience->businesstype = $request->employexperiencebusinesstype;
        $employexperience->startposition = $request->employexperiencestartposition;
        $employexperience->endposition = $request->employexperienceendposition;
        $employexperience->startdate = $request->employexperiencestartdate;
        $employexperience->enddate = $request->employexperienceenddate;
        $employexperience->save();
        $employexperiences = EmployExperience::where('company_employ_id',$request->id)->get();
        return response()->json($employexperiences); 
    }

    public function Delete(Request $request){
        $employexperience = EmployExperience::find($request->id);
        $company_employ_id = $employexperience->company_employ_id;
        $employexperience->delete();
        $employexperiences = EmployExperience::where('company_employ_id',$company_employ_id)->get();
        return response()->json($employexperiences); 
    }
}
