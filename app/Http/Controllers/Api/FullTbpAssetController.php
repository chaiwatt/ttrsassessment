<?php

namespace App\Http\Controllers\Api;

use App\Model\FullTbpAsset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FullTbpAssetController extends Controller
{
    public function Get(Request $request){
        $fulltbpasset = FullTbpAsset::find($request->id);
        return response()->json($fulltbpasset); 
    }

    public function Edit(Request $request){
        $fulltbpasset = FullTbpAsset::find($request->id);
        $fulltbpid = $fulltbpasset->full_tbp_id;
        $fulltbpasset->update([
            'cost' => str_replace(',', '', $request->assetcostedit),
            'quantity' => $request->assetquantityedit,
            'price' => str_replace(',', '', $request->assetpriceedit),
            'specification' => $request->assetspecificationedit,
        ]);
        $fulltbpassets = FullTbpAsset::where('full_tbp_id',$fulltbpid)->get();
        return response()->json($fulltbpassets); 
    }
}
