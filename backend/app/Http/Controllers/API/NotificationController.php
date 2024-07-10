<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getNotificationsByUserId($userId)
    {
        // Ensure only the authenticated user can fetch their notifications
        $user = Auth::user();
        if (!$user || $user->id != $userId) {
            return response()->json(['success' => false, 'message' => 'Unauthorized access'], 403);
        }

        $notifications = Notification::where('user_id', $userId)->latest()->get();
        
        return response()->json(['success' => true, 'data' => $notifications]);
    }


    public function updateNotification($id)
    {
        $notification = Notification::find($id);
        $notification['read'] = true;
        $notification ->save();
        return response()->json(['success' => true, 'message' => 'updated notification successfully']);
    }

   
    public function destroy($id)
    {
        $notification = Notification::find($id);
        
        if (!$notification) {
            return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
        }

        $notification->delete();

        return response()->json(['success' => true, 'message' => 'Notification deleted successfully']);
    }
}
