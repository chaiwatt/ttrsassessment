<?php

namespace App\Http\Controllers\Api;

use App\Model\CompanyEmploy;
use Illuminate\Http\Request;
use App\Model\CompanyStockHolder;
use App\Http\Controllers\Controller;

class FullTbpCompanyStockHolderController extends Controller
{
    public function Add(Request $request){
        $companyid= CompanyEmploy::find($request->id)->company_id;
        $companystockholder = new CompanyStockHolder();
        $companystockholder->company_id = $companyid;
        $companystockholder->company_employ_id = $request->id;
        $companystockholder->relationwithceo = $request->ceorelation;
        $companystockholder->save();
        $companystockholders = CompanyStockHolder::where('company_id',$companyid)->get();
        return response()->json($companystockholders); 
    }
    public function Delete(Request $request){
        $companystockholder = CompanyStockHolder::find($request->id);
        $companyid= $companystockholder->company_id;
        $companystockholder->delete();
        $companystockholders = CompanyStockHolder::where('company_id',$companyid)->get();
        return response()->json($companystockholders); 
    }
}
