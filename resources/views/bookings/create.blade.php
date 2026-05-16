@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold">New Booking</h1>
</div>

<form action="{{ route('bookings.store') }}" method="POST" class="max-w-lg">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="guest_id">
            Guest
        </label>
        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="guest_id" name="guest_id" required>
            <option value="">Select Guest</option>
            @foreach($guests as $guest)
                <option value="{{ $guest->id }}">{{ $guest->name }} ({{ $guest->email }})</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="room_id">
            Room
        </label>
        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="room_id" name="room_id" required>
            <option value="">Select Room</option>
            @foreach($rooms as $room)
                <option value="{{ $room->id }}">{{ $room->room_number }} - {{ $room->room_type }} (${{ $room->price_per_night }}/night)</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="check_in_date">
            Check-in Date
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="check_in_date" name="check_in_date" type="date" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="check_out_date">
            Check-out Date
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="check_out_date" name="check_out_date" type="date" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
            Status
        </label>
        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status" required>
            <option value="Pending">Pending</option>
            <option value="Confirmed">Confirmed</option>
        </select>
    </div>

    <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Create Booking
        </button>
        <a href="{{ route('bookings.index') }}" class="text-blue-500 hover:text-blue-800">Cancel</a>
    </div>
</form>
@endsection