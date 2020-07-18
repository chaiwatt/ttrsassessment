<?php

namespace App\Model;

use App\User;
use App\Model\ExpertAssignmentStatus;
use Illuminate\Database\Eloquent\Model;

class ExpertAssignment extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['user','expertassignmentstatus'];
    public function getUserAttribute(){
        return User::find($this->user_id);
    }
    public function getexpertassignmentstatusAttribute(){
        return ExpertAssignmentStatus::find($this->expert_assignment_status_id);
    }
}
