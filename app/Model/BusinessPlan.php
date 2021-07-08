<?php

namespace App\Model;

use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Helper\DateConversion;
use App\Model\TimeLineHistory;
use App\Model\ProjectAssignment;
use App\Model\BusinessPlanStatus;
use Illuminate\Database\Eloquent\Model;

class BusinessPlan extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['company','businessplanstatus'];

    public function getCompanyAttribute(){
        return Company::find($this->company_id);
    } 
    public function getBusinessPlanStatusAttribute(){
        return BusinessPlanStatus::find($this->business_plan_status_id,['name', 'progress']);
    } 

    public function getCreateddateTHAttribute(){
        return DateConversion::engToThaiDate($this->created_at->toDateString());
    } 

    public function getUpdatedAtThAttribute(){
        return DateConversion::engToThaiDate($this->updated_at->toDateString());
    } 

    public function getMiniTBPAttribute(){
        return MiniTBP::where('business_plan_id',$this->id)->first();
    } 

    public function getProjectassignmentAttribute(){
        return ProjectAssignment::where('business_plan_id',$this->id)->first();
    } 

    public function getMinitbpapprovedateAttribute(){
        $check = TimeLineHistory::where('business_plan_id',$this->id)->where('message_type',1)->where('details', 'LIKE', '%ได้รับอนุมัติ%')->first();
        if(!Empty($check)){
            return DateConversion::engToThaiDate($check->created_at->toDateString());
        }else{
            return '';
        }
    } 

    public function getFulltbpapprovedateAttribute(){
        $check = TimeLineHistory::where('business_plan_id',$this->id)->where('message_type',2)->where('details', 'LIKE', '%ได้รับอนุมัติ%')->first();
        if(!Empty($check)){
            return DateConversion::engToThaiDate($check->created_at->toDateString());
        }else{
            return '';
        }
    } 

    public function getMinitbpdurationAttribute(){
        $check0 = TimeLineHistory::where('business_plan_id',$this->id)->where('message_type',1)->where('details', 'LIKE', '%ส่งแบบคำขอรับการประเมิน%')->first();
        $check1 = TimeLineHistory::where('business_plan_id',$this->id)->where('message_type',1)->where('details', 'LIKE', '%ได้รับอนุมัติ%')->first();
        if(!Empty($check1)){
            $from = Carbon::parse($check0->created_at);
            $to = Carbon::parse($check1->created_at);
            $diff_in_day = $to->diffInDays($from);
            return $diff_in_day;
        }else{
            return '';
        }
    } 
    public function getFulltbpdurationAttribute(){
        $check0 = TimeLineHistory::where('business_plan_id',$this->id)->where('message_type',2)->where('details', 'LIKE', '%ส่งแผนธุรกิจเทคโนโลยี%')->first();
        $check1 = TimeLineHistory::where('business_plan_id',$this->id)->where('message_type',2)->where('details', 'LIKE', '%ได้รับอนุมัติ%')->first();
        if(!Empty($check1)){
            $from = Carbon::parse($check0->created_at);
            $to = Carbon::parse($check1->created_at);
            $diff_in_day = $to->diffInDays($from);
            return $diff_in_day;
        }else{
            return '';
        }
    } 

    public function getAssessmentdurationAttribute(){
        $check0 = TimeLineHistory::where('business_plan_id',$this->id)->where('message_type',2)->where('details', 'LIKE', '%ได้รับอนุมัติ%')->first();
        $check1 = TimeLineHistory::where('business_plan_id',$this->id)->where('message_type',3)->where('details', 'LIKE', '%สรุปผลการประเมินสำเร็จ%')->first();
        if(!Empty($check1)){
            $from = Carbon::parse($check0->created_at);
            $to = Carbon::parse($check1->created_at);
            $diff_in_day = $to->diffInDays($from);
            return $diff_in_day;
        }else{
            return '';
        }
    } 

    public function getCertificatedurationAttribute(){
        $check0 = TimeLineHistory::where('business_plan_id',$this->id)->where('message_type',3)->where('details', 'LIKE', '%สรุปผลการประเมินสำเร็จ%')->first();
        $check1 = TimeLineHistory::where('business_plan_id',$this->id)->where('message_type',3)->where('details', 'LIKE', '%ยืนยันการส่งจดหมาย%')->first();
        if(!Empty($check1)){
            $from = Carbon::parse($check0->created_at);
            $to = Carbon::parse($check1->created_at);
            $diff_in_day = $to->diffInDays($from);
            return $diff_in_day;
        }else{
            return '';
        }
    } 
    public function getProjectdurationAttribute(){
        $check0 = TimeLineHistory::where('business_plan_id',$this->id)->where('message_type',1)->where('details', 'LIKE', '%ส่งแบบคำขอรับการประเมิน%')->first();
        $check1 = TimeLineHistory::where('business_plan_id',$this->id)->where('message_type',3)->where('details', 'LIKE', '%สิ้นสุดโครงการ%')->first();
        if(!Empty($check1)){
            $from = Carbon::parse($check0->created_at);
            $to = Carbon::parse($check1->created_at);
            $diff_in_day = $to->diffInDays($from);
            return $diff_in_day;
        }else{
            return '';
        }
    } 


    public function getFullTbpAttribute(){
        $minitbp = MiniTBP::where('business_plan_id',$this->id)->first();
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
        return $fulltbp;
    } 
    
}
