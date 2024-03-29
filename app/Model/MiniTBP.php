<?php

namespace App\Model;

use App\User;
use Carbon\Carbon;
use App\Model\Prefix;
use App\Model\FullTbp;
use App\Model\ThaiBank;
use App\Model\ReviseLog;
use App\Helper\LogAction;
use App\Model\BusinessPlan;
use App\Model\ExpertDetail;
use App\Model\ProjectStatus;
use App\Helper\DateConversion;
use Illuminate\Support\Facades\Auth;
use App\Model\ProjectStatusTransaction;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class MiniTBP extends Model
{
    use LogsActivity;
    
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['businessplan','prefix','bank'];

protected static $logAttributes = ['project', 'projecteng', 'finance1', 'finance2', 'nonefinance1', 'nonefinance2', 'nonefinance3', 'nonefinance4', 'nonefinance5', 'nonefinance6',
'contactname','contactlastname','contactphone','contactemail','contactposition','website'];
    protected static $logName = 'Mini TBP';

    protected static $logOnlyDirty = true;

    // public function getDescriptionForEvent(string $eventName): string
    // {
    //     return LogAction::logAction('Mini TBP',$eventName);
    // }

    public function getBusinessPlanAttribute(){
        return BusinessPlan::find($this->business_plan_id);
    } 
    public function getPrefixAttribute(){
        return Prefix::find($this->contactprefix);
    } 
    public function getManagerprefixAttribute(){
        return Prefix::find($this->managerprefix_id);
    } 
    public function getBankAttribute(){
        if($this->thai_bank_id == 0){
            return '';
        }
        return ThaiBank::find($this->thai_bank_id)->name;
    } 
    public function getBank1Attribute(){
        if($this->thai_bank_1_id == 0){
            return '';
        }
        return ThaiBank::find($this->thai_bank_1_id)->name;
    } 
    public function getBank2Attribute(){
        if($this->thai_bank_2_id == 0){
            return '';
        }
        return ThaiBank::find($this->thai_bank_2_id)->name;
    } 

    public function getUpdatedAtThAttribute(){
        return DateConversion::engToThaiDate($this->updated_at->toDateString());
    } 

    public function getContactpersonprefixAttribute(){
        return Prefix::find($this->contactprefix);
    }

    public function getFulltbpAttribute(){
        return FullTbp::where('mini_tbp_id',$this->id)->first();
    }

    public function getReviselogAttribute(){
        return ReviseLog::where('mini_tbp_id',$this->id)->where('doctype',1)->get();
    }

    public function Reviselog($id){
        return ReviseLog::where('mini_tbp_id',$this->id)->where('doctype',$id)->get();
    }

    public function getSubmitdateThAttribute(){
        if(!Empty($this->submitdate)){
            return DateConversion::engToThaiDate($this->submitdate);
        }else{
           return "" ;
        }
    } 

    public function getProjectdatediffAttribute(){
        if(!Empty($this->submitdate)){
            $businessplan = BusinessPlan::find($this->business_plan_id);
            if($businessplan->business_plan_status_id < 10){
                $datefiff = Carbon::parse(Carbon::createFromFormat('Y-m-d', $this->submitdate))->DiffInDays(Carbon::now(), false);
                return intVal($datefiff)+1 ;
            }else{
                $fulltbp = FullTbp::where('mini_tbp_id',$this->id)->first();
                if(!Empty($fulltbp->endprojectdate)){
                    $datefiff = Carbon::parse(Carbon::createFromFormat('Y-m-d', $this->submitdate))->DiffInDays(Carbon::parse(Carbon::createFromFormat('Y-m-d', $fulltbp->endprojectdate)), false);
                    return intVal($datefiff)+1 ;
                }else{
                    return "" ;  
                }
            }
        }else{
           return "" ;
        }
    } 

    public function getSubmitdateyearthAttribute(){
        if(!Empty($this->submitdate)){
            $check = DateConversion::engToThaiDate($this->submitdate);
            preg_match("/[^\/]+$/", $check, $matches);
            return $matches[0]; 
        }else{
           return "" ;
        }
    } 
    public function getSubmitdateyearbudgetthAttribute(){
        if(!Empty($this->submitdate)){
            return  $this->fiscalYear($this->submitdate);
        }else{
           return "" ;
        }
    }

    public function fiscalYear($date) {
        // วันที่ที่ต้องการตรวจสอบ
        list($year, $month, $day) = explode("-", $date);
        // วันที่ที่ส่งมา (mktime)
        $cday = mktime(0, 0, 0, $month, $day, $year);
        // ปีงบประมาณตามค่าที่ส่งมา (mktime)
        $d1 = mktime(0, 0, 0, 10, 1, $year );
        // ปีใหม่
        $d2 = mktime(0, 0, 0, 9, 30, $year + 1);
        if ($cday >= $d1 && $cday < $d2) {
            // 1 ตค. -  ธค.
        
        $year++;
        
        }
        return $year+543;
    }

    public function isintime($id){
       $businessplans = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
       $minitbps = MiniTbp::whereIn('business_plan_id',$businessplans)->pluck('id')->toArray();
       $check =  ProjectStatusTransaction::where('mini_tbp_id',$id)->whereIn('mini_tbp_id',$minitbps)->where('status',1)->first();
       if(!Empty($check)){
            $projectstatus =  ProjectStatus::where('mini_tbp_id',$id)->where('project_flow_id',$check->project_flow_id)->whereNull('actual_startdate')->first();
            if(!Empty($projectstatus)){
                
                $datefiff = Carbon::parse(Carbon::now())->DiffInDays(Carbon::createFromFormat('Y-m-d', $projectstatus->enddate), false);
                return $datefiff;
            }else{
                return 'yy';
            }
            
       }else{
        return 'xx';
       }
     
    //    if($check == 0){
    //     return false;
    //    }else{
    //     return true;
    //    }
    }

    public function getFlowstagefourAttribute(){
        $check =  ProjectStatusTransaction::where('mini_tbp_id',$this->id)->where('project_flow_id','>=',4)->count();
        if($check == 0){
         return false;
        }else{
         return true;
        }
     }

     public function getCreatedAtThAttribute(){
        return DateConversion::thaiDateTime2($this->created_at,'full');
    } 


    public function getSubmitmonthAttribute(){
        if(!Empty($this->submitdate)){
            return DateConversion::getThaiMonth($this->submitdate);
        }else{
            return '';
        }
    } 

    public function getSubmityearAttribute(){
        if(!Empty($this->submitdate)){
            return intVal(explode ("/", $this->submitdate)[0])+543; 
            // return DateConversion::getThaiMonth($this->submitdate);
        }else{
            return '';
        }
    } 

    public function getProjectleaderAttribute(){
        $fulltbp = FullTbp::where('mini_tbp_id',$this->id)->first();
        $check = ProjectAssignment::where('full_tbp_id',$fulltbp->id)->first();
        if(!Empty($check)){
            if(!Empty($check->leader_id)){
                $user = User::find($check->leader_id);
                return $user->name . ' ' . $user->lastname;
            }else{
                return '';
            }
        }
    } 

    public function getProjectnumberAttribute(){
        if(!Empty($this->submitdate)){
            return substr($this->submitdate, 3);
        }else{
            return '';
        }
    } 

    public function getIsexternalexpertAttribute()
    {
        $expertdetail = ExpertDetail::where('user_id',Auth::user()->id)->first();
        if(!Empty($expertdetail)){
            if($expertdetail->expert_type_id == 2){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}
