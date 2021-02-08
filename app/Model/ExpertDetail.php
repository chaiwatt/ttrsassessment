<?php

namespace App\Model;

use App\User;
use App\Model\UserGroup;
use App\Model\ExpertField;
use App\Model\ExpertBranch;
use App\Model\ProjectMember;
use App\Model\EducationLevel;
use Illuminate\Database\Eloquent\Model;

class ExpertDetail extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['user'];
    
    public function getUserAttribute()
    {
        return User::find($this->user_id);
    }

    public function getExpertbranchAttribute()
    {
        return ExpertBranch::find($this->expert_branch_id);
    }

    public function getEducationLevelAttribute()
    {
        return EducationLevel::find($this->education_level_id);
    }
    public function getExpertfieldAttribute()
    {
        return ExpertField::where('user_id',$this->user_id)->get();
    }
    public function ProjectMember($id)
    {
        return ProjectMember::where('user_id',$id)->get();
    }

}
