<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Bol;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Model\MessageBox;
use App\Model\ProjectLog;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Helper\DateConversion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helper\UserArray;

class FullTbpBolController extends Controller
{
    public function Add(Request $request){
        $auth = Auth::user();
        $file = $request->file;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/fulltbp/bol/attachment" , $new_name);
        $filelocation = "storage/uploads/fulltbp/bol/attachment/".$new_name;
        $bol = new Bol();
        $bol->full_tbp_id = $request->id;
        $bol->name = $file->getClientOriginalName();
        $bol->path = $filelocation;
        $bol->save();
        $bols = Bol::where('full_tbp_id',$request->id)->get();
        $fulltbp = FullTbp::find($request->id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
//href="{{route('dashboard.admin.project.fulltbp.bol',['id' => $fulltbp->id])}}"

        $admin = User::where('user_type_id',5)->first()->id;
        $jd = User::where('user_type_id',6)->first()->id;

        $messagebox =  Message::sendMessage('เพิ่มเอกสาร BOL ของโครงการ' . $minitbp->project . ' บริษัท' . $company->name , 'คุณ' .$auth->name . ' ' . $auth->lastname. ' (LEADER) ได้เพิ่มเอกสาร BOL ของโครงการ' . $minitbp->project . ' บริษัท' . $company->name .'โปรดตรวจสอบ <a href='.route('dashboard.admin.project.fulltbp.bol',['id' => $fulltbp->id]).'>คลิกที่นี่</a>',Auth::user()->id,$admin);
    
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $admin;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' คุณ' .$auth->name . ' ' . $auth->lastname. ' (LEADER) ได้เพิ่มเอกสาร BOL ของโครงการ' . $minitbp->project . ' บริษัท' . $company->name;
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        $messagebox =  Message::sendMessage('เพิ่มเอกสาร BOL ของโครงการ' . $minitbp->project . ' บริษัท' . $company->name ,'LEADER ได้เพิ่มเอกสาร BOL ของโครงการ' . $minitbp->project . ' บริษัท' . $company->name .'โปรดตรวจสอบ <a href='.route('dashboard.admin.project.fulltbp.bol',['id' => $fulltbp->id]).'>คลิกที่นี่</a>',Auth::user()->id,$jd);

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $jd;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' คุณ' .$auth->name . ' ' . $auth->lastname. ' (LEADER) ได้เพิ่มเอกสาร BOL ของโครงการ' . $minitbp->project . ' บริษัท' . $company->name;
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
        $projectlog->action = 'เพิ่มเอกสาร BOL (รายละเอียด: ' .$bol->name.')';
        $projectlog->save();

        CreateUserLog::createLog('เพิ่มเอกสาร BOL โครงการ' . MiniTBP::find($fulltbp->mini_tbp_id)->project);
        return response()->json($bols); 
    }
    public function Delete(Request $request){
        
        $auth = Auth::user();
        $bol = Bol::find($request->id);
        $fname = $bol->name;
        $fulltbpid = $bol->full_tbp_id;
        @unlink($bol->path);
        $bol->delete();
        $bols = Bol::where('full_tbp_id',$fulltbpid)->get();
        $fulltbp = FullTbp::find($bol->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $admin = User::where('user_type_id',5)->first()->id;
        $jd = User::where('user_type_id',6)->first()->id;

        $messagebox =  Message::sendMessage('ลบเอกสาร BOL ของโครงการ' . $minitbp->project . ' บริษัท' . $company->name , 'คุณ' .$auth->name . ' ' . $auth->lastname. ' (LEADER) ได้ลบเอกสาร BOL ของโครงการ' . $minitbp->project . ' บริษัท' . $company->name .'โปรดตรวจสอบ <a href='.route('dashboard.admin.project.fulltbp.bol',['id' => $fulltbp->id]).'>คลิกที่นี่</a>',Auth::user()->id,$admin);
    
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $admin;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' คุณ' .$auth->name . ' ' . $auth->lastname. ' (LEADER) ได้ลบเอกสาร BOL ของโครงการ' . $minitbp->project . ' บริษัท' . $company->name;
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        $messagebox =  Message::sendMessage('ลบเอกสาร BOL ของโครงการ' . $minitbp->project . ' บริษัท' . $company->name ,'LEADER ได้ลบเอกสาร BOL ของโครงการ' . $minitbp->project . ' บริษัท' . $company->name .'โปรดตรวจสอบ <a href='.route('dashboard.admin.project.fulltbp.bol',['id' => $fulltbp->id]).'>คลิกที่นี่</a>',Auth::user()->id,$jd);

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $jd;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' คุณ' .$auth->name . ' ' . $auth->lastname. ' (LEADER) ได้ลบเอกสาร BOL ของโครงการ' . $minitbp->project . ' บริษัท' . $company->name;
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
        $projectlog->action = 'ลบเอกสาร BOL (รายละเอียด: ' .$fname.')';
        $projectlog->save();

        CreateUserLog::createLog('ลบเอกสาร BOL โครงการ' . MiniTBP::find($fulltbp->mini_tbp_id)->project);
        return response()->json($bols); 
    }
}
