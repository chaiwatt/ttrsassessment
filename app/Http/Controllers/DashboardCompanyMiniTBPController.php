<?php

namespace App\Http\Controllers;

use App\Model\Prefix;
use App\Model\Company;
use App\Model\MiniTBP;
use App\Model\ThaiBank;
use App\Model\BusinessPlan;
use App\Model\UserPosition;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
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
            'website' => $request->website,
        ]);
        return  redirect()->back()->withSuccess('แก้ไขรายการสำเร็จ');
    }

    public function DownloadPDF($id){
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
        $minitpb = MiniTBP::find($id); 
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
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$company->name.'</span>', 69, 86.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$company->address. ' ตำบล'. $company->tambol->name .' อำเภอ'. $company->amphur->name .' จังหวัด'. $company->province->name. ' ' .$company->postalcode.'</span>', 69, 94.5, 150, 90, 'auto');
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
        $mpdf->Output();
    }
    
    public function Submit($id){
        $minitbp = MiniTBP::find($id);
        return view('dashboard.company.minitbp.submit')->withMinitbp($minitbp);
    }
    public function SubmitSave(Request $request, $id){
        $minitbp = MiniTBP::find($id);
        if(!Empty($minitbp->attachment)){
            @unlink($minitbp->attachment);
        }
        $file = $request->attachment;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/minitbp/attachment" , $new_name);
        $filelocation = "storage/uploads/minitbp/attachment/".$new_name;
        $minitbp->update([
            'attachment' => $filelocation
        ]);

        BusinessPlan::find(MiniTBP::find($id)->business_plan_id)->update([
            'business_plan_status_id' => 3
        ]);

        return redirect()->route('dashboard.company.minitbp')->withSuccess('ส่งเอกสาร mini TBP สำเร็จ');
    }
}
