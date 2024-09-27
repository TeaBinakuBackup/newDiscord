<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RequestStatuses extends Model
{
    protected $table = 'request_statuses';
    protected $fillable = ['name'];

    public function friendRequests()
    {
        return $this->hasMany(FriendRequestModel::class , 'request_statuses_id' , 'id');

    }
}
