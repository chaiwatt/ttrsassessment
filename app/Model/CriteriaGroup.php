<?php

namespace App\Model;

use App\Model\IndustryGroup;
use Illuminate\Database\Eloquent\Model;

class CriteriaGroup extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    
    public function getIndustryGroupAttribute(){
        return IndustryGroup::find($this->industry_group_id);
    }
}
