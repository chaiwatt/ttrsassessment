<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ExtraScoring extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getUserAttribute(){
        return User::find($this->user_id);
    }
}
