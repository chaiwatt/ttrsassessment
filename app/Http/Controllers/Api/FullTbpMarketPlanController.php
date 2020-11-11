<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\FullTbpMarketSwot;
use App\Http\Controllers\Controller;
use App\Model\FullTbpMarketAnalysis;
use App\Model\FullTbpMarketBusinessModelCanvas;

class FullTbpMarketPlanController extends Controller
{
    public function Edit(Request $request){
        $check = FullTbpMarketAnalysis::where('full_tbp_id',$request->id)->first();
        if(Empty($check)){
            $fulltbpmarketanalysis = new FullTbpMarketAnalysis();
            $fulltbpmarketanalysis->full_tbp_id = $request->id;
            $fulltbpmarketanalysis->detail = $request->analysis;
            $fulltbpmarketanalysis->save();
        }else{
            $check->update([
                'detail' => $request->analysis
            ]);
        }
        $check = FullTbpMarketBusinessModelCanvas::where('full_tbp_id',$request->id)->first();
        if(Empty($check)){
            $fulltbpmarketbusinessmodelcanvas = new FullTbpMarketBusinessModelCanvas();
            $fulltbpmarketbusinessmodelcanvas->full_tbp_id = $request->id;
            $fulltbpmarketbusinessmodelcanvas->detail = $request->modelcanvas;
            $fulltbpmarketbusinessmodelcanvas->save();
        }else{
            $check->update([
                'detail' => $request->modelcanvas
            ]);
        }
        $check = FullTbpMarketSwot::where('full_tbp_id',$request->id)->first();
        if(Empty($check)){
            $fulltbpmarketswot = new FullTbpMarketSwot();
            $fulltbpmarketswot->full_tbp_id = $request->id;
            $fulltbpmarketswot->detail = $request->swot;
            $fulltbpmarketswot->save();
        }else{
            $check->update([
                'detail' => $request->swot
            ]);
        }
    }
}
