<?php

namespace App\Http\Controllers;

use App\Model\Ev;
use App\Model\Pillar;
use App\Model\Cluster;
use App\Model\Criteria;
use Illuminate\Http\Request;
use App\Model\CriteriaTransaction;

class SettingAdminAssessmentEvController extends Controller
{
    public function Index(){
        $evs = Ev::get();
        return view('setting.admin.assessment.ev.index')->withEvs($evs);
    }
    public function Create(){
        $pillars = Pillar::get();
        return view('setting.admin.assessment.ev.create')->withPillars($pillars);
    }
    public function CreateSave(Request $request){
        $ev = new Ev();
        $ev->name = $request->name;
        $ev->version = $request->version;
        $ev->save();
        return redirect()->route('setting.admin.assessment.ev')->withSuccess('เพิ่มรายการสำเร็จ');
    }
    public function Edit($id){
        $ev = Ev::find($id);
        return view('setting.admin.assessment.ev.edit')->withEv($ev);
    }
    public function EditSave(Request $request,$id){
        Ev::find($id)->update([
            'name' => $request->name,
            'version' => $request->version
        ]);
        return redirect()->route('setting.admin.assessment.ev')->withSuccess('แก้ไขรายการสำเร็จ');
    }
    public function Delete($id){
        Ev::find($id)->delete();
        return redirect()->route('setting.admin.assessment.ev')->withSuccess('ลบรายการสำเร็จ');
    }
    public function EditEv($id){
        $ev = Ev::find($id);
        $pillars = Pillar::get();
        return view('setting.admin.assessment.ev.editev')->withEv($ev)
                                                    ->withPillars($pillars);
    }
}
