<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    function __construct()
    {
        $this->middleware('role_or_permission:Booking access|Booking create|Booking edit|Booking delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Booking create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Booking edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Booking delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            // Admin: get all bookings
            $bookings = Booking::latest()->get();
        } else {
            // Owner: get bookings for their fields
            $fields = $user->fields()->pluck('id');
            $bookings = Booking::whereIn('field_id', $fields)->latest()->get();
        }

        $bookings = BookingResource::collection($bookings);
        return view('setting.booking.index', compact('bookings'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        $booking = Booking::find($id);
        $booking = new BookingResource($booking);
        return view('setting.booking.show', compact('booking'));
    }

    public function update(string $id)
    {
        //
    }

    public function cancel($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found');
        }

        $booking->status = 'cancelled';
        $booking->save();

        $this->createNotification($booking->user_id, 'booking_cancelled', 'Your booking has been cancelled.', $booking->id);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking cancelled successfully');
    }

    public function reject(string $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found');
        }

        $booking->status = 'rejected';
        $booking->save();

        $this->createNotification($booking->user_id, 'booking_rejected', 'Your booking has been rejected.', $booking->id);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking rejected successfully');
    }

    public function accept(string $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        $booking->status = 'confirmed';
        $booking->save();

        $this->createNotification($booking->user_id, 'booking_confirmed', 'Your booking has been confirmed.', $booking->id);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking accepted successfully');
    }

    public function reStore(string $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found');
        }

        $booking->status = 'confirmed';
        $booking->save();

        $this->createNotification($booking->user_id, 'booking_rebooked', 'Your booking has been rebooked.', $booking->id);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking rebooked successfully');
    }

    public function destroy(string $id)
    {
        //
    }

    private function createNotification($userId, $type, $text, $bookingId)
    {
        $notification = new Notification();
        $notification->user_id = $userId;
        $notification->notification_type = $type;
        $notification->notification_text = $text;
        $notification->notification_data = json_encode(['booking_id' => $bookingId]);
        $notification->read = false;
        $notification->save();
    }

}
