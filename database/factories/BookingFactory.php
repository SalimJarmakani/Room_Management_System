<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Room;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        // Generate a random start time within the next 30 days
        $start_time = $this->faker->dateTimeBetween('now', '+30 days');

        // Convert start_time to Carbon instance for date manipulation
        $start_time = Carbon::instance($start_time);

        // Add a random duration between 1 and 4 hours to the start time to generate end time
        $end_time = $start_time->copy()->addHours(rand(1, 4));

        return [
            'room_id' => Room::factory(),
            'employee_id' => Employee::factory(),
            'start_time' => $start_time,
            'end_time' => $end_time,
            'bookingStatus' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}
