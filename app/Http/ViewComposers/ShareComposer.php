<?php 
namespace App\Http\ViewComposers; 
use Auth; 
use App\Model\GeneralInfo;
use Illuminate\View\View; 

class ShareComposer 
{ 
    public function compose (View $view) 
    { 
        $generalinfo = GeneralInfo::get()->first();
        $view->with('generalinfo', $generalinfo);
    }
}