<?php

namespace App\Model;

use App\Model\Amphur;
use App\Model\Tambol;
use App\Model\Province;
use Illuminate\Database\Eloquent\Model;

class CompanyAddress extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['tambol','amphur','province'];

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
}
