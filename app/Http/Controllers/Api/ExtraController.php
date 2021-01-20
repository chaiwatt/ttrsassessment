<?php

namespace App\Http\Controllers\Api;

use App\Model\ExtraCategory;
use App\Model\ExtraCriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ExtraCriteriaTransaction;

class ExtraController extends Controller
{
    public function GetExtraCategory(Request $request){
        $extracaterories = ExtraCategory::get();
        return response()->json($extracaterories); 
    }

    public function GetExtra(Request $request){
        $extracriterias = ExtraCriteria::where('extra_category_id',$request->id)->get();
        return response()->json($extracriterias); 
    }

    public function AddExtra(Request $request){
        $check = ExtraCriteriaTransaction::where('ev_id',$request->evid)
                            ->where('extra_category_id',$request->categoryid)
                            ->where('extra_criteria_id',$request->criteria)
                            ->first();
        if(Empty($check)){
            $extracriteriatransaction = new ExtraCriteriaTransaction();
            $extracriteriatransaction->ev_id=$request->evid;
            $extracriteriatransaction->extra_category_id=$request->categoryid;
            $extracriteriatransaction->extra_criteria_id=$request->criteria;
            $extracriteriatransaction->save();
        }     

        $extracriteriatransactions = ExtraCriteriaTransaction::where('ev_id',$request->evid)
                                                        ->orderBy('extra_category_id', 'asc')
                                                        ->orderBy('extra_criteria_id', 'asc')
                                                        ->get()
                                                        ->append('extracategory')
                                                        ->append('extracriteria');   
                                                            
        return response()->json($extracriteriatransactions); 
    }

    public function DeleteCategoryExtraTransaction(Request $request){
        ExtraCriteriaTransaction::where('ev_id',$request->evid)
                            ->where('extra_category_id',$request->categoryid)
                            ->delete();
  
        $extracriteriatransactions = ExtraCriteriaTransaction::where('ev_id',$request->evid)
                                                        ->orderBy('extra_category_id', 'asc')
                                                        ->orderBy('extra_criteria_id', 'asc')
                                                        ->get()
                                                        ->append('extracategory')
                                                        ->append('extracriteria');   
                                                            
        return response()->json($extracriteriatransactions); 
    }

    public function DeleteCriteriaExtraTransaction(Request $request){
        ExtraCriteriaTransaction::where('ev_id',$request->evid)
                            ->where('extra_category_id',$request->categoryid)
                            ->where('extra_criteria_id',$request->creteria)
                            ->delete();
  
        $extracriteriatransactions = ExtraCriteriaTransaction::where('ev_id',$request->evid)
                                                        ->orderBy('extra_category_id', 'asc')
                                                        ->orderBy('extra_criteria_id', 'asc')
                                                        ->get()
                                                        ->append('extracategory')
                                                        ->append('extracriteria');   
                                                            
        return response()->json($extracriteriatransactions); 
    }

    public function EditExtraWeight(Request $request){
        ExtraCriteriaTransaction::find($request->id)->update([
                                    'weight' => $request->weight
                                ]);
        
        $sumweigth = ExtraCriteriaTransaction::where('ev_id',$request->evid)->sum('weight');   
                                    
        return $sumweigth;                         
    }
}
