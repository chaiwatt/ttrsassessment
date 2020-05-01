<?php

namespace App\Http\Controllers;

use App\Model\UserPosition;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserPositionRequest;

class SettingDashboardUserPositionController extends Controller
{
    public function Index(){
        $userpositions = UserPosition::get();
        return view('setting.dashboard.userposition.index')->withUserpositions($userpositions);
    }
    public function Create(){
        return view('setting.dashboard.userposition.create');
    }
    public function CreateSave(CreateUserPositionRequest $request){
        $userposition = new UserPosition();
        $userposition->name = $request->userposition;
        $userposition->save();
        return redirect()->route('setting.dashboard.userposition')->withSuccess('เพิ่มตำแหน่งผู้ใช้งานสำเร็จ');
    }
    public function Edit($id){
        $userposition = UserPosition::find($id);
        return view('setting.dashboard.userposition.edit')->withUserposition($userposition);
    }
    public function EditSave(CreateUserPositionRequest $request,$id){
        $religion = UserPosition::find($id)->update([
            'name' => $request->userposition
        ]);
        return redirect()->route('setting.dashboard.userposition')->withSuccess('แก้ไขตำแหน่งผู้ใช้งานสำเร็จ');
    }
    public function Delete($id){
        UserPosition::find($id)->delete();
        return redirect()->route('setting.dashboard.userposition')->withSuccess('ลบตำแหน่งผู้ใช้งานสำเร็จ');
    }
}
