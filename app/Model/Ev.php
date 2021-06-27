<?php

namespace App\Model;

use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\EvStatus;
use App\Model\ProjectMember;
use App\Model\ScoringStatus;
use App\Model\CriteriaTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Ev extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getFullTbpAttribute(){
        return FullTbp::find($this->full_tbp_id);
    } 

    public function getScoringStatusAttribute(){
        return ScoringStatus::where('ev_id',$this->id)->where('user_id',Auth::user()->id)->get();
    } 

    public function getEvStatusAttribute(){
        return EvStatus::find($this->status);
    } 


    public function getIsevaddAttribute(){       
        return CriteriaTransaction::where('ev_id',$this->id)->count();
    } 
}
