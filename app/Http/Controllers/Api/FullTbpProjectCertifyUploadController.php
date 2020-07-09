<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FullTbpProjectCertifyAttachment;

class FullTbpProjectCertifyUploadController extends Controller
{
    public function Add(Request $request){
        $file = $request->file;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/fulltbp/project/certify/attachment" , $new_name);
        $filelocation = "storage/uploads/fulltbp/project/certify/attachment/".$new_name;
        $fulltbpprojectcertifyattachment = new FullTbpProjectCertifyAttachment();
        $fulltbpprojectcertifyattachment->project_certify_id = $request->id;
        $fulltbpprojectcertifyattachment->name = $file->getClientOriginalName();;
        $fulltbpprojectcertifyattachment->path = $filelocation;
        $fulltbpprojectcertifyattachment->save();
        $fulltbpprojectcertifyattachments = FullTbpProjectCertifyAttachment::where('project_certify_id',$request->id)->get();
        return response()->json($fulltbpprojectcertifyattachments); 
    }
    public function Delete(Request $request){
        $fulltbpprojectcertifyattachment = FullTbpProjectCertifyAttachment::find($request->id);
        $projectcertifyid = $fulltbpprojectcertifyattachment->project_certify_id;
        @unlink($fulltbpprojectcertifyattachment->path);
        $fulltbpprojectcertifyattachment->delete();
        $fulltbpprojectcertifyattachments = FullTbpProjectCertifyAttachment::where('project_certify_id',$projectcertifyid)->get();
        return response()->json($fulltbpprojectcertifyattachments); 
    }
}
