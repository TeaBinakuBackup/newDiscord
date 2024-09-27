<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GroupChatsModel extends Model
{
    protected $table = 'group_chats';

    protected $fillable = ['name'];
}
