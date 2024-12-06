<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'employee_id' => $this->faker->unique()->randomNumber(),
            'user_id' => \App\Models\User::factory(), // Assuming users are already created
            'organization_name' => $this->faker->company(),
            'position' => $this->faker->jobTitle(),
        ];
    }
}
