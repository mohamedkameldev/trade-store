<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected static $counter = 0;
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
            'image' => $this->staticImages(CategoryFactory::$counter),
            'status' => fake()->randomElement(['active', 'archived']),
        ];
    }

    protected function generateParentId($attempts)
    {
        $id = null;
        $lastCategoryId = DB::table('categories')->orderByDesc('id')->first()->id;

        while ($attempts != 0) {
            $id = fake()->numberBetween(1, $lastCategoryId);

            if(DB::table('categories')->where('id', $id)->exists()) {
                return $id;
            }
            $attempts--;
        }
        return null;
    }

    // proper method - faker package has a problem with it
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

    protected function staticImages(&$counter)
    {
        $counter++;
        if(strlen($counter) == 1) {
            return "uploads/0" . $counter . '.png';
        }
        return "uploads/" . $counter . '.png';
    }
}
