<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserBookingController extends Controller
{
    public function index()
    {
        $rooms = Room::where('status', 'Available')->get();
        return view('user.rooms', compact('rooms'));
    }

    public function myBookings()
    {
        $bookings = auth()->user()->bookings()->with('room')->get();
        return view('user.my-bookings', compact('bookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        $room = Room::find($validated['room_id']);
        
        // Check if room is still available
        if ($room->status !== 'Available') {
            return back()->with('error', 'Sorry, this room is no longer available.');
        }

        $checkIn = Carbon::parse($validated['check_in_date']);
        $checkOut = Carbon::parse($validated['check_out_date']);
        $days = $checkIn->diffInDays($checkOut);
        
        $total_price = $days * $room->price_per_night;

        Booking::create([
            'user_id' => auth()->id(),
            'room_id' => $validated['room_id'],
            'check_in_date' => $validated['check_in_date'],
            'check_out_date' => $validated['check_out_date'],
            'total_price' => $total_price,
            'status' => 'Pending',
        ]);

        return redirect()->route('user.my-bookings')->with('success', 'Booking requested successfully! Please wait for confirmation.');
    }
}