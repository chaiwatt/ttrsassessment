<?php

namespace App\Http\Controllers;

use App\Model\BankType;
use App\Model\BankAccount;
use Illuminate\Http\Request;
use App\Http\Requests\CreateBankAccountRequest;

class SettingAdminDashboardBankAccountController extends Controller
{
    public function Index(){
        $bankaccounts = BankAccount::get();       
        return view('setting.admin.dashboard.bankaccount.index')->withBankaccounts($bankaccounts);
    }
    public function Create(){   
        $banktypes = BankType::get(); 
        return view('setting.admin.dashboard.bankaccount.create')->withBanktypes($banktypes);
    }
    public function CreateSave(CreateBankAccountRequest $request){   
        $bankaccount = new BankAccount();   
        $bankaccount->bank = $request->bank;
        $bankaccount->name = $request->name;
        $bankaccount->accountno = $request->accountno;
        $bankaccount->bank_type_id = $request->banktypeid;
        $bankaccount->save();
        return redirect()->route('setting.admin.dashboard.bankaccount')->withSuccess('เพิ่มรายการบัญชีสำเร็จ');
    }
    public function Edit($id){   
        $banktypes = BankType::get(); 
        $bankaccount = BankAccount::find($id); 
        return view('setting.admin.dashboard.bankaccount.edit')->withBankaccount($bankaccount)
                                                                ->withBanktypes($banktypes);
    }
    public function EditSave(CreateBankAccountRequest $request,$id){   
        $bankaccount = BankAccount::find($id)->update([
            'bank' => $request->bank,
            'name' => $request->name,
            'accountno' => $request->accountno,
            'bank_type_id' => $request->banktypeid
        ]);
        return redirect()->route('setting.admin.dashboard.bankaccount')->withSuccess('แก้ไขรายการบัญชีสำเร็จ');
    }
    public function Delete($id){   
       BankAccount::find($id)->delete();
        return redirect()->route('setting.admin.dashboard.bankaccount')->withSuccess('ลบรายการบัญชีสำเร็จ');
    }
}
