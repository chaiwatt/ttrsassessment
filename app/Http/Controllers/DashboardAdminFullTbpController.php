<?php

namespace App\Http\Controllers;

use App\Model\FullTbp;
use Illuminate\Http\Request;

class DashboardAdminFullTbpController extends Controller
{
    public function Index(){
        $fulltbps = FullTbp::where('status',2)->get();
        return view('dashboard.admin.fulltbp.index')->withFulltbps($fulltbps) ;
    }
}
