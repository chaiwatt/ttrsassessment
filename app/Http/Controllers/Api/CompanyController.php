<?php

namespace App\Http\Controllers\Api;

use App\Model\Company;
use App\Model\IsicSub;
use Illuminate\Http\Request;
use App\Model\AuthorizedDirector;
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

    public function AddAuthorizedDirector(Request $request){
        $authorizeddirector = new AuthorizedDirector();
        $authorizeddirector->company_id = $request->id;
        $authorizeddirector->prefix_id = $request->prefix;
        $authorizeddirector->name = $request->name;
        $authorizeddirector->lastname = $request->lastname;
        $authorizeddirector->save();
        $authorizeddirectors = AuthorizedDirector::where('company_id',$request->id)->get();
        return response()->json($authorizeddirectors);
    }
    public function DeleteAuthorizedDirector(Request $request){
        $companyid = AuthorizedDirector::find($request->id)->company_id;
        AuthorizedDirector::find($request->id)->delete();
        $authorizeddirectors = AuthorizedDirector::where('company_id',$companyid)->get();
        return response()->json($authorizeddirectors);
    }
}

