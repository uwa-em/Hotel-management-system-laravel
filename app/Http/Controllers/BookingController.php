<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['guest', 'room'])->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $guests = Guest::all();
        $rooms = Room::where('status', 'Available')->get();
        return view('bookings.create', compact('guests', 'rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'status' => 'required|in:Pending,Confirmed,Cancelled,Checked-out',
        ]);

        $room = Room::find($validated['room_id']);
        $checkIn = Carbon::parse($validated['check_in_date']);
        $checkOut = Carbon::parse($validated['check_out_date']);
        $days = $checkIn->diffInDays($checkOut);
        
        $validated['total_price'] = $days * $room->price_per_night;

        Booking::create($validated);

        // Update room status if confirmed
        if ($validated['status'] == 'Confirmed') {
            $room->update(['status' => 'Occupied']);
        }

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function edit(Booking $booking)
    {
        $guests = Guest::all();
        $rooms = Room::all();
        return view('bookings.edit', compact('booking', 'guests', 'rooms'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'status' => 'required|in:Pending,Confirmed,Cancelled,Checked-out',
        ]);

        $room = Room::find($validated['room_id']);
        $checkIn = Carbon::parse($validated['check_in_date']);
        $checkOut = Carbon::parse($validated['check_out_date']);
        $days = $checkIn->diffInDays($checkOut);
        
        $validated['total_price'] = $days * $room->price_per_night;

        $oldStatus = $booking->status;
        $booking->update($validated);

        // Update room status logic
        if ($validated['status'] == 'Confirmed' && $oldStatus != 'Confirmed') {
            $room->update(['status' => 'Occupied']);
        } elseif ($validated['status'] == 'Checked-out' || $validated['status'] == 'Cancelled') {
            $room->update(['status' => 'Available']);
        }

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $room = $booking->room;
        $booking->delete();
        
        // Free up the room if it was occupied by this booking
        $room->update(['status' => 'Available']);

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
