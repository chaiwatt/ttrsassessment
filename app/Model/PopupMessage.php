<?php

namespace App\Model;

use App\Model\PopupCategory;
use Illuminate\Database\Eloquent\Model;

class PopupMessage extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getCategoryAttribute()
    {
        return PopupCategory::find($this->category_id);
    }
}
