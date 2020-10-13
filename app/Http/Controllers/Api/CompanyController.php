<?php

namespace App\Http\Controllers\Api;

use App\Model\Company;
use App\Model\IsicSub;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function GetSubisic(Request $request){
        $subisics = IsicSub::where('isic_id',$request->id)->get();
        $company = Company::where('user_id',Auth::user()->id)->first();
        // return response()->json($subisics);
        return response()->json(array(
            "subisics" => $subisics,
            "company" => $company
        ));
    }
}
