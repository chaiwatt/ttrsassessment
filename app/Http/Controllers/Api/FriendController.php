<?php

namespace App\Http\Controllers\Api;

use App\Model\FriendRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FriendController extends Controller
{
    public function FriendRequest(Request $request){
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
        $friendrequests = FriendRequest::where('from_id',$request->id)->where('friend_status_id',2)->get();
        return response()->json($friendrequests);  
    }
}