<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create([
            'room_number' => '101',
            'room_type' => 'Single',
            'price_per_night' => 50.00,
            'status' => 'Available',
            'description' => 'A cozy single room for one person.',
        ]);

        Room::create([
            'room_number' => '102',
            'room_type' => 'Double',
            'price_per_night' => 80.00,
            'status' => 'Available',
            'description' => 'Spacious double room for two people.',
        ]);

        Room::create([
            'room_number' => '201',
            'room_type' => 'Suite',
            'price_per_night' => 150.00,
            'status' => 'Available',
            'description' => 'Luxury suite with a great view.',
        ]);
    }
}
