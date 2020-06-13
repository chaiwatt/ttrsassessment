<?php

namespace App\Model;

use App\Model\BusinessPlan;
use Illuminate\Database\Eloquent\Model;

class MiniTBP extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getBusinessPlanAttribute(){
        return BusinessPlan::find($this->business_plan_id)->first();
    } 

}
