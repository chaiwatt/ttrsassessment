<?php 
namespace App\Http\ViewComposers; 
use Auth; 
use App\Model\Tag;
use App\Model\Menu;
use App\Model\Page;
use App\Model\Slide;
use App\Model\FrontPage;
use App\Model\MessageBox;
use App\Model\GeneralInfo;
use Illuminate\View\View; 
use App\Model\PageCategory;
use App\Model\WebsiteLayout;


class ShareComposer 
{ 
    public function compose (View $view) 
    { 
        $auth = Auth::user();
        $shareunreadmessages = MessageBox::where('receiver_id',@$auth->id)->where('message_read_status_id',1)->get();
        $generalinfo = GeneralInfo::get()->first();
        $menus = Menu::where('parent_id', 0)->get();
        $websitelayouts = WebsiteLayout::where('status', 1)->get();
        $slides = Slide::where('slide_status_id', 1)->get();
        $tags = Tag::get();
        $sharepagecategories = PageCategory::where('parent_id',0)->get();
        $shareunreadmessages = MessageBox::where('receiver_id',@$auth->id)->where('message_read_status_id',1)->take(5)->get();
        $sharepages = Page::paginate(6);
        $sharefrontpage = FrontPage::first();
        $view->withGeneralinfo($generalinfo)
            ->withMenus($menus)
            ->withShareunreadmessages($shareunreadmessages)
            ->withWebsitelayouts($websitelayouts)
            ->withSlides($slides)
            ->withTags($tags)
            ->withSharepagecategories($sharepagecategories)
            ->withSharepages($sharepages)
            ->withShareunreadmessages($shareunreadmessages)
            ->withSharefrontpage($sharefrontpage);
    }
}