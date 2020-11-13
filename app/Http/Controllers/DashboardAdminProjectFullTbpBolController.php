<?php

namespace App\Http\Controllers;

use App\Model\Bol;
use App\Model\FullTbp;
use Illuminate\Http\Request;

class DashboardAdminProjectFullTbpBolController extends Controller
{
    public function Index($id){
        $fulltbp = FullTbp::find($id);
        $bols = Bol::where('full_tbp_id',$id)->get();
        return view('dashboard.admin.project.fulltbp.bol.index')->withBols($bols)->withFulltbp($fulltbp);
    }
}
