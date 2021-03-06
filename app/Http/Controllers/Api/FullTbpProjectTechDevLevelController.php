<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FullTbpProjectTechDevLevel;

class FullTbpProjectTechDevLevelController extends Controller
{
    public function Add(Request $request){
        $fulltbpprojecttechdevlevel = new FullTbpProjectTechDevLevel();
        $fulltbpprojecttechdevlevel->full_tbp_id = $request->id;
        $fulltbpprojecttechdevlevel->technology = $request->technology;
        $fulltbpprojecttechdevlevel->presenttechnology = $request->presenttechnology;
        $fulltbpprojecttechdevlevel->projecttechnology = $request->projecttechnology;
        $fulltbpprojecttechdevlevel->save();
        $fulltbpprojecttechdevlevels = FullTbpProjectTechDevLevel::where('full_tbp_id',$request->id)->get();
        return response()->json($fulltbpprojecttechdevlevels);  
    }

    public function Delete(Request $request){
        $fulltbpprojecttechdevlevel = FullTbpProjectTechDevLevel::find($request->id);
        $full_tbp_id = $fulltbpprojecttechdevlevel->full_tbp_id;
        $fulltbpprojecttechdevlevel->delete();
        $fulltbpprojecttechdevlevels = FullTbpProjectTechDevLevel::where('full_tbp_id',$full_tbp_id)->get();
        return response()->json($fulltbpprojecttechdevlevels);  
    }
}

