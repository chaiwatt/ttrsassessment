<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;
use App\Model\Prefix;
use App\Model\Company;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\UserPosition;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\PdfParser\StreamReader;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class MiniTbpController extends Controller
{
    public function EditSave(Request $request){
        $minitbp = MiniTBP::find($request->id);
        $minitbpcode = $minitbp->minitbp_code;
        if(Empty($minitbpcode)){
            $minitbpcode = 'PL-'.Carbon::now()->format('y') . Carbon::now()->format('m') . str_pad((MiniTBP::get()->count()),3,0,STR_PAD_LEFT); 
        }
        MiniTBP::find($request->id)->update([
            'project' => $request->project,
            'projecteng' => $request->projecteng,
            'minitbp_code' => $minitbpcode,
            'finance1' => $request->finance1,
            'thai_bank_id' => $request->bank,
            'finance1_loan' => $request->finance1loan,
            'finance2' => $request->finance2,
            'finance3' => $request->finance3,
            'finance4' => $request->finance4,
            'finance4_joint' => $request->finance4joint,
            'finance4_joint_min' => $request->finance4jointmin,
            'finance4_joint_max' => $request->finance4jointmax,
            'nonefinance1' => $request->nonefinance1,
            'nonefinance2' => $request->nonefinance2,
            'nonefinance3' => $request->nonefinance3,
            'nonefinance4' => $request->nonefinance4,
            'nonefinance5' => $request->nonefinance5,
            'nonefinance5_detail' => $request->nonefinance5detail,
            'nonefinance6' => $request->nonefinance6,
            'nonefinance6_detail' => $request->nonefinance6detail,
            'contactprefix' => $request->contactprefix,
            'contactname' => $request->contactname,
            'contactlastname' => $request->contactlastname,
            'contactphone' => $request->contactphone,
            'contactemail' => $request->contactemail,
            'contactposition' => $request->contactposition,
            'managerprefix_id' => $request->managerprefix,
            'managername' => $request->managername,
            'managerlastname' => $request->managerlastname,
            'managerposition_id' => $request->managerposition,
            'website' => $request->website,
            'signature_status_id' => $request->signature
        ]);
       
        Company::where('user_id',Auth::user()->id)->first()->update([
            'name' => $request->companyname,
            // 'address' => $request->address,
            // 'province_id' => $request->province,
            // 'amphur_id' => $request->amphur,
            // 'tambol_id' => $request->tambol,
            // 'postalcode' => $request->postalcode
        ]);
        $minitbp = MiniTBP::find($request->id);
        return response()->json($minitbp);
    }

    public function CreatePdf(Request $request){
        require_once (base_path('/vendor/notyes/thsplitlib/THSplitLib/segment.php'));
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [
                base_path('public/assets/dashboard/fonts/'),
            ]),
            'fontdata' => $fontData + [
                'kanit' => [
                    'R'  => 'thsarabunnew-webfont.ttf',    
                    'B'  => 'thsarabunnew_bold-webfont.ttf',       
                    'I'  => 'thsarabunnew_italic-webfont.ttf',    
                    'BI' => 'thsarabunnew_bolditalic-webfont.ttf' 
                ]
            ],
            'default_font' => 'kanit',
        ]);
        $auth = Auth::user();
        $company = Company::where('user_id',$auth->id)->first();
        $minitpb = MiniTBP::find($request->id);
        
        $company_name = (!Empty($company->name))?$company->name:'';
        $company_address = (!Empty($company->companyaddress->first()->address))?$company->companyaddress->first()->address:'';

        $finance1_text = (!Empty($minitpb->finance1))?'x':'';
        $finance1_bank = (!Empty($minitpb->finance1) && !Empty($minitpb->thai_bank_id))?$minitpb->bank->name:'' ;
        $finance1_loan = (!Empty($minitpb->finance1) && !Empty($minitpb->finance1_loan))?number_format($minitpb->finance1_loan,2):'' ;
        $finance2_text = (!Empty($minitpb->finance2))?'x':'';
        $finance3_text = (!Empty($minitpb->finance3))?'x':'';
        $finance4_text = (!Empty($minitpb->finance4))?'x':'';
        $finance4_joint = (!Empty($minitpb->finance4) && !Empty($minitpb->finance4_joint))?number_format($minitpb->finance4_joint,2):'' ;
        $finance4_joint_min = (!Empty($minitpb->finance4) && !Empty($minitpb->finance4_joint_min))?$minitpb->finance4_joint_min:'' ;
        $finance4_joint_max = (!Empty($minitpb->finance4) && !Empty($minitpb->finance4_joint_max))?$minitpb->finance4_joint_max:'' ;
        $nonefinance1_text = (!Empty($minitpb->nonefinance1))?'x':'';
        $nonefinance2_text = (!Empty($minitpb->nonefinance2))?'x':'';
        $nonefinance3_text = (!Empty($minitpb->nonefinance3))?'x':'';
        $nonefinance4_text = (!Empty($minitpb->nonefinance4))?'x':'';
        $nonefinance5_text = (!Empty($minitpb->nonefinance5))?'x':'';
        $nonefinance5_detail = (!Empty($minitpb->nonefinance5) && !Empty($minitpb->nonefinance5_detail))?$minitpb->nonefinance5_detail:'' ;
        $nonefinance6_text = (!Empty($minitpb->nonefinance6))?'x':'';
        $nonefinance6_detail = (!Empty($minitpb->nonefinance6) && !Empty($minitpb->nonefinance6_detail))?$minitpb->nonefinance6_detail:'' ;
        $signature = ($minitpb->signature_status_id == 2 && !Empty($auth->signature))?$auth->signature:'';
        $managerprefix = (!Empty($minitpb->managerprefix_id))?Prefix::find($minitpb->managerprefix_id)->name:'';
        $managername = (!Empty($minitpb->managername))?$minitpb->managername:'';
        $managerlastname = (!Empty($minitpb->managerlastname))?$minitpb->managerlastname:'';
        $managerposition = (!Empty($minitpb->managerposition_id))?UserPosition::find($minitpb->managerposition_id)->name:'';
        $fileContent = file_get_contents(asset("assets/dashboard/template/minitbp.pdf"),'rb');
        $pagecount = $mpdf->SetSourceFile(StreamReader::createByString($fileContent));
        $tplId = $mpdf->ImportPage($pagecount); 
        // $segment = new \Segment();
        // $words = $segment->get_segment_array($minitpb->project);
        // $firstparagraph = '';
        // foreach($words as $word){
        //     $firstparagraph .= $word;
        //     if(strlen($firstparagraph) > 180 )break;
        // }

        // $projectname = $minitpb->project;
        // if(strlen($firstparagraph) > 180){
        //     $projectname = substr_replace( $minitpb->project, '<br>', strlen($firstparagraph), 0 );
        // }
        $projectname = $minitpb->project;
        $projectnameeng = (!Empty($minitpb->projecteng))?$minitpb->projecteng:'';
        $mpdf->UseTemplate($tplId);
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$minitpb->prefix->name . $minitpb->contactname . ' ' .$minitpb->contactlastname .'</span>', 69, 79, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:25px;heigh:100px;text-align:center;display:block;">'.DateConversion::shortThaiDate($minitpb->created_at,'d').'</div>',171, 34.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.DateConversion::shortThaiDate($minitpb->created_at,'m').'</span>',180, 34.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.DateConversion::shortThaiDate($minitpb->created_at,'y').'</span>',187, 34.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$company_name.'</span>', 69, 86.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$company_address. ' ตำบล'. $company->tambol->name .' อำเภอ'. $company->amphur->name .' จังหวัด'. $company->province->name. ' ' .$company->postalcode.'</span>', 69, 94.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$minitpb->contactphone.'</span>', 69, 102.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$minitpb->contactemail.'</span>', 69, 110.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$projectname . ' ' .$projectnameeng.'</span>', 69, 118.4, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($finance1_text, 20.8, 150.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:155px;heigh:100px;text-align:center;">'.$finance1_bank.'</div>', 55, 151.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:150px;heigh:100px;text-align:center;">'.$finance1_loan.'</div>', 54, 158, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($finance2_text, 20.8, 163.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($finance3_text, 20.8, 177, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($finance4_text, 20.8, 183.2, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center;">'.$finance4_joint.'</div>', 56, 191, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$finance4_joint_min.'</span>', 75, 197.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$finance4_joint_max.'</span>', 92, 197.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance1_text, 105.8, 150.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance2_text, 105.8, 157, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance3_text, 105.8, 163.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance4_text, 105.8, 170, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance5_text, 105.8, 177, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$nonefinance5_detail.'</span>', 111, 184.6, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance6_text, 105.8, 189.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$nonefinance6_detail.'</span>', 111, 197.5, 150, 90, 'auto');
        if (!Empty($signature)) {
            $mpdf->WriteFixedPosHTML('<img src="'.asset($signature).'" width="120" height="30" alt="">', 125, 232, 150, 90, 'auto');
        } 
        $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:200px;heigh:100px;text-align:center">'.$managerprefix.$managername . ' ' . $managerlastname. '</div>', 118,244.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:200px;heigh:100px;text-align:center">'.$managerposition. '</div>', 118,253.3, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 142,261.7, 150, 90, 'auto');
        // $mpdf->Output();
        $path = public_path("storage/uploads/");

        $mpdf->Output($path . $minitpb->minitbp_code.'.pdf');
        return 'storage/uploads/'.$minitpb->minitbp_code.'.pdf' ;
    }

    public function SubmitWithAttachement(Request $request){
        $id = $request->id;
        $auth = Auth::user();
        $minitbp = MiniTBP::find($id);
        if(!Empty($minitbp->attachment)){
            @unlink($minitbp->attachment);
        }
        $file = $request->attachment;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/pdf/attachment" , $new_name);
        $filelocation = "storage/uploads/pdf/attachment/".$new_name;
        $minitbp->update([
            'attachment' => $filelocation
        ]);
        $minitbp = MiniTBP::find($id);
        if($minitbp->refixstatus == 1){
            $minitbp->update([
                'refixstatus' => 2  
            ]);
        }
        BusinessPlan::find(MiniTBP::find($id)->business_plan_id)->update([
            'business_plan_status_id' => 3
        ]);

        $projectassignment = ProjectAssignment::where('business_plan_id',BusinessPlan::find(MiniTBP::find($id)->business_plan_id)->id)->first();
        if(Empty($projectassignment->leader_id)){
         
            $projectassignment = new ProjectAssignment();
            $projectassignment->business_plan_id = BusinessPlan::find(MiniTBP::find($id)->business_plan_id)->id;
            $projectassignment->save();

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = BusinessPlan::find(MiniTBP::find($id)->business_plan_id)->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 1;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = User::where('user_type_id',6)->first()->id;
            $notificationbubble->save();

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = User::where('user_type_id',6)->first()->id;
            $alertmessage->detail = 'โครงการ' .$minitbp->project. ' ได้ส่งเอกสาร Mini TBP แล้ว โปรดมอบหมาย Leader ในขั้นตอนต่อไป ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
            $alertmessage->save();

            EmailBox::send(User::where('user_type_id',6)->first()->email,'TTRS:ส่งเอกสาร Mini TBP','เรียน JD<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่งเอกสาร Mini Tbp โปรดตรวจสอบและแต่งตั้ง Leader ผู้รับผิดชอบโครงการ ได้ที่ <a href='.route('dashboard.admin.project.projectassignment').'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('ส่งเอกสาร Mini TBP',Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่งเอกสาร Mini TBP โปรดตรวจสอบและแต่งตั้ง Leader ผู้รับผิดชอบ',Auth::user()->id,User::where('user_type_id',6)->first()->id);    

        }else{
            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = BusinessPlan::find(MiniTBP::find($id)->business_plan_id)->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 4;
            $notificationbubble->user_id = Auth::user()->id;
            $notificationbubble->target_user_id = $projectassignment->leader_id;
            $notificationbubble->save();

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $projectassignment->leader_id;
            $alertmessage->detail = 'โครงการ' .$minitbp->project. ' เอกสาร Mini TBP ที่มีการแก้ไขแล้ว ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
            $alertmessage->save();

            EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:เอกสาร Mini TBP ที่มีการแก้ไขแล้ว','เรียน Leader<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่งเอกสาร Mini Tbp ที่มีการแก้ไขแล้ว โปรดตรวจสอบได้ที่ <a href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('เอกสาร Mini TBP ที่มีการแก้ไขแล้ว',Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่งเอกสาร Mini TBP ที่มีการแก้ไขแล้ว โปรดตรวจสอบได้ที่ <a href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a>',Auth::user()->id,$projectassignment->leader_id);
        }
    }
    public function SubmitNoAttachement(Request $request){
        $id = $request->id;
        $auth = Auth::user();
        $minitbp = MiniTBP::find($id);
        $filelocation = "storage/uploads/".$minitbp->minitbp_code.'.pdf';

        $minitbp->update([
            'attachment' => $filelocation
        ]);
        $minitbp = MiniTBP::find($id);
        if($minitbp->refixstatus == 1){
            $minitbp->update([
                'refixstatus' => 2  
            ]);
        }
        BusinessPlan::find(MiniTBP::find($id)->business_plan_id)->update([
            'business_plan_status_id' => 3
        ]);

        $projectassignment = ProjectAssignment::where('business_plan_id',BusinessPlan::find(MiniTBP::find($id)->business_plan_id)->id)->first();
        
        if(Empty($projectassignment->leader_id)){
            
            $projectassignment = new ProjectAssignment();
            $projectassignment->business_plan_id = BusinessPlan::find(MiniTBP::find($id)->business_plan_id)->id;
            $projectassignment->save();

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = BusinessPlan::find(MiniTBP::find($id)->business_plan_id)->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 1;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = User::where('user_type_id',6)->first()->id;
            $notificationbubble->save();

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = User::where('user_type_id',6)->first()->id;
            $alertmessage->detail = 'โครงการ' .$minitbp->project. ' ได้ส่งเอกสาร Mini TBP แล้ว โปรดมอบหมาย Leader ในขั้นตอนต่อไป ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
            $alertmessage->save();
            
            EmailBox::send(User::where('user_type_id',6)->first()->email,'TTRS:ส่งเอกสาร Mini TBP','เรียน JD<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่งเอกสาร Mini Tbp โปรดตรวจสอบและแต่งตั้ง Leader ผู้รับผิดชอบโครงการ ได้ที่ <a href='.route('dashboard.admin.project.projectassignment').'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('ส่งเอกสาร Mini TBP',Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่งเอกสาร Mini TBP โปรดตรวจสอบและแต่งตั้ง Leader ผู้รับผิดชอบ',Auth::user()->id,User::where('user_type_id',6)->first()->id);    

        }else{
            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = BusinessPlan::find(MiniTBP::find($id)->business_plan_id)->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 4;
            $notificationbubble->user_id = Auth::user()->id;
            $notificationbubble->target_user_id = $projectassignment->leader_id;
            $notificationbubble->save();

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $projectassignment->leader_id;
            $alertmessage->detail = 'โครงการ' .$minitbp->project. ' เอกสาร Mini TBP ที่มีการแก้ไขแล้ว ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
            $alertmessage->save();

            EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:เอกสาร Mini TBP ที่มีการแก้ไขแล้ว','เรียน Leader<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่งเอกสาร Mini Tbp ที่มีการแก้ไขแล้ว โปรดตรวจสอบได้ที่ <a href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('เอกสาร Mini TBP ที่มีการแก้ไขแล้ว',Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่งเอกสาร Mini TBP ที่มีการแก้ไขแล้ว โปรดตรวจสอบได้ที่ <a href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a>',Auth::user()->id,$projectassignment->leader_id);
        }
    }

    
    public function GetJdMessage(Request $request){
        $minitbp = MiniTBP::find($request->id);
        return response()->json($minitbp);
    }
    public function AddJdMessage(Request $request){
        MiniTBP::find($request->id)->update([
            'jdmessage' => $request->message
        ]);
        $minitbp = MiniTBP::find($request->id);
        return response()->json($minitbp);
    }
}
