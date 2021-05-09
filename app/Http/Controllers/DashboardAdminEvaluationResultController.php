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
use App\Model\GeneralInfo;


use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\UserPosition;
use App\Model\EvaluationDay;
use Illuminate\Http\Request;

use App\Helper\CreateUserLog;

use App\Model\CompanyAddress;
use App\Helper\DateConversion;
use App\Model\EvaluationMonth;
use App\Model\SignatureStatus;
use App\Model\EvaluationResult;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\PdfParser\StreamReader;
use App\Http\Requests\EvaluationResultEdit;

use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\Alignment;

class DashboardAdminEvaluationResultController extends Controller
{
    public function Index(){
        $fulltbps = FullTbp::get();
        $generalinfo = GeneralInfo::first();
        return view('dashboard.admin.evaluationresult.index')->withFulltbps($fulltbps)->withGeneralinfo($generalinfo);
    }
    public function Edit($id){
        $evaluationmonths = EvaluationMonth::get();
        $evaluationdays = EvaluationDay::get();
        $evaluationresult = EvaluationResult::find($id);
        $fulltbp = FullTbp::find($evaluationresult->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $user = User::find($projectassignment->leader_id);
        $generalinfo = GeneralInfo::first();
        return view('dashboard.admin.evaluationresult.edit')->withEvaluationresult($evaluationresult)
                                                        ->withUser($user)
                                                        ->withGeneralinfo($generalinfo)
                                                        ->withEvaluationmonths($evaluationmonths)
                                                        ->withEvaluationdays($evaluationdays);
    }

    public function EditSave(EvaluationResultEdit $request,$id){
        EvaluationResult::find($id)->update([
            'headercode' => $request->headercode,
            'contactname' => $request->contactname,
            'contactlastname' => $request->contactlastname,
            'contactposition' => $request->contactposition,
            'contactphone' => $request->contactphone,
            'contactphoneext' => $request->contactphoneext,
            'contactfax' => $request->contactfax,
            'contactemail' => $request->contactemail,
            'management' => $request->management,
            'technoandinnovation' => $request->technoandinnovation,
            'marketability' => $request->marketability,
            'businessprospect' => $request->businessprospect,
            'evaluation_day_id' => $request->evaluationday,
            'evaluation_month_id' => $request->evaluationmonth
        ]);
        $fulltbp = FullTbp::find(EvaluationResult::find($id)->full_tbp_id);
        CreateUserLog::createLog('เพิ่ม/แก้ไขบทวิเคราะห์ โครงการ' . MiniTBP::find($fulltbp->mini_tbp_id)->project);
        return redirect()->route('dashboard.admin.evaluationresult')->withSuccess('เพิ่มบทวิเคราะห์สำเร็จ');
    }

    public function Pdf($id){
        require_once (base_path('/vendor/notyes/thsplitlib/THSplitLib/segment.php'));
        $segment = new \Segment();
        $fulltbp = FullTbp::find($id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $evaluationresult= EvaluationResult::where('full_tbp_id',$id)->first();
        $generalinfo = GeneralInfo::first();
        $data = [
            'fulltbp' => $fulltbp,
            'minitbp' => $minitbp,
            'company' => $company,
            'evaluationresult' => $evaluationresult,
            'generalinfo' => $generalinfo
        ];
        $pdf = PDF::loadView('dashboard.admin.evaluationresult.pdf', $data);
        $path = public_path("storage/uploads/fulltbp/");
        return $pdf->stream('document.pdf');
    }
    

    public function Ppt($id){
        $fulltbp = FullTbp::find($id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $evaluationresult= EvaluationResult::where('full_tbp_id',$id)->first();
        $generalinfo = GeneralInfo::first();
        $company_name = (!Empty($company->name))?$company->name:'';
        $bussinesstype = $company->business_type_id;
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
        $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[intval(Carbon::today()->format('m'))];

        $objPHPPowerPoint = new PhpPresentation();
        $objPHPPowerPoint->getDocumentProperties()->setCreator('PHPOffice')
            ->setLastModifiedBy('PHPPresentation Team')
            ->setTitle('Sample 02 Title')
            ->setSubject('Sample 02 Subject')
            ->setDescription('Sample 02 Description')
            ->setKeywords('office 2007 openxml libreoffice odt php')
            ->setCategory('Sample Category');
        $objPHPPowerPoint->removeSlideByIndex(0);
        $slide = $objPHPPowerPoint->createSlide();
                   
        $shapeheader = $slide->createRichTextShape()
                ->setHeight(60)
                ->setWidth(800)
                ->setOffsetX(190)
                ->setOffsetY(150);
        $headertextRun = $shapeheader->createTextRun($minitbp->project. ' ' . $minitbp->projecteng);
        $headertextRun->getFont()->setBold(true)
                ->setName('PSL-Kittithada')
                ->setSize(38);

        $shapeheader = $slide->createRichTextShape()
                ->setHeight(40)
                ->setWidth(800)
                ->setOffsetX(50)
                ->setOffsetY(210);
        $headertextRun = $shapeheader->createTextRun('เลขที่                '.$fulltbp->fulltbp_code);
        $headertextRun->getFont()->setBold(true)
                ->setName('PSL-Kittithada')
                ->setSize(18);

        $shapeone = $slide->createRichTextShape()
                ->setHeight(40)
                ->setWidth(800)
                ->setOffsetX(50)
                ->setOffsetY(245);
        $headertextRun = $shapeone->createTextRun('โดย                 '. $fullcompanyname);
        $headertextRun->getFont()->setBold(true)
                ->setName('PSL-Kittithada')
                ->setSize(18);


        $shapetwo = $slide->createRichTextShape()
                ->setHeight(40)
                ->setWidth(800)
                ->setOffsetX(50)
                ->setOffsetY(280);
        $headertextRun = $shapetwo->createTextRun('สาขาเทคโนโลยี        '. $company->industrygroup->name);
        $headertextRun->getFont()->setBold(true)
                ->setName('PSL-Kittithada')
                ->setSize(18);

        
        $shapethree = $slide->createRichTextShape()
                ->setHeight(40)
                ->setWidth(800)
                ->setOffsetX(50)
                ->setOffsetY(315);
        $headertextRun = $shapethree->createTextRun('ระดับ                '.$fulltbp->projectgrade->grade);
        $headertextRun->getFont()->setBold(true)
                ->setName('PSL-Kittithada')
                ->setSize(18);


        
        $shapefour = $slide->createRichTextShape()
                ->setHeight(40)
                ->setWidth(800)
                ->setOffsetX(50)
                ->setOffsetY(350);
        $headertextRun = $shapefour->createTextRun('ตามระบบการประเมินและจัดอันดับเทคโนโลยีของประเทศ (Thailand Technology Rating System : TTRS)');
        $headertextRun->getFont()->setBold(true)
                ->setName('PSL-Kittithada')
                ->setSize(18);


        $shapefive = $slide->createRichTextShape()
                ->setHeight(40)
                ->setWidth(800)
                ->setOffsetX(50)
                ->setOffsetY(430);
        $headertextRun = $shapefive->createTextRun('ให้ไว้ ณ วันที่ ' .ltrim(Carbon::today()->format('d'), '0'). ' '. $strMonthCut[intval(Carbon::today()->format('m'))].' พ.ศ. '.(Carbon::today()->format('Y')+543));
        $headertextRun->getFont()->setBold(true)
                ->setName('PSL-Kittithada')
                ->setSize(18);
                //
          
        $shapesix = $slide->createRichTextShape()
                ->setHeight(40)
                ->setWidth(800)
                ->setOffsetX(150)
                ->setOffsetY(490);
        $headertextRun = $shapesix->createTextRun('(' .$generalinfo->director. ')');
        $headertextRun->getFont()->setBold(false)
                ->setName('PSL-Kittithada')
                ->setSize(26);

        header("Content-Type: application/vnd.openxmlformats-officedocument.presentationml.presentation");
        header("Content-Disposition: attachment; filename=certificate.pptx");
        $oWriterPPTX = IOFactory::createWriter($objPHPPowerPoint, 'PowerPoint2007');
        $oWriterPPTX->save('php://output');
        //$oWriterPPTX->save("sample.pptx");
    }

    public function Certificate($id,$type){
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
                'kittithada' => [
                    'R'  => 'PSL-Kittithada.ttf',    
                    'B'  => 'PSL-KittithadaBold.ttf',       
                    'I'  => 'PSL-KittithadaItalic.ttf',    
                    'BI' => 'PSL-KittithadaBoldItalic.ttf' 
                ]
            ],
            'default_font' => 'kittithada',
            'format' => [279, 203]
        ]);
        // $mpdf->SetCompression(false);
        $evaluationresult = EvaluationResult::find($id);
        $fulltbp = FullTbp::find($evaluationresult->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $generalinfo = GeneralInfo::first();
        $fileContent = file_get_contents(asset("assets/dashboard/template/certificate.pdf"),'rb');
        if($type == 2){
            $fileContent = file_get_contents(asset("assets/dashboard/template/blankcertificate.pdf"),'rb');
        }
        
        $company_name = (!Empty($company->name))?$company->name:'';
        $bussinesstype = $company->business_type_id;
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

        $pagecount = $mpdf->SetSourceFile(StreamReader::createByString($fileContent));
        $tplId = $mpdf->ImportPage($pagecount); 

		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[intval(Carbon::today()->format('m'))];

        $projectname = $minitbp->project;
        $mpdf->UseTemplate($tplId);
        $mpdf->WriteFixedPosHTML('<span style="font-size: 37pt;">'. $minitbp->project. ' ' . $minitbp->projecteng.'</span>', 45, 69.5, 200, 150, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>เลขที่</strong></span>', 13, 84, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>'.$fulltbp->fulltbp_code.'</strong></span>', 50, 84, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>โดย</strong></span>', 13, 92.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>'.$fullcompanyname.'</strong></span>', 50, 92.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>สาขาเทคโนโลยี</strong></span>', 13, 101.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>'.$company->industrygroup->name.'</strong></span>', 50, 101.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>ระดับ</strong></span>', 13, 109.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>'. $fulltbp->projectgrade->grade.'</strong></span>', 50, 109.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>ตามระบบการประเมินและจัดอันดับเทคโนโลยีของประเทศ (Thailand Technology Rating System : TTRS)</strong></span>', 13, 118, 250, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>ให้ไว้ ณ วันที่ '.ltrim(Carbon::today()->format('d'), '0').' '.$strMonthCut[intval(Carbon::today()->format('m'))].' พ.ศ. '.(Carbon::today()->format('Y')+543).'</strong></span>', 13, 132.5, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<div style="font-size: 26pt;width:350px;heigh:100px;text-align:center;margin-left:20px">('.$generalinfo->director.')</div>', 14,160, 200, 90, 'auto');
        $path = public_path("storage/uploads/minitbp/pdf/");
        $mpdf->Output();
    }
    
    public static function FixBreak($data){
        $segment = new \Segment();
        return $segment->get_segment_array($data);
    } 
}
