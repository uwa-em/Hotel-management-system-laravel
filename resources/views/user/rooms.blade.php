@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold">Available Rooms</h1>
</div>

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($rooms as $room)
    <div class="bg-white rounded-lg shadow-md overflow-hidden border">
        <div class="p-6">
            <h2 class="text-xl font-bold mb-2">Room {{ $room->room_number }}</h2>
            <p class="text-gray-600 mb-4">{{ $room->room_type }} - ${{ number_format($room->price_per_night, 2) }} / night</p>
            <p class="text-sm text-gray-500 mb-6">{{ $room->description }}</p>
            
            <form action="{{ route('user.bookings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase">Check In</label>
                        <input type="date" name="check_in_date" class="w-full text-sm border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase">Check Out</label>
                        <input type="date" name="check_out_date" class="w-full text-sm border-gray-300 rounded-md shadow-sm" required>
                    </div>
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                    Book Now
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection