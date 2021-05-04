<?php

namespace App\Model;

use App\User;
use App\Model\FullTbp;
use App\Model\ExpertDetail;
use App\Model\ExpertComment;
use App\Model\ExpertAssignment;
use Illuminate\Support\Facades\Auth;
use App\Model\ExpertAssignmentStatus;
use Illuminate\Database\Eloquent\Model;

class ExpertAssignment extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = [];
    // protected $appends = ['user','expertassignmentstatus','expertcomment','fulltbp'];
    public function getUserAttribute(){
        return User::find($this->user_id);
    }

    public function getexpertassignmentstatusAttribute(){
        return ExpertAssignmentStatus::find($this->expert_assignment_status_id);
    }

    public function getExpertcommentAttribute(){
        return ExpertComment::where('full_tbp_id',$this->full_tbp_id)->where('user_id',$this->user_id)->first();
    }

    public function getFullTbpAttribute(){
        return FullTbp::find($this->full_tbp_id);
    }

    public function isExternal($id)
    {
        $user = User::find($id);
        if ($user->user_type_id == 3){
            $check = ExpertDetail::where('user_id',$id)->first();
            if($check->expert_type_id == 1){
                return "";
            }else if($check->expert_type_id == 2){
                return "(ภายนอก)";
            }
        }else{
            return "";
        }
    }
}
