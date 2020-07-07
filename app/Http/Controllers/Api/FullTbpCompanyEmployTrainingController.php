<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\EmployTraining;
use App\Helper\DateConversion;
use App\Http\Controllers\Controller;

class FullTbpCompanyEmployTrainingController extends Controller
{
    public function Add(Request $request){
        $employtraining = new EmployTraining();
        $employtraining->company_employ_id = $request->id;
        $employtraining->trainingdate = DateConversion::thaiToEngDate($request->employtrainingdate);
        $employtraining->course = $request->employtrainingcourse;
        $employtraining->owner = $request->employtrainingowner;
        $employtraining->save();
        $employtrainings = EmployTraining::where('company_employ_id',$request->id)->get();
        return response()->json($employtrainings); 
    }
    public function Delete(Request $request){
        $employtraining = EmployTraining::find($request->id);
        $company_employ_id = $employtraining->company_employ_id;
        $employtraining->delete();
        $employtrainings = EmployTraining::where('company_employ_id',$company_employ_id)->get();
        return response()->json($employtrainings); 
    }
}
