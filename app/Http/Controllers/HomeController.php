<?php

namespace App\Http\Controllers;

use App\Model\Page;
use App\Model\PageTag;
use App\Model\PageImage;
use App\Model\IntroSection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Index()
    {
        $introsections = IntroSection::get();
        return view('landing.index')->withIntrosections($introsections);
    }

    public function Page($slug)
    {
        $page = Page::where('slug',$slug)->first();
        $pagetags = PageTag::where('page_id',$page->id)->get();
        $pageimages = PageImage::where('page_id',$page->id)->get();
        return view('landing.page')->withPage($page)
                                ->withPagetags($pagetags)
                                ->withPageimages($pageimages);
    }
}
