<?php

namespace App\Http\Controllers;

use PDF;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Model\EvaluationResult;
use setasign\Fpdi\PdfParser\StreamReader;

class DashboardCompanyInvoiceController extends Controller
{
//         public function Invoice($id){
//             // require_once (base_path('/vendor/notyes/thsplitlib/THSplitLib/segment.php'));
//             // $segment = new \Segment();
//             $fulltbp = FullTbp::find($id);
//             // $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
//             // $businessplan = BusinessPlan::find($minitbp->business_plan_id);
//             // $company = Company::find($businessplan->company_id);
//             // $ceo = CompanyEmploy::where('full_tbp_id',$id)->where('employ_position_id',1)->first();
//             // $companyboards = CompanyEmploy::where('full_tbp_id',$id)->where('employ_position_id','<=',5)->where('id','!=',$ceo->id)->get();
//             // $companyemploys = CompanyEmploy::where('full_tbp_id',$id)->where('employ_position_id','>',5)->where('id','!=',$ceo->id)->get();
//             // $companyemploys = FullTbpResearcher::where('full_tbp_id',$id)->get(); 
//             // return  $companyemploys;
//             // $companyhistory = $segment->get_segment_array($company->companyhistory);
//             // $companystockholders = CompanyStockHolder::where('company_id',$company->id)->get();
//             $data = [
//                 'fulltbp' => $fulltbp
//             ];

//             // $pdf = PDF::loadView('dashboard.company.project.fulltbp.pdf', $data);
//             // $path = public_path("storage/uploads/");
//             // $pdf->save($path.$fulltbpcode.'invoice.pdf');

//             $pdf = PDF::loadView('dashboard.company.project.invoice.invoicepdf', $data);
//             // $path = public_path("storage/uploads/fulltbp/");
//             return $pdf->stream('document.pdf');
//         }

        
//         // public function SampleInvoice(){
//         //     $data = [
//         //         'fulltbp' => 'nothing'
//         //     ];
//         //     $pdf = PDF::loadView('dashboard.company.project.invoice.invoicepdf', $data);
//         //     return $pdf->stream('document.pdf');
//         // }


public function Invoice($id){

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
        [
            'tempDir' => base_path('public/storage')
        ],
        'fontdata' => $fontData + [
            'opun' => [
                'R'  => 'thsarabunnew-webfont.ttf',    
                'B'  => 'thsarabunnew_bold-webfont.ttf',       
                'I'  => 'thsarabunnew_italic-webfont.ttf',    
                'BI' => 'thsarabunnew_bolditalic-webfont.ttf' 
            ]
        ],
        'default_font' => 'opun'
    ]);

    $evaluationresult = EvaluationResult::find($id);
    $fulltbp = FullTbp::find($evaluationresult->full_tbp_id);
    $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
    $businessplan = BusinessPlan::find($minitbp->business_plan_id);
    $company = Company::find($businessplan->company_id);

    $fileContent = file_get_contents(asset("assets/dashboard/template/invoice.pdf"),'rb');
    $pagecount = $mpdf->SetSourceFile(StreamReader::createByString($fileContent));
    $tplId = $mpdf->ImportPage($pagecount); 

    $projectname = $minitbp->project;
    $mpdf->UseTemplate($tplId);

    $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">TTRS0000001</span>', 50, 37.8, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">คุณชัยวัฒน์ ทวีจันทร์</span>', 44, 43, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">บริษัท เอ็นพีซีโซลูชั่นแอนด์เซอร์วิส จำกัด</span>', 41, 53.5, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">105 หมู่ที่ 8 ตำบลเหมืองง่า อำเภอเมือง จังหวัดลำพูน</span>', 16, 68, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">โทร: 088-2514838 อีเมล: npcsolutionandservice@gmail.com</span>', 16, 73, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">ก0012020</span>', 157, 38.6, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">30/11/2020</span>', 133.5, 44.2, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">TTRS2020001</span>', 163, 49.7, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">TTRS2020002</span>', 163, 55.3, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">TTRS2020003</span>', 160, 61, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">31/11/2020</span>', 160, 67, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">TTRS2020004</span>', 163, 72.3, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">01201245124514</span>', 55, 81.3, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">สำนักงานใหญ่</span>', 106, 81.3, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)</span>', 46, 86.5, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">1</span>', 19, 109, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">ค่าธรรมเนียมการประเมินเทคโนโลยี</span>', 30, 109, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">35,000.00</span>', 177, 109, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">32,710.28</span>', 177, 165, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">2,289.72</span>', 177, 172.5, 200, 90, 'auto');
    $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">35,000.00</span>', 177, 179.5, 200, 90, 'auto');
    $path = public_path("storage/uploads/minitbp/pdf/");
    $mpdf->Output();
}

}
