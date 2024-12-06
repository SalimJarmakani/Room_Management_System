<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Amenity;
use App\Models\RoomAmenity; // Make sure to import the RoomAmenity model
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Insert default amenities
        Amenity::create(['name' => 'WiFi']);
        Amenity::create(['name' => 'Projector']);
        Amenity::create(['name' => 'Whiteboard']);
        Amenity::create(['name' => 'TV']);
    }
}
