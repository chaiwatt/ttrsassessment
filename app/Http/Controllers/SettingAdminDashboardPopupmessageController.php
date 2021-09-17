<?php

namespace App\Http\Controllers;

use App\Model\PopupMessage;
use Illuminate\Http\Request;

class SettingAdminDashboardPopupmessageController extends Controller
{
    public function Index(){
        $popupmessages = PopupMessage::get();
        return view('setting.admin.dashboard.popupmessage.index')->withPopupmessages($popupmessages);
    }

    public function Edit($id){
        $popupmessage = PopupMessage::find($id);
        return view('setting.admin.dashboard.popupmessage.edit')->withPopupmessage($popupmessage);
    }

    public function EditSave(Request $request, $id){
        PopupMessage::find($id)->update([
            'title' => $request->title,
            'message' => $request->message
        ]);
        return redirect()->route('setting.admin.dashboard.popup')->withSuccess('แก้ไขสำเร็จ');
    }

    public function Restore(){
        $popuomessages = PopupMessage::get();
        foreach ($popuomessages as $key => $popuomessage) {
            PopupMessage::find($popuomessage->id)->update([
                'title' => $popuomessage->title_default,
                'message' => $popuomessage->message_default,
            ]);
        }
        return redirect()->route('setting.admin.dashboard.popup')->withSuccess('เรียกคืนค่า Default สำเร็จ');
    }
}
