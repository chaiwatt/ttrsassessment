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
use App\Model\ReviseLog;
use App\Model\MessageBox;
use App\Model\FullTbpCost;
use App\Model\FullTbpSell;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use App\Model\CompanyBoard;
use App\Model\EvCommentTab;
use App\Model\FullTbpAsset;
use App\Model\FullTbpGantt;
use App\Model\UserPosition;
use App\Model\CompanyEmploy;
use App\Model\CriteriaGroup;
use App\Model\EvEditHistory;
use App\Model\EventCalendar;
use App\Model\ExpertComment;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Model\DocumentEditor;
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
use App\Model\StockHolderEmploy;
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
use App\Model\ProjectStatusTransaction;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;
use App\Model\FullTbpReturnOfInvestment;
use App\Model\FullTbpProjectTechDevLevel;
use App\Http\Requests\AssignExpertRequest;
use App\Model\FullTbpCompanyProfileDetail;
use App\Model\FullTbpProjectAbtractDetail;
use App\Model\FullTbpProjectTechDevProblem;
use App\Model\FullTbpProjectAwardAttachment;
use App\Model\FullTbpProjectPlanTransaction;
use App\Model\FullTbpCompanyProfileAttachment;
use App\Model\FullTbpProjectCertifyAttachment;

class DashboardAdminProjectFullTbpController extends Controller
{
    public function Index(){
        $auth = Auth::user();
        NotificationBubble::where('target_user_id',Auth::user()->id)
                    ->where('notification_category_id',1) // notification_category_id 1 = โครงการ
                    ->where('notification_sub_category_id',5) // notification_sub_category_id 5 = Full TBP
                    ->where('status',0)->delete();                  
        $fulltbps = FullTbp::get();
        if($auth->user_type_id < 5){
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
        $companystockholders = StockHolderEmploy::where('company_id',$company->id)->get();
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
        $fulltbpprojectplantransactionarray =  FullTbpProjectPlanTransaction::where('full_tbp_id',$fulltbp->id)->distinct('month')->pluck('id')->toArray();
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

        $fulltbpprojectplantransactionarray =  FullTbpProjectPlanTransaction::where('full_tbp_id',$fulltbp->id)->distinct('month')->pluck('month')->toArray();
        $minmonth = 0;
        $maxmonth = 0;
        $allyears = array(0, 0, 0);
        if(count($fulltbpprojectplantransactionarray) != 0){
            $minmonth = min($fulltbpprojectplantransactionarray);
            $maxmonth = max($fulltbpprojectplantransactionarray);
            $year1 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 1 && $n <= 12;
            }); 
            $year2 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 13 && $n <= 24;
            });
            $year3 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 25 && $n <= 36;
            });
            if(count($year1) != 0){
                if(count($year2) != 0){
                    $year1 = range(min($year1),12);
                }else{
                    $year1 = range(min($year1),max($year1));
                }
            }else{
                $year1 = [];
            }
            
            if(count($year2) != 0){
                if(count($year1) != 0){
                    $year2 = range(13,max($year2));
                }else{
                    $year2 = range(min($year2),max($year2));
                }
            }else{
                $year2 = [];
            }
            if(count($year3) != 0){
                if(count($year2) != 0){
                    $year3 = range(25,max($year3));
                }else{
                    $year3 = range(min($year3),max($year3));
                }
            }else{
                $year3 = [];
            }
            $allyears = array(count($year1), count($year2), count($year3));
        }

        // $fulltbp_employ_activitylogs = Activity::causedBy($user)->where('log_name','Full TBP Employ')->orderBy('id','desc')->get();

        $fulltbpgantt = FullTbpGantt::where('full_tbp_id',$fulltbp->id)->first();
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
                                                ->withSignaturestatuses($signaturestatuses)
                                                ->withFulltbpgantt($fulltbpgantt)
                                                ->withMaxmonth($maxmonth)
                                                ->withMinmonth($minmonth)
                                                ->withAllyears($allyears);
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

    public function AssignExpertReview($id){
        $experts = User::where('user_type_id',3)->pluck('id')->toArray();
        $officers = User::where('user_type_id',4)->pluck('id')->toArray();
        $_experts = array_unique(array_merge($experts,$officers));
     
        $expertassignments = ExpertAssignment::where('full_tbp_id',$id)->get();
        $leader = ProjectAssignment::where('full_tbp_id',$id)->pluck('leader_id')->toArray();
        $coleader = ProjectAssignment::where('full_tbp_id',$id)->pluck('coleader_id')->toArray();
        $expertassignmentarray = array_unique(array_merge($leader,$coleader)); 
        $unique_array = array_diff($_experts, $expertassignmentarray);

        $fulltbp = FullTbp::find($id);
        $experts = User::whereIn('id',$unique_array)->get() ;

        if($fulltbp->assignexpert == 2){
            $expertassignments = ExpertAssignment::where('full_tbp_id',$id)->pluck('user_id')->toArray();
            $experts = User::whereIn('id',$expertassignments)->get() ;
        }

        return view('dashboard.admin.project.fulltbp.assignexpertreview')->withExpertassignments($expertassignments)
                                                        ->withExperts($experts)
                                                        ->withFulltbp($fulltbp);
    }

    public function AssignExpertReviewSave(AssignExpertRequest $request,$id){
        $auth = Auth::user();
        ExpertAssignment::where('full_tbp_id',$id)->whereNotIn('user_id',$request->expert)->delete();
        $existing_array = ExpertAssignment::where('full_tbp_id',$id)->pluck('user_id')->toArray();
        $unique_array = array_diff($request->expert,$existing_array);
        if(count($unique_array) == 0){
            return redirect()->back()->withSuccess('แก้ไขรายการสำเร็จ'); 
        }
        $experts = '';
        foreach ($unique_array as $key => $expert) {
            $check = ExpertAssignment::where('full_tbp_id', $id)
                                ->where('user_id',$expert)
                                ->first();
            if(Empty($check)){
                $expertassignment = new ExpertAssignment();
                $expertassignment->full_tbp_id = $id;
                $expertassignment->user_id = $expert;
                $expertassignment->expert_assignment_status_id = 1;
                $expertassignment->save();
                
                $user = User::find($expert);
                $experts .= 'คุณ' . $user->name . ' ' . $user->lastname . '<br>';
            }
        }

        $fulltbp = FullTbp::find($id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $_businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $_company = Company::find($_businessplan->company_id);
        
        $jduser = User::where('user_type_id',6)->first();

        $messagebox = Message::sendMessage('การมอบหมายผู้เชี่ยวชาญ โครงการ'.$minitbp->project .' บริษัท' . $_company->name,'คุณ'.$auth->name . ' ' . $auth->lastname.' (Leader) ได้มอบหมายให้ <br><br><div style="border-style: dashed;border-width: 2px; padding:10px">'.$experts.'</div><br>เป็นผู้เชี่ยวชาญในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล <a class="btn btn-sm bg-success" href='.route('dashboard.expert.report').'>ดำเนินการ</a>',Auth::user()->id,User::find($expertassignment->user_id)->id);

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $jduser->id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' คุณ'.$auth->name . ' ' . $auth->lastname.' (Leader) ได้มอบหมายให้ <br><br><div style="border-style: dashed;border-width: 2px; padding:10px">'.$experts.'</div><br>เป็นผู้เชี่ยวชาญในโครงการ'.$minitbp->project .' บริษัท' . $_company->name . ' <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>ดำเนินการ</a>';
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
        EmailBox::send($jduser->email,'TTRS:การมอบหมายผู้เชี่ยวชาญ โครงการ'.$minitbp->project  .' บริษัท' . $_company->name,'เรียน JD <br><br> คุณ'.$auth->name . ' ' . $auth->lastname.' (Leader) ได้มอบหมายให้ <br><br><div style="border-style: dashed;border-width: 2px; padding:10px">'.$experts.'</div><br><br>เป็นผู้เชี่ยวชาญในโครงการ'.$minitbp->project .' บริษัท' . $_company->name.' โปรดตรวจสอบข้อมูล <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        CreateUserLog::createLog('มอบหมายผู้เชี่ยวชาญ โครงการ' . $minitbp->project);

        return redirect()->back()->withSuccess('เพิ่มผู้เชี่ยวชาญสำเร็จ'); 
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
            $expertassignment = ExpertAssignment::find($request->id);
            $minitbp = MiniTBP::find(FullTbp::find($request->fulltbpid)->mini_tbp_id);
            
            $messagebox = Message::sendMessage('การมอบหมายผู้เชี่ยวชาญ โครงการ'.$minitbp->project,'ท่านได้รับมอบหมายให้เป็นผู้เชี่ยวชาญในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล <a class="btn btn-sm bg-success" href='.route('dashboard.expert.report').'>ดำเนินการ</a>',Auth::user()->id,User::find($expertassignment->user_id)->id);

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $expertassignment->user_id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' ได้รับมอบหมายให้เป็นผู้เชี่ยวชาญในโครงการ '.$minitbp->project .' ';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            EmailBox::send(User::find($expertassignment->user_id)->email,'TTRS:การมอบหมายผู้เชี่ยวชาญ โครงการ'.$minitbp->project,'เรียนคุณ'.User::find($expertassignment->user_id)->name . ' ' .User::find($expertassignment->user_id)->lastname.'<br><br> ท่านได้รับมอบหมายให้เป็นผู้เชี่ยวชาญในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล <a class="btn btn-sm bg-success" href='.route('dashboard.expert.report').'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
   
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
        $projectassignment = ProjectAssignment::where('business_plan_id',$_businessplan->id)->first();
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
            $timeLinehistory->details = 'แผนธุรกิจเทคโนโลยี (Full TBP) ของท่านได้รับอนุมัติ';
            $timeLinehistory->message_type = 2;
            $timeLinehistory->owner_id = $_company->user_id;
            $timeLinehistory->user_id = $auth->id;
            $timeLinehistory->save();

            $messagebox = Message::sendMessage('อนุมัติแผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project ,'แผนธุรกิจเทคโนโลยี (Full TBP) ของท่านได้รับอนุมัติแล้ว กรุณาเตรียมพร้อมสำหรับการประเมิณ ณ สถานประกอบการ',$auth->id,$_user->id);

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $_company->user_id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' แผนธุรกิจเทคโนโลยี (Full TBP) ของท่านได้รับอนุมัติ';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            $jduser = User::where('user_type_id',6)->first();

            $messagebox = Message::sendMessage('อนุมัติแผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project .' บริษัท' . $_company->name,'คุณ'.$auth->name . ' ' . $auth->lastname.' (Leader) ได้อนุมัติแผนธุรกิจเทคโนโลยี(Full TBP) โครงการ' . $minitbp->project .' บริษัท' . $_company->name ,$auth->id,$jduser->id);

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $jduser->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' คุณ'.$auth->name . ' ' . $auth->lastname.' (Leader) ได้อนุมัติแผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project .' บริษัท' . $_company->name;
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            EmailBox::send($jduser->email,'TTRS:อนุมัติแผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project .' บริษัท' . $_company->name,'เรียน JD <br><br> คุณ'.$auth->name . ' ' . $auth->lastname.' (Leader) ได้อนุมัติแผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project .' บริษัท' . $_company->name .' จึงแจ้งมาเพื่อทราบ <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            EmailBox::send($_user->email,'TTRS:อนุมัติแผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project .' บริษัท' . $_company->name,'เรียนผู้ขอรับการประเมิน<br><br> แผนธุรกิจเทคโนโลยี (Full TBP) ของท่านได้รับอนุมัติแล้ว กรุณาเตรียมพร้อมสำหรับการประเมิณ ณ สถานประกอบการ <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            
            $projectstatustransaction = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',3)->first();
            if($projectstatustransaction->status == 1){
                $ev = Ev::where('full_tbp_id',$fulltbp->id)->first();
                if($_businessplan->business_plan_status_id == 6 && $fulltbp->assignexpert == 2 && $ev->status ==4){
                    $projectstatustransaction->update([
                        'status' => 2
                    ]);
                   $projectstatustransaction = new ProjectStatusTransaction();
                   $projectstatustransaction->mini_tbp_id = $minitbp->id;
                   $projectstatustransaction->project_flow_id = 4;
                   $projectstatustransaction->save();

                   $messagebox =  Message::sendMessage('สร้างปฏิทินนัดหมาย โครงการ' . $minitbp->project . ' บริษัท' . $_company->name ,'Full TBP, การมอบหมายผู้เชี่ยวชาญ และ EV โครงการ' . $minitbp->project . 'ได้รับการอนุมัติแล้ว กรุณาสร้างปฏิทินกิจกรรมเพื่อนัดหมายการประเมินต่อไป โปรดตรวจสอบ <a href='.route('dashboard.admin.calendar').'>คลิกที่นี่</a>',Auth::user()->id,$projectassignment->leader_id);
                   $alertmessage = new AlertMessage();
                   $alertmessage->user_id = $auth->id;
                   $alertmessage->target_user_id =  $projectassignment->leader_id;
                   $alertmessage->messagebox_id = $messagebox->id;
                   $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() .' Full TBP, การมอบหมายผู้เชี่ยวชาญ และ EV โครงการ' . $minitbp->project . 'ได้รับการอนุมัติแล้ว กรุณาสร้างปฏิทินกิจกรรมเพื่อนัดหมายการประเมินต่อไป' ;
                   $alertmessage->save();

                   EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:สร้างปฏิทินนัดหมาย โครงการ' . $minitbp->project . ' บริษัท' . $_company->name,'เรียน Leader<br><br> Full TBP, การมอบหมายผู้เชี่ยวชาญ และ EV โครงการ' . $minitbp->project .  ' บริษัท' . $_company->name . ' ได้รับการอนุมัติแล้ว กรุณาสร้างปฏิทินกิจกรรมเพื่อนัดหมายการประเมินต่อไป โปรดตรวจสอบ <a href='.route('dashboard.admin.calendar').'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
                   DateConversion::addExtraDay($minitbp->id,3);
                }
            }
            CreateUserLog::createLog('อนุมัติ Full TBP โครงการ' . $minitbp->project);
        }else{
            
            FullTbp::find($request->id)->update(
                [
                    'refixstatus' => 1
                ]
            );

            $timeLinehistory = new TimeLineHistory();
            $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
            $timeLinehistory->details = $request->note;
            $timeLinehistory->user_id = $auth->id;
            $timeLinehistory->message_type = 2;
            $timeLinehistory->owner_id = $_company->user_id;
            $timeLinehistory->save();

            $messagebox = Message::sendMessage('แก้ไขข้อมูลแผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project,'แผนธุรกิจเทคโนโลยี (Full TBP) ของท่านยังไม่ได้รับการอนุมัติ โปรดทำการแก้ไขตามข้อแนะนำ ดังนี้<br><br><div style="border-style: dashed;border-width: 2px; padding:10px">'.$request->note.'</div><br><a class="btn btn-sm bg-success" href='.route('dashboard.company.project.fulltbp.edit',['id' => $fulltbp->id]).'>ดำเนินการ</a>',$auth->id,$_user->id);
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $_company->user_id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' โปรดแก้ไขแผนธุรกิจเทคโนโลยี (Full TBP) ตามข้อแนะนำ ดังนี้<br><br><div style="border-style: dashed;border-width: 2px; padding:10px">'.$request->note.'</div><br> <a class="btn btn-sm bg-success" href='.route('dashboard.company.project.fulltbp.edit',['id' => $fulltbp->id]).'>ดำเนินการ</a>';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            $reviselog = new ReviseLog();
            $reviselog->mini_tbp_id = $minitbp->id;
            $reviselog->user_id = $auth->id;
            $reviselog->message = $request->note;
            $reviselog->doctype = 2;
            $reviselog->save();

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $minitbp->business_plan_id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 5;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $_user->id;
            $notificationbubble->save();

            EmailBox::send($_user->email,'TTRS:แก้ไขข้อมูลแผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project,'เรียนผู้ขอรับการประเมิน<br><br> แผนธุรกิจเทคโนโลยี (Full TBP) ของท่านยังไม่ได้รับการอนุมัติ โปรดเข้าสู่ระบบเพื่อทำการแก้ไขตามข้อแนะนำ ดังนี้<br><br><div style="border-style: dashed;border-width: 2px; padding:10px">'.$request->note.'</div><br>โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.company.project.fulltbp.edit',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            CreateUserLog::createLog('ส่งคืน Full TBP โครงการ' . $minitbp->project);
        }
        return response()->json($fulltbp); 
    }
    public function GetExpert(Request $request){
        $expertassignments = ExpertAssignment::where('user_id',$request->id)->get();
        return response()->json($expertassignments); 
    }  
    public function NotifyJd(Request $request){
        $auth = Auth::user();
        $fulltbp = FullTbp::find($request->fulltbpid);
        $minitbp = MiniTBP::find(FullTbp::find($request->fulltbpid)->mini_tbp_id);
        if(!Empty($request->users)){
            $expert = '';
            foreach($request->users as $_user){
                $user = User::find($_user);
                $expert .= $user->name . ' ' . $user->lastname . '<br>';
            }
            $jduser = User::where('user_type_id',6)->first();
            $messagebox = Message::sendMessage('การมอบหมายผู้เชี่ยวชาญ โครงการ'.$minitbp->project,'Leader ได้มอบหมายให้ <br><br>' .$expert . ' <br> เป็นผู้เชี่ยวชาญในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>ดำเนินการ</a>',$auth->id,$jduser->id);
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $jduser->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() . ' ตรวจสอบการมอบหมายผู้เชี่ยวชาญ สำหรับโครงการ' . $minitbp->project . ' <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>ดำเนินการ</a> ';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $minitbp->business_plan_id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 5;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $jduser->id;
            $notificationbubble->save();

            EmailBox::send($jduser->email,'TTRS:การมอบหมายผู้เชี่ยวชาญ โครงการ'.$minitbp->project,'เรียน JD <br> Leader ได้มอบหมายให้ <br><br>' .$expert . ' <br>เป็นผู้เชี่ยวชาญในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            
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

        $messagebox = Message::sendMessage('JD ได้พิจารณาผู้เชี่ยวชาญ โครงการ' . $minitbp->project . ' เสร็จแล้ว','JD ได้พิจารณาผู้เชี่ยวชาญสำหรับโครงการ' . $minitbp->project . ' เสร็จแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$projectassignment->leader_id);
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $projectassignment->leader_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().  'JD ได้พิจารณาผู้เชี่ยวชาญสำหรับโครงการ' . $minitbp->project . ' เสร็จแล้ว <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>ดำเนินการ</a>' ;
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);
        
        EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:JD ได้พิจารณาผู้เชี่ยวชาญ โครงการ' . $minitbp->project . ' เสร็จแล้ว','เรียน Leader<br><br> JD ได้พิจารณาผู้เชี่ยวชาญสำหรับโครงการ' . $minitbp->project . ' เสร็จแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        
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

    public function FinishProject($id){
        FullTbp::find($id)->update([
            'status' => 3
        ]);

        $auth = Auth::user();
        $fulltbp = FullTbp::find($id);

        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectsmembers = ProjectMember::where('full_tbp_id',$id)->get();
        $company = Company::find($businessplan->company_id);
        foreach ($projectsmembers as $key => $projectsmember) {
            $messagebox = Message::sendMessage('แจ้งสิ้นสุดโครงการ'.$minitbp->project. ' บริษัท' . $company->name,'แจ้งสิ้นสุดโครงการโครงการ '.$minitbp->project . ' บริษัท' . $company->name,$auth->id,$projectsmember->user_id);
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id =$projectsmember->user_id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' แจ้งสิ้นสุดโครงการ ' . $minitbp->project ;
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            EmailBox::send(User::find($projectsmember->user_id)->email,'TTRS:แจ้งสิ้นสุดโครงการ'.$minitbp->project. ' บริษัท' . $company->name,'เรียนท่านคณะกรรมการ <br><br>แจ้งสิ้นสุดโครงการโครงการ '.$minitbp->project. ' บริษัท' . $company->name .'<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());  
        }

        // $company = Company::find($businessplan->company_id);
        // $messagebox = Message::sendMessage('สิ้นสุดโครงการ'.$minitbp->project,'แจ้งสิ้นสุดโครงการโครงการ'.$minitbp->project ,$auth->id,$company->user_id);
        // $alertmessage = new AlertMessage();
        // $alertmessage->user_id = $auth->id;
        // $alertmessage->target_user_id =$company->user_id;
        // $alertmessage->messagebox_id = $messagebox->id;
        // $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' แจ้งสิ้นสุดโครงการ ' . $minitbp->project ;
        // $alertmessage->save();

        // EmailBox::send(User::find($company->user_id)->email,'TTRS:สิ้นสุดโครงการ'.$minitbp->project,'เรียนผู้ขอรับการประเมิน<br><br>แจ้งสิ้นสุดโครงการโครงการ '.$minitbp->project.'<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        

        $timeLinehistory = new TimeLineHistory();
        $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
        $timeLinehistory->details = 'สิ้นสุดโครงการ';
        $timeLinehistory->message_type = 3;
        $timeLinehistory->owner_id = $auth->id;
        $timeLinehistory->user_id = $auth->id;
        $timeLinehistory->save();

        BusinessPlan::find($minitbp->business_plan_id)->update([
            'business_plan_status_id' => 10
        ]);

        EventCalendar::where('full_tbp_id',$id)->delete();
        $projectstatustransaction = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',8)->first();
        if($projectstatustransaction->status == 1){
            $projectstatustransaction->update([
                'status' => 2
            ]);
            DateConversion::addExtraDay($minitbp->id,8);
        }
        CreateUserLog::createLog('ยืนยันสิ้นสุดโครงการ โครงการ' . $minitbp->project);
        return redirect()->back()->withSuccess('สิ้นสุดโครงการ'.$minitbp->project.'สำเร็จ');
    }
}
