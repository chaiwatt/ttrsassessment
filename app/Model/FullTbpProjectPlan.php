<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\FullTbpProjectPlanTransaction;

class FullTbpProjectPlan extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    
    protected $appends = ['fulltbpprojectplantransaction'];

    public function getFullTbpProjectPlanTransactionAttribute()
    {
        return FullTbpProjectPlanTransaction::where('project_plan_id',$this->id)->get();
    }

    public function planIndex($month)
    {
        $check = FullTbpProjectPlanTransaction::where('full_tbp_id',$this->full_tbp_id)->where('project_plan_id',$this->id)->where('month',$month)->first();
        if(!Empty($check)){
            return $check->mindex;
        }else{
            return null;
        }
        return FullTbpProjectPlanTransaction::where('project_plan_id',$this->id)->get();
    }
}
