<?php

namespace App\Model;

use App\Helper\LogAction;
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
        return LogAction::logAction('เมนูเว็บไซต์',$eventName);
    }
    
    public function childs() {
        return $this->hasMany('App\Model\Menu','parent_id','id') ;
    }

}

