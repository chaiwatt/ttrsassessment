<?php

namespace App\Http\Controllers;

use App\Model\Prefix;
use App\Model\Company;
use App\Model\MiniTBP;
use App\Model\ThaiBank;
use App\Model\BusinessPlan;
use App\Model\UserPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\PdfParser\StreamReader;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class DashboardCompanyMiniTBPController extends Controller
{
    public function Index(){
        $company = Company::where('user_id',Auth::user()->id)->first();
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        $minitbps = MiniTBP::where('business_plan_id',$businessplan->id)->get();
        return view('dashboard.company.minitbp.index')->withMinitbps($minitbps);
    }
    public function Edit($id){
        $company = Company::where('user_id',Auth::user()->id)->first();
        $banks = ThaiBank::get();
        $minitbp = MiniTBP::find($id);
        $contactprefixes = Prefix::get();
        $contactpositions = UserPosition::get();
        return view('dashboard.company.minitbp.edit')->withMinitbp($minitbp)
                                                ->withBanks($banks)
                                                ->withCompany($company)
                                                ->withContactprefixes($contactprefixes)
                                                ->withContactpositions($contactpositions);
    }
    public function Pdf(){
        require_once(base_path('/vendor/notyes/thsplitlib/THSplitLib/segment.php'));
        $segment = new \Segment();
        $body = 'หาดทรายละเอียดสีขาว ตัดกับท้องฟ้าและน้ำทะเลสีครามใส คือบรรยากาศของท้องทะเลไทย ในช่วงของการแพร่ระบาดไวรัสโควิด-19 หาดทรายละเอียดสีขาว ตัดกับท้องฟ้าและน้ำทะเลสีครามใส คือบรรยากาศของท้องทะเลไทย ในช่วงของการแพร่ระบาดไวรัสโควิด-19';
        $words = $segment->get_segment_array($body);
        $text = implode("|",$words);
        $data = ['title'=> 'DomPDF with Laravel','body'=> $text];
        $pdf = Pdf::loadView('dashboard.company.minitbp.pdf',$data);
        return $pdf->stream('document.pdf');
    }
    public function EditSave(Request $request,$id){
        MiniTBP::find($id)->update([
            'project' => $request->project,
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
            'contactposition_id' => $request->contactposition,
            'contactphone' => $request->contactphone,
            'contactemail' => $request->contactemail,
        ]);
        return  redirect()->back()->withSuccess('แก้ไขรายการสำเร็จ');
    }

    public function DownloadPDF($id){
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
                    'R'  => 'Kanit-Light.ttf',    
                    'B'  => 'Kanit-Bold.ttf',       
                    'I'  => 'Kanit-Italic.ttf',    
                    'BI' => 'Kanit-Bold-Italic.ttf' 
                ]
            ],
            'default_font' => 'kanit',
        ]);
        $auth = Auth::user();
        $company = Company::where('user_id',$auth->id)->first();
        $minitpb = MiniTBP::find($id); 
        // return $minitpb->businessplan;
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
        
        $fileContent = file_get_contents(asset("assets/dashboard/template/minitbp.pdf"),'rb');
        $pagecount = $mpdf->SetSourceFile(StreamReader::createByString($fileContent));
        $tplId = $mpdf->ImportPage($pagecount);    
        $mpdf->UseTemplate($tplId);
        $mpdf->WriteFixedPosHTML('<span style="font-size: 10pt;">'.$minitpb->prefix->name.'</span>', 68, 74, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($company->name, 68, 83, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 10pt;">'.$minitpb->contactname.'</span>', 75, 74, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 10pt;">'.$minitpb->contactlastname.'</span>', 90, 74, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($finance1_text, 20, 152.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 10pt;">'.$finance1_bank.'</span>', 57, 153, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 10pt;">'.$finance1_loan.'</span>', 60, 159, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($finance2_text, 20, 165.2, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($finance3_text, 20, 177.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($finance4_text, 20, 184, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 10pt;">'.$finance4_joint.'</span>', 62, 190.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 10pt;">'.$finance4_joint_min.'</span>', 78, 197.2, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 10pt;">'.$finance4_joint_max.'</span>', 92, 197.2, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance1_text, 105.2, 152.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance2_text, 105.2, 158.8, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance3_text, 105.2, 165.1, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance4_text, 105.2, 171.4, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance5_text, 105.2, 177.6, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 10pt;">'.$nonefinance5_detail.'</span>', 111, 184.1, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($nonefinance6_text, 105.2, 190.3, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 10pt;">'.$nonefinance6_detail.'</span>', 111, 197, 150, 90, 'auto');
        
        $mpdf->Output();
    }
    
}
// 