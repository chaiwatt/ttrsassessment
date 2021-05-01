<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Model\FullTbp;
use Illuminate\Http\Request;

class DashboardAdminProjectCancelController extends Controller
{
    public function Index(){
        $fulltbps = FullTbp::get();
        return view('dashboard.admin.project.projectcancel.projectcancel')->withFulltbps($fulltbps);
    }

    public function savecancel($id){
        FullTbp::find($id)->update([
            'canceldate' => Carbon::now()->toDateString()
        ]);
        return redirect()->back()->withSuccess('ยกเลิกโครงการสำเร็จ');
    }
}
