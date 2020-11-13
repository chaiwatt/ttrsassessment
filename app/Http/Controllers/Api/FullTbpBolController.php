<?php

namespace App\Http\Controllers\Api;

use App\Model\Bol;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FullTbpBolController extends Controller
{
    public function Add(Request $request){
        $file = $request->file;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/fulltbp/bol/attachment" , $new_name);
        $filelocation = "storage/uploads/fulltbp/bol/attachment/".$new_name;
        $bol = new Bol();
        $bol->full_tbp_id = $request->id;
        $bol->name = $request->docname;
        $bol->path = $filelocation;
        $bol->save();
        $bols = Bol::where('full_tbp_id',$request->id)->get();
        return response()->json($bols); 
    }
    public function Delete(Request $request){
        $bol = Bol::find($request->id);
        $fulltbpid = $bol->full_tbp_id;
        @unlink($bol->path);
        $bol->delete();
        $bols = Bol::where('full_tbp_id',$fulltbpid)->get();
        return response()->json($bols); 
    }
}
