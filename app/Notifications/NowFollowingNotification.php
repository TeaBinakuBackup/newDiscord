<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NowFollowingNotification extends Notification
{
    use Queueable;

    protected $otherUser;

    /**
     * Create a new notification instance.
     *
     * @param $otherUser - The user who is now following the notified user
     */
    public function __construct($otherUser)
    {
        dump($otherUser);
        $this->otherUser = $otherUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->otherUser->name . ' is now following you.',

        ];
    }
}
