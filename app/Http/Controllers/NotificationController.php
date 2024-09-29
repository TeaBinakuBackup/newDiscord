<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Fetch unread notifications for the authenticated user
    public function getNotifications()
    {
        return response()->json(Auth::user()->unreadNotifications);
    }

    // Mark a notification as read
    public function markNotificationAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json('Notification marked as read');
    }
}
