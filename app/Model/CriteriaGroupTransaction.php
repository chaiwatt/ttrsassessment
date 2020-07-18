<?php

namespace App\Model;

use App\Model\Criteria;
use App\Model\CriteriaGroup;
use App\Model\CriteriaGroupTransaction;
use Illuminate\Database\Eloquent\Model;

class CriteriaGroupTransaction extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    
    public function getCriteriaGroupAttribute(){
        return CriteriaGroup::find($this->criteria_group_id);
    }
    public function getCriteriaAttribute(){
        return Criteria::find($this->criteria_id);
    }
   
}
