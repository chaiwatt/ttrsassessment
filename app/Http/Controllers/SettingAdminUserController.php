<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Model\Prefix;
use App\Model\UserLog;
use App\Model\UserType;
use App\Model\UserStatus;
use App\Model\ExpertDetail;
use App\Model\OfficerDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;

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
        $users = User::get();
        return view('setting.admin.user.index')->withUsers($users);
    }
    public function Create(){
        $prefixes = Prefix::get();
        $usertypes = UserType::get();
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
        // return  $request->usertype;
        $user = User::find($id);
        if(!Hash::check( $request->password,$user->password)){
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        if($user->user_type_id == 1){
           if($request->usertype == 3){ //change user -> expert
                $experttype = 1;
                if($request->experttype != 1){  //internal expert
                    $experttype = 2;
                }
                $xpertdetail = new ExpertDetail();
                $xpertdetail->user_id = $user->id;
                $xpertdetail->expert_type_id = $experttype;
                $xpertdetail->save();
           }else if($request->usertype > 3){ //change user -> ttrs officer
                $officerdetail = new OfficerDetail();
                $officerdetail->user_id = $user->id;
                $officerdetail->save();
           }
        }else if($user->user_type_id == 3){
            if($request->usertype == 1){ //change expert to user
                ExpertDetail::where('user_id',$user->id)->delete();
            }else if($request->usertype > 3){ //change expert to ttrs officer
                ExpertDetail::where('user_id',$user->id)->delete();
                $officerdetail = new OfficerDetail();
                $officerdetail->user_id = $user->id;
                $officerdetail->save();
            }
        }else if($user->user_type_id > 3){
            if($request->usertype == 1){ //change ttrs officer to user
                OfficerDetail::where('user_id',$user->id)->delete();
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
               }
        }
        User::find($id)->update([
            'prefix_id' => $request->prefix,
            'alter_prefix' => $request->alter_prefix,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'user_type_id' => $request->usertype,
            'user_status_id' => $request->userstatus,
            'email' => $request->email
        ]);

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
