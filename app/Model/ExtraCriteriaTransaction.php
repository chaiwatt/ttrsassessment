<?php

namespace App\Model;

use App\User;
use App\Model\ExtraCategory;

use App\Model\ExtraCriteria;
use Illuminate\Database\Eloquent\Model;

class ExtraCriteriaTransaction extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getExtraCategoryAttribute(){
        return ExtraCategory::find($this->extra_category_id);
    }

    public function getExtraCriteriaAttribute(){
        return ExtraCriteria::find($this->extra_criteria_id);
    }

}

