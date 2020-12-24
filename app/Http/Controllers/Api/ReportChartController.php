<?php

namespace App\Http\Controllers\Api;

use App\Model\FullTbp;
use App\Model\MiniTBP;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportChartController extends Controller
{
    public function GetProject(Request $request){
        $minitbps = MiniTBP::get();
        $fulltbps = FullTbp::get();
        $completes = FullTbp::where('status',3)->get();
        return response()->json(array(
            "minitbps" => $minitbps,
            "fulltbps" => $fulltbps,
            "completes" => $completes
        ));
    }
}
