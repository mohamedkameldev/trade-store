<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            // 'parent_id' => generateParentId('categories', 1),
            'parent_id' => Category::inRandomOrder()->first()->id,
            'image' => $this->staticImages(CategoryFactory::$counter),
            'status' => fake()->randomElement(['active', 'archived']),
        ];
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
        if (strlen($counter) == 1) {
            return "uploads/0" . $counter . '.png';
        }
        return "uploads/" . $counter . '.png';
    }
}
