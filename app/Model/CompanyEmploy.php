<?php

namespace App\Model;

use App\Model\Prefix;
use App\Model\EmployPosition;
use Illuminate\Database\Eloquent\Model;

class CompanyEmploy extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['employposition','prefix'];
    public function getEmploypositionAttribute()
    {
        return EmployPosition::find($this->employ_position_id);
    }
    public function getPrefixAttribute()
    {
        return Prefix::find($this->prefix_id);
    }

}
