<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Model\Amphur;
use App\Model\Prefix;
use App\Model\Tambol;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Model\Province;
use App\Model\ThaiBank;
use App\Helper\EmailBox;
use App\Model\ReviseLog;
use App\Model\MessageBox;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\UserPosition;
use App\Model\CompanyEmploy;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Model\DocumentEditor;
use App\Helper\DateConversion;
use App\Model\SignatureStatus;
use App\Model\TimeLineHistory;
use App\Helper\OnlyBelongPerson;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use Illuminate\Support\Facades\Auth;
use App\Model\ProjectStatusTransaction;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class DashboardAdminProjectMiniTbpController extends Controller
{
    public function Index(){
        NotificationBubble::where('target_user_id',Auth::user()->id)
                        ->where('notification_category_id',1) // notification_category_id 1 = โครงการ
                        ->where('notification_sub_category_id',4) // notification_sub_category_id 4 = Mini TBP
                        ->where('status',0)->delete();
        $projectassignments = ProjectAssignment::where('leader_id',Auth::user()->id)->pluck('business_plan_id')->toArray();
        // $businessplans = BusinessPlan::where('business_plan_status_id',3)->whereIn('id',$projectassignments)->pluck('id')->toArray();
        $businessplans = BusinessPlan::whereIn('id',$projectassignments)->pluck('id')->toArray();
        if(Auth::user()->user_type_id >= 5){
            $businessplans = BusinessPlan::where('business_plan_status_id',3)->pluck('id')->toArray();
        }
        $minitbps = MiniTBP::whereIn('business_plan_id',$businessplans)->get();
        return view('dashboard.admin.project.minitbp.index')->withMinitbps($minitbps);
    }

    public function View($id){
        $banks = ThaiBank::get();
        $minitbp = MiniTBP::find($id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $user = User::find($company->user_id);
        $contactprefixes = Prefix::get();
        $contactpositions = UserPosition::get();
        $signaturestatuses = SignatureStatus::get();
        $timelinehistories = TimeLineHistory::where('business_plan_id',$minitbp->business_plan_id)
                                            ->where('message_type',1)
                                            ->get();
        $provinces = Province::get();
        $amphurs = Amphur::where('province_id',$user->province_id)->get();
        $tambols = Tambol::where('amphur_id',$user->amphur_id)->get();
        $authorizeddirectors = CompanyEmploy::where('company_id',$company->id)->where('employ_position_id','<=',5)->get();
        // $activitylogs = Activity::causedBy($user)->where('log_name','Mini TBP')->orderBy('id','desc')->get();

        // $check =false;
        // $totalchange = 0;
        // $oddarray = array();
        // $evenarray = array();
        // $logarray = array();
        // $updatedate = '';
        // foreach ($activitylogs as $key => $activity) {

        //     $i = 0;
        //     foreach ($activity->properties as $properties) {
        //         foreach ($properties as $_key => $property) { 
        //             $updatedate = DateConversion::thaiDateTime($activity->created_at,'full');
        //             if( $i < count($properties)){

        //                 $temp = array("key" => $_key,"property" => $property);
        //                 array_push($evenarray,$temp);
        //             }else{
        //                 $_temp = array("key" => $_key,"property" => $property);
        //                 array_push($oddarray,$_temp);
        //             }
        //             $i++;
        //             $check = true;
        //         }
        //     }
        //     if($check == true){
        //         break;
        //     }
        // }

        // $i =0;
      
        // foreach ($oddarray as $key => $e) {
        //    $temp = array("key" => $this->changekeyname($e['key']),"new" => $this->checkval($evenarray[$i]['property']),"old" =>  $this->checkval($e['property']),"edit" =>  $updatedate);
        //    array_push($logarray,$temp);
        //    $i ++;
        // }
        // $logcollections = collect($logarray);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();

        if(OnlyBelongPerson::LeaderAndExpert($minitbp->id) == false){
            return view('dashboard.admin.project.minitbp.view')->withMinitbp($minitbp)
                    ->withBanks($banks)
                    ->withContactprefixes($contactprefixes)
                    ->withContactpositions($contactpositions)
                    ->withSignaturestatuses($signaturestatuses)
                    ->withTimelinehistories($timelinehistories)
                    ->withUser($user)
                    ->withUser($user)
                    ->withProvinces($provinces)
                    ->withAmphurs($amphurs)
                    ->withTambols($tambols)
                    ->withAuthorizeddirectors($authorizeddirectors)
                    // ->withActivitylogs($activitylogs)
                    // ->withLogcollections($logcollections)
                    ->withProjectassignment($projectassignment);
        }else{
            Auth::logout();
            Session::flush();
            return redirect()->route('login');
        }
    }

    public function changekeyname($name){
        if($name == 'project'){
            return 'ชื่อโครงการ/เทคโนโลยี';
        }elseif($name == 'projecteng'){
            return 'ชื่อโครงการ/เทคโนโลยี ภาษาอังกฤษ';
        }elseif($name == 'finance1'){
            return 'ขอสินเชื่อกับธนาคาร';
        }elseif($name == 'finance2'){
            return 'ขอรับการค้ำประกันสินเชื่อฯ บสย. (บรรษัทประกันสินเชื่ออุตสาหกรรมขนาดย่อม)';
        }elseif($name == 'finance3'){
            return 'โครงการเงินกู้ดอกเบี้ยต่ำ (สวทช.)';
        }elseif($name == 'finance4'){
            return 'บริษัทร่วมทุน (สวทช.)';
        }elseif($name == 'nonefinance1'){
            return 'โครงการขึ้นทะเบียนบัญชีนวัตกรรมไทย';
        }elseif($name == 'nonefinance2'){
            return 'รับรองสิทธิประโยชน์ทางภาษี';
        }elseif($name == 'nonefinance3'){
            return 'โครงการ spin-off';
        }elseif($name == 'nonefinance4'){
            return 'ที่ปรึกษาทางด้านเทคนิค/ด้านธุรกิจ';
        }elseif($name == 'nonefinance5'){
            return 'โครงการสนับสนุนผู้ประกอบการภาครัฐ';
        }elseif($name == 'contactname'){
            return 'ชื่อผู้ยื่นแบบคำขอ';
        }elseif($name == 'contactlastname'){
            return 'สกุลผู้ยื่นแบบคำขอ';
        }elseif($name == 'contactphone'){
            return 'เบอร์โทรศัพท์ผู้ยื่นแบบคำขอ';
        }elseif($name == 'contactemail'){
            return 'อีเมล์ผู้ยื่นแบบคำขอ';
        }elseif($name == 'contactposition'){
            return 'ตำแหน่งผู้ยื่นแบบคำขอ';
        }elseif($name == 'website'){
            return 'เว็บไซต์';
        }
    }

    public function checkval($val){
        if($val == '1'){
            return 'เลือกใหม่';
        }elseif(Empty($val)){
            return '-';
        }else{
            return $val;
        }
    }


    

    public function Approve($id){
        $minitbp = MiniTBP::find($id);
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
        $businessplan = BusinessPlan::find($minitbp->business_plan_id)->update([
            'business_plan_status_id' => 4
        ]);
        
        $_businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $_company = Company::find($_businessplan->company_id);
        $_user = User::find($_company->user_id);
        EmailBox::send($_user->email,'TTRS:กรอกข้อมูลแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)','เรียน ผู้ขอรับการประเมิน<br><br> แบบคำขอรับบริการประเมิน TTRS (Mini TBP) ของท่านได้รับอนุมัติแล้ว ให้สามารถกรอกข้อมูล Full TBP ได้ที่ <a href='.route('dashboard.company.project.fulltbp.edit',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        Message::sendMessage('กรอกข้อมูลแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)','แบบคำขอรับบริการประเมิน TTRS (Mini TBP) ของท่านได้รับอนุมัติแล้ว ให้สามารถกรอกข้อมูล Full TBP ได้ที่ <a href='.route('dashboard.company.project.fulltbp.edit',['id' => $fulltbp->id]).'>คลิกที่นี่</a>',Auth::user()->id,$_user->id);
        
        return redirect()->back()->withSuccess('อนุมัติแบบคำขอรับบริการประเมิน TTRS (Mini TBP) สำเร็จ');
    }

    public function EditApprove(Request $request){
        $auth = Auth::user();
        $minitbp = MiniTBP::find($request->id);
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
        $_businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $_company = Company::find($_businessplan->company_id);
        $_user = User::find($_company->user_id);

        $company_name = (!Empty($_businessplan->company->name))?$_businessplan->company->name:'';
        $bussinesstype = $_businessplan->business_type_id;
        $fullcompanyname = $company_name;

        if($bussinesstype == 1){
            $fullcompanyname = 'บริษัท ' . $company_name . ' จำกัด (มหาชน)';
        }else if($bussinesstype == 2){
            $fullcompanyname = 'บริษัท ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 3){
            $fullcompanyname = 'ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 4){
            $fullcompanyname = 'ห้างหุ้นส่วนสามัญ ' . $company_name; 
        }

        if($request->val == 1){
            BusinessPlan::find($minitbp->business_plan_id)->update([
                'business_plan_status_id' => 4
            ]);
            
            if($minitbp->refixstatus != 0){
                MiniTBP::find($request->id)->update(
                    [
                        'refixstatus' => 0
                    ]
                );
            }

            $messagebox = Message::sendMessage('กรอกข้อมูลแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)','แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ'.$minitbp->project.' ของท่านได้รับอนุมัติแล้ว กรุณากรอกข้อมูลแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) ในขั้นตอนต่อไป <a class="btn btn-sm bg-success" href='.route('dashboard.company.project.fulltbp.edit',['id' => $fulltbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$_user->id);

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $_company->user_id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ'.$minitbp->project.' ของท่านได้รับอนุมัติแล้ว กรุณากรอกข้อมูลแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) ในขั้นตอนต่อไป <a class="btn btn-sm bg-success" href='.route('dashboard.company.project.fulltbp.edit',['id' => $fulltbp->id]).'>ดำเนินการ</a>';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            EmailBox::send($_user->email,'TTRS:กรอกข้อมูลแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)','เรียน ผู้ขอรับการประเมิน<br><br> แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ'.$minitbp->project.' ของท่านได้รับอนุมัติแล้ว กรุณากรอกข้อมูลแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) ในขั้นตอนต่อไป <a class="btn btn-sm bg-success" href='.route('dashboard.company.project.fulltbp.edit',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            
            $jduser = User::where('user_type_id',6)->first();
            $messagebox = Message::sendMessage('อนุมัติแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project,'คุณ'.$auth->name . ' ' . $auth->lastname.' (Leader) ได้อนุมัติแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ'.$minitbp->project. ' ของ' . $fullcompanyname,Auth::user()->id,$jduser->id) ;

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $jduser->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' คุณ'.$auth->name . ' ' . $auth->lastname.' (Leader) ได้อนุมัติแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ'.$minitbp->project . ' ของ' . $fullcompanyname;
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            EmailBox::send($jduser->email,'TTRS:อนุมัติแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project,'เรียน JD<br><br> คุณ'.$auth->name . ' ' . $auth->lastname.' (Leader) ได้อนุมัติแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ'.$minitbp->project . ' ของ' . $fullcompanyname .'<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());

            $timeLinehistory = new TimeLineHistory();
            $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
            $timeLinehistory->details = 'แบบคำขอรับบริการประเมิน TTRS (Mini TBP) ของท่านได้รับอนุมัติ';
            $timeLinehistory->message_type = 1;
            $timeLinehistory->owner_id = $_company->user_id;
            $timeLinehistory->user_id = $auth->id;
            $timeLinehistory->save();

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $minitbp->business_plan_id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 5;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $_user->id;
            $notificationbubble->save();

            $projectstatustransaction = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',2)->first();
            if($projectstatustransaction->status == 1){
                $projectstatustransaction->update([
                    'status' => 2
                ]);
                $projectstatustransaction = new ProjectStatusTransaction();
                $projectstatustransaction->mini_tbp_id = $minitbp->id;
                $projectstatustransaction->project_flow_id = 3;
                $projectstatustransaction->save();

                DateConversion::addExtraDay($minitbp->id,2);
            }

            CreateUserLog::createLog('อนุมัติ Mini TBP โครงการ'.$minitbp->project);
            
        }else{
            MiniTBP::find($request->id)->update(
                [
                    'refixstatus' => 1
                ]
            );

            $timeLinehistory = new TimeLineHistory();
            $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
            $timeLinehistory->details = $request->note;
            $timeLinehistory->user_id = $auth->id;
            $timeLinehistory->message_type = 1;
            $timeLinehistory->owner_id = $_company->user_id;
            $timeLinehistory->save();

            $messagebox =  Message::sendMessage('แก้ไขข้อมูลแบบคำขอรับบริการประเมิน TTRS (Mini TBP)','แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ'.$minitbp->project.' ของท่านยังไม่ได้รับการอนุมัติ โปรดทำการแก้ไขตามข้อแนะนำ ดังนี้<br><br><div style="border-style: dashed;border-width: 2px; padding:10px">'.$request->note.'</div><br><a href="'.route('dashboard.company.project.minitbp.edit',['id' => $minitbp->id]).'" class="btn btn-sm bg-success">ดำเนินการ</a>',Auth::user()->id,$_user->id);

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $_company->user_id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' ให้แก้ไขแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ'.$minitbp->project.' โปรดทำการแก้ไขตามข้อแนะนำ ดังนี้<br><br><div style="border-style: dashed;border-width: 2px; padding:10px">'.$request->note.'</div><br><a href="'.route('dashboard.company.project.minitbp.edit',['id' => $minitbp->id]).'" class="btn btn-sm bg-success">ดำเนินการ</a>' ; 
            $alertmessage->save();

            $documenteditor = new DocumentEditor();
            $documenteditor->mini_tbp_id = $minitbp->id;
            $documenteditor->user_id = $auth->id;
            $documenteditor->doctype = 1;
            $documenteditor->save();

            $reviselog = new ReviseLog();
            $reviselog->mini_tbp_id = $minitbp->id;
            $reviselog->user_id = $auth->id;
            $reviselog->message = $request->note;
            $reviselog->doctype = 1;
            $reviselog->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $minitbp->business_plan_id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 4;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $_user->id;
            $notificationbubble->save();
            CreateUserLog::createLog('ส่งคืน Mini TBP โครงการ'.$minitbp->project);
            EmailBox::send($_user->email,'TTRS:แก้ไขข้อมูลแบบคำขอรับบริการประเมิน TTRS (Mini TBP)','เรียน ผู้ขอรับการประเมิน<br><br> แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ'.$minitbp->project.' ของท่านยังไม่ได้รับการอนุมัติ โปรดเข้าสู่ระบบเพื่อทำการแก้ไขตามข้อแนะนำ ดังนี้<br><br><div style="border-style: dashed;border-width: 2px; padding:10px">'.$request->note.'</div><br>โปรดตรวจสอบ <a href="'.route('dashboard.company.project.minitbp.edit',['id' => $minitbp->id]).'" class="btn btn-sm bg-success">คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }
        // 
        return response()->json($minitbp); 
    }
}
