<?php

namespace App\Model;

use App\Model\Amphur;
use App\Model\Tambol;
use App\Model\Province;
use App\Helper\LogAction;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class GeneralInfo extends Model
{
    use LogsActivity;
    
    protected $fillable = [];
    protected $guarded = [];

    // protected static $logAttributes = ['company','logo','phone','fax','email','address','lat','lng','facebookpage',
    // 'youtube','twitter','client_id','client_secret','thsmsuser','thsmspass','verify_type_id'];
    // protected static $logName = 'ข้อมูลหน่วยงาน';
    // protected static $logOnlyDirty = true;
    
    public function getDescriptionForEvent(string $eventName): string
    {
        return LogAction::logAction('ข้อมูลหน่วยงาน',$eventName);
    }

    
    public function getProvinceAttribute(){
        return Province::find($this->province_id);
    } 

    public function getAmphurAttribute(){
        return Amphur::find($this->amphur_id);
    } 

    public function getTambolAttribute(){
        return Tambol::find($this->tambol_id);
    } 
}

