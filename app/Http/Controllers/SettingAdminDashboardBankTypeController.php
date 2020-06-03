<?php

namespace App\Http\Controllers;

use App\Model\BankType;
use Illuminate\Http\Request;
use App\Http\Requests\CreateBankTypeRequest;

class SettingAdminDashboardBankTypeController extends Controller
{
    public function Index(){
        $banktypes = BankType::get();
        return view('setting.admin.dashboard.banktype.index')->withBanktypes($banktypes);
    }
    public function Create(){
        return view('setting.admin.dashboard.banktype.create');
    }
    public function CreateSave(CreateBankTypeRequest $request){
        $banktype = new BankType();
        $banktype->name = $request->banktype;
        $banktype->save();
        return redirect()->route('setting.admin.dashboard.banktype')->withSuccess('เพิ่มประเภทบัญชีเงินฝากสำเร็จ');
    }
    public function Edit($id){
        $banktype = BankType::find($id);
        return view('setting.admin.dashboard.banktype.edit')->withBanktype($banktype);
    }
    public function EditSave(CreateBankTypeRequest $request,$id){
        $banktype = BankType::find($id)->update([
            'name' => $request->banktype
        ]);
        return redirect()->route('setting.admin.dashboard.banktype')->withSuccess('แก้ไขประเภทบัญชีเงินฝากสำเร็จ');
    }
    public function Delete($id){
        BankType::find($id)->delete();
        return redirect()->route('setting.admin.dashboard.banktype')->withSuccess('ลบประเภทบัญชีเงินฝากสำเร็จ');
}
}