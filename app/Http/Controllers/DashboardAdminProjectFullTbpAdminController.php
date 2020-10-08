<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Ev;
use App\Helper\Message;
use App\Model\EvEditHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAdminProjectFullTbpAdminController extends Controller
{
    public function EditEv($id){
        $ev = Ev::find($id);
        $evs = Ev::where('full_tbp_id','!=',$ev->full_tbp_id)->orWhereNull('full_tbp_id')->get();
        $evedithistories = EvEditHistory::where('ev_id',$id)->get();
        return view('dashboard.admin.project.fulltbp.admin.editev')->withEvs($evs)
                                                            ->withEvedithistories($evedithistories)
                                                            ->withEv($ev);
    }

    public function AddEvEditHistory(Request $request,$id){
        $auth = Auth::user();
        $evedithistory = new EvEditHistory();
        $evedithistory->ev_id = $id;
        $evedithistory->user_id = $auth->id;
        $evedithistory->detail = $request->detail;
        $evedithistory->save();
        if($auth->user_type_id != 6){
            Message::sendMessage('มีการแก้ไข EV','เรียน JD<br> ได้มีการแก้ไข EV '. Ev::find($id)->name.' โดย ' . $auth->name . ' '. $auth->lastname . ' ได้ที่ <a href='.route('dashboard.admin.project.fulltbp.admin.editev',['id' => $id]).'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::where('user_type_id',6)->first()->id);
        }  
        return redirect()->back()->withSuccess('เพิ่มประวัติสำเร็จ');
    }

  
}
