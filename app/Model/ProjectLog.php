<?php

namespace App\Model;

use App\User;
use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class ProjectLog extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    protected $casts = [
        'viewer' => 'array'
    ];

    public function getUserAttribute()
    {
        return User::find($this->user_id);
    }

    public function getCreatedAtThAttribute(){
        return DateConversion::engToThaiDate($this->created_at->toDateString());
    } 
}
