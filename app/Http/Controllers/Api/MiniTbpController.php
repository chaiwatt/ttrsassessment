<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;
use App\Model\Prefix;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\Signature;
use App\Model\MessageBox;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\UserPosition;
use App\Model\CompanyEmploy;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\TimeLineHistory;
use App\Model\MinitbpSignature;
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
            $minitbpcode = 'PL-'.Carbon::now()->format('y') . Carbon::now()->format('m') . str_pad(($request->id),3,0,STR_PAD_LEFT); 
        }
        // echo($request->director);
        if(count(json_decode($request->director)) > 0){
            MinitbpSignature::where('mini_tbp_id',$request->id)->delete();
            foreach (json_decode($request->director) as $value) {
                $minitbpsignature = new MinitbpSignature();
                $minitbpsignature->mini_tbp_id = $request->id;
                $minitbpsignature->company_employee_id = $value;
                $minitbpsignature->save();
            }
        }
        $otherbank = $minitbp->otherbank;
        if(!Empty($request->otherbank)){
            $otherbank = $request->otherbank;
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
            'signature_status_id' => $request->signature,
            'otherbank' => $otherbank
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
        // $mpdf->SetCompression(false);

        $minitbpsignatures = MinitbpSignature::where('mini_tbp_id',$request->id)->get();

        $auth = Auth::user();
        $company = Company::where('user_id',$auth->id)->first();
        $minitbp = MiniTBP::find($request->id);
        
        $company_name = (!Empty($company->name))?$company->name:'';
        $company_address = (!Empty($company->companyaddress->first()->address))?$company->companyaddress->first()->address:'';

        $finance1_text = (!Empty($minitbp->finance1))?'x':'';

        $finance1_bank = $minitbp->otherbank;
        if($minitbp->bank->name != 'อื่น ๆ โปรดระบุ'){
            $finance1_bank = (!Empty($minitbp->finance1) && !Empty($minitbp->thai_bank_id))?$minitbp->bank->name:'' ;
        }

        $finance1_loan = (!Empty($minitbp->finance1) && !Empty($minitbp->finance1_loan))?number_format($minitbp->finance1_loan,2):'' ;
        $finance2_text = (!Empty($minitbp->finance2))?'x':'';
        $finance3_text = (!Empty($minitbp->finance3))?'x':'';
        $finance4_text = (!Empty($minitbp->finance4))?'x':'';
        $finance4_joint = (!Empty($minitbp->finance4) && !Empty($minitbp->finance4_joint))?number_format($minitbp->finance4_joint,2):'' ;
        $finance4_joint_min = (!Empty($minitbp->finance4) && !Empty($minitbp->finance4_joint_min))?$minitbp->finance4_joint_min . "%":'' ;
        $finance4_joint_max = (!Empty($minitbp->finance4) && !Empty($minitbp->finance4_joint_max))?$minitbp->finance4_joint_max . "%":'' ;
        $nonefinance1_text = (!Empty($minitbp->nonefinance1))?'x':'';
        $nonefinance2_text = (!Empty($minitbp->nonefinance2))?'x':'';
        $nonefinance3_text = (!Empty($minitbp->nonefinance3))?'x':'';
        $nonefinance4_text = (!Empty($minitbp->nonefinance4))?'x':'';
        $nonefinance5_text = (!Empty($minitbp->nonefinance5))?'x':'';
        $nonefinance5_detail = (!Empty($minitbp->nonefinance5) && !Empty($minitbp->nonefinance5_detail))?$minitbp->nonefinance5_detail:'' ;
        $nonefinance6_text = (!Empty($minitbp->nonefinance6))?'x':'';
        $nonefinance6_detail = (!Empty($minitbp->nonefinance6) && !Empty($minitbp->nonefinance6_detail))?$minitbp->nonefinance6_detail:'' ;
        $signature = ($minitbp->signature_status_id == 2 && !Empty($auth->signature))?$auth->signature:'';
        $managerprefix = (!Empty($minitbp->managerprefix_id))?Prefix::find($minitbp->managerprefix_id)->name:'';
        $managername = (!Empty($minitbp->managername))?$minitbp->managername:'';
        $managerlastname = (!Empty($minitbp->managerlastname))?$minitbp->managerlastname:'';
        $managerposition = (!Empty($minitbp->managerposition_id))?UserPosition::find($minitbp->managerposition_id)->name:'';
        $fileContent = file_get_contents(asset("assets/dashboard/template/minitbp1.pdf"),'rb');
        if($minitbpsignatures->count() == 2){
            $fileContent = file_get_contents(asset("assets/dashboard/template/minitbp2.pdf"),'rb');
        }else if($minitbpsignatures->count() == 3){
            $fileContent = file_get_contents(asset("assets/dashboard/template/minitbp3.pdf"),'rb');
        }
        
        $pagecount = $mpdf->SetSourceFile(StreamReader::createByString($fileContent));
        $tplId = $mpdf->ImportPage($pagecount); 

        $bussinesstype = $minitbp->businessplan->company->business_type_id;
        $companyname = $minitbp->businessplan->company->name;
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

        $projectname = $minitbp->project;
        $projectnameeng = (!Empty($minitbp->projecteng))?$minitbp->projecteng:'';
        $mpdf->UseTemplate($tplId);
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$minitbp->prefix->name . $minitbp->contactname . ' ' .$minitbp->contactlastname .'</span>', 69, 79, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:25px;heigh:100px;text-align:center;display:block;">'.DateConversion::shortThaiDate($minitbp->created_at,'d').'</div>',171, 34.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.DateConversion::shortThaiDate($minitbp->created_at,'m').'</span>',180, 34.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.DateConversion::shortThaiDate($minitbp->created_at,'y').'</span>',187, 34.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$fullcompanyname.'</span>', 69, 86.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$company_address. ' ตำบล'. $company->companyaddress->first()->tambol->name .' อำเภอ'. $company->companyaddress->first()->amphur->name .' จังหวัด'. $company->companyaddress->first()->province->name. ' ' .$company->companyaddress->first()->postalcode.'</span>', 69, 94.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$minitbp->contactphone.'</span>', 69, 102.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$minitbp->contactemail.'</span>', 69, 110.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$projectname.'</span>', 69, 118.4, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$projectnameeng.'</span>', 69, 126, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($finance1_text, 20.8, 150.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:155px;heigh:100px;text-align:center;">'.$finance1_bank.'</div>', 55, 151.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:150px;heigh:100px;text-align:center;">'.$finance1_loan.'</div>', 54, 158, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($finance2_text, 20.8, 163.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($finance3_text, 20.8, 177, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($finance4_text, 20.8, 183.2, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center;">'.$finance4_joint.'</div>', 56, 191, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$finance4_joint_min.'</span>', 74, 197.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$finance4_joint_max.'</span>', 91, 197.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance1_text, 105.8, 150.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance2_text, 105.8, 157, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance3_text, 105.8, 163.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance4_text, 105.8, 170, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance5_text, 105.8, 177, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$nonefinance5_detail.'</span>', 111, 184.6, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance6_text, 105.8, 189.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$nonefinance6_detail.'</span>', 111, 197.5, 150, 90, 'auto');
        if($minitbpsignatures->count() == 1){
            $director = CompanyEmploy::find($minitbpsignatures[0]->company_employee_id);
            if ($minitbp->signature_status_id == 2) {
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:200px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 116, 232, 150, 90, 'auto');
            } 
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:200px;heigh:100px;text-align:center">'.$director->prefix->name.$director->name. ' ' . $director->lastname. '</div>', 118,244.5, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:200px;heigh:100px;text-align:center">'.$director->employposition->name. '</div>', 120,253.3, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 142,261.7, 150, 90, 'auto');
        }else if($minitbpsignatures->count() == 2){
            $director = CompanyEmploy::find($minitbpsignatures[0]->company_employee_id);
            if ($minitbp->signature_status_id == 2) {
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:200px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 129, 232, 150, 90, 'auto');
            } 
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:190px;heigh:100px;text-align:center">'.$director->prefix->name.$director->name. ' ' . $director->lastname. '</div>', 130,244.5, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:170px;heigh:100px;text-align:center">'.$director->employposition->name. '</div>', 135,253.3, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 152,261.7, 150, 90, 'auto');

            $director = CompanyEmploy::find($minitbpsignatures[1]->company_employee_id);
            if ($minitbp->signature_status_id == 2) {
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:200px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 32, 232, 150, 90, 'auto');
            } 
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:190px;heigh:100px;text-align:center">'.$director->prefix->name.$director->name. ' ' . $director->lastname. '</div>', 35,244.5, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:170px;heigh:100px;text-align:center">'.$director->employposition->name. '</div>', 39,253.3, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 52,261.7, 150, 90, 'auto');
        }else if($minitbpsignatures->count() == 3){
            $director = CompanyEmploy::find($minitbpsignatures[0]->company_employee_id);
            if ($minitbp->signature_status_id == 2) {
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 86, 232, 150, 90, 'auto');
            } 
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$director->prefix->name.$director->name. ' ' . $director->lastname. '</div>', 150,244.5, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$director->employposition->name. '</div>', 154,253.3, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 166,261.7, 150, 90, 'auto');

            $director = CompanyEmploy::find($minitbpsignatures[1]->company_employee_id);
            if ($minitbp->signature_status_id == 2) {
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 25, 232, 150, 90, 'auto');
            } 
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$director->prefix->name.$director->name. ' ' . $director->lastname. '</div>', 87,244.5, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$director->employposition->name. '</div>', 91,253.3, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 104,261.7, 150, 90, 'auto');

            $director = CompanyEmploy::find($minitbpsignatures[2]->company_employee_id);
            if ($minitbp->signature_status_id == 2) {
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 150, 232, 150, 90, 'auto');
            } 
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$director->prefix->name.$director->name. ' ' . $director->lastname. '</div>', 26,244.5, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$director->employposition->name. '</div>', 30,253.3, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 42,261.7, 150, 90, 'auto');
        }
        
        // $mpdf->Output();
        $path = public_path("storage/uploads/");
        $randname = str_random(10);
        $mpdf->Output($path . $randname.'.pdf');
        return 'storage/uploads/'.$randname.'.pdf' ;
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
        $file->move("storage/uploads/company/attachment" , $new_name);
        $filelocation = "storage/uploads/company/attachment/".$new_name;
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
        $minitbp = MiniTBP::find($id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $company = $minitbp->businessplan->company;
        if(Empty($projectassignment->leader_id)){
            $projectassignment = new ProjectAssignment();
            $projectassignment->full_tbp_id = FullTbp::where('mini_tbp_id',$minitbp->id)->first()->id;
            $projectassignment->business_plan_id = $businessplan->id;
            $projectassignment->save();

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $businessplan->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 1;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = User::where('user_type_id',6)->first()->id;
            $notificationbubble->save();

            $messagebox = Message::sendMessage('แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project,'บริษัท'.$company->name. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project. ' โปรดมอบหมาย Leader ในขั้นตอนต่อไป <a href="'.route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id]).'" class="btn btn-sm bg-success">ดำเนินการ</a>',Auth::user()->id,User::where('user_type_id',6)->first()->id);    

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->target_user_id = User::where('user_type_id',6)->first()->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' บริษัท'.$company->name. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) สำหรับโครงการ' .$minitbp->project. ' โปรดมอบหมาย Leader ในขั้นตอนต่อไป <a href="'.route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id]).'" class="btn btn-sm bg-success">ดำเนินการ</a>';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            $timeLinehistory = new TimeLineHistory();
            $timeLinehistory->business_plan_id = $businessplan->id;
            $timeLinehistory->details = 'ส่งแบบคำขอรับการประเมิน TTRS (Mini TBP)';
            $timeLinehistory->message_type = 1;
            $timeLinehistory->owner_id = $auth->id;
            $timeLinehistory->user_id = $auth->id;
            $timeLinehistory->save();


            EmailBox::send(User::where('user_type_id',6)->first()->email,'TTRS:แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project . ' บริษัท'. $company->name,'เรียน JD<br><br> บริษัท'. $company->name . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ'.$minitbp->project.' โปรดตรวจสอบและแต่งตั้ง Leader ผู้รับผิดชอบโครงการ ได้ที่ <a href='.route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature() . EmailBox::emailSignature());
            
        }else{
            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = BusinessPlan::find(MiniTBP::find($id)->business_plan_id)->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 4;
            $notificationbubble->user_id = Auth::user()->id;
            $notificationbubble->target_user_id = $projectassignment->leader_id;
            $notificationbubble->save();

            $messagebox = Message::sendMessage('แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project.' ที่มีการแก้ไขแล้ว','บริษัท'.$company->name . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project.' ที่มีการแก้ไขแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp').'>ดำเนินการ</a>',Auth::user()->id,$projectassignment->leader_id);

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $projectassignment->leader_id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().'บริษัท'.$company->name . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project.' ที่มีการแก้ไขแล้ว <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp').'>ดำเนินการ</a>';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project. ' บริษัท'. $company->name . ' ที่มีการแก้ไขแล้ว','เรียน Leader<br><br> บริษัท'. $company->name . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project.' ที่มีการแก้ไขแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature()); 
        }
    }
    public function SubmitNoAttachement(Request $request){
        $id = $request->id;
        $auth = Auth::user();
        $minitbp = MiniTBP::find($id);
        $filelocation = $request->pdfname;//"storage/uploads/".$minitbp->minitbp_code.'.pdf';

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
        $minitbp = MiniTBP::find($id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $company = $minitbp->businessplan->company;
        if(Empty($projectassignment->leader_id)){
            
            $projectassignment = new ProjectAssignment();
            $projectassignment->full_tbp_id = FullTbp::where('mini_tbp_id',$minitbp->id)->first()->id;
            $projectassignment->business_plan_id = $businessplan->id;
            $projectassignment->save();

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $businessplan->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 1;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = User::where('user_type_id',6)->first()->id;
            $notificationbubble->save();

            $messagebox = Message::sendMessage('แบบคำขอรับบริการประเมิน TTRS (Mini TBP)','บริษัท'.$company->name. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) สำหรับโครงการ' .$minitbp->project. ' โปรดมอบหมาย Leader ในขั้นตอนต่อไป <a href="'.route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id]).'" class="btn btn-sm bg-success">ดำเนินการ</a>',Auth::user()->id,User::where('user_type_id',6)->first()->id);    

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->target_user_id = User::where('user_type_id',6)->first()->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' บริษัท'.$company->name. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) สำหรับโครงการ' .$minitbp->project. ' โปรดมอบหมาย Leader ในขั้นตอนต่อไป <a href="'.route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id]).'" class="btn btn-sm bg-success">ดำเนินการ</a>';
            $alertmessage->save();
            
            $timeLinehistory = new TimeLineHistory();
            $timeLinehistory->business_plan_id = $businessplan->id;
            $timeLinehistory->details = 'ส่งแบบคำขอรับการประเมิน TTRS (Mini TBP)';
            $timeLinehistory->message_type = 1;
            $timeLinehistory->owner_id = $auth->id;
            $timeLinehistory->user_id = $auth->id;
            $timeLinehistory->save();

            EmailBox::send(User::where('user_type_id',6)->first()->email,'TTRS:แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project . 'บริษัท'. $company->name,'เรียน JD<br><br> บริษัท'. $company->name . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โปรดตรวจสอบและแต่งตั้ง Leader ผู้รับผิดชอบโครงการ ได้ที่ <a href='.route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature() . EmailBox::emailSignature());
            
        }else{
            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = BusinessPlan::find($minitbp->business_plan_id)->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 4;
            $notificationbubble->user_id = Auth::user()->id;
            $notificationbubble->target_user_id = $projectassignment->leader_id;
            $notificationbubble->save();

            $messagebox =  Message::sendMessage('แบบคำขอรับบริการประเมิน TTRS (Mini TBP) ที่มีการแก้ไขแล้ว','บริษัท'.$company->name . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) ที่มีการแก้ไขแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp').'>ดำเนินการ</a>',Auth::user()->id,$projectassignment->leader_id);
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->target_user_id = $projectassignment->leader_id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' โครงการ' .$minitbp->project. ' แบบคำขอรับบริการประเมิน TTRS (Mini TBP) ที่มีการแก้ไขแล้ว <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp').'>ดำเนินการ</a>';
            $alertmessage->save();

            EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project . ' บริษัท'. $company->name .' ที่มีการแก้ไขแล้ว','เรียน Leader<br><br> บริษัท'. $company->name . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project. 'ที่มีการแก้ไขแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature() . EmailBox::emailSignature());
            
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
