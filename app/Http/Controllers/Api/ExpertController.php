<?php

namespace App\Http\Controllers\Api;

use App\Model\ExpertField;
use App\Model\ExpertDetail;
use Illuminate\Http\Request;
use App\Model\ExpertEducation;
use App\Model\ExpertExperience;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpertController extends Controller
{
    //
    public function DeleteExperience(Request $request){
        ExpertExperience::find($request->id)->delete();
        $expertexperiences = ExpertExperience::get();
        return response()->json($expertexperiences);  
    }

    public function DeleteEducation(Request $request){
        ExpertEducation::find($request->id)->delete();
        $experteducations = ExpertEducation::get();
        return response()->json($experteducations);  
    }
    public function AddExpertField(Request $request){
        $auth = Auth::user();
        $expertfield = new ExpertField();
        $expertfield->user_id = $auth->id;
        $expertfield->order = $request->expertfieldnum;
        $expertfield->detail = $request->expertfielddetail;
        $expertfield->save();
        $expertfields = ExpertField::where('user_id',$auth->id)->get();
        return response()->json($expertfields);  
    }
    public function DeleteExpertField(Request $request){
        $expertdetail = ExpertField::find($request->id)->delete();
        $expertfields = ExpertField::where('user_id',Auth::user()->id)->get();
        return response()->json($expertfields);  
    }
    
}
