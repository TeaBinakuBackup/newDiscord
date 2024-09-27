<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MessagesModel extends Model
{
    protected $table = 'messages';

    protected $fillable = ['content','read_at','sender_id','receiver_id','group_chat_id'];

    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id');

    }
    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id');

    }
    public function groupChat()
    {
        return $this->belongsTo(GroupChatsModel::class,'group_chat_id');

    }

}

