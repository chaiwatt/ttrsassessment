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
use App\Helper\UserArray;


use App\Model\MessageBox;
use App\Model\ProjectLog;
use App\Model\GeneralInfo;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;

use App\Model\PopupMessage;

use App\Model\ProjectGrade;
use App\Model\UserPosition;
use App\Model\EvaluationDay;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Model\CompanyAddress;
use App\Helper\DateConversion;
use App\Model\EvaluationMonth;
use App\Model\SignatureStatus;
use App\Model\EvaluationResult;

use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use App\Helper\ThaiNumericConverter;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use setasign\Fpdi\PdfParser\StreamReader;
use PhpOffice\PhpPresentation\Style\Color;
use App\Http\Requests\EvaluationResultEdit;
use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\Style\Alignment;

class DashboardAdminEvaluationResultController extends Controller
{
    public function Index(){
        $auth = Auth::user();
        $fulltbps = FullTbp::get();
        // NotificationBubble::where('target_user_id',$auth->id)
        //                     ->where('notification_category_id',3)
        //                     ->where('notification_sub_category_id',9)
        //                     ->where('status',0)->delete();
        NotificationBubble::where('target_user_id',$auth->id)
                            ->where('notification_category_id',4)
                            ->where('notification_sub_category_id',10)
                            ->where('status',0)->delete();
        $generalinfo = GeneralInfo::first();

        $fulltbparr = FullTbp::pluck('id')->toArray();
        $projectassignments =  ProjectAssignment::whereIn('full_tbp_id',$fulltbparr)->get();
        $leaderarr = [];
        foreach($projectassignments as $projectassignment){
            if(!Empty($projectassignment->leader_id)){
               array_push($leaderarr,$projectassignment->leader_id)  ;
            }
        }
        if(count($leaderarr) > 0){
            $leaderarr =array_unique($leaderarr);
        }
       
        $leaders = User::whereIn('id',$leaderarr)->get();


        $expertassignments =  ExpertAssignment::whereIn('full_tbp_id',$fulltbparr)->get();
 
        $expertarr = [];
        foreach($expertassignments as $expertassignment){
            array_push($expertarr,$expertassignment->user_id)  ;
        }

        if(count($expertarr) > 0){
            $expertarr =array_unique($expertarr);
        }
       
        $experts = User::whereIn('id',$expertarr)->get();

        $gradearr = [];
        $gradearr =  ProjectGrade::pluck('grade')->toArray();
        if(count($gradearr) > 0){
            $gradearr =array_unique($gradearr);
        }

        $gradecollection = collect($gradearr);
        $popupmessages = PopupMessage::get();
        return view('dashboard.admin.evaluationresult.index')->withFulltbps($fulltbps)
        ->withLeaders($leaders)
        ->withExperts($experts)
        ->withGradecollection($gradecollection)
        ->withPopupmessages($popupmessages);
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
        $auth = Auth::user();
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
            'evaluation_month_id' => $request->evaluationmonth,
            'evaluation_year' => $request->evaluationyear
        ]);
        $fulltbp = FullTbp::find(EvaluationResult::find($id)->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
  
        $company_name = (!Empty($company->name))?$company->name:'';
        $bussinesstype = $company->business_type_id;
  
        $fullcompanyname = ' ' . $company_name;
        if($bussinesstype == 1){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด (มหาชน)';
        }else if($bussinesstype == 2){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 3){
            $fullcompanyname = ' ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 4){
            $fullcompanyname = ' ห้างหุ้นส่วนสามัญ ' . $company_name; 
        }
  
        
        $arr1 = UserArray::adminandjd($minitbp->business_plan_id);
        $arr2 = UserArray::leader($minitbp->business_plan_id);
        $userarray = array_unique(array_merge($arr1,$arr2));

        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = Auth::user()->id;
        $projectlog->viewer = $userarray;
        $projectlog->action = 'เพิ่ม / แก้ไขบทวิเคราะห์';
        $projectlog->save();

        $jduser = User::where('user_type_id',6)->first();

        $messagebox = Message::sendMessage('เพิ่ม / แก้ไขบทวิเคราะห์'.$minitbp->project .$fullcompanyname,'คุณ'.$auth->name . ' ' . $auth->lastname.' ได้เพิ่ม / แก้ไข บทวิเคราะห์ โครงการ'.$minitbp->project .$fullcompanyname.' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.evaluationresult.edit',['id' => $fulltbp->id]).'>ดำเนินการ</a>',$auth->id,$jduser->id);

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $jduser->id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' เพิ่ม / แก้ไขบทวิเคราะห์'.$minitbp->project;
        $alertmessage->save();

        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $minitbp->business_plan_id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 5;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $jduser->id;
        $notificationbubble->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send($jduser->email,'','TTRS: เพิ่ม / แก้ไขบทวิเคราะห์'.$minitbp->project .$fullcompanyname,'เรียน Manager<br><br> คุณ'.$auth->name . ' ' . $auth->lastname.' ได้เพิ่ม / แก้ไข บทวิเคราะห์ โครงการ'.$minitbp->project .$fullcompanyname.' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.evaluationresult.edit',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        
        CreateUserLog::createLog('เพิ่ม / แก้ไขบทวิเคราะห์ โครงการ' . $minitbp->project);
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
        return $pdf->stream('หนังสือแจ้งผลโครงการเลขที่ '.$fulltbp->fulltbp_code.' '.$company->fullname.'.pdf');
    }
    public function Word($id){
        $evaluationresult = EvaluationResult::find($id);
        $fulltbp = FullTbp::find($evaluationresult->full_tbp_id);
        $generalinfo = GeneralInfo::first();
        //หนังสือแจ้งผลโครงการเลขที่ 2108002  ห้างหุ้นส่วน ไทยชนะรีสอร์ต จำกัด (1).pdf
        $wordtemplate = new TemplateProcessor(asset("assets/dashboard/template/letter.docx"));
        $wordtemplate->setValue('headercode',ThaiNumericConverter::toThaiNumeric($evaluationresult->headercode));
        $wordtemplate->setValue('_day',ThaiNumericConverter::toThaiNumeric($evaluationresult->evaluation_day_id));
        $wordtemplate->setValue('_month',$evaluationresult->month->name);
        $wordtemplate->setValue('_year',ThaiNumericConverter::toThaiNumeric($evaluationresult->evaluation_year));
        $wordtemplate->setValue('respname',$fulltbp->fulltbpresponsibleperson->name);
        $wordtemplate->setValue('resplastname',$fulltbp->fulltbpresponsibleperson->lastname);
        $wordtemplate->setValue('company',$fulltbp->minitbp->businessplan->company->fullname);
        $wordtemplate->setValue('projectno',ThaiNumericConverter::toThaiNumeric($fulltbp->fulltbp_code));
        $wordtemplate->setValue('projectname',$fulltbp->minitbp->project);
        $wordtemplate->setValue('score',ThaiNumericConverter::toThaiNumeric(number_format($fulltbp->projectgrade->percent, 2, '.', '')));
        $wordtemplate->setValue('grade',$fulltbp->projectgrade->grade);
        $wordtemplate->setValue('management',strip_tags($evaluationresult->management));
        $wordtemplate->setValue('technology',strip_tags($evaluationresult->technoandinnovation));
        $wordtemplate->setValue('marketability',strip_tags($evaluationresult->marketability));
        $wordtemplate->setValue('prospect',strip_tags($evaluationresult->businessprospect));
        $wordtemplate->setValue('leadername',$evaluationresult->contactname);
        $wordtemplate->setValue('leaderlastname',$evaluationresult->contactlastname);
        $wordtemplate->setValue('leaderposition',$evaluationresult->contactposition);
        $wordtemplate->setValue('phone',ThaiNumericConverter::toThaiNumeric($generalinfo->phone1));
        $wordtemplate->setValue('phoneext', ThaiNumericConverter::toThaiNumeric($evaluationresult->contactphoneext));
        $wordtemplate->setValue('leaderemail',$evaluationresult->contactemail);
        $wordtemplate->setValue('fax',ThaiNumericConverter::toThaiNumeric($evaluationresult->contactfax));
        $wordtemplate->saveAs($fulltbp->fulltbp_code.'.docx');
        return response()->download($fulltbp->fulltbp_code.'.docx');
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
        $fullcompanyname = ' ' . $company_name;

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
            ->setLastModifiedBy('TTRS')
            ->setTitle('Certificate')
            ->setSubject('Certificate')
            ->setDescription('Certificate')
            ->setKeywords('office 2007 TTRS Certificate')
            ->setCategory('TTRS');
        $objPHPPowerPoint->removeSlideByIndex(0);
        $slide = $objPHPPowerPoint->createSlide();
                   
        $shapeheader = $slide->createRichTextShape()
                ->setHeight(60)
                ->setWidth(1000)
                ->setOffsetX(190)
                ->setOffsetY(150);
        $headertextRun = $shapeheader->createTextRun($minitbp->project. ' ' . $minitbp->projecteng);
        $headertextRun->getFont()->setBold(true)
                ->setName('PSL-Kittithada')
                ->setSize(38);

        $shapeheader = $slide->createRichTextShape()
                ->setHeight(40)
                ->setWidth(1000)
                ->setOffsetX(40)
                ->setOffsetY(210);
        $headertextRun = $shapeheader->createTextRun('เลขที่                '.$fulltbp->fulltbp_code);
        $headertextRun->getFont()->setBold(true)
                ->setName('PSL-Kittithada')
                ->setSize(18);

        $shapeone = $slide->createRichTextShape()
                ->setHeight(40)
                ->setWidth(1000)
                ->setOffsetX(40)
                ->setOffsetY(245);
        $headertextRun = $shapeone->createTextRun('โดย                 '. $fullcompanyname);
        $headertextRun->getFont()->setBold(true)
                ->setName('PSL-Kittithada')
                ->setSize(18);


        $shapetwo = $slide->createRichTextShape()
                ->setHeight(40)
                ->setWidth(1000)
                ->setOffsetX(40)
                ->setOffsetY(280);
        $headertextRun = $shapetwo->createTextRun('สาขาเทคโนโลยี        '. $company->industrygroup->name);
        $headertextRun->getFont()->setBold(true)
                ->setName('PSL-Kittithada')
                ->setSize(18);
        
        $shapethree = $slide->createRichTextShape()
                ->setHeight(40)
                ->setWidth(1000)
                ->setOffsetX(40)
                ->setOffsetY(315);
        $headertextRun = $shapethree->createTextRun('ระดับ                '.$fulltbp->projectgrade->grade);
        $headertextRun->getFont()->setBold(true)
                ->setName('PSL-Kittithada')
                ->setSize(18);

        $shapefour = $slide->createRichTextShape()
                ->setHeight(40)
                ->setWidth(1000)
                ->setOffsetX(40)
                ->setOffsetY(350);
        $headertextRun = $shapefour->createTextRun('ตามระบบการประเมินและจัดอันดับเทคโนโลยีของประเทศ (Thailand Technology Rating System : TTRS)');
        $headertextRun->getFont()->setBold(true)
                ->setName('PSL-Kittithada')
                ->setSize(18);

        $shapefive = $slide->createRichTextShape()
                ->setHeight(40)
                ->setWidth(1000)
                ->setOffsetX(40)
                ->setOffsetY(430);
        $headertextRun = $shapefive->createTextRun('ให้ไว้ ณ วันที่ ' .ltrim(Carbon::today()->format('d'), '0'). ' '. $strMonthCut[intval(Carbon::today()->format('m'))].' พ.ศ. '.(Carbon::today()->format('Y')+543));
        $headertextRun->getFont()->setBold(true)
                ->setName('PSL-Kittithada')
                ->setSize(18);
          
        $shapesix = $slide->createRichTextShape()
                ->setHeight(40)
                ->setWidth(1000)
                ->setOffsetX(150)
                ->setOffsetY(490);
        $headertextRun = $shapesix->createTextRun('(' .$generalinfo->director. ')');
        $headertextRun->getFont()->setBold(false)
                ->setName('PSL-Kittithada')
                ->setSize(26);
        $fname = 'ใบรับรองโครงการเลขที่ '.$fulltbp->fulltbp_code.' '.$company->fullname.'.pptx';
        header("Content-Type: application/vnd.openxmlformats-officedocument.presentationml.presentation");
        header("Content-Disposition: attachment; filename=$fname");
        $oWriterPPTX = IOFactory::createWriter($objPHPPowerPoint, 'PowerPoint2007');
        $oWriterPPTX->save('php://output');
        //$oWriterPPTX->save("sample.pptx");
        // 'ใบรับรองโครงการเลขที่ '.$fulltbp->fulltbp_code.' '.$company->fullname.'
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
            'format' => [274, 191]
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
        $fullcompanyname = ' ' . $company_name;

        if($bussinesstype == 1){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด (มหาชน)';
        }else if($bussinesstype == 2){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 3){
            $fullcompanyname = ' ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 4){
            $fullcompanyname = ' ห้างหุ้นส่วนสามัญ ' . $company_name; 
        }

        $pagecount = $mpdf->SetSourceFile(StreamReader::createByString($fileContent));
        $tplId = $mpdf->ImportPage($pagecount); 

		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[intval(Carbon::today()->format('m'))];

        $projectname = $minitbp->project;
        $mpdf->UseTemplate($tplId);
        $mpdf->WriteFixedPosHTML('<span style="font-size: 37pt;">'. $minitbp->project. ' ' . $minitbp->projecteng.'</span>', 45, 58.55, 250, 150, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>เลขที่</strong></span>', 13, 84, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>'.$fulltbp->fulltbp_code.'</strong></span>', 45, 84, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>โดย</strong></span>', 13, 92.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>'.$fullcompanyname.'</strong></span>', 45, 92.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>สาขาเทคโนโลยี</strong></span>', 13, 101.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>'.$company->industrygroup->name.'</strong></span>', 45, 101.5, 250, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>ระดับ</strong></span>', 13, 109.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>'. $fulltbp->projectgrade->grade.'</strong></span>', 45, 109.5, 150, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>ตามระบบการประเมินและจัดอันดับเทคโนโลยีของประเทศ (Thailand Technology Rating System : TTRS)</strong></span>', 13, 118, 250, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 18pt;"><strong>ให้ไว้ ณ วันที่ '.ltrim(Carbon::today()->format('d'), '0').' '.$strMonthCut[intval(Carbon::today()->format('m'))].' พ.ศ. '.(Carbon::today()->format('Y')+543).'</strong></span>', 13, 132.5, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<div style="font-size: 26pt;width:350px;heigh:100px;text-align:center;margin-left:20px">('.$generalinfo->director.')</div>', 14,148, 200, 90, 'auto');
        $path = public_path("storage/uploads/minitbp/pdf/");
        $mpdf->Output('ใบรับรองโครงการเลขที่ '.$fulltbp->fulltbp_code.' '.$company->fullname.'.pdf', 'I');
        // return $pdf->stream('หนังสือแจ้งผลโครงการเลขที่ '.$fulltbp->fulltbp_code.' '.$company->fullname.'.pdf');
    }
    
    public static function FixBreak($data){
        $data = str_replace("</p><p>","",$data);
        $segment = new \Segment();
        return $segment->get_segment_array($data);
    } 

    public static function FixBreak2($data){
        $data = str_replace("</p><p>","",$data);
        $segment = new \Segment();
        return $segment->get_segment_array_org($data);
    } 

    public static function FixBreak3($data){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.aiforthai.in.th/tlexplus?text=".$data,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Apikey: YG6FG6ur6kI58eDdKwYNBkQavGeaaVBX"
          )
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            echo implode("|",json_decode($response)->tokens);
        }
        
    } 
}
