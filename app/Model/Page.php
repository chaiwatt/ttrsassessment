<?php

namespace App\Model;

use App\User;
use App\Model\PageTag;
use App\Model\PageView;
use App\Model\BlogComment;
use App\Model\FeatureImage;
use App\Model\PageCategory;
use App\Helper\DateConversion;
use App\Model\FeatureImageThumbnail;
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
    public function getYearAttribute()
    {
        return DateConversion::thaiDate($this->created_at,'y');
    }
    public function getPageViewAttribute()
    {
        return PageView::where('page_id',$this->id);
    }

    public function getViewdateAttribute(){
        $pageview = PageView::where('page_id',$this->id)->latest()->first();
        return DateConversion::thaiDateTime($pageview->created_at);
    } 

    public function getPageViewUniqueAttribute()
    {
        return PageView::where('page_id',$this->id)->select('ipaddress')->distinct()->get();
    }
    public function getPageTagAttribute()
    {
        return PageTag::where('page_id',$this->id)->get();
    }
    public function getFeatureImageAttribute()
    {
        return FeatureImage::find($this->feature_image_id);
    }
    public function getFeatureImageThumbnailAttribute()
    {
        return FeatureImageThumbnail::find($this->feature_image_thumbnail_id);
    }
    public function getBlogcommentAttribute()
    {
        return BlogComment::where('page_id',$this->id)->get();
    }

    public function getSidebarimageAttribute()
    {
        return FeatureImageThumbnail::find($this->blogsidebarimage_id);
    }

    public function getHomepageblogimageAttribute()
    {
        return FeatureImageThumbnail::find($this->bloghomepageimage_id);
    }
 
}


