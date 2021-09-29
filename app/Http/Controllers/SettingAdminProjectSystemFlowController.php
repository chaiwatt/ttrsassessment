<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\ProjectFlow;
use App\Model\EventCalendar;
use Illuminate\Http\Request;

class SettingAdminProjectSystemFlowController extends Controller
{
    public function Index(){
        $fulltbparr = EventCalendar::whereNotNull('eventdate')
                                ->whereDate('eventdate', '<=', Carbon::today())
                                ->where('calendar_type_id',3)
                                ->pluck('full_tbp_id')->toArray();

        if(count($fulltbparr) > 0){
            $fulltbps = FullTbp::whereNull('finishdate')->whereIn('id',array_unique($fulltbparr))->get();
        }else{
            $fulltbps = FullTbp::whereNull('finishdate')->whereIn('id',$fulltbparr)->get();
        }

        $projectflows = ProjectFlow::get();
        return view('setting.admin.system.projectflow.index')->withProjectflows($projectflows)->withFulltbps($fulltbps);
    }
    public function Edit($id){
        $projectflow = ProjectFlow::find($id);
        return view('setting.admin.system.projectflow.edit')->withProjectflow($projectflow);
    }
    public function EditSave(Request $request,$id){
        ProjectFlow::find($id)->update([
            'duration' => $request->duration
        ]);
        return redirect()->route('setting.admin.system.projectflow')->withSuccess('แก้ไขรายการสำเร็จ');
    }
}
