<?php

namespace App\Model;

use App\Model\Pillar;
use Illuminate\Database\Eloquent\Model;

class SubPillar extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getPillarAttribute(){
        return Pillar::find($this->pillar_id);
    } 

    // public function Singlepillar($pillarid){

    //     return Pillar::find($pillarid)->name;
    // } 
    // public function getSubpillarAttribute(){
    //     return SubPillar::find($this->sub_pillar_id);
    // } 
}
