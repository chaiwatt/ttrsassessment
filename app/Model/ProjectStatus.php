<?php

namespace App\Model;

use App\Model\Ev;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\ProjectFlow;
use App\Model\BusinessPlan;
use App\Helper\DateConversion;
use App\Model\ProjectStatusTransaction;
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
    public function getActualdatethAttribute(){
        if(Empty($this->actual_startdate)){
            return '';
        }else{
            return DateConversion::engToThaiDate($this->actual_startdate);
        }
    } 
    public function getProjectflowAttribute(){
        return ProjectFlow::find($this->project_flow_id)->name;
    } 
    public function projectstatustransaction($flow,$minitbp){
        $name = ProjectStatusTransaction::where('project_flow_id',$flow)->where('mini_tbp_id',$minitbp)->first();
        if(!Empty($name)){

            if($name->status == 1){
                return '<span class="badge badge-flat border-pink text-pink-600">อยู่ระหว่างการดำเนินการ</span>';
            }elseif($name->status == 2){
                return '<span class="badge badge-flat border-success text-success-600">เสร็จสิ้น</span>';
            }
        }else{
            return '<span class="badge badge-flat border-grey text-grey-600">ยังไม่ได้ดำเนินการ</span>';
        }
        
    } 
    public function getControlflowstage3approveAttribute(){
        $fulltbp = FullTbp::where('mini_tbp_id',$this->mini_tbp_id)->first();
        $minitbp = MiniTBP::find($this->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $ev= Ev::where('full_tbp_id',$fulltbp->id)->first();

        $fulltbpapprove = $businessplan->business_plan_status_id;
        $expertapprove = $fulltbp->assignexpert;
        $evapprove = $ev->status;
        // dd($evapprove);
        $controlflowstage3 = array($fulltbpapprove, $expertapprove,$evapprove);
        return $controlflowstage3;
    } 

}
