<?php

namespace App\Http\Controllers\Api;

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
        $fulltbpcompanydoc = new FullTbpCompanyDoc();
        $fulltbpcompanydoc->full_tbp_id = $request->id;
        $fulltbpcompanydoc->name = $request->companydocname;
        $fulltbpcompanydoc->path = $filelocation;
        $fulltbpcompanydoc->save();
        $fulltbpcompanydocs = FullTbpCompanyDoc::where('full_tbp_id',$request->id)->get();
        return response()->json($fulltbpcompanydocs); 
    }
    public function Delete(Request $request){
        $fulltbpcompanydoc = FullTbpCompanyDoc::find($request->id);
        $fulltbpid = $fulltbpcompanydoc->full_tbp_id;
        @unlink($fulltbpcompanydoc->path);
        $fulltbpcompanydoc->delete();
        $fulltbpcompanydocs = FullTbpCompanyDoc::where('full_tbp_id',$fulltbpid)->get();
        return response()->json($fulltbpcompanydocs); 
    }
}
