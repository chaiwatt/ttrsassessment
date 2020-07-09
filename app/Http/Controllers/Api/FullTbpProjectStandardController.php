<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FullTbpProjectStandard;

class FullTbpProjectStandardController extends Controller
{
    public function Add(Request $request){
        $file = $request->file;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/fulltbp/project/standard/attachment" , $new_name);
        $filelocation = "storage/uploads/fulltbp/project/standard/attachment/".$new_name;
        $fulltbpprojectstandard = new FullTbpProjectStandard();
        $fulltbpprojectstandard->full_tbp_id = $request->id;
        $fulltbpprojectstandard->name = $request->standardname;
        $fulltbpprojectstandard->path = $filelocation;
        $fulltbpprojectstandard->save();
        $fulltbpprojectstandards = FullTbpProjectStandard::where('full_tbp_id',$request->id)->get();
        return response()->json($fulltbpprojectstandards); 
    }

    public function Delete(Request $request){
        $fulltbpprojectstandard = FullTbpProjectStandard::find($request->id);
        $fulltbpid = $fulltbpprojectstandard->full_tbp_id;
        @unlink($fulltbpprojectstandard->path);
        $fulltbpprojectstandard->delete();
        $fulltbpprojectstandards = FullTbpProjectStandard::where('full_tbp_id',$fulltbpid)->get();
        return response()->json($fulltbpprojectstandards); 
    }
}
