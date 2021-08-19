<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\MessageBox;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    public function SendUser(Request $request){
        $auth = Auth::user();
        $fulltbp = FullTbp::find($request->id);
        $businessplan = BusinessPlan::find(MiniTBP::find($fulltbp->mini_tbp_id)->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $user = User::find($company->user_id);

        $messagebox =  Message::sendMessage('ข้อความระบบ: ' . $request->topic,'เรียน ผู้ขอรับการประเมิน<br><br>' .$request->body.  ' แจ้งมาเพื่อทราบ',$auth->id,$user->id);
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $user->id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = 'ข้อความระบบ: ' . $request->topic . ' ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send($user->email,'','TTRS:'.$request->topic,'เรียน ผู้ขอรับการประเมิน<br><br>' .$request->body.  ' แจ้งมาเพื่อทราบ<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
       
        return response()->json($fulltbp); 
    }
    public function SendMember(Request $request){
        $auth = Auth::user();
        $fulltbp = FullTbp::find($request->id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        foreach ($request->users as $key => $_user) {
            $user = User::find($_user);
            $messagebox = Message::sendMessage('ข้อความระบบ: ' . $request->topic,'เรียนทีมในโครงการ'.$minitbp->project.'<br><br>' .$request->body.  ' แจ้งมาเพื่อทราบ',$auth->id,$user->id);
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $user->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = 'ข้อความระบบ: ' . $request->topic . ' ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
            $alertmessage->save();
    
            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);
            
            EmailBox::send($user->email,'','TTRS:'.$request->topic,'เรียนทีมในโครงการ'.$minitbp->project.'<br><br>' .$request->body.  ' แจ้งมาเพื่อทราบ<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
           
        }

        return response()->json($fulltbp); 
    }

    
}
