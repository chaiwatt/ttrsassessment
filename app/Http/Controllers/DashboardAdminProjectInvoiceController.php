<?php

namespace App\Http\Controllers;

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
use App\Model\InvoiceTransaction;
use App\Model\NotificationBubble;
use App\Helper\ThaiNumericConverter;
use Illuminate\Support\Facades\Auth;
use App\Model\ProjectStatusTransaction;
use setasign\Fpdi\PdfParser\StreamReader;

class DashboardAdminProjectInvoiceController extends Controller
{
    public function Index(){
        $auth = Auth::user();
        NotificationBubble::where('target_user_id',$auth->id)
                ->where('notification_category_id',1) // notification_category_id 1 = โครงการ
                ->where('notification_sub_category_id',3) // notification_sub_category_id 3 = ใบแจ้งหนี้
                ->where('status',0)->delete();
        $invoicetransactions = InvoiceTransaction::get();
        return view('dashboard.admin.project.invoice.index')->withInvoicetransactions($invoicetransactions);
    }
    public function Create(){
        $users = User::where('user_type_id','<',3)->pluck('id');
        $companies = Company::whereIn('user_id',$users)->get();
        return view('dashboard.admin.project.invoice.create')->withCompanies($companies);
    }
    public function CreateSave(Request $request){
        $invoicetransaction = new InvoiceTransaction();
        $invoicetransaction->company_id = $request->company;
        $invoicetransaction->customer = $request->customer;
        $invoicetransaction->docno = $request->docno;
        $invoicetransaction->issuedate = Carbon::now()->toDateString();
        $invoicetransaction->quotationno = $request->quotationno;
        $invoicetransaction->purchaseorderno = $request->purchaseorderno;
        $invoicetransaction->saleorderno = $request->saleorderno;
        $invoicetransaction->saleorderdate = DateConversion::thaiToEngDate($request->saleorderdate);
        $invoicetransaction->refno = $request->refno;
        $invoicetransaction->description = $request->description;
        $invoicetransaction->price = $request->price;
        $invoicetransaction->billerid = $request->billerid;
        $invoicetransaction->branchid = $request->branchid;
        $invoicetransaction->servicecode = $request->servicecode;
        $invoicetransaction->compcode = $request->compcode;
        $invoicetransaction->save();

        $company = Company::find($request->company);
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        CreateUserLog::createLog('สร้าง Invoice โครงการ' . MiniTBP::where('business_plan_id',$businessplan->id)->first()->project);

        return redirect()->route('dashboard.admin.project.invoice')->withSuccess('สร้างรายการสำเร็จ');
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

    public function Edit($id){
        $users = User::where('user_type_id','<',3)->pluck('id');
        $companies = Company::whereIn('user_id',$users)->get();
        $invoicetransaction = InvoiceTransaction::find($id);
        return view('dashboard.admin.project.invoice.edit')->withCompanies($companies)
                                                        ->withInvoicetransaction($invoicetransaction);
    }
    public function EditSave(Request $request,$id){
        InvoiceTransaction::find($id)->update([
            'customer' => $request->customer,
            'docno' => $request->docno,
            'issuedate' => Carbon::now()->toDateString(),
            'quotationno' => $request->quotationno,
            'purchaseorderno' => $request->purchaseorderno,
            'saleorderno' => $request->saleorderno,
            'saleorderdate' => DateConversion::thaiToEngDate($request->saleorderdate),
            'refno' => $request->refno,
            'description' => $request->description,
            'price' => str_replace( ',', '', $request->price),
            'billerid' => $request->billerid,
            'branchid' => $request->branchid,
            'servicecode' => $request->servicecode,
            'compcode' => $request->compcode
        ]);
        $company = Company::find(InvoiceTransaction::find($id)->company_id);
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        CreateUserLog::createLog('แก้ไข Invoice โครงการ' . MiniTBP::where('business_plan_id',$businessplan->id)->first()->project);
        return redirect()->route('dashboard.admin.project.invoice')->withSuccess('แก้ไขรายการสำเร็จ');
    }


    public function UpdateStatus(Request $request){
        $invoicetransaction = InvoiceTransaction::find($request->id);
        $company = Company::find($invoicetransaction->company_id);
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $auth = Auth::user();
        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 3;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $company->user_id;
        $notificationbubble->save();

        $messagebox = Message::sendMessage('กรุณาตรวจสอบรายการใบแจ้งหนี้','กรุณาตรวจสอบรายการใบแจ้งหนี้ สำหรับโครงการ' .$minitbp->project. ' <a href="'.route('dashboard.company.project.invoice').'" class="btn btn-sm bg-success">ดำเนินการ</a>',Auth::user()->id,$company->user_id);    

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $company->user_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' กรุณาตรวจสอบรายการใบแจ้งหนี้ สำหรับโครงการ' .$minitbp->project. ' <a data-id="'.$messagebox->id.'" href="'.route('dashboard.company.project.invoice').'" class="btn btn-sm bg-success linknextaction">ดำเนินการ</a>';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send(User::find($company->user_id)->email,'TTRS:กรุณาตรวจสอบรายการใบแจ้งหนี้','เรียน ผู้ขอรับการประเมิน<br><br> กรุณาตรวจสอบรายการใบแจ้งหนี้ สำหรับโครงการ'.$minitbp->project. ' <a href='.route('dashboard.company.project.invoice').'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        
        CreateUserLog::createLog('ส่งใบแจ้งหนี้ โครงการ' . $minitbp->project);
        InvoiceTransaction::find($request->id)->update([
            'status' => $request->status
        ]);
        return;
    }

    public function Payment($id){
        $banks = ThaiBank::get();
        $invoicetransaction = InvoiceTransaction::find($id);
        return view('dashboard.admin.project.invoice.payment')->withBanks($banks)
                                                        ->withInvoicetransaction($invoicetransaction);
    }

    public function PaymentProve(Request $request,$id){
        $invoicetransaction = InvoiceTransaction::find($request->id);
        $company = Company::find($invoicetransaction->company_id);
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
        $auth = Auth::user();
        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 3;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $company->user_id;
        $notificationbubble->save();

        $messagebox = Message::sendMessage('ยืนยันการชำระเงิน','ยืนยันการชำระเงิน สำหรับโครงการ' .$minitbp->project. ' <a href="'.route('dashboard.company.project.invoice').'" class="btn btn-sm bg-success">ดำเนินการ</a>',Auth::user()->id,$company->user_id);    

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $company->user_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' ยืนยันการชำระเงิน สำหรับโครงการ' .$minitbp->project. ' <a data-id="'.$messagebox->id.'" href="'.route('dashboard.company.project.invoice').'" class="btn btn-sm bg-success linknextaction">ดำเนินการ</a>';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send(User::find($company->user_id)->email,'TTRS:ยืนยันการชำระเงิน','เรียน ผู้ขอรับการประเมิน<br><br> ยืนยันการชำระเงิน สำหรับโครงการ'.$minitbp->project. ' <a href='.route('dashboard.company.project.invoice').'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        
        
        InvoiceTransaction::find($id)->update([
            'status' => 3
        ]);
        BusinessPlan::where('company_id',$company->id)->first()->update([
            'business_plan_status_id' => 9
          ]);

        $projectstatustransaction = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',6)->first();
        if($projectstatustransaction->status == 1){
            $projectstatustransaction->update([
                'status' => 2
            ]);
            $projectstatustransaction = new ProjectStatusTransaction();
            $projectstatustransaction->mini_tbp_id = $minitbp->id;
            $projectstatustransaction->project_flow_id = 7;
            $projectstatustransaction->save();

            $mailbody  ="เรียน คุณ".$fulltbp->fulltbpresponsibleperson->name ." ".$fulltbp->fulltbpresponsibleperson->lastname . " กรรมการผู้จัดการ บริษัท ". $fulltbp->minitbp->businessplan->company->name ."<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามที่ท่านได้แจ้งความประสงค์เข้ารับบริการประเมินศักยภาพผู้ประกอบการโดย TTRS Model โครงการเลขที่ " . ThaiNumericConverter::toThaiNumeric($fulltbp->minitbp->businessplan->code) . " เรื่อง" .$fulltbp->minitbp->project ." ของ บริษัท" . $fulltbp->minitbp->businessplan->company->name . " ความละเอียดทราบแล้วนั้น บัดนี้ สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.) โดยศูนย์สนับสนุนและให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศบริการประเมินจัดอันดับเทคโนโลยีของประเทศ (TTRS) ได้ทำการประเมินเสร็จสิ้นเป็นที่เรียบร้อยแล้ว จึงขอแจ้งผลการประเมินศักยภาพผู้ประกอบการโดย TTRS Model ซึ่งได้คะแนน " .ThaiNumericConverter::toThaiNumeric(number_format($fulltbp->projectgrade->percent, 2, '.', '')) . " คะแนน จากคะแนนเต็ม " .ThaiNumericConverter::toThaiNumeric('100') ." คะแนนคิดเป็นเกรดระดับ " . $fulltbp->projectgrade->grade ." โดยสำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ จะจัดส่งหนังสือแจ้งผลการประเมินอย่างเป็นทางการในลำดับถัดไป";
            EmailBox::send(User::find($company->user_id)->email,'TTRS:แจ้งผลการประเมินศักยภาพผู้ประกอบการโดย TTRS Model โครงการ' . $minitbp->project,$mailbody.'<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            DateConversion::addExtraDay($minitbp->id,6);
        }  
        CreateUserLog::createLog('ยืนยันการชำระเงินค่าธรรมเนียม โครงการ' . $minitbp->project);
        return redirect()->route('dashboard.admin.project.invoice')->withSuccess('ยืนยันรายการสำเร็จ');
    }
}
