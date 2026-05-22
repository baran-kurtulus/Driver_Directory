<?php

namespace Database\Factories;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => fake()->unique()->numerify('05#########'),
            'license_number' => fake()->unique()->bothify('??-####-??'),
            'vehicle_type' => fake()->randomElement(['sedan', 'suv', 'minivan', 'truck']),
            'status' => fake()->randomElement(['active', 'inactive', 'on_trip']),
            'email' => fake()->unique()->safeEmail(),
            'license_expiry' => fake()->dateTimeBetween('+1 month', '+5 years')->format('Y-m-d'),
        ];
    }
}
