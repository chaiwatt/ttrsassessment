<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Company;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusinessPlanController extends Controller
{
    public function Update(Request $request){
        $status = 1;
        if($request->status == 1){
            $status = 2;
            $_businessplan = BusinessPlan::find($request->id);
            $_company = Company::find($_businessplan->company_id);
            $_user = User::find($_company->user_id);
            $minitbp = MiniTBP::where('business_plan_id', $_businessplan->id)->first();
            EmailBox::send($_user->email,'TTRS:กรอกข้อมูล Mini TBP','เรียนผู้ประกอบการ<br> คำขอประเมินธุรกิจของท่านได้รับอนุมัติให้สามารถกรอกข้อมูล Mini TBP ได้ที่ <a href='.route('dashboard.company.project.minitbp.edit',['id' => $minitbp->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('กรอกข้อมูล Mini TBP','เรียนผู้ประกอบการ<br> คำขอประเมินธุรกิจของท่านได้รับอนุมัติให้สามารถกรอกข้อมูล Mini TBP ได้ที่ <a href='.route('dashboard.company.project.minitbp.edit',['id' => $minitbp->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',User::where('user_type_id',7)->first()->id,$_user->id);
        }
        BusinessPlan::find($request->id)->update([
            'business_plan_status_id' => $status
        ]);
        $businessplan = BusinessPlan::find($request->id);  
        return response()->json($businessplan);  
    }
}
