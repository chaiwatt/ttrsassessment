<?php

namespace App\Model;

use App\Model\EducationLevel;
use App\Model\EducationBranch;
use Illuminate\Database\Eloquent\Model;

class ExpertEducation extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    protected $appends = ['educationlevel','educationbranch'];

    public function getEducationLevelAttribute()
    {
        return EducationLevel::find($this->education_level_id);
    }
    public function getEducationBranchAttribute()
    {
        return EducationBranch::find($this->education_branch_id);
    }
}
