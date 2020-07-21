<?php

namespace App;

use App\Model\Prefix;
use App\Model\Company;
use App\Model\UserType;
use App\Helper\LogAction;
use App\Model\UserStatus;
use App\Model\UserPosition;
use App\Model\ExpertAssignment;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,LogsActivity;

    // protected $fillable = [
    //     'name', 'email','phone', 'password', 'prefix_id', 'user_type_id','linetoken','verify_type'
    // ];

    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['usertype'];

    protected static $ignoreChangedAttributes = ['password'];
    protected static $logAttributesToIgnore = [ 'password'];
    protected static $logAttributes = ['prefix_id', 'name', 'lastname', 'user_type_id', 'user_status_id', 'email', 'password'];
    protected static $logName = 'ผู้ใช้งาน';
    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return LogAction::logAction('ผู้ใช้งาน',$eventName);
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
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
    public function getCompanyVatidAttribute()
    {
        $vatid = '';
        $company = Company::where('user_id',$this->id)->first();
        if(!Empty($company)){
            $vatid = $company->vatno;
        }
        return $vatid;
    }
    public function getCompanyAttribute()
    {
        return Company::where('user_id',$this->id)->first();
    }
    public function getExpertassignmentAttribute()
    {
        return ExpertAssignment::where('user_id',$this->id)->where('expert_assignment_status_id',2)->get();
    }
    
}
