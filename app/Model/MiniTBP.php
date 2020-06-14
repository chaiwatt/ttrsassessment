<?php

namespace App\Model;

use App\Model\Prefix;
use App\Model\ThaiBank;
use App\Model\BusinessPlan;
use Illuminate\Database\Eloquent\Model;

class MiniTBP extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getBusinessPlanAttribute(){
        return BusinessPlan::find($this->business_plan_id)->first();
    } 
    public function getPrefixAttribute(){
        return Prefix::find($this->contactprefix)->first();
    } 
    public function getBankAttribute(){
        return ThaiBank::find($this->thai_bank_id)->first();
    } 

}
