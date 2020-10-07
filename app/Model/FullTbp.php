<?php

namespace App\Model;

use App\Model\Ev;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\CriteriaGroup;
use App\Model\EventCalendar;
use App\Model\ExpertComment;
use App\Model\ProjectMember;
use App\Model\ScoringStatus;
use App\Model\ProjectScoring;
use App\Helper\DateConversion;
use App\Model\ExpertAssignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

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
        return ExpertAssignment::where('user_id',Auth::user()->id)->first();
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
        $scoringstatuses = ScoringStatus::where('ev_id',$ev->id)->pluck('user_id')->toArray();
        $projectmembers = ProjectMember::where('full_tbp_id',$this->id)->pluck('user_id')->toArray();
        return count(array_diff($projectmembers,$scoringstatuses));
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

      
}


