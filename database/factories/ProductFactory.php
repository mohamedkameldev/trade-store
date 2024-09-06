<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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

    public function definition(): array
    {
        $name = $this->faker->words(2, true);  // return 2 words as a string not an array
        $price = $this->faker->randomFloat(2, 1, 500);
        return [
            'store_id' => Store::inRandomOrder()->first()->id,
            'category_id' => generateParentId('categories', 10),
            'name' => $name,
            'description' => $this->faker->sentences(2, true), // 2 sentences as a text not an array
            'image' => $this->faker->imageUrl(word: "$name-product"),
            'compare_price' => ($price + $this->faker->randomNumber(2)),
            'featured' => rand(0, 1),
        ];
    }
}
