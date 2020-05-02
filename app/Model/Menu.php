<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Menu extends Model
{
    use LogsActivity;
    
    protected $fillable = [];
    protected $guarded = [];

    protected static $logAttributes = ['name','slug','engname','engslug','url','parent_id','hide'];
    protected static $logName = 'เมนูเว็บไซต์';
    protected static $logOnlyDirty = true;
    public function getDescriptionForEvent(string $eventName): string
    {
        $name = 'เมนูเว็บไซต์';
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

