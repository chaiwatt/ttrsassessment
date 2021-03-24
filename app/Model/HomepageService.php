<?php

namespace App\Model;

use App\Model\CardColor;
use Illuminate\Database\Eloquent\Model;

class HomepageService extends Model
{
    protected $fillable = [];
    protected $guarded = [];

   public function getCardcolorAttribute(){
        return CardColor::find($this->cardcolor_id);
    } 

}
