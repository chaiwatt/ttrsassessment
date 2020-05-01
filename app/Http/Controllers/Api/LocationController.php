<?php

namespace App\Http\Controllers\Api;

use App\Model\Amphur;
use App\Model\Tambol;
use App\Model\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function Province(Request $request){
        $provicnes = Province::get();
        return response()->json($provicnes);  
    }
    public function Amphur(Request $request){
        $amphurs = Amphur::where('province_id',$request->proviceid)->get();
        return response()->json($amphurs);  
    }
    public function Tambol(Request $request){
        $tambols = Tambol::where('amphur_id',$request->amphurid)
                        ->get();
        return response()->json($tambols);  
    }
}
