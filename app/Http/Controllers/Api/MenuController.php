<?php

namespace App\Http\Controllers\Api;

use App\Model\Menu;
use App\Model\DirectMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function GetMenu(Request $request){
        $menu = Menu::find($request->id);
        return response()->json($menu);  
    }
    public function GetDirectMenu(Request $request){
        $menu = DirectMenu::find($request->id);
        return response()->json($menu);  
    }
}
