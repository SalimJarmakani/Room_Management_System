<?php

namespace App\Http\Controllers\Rooms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function showBookingForm()
    {
        return view('rooms.book'); // Pass the room data to the view
    }
}
