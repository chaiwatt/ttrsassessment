<?php

namespace App\Http\Controllers\Api;

use App\Model\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function GetMenu(Request $request){
        $menu = Menu::find($request->id);
        return response()->json($menu);  
    }
}
