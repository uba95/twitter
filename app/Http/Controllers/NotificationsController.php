<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function __invoke()
    {
        $old_notifications = current_user()->readNotifications;

        $new_notifications = tap(current_user()->unreadNotifications)->markAsRead();

        return view('notifications.index', compact('new_notifications', 'old_notifications'));
    }
}
// $new_notifications = current_user()->unreadNotifications;
// $old_notifications = current_user()->readNotifications;
