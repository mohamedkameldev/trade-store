<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Disable foreign key checks
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // Re-enable foreign key checks
        // laravel cann't truncate the table because of it's a parent to another table, so we do this

        foreach ($this->categories as $category) {
            Category::create($category);
        }

        Category::factory()->count(4)->create();
        // Category::factory(4)->create();
    }
}
