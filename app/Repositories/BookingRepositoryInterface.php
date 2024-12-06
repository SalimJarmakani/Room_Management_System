<?php

namespace App\Repositories;

interface BookingRepositoryInterface
{
    public function getAllBookings();
    public function createBooking(array $data);
    public function updateBooking($bookingId, array $data);
    public function getBookingById($bookingId);
}
