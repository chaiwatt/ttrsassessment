<?php

namespace App\Http\Controllers;

use App\Model\Tag;
use App\Model\Page;
use App\Model\PageTag;
use App\Model\PageView;
use App\Model\PageImage;
use App\Model\GeneralInfo;
use App\Model\FeatureImage;
use App\Model\IntroSection;
use App\Model\PageCategory;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    public function Index()
    {
        $generalinfo = GeneralInfo::first();
        if(Session::get('front') == 'active'){
            return $this->Front();
        }else if($generalinfo->front_page_status_id == 2){
            Session::put('front', 'active');
            return view('front');
        }else{
            return $this->Front();
        }
    }

    public function Page($slug)
    {
    //     $ip = \Request::getClientIp(true);
    //     $agent = new Agent();
    //     $page = Page::where('slug',$slug)->first();
    //     if(Empty($page)){
    //         return abort(404);
    //     }
    //     $user = "";
    //     if(Auth::check()){
    //         $user = Auth::user()->id;
    //     }
    //     $pageview = new PageView();
    //     $pageview->page_id = $page->id;
    //     $pageview->user_id = $user ;
    //     $pageview->device = $agent->device();
    //     $pageview->platform = $agent->platform();
    //     $pageview->browser = $agent->browser();
    //     $pageview->ipaddress = $ip;
    //     $pageview->save();
        
    //     $pagetags = PageTag::where('page_id',$page->id)->get();
    //     $pageimages = PageImage::where('page_id',$page->id)->get();
    //     return view('landing.page')->withPage($page)
    //                             ->withPagetags($pagetags)
    //                             ->withPageimages($pageimages);
    // }
    // public function Tag($slug)
    // {
    //     $tag = Tag::where('slug',$slug)->first();
    //     $pagearray = PageTag::where('tag_id',$tag->id)->pluck('page_id')->toArray();
    //     $pages = Page::whereIn('id',$pagearray)->paginate(10);
    //     return view('landing.search')->withPages($pages);
    // }
    // public function Search(Request $request)
    // {
    //     $pages = Page::where('name','LIKE','%' . $request->search . '%')->paginate(10);
    //     return view('landing.search')->withPages($pages);
    return view('landing.single');
    }
    public function Front()
    {
        $introsections = IntroSection::get();
        return view('landing.index')->withIntrosections($introsections);
    }
    public function Blog()
    {
        return view('landing.blog');
    }
}
