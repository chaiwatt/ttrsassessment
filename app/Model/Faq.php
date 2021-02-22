<?php

namespace App\Model;

use App\Model\PageStatus;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getShowstatusAttribute()
    {
        return PageStatus::find($this->status);
    }
}
