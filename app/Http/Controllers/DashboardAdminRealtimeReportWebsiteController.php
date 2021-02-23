<?php

namespace App\Http\Controllers;

use App\Model\Page;
use App\Model\DirectMenu;
use Illuminate\Http\Request;

class DashboardAdminRealtimeReportWebsiteController extends Controller
{
    public function Visit(){
        $directmenus = DirectMenu::get();
        $pages = Page::get();
        return view('dashboard.admin.realtimereport.website.index')->withPages($pages)
                                                            ->withDirectmenus($directmenus);
    }
}
