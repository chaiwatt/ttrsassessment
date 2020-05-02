<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class UserType extends Model
{
    use LogsActivity;
    
    protected $fillable = [];
    protected $guarded = [];

    protected static $logAttributes = ['name'];
    protected static $logName = 'ประเภทผู้ใช้งาน';
    protected static $logOnlyDirty = true;
    public function getDescriptionForEvent(string $eventName): string
    {
        $name = 'ประเภทผู้ใช้งาน';
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
