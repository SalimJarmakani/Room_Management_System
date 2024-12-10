<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Amenity;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoomRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_fetches_all_rooms_with_latest_booking_and_amenities()
    {
        // Create test data

        // Create amenities
        $amenity1 = Amenity::factory()->create(['name' => 'WiFi']);
        $amenity2 = Amenity::factory()->create(['name' => 'Air Conditioning']);

        // Create rooms with amenities
        $room1 = Room::factory()->create();
        $room2 = Room::factory()->create();

        $room1->amenities()->attach([$amenity1->id, $amenity2->id]);
        $room2->amenities()->attach([$amenity1->id]);

        // Create bookings for the rooms
        Booking::factory()->create([
            'room_id' => $room1->id,
            'booking_date' => now()->subDays(2), // Older booking
        ]);

        $latestBookingRoom1 = Booking::factory()->create([
            'room_id' => $room1->id,
            'booking_date' => now(), // Latest booking
        ]);

        $latestBookingRoom2 = Booking::factory()->create([
            'room_id' => $room2->id,
            'booking_date' => now()->subDay(),
        ]);

        // Call the method
        $rooms = app(\App\Repositories\RoomRepository::class)->getAllRoomsWithLatestBooking();

        // Assertions
        $this->assertCount(2, $rooms); // Ensure both rooms are returned

        $this->assertTrue($rooms->contains(function ($room) use ($latestBookingRoom1) {
            return $room->id === $latestBookingRoom1->room_id && $room->latestBooking->id === $latestBookingRoom1->id;
        }));

        $this->assertTrue($rooms->contains(function ($room) use ($latestBookingRoom2) {
            return $room->id === $latestBookingRoom2->room_id && $room->latestBooking->id === $latestBookingRoom2->id;
        }));

        foreach ($rooms as $room) {
            $this->assertNotEmpty($room->amenities); // Ensure amenities are loaded
        }
    }
}
