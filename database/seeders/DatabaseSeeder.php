<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        #------------- Seeding from the Seeder
        // $this->call([
        //     CategorySeeder::class
        // ]);

        #------------- Seeding directrly from the Factory
        // Store::factory(5)->create();
        Product::factory(25)->create();
    }
}
