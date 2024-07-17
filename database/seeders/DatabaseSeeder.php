<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = Category::factory(10)->create();
        User::factory(5)
        ->has(
            Product::factory(10)->state(function () use ($categories) {
                return ['category_id' => $categories->random()->id];
            })
        )
        ->create();
    }
}
