<?php

namespace App\Model;

use App\User;
use App\Model\Ev;
use App\Model\Bol;
use App\Model\Prefix;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\Province;
use App\Model\ReviseLog;
use App\Model\FullTbpCost;
use App\Model\FullTbpSell;
use App\Model\BusinessPlan;
use App\Model\FullTbpAsset;
use App\Model\ProjectGrade;
use App\Model\CompanyEmploy;
use App\Model\CriteriaGroup;
use App\Model\EventCalendar;
use App\Model\ExpertComment;
use App\Model\ProjectMember;
use App\Model\ScoringStatus;
use App\Model\CompanyAddress;
use App\Model\EmployTraining;
use App\Model\ProjectScoring;
use App\Helper\DateConversion;
use App\Model\EmployEducation;
use App\Model\FullTbpEmployee;
use App\Model\EmployExperience;
use App\Model\EvaluationResult;
use App\Model\ExpertAssignment;
use App\Model\FullTbpInvestment;
use App\Model\FullTbpMarketSwot;
use App\Model\FullTbpSellStatus;
use App\Model\FullTbpDebtPartner;
use App\Model\FullTbpProjectPlan;
use App\Model\CriteriaTransaction;
use App\Model\ProjectMemberBackup;
use App\Model\FullTbpCreditPartner;
use App\Model\FullTbpMarketAnalysis;
use App\Model\FullTbpProjectCertify;
use Illuminate\Support\Facades\Auth;
use App\Model\FullTbpResponsiblePerson;
use App\Model\ProjectStatusTransaction;
use Illuminate\Database\Eloquent\Model;
use App\Model\FullTbpReturnOfInvestment;
use App\Model\FullTbpProjectTechDevLevel;
use App\Model\FullTbpMarketBusinessModelCanvas;

class FullTbp extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['minitbp','updatedatth','expertassignment'];

    public function getMiniTbpAttribute(){
        return MiniTBP::find($this->mini_tbp_id);
    } 

    public function getYearListAttribute(){
        $presentyear = intval($this->created_at->format('Y'))+543;
        $myarray[] = array(
            'present' => $presentyear, 
            'past1' => $presentyear-1,
            'past2' => $presentyear-2,
            'past3' => $presentyear-3
        ); 
        $collection = collect($myarray)->first();
        return response()->json($myarray)->getContent(); 
    } 
    public function getPresentYearAttribute(){
        $presentyear = intval($this->created_at->format('Y'))+543;
        return $presentyear ; 
    } 
    public function getPast1Attribute(){
        $presentyear = intval($this->created_at->format('Y'))+543-1;
        return $presentyear ; 
    } 
    public function getPast2Attribute(){
        $presentyear = intval($this->created_at->format('Y'))+543-2;
        return $presentyear ; 
    } 
    public function getPast3Attribute(){
        $presentyear = intval($this->created_at->format('Y'))+543-3;
        return $presentyear ; 
    } 

    public function getUpdatedAtThAttribute(){
        return DateConversion::engToThaiDate($this->updated_at->toDateString());
    } 

    public function getCriteriagroupAttribute(){
        return CriteriaGroup::find($this->criteria_group_id);
    } 

    public function getProjectScoreAttribute(){
        return ProjectScoring::where('full_tbp_id',$this->id)
                            ->where('user_id',Auth::user()->id)
                            ->where('criteria_group_id',$this->criteria_group_id)
                            ->first();
    } 

    public function getExpertAssignmentAttribute(){
        return ExpertAssignment::where('user_id',Auth::user()->id)
                            ->where('full_tbp_id',$this->id)
                            ->first();
    } 
    public function getExpertAssignmentsAttribute(){
        return ExpertAssignment::where('full_tbp_id',$this->id)
                            // ->where('expert_assignment_status_id',2)
                            // ->where('accepted',1)
                            ->get();
    } 
    public function getProjectmemberAttribute(){
        return ProjectMember::where('full_tbp_id',$this->id)->get();
    } 
    public function getProjectmemberbackupAttribute(){
        return ProjectMemberBackup::where('full_tbp_id',$this->id)->get();
    } 
    public function getJduserAttribute(){
        return User::where('user_type_id',6)->first();
    } 
    public function getAllScoringAttribute(){
        $ev = Ev::where('full_tbp_id',$this->id)->first();
        
        if(!Empty($ev)){
            $scoringstatuses = ScoringStatus::where('ev_id',$ev->id)->pluck('user_id')->toArray();
            $projectmembers = ProjectMember::where('full_tbp_id',$this->id)->pluck('user_id')->toArray(); 
            return count(array_diff($projectmembers,$scoringstatuses));
        }else{
            return ProjectMember::where('full_tbp_id',$this->id)->count();
        }
        
        
    }
    public function getProjectAssignmentAttribute(){
        $minitbp = MiniTBP::find($this->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        return ProjectAssignment::where('business_plan_id',$businessplan->id)
                            ->where('leader_id',Auth::user()->id)->get();
    } 

    public function getEvAttribute(){
        return Ev::where('full_tbp_id',$this->id)->first();
    } 

    public function getProjectleaderAttribute(){
        return ProjectAssignment::where('full_tbp_id',$this->id)->first()->leader_id;
    } 


    public function getExpertCommentAttribute(){
        return ExpertComment::where('full_tbp_id',$this->id)->where('user_id',Auth::user()->id)->first();
    } 
    public function getBriefingdateAttribute(){
        $eventcalendar = EventCalendar::where('full_tbp_id',$this->id)
                                    ->whereNotNull('subject')
                                    ->whereNotNull('starttime')
                                    ->whereNotNull('endtime')
                                    ->whereNotNull('summary')
                                    ->where('calendar_type_id',1)
                                    ->orderBy('id','asc')->first();
        if(!Empty($eventcalendar)){
            return DateConversion::engToThaiDate($eventcalendar->eventdate);
        }else{
            return '';
        }
    } 
    public function getAssessmentdateAttribute(){
        $eventcalendar = EventCalendar::where('full_tbp_id',$this->id)->where('calendar_type_id',2)->orderBy('id','asc')->first();
        if(!Empty($eventcalendar)){
            return DateConversion::engToThaiDate($eventcalendar->eventdate);
        }else{
            return '';
        }
    } 
    public function getFinalassessmentdateAttribute(){
        $eventcalendar = EventCalendar::where('full_tbp_id',$this->id)->where('calendar_type_id',3)->orderBy('id','asc')->first();
        if(!Empty($eventcalendar)){
           return DateConversion::engToThaiDate($eventcalendar->eventdate);
        }else{
            return '';
        }
    } 

    public function getFulltbpemployeeAttribute(){
        return FullTbpEmployee::where('full_tbp_id',$this->id)->first();
    }  
    public function getFulltbpresponsiblepersonAttribute(){
        return FullTbpResponsiblePerson::where('full_tbp_id',$this->id)->first();
    }  

    public function getCompanyemployAttribute(){
        $minitbp = MiniTBP::find($this->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        return CompanyEmploy::where('company_id',$company->id)->where('employ_position_id',1)->first();
    }  

    public function getEmployeducationAttribute(){
        $minitbp = MiniTBP::find($this->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $ceo = CompanyEmploy::where('company_id',$company->id)->where('employ_position_id',1)->first();
        return EmployEducation::where('company_employ_id',@$ceo->id)->get();
    }  

    public function getEmployexperienceAttribute(){
        $minitbp = MiniTBP::find($this->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $ceo = CompanyEmploy::where('company_id',$company->id)->where('employ_position_id',1)->first();
        return EmployExperience::where('company_employ_id',@$ceo->id)->get();
    } 
    
    public function getEmploytrainingAttribute(){
        $minitbp = MiniTBP::find($this->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $ceo = CompanyEmploy::where('company_id',$company->id)->where('employ_position_id',1)->first();
        return EmployTraining::where('company_employ_id',@$ceo->id)->get();
    } 
       
    public function getFulltbpprojecttechdevlevelAttribute(){
        return FullTbpProjectTechDevLevel::where('full_tbp_id',$this->id)->get();
    } 

    public function getFulltbpprojectcertifyAttribute(){
        return FullTbpProjectCertify::where('full_tbp_id',$this->id)->first();
    } 

    public function getFulltbpprojectplanAttribute(){
        return FullTbpProjectPlan::where('full_tbp_id',$this->id)->get();
    } 

    public function getFulltbpmarketanalysisAttribute(){
        return FullTbpMarketAnalysis::where('full_tbp_id',$this->id)->first();
    } 

    public function getFulltbpmarketbusinessmodelcanvasAttribute(){
        return FullTbpMarketBusinessModelCanvas::where('full_tbp_id',$this->id)->first();
    } 

    public function getFulltbpmarketswotAttribute(){
        return FullTbpMarketSwot::where('full_tbp_id',$this->id)->first();
    } 
    
    public function getFulltbpsellAttribute(){
        return FullTbpSell::where('full_tbp_id',$this->id)->get();
    } 
    
    public function getFulltbpsellstatusAttribute(){
        return FullTbpSellStatus::where('full_tbp_id',$this->id)->get();
    } 

    public function getFulltbpdebtpartnerAttribute(){
        return FullTbpDebtPartner::where('full_tbp_id',$this->id)->get();
    } 

    public function getFulltbpcreditpartnerAttribute(){
        return FullTbpCreditPartner::where('full_tbp_id',$this->id)->get();
    } 
    
    public function getFulltbpassetAttribute(){
        return FullTbpAsset::where('full_tbp_id',$this->id)->get();
    } 

    public function getFulltbpinvestmentAttribute(){
        return FullTbpInvestment::where('full_tbp_id',$this->id)->get();
    }

    public function getFulltbpcostAttribute(){
        return FullTbpCost::where('full_tbp_id',$this->id)->get();
    }

    public function getFulltbpreturnofinvestmentAttribute(){
        return FullTbpReturnOfInvestment::where('full_tbp_id',$this->id)->first();
    }

    public function getBolAttribute(){
        return Bol::where('full_tbp_id',$this->id)->get();
    }
    
    public function getEvaluationresultAttribute(){
        return EvaluationResult::where('full_tbp_id',$this->id)->first();
    }
    public function getProjectgradeAttribute(){
        return ProjectGrade::where('full_tbp_id',$this->id)->first();
    }
    public function Projectstatustransaction($flowid){
        $minitbp = MiniTBP::find($this->mini_tbp_id);
        $check = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',$flowid)->first();
        if(Empty($check)){
            return null;
        }else{
            return $check;
        }
    }
    public function Resultissuedate($flowid){
        $minitbp = MiniTBP::find($this->mini_tbp_id);
        $check = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',$flowid)->first();
        if(!Empty($check)){
            return DateConversion::engToThaiDate($check->created_at->toDateString());
        }else{
            return '';
        }

    }

    public function HaveExpertComment($fulltbpid){
        return ExpertComment::where('full_tbp_id',$fulltbpid)->count();
    }

    public function getSubmitdateThAttribute(){
        if(!Empty($this->submitdate)){
            return DateConversion::engToThaiDate($this->submitdate);
        }else{
           return "" ;
        }
    } 

    public function getCanceldatethAttribute(){
        if(!Empty($this->canceldate)){
            return DateConversion::engToThaiDate($this->canceldate);
        }else{
           return "" ;
        }
    } 

    public function getProjectBudgetAttribute(){
        $check = FullTbpInvestment::where('full_tbp_id',$this->id)->sum('cost');
        $projectbudget = ProjectBudget::where('minbudget','<=',$check)->where('maxbudget','>=',$check)->first();
        if($projectbudget->id == 1){
           return "น้อยกว่า " . number_format($projectbudget->maxbudget) ." บาท";
        }elseif($projectbudget->id == 4){
            return "มากกว่า " . number_format($projectbudget->minbudget) ." บาท";
        }else{
            return "ตั้งแต่ " . number_format($projectbudget->minbudget) . ' - ' . number_format($projectbudget->maxbudget) ." บาท";
        }
    } 

    public function getIsEvaluationResultReadyAttribute(){
        $evaluationresult = EvaluationResult::where('full_tbp_id',$this->id)->first();
        
        if(!empty($evaluationresult->management) && !empty($evaluationresult->technoandinnovation) && !empty($evaluationresult->marketability) && !empty($evaluationresult->businessprospect)){
            return 1;
        }else{
            return 0;
        }   
        // return ExpertComment::where('full_tbp_id',$fulltbpid)->count();
    }

    public function getReviselogAttribute(){
        $fulltbp = FullTbp::find($this->id);
        return ReviseLog::where('mini_tbp_id',$fulltbp->mini_tbp_id)->where('doctype',2)->get();
    }

    public function getCreatedAtThAttribute(){
        return DateConversion::thaiDateTime2($this->created_at,'full');
    } 

    public function getBrieftdatethAttribute(){
        if(!Empty($this->brieftdate)){
            return DateConversion::engToThaiDate($this->brieftdate);
        }else{
           return "" ;
        }
    } 
    public function getFielddatethAttribute(){
        if(!Empty($this->fielddate)){
            return DateConversion::engToThaiDate($this->fielddate);
        }else{
           return "" ;
        }
    } 
    public function getScoringdatethAttribute(){
        if(!Empty($this->scoringdate)){
            return DateConversion::engToThaiDate($this->scoringdate);
        }else{
           return "" ;
        }
    } 

    public function getFinishdatethAttribute(){
        if(!Empty($this->finishdate)){
            return DateConversion::engToThaiDate($this->finishdate);
        }else{
           return "" ;
        }
    } 

    public function getProjectcapitalnameAttribute(){
        $check = intVal(FullTbpInvestment::where('full_tbp_id',$this->id)->sum('cost'));
        if($check >=0 && $check <500000){
            return 'น้อยกว่า 500,000 บาท';
        }else if($check >=500000 && $check <1000000){
            return 'ตั้งแต่ 500,000 - 1,000,000 บาท';
        }else if($check >=1000000 && $check <10000000){
            return 'ตั้งแต่ 1,000,000 - 10,000,000 บาท';
        }else if($check >= 10000000){
            return 'มากกว่า 10,000,000 บาท';
        }
    } 

    public function Projectprovincename($proviceid){
        if(!Empty($proviceid)){
            return Province::find($proviceid)->name;
        }else{

        $minitbp = MiniTBP::find($this->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $arr = CompanyAddress::where('company_id',$company->id)->pluck('province_id')->toArray();
        $provinces = Province::whereIn('id',$arr)->get();
        $_provinces = '';
        foreach ($provinces as $key => $province) {
            $_provinces .= $province->name . ', ';
        }

            return rtrim($_provinces, ', ');
        }
        
    } 

    public function getProjectprovincesectornameAttribute(){
        $minitbp = MiniTBP::find($this->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $provinceid = CompanyAddress::where('company_id',$company->id)->first();
        return Sector::find(Province::find($provinceid->province_id)->map_code)->name;
        // return Province::find($provinceid->province_id)->name;
    } 

    public function getFinishmonthAttribute(){
        if(!Empty($this->finishdate)){
            return DateConversion::getThaiMonth($this->finishdate);
        }else{
            return '';
        }
    } 

    public function getFinishyearAttribute(){
        if(!Empty($this->finishdate)){
            return intVal(explode("/",$this->finishdate)[0])+543;
        }else{
            return '';
        }
    } 

    public function getFinishyearbudgetAttribute(){
        if(!Empty($this->finishdate)){
            return  $this->fiscalYear($this->finishdate);
        }else{
           return "" ;
        }
    }

    public function getSubmitdateyearbudgetthAttribute(){
        if(!Empty($this->submitdate)){
            return  $this->fiscalYear($this->submitdate);
        }else{
           return "" ;
        }
    }

    public function getCanceldateyearbudgetthAttribute(){
        if(!Empty($this->canceldate)){
            return  $this->fiscalYear($this->canceldate);
        }else{
           return "" ;
        }
    }

    public function getSubmitdateyearthAttribute(){
        if(!Empty($this->submitdate)){
            $check = DateConversion::engToThaiDate($this->submitdate);
            preg_match("/[^\/]+$/", $check, $matches);
            return $matches[0]; 
        }else{
           return "" ;
        }
    } 

    
    public function getSubmitmonthAttribute(){
        if(!Empty($this->submitdate)){
            return DateConversion::getThaiMonth($this->submitdate);
        }else{
            return '';
        }
    } 

    public function fiscalYear($date) {
        // วันที่ที่ต้องการตรวจสอบ
        list($year, $month, $day) = explode("-", $date);
        // วันที่ที่ส่งมา (mktime)
        $cday = mktime(0, 0, 0, $month, $day, $year);
        // ปีงบประมาณตามค่าที่ส่งมา (mktime)
        $d1 = mktime(0, 0, 0, 10, 1, $year );
        // ปีใหม่
        $d2 = mktime(0, 0, 0, 9, 30, $year + 1);
        if ($cday >= $d1 && $cday < $d2) {
            // 1 ตค. -  ธค.
        
        $year++;
        
        }
        return $year+543;
    }


    public function getCancelyearAttribute(){
        if(!Empty($this->canceldate)){
            return intVal(explode("/",$this->canceldate)[0])+543;
        }else{
            return '';
        }
    } 

    public function getCancelmonthAttribute(){
        if(!Empty($this->canceldate)){
            return DateConversion::getThaiMonth($this->canceldate);
        }else{
            return '';
        }
    } 

    public function getSearchprojectleaderAttribute(){
        $check =  ProjectAssignment::where('full_tbp_id',$this->id)->first();
        if(!Empty($check)){
            $user = User::find($check->leader_id);
            return $user->name .' '.$user->lastname;
        }else{
            return '';
        }
    } 

    public function getSearchprojectexpertAttribute(){
        $expertassignments =  ExpertAssignment::where('full_tbp_id',$this->id)->get();
        if($expertassignments->count() > 0){
            $apptext = '';
            foreach ($expertassignments as $key => $expert) {
                $user = User::find($expert->user_id);
                $apptext .= $user->name .' '. $user->lastname . ' ';
            }
            return $apptext;
        }else{
            return '';
        }
    } 

    public function getSearchprojectgradeAttribute(){
        $check =  ProjectGrade::where('full_tbp_id',$this->id)->first();
        if(!Empty($check)){
            return $check->grade;
        }else{
            return '';
        }
    } 

}


