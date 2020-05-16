<?php

namespace App\Model;

use App\Helper\LogAction;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PageCategory extends Model
{
    use LogsActivity;
    
    protected $fillable = [];
    protected $guarded = [];

    protected static $logAttributes = ['name','slug'];
    protected static $logName = 'หมวดหมู่เพจ';
    protected static $logOnlyDirty = true;
    
    public function getDescriptionForEvent(string $eventName): string
    {
        return LogAction::logAction('หมวดหมู่เพจ',$eventName);
    }

    public function childs() {
        return $this->hasMany('App\Model\PageCategory','parent_id','id') ;
    }
}
