<?php

namespace App\Model;

use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getCreatedatThAttribute(){
        return DateConversion::engToThaiDate($this->created_at->toDateString());
    } 

}
