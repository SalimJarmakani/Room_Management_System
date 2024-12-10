<?php

namespace App\Http\Controllers\Rooms;

use App\Http\Controllers\Controller;
use App\Repositories\BookingRepositoryInterface;
use App\Repositories\RoomRepositoryInterface;
use App\Models\Amenity;
use Exception;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $roomRepository;
    protected $bookingRepository;

    public function __construct(RoomRepositoryInterface $roomRepository, BookingRepositoryInterface $bookingRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->bookingRepository = $bookingRepository;
    }
    public function index()
    {
        $rooms = $this->roomRepository->getAllRoomsWithLatestBooking();

        // Static room data (this could come from a database in a real-world app)
        // $rooms = [
        //     [
        //         'name' => 'Conference Room A',
        //         'description' => 'Perfect for meetings and presentations.',
        //         'availability' => 'Available',
        //         'availability_color' => 'green-500',
        //         'capacity' => '10 People',
        //         'amenities' => 'Wi-Fi, Projector',
        //     ],
        //     [
        //         'name' => 'Meeting Room B',
        //         'description' => 'Ideal for smaller team discussions.',
        //         'availability' => 'Booked',
        //         'availability_color' => 'red-500',
        //         'capacity' => '6 People',
        //         'amenities' => 'Whiteboard',
        //     ],
        //     [
        //         'name' => 'Training Room C',
        //         'description' => 'Equipped for large training sessions.',
        //         'availability' => 'Available',
        //         'availability_color' => 'green-500',
        //         'capacity' => '20 People',
        //         'amenities' => 'Wi-Fi, Projector',
        //     ],
        //];
        // Pass rooms to the view
        return view('rooms.index', compact('rooms'));
    }

    public function show($roomId)
    {
        $room = $this->roomRepository->getRoomById($roomId);
        return view('rooms.details', compact('room'));
    }

    public function create()
    {
        // Fetch all available amenities to populate the form
        $amenities = Amenity::all();

        return view('rooms.create', compact('amenities'));
    }

    public function showCalendar()
    {
        $bookings = $this->bookingRepository->getAllBookings();
        $events = $bookings->map(function ($booking) {
            return [
                'id' => $booking->booking_id,
                'title' => $booking->room->room_name,
                'start' => $booking->start_time->toDateTimeString(),
                'end' => $booking->end_time->toDateTimeString(),
                'allDay' => false,
            ];
        });



        return view('rooms.calendar', ['events' => $events, 'bookings' => $bookings]);
    }

    public function table()
    {
        $rooms = $this->roomRepository->getAllRooms();
        return view('rooms.table', compact('rooms'));
    }

    public function store(Request $request)
    {
        try {


            $validated = $request->validate([
                'room_name' => 'required|string|max:255',
                'capacity' => 'required|integer|min:1',
                'description' => 'nullable|string',
                'amenities' => 'array',
                'amenities.*' => 'exists:amenities,id',
            ]);

            $roomData = $request->only(['employee_id', 'room_name', 'capacity', 'description']);


            $amenities = $request->input('amenities', []);


            $this->roomRepository->createRoomWithAmenities($roomData, $amenities);

            return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
        } catch (Exception $e) {
            print_r($e->getMessage());

            exit();
        }
    }

    public function search(Request $request)
    {
        // Get all available amenities
        $amenities = Amenity::all();

        $rooms = $this->roomRepository->filterRoomsByAmenities($request);



        return view('rooms.search', compact('amenities', 'rooms'));
    }

    public function update(Request $request, $roomId)
    {
        $validated = $request->validate([
            'room_name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $this->roomRepository->updateRoom($roomId, $validated);

        return redirect()->route('rooms.details', $roomId)->with('success', 'Room details updated successfully.');
    }

    /**
     * Delete the specified room.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->roomRepository->deleteRoom($id);

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}
