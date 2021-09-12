<?php

namespace App\Http\Controllers;

use App\Model\MenuType;
use App\Model\PageStatus;
use App\Helper\CreateSlug;
use App\Model\DirectMenu2;
use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;

class MenuController extends Controller
{
    public function Index(){
        $directmenu2s = DirectMenu2::get();
        return view('setting.admin.website.menu.index')->withDirectmenu2s($directmenu2s);
    }

    public function Create(){
        $directmenu2s = DirectMenu2::where('menu_type_id',2)->get();
        $menutypes = MenuType::get();

        if($directmenu2s->count() == 0){
            $menutypes = MenuType::take(2)->get();
        }
        $showstatuses = PageStatus::get();
        return view('setting.admin.website.menu.create')->withShowstatuses($showstatuses)
                                                    ->withMenutypes($menutypes)
                                                    ->withDirectmenu2s($directmenu2s);
    }
    public function CreateSave(MenuRequest $request){
        $submenu = null;
        if($request->menutype > 2){
            $submenu = $request->parent;
        }
        $directmenus = new DirectMenu2();
        $directmenus->name = $request->menuthai;
        $directmenus->menu_type_id = $request->menutype;
        $directmenus->submenu = $submenu;
        $directmenus->slug =  CreateSlug::createSlug($request->menuthai) ;
        $directmenus->engname = $request->menuenglish;
        $directmenus->engslug = CreateSlug::createSlug($request->menuenglish);
        $directmenus->url = $request->url;
        $directmenus->hide = $request->showstatus;
        $directmenus->save();
        return redirect()->route('setting.admin.website.menu')->withSuccess('เพิ่มเมนูสำเร็จ');
    }

    public function Edit($id){
        $menu = DirectMenu2::find($id);
        $showstatuses = PageStatus::get();
        $directmenu2s = collect([]);

        $menutypes = MenuType::where('id','<=',2)->get();
        // return $menutypes;
        if($menu->menu_type_id > 2){
            $menutypes = collect([]);
            $directmenu2s = DirectMenu2::where('menu_type_id',2)->get();
        }

        //  return $directmenu2s;
        return view('setting.admin.website.menu.edit')->withMenu($menu)->withShowstatuses($showstatuses)
                                                    ->withMenutypes($menutypes)
                                                    ->withDirectmenu2s($directmenu2s);
    }

    public function EditSave(MenuRequest $request,$id){
        $directmenu = DirectMenu2::find($id);
        $menutype = $directmenu->menu_type_id;
        $submenu = null;
        if($directmenu->menu_type_id <= 2){
            $menutype = $request->menutype;
        }else if($directmenu->menu_type_id == 3){
            $submenu = $request->parent;
        }
        DirectMenu2::find($id)->update([
            'name' => $request->menuthai,
            'slug' =>  CreateSlug::createSlug($request->menuthai),
            'engname' => $request->menuenglish,
            'submenu' => $submenu,
            'menu_type_id' => $menutype,
            'engslug' => CreateSlug::createSlug($request->menuenglish),
            'url' => $request->url,
            'hide' => $request->showstatus
        ]);
        return redirect()->route('setting.admin.website.menu')->withSuccess('แก้ไขเมนูสำเร็จ');
    }
    public function Delete($id){
        DirectMenu2::where('submenu',$id)->delete();
        DirectMenu2::find($id)->delete();

        return redirect()->route('setting.admin.website.menu')->withSuccess('ลบเมนูสำเร็จ');
    }
}
