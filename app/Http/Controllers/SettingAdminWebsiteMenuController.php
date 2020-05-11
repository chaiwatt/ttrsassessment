<?php

namespace App\Http\Controllers;

use App\Model\Menu;
use Illuminate\Http\Request;

class SettingAdminWebsiteMenuController extends Controller
{
    public function Create(){
        $menus = Menu::where('parent_id', '=', 0)->get();
        $allMenus = Menu::pluck('name','id')->all();
        return view('setting.admin.website.menu.create')->withMenus($menus)->withAllMenus($allMenus);
    }
}
