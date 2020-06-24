<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FullTbpCompanyProfileDetail;

class FullTbpCompanyProfileController extends Controller
{
    public function CompanyprofileAdd(Request $request){
        FullTbpCompanyProfileDetail::where('full_tbp_id',$request->id)->delete(); 
        foreach($request->lines as $line){
            $fulltbpcompanyprofiledetail = new FullTbpCompanyProfileDetail();
            $fulltbpcompanyprofiledetail->full_tbp_id = $request->id;
            $fulltbpcompanyprofiledetail->line = $line;
            $fulltbpcompanyprofiledetail->save();
        }
        $fulltbpcompanyprofiledetail = FullTbpCompanyProfileDetail::where('full_tbp_id',$request->id)->first();
        return response()->json($fulltbpcompanyprofiledetail);  
    }
}
