<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\Employee;
use App\Models\RoomAmenity;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RoomRepository implements RoomRepositoryInterface
{
    /**
     * Get all rooms.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRooms()
    {
        return Room::all();
    }

    public function getAllRoomsWithLatestBooking()
    {
        return Room::with('latestBooking', 'amenities')->get();  // Eager load the latest booking
    }

    /**
     * Get a room by its room_id.
     *
     * @param int $room_id
     * @return \App\Models\Room|null
     */
    public function getRoomById($room_id)
    {
        return Room::find($room_id);  // Use room_id as the primary key
    }

    /**
     * Create a new room.
     *
     * @param array $data
     * @return \App\Models\Room
     */
    public function createRoom(array $data)
    {
        return Room::create($data);
    }

    /**
     * Create a room and associate amenities.
     *
     * @param array $roomData
     * @param array $amenities
     * @return Room
     */
    public function createRoomWithAmenities(array $roomData, array $amenities): Room
    {
        try {
            // Get the authenticated user's employee ID
            $userId = Auth::id();
            $employee = Employee::where('user_id', $userId)->first();
            $roomData['employee_id'] = $employee->employee_id ?? 1;

            // Create the room
            $room = Room::create($roomData);

            $roomCreated = Room::orderBy('room_id', 'desc')->first();


            // Attach amenities manually
            if (!empty($amenities)) {
                foreach ($amenities as $amenityId) {
                    RoomAmenity::create([
                        'room_id' => $roomCreated->room_id,
                        'amenity_id' => $amenityId,
                    ]);
                }
            }

            return $room;
        } catch (Exception $e) {
            print_r($e->getMessage());
            exit();
        }
    }

    public function filterRoomsByAmenities($request)
    {

        // If the search form is submitted, filter the rooms based on selected amenities
        return Room::whereHas('amenities', function ($query) use ($request) {
            if ($request->has('amenities') && !empty($request->amenities)) {
                $query->whereIn('amenity_id', $request->amenities);
            }
        })->get();
    }



    /**
     * Update an existing room.
     *
     * @param int $room_id
     * @param array $data
     * @return Room
     */
    public function updateRoom($room_id, array $data)
    {
        $room = Room::find($room_id);  // Use room_id for finding the room
        if ($room) {
            $room->update($data);
        }
        return $room;
    }

    /**
     * Delete a room.
     *
     * @param int $room_id
     * @return bool|null
     */
    public function deleteRoom($room_id)
    {
        $room = Room::find($room_id);  // Use room_id for finding the room
        if ($room) {
            return $room->delete();
        }
        return false;
    }
}
