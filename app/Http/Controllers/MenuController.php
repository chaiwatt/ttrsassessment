<?php

namespace App\Http\Controllers;

use App\Model\PageStatus;
use App\Helper\CreateSlug;
use App\Model\DirectMenu2;
use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;

class MenuController extends Controller
{
    public function Index(){
        // return 'ok';
        $directmenu2s = DirectMenu2::get();
        return view('setting.admin.website.menu.index')->withDirectmenu2s($directmenu2s);
    }

    public function Create(){
        // $directmenus = DirectMenu2::get();
        $showstatuses = PageStatus::get();
        return view('setting.admin.website.menu.create')->withShowstatuses($showstatuses);
    }
    public function CreateSave(MenuRequest $request){
        $directmenus = new DirectMenu2();
        $directmenus->name = $request->menuthai;
        $directmenus->slug =  CreateSlug::createSlug($request->menuthai) ;
        $directmenus->engname = $request->menuenglish;
        $directmenus->engslug = CreateSlug::createSlug($request->menuenglish) ;
        $directmenus->url = $request->url;
        $directmenus->hide = $request->showstatus;
        $directmenus->save();
        return redirect()->route('setting.admin.website.menu')->withSuccess('เพิ่มเมนูสำเร็จ');
    }

    public function Edit($id){
        $menu = DirectMenu2::find($id);
        $showstatuses = PageStatus::get();
        return view('setting.admin.website.menu.edit')->withMenu($menu)->withShowstatuses($showstatuses);
    }

    public function EditSave(MenuRequest $request,$id){
        DirectMenu2::find($id)->update([
            'name' => $request->menuthai,
            'slug' =>  CreateSlug::createSlug($request->menuthai),
            'engname' => $request->menuenglish,
            'engslug' => CreateSlug::createSlug($request->menuenglish),
            'url' => $request->url,
            'hide' => $request->showstatus
        ]);
        return redirect()->route('setting.admin.website.menu')->withSuccess('แก้ไขเมนูสำเร็จ');
    }
    public function Delete($id){
        DirectMenu2::find($id)->delete();
        return redirect()->route('setting.admin.website.menu')->withSuccess('ลบเมนูสำเร็จ');
    }
}
