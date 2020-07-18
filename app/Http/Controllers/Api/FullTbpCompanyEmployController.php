<?php

namespace App\Http\Controllers\Api;

use App\Model\Prefix;
use App\Model\Company;
use App\Model\CompanyEmploy;
use Illuminate\Http\Request;
use App\Model\EmployPosition;
use App\Model\EmployTraining;
use App\Model\EmployEducation;
use App\Model\EmployExperience;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FullTbpCompanyEmployController extends Controller
{
    public function Add(Request $request){      
        $company = Company::where('user_id',Auth::user()->id)->first();
        $check = CompanyEmploy::where('company_id',$company->id)->first();
        $companyemploy = new CompanyEmploy();
        $companyemploy->company_id = $company->id;
        $companyemploy->prefix_id = $request->prefix;
        $companyemploy->name = $request->name;
        $companyemploy->stockholder_id = '1';
        $companyemploy->lastname = $request->lastname;
        $companyemploy->employ_position_id = $request->position;
        $companyemploy->phone = $request->phone;
        $companyemploy->workphone = $request->workphone;
        $companyemploy->save();
        $companyemploys = CompanyEmploy::where('company_id',$company->id)->get();
        return response()->json($companyemploys); 
    }

    public function Get(Request $request){      
        $employ = CompanyEmploy::find($request->id);
        $prefixes = Prefix::get();
        $employpositions = EmployPosition::get();
        $employeducations = EmployEducation::where('company_employ_id',$request->id)->get();
        $employexperiences = EmployExperience::where('company_employ_id',$request->id)->get();
        $employtrainings = EmployTraining::where('company_employ_id',$request->id)->get();
        return response()->json(array(
            "employ" => $employ,
            "prefixes" => $prefixes,
            "employpositions" => $employpositions,
            "employeducations" => $employeducations,
            "employexperiences" => $employexperiences,
            "employtrainings" => $employtrainings
        )); 
    }

    public function Edit(Request $request){      
        CompanyEmploy::find($request->id)->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'employ_position_id' => $request->position,
            'phone' => $request->phone,
            'workphone' => $request->workphone,
        ]);
        $companyid = Company::find(CompanyEmploy::find($request->id)->company_id);
        $companyemploys = CompanyEmploy::where('company_id',$companyid->id)->get();
        return response()->json($companyemploys); 
    }

    public function GetList(Request $request){      
        $employs = CompanyEmploy::where('company_id',$request->companayid)->get();
        return response()->json($employs); 
    }

    public function Delete(Request $request){ 
        $companyid = Company::find(CompanyEmploy::find($request->id)->company_id);     
        CompanyEmploy::find($request->id)->delete();
        
        $companyemploys = CompanyEmploy::where('company_id',$companyid->id)->get();
        return response()->json($companyemploys); 

    }
}
