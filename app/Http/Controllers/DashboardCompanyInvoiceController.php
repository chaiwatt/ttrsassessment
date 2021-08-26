<?php

namespace App\Http\Controllers;

use PDF;
use App\User;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Model\ThaiBank;
use App\Helper\EmailBox;
use App\Model\MessageBox;
use App\Model\GeneralInfo;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Helper\DateConversion;
use App\Model\EvaluationResult;
use App\Model\ProjectAssignment;
use App\Model\InvoiceTransaction;
use App\Model\NotificationBubble;
use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\PdfParser\StreamReader;
use App\Http\Requests\EditPaymentNotification;

class DashboardCompanyInvoiceController extends Controller
{
    public function Index(){
        NotificationBubble::where('target_user_id',Auth::user()->id)
                    ->where('notification_category_id',1)
                    ->where('notification_sub_category_id',3)
                    ->where('status',0)->delete();
        $auth = Auth::user();
        $invoicetransactions = InvoiceTransaction::where('company_id',$auth->company->id)->where('status','>',0)->get();
        return view('dashboard.company.project.invoice.index')->withInvoicetransactions($invoicetransactions);
    }
    public function View($id){
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
                'opun' => [
                    'R'  => 'thsarabunnew-webfont.ttf',    
                    'B'  => 'thsarabunnew_bold-webfont.ttf',       
                    'I'  => 'thsarabunnew_italic-webfont.ttf',    
                    'BI' => 'thsarabunnew_bolditalic-webfont.ttf' 
                ]
            ],
            'default_font' => 'opun'
        ]);
        // $mpdf->SetCompression(false);
        $invoicetransaction = InvoiceTransaction::find($id);
        $company = Company::find($invoicetransaction->company_id);
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        
        $generalinfo = GeneralInfo::first();
        $fileContent = file_get_contents(asset("assets/dashboard/template/invoice.pdf"),'rb');
        $pagecount = $mpdf->SetSourceFile(StreamReader::createByString($fileContent));
        $tplId = $mpdf->ImportPage($pagecount); 

        $projectname = $minitbp->project;
        $mpdf->UseTemplate($tplId);

        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">'.$invoicetransaction->customer.'</span>', 50, 37.8, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">คุณ'.$minitbp->contactname.' ' .$minitbp->contactlastname.'</span>', 44, 43, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">บริษัท '.$company->name.'</span>', 41, 53.5, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">'.$company->companyaddress->first()->address.'</span>', 16, 66, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">ตำบล'.$company->companyaddress->first()->tambol->name.' อำเภอ'.$company->companyaddress->first()->amphur->name.' จังหวัด'.$company->companyaddress->first()->province->name.'</span>', 16, 71, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">โทร: '.$company->phone.' อีเมล: '.$company->email.'</span>', 16, 76, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">'.$invoicetransaction->docno.'</span>', 157, 38.6, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">'.DateConversion::engToThaiDate($invoicetransaction->issuedate).'</span>', 133.5, 44.2, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">'.$invoicetransaction->quotationno.'</span>', 163, 49.7, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">'.$invoicetransaction->purchaseorderno.'</span>', 163, 55.3, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">'.$invoicetransaction->saleorderno.'</span>', 160, 61, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">'.DateConversion::engToThaiDate($invoicetransaction->saleorderdate).'</span>', 160, 67, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">'.$invoicetransaction->refno.'</span>', 163, 72.3, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">'.$company->vatno.'</span>', 55, 83.4, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">สำนักงานใหญ่</span>', 106, 83.4, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">'.$generalinfo->company.'</span>', 46, 88.3, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">1</span>', 19, 109, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 9pt;">'.$invoicetransaction->description.'</span>', 30, 109, 200, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:91px;heigh:95px;text-align:right;">'.number_format($invoicetransaction->price, 2).'</div>', 172,109, 91, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:91px;heigh:95px;text-align:right;">'.number_format($invoicetransaction->price*0.93, 2).'</div>', 172,165, 91, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:91px;heigh:95px;text-align:right;">'.number_format($invoicetransaction->price*0.07, 2).'</div>', 172,172.5, 91, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<div style="font-size: 9pt;width:91px;heigh:95px;text-align:right;">'.number_format($invoicetransaction->price, 2).'</div>', 172,179.5, 91, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<div style="font-size: 8pt;width:80px;heigh:95px;text-align:center;">'.$generalinfo->fax.'</div>', 147,199.8, 80, 90, 'auto');
        $mpdf->WriteFixedPosHTML('<span style="font-size: 8.5pt;">บริษัท '.$company->name.'</span>', 15.5, 230, 200, 90, 'auto');
        $path = public_path("storage/uploads/minitbp/pdf/");
        $mpdf->Output();
    }

    public function PaymentNotification($id){
        $invoicetransaction = InvoiceTransaction::find($id);
        $banks = ThaiBank::get();
        return view('dashboard.company.project.invoice.paymentnotification')->withInvoicetransaction($invoicetransaction)
                                                                        ->withBanks($banks);
    }

    public function PaymentNotificationSave(EditPaymentNotification $request,$id){
        $auth = Auth::user();
        $invoicetransaction = InvoiceTransaction::find($id);
        $company = Company::find($invoicetransaction->company_id);
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();

        $file = $request->file;
        $new_name = $minitbp->minitbp_code."_invoice.".$file->getClientOriginalExtension();
        $file->move("storage/uploads/company/invoice/prove" , $new_name);
        $filelocation = "storage/uploads/company/invoice/prove/".$new_name;
        InvoiceTransaction::find($id)->update([
            'bank_id' => $request->bank,
            'transferprice' => $request->price,
            'paymentdate' => DateConversion::thaiToEngDate($request->paymentdate),
            'paymenttime' => $request->paymenttime,
            'attachment' => $filelocation,
            'note' => $request->note,
            'status' => 2
        ]);
        $invoicetransaction = InvoiceTransaction::find($id);
   

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

        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 3;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $projectassignment->leader_id;
        $notificationbubble->save();

        $messagebox = Message::sendMessage('โปรดตรวจสอบผลการแจ้งการชำระเงิน โครงการ' .$minitbp->project.$fullcompanyname,'โปรดตรวจสอบผลการแจ้งการชำระเงิน โครงการ' .$minitbp->project.$fullcompanyname. ' <a href="'.route('dashboard.admin.project.invoice.payment',['id' => $invoicetransaction->id]).'" class="btn btn-sm bg-success">ดำเนินการ</a>',Auth::user()->id,$projectassignment->leader_id);    
        
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $projectassignment->leader_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' โปรดตรวจสอบผลการแจ้งการชำระเงิน โครงการ' .$minitbp->project.$fullcompanyname. ' <a data-id="'.$messagebox->id.'" href="'.route('dashboard.admin.project.invoice.payment',['id' => $invoicetransaction->id]).'" class="btn btn-sm bg-success linknextaction">ดำเนินการ</a>';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send(User::find($projectassignment->leader_id)->email,'','TTRS: โปรดตรวจสอบผลการแจ้งการชำระเงิน โครงการ' .$minitbp->project.$fullcompanyname,'เรียน Leader<br><br> โปรดตรวจสอบผลการแจ้งการชำระเงิน โครงการ'.$minitbp->project.$fullcompanyname. ' <a href='.route('dashboard.admin.project.invoice.payment',['id' => $invoicetransaction->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        
        CreateUserLog::createLog('แจ้งการชำระเงินใบแจ้งหนี้ โครงการ' . $minitbp->project);

       return redirect()->route('dashboard.company.project.invoice')->withSuccess('แจ้งการชำระเงินสำเร็จ');
    }

    public function Report(){
        return 'ok';
    }

}
