<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FullTbpMarketAttachment;

class FullTbpMarketAttachmentController extends Controller
{
    public function Add(Request $request){
        $file = $request->file;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/fulltbp/market/attachment" , $new_name);
        $filelocation = "storage/uploads/fulltbp/market/attachment/".$new_name;
        $fullTbpmarketattachment = new FullTbpMarketAttachment();
        $fullTbpmarketattachment->attachmenttype = $request->attachmenttype;
        $fullTbpmarketattachment->full_tbp_id = $request->id;
        $fullTbpmarketattachment->name = $request->docname;
        $fullTbpmarketattachment->path = $filelocation;
        $fullTbpmarketattachment->save();
        $fullTbpmarketattachments = FullTbpMarketAttachment::where('full_tbp_id',$request->id)
                                                        ->where('attachmenttype',$request->attachmenttype)->get();
        return response()->json($fullTbpmarketattachments); 
    }
    public function Delete(Request $request){
        $fullTbpmarketattachment = FullTbpMarketAttachment::find($request->id);
        $fulltbpid = $fullTbpmarketattachment->full_tbp_id;
        @unlink($fullTbpmarketattachment->path);
        $fullTbpmarketattachment->delete();
        $fullTbpmarketattachments = FullTbpMarketAttachment::where('full_tbp_id',$fulltbpid)
                                                        ->where('attachmenttype',$request->attachmenttype)->get();
        return response()->json($fullTbpmarketattachments); 
    }
}
