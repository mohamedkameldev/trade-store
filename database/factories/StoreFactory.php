<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(15, true), // random number from 1 to 15
            'logo_image' => $this->faker->imageUrl(300, 300, category: 'store'),
            'cover_image' => $this->faker->imageUrl(),
            'status' => Arr::random(['active', 'inactive']),
        ];
    }
}
