<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class FriendRequestNotification extends Notification
{
    use Queueable;

    protected $requestingUser;

    public function __construct($requestingUser)
    {
        $this->requestingUser = $requestingUser;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->requestingUser->name . ' has sent you a friend request.',
            'requester_user_id' => $this->requestingUser->id,
        ];
    }
}
