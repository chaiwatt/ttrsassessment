<?php

namespace App;

use App\Model\Prefix;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\UserType;
use App\Model\UserGroup;
use App\Helper\LogAction;
use App\Model\UserStatus;
use App\Model\ExpertDetail;
// use App\Model\UserPosition;
use App\Model\OfficerDetail;
use App\Model\ProjectMember;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
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
    // protected $appends = ['usertype'];
    // protected $appends = ['usertype','fulltbpexpert','fulltbpofficer'];
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
    // public function getUserPositionAttribute()
    // {
    //     return UserPosition::find($this->user_position_id);
    // }
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

    public function getUsergroupAttribute()
    {
        return UserGroup::find($this->user_group_id);
    }
    
    public function getExpertdetailAttribute()
    {
        return ExpertDetail::where('user_id',$this->id)->first();
    }
    public function getOfficerdetailAttribute()
    {
        return OfficerDetail::where('user_id',$this->id)->first();
    }
    public function getProjecthandleAttribute()
    {
        $expertassignmentfulltbparray = ExpertAssignment::where('user_id',$this->id)->pluck('full_tbp_id')->toArray();
        $leaderfulltbparray= ProjectAssignment::where('leader_id',$this->id)->pluck('full_tbp_id')->toArray();
        $coleaderfulltbparray = ProjectAssignment::where('coleader_id',$this->id)->pluck('full_tbp_id')->toArray();
        $fulltbpiduniques = array_unique(array_merge($expertassignmentfulltbparray,$leaderfulltbparray,$coleaderfulltbparray));
        return FullTbp::whereIn('id',$fulltbpiduniques)->get();
    }
    // public function getFulltbpexpertAttribute()
    // {
    //     $projectmemberarray = ProjectMember::where('user_id',$this->id)->pluck('full_tbp_id')->toArray();
    //     return FullTbp::whereIn('id',$projectmemberarray)->get();
    // }
    // public function getFulltbpofficerAttribute()
    // {
    //     $officerdetailids = OfficerDetail::where('user_id', $this->id)->pluck('user_id')->toArray();
    //     $projectmemberids = ProjectMember::whereIn('user_id',$officerdetailids)->pluck('full_tbp_id')->toArray();
    //     $projectmemberuniqueids = array_unique($projectmemberids);
    //     $projectassignmentids = ProjectAssignment::where('coleader_id',$this->id)->pluck('full_tbp_id')->toArray();
    //     $projectassignmentuniqueids = array_unique($projectassignmentids);
    //     $fulltbpids = array_unique(array_merge($projectmemberuniqueids,$projectassignmentuniqueids));
    //     return FullTbp::whereIn('id',$fulltbpids)->get();
    // }
}
