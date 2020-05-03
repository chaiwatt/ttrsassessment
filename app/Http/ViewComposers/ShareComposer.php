<?php 
namespace App\Http\ViewComposers; 
use Auth; 
use App\Model\Menu;
use App\Model\GeneralInfo;
use Illuminate\View\View; 

class ShareComposer 
{ 
    public function compose (View $view) 
    { 
        $generalinfo = GeneralInfo::get()->first();
        $menus = Menu::where('parent_id', '=', 0)->get();
        $view->withGeneralinfo($generalinfo)
            ->withMenus($menus);
    }
}