<?php

namespace App\Model;

use App\User;
use App\Helper\TimeAgo;
use App\Model\MessageBoxAttachment;
use Illuminate\Database\Eloquent\Model;

class MessageBox extends Model
{
    //
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['sender','timeago'];
    public function getSenderAttribute()
    {
        return User::find($this->sender_id);
    }

    public function getMessageBoxAttachmentAttribute()
    {
        return MessageBoxAttachment::where('message_box_id',$this->id)->get();
    }

    public function getTimeAgoAttribute()
    {
        return TimeAgo::timeAgo($this->created_at);
    }
    
}
