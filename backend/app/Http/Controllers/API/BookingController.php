<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::all();
        $bookings = BookingResource::collection($bookings);
        return response()->json(['success' => true, 'data' => $bookings]);
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
    public function store(BookingRequest $request)
    {
        Booking::store($request);
        return response()->json(['success' => true, 'message' => "Booking created succesfully"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::find($id);
        $booking = new BookingResource($booking);
        return response()->json(['success' => true, 'data' => $booking]);

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
    public function acceptBooking(string $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            // Handle the case where the booking is not found
            return response()->json(['error', 'Booking not found'], 404);
        }
    
        $booking->status = 'confirmed';
        $booking->save(); // Save the updated status to the database
    
        return  response()->json(['success', 'Booking confirmed successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function rejectBooking(string $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            // Handle the case where the booking is not found
            return response()->json(['error', 'Booking not found'], 404);
        }
    
        $booking->status = 'rejected';
        $booking->save(); // Save the updated status to the database
    
        return  response()->json(['success', 'Booking rejected successfully'], 200);
    }
    public function cancelBooking(string $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            // Handle the case where the booking is not found
            return response()->json(['error', 'Booking not found'], 404);
        }
    
        $booking->status = 'cancelled';
        $booking->save(); // Save the updated status to the database
    
        return  response()->json(['success', 'Booking cancelled successfully'], 200);
    }
}
