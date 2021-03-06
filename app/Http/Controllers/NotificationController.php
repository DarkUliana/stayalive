<?php

namespace App\Http\Controllers;

use App\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('expirationDate', '>', date('Y-m-d H:i:s', time()))
            ->orWhere('isSimple', 1)
            ->orderBy('isSimple', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();

        $array = [];

        foreach ($notifications as $notification) {

            $array[] = [

                'id' => 'nt' . $notification->ID,
                'description' => $notification->description->key
            ];
        }

        return response(['startingNotifications' => $array], 200);
    }
}
