<?php

namespace App\Model;

use App\Model\Company;
use App\Helper\LogAction;
use App\Model\BusinessPlan;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class IndustryGroup extends Model
{
   
    use LogsActivity;
    protected $fillable = [];
    protected $guarded = [];

    // protected static $logAttributes = ['name'];
    // protected static $logName = 'กลุ่มอุตสาหกรรม';
    // protected static $logOnlyDirty = true;
    
    public function getDescriptionForEvent(string $eventName): string
    {
        return LogAction::logAction('กลุ่มอุตสาหกรรม',$eventName);
    }

    public function companies()
    {
        return $this->hasMany(Company::class,'industry_group_id');
    }

    public function getProjectbelongAttribute(){
        $count = 0;
        $companies = Company::where('industry_group_id',$this->id)->get();
        if($companies->count() == 0){
            return 0;
        }else{

            foreach ($companies as $key => $company) {
                $count += BusinessPlan::where('company_id', $company->id)->count();
            }
            return $count;
        }
    } 
    
}
