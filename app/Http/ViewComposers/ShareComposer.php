<?php 
namespace App\Http\ViewComposers; 
use Auth; 
use App\Model\Faq;
use App\Model\Tag;
use App\Model\Menu;
use App\Model\Page;
use App\Model\Slide;
use App\Model\MiniTBP;
use App\Model\FrontPage;
use App\Model\DirectMenu;
use App\Model\HeaderText;
use App\Model\MessageBox;
use App\Model\DirectMenu2;
use App\Model\GeneralInfo;
use Illuminate\View\View; 
use App\Model\PageCategory;
use Jenssegers\Agent\Agent;
use App\Model\IndustryGroup;
use App\Model\WebsiteLayout;
use App\Model\HomepagePillar;
use App\Helper\GoogleCalendar;
use App\Model\HomepageService;
use App\Model\NotificationBubble;
use App\Model\HomepagePillarSection;
use App\Model\HomepageIndustryGroupText;

class ShareComposer 
{ 
    public function compose (View $view) 
    { 
        $auth = Auth::user();
        $shareunreadmessages = MessageBox::where('receiver_id',@$auth->id)->where('message_read_status_id',1)->get();
        $generalinfo = GeneralInfo::get()->first();
        $directmenus = DirectMenu::get();
        $websitelayouts = WebsiteLayout::where('status', 1)->get();
        $slides = Slide::get();
        $tags = Tag::get();
        $sharepagecategories = PageCategory::where('parent_id',0)->get();
        $shareunreadmessages = MessageBox::where('receiver_id',@$auth->id)->where('message_read_status_id',1)->get();
        $homepageservices = HomepageService::get();
        $homepagepillar = HomepagePillarSection::first();
        $sharepages = Page::orderBy('id','desc')->paginate(3);
        $sharefrontpage = FrontPage::first();
        $sharenotificationbubbles = NotificationBubble::where('target_user_id',@$auth->id)->where('status',0)->get();
        $sharefaqs = Faq::where('status',1)->get();
        $shareheadertext = HeaderText::first();
        $shareindustrygroups = IndustryGroup::orderBy('companybelong','desc')->get();
        $sharehomepageindustrygrouptext = HomepageIndustryGroupText::first();
        $directmenus2 = DirectMenu2::get();
        $shareagent  = new Agent();
        
        $industrygroups = IndustryGroup::get();
        $industrygrouparray = array();
        $totalminitbp = MiniTBP::whereNotNull('submitdate')->count();
        foreach ($industrygroups as $key => $industrygroup) {
            $minitbps = MiniTBP::whereNotNull('submitdate')->where('industry_group_id',$industrygroup->id)->get();
                if ($minitbps->count() > 0) {
                    $industrygrouparray[] = array('name' => $industrygroup->name,'thname' => $industrygroup->nameth,'engname' => $industrygroup->nameeng, 'occured' => $minitbps->count(), 'total' => $totalminitbp);
                }
        }
        $shareindustrygroupcollections = collect($industrygrouparray);
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
            ->withShareheadertext($shareheadertext)
            ->withShareindustrygroups($shareindustrygroups)
            ->withSharehomepageindustrygrouptext($sharehomepageindustrygrouptext)
            ->withDirectmenus2($directmenus2)
            ->withShareindustrygroupcollections($shareindustrygroupcollections)
            ->withShareagent($shareagent);
    }
}