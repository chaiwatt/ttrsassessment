<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FullTbpCompanyProfileAttachment;

class FullTbpCompanyProfileAttachmentController extends Controller
{
    public function Add(Request $request){
        $file = $request->file;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/fulltbp/companyprofile/attachment" , $new_name);
        $filelocation = "storage/uploads/fulltbp/companyprofile/attachment/".$new_name;
        $fulltbpcompanyprofileattachment = new FullTbpCompanyProfileAttachment();
        $fulltbpcompanyprofileattachment->full_tbp_id = $request->id;
        $fulltbpcompanyprofileattachment->name = $request->companydocname;
        $fulltbpcompanyprofileattachment->path = $filelocation;
        $fulltbpcompanyprofileattachment->save();
        $fulltbpcompanyprofileattachments = FullTbpCompanyProfileAttachment::where('full_tbp_id',$request->id)->orderBy('id','desc')->get();
        return response()->json($fulltbpcompanyprofileattachments); 
    }
    public function Delete(Request $request){
        
        $fulltbpcompanyprofileattachment = FullTbpCompanyProfileAttachment::find($request->id);
        $fulltbpid = $fulltbpcompanyprofileattachment->full_tbp_id;
        @unlink($fulltbpcompanyprofileattachment->path);
        $fulltbpcompanyprofileattachment->delete();
        $fulltbpcompanyprofileattachments = FullTbpCompanyProfileAttachment::where('full_tbp_id',$fulltbpid)->orderBy('id','desc')->get();
        return response()->json($fulltbpcompanyprofileattachments); 
    }
}
