<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\ExpertComment;
use Illuminate\Http\Request;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;

class DashboardExpertProjectCommentController extends Controller
{
    public function Edit($id){
        $expertcomment = ExpertComment::where('full_tbp_id',$id)->first();
        $fulltbp = FullTbp::find($id);
        $businessplan = BusinessPlan::find(MiniTBP::find($fulltbp->mini_tbp_id)->business_plan_id);

        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $user_array[] = $projectassignment->leader_id;
        $user_array[] = $projectassignment->coleader_id;
        foreach(User::where('user_type_id','>=',7)->get() as $user ){
            $user_array[] = $user->id;
        }
        $users = User::whereIn('id',$user_array)->get();
        return view('dashboard.expert.project.comment.edit')->withExpertcomment($expertcomment)
                                                        ->withFulltbp($fulltbp)
                                                        ->withUsers($users);
    }
    public function EditSave(Request $request,$id){
        $expertcomment = ExpertComment::where('full_tbp_id',$id)->first();
        if(Empty($expertcomment)){
            $expertcomment = new ExpertComment();
            $expertcomment->full_tbp_id = $id;
            $expertcomment->overview = $request->overview;
            $expertcomment->management = $request->management;
            $expertcomment->technology = $request->technology;
            $expertcomment->marketing = $request->marketing;
            $expertcomment->businessprospect = $request->businessprospect;
            $expertcomment->save();
        }else{
            $expertcomment->update([
                'overview' => $request->overview,
                'management' => $request->management,
                'technology' => $request->technology,
                'marketing' => $request->marketing,
                'businessprospect' => $request->businessprospect
            ]);
        }
        return redirect()->route('dashboard.expert.project.fulltbp')->withSuccess('เพิ่มรายการสำเร็จ');
    }
}
