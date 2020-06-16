<?php

namespace App\Model;

use App\Model\MiniTBP;
use Illuminate\Database\Eloquent\Model;

class FullTbp extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getMiniTbpAttribute(){
        return MiniTBP::find($this->mini_tbp_id)->first();
    } 
}
