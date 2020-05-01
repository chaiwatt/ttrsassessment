<?php

namespace App;

use App\Model\Prefix;
use App\Model\UserType;
use App\Model\UserStatus;
use App\Model\UserPosition;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // protected $fillable = [
    //     'name', 'email','phone', 'password', 'prefix_id', 'user_type_id','linetoken','verify_type'
    // ];

    protected $fillable = [];
    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPrefixAttribute()
    {
        return Prefix::find($this->prefix_id);
    }
    public function getUserTypeAttribute()
    {
        return UserType::find($this->user_type_id);
    }
    public function getUserStatusAttribute()
    {
        return UserStatus::find($this->user_status_id);
    }
    public function getUserPositionAttribute()
    {
        return UserPosition::find($this->user_position_id);
    }
}
