<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $categories = [
            'cakes',
            'fish',
            'chicken',
            'pizza',
            'burger',
            'drinks',
            'ice-cream',
            'salads',
            'snacks'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }

        Restaurant::factory(8)->create()->each(function ($restaurant) {
            Menu::factory(10)->create([
                'restaurant_id' => $restaurant->id
            ]);
        });
    }
}
