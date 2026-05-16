@extends('layouts.app')

@section('content')
<div class="text-center py-12">
    <h1 class="text-5xl font-extrabold text-blue-600 mb-4">Welcome to HotelManager</h1>
    <p class="text-xl text-gray-600 mb-8">Your complete solution for managing rooms, guests, and bookings.</p>
    
    @guest
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mb-12">
            <a href="{{ route('login') }}" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded-lg text-lg transition shadow-md hover:shadow-lg">
                Login to Book
            </a>
            <a href="{{ route('register') }}" class="w-full sm:w-auto bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold py-3 px-10 rounded-lg text-lg transition shadow-sm">
                Create Account
            </a>
        </div>
    @endguest

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('rooms.index') }}" class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow border-t-4 border-blue-500">
                    <div class="text-4xl mb-4">🏨</div>
                    <h2 class="text-2xl font-bold mb-2">Manage Rooms</h2>
                    <p class="text-gray-500">View, add, and edit hotel rooms and their status.</p>
                </a>

                <a href="{{ route('guests.index') }}" class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow border-t-4 border-green-500">
                    <div class="text-4xl mb-4">👤</div>
                    <h2 class="text-2xl font-bold mb-2">Manage Guests</h2>
                    <p class="text-gray-500">Keep track of your guests and their contact information.</p>
                </a>

                <a href="{{ route('bookings.index') }}" class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow border-t-4 border-purple-500">
                    <div class="text-4xl mb-4">📅</div>
                    <h2 class="text-2xl font-bold mb-2">Bookings</h2>
                    <p class="text-gray-500">Handle room reservations and check-in/out dates.</p>
                </a>
            @else
                <a href="{{ route('user.rooms') }}" class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow border-t-4 border-blue-500">
                    <div class="text-4xl mb-4">🏨</div>
                    <h2 class="text-2xl font-bold mb-2">Available Rooms</h2>
                    <p class="text-gray-500">Browse and book your favorite rooms.</p>
                </a>

                <a href="{{ route('user.my-bookings') }}" class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow border-t-4 border-purple-500">
                    <div class="text-4xl mb-4">📅</div>
                    <h2 class="text-2xl font-bold mb-2">My Bookings</h2>
                    <p class="text-gray-500">View your current and past room reservations.</p>
                </a>
            @endif
        @else
            <div class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-blue-500 opacity-75">
                <div class="text-4xl mb-4">🏨</div>
                <h2 class="text-2xl font-bold mb-2">Quality Rooms</h2>
                <p class="text-gray-500">Login to see our full list of available luxury rooms.</p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-green-500 opacity-75">
                <div class="text-4xl mb-4">✨</div>
                <h2 class="text-2xl font-bold mb-2">Best Service</h2>
                <p class="text-gray-500">Experience world-class hospitality and service.</p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-purple-500 opacity-75">
                <div class="text-4xl mb-4">🌟</div>
                <h2 class="text-2xl font-bold mb-2">Great Deals</h2>
                <p class="text-gray-500">Competitive pricing for all our room categories.</p>
            </div>
        @endauth
    </div>
</div>
@endsection