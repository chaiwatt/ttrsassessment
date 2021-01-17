<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\ExpertDoc;
use App\Model\MessageBox;
use App\Model\ExpertField;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\ExpertDetail;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\ExpertEducation;
use App\Model\ExpertAssignment;
use App\Model\ExpertExperience;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpertController extends Controller
{
    //
    public function DeleteExperience(Request $request){
        ExpertExperience::find($request->id)->delete();
        $expertexperiences = ExpertExperience::get();
        return response()->json($expertexperiences);  
    }

    public function DeleteEducation(Request $request){
        ExpertEducation::find($request->id)->delete();
        $experteducations = ExpertEducation::get();
        return response()->json($experteducations);  
    }
    public function AddExpertField(Request $request){
        $auth = Auth::user();
        $expertfield = new ExpertField();
        $expertfield->user_id = $auth->id;
        $expertfield->order = $request->expertfieldnum;
        $expertfield->detail = $request->expertfielddetail;
        $expertfield->save();
        $expertfields = ExpertField::where('user_id',$auth->id)->get();
        return response()->json($expertfields);  
    }
    public function DeleteExpertField(Request $request){
        $expertdetail = ExpertField::find($request->id)->delete();
        $expertfields = ExpertField::where('user_id',Auth::user()->id)->get();
        return response()->json($expertfields);  
    }
    public function AddExpertDoc(Request $request){
        $auth = Auth::user();
        $file = $request->file;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/expert/expertdoc/attachment" , $new_name);
        $filelocation = "storage/uploads/expert/expertdoc/attachment/".$new_name;

        $expertdoc = new ExpertDoc();
        $expertdoc->user_id = $auth->id;
        $expertdoc->name = $request->expertdocname;
        $expertdoc->path = $filelocation;
        $expertdoc->save();
        $expertdocs = ExpertDoc::where('user_id',$auth->id)->get();
        return response()->json($expertdocs);  
    }

    public function DeleteExpertDoc(Request $request){
        $expertdoc = ExpertDoc::find($request->id);
        @unlink($expertdoc->path);
        $expertdoc->delete();
        $expertdocs = ExpertDoc::where('user_id',Auth::user()->id)->get();
        return response()->json($expertdocs); 
    }
    
    public function AssignExpert(Request $request){
        if($request->status == 1){
            ExpertAssignment::where('full_tbp_id',$request->fulltbpid)->where('user_id',$request->id)->delete();
        }elseif($request->status == 2){
            $check = ExpertAssignment::where('full_tbp_id',$request->fulltbpid)->where('user_id',$request->id)->first();
            if(Empty($check)){
                $expertassignment = new ExpertAssignment();
                $expertassignment->full_tbp_id = $request->fulltbpid;
                $expertassignment->user_id = $request->id;
                $expertassignment->expert_assignment_status_id = 1;
                $expertassignment->save();
            }
        }  
    }

    public function JdAssignExpert(Request $request){
            $auth =Auth::user();
            ExpertAssignment::where('full_tbp_id',$request->fulltbpid)->where('user_id',$request->id)->first()->update([
                'expert_assignment_status_id' => 2
            ]);
            
            $expert = User::find($request->id);
            $minitbp = MiniTBP::find(FullTbp::find($request->fulltbpid)->mini_tbp_id);
            $businessplan = BusinessPlan::find($minitbp->business_plan_id);
            $company = Company::find($businessplan->company_id);
            $messagebox = Message::sendMessage('การมอบหมายผู้เชี่ยวชาญ โครงการ'.$minitbp->project .' บริษัท' . $company->name,'ท่านได้รับมอบหมายให้เป็นผู้เชี่ยวชาญในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล <a class="btn btn-sm bg-success" href='.route('dashboard.expert.report').'>ดำเนินการ</a>',Auth::user()->id,$request->id);

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $request->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' ได้รับมอบหมายให้เป็นผู้เชี่ยวชาญในโครงการ '.$minitbp->project .' ';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            EmailBox::send($expert->email,'TTRS:การมอบหมายผู้เชี่ยวชาญ โครงการ'.$minitbp->project .' บริษัท' . $company->name,'เรียนคุณ'.$expert->name . ' ' .$expert->lastname.'<br><br> ท่านได้รับมอบหมายให้เป็นผู้เชี่ยวชาญในโครงการ'.$minitbp->project.' บริษัท' . $company->name.' โปรดตรวจสอบข้อมูล <a class="btn btn-sm bg-success" href='.route('dashboard.expert.report').'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
    }

    public function ExpertReject(Request $request){
        ExpertAssignment::where('full_tbp_id',$request->fulltbpid)->where('user_id',$request->id)->first()->update([
            'accepted' => 2,
            'rejectreason' => $request->note
        ]);
    }
    public function ShowReject(Request $request){
        return ExpertAssignment::where('full_tbp_id',$request->fulltbpid)->where('user_id',$request->id)->first()->rejectreason;
    }
    public function JdConfirm(Request $request){
       $check = ExpertAssignment::where('full_tbp_id',$request->fulltbpid)->where('accepted',1)->get();
       if($check->count() != 0){
            ExpertAssignment::where('full_tbp_id',$request->fulltbpid)->where('accepted','!=',1)->delete();
            $expertassignments = ExpertAssignment::where('full_tbp_id',$request->fulltbpid)->get();
            foreach ($expertassignments as $key => $expertassignment) {
                $check = ProjectMember::where('full_tbp_id',$request->fulltbpid)->where('user_id',$expertassignment->user_id)->first();
                if(Empty($check)){
                    $isexpert = ExpertDetail::where('user_id',$expertassignment->user_id)->first();
                    if(Empty($isexpert)){
                        $projectmember = new ProjectMember();
                        $projectmember->full_tbp_id = $request->fulltbpid;
                        $projectmember->user_id = $expertassignment->user_id;
                        $projectmember->save();
                    }else{
                        if($isexpert->expert_type_id == 1){
                            $projectmember = new ProjectMember();
                            $projectmember->full_tbp_id = $request->fulltbpid;
                            $projectmember->user_id = $expertassignment->user_id;
                            $projectmember->save();
                        }
                    }

                }
            }
            FullTbp::find($request->fulltbpid)->update([
                'assignexpert' => 2
            ]);
            return response()->json($expertassignments);
       }
    }
    
}
