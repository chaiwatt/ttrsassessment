<?php

namespace App\Model;

use App\Model\ExtraFactor;
use Illuminate\Database\Eloquent\Model;

class SubExtraFactor extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['extrafactor'];

    public function getExtraFactorAttribute(){
        return ExtraFactor::find($this->extra_factor_id);
    } 
}
