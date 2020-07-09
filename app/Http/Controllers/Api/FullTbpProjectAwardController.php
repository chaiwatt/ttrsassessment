<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FullTbpProjectAwardAttachment;

class FullTbpProjectAwardController extends Controller
{
    public function Add(Request $request){
        $file = $request->file;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/fulltbp/project/award/attachment" , $new_name);
        $filelocation = "storage/uploads/fulltbp/project/award/attachment/".$new_name;
        $fulltbpprojectawardattachment = new FullTbpProjectAwardAttachment();
        $fulltbpprojectawardattachment->full_tbp_id = $request->id;
        $fulltbpprojectawardattachment->name = $request->awardname;
        $fulltbpprojectawardattachment->path = $filelocation;
        $fulltbpprojectawardattachment->save();
        $fulltbpprojectawardattachments = FullTbpProjectAwardAttachment::where('full_tbp_id',$request->id)->get();
        return response()->json($fulltbpprojectawardattachments); 
    }
    public function Delete(Request $request){
        $fulltbpprojectawardattachment = FullTbpProjectAwardAttachment::find($request->id);
        $fulltbpid = $fulltbpprojectawardattachment->full_tbp_id;
        @unlink($fulltbpprojectawardattachment->path);
        $fulltbpprojectawardattachment->delete();
        $fulltbpprojectawardattachments = FullTbpProjectAwardAttachment::where('full_tbp_id',$fulltbpid)->get();
        return response()->json($fulltbpprojectawardattachments); 
    }
}
