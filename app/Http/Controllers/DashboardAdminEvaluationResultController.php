<?php

namespace App\Http\Controllers;

use App\Model\FullTbp;
use Illuminate\Http\Request;
use App\Model\EvaluationResult;

class DashboardAdminEvaluationResultController extends Controller
{
    public function Index(){
        $fulltbps = FullTbp::where('status',1)->get();
        return view('dashboard.admin.evaluationresult.index')->withFulltbps($fulltbps);
    }
    public function Edit($id){
        $evaluationresult = EvaluationResult::find($id);
        return view('dashboard.admin.evaluationresult.edit')->withEvaluationresult($evaluationresult);
    }

    public function EditSave(Request $request,$id){
        EvaluationResult::find($id)->update([
            'management' => $request->management,
            'technoandinnovation' => $request->technoandinnovation,
            'marketability' => $request->marketability,
            'businessprospect' => $request->businessprospect
        ]);
        return redirect()->back()->withSuccess('แก้ไขข้อมูลการแจ้งผลสำเร็จ');
    }
}
