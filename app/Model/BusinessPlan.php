<?php

namespace App\Model;

use App\Model\Company;
use App\Model\MiniTBP;
use App\Helper\DateConversion;
use App\Model\ProjectAssignment;
use App\Model\BusinessPlanStatus;
use Illuminate\Database\Eloquent\Model;

class BusinessPlan extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['company','businessplanstatus'];

    public function getCompanyAttribute(){
        return Company::find($this->company_id);
    } 
    public function getBusinessPlanStatusAttribute(){
        return BusinessPlanStatus::find($this->business_plan_status_id,['name', 'progress']);
    } 

    public function getCreateddateTHAttribute(){
        return DateConversion::engToThaiDate($this->created_at->toDateString());
    } 

    public function getUpdatedAtThAttribute(){
        return DateConversion::engToThaiDate($this->updated_at->toDateString());
    } 

    public function getMiniTBPAttribute(){
        return MiniTBP::where('business_plan_id',$this->id)->first();
    } 

    public function getProjectassignmentAttribute(){
        return ProjectAssignment::where('business_plan_id',$this->id)->first();
    } 
    
}
