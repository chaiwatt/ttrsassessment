<?php

namespace App\Model;

use App\Model\Company;
use App\Model\FeeType;
use App\Model\BusinessPlan;
use Illuminate\Database\Eloquent\Model;

class BusinessPlanFeeTransaction extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    
    public function getCompanyAttribute(){
        $businessplan = BusinessPlan::find($this->business_plan_id); 
        return Company::find($businessplan->company_id);
    } 
    public function getFeeTypeAttribute(){
        return FeeType::find($this->fee_type_id);
    } 

}
