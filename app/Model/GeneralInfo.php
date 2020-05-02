<?php

namespace App\Model;

use App\Helper\LogAction;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class GeneralInfo extends Model
{
    use LogsActivity;
    
    protected $fillable = [];
    protected $guarded = [];

    protected static $logAttributes = ['company','logo','phone','fax','email','address','lat','lng','facebookpage',
    'youtube','twitter','client_id','client_secret','thsmsuser','thsmspass','verify_status_id'];
    protected static $logName = 'ข้อมูลหน่วยงาน';
    protected static $logOnlyDirty = true;
    
    public function getDescriptionForEvent(string $eventName): string
    {
        return LogAction::logAction('ข้อมูลหน่วยงาน',$eventName);
    }
}

