<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Model\Prefix;
use App\Model\Company;
use App\Model\UserLog;
use App\Model\UserType;
use App\Model\UserStatus;
use App\Model\ExpertDetail;
use App\Model\OfficerDetail;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Session;

class SettingAdminUserController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:4,5,6,7,8,9,10'); 
    }
    public function Index(){
        // $users = User::where('id','!=',Auth::user()->id)->get();
        $auth = Auth::user();
        if($auth->user_type_id < 5){
             Auth::logout();
             Session::flush();
             return redirect()->route('login');
        }

        $users = User::get();
        return view('setting.admin.user.index')->withUsers($users);
    }
    public function Create(){
        $prefixes = Prefix::get();
        $usertypes = UserType::where('id','<',5)->get();
        $userstatuses = UserStatus::get();
        return view('setting.admin.user.create')->withPrefixes($prefixes)
                                    ->withUsertypes($usertypes)
                                    ->withUserstatuses($userstatuses);
    }
    public function CreateSave(CreateUserRequest $request){
        $user = new User();
        $user->prefix_id = $request->prefix;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->user_type_id = $request->usertype;
        $user->user_status_id = $request->userstatus;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verified_at =  Carbon::now()->toDateString();
        $user->verify_type =  1 ;
        $user->save();
        return redirect()->route('setting.admin.user')->withSuccess('เพิ่มผู้ใช้งานสำเร็จ');
    }

    public function Edit($id){
        $prefixes = Prefix::get();
        $usertypes = UserType::get();
        $userstatuses = UserStatus::get();
        $user = User::find($id);
        return view('setting.admin.user.edit')->withPrefixes($prefixes)
                                    ->withUsertypes($usertypes)
                                    ->withUserstatuses($userstatuses)
                                    ->withUser($user);
    }
    public function EditSave(CreateUserRequest $request,$id){
        $user = User::find($id);
        if($user->user_type_id == 1){
            if($request->usertype < 3){
                if($request->usertype == 1){ //นิติบุคคล
                    User::find($id)->update([
                        'user_group_id' => 1
                    ]);
                    Company::where('user_id',$id)->first()->update([
                        'business_type_id' => 2
                    ]);
                }else{ 
                    User::find($id)->update([ //บุคคลธรรมดา 
                        'user_group_id' => 2
                    ]);
                    Company::where('user_id',$id)->first()->update([
                        'business_type_id' => 5
                    ]);
                }
            }elseif($request->usertype == 3){ //change user -> expert
                $experttype = 1;
                if($request->experttype != 1){  //internal expert
                    $experttype = 2;
                }
                $xpertdetail = new ExpertDetail();
                $xpertdetail->user_id = $user->id;
                $xpertdetail->expert_type_id = $experttype;
                $xpertdetail->save();
                User::find($id)->update([
                    'user_group_id' => 2
                ]);
                Company::where('user_id',$id)->first()->update([
                    'business_type_id' => 5
                ]);
           }else if($request->usertype > 3){ //change user -> ttrs officer
               if($request->usertype == 5){ 
                    $_user = User::where('user_type_id',5)->update([
                        'user_type_id' => 4
                    ]);
               }elseif($request->usertype == 6){
                    $_user = User::where('user_type_id',6)->update([
                        'user_type_id' => 4
                    ]);
               }
                $officerdetail = new OfficerDetail();
                $officerdetail->user_id = $user->id;
                $officerdetail->save();
                User::find($id)->update([
                    'user_group_id' => 2
                ]);
                Company::where('user_id',$id)->first()->update([
                    'business_type_id' => 5
                ]);
           }
        }else if($user->user_type_id == 3){
            if($request->usertype == 1){ //change expert to user
                ExpertDetail::where('user_id',$user->id)->delete();
                if($request->usertype == 1){ //นิติบุคคล
                    User::find($id)->update([
                        'user_group_id' => 1
                    ]);
                    Company::where('user_id',$id)->first()->update([
                        'business_type_id' => 2
                    ]);
                }else{ 
                    User::find($id)->update([ //บุคคลธรรมดา 
                        'user_group_id' => 2
                    ]);
                    Company::where('user_id',$id)->first()->update([
                        'business_type_id' => 5
                    ]);
                }
            }elseif($request->usertype == 3){
                if($request->experttype == 1){  //internal expert
                    ExpertDetail::where('user_id',$user->id)->update([
                        'expert_type_id' => 1
                    ]);
                }else{
                    ExpertDetail::where('user_id',$user->id)->update([
                        'expert_type_id' => 2
                    ]);
                }
            }else if($request->usertype > 3){ //change expert to ttrs officer
                ExpertDetail::where('user_id',$user->id)->delete();
                if($request->usertype == 5){ 
                    $_user = User::where('user_type_id',5)->update([
                        'user_type_id' => 4
                    ]);
               }elseif($request->usertype == 6){
                    $_user = User::where('user_type_id',6)->update([
                        'user_type_id' => 4
                    ]);
               }
                ExpertDetail::where('user_id',$user->id)->delete();
                $officerdetail = new OfficerDetail();
                $officerdetail->user_id = $user->id;
                $officerdetail->save();
                User::find($id)->update([
                    'user_group_id' => 2
                ]);
                Company::where('user_id',$id)->first()->update([
                    'business_type_id' => 5
                ]);
            }
        }else if($user->user_type_id > 3){
            if($request->usertype == 1){ //change ttrs officer to user
                OfficerDetail::where('user_id',$user->id)->delete();
                if($request->usertype == 1){ //นิติบุคคล
                    User::find($id)->update([
                        'user_group_id' => 1
                    ]);
                    Company::where('user_id',$id)->first()->update([
                        'business_type_id' => 2
                    ]);
                }else{ 
                    User::find($id)->update([ //บุคคลธรรมดา 
                        'user_group_id' => 2
                    ]);
                    Company::where('user_id',$id)->first()->update([
                        'business_type_id' => 5
                    ]);
                }
            }else if($request->usertype == 3){ //change officer -> expert
                OfficerDetail::where('user_id',$user->id)->delete();
                    $experttype = 1;
                    if($request->experttype != 1){  //internal expert
                        $experttype = 2;
                    }
                    $xpertdetail = new ExpertDetail();
                    $xpertdetail->user_id = $user->id;
                    $xpertdetail->expert_type_id = $experttype;
                    $xpertdetail->save();
                    User::find($id)->update([
                        'user_group_id' => 2
                    ]);
                    Company::where('user_id',$id)->first()->update([
                        'business_type_id' => 5
                    ]);
               }else if($request->usertype > 3){
                    if($request->usertype == 5){ 
                        $_user = User::where('user_type_id',5)->update([
                            'user_type_id' => 4
                        ]);
                }elseif($request->usertype == 6){
                        $_user = User::where('user_type_id',6)->update([
                            'user_type_id' => 4
                        ]);
                }
               }
        }
        $usertype = $request->usertype;
        if( $usertype < 3){
            $usertype  = 1;
        }

        User::find($id)->update([
            'user_type_id' => $usertype,
            'user_status_id' => $request->userstatus,
        ]);

        CreateUserLog::createLog('แก้ไขข้อมูลผู้ใช้งาน (' . $user->name . ' ' . $user->lastname .')');

        return redirect()->route('setting.admin.user')->withSuccess('แก้ไขผู้ใช้งานสำเร็จ');
    }
    public function Delete($id){
        User::find($id)->delete();
        return redirect()->route('setting.admin.user')->withSuccess('ลบผู้ใช้งานสำเร็จ');
    }

    public function Log(){
        // $users = User::where('id','!=',Auth::user()->id)->get();
        $userlogs = UserLog::get();
        // return $userlogs;
        return view('setting.admin.user.userlog')->withUserlogs($userlogs);
    }

}
