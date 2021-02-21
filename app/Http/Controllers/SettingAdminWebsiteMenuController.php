<?php

namespace App\Http\Controllers;

use App\Model\Menu;
use App\Model\Page;
use App\Model\DirectMenu;
use App\Helper\CreateSlug;
use Illuminate\Http\Request;
use App\Http\Requests\CreateMenuRequest;

class SettingAdminWebsiteMenuController extends Controller
{
    public function Create(){
        $menus = Menu::where('parent_id',0)->get();
        // $allmenus = Menu::pluck('name','id')->all();
        $allmenus = DirectMenu::pluck('name','id')->all();
        $pages = Page::get();
        return view('setting.admin.website.directmenu.create')->withMenus($menus)
                                                    ->withAllmenus($allmenus)
                                                    ->withPages($pages);
    }
    public function Crud(CreateMenuRequest $request){
        if($request->action == 'create'){
            $parentid = 0;
            if(!Empty($request->parentmenu)){
                $parentid = $request->parentmenu;
            }
            $menu = new Menu();
            $menu->parent_id = $parentid;
            $menu->name = $request->menuthai;
            $menu->slug = CreateSlug::createSlug($request->menuthai);
            $menu->engname = $request->menuenglish;
            $menu->engslug = CreateSlug::createSlug($request->menuenglish);
            $menu->page_id = $request->page;
            $menu->save();
            return redirect()->back()->withSuccess('เพิ่มเมนูสำเร็จ');
        }else if($request->action == 'edit'){
            // return 'here';
            if(!Empty($request->menuid)){
                Menu::find($request->menuid)->update([
                    'parent_id' => $request->parentmenu,
                    'name' => $request->menuthai,
                    'slug' => CreateSlug::createSlug($request->menuthai),
                    'engname' => $request->menuenglish,
                    'engslug' => CreateSlug::createSlug($request->menuenglish),
                    'page_id' => $request->page
                ]);
                return redirect()->back()->withSuccess('แก้ไขเมนูสำเร็จ');
            }else{
                return redirect()->back()->withError('ยังไม่ได้เลือกเมนู');
            }
        }else if($request->action == 'delete'){
            if(!Empty($request->menuid)){
                if(Menu::where('parent_id',$request->menuid)->get()->count() > 0){
                    return redirect()->back()->withError('ไม่สามารถลบเมนูที่มีเมนูย่อย');
                }
                Menu::find($request->menuid)->delete();
                return redirect()->back()->withSuccess('ลบเมนูสำเร็จ');
            }else{
                return redirect()->back()->withError('ยังไม่ได้เลือกเมนู');
            }
        }   
    }
}
