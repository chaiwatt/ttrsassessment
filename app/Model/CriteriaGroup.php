<?php

namespace App\Model;

use App\Model\IndustryGroup;
use App\Model\CriteriaGroupTransaction;
use Illuminate\Database\Eloquent\Model;

class CriteriaGroup extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    
    public function getIndustryGroupAttribute(){
        return IndustryGroup::find($this->industry_group_id);
    }

    public function getSumweightAttribute(){
        return CriteriaGroupTransaction::where('criteria_group_id',$this->id)->sum('weight');
    }
}
