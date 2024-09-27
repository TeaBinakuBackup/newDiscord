<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class FriendRequestModel extends Model
{
    protected $table = 'friend_requests';
    protected $fillable = ['requester_user_id','requesting_user_id','request_status_id',
    ];

    public function Requester()
    {
        return $this->belongsTo(User::class,'requester_user_id');
    }
    public function RequestingUser()
    {
        return $this->belongsTo(User::class,'requesting_user_id');
    }
    public function RequestStatus(){
        return $this->belongsTo(RequestStatuses::class,'request_status_id');
    }


}
