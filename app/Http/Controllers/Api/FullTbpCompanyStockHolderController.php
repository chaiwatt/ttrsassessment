<?php

namespace App\Http\Controllers\Api;

use App\Model\CompanyEmploy;
use Illuminate\Http\Request;
use App\Model\StockHolderEmploy;
use App\Http\Controllers\Controller;

class FullTbpCompanyStockHolderController extends Controller
{
    public function Add(Request $request){
        $companystockholder = new StockHolderEmploy();
        $companystockholder->company_id = $request->id;
        $companystockholder->name = $request->holdername;
        $companystockholder->ceorelation = $request->ceorelation;
        $companystockholder->save();
        $companystockholders = StockHolderEmploy::where('company_id',$request->id)->orderBy('id','desc')->get();
        return response()->json($companystockholders); 
    }
    public function Delete(Request $request){
        $companystockholder = StockHolderEmploy::find($request->id);
        $companyid= $companystockholder->company_id;
        $companystockholder->delete();
        $companystockholders = StockHolderEmploy::where('company_id',$companyid)->orderBy('id','desc')->get();
        return response()->json($companystockholders); 
    }
}
