<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Booking access|Booking create|Booking edit|Booking delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Booking create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Booking edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Booking delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $bookings = Booking::latest()->get();
        $bookings = BookingResource::collection($bookings);
        return view('setting.booking.index', compact('bookings'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Accept the booking
     */
    public function store(Request $request)
    {
        dd(1);
        
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::find($id);
        $booking = new BookingResource($booking);
        return view('setting.booking.show', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
       
    }
    public function cancel($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found');
        }
        $booking->status = 'cancelled';
        $booking->save();
    
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
    
        return redirect()->route('admin.bookings.index')->with('success', 'Booking rejected successfully');
    }

    public function accept(string $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found');
        }
        $booking->status = 'comfirmed';
        $booking->save();
    
        return redirect()->route('admin.bookings.index')->with('success', 'Booking accepted successfully');
    }

    public function reBook(string $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found');
        }
        $booking->status = 'comfirmed';
        $booking->save();
    
        return redirect()->route('admin.bookings.index')->with('success', 'Booking rebooked successfully');
    }

    /**
     * remove the booking
     */
    public function destroy(string $id)
    {
        //
    }
}
