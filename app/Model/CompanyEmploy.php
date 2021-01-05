<?php

namespace App\Model;

use App\Model\Prefix;
use App\Model\Company;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\EmployPosition;
use App\Model\EmployTraining;
use App\Model\EmployEducation;
use App\Model\EmployExperience;
use App\Model\FulltbpSignature;
use App\Model\MinitbpSignature;
use Illuminate\Database\Eloquent\Model;

class CompanyEmploy extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['employposition','prefix'];
    public function getEmploypositionAttribute()
    {
        return EmployPosition::find($this->employ_position_id);
    }
    public function getPrefixAttribute()
    {
        return Prefix::find($this->prefix_id);
    }

    public function getEmployeducationAttribute(){
        return EmployEducation::where('company_employ_id',$this->id)->get();
    }  

    public function getEmployexperienceAttribute(){
        return EmployExperience::where('company_employ_id',$this->id)->get();
    } 
    
    public function getEmploytrainingAttribute(){
        return EmployTraining::where('company_employ_id',$this->id)->get();
    } 

    public function getUsesignatureAttribute(){
        $company = Company::find($this->company_id);
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        $minitbp=MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $signature = '1';
        $check = MinitbpSignature::where('company_employee_id',$this->id)->where('mini_tbp_id',$minitbp->id)->first();
        if(!Empty($check)){
            $signature = '2';
        }
        return $signature;
    } 

    public function getUsefulltbpsignatureAttribute(){
        $company = Company::find($this->company_id);
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        $minitbp=MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
        $signature = '1';
        $check = FulltbpSignature::where('company_employee_id',$this->id)->where('full_tbp_id',$fulltbp->id)->first();
        if(!Empty($check)){
            $signature = '2';
        }
        return $signature;
    } 
}
