<?php

namespace App\Model;

use App\User;
use App\Model\PageCategory;
use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getPageCategoryAttribute()
    {
        return PageCategory::find($this->page_category_id);
    }
    public function getUserAttribute()
    {
        return User::find($this->user_id);
    }

    public function getDayAttribute()
    {
        return DateConversion::thaiDate($this->created_at,'d');
    }
    public function getMonthAttribute()
    {
        return DateConversion::thaiDate($this->created_at,'m');
    }
}


