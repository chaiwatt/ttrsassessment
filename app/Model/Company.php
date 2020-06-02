<?php

namespace App\Model;

use App\User;
use App\Helper\LogAction;
use App\Model\BusinessPlan;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model
{
    use LogsActivity;
    
    protected $fillable = [];
    protected $guarded = [];

    protected static $logAttributes = ['registered_capital_type_id','industry_group_id','business_type_id','name','phone','fax','email','address','province_id','amphur_id','tambol_id','postalcode'];
    protected static $logName = 'ประเภทการจดทะเบียน';
    protected static $logOnlyDirty = true;
    
    public function getDescriptionForEvent(string $eventName): string
    {
        return LogAction::logAction('ประเภทการจดทะเบียน',$eventName);
    }
    
    public function getUserAttribute()
    {
        return User::find($this->user_id);
    }

    public function getBusinessPlanAttribute()
    {
        return BusinessPlan::where('company_id',$this->id)->where('business_plan_active_status_id',1)->first();
    }
}
