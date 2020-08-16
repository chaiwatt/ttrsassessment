<?php

namespace App\Http\Controllers\Api;

use App\Model\ExtraFactor;
use Illuminate\Http\Request;
use App\Model\SubExtraFactor;
use App\Http\Controllers\Controller;

class AssessmentSubExtrafactorController extends Controller
{
    public function Get(Request $request){
        $subextrafactors = SubExtraFactor::where('extra_factor_id',$request->extrafactorid)->get();
        $extrafactor = ExtraFactor::find($request->extrafactorid);

        return response()->json(array(
            "extrafactor" => $extrafactor,
            "subextrafactors" => $subextrafactors
        ));

    }
}
