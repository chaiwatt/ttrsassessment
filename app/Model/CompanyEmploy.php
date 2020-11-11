<?php

namespace App\Model;

use App\Model\Prefix;
use App\Model\EmployPosition;
use App\Model\EmployTraining;
use App\Model\EmployEducation;
use App\Model\EmployExperience;
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
}
