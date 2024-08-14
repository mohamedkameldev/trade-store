<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $categories = [
        [
            'name' => 'Clothes',
            'parent_id' => null,
            'description' => 'find the best clothes for you',
            'image' => 'uploads\clothes.jpeg',
            'status' => 'active',
        ],
        [
            'name' => 'Men Clothes',
            'parent_id' => 1,
            'description' => 'best men clothes',
            'image' => 'uploads\men_clothes.jpeg',
            'status' => 'active',
        ],
        [
            'name' => 'Sports Clothes',
            'parent_id' => 2,
            'description' => 'find the best clothes for you',
            'image' => 'uploads\sports_clothes.jpeg',
            'status' => 'active',
        ],
        [
            'name' => 'Pants',
            'parent_id' => 2,
            'description' => 'find the best pants',
            'image' => 'uploads\pants.jpeg',
            'status' => 'active',
        ],
        [
            'name' => 'Children Clothes',
            'parent_id' => 1,
            'description' => 'best clothes for your children',
            'image' => 'uploads\children_clothes.jpeg',
            'status' => 'active',
        ],
        [
            'name' => 'Baby Clothes',
            'parent_id' => 1,
            'description' => 'best clothes for your babies',
            'image' => 'uploads\baby_clothes.jpeg',
            'status' => 'active',
        ],
    ];

    public function run(): void
    {
        Category::truncate();

        foreach ($this->categories as $category) {
            Category::create($category);
        }

        Category::factory()->count(26)->create();
    }
}
