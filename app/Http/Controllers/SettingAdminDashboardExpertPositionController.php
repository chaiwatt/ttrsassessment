<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ExpertPosition;
use App\Http\Requests\CreateExpertPositionRequest;

class SettingAdminDashboardExpertPositionController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1'); 
    }
    Public function Index(){
        $expertpositions = ExpertPosition::get();
        return view('setting.admin.dashboard.expertposition.index')->withExpertpositions($expertpositions);

    }
    public function Create(){
        return view('setting.admin.dashboard.expertposition.create');
    }
    public function CreateSave(CreateExpertPositionRequest $request){
        $expertposition = new ExpertPosition();
        $expertposition->name = $request->expertposition;
        $expertposition->save();
        return redirect()->route('setting.admin.dashboard.expertposition')->withSuccess('เพิ่มตำแหน่ง expert สำเร็จ');
    }
    public function Edit($id){
        $expertposition = ExpertPosition::find($id);
        return view('setting.admin.dashboard.expertposition.edit')->withExpertposition($expertposition);
    }
    public function EditSave(CreateExpertPositionRequest $request ,$id){
        $expertposition = ExpertPosition::find($id)->update([
            'name'=> $request->expertposition
        ]);
        return redirect()->route('setting.admin.dashboard.expertposition')->withSuccess('แก้ไขตำแหน่ง expert สำเร็จ');
    }
    public function Delete($id){
        ExpertPosition::find($id)->delete();
        return redirect()->route('setting.admin.dashboard.expertposition')->withSuccess('ลบตำแหน่ง expert สำเร็จ');
    }

}
 