<?php

namespace App\Http\Controllers;

use PDF;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Model\EvaluationResult;
use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\PdfParser\StreamReader;


use App\User;
use DateTimeZone;
use Carbon\Carbon;
use App\Model\Amphur;
use App\Model\Prefix;
use App\Model\Tambol;


use App\Helper\Message;
use App\Model\Province;
use App\Model\ThaiBank;
use App\Helper\EmailBox;
use App\Model\AlertMessage;

use App\Model\UserPosition;

use App\Model\CompanyAddress;
use App\Helper\DateConversion;
use App\Model\SignatureStatus;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;


class DashboardAdminEvaluationResultController extends Controller
{
    public function Index(){
        $fulltbps = FullTbp::where('status',1)->get();
        return view('dashboard.admin.evaluationresult.index')->withFulltbps($fulltbps);
    }
    public function Edit($id){
        $evaluationresult = EvaluationResult::find($id);
        return view('dashboard.admin.evaluationresult.edit')->withEvaluationresult($evaluationresult);
    }

    public function EditSave(Request $request,$id){
        EvaluationResult::find($id)->update([
            'management' => $request->management,
            'technoandinnovation' => $request->technoandinnovation,
            'marketability' => $request->marketability,
            'businessprospect' => $request->businessprospect
        ]);
        return redirect()->back()->withSuccess('แก้ไขข้อมูลการแจ้งผลสำเร็จ');
    }

    public function Pdf($id){
        require_once (base_path('/vendor/notyes/thsplitlib/THSplitLib/segment.php'));
        $segment = new \Segment();
        $fulltbp = FullTbp::find($id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $evaluationresult= EvaluationResult::where('full_tbp_id',$id)->first();
        $data = [
            'fulltbp' => $fulltbp,
            'minitbp' => $minitbp,
            'company' => $company,
            'evaluationresult' => $evaluationresult
        ];
        $pdf = PDF::loadView('dashboard.admin.evaluationresult.pdf', $data);
        $path = public_path("storage/uploads/fulltbp/");
        return $pdf->stream('document.pdf');
    }
    
    public function Certificate($id){

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
                    'R'  => 'opun-regular.ttf',    
                    // 'R'  => 'thsarabunnew-webfont.ttf', 
                    'B'  => 'thsarabunnew_bold-webfont.ttf',       
                    'I'  => 'thsarabunnew_italic-webfont.ttf',    
                    'BI' => 'thsarabunnew_bolditalic-webfont.ttf' 
                ]
            ],
            'default_font' => 'opun',
            'format' => [279, 203]
        ]);

        $evaluationresult = EvaluationResult::find($id);
        $fulltbp = FullTbp::find($evaluationresult->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);

        $fileContent = file_get_contents(asset("assets/dashboard/template/certificate.pdf"),'rb');
        $pagecount = $mpdf->SetSourceFile(StreamReader::createByString($fileContent));
        $tplId = $mpdf->ImportPage($pagecount); 



        $projectname = $minitbp->project;
        // if(strlen($firstparagraph) > 180){
        //     $projectname = substr_replace( $minitpb->project, '<br>', strlen($firstparagraph), 0 );
        // }
        $mpdf->UseTemplate($tplId);

        $mpdf->WriteFixedPosHTML('<span style="font-size: 24pt;">'. $minitbp->project.'</span>', 45, 66.5, 200, 150, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 12pt;">เลขที่</span>', 13, 86.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 12pt;">207001-DM</span>', 50, 86.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 12pt;">โดย</span>', 13, 95, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 12pt;">บริษัท ABC-DM จำกัด</span>', 50, 95, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 12pt;">สาขาเทคโนโลยี</span>', 13, 103.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 12pt;">เทคโนโลยีอาหาร</span>', 50, 103.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 12pt;">ระดับ</span>', 13, 112, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 12pt;">AAA</span>', 50, 112, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 12pt;">ตามระบบการประเมินและจัดอันดับเทคโนโลยีของประเทศ (Thailand Technology Rating System : TTRS</span>', 13, 120.5, 250, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 12pt;">ให้ไว้ ณ วันที่ 23 ตุลาคม พ.ศ. 2563</span>', 13, 135, 200, 90, 'auto');
        $path = public_path("storage/uploads/minitbp/pdf/");
        $mpdf->Output();
    }
    
    public static function FixBreak($data){
        $segment = new \Segment();
        return $segment->get_segment_array($data);
    } 
}
