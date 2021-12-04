<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{

    public function getUserNotifications()
    {
        $notifications = Notifications::where('user_id', Auth::id())->with('user')->orderBy('created_at', 'DESC')->get();
        return response()->json([
            'success' => true,
            'data' => $notifications,
            'Message' => 'Your Notifications',
        ]);
    }
}
