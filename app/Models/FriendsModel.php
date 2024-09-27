<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class FriendsModel extends Model
{
    protected $table = 'friends';

    protected $fillable = ['user_id_1', 'user_id_2'];

    public function user1(){
        return $this->belongsTo(User::class, 'user_id_1');
    }
    public function user2(){
        return $this->belongsTo(User::class, 'user_id_2');
    }

}
