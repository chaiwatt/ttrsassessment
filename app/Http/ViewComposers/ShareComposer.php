<?php 
namespace App\Http\ViewComposers; 
use Auth; 
use App\Model\Faq;
use App\Model\Tag;
use App\Model\Menu;
use App\Model\Page;
use App\Model\Slide;
use App\Model\FrontPage;
use App\Model\DirectMenu;
use App\Model\HeaderText;
use App\Model\MessageBox;
use App\Model\GeneralInfo;
use Illuminate\View\View; 
use App\Model\PageCategory;
use App\Model\WebsiteLayout;
use App\Model\HomepagePillar;
use App\Helper\GoogleCalendar;
use App\Model\HomepageService;
use App\Model\NotificationBubble;


class ShareComposer 
{ 
    public function compose (View $view) 
    { 
        $auth = Auth::user();
        $shareunreadmessages = MessageBox::where('receiver_id',@$auth->id)->where('message_read_status_id',1)->get();
        $generalinfo = GeneralInfo::get()->first();
        // $directmenus = Menu::where('parent_id', 0)->get();
        // $sharepages = Page::take(5)->get();
        $directmenus = DirectMenu::get();
        $websitelayouts = WebsiteLayout::where('status', 1)->get();
        // $slides = Slide::where('slide_status_id', 1)->get();
        $slides = Slide::get();
        $tags = Tag::get();
        $sharepagecategories = PageCategory::where('parent_id',0)->get();
        $shareunreadmessages = MessageBox::where('receiver_id',@$auth->id)->where('message_read_status_id',1)->take(5)->get();
        // $time = MessageBox::where('receiver_id',@$auth->id)->where('message_read_status_id',1)->take(5)->get();
        $homepageservices = HomepageService::get();
        $homepagepillar = HomepagePillar::first();
        $sharepages = Page::paginate(3);
        $sharefrontpage = FrontPage::first();
        $sharenotificationbubbles = NotificationBubble::where('target_user_id',@$auth->id)->where('status',0)->get();
        $sharefaqs = Faq::get();
        $shareheadertext = HeaderText::first();
        $view->withGeneralinfo($generalinfo)
            ->withDirectmenus($directmenus)
            ->withShareunreadmessages($shareunreadmessages)
            ->withWebsitelayouts($websitelayouts)
            ->withSlides($slides)
            ->withTags($tags)
            ->withSharepagecategories($sharepagecategories)
            ->withSharepages($sharepages)
            ->withShareunreadmessages($shareunreadmessages)
            ->withSharenotificationbubbles($sharenotificationbubbles)
            ->withSharefrontpage($sharefrontpage)
            ->withHomepageservices($homepageservices)
            ->withHomepagepillar($homepagepillar)
            ->withSharefaqs($sharefaqs)
            ->withShareheadertext($shareheadertext);
    }
}