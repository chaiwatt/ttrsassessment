<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class DownloadStat extends Model
{
    public function getUserAttribute()
    {
        return User::find($this->user_id);
    }
}
