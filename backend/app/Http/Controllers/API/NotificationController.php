<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getNotificationsByUserId($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 401);
        }
        
        $notifications = Notification::where('user_id', $user->id)->latest()->get();
        
        return response()->json(['success' => true, 'data' => $notifications]);
    }

    /**
     * Mark a notification as read.
     */
    public function updateNotification($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
        }

        // Ensure only the notification owner can mark it as read
        // $user = Auth::user();
        // if ($notification->user_id !== $user->id) {
        //     return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        // }

        $notification->read = true;
        $notification->save();

        return response()->json(['success' => true, 'message' => 'Notification updated successfully']);
    }

    /**
     * Delete a notification.
     */
    public function destroy($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
        }

        // Ensure only the notification owner can delete it
        // $user = Auth::user();
        // if ($notification->user_id !== $user->id) {
        //     return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        // }

        $notification->delete();

        return response()->json(['success' => true, 'message' => 'Notification deleted successfully']);
    }
}
