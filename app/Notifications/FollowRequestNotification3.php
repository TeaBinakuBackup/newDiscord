<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class FollowRequestNotification3 extends Notification
{
    use Queueable;

    protected $requestingUser;

    /**
     * Create a new notification instance.
     *
     * @param $requestingUser - the user who sent the follow request
     */
    public function __construct($requestingUser)
    {
        $this->requestingUser = $requestingUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  object  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // Use database notification instead of mail
        return ['database'];
    }

    /**
     * Get the array representation of the notification for storing in the database.
     *
     * @param  object  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->requestingUser->name . ' has sent you a follow request.',

        ];
    }
}
