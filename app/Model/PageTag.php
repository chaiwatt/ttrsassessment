<?php

namespace App\Model;

use App\Model\Tag;
use Illuminate\Database\Eloquent\Model;

class PageTag extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getTagAttribute()
    {
        return Tag::find($this->tag_id);
    }
}
