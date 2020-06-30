<?php

namespace App\Model;

use App\User;
use App\Model\BusinessPlan;
use Illuminate\Database\Eloquent\Model;

class ProjectAssignment extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    public function getBusinessPlanAttribute(){
        return BusinessPlan::find($this->business_plan_id)->first();
    } 
    public function getLeaderAttribute(){
        return User::find($this->leader_id);
    } 
    public function getCoLeaderAttribute(){
        return User::find($this->coleader_id);
    } 
}
