<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    
    protected $appends = ['user'];

    public function getUserAttribute()
    {
        return User::find($this->friend_id);
    }
}
