<?php

namespace App\Model;

use App\Model\Prefix;
use App\Model\FullTbp;
use App\Model\ThaiBank;
use App\Model\BusinessPlan;
use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class MiniTBP extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['businessplan','prefix','bank'];

    public function getBusinessPlanAttribute(){
        return BusinessPlan::find($this->business_plan_id);
    } 
    public function getPrefixAttribute(){
        return Prefix::find($this->contactprefix);
    } 
    public function getManagerprefixAttribute(){
        return Prefix::find($this->managerprefix_id);
    } 
    public function getBankAttribute(){
        return ThaiBank::find($this->thai_bank_id);
    } 

    public function getUpdatedAtThAttribute(){
        return DateConversion::engToThaiDate($this->updated_at->toDateString());
    } 

    public function getContactpersonprefixAttribute(){
        return Prefix::find($this->contactprefix);
    }

    public function getFulltbpAttribute(){
        return FullTbp::where('mini_tbp_id',$this->id)->first();
    }
}
