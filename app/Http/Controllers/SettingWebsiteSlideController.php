<?php

namespace App\Http\Controllers;

use App\Model\Slide;
use App\Model\HomePage;
use App\Model\SlideStyle;
use App\Model\SlideStatus;
use Illuminate\Http\Request;

class SettingWebsiteSlideController extends Controller
{
    public function Index(){
        $slides = Slide::get();
        return view('setting.website.slide.index')->withSlides($slides);
    }
    public function Create(){
        $slidestatuses = SlideStatus::get();
        $slidestyles = SlideStyle::get();
        return view('setting.website.slide.create')->withSlidestatuses($slidestatuses)
                                            ->withSlidestyles($slidestyles);
    }
}
