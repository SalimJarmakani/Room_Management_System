<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class BookingRepository implements BookingRepositoryInterface
{
    /**
     * Get all bookings with the associated room data.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllBookings()
    {
        return Booking::with('room') // Assuming the 'room' relationship is defined
            ->get();
    }

    /**
     * Create a new booking.
     *
     * @param array $data
     * @return Booking
     */
    public function createBooking(array $data)
    {
        $userId = Auth::id();
        $employee = Employee::where('user_id', $userId)->first() ?? 1;
        $data['employee_id'] = $employee->employee_id;
        $data['bookingStatus'] = 'pending';

        // Get the room_id, start_time, and end_time from the booking data
        $roomId = $data['room_id'];
        $startTime = $data['start_time'];  // assuming start_time is in 'Y-m-d H:i:s' format
        $endTime = $data['end_time'];      // assuming end_time is in 'Y-m-d H:i:s' format

        // Check for overlapping bookings
        $overlap = Booking::where('room_id', $roomId)
            ->where(function ($query) use ($startTime, $endTime) {
                // Check if the booking start or end time overlaps with existing bookings
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        // Also check if the new booking period is contained within an existing booking
                        $query->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                    });
            })
            ->exists(); // Return true if any overlap exists

        if ($overlap) {
            // Return error message if there is an overlap
            return ['error' => 'The selected room is already booked during this time.'];
        }

        // No overlap, proceed with creating the booking
        return Booking::create($data);
    }

    /**
     * Update an existing booking.
     *
     * @param int $bookingId
     * @param array $data
     * @return Booking
     */
    public function updateBooking($bookingId, array $data)
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->update($data);
        return $booking;
    }

    public function getAllBookingsWithEmployeeAndUser()
    {

        return Booking::with(['employee.user'])->get();
    }

    /**
     * Get a booking by ID.
     *
     * @param int $bookingId
     * @return Booking
     */
    public function getBookingById($bookingId)
    {
        return Booking::findOrFail($bookingId);
    }
}
