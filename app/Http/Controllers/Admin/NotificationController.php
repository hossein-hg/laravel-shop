<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function readAll()
    {
        $notifications = Notification::all();
//        return response()->json(
//            [
//                'status'=>200
//            ]
//        );
        foreach ($notifications as $notification){
            $notification->read_at = now();
            $notification->save();
        }
    }
}
