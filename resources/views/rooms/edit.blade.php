@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold">Edit Room: {{ $room->room_number }}</h1>
</div>

<form action="{{ route('rooms.update', $room) }}" method="POST" class="max-w-lg">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="room_number">
            Room Number
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="room_number" name="room_number" type="text" value="{{ $room->room_number }}" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="room_type">
            Room Type
        </label>
        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="room_type" name="room_type" required>
            <option value="Single" {{ $room->room_type == 'Single' ? 'selected' : '' }}>Single</option>
            <option value="Double" {{ $room->room_type == 'Double' ? 'selected' : '' }}>Double</option>
            <option value="Suite" {{ $room->room_type == 'Suite' ? 'selected' : '' }}>Suite</option>
            <option value="Deluxe" {{ $room->room_type == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="price_per_night">
            Price per Night ($)
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="price_per_night" name="price_per_night" type="number" step="0.01" value="{{ $room->price_per_night }}" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
            Status
        </label>
        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status" required>
            <option value="Available" {{ $room->status == 'Available' ? 'selected' : '' }}>Available</option>
            <option value="Occupied" {{ $room->status == 'Occupied' ? 'selected' : '' }}>Occupied</option>
            <option value="Maintenance" {{ $room->status == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
        </select>
    </div>

    <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
            Description
        </label>
        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" rows="3">{{ $room->description }}</textarea>
    </div>

    <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Update Room
        </button>
        <a href="{{ route('rooms.index') }}" class="text-blue-500 hover:text-blue-800">Cancel</a>
    </div>
</form>
@endsection