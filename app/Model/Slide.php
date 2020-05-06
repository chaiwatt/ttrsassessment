<?php

namespace App\Model;

use App\Model\SlideStyle;
use App\Model\SlideStatus;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = [];
    protected $guarded = [];
     
    public function getSlideStatusAttribute()
    {
        return SlideStatus::find($this->slide_style_id);
    }

    public function getSlideStyleAttribute()
    {
        return SlideStyle::find($this->slide_style_id);
    }
}
