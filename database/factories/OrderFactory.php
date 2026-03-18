<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

// @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>

class OrderFactory extends Factory
{
    // Define the model's default state.
    // @return array<string, mixed>

    public function definition(): array
    {
        return [
            'total' => $this->faker->numberBetween(100, 1000),
            'date' => $this->faker->date(),
            'paid' => $this->faker->boolean(),
            'shipped' => $this->faker->word(),
            'methodOfPayment' => $this->faker->randomElement(['card', 'cash', 'bank']),
        ];
    }
}
