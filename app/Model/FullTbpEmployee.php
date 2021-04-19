<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class FullTbpEmployee extends Model
{
    use LogsActivity;
    protected $fillable = [];
    protected $guarded = [];
    protected static $logAttributes = ['department_qty', 'department1_qty', 'department2_qty', 'department3_qty', 'department4_qty', 'department5_qty'];
    protected static $logName = 'Full TBP Employ';
}
