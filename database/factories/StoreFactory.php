<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    protected static $image_counter = 0;
    protected static $cover_counter = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'name' => $this->faker->word(),
            'name' => fake()->department,
            'description' => $this->faker->sentence(15, true), // random number from 1 to 15
            // 'logo_image' => $this->faker->imageUrl(300, 300, category: 'store'),
            'logo_image' => staticImages(StoreFactory::$image_counter),
            'cover_image' => staticImages(StoreFactory::$cover_counter),
            'status' => Arr::random(['active', 'inactive']),
        ];
    }
}
