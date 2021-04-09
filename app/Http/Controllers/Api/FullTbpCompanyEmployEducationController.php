<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\EducationLevel;
use App\Model\EmployEducation;
use App\Http\Controllers\Controller;

class FullTbpCompanyEmployEducationController extends Controller
{
    public function Add(Request $request){
        $educationlevel = EducationLevel::find($request->employeducationlevel)->name;
        $employeducation = new EmployEducation();
        $employeducation->company_employ_id = $request->id;
        $employeducation->employeducationlevel =  $educationlevel;
        $employeducation->otheremployeducationlevel = $request->othereducationlevel ;
        $employeducation->employeducationinstitute = $request->employeducationinstitute;
        $employeducation->employeducationmajor = $request->employeducationmajor;
        $employeducation->employeducationyear = $request->employeducationyear;
        $employeducation->save();
        $employeducations = EmployEducation::where('company_employ_id',$request->id)->get();
        return response()->json($employeducations); 
    }
    public function Delete(Request $request){
        $employeducation = EmployEducation::find($request->id);
        $company_employ_id = $employeducation->company_employ_id;
        $employeducation->delete();
        $employeducations = EmployEducation::where('company_employ_id',$company_employ_id)->get();
        return response()->json($employeducations); 
    }
}
