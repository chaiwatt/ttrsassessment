<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Model\ProjectAssignment;
use Illuminate\Support\Facades\Auth;

class DashboardAdminProjectAssignmentController extends Controller
{
    public function Index(){
        $auth = Auth::user();
        $projectassignments = ProjectAssignment::where('leader_id',$auth->id)
                                            ->orWhere('coleader_id',$auth->id)
                                            ->get();
        if($auth->user_type_id >= 7){
            $projectassignments = ProjectAssignment::get();
        }
        return view('dashboard.admin.projectassignment.index')->withProjectassignments($projectassignments);
    }
    public function Edit($id){
        $projectassignment = ProjectAssignment::find($id);
        $minitbp = MiniTBP::where('business_plan_id',BusinessPlan::find($projectassignment->business_plan_id)->id)->first();
        $users = User::where('user_type_id','>=',3)->get();
        return view('dashboard.admin.projectassignment.edit')->withProjectassignment($projectassignment)
                                                            ->withUsers($users)
                                                            ->withMinitbp($minitbp);
    }
    public function EditSave(Request $request,$id){
        ProjectAssignment::find($id)->update([
            'leader_id' => $request->leader,
            'coleader_id' => $request->coleader,
        ]);
        return redirect()->route('dashboard.admin.projectassignment')->withSuccess('Assign สำเร็จ');
    }
}
