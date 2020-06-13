<?php

namespace App\Http\Controllers;

use App\Model\Company;
use App\Model\MiniTBP;
use App\Model\ThaiBank;
use App\Model\BusinessPlan;
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
        return view('dashboard.company.minitbp.edit')->withMinitbp($minitbp)
                                                ->withBanks($banks)
                                                ->withCompany($company);
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
            'finance2' => $request->finance2,
            'finance3' => $request->finance3,
            'finance4' => $request->finance4
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
        $fileContent = file_get_contents(asset("assets/dashboard/template/minitbp.pdf"),'rb');
        $pagecount = $mpdf->SetSourceFile(StreamReader::createByString($fileContent));
        $tplId = $mpdf->ImportPage($pagecount);    
        $mpdf->UseTemplate($tplId);
        $mpdf->WriteFixedPosHTML($auth->name, 68, 74, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($company->name, 68, 83, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML($company->address, 68, 92, 150, 90, 'auto');
        $mpdf->Output();
    }
    
}
