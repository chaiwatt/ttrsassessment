<?php

namespace App\Model;

use App\Model\Pillar;
use App\Model\Scoring;
use App\Model\Criteria;
use App\Model\SubPillar;
use App\Model\SubPillarIndex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class CriteriaTransaction extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['pillar','subpillar','criteria','subpillarindex','scoring'];

    public function getCriteriaAttribute(){
        return Criteria::find($this->criteria_id);
    } 
    public function getSubpillarindexAttribute(){
        return SubPillarIndex::find($this->sub_pillar_index_id);
    } 
    public function getPillarAttribute(){
        $subpillarindex = SubPillarIndex::find($this->sub_pillar_index_id);
        $subpillar = SubPillar::find($subpillarindex->sub_pillar_id);

        return Pillar::find($subpillar->pillar_id);
    } 
    public function getSubpillarAttribute(){
        $subpillarindex = SubPillarIndex::find($this->sub_pillar_index_id);
        return SubPillar::find($subpillarindex->sub_pillar_id);
    } 

    public function getScoringAttribute(){
        return Scoring::where('criteria_transaction_id',$this->id)->where('user_id',Auth::user()->id)->first();
    } 
}
