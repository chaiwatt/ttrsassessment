<?php

namespace App\Model;

use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class ServicePage extends Model
{
    public function getDayAttribute()
    {
        return DateConversion::thaiDate($this->created_at,'d');
    }
    public function getMonthAttribute()
    {
        return DateConversion::thaiDate($this->created_at,'m');
    }
    public function getYearAttribute()
    {
        return DateConversion::thaiDate($this->created_at,'y');
    }
}
