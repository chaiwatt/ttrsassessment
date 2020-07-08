<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Model\FullTbpProjectTechDev;

class FullTbpProjectTechDevController extends Controller
{
    public function Add(Request $request){
        FullTbpProjectTechDev::where('full_tbp_id',$request->id)->delete(); 
        foreach($request->lines as $line){
            $fulltbpprojecttechdev = new FullTbpProjectTechDev();
            $fulltbpprojecttechdev->full_tbp_id = $request->id;
            $fulltbpprojecttechdev->line = $line;
            $fulltbpprojecttechdev->save();
        }
        $fulltbpprojecttechdev = FullTbpProjectTechDev::where('full_tbp_id',$request->id)->first();
        return response()->json($fulltbpprojecttechdev);  
    }
}
