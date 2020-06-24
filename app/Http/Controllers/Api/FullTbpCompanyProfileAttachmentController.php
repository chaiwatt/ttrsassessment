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
        $fulltbpcompanyprofileattachment->name = $file->getClientOriginalName();;
        $fulltbpcompanyprofileattachment->path = $filelocation;
        $fulltbpcompanyprofileattachment->save();
        $fulltbpcompanyprofileattachments = FullTbpCompanyProfileAttachment::where('full_tbp_id',$request->id)->get();
        return response()->json($fulltbpcompanyprofileattachments); 
    }
}
