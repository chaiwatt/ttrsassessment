<?php

namespace App\Http\Controllers\Api;

use App\Model\Prefix;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\CompanyEmploy;
use Illuminate\Http\Request;
use App\Model\EmployPosition;
use App\Model\EmployTraining;
use App\Model\EmployEducation;
use App\Model\EmployExperience;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\FullTbpBoardAttachment;

class FullTbpCompanyEmployController extends Controller
{
    public function Add(Request $request){      
        $company = Company::where('user_id',Auth::user()->id)->first();
        $check = CompanyEmploy::where('company_id',$company->id)->first();
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $fulltpb = FullTbp::where('mini_tbp_id',$minitbp->id)->first();   
        $companyemploy = new CompanyEmploy();
        $companyemploy->full_tbp_id = $fulltpb->id;
        $companyemploy->company_id = $company->id;
        $companyemploy->prefix_id = $request->prefix;
        $companyemploy->name = $request->name;
        $companyemploy->stockholder_id = '1';
        $companyemploy->lastname = $request->lastname;
        $companyemploy->employ_position_id = $request->position;
        $companyemploy->phone = $request->phone;
        $companyemploy->workphone = $request->workphone;
        $companyemploy->email = $request->email;
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
        $fullTbpboardattachments = FullTbpBoardAttachment::where('company_employ_id',$request->id)->get();
        return response()->json(array(
            "employ" => $employ,
            "prefixes" => $prefixes,
            "employpositions" => $employpositions,
            "employeducations" => $employeducations,
            "employexperiences" => $employexperiences,
            "employtrainings" => $employtrainings,
            "fullTbpboardattachments" => $fullTbpboardattachments
        )); 
    }

    public function GetPosition(Request $request){      
        $employpositions = EmployPosition::get();
        return response()->json($employpositions); 
    }

    public function Edit(Request $request){      
        CompanyEmploy::find($request->id)->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'employ_position_id' => $request->position,
            'phone' => $request->phone,
            'workphone' => $request->workphone,
            'email' => $request->email
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
    
    public function GetBoardAttachment(Request $request){ 
        $fullTbpboardattachments = FullTbpBoardAttachment::where('company_employ_id',$request->id)->get();
        return response()->json($fullTbpboardattachments); 
    }
    public function AddBoardAttachment(Request $request){ 
        $file = $request->file;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/fulltbp/board/attachment" , $new_name);
        $filelocation = "storage/uploads/fulltbp/board/attachment/".$new_name;
        $fulltbpboardattachment = new FullTbpBoardAttachment();
        $fulltbpboardattachment->company_employ_id = $request->id;
        $fulltbpboardattachment->name = $file->getClientOriginalName();;
        $fulltbpboardattachment->path = $filelocation;
        $fulltbpboardattachment->save();
        $fullTbpboardattachments = FullTbpBoardAttachment::where('company_employ_id',$request->id)->get();
        return response()->json($fullTbpboardattachments); 
    }

    public function DeleteBoardAttachment(Request $request){ 
        $fulltbpboardattachment = FullTbpBoardAttachment::find($request->id);
        if(!Empty($fulltbpboardattachment->path)){
            @unlink($fulltbpboardattachment->path);
        }
        $companyemployid = $fulltbpboardattachment->company_employ_id;
        FullTbpBoardAttachment::find($request->id)->delete();
        $fullTbpboardattachments = FullTbpBoardAttachment::where('company_employ_id',$companyemployid)->get();
        return response()->json($fullTbpboardattachments); 
    }
    
}
