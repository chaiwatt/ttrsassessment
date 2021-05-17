<?php

namespace App\Http\Controllers\Api;

use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Model\FullTbpCompanyDoc;
use App\Http\Controllers\Controller;

class FullTbpCompanyDocController extends Controller
{
    public function Add(Request $request){
        $file = $request->file;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/fulltbp/companydoc/attachment" , $new_name);
        $filelocation = "storage/uploads/fulltbp/companydoc/attachment/".$new_name;
        // $fulltbp = FullTbp::find($request->id);
        // $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        // $buninessplan = BusinessPlan::find($minitbp->business_plan_id);
        $fulltbpcompanydoc = new FullTbpCompanyDoc();
        $fulltbpcompanydoc->company_id = $request->id;
        $fulltbpcompanydoc->name = $file->getClientOriginalName();
        $fulltbpcompanydoc->path = $filelocation;
        $fulltbpcompanydoc->save();
        $fulltbpcompanydocs = FullTbpCompanyDoc::where('company_id',$request->id)->get();
        return response()->json($fulltbpcompanydocs); 
    }
    public function Delete(Request $request){
        $fulltbpcompanydoc = FullTbpCompanyDoc::find($request->id);
        $companyid = $fulltbpcompanydoc->company_id;
        @unlink($fulltbpcompanydoc->path);
        $fulltbpcompanydoc->delete();
        $fulltbpcompanydocs = FullTbpCompanyDoc::where('company_id',$companyid)->get();
        return response()->json($fulltbpcompanydocs); 
    }
}
