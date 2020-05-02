<?php

namespace App\Model;

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
        $name = 'ข้อมูลหน่วยงาน';
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
}

