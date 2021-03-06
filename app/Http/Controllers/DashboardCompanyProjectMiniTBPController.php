<?php

namespace App\Http\Controllers;
use PDF;
use App\User;
use DateTimeZone;
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
use App\Model\MessageBox;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\UserPosition;
use App\Model\CompanyEmploy;
use Illuminate\Http\Request;
use App\Model\CompanyAddress;
use App\Helper\DateConversion;
use App\Model\SignatureStatus;
use App\Model\ProjectAssignment;
use App\Model\AuthorizedDirector;
use App\Model\NotificationBubble;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditMiniTbpRequest;
use setasign\Fpdi\PdfParser\StreamReader;


class DashboardCompanyProjectMiniTBPController extends Controller
{
    public function Index(){
        NotificationBubble::where('target_user_id',Auth::user()->id)
                    ->where('notification_category_id',1) // notification_category_id 1 = โครงการ
                    ->where('notification_sub_category_id',4) // notification_sub_category_id 4 = Mini TBP
                    ->where('status',0)->delete();
        $company = Company::where('user_id',Auth::user()->id)->first();
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        $minitbps = MiniTBP::where('business_plan_id',$businessplan->id)->get();
        return view('dashboard.company.project.minitbp.index')->withMinitbps($minitbps);
    }
    public function Edit($id){
        $user = Auth::user();
        NotificationBubble::where('target_user_id',$user->id)
                        ->where('notification_category_id',1)       // notification_category_id 1 = โครงการ
                        ->where('notification_sub_category_id',4)   // notification_sub_category_id 4 = Mini TBP
                        ->where('status',0)->delete();
        $company = Company::where('user_id',$user->id)->first();
        $banks = ThaiBank::get();
        $minitbp = MiniTBP::find($id);
        $contactprefixes = Prefix::get();
        $contactpositions = UserPosition::get();
        $signaturestatuses = SignatureStatus::get();
        $provinces = Province::get();
        $companyaddress = CompanyAddress::where('company_id',$company->id)->first();
        $amphurs = Amphur::where('province_id',$companyaddress->province_id)->get();
        $tambols = Tambol::where('amphur_id',$companyaddress->amphur_id)->get();
        $authorizeddirectors = CompanyEmploy::where('company_id',$company->id)->where('employ_position_id','<=',5)->get();

        return view('dashboard.company.project.minitbp.edit')->withMinitbp($minitbp)
                                                ->withBanks($banks)
                                                ->withCompany($company)
                                                ->withContactprefixes($contactprefixes)
                                                ->withContactpositions($contactpositions)
                                                ->withSignaturestatuses($signaturestatuses)
                                                ->withProvinces($provinces)
                                                ->withAmphurs($amphurs)
                                                ->withUser($user)
                                                ->withAuthorizeddirectors($authorizeddirectors)
                                                ->withTambols($tambols);
    }
    public function Pdf(){
        require_once(base_path('/vendor/notyes/thsplitlib/THSplitLib/segment.php'));
        $segment = new \Segment();
        $body = 'หาดทรายละเอียดสีขาว ตัดกับท้องฟ้าและน้ำทะเลสีครามใส คือบรรยากาศของท้องทะเลไทย ในช่วงของการแพร่ระบาดไวรัสโควิด-19 หาดทรายละเอียดสีขาว ตัดกับท้องฟ้าและน้ำทะเลสีครามใส คือบรรยากาศของท้องทะเลไทย ในช่วงของการแพร่ระบาดไวรัสโควิด-19';
        $words = $segment->get_segment_array($body);
        $text = implode("|",$words);
        $data = ['title'=> 'DomPDF with Laravel','body'=> $text];
        $pdf = Pdf::loadView('dashboard.company.project.minitbp.pdf',$data);
        return $pdf->stream('document.pdf');
    }
    public function EditSave(EditMiniTbpRequest $request,$id){
        MiniTBP::find($id)->update([
            'project' => $request->project,
            'projecteng' => $request->projecteng,
            'finance1' => $request->finance1,
            'thai_bank_id' => $request->bank,
            'finance1_loan' => str_replace( ',', '', $request->finance1loan),
            'finance2' => $request->finance2,
            'finance3' => $request->finance3,
            'finance4' => $request->finance4,
            'finance4_joint' => str_replace( ',', '', $request->finance4joint),
            'finance4_joint_min' => str_replace( ',', '', $request->finance4jointmin),
            'finance4_joint_max' => str_replace( ',', '', $request->finance4jointmax),
            'nonefinance1' => $request->nonefinance1,
            'nonefinance2' => $request->nonefinance2,
            'nonefinance3' => $request->nonefinance3,
            'nonefinance4' => $request->nonefinance4,
            'nonefinance5' => $request->nonefinance5,
            'nonefinance5_detail' => $request->nonefinance5detail,
            'nonefinance6' => $request->nonefinance6,
            'nonefinance6_detail' => $request->nonefinance6detail,
            // 'minitbp_objecttive' => 2,
            'contactprefix' => $request->contactprefix,
            'contactname' => $request->contactname,
            'contactlastname' => $request->contactlastname,
            'contactposition' => $request->contactposition,
            'managerprefix_id' => $request->managerprefix,
            'managername' => $request->managername,
            'managerlastname' => $request->managerlastname,
            'managerposition_id' => $request->managerposition,
            'website' => $request->website,
            'signature_status_id' => $request->signature
        ]);
        return  redirect()->route('dashboard.company.project.minitbp')->withSuccess('แก้ไขรายการสำเร็จ');
    }

    public function DownloadPDF($id){
        require_once (base_path('/vendor/notyes/thsplitlib/THSplitLib/segment.php'));
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, 
                    [
                        base_path('public/assets/dashboard/fonts/'),
                    ]
                ),
                'tempDir' => base_path('public/storage'),
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
        $auth = Auth::user();
        $company = Company::where('user_id',$auth->id)->first();
        $minitpb = MiniTBP::find($id);
        $company_name = (!Empty($company->name))?$company->name:'';
        $company_address = (!Empty($company->companyaddress->first()->address))?$company->companyaddress->first()->address:'';

        $finance1_text = (!Empty($minitpb->finance1))?'x':'';
        $finance1_bank = (!Empty($minitpb->finance1) && !Empty($minitpb->thai_bank_id))?$minitpb->bank->name:'' ;
        $finance1_loan = (!Empty($minitpb->finance1) && !Empty($minitpb->finance1_loan))?number_format($minitpb->finance1_loan,2):'' ;
        $finance2_text = (!Empty($minitpb->finance2))?'x':'';
        $finance3_text = (!Empty($minitpb->finance3))?'x':'';
        $finance4_text = (!Empty($minitpb->finance4))?'x':'';
        $finance4_joint = (!Empty($minitpb->finance4) && !Empty($minitpb->finance4_joint))?number_format(Math.ceil($minitpb->finance4_joint),2):'' ;
        $finance4_joint_min = (!Empty($minitpb->finance4) && !Empty($minitpb->finance4_joint_min))?$minitpb->finance4_joint_min ."%":'' ;
        $finance4_joint_max = (!Empty($minitpb->finance4) && !Empty($minitpb->finance4_joint_max))?$minitpb->finance4_joint_max ."%":'' ;
        $nonefinance1_text = (!Empty($minitpb->nonefinance1))?'x':'';
        $nonefinance2_text = (!Empty($minitpb->nonefinance2))?'x':'';
        $nonefinance3_text = (!Empty($minitpb->nonefinance3))?'x':'';
        $nonefinance4_text = (!Empty($minitpb->nonefinance4))?'x':'';
        $nonefinance5_text = (!Empty($minitpb->nonefinance5))?'x':'';
        $nonefinance5_detail = (!Empty($minitpb->nonefinance5) && !Empty($minitpb->nonefinance5_detail))?$minitpb->nonefinance5_detail:'' ;
        $nonefinance6_text = (!Empty($minitpb->nonefinance6))?'x':'';
        $nonefinance6_detail = (!Empty($minitpb->nonefinance6) && !Empty($minitpb->nonefinance6_detail))?$minitpb->nonefinance6_detail:'' ;
        $signature = (!Empty($minitpb->signature_status_id) && !Empty(Auth::user()->signature))?Auth::user()->signature:'';
        $managerprefix = (!Empty($minitpb->managerprefix_id))?Prefix::find($minitpb->managerprefix_id)->name:'';
        $managername = (!Empty($minitpb->managername))?$minitpb->managername:'';
        $managerlastname = (!Empty($minitpb->managerlastname))?$minitpb->managerlastname:'';
        $managerposition = (!Empty($minitpb->managerposition_id))?UserPosition::find($minitpb->managerposition_id)->name:'';
        $fileContent = file_get_contents(asset("assets/dashboard/template/minitbp.pdf"),'rb');
        $pagecount = $mpdf->SetSourceFile(StreamReader::createByString($fileContent));
        $tplId = $mpdf->ImportPage($pagecount); 
        $segment = new \Segment();
        $words = $segment->get_segment_array($minitpb->project);
        $firstparagraph = '';
        foreach($words as $word){
            $firstparagraph .= $word;
            if(strlen($firstparagraph) > 180 )break;
        }

        $projectname = $minitpb->project;
        if(strlen($firstparagraph) > 180){
            $projectname = substr_replace( $minitpb->project, '<br>', strlen($firstparagraph), 0 );
        }

        $mpdf->UseTemplate($tplId);
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$minitpb->prefix->name . $minitpb->contactname . ' ' .$minitpb->contactlastname .'</span>', 69, 79, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.DateConversion::shortThaiDate($minitpb->created_at,'d').'</span>',172, 34.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.DateConversion::shortThaiDate($minitpb->created_at,'m').'</span>',180, 34.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.DateConversion::shortThaiDate($minitpb->created_at,'y').'</span>',187, 34.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$company_name.'</span>', 69, 86.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$company_address. ' ตำบล'. $company->tambol->name .' อำเภอ'. $company->amphur->name .' จังหวัด'. $company->province->name. ' ' .$company->postalcode.'</span>', 69, 94.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$minitpb->contactphone.'</span>', 69, 102.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$minitpb->contactemail.'</span>', 69, 110.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$projectname.'</span>', 69, 118.4, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($finance1_text, 20.8, 150.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$finance1_bank.'</span>', 57, 151.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$finance1_loan.'</span>', 60, 158, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($finance2_text, 20.8, 163.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($finance3_text, 20.8, 177, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($finance4_text, 20.8, 183.2, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$finance4_joint.'</span>', 62, 191, 150, 90, 'auto');
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
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$managerprefix.$managername . ' ' . $managerlastname. '</span>', 127,244.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$managerposition. '</span>', 130,253.3, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 142,261.7, 150, 90, 'auto');
        // $mpdf->Output();
        $path = public_path("storage/uploads/minitbp/pdf/");
        $mpdf->Output($path . 'minitbp001.pdf');
    }
    
    public function Submit($id){
        $minitbp = MiniTBP::find($id);
        return view('dashboard.company.project.minitbp.submit')->withMinitbp($minitbp);
    }
    public function SubmitSave(Request $request, $id){
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
        $projectassignment = ProjectAssignment::where('business_plan_id',BusinessPlan::find($minitbp->business_plan_id)->id)->first();
        $company = $minitbp->businessplan->company->name;
        if(Empty($projectassignment)){
            $projectassignment = new ProjectAssignment();
            $projectassignment->full_tbp_id = FullTbp::where('mini_tbp_id',$minitbp->id)->first()->id;
            $projectassignment->business_plan_id = BusinessPlan::find($minitbp->business_plan_id)->id;
            $projectassignment->save();

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = BusinessPlan::find($minitbp->business_plan_id)->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 1;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = User::where('user_type_id',6)->first()->id;
            $notificationbubble->save();

            $messagebox = Message::sendMessage('แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project,' บริษัท'.$company->name. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project. ' โปรดมอบหมาย Leader ในขั้นตอนต่อไป <a href="'.route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id]).'" class="btn btn-sm bg-success">ดำเนินการ</a>',Auth::user()->id,User::where('user_type_id',6)->first()->id);    

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->target_user_id = User::where('user_type_id',6)->first()->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' บริษัท'.$company->name. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project. ' โปรดมอบหมาย Leader ในขั้นตอนต่อไป <a data-id="'.$messagebox->id.'" href="'.route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id]).'" class="btn btn-sm bg-success linknextaction">ดำเนินการ</a>';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            EmailBox::send(User::where('user_type_id',6)->first()->email,'TTRS:แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project,'เรียน Manager<br><br> บริษัท'. $company->name . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ'.$minitbp->project.' โปรดตรวจสอบและแต่งตั้ง Leader <a href='.route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            
        }else{
            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = BusinessPlan::find($minitbp->business_plan_id)->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 4;
            $notificationbubble->user_id = Auth::user()->id;
            $notificationbubble->target_user_id = $projectassignment->leader_id;
            $notificationbubble->save();

            $messagebox = Message::sendMessage('แบบคำขอรับบริการประเมิน TTRS (Mini TBP) ' . $minitbp->project.' ที่มีการแก้ไขแล้ว',' บริษัท'.$company->name . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project.' ที่มีการแก้ไขแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp').'>ดำเนินการ</a>',Auth::user()->id,$projectassignment->leader_id);

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $projectassignment->leader_id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' โครงการ' .$minitbp->project. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project.' ที่มีการแก้ไขแล้ว <a data-id="'.$messagebox->id.'" class="btn btn-sm bg-success linknextaction" href='.route('dashboard.admin.project.minitbp').'>ดำเนินการ</a>';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project.' ที่มีการแก้ไขแล้ว','เรียน Leader<br><br> บริษัท'. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project.' ที่มีการแก้ไขแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature()); 
        }

        return redirect()->route('dashboard.company.project.minitbp')->withSuccess('ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) สำเร็จ');
    }
}
