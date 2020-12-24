<?php

namespace App\Model;

use App\User;
use App\Model\Amphur;
use App\Model\Tambol;
use App\Model\Province;
use App\Helper\LogAction;
use App\Model\BusinessPlan;
use App\Model\ExpertDetail;
use App\Model\CompanyEmploy;
use App\Model\IndustryGroup;
use App\Model\CompanyAddress;
use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model
{
    use LogsActivity;
    
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['companyaddress'];

    protected static $logAttributes = ['industry_group_id','business_type_id','name','phone','fax','email','address','province_id','amphur_id','tambol_id','postalcode'];
    protected static $logName = 'ประเภทการจดทะเบียน';
    protected static $logOnlyDirty = true;
    
    public function getDescriptionForEvent(string $eventName): string
    {
        return LogAction::logAction('ประเภทการจดทะเบียน',$eventName);
    }
    
    public function getUserAttribute()
    {
        return User::find($this->user_id);
    }

    public function getBusinessPlanAttribute()
    {
        return BusinessPlan::where('company_id',$this->id)->first();
    }

    public function getTambolAttribute()
    {
        return Tambol::find($this->tambol_id);
    }

    public function getAmphurAttribute()
    {
        return Amphur::find($this->amphur_id);
    }

    public function getProvinceAttribute()
    {
        return Province::find($this->province_id);
    }
    public function getPaidupcapitaldateThAttribute()
    {
        if(Empty($this->paidupcapitaldate)) return ;
        return DateConversion::engToThaiDate($this->paidupcapitaldate);
    }
    public function getCompanyaddressAttribute()
    {
        return CompanyAddress::where('company_id',$this->id)->get();
    }
    public function getIndustrygroupAttribute()
    {
        return IndustryGroup::find($this->industry_group_id);
    }

}
