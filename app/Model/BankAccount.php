<?php

namespace App\Model;

use App\Model\BankType;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    
    public function getBankTypeAttribute()
    {
        return BankType::find($this->bank_type_id);
    }

}
