<?php

namespace App\Http\Controllers\Api;

use App\Model\Friend;
use App\Model\FriendRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function AddRequest(Request $request){
        foreach ($request->toids as $id) {
            $check = FriendRequest::where('to_id',$id)->first();
            if(Empty($check)){
                $friendrequest = new FriendRequest();
                $friendrequest->from_id = $request->id;
                $friendrequest->to_id = $id;
                $friendrequest->friend_status_id = 2;
                $friendrequest->save();
            }
        }
        $friendrequests = FriendRequest::where('from_id',$request->id)->whereIn('friend_status_id',[2,4])->get();
        return response()->json($friendrequests);  
    }
    public function DeleteRequest(Request $request){
        FriendRequest::find($request->id)->delete();
        $friendrequests = FriendRequest::where('from_id',Auth::user()->id)->whereIn('friend_status_id',[2,4])->get();
        return response()->json($friendrequests);  
    }
    public function AcceptRequest(Request $request){
        $auth = Auth::user();
        $friendrequest = FriendRequest::find($request->id);
        $friend = new Friend();
        $friend->user_id = $auth->id;
        $friend->friend_id = $friendrequest->from_id;
        $friend->save();

        $friend = new Friend();
        $friend->user_id = $friendrequest->from_id;
        $friend->friend_id = $auth->id;
        $friend->save();

        FriendRequest::find($request->id)->delete();
        $friendrequests = FriendRequest::where('to_id',$auth->id)->whereIn('friend_status_id',[2,4])->get();
        $friends = Friend::where('user_id',$auth->id)->get();
        return response()->json(array("comming" => $friendrequests,"friends" => $friends));  
    }
    public function RejectRequest(Request $request){
        $auth = Auth::user();
        FriendRequest::find($request->id)->delete();
        $friendrequests = FriendRequest::where('to_id',$auth->id)->whereIn('friend_status_id',[2,4])->get();
        return response()->json($friendrequests);  
    }
}