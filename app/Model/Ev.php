<?php

namespace App\Model;

use App\Model\FullTbp;
use App\Model\MiniTBP;
use Illuminate\Database\Eloquent\Model;

class Ev extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getFullTbpAttribute(){
        return FullTbp::find($this->full_tbp_id);
    } 

}
