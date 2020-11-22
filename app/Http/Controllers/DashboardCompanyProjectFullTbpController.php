<?php

namespace App\Http\Controllers;

use PDF;
// use Segment;
use App\User;
use Carbon\Carbon;
use App\Model\Prefix;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\FullTbpCost;
use App\Model\FullTbpSell;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use App\Model\CompanyBoard;
use App\Model\FullTbpAsset;
use App\Model\UserPosition;
use App\Model\CompanyEmploy;
use Illuminate\Http\Request;
use App\Model\EmployPosition;
use App\Model\EmployTraining;
use App\Helper\DateConversion;
use App\Model\EmployEducation;
use App\Model\FullTbpEmployee;
use App\Model\SignatureStatus;
use App\Model\TimeLineHistory;
use App\Model\EmployExperience;
use App\Model\FullTbpCompanyDoc;
use App\Model\FullTbpInvestment;
use App\Model\FullTbpMarketNeed;
use App\Model\FullTbpMarketSize;
use App\Model\FullTbpResearcher;
use App\Model\FullTbpSellStatus;
use App\Model\ProjectAssignment;
use App\Model\CompanyStockHolder;
use App\Model\FullTbpDebtPartner;
use App\Model\FullTbpMarketShare;
use App\Model\FullTbpProjectPlan;
use App\Model\NotificationBubble;
use App\Model\FullTbpCreditPartner;
use App\Model\FullTbpProductDetail;
use App\Model\FullTbpCompanyProfile;
use App\Model\FullTbpProjectCertify;
use App\Model\FullTbpProjectTechDev;
use Illuminate\Support\Facades\Auth;
use App\Model\FullTbpProjectStandard;
use App\Model\FullTbpMarketAttachment;
use App\Model\FullTbpMainProductDetail;
use App\Model\FullTbpMarketCompetitive;
use App\Model\FullTbpReturnOfInvestment;
use App\Model\FullTbpProjectTechDevLevel;
use App\Model\FullTbpCompanyProfileDetail;
use App\Model\FullTbpProjectAbtractDetail;
use App\Model\FullTbpProjectTechDevProblem;
use App\Model\FullTbpProjectAwardAttachment;
use App\Model\FullTbpCompanyProfileAttachment;
use App\Model\FullTbpProjectCertifyAttachment;

class DashboardCompanyProjectFullTbpController extends Controller
{
    public function Index(){
        $auth = Auth::user();
        NotificationBubble::where('target_user_id',$auth->id)
                        ->where('notification_category_id',1)
                        ->where('notification_sub_category_id',5)
                        ->where('status',0)->delete();
        $companyinfo = collect();
        $company = Company::where('user_id',$auth->id)->first();
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $fulltpbs = FullTbp::where('mini_tbp_id',$minitbp->id)->get();   
        return view('dashboard.company.project.fulltbp.index')->withFulltbps($fulltpbs);
    }

    public function Edit($id){
        $businesstypes = BusinessType::get();
        $fulltbp = FullTbp::find($id);
        $fulltbpcompanyprofile = FullTbpCompanyProfile::where('full_tbp_id',$fulltbp->id)->first();
        $fulltbpemployee = FullTbpEmployee::where('full_tbp_id', $fulltbp->id)->first();
        $fulltbpcompanyprofiledetails = FullTbpCompanyProfileDetail::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpcompanyprofileattachments = FullTbpCompanyProfileAttachment::where('full_tbp_id',$fulltbp->id)->get();
        $company = Company::where('user_id',Auth::user()->id)->first();
        $prefixes = Prefix::get();
        $employpositions = EmployPosition::get();
        $companyemploys = CompanyEmploy::where('company_id',$company->id)->get();
        $companystockholders = CompanyStockHolder::where('company_id',$company->id)->get();
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $contactprefixes = Prefix::get();
        $contactpositions = UserPosition::get();
        $fulltbpprojectabtractdetails = FullTbpProjectAbtractDetail::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpMainproductdetails = FullTbpMainProductDetail::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpproductdetails = FullTbpProductDetail::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpprojecttechdevs = FullTbpProjectTechDev::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpprojecttechdevlevels = FullTbpProjectTechDevLevel::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpprojecttechdevproblems = FullTbpProjectTechDevProblem::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpprojectcertify = FullTbpProjectCertify::where('full_tbp_id',$fulltbp->id)->first();
        $fulltbpprojectcertifyattachments = FullTbpProjectCertifyAttachment::where('project_certify_id',$fulltbpprojectcertify->id)->get();
        $fulltbpprojectawardattachments = FullTbpProjectAwardAttachment::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpprojectstandards = FullTbpProjectStandard::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpprojectplans =  FullTbpProjectPlan::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpmarketneeds = FullTbpMarketNeed::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpmarketsizes = FullTbpMarketSize::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpmarketshares = FullTbpMarketShare::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpmarketcompetitives = FullTbpMarketCompetitive::where('full_tbp_id',$fulltbp->id)->get();
        $fullTbpmarketattachmentmodelcanvases = FullTbpMarketAttachment::where('full_tbp_id',$fulltbp->id)->where('attachmenttype',1)->get();
        $fullTbpmarketattachmentswots = FullTbpMarketAttachment::where('full_tbp_id',$fulltbp->id)->where('attachmenttype',2)->get();
        $fullTbpmarketattachmentfinancialplans = FullTbpMarketAttachment::where('full_tbp_id',$fulltbp->id)->where('attachmenttype',3)->get();
        $fulltbpsells = FullTbpSell::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpsellstatuses = FullTbpSellStatus::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpdebtpartners = FullTbpDebtPartner::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpcreditpartners = FullTbpCreditPartner::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpassets = FullTbpAsset::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpinvestments = FullTbpInvestment::where('full_tbp_id',$fulltbp->id)->get();        
        $fulltbpcosts = FullTbpCost::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpreturnofinvestment = FullTbpReturnOfInvestment::where('full_tbp_id',$fulltbp->id)->first();
        $fulltbpcompanydocs = FullTbpCompanyDoc::where('company_id',$company->id)->get();
        $fulltbpresearchers = FullTbpResearcher::where('full_tbp_id',$fulltbp->id)->get(); 
        $signaturestatuses = SignatureStatus::get();
        return view('dashboard.company.project.fulltbp.edit')->withFulltbp($fulltbp)
                                                ->withFulltbpemployee($fulltbpemployee)
                                                ->withBusinesstypes($businesstypes)
                                                ->withFulltbpcompanyprofile($fulltbpcompanyprofile)
                                                ->withFulltbpcompanyprofiledetails($fulltbpcompanyprofiledetails)
                                                ->withFulltbpcompanyprofileattachments($fulltbpcompanyprofileattachments)
                                                ->withCompanyemploys($companyemploys)
                                                ->withPrefixes($prefixes)
                                                ->withEmploypositions($employpositions)
                                                ->withCompanystockholders($companystockholders)
                                                ->withCompany($company)
                                                ->withMinitbp($minitbp)
                                                ->withContactprefixes($contactprefixes)
                                                ->withContactpositions($contactpositions)
                                                ->withFulltbpprojectabtractdetails($fulltbpprojectabtractdetails)
                                                ->withFulltbpMainproductdetails($fulltbpMainproductdetails)
                                                ->withFulltbpproductdetails($fulltbpproductdetails)
                                                ->withFulltbpprojecttechdevs($fulltbpprojecttechdevs)
                                                ->withFulltbpprojecttechdevlevels($fulltbpprojecttechdevlevels)
                                                ->withFulltbpprojecttechdevproblems($fulltbpprojecttechdevproblems)
                                                ->withFulltbpprojectcertify($fulltbpprojectcertify)
                                                ->withFulltbpprojectcertifyattachments($fulltbpprojectcertifyattachments)
                                                ->withFulltbpprojectawardattachments($fulltbpprojectawardattachments)
                                                ->withFulltbpprojectstandards($fulltbpprojectstandards)
                                                ->withFulltbpprojectplans($fulltbpprojectplans)
                                                ->withFulltbpmarketneeds($fulltbpmarketneeds)
                                                ->withFulltbpmarketsizes($fulltbpmarketsizes)
                                                ->withFulltbpmarketshares($fulltbpmarketshares)
                                                ->withFulltbpmarketcompetitives($fulltbpmarketcompetitives)
                                                ->withFullTbpmarketattachmentmodelcanvases($fullTbpmarketattachmentmodelcanvases)
                                                ->withFullTbpmarketattachmentswots($fullTbpmarketattachmentswots)
                                                ->withFullTbpmarketattachmentfinancialplans($fullTbpmarketattachmentfinancialplans)
                                                ->withFulltbpsells($fulltbpsells)
                                                ->withFulltbpsellstatuses($fulltbpsellstatuses)
                                                ->withFulltbpdebtpartners($fulltbpdebtpartners)
                                                ->withFulltbpcreditpartners($fulltbpcreditpartners)
                                                ->withFulltbpassets($fulltbpassets)
                                                ->withFulltbpinvestments($fulltbpinvestments)
                                                ->withFulltbpcosts($fulltbpcosts)
                                                ->withFulltbpreturnofinvestment($fulltbpreturnofinvestment)
                                                ->withFulltbpcompanydocs($fulltbpcompanydocs)
                                                ->withFulltbpresearchers($fulltbpresearchers)
                                                ->withSignaturestatuses($signaturestatuses);
    }

    public function EditSave(Request $request,$id){
        FullTbpEmployee::find($id)->update([
            'department1_qty' => $request->department1_qty,
            'department2_qty' => $request->department2_qty,
            'department3_qty' => $request->department3_qty,
            'department4_qty' => $request->department4_qty,
            'department5_qty' => $request->department5_qty,
        ]); 
        $fulltbp = FullTbp::find($id); 
        FullTbpCompanyProfile::where('full_tbp_id',$fulltbp->id)->first()->update([
               'profile' => $request->companyprofile
            ]);

        FullTbpCompanyProfileDetail::where('full_tbp_id',$fulltbp->id)->delete();
        foreach( $request->companyprofile as $companyprofile ){
            $fulltbpcompanyprofiledetail = new FullTbpCompanyProfileDetail();
            $fulltbpcompanyprofiledetail->full_tbp_id = $fulltbp->id;
            $fulltbpcompanyprofiledetail->line = $companyprofile;
            $fulltbpcompanyprofiledetail->save();
        }

        return redirect()->back()->withSuccess('แก้ไข Full TBP สำเร็จ');
    }

    public function DownloadPDF($id){
        require_once (base_path('/vendor/notyes/thsplitlib/THSplitLib/segment.php'));
        $segment = new \Segment();
        $fulltbp = FullTbp::find($id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $ceo = CompanyEmploy::where('full_tbp_id',$id)->where('employ_position_id',1)->first();
        $companyboards = CompanyEmploy::where('full_tbp_id',$id)->where('employ_position_id','<=',5)->where('id','!=',$ceo->id)->get();
        $companyemploys = CompanyEmploy::where('full_tbp_id',$id)->where('employ_position_id','>',5)->where('id','!=',$ceo->id)->get();
        // $companyemploys = FullTbpResearcher::where('full_tbp_id',$id)->get(); 
        // return  $companyemploys;
        // $companyhistory = $segment->get_segment_array($company->companyhistory);
        $companystockholders = CompanyStockHolder::where('company_id',$company->id)->get();
        $data = [
            'fulltbp' => $fulltbp,
            'companyboards' => $companyboards,
            'companyemploys' => $companyemploys,
            'companystockholders' => $companystockholders,
            // 'companyhistory' => $companyhistory
        ];
        $pdf = PDF::loadView('dashboard.company.project.fulltbp.pdf', $data);
        $path = public_path("storage/uploads/fulltbp/");
        return $pdf->stream('document.pdf');
    }

    public function Submit($id){
        $fulltbp = FullTbp::find($id);
        return view('dashboard.company.project.fulltbp.submit')->withFulltbp($fulltbp);
    }

    public function SubmitSave(Request $request, $id){
        $auth = Auth::user();
        $fulltbp = FullTbp::find($id);
        if(!Empty($fulltbp->attachment)){
            @unlink($fulltbp->attachment);
        }
        $file = $request->attachment;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/fulltbp/attachment" , $new_name);
        $filelocation = "storage/uploads/fulltbp/attachment/".$new_name;
        $fulltbp->update([
            'file' => $filelocation,
            'status' => 2
        ]);
        
        $message = 'เอกสาร Full TBP' ;
        $fulltbp = FullTbp::find($id);
        if($fulltbp->refixstatus == 1){
            $fulltbp->update([
                'refixstatus' => 2  
            ]);
            $message = 'เอกสาร Full TBP ที่มีการแก้ไข' ;
        }

        $businessplan = BusinessPlan::find(MiniTBP::find($fulltbp->mini_tbp_id)->business_plan_id)->update([
            'business_plan_status_id' => 5
        ]);
        
        $businessplan = BusinessPlan::find(MiniTBP::find($fulltbp->mini_tbp_id)->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        
        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 5;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $projectassignment->leader_id;
        $notificationbubble->save();

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $projectassignment->leader_id;
        $alertmessage->detail = 'โครงการ' . MiniTBP::find($fulltbp->mini_tbp_id)->project . ' ได้ส่ง'.$message.' ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
        $alertmessage->save();

        EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:'.$message,'เรียน Leader<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.fulltbp').'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS');
        EmailBox::send(User::where('user_type_id',6)->first()->email,'TTRS:'.$message,'เรียน JD<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.fulltbp').'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS');

        Message::sendMessage('ส่ง'.$message,'เรียน Leader<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.fulltbp').'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::find($projectassignment->leader_id)->id);
        Message::sendMessage('ส่ง'.$message,'เรียน JD<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.fulltbp').'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::where('user_type_id',6)->first()->id);
        
        return redirect()->route('dashboard.company.project.fulltbp')->withSuccess('ส่งเอกสาร Full TBP สำเร็จ');
    }
   
}
