<?php

namespace App\Model;

use App\Model\Ev;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\ProjectFlow;
use App\Model\BusinessPlan;
use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getStartdatethAttribute(){
        return DateConversion::engToThaiDate($this->startdate);
    } 
    public function getEnddatethAttribute(){
        return DateConversion::engToThaiDate($this->enddate);
    } 
    public function getProjectflowAttribute(){
        return ProjectFlow::find($this->project_flow_id)->name;
    } 
    public function getControlflowstage3approveAttribute(){
        $fulltbp = FullTbp::where('mini_tbp_id',$this->mini_tbp_id)->first();
        $minitbp = MiniTBP::find($this->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $ev= Ev::where('full_tbp_id')->first();

        $fulltbpapprove = $businessplan->business_plan_status_id;
        $expertapprove = $fulltbp->assignexpert;
        $evapprove = $ev->status;
        $controlflowstage3 = array($fulltbpapprove, $expertapprove,$evapprove);
        return $controlflowstage3;
    } 

}
