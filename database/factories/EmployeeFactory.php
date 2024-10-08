<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => rand(1000000000,55555555555),
            'date_of_birth' => now(),
            'hire_date' => fake()->date(),
            'is_active' => fake()->randomElement(['0','1']),
            'address' => fake()->name(),
        ];
    }
}
