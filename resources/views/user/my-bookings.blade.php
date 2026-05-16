@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold">My Bookings</h1>
</div>

@if($bookings->isEmpty())
    <div class="bg-gray-100 p-8 rounded-lg text-center">
        <p class="text-gray-600 mb-4">You have no bookings yet.</p>
        <a href="{{ route('user.rooms') }}" class="text-blue-600 hover:underline">Browse available rooms</a>
    </div>
@else
    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Room
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Dates
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Total Price
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection