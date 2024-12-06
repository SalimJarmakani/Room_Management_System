<?php

namespace App\Repositories;

use App\Models\Room;

interface RoomRepositoryInterface
{
    public function getAllRooms();
    public function getAllRoomsWithLatestBooking();
    public function createRoomWithAmenities(array $roomData, array $amenities);
    public function filterRoomsByAmenities($request);
    public function getRoomById($room_id);  // Use room_id as parameter
    public function createRoom(array $data);
    public function updateRoom($room_id, array $data);  // Use room_id as parameter
    public function deleteRoom($room_id);  // Use room_id as parameter
}
