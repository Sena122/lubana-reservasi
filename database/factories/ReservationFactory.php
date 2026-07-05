<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    public function definition(): array
{
    return [
        'name' => $this->faker->name(),
        'phone' => '08' . $this->faker->numerify('##########'),
        'date' => now()->subDays(rand(0, 6))->format('Y-m-d'), // 1 minggu ke belakang
        'session' => rand(1, 2),
        'guest_count' => rand(1, 10),
        'type' => $this->faker->randomElement(['VIP', 'REGULAR']),
        'area' => $this->faker->randomElement(['RESTO', 'MONSTER']),
        'dp_status' => $this->faker->boolean(),
        'status' => $this->faker->randomElement(['pending', 'done', 'canceled']),
        ];
    }
}