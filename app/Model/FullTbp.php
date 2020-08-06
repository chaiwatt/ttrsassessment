<?php

namespace App\Model;

use App\Model\MiniTBP;
use App\Model\CriteriaGroup;
use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class FullTbp extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['minitbp','updatedatth'];

    public function getMiniTbpAttribute(){
        return MiniTBP::find($this->mini_tbp_id)->first();
    } 

    public function getYearListAttribute(){
        $presentyear = intval($this->created_at->format('Y'))+543;
        $myarray[] = array(
            'present' => $presentyear, 
            'past1' => $presentyear-1,
            'past2' => $presentyear-2,
            'past3' => $presentyear-3
        ); 
        $collection = collect($myarray)->first();
        return response()->json($myarray)->getContent(); 
    } 
    public function getPresentYearAttribute(){
        $presentyear = intval($this->created_at->format('Y'))+543;
        return $presentyear ; 
    } 
    public function getPast1Attribute(){
        $presentyear = intval($this->created_at->format('Y'))+543-1;
        return $presentyear ; 
    } 
    public function getPast2Attribute(){
        $presentyear = intval($this->created_at->format('Y'))+543-2;
        return $presentyear ; 
    } 
    public function getPast3Attribute(){
        $presentyear = intval($this->created_at->format('Y'))+543-3;
        return $presentyear ; 
    } 

    public function getUpdatedAtThAttribute(){
        return DateConversion::engToThaiDate($this->updated_at->toDateString());
    } 

    public function getCriteriagroupAttribute(){
        return CriteriaGroup::find($this->criteria_group_id);
    } 
}
