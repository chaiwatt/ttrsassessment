<?php

namespace App\Model;

use App\Model\CompanyEmploy;
use Illuminate\Database\Eloquent\Model;

class FullTbpSignature extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getCompanyemployAttribute(){
        return CompanyEmploy::find($this->company_employee_id);
    } 

}
