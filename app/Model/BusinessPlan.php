<?php

namespace App\Model;

use App\Model\Company;
use App\Model\BusinessPlanStatus;
use Illuminate\Database\Eloquent\Model;

class BusinessPlan extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getCompanyAttribute(){
        return Company::find($this->company_id);
    } 
    public function getBusinessPlanStatusAttribute(){
        return BusinessPlanStatus::find($this->business_plan_status_id);
    } 
    
}
