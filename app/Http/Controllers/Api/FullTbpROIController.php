<?php

namespace App\Http\Controllers\Api;

use App\Model\CompanyEmploy;
use Illuminate\Http\Request;
use App\Model\FullTbpSignature;
use App\Http\Controllers\Controller;
use App\Model\FullTbpReturnOfInvestment;

class FullTbpROIController extends Controller
{
    public function Edit(Request $request){

        $fulltbpreturnofinvestment = FullTbpReturnOfInvestment::find($request->id);
        $fulltbpid = $fulltbpreturnofinvestment->full_tbp_id;
        $fulltbpreturnofinvestment->update([
            'income' => str_replace(',', '', $request->income),
            'profit' => str_replace(',', '', $request->profit),
            'reduce' => str_replace(',', '', $request->reduce)
        ]);

        if(count(json_decode($request->directors)) > 0){
            FullTbpSignature::where('full_tbp_id',$fulltbpid)->delete();
            foreach (json_decode($request->directors) as $value) {
                $check = CompanyEmploy::find($value);
                $fulltbpsignature = new FullTbpSignature();
                $fulltbpsignature->full_tbp_id = $fulltbpid;
                $fulltbpsignature->employ_position_id = $check->employ_position_id;
                $fulltbpsignature->company_employee_id = $value;
                $fulltbpsignature->save();
            }
        }

        $fulltbpreturnofinvestment = FullTbpReturnOfInvestment::where('full_tbp_id',$fulltbpid)->first();
        return response()->json($fulltbpreturnofinvestment); 
    }
}
