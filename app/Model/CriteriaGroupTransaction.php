<?php

namespace App\Model;

use App\Model\CriteriaGroup;
use Illuminate\Database\Eloquent\Model;

class CriteriaGroupTransaction extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    
    public function getCriteriaGroupAttribute(){
        return CriteriaGroup::find($this->criteria_group_id);
    }
}
