<?php

namespace App\Model;

use App\Model\Pillar;
use App\Model\SubPillar;
use App\Model\SubPillarIndex;
use Illuminate\Database\Eloquent\Model;

class PillaIndexWeigth extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    protected $appends = ['pillar','subpillar','subpillarindex'];

    public function getPillarAttribute()
    {
        return Pillar::find($this->pillar_id);
    }
    public function getSubPillarAttribute()
    {
        return SubPillar::find($this->sub_pillar_id);
    }
    public function getSubPillarIndexAttribute()
    {
        return SubPillarIndex::find($this->sub_pillar_index_id);
    }
}
