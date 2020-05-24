<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['request','requestcoming'];

    public function getRequestAttribute()
    {
        return User::find($this->to_id);
    }
    public function getRequestComingAttribute()
    {
        return User::find($this->from_id);
    }
}
