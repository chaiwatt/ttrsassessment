<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\ExpertEducation;
use App\Model\ExpertExperience;
use App\Http\Controllers\Controller;

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
}
