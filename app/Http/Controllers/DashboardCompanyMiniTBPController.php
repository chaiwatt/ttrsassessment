<?php

namespace App\Http\Controllers;

use App\Model\Company;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use setasign\Fpdi\PdfParser\StreamReader;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\Auth;

class DashboardCompanyMiniTBPController extends Controller
{
    public function Edit(){
     $company = Company::where('user_id',Auth::user()->id)->first();
     $businessplan = BusinessPlan::where('company_id',$company->id)->first();
     $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
     return view('dashboard.company.minitbp.edit')->withMinitbp($minitbp);
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
}
