<?php

namespace App\Model;

use App\Model\CompanyEmploy;
use Illuminate\Database\Eloquent\Model;

class CompanyStockHolder extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['companyemploy'];
    public function getCompanyEmployAttribute()
    {
        return CompanyEmploy::find($this->company_employ_id);
    }
}
