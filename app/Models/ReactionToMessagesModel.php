<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ReactionToMessagesModel extends Model
{
    protected $table = 'reactions_to_messages';

    protected $fillable = ['emoji','reacted_by','message_id',];

    public function message(){
        return $this->belongsTo(MessagesModel::class , 'message_id');
    }
    public function user(){
        return $this->belongsTo(User::class , 'reacted_by');

    }
}
