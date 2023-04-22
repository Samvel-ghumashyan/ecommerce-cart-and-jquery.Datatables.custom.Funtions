<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'products' => $this->faker->words(4, true),
            'date' => $this->faker->date(),
            'phone' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->email(),
            'address' => $this->faker->longitude($min = -180, $max = 180),
            'count' => $this->faker->numberBetween(1, 10),
            'cost'  => $this->faker->numberBetween(3000, 15000),
        ];
    }
}
