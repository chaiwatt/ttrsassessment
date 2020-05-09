<?php 
namespace App\Http\ViewComposers; 
use Auth; 
use App\Model\Menu;
use App\Model\GeneralInfo;
use Illuminate\View\View; 
use App\Model\MessageReceive;

class ShareComposer 
{ 
    public function compose (View $view) 
    { 
        $auth = Auth::user();
        $shareunreadmessages = MessageReceive::where('receiver_id',@$auth->id)->where('message_read_status_id',1)->get();
        $generalinfo = GeneralInfo::get()->first();
        $menus = Menu::where('parent_id', '=', 0)->get();
        $view->withGeneralinfo($generalinfo)
            ->withMenus($menus)
            ->withShareunreadmessages($shareunreadmessages);
    }
}