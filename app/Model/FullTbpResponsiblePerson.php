<?php

namespace App\Model;

use App\Model\Prefix;
use Illuminate\Database\Eloquent\Model;

class FullTbpResponsiblePerson extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getPrefixAttribute()
    {
        return Prefix::find($this->prefix_id);
    }
}
