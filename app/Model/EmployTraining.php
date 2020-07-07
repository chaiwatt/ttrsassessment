<?php

namespace App\Model;

use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class EmployTraining extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    protected $appends = ['trainingdateth'];

    public function getTrainingdateThAttribute()
    {
        return DateConversion::engToThaiDate($this->trainingdate);
    }
}
