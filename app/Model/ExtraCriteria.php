<?php

namespace App\Model;

use App\Model\ExtraCategory;
use Illuminate\Database\Eloquent\Model;

class ExtraCriteria extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    public function getExtraCategoryAttribute(){
        return ExtraCategory::find($this->extra_category_id);
    }
}
