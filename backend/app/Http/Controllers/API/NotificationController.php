<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getNotificationsByUserId($userId)
    {
        $notifications = Notification::where('user_id', $userId)->get();
        return response()->json($notifications);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteNotifications(Request $request)
    {
        $notificationIds = $request->input('notifications', []);

        // Validate input if needed
        // Example validation: $request->validate(['notifications' => 'required|array']);

        try {
            // Perform deletion
            Notification::whereIn('id', $notificationIds)->delete();

            return response()->json(['message' => 'Notifications deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete notifications'], 500);
        }
    }
}
