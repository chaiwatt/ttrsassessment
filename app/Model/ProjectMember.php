<?php

namespace App\Model;

use App\User;
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
}
