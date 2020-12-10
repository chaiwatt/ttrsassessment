<?php

namespace App\Http\Controllers;

use App\Model\DirectMenu;
use App\Helper\CreateSlug;
use Illuminate\Http\Request;
use App\Http\Requests\CreateDirectMenuRequest;

class SettingAdminWebsiteDirectMenuController extends Controller
{
    public function Crud(CreateDirectMenuRequest $request){
        if($request->action == 'create'){
            $menu = new DirectMenu();
            $menu->name = $request->menuthai;
            $menu->slug = CreateSlug::createSlug($request->menuthai);
            $menu->engname = $request->menuenglish;
            $menu->engslug = CreateSlug::createSlug($request->menuenglish);
            $menu->url = $request->url;
            $menu->save();
            return redirect()->back()->withSuccess('เพิ่มเมนูสำเร็จ');
        }else if($request->action == 'edit'){
            if(!Empty($request->menuid)){
                DirectMenu::find($request->menuid)->update([
                    'name' => $request->menuthai,
                    'slug' => CreateSlug::createSlug($request->menuthai),
                    'engname' => $request->menuenglish,
                    'engslug' => CreateSlug::createSlug($request->menuenglish),
                    'url' => $request->url
                ]);
                return redirect()->back()->withSuccess('แก้ไขเมนูสำเร็จ');
            }else{
                return redirect()->back()->withError('ยังไม่ได้เลือกเมนู');
            }
        }else if($request->action == 'delete'){
            if(!Empty($request->menuid)){
                DirectMenu::find($request->menuid)->delete();
                return redirect()->back()->withSuccess('ลบเมนูสำเร็จ');
            }else{
                return redirect()->back()->withError('ยังไม่ได้เลือกเมนู');
            }
        }   
    }
}
