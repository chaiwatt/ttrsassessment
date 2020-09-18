<?php

namespace App\Model;

use App\User;
use App\Model\CriteriaTransaction;
use Illuminate\Database\Eloquent\Model;

class Scoring extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    protected $appends = ['user'];

    public function getUserAttribute(){
        return User::find($this->user_id);
    } 
}
