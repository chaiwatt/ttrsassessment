<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Ev;
use Carbon\Carbon;
use App\Model\Prefix;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\LogChange;
use App\Model\ReviseLog;
use App\Model\Signature;
use App\Model\MessageBox;
use App\Model\ProjectLog;
use App\Model\GeneralInfo;
use App\Model\ProjectFlow;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\UserPosition;
use App\Model\CompanyEmploy;
use App\Model\ProjectStatus;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Model\DocumentEditor;
use App\Helper\DateConversion;
use App\Model\TimeLineHistory;
use App\Model\MinitbpSignature;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\ProjectStatusTransaction;
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

        $otherbank1 = $minitbp->otherbank1;
        if(!Empty($request->otherbank1)){
            $otherbank1 = $request->otherbank1;
        }

        $otherbank2 = $minitbp->otherbank2;
        if(!Empty($request->otherbank2)){
            $otherbank2 = $request->otherbank2;
        }
       
        $objecttive = 0;
        if(($request->finance1 == '1' || $request->finance2 == '1' || $request->finance3_other == '1' ) && ($request->nonefinance1 == '' && $request->nonefinance2 == '' && $request->nonefinance3 == ''  && $request->nonefinance5 == '') ){
            $objecttive = 1;
        }else if(($request->finance1 == '' && $request->finance2 == '' && $request->finance3_other == '' ) && ($request->nonefinance1 == '1' || $request->nonefinance2 == '1' || $request->nonefinance3 == '1' || $request->nonefinance5 == '1') ){
            $objecttive = 2;
        }else if(($request->finance1 == '1' || $request->finance2 == '1' || $request->finance3_other || '1' ) && ($request->nonefinance1 == '1' || $request->nonefinance2 == '1' || $request->nonefinance3 == '1'  || $request->nonefinance5 == '1') ){
            $objecttive = 3;
        }

        MiniTBP::find($request->id)->update([
            'project' => $request->project,
            'projecteng' => $request->projecteng,
            'minitbp_code' => $minitbpcode,
            'finance1' => $request->finance1,
            'thai_bank_id' => $request->bank,
            'thai_bank_1_id' => $request->bank1,
            'thai_bank_2_id' => $request->bank2,
                      
            'finance1_loan' => $request->finance1loan,
            'finance1_1_loan' => $request->finance1_1_loan,
            'finance1_2_loan' => $request->finance1_2_loan,

            'finance2' => $request->finance2,
            'finance3_other' => $request->finance3_other,
            'finance3_other_detail' => $request->finance3_other_detail,

            'nonefinance1' => $request->nonefinance1,
            'nonefinance2' => $request->nonefinance2,
            'nonefinance3' => $request->nonefinance3,
            
            'nonefinance5' => $request->nonefinance5,
            'nonefinance5_detail' => $request->nonefinance5detail,
            'nonefinance6' => $request->nonefinance6,
            'nonefinance6_detail' => $request->nonefinance6detail,
            'minitbp_objecttive' => $objecttive,
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
            'otherbank' => $otherbank,
            'otherbank1' => $otherbank1,
            'otherbank2' => $otherbank2
        ]);
       
        Company::where('user_id',Auth::user()->id)->first()->update([
            'name' => $request->companyname,
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
            'adjustFontDescLineheight' => 1.1,
        ]);
        $generalinfo = GeneralInfo::first();
        if($generalinfo->watermark == 1){
            $mpdf->SetWatermarkText($generalinfo->watermarktext);
            $mpdf->watermarkTextAlpha = 0.1;
            $mpdf->watermarkImageAlpha = 0.5;
            $mpdf->watermarkAngle = 45;
            $mpdf->showWatermarkText = true; 
        }

        $minitbpsignatures = MinitbpSignature::where('mini_tbp_id',$request->id)->get();

        $auth = Auth::user();
        $company = Company::where('user_id',$auth->id)->first();
        $minitbp = MiniTBP::find($request->id);
        
        $company_name = (!Empty($company->name))?$company->name:'';
        $company_address = (!Empty($company->companyaddress->first()->address))?$company->companyaddress->first()->address:'';

        $finance1_text = (!Empty($minitbp->finance1))?'x':'';
        $finance1_bank = $minitbp->otherbank;
        if($minitbp->bank != 'อื่นๆ โปรดระบุ'){
            $finance1_bank = '' ;
            
            if($minitbp->thai_bank_id != 0){
                $finance1_bank = (!Empty($minitbp->finance1) && !Empty($minitbp->thai_bank_id))?$minitbp->bank:'' ;
            }
        }

        $finance1_1_bank = $minitbp->otherbank1;

        if($minitbp->bank1 != 'อื่นๆ โปรดระบุ'){
            $finance1_1_bank = '';
            if($minitbp->thai_bank_1_id!=0){
                $finance1_1_bank = (!Empty($minitbp->finance1) && !Empty($minitbp->thai_bank_1_id))?$minitbp->bank1:'' ;
            }
            
        }

        $finance1_2_bank = $minitbp->otherbank2;
        if($minitbp->bank2 != 'อื่นๆ โปรดระบุ'){
            $finance1_2_bank = '';
            if($minitbp->thai_bank_2_id !=0){
                $finance1_2_bank = (!Empty($minitbp->finance1) && !Empty($minitbp->thai_bank_2_id))?$minitbp->bank2:'' ;
            }
           
        }

        $finance1_loan = (!Empty($minitbp->finance1) && !Empty($minitbp->finance1_loan))?number_format($minitbp->finance1_loan,2):'' ;
        $finance1_1_loan = (!Empty($minitbp->finance1) && !Empty($minitbp->finance1_1_loan))?number_format($minitbp->finance1_1_loan,2):'' ;
        $finance1_2_loan = (!Empty($minitbp->finance1) && !Empty($minitbp->finance1_2_loan))?number_format($minitbp->finance1_2_loan,2):'' ;

        $finance2_text = (!Empty($minitbp->finance2))?'x':'';
        $finance3_other_text = (!Empty($minitbp->finance3_other))?'x':'';

        $nonefinance1_text = (!Empty($minitbp->nonefinance1))?'x':'';
        $nonefinance2_text = (!Empty($minitbp->nonefinance2))?'x':'';
        $nonefinance3_text = (!Empty($minitbp->nonefinance3))?'x':'';

        $nonefinance_head_text = ( !Empty($minitbp->nonefinance1) || !Empty($minitbp->nonefinance2) || !Empty($minitbp->nonefinance3) )?'x':'';
        
        $finance3_other_detail = (!Empty($minitbp->finance3_other) && !Empty($minitbp->finance3_other_detail))?$minitbp->finance3_other_detail:'' ;

        $nonefinance5_text = (!Empty($minitbp->nonefinance5))?'x':'';
        $nonefinance5_detail = (!Empty($minitbp->nonefinance5) && !Empty($minitbp->nonefinance5_detail))?$minitbp->nonefinance5_detail:'' ;
        $nonefinance6_text = (!Empty($minitbp->nonefinance6))?'x':'';
        $nonefinance6_detail = (!Empty($minitbp->nonefinance6) && !Empty($minitbp->nonefinance6_detail))?$minitbp->nonefinance6_detail:'' ;
        $signature = ($minitbp->signature_status_id == 2 && !Empty($auth->signature))?$auth->signature:'';
        $managerprefix = (!Empty($minitbp->managerprefix_id))?Prefix::find($minitbp->managerprefix_id)->name:'';
        $managername = (!Empty($minitbp->managername))?$minitbp->managername:'';
        $managerlastname = (!Empty($minitbp->managerlastname))?$minitbp->managerlastname:'';
        $managerposition = (!Empty($minitbp->managerposition_id))?UserPosition::find($minitbp->managerposition_id)->name:'';
        $fileContent = file_get_contents(asset("assets/dashboard/template/mininew.pdf"),'rb');
        if($minitbpsignatures->count() > 1 && $minitbpsignatures->count() <= 3){
            $fileContent = file_get_contents(asset("assets/dashboard/template/mininew1.pdf"),'rb');
        }else if($minitbpsignatures->count() > 3){
            $fileContent = file_get_contents(asset("assets/dashboard/template/mininew2.pdf"),'rb');
        }
      
        $pagecount = $mpdf->SetSourceFile(StreamReader::createByString($fileContent));
        $tplId = $mpdf->ImportPage($pagecount); 

        $bussinesstype = $minitbp->businessplan->company->business_type_id;
        $companyname = $minitbp->businessplan->company->name;
        $fullcompanyname = $company_name;
        if($bussinesstype == 1){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด (มหาชน)';
        }else if($bussinesstype == 2){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 3){
            $fullcompanyname = 'ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 4){
            $fullcompanyname = 'ห้างหุ้นส่วนสามัญ ' . $company_name; 
        }

        $projectname = $minitbp->project;
        $projectnameeng = (!Empty($minitbp->projecteng))?$minitbp->projecteng:'';
        $mpdf->UseTemplate($tplId);
        if($minitbpsignatures->count() != 0){
            $userprefixname = $minitbp->prefix->name;
            if($userprefixname== 'อื่นๆ'){
                $userprefixname = Auth::user()->alter_prefix ;
            }
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$userprefixname . $minitbp->contactname . ' ' .$minitbp->contactlastname .'</span>', 69, 59, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:25px;heigh:100px;text-align:center;display:block;">'.DateConversion::shortThaiDate($minitbp->created_at,'d').'</div>',174, 27.3, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.DateConversion::shortThaiDate($minitbp->created_at,'m').'</span>',182, 27.3, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.DateConversion::shortThaiDate($minitbp->created_at,'y').'</span>',188, 27.3, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$fullcompanyname.'</span>', 69, 66, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$company_address. ' ตำบล'. $company->companyaddress->first()->tambol->name .' อำเภอ'. $company->companyaddress->first()->amphur->name .' จังหวัด'. $company->companyaddress->first()->province->name. ' ' .$company->companyaddress->first()->postalcode.'</span>', 69, 72.5, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$minitbp->contactphone.'</span>', 69, 79.2, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$minitbp->contactemail.'</span>', 69, 85.5, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$projectname.'</span>', 69, 92, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$projectnameeng.'</span>', 69, 98.5, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML($finance1_text, 20.8, 122.4, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:155px;heigh:100px;text-align:center;">'.$finance1_bank.'</div>', 35, 130, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:150px;heigh:100px;text-align:center;">'.$finance1_loan.'</div>', 52, 136.5, 150, 90, 'auto');

            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:155px;heigh:100px;text-align:center;">'.$finance1_1_bank.'</div>', 35, 143.3, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:150px;heigh:100px;text-align:center;">'.$finance1_1_loan.'</div>', 52, 149.8, 150, 90, 'auto');

            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:155px;heigh:100px;text-align:center;">'.$finance1_2_bank.'</div>', 35, 156.5, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:150px;heigh:100px;text-align:center;">'.$finance1_2_loan.'</div>', 52, 162.8, 150, 90, 'auto');


            $mpdf->WriteFixedPosHTML($finance2_text, 20.8, 168.5, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML($finance3_other_text, 20.8, 181.5, 150, 90, 'auto');

            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$finance3_other_detail.'</span>', 48, 183, 150, 90, 'auto');

            $mpdf->WriteFixedPosHTML($nonefinance_head_text, 108.5, 122.5, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML($nonefinance1_text, 115.8, 129, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML($nonefinance2_text, 115.8, 135.5, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML($nonefinance3_text, 115.8, 142.5, 150, 90, 'auto');
            
            $mpdf->WriteFixedPosHTML($nonefinance5_text, 108.5, 148.8, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$nonefinance5_detail.'</span>', 114, 156.5, 100, 90, 'auto');
            $mpdf->WriteFixedPosHTML($nonefinance6_text, 108.5, 181.5, 150, 90, 'auto');
            $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$nonefinance6_detail.'</span>', 136, 183, 150, 90, 'auto');
            if($minitbpsignatures->count() == 1){
                $director = CompanyEmploy::find($minitbpsignatures[0]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($director->employposition->name == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:200px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 116, 213, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:200px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 118,226.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:200px;heigh:100px;text-align:center">'.$directorposition. '</div>', 117,235.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 142,244, 150, 90, 'auto');



            }else if($minitbpsignatures->count() == 2){
                $director = CompanyEmploy::find($minitbpsignatures[0]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:200px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 140, 215, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:190px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 142,226.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:170px;heigh:100px;text-align:center">'.$directorposition. '</div>', 145,235.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 165,244.2, 150, 90, 'auto');

                $director = CompanyEmploy::find($minitbpsignatures[1]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:200px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 80, 215, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:190px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 80,226.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:170px;heigh:100px;text-align:center">'.$directorposition. '</div>', 85,235.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 105,244.2, 150, 90, 'auto');



            }else if($minitbpsignatures->count() == 3){
                $director = CompanyEmploy::find($minitbpsignatures[0]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {   
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 145, 215, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 147,226.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 150,235.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 165,244.2, 150, 90, 'auto');

                $director = CompanyEmploy::find($minitbpsignatures[1]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 85, 215, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 85,226.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 90,235.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 105,244.2, 150, 90, 'auto');

                $director = CompanyEmploy::find($minitbpsignatures[2]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 25,215, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 23,226.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 30,235.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 45,244.2, 150, 90, 'auto');
            }else if($minitbpsignatures->count() == 4){
                //person1
                $director = CompanyEmploy::find($minitbpsignatures[0]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {   
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 145, 202, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 147,213, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 150,220.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 163,228, 150, 90, 'auto');
                
                //person2
                $director = CompanyEmploy::find($minitbpsignatures[1]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 85, 202, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 85,213, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 90,220.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 103,228, 150, 90, 'auto');
                
                //person3
                $director = CompanyEmploy::find($minitbpsignatures[2]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 25,202, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 23,213, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 30,220.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 43,228, 150, 90, 'auto');

                //person4
                $director = CompanyEmploy::find($minitbpsignatures[3]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {   
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 145, 235.4, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 147,247.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 150,255, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 163,262.4, 150, 90, 'auto');
                      
            }else if($minitbpsignatures->count() == 5){
                //person1
                $director = CompanyEmploy::find($minitbpsignatures[0]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {   
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 145, 202, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 147,213, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 150,220.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 163,228, 150, 90, 'auto');
                
                //person2
                $director = CompanyEmploy::find($minitbpsignatures[1]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 85, 202, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 85,213, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 90,220.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 103,228, 150, 90, 'auto');
                
                //person3
                $director = CompanyEmploy::find($minitbpsignatures[2]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 25,202, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 23,213, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 30,220.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 43,228, 150, 90, 'auto');

                //person4
                $director = CompanyEmploy::find($minitbpsignatures[3]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {   
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 145, 235.4, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 147,247.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 150,255, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 163,262.4, 150, 90, 'auto');
                      
                //person5
                $director = CompanyEmploy::find($minitbpsignatures[4]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {   
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 85, 235.4, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 85,247.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 90,255, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 103,262.4, 150, 90, 'auto');
            }else if($minitbpsignatures->count() == 6){
                //person1
                $director = CompanyEmploy::find($minitbpsignatures[0]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {   
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 145, 202, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 147,213, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 150,220.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 163,228, 150, 90, 'auto');
                
                //person2
                $director = CompanyEmploy::find($minitbpsignatures[1]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 85, 202, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 85,213, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 90,220.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 103,228, 150, 90, 'auto');
                
                //person3
                $director = CompanyEmploy::find($minitbpsignatures[2]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 25,202, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 23,213, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 30,220.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 43,228, 150, 90, 'auto');

                //person4
                $director = CompanyEmploy::find($minitbpsignatures[3]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {   
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 145, 235.4, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 147,247.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 150,255, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 163,262.4, 150, 90, 'auto');
                      
                //person5
                $director = CompanyEmploy::find($minitbpsignatures[4]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {   
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 85, 235.4, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 85,247.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 90,255, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 103,262.4, 150, 90, 'auto');
            
                //person6
                $director = CompanyEmploy::find($minitbpsignatures[5]->company_employee_id);
                $directorposition = $director->employposition->name;
                if($directorposition == 'อื่นๆ'){
                    $directorposition = $director->otherposition;
                }
                $directorprefix = $director->prefix->name;
                if($directorprefix == 'อื่นๆ'){
                    $directorprefix = $director->otherprefix;
                }
                if ($minitbp->signature_status_id == 2) {   
                    $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center"><img src="'.asset(Signature::find($director->signature_id)->path).'" width="120" height="30" alt=""></div>', 25, 235.4, 150, 90, 'auto');
                } 
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:160px;heigh:100px;text-align:center">'.$directorprefix.$director->name. ' ' . $director->lastname. '</div>', 23,247.5, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:140px;heigh:100px;text-align:center">'.$directorposition. '</div>', 30,255, 150, 90, 'auto');
                $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt">'.DateConversion::engToThaiDate(Carbon::today()->format('Y-m-d')). '</span>', 43,262.4, 150, 90, 'auto');
                   
            }
    
    }
   
        // $mpdf->Output();
         $path = public_path("storage/uploads/");
         $randname = 'แบบคำขอรับบริการประเมิน_TTRS_' . $minitbp->id .'_'.$minitbp->minitbp_code;
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
        $new_name = $file->getClientOriginalName().'_'.$minitbp->id.$file->getClientOriginalExtension();
        $file->move("storage/uploads/company/attachment" , $new_name);
        $filelocation = "storage/uploads/company/attachment/".$new_name;
        $minitbp->update([
            'attachment' => $filelocation,
            'submitdate' => Carbon::now()->toDateString()  
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
        $projectassignments = ProjectAssignment::where('business_plan_id',$businessplan->id)->get();
        $company = $minitbp->businessplan->company;
        $bussinesstype = $company->business_type_id;
        $company_name = (!Empty($company->name))?$company->name:'';
        $fullcompanyname = $company_name;
        if($bussinesstype == 1){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด (มหาชน)';
        }else if($bussinesstype == 2){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 3){
            $fullcompanyname = 'ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 4){
            $fullcompanyname = 'ห้างหุ้นส่วนสามัญ ' . $company_name; 
        }

        if($projectassignments->count() == 0){
            $projectassignment = new ProjectAssignment();
            $projectassignment->full_tbp_id = FullTbp::where('mini_tbp_id',$minitbp->id)->first()->id;
            $projectassignment->business_plan_id = $businessplan->id;
            $projectassignment->save();
            $jd = User::where('user_type_id',6)->first();

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $businessplan->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 1;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $jd->id;
            $notificationbubble->save();

            $messagebox = Message::sendMessage('แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project, $fullcompanyname. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project. ' โปรดมอบหมาย Leader ในขั้นตอนต่อไป <a href="'.route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id]).'" class="btn btn-sm bg-success">ดำเนินการ</a>',Auth::user()->id,$jd->id);    

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->target_user_id = $jd->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' '.$fullcompanyname. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) สำหรับโครงการ' .$minitbp->project. ' โปรดมอบหมาย Leader ในขั้นตอนต่อไป <a data-id="'.$messagebox->id.'" href="'.route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id]).'" class="btn btn-sm bg-success linknextaction">ดำเนินการ</a>';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            $admin = User::where('user_type_id',5)->first();
            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $businessplan->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 2;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $admin->id;
            $notificationbubble->save();

            $messagebox = Message::sendMessage('แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project, $fullcompanyname. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project. ' โปรดตรวจสอบ <a href="'.route('dashboard.admin.project.minitbp').'" class="btn btn-sm bg-success">ดำเนินการ</a>',Auth::user()->id,$admin->id);    

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->target_user_id = $admin->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' '.$fullcompanyname. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) สำหรับโครงการ' .$minitbp->project. ' โปรดตรวจสอบ <a data-id="'.$messagebox->id.'" href="'.route('dashboard.admin.project.minitbp').'" class="btn btn-sm bg-success linknextaction">ดำเนินการ</a>';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            $timeLinehistory = new TimeLineHistory();
            $timeLinehistory->business_plan_id = $businessplan->id;
            $timeLinehistory->mini_tbp_id = $minitbp->id;
            $timeLinehistory->details = 'ผู้ประกอบการ: ส่งแบบคำขอรับการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project;
            $timeLinehistory->message_type = 1;
            $timeLinehistory->owner_id = $auth->id;
            $timeLinehistory->user_id = $auth->id;
            $timeLinehistory->save();

            $_fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
            Ev::where('full_tbp_id',$_fulltbp->id)->first()->update([
                'name' => $minitbp->project
            ]);

            EmailBox::send($admin->email,'TTRS:แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project . ' '. $fullcompanyname,'เรียน Admin<br><br> '. $fullcompanyname . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ'.$minitbp->project.' โปรดตรวจสอบ <a href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            EmailBox::send($jd->email,'TTRS:แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project . ' '. $fullcompanyname,'เรียน Manager<br><br> '. $fullcompanyname . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ'.$minitbp->project.' โปรดตรวจสอบและแต่งตั้ง Leader <a href='.route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            
            $startdate = Carbon::now()->addDay(1);
            $projectflows = ProjectFlow::get();
            foreach ($projectflows as $key => $projectflow) {
                $projectstatuse = new ProjectStatus();
                $projectstatuse->mini_tbp_id = $minitbp->id;
                $projectstatuse->project_flow_id = $projectflow->id;
                $projectstatuse->duration = $projectflow->duration;
                $projectstatuse->startdate = $startdate->toDateString();
                $projectstatuse->enddate = $startdate->addDay(($projectflow->duration)-1);
                $projectstatuse->save();
                $startdate = $projectstatuse->enddate->addDay(1);
            }
            $projectstatustransaction = new ProjectStatusTransaction();
            $projectstatustransaction->mini_tbp_id = $minitbp->id;
            $projectstatustransaction->project_flow_id = 1;
            $projectstatustransaction->save();

            CreateUserLog::createLog('ส่งแบบคำขอรับการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project);
        }else{
            if(!Empty($projectassignments->first()->leader_id)){
                $leader = $projectassignments->first();
                $notificationbubble = new NotificationBubble();
                $notificationbubble->business_plan_id = BusinessPlan::find(MiniTBP::find($id)->business_plan_id)->id;
                $notificationbubble->notification_category_id = 1;
                $notificationbubble->notification_sub_category_id = 4;
                $notificationbubble->user_id = Auth::user()->id;
                $notificationbubble->target_user_id = $leader->leader_id;
                $notificationbubble->save();

                $timeLinehistory = new TimeLineHistory();
                $timeLinehistory->business_plan_id = $businessplan->id;
                $timeLinehistory->mini_tbp_id = $minitbp->id;
                $timeLinehistory->details = 'ผู้ประกอบการ: ส่งแบบคำขอรับการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project . ' ฉบับแก้ไข';
                $timeLinehistory->message_type = 1;
                $timeLinehistory->owner_id = $auth->id;
                $timeLinehistory->user_id = $auth->id;
                $timeLinehistory->save();

                $messagebox = Message::sendMessage('แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project.' ที่มีการแก้ไข',$fullcompanyname . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project.' ที่มีการแก้ไขแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$projectassignments->first()->leader_id);

                $alertmessage = new AlertMessage();
                $alertmessage->user_id = $auth->id;
                $alertmessage->target_user_id = $leader->leader_id;
                $alertmessage->messagebox_id = $messagebox->id;
                $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' '.$fullcompanyname . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project.' ที่มีการแก้ไขแล้ว <a data-id="'.$messagebox->id.'" class="btn btn-sm bg-success linknextaction" href='.route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id]).'>ดำเนินการ</a>';
                $alertmessage->save();
    
                MessageBox::find($messagebox->id)->update([
                    'alertmessage_id' => $alertmessage->id
                ]);
                EmailBox::send(User::find($leader->leader_id)->email,'TTRS:แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project. ' '. $fullcompanyname . ' ที่มีการแก้ไข','เรียน Leader<br><br> '. $fullcompanyname . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project.' ที่มีการแก้ไขแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature()); 
               
            }else{

                $admin = User::where('user_type_id',5)->first();
                $documenteditor = DocumentEditor::where('mini_tbp_id',$id)->orderBy('id','desc')->first();
                $notificationbubble = new NotificationBubble();
                $notificationbubble->business_plan_id = BusinessPlan::find(MiniTBP::find($id)->business_plan_id)->id;
                $notificationbubble->notification_category_id = 1;
                $notificationbubble->notification_sub_category_id = 4;
                $notificationbubble->user_id = Auth::user()->id;
                $notificationbubble->target_user_id = $documenteditor->user_id;
                $notificationbubble->save();

                $timeLinehistory = new TimeLineHistory();
                $timeLinehistory->business_plan_id = $businessplan->id;
                $timeLinehistory->mini_tbp_id = $minitbp->id;
                $timeLinehistory->details = 'ผู้ประกอบการ: ส่งแบบคำขอรับการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project . ' ฉบับแก้ไข';
                $timeLinehistory->message_type = 1;
                $timeLinehistory->owner_id = $auth->id;
                $timeLinehistory->user_id = $auth->id;
                $timeLinehistory->save();

                $messagebox = Message::sendMessage('แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project.' ที่มีการแก้ไข',$fullcompanyname . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project.' ที่มีการแก้ไขแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$documenteditor->user_id);

                $alertmessage = new AlertMessage();
                $alertmessage->user_id = $auth->id;
                $alertmessage->target_user_id = $documenteditor->user_id;
                $alertmessage->messagebox_id = $messagebox->id;
                $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' '.$fullcompanyname . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project.' ที่มีการแก้ไขแล้ว <a data-id="'.$messagebox->id.'" class="btn btn-sm bg-success linknextaction" href='.route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id]).'>ดำเนินการ</a>';
                $alertmessage->save();
    
                MessageBox::find($messagebox->id)->update([
                    'alertmessage_id' => $alertmessage->id
                ]);
                EmailBox::send(User::find($documenteditor->user_id)->email,'TTRS:แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project. ' '. $fullcompanyname . ' ที่มีการแก้ไข','เรียน Admin<br><br> '. $fullcompanyname. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project.' ที่มีการแก้ไขแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature()); 
            }
            CreateUserLog::createLog('ส่งแบบคำขอรับการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project .  ' ที่มีการแก้ไข' );
        }

    }
    public function SubmitNoAttachement(Request $request){
        $id = $request->id;
        $auth = Auth::user();
        $minitbp = MiniTBP::find($id);
        $filelocation = $request->pdfname;

        $minitbp->update([
            'attachment' => $filelocation,
            'submitdate' => Carbon::now()->toDateString() 
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
        $projectassignments = ProjectAssignment::where('business_plan_id',$businessplan->id)->get();
        $company = $minitbp->businessplan->company;
        $company_name = (!Empty($company->name))?$company->name:'';
        $bussinesstype = $company->business_type_id;
        $fullcompanyname = $company_name;
        if($bussinesstype == 1){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด (มหาชน)';
        }else if($bussinesstype == 2){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 3){
            $fullcompanyname = 'ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 4){
            $fullcompanyname = 'ห้างหุ้นส่วนสามัญ ' . $company_name; 
        }

        if($projectassignments->count() == 0){
            
            $projectassignment = new ProjectAssignment();
            $projectassignment->full_tbp_id = FullTbp::where('mini_tbp_id',$minitbp->id)->first()->id;
            $projectassignment->business_plan_id = $businessplan->id;
            $projectassignment->save();

            $jd = User::where('user_type_id',6)->first();
            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $businessplan->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 1;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $jd->id;
            $notificationbubble->save();

            $bussinesstype = $company->business_type_id;

            $messagebox = Message::sendMessage('แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project,$fullcompanyname. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) สำหรับโครงการ' .$minitbp->project. ' โปรดมอบหมาย Leader ในขั้นตอนต่อไป <a href="'.route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id]).'" class="btn btn-sm bg-success">ดำเนินการ</a>',Auth::user()->id,$jd->id);    

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->target_user_id = $jd->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' '.$fullcompanyname. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) สำหรับโครงการ' .$minitbp->project. ' โปรดมอบหมาย Leader ในขั้นตอนต่อไป <a data-id="'.$messagebox->id.'" href="'.route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id]).'" class="btn btn-sm bg-success linknextaction">ดำเนินการ</a>';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            $admin = User::where('user_type_id',5)->first();

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $businessplan->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 2;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $admin->id;
            $notificationbubble->save();

            $messagebox = Message::sendMessage('แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project,$fullcompanyname. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) สำหรับโครงการ' .$minitbp->project. '  โปรดตรวจสอบ <a href="'.route('dashboard.admin.project.minitbp').'" class="btn btn-sm bg-success">ดำเนินการ</a>',Auth::user()->id,$admin->id);    

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->target_user_id = $admin->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' '.$fullcompanyname. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) สำหรับโครงการ' .$minitbp->project. ' โปรดตรวจสอบ <a data-id="'.$messagebox->id.'" href="'.route('dashboard.admin.project.minitbp').'" class="btn btn-sm bg-success linknextaction">ดำเนินการ</a>';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);
            
            $timeLinehistory = new TimeLineHistory();
            $timeLinehistory->business_plan_id = $businessplan->id;
            $timeLinehistory->mini_tbp_id = $minitbp->id;
            $timeLinehistory->details = 'ผู้ประกอบการ: ส่งแบบคำขอรับการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project ;
            $timeLinehistory->message_type = 1;
            $timeLinehistory->owner_id = $auth->id;
            $timeLinehistory->user_id = $auth->id;
            $timeLinehistory->save();
            
            $_fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
            Ev::where('full_tbp_id',$_fulltbp->id)->first()->update([
                'name' => $minitbp->project
            ]);
         
            EmailBox::send($admin->email,'TTRS:แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project . ' ' . $fullcompanyname,'เรียน Admin<br><br> '. $fullcompanyname. ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project . ' โปรดตรวจสอบ <a href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            EmailBox::send($jd->email,'TTRS:แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project . ' ' . $fullcompanyname,'เรียน Manager<br><br> '. $fullcompanyname . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project . ' โปรดตรวจสอบและแต่งตั้ง Leader ได้ที่ <a href='.route('dashboard.admin.project.projectassignment.edit',['id' => $projectassignment->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());

            $startdate = Carbon::now()->addDay(1);
            $projectflows = ProjectFlow::get();
            foreach ($projectflows as $key => $projectflow) {
                $projectstatuse = new ProjectStatus();
                $projectstatuse->mini_tbp_id = $minitbp->id;
                $projectstatuse->project_flow_id = $projectflow->id;
                $projectstatuse->duration = $projectflow->duration;
                $projectstatuse->startdate = $startdate->toDateString();
                $projectstatuse->enddate = $startdate->addDay(($projectflow->duration)-1);
                $projectstatuse->save();
                $startdate = $projectstatuse->enddate->addDay(1);
            }
    
            $projectstatustransaction = new ProjectStatusTransaction();
            $projectstatustransaction->mini_tbp_id = $minitbp->id;
            $projectstatustransaction->project_flow_id = 1;
            $projectstatustransaction->save();

            CreateUserLog::createLog('ส่งแบบคำขอรับการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project);
        }else{
            if(!Empty($projectassignments->first()->leader_id)){
                $notificationbubble = new NotificationBubble();
                $notificationbubble->business_plan_id = BusinessPlan::find($minitbp->business_plan_id)->id;
                $notificationbubble->notification_category_id = 1;
                $notificationbubble->notification_sub_category_id = 4;
                $notificationbubble->user_id = Auth::user()->id;
                $notificationbubble->target_user_id = $projectassignments->first()->leader_id;
                $notificationbubble->save();

                $timeLinehistory = new TimeLineHistory();
                $timeLinehistory->business_plan_id = $businessplan->id;
                $timeLinehistory->mini_tbp_id = $minitbp->id;
                $timeLinehistory->details = 'ผู้ประกอบการ: ส่งแบบคำขอรับการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project . ' ฉบับแก้ไข';
                $timeLinehistory->message_type = 1;
                $timeLinehistory->owner_id = $auth->id;
                $timeLinehistory->user_id = $auth->id;
                $timeLinehistory->save();

                $messagebox =  Message::sendMessage('แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ'.$minitbp->project.' ที่มีการแก้ไข', $fullcompanyname . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) ที่มีการแก้ไขแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$projectassignments->first()->leader_id);
                $alertmessage = new AlertMessage();
                $alertmessage->user_id = $auth->id;
                $alertmessage->messagebox_id = $messagebox->id;
                $alertmessage->target_user_id = $projectassignments->first()->leader_id;
                $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' โครงการ' .$minitbp->project. ' ส่งคืนแบบคำขอรับบริการประเมิน TTRS (Mini TBP) ที่มีการแก้ไขแล้ว <a data-id="'.$messagebox->id.'" class="btn btn-sm bg-success linknextaction" href='.route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id]).'>ดำเนินการ</a>';
                $alertmessage->save();

                MessageBox::find($messagebox->id)->update([
                    'alertmessage_id' => $alertmessage->id
                ]);

                CreateUserLog::createLog('ส่งแบบคำขอรับการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project .  ' ที่มีการแก้ไข' );
                EmailBox::send(User::find($projectassignments->first()->leader_id)->email,'TTRS:แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project .' ' . $fullcompanyname .' ที่มีการแก้ไข','เรียน Leader<br><br>' . $fullcompanyname . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project. ' ที่มีการแก้ไขแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
                
            }else{
                $documenteditor = DocumentEditor::where('mini_tbp_id',$id)->orderBy('id','desc')->first();
                $notificationbubble = new NotificationBubble();
                $notificationbubble->business_plan_id = BusinessPlan::find($minitbp->business_plan_id)->id;
                $notificationbubble->notification_category_id = 1;
                $notificationbubble->notification_sub_category_id = 4;
                $notificationbubble->user_id = Auth::user()->id;
                $notificationbubble->target_user_id = $documenteditor->user_id;
                $notificationbubble->save();

                $timeLinehistory = new TimeLineHistory();
                $timeLinehistory->business_plan_id = $businessplan->id;
                $timeLinehistory->mini_tbp_id = $minitbp->id;
                $timeLinehistory->details = 'ผู้ประกอบการ: ส่งแบบคำขอรับการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project . ' ฉบับแก้ไข';
                $timeLinehistory->message_type = 1;
                $timeLinehistory->owner_id = $auth->id;
                $timeLinehistory->user_id = $auth->id;
                $timeLinehistory->save();

                $messagebox =  Message::sendMessage('แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ'.$minitbp->project.' ที่มีการแก้ไข', $fullcompanyname . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) ที่มีการแก้ไขแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$documenteditor->user_id);
                $alertmessage = new AlertMessage();
                $alertmessage->user_id = $auth->id;
                $alertmessage->messagebox_id = $messagebox->id;
                $alertmessage->target_user_id = $documenteditor->user_id;
                $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' โครงการ' .$minitbp->project. ' ส่งคืนแบบคำขอรับบริการประเมิน TTRS (Mini TBP) ที่มีการแก้ไขแล้ว <a data-id="'.$messagebox->id.'" class="btn btn-sm bg-success linknextaction" href='.route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id]).'>ดำเนินการ</a>';
                $alertmessage->save();

                MessageBox::find($messagebox->id)->update([
                    'alertmessage_id' => $alertmessage->id
                ]);

                CreateUserLog::createLog('ส่งแบบคำขอรับการประเมิน TTRS (Mini TBP) โครงการ' . $minitbp->project .  ' ที่มีการแก้ไข' );

                EmailBox::send(User::find($documenteditor->user_id)->email,'TTRS:แบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project . ' '. $fullcompanyname .' ที่มีการแก้ไข','เรียน Admin <br><br>'. $fullcompanyname . ' ได้ส่งแบบคำขอรับบริการประเมิน TTRS (Mini TBP) โครงการ' .$minitbp->project. 'ที่มีการแก้ไขแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            }
        }

    }

    public function GetJdMessage(Request $request){
        $minitbp = MiniTBP::find($request->id);
        return response()->json($minitbp);
    }
    public function AddJdMessage(Request $request){
        $auth = Auth::user();
        MiniTBP::find($request->id)->update([
            'jdmessage' => $request->message
        ]);
        $minitbp = MiniTBP::find($request->id);

        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = $auth->id;
        $projectlog->action = 'เพิ่มความเห็น Mini TBP (รายละเอียด: ' . $request->message . ')' ;
        $projectlog->save();

        CreateUserLog::createLog('เพิ่มความเห็น โครงการ' . $minitbp->project );
        return response()->json($minitbp);
    }

    public function GetReviseLog(Request $request){
        // mini_tbp_id: 1, user_id: 9, message: "dfgdfg", doctype: "1"
    //    $revisedocs =  ReviseLog::where('mini_tbp_id',$request->minitbpid)->where('user_id',Auth::user()->id)->where('doctype','1')->get()->each->append('createdatth');
       $revisedocs =  ReviseLog::where('mini_tbp_id',$request->minitbpid)->where('doctype',$request->doctype)->orderBy('id','desc')->get()->each->append('createdatth')->each->append('user');
       return response()->json($revisedocs);
    }
}
