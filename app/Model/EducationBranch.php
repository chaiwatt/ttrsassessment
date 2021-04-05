<?php

namespace App\Model;

use App\Helper\LogAction;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class EducationBranch extends Model
{
    use LogsActivity;
    
    protected $fillable = [];
    protected $guarded = [];
    
    // protected static $logAttributes = ['name'];
    // protected static $logName = 'สาขาวิชา';
    // protected static $logOnlyDirty = true;
    
    public function getDescriptionForEvent(string $eventName): string
    {
        return LogAction::logAction('สาขาวิชา',$eventName);
    }
}
