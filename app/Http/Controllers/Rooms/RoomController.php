<?php

namespace App\Http\Controllers\Rooms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        // Static room data (this could come from a database in a real-world app)
        $rooms = [
            [
                'name' => 'Conference Room A',
                'description' => 'Perfect for meetings and presentations.',
                'availability' => 'Available',
                'availability_color' => 'green-500',
                'capacity' => '10 People',
                'amenities' => 'Wi-Fi, Projector',
            ],
            [
                'name' => 'Meeting Room B',
                'description' => 'Ideal for smaller team discussions.',
                'availability' => 'Booked',
                'availability_color' => 'red-500',
                'capacity' => '6 People',
                'amenities' => 'Whiteboard',
            ],
            [
                'name' => 'Training Room C',
                'description' => 'Equipped for large training sessions.',
                'availability' => 'Available',
                'availability_color' => 'green-500',
                'capacity' => '20 People',
                'amenities' => 'Wi-Fi, Projector',
            ],
        ];

        // Pass rooms to the view
        return view('rooms.index', compact('rooms'));
    }

    public function showCalendar()
    {

        return View("rooms.calendar");
    }
}
