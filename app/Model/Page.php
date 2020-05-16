<?php

namespace App\Model;

use App\User;
use App\Model\PageTag;
use App\Model\PageView;
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
    public function getPageViewAttribute()
    {
        return PageView::where('page_id',$this->id);
    }
    public function getPageViewUniqueAttribute()
    {
        return PageView::where('page_id',$this->id)->select('ipaddress')->distinct()->get();
    }
    public function getPageTagAttribute()
    {
        return PageTag::where('page_id',$this->id)->get();
    }
}


