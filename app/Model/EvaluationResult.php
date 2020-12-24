<?php

namespace App\Model;

use App\Model\FullTbp;
use Illuminate\Database\Eloquent\Model;

class EvaluationResult extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getFulltbpAttribute(){
        return FullTbp::find($this->full_tbp_id);
    } 
}
