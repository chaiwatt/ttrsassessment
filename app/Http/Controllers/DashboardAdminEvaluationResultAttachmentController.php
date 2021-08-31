<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\UserArray;
use App\Model\MessageBox;
use App\Model\ProjectLog;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Helper\DateConversion;
use Illuminate\Support\Facades\Auth;
use App\Model\ProjectFinishAttachment;

class DashboardAdminEvaluationResultAttachmentController extends Controller
{
    public function Index($id){
        $projectfinishattachments = ProjectFinishAttachment::where('full_tbp_id',$id)->get();
        $fulltpb = FullTbp::find($id);
        return view('dashboard.admin.evaluationresult.projectfinishattachment.index')->withProjectfinishattachments($projectfinishattachments)
        ->withFulltbp($fulltpb);
    }

    public function Add(Request $request){
        $auth = Auth::user();
        $file = $request->file;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/evaluationresult/attachment" , $new_name);
        $filelocation = "storage/uploads/evaluationresult/attachment/".$new_name;
        $projectfinishattachment = new ProjectFinishAttachment();
        $projectfinishattachment->full_tbp_id = $request->id;
        $projectfinishattachment->name = $file->getClientOriginalName();
        $projectfinishattachment->path = $filelocation;
        $projectfinishattachment->save();
        $projectfinishattachments = ProjectFinishAttachment::where('full_tbp_id',$request->id)->get();
        $fulltbp = FullTbp::find($request->id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);

        $admin = User::where('user_type_id',5)->first()->id;
        $jd = User::where('user_type_id',6)->first()->id;

        $messagebox =  Message::sendMessage('เพิ่มเอกสารแนบของโครงการ' . $minitbp->project . ' บริษัท' . $company->name , 'คุณ' .$auth->name . ' ' . $auth->lastname. ' (LEADER) ได้เพิ่มเอกสารแนบของโครงการ' . $minitbp->project . ' บริษัท' . $company->name .' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.report.detail.view',['id' => $fulltbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$admin);
    
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $admin;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' คุณ' .$auth->name . ' ' . $auth->lastname. ' (LEADER) ได้เพิ่มเอกสารแนบของโครงการ' . $minitbp->project . ' บริษัท' . $company->name .' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.report.detail.view',['id' => $fulltbp->id]).'>ดำเนินการ</a>';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        $messagebox =  Message::sendMessage('เพิ่มเอกสารแนบของโครงการ' . $minitbp->project . ' บริษัท' . $company->name ,'LEADER ได้เพิ่มเอกสารแนบของโครงการ' . $minitbp->project . ' บริษัท' . $company->name .' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.report.detail.view',['id' => $fulltbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$jd);

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $jd;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' คุณ' .$auth->name . ' ' . $auth->lastname. ' (LEADER) ได้เพิ่มเอกสารแนบของโครงการ' . $minitbp->project . ' บริษัท' . $company->name .' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.report.detail.view',['id' => $fulltbp->id]).'>ดำเนินการ</a>';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        $arr1 = UserArray::adminandjd($minitbp->business_plan_id);
        $arr2 = UserArray::leader($minitbp->business_plan_id);
        $userarray = array_unique(array_merge($arr1,$arr2));

        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = $auth->id;
        $projectlog->viewer = $userarray;
        $projectlog->action = 'เพิ่มเอกสารแนบ (รายละเอียด: ' .$projectfinishattachment->name.')';
        $projectlog->save();

        CreateUserLog::createLog('เพิ่มเอกสารแนบโครงการ' . MiniTBP::find($fulltbp->mini_tbp_id)->project);
        return response()->json($projectfinishattachments); 
    }
    public function Delete(Request $request){
        
        $auth = Auth::user();
        $projectfinishattachment = ProjectFinishAttachment::find($request->id);
        $fname = $projectfinishattachment->name;
        $fulltbpid = $projectfinishattachment->full_tbp_id;
        @unlink($projectfinishattachment->path);
        $projectfinishattachment->delete();
        $projectfinishattachments = ProjectFinishAttachment::where('full_tbp_id',$fulltbpid)->get();
        $fulltbp = FullTbp::find($projectfinishattachment->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $admin = User::where('user_type_id',5)->first()->id;
        $jd = User::where('user_type_id',6)->first()->id;

        $messagebox =  Message::sendMessage('ลบเอกสารแนบของโครงการ' . $minitbp->project . ' บริษัท' . $company->name , 'คุณ' .$auth->name . ' ' . $auth->lastname. ' (LEADER) ได้ลบเอกสารแนบของโครงการ' . $minitbp->project . ' บริษัท' . $company->name .' โปรดตรวจสอบ <a href='.route('dashboard.admin.report.detail.view',['id' => $fulltbp->id]).'>คลิกที่นี่</a>',Auth::user()->id,$admin);
    
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $admin;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' คุณ' .$auth->name . ' ' . $auth->lastname. ' (LEADER) ได้ลบเอกสารแนบของโครงการ' . $minitbp->project . ' บริษัท' . $company->name;
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        $messagebox =  Message::sendMessage('ลบเอกสารแนบของโครงการ' . $minitbp->project . ' บริษัท' . $company->name ,'LEADER ได้ลบเอกสารแนบของโครงการ' . $minitbp->project . ' บริษัท' . $company->name .' โปรดตรวจสอบ <a href='.route('dashboard.admin.report.detail.view',['id' => $fulltbp->id]).'>คลิกที่นี่</a>',Auth::user()->id,$jd);

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $jd;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' คุณ' .$auth->name . ' ' . $auth->lastname. ' (LEADER) ได้ลบเอกสารแนบของโครงการ' . $minitbp->project . ' บริษัท' . $company->name;
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        $arr1 = UserArray::adminandjd($minitbp->business_plan_id);
        $arr2 = UserArray::leader($minitbp->business_plan_id);
        $userarray = array_unique(array_merge($arr1,$arr2));

        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = $auth->id;
        $projectlog->viewer = $userarray;
        $projectlog->action = 'ลบเอกสารแนบ (รายละเอียด: ' .$fname.')';
        $projectlog->save();

        CreateUserLog::createLog('ลบเอกสารแนบโครงการ' . MiniTBP::find($fulltbp->mini_tbp_id)->project);
        return response()->json($projectfinishattachments); 
    }

    public function Show(Request $request){
        ProjectFinishAttachment::find($request->id)->update([
            'publicstatus' => 1
        ]);
        return;
        // $projectfinishattachments = ProjectFinishAttachment::where('full_tbp_id',$request->id)->get();
        // return response()->json($projectfinishattachments); 
    }

    public function Hide(Request $request){
        // dd($request->id);
        ProjectFinishAttachment::find($request->id)->update([
            'publicstatus' => 0
        ]);
        return;
        // $projectfinishattachments = ProjectFinishAttachment::where('full_tbp_id',$request->id)->get();
        // return response()->json($projectfinishattachments); 
    }
}
