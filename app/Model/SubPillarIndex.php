<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubPillarIndex extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getPillarAttribute(){
        $subpillar = SubPillar::find($this->sub_pillar_id);
        return Pillar::find($subpillar->pillar_id);
    } 
    public function getSubpillarAttribute(){
        return SubPillar::find($this->sub_pillar_id);
    } 
}
