<?php

namespace App\Model;

use App\Model\Ev;
use App\Model\Bol;
use App\Model\Prefix;
use App\Model\MiniTBP;
use App\Model\FullTbpCost;
use App\Model\FullTbpSell;
use App\Model\BusinessPlan;
use App\Model\FullTbpAsset;
use App\Model\CompanyEmploy;
use App\Model\CriteriaGroup;
use App\Model\EventCalendar;
use App\Model\ExpertComment;
use App\Model\ProjectMember;
use App\Model\ScoringStatus;
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
use App\Model\FullTbpCreditPartner;
use App\Model\FullTbpMarketAnalysis;
use App\Model\FullTbpProjectCertify;
use Illuminate\Support\Facades\Auth;
use App\Model\FullTbpResponsiblePerson;
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
    public function getExpertCommentAttribute(){
        return ExpertComment::where('full_tbp_id',$this->id)->where('user_id',Auth::user()->id)->first();
    } 
    public function getBriefingdateAttribute(){
        $eventcalendar = EventCalendar::where('full_tbp_id',$this->id)->where('calendar_type_id',1)->first();
        if(!Empty($eventcalendar)){
            return DateConversion::engToThaiDate($eventcalendar->eventdate);
        }else{
            return '';
        }
    } 
    public function getAssessmentdateAttribute(){
        $eventcalendar = EventCalendar::where('full_tbp_id',$this->id)->where('calendar_type_id',2)->first();
        if(!Empty($eventcalendar)){
            return DateConversion::engToThaiDate($eventcalendar->eventdate);
        }else{
            return '';
        }
    } 
    public function getFinalassessmentdateAttribute(){
        $eventcalendar = EventCalendar::where('full_tbp_id',$this->id)->where('calendar_type_id',3)->first();
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
        return CompanyEmploy::where('full_tbp_id',$this->id)->where('employ_position_id',1)->first();
    }  

    public function getEmployeducationAttribute(){
        $ceo = CompanyEmploy::where('full_tbp_id',$this->id)->where('employ_position_id',1)->first();
        return EmployEducation::where('company_employ_id',$ceo->id)->get();
    }  

    public function getEmployexperienceAttribute(){
        $ceo = CompanyEmploy::where('full_tbp_id',$this->id)->where('employ_position_id',1)->first();
        return EmployExperience::where('company_employ_id',$ceo->id)->get();
    } 
    
    public function getEmploytrainingAttribute(){
        $ceo = CompanyEmploy::where('full_tbp_id',$this->id)->where('employ_position_id',1)->first();
        return EmployTraining::where('company_employ_id',$ceo->id)->get();
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
}


