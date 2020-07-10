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
}
