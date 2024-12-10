<?php

namespace App\Http\Controllers\Rooms;

use App\Http\Controllers\Controller;
use App\Repositories\BookingRepository;
use App\Repositories\RoomRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingRepository;
    protected $roomRepository;
    public function __construct(BookingRepository $bookingRepository, RoomRepositoryInterface $roomRepo)
    {
        $this->bookingRepository = $bookingRepository;
        $this->roomRepository = $roomRepo;
    }

    public function showBookingForm(Request $request)
    {
        // Pass the room_id to the view
        $room = $this->roomRepository->getRoomById($request->query("room_id"));

        return view('rooms.book', ['room_id' => $request->query('room_id'), "room_name" => $room->room_name]);
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'room_id' => 'required|exists:rooms,room_id',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time',
            ]);

            // Use the repository to create a booking
            $response = $this->bookingRepository->createBooking($validatedData);

            // Check if the response contains an error (i.e., overlap detected)
            if (isset($response['error'])) {
                return redirect()->back()->withErrors(['error' => $response['error']]);
            }

            return redirect()->route('rooms.index')->with('success', 'Booking successfully created.');
        } catch (Exception $e) {
            // Handle unexpected errors
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function employees()
    {
        $bookings = $this->bookingRepository->getAllBookingsWithEmployeeAndUser();
        return view('rooms.employees', compact('bookings'));
    }
}
