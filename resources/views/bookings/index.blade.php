@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Bookings List</h1>
    <a href="{{ route('bookings.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        New Booking
    </a>
</div>

<table class="min-w-full leading-normal">
    <thead>
        <tr>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Guest / User
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Room
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Check In/Out
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Total Price
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Status
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Actions
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                @if($booking->guest)
                    {{ $booking->guest->name }} (Guest)
                @elseif($booking->user)
                    {{ $booking->user->name }} (User)
                @else
                    N/A
                @endif
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                {{ $booking->room->room_number }} ({{ $booking->room->room_type }})
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                {{ $booking->check_in_date->format('Y-m-d') }} to {{ $booking->check_out_date->format('Y-m-d') }}
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                ${{ number_format($booking->total_price, 2) }}
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <span class="relative inline-block px-3 py-1 font-semibold leading-tight
                    {{ $booking->status == 'Confirmed' ? 'text-green-900' : ($booking->status == 'Pending' ? 'text-orange-900' : 'text-red-900') }}">
                    <span aria-hidden class="absolute inset-0 opacity-50 rounded-full
                        {{ $booking->status == 'Confirmed' ? 'bg-green-200' : ($booking->status == 'Pending' ? 'bg-orange-200' : 'bg-red-200') }}"></span>
                    <span class="relative">{{ $booking->status }}</span>
                </span>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <a href="{{ route('bookings.edit', $booking) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection