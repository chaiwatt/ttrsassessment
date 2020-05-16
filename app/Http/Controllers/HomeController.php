<?php

namespace App\Http\Controllers;

use App\Model\Page;
use App\Model\PageTag;
use App\Model\PageView;
use App\Model\PageImage;
use App\Model\IntroSection;
use App\Model\PageCategory;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    public function Index()
    {
        $pages = Page::get();
        $introsections = IntroSection::get();
        return view('landing.index')->withIntrosections($introsections);
    }

    public function Page($slug)
    {
        $ip = \Request::getClientIp(true);
        $agent = new Agent();
        $page = Page::where('slug',$slug)->first();
        if(Empty($page)){
            return abort(404);
        }
        $user = "";
        if(Auth::check()){
            $user = Auth::user()->id;
        }
        $pageview = new PageView();
        $pageview->page_id = $page->id;
        $pageview->user_id = $user ;
        $pageview->device = $agent->device();
        $pageview->platform = $agent->platform();
        $pageview->browser = $agent->browser();
        $pageview->ipaddress = $ip;
        $pageview->save();
        
        $pagetags = PageTag::where('page_id',$page->id)->get();
        $pageimages = PageImage::where('page_id',$page->id)->get();
        return view('landing.page')->withPage($page)
                                ->withPagetags($pagetags)
                                ->withPageimages($pageimages);
    }
}
