<?php

namespace App\Http\Controllers;

use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Model\EvaluationResult;
use PDF;

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

    public function Pdf($id){
        require_once (base_path('/vendor/notyes/thsplitlib/THSplitLib/segment.php'));
        $segment = new \Segment();
        $fulltbp = FullTbp::find($id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $evaluationresult= EvaluationResult::where('full_tbp_id',$id)->first();
        $data = [
            'fulltbp' => $fulltbp,
            'minitbp' => $minitbp,
            'company' => $company,
            'evaluationresult' => $evaluationresult
        ];
        $pdf = PDF::loadView('dashboard.admin.evaluationresult.pdf', $data);
        $path = public_path("storage/uploads/fulltbp/");
        return $pdf->stream('document.pdf');
    }

    public static function Certificate($id){
        return $id;
    }
    
    public static function FixBreak($data){
        $segment = new \Segment();
        return $segment->get_segment_array($data);
    }
    
}
