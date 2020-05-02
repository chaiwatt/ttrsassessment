<?php

namespace App;

use App\Model\Prefix;
use App\Model\UserType;
use App\Model\UserStatus;
use App\Model\UserPosition;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,LogsActivity;

    // protected $fillable = [
    //     'name', 'email','phone', 'password', 'prefix_id', 'user_type_id','linetoken','verify_type'
    // ];

    protected $fillable = [];
    protected $guarded = [];
    
    protected static $ignoreChangedAttributes = ['password'];
    protected static $logAttributesToIgnore = [ 'password'];
    protected static $logAttributes = ['prefix_id', 'name', 'lastname', 'user_type_id', 'user_status_id', 'email', 'password'];
    protected static $logName = 'ผู้ใช้งาน';
    protected static $logOnlyDirty = true;
    public function getDescriptionForEvent(string $eventName): string
    {
        $name = 'ผู้ใช้งาน';
        $action_name = '';
        if($eventName == 'created'){
            $action_name = 'เพิ่ม';
        }elseif ($eventName == 'updated'){
            $action_name = 'แก้ไข';
        }elseif ($eventName == 'deleted'){
            $action_name = 'ลบ';
        }
        return "โมเดลมีการ {$action_name} {$name}";
    }

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
