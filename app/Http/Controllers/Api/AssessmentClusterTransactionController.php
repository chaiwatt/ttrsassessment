<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AssessmentGroupTransaction;

class AssessmentClusterTransactionController extends Controller
{
    public function Add(Request $request){
        if($request->subextrafactorscoreinp != null){
            foreach ($request->subextrafactorscoreinp as $subextrafactorscoreinp) {
                // $subextrafactorscoreinp['subcluster']
                // $subextrafactorscoreinp['extrafactor']
                // $subextrafactorscoreinp['subextrafactorscore']
                // $subextrafactorscoreinp['score']
            }
        }
        if($request->extrafactorscoreinp != null){
            foreach ($request->extrafactorscoreinp as $extrafactorscoreinp) {
                // $extrafactorscoreinp['subcluster']
                // $extrafactorscoreinp['extrafactor']
                // $extrafactorscoreinp['score']
            }
        }

        dd($request->extrafactorscoreinp);
        $assessmentgrouptransaction = new AssessmentGroupTransaction();
        $assessmentgrouptransaction->assessment_group_id = $request->assessmentgroupid;
        $assessmentgrouptransaction->cluster_id = $request->clusterid;
        $assessmentgrouptransaction->sub_cluster_id = !Empty($request->subclusterid)?$request->subclusterid:'';
        $assessmentgrouptransaction->sub_cluster_weight = !Empty($request->subclusterweight)?$request->subclusterweight:'';
        $assessmentgrouptransaction->extrafactor_id = !Empty($request->extrafactorid)?$request->extrafactorid:'';
        $assessmentgrouptransaction->extrafactor_score = !Empty($request->extrafactorscore)?$request->extrafactorscore:'';
        $assessmentgrouptransaction->sub_extrafactor_id = !Empty($request->subextrafactorid)?$request->subextrafactorid:'';
        $assessmentgrouptransaction->sub_extrafactor_score = !Empty($request->subextrafactorscore)?$request->subextrafactorscore:'';
        $assessmentgrouptransaction->save();

        $assessmentgrouptransactions = AssessmentGroupTransaction::where('assessment_group_id',$request->assessmentgroupid)->get();
        return response()->json($assessmentgrouptransactions); 
    }
}
