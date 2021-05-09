<?php

namespace App\Http\Controllers;

use App\Model\FullTbp;
use Illuminate\Http\Request;

class DashboardAdminFollowUpController extends Controller
{
    public function Index(){
        $fulltbps = FullTbp::get();
        return view('dashboard.admin.followup.index')->withFulltbps($fulltbps);
    }
    public function Edit($id){
        $fulltbp = FullTbp::find($id);
        return view('dashboard.admin.followup.edit')->withFulltbp($fulltbp);
    }
    public function EditSave(Request $request,$id){
        FullTbp::find($id)->update([
            'success_objective' => $request->followup,
            'follow_reason' => $request->note,
        ]);
        return redirect()->route('dashboard.admin.followup')->withSuccess('อัพเดทรายการสำเร็จ');
    }
    public function View($id){
        $fulltbp = FullTbp::find($id);
        return view('dashboard.admin.followup.view')->withFulltbp($fulltbp);
    }
}
