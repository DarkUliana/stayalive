<?php

namespace App\Http\Controllers;

use App\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('expiration_date', '>', date('Y-m-d H:i:s', time()))
            ->orWhere('isSimple', 1)
            ->orderBy('isSimple', 'desc')
            ->orderBy('updated_at')
            ->get();

        return response($notifications->toArray(), 200);
    }
}
