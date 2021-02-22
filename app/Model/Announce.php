<?php

namespace App\Model;

use App\User;
use App\Model\PageStatus;
use App\Helper\DateConversion;
use App\Model\AnnounceCategory;
use Illuminate\Database\Eloquent\Model;

class Announce extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getPagestatusAttribute()
    {
        return PageStatus::find($this->page_status_id);
    }
    public function getAnnouncecategoryAttribute()
    {
        return AnnounceCategory::find($this->announce_category_id);
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
    public function getYearAttribute()
    {
        return DateConversion::thaiDate($this->created_at,'y');
    }
}
