<?php

namespace App\Model;

use App\User;
use App\Model\UserGroup;
use App\Model\ExpertBranch;
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

    // public function getExpertbranchAttribute()
    // {
    //     return ExpertBranch::find($this->expert_branch_id);
    // }

}
