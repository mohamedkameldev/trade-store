<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'description' => fake()->sentence(15),
            'parent_id' => $this->generateParentId(1),
            'image' => $this->fakeImage(),
            'status' => fake()->randomElement(['active', 'archived']),
        ];
    }

    protected function generateParentId($attempts)
    {
        $id = null;
        $lastCategoryId = DB::table('categories')->latest()->first()->id;

        while ($attempts != 0) {
            $id = fake()->numberBetween(1, $lastCategoryId);

            if(DB::table('categories')->where('id', $id)->exists()) {
                return $id;
            }

            $attempts--;
        }
        return null;
    }

    protected function fakeImage()
    {
        $image = fake()->image(
            $dir =  public_path('storage\uploads'),
            $width = 100,
            $height = 75,
            $category = 'categories',
            $fullPath = false,
            // $randomize = true,
            // $word = 'categories',
            // $format = 'png'
        );
        return "uploads/". $image;
    }
}
