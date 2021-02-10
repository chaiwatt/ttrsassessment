<?php

namespace App\Model;

use App\Model\SubPillarIndex;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getSubpillarindexAttribute(){
        return SubPillarIndex::find($this->sub_pillar_index_id);
    }
}
