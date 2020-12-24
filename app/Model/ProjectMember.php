<?php

namespace App\Model;

use App\User;
use App\Model\FullTbp;
use App\Model\ProjectGrade;
use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['user'];

    public function getUserAttribute()
    {
        return User::find($this->user_id);
    }
    public function getFulltbpAttribute()
    {
        return FullTbp::find($this->full_tbp_id);
    }
    public function getProjectgradeAttribute()
    {
        return ProjectGrade::where($this->full_tbp_id)->get();
    }

    
}
