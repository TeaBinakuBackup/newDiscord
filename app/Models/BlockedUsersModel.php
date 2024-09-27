<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BlockedUsersModel extends Model
{
    protected $table = 'blocked_users';

    protected $fillable = ['blocker_user_id','blocked_user_id'];


    public function blocker()
    {
        return $this->belongsTo(User::class,'blocker_user_id');

    }
    public function blocked()
    {
        return $this->belongsTo(User::class,'blocked_user_id');

    }
}
