<?php

namespace App\Http\Controllers;

use App\User;
use ZipArchive;
use App\Model\Ev;
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
use App\Model\EvCommentTab;
use App\Model\FullTbpAsset;
use App\Model\UserPosition;
use App\Model\CompanyEmploy;
use App\Model\CriteriaGroup;
use App\Model\EvEditHistory;
use App\Model\ExpertComment;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Model\EmployPosition;
use App\Model\EmployTraining;
use App\Helper\DateConversion;
use App\Model\EmployEducation;
use App\Model\FullTbpEmployee;
use App\Model\SignatureStatus;
use App\Model\TimeLineHistory;
use App\Model\EmployExperience;
use App\Model\ExpertAssignment;
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
use Illuminate\Support\Facades\File;
use App\Model\FullTbpBoardAttachment;
use App\Model\FullTbpProjectStandard;
use App\Model\FullTbpMarketAttachment;
use App\Model\FullTbpMainProductDetail;
use App\Model\FullTbpMarketCompetitive;
use Illuminate\Support\Facades\Storage;
use App\Model\FullTbpReturnOfInvestment;
use App\Model\FullTbpProjectTechDevLevel;
use App\Model\FullTbpCompanyProfileDetail;
use App\Model\FullTbpProjectAbtractDetail;
use App\Model\FullTbpProjectTechDevProblem;
use App\Model\FullTbpProjectAwardAttachment;
use App\Model\FullTbpCompanyProfileAttachment;
use App\Model\FullTbpProjectCertifyAttachment;

class DashboardAdminProjectFullTbpController extends Controller
{
    public function Index(){
        $auth = Auth::user();
        NotificationBubble::where('target_user_id',$auth->id)
                        ->where('notification_category_id',1)
                        ->where('notification_sub_category_id',5)
                        ->where('status',0)->delete();
                        
        // $fulltbps = FullTbp::where('status',2)->get();
        $fulltbps = FullTbp::get();
        if($auth->user_type_id < 6){
            $businessplanids = ProjectAssignment::where('leader_id',$auth->id)
                                            // ->orWhere('coleader_id',$auth->id)
                                            ->pluck('business_plan_id')->toArray();
            $minitbpids = MiniTBP::whereIn('business_plan_id',$businessplanids)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        }
        return view('dashboard.admin.project.fulltbp.index')->withFulltbps($fulltbps) ;
    }

    public function View($id){
        $businesstypes = BusinessType::get();
        $fulltbp = FullTbp::find($id);
        $fulltbpcompanyprofile = FullTbpCompanyProfile::where('full_tbp_id',$fulltbp->id)->first();
        $fulltbpemployee = FullTbpEmployee::where('full_tbp_id', $fulltbp->id)->first();
        $fulltbpcompanyprofiledetails = FullTbpCompanyProfileDetail::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpcompanyprofileattachments = FullTbpCompanyProfileAttachment::where('full_tbp_id',$fulltbp->id)->get();
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $company = Company::find(BusinessPlan::find($minitbp->business_plan_id)->company_id);
        $prefixes = Prefix::get();
        $employpositions = EmployPosition::get();
        $companyemploys = CompanyEmploy::where('company_id',$company->id)->get();
        $companystockholders = CompanyStockHolder::where('company_id',$company->id)->get();
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
        $timelinehistories = TimeLineHistory::where('business_plan_id',$minitbp->business_plan_id)
                                            ->where('message_type',2)
                                            ->get();
        $fulltbpresearchers = FullTbpResearcher::where('full_tbp_id',$fulltbp->id)->get(); 
        $signaturestatuses = SignatureStatus::get();
        return view('dashboard.admin.project.fulltbp.view')->withFulltbp($fulltbp)
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
                                                ->withTimelinehistories($timelinehistories)
                                                ->withFulltbpresearchers($fulltbpresearchers)
                                                ->withSignaturestatuses($signaturestatuses);
    }

    public function AssignGroup($id){
        $fulltbp = FullTbp::find($id);
        $criteriagroups = CriteriaGroup::get();
        return view('dashboard.admin.project.fulltbp.assigngroup')->withCriteriagroups($criteriagroups)
                                                    ->withFulltbp($fulltbp);
    }
    public function AssignGroupSave(Request $request,$id){
        $fulltbp = FullTbp::find($id)->update([
            'criteria_group_id' => $request->criteriagroup
        ]);
        return redirect()->route('dashboard.admin.project.fulltbp')->withSuccess('Assign เกณฑ์การประเมินสำเร็จ');
    }
    public function AssignExpert($id){
        $experts = User::where('user_type_id',3)->get();
        $expertassignments = ExpertAssignment::where('full_tbp_id',$id)->get();
        
        $fulltbp = FullTbp::find($id);
        return view('dashboard.admin.project.fulltbp.assignexpert')->withExpertassignments($expertassignments)
                                                        ->withExperts($experts)
                                                        ->withFulltbp($fulltbp);
    }

    public function AssignExpertSave(Request $request){
        $check = ExpertAssignment::where('full_tbp_id', $request->fulltbpid)
                            ->where('user_id',$request->id)
                            ->first();
        if(Empty($check)){
            $expertassignment = new ExpertAssignment();
            $expertassignment->full_tbp_id = $request->fulltbpid;
            $expertassignment->user_id = $request->id;
            $expertassignment->expert_assignment_status_id = 1;
            $expertassignment->save();
        }

        $expertassignments = ExpertAssignment::where('full_tbp_id', $request->fulltbpid)->get();
        if($expertassignments->count() > 0){
            FullTbp::find($request->fulltbpid)->update([
                'assignexpert' => '2'
            ]);
        }else{
            FullTbp::find($request->fulltbpid)->update([
                'assignexpert' => '1'
            ]);
        }
        return response()->json($expertassignments); 
    }

    public function AssignExpertDelete(Request $request){
        ExpertAssignment::find($request->id)->delete();
        $expertassignments = ExpertAssignment::where('full_tbp_id', $request->fulltbpid)->get();
        
        if($expertassignments->count() > 0){
            FullTbp::find($request->fulltbpid)->update([
                'assignexpert' => '2'
            ]);
        }else{
            FullTbp::find($request->fulltbpid)->update([
                'assignexpert' => '1'
            ]);
        }
        return response()->json($expertassignments); 
    }   
    public function EditAssignExpert(Request $request){
        $auth = Auth::user();
        ExpertAssignment::find($request->id)->update([
            'expert_assignment_status_id' => $request->status
        ]);

        $expertassignments = ExpertAssignment::where('full_tbp_id', $request->fulltbpid)->get();
        
        if($expertassignments->count() > 0){
            FullTbp::find($request->fulltbpid)->update([
                'assignexpert' => '2'
            ]);

            $minitbp = MiniTBP::find(FullTbp::find($request->fulltbpid)->mini_tbp_id);
            EmailBox::send(User::find($request->id)->email,'TTRS:การมอบหมายผู้เชี่ยวชาญ','เรียนคุณ'.User::find($request->id)->name . ' ' .User::find($request->id)->lastname.'<br> ท่านได้รับมอบหมายให้เป็นผู้เชี่ยวชาญในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล <a class="btn btn-sm bg-success" href='.route('dashboard.expert.report').'>ตรวจสอบ</a> <br><br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('การมอบหมายผู้เชี่ยวชาญ','เรียน '.User::find($request->id)->name.'<br> ท่านได้รับมอบหมายให้เป็นผู้เชี่ยวชาญในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล <a class="btn btn-sm bg-success" href='.route('dashboard.expert.report').'>ตรวจสอบ</a> <br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::find($request->id)->id);

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $request->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' ได้รับมอบหมายให้เป็นผู้เชี่ยวชาญในโครงการ '.$minitbp->project .' ';
            $alertmessage->save();

        }else{
            FullTbp::find($request->fulltbpid)->update([
                'assignexpert' => '1'
            ]);
        }
        return response()->json($expertassignments); 
    }
    public function EditApprove(Request $request){
        $auth = Auth::user();
        $fulltbp = FullTbp::find($request->id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $_businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $_company = Company::find($_businessplan->company_id);
        $_user = User::find($_company->user_id);
        if($request->val == 1){
            BusinessPlan::find($minitbp->business_plan_id)->update([
                'business_plan_status_id' => 6
            ]);

            if($fulltbp->refixstatus != 0){
                FullTbp::find($request->id)->update(
                    [
                        'refixstatus' => 0
                    ]
                );
            }
           
            $timeLinehistory = new TimeLineHistory();
            $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
            $timeLinehistory->details = 'แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) ของท่านได้รับอนุมัติ';
            $timeLinehistory->message_type = 2;
            $timeLinehistory->owner_id = $_company->user_id;
            $timeLinehistory->user_id = $auth->id;
            $timeLinehistory->save();

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $_company->user_id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) ของท่านได้รับอนุมัติ';
            $alertmessage->save();

            EmailBox::send($_user->email,'TTRS:อนุมัติแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)','เรียนผู้ประกอบการ<br><br> แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) ของท่านได้รับอนุมัติแล้ว กรุณาเตรียมพร้อมสำหรับการประเมิณ ณ สถานประกอบการ <br><br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('กรอกข้อมูล Full TBP','เรียนผู้ประกอบการ<br> แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) ของท่านได้รับอนุมัติแล้ว กรุณาเตรียมพร้อมสำหรับการประเมิณ ณ สถานประกอบการ <br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$_user->id);

        }else{
            
            FullTbp::find($request->id)->update(
                [
                    'refixstatus' => 1
                ]
            );

            $timeLinehistory = new TimeLineHistory();
            $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
            $timeLinehistory->details = $request->note;
            $timeLinehistory->user_id = Auth::user()->id;
            $timeLinehistory->message_type = 2;
            $timeLinehistory->owner_id = $_company->user_id;
            $timeLinehistory->save();

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $_company->user_id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' โปรดแก้ไขแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) ตามข้อแนะนำ ดังนี้<br><br>' .$request->note . '<br><br> <a class="btn btn-sm bg-success" href='.route('dashboard.company.project.fulltbp.edit',['id' => $fulltbp->id]).'>ตรวจสอบ</a>';
            $alertmessage->save();

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $minitbp->business_plan_id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 5;
            $notificationbubble->user_id = Auth::user()->id;
            $notificationbubble->target_user_id = $_user->id;
            $notificationbubble->save();

            EmailBox::send($_user->email,'TTRS:แก้ไขข้อมูล Full TBP','เรียนผู้ประกอบการ<br><br> แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) ของท่านยังไม่ได้รับการอนุมัติ โปรดเข้าสู่ระบบเพื่อทำการแก้ไขตามข้อแนะนำ ดังนี้<br><br>' .$request->note.  ' <br><br><a class="btn btn-sm bg-success" href='.route('dashboard.company.project.fulltbp.edit',['id' => $fulltbp->id]).'>ตรวจสอบ</a><br><br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('แก้ไขข้อมูล Full TBP','เรียนผู้ประกอบการ<br> แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) ของท่านยังไม่ได้รับการอนุมัติ โปรดทำการแก้ไขตามข้อแนะนำ ดังนี้<br><br>' .$request->note. '<br><br><a class="btn btn-sm bg-success" href='.route('dashboard.company.project.fulltbp.edit',['id' => $fulltbp->id]).'>ตรวจสอบ</a><br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$_user->id);
        }
        return response()->json($fulltbp); 
    }
    public function GetExpert(Request $request){
        $fulltbpids = ExpertAssignment::where('user_id',$request->id)->pluck('full_tbp_id')->toArray();
        $fulltbps = FullTbp::whereIn('id',$fulltbpids)->get();
        return response()->json($fulltbps); 
    }  
    public function NotifyJd(Request $request){
        $fulltbp = FullTbp::find($request->fulltbpid);
        $minitbp = MiniTBP::find(FullTbp::find($request->fulltbpid)->mini_tbp_id);
        if(!Empty($request->users)){
            $expert = '';
            foreach($request->users as $_user){
                $user = User::find($_user);
                $expert .= $user->name . ' ' . $user->lastname . '<br>';
            }
            
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = Auth::user()->id;
            $alertmessage->target_user_id = User::where('user_type_id',6)->first()->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() . ' ตรวจสอบการมอบหมายผู้เชี่ยวชาญ สำหรับโครงการ' . $minitbp->project . ' <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpert',['id' => $fulltbp->id]).'>ตรวจสอบ</a> ';
            $alertmessage->save();

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $minitbp->business_plan_id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 5;
            $notificationbubble->user_id = Auth::user()->id;
            $notificationbubble->target_user_id = User::where('user_type_id',6)->first()->id;
            $notificationbubble->save();

            EmailBox::send(User::where('user_type_id',6)->first()->email,'TTRS:การมอบหมายผู้เชี่ยวชาญ','เรียน JD <br> Leader ได้มอบหมายให้ <br><br>' .$expert . ' <br>เป็นผู้เชี่ยวชาญในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpert',['id' => $fulltbp->id]).'>ตรวจสอบ</a> <br><br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('การมอบหมายผู้เชี่ยวชาญ','เรียน JD <br> Leader ได้มอบหมายให้ <br><br>' .$expert . ' <br> เป็นผู้เชี่ยวชาญในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpert',['id' => $fulltbp->id]).'>ตรวจสอบ</a> <br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::where('user_type_id',6)->first()->id);
        }
        $expertassignments = ExpertAssignment::where('full_tbp_id', $request->fulltbpid)->get();
        return response()->json($expertassignments); 
    }

    public function ViewEv($id){
        $evs = Ev::where('full_tbp_id',$id)->get();
        $fulltbp = FullTbp::find($id);
        return view('dashboard.admin.project.fulltbp.viewev')->withFulltbp($fulltbp)
                                                            ->withEvs($evs);
    }
    public function CreateEv($id){
        $fulltbp = FullTbp::find($id);
        return view('dashboard.admin.project.fulltbp.createev')->withFulltbp($fulltbp);
    }
    public function CreateSaveEv(Request $request){
        $ev = new Ev();
        $ev->full_tbp_id = $request->fulltbpid;
        $ev->name = $request->name;
        $ev->version = $request->version;
        $ev->save();
        return redirect()->route('dashboard.admin.project.fulltbp.viewev',['id' => $request->fulltbpid])->withSuccess('เพิ่มรายการสำเร็จ');
    }

    public function EditEv($id){
        $ev = Ev::find($id);
        $evs = Ev::where('full_tbp_id','!=',$ev->full_tbp_id)->orWhereNull('full_tbp_id')->get();
        $evedithistories = EvEditHistory::where('ev_id',$id)->where('historytype',1)->get();
        $evcommenttabs = EvCommentTab::where('ev_id',$id)->where('stage',1)->get();
        // return $evcommenttabs;
        return view('dashboard.admin.project.fulltbp.editev')->withEvs($evs)
                                                            ->withEv($ev)
                                                            ->withEvedithistories($evedithistories)
                                                            ->withEvcommenttabs($evcommenttabs);
    }

    public function GetUsers(Request $request){
        $users = User::where('user_type_id','>=',3)->get();
        $projectmembers = ProjectMember::where('full_tbp_id',$request->id)->get();
        return response()->json(array(
            "users" => $users,
            "projectmembers" => $projectmembers
        ));
    }

    public function AddProjectMember(Request $request){
        $projectmember = ProjectMember::where('user_id',$request->userid)->where('full_tbp_id',$request->fulltbpid)->first();
        if(Empty($projectmember)){
            $projectmember = new ProjectMember();
            $projectmember->full_tbp_id = $request->fulltbpid;
            $projectmember->user_id = $request->userid;
            $projectmember->save();
        }
        $users = User::where('user_type_id','>=',3)->get();
        $projectmembers = ProjectMember::where('full_tbp_id',$request->fulltbpid)->get();
        return response()->json(array(
            "users" => $users,
            "projectmembers" => $projectmembers
        ));
    }

    public function DeleteProjectMember(Request $request){
        ProjectMember::find($request->id)->delete();
        $users = User::where('user_type_id','>=',3)->get();
        $projectmembers = ProjectMember::where('full_tbp_id',$request->fulltbpid)->get();
        return response()->json(array(
            "users" => $users,
            "projectmembers" => $projectmembers
        ));
    }

    public function DoneAssignement(Request $request){
        $auth = Auth::user();

        $minitbp = MiniTBP::find($request->fulltbpid);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $fulltbp = FullTbp::find($request->fulltbpid);
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
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().  'JD ได้พิจารณาผู้เชี่ยวชาญสำหรับโครงการ' . $minitbp->project . ' เสร็จแล้ว <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpert',['id' => $fulltbp->id]).'>ตรวจสอบ</a>' ;
        // $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' ผู้เชี่ยวชาญ คุณ'.$auth->name .' '. $auth->lastname .' ได้แสดงความเห็นสำหรับโครงการ' . $minitbp->project . ' เสร็จแล้ว <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpert',['id' => $fulltbp->id]).'>ตรวจสอบ</a>';
        $alertmessage->save();
        
        EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:JD ได้พิจารณาผู้เชี่ยวชาญสำหรับโครงการ' . $minitbp->project . ' เสร็จแล้ว','เรียน Leader<br> JD ได้พิจารณาผู้เชี่ยวชาญสำหรับโครงการ' . $minitbp->project . ' เสร็จแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpert',['id' => $fulltbp->id]).'>ตรวจสอบ</a> <br><br>ด้วยความนับถือ<br>TTRS');
        Message::sendMessage('JD ได้พิจารณาผู้เชี่ยวชาญสำหรับโครงการ' . $minitbp->project . ' เสร็จแล้ว','JD ได้พิจารณาผู้เชี่ยวชาญสำหรับโครงการ' . $minitbp->project . ' เสร็จแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpert',['id' => $fulltbp->id]).'>ตรวจสอบ</a> <br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$projectassignment->leader_id);
    }

    public function ExpertComment(Request $request){
        $expertassignment = ExpertAssignment::find($request->id);
        $expertcomment = ExpertComment::where('full_tbp_id',$expertassignment->full_tbp_id)->where('user_id',$expertassignment->user_id)->first();
        return response()->json($expertcomment); 
    }

    public function DownloadZip($id){
        $zip = new ZipArchive();
        $fulltbp = FullTbp::find($id);
        $filename = 'fulltbp_'.$fulltbp->fulltbp_code .".zip";
        if ($zip->open(public_path('storage/uploads/fulltbp/'.$filename), ZipArchive::CREATE) === TRUE)
        {
            $fulltbpcompanyprofileattachments = FullTbpCompanyProfileAttachment::where('full_tbp_id',$fulltbp->id)->get();
            foreach ($fulltbpcompanyprofileattachments as $key => $fulltbpcompanyprofileattachment) {
                $file = public_path($fulltbpcompanyprofileattachment->path);
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $name = preg_replace("/\.[^.]+$/", "", $fulltbpcompanyprofileattachment->name);
                $download_file = file_get_contents($file);
                $zip->addFromString(basename($file), $download_file);
                $zip->renameName(basename($file), 'เอกสารบริษัท_'.$name.'.'.$extension);
            }
            $companyemploys = CompanyEmploy::where('full_tbp_id',$fulltbp->id)->get();
            foreach ($companyemploys as $key => $companyemploy) {
                $boardattacements = FullTbpBoardAttachment::where('company_employ_id',$companyemploy->id)->get();
                foreach ($boardattacements as $key => $boardattacement) {
                    $file = public_path($boardattacement->path);
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $name = preg_replace("/\.[^.]+$/", "", $boardattacement->name);
                    $download_file = file_get_contents($file);
                    $zip->addFromString(basename($file), $download_file);
                    $zip->renameName(basename($file), 'บุคลากร_'.$companyemploy->name.'_'.$companyemploy->lastname.'_'.$name.'.'.$extension);
                }
            }
            $certifyattachments = FullTbpProjectCertifyAttachment::where('full_tbp_id',$fulltbp->id)->get();
            foreach ($certifyattachments as $key => $certifyattachment) {
                $file = public_path($certifyattachment->path);
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $name = preg_replace("/\.[^.]+$/", "", $certifyattachment->name);
                $download_file = file_get_contents($file);
                $zip->addFromString(basename($file), $download_file);
                $zip->renameName(basename($file), 'สิทธิบัตร_'.$name.'.'.$extension);
            }
            $awardattachments = FullTbpProjectAwardAttachment::where('full_tbp_id',$fulltbp->id)->get();
            foreach ($awardattachments as $key => $awardattachment) {
                $file = public_path($awardattachment->path);
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $name = preg_replace("/\.[^.]+$/", "", $awardattachment->name);
                $download_file = file_get_contents($file);
                $zip->addFromString(basename($file), $download_file);
                $zip->renameName(basename($file), 'นวัตกรรม_'.$name.'.'.$extension);
            }
            
            $standards = FullTbpProjectStandard::where('full_tbp_id',$fulltbp->id)->get();
            foreach ($standards as $key => $standard) {
                $file = public_path($standard->path);
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $name = preg_replace("/\.[^.]+$/", "", $standard->name);
                $download_file = file_get_contents($file);
                $zip->addFromString(basename($file), $download_file);
                $zip->renameName(basename($file), 'รับรองมาตรฐาน_'.$name.'.'.$extension);
            }
            $marketattachments = FullTbpMarketAttachment::where('full_tbp_id',$fulltbp->id)->where('attachmenttype',1)->get();
            foreach ($marketattachments as $key => $marketattachment) {
                $file = public_path($marketattachment->path);
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $name = preg_replace("/\.[^.]+$/", "", $marketattachment->name);
                $download_file = file_get_contents($file);
                $zip->addFromString(basename($file), $download_file);
                $zip->renameName(basename($file), 'bmc_'.$name.'.'.$extension);
            }
            $marketattachments = FullTbpMarketAttachment::where('full_tbp_id',$fulltbp->id)->where('attachmenttype',2)->get();
            foreach ($marketattachments as $key => $marketattachment) {
                $file = public_path($marketattachment->path);
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $name = preg_replace("/\.[^.]+$/", "", $marketattachment->name);
                $download_file = file_get_contents($file);
                $zip->addFromString(basename($file), $download_file);
                $zip->renameName(basename($file), 'swot_'.$name.'.'.$extension);
            }
            $zip->close();
        }
        return response()->download(public_path('storage/uploads/fulltbp/'.$filename))->deleteFileAfterSend(true);
    }
}
